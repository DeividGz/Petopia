<!DOCTYPE html>

<?php

$email = filter_input(INPUT_GET, 'email');
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
  <link rel="stylesheet" href="./css/login.css" />
</head>

<body>
  <main>
    <img class="bird" src="./img/login-bird.png" alt="Passarinho" />

    <form action="./clientes/logar.php" method="POST">
      <img src="./img/logo.svg" alt="Logo Petopia" />
      <div class="erro">
        <span id="erro" name="erro"><?= $erro ?></span>
      </div>
      <input required name="email" id="email" value="<?= $email ?>" type="email" placeholder="E-mail" />
      <input required name="senha" id="senha" type="password" placeholder="Senha" />
      <div class="check">
        <input type="checkbox" name="manter" id="manter" />
        <label for="keep-loged">Manter-me logado(a)</label>
      </div>
      <button type="submit">Entrar</button>
      <a href="./cadastro.php">Sou novo(a), quero me cadastrar!</a>
    </form>

  </main>
</body>

</html>