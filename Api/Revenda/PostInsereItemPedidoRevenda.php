<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache






include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldIpr.php');
require_once('../../Models/SceCldPro.php');
require_once('../../Models/SceCldPdr.php');
$vXobItem = new ItensPedidoRevenda();
$vXobProduto = new Produto();
$vXobPedido = new PedidoRevenda();
$util = new Util();
$Json = null;
$Transacao = array();
$subTotal = 0;
$usuario = null;
$TotalPedido= 0;
$QtdePedido = 0;


try {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    $Id = $data->Id;
    $Qtde = $data->Qtde;
    $CodPedido = $data->Pedido;
    if(isset($data->Usuario)){
        $usuario = $data->Usuario;
    }

    $Prod = $vXobProduto->selecionarProdutoPorCod($Id);
    $ExisteItem = $vXobItem->VerificaItemNoPedido($Id,$CodPedido);

    if($ExisteItem){
        $listaQtde = $vXobItem->BuscaQtdeItemPedido($Id,$CodPedido);
        foreach ($listaQtde as $q) {
            $qdteAtualizada = $q->IPRQTDE + $Qtde;
        }
        
        $Qtde = $qdteAtualizada;
    }


    if($Prod[0]->PROPRECOPROMOCIONAL <= 0){
        $subTotal = $Prod[0]->PROPRECOVENDA * $Qtde;
    }
    else{
        $subTotal = $Prod[0]->PROPRECOPROMOCIONAL * $Qtde;
    }

    
    
    session_start();
    $vXobItem->Quantidade = $Qtde;
    $vXobItem->Produto = $Id;
    $vXobItem->SubTotal = $subTotal;
    $vXobItem->PedidoRevenda = $CodPedido;
    if($usuario){
        $vXobItem->UsuarioCadastro = $usuario;
    }
    else{
    $vXobItem->UsuarioCadastro = $_SESSION['User'];
    }

    if ($ExisteItem) {
        $vXobItem->AtualizarItemPedidoRevenda();
    } else {
        $vXobItem->InsereItemPedidoRevenda();
    }
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
        "msg" => "Item Incluido Com Sucesso.",
        "ValorPedido" => $ValorTotalPedido,
        "Quantidade" => $QtdeItensPedido
    ];

        echo json_encode($Transacao);
    
} catch (Exception $e) {
    $Json = $util->convert_from_latin1_to_utf8_recursively('[{"TransCod":0, "msg":"' . $e->getMessage() . '"}]'); // opcional, apenas para teste
    echo json_encode($Json);
}
