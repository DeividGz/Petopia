<?php
$codigo = filter_input(INPUT_GET, 'codigo');
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);

include_once '../../functions/database.php';
$bd = connection();

$ptcod = filter_input(INPUT_GET, 'ptcod');

if($ptcod == 1) {
    $sql = "UPDATE categorias SET ds_categoria = '$descricao' WHERE id_categoria = '$codigo' ";
} else {
    $sigla = filter_input(INPUT_POST, 'sigla', FILTER_SANITIZE_SPECIAL_CHARS);
    $sql = "UPDATE unidades_medida SET sg_unidade_medida = '$sigla', ds_unidade_medida = '$descricao' WHERE id_unidade_medida = '$codigo' ";
}

$bd->beginTransaction();
$linhas = $bd->exec($sql);
if ($linhas == 1){
    $bd->commit();
}
else {
    $bd->rollBack();
}

$bd = null;

header("location:index.php");