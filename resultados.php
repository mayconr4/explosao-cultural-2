<?php 
use ExplosaoCultural\Services\EventoServico; 

require_once 'vendor/autoload.php';

$eventosServico = new EventoServico();
$resultados = $eventosServico->buscar($_GET['busca'] ?? '');
$quantidade = count($resultados); 

if ($quantidade > 0){ 
?>
    <h2 class="fs-5">resultados: <span class="badge rounded-pill text-bg-success"><?=$quantidade?></span></h2>
    <div class="list-group"> 
        <?php foreach($resultados as $itemEvento){ ?>
            <a class="list-group-item list-group-item-action" href="evento.php?id=<?=$itemEvento['id']?>">
                <?=$itemEvento['nome']?>
            </a>
        <?php } ?>
    </div>
<?php } else { ?> 
    <h2 class="fs-5 text-danger">Sem eventos</h2>
<?php } ?>

