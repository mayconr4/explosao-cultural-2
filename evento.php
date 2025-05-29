<?php 
require_once 'vendor/autoload.php';

use ExplosaoCultural\Helpers\Utils;
use ExplosaoCultural\Services\EventoServico; 

$eventoServico = new EventoServico();

Utils::verificarId($_GET["id"] ?? null);  

$dados = $eventoServico->listarDetalhes($_GET["id"]);

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
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav" aria-controls="menuNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse justify-content-center" id="menuNav">
            <ul class="navbar-nav mx-auto">
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
                      <a class="dropdown-item" href="generos.php?tipo=<?= htmlspecialchars($generos['id']) ?>">
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

            <div class="position-relative ms-lg-3">
              <form autocomplete="off" class="d-flex" action="resultados.php" method="POST" id="form-busca">
                <input id="campo-busca" name="busca" class="form-control me-2" type="search" placeholder="Pesquise aqui" aria-label="Pesquise aqui">
              </form>
              <div id="resultados" role="region" aria-live="polite" class="mt-3 position-absolute container bg-white shadow-lg p-3 rounded"></div>
            </div>
          </div>
        </div>
      </nav>

    </div>
    <hr>
  </header> 

  <div class="row my-1 mx-md-n1"> 
    
      <article class="col-12">
         <h2> <?=$dados['titulo']?> </h2>   
         <p class="font-weight-light"> 
            <time><?=Utils::formataData($dados['data_evento'])?></time> - <span><?=$dados['criador']?></span> 
         </p>         
         <img src="images/<?=$dados['imagem']?>" alt="" class="float-start pe-2 img-fluid">
         <p class="ajusta-texto"><?=$dados['descricao']?></p> 
      </article>              

  </div>

