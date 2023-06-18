<?php

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$cpf_cnpj = filter_input(INPUT_POST, 'cpf_cnpj', FILTER_SANITIZE_SPECIAL_CHARS);
$cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS);
$uf = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_SPECIAL_CHARS);
$cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS);
$bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS);
$rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_SPECIAL_CHARS);
$numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, 'senha');

include_once '../functions/database.php';

$bd = connection();
$sql = "
INSERT INTO clientes (id_cliente, cpf_cnpj_cliente, email, senha, nm_cliente, cep_cliente, cidade_cliente, estado_cliente, bairro_cliente, logradouro_cliente, nr_cliente) VALUES (NULL, '$cpf_cnpj', '$email', '$senha', '$nome', '$cep', '$cidade', '$uf', '$bairro', '$rua', '$numero');
";
try {
  $bd->beginTransaction();
  $linhas = $bd->exec($sql);
  if ($linhas == 1) {
    $bd->commit();
  } else {
    $bd->rollBack();
  }
} catch (Exception $ex) {
  $params = "";
  $params = "erro=Usuário já cadastrado!";

  $params .= "&cpf_cnpj=$cpf_cnpj";
  $params .= "&nome=$nome";
  $params .= "&email=$email";
  $params .= "&cep=$cep";
  $params .= "&cidade=$cidade";
  $params .= "&uf=$uf";
  $params .= "&bairro=$bairro";
  $params .= "&rua=$rua";
  $params .= "&numero=$numero";

  $bd = null;
  header("location:../cadastro.php?$params");
  die();
}


$bd = null;

header("location:../index.php");
