<?php

use ExplosaoCultural\Helpers\Utils;
use ExplosaoCultural\Services\EventoServico;
use ExplosaoCultural\Services\GeneroServico;
require_once "vendor/autoload.php";

$eventoServico = new EventoServico();
$listaDeEventos = $eventoServico->listarTodos();  

$generoServico = new GeneroServico();
$listaDeGeneros = $generoServico->listarTodos();



?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Explosão Cultural</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilo.css">
</head>

<body class="bg-ligth text-dark">
  <header class="bg-black p-3">
    <div class="container d-flex justify-content-between align-items-center">
      <h1 class="m-0"><a href="index.php" class="text-light text-decoration-none">Explosão Cultural <img src="images/logotipo.png" alt="Logotipo da explosão cultural" class="teste"></a></h1>
      <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
          <button class="navbar-toggler" type="button" id="menuBtn" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="menuNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="cria-conta.php">Cadastro</a></li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Gêneros
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php foreach ($listaDeGeneros as $generos) {?>
                  <li>
                    <a class="dropdown-item" href="generos.php?tipo=<?= $generos['id'] ?>">
                      <?= $generos['tipo'] ?>
                    </a> 
                  </li>
                  <?php } ?> 
                </ul>
              </li>               
              <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
            </ul>
                <div class="position-relative">
                <form autocomplete="off" class="d-flex" action="resultados.php" method="POST" onsubmit="return false" id="form-busca">
                  <input id="campo-busca" name="busca" class="form-control me-2" type="search" placeholder="Pesquise aqui" aria-label="Pesquise aqui">
                </form>
                <!-- Div manipulada pelo busca.js -->
                <div id="resultados" class="mt-3 position-absolute container bg-white shadow-lg p-3 rounded"></div>
              </div>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <section class="container py-5">
    <h2 class="text-white mb-4">Eventos em Destaquemoiu</h2>

    <div id="carouselEventos" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">


        <div class="carousel-item active">
          <div class="d-flex gap-3">
            <div class="card bg-secondary text-light" style="min-width: 300px;">
              <img src="https://source.unsplash.com/400x250/?music" class="card-img-top" alt="Evento 1">
              <div class="card-body">
                <h5 class="card-title">Show Indie</h5>
                <p class="card-text">Dia 10 de Junho - Centro Cultural</p>
              </div>
            </div>

            <div class="card bg-secondary text-light" style="min-width: 300px;">
              <img src="https://source.unsplash.com/400x250/?party" class="card-img-top" alt="Evento 2">
              <div class="card-body">
                <h5 class="card-title">Festa Black</h5>
                <p class="card-text">Dia 15 de Julho - Arena Norte</p>
              </div>
            </div>
          </div>
        </div>

        <div class="carousel-item">
          <div class="d-flex gap-3">
            <div class="card bg-secondary text-light" style="min-width: 300px;">
              <img src="https://source.unsplash.com/400x250/?exhibition" class="card-img-top" alt="Evento 3">
              <div class="card-body">
                <h5 class="card-title">Expo Arte Urbana</h5>
                <p class="card-text">De 5 a 20 de Julho - Galeria Sul</p>
              </div>
            </div>

            <div class="card bg-secondary text-light" style="min-width: 300px;">
              <img src="https://source.unsplash.com/400x250/?dj" class="card-img-top" alt="Evento 4">
              <div class="card-body">
                <h5 class="card-title">Noite Eletrônica</h5>
                <p class="card-text">Dia 25 de Julho - Club 303</p>
              </div>
            </div>
          </div>
        </div>

      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselEventos" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselEventos" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </section> <!-- Fim do Carrossel -->


  <main class="container py-5">
    <section class="text-center mb-5">
      <h2 class="display-5 fw-bold">Eventos únicos</h2>
      <p class="lead">Shows, festas e experiências culturais em destaque</p>
    </section>



    <section class="row g-4">


      <!-- mudou -->
      <!-- <div class="col-md-4">
        <div class="card bg-secondary text-light h-100 post" data-bs-toggle="modal" data-bs-target="#postModal">
          <img src="https://source.unsplash.com/400x250/?dance,party" class="card-img-top" alt="Festa">
          <div class="card-body">
            <h5 class="card-title">Baile Black</h5>
            <p class="card-text">A noite mais dançante do mês. Dia 12 de Agosto.</p>
          </div>
        </div>
      </div> -->
      <!-- Modal -->
      <!-- <div class="modal" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="postModalLabel">Detalhes do Evento</h5>
        <button type="button" class="btn-close fechar-modal" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <p>Mais informações sobre o Baile Black...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary fechar-modal" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div> -->
      </div>
      <?php foreach ($listaDeEventos as $evento) { ?>
        <div class="col-md-4">
          <div class="card bg-secondary text-light h-100">
            <img src="images/<?=$evento['imagem']?>" class="card-img-top" alt="Exposição">             
            <div class="card-body">
              <h5 class="card-title">Evento: <?= $evento['evento'] ?></h5> <!-- nome do evento -->
              <p class="card-text">data do evento: <?= $evento['data_evento'] ?></p> <!-- data do  evento -->
              <p class="card-text">Horario: <?= $evento['horario'] ?></p> <!-- horario do  evento -->
              <p class="card-text">Classificação indicativa: <?= $evento['classificacao'] ?></p> <!-- classificação enum  do  evento -->
              <p class="card-text">Telefone: <?= $evento['telefone'] ?></p> <!-- telefone do  evento -->
              <p class="card-text">Descrição: <?= $evento['descricao'] ?></p> <!-- descrição do  evento -->
              <!-- <p class="card-text"></p> imagem do  evento -->
            </div>
          </div>
        </div>
      <?php } ?>

    </section>
  </main>

  <footer class="bg-ligth text-center py-3">
    <p class="m-0">Explosão Cultural — Empresa fictícia crianda por Maycon e Lucas &copy; </p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/menu.js"></script> 
  <script src="js/buscar.js"></script>   
</body>

</html>
