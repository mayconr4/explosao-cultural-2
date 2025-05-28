<?php

require_once __DIR__ . '/vendor/autoload.php';

use ExplosaoCultural\Helpers\Utils;
use ExplosaoCultural\Services\UsuarioServico;
use ExplosaoCultural\Auth\ControleDeAcesso;

if (isset($_GET["campos_obrigatorios"])) {
  $feedback = "Preencha e-mail e senha!";
} elseif (isset($_GET['dados_incorretos'])) {
  $feedback = "Algo de errado não está certo!";
} elseif (isset($_GET['logout'])) {
  $feedback = "Você saiu do sistema!";
} elseif (isset($_GET['acesso_proibido'])) {
  $feedback = "Você deve logar primeiro";
}

if (isset($_POST['entrar'])) {

  $email = Utils::sanitizar($_POST["email"], 'email');
  $senha = ($_POST["senha"]);

  if (empty($email) || empty($senha)) {
    header("Location:login.php?campos_obrigatorios");
    exit;
  }

  try {
    $usuarioServico = new UsuarioServico();
    $usuario = $usuarioServico->buscarPorEmail($email);

    if (!$usuario) {
      header("location:login.php?dados_incorretos");
      exit;
    }

    if ($usuario && password_verify($senha, $usuario['senha'])) {
      ControleDeAcesso::login(
        $usuario['id'],
        $usuario['nome'],
        $usuario['tipo']
      );
      header("Location:usuario.php");
      exit;
    } else {

      header("location:login.php?dados_incorretos");
      exit;
    }
  } catch (Throwable $erro) {
    Utils::registrarErro($erro);
    header("location:login.php?erro");
    exit;
  }
}  
?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Explosão Cultural</title>
  <link rel="shortcut icon" href="images/logotipo2.png" type="image/png" sizes="64x64"> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body class="bg-ligth text-dark">
  <header class="bg-ligth p-3">
    <div class="container d-flex justify-content-between align-items-center">
      <h1 class="m-0"><a href="index.php" class="text-light text-decoration-none"><img class="logotipo" src="images/logo2.png" alt="logo tipo"></a></h1>
      <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
          <button class="navbar-toggler" type="button" id="menuBtn" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="menuNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link text-black" href="index.php">Home</a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-black" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Gêneros
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php foreach ($listaDeGeneros as $generos) { ?>
                    <li>
                      <a class="dropdown-item" href="generos.php?tipo=<?= $generos['id'] ?>">
                        <?= $generos['tipo'] ?>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="nav-item">
                <a class="nav-link text-black" href="cria-conta.php">Cadastro</a>
              </li>

              <li class="nav-item">
                <a class="nav-link text-black" href="login.php">Login</a>
              </li>
            </ul>

            <div class="position-relative">
              <form autocomplete="off" class="d-flex" action="resultados.php" method="POST" onsubmit="return false" id="form-busca">
                <input id="campo-busca" name="busca" class="form-control me-2" type="search" placeholder="Pesquise aqui" aria-label="Pesquise aqui">
              </form>

              <!-- Div manipulada pelo busca.js -->
              <div id="resultados" class="mt-3 position-absolute container bg-white shadow-lg p-3 rounded"></div>
            </div>
          </div>
        </div>
      </nav>
    </div>
    <hr>
  </header>

  <main class="container my-5 h-100">
    <div class="row">
      <div class="bg-light text-dark rounded shadow col-12 my-1 py-4">
        <h2 class="text-center fw-light">Acesso à sua conta</h2>

        <!-- Mensagem de feedback simulada -->
        <p class="my-2 alert alert-warning text-center">
          Preencha e-mail e senha!
        </p>

        <form action="" method="post" id="form-login" name="form-login" class="mx-auto w-50" autocomplete="off"> 
          <?php if(isset($feedback)): ?>
            <p class="my-2 alert alert-warning text-center"><?=$feedback?></p>
          <?php endif;?>

          <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input autofocus class="form-control" type="email" id="email" name="email" placeholder="email@exemplo.com">
          </div>

          <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input class="form-control" type="password" id="senha" name="senha" placeholder="Digite sua senha">
          </div>

          <button class="btn btn-primary btn-lg" name="entrar" type="submit">Entrar</button>
        </form>
      </div>
    </div>
  </main>

  <footer class="bg-ligth text-center py-3">
    <p class="m-0">Explosão Cultural — Empresa fictícia criada por Maycon e Lucas &copy;</p>
  </footer>

  <script src="js/menu.js"></script>
  <script src="js/buscar.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>