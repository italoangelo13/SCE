<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache





include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldCrt.php');
$vxobCrt = new SceCldCrt();
$util = new Util();
$Json = null;
$Pesquisa = null;
$transacao = null;
$Carteiras = array();

try {
    if (isset($_GET["Pesq"])) {
        $Pesquisa = $_GET["Pesq"];
    }

    if ($Pesquisa) {
        $listaCarteiras = $vxobCrt->selecionarTodasCarteirasAutoComplete($Pesquisa);
    } else {
        $listaCarteiras = $vxobCrt->selecionarTodasCarteiras();
    }

    if ($listaCarteiras) {
        foreach ($listaCarteiras as $crt) {
            $c = new SceCldCrt();
            $c->Id = $crt->CRTCOD;
            $c->Descricao = $crt->CRTDESCRICAO;
            $c->Saldo = $crt->CRTSALDOATUAL;
            array_push($Carteiras, $c);
        }
    }

    $transacao = [
        "Transcod" => 1,
        "Carteiras" => $Carteiras
    ];


    ////$Json = $util->convert_from_latin1_to_utf8_recursively($Json);
    echo json_encode($transacao);
} catch (Exception $e) {
    echo '[{"TransCod":0, "erro":"' . $e->getMessage() . '"}]'; // opcional, apenas para teste
}
