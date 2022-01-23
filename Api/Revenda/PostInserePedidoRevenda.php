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
$Json = null;
$Transacao = array();


try {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    $NumPedido = $vXobPedido->GeraNumeroPedidoRevenda();
    $Revendedor = $data->Revend;
    $DataPedido = $data->DataPed;
    $DataAcerto = $data->DataAcert;
    $DataDevolucao = $data->DataDev;

    
    
    session_start();
    $vXobPedido->NumeroPedido = $NumPedido;
    $vXobPedido->Revendedor = $Revendedor;
    $vXobPedido->DataPedido = $DataPedido;
    $vXobPedido->DataAcerto = $DataAcerto;
    $vXobPedido->DataDevolucao = $DataDevolucao;
    $vXobPedido->UsuarioCadastro = $_SESSION['User'];
    if ($vXobPedido->InserePedidoRevenda()) {
        $ultimoCod = $vXobPedido->BuscaUltimoCodPorUser();
        $Transacao = [
            "Transcod" => 1,
            "msg" => "Registro cadastrado com sucesso.",
            "Id" => $ultimoCod,
            "NumPedido" => $NumPedido,
            "Acao" => 1 //Insert
        ];
        
    } else {
        $Transacao = [
            "Transcod" => 2,
            "msg" => "Não foi Possivel Cadastrar este Registro."
        ];
    }

        echo json_encode($Transacao);
    
} catch (Exception $e) {
    $Json = $util->convert_from_latin1_to_utf8_recursively('[{"TransCod":0, "msg":"' . $e->getMessage() . '"}]'); // opcional, apenas para teste
    echo json_encode($Json);
}
