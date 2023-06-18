<?php

include_once '../../functions/database.php';

$bd = connection();
$codigo = filter_input(INPUT_GET, 'codigo');

$ptcod = filter_input(INPUT_GET, 'ptcod');

if($ptcod == 1) {
    $sql = "DELETE FROM categorias WHERE id_categoria = '$codigo' ";
} else {
    $sql = "DELETE FROM unidades_medida WHERE id_unidade_medida = '$codigo' ";
}

try {
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
} catch (Exception $exc) {
    $parametros = "";
    $parametros .= dbError($exc);
    $parametros .= "&codigo=$codigo";

    header("location:index.php?$parametros");
    die();
}