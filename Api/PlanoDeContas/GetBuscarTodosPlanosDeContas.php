<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache





include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldPdc.php');
$Planos = new SceCldPdc();
$util = new Util();
$Json = null;
$Pesquisa = null;
$transacao = null;
$PlanosContas = array();

try {
    if (isset($_GET["Pesq"])) {
        $Pesquisa = $_GET["Pesq"];
    }

    if ($Pesquisa) {
        $listaplanos = $Planos->selecionarTodosPlanosDeContasAutoComplete($Pesquisa);
    } else {
        $listaplanos = $Planos->selecionarTodosPlanosDeContas();
    }

    if ($listaplanos) {
        foreach ($listaplanos as $pgt) {
            $p = new SceCldPdc();
            $p->Id = $pgt->PDCCOD;
            $p->Descricao = $pgt->PDCDESCRICAO;
            $p->Tipo = $pgt->TPCDESCRICAO;
            array_push($PlanosContas, $p);
        }
    }

    $transacao = [
        "Transcod" => 1,
        "PlanoContas" => $PlanosContas
    ];


    ////$Json = $util->convert_from_latin1_to_utf8_recursively($Json);
    echo json_encode($transacao);
} catch (Exception $e) {
    echo '[{"TransCod":0, "erro":"' . $e->getMessage() . '"}]'; // opcional, apenas para teste
}
