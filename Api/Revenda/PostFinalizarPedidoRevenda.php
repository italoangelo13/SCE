<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache

//importando classes
include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldIpr.php');
require_once('../../Models/SceCldPdr.php');
require_once('../../Models/SceCldPed.php');
require_once('../../Models/SceCldIte.php');
require_once('../../Negocio/SceClnPed.php');
require_once('../../Models/SceCldPro.php');
require_once('../../Models/SceCldSdp.php');

//Instanciando os objetos e variaveis
$vXobItemPedidoRevenda = new ItensPedidoRevenda();
$vXobPedidoRevenda = new PedidoRevenda();
$vXobPedido = new SceCldPed();
$vXobItem = new SceCldIte();
$vXobProduto = new Produto();
$NegPedido = new SceClnPed();
$util = new Util();
$Json = null;
$Transacao = array();
$subTotal = 0;
$usuario = null;
$TotalPedido= 0;
$QtdePedido = 0;
$Comissao = null;
//Iniciando Sessão
session_start();

try {

    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    $Id = $data->Id;

    if(isset($data->Usuario)){
        $usuario = $data->Usuario;
    }
    else{
        $usuario = $_SESSION['User'];
    }


    //Buscar Dados Do Pedido de Revenda
    $PedidoRevenda = $vXobPedidoRevenda->selecionarPedidoRevendaPorCod($Id);

    
    //Buscar Qtde Itens Vendidos e vlr Vendido Do Pedido
    $QtdeItensVendidos = $vXobItemPedidoRevenda->selecionarQtdeVendidoPedido($Id);
    $VlrVenda = $vXobItemPedidoRevenda->selecionarValorVendidoPedido($Id);

    $Comissao = $NegPedido->CalculaTaxaVlrComissao($VlrVenda);

    $vXobPedidoRevenda->TaxaComissao = $Comissao["Taxa"];
    $vXobPedidoRevenda->ValorComissao = $Comissao["ValorComissao"];
    $vXobPedidoRevenda->AtualizarTaxaValorComissao();

    if($QtdeItensVendidos == 0){
        $Transacao = [
            "Transcod" => 2,
            "msg" => "Não Encontramos nenhum Item marcado como vendido."
        ];
    
        echo json_encode($Transacao);
        return;
    }

    
    //Inserindo Pedido Na Tabela Central de Pedidos
    $vXobPedido->NumeroPedido = $PedidoRevenda[0]->PDRNUMEROPEDIDO;
    $vXobPedido->CanalVenda = 4; //revenda consignada
    $vXobPedido->Status = 'N';
    $vXobPedido->Revendedor = $PedidoRevenda[0]->REVCOD;
    $vXobPedido->ValorPedido = $VlrVenda;
    $vXobPedido->QuantidadeItens = $QtdeItensVendidos;
    $vXobPedido->UsuarioCadastro = $usuario;
    
    $vXobPedido->TaxaComissao = $Comissao["Taxa"];
    $vXobPedido->ValorComissao = $Comissao["ValorComissao"];

    
    
    if($vXobPedido->InsereNovoPedidoViaRevenda()){
        $CodPedido = $vXobPedido->BuscaUltimoCodPorUser($usuario);

        $vXobItem->Pedido = $CodPedido;
        $vXobItem->UsuarioCadastro = $usuario;
        //Lançando Itens do pedido
        if($vXobItem->InsereItensPedidoViaRevenda($Id)){
            $pdr = new PedidoRevenda();
            $pdr->Id = $Id;
            $pdr->Status = 'F';
            $pdr->AtualizarStatusPedidoRevendaPorCod();


            $produtosVendidos = $vXobItemPedidoRevenda->selecionarItensVendidosPedidoRevendaParaFaturamentoPorCodigoPedido($Id);

            foreach ($produtosVendidos as $pv) {
                $prod = new Produto();
                $spd = new SceCldSdp();
                $prod->AtualizaQtdeSaidaEstoquePorCod($pv->PROCOD,$pv->IPRQTDE);
                $prod->AtualizaStatusSaidaEstoquePorCod($pv->PROCOD);

                
                $spd->Produto = $pv->PROCOD;
                $spd->Quatidade = $pv->IPRQTDE;
                $spd->TipoSaidaProduto = 2;
                $spd->DataSaida = date("Y-m-d");
                $spd->Pedido = $Id;
                $spd->UsuarioCadastro = $_SESSION["User"];
                $spd->InsereSaidaDeProduto();
            }

            $Transacao = [
                "Transcod" => 1,
                "msg" => "Este Pedido de Revenda Foi Finalizado com sucesso. \n Foi Gerado um novo Pedido Pendente de Faturamento na tela de Pedidos, Favor Verificar.",
                "Pedido" => $CodPedido
            ];
        }
        else{
            $vXobPedido->DeletaPedidoPorCod($CodPedido);
            $Transacao = [
                "Transcod" => 2,
                "msg" => "Não foi Possivel finalizar este pedido no momento, Tente novamente mais tarde."
            ];
        
            echo json_encode($Transacao);
            return;
        }
    }
    else{
        $Transacao = [
            "Transcod" => 2,
            "msg" => "Não foi Possivel finalizar este pedido no momento, Tente novamente mais tarde."
        ];
    
        echo json_encode($Transacao);
        return;
    }


    

    echo json_encode($Transacao);
    
} catch (Exception $e) {
    $Json = $util->convert_from_latin1_to_utf8_recursively('[{"TransCod":0, "msg":"' . $e->getMessage() . '"}]'); // opcional, apenas para teste
    echo json_encode($Json);
}
