<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro vendedor</title>
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&family=Righteous&display=swap" rel="stylesheet" />
    <!-- CSS -->
    <link rel="shortcut icon" href="../../img/icon.png" type="image/x-icon" />
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/admin.css" />
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
        <a class="active" href="../vendedores">
            Vendedores
        </a>
        <a href="../transportadoras">
            Transportadoras
        </a>
    </nav>

    <main class="container box">
        <div class="form">
            <h1>Vendedores</h1>
            <fieldset class="cadastro">
                <legend>Cadastrar vendedor</legend>
                <form class="insert" action="insert.php" method="POST">
                    <div>
                        <input required type="text" name="cpf_cnpj" id="cpf_cnpj" placeholder="CPF ou CNPJ">
                        <input required type="text" name="nome" id="nome" placeholder="Nome">
                        <button type="submit">Salvar</button>
                    </div>
                </form>
            </fieldset>
            <fieldset class="registros">
                <legend>
                    Vendedores cadastrados
                </legend>
                <?php
                include_once '../../functions/database.php';

                $banco = connection();
                $sql = "SELECT id_vendedor, nm_vendedor, cpf_cnpj_vendedor FROM vendedores ORDER BY nm_vendedor";
                $resultado = $banco->query($sql);

                if ($resultado->rowCount() == 0) {
                ?>
                    <p>Nenhum vendedor cadastrado</p>
                    <?php
                } else {

                    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div class="registro">
                            <p><?= $registro["cpf_cnpj_vendedor"] ?></p>
                            <p><?= $registro["nm_vendedor"] ?></p>
                            <button onclick="openModal(<?= $registro['id_vendedor'] ?>)" title="Editar" style="all: initial; cursor: pointer">
                                <img src="../../img/edit.svg" alt="Editar">
                            </button>
                            <button onclick="deleteData('delete.php?codigo=<?= $registro['id_vendedor'] ?>')" title="Apagar" style="all: initial; cursor: pointer;">
                                <img src="../../img/delete.svg" alt="Deletar">
                            </button>
                        </div>
                        <div class="modal" id="<?= $registro['id_vendedor'] ?>">
                            <button class="button_cancel" onclick="closeModal(<?= $registro['id_vendedor'] ?>)">X | Cancelar</button>
                            <div class="content">
                                <form class="insert" action="edit.php?codigo=<?= $registro['id_vendedor'] ?>" method="POST">
                                    <div class="input_edit">
                                        <input required type="text" name="cpf_cnpj" id="cpf_cnpj" value="<?= $registro['cpf_cnpj_vendedor'] ?>">
                                        <input required type="text" name="nome" id="nome" value="<?= $registro['nm_vendedor'] ?>">
                                        <button type="submit">Salvar edição</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                <?php
                    }
                }
                $resultado = null;
                $banco = null;
                ?>
            </fieldset>
        </div>
    </main>
    <?php include_once '../footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../js/alerts.js"></script>
    <script src="../../js/modal.js"></script>
</body>

</html>