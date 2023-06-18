<?php
$cart = $_COOKIE['cart'];
$itens = json_decode($cart);

if (isset($_COOKIE["login"])) {
  $data = unserialize($_COOKIE["login"]);
}

$frete = filter_input(INPUT_POST, 'frete', FILTER_SANITIZE_SPECIAL_CHARS);
$comissao = filter_input(INPUT_POST, 'comissao', FILTER_SANITIZE_SPECIAL_CHARS);
$vendedor = filter_input(INPUT_POST, 'vendedor', FILTER_SANITIZE_SPECIAL_CHARS);
$transportadora = filter_input(INPUT_POST, 'transportadora', FILTER_SANITIZE_SPECIAL_CHARS);
$cliente = $data[0];

include_once './functions/database.php';

$bd = connection();

$sql_cliente = "SELECT cpf_cnpj_cliente as cliente FROM clientes WHERE email = '$cliente'";
$r_cliente = $bd->query($sql_cliente);
$registro_cliente = $r_cliente->fetch(PDO::FETCH_ASSOC);
$c = $registro_cliente["cliente"];

$sql_vendedor = "SELECT cpf_cnpj_vendedor as vendedor FROM vendedores WHERE id_vendedor = '$vendedor'";
$r_vendedor = $bd->query($sql_vendedor);
$registro_vendedor = $r_vendedor->fetch(PDO::FETCH_ASSOC);
$v = $registro_vendedor["vendedor"];

$sql_transportadora = "SELECT cpf_cnpj_transportadora as transportadora FROM transportadoras WHERE id_transportadora = '$transportadora'";
$r_transportadora = $bd->query($sql_transportadora);
$registro_transportadora = $r_transportadora->fetch(PDO::FETCH_ASSOC);
$t = $registro_transportadora["transportadora"];

$sql = "INSERT INTO compras (vl_comissao, vl_transporte, cpf_cnpj_cliente, cpf_cnpj_vendedor, cpf_cnpj_transportadora) 
VALUES ('$comissao', '$frete', '$c', '$v', '$t')";

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

  $bd = null;
  header("location:checkout.php?$params");
  die();
}


$sql_compra = "SELECT id_compra FROM compras ORDER BY id_compra DESC LIMIT 1";
$compra = $bd->query($sql_compra);
$registro_compra = $compra->fetch(PDO::FETCH_ASSOC);
$id_compra = $registro_compra["id_compra"];

foreach ($itens as $item) {

  $id = $item->id;
  $name = $item->name;
  $value = $item->value;
  $quantity = $item->quantity;
  $stored = $item->stored;

  $sql = "INSERT INTO itens_compra (vl_item_compra, qt_item_compra, id_compra, id_produto)
  VALUES ('$value', '$quantity', '$id_compra', '$id');
  UPDATE produtos SET qt_estoque = qt_estoque - $quantity
  WHERE id_produto = '$id'";
  $bd->beginTransaction();
  $linhas = $bd->exec($sql);
  if ($linhas == 1) {
    $bd->commit();
  } else {
    $bd->rollBack();
  }
}

$bd = null;

header("location:concluida.php");
