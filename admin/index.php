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

  <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon" />
  <!-- CSS -->
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/admin.css" />
  <link rel="stylesheet" href="../css/admin-home.css" />
  <!-- JS -->
</head>

<body>
  <header>
    <div class="container">
      <a href="../">
        <img src="../img/logo.svg" alt="Logo Petopia" height="80" />
      </a>
      <div class="links">
        <a href="#"></a>
      </div>
    </div>
  </header>
  <h1>Selecione um módulo</h1>
  <main class="container box">
    <nav>
      <a href="produtos">
        <img src="../img/produtos.png" alt="Caixa de produtos">
        <p>Produtos</p>
      </a>
      <a href="categorias">
        <img src="../img/categoria.png" alt="Prateleira">
        <p>Categorias & <br> Unidades de medida</p>
      </a>
      <a href="vendedores">
        <img src="../img/vendedor.png" alt="Vendedor">
        <p>Vendedores</p>
      </a>
      <a href="transportadoras">
        <img src="../img/transportadora.png" alt="Caminhão">
        <p>Transportadoras</p>
      </a>
    </nav>
  </main>
  <footer>
    <a href="../">
      <img src="../img/logo.svg" alt="Logo Petopia" />
    </a>
    <p>&copy; <?php echo date('Y'); ?> Petopia. Todos os direitos reservados.</p>
  </footer>
</body>

</html>