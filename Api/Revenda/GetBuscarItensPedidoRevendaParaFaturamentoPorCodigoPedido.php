<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache





include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldIpr.php');
$vXobItens = new ItensPedidoRevenda();
$transacao = array();
$ItensPedido = array();
$util = new Util();
$Json = null;

try {

    if (isset($_GET)) {

        $Id = $_GET["Id"];

        $listaItens = $vXobItens->selecionarItensPedidoRevendaParaFaturamentoPorCodigoPedido($Id);
        $vXavQtdeVenda = $vXobItens->selecionarQtdeVendidoPedido($Id);
        $vXavVlrVenda = $vXobItens->selecionarValorVendidoPedido($Id);

        $vXavVlrVenda = FormatarMoeda($vXavVlrVenda);

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

                if($ite->PROIMG != null){
                    $i->Imagem = $ite->PROIMG;
                }
                else{
                    $i->Imagem = "../../assets/img/sem-foto.gif";
                }
                
                $i->SKU = $ite->PROSKU;

                array_push($ItensPedido, $i);
            }
        }

        $transacao = [
            "TransCod" => 1,
            "QtdeVendido" => $vXavQtdeVenda,
            "VlrVendido" => $vXavVlrVenda,
            "Itens" => $ItensPedido
        ];

        //$Json = $util->convert_from_latin1_to_utf8_recursively($transacao);
        echo json_encode($transacao);
    }
} catch (Exception $e) {
    echo '[{"Transcod":0, "erro":"' . $e->getMessage() . '"}]'; // opcional, apenas para teste
}
