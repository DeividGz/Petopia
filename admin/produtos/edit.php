<?php
$codigo = filter_input(INPUT_GET, 'codigo');
$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_SPECIAL_CHARS);
$qt_estoque = filter_input(INPUT_POST, "qt_estoque", FILTER_SANITIZE_SPECIAL_CHARS);
$valor = filter_input(INPUT_POST, "valor", FILTER_SANITIZE_SPECIAL_CHARS);
$dimensoes = filter_input(INPUT_POST, "dimensoes", FILTER_SANITIZE_SPECIAL_CHARS);
$medida = filter_input(INPUT_POST, "medida", FILTER_SANITIZE_SPECIAL_CHARS);
$peso = filter_input(INPUT_POST, "peso", FILTER_SANITIZE_SPECIAL_CHARS);
$descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);
$arquivo1 = $_FILES['img1'];
$arquivo2 = $_FILES['img2'];
$arquivo3 = $_FILES['img3'];
$arquivo4 = $_FILES['img4'];
$arquivo5 = $_FILES['img5'];

include_once '../../functions/database.php';
include_once '../../functions/loadFiles.php';

$bd = connection();

$sql = "UPDATE produtos SET
            nm_produto = '$nome',
            ds_produto = '$descricao',
            vl_produto = '$valor',
            qt_estoque = '$qt_estoque',
            dimensoes_produto = '$dimensoes',
            peso_produto = '$peso',
            id_unidade_medida = '$medida',
            id_categoria = '$categoria'
        WHERE id_produto = '$codigo' ";

try {
  $bd->beginTransaction();
  $linhas = $bd->exec($sql);
  if ($linhas == 1) {
    $bd->commit();
  } else {
    $bd->rollBack();
  }

  header("location:cadastrados.php");
} catch (Exception $exc) {
  $parametros = "";
  $parametros .= dbError($exc);
  $parametros .= "&codigo=$codigo";
  $parametros .= "&nome=$nome";
  $parametros .= "&categoria=$categoria";
  $parametros .= "&qt_estoque=$qt_estoque";
  $parametros .= "&valor=$valor";
  $parametros .= "&dimensoes=$dimensoes";
  $parametros .= "&medida=$medida";
  $parametros .= "&peso=$peso";
  $parametros .= "&descricao=$descricao";

  header("location:cadastrados.php?$parametros");
  die();
}

$sql = "DELETE FROM imagens WHERE id_produto = '$codigo'";
$bd->beginTransaction();
$linhas = $bd->exec($sql);
$bd->commit();

$cod = uniqid();

if (loadFile($arquivo1)) {
  moveFile($arquivo1, "../../img/produtos/" . $nome . $cod . "-1.png");
  $name = $nome . $cod . "-1.png";
  $sql = "INSERT INTO imagens (nm_imagem, id_produto) VALUES ('$name', '$codigo')";
  $bd->beginTransaction();
  $linhas = $bd->exec($sql);
  if ($linhas == 1) {
    $bd->commit();
  } else {
    $bd->rollBack();
  }
}
if (loadFile($arquivo2)) {
  moveFile($arquivo2, "../../img/produtos/" . $nome . $cod . "-2.png");
  $name = $nome . $cod . "-2.png";
  $sql = "INSERT INTO imagens (nm_imagem, id_produto) VALUES ('$name', '$codigo')";
  $bd->beginTransaction();
  $linhas = $bd->exec($sql);
  if ($linhas == 1) {
    $bd->commit();
  } else {
    $bd->rollBack();
  }
}
if (loadFile($arquivo3)) {
  moveFile($arquivo3, "../../img/produtos/" . $nome . $cod . "-3.png");
  $name = $nome . $cod . "-3.png";
  $sql = "INSERT INTO imagens (nm_imagem, id_produto) VALUES ('$name', '$codigo')";
  $bd->beginTransaction();
  $linhas = $bd->exec($sql);
  if ($linhas == 1) {
    $bd->commit();
  } else {
    $bd->rollBack();
  }
}
if (loadFile($arquivo4)) {
  moveFile($arquivo4, "../../img/produtos/" . $nome . $cod . "-4.png");
  $name = $nome . $cod . "-4.png";
  $sql = "INSERT INTO imagens (nm_imagem, id_produto) VALUES ('$name', '$codigo')";
  $bd->beginTransaction();
  $linhas = $bd->exec($sql);
  if ($linhas == 1) {
    $bd->commit();
  } else {
    $bd->rollBack();
  }
}
if (loadFile($arquivo5)) {
  moveFile($arquivo5, "../../img/produtos/" . $nome . $cod . "-5.png");
  $name = $nome . $cod . "-5.png";
  $sql = "INSERT INTO imagens (nm_imagem, id_produto) VALUES ('$name', '$codigo')";
  $bd->beginTransaction();
  $linhas = $bd->exec($sql);
  if ($linhas == 1) {
    $bd->commit();
  } else {
    $bd->rollBack();
  }
}

$bd = null;
