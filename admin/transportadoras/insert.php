<?php
$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$cpf_cnpj = filter_input(INPUT_POST, "cpf_cnpj", FILTER_SANITIZE_SPECIAL_CHARS);
$cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_SPECIAL_CHARS);
$estado = filter_input(INPUT_POST, "estado", FILTER_SANITIZE_SPECIAL_CHARS);
$cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS);
$bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS);
$rua = filter_input(INPUT_POST, "rua", FILTER_SANITIZE_SPECIAL_CHARS);
$numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_SPECIAL_CHARS);


include_once '../../functions/database.php';
$bd = connection();
$sql = "INSERT INTO transportadoras (id_transportadora, nm_transportadora, cpf_cnpj_transportadora, cep_transportadora, cidade_transportadora, estado_transportadora, bairro_transportadora, logradouro_transportadora, nr_transportadora) VALUES (NULL, '$nome', '$cpf_cnpj', '$cep', '$cidade', '$estado', '$bairro', '$rua','$numero')";

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
  $params = dbError($ex);

  $params .= "&nome=$nome";
  $params .= "&cpf_cnpj=$cpf_cnpj";
  $params .= "&cep=$cep";
  $params .= "&estado=$estado";
  $params .= "&cidade=$cidade";
  $params .= "&bairro=$bairro";
  $params .= "&rua=$rua";
  $params .= "&numero=$numero";

  $bd = null;
  header("location:index.php?$params");
  die();
}

$bd = null;

header("location:index.php");
