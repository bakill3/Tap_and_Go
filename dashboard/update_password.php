<?php
include '../ligar_db.php';
session_start();

$response = ['status' => 'error'];

if (isset($_POST['new_password']) && isset($_POST['new_password_repeat'])) {
    $id = $_SESSION['login_dashboard'][0];
    $new_password = htmlspecialchars(mysqli_real_escape_string($link, $_POST['new_password']));
    $new_password_repeat = htmlspecialchars(mysqli_real_escape_string($link, $_POST['new_password_repeat']));

    if (!empty($new_password) && !empty($new_password_repeat)) {
        if ($new_password == $new_password_repeat) {
            //$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $result = mysqli_query($link, "UPDATE users SET password='$new_password' WHERE id='$id'");
            if ($result) {
                $response['status'] = 'success';
            }
        }
    }
}
header('Content-Type: application/json');
echo json_encode($response);

?>