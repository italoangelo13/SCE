<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache






include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldIpr.php');
$vXobItens = new ItensPedidoRevenda();
$util = new Util();
$Transacao = array();
try {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    $Id = $data->Id;
    $Status = $data->Status;



    session_start();
    $vXobItens->PedidoRevenda = $Id;
    if($vXobItens->AtualizarTodosItensVendidosPorCodigoPedido($Status)){
        $Transacao = [
            "Transcod" => 1,
            "msg" => "Registros Atualizado com Sucesso.",
            "Acao" => 2 //Update
        ];
        
    }
    else{
        $Transacao = [
            "Transcod" => 0,
            "msg" => "Não foi possivel atualizar este registro."
        ];
    }

    echo json_encode($Transacao);
    
} catch (Exception $e) {
    $Json = $util->convert_from_latin1_to_utf8_recursively('[{"TransCod":0, "msg":"' . $e->getMessage() . '"}]'); // opcional, apenas para teste
    echo json_encode($Json);
}
