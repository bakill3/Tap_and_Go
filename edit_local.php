<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'ligar_db.php'; // Adjust to your DB connection details

    if (!isset($_POST['id']) || empty($_POST['id'])) {
        echo json_encode(['status' => 'error', 'message' => 'No ID provided']);
        exit;
    }

    $id = $_POST['id'];
    $nome_local = $_POST['nome_local'];

// If an image is uploaded
    if (isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_name = basename($_FILES['file']['name']);

        $dir = __DIR__ . "/assets/img/uploaded_locals/";
        
        if (!is_dir($dir)) {
            echo json_encode(['status' => 'error', 'message' => 'Directory does not exist']);
            exit;
        }

        $target_file = $dir . $file_name;
        
        if (!move_uploaded_file($file_tmp, $target_file)) {
            echo json_encode(['status' => 'error', 'message' => 'Error uploading file']);
            exit;
        }

        $image_final = "/assets/img/uploaded_locals/" . $file_name;

    // Update the database with the new image URL
    // This assumes you have a connection named $link and the table structure
        $updateSQL = "UPDATE locals SET logo_url = '$image_final' WHERE id_local = $id";
        mysqli_query($link, $updateSQL);
    }

// Update the local name if provided
    if (!empty($nome_local)) {
        $updateSQL = "UPDATE locals SET nome_local = '$nome_local' WHERE id_local = $id";
        mysqli_query($link, $updateSQL);
    }

    echo json_encode(['status' => 'success', 'image_url' => $image_final ?? '']);

}
?>