<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache





include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/AfsCldCli.php');
$Planos = new Clientes();
$util = new Util();
$Json = null;

try {

    if(isset($_GET)){
        $cod = $_GET["id"];
    }

    $listaplanos = $Planos->SelecionarDadosClientePorCod($cod);
    if($listaplanos){
        if (count($listaplanos) === 0) {
            $Json = '[]';
            echo json_encode($Json);
        }
    }
    else{
        $Json = '[]';
        echo json_encode($Json);
        return;
    }
    

    if (count($listaplanos)) {
        $Json = '[';
        $cont = 1;
        $total = count($listaplanos);
        foreach ($listaplanos as $plan) {
            $date = new DateTime($plan->CLIDATACADASTRO);
            if ($cont == $total) {
                $Json = $Json .  '{"id":"' . $plan->CLICOD . '","cliente":"' . $plan->CLINOME . '","cpf":"' . $plan->CLICPF . '","dtcadastro":"' . $date->format( 'd/m/Y') . '","editar":"'. $plan->CLICOD . '","excluir":"'. $plan->CLICOD . '"}]';
            } else {
                $Json = $Json .  '{"id":"' . $plan->CLICOD . '","cliente":"' . $plan->CLINOME . '","cpf":"' . $plan->CLICPF . '","dtcadastro":"' . $date->format( 'd/m/Y') . '","editar":"'. $plan->CLICOD . '","excluir":"'. $plan->CLICOD . '"},';
            }
            $cont++;
        }

        ////$Json = $util->convert_from_latin1_to_utf8_recursively($Json);
        echo json_encode($Json);
    }
} catch (Exception $e) {
    echo '[{"TransCod":0, "erro":"' . $e->getMessage() . '"}]'; // opcional, apenas para teste
}
