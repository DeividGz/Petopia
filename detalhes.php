<!DOCTYPE html>
<?php
if (isset($_COOKIE["login"])) {
  $data = unserialize($_COOKIE["login"]);
} else {
  header("location:./welcome.php");
}

include_once './functions/database.php';

$id = filter_input(INPUT_GET, "id");

$banco = connection();
$sql = "SELECT p.id_produto, p.nm_produto, p.ds_produto, p.vl_produto, p.qt_estoque, p.dimensoes_produto, p.peso_produto, c.ds_categoria, u.ds_unidade_medida
FROM produtos p
INNER JOIN categorias c
ON c.id_categoria = p.id_categoria
INNER JOIN unidades_medida u 
ON u.id_unidade_medida = p.id_unidade_medida
WHERE p.id_produto = $id";
$resultado = $banco->query($sql);
$registro = $resultado->fetch(PDO::FETCH_ASSOC);

$sql_imagens = "SELECT p.id_produto, p.nm_produto, p.ds_produto, p.vl_produto, i.nm_imagem
FROM produtos p
INNER JOIN imagens i
ON i.id_produto = p.id_produto
WHERE p.id_produto = $id";
$resultado_imagens = $banco->query($sql_imagens);
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
  <link rel="stylesheet" href="./css/iziToast.min.css" />
  <link rel="stylesheet" href="./css/styles.css" />
  <link rel="stylesheet" href="./css/detalhes.css" />
  <link rel="stylesheet" href="./css/menu.css" />
  <!-- JS -->
  <script defer src="https://cdn.jsdelivr.net/npm/keen-slider@6.8.5/keen-slider.min.js"></script>
  <script defer src="./js/slider.js"></script>
  <script defer src="./js/menu.js"></script>
  <script defer src="./js/iziToast.min.js"></script>
  <script defer src="./js/localStorage.js"></script>
  <script defer src="./js/detalhes.js"></script>
</head>

<body>
  <?php include_once 'header.php'; ?>
  <main class="container box">
    <div class="imgs">
      <div id="my-keen-slider" class="keen-slider">
        <?php
        while ($imagens = $resultado_imagens->fetch(PDO::FETCH_ASSOC)) {
        ?>
          <div class="keen-slider__slide slide">
            <img src="./img/produtos/<?= $imagens['nm_imagem'] ?>" alt="<?= $registro['nm_produto'] ?>" />
          </div>
        <?php
        }
        $resultado = null;
        $banco = null;
        ?>
      </div>
    </div>
    <div class="info">
      <p style="display: none;">cod - <span id="id_produto"><?= $id ?></span></p>
      <p><strong><?= $registro['ds_categoria'] ?></strong></p>
      <h1><?= $registro['nm_produto'] ?></h1>
      <h2>R$<?= $registro['vl_produto'] ?></h2>
      <p><?= $registro['ds_produto'] ?></p>
      <p><strong>Dimensões:</strong> <?= $registro['dimensoes_produto'] ?></p>
      <p><strong>Peso:</strong> <?= $registro['peso_produto'] ?>kg</p>
      <p><strong>Quantidade disponível em estoque: </strong><?= $registro['qt_estoque'] ?></p>
      <p><strong>Unidade de medida:</strong> <?= $registro['ds_unidade_medida'] ?></p>
      <div class="actions">
        <button onclick="
        addToCart(<?= $id ?>, '<?= $registro['nm_produto'] ?>', <?= $registro['vl_produto'] ?>, <?= $registro['qt_estoque'] ?>)">Adicionar ao carrinho</button>
        <button class="orange"><a href="carrinho.php" style="color: #fff">Ver carrinho</a></button>
      </div>
      <p><strong>Quantidade adicionada:</strong> <span id="qt"></span> </p>
    </div>
  </main>
  <?php include_once 'footer.php'; ?>
</body>

</html>