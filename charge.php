<?php
session_start();

require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('API_KEY_HERE');

$token = $_POST['stripeToken'];
$total = $_SESSION["total"] * 100; 

try {
    $intent = \Stripe\PaymentIntent::create([
        'amount' => $total,
        'currency' => 'eur',
        'description' => 'Shopping Cart Checkout',
        'confirm' => true,
        'payment_method' => $token,
    ]);
    
    $_SESSION["cart"] = array();
    
    header('Location: success.php?tid=' . $intent->id . '&product=' . $intent->description);
} catch (\Stripe\Exception\ApiErrorException $e) {
    $error = $e->getMessage();
    header('Location: error.php?error=' . $error);
}
?>