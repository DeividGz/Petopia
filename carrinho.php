<!DOCTYPE html>
<?php
if (isset($_COOKIE["login"])) {
  $data = unserialize($_COOKIE["login"]);
} else {
  header("location:./welcome.php");
}
?>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Meu carrinho | Petopia</title>
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&family=Righteous&display=swap" rel="stylesheet" />
  <link rel="shortcut icon" href="./img/icon.png" type="image/x-icon" />
  <!-- CSS -->
  <link rel="stylesheet" href="./css/iziToast.min.css" />
  <link rel="stylesheet" href="./css/styles.css" />
  <link rel="stylesheet" href="./css/carrinho.css" />
  <link rel="stylesheet" href="./css/menu.css" />
  <!-- JS -->
  <script defer src="./js/iziToast.min.js"></script>
  <script defer src="./js/localStorage.js"></script>
  <script defer src="./js/menu.js"></script>
  <script defer src="./js/cart.js"></script>
</head>

<body>
  <?php include_once 'header.php'; ?>
  <main class="container">
    <h1>Meu carrinho</h1>
    <div id="show-cart" class="carrinho">
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
    <div class="checkout">
      <div class="total">
        <p>Total: R$<span id="amount">000.00</span></p>
        <a href="./checkout.php">
          Fechar pedido
        </a>
      </div>
    </div>
    </div>
    <div id="empty-cart">
      <img src="./img/empty.svg" alt="Carrinho Vazio" width="250px" />
      <h1>Seu carrinho está vazio, vá às compras!</h1>
    </div>
  </main>
  <?php include_once 'footer.php'; ?>
</body>

</html>