<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache






include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldIpr.php');
require_once('../../Models/SceCldPdr.php');
$vXobItem = new ItensPedidoRevenda();
$vXobPedido = new PedidoRevenda();
$util = new Util();
$Transacao = array();
$QtdePedido = 0;
$TotalPedido = 0;

try {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    $Id = strtoupper($data->Id);
    $CodPedido = strtoupper($data->CodPedido);

    session_start();
    if($vXobItem->ExcluirItemPorCod($Id)){
        $VlrQtdePedido = $vXobPedido->SelecionarVlrTotalEQtdePedido($CodPedido);

        if($VlrQtdePedido[0]->QTDE == NULL){
            $QtdePedido = 0;
        }
        else{
            $QtdePedido = $VlrQtdePedido[0]->QTDE;
        }
    
        if($VlrQtdePedido[0]->VLRTOTAL == NULL){
            $TotalPedido = 0;
        }
        else{
            $TotalPedido = $VlrQtdePedido[0]->VLRTOTAL;
        }
    
        $vXobPedido->AtualizarValorEQuantidadePedidoPorCodigo($CodPedido, $TotalPedido, $QtdePedido);
    
        $ValorTotalPedido = FormatarMoeda($TotalPedido);
        $QtdeItensPedido = $QtdePedido;
    
        $Transacao = [
            "Transcod" => 1,
            "msg" => "Item Excluido Com Sucesso.",
            "ValorPedido" => $ValorTotalPedido,
            "Quantidade" => $QtdeItensPedido
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
