<!DOCTYPE html>
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
  <!-- JS -->
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script defer src="../../js/masks.js"></script>
  <script defer src="../../js/viacep.js"></script>
</head>

<body>
  <?php include_once '../header.php'; ?>
  <nav class="container box">
    <a href="../produtos">
      Produtos
    </a>
    <a href="../categorias">
      Categorias & Unidades de medida
    </a>
    <a href="../vendedores">
      Vendedores
    </a>
    <a class="active" href="../transportadoras">
      Transportadoras
    </a>
  </nav>
  <main class="container box">
    <div class="form">
      <h1>Cadastro de transportadora</h1>
      <fieldset style="margin-top: 1rem">
        <legend>Cadastrar</legend>
        <form class="transportadora" action="insert.php" method="POST">
          <div class="fields">
            <div>
              <input required type="text" name="cpf_cnpj" id="cpf_cnpj" placeholder="CPF ou CNPJ">
              <input required type="text" name="nome" id="nome" placeholder="Nome">
              <input required type="text" name="cep" id="cep" onblur="pesquisacep(this.value)" placeholder="CEP">
              <input required type="text" name="estado" id="uf" placeholder="Estado">
            </div>
            <div>
              <input required type="text" name="cidade" id="cidade" placeholder="Cidade">
              <input required type="text" name="bairro" id="bairro" placeholder="Bairro">
              <input required type="text" name="rua" id="rua" placeholder="Rua">
              <input required type="text" name="numero" id="numero" placeholder="Número">
            </div>
          </div>
          <button type="submit">Salvar</button>
        </form>
      </fieldset>
      <h2>
        Transportadoras cadastradas
      </h2>
      <?php
      include_once '../../functions/database.php';

      $banco = connection();
      $sql = "SELECT * FROM transportadoras ORDER BY nm_transportadora";
      $resultado = $banco->query($sql);

      if ($resultado->rowCount() == 0) {
      ?>
        <p class="listagem_vazia">Nenhuma transportadora cadastrada</p>
      <?php
      } else {
      ?>
        <div class="transportadora_list">
          <?php
          while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
          ?>
            <div class="registro_transportadora">
              <p><strong>CPF/CNPJ:</strong> <?= $registro["cpf_cnpj_transportadora"] ?></p>
              <p><strong>Nome:</strong> <?= $registro["nm_transportadora"] ?></p>
              <p><strong>CEP:</strong> <?= $registro["cep_transportadora"] ?></p>
              <p><strong>Estado:</strong> <?= $registro["estado_transportadora"] ?></p>
              <p><strong>Cidade:</strong> <?= $registro["cidade_transportadora"] ?></p>
              <p><strong>Bairro:</strong> <?= $registro["bairro_transportadora"] ?></p>
              <p><strong>Rua:</strong> <?= $registro["logradouro_transportadora"] ?></p>
              <p><strong>Número:</strong> <?= $registro["nr_transportadora"] ?></p>
              <div class="actions">
                <button onclick="openModal(<?= $registro['id_transportadora'] ?>)" title="Editar">
                  <img src="../../img/edit.svg" alt="Editar">
                </button>
                <button onclick="deleteData('delete.php?codigo=<?= $registro['id_transportadora'] ?>')" title="Apagar">
                  <img src="../../img/delete.svg" alt="Deletar">
                </button>
              </div>
            </div>
            <div class="modal_transportadora" id="<?= $registro['id_transportadora'] ?>">
              <div class="total_content">
                <button class="button_cancel" onclick="closeModal(<?= $registro['id_transportadora'] ?>)">X | Cancelar</button>
                <div class="content">
                  <form class="insert" action="edit.php?codigo=<?= $registro['id_transportadora'] ?>" method="POST">
                    <div class="input_edit_t">
                      <div class="fields">
                        <div>
                          <input required type="text" value="<?= $registro["cpf_cnpj_transportadora"] ?>" name="cpf_cnpj" id="cpf_cnpj" placeholder="CPF ou CNPJ">
                          <input required type="text" value="<?= $registro["nm_transportadora"] ?>" name="nome" id="nome" placeholder="Nome">
                          <input required type="text" value="<?= $registro["cep_transportadora"] ?>" name="cep" id="cep" onblur="pesquisacep(this.value)" placeholder="CEP">
                          <input required type="text" value="<?= $registro["estado_transportadora"] ?>" name="estado" id="uf" placeholder="Estado">
                        </div>
                        <div>
                          <input required type="text" value="<?= $registro["cidade_transportadora"] ?>" name="cidade" id="cidade" placeholder="Cidade">
                          <input required type="text" value="<?= $registro["bairro_transportadora"] ?>" name="bairro" id="bairro" placeholder="Bairro">
                          <input required type="text" value="<?= $registro["logradouro_transportadora"] ?>" name="rua" id="rua" placeholder="Rua">
                          <input required type="text" value="<?= $registro["nr_transportadora"] ?>" name="numero" id="numero" placeholder="Número">
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
        </div>
  </main>
  <?php include_once '../footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../../js/alerts.js"></script>
  <script src="../../js/modal.js"></script>
</body>

</html>