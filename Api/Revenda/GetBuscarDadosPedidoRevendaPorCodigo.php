<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache





include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldPdr.php');
require_once('../../Models/SceCldIpr.php');
$vXobPedido = new PedidoRevenda();
$vXobItens = new ItensPedidoRevenda();
$transacao = array();
$PedidosRevenda = array();
$ItensPedido = array();
$util = new Util();
$Json = null;

try {

    if (isset($_GET)) {

        $Id = $_GET["Id"];

        $listaPedidos = $vXobPedido->selecionarPedidoRevendaPorCod($Id);
        $listaItens = $vXobItens->selecionarItensPedidoRevendaPorCodigoPedido($Id);

        //PEDIDO
        foreach ($listaPedidos as $ped) {
            $dataPedido = new DateTime($ped->PDRDATAPEDIDO);
            $dataAcerto = new DateTime($ped->PDRDATAACERTO);
            $dataDevolucao = new DateTime($ped->PDRDATADEVOLUCAO);


            $p = new PedidoRevenda();
            $p->Id = $ped->PDRCOD;
            $p->CodigoRevendedor = $ped->REVCOD;
            $p->Revendedor = $ped->REVNOMECOMPLETO;
            $p->NumeroPedido = $ped->PDRNUMEROPEDIDO;
            $p->DataPedido = $dataPedido->format('Y-m-d');
            $p->DataAcerto = $dataAcerto->format('Y-m-d');
            $p->DataDevolucao = $dataDevolucao->format('Y-m-d');
            $p->ValorTotalPedido = FormatarMoeda($ped->PDRVALORTOTALPEDIDO);
            $p->QtdeItensPedido = $ped->PDRQTDEITENSPEDIDO;
            switch ($ped->PDRSTATUS) {
                case 'N':
                    $p->Status = 'NOVO';
                    break;
                case 'R':
                    $p->Status = "EM REVENDA";
                    break;
                    case 'V':
                        $p->Status = "APROVADO";
                        break;
                case 'C':
                    $p->Status = "CANCELADO";
                    break;
                case 'D':
                    $p->Status = "PENDENTE DE DEVOLUÇÃO";
                    break;
                case 'A':
                    $p->Status = "PENDENTE DE ACERTO";
                    break;
                case 'F':
                    $p->Status = 'FINALIZADO';
                    break;
            }

            array_push($PedidosRevenda, $p);
        }

        //ITENS
        if ($listaItens) {
            foreach ($listaItens as $ite) {
                $i = new ItensPedidoRevenda();
                $i->Id = $ite->IPRCOD;
                $i->Produto = $ite->PRONOME;
                $i->Quantidade = $ite->IPRQTDE;
                $i->SubTotal = FormatarMoeda($ite->IPRSUBTOTAL);
                $i->PrecoVenda = FormatarMoeda($ite->PROPRECOVENDA);
                $i->PrecoPromocional = FormatarMoeda($ite->PROPRECOPROMOCIONAL);
                $i->Imagem = $ite->PROIMG;
                $i->SKU = $ite->PROSKU;

                array_push($ItensPedido, $i);
            }
        }

        $transacao = [
            "TransCod" => 1,
            "PedidoRevenda" => [
                "Pedido" => $PedidosRevenda,
                "Itens" => $ItensPedido
            ]
        ];

        //$Json = $util->convert_from_latin1_to_utf8_recursively($transacao);
        echo json_encode($transacao);
    }
} catch (Exception $e) {
    echo '[{"TransCod":0, "erro":"' . $e->getMessage() . '"}]'; // opcional, apenas para teste
}
