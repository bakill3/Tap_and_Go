<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey("API KEY HERE");

require 'ligar_db.php';
$total = 0;
$product_array = array();

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                $output = array(
                    "city"           => @$ipdat->geoplugin_city,
                    "state"          => @$ipdat->geoplugin_regionName,
                    "country"        => @$ipdat->geoplugin_countryName,
                    "country_code"   => @$ipdat->geoplugin_countryCode,
                    "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                    "continent_code" => @$ipdat->geoplugin_continentCode
                );
                break;
                case "address":
                $address = array($ipdat->geoplugin_countryName);
                if (@strlen($ipdat->geoplugin_regionName) >= 1)
                    $address[] = $ipdat->geoplugin_regionName;
                if (@strlen($ipdat->geoplugin_city) >= 1)
                    $address[] = $ipdat->geoplugin_city;
                $output = implode(", ", array_reverse($address));
                break;
                case "city":
                $output = @$ipdat->geoplugin_city;
                break;
                case "state":
                $output = @$ipdat->geoplugin_regionName;
                break;
                case "region":
                $output = @$ipdat->geoplugin_regionName;
                break;
                case "country":
                $output = @$ipdat->geoplugin_countryName;
                break;
                case "countrycode":
                $output = @$ipdat->geoplugin_countryCode;
                break;
            }
        }
    }
    return $output;
}
$ip = $_SERVER['REMOTE_ADDR'];
$user_country = ip_info($ip, "Country");

if ($user_country == 'United Kingdom') {
    $currency = "£";
    $currency_format = "gbp";
} else {
    $currency = "€";
    $currency_format = "eur";
}

if (!empty($_SESSION["cart"])) {
    foreach ($_SESSION["cart"] as $item) {
        $item_total = $item["item_quantity"] * $item["item_price"];
        $total += $item_total;

        $nome = $item["item_name"];
        $quantity = $item['item_quantity'];
        $imagem = "https://tapgotech.com/". $item['item_imagem'];
        $descricao = $item["item_description"];
        $description = substr($descricao, 0, 20);
        $price = $item["item_price"];
        $price_in_cents = $price * 100;
        
        // Construct the line_item and add it to the product_array
        $product_array[] = [
            'quantity' => $quantity,
            'price_data' => [
                'currency' => $currency_format,
                'unit_amount' => $price_in_cents,
                'product_data' => [
                    'name' => $nome,
                    'description' => $description,
                    'images' => [$imagem],
                ]
            ],
            'adjustable_quantity' => [
                'enabled' => true,
                'minimum' => 0,
                'maximum' => 50,
            ],
        ];
    }
}

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://tapgotech.com/success.php",
    "cancel_url" => "http://tapgotech.com/checkout.php",
    "allow_promotion_codes" => true,
    "locale" => "auto",
    "line_items" => $product_array // Use the constructed array here
]);

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $user_ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $user_ip = $_SERVER['REMOTE_ADDR'];
}

$stripe_charge_id = $checkout_session->id;
$sql = "INSERT INTO orders (first_name, last_name, email, address1, establishment, country, zip, payment_method, total_price, stripe_charge_id, ip)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$firstname = htmlspecialchars(mysqli_real_escape_string($link, $_POST['firstName']));
$lastName = htmlspecialchars(mysqli_real_escape_string($link, $_POST['lastName']));
$email = htmlspecialchars(mysqli_real_escape_string($link, $_POST['email']));
$address = htmlspecialchars(mysqli_real_escape_string($link, $_POST['address']));
$establishment = htmlspecialchars(mysqli_real_escape_string($link, $_POST['establishment']));
$country = htmlspecialchars(mysqli_real_escape_string($link, $_POST['country']));
$zip = htmlspecialchars(mysqli_real_escape_string($link, $_POST['zip']));
$paymentMethod = htmlspecialchars(mysqli_real_escape_string($link, $_POST['paymentMethod']));
$total = htmlspecialchars(mysqli_real_escape_string($link, $_POST['total']));


$stmt = $link->prepare($sql);
$stmt->bind_param('ssssssssdss', 
    $firstname,
    $lastName,
    $email,
    $address,
    $establishment,
    $country,
    $zip,
    $paymentMethod,
    $total,
    $stripe_charge_id,
    $user_ip 
);

if (!$stmt->execute()) {
    die("Error saving the order: " . $stmt->error);
}

$orderId = $stmt->insert_id;
$_SESSION['payment_data'][0] = $orderId;
$_SESSION['payment_data'][1] = $stripe_charge_id;
$stmt->close();


foreach ($_SESSION["cart"] as $item) {
    $productId = $item["item_id"];
    $productName = $item["item_name"];
    $quantity = $item["item_quantity"];
    $pricePerUnit = $item["item_price"];
    $totalPrice = $quantity * $pricePerUnit;

    $sql = "INSERT INTO order_details (order_id, product_id, product_name, quantity, price_per_unit, total_price)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $link->prepare($sql);
    $stmt->bind_param('iissdd', $orderId, $productId, $productName, $quantity, $pricePerUnit, $totalPrice);

    if (!$stmt->execute()) {
        echo "Error saving order details: " . $stmt->error;
    }

    $stmt->close();
}

http_response_code(303);
header("Location: " . $checkout_session->url);
?>
