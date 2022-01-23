<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache






include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/AfsCldPdc.php');
$vxobPlan = new PlanoDeContas();
$util = new Util();
$Descricao = null;
$Tipo = null;
$Json = null;
try {
  
   

    session_start();
    if(isset($_GET)){

    $Id = $_GET["Id"];

    $plan = $vxobPlan->selecionarPlanosDeContasPorCod($Id);
    if($plan){
        if (count($plan) === 0) {
            $Json = '[]';
            echo json_encode($Json);
        }
    }
    else{
        $Json = '[]';
        echo json_encode($Json);
        return;
    }
    

    if (count($plan)) {
        $Json = '[';
        $cont = 1;
        $total = count($plan);
        foreach ($plan as $p) {
            $date = new DateTime($p->PDCDATCADASTRO);
            if ($cont == $total) {
                $Json = $Json .  '{"id":"' . $p->PDCCOD . '","plano":"' . $p->PDCDESCRICAO . '","Codtipo":"' . $p->TPCCOD . '","tipo":"' . $p->TPCDESCRICAO . '","dtcadastro":"' . $date->format( 'd/m/Y') . '"}]';
            } else {
                $Json = $Json .  '{"id":"' . $p->PDCCOD . '","plano":"' . $p->PDCDESCRICAO . '","Codtipo":"' . $p->TPCCOD . '","tipo":"' . $p->TPCDESCRICAO . '","dtcadastro":"' . $date->format( 'd/m/Y') . '"},';
            }
            $cont++;
        }

        ////$Json = $util->convert_from_latin1_to_utf8_recursively($Json);
        echo json_encode($Json);
    }
}
else{
    $Json = '[]';
    echo json_encode($Json);
    return;
}


    
} catch (Exception $e) {
    $Json = $util->convert_from_latin1_to_utf8_recursively('[{"TransCod":0, "msg":"' . $e->getMessage() . '"}]'); // opcional, apenas para teste
    echo json_encode($Json);
}
