<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache






include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldCli.php');
$vxobCli = new SceCldCli();
$util = new Util();
$Json = null;
$Pesquisa = null;
$transacao = null;
$Clientes = array();

try {
    if (isset($_GET["Pesq"])) {
        $Pesquisa = $_GET["Pesq"];
    }

    if ($Pesquisa) {
        $listaClientes = $vxobCli->SelecionarClientes($Pesquisa);
    } else {
        $listaClientes = $vxobCli->SelecionarClientes();
    }

    if ($listaClientes) {
        foreach ($listaClientes as $cli) {
            $c = new SceCldCli();
            $c->Id = $cli->CLICOD;
            $c->Nome = $cli->CLINOME;
            $c->Cpf = $cli->CLICPF;
            array_push($Clientes, $c);
        }
    }

    $transacao = [
        "Transcod" => 1,
        "Clientes" => $Clientes
    ];


    ////$Json = $util->convert_from_latin1_to_utf8_recursively($Json);
    echo json_encode($transacao);
} catch (Exception $e) {
    echo '[{"TransCod":0, "erro":"' . $e->getMessage() . '"}]'; // opcional, apenas para teste
}
