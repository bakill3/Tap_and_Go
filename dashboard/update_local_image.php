<?php
include '../ligar_db.php';

// Define a location to move the uploaded files
$target_dir = __DIR__ . "/../assets/img/uploaded_locals/";

// Ensure the directory exists
if (!file_exists($target_dir)) {
	mkdir($target_dir, 0777, true);
}

$response = array('success' => false, 'message' => 'File not uploaded.');

// Check if a file is uploaded
if (isset($_FILES["uploaded_file"]) && $_FILES['uploaded_file']['size'] > 0) {
	$id_local = htmlspecialchars(mysqli_real_escape_string($link, $_POST['id_local']));
	$target_file = $target_dir . basename($_FILES["uploaded_file"]["name"]);

    // Check file size (e.g., limit to 2MB)
	if ($_FILES["uploaded_file"]["size"] > 5000000) {
		$response['message'] = "File is too large.";
	} else {
        // Move the uploaded file to the target directory
		if (move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $target_file)) {
			$response['success'] = true;
			$response['message'] = "File uploaded successfully.";
			$image_final = "/assets/img/uploaded_locals/" . basename($_FILES["uploaded_file"]["name"]);
			$updateSQL = "UPDATE locals SET logo_url = '$image_final' WHERE id_local = $id_local";
			mysqli_query($link, $updateSQL);
		} else {
			$response['message'] = "Error uploading file.";
		}
	}
}




header('Content-Type: application/json');
echo json_encode($response);
?>