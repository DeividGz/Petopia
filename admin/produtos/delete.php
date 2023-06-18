<?php

include_once '../../functions/database.php';

$bd = connection();
$codigo = filter_input(INPUT_GET, 'codigo');

$sql = "UPDATE produtos SET status_produto = 'Inativo' WHERE id_produto = '$codigo' ";

try {
  $bd->beginTransaction();
  $linhas = $bd->exec($sql);
  if ($linhas == 1) {
    $bd->commit();
  } else {
    $bd->rollBack();
  }

  $bd = null;
  header("location:cadastrados.php");
} catch (Exception $exc) {
  $parametros = "";
  $parametros .= dbError($exc);
  $parametros .= "&codigo=$codigo";

  header("location:cadastrados.php?$parametros");
  die();
}
