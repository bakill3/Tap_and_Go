<?php
include 'ligar_db.php';

$response = ['status' => 'error', 'message' => 'Unknown error.'];

// Check if the id_produto POST parameter is set
if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['telemovel']) && isset($_POST['mensagem']) && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['telemovel']) && !empty($_POST['mensagem'])) {
    $nome = htmlspecialchars(mysqli_real_escape_string($link, $_POST['nome']));
    $email = htmlspecialchars(mysqli_real_escape_string($link, $_POST['email']));
    $telemovel = htmlspecialchars(mysqli_real_escape_string($link, $_POST['telemovel']));
    $mensagem = htmlspecialchars(mysqli_real_escape_string($link, $_POST['mensagem']));

    mysqli_query($link, "INSERT INTO mensagens(nome, email, telemovel, mensagem) VALUES('$nome', '$email', '$telemovel', '$mensagem')");



    $response = ['status' => 'success'];
} else {
    $response = ['status' => 'error'];
}
header('Content-Type: application/json');
echo json_encode($response);