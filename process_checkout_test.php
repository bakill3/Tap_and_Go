<?php
// Include the Stripe PHP SDK
require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('STRIPE_API_KEY');  // Replace with your Stripe secret key

// Endpoint to create a Stripe session and return the session ID
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['createStripeSession'])) {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card', 'paypal', 'ideal', 'blik', 'bancontact', 'eps', 'giropay', 'klarna', 'google_pay', 'apple_pay'],
        'line_items' => [[  // You'll need to adjust this based on your cart's content
            'price_data' => [
                'currency' => 'usd',  // Change this to your currency
                'product_data' => [
                    'name' => 'Your product name',
                ],
                'unit_amount' => 2000,  // example amount, adjust based on your cart
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'YOUR_SUCCESS_URL',  // Update with your success URL
        'cancel_url' => 'YOUR_CANCEL_URL',  // Update with your cancel/failure URL
    ]);
    
    echo json_encode(['id' => $session->id]);
    exit();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey("STRIPE_API_KEY");

require 'ligar_db.php';

if (isset($_POST['stripeToken'])) {
    //echo "Received token: " . $_POST['stripeToken'];
} else {
    die("Stripe token not received.");
}

function generatePassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[random_int(0, strlen($chars) - 1)];
    }
    return $password;
}

function sendOrderConfirmationEmail($order, $details) {
    global $link;

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    
    try {
        //$productsHtml = "";
        $total_price_count = 0;
        foreach ($details as $detail) {
            $productBlock = "<div style='margin-bottom: 10px;'>";
            $productBlock .= "<img src='" . $detail['item_imagem'] . "' width='50px' height='50px'>";
            $productBlock .= "<p>" . $detail['product_name'] . "</p>";
            $productBlock .= "<p>" . $detail['quantity'] . " x " . $detail['price_per_unit'] . "€</p>";
            $productBlock .= "</div>";
            //$productsHtml .= $productBlock;
            $total_price_count = $total_price_count + ($detail['quantity']*$detail['price_per_unit']);
        }
        $password_generated = generatePassword();

        $stmt = $link->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $order["email"]);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $stmt_insert = $link->prepare("INSERT INTO users(nome, apelido, morada, email, password) VALUES (?, ?, ?, ?, ?)");
            $address = $order["address1"] . " - " . $order["establishment"];
            $stmt_insert->bind_param("sssss", $order["first_name"], $order["first_name"], $address, $order["email"], $password_generated);
            $stmt_insert->execute();
        }

        $productsHtml = "";
        $carrinho_num = 0;
        $total = 0; 
        foreach ($_SESSION["cart"] as $keys => $values)  { 
            $carrinho_num++;
            if ($values["item_quantity"] < 1) { $values["item_quantity"] = 1; }
            if ($values["item_quantity"] == "") { $values["item_quantity"] = 1; } 

            $nome_produto = $values['item_name'];
            $imagem_produto = "https://tapgotech.com/". $values['item_imagem'];
            $id_produto = $values['item_id'];
            $quantidade_produto = $values['item_quantity'];
            $price_produto = $values["item_price"];
            $descricao_produto = substr($values['item_description'],0,45).'...';


            $productsHtml .= "
           
                <tr>
                  <td class='esdev-adapt-off' align='left' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px'>
                   <table cellpadding='0' cellspacing='0' class='esdev-mso-table' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:560px'>
                     <tr>
                      <td class='esdev-mso-td' valign='top' style='padding:0;Margin:0'>
                       <table cellpadding='0' cellspacing='0' class='es-left' align='left' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left'>
                         <tr>
                          <td class='es-m-p0r' align='center' style='padding:0;Margin:0;width:70px'>
                           <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                             <tr>
                              <td align='center' style='padding:0;Margin:0;font-size:0px'><img class='adapt-img' src='$imagem_produto' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic' width='70'></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                      <td style='padding:0;Margin:0;width:20px'></td>
                      <td class='esdev-mso-td' valign='top' style='padding:0;Margin:0'>
                       <table cellpadding='0' cellspacing='0' class='es-left' align='left' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left'>
                         <tr>
                          <td align='center' style='padding:0;Margin:0;width:265px'>
                           <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                             <tr>
                              <td align='left' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;line-height:21px;color:#333333;font-size:14px'><strong>$nome_produto</strong></p></td>
                            </tr>
                            <tr>
                              <td align='left' style='padding:0;Margin:0;padding-top:5px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly; line-height:21px;color:#333333;font-size:14px'>$descricao_produto</p></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                      <td style='padding:0;Margin:0;width:20px'></td>
                      <td class='esdev-mso-td' valign='top' style='padding:0;Margin:0'>
                       <table cellpadding='0' cellspacing='0' class='es-left' align='left' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left'>
                         <tr>
                          <td align='left' style='padding:0;Margin:0;width:80px'>
                           <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                             <tr>
                              <td align='center' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly; line-height:21px;color:#333333;font-size:14px'>x$quantidade_produto</p></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                      <td style='padding:0;Margin:0;width:20px'></td>
                      <td class='esdev-mso-td' valign='top' style='padding:0;Margin:0'>
                       <table cellpadding='0' cellspacing='0' class='es-right' align='right' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right'>
                         <tr>
                          <td align='left' style='padding:0;Margin:0;width:85px'>
                           <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                             <tr>
                              <td align='right' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly; line-height:21px;color:#333333;font-size:14px'>$price_produto€</p></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                </tr>

            ";
            $total = $total + ($quantidade_produto * $price_produto);
        }
        $client_email = $order['email'];
        $account_details = "<br><h3 style='text-align: center;'>For accessing your establishment estatistics via our <a href='https://tapgotech.com/dashboard' target='_blank'>Dashboard</a> </h3><hr><b>Email:</b> $client_email <br> <b>Password:</b> $password_generated <hr>";


        $emailContent = file_get_contents('new_template_test.html');
        $emailContent = str_replace('PLACEHOLDER_NAME', $order['first_name'] . ' ' . $order['last_name'], $emailContent);
        $emailContent = str_replace('PLACEHOLDER_EMAIL', $order['email'], $emailContent);
        $emailContent = str_replace('PLACEHOLDER_ADDRESS', $order['address1'] . " - " . $order['establishment'], $emailContent);
        $emailContent = str_replace('PLACEHOLDER_PRODUCTS', $productsHtml, $emailContent);
        $emailContent = str_replace('PLACEHOLDER_ORDER_ID', '#' . $_SESSION['stripe_charge_id'], $emailContent);
        $emailContent = str_replace('PLACEHOLDER_TOTAL', $total_price_count, $emailContent);
        $emailContent = str_replace('PLACEHOLDER_ACCOUNT_DETAILS', $account_details, $emailContent);
        

        $emailContent = str_replace('PLACEHOLDER_DATE', $order['created_at'], $emailContent);
        $emailContent = str_replace('PLACEHOLDER_FULL_ADDRESS', $order['address1'] . " - " . $order['establishment'] . ", " . $order['country'] . ", " . $order['zip'], $emailContent);
        $emailContent = str_replace('MY ACCOUNT', 'Visit Website', $emailContent);

        // PHPMailer configurations
        $mail->isSMTP();
        $mail->Host = 'mail.tapgotech.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'noreply@tapgotech.com';
        $mail->Password = '(6!9Y9aE)Urg';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('noreply@tapgotech.com', 'Tap&Go');
        $mail->addAddress($order['email'], $order['first_name'] . ' ' . $order['last_name']);
        $mail->addReplyTo('noreply@tapgotech.com', 'No Reply');

        $mail->isHTML(true);
        $mail->Subject = 'Order Confirmation - Tap&Go';
        $mail->Body = $emailContent;
        $mail->CharSet = 'UTF-8';

        if(!$mail->send()) {
            die('Mailer Error: ' . $mail->ErrorInfo);
        }

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function handleStripePayment($postData) {
    global $link;

    try {
        if (!isset($postData['stripeToken'])) {
            throw new Exception("Stripe token is missing.");
        }

        $token = $postData['stripeToken'];
        $charge = \Stripe\Charge::create([
            'amount' => $postData['total'] * 100, // Convert to cents
            'currency' => 'eur',
            'description' => 'Order Payment',
            'source' => $token,
        ]);

        if ($charge->paid) {
            $orderId = saveOrderToDatabase($postData, $charge->id);
            saveOrderDetailsToDatabase($orderId);

            $orderDetailsQuery = $link->query("SELECT * FROM orders WHERE id = $orderId");
            $order = $orderDetailsQuery->fetch_assoc();

            $orderProductsQuery = $link->query("SELECT * FROM order_details WHERE order_id = $orderId");
            $details = [];
            while ($row = $orderProductsQuery->fetch_assoc()) {
                $details[] = $row;
            }

            $_SESSION['last_order_id'] = $orderId;
            $_SESSION['stripe_charge_id'] = $charge->id;

            sendOrderConfirmationEmail($order, $details);

            

            header("Location: success_page.php"); 
            exit; 
        } else {
            echo "Payment failed.";
        }
    } catch (\Stripe\Error\Card $e) {
        echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "General Error: " . $e->getMessage();
    }
}

function saveOrderToDatabase($data, $stripeChargeId) {
    global $link;

    $sql = "INSERT INTO orders (first_name, last_name, email, address1, establishment, country, zip, payment_method, total_price, stripe_charge_id)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $link->prepare($sql);
    $stmt->bind_param('ssssssssds', 
        $data['firstName'],
        $data['lastName'],
        $data['email'],
        $data['address'],
        $data['establishment'],
        $data['country'],
        $data['zip'],
        $data['paymentMethod'],
        $data['total'],
        $stripeChargeId
    );

    if (!$stmt->execute()) {
        die("Error saving the order: " . $stmt->error);
    }

    $orderId = $stmt->insert_id;
    $stmt->close();
    return $orderId; 
}

function saveOrderDetailsToDatabase($orderId) {
    global $link;

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
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    handleStripePayment($_POST);
}
?>