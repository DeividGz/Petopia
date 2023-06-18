<!DOCTYPE html>
<?php
include_once './functions/database.php';

$banco = connection();
$sql = "SELECT p.id_produto, p.nm_produto, p.ds_produto, p.vl_produto, i.nm_imagem FROM produtos p INNER JOIN imagens i ON i.id_produto = p.id_produto WHERE i.nm_imagem LIKE '%-1.PNG' AND p.qt_estoque > 0 AND p.status_produto = 'Ativo'";
$resultado = $banco->query($sql);
?>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Petopia | Tudo para seu amigo animal</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/keen-slider@6.8.5/keen-slider.min.css" />
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&family=Righteous&display=swap" rel="stylesheet" />

  <link rel="shortcut icon" href="./img/icon.png" type="image/x-icon" />
  <!-- CSS -->
  <link rel="stylesheet" href="./css/styles.css" />
  <link rel="stylesheet" href="./css/home.css" />
  <!-- JS -->
  <script defer src="https://cdn.jsdelivr.net/npm/keen-slider@6.8.5/keen-slider.min.js"></script>
  <script defer src="./js/slider.js"></script>
</head>

<body>
  <header>
    <div class="container">
      <a href="/">
        <img src="./img/logo.svg" alt="Logo Petopia" height="80" />
      </a>
      <div class="links">
        <a href="./login.php">Login</a>
        <a href="./cadastro.php">Cadastro</a>
      </div>
    </div>
  </header>
  <div class="hero">
    <!-- CARROSSEL -->
    <div id="my-keen-slider" class="keen-slider">
      <div class="keen-slider__slide slide">
        <img src="./img/pets-1.jpg" alt="Imagem de pets" />
      </div>
      <div class="keen-slider__slide slide">
        <img src="./img/pets-2.jpg" alt="Imagem de pets" />
      </div>
      <div class="keen-slider__slide slide">
        <img src="./img/pets-3.jpg" alt="Imagem de pets" />
      </div>
      <div class="keen-slider__slide slide">
        <img src="./img/pets-4.jpg" alt="Imagem de pets" />
      </div>
      <div class="keen-slider__slide slide">
        <img src="./img/pets-5.jpg" alt="Imagem de pets" />
      </div>
      <div class="keen-slider__slide slide">
        <img src="./img/pets-6.jpg" alt="Imagem de pets" />
      </div>
      <div class="keen-slider__slide slide">
        <img src="./img/pets-7.jpg" alt="Imagem de pets" />
      </div>
    </div>
  </div>
  <div class="line"></div>
  <main class="container">
    <h1>Bem-vindo(a) à Petopia!</h1>
    <h2>Encontre tudo para seu amigo pet bem aqui!</h2>
    <div class="products">
      <?php
      while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
      ?>
        <div class="card">
          <img src="./img/produtos/<?= $registro['nm_imagem'] ?>" alt="<?= $registro['nm_produto'] ?>" />
          <h3>R$<?= $registro['vl_produto'] ?></h3>
          <h4><?= $registro['nm_produto'] ?></h4>
          <p><?=substr($registro['ds_produto'], 0, 90) . (strlen($registro['ds_produto']) > 100 ? '...' : '')?></p>
          <a class="detalhes" href="./login.php">Detalhes</a>
        </div>
      <?php
      }
      $resultado = null;
      $banco = null;
      ?>
    </div>
    <p>Faça o login para ver detalhes dos produtos e continuar suas compras</p>
  </main>
  <?php include_once 'footer.php'; ?>
</body>

</html>