<!DOCTYPE html>
<?php
if (isset($_COOKIE["login"])) {
  $data = unserialize($_COOKIE["login"]);
} else {
  header("location:./welcome.php");
}

include_once './functions/views.php';
include_once './functions/database.php';

$banco = connection();
$sql_transportadora = "SELECT * FROM transportadoras ORDER BY nm_transportadora";
$r_transportadora = $banco->query($sql_transportadora);

$sql_vendedor = "SELECT * FROM vendedores ORDER BY nm_vendedor";
$r_vendedor = $banco->query($sql_vendedor);
?>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Finalizar compra | Petopia</title>
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&family=Righteous&display=swap" rel="stylesheet" />
  <link rel="shortcut icon" href="./img/icon.png" type="image/x-icon" />
  <!-- CSS -->
  <link rel="stylesheet" href="./css/iziToast.min.css" />
  <link rel="stylesheet" href="./css/styles.css" />
  <link rel="stylesheet" href="./css/carrinho.css" />
  <link rel="stylesheet" href="./css/checkout.css" />
  <link rel="stylesheet" href="./css/menu.css" />
  <!-- JS -->
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
  <script defer src="./js/iziToast.min.js"></script>
  <script defer src="./js/localStorage.js"></script>
  <script defer src="./js/menu.js"></script>
  <script defer src="./js/checkout.js"></script>
</head>

<body>
  <?php include_once 'header.php'; ?>
  <main class="container flex">
    <h1>Finalizar compra</h1>
    <div class="produtos">
      <table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>Valor Un.</th>
            <th>Quantidade</th>
            <th>Valor total</th>
          </tr>
        </thead>
        <tbody id="items-cart"></tbody>
      </table>
    </div>
    <form action="compra.php" method="POST">
      <p>Transportadora</p>
      <select required class="slct" name="transportadora">
        <?= selectList($r_transportadora, ["id_transportadora", "nm_transportadora"], null, "Selecione uma transportadora") ?>
      </select>
      <p>Vendedor</p>
      <select required class="slct" name="vendedor">
        <?= selectList($r_vendedor, ["id_vendedor", "nm_vendedor"], null, "Selecione um vendedor") ?>
      </select>
      <p>Valor do frete:</p>
      <input readonly required type="text" id="frete" name="frete">
      <p>Comissão do vendedor:</p>
      <input readonly required type="text" id="comissao" name="comissao">
      <button onclick="clean()" type="submit">Comprar</button>
    </form>
  </main>
  <?php include_once 'footer.php'; ?>
</body>

</html>