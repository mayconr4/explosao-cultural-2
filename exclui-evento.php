<?php 
require_once 'vendor/autoload.php'; 
use ExplosaoCultural\Auth\ControleDeAcesso; 
use ExplosaoCultural\Enums\TipoUsuario;

use ExplosaoCultural\Helpers\Utils;
use ExplosaoCultural\Services\EventoServico; 

ControleDeAcesso::exigirLogin(); 

$idEvento = Utils::sanitizar($_GET["id"] , "inteiro"); 
Utils::verificarId($idEvento); 

$idUsuario = $_SESSION['id'];
$tipoUsuario = $tipoUsuario = $_SESSION['tipo'] === 'Administrador' ? TipoUsuario::ADMINISTRADOR : TipoUsuario::USUARIO;

$eventoServico = new EventoServico(); 
$eventoServico->excluir($idEvento, $tipoUsuario ,);

header("Location:usuario.php?id=$idUsuario");
exit;