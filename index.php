<?php

use ExplosaoCultural\Helpers\Utils;
use ExplosaoCultural\Services\EventoServico;
use ExplosaoCultural\Services\GeneroServico;
use ExplosaoCultural\Enums\TipoUsuario;

require_once "vendor/autoload.php";

session_start();

$tipoSessao = $_SESSION['tipo'] ?? '';
$tipoUsuario = TipoUsuario::tryFrom(strtoupper($tipoSessao));

$eventoServico = new EventoServico();
$listaDeEventos = $eventoServico->listarTodos(); 

$hoje = date('Y-m-d'); 


$eventosFuturos = array_filter($listaDeEventos, fn($evento) => date('Y-m-d', strtotime($evento['data_evento'])) >= $hoje); 

usort($eventosFuturos, fn($a, $b) => strtotime($a['data_evento']) <=> strtotime($b['data_evento']));


$eventosParaCarrossel = array_slice($eventosFuturos, 0, 4); 

$generoServico = new GeneroServico();
$listaDeGeneros = $generoServico->listarTodos();

?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Explosão Cultural</title>
  <link rel="shortcut icon" href="images/logotipo2.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilo.css">
</head>

<body class="bg-light text-dark">
  <header class="bg-light p-3">
    <div class="container d-flex justify-content-between align-items-center">
      <h1 class="m-0">
        <a href="index.php" class="text-light text-decoration-none">
          <img class="logotipo" src="images/logo2.png" alt="Logo">
        </a>
      </h1>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="menuNav">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item"><a class="nav-link text-black" href="index.php">Home</a></li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-black" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">Gêneros</a>
                <ul class="dropdown-menu">
                  <?php foreach ($listaDeGeneros as $generos): ?>
                    <li><a class="dropdown-item" href="eventosPorGeneros.php?id=<?= htmlspecialchars($generos['id']) ?>"><?= htmlspecialchars($generos['tipo']) ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
              <li class="nav-item"><a class="nav-link text-black" href="cria-conta.php">Cadastro</a></li>
              <li class="nav-item"><a class="nav-link text-black" href="login.php">Login</a></li>
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

  <main class="container">
    

    <article class="py-5">
      <section class="text-center mb-5">
        <h2 class="display-5 fw-bold">Eventos </h2>
        <p class="lead">Shows, festas e experiências culturais em destaque</p>
      </section>

      <section class="row g-4">
     <?php foreach ($listaDeEventos as $evento) { ?> 
         <div class="col-md-4"> 
             <article class="card **card-com-imagem** bg-secondary text-light h-100" 
                      style="background-image: url('images/<?= htmlspecialchars($evento['imagem']) ?>'); background-repeat: no-repeat; background-size: cover; background-position: center; min-height: 300px; display: flex; flex-direction: column;">
                 <a href="evento.php?id=<?= $evento["id"] ?>" class="list-group-item list-group-item-action card-link">
                     <div class="card-body fundo-opaco">
                         <h5 class="card-title">Evento: <?= htmlspecialchars($evento['evento']) ?></h5>
                         <p class="card-text">Data: <?= htmlspecialchars(Utils::formatarDataBr($evento['data_evento'])) ?></p>
                         <p class="card-text">Horário: <?= htmlspecialchars($evento['horario']) ?></p>                           
                 </a>
             </article>
         </div>
     <?php } ?>
  </section>
     
    </article> 


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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/menu.js"></script>
  <script src="js/buscar.js"></script>
</body>

</html>
