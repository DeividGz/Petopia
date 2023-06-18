<?php

$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, "senha", FILTER_DEFAULT);
$manter = filter_input(INPUT_POST, "manter", FILTER_VALIDATE_BOOL);

include_once '../functions/database.php';

$bd = connection();
$sql = "SELECT id_cliente FROM clientes WHERE email = '$email' AND senha = '$senha'";
$comando = $bd->query($sql);
$result = $comando->fetch(PDO::FETCH_ASSOC);

if (!$result) {
  $erro = "?email=" . $email . "&erro=E-mail ou senha incorreto(s)";
  header("location:../login.php" . $erro);
  exit();
}

if ($manter) {
  $duracao = time() + (60 * 60 * 24 * 30); // 30 dias
} else {
  $duracao = time() + (60 * 60); // 1 hora
}

$data[0] = $email;
$data[1] = $senha;

setcookie("login", serialize($data), $duracao, '/');

header("location:../index.php");
exit();
