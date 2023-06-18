<!DOCTYPE html>

<?php
include_once '../../functions/loadFiles.php';
include_once '../../functions/views.php';
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
  <link rel="stylesheet" href="../../css/adm_cadastrados.css" />
  <!-- JS -->
  <script defer src="../../js/modal.js"></script>
  <script defer src="../../js/alerts.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script defer src="../../js/showImage.js"></script>
</head>

<body>
  <a class="btn_voltar" href="index.php">Voltar</a>
  <main class="container box" style="display: flex; flex-direction: column; align-items: center">
    <h1>Produtos cadastrados</h1>
    <?php
    include_once '../../functions/database.php';
    $banco = connection();

    $sql_produtos = "SELECT
                p.id_produto,
                p.nm_produto,
                p.ds_produto,
                p.vl_produto,
                p.qt_estoque,
                p.dimensoes_produto,
                p.peso_produto,
                p.id_categoria,
                p.id_unidade_medida,
                m.ds_unidade_medida,
                c.ds_categoria
            FROM produtos p
            INNER JOIN categorias c ON c.id_categoria = p.id_categoria
            INNER JOIN unidades_medida m ON m.id_unidade_medida = p.id_unidade_medida
            WHERE p.status_produto = 'Ativo'
            ORDER BY p.nm_produto
            ";
    $resultado = $banco->query($sql_produtos);

    if ($resultado->rowCount() == 0) {
    ?>
      <div class="linha"></div>
      <p>Nenhum produto cadastrado</p>
      <?php
    } else {
      while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {

        $id = $registro['id_produto'];
        $sql_imagens = "SELECT i.nm_imagem
        FROM imagens i
        INNER JOIN produtos p
        ON i.id_produto = p.id_produto
        WHERE p.id_produto = $id";
        $resultado_imagens = $banco->query($sql_imagens);
      ?>
        <div class="linha"></div>
        <div class="produto">
          <div class="header_prod">
            <button title="Editar" onclick="openModal(<?= $registro['id_produto'] ?>)" style="all: initial; cursor: pointer;">
              <img src="../../img/edit.svg" alt="Editar">
            </button>
            <h2><?= $registro["nm_produto"] ?></h2>
            <button title="Apagar" onclick="deleteData('delete.php?codigo=<?= $registro['id_produto'] ?>')" style="all: initial; cursor: pointer;">
              <img src="../../img/delete.svg" alt="Deletar">
            </button>
          </div>
          <div class="informacoes">
            <div class="detalhes">
              <p><a>Categoria:</a> <?= $registro["ds_categoria"] ?></p>
              <p><a>Em estoque:</a> <?= $registro["qt_estoque"] ?></p>
              <p><a>Valor unitário:</a> <?= $registro["vl_produto"] ?></p>
              <p><a>Dimensões:</a> <?= $registro["dimensoes_produto"] ?></p>
              <p><a>Unidade de medida:</a> <?= $registro["ds_unidade_medida"] ?></p>
              <p><a>Peso:</a> <?= $registro["peso_produto"] ?></p>
            </div>
            <div class="descricao">
              <a>Descrição:</a>
              <textarea disabled rows="8"><?= $registro["ds_produto"] ?></textarea>
            </div>
          </div>
          <div class="imagens">
            <?php
            while ($registro_img = $resultado_imagens->fetch(PDO::FETCH_ASSOC)) {
            ?>
              <img src="<?= loadCadastrado('../../img/produtos/' . $registro_img['nm_imagem']) ?>" alt="<?= $registro['nm_produto'] ?>" />
            <?php
            }
            $resultado_imagens = null;
            ?>
          </div>
        </div>

        <div class="modal" id="<?= $registro['id_produto'] ?>">
          <div class="total_content">
            <button class="button_cancel" onclick="closeModal(<?= $registro['id_produto'] ?>)">X | Cancelar</button>
            <div class="content">
              <form class="insert" action="edit.php?codigo=<?= $registro['id_produto'] ?>" enctype="multipart/form-data" method="POST">
                <div class="input_edit_t">
                  <div class="fields">
                    <div>
                      <input type="text" value="<?= $registro["nm_produto"] ?>" name="nome" id="nome" placeholder="Nome">
                      <?php
                      $sql_categoria = "SELECT id_categoria, ds_categoria FROM categorias ORDER BY ds_categoria";
                      $r_categoria = $banco->query($sql_categoria);

                      $sql_medida = "SELECT id_unidade_medida, ds_unidade_medida FROM unidades_medida ORDER BY ds_unidade_medida";
                      $r_medida = $banco->query($sql_medida);
                      ?>
                      <select class="slct" name="categoria">
                        <?= selectList($r_categoria, ["id_categoria", "ds_categoria"], $registro['id_categoria'], "Selecione uma categoria") ?>
                      </select>
                      <input type="text" value="<?= $registro["qt_estoque"] ?>" name="qt_estoque" id="qt_estoque" placeholder="Quantidade em estoque">
                      <input type="text" value="<?= $registro["vl_produto"] ?>" name="valor" id="valor" placeholder="Valor unitário">
                      <input type="text" value="<?= $registro["dimensoes_produto"] ?>" name="dimensoes" id="dimensoes" placeholder="Dimensões">
                      <select class="slct" name="medida">
                        <?= selectList($r_medida, ["id_unidade_medida", "ds_unidade_medida"], $registro['id_unidade_medida'], "Selecione uma unidade de medida") ?>
                      </select>
                      <input type="text" value="<?= $registro["peso_produto"] ?>" name="peso" id="peso" placeholder="Peso">
                    </div>
                    <div style="border: 1px solid black; padding: 0.5rem; border-radius: var(--radius)">
                      <textarea required name="descricao" type="text" placeholder="Descreva o produto..." rows="5" style="resize: none"><?= $registro["ds_produto"] ?></textarea>
                    </div>
                  </div>
                  <div class="imgs_produto">
                    <label for="img1" class="add_img">
                      <img id="picture" src="<?= LoadImage("../../img/produtos/" . ".png") ?>" alt="" />
                    </label>
                    <div class="inputs">
                      <input type="file" id="img1" name="img1" accept="image" required />

                      <input type="file" id="img2" name="img2" accept="image" />

                      <input type="file" id="img3" name="img3" accept="image" />

                      <input type="file" id="img4" name="img4" accept="image" />

                      <input type="file" id="img5" name="img5" accept="image" />
                    </div>
                  </div>
                  <button type="submit">Salvar edição</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    <?php
      }
    }

    $resultado = null;
    $banco = null;
    ?>
  </main>
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