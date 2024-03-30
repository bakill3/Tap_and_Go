<?php
// Include your database connection script
header('Content-Type: application/json');
include 'ligar_db.php';

// Check if the id and qnt parameters are set
if (isset($_GET['id']) && isset($_GET['qnt'])) {
    $productId = intval($_GET['id']);
    $quantity = intval($_GET['qnt']);

    // Prepare a SQL statement to prevent SQL injection
    $stmt = $link->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a product is found
    if ($row = $result->fetch_assoc()) {
        // You might need to adjust your logic here based on how the quantity changes the response
        // For simplicity, I'm using a switch case
        switch ($quantity) {
            case 1:
                $price = $row['price_pack_1'];
                $imageUrl = $row['imagem_1_pack'];
                break;
            case 5:
                $price = $row['price_pack_5'];
                $imageUrl = $row['imagem_5_pack'];
                break;
            case 10:
                $price = $row['price_pack_10'];
                $imageUrl = $row['imagem_10_pack'];
                break;
            case 20:
                $price = $row['price_pack_20'];
                $imageUrl = $row['imagem_20_pack'];
                break;
            default:
                $price = $row['price_pack_5']; // Default case
                $imageUrl = $row['imagem_5_pack'];
        }

        // Prepare the product data
        $productData = array(
            'title' => $row['nome'],
            'price' => $price,
            'extra_price' => '59.95', // Adjust as necessary
            'imageUrl' => $imageUrl,
            // Add more fields as needed
        );

        // Send product data as JSON
        echo json_encode($productData);
    } else {
        // No product found
        echo json_encode(array('error' => 'No product found'));
    }

    // Close statement
    $stmt->close();
} else {
    // Required parameters not provided
    echo json_encode(array('error' => 'Product ID or quantity not provided'));
}

// Close connection
$link->close();
?>
