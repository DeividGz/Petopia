<?php
$codigo = filter_input(INPUT_GET, 'codigo');
$cpf_cnpj = filter_input(INPUT_POST, 'cpf_cnpj', FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);

include_once '../../functions/database.php';
$bd = connection();

$sql = "UPDATE vendedores SET cpf_cnpj_vendedor = '$cpf_cnpj', nm_vendedor = '$nome' WHERE id_vendedor = '$codigo' ";


$bd->beginTransaction();
$linhas = $bd->exec($sql);
if ($linhas == 1) {
  $bd->commit();
} else {
  $bd->rollBack();
}

$bd = null;

header("location:index.php");
