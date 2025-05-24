<?php 
require_once __DIR__ . '/vendor/autoload.php';

use ExplosaoCultural\Auth\ControleDeAcesso;
use ExplosaoCultural\Helpers\Utils;
use ExplosaoCultural\Services\EventoServico; 
use ExplosaoCultural\Services\UsuarioServico;
use ExplosaoCultural\Helpers\Validacoes;
use ExplosaoCultural\Services\GeneroServico;
use ExplosaoCultural\Models\Enderecos;
use ExplosaoCultural\Services\EnderecosServicos;


ControleDeAcesso::exigirLogin();

$idUsuario = $_SESSION['id'];

$mensagemErro = '';

$generoServico = new GeneroServico();

$listaDeGeneros = $generoServico->listarTodos();

if (isset($_POST['inserir'])){ 
    $titulo = Utils::sanitizar($_POST["nome_evento"]);
    $texto = Utils::sanitizar($_POST["descricao"]);  
    $localizacao = Utils::sanitizar($_POST["localizacao"]);
    $genero = Utils::sanitizar($_POST	["genero"], "inteiro");
    $imagem = Utils::sanitizar($_FILES['imagem'], "arquivo");  





}



?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Explosão Cultural</title>
    <link rel="stylesheet" href="css/estilo.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-dark text-light">
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
                            <li class="nav-item"><a class="nav-link" href="generos.php">Gêneros</a></li>
                            <li class="nav-item"><a class="nav-link" href="usuarios.php">Login</a></li>
                        </ul>

                        <div class="position-relative ms-3">
                            <form autocomplete="off" class="d-flex" action="resultados.php" method="POST" onsubmit="return false" id="form-busca">
                                <input id="campo-busca" name="busca" class="form-control me-2" type="search" placeholder="Pesquise aqui" aria-label="Pesquise aqui" />
                            </form>
                            <!-- Div manipulada pelo busca.js -->
                            <div id="resultados" class="mt-3 position-absolute container bg-white shadow-lg p-3 rounded"></div>
                        </div>

                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="container my-5  bg-dark text-light rounded p-4 shadow">
        <h2 class="mb-4 text-center">Inserir Evento</h2>


        <form class="mx-auto w-75" action="#" method="post" id="form-inserir" name="form-inserir" enctype="multipart/form-data" autocomplete="off">
            <div class="mb-3">
                <label class="form-label" for="genero">Gêneros:</label>
                <select class="form-select" name="genero" id="genero" required>
                    <option value="" disabled selected>Selecione...</option>
                    <option value="1">Música</option>
                    <option value="2">Arte</option>
                    <option value="3">Dança</option>
                </select>
            </div>
        </form>


        <div class="mb-3">
            <label class="form-label" for="titulo">Nome Do evento:</label>
            <input class="form-control" type="text" id="nome_evento" name="nome_evento" placeholder="Digite o nome do evento" required />
        </div>

        <div class="mb-3">
            <label class="form-label" for="texto">Descrição:</label>
            <textarea class="form-control" name="texto" id="texto" cols="50" rows="6" placeholder="Digite o texto completo" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label" for="resumo">Localização do evento</label>
            <textarea class="form-control" name="resumo" id="resumo" cols="50" rows="2" maxlength="300" placeholder="Endereço" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label" for="imagem">Selecione uma imagem:</label>
            <input class="form-control" type="file" id="imagem" name="imagem" accept="image/png, image/jpeg, image/gif, image/svg+xml" required />
        </div>

        <div class="mb-3">
            <p>Deixar o evento em destaque?</p>
            <input type="radio" class="btn-check" name="destaque" id="option1" checked autocomplete="off" value="nao" />
            <label class="btn btn-outline-danger me-2" for="option1">Não</label>

            <input type="radio" class="btn-check" name="destaque" id="option2" autocomplete="off" value="sim" />
            <label class="btn btn-outline-success" for="option2">Sim</label>
        </div>

        <div class="text-center">
            <button class="btn btn-primary" id="inserir" name="inserir" type="submit">
                <i class="bi bi-save">Lançar evento</i>
            </button>
        </div>
        </form>
    </main>

    <footer class="bg-black text-center py-3 mt-5">
        <p class="m-0 text-light">Explosão Cultural — Empresa fictícia criada por Maycon e Lucas &copy;</p>
    </footer>

    <script src="js/menu.js"></script>
    <script src="js/buscar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
