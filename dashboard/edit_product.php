<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../ligar_db.php';

if(isset($_POST['update_product'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['nome'];
    $productDesc = $_POST['descricao'];
    $pricePack5 = $_POST['price_pack_5'];
    $pricePack10 = $_POST['price_pack_10'];
    $pricePack20 = $_POST['price_pack_20'];
    $stock = $_POST['stock'];
    $type = $_POST['type'];

    // Retrieve the current image paths from the database
    $current_images = mysqli_fetch_assoc(mysqli_query($link, "SELECT imagem_5_pack, imagem_10_pack, imagem_20_pack FROM products WHERE id = $productId"));

    $imageFields = ['imagem_5_pack', 'imagem_10_pack', 'imagem_20_pack'];
    foreach ($imageFields as $field) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] == 0) {
            $target_dir = "../assets/img/hero/";
            $target_file = $target_dir . basename($_FILES[$field]["name"]);
            move_uploaded_file($_FILES[$field]["tmp_name"], $target_file);
            
            // Change path for database
            $db_path = "assets/img/hero/" . basename($_FILES[$field]["name"]);
            $$field = $db_path;  // Dynamically set the variable for database
            
        } else {
            $$field = $current_images[$field];  // Use existing image path if no new image is uploaded
        }
    }


    // Update database
    $stmt = $link->prepare("UPDATE products SET 
        nome = ?, descricao = ?, price_pack_5 = ?, price_pack_10 = ?, 
        price_pack_20 = ?, stock = ?, imagem_5_pack = ?, imagem_10_pack = ?, 
        imagem_20_pack = ?, type = ? WHERE id = ?");

    $stmt->bind_param('ssssssssssi', $productName, $productDesc, $pricePack5, $pricePack10, 
      $pricePack20, $stock, $imagem_5_pack, $imagem_10_pack, 
      $imagem_20_pack, $type, $productId);

    $success = $stmt->execute();

    echo json_encode(['success' => $success]);
    exit;
}

?>
