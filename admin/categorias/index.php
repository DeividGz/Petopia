<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria</title>
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
        <a class="active" href="../categorias">
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
            <h1>Cadastro de informações</h1>
            <fieldset class="cadastro">
                <legend>Cadastrar categoria</legend>
                <form class="insert" action="insert.php?ptcod=1" method="POST">
                    <div>
                        <input required type="text" name="descricao" id="descricao" placeholder="Descrição">
                        <button type="submit">Salvar</button>
                    </div>
                </form>
            </fieldset>
            <fieldset class="registros">
                <legend>
                    Categorias de produtos cadastradas
                </legend>
                <?php
                include_once '../../functions/database.php';
                $banco = connection();
                $sql = "SELECT * FROM categorias";
                $resultado = $banco->query($sql);

                if ($resultado->rowCount() == 0) {
                ?>
                    <p>Nenhuma categoria cadastrada</p>
                    <?php
                } else {
                    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div class="registro">
                            <p><?= $registro["ds_categoria"] ?></p>
                            <button onclick="openModal(<?= $registro['id_categoria'] ?>)" title="Editar" style="all: initial; cursor: pointer">
                                <img src="../../img/edit.svg" alt="Editar">
                            </button>
                            <button onclick="deleteData('delete.php?codigo=<?= $registro['id_categoria'] ?>&ptcod=1')" title="Apagar" style="all: initial; cursor: pointer;">
                                <img src="../../img/delete.svg" alt="Deletar">
                            </button>
                        </div>
                        <div class="modal" id="<?= $registro['id_categoria'] ?>">
                            <button class="button_cancel" onclick="closeModal(<?= $registro['id_categoria'] ?>)">X | Cancelar</button>
                            <div class="content">
                                <form class="insert" action="edit.php?codigo=<?= $registro['id_categoria'] ?>&ptcod=1" method="POST">
                                    <div class="input_edit">
                                        <input required type="text" name="descricao" id="descricao" value="<?= $registro['ds_categoria'] ?>">
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
            <div class="linha"></div>
            <fieldset class="cadastro">
                <legend>Cadastrar unidade de medida</legend>
                <form class="insert" action="insert.php?ptcod=2" method="POST">
                    <div>
                        <input required type="text" name="sigla" id="sigla" placeholder="Sigla">
                        <input required type="text" name="descricao" id="descricao" placeholder="Descrição">
                        <button type="submit">Salvar</button>
                    </div>
                </form>
            </fieldset>
            <fieldset class="registros">
                <legend>
                    Unidades de medidas cadastradas
                </legend>
                <?php
                include_once '../../functions/database.php';
                $banco = connection();
                $sql = "SELECT * FROM unidades_medida";
                $resultado = $banco->query($sql);

                if ($resultado->rowCount() == 0) {
                ?>
                    <p>Nenhuma unidade de medida cadastrada</p>
                    <?php
                } else {
                    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div class="registro">
                            <p><?= $registro["sg_unidade_medida"] ?></p>
                            <p><?= $registro["ds_unidade_medida"] ?></p>
                            <button onclick="openModal('<?= $registro['id_unidade_medida'] ?>u')" title="Editar" style="all: initial; cursor: pointer">
                                <img src="../../img/edit.svg" alt="Editar">
                            </button>
                            <button onclick="deleteData('delete.php?codigo=<?= $registro['id_unidade_medida'] ?>&ptcod=2')" title="Apagar" style="all: initial; cursor: pointer;">
                                <img src="../../img/delete.svg" alt="Deletar">
                            </button>
                        </div>
                        <div class="modal" id="<?= $registro['id_unidade_medida'] ?>u">
                            <button class="button_cancel" onclick="closeModal('<?= $registro['id_unidade_medida'] ?>u')">X | Cancelar</button>
                            <div class="content">
                                <form class="insert" action="edit.php?codigo=<?= $registro['id_unidade_medida'] ?>&ptcod=2" method="POST">
                                    <div class="input_edit">
                                        <input required type="text" name="sigla" id="sigla" value="<?= $registro['sg_unidade_medida'] ?>">
                                        <input required type="text" name="descricao" id="descricao" value="<?= $registro['ds_unidade_medida'] ?>">
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