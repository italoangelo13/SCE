<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache






include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldPdr.php');
$vXobPedido = new PedidoRevenda();
$util = new Util();
$Transacao = array();
$qtde = 1;
try {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    $Id = $data->Id;
    $Status = strtoupper($data->Status);

    if ($Status == 'R') {
        $objQtde = $vXobPedido->SelecionarVlrTotalEQtdePedido($Id);
        $qtde = $objQtde[0]->QTDE;
    }

    session_start();
    $vXobPedido->Id = $Id;
    $vXobPedido->Status = $Status;
    if ($qtde <= 0) {
        $Transacao = [
            "Transcod" => 0,
            "msg" => "Não Há Itens em Seu Pedido. Insira Alguns Itens antes de envia-lo para Revenda."
        ];
    } else {
        if ($vXobPedido->AtualizarStatusPedidoRevendaPorCod()) {
            $Transacao = [
                "Transcod" => 1,
                "msg" => "Registro Atualizado com Sucesso.",
                "Acao" => 2 //Update
            ];
        } else {
            $Transacao = [
                "Transcod" => 0,
                "msg" => "Não foi possivel atualizar este registro."
            ];
        }
    }

    echo json_encode($Transacao);
} catch (Exception $e) {
    $Json = $util->convert_from_latin1_to_utf8_recursively('[{"TransCod":0, "msg":"' . $e->getMessage() . '"}]'); // opcional, apenas para teste
    echo json_encode($Json);
}
