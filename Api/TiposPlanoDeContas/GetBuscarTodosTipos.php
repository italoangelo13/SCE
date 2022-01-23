<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache





include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/AfsCldTpc.php');
$Tipos = new TipoPlanoDeContas();
$util = new Util();
$Json = null;

try {

    $listaTipos = $Tipos->selecionarTodosTiposPlanoDeContas();
    if($listaTipos){
        if (count($listaTipos) === 0) {
            $Json = '[]';
            echo json_encode($Json);
        }
    }
    else{
        $Json = '[]';
        echo json_encode($Json);
        return;
    }
    

    if (count($listaTipos)) {
        $Json = '[';
        $cont = 1;
        $total = count($listaTipos);
        foreach ($listaTipos as $tip) {
            $date = new DateTime($tip->TPCDATCADASTRO);
            if ($cont == $total) {
                $Json = $Json .  '{"id":"' . $tip->TPCCOD . '","tipo":"' . $tip->TPCDESCRICAO . '","dtcadastro":"' . $date->format( 'd/m/Y') . '","editar":"'. $tip->TPCCOD . '","excluir":"'. $tip->TPCCOD . '"}]';
            } else {
                $Json = $Json .  '{"id":"' . $tip->TPCCOD . '","tipo":"' . $tip->TPCDESCRICAO . '","dtcadastro":"' . $date->format( 'd/m/Y') . '","editar":"'. $tip->TPCCOD . '","excluir":"'. $tip->TPCCOD . '"},';
            }
            $cont++;
        }

        ////$Json = $util->convert_from_latin1_to_utf8_recursively($Json);
        echo json_encode($Json);
    }
} catch (Exception $e) {
    echo '[{"TransCod":0, "erro":"' . $e->getMessage() . '"}]'; // opcional, apenas para teste
}
