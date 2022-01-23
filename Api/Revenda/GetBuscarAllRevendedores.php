<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache





include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldRev.php');
$vXobRevend = new Revendedores();
$transacao = array();
$revendedores = array();
$util = new Util();
$Json = null;

try {

    $listaRevendedores = $vXobRevend->selecionarTodosRevendedores();

    foreach ($listaRevendedores as $rev) {
        $r = new Revendedores();
        $r->Id = $rev->REVCOD;
        $r->Nome = $rev->REVNOMECOMPLETO;
        $r->Endereco = $rev->REVENDERECO;
        $r->Bairro = $rev->REVBAIRRO;
        $r->Cidade = $rev->REVMUNICIPIO;
        $r->UF = $rev->REVUF;
        $r->Cep = $rev->REVCEP;
        $r->CpfCnpj = $rev->REVCPFCNPJ;
        $r->Telefone = $rev->REVTELEFONE;
        $r->RG = $rev->REVRG;
        $r->UsuarioCadastro = $rev->REVUSER;
        $r->DataCadastro = $rev->REVDATCADASTRO;
        $r->DataInicioContrato = $rev->REVDATAINICIOCONTRATO;

        array_push($revendedores,$r);
    }

    $transacao = [
        "TransCod" => 1,
        "Revendedores" => $revendedores
    ];
    
        //$Json = $util->convert_from_latin1_to_utf8_recursively($transacao);
        echo json_encode($transacao);
    
} catch (Exception $e) {
    echo '[{"TransCod":0, "erro":"' . $e->getMessage() . '"}]'; // opcional, apenas para teste
}
