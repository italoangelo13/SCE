<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("ccess-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers,access-control-allow-origin,access-control-allow-methods,access-control-allow-credentials");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache






include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
include_once('../../Models/SceCldUsu.php');
$vxobUsu = new SceCldUsu();
$util = new Util();
$Descricao = null;
$Tipo = null;
$Json = null;
$Transacao = array();

try {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
        $Usuario = strtoupper($data->Usuario);
        $Senha = $data->Senha;

   

    session_start();
    $vxobUsu->usuario = $Usuario;
    $vxobUsu->senha = $Senha;
    $retorno = $vxobUsu->AutenticarUsuario();
    
    if($retorno["Autenticado"]){
        $Transacao = $retorno;
    }
    else{
        $Transacao = [
            "Autenticado" => false
        ];
    }

    echo json_encode($Transacao);
    
} catch (Exception $e) {
    $Json = $util->convert_from_latin1_to_utf8_recursively('[{"TransCod":0, "msg":"' . $e->getMessage() . '"}]'); // opcional, apenas para teste
    echo json_encode($Json);
}
