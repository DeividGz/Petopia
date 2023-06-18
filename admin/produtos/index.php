<!DOCTYPE html>

<?php
include_once '../../functions/views.php';
include_once '../../functions/database.php';
include_once '../../functions/loadFiles.php';

$nome = filter_input(INPUT_GET, 'nome');
$descricao = filter_input(INPUT_GET, 'descricao');
$valor = filter_input(INPUT_GET, 'valor');
$peso = filter_input(INPUT_GET, 'peso');
$dimensoes = filter_input(INPUT_GET, 'dimensoes');
$categoria = filter_input(INPUT_GET, 'categoria');
$medida = filter_input(INPUT_GET, 'medida');
$quantidade = filter_input(INPUT_GET, 'quantidade');

$banco = connection();
$sql_categoria = "SELECT id_categoria, ds_categoria FROM categorias ORDER BY ds_categoria";
$r_categoria = $banco->query($sql_categoria);
$sql_medida = "SELECT id_unidade_medida, ds_unidade_medida FROM unidades_medida ORDER BY ds_unidade_medida";
$r_medida = $banco->query($sql_medida);
?>

<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Petopia | Admin</title>
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&family=Righteous&display=swap" rel="stylesheet" />

  <link rel="shortcut icon" href="../../img/icon.png" type="image/x-icon" />
  <!-- CSS -->
  <link rel="stylesheet" href="../../css/styles.css" />
  <link rel="stylesheet" href="../../css/admin.css" />
  <link rel="stylesheet" href="../../css/adm_produtos.css" />
  <!-- JS -->
</head>

<body>
  <?php include_once '../header.php'; ?>
  <nav class="container box">
    <a class="active" href="../produtos">
      Produtos
    </a>
    <a href="../categorias">
      Categorias & Unidades de medida
    </a>
    <a href="../vendedores">
      Vendedores
    </a>
    <a href="../transportadoras">
      Transportadoras
    </a>
  </nav>
  <main class="container box">
    <div class="form">
      <h1>Cadastro de produto</h1>
      <form method="POST" enctype="multipart/form-data" action="insert.php">
        <div class="imgs_produto">
          <label for="img1" class="add_img">
            <img id="picture" src="<?= LoadImage("../../img/produtos/" . ".png") ?>" alt="" />
          </label>
          <fieldset>
            <legend>
              Adicione até 5 imagens do produto
            </legend>
            <input type="file" id="img1" name="img1" accept="image" required />

            <input type="file" id="img2" name="img2" accept="image" />

            <input type="file" id="img3" name="img3" accept="image" />

            <input type="file" id="img4" name="img4" accept="image" />

            <input type="file" id="img5" name="img5" accept="image" />
          </fieldset>
        </div>
        <div class="linha"></div>
        <div class="inicio_form">
          <div>
            <input required name="nome" value="<?= $nome ?>" type="text" placeholder="Nome" />
            <select class="slct" name="categoria">
              <?= selectList($r_categoria, ["id_categoria", "ds_categoria"], $categoria, "Selecione uma categoria") ?>
            </select>
            <select class="slct" name="medida">
              <?= selectList($r_medida, ["id_unidade_medida", "ds_unidade_medida"], $medida, "Selecione uma unidade de medida") ?>
            </select>
          </div>
          <textarea required name="descricao" type="text" placeholder="Descreva o produto..." rows="5" style="resize: none"><?= $descricao ?></textarea>
        </div>
        <div class="final_form">
          <div>
            <input required name="dimensao" value="<?= $valor ?>" type="text" placeholder="Dimensões do produto (em cm)" />
            <input required name="peso" value="<?= $peso ?>" type="number" placeholder="Peso unitário (em Kg)" />
          </div>
          <div>
            <input required name="valor" value="<?= $valor ?>" type="number" placeholder="Valor unitário do produto" />
            <input required name="quantidade" value="<?= $quantidade ?>" type="number" placeholder="Quantidade" />
          </div>
        </div>
        <div class="linha"></div>
        <button type="submit">Cadastrar produto</button>
      </form>
      <div class="linha"></div>
      <a href="cadastrados.php" class="ver_produtos">
        <button>
          Visualizar produtos cadastrados
        </button>
      </a>
    </div>
  </main>
  <?php include_once '../footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../../js/alerts.js"></script>
  <script src="../../js/modal.js"></script>
  <script src="../../js/showImage.js"></script>
  <script>
    let picture = document.getElementById("picture")
    let file1 = document.getElementById("img1")
    let file2 = document.getElementById("img2")
    let file3 = document.getElementById("img3")
    let file4 = document.getElementById("img4")
    let file5 = document.getElementById("img5")

    file1.addEventListener("change", function() {
      show(file1, picture)
    })
    file2.addEventListener("change", function() {
      show(file2, picture)
    })
    file3.addEventListener("change", function() {
      show(file3, picture)
    })
    file4.addEventListener("change", function() {
      show(file4, picture)
    })
    file5.addEventListener("change", function() {
      show(file5, picture)
    })
  </script>
</body>

</html>