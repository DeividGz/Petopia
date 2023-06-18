<?php
include_once '../../functions/database.php';
$bd = connection();
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);

$ptcod = filter_input(INPUT_GET, 'ptcod');

if($ptcod == 1) {
    $sql = "INSERT INTO categorias (ds_categoria) VALUES ('$descricao')";
} else {
    $sigla = filter_input(INPUT_POST, 'sigla', FILTER_SANITIZE_SPECIAL_CHARS);

    $sql = "INSERT INTO unidades_medida (sg_unidade_medida, ds_unidade_medida) VALUES ('$sigla', '$descricao')";
}

try{
    $bd->beginTransaction();
    $linhas = $bd->exec($sql);
    if ($linhas == 1){
        $bd->commit();
    }
    else {
        $bd->rollBack();
    }
} catch (Exception $ex) {
    $params = "";
    $params = dbError($ex);

    $params .= "&descricao=$descricao";

    if($ptcod == 2) {
        $params .= "&sigla=$sigla";
    }
    
    $bd = null;
    
    header("location:index.php?$params");
    die();
}

$bd = null;

header("location:index.php");