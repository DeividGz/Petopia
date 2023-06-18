<?php

include_once '../../functions/database.php';

$bd = connection();
$codigo = filter_input(INPUT_GET, 'codigo');

$sql = "DELETE FROM vendedores WHERE id_vendedor = '$codigo' ";

try {
  $bd->beginTransaction();
  $linhas = $bd->exec($sql);
  if ($linhas == 1) {
    $bd->commit();
  } else {
    $bd->rollBack();
  }

  $bd = null;
  header("location:index.php");
} catch (Exception $exc) {
  $parametros = "";
  $parametros .= dbError($exc);
  $parametros .= "&codigo=$codigo";

  header("location:index.php?$parametros");
  die();
}
