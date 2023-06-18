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
  <title>Pedido finalizado | Petopia</title>
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&family=Righteous&display=swap" rel="stylesheet" />
  <link rel="shortcut icon" href="./img/icon.png" type="image/x-icon" />
  <!-- CSS -->
  <link rel="stylesheet" href="./css/iziToast.min.css" />
  <link rel="stylesheet" href="./css/styles.css" />
  <link rel="stylesheet" href="./css/checkout.css" />
  <link rel="stylesheet" href="./css/menu.css" />
  <!-- JS -->
  <script defer src="./js/menu.js"></script>
</head>

<body>
  <?php include_once 'header.php'; ?>
  <main class="container finalizado">
    <h1>Pedido finalizado!</h1>
    <h2>Pague através do QR Code e sua compra estará finalizada</h2>
    <div class="pay">
      <img src="./img/sucesso.svg" alt="Compra concluída com sucesso" width="400">
      <img src="./img/pagar.png" alt="QR code para pagar" width="250" onclick="mensagem()" style="cursor: pointer;">
    </div>
    <button>
      <a href="historico.php" style="color: #FFF">
        Ver minhas compras
      </a>
    </button>
  </main>
  <?php include_once 'footer.php'; ?>
  <script src="./js/iziToast.min.js"></script>
  <script>
    function mensagem() {
      iziToast.show({
          title: "Pagamento efetuado",
          timeout: 2000,
          color: "green",
        });
    }
  </script>
</body>

</html>