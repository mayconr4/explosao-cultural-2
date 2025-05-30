<?php  
require_once "vendor/autoload.php";

use ExplosaoCultural\Helpers\Utils;
use ExplosaoCultural\Services\EventoServico;
use ExplosaoCultural\Services\GeneroServico;

Utils::verificarId($_GET["id"] ?? null);

$eventoServico = new EventoServico();
$dados = $eventoServico->listarPorGenero($_GET["id"]);


$generoServico = new GeneroServico();
$listaDeGeneros = $generoServico->listarTodos();
?> 
<!DOCTYPE html>
<html lang="pt-br" class="h-100">

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
                      <a class="dropdown-item" href="eventosPorGeneros.php?id=<?= htmlspecialchars($generos['id']) ?>">
                        <?= htmlspecialchars($generos['tipo']) ?>
                      </a>
                    </li>
                  <?php } ?>
                </ul>

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
  <main class="container  bg-ligth text-dark">
<div class="row my-1 mx-md-n1">

    <article class="col-12">
        <?php if( count($dados) > 0 ){ ?>
        <h2 class="text-center">
            Gêneros sobre <span class="badge bg-primary">
                <?=$dados[0]["genero"]?>
            </span> 
        </h2>
        <?php } else { ?>
            <h2 class="alert alert-warning text-center">
                Não há eventos deste gênero </h2>
        <?php } ?>
        
        <div class="row my-1">
            <div class="col-12 px-md-1">
                <div class="list-group">
                <?php foreach($dados as $tipoEvento) { ?>
                    <a href="eventos.php?id=<?=$tipoEvento['id']?>" class="list-group-item list-group-item-action">
                        <h3 class="fs-6"><?=$tipoEvento['evento']?></h3>
                        <p><time><?=Utils::formataData($tipoEvento['data_evento'])?></time> 
                        - <?=$tipoEvento['criador']?></p>
                        <p><?=$tipoEvento['descricao']?></p>
                    </a>
                <?php } ?>
                </div>
            </div>
        </div>  
    </article>     

</div>      
  </main>
<hr>
<footer class="bg-ligth py-4">
    <div class="container d-flex justify-content-center align-items-center flex-column">
      <h1 class="m-0">
        <a href="index.php" class="text-light text-decoration-none">
          <img class="logotipo" src="images/logo2.png" alt="Logo do site">
        </a>
      </h1>

      <ul class="nav">
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
                      <a class="dropdown-item" href="eventosPorGeneros.php?id=<?= htmlspecialchars($generos['id']) ?>">
                        <?= htmlspecialchars($generos['tipo']) ?>
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
    </div>

    <p class="m-0 text-center">
      Explosão Cultural — Empresa fictícia criada por Maycon e Lucas &copy;
    </p>
  </footer>


  <script src="js/buscar.js"></script>
  <script src="js/menu.js"></script>
 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>