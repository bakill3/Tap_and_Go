<?php
session_start();

$link = mysqli_connect("localhost", "username", "password", "database_name");
if ($link == FALSE) {
    die("Nao foi possivel estabelecer uma conexao" . mysqli_error());
    exit;
}
mysqli_set_charset($link, "UTF8");
$escolheBD = mysqli_select_db($link, "tapgotec_tapandgo");
if ($escolheBD == FALSE) {
    echo ("Não foi possível ligar à base de dados");
    mysqli_error();
    exit;
}
?>