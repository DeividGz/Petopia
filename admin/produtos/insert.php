<?php
$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);
$valor = filter_input(INPUT_POST, "valor", FILTER_SANITIZE_SPECIAL_CHARS);
$quantidade = filter_input(INPUT_POST, "quantidade", FILTER_SANITIZE_SPECIAL_CHARS);
$dimensoes = filter_input(INPUT_POST, "dimensoes", FILTER_SANITIZE_SPECIAL_CHARS);
$peso = filter_input(INPUT_POST, "peso", FILTER_SANITIZE_SPECIAL_CHARS);
$medida = filter_input(INPUT_POST, "medida", FILTER_SANITIZE_NUMBER_INT);
$categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_NUMBER_INT);
$arquivo1 = $_FILES["img1"];
$arquivo2 = $_FILES["img2"];
$arquivo3 = $_FILES["img3"];
$arquivo4 = $_FILES["img4"];
$arquivo5 = $_FILES["img5"];

include_once '../../functions/database.php';
include_once '../../functions/loadFiles.php';
$bd = connection();
$sql = "INSERT INTO produtos 
        (id_produto, nm_produto, ds_produto, vl_produto, qt_estoque, dimensoes_produto, peso_produto, id_unidade_medida, id_categoria)
        VALUES (NULL, '$nome', '$descricao', '$valor', '$quantidade', '$dimensoes', '$peso', '$medida', '$categoria')";
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
  $params .= "&descricao=$descricao";
  $params .= "&valor=$valor";
  $params .= "&quantidade=$quantidade";
  $params .= "&dimensoes=$dimensoes";
  $params .= "&peso=$peso";
  $params .= "&medida=$medida";
  $params .= "&categoria=$categoria";

  $bd = null;
  header("location:index.php?$params");
  die();
}

$sql = "SELECT MAX(id_produto) as id FROM produtos";
$resultado = $bd->query($sql);
$registro = $resultado->fetch(PDO::FETCH_ASSOC);
$id = $registro["id"];
$cod = uniqid();
// echo $cod;

if (loadFile($arquivo1)) {
  moveFile($arquivo1, "../../img/produtos/" . $nome . $cod . "-1.png");
  $name = $nome . $cod . "-1.png";
  $sql = "INSERT INTO imagens (id_imagem, nm_imagem, id_produto) VALUES (NULL, '$name', '$id')";
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
  $sql = "INSERT INTO imagens (id_imagem, nm_imagem, id_produto) 
          VALUES (NULL, '$name', '$id')";
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
  $sql = "INSERT INTO imagens (id_imagem, nm_imagem, id_produto) 
          VALUES (NULL, '$name', '$id')";
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
  $sql = "INSERT INTO imagens (id_imagem, nm_imagem, id_produto) 
          VALUES (NULL, '$name', '$id')";
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
  $sql = "INSERT INTO imagens (id_imagem, nm_imagem, id_produto) 
          VALUES (NULL, '$name', '$id')";
  $bd->beginTransaction();
  $linhas = $bd->exec($sql);
  if ($linhas == 1) {
    $bd->commit();
  } else {
    $bd->rollBack();
  }
}


$bd = null;

header("location:../");
