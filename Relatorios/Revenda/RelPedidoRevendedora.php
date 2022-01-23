<?php
require_once("../../Config/ConexaoBD.php");
require_once("../../Models/SceCldPdr.php");
require_once("../../Models/SceCldIpr.php");
require_once("../../Models/SceCldRev.php");
require_once  '../../vendor/autoload.php';

$CodPedido = null;

if (isset($_GET["Pedido"])) {
    $CodPedido = $_GET["Pedido"];
}


if ($CodPedido) {
    date_default_timezone_set('America/Sao_Paulo');
    $stylesheet = file_get_contents('../assets/bootstrap/css/bootstrap.css');

    $pdr = new PedidoRevenda();
    $ipr = new ItensPedidoRevenda();
    $rev = new Revendedores();

    $vXobPedido = new PedidoRevenda();
    $vXobRevendedor = new Revendedores();

    $DadosPedido = $pdr->selecionarPedidoRevendaPorCod($CodPedido);
    $listaItensPedido = $ipr->selecionarItensPedidoRevendaPorCodigoPedido($CodPedido);

    foreach ($DadosPedido as $p) {

        $dataPedido = new DateTime($p->PDRDATAPEDIDO);
        $dataAcerto = new DateTime($p->PDRDATAACERTO);
        $dataDevolucao = new DateTime($p->PDRDATADEVOLUCAO);

        $vXobPedido->Id = $p->PDRCOD;
        $vXobPedido->NumeroPedido = $p->PDRNUMEROPEDIDO;
        $vXobPedido->CodigoRevendedor = $p->REVCOD;
        $vXobPedido->Revendedor = $p->REVNOMECOMPLETO;
        $vXobPedido->DataPedido = $dataPedido->format('d/m/Y');
        $vXobPedido->UsuarioCadastro = $p->PDRUSER;
        $vXobPedido->DataCadastro = $p->PDRDATCADASTRO;
        $vXobPedido->DataDevolucao = $dataDevolucao->format('d/m/Y');
        $vXobPedido->DataAcerto = $dataAcerto->format('d/m/Y');
        $vXobPedido->ValorTotalPedido = FormatarMoeda($p->PDRVALORTOTALPEDIDO);
        $vXobPedido->QtdeItensPedido = $p->PDRQTDEITENSPEDIDO;
        $vXobPedido->Status = $p->PDRSTATUS;
    }

    $dadosRevendedor = $rev->selecionarRevendedorPorCod($vXobPedido->CodigoRevendedor);

    foreach ($dadosRevendedor as $r) {

        $vXobRevendedor->Id = $r->REVCOD;
        $vXobRevendedor->Nome = $r->REVNOMECOMPLETO;
        $vXobRevendedor->Endereco = $r->REVENDERECO;
        $vXobRevendedor->Bairro = $r->REVBAIRRO;
        $vXobRevendedor->Cidade = $r->REVMUNICIPIO;
        $vXobRevendedor->UF = $r->REVUF;
        $vXobRevendedor->Cep = $r->REVCEP;
        $vXobRevendedor->Telefone = $r->REVTELEFONE;
        $vXobRevendedor->CpfCnpj = $r->REVCPFCNPJ;
        $vXobRevendedor->RG = $r->REVRG;
        $vXobRevendedor->DataCadastro = $r->REVDATCADASTRO;
        $vXobRevendedor->UsuarioCadastro = $r->REVUSER;
        $vXobRevendedor->DataInicioContrato = $r->REVDATAINICIOCONTRATO;
    }

    $dataHoraAtual = date("d/m/Y \á\s\ H:i:s");


    $html = '
<!DOCTYPE html>
<html lang="en">
<head>
	<style>
		.linha-alt{
			background: #F5F5F5;
		}

        @page {
            margin-left: 5mm;
            margin-right: 5mm;
            margin-header:5mm;
            header: myheader;
            footer: myfooter;
            
        }
	</style>
</head>
<body>
<!--mpdf
<htmlpageheader name="myheader">
<table width="100%" style="border: 1px solid #000" >
		<tr>
			<td width="30%" style="text-align:center;border-right:1px solid #000">
				<div>
				<img src="../../assets/img/logo.png" width="150px">
				</div>
			</td>
			<td width="50%" style="text-align:center; border-right:1px solid #000">
				<div >
					<h2>Pedido De Revenda</h2>
				</div>
				<div >
					<h4>Aninha Faria Semijoias</h4>
					<br>
				</div>
				<div>
					<h5>Rua Dezessete de julho, 34 C, Nossa Senhora do Ó, Sabará - MG, 34515-266</h5> 
				</div>
				<div>
					<h6>(31) 99576-0071</h6> 
				</div>
				<div>
					<h6>contato@aninhafariasemijoias.com.br</h6> 
				</div>
				<div>
					<h6>www.aninhafariasemijoias.com.br</h6> 
				</div>
			</td>
            <td width="20%" style="text-align:center">
                <div>
                    <h4>Data Pedido</h4>
                </div>
                <div>
                    <span>' . $vXobPedido->DataPedido . '</span>
                      
                </div>
                <br>  
                <div>
                    <h4>Nº do Pedido</h4>
                </div>
                <div>
                    <span>' . $vXobPedido->NumeroPedido . '</span>
                </div>
            </td>
		</tr>
	</table>
</htmlpageheader>
<htmlpagefooter name="myfooter">
<table width="100%">
    <tr>
        <td style="text-align: left;">
            SCE - Sistema de Controle Empresarial
            <br>
            Licenciado Para <strong>Aninha Faria Semijoias</strong>
        </td>
        <td style="text-align: right;">
            <h6>ROTTINA - Transformação Digital</h6>
        </td>
    </tr>
	<tr>
        <td style="font-size: 9pt;padding-top: 3mm; ">
			Pagina {PAGENO} de {nb}
        </td>
        <td style="font-size: 9pt;padding-top: 3mm; text-align: right; ">
			Emitido em ' . $dataHoraAtual . '
        </td>
    </tr>
</table>
</htmlpagefooter>

mpdf-->
<br>
	<table style="width: 100%; border:1px solid #000">
		<tr>
			<td style="width: 50%;">
				<div>
					<strong>Codigo:</strong>
					<span>' . $vXobRevendedor->Id . '</span>
				</div>
                <div>
					<strong>Endereço:</strong>
					<span>' . $vXobRevendedor->Endereco . '</span>
				</div>
                <div>
					<strong>Cidade:</strong>
					<span>' . $vXobRevendedor->Cidade . '</span>
				</div>
                <div>
					<strong>Cep:</strong>
					<span>' . $vXobRevendedor->Cep . '</span>
				</div>
                <div>
					<strong>CPF/CNPJ:</strong>
					<span>' . $vXobRevendedor->CpfCnpj . '</span>
				</div>
			</td>
			<td style="width: 50%;">
				<div>
					<strong>Revendedora:</strong>
					<span>' . $vXobRevendedor->Nome . '</span>
				</div>
                <div>
					<strong>Bairro:</strong>
					<span>' . $vXobRevendedor->Bairro . '</span>
				</div>
                <div>
					<strong>UF:</strong>
					<span>' . $vXobRevendedor->UF . '</span>
				</div>
                <div>
					<strong>Telefone:</strong>
					<span>' . $vXobRevendedor->Telefone . '</span>
				</div>
                <div>
					<strong>RG:</strong>
					<span>' . $vXobRevendedor->RG . '</span>
				</div>
			</td>
		</tr>
	</table>
<br>

<table>
        <tr>
            <td>Aos Cuidados do(a) Sr(a): ____________________________________________________________________</td>
        </tr>
        <tr>
            <td>Segue abaixo os itens Solicitados do Pedido.</td>
        </tr>
</table>

<br>
<table width="100%" style="border: 1px solid #000; text-align:center;">
    <thead>
		<tr style=" background-color:#263548">
        <th style="width:10%; color:#e8ac60;">Codigo</th>
        <th style="width:30%; color:#e8ac60;">Produto</th>
        <th style="width:10%; color:#e8ac60;">Vlr Unitario</th>
        <th style="width:15%; color:#e8ac60;">Vlr Promocional</th>
        <th style="width:8%; color:#e8ac60;">Qtde</th>
        <th style="width:10%; color:#e8ac60;">Sub-Total</th>
		</tr>
    </thead>
    <tbody>';
    if ($listaItensPedido) {
        $ctrlLinha = true;
        foreach ($listaItensPedido as $i) {
            if (!$ctrlLinha) {
                $html .= '<tr class="linha-alt">';
            } else {
                $html .= '<tr>';
            }
            $html .= '
                        <th style="">' . $i->PROSKU . '</th>
                        <th style="">' . $i->PRONOME . '</th>
                        <th style="">R$ ' . FormatarMoeda($i->PROPRECOVENDA) . '</th>
                        <th style="">R$ ' . FormatarMoeda($i->PROPRECOPROMOCIONAL) . '</th>
                        <th style="">' . $i->IPRQTDE . '</th>
                        <th style="">R$ ' . FormatarMoeda($i->IPRSUBTOTAL) . '</th>
                    </tr>';

            if ($ctrlLinha) {
                $ctrlLinha = false;
            } else {
                $ctrlLinha = true;
            }
        }
    } else {
        $html .= '<tr >
        <td style="text-align:center;">NENHUM ITEM ENCONTRADO PARA ESTE PEDIDO.</td>
        </tr>';
    }


    $html .= '  </tbody>
    
</table>




<pagebreak />


<br>
<br>
<table style="width:100%; vertical-align:top;">
	<tr>
		<td style="width:65%; height:250px; border: #000 1px solid">
			<strong>Observações</strong>
		</td>
		<td style="border: #000 1px solid">
            <table>
                <tr>
                    <td style="width:40%;"><h4>Valor Pedido:</h4></td>
                    <td style="width:60%; text-align: right;"><span>R$ ' . $vXobPedido->ValorTotalPedido . '</span></td>
                </tr>
                <tr>
                    <td style="width:40%;"><h4>Quantidade:</h4></td>
                    <td style="width:60%; text-align: right;"><span>' . $vXobPedido->QtdeItensPedido . '</span></td>
                </tr>
                <tr>
                    <td style="width:40%;"><h4>Data Acerto:</h4></td>
                    <td style="width:60%; text-align: right;"><span>' . $vXobPedido->DataAcerto . '</span></td>
                </tr>
                <tr>
                    <td style="width:50%;"><h4>Data Devolução:</h4></td>
                    <td style="width:50%; text-align: right;"><span>' . $vXobPedido->DataDevolucao . '</span></td>
                </tr>
            </table>
        </td>
	</tr>
</table>


<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<table style="width:100%; text-align: center;">
	<tr>
		<td style="width:50%;">
			<div >
                ____________________________________________
            </div>
            <div ><h5>'.
                $vXobRevendedor->Nome
            .'</h5></div>
            <div >
                <h6>Revendedor(a) Aninha Faria Semijoias</h6>
            </div>
		</td>
		<td style="width:50%;">
			<div >
            ____________________________________________
            </div>
            <div >
                <h5>ANA MARIA DE FARIA SANTOS</h5>
            </div>
            <div>
                <h6>CEO Aninha Faria Semijoias</h6>
            </div>
		</td>
	</tr>
</table>

</body>
</html>
';


    $mpdf = new \Mpdf\Mpdf([
        'margin_left' => 20,
        'margin_right' => 15,
        'margin_top' => 48,
        'margin_bottom' => 25,
        'margin_header' => 10,
        'margin_footer' => 10
    ]);




    $nomeRel = $vXobPedido->NumeroPedido."_Pedido_Revenda_". str_replace(" ","_",$vXobRevendedor->Nome) ."_". date("d-m-Y_H-i-s");
    $mpdf->SetProtection(array('print'));
    $mpdf->SetTitle($nomeRel);
    $mpdf->SetAuthor("Aninha Faria Semijoias");
    $mpdf->SetWatermarkText("Aninha Faria Semijoias");
    $mpdf->showWatermarkText = false;
    $mpdf->watermark_font = 'DejaVuSansCondensed';
    $mpdf->watermarkTextAlpha = 0.1;
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($html);

    $mpdf->Output();
} else {
    echo 'NÃO FOI POSSIVEL EMITIR ESTE PEDIDO DE REVENDA.';
}
?>




<!-- <tbody>';
	$ctrlLinha = true;
	foreach ($listaPlanos as $plano) {
		if(!$ctrlLinha){
			$html .= '<tr class="linha-alt">';
		}
		else{
		$html .= '<tr>';
		}
		$html .=  '<td>'.$plano->PDCCOD.'</td>';
		$html .=  '<td>'.$plano->PDCDESCRICAO.'</td>';
		$html .=  '<td>'.$plano->TPCDESCRICAO.'</td>';
		$data = strtotime($plano->PDCDATCADASTRO);
		$html .=  '<td>'.date("d/m/Y",$data).'</td>';
		$html .=  '</tr>';

		if($ctrlLinha){
			$ctrlLinha = false;
		}
		else{
			$ctrlLinha = true;
		}
	}
 $html .= '</tbody> -->