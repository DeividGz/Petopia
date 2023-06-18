<!DOCTYPE html>
<?php
if (isset($_COOKIE["login"])) {
  $data = unserialize($_COOKIE["login"]);
} else {
  header("location:./welcome.php");
}
$email = $data[0];

include_once './functions/views.php';
include_once './functions/database.php';

$banco = connection();
$sql = "SELECT i.id_compra, p.nm_produto produto, i.vl_item_compra valor, i.qt_item_compra quantidade, v.nm_vendedor vendedor, t.nm_transportadora transportadora, (i.vl_item_compra * i.qt_item_compra) as total
FROM itens_compra i
INNER JOIN compras c
ON c.id_compra = i.id_compra
INNER JOIN vendedores v
ON v.cpf_cnpj_vendedor = c.cpf_cnpj_vendedor
INNER JOIN transportadoras t 
ON t.cpf_cnpj_transportadora = c.cpf_cnpj_transportadora
INNER JOIN clientes cli 
ON cli.cpf_cnpj_cliente = c.cpf_cnpj_cliente
INNER JOIN produtos p 
ON p.id_produto = i.id_produto
WHERE cli.email = '$email'";
$resultado = $banco->query($sql);

?>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Minhas compras | Petopia</title>
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&family=Righteous&display=swap" rel="stylesheet" />
  <link rel="shortcut icon" href="./img/icon.png" type="image/x-icon" />
  <!-- CSS -->
  <link rel="stylesheet" href="./css/styles.css" />
  <link rel="stylesheet" href="./css/menu.css" />
  <link rel="stylesheet" href="./css/historico.css" />
  <!-- JS -->
  <script defer src="./js/menu.js"></script>
</head>

<body>
  <?php include_once 'header.php'; ?>
  <main class="container">
    <h1>Minhas compras</h1>
    <table>
      <tr>
        <th>Id da compra</th>
        <th>Produto</th>
        <th>Valor Un.</th>
        <th>Quantidade</th>
        <th>Vendedor</th>
        <th>Transportadora</th>
        <th>Total</th>
      </tr>
      <?php
      while ($r = $resultado->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <tr>
        <td><?=$r['id_compra']?></td>
        <td><?=$r['produto']?></td>
        <td>R$<?=$r['valor']?></td>
        <td><?=round($r['quantidade'])?></td>
        <td><?=$r['vendedor']?></td>
        <td><?=$r['transportadora']?></td>
        <td>R$<?=round($r['total'], 2)?></td>
      </tr>
      <?php
      }
      $resultado = null;
      $banco = null;
      ?>
    </table>
  </main>
  <?php include_once 'footer.php'; ?>
</body>

</html>