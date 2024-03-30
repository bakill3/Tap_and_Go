<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'ligar_db.php';

    $id = $_POST['id'];

    $stmt = $link->prepare("DELETE FROM locals WHERE id_local = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    
    $stmt->close();
    $link->close();
} else {
    echo "invalid_request";
}
?>
