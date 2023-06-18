<!DOCTYPE html>

<?php

$nome = filter_input(INPUT_GET, 'nome');
$email = filter_input(INPUT_GET, 'email');
$cpf_cnpj = filter_input(INPUT_GET, 'cpf_cnpj');
$cep = filter_input(INPUT_GET, 'cep');
$uf = filter_input(INPUT_GET, 'uf');
$cidade = filter_input(INPUT_GET, 'cidade');
$bairro = filter_input(INPUT_GET, 'bairro');
$rua = filter_input(INPUT_GET, 'rua');
$numero = filter_input(INPUT_GET, 'numero');
$senha = filter_input(INPUT_GET, 'senha');

$erro = filter_input(INPUT_GET, 'erro');
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
  <link rel="stylesheet" href="./css/cadastro.css" />
  <!-- JS -->
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script defer src="./js/masks.js"></script>
  <script defer src="./js/viacep.js"></script>
</head>

<body>
  <form method="POST" action="./clientes/cadastrar.php">
    <img src="./img/logo.svg" alt="Logo Petopia" />
    <h1>Cadastre-se!</h1>
    <div class="erro">
      <span id="erro"><?= $erro ?></span>
    </div>
    <input required value="<?= $nome ?>" name="nome" type="text" placeholder="Nome" />
    <input required value="<?= $email ?>" name="email" type="email" placeholder="E-mail" />
    <input required value="<?= $cpf_cnpj ?>" name="cpf_cnpj" type="text" id="cpf-cnpj" placeholder="CPF/CNPJ" />
    <input required value="<?= $cep ?>" name="cep" id="cep" onblur="pesquisacep(this.value)" type="text" placeholder="CEP" />
    <input required value="<?= $uf ?>" name="uf" id="uf" type="text" placeholder="Estado" />
    <input required value="<?= $cidade ?>" name="cidade" id="cidade" type="text" placeholder="Cidade" />
    <input required value="<?= $bairro ?>" name="bairro" id="bairro" type="text" placeholder="Bairro" />
    <input required value="<?= $rua ?>" name="rua" id="rua" type="text" placeholder="Logradouro" />
    <input required value="<?= $numero ?>" name="numero" type="number" placeholder="Número" />
    <input required value="<?= $senha ?>" name="senha" type="password" placeholder="Senha" />
    <button type="submit">Cadastrar</button>
    <a href="./login.php">Já ama os animais? Entre com sua conta</a>
  </form>
</body>

</html>