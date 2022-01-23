<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // limpa o cache
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: false");
header("ccess-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers,access-control-allow-origin,access-control-allow-methods,access-control-allow-credentials");
header("Content-Type: application/json; charset=utf-8");

clearstatcache(); // limpa o cache





include_once('../../Config/ConexaoBD.php');
include_once('../../Config/Util.php');
require_once('../../Models/SceCldPdr.php');
require_once('../../Models/SceCldUsu.php');
$vXobPed = new PedidoRevenda();
$vXobUsu = new SceCldUsu();
$transacao = array();
$Pedidos = array();
$util = new Util();
$Json = null;
$token = null;
$order = null;
try {

    if(isset($_GET["SceToken"])){
        $token = $_GET["SceToken"];
    }

    if(isset($_GET["Order"])){
        $order = $_GET["Order"];
    }


    if(!$token){
        $transacao = [
            "TransCod" => 0,
            "Msg" => "O Token utilizado é inválido."
        ];

        http_response_code(401);
        echo json_encode($transacao);
        exit;
    }
    else{
        if(!$vXobUsu->ValidaTokenUsuario($token)){
            $transacao = [
                "TransCod" => 0,
                "Msg" => "O Token utilizado é inválido."
            ];
    
            http_response_code(401);
            echo json_encode($transacao);
            exit;
        }
    }

    switch ($order) {
        case "1":
            $order = " PDRDATAPEDIDO desc";
            break;

        case "2":
            $order = " PDRDATAPEDIDO asc";
            break;

        case "3":
            $order = " REVCOD asc";
            break;

        case "4":
            $order = " PDRVALORTOTALPEDIDO desc";
            break;

        case "5":
            $order = " PDRVALORTOTALPEDIDO asc";
            break;

        default:
            $order = " PDRDATAPEDIDO desc";
            break;
    }
    

    $listaPedidos = $vXobPed->selecionarTodosPedidosRevenda($order);
    if ($listaPedidos) {
        foreach ($listaPedidos as $ped) {
            $p = new PedidoRevenda();
            $p->Id = $ped->PDRCOD;
            $p->NumeroPedido = $ped->PDRNUMEROPEDIDO;
            $p->CodigoRevendedor = $ped->REVCOD;
            $p->Revendedor = $ped->REVNOMECOMPLETO;
            $datePed = new DateTime($ped->PDRDATAPEDIDO);
            $p->DataPedido = $datePed->format("d/m/Y");
            $dateAcert = new DateTime($ped->PDRDATAACERTO);
            $p->DataAcerto = $dateAcert->format("d/m/Y");
            $dateDev = new DateTime($ped->PDRDATADEVOLUCAO);
            $p->DataDevolucao = $dateDev->format("d/m/Y");
            $p->ValorTotalPedido = FormatarMoeda($ped->PDRVALORTOTALPEDIDO);
            $p->QtdeItensPedido = $ped->PDRQTDEITENSPEDIDO;
            $p->CodigoStatus = $ped->PDRSTATUS;
            switch ($ped->PDRSTATUS) {
                case 'N':
                    $p->Status = "<label class='badge badge-primary'>NOVO</label>";
                    break;
                case 'R':
                    $p->Status = "<label class='badge badge-info'>EM REVENDA</label>";
                    break;
                case 'C':
                    $p->Status = "<label class='badge badge-danger'>CANCELADO</label>";
                    break;
                case 'D':
                    $p->Status = "<label class='badge badge-warning'>PENDENTE DE DEVOLUÇÃO</label>";
                    break;
                case 'A':
                    $p->Status = "<label class='badge badge-warning'>PENDENTE DE ACERTO</label>";
                    break;
                case 'F':
                    $p->Status = "<label class='badge badge-success'>FINALIZADO</label>";
                    break;
                    case 'V':
                        $p->Status = "<label class='badge badge-info'>APROVADO</label>";
                        break;
            }
            $p->UsuarioCadastro = $ped->PDRUSER;
            $p->DataCadastro = $ped->PDRDATCADASTRO;

            array_push($Pedidos, $p);
        }
    }

    $transacao = [
        "TransCod" => 1,
        "Pedidos" => $Pedidos
    ];

    //$Json = $util->convert_from_latin1_to_utf8_recursively($transacao);
    echo json_encode($transacao);
} catch (Exception $e) {
    echo '[{"TransCod":0, "erro":"' . $e->getMessage() . '"}]'; // opcional, apenas para teste
}
