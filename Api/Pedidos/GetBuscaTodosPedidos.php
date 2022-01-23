<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache

include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldPed.php');
$vXobPed = new SceCldPed();
$util = new Util();
$transacao = array();
$Pedidos = array();
try {

    $listaPedidos = $vXobPed->SelecionarTodosPedidos();
    if ($listaPedidos) {
        foreach ($listaPedidos as $ped) {
            $p = new SceCldPed();
            $p->Id = $ped->PEDCOD;
            $p->NumeroPedido = $ped->PEDNUMEROPEDIDO;
            $p->IdRevendedor = $ped->REVCOD;
            $p->Revendedor = $ped->REVNOMECOMPLETO;
            $datePed = new DateTime($ped->PEDDAT);
            $p->DataPedido = $datePed->format("d/m/Y");
            $p->ValorPedido = FormatarMoeda($ped->PEDVLRPEDIDO);
            $p->QuantidadeItens = $ped->PEDQTDEITENS;
            $p->CodStatus = $ped->PEDSTATUS;
            switch ($ped->PEDSTATUS) {
                case 'N':
                    $p->Status = "<label class='badge badge-primary'>NOVO</label>";
                    break;
                case 'C':
                    $p->Status = "<label class='badge badge-danger'>CANCELADO</label>";
                    break;
                case 'F':
                    $p->Status = "<label class='badge badge-success'>Faturado</label>";
                    break;
                    case 'P':
                        $p->Status = "<label class='badge badge-warning'>Processado</label>";
                        break;
            }
            $p->UsuarioCadastro = $ped->PEDUSER;
            $p->DataCadastro = $ped->PEDDATACADASTRO;
            $p->Colaborador = $ped->COLNOMECOMPLETO;
            $p->IdColaborador = $ped->COLCOD;
            $p->Cliente = $ped->CLINOME;
            $p->IdCliente = $ped->CLICOD;
            $p->CanalVenda = $ped->CNLDESCRICAO;
            $p->IdCanalVenda = $ped->CNLCOD;
            $p->TaxaComissao = $ped->PEDTAXACOMISSAO;
            $p->ValorComissao = FormatarMoeda($ped->PEDVLRCOMISSAO);

            array_push($Pedidos, $p);
        }
    }

    $transacao = [
        "Transcod" => 1,
        "Pedidos" => $Pedidos
    ];

    //$Json = $util->convert_from_latin1_to_utf8_recursively($transacao);
    echo json_encode($transacao);
} catch (Exception $e) {
    echo '[{"Transcod":0, "erro":"' . $e->getMessage() . '"}]'; // opcional, apenas para teste
}