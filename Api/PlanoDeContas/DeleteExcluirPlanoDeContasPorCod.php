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
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    $Id = strtoupper($data->Id);

    session_start();
    if($vxobPlan->ExcluirPlanoDeContasPorCod($Id)){
        
        $Json = $util->convert_from_latin1_to_utf8_recursively('[{"TransCod":3, "msg":"Registro Excluido com Sucesso."}]');
    }
    else{
        $Json = $util->convert_from_latin1_to_utf8_recursively('[{"TransCod":0, "msg":"Não foi Possivel Cadastrar este Registro."}]'); 
    }

    echo json_encode($Json);
    
} catch (Exception $e) {
    $Json = $util->convert_from_latin1_to_utf8_recursively('[{"TransCod":0, "msg":"' . $e->getMessage() . '"}]'); // opcional, apenas para teste
    echo json_encode($Json);
}
