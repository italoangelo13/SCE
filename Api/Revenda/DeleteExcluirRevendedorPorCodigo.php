<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache






include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldRev.php');
$vXobReven = new Revendedores();
$util = new Util();
$Transacao = array();
try {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    $Id = strtoupper($data->Id);

    session_start();
    if($vXobReven->ExcluirRevendedorPorCod($Id)){
        $Transacao = [
            "Transcod" => 1,
            "msg" => "Registro Excluido com Sucesso."
        ];
    }
    else{
        $Transacao = [
            "Transcod" => 0,
            "msg" => "Não foi Possivel Excluir este Registro"
        ];
        
    }

    echo json_encode($Transacao);
    
} catch (Exception $e) {
    $Json = $util->convert_from_latin1_to_utf8_recursively('[{"TransCod":0, "msg":"' . $e->getMessage() . '"}]'); // opcional, apenas para teste
    echo json_encode($Json);
}
