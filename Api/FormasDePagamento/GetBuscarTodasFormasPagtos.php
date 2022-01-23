<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache

include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldPgt.php');
$vXobPagtos = new SceCldPgt();
$transacao = array();
$Pagtos = array();
try {

    $listaPagtos = $vXobPagtos->SelecionaTodasFormasPagamento();
    if ($listaPagtos) {
        foreach ($listaPagtos as $pgt) {
            $p = new SceCldPgt();
            $p->Id = $pgt->PGTCOD;
            $p->FormaPagamento = $pgt->PGTDESCRICAO;
            $p->PermiteParcelamento = $pgt->PGTPERMITEPARCELAMENTO;
            $p->QuantidadeParecelas = $pgt->PGTQTDEPARCELAS;
            $p->UsuarioCadastro = $pgt->PGTUSER;
            $p->DataCadastro = $pgt->PGTDATACADASTRO;
            array_push($Pagtos, $p);
        }
    }

    $transacao = [
        "Transcod" => 1,
        "FormasPagtos" => $Pagtos
    ];

    //$Json = $util->convert_from_latin1_to_utf8_recursively($transacao);
    echo json_encode($transacao);
} catch (Exception $e) {
    echo '[{"Transcod":0, "erro":"' . $e->getMessage() . '"}]'; // opcional, apenas para teste
}