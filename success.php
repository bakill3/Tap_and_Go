<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
include 'header.php';

if (!isset($_SESSION['payment_data'])) {
    echo "<script>window.location.href='index.php';</script>";
    exit;
}

function generatePassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[random_int(0, strlen($chars) - 1)];
    }
    return $password;
}

$mail = new PHPMailer\PHPMailer\PHPMailer();

try {
    $order_id = $_SESSION['payment_data'][0];
    $stripe_charge_id = $_SESSION['payment_data'][1];

    // Fetch order details using prepared statements
    $stmt = $link->prepare("SELECT * FROM order_details WHERE order_id = ?");
    $stmt->bind_param('s', $order_id);
    $stmt->execute();
    $orderProductsQuery = $stmt->get_result();

    if (!$orderProductsQuery) {
        die("Error executing query: " . $link->error);
    }

    $details = [];
    while ($row = $orderProductsQuery->fetch_assoc()) {
        $details[] = $row;
    }

    // Fetch order information using prepared statements
    $stmt = $link->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->bind_param('s', $order_id);
    $stmt->execute();
    $orderResult = $stmt->get_result();
    $order = $orderResult->fetch_assoc();

    if (!$order) {
        die("Order not found: " . $link->error);
    }

    $total_price_count = 0;
    foreach ($details as $detail) {
        $productBlock = "<div style='margin-bottom: 10px;'>";
        //$productBlock .= "<img src='" . $detail['item_imagem'] . "' width='50px' height='50px'>";
        $productBlock .= "<p>" . $detail['product_name'] . "</p>";
        $productBlock .= "<p>" . $detail['quantity'] . " x " . $detail['price_per_unit'] . "€</p>";
        $productBlock .= "</div>";
        $total_price_count += ($detail['quantity'] * $detail['price_per_unit']);
    }

    $password_generated = generatePassword();

    $stmt = $link->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $order["email"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $stmt_insert = $link->prepare("INSERT INTO users(nome, apelido, morada, email, password) VALUES (?, ?, ?, ?, ?)");
        $address = $order["address1"] . " - " . $order["establishment"];
        $stmt_insert->bind_param("sssss", $order["first_name"], $order["last_name"], $address, $order["email"], $password_generated);
        $stmt_insert->execute();
    }

    $productsHtml = "";
    $carrinho_num = 0;
    $total = 0; 
    foreach ($_SESSION["cart"] as $keys => $values) {
	    $carrinho_num++;
	    
	    if (!isset($values["item_quantity"]) || $values["item_quantity"] < 1) {
	        $values["item_quantity"] = 1;
	    }

	    $nome_produto = $values['item_name'];
		$imagem_produto = "https://tapgotech.com/". $values['item_imagem'];	    
		$id_produto = $values['item_id'];
	    $quantidade_produto = $values['item_quantity'];
	    $price_produto = $values["item_price"];
	    $descricao_produto = substr($values['item_description'], 0, 45) . '...';


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
		<td align='right' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly; line-height:21px;color:#333333;font-size:14px'>$price_produto €</p></td>
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
    $account_details = "<br><h3 style='text-align: center;'>For accessing your establishment statistics via our <a href='https://tapgotech.com/dashboard' target='_blank'>Dashboard</a> </h3><hr><b>Email:</b> $client_email <br> <b>Password:</b> $password_generated <hr>";

    $emailContent = file_get_contents('new_template_test.html');
	$emailContent = str_replace('PLACEHOLDER_NAME', $order['first_name'] . ' ' . $order['last_name'], $emailContent);
	$emailContent = str_replace('PLACEHOLDER_EMAIL', $order['email'], $emailContent);
	$emailContent = str_replace('PLACEHOLDER_ADDRESS', $order['address1'] . " - " . $order['establishment'], $emailContent);
	$emailContent = str_replace('PLACEHOLDER_PRODUCTS', $productsHtml, $emailContent);
	$emailContent = str_replace('PLACEHOLDER_ORDER_ID', '#' . $stripe_charge_id, $emailContent);
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

$stmt = $link->prepare("UPDATE orders SET order_status='completed' WHERE stripe_charge_id=?");
$stmt->bind_param('s', $stripe_charge_id);
if (!$stmt->execute()) {
    die("Error updating order: " . $stmt->error);
}
?>

<div class="container mt-5" style="padding: 10%;">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header text-center">
					<h2>Order Successful</h2>
				</div>
				<div class="card-body text-center">
					<h4>Thank you for your purchase!</h4>
					<p>Your order details have been successfully saved. You can download a PDF containing all the details of your purchase by clicking the button below.</p>
					<a href="generate_pdf.php" class="btn btn-primary">Download Order PDF</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	Swal.fire({
		icon: 'success',
		title: 'Order Successful!',
		text: 'Thank you for your purchase. You can now download your order details.'
	});
</script>

<?php
include 'footer.php';
?>
