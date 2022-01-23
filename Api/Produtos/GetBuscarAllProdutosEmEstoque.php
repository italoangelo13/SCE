<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache





include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldPro.php');
$vXobPro = new Produto();
$transacao = array();
$Produtos = array();
$util = new Util();
$Json = null;

try {

    $listaProdutos = $vXobPro->selecionarTodosProdutosEmEstoque();
    if ($listaProdutos) {
        foreach ($listaProdutos as $pro) {
            $p = new Produto();
            $p->Id = $pro->PROCOD;
            $p->Produto = $pro->PRONOME;
            $p->SKU = $pro->PROSKU;
            $p->PrecoVenda = FormatarMoeda($pro->PROPRECOVENDA);
            $p->PrecoPromocional = FormatarMoeda($pro->PROPRECOPROMOCIONAL);
            $p->Imagem = $pro->PROIMG;
            $p->StatusEstoque = $pro->STATUSESTOQUE;
            $p->QuatidadeEstoque = intval($pro->PROQTDESTOQUE);
            $p->StatusSite = $pro->PROSTATUSSITE;
            $p->Categoria = strtoupper($pro->PROCATEGORIA);

            array_push($Produtos, $p);
        }
    }

    $transacao = [
        "TransCod" => 1,
        "Produtos" => $Produtos
    ];

    //$Json = $util->convert_from_latin1_to_utf8_recursively($transacao);
    echo json_encode($transacao);
} catch (Exception $e) {
    echo '[{"TransCod":0, "erro":"' . $e->getMessage() . '"}]'; // opcional, apenas para teste
}
