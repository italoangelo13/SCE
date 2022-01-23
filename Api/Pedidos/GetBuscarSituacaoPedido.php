<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache





include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldPed.php');
$vXobPedido = new SceCldPed();
$transacao = array();
$Status = null;
$util = new Util();
$Json = null;

try {

    if (isset($_GET)) {

        $Id = $_GET["Id"];

        $listaPedidos = $vXobPedido->selecionarSituacaoPedidoPorCod($Id);

        //PEDIDO
        if ($listaPedidos) {
            foreach ($listaPedidos as $ped) {

                $Status = $ped->PEDSTATUS;
            }
            $transacao = [
                "Transcod" => 1,
                "Pedido" => $Id,
                "Situacao" => $Status
            ];
        }
        else{
            $transacao = [
                "Transcod" => 0,
                "msg" => "Pedido Não encontrado."
            ];
        }

        //$Json = $util->convert_from_latin1_to_utf8_recursively($transacao);
        echo json_encode($transacao);
    }
} catch (Exception $e) {
    echo '[{"TransCod":0, "erro":"' . $e->getMessage() . '"}]'; // opcional, apenas para teste
}
