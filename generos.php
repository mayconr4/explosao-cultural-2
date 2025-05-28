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
  <header class="bg-black p-3">
    <div class="container d-flex justify-content-between align-items-center">
      <h1 class="m-0"><a href="index.php" class="text-light text-decoration-none">Explosão Cultural </a></h1>
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
                  <?php foreach ($listaDeGeneros as $generos) { ?>
                    <li>
                      <a class="dropdown-item" href="generos.php?tipo=<?= $generos['id'] ?>">
                        <?= $generos['tipo'] ?>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </li>
              <li class="nav-item"><a class="nav-link" href="cria-conta.php">Cadastro</a></li>
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

  <main class="container py-5">
    <section class="text-center mb-5">
      <h2 class="display-5 fw-bold">Descubra eventos únicos</h2>
      <p class="lead">Shows, festas e experiências culturais em destaque</p>
    </section> 
    
    

    <!--<//?php-->
    <!-- // <section class="row g-4">
      //   <//?php foreach ($listaDeEventos as $evento) { ?> 
      //   <div class="col-md-4">
        //     <div class="card bg-secondary text-light h-100">
//       <img src="images/<//?= $evento['imagem'] ?>" class="card-img-top" alt="Exposição">
//       <div class="card-body">
//         <h5 class="card-title">Evento: <//?= $evento['evento'] ?></h5>
//         <p class="card-text">data do evento: <//?= $evento['data_evento'] ?></p>
//         <p class="card-text">Horario: <//?= $evento['horario'] ?></p>
//         <p class="card-text">Classificação indicativa: <//?= $evento['classificacao'] ?></p>
//         <p class="card-text">Telefone: <//?= $evento['telefone'] ?></p>
//         <p class="card-text">Descrição: <//?= $evento['descricao'] ?></p>
//       </div>
//     </div>
//   </div>
// <//?php } ?> 
// </section> -->

</main>
    

  <footer class="bg-ligth text-center py-3">
    <p class="m-0">Explosão Cultural — Empresa fictícia crianda por Maycon e Lucas &copy; </p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  <script src="js/menu.js"></script>
  <script src="js/buscar.js"></script>
</body>


</html>