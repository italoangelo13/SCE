<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache






include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldRev.php');
$vXobReven = new Revendedores();
$util = new Util();
$Transacao = array();
try {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    $Id = $data->Id;
    $Nome = strtoupper($data->Nome);
    $Cpf = $data->Cpf;
    $Rg = $data->Rg;
    $DataInicioContrato = $data->DataInicioContrato;
    $Endereco = $data->Endereco;
    $Bairro = $data->Bairro;
    $Municipio = $data->Municipio;
    $Uf = $data->Uf;
    $Cep = $data->Cep;
    $Telefone = $data->Telefone;


    //Trata CPF
    $Cpf = str_replace(".", "", $Cpf);
    $Cpf = str_replace("-", "", $Cpf);

    //Trata Cep
    $Cep = str_replace("-", "", $Cep);

    //Trata telefone
    $Telefone = str_replace("(", "", $Telefone);
    $Telefone = str_replace(")", "", $Telefone);
    $Telefone = str_replace("-", "", $Telefone);
    $Telefone = str_replace(" ", "", $Telefone);

   

    session_start();
    $vXobReven->Id = $Id;
    $vXobReven->Nome = $Nome;
    $vXobReven->CpfCnpj = $Cpf;
    $vXobReven->RG = $Rg;
    $vXobReven->DataInicioContrato = $DataInicioContrato;
    $vXobReven->Endereco = $Endereco;
    $vXobReven->Bairro = $Bairro;
    $vXobReven->Cidade = $Municipio;
    $vXobReven->UF = $Uf;
    $vXobReven->Cep = $Cep;
    $vXobReven->Telefone = $Telefone;
    $vXobReven->UsuarioCadastro = $_SESSION['User'];
    if($vXobReven->AtualizaRevendedorPorCod()){
        $Transacao = [
            "Transcod" => 1,
            "msg" => "Registro Atualizado com Sucesso.",
            "Acao" => 2 //Update
        ];
        
    }
    else{
        $Transacao = [
            "Transcod" => 0,
            "msg" => "Não foi possivel atualizar este registro."
        ];
    }

    echo json_encode($Transacao);
    
} catch (Exception $e) {
    $Json = $util->convert_from_latin1_to_utf8_recursively('[{"TransCod":0, "msg":"' . $e->getMessage() . '"}]'); // opcional, apenas para teste
    echo json_encode($Json);
}
