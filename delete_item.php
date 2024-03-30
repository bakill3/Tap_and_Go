<?php
include 'ligar_db.php';

// Ensure session is started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$response = ['status' => 'error', 'message' => 'Unknown error'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['key']) && isset($_POST['item_id'])) {
    $key = $_POST['key'];
    $itemId = $_POST['item_id'];

    if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$key])) {
        // Check if the item_id matches
        if ((int)$_SESSION['cart'][$key]['item_id'] == (int)$itemId) {
            // If the quantity of the item is greater than 1, decrement the quantity by 1
            if ($_SESSION['cart'][$key]['item_quantity'] > 1) {
                $_SESSION['cart'][$key]['item_quantity']--;
                $response['status'] = 'decremented';
            } else {
                // If the quantity is 1 or less, unset the item from the cart
                unset($_SESSION['cart'][$key]);
                $response['status'] = 'removed';
            }
        } else {
            $response['message'] = 'Item ID mismatch in cart';
        }
    } else {
        $response['message'] = 'Cart or key not set in session';
    }
}

echo json_encode($response);
?>
