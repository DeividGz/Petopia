<?php
$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$cpf_cnpj = filter_input(INPUT_POST, "cpf_cnpj", FILTER_SANITIZE_SPECIAL_CHARS);

include_once '../../functions/database.php';
$bd = connection();
$sql = "INSERT INTO vendedores (id_vendedor, nm_vendedor, cpf_cnpj_vendedor) VALUES (NULL, '$nome', '$cpf_cnpj')";

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

  $bd = null;
  header("location:index.php?$params");
  die();
}

$bd = null;

header("location:index.php");
