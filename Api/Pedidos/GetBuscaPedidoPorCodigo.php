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
$p = new SceCldPed();
try {
    if (isset($_GET)) {

        $Id = $_GET["Id"];
        $listaPedidos = $vXobPed->SelecionarPedidoPorCod($Id);
        if ($listaPedidos) {
                
                $p->Id = $listaPedidos[0]->PEDCOD;
                $p->NumeroPedido = $listaPedidos[0]->PEDNUMEROPEDIDO;
                $p->IdRevendedor = $listaPedidos[0]->REVCOD;
                $p->Revendedor = $listaPedidos[0]->REVNOMECOMPLETO;
                $datePed = new DateTime($listaPedidos[0]->PEDDAT);
                $p->DataPedido = $datePed->format("d/m/Y");
                $p->DataPedidoSemFormatar = $datePed->format("Y-m-d");
                $p->ValorPedido = FormatarMoeda($listaPedidos[0]->PEDVLRPEDIDO);
                $p->QuantidadeItens = $listaPedidos[0]->PEDQTDEITENS;
                $p->CodStatus = $listaPedidos[0]->PEDSTATUS;
                switch ($listaPedidos[0]->PEDSTATUS) {
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
                $p->UsuarioCadastro = $listaPedidos[0]->PEDUSER;
                $p->DataCadastro = $listaPedidos[0]->PEDDATACADASTRO;
                $p->Colaborador = $listaPedidos[0]->COLNOMECOMPLETO;
                $p->IdColaborador = $listaPedidos[0]->COLCOD;
                $p->Cliente = $listaPedidos[0]->CLINOME;
                $p->IdCliente = $listaPedidos[0]->CLICOD;
                $p->CanalVenda = $listaPedidos[0]->CNLDESCRICAO;
                $p->IdCanalVenda = $listaPedidos[0]->CNLCOD;
                $p->TaxaComissao = intval($listaPedidos[0]->PEDTAXACOMISSAO);
                $p->ValorComissao = FormatarMoeda($listaPedidos[0]->PEDVLRCOMISSAO);

        }

        $transacao = [
            "Transcod" => 1,
            "Pedido" => $p
        ];
    }
    //$Json = $util->convert_from_latin1_to_utf8_recursively($transacao);
    echo json_encode($transacao);
} catch (Exception $e) {
    echo '[{"Transcod":0, "erro":"' . $e->getMessage() . '"}]'; // opcional, apenas para teste
}
