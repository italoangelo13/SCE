<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache

include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldIte.php');
$vXobIte = new SceCldIte();
$util = new Util();
$transacao = array();
$Itens = array();
try {
    if (isset($_GET)) {

        $Id = $_GET["Id"];
        $listaItens = $vXobIte->SelecionaTodosItensPedido($Id);
        if ($listaItens) {
            foreach ($listaItens as $ped) {
                $p = new SceCldIte();
                $p->Id = $ped->ITECOD;
                $p->Produto = $ped->PRONOME;
                $p->Quantidade = $ped->ITEQTDE;
                $p->ValorUnitario = FormatarMoeda($ped->ITEVLRUNITARIO);
                $p->SKU = $ped->PROSKU;
                $p->ValorTotal = FormatarMoeda($ped->ITEVLRTOTAL);
                
                array_push($Itens, $p);
            }
        }

        $transacao = [
            "Transcod" => 1,
            "Itens" => $Itens
        ];
    }
    //$Json = $util->convert_from_latin1_to_utf8_recursively($transacao);
    echo json_encode($transacao);
} catch (Exception $e) {
    echo '[{"Transcod":0, "erro":"' . $e->getMessage() . '"}]'; // opcional, apenas para teste
}
