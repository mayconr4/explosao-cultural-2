<!doctype html>
<html lang="pt-br" class="h-100">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Explosão Cultural</title>
  <link rel="stylesheet" href="css/estilo.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-light h-100">
  <header class="bg-black p-3">
    <div class="container d-flex justify-content-between align-items-center">
      <h1 class="m-0"><a href="index.php" class="text-light text-decoration-none">Explosão Cultural</a></h1>
      <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
          <button class="navbar-toggler" type="button" id="menuBtn" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="menuNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Gêneros
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href=""></a> </li>
                </ul>
              <li class="nav-item"><a class="nav-link" href="usuarios.php">Login</a></li>
              <li class="nav-item"><a class="nav-link" href="criarEvento.php">Crie seu evento</a></li>

              <div class="position-relative">
                <form autocomplete="off" class="d-flex" action="resultados.php" method="POST" onsubmit="return false" id="form-busca">
                  <input id="campo-busca" name="busca" class="form-control me-2" type="search" placeholder="Pesquise aqui" aria-label="Pesquise aqui">
                </form>
                <!-- Div manipulada pelo busca.js -->
                <div id="resultados" class="mt-3 position-absolute container bg-white shadow-lg p-3 rounded"></div>
              </div>
          </div>
      </nav>
    </div>
  </header>
  <div class="container my-5 h-100">
    <h2 class="mb-4">Login</h2>
    <p class="text-warning">Atenção: os campos <strong>Nome</strong> e <strong>E-mail</strong> são <u>obrigatórios</u>.</p>
    <p class="text-warning"> <strong><a class="text-warning" href="login-adm.php">Login</a> Adiministrativo</strong> </p>

    <form autocomplete="off" action="https://formspree.io/f/mldbpvlk" method="post" id="my-form">
      <fieldset class="border p-4 rounded">
        <legend class="float-none w-auto px-3">Formulário de Contato</legend>

        <div class="mb-3">
          <label for="nome" class="form-label">Nome completo *</label>
          <input type="text" class="form-control" name="nome" id="nome" required placeholder="Digite seu nome completo">
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">E-mail *</label>
          <input type="email" class="form-control" name="email" id="email" required placeholder="email@exemplo.com">
        </div>


        <div class="mb-3">
          <label for="telefone" class="form-label">Telefone</label>
          <input type="tel" class="form-control" name="telefone" id="telefone" placeholder="(99) 99999-9999">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
  </div>
  </fieldset>
  </form>
  </div>

  <footer class="bg-black text-center py-3">
    <p class="m-0">Explosão Cultural — Empresa fictícia crianda por Maycon e Lucas &copy; </p>
  </footer>

  <script src="js/buscar.js"></script>
  <script src="js/menu.js"></script>
  <script src="js/login.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>