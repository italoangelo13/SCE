<?php
require_once ("../../Config/ConexaoBD.php");
require_once ("../../Models/AfsCldPdc.php");
require_once  '../../vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');

$dataini = null;
$dataFim = null;
$tipos = null;

if(isset($_POST["rel"])){
	if(isset($_POST["_edDataIni"])){
		$dataini = $_POST["_edDataIni"];
	}

	if(isset($_POST["_edDataFim"])){
		$dataini = $_POST["_edDataFim"];
	}

	if(isset($_POST["_ckplancontas"])){
		foreach ($_POST["_ckplancontas"] as $t) {
			$tipos = $tipos . "$t,";
		}
		$tipos = $tipos . "'";
		$tipos = str_replace(",'","",$tipos);
	}
}

$dataHoraAtual = date("d/m/Y \á\s\ H:i:s");

$p = new PlanodeContas();
$listaPlanos = $p->selecionarPlanosDeContasRelatorio($dataini,$dataFim,$tipos);

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
	<style>
		.linha-alt{
			background: #F5F5F5;
		}
	</style>
</head>
<body>

<br>
<table width="100%" style="border: 1px solid #000; text-align:center;">
    <thead >
		<tr style="background: #263548;">
        <th style="color:#E8AC60; width:10%;">#</th>
        <th style="color:#E8AC60; width:50%;">Plano de Contas</th>
        <th style="color:#E8AC60; width:20%;">Tipo</th>
        <th style="color:#E8AC60; width:20%;">Data Cadastro</th>
		</tr>
    </thead>
    <tbody>';
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
 $html .= '</tbody>
</table>

<br>





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


$Planos = $p->selecionarTodosPlanosDeContas();
$nomeRel = "Relatorio_de_Plano_de_Contas_".date("dmY_His");

$mpdf->SetHTMLHeader('<table width="100%"  >
<tr>
	<td width="30%">
		<div>
		<img src="../../assets/img/logo.png" width="150px">
		</div>
	</td>
	<td width="70%" style="text-align:right">
		<div >
			<h2>Relatorio de Plano de Contas</h2>
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
</tr>
</table>');


$mpdf->SetHTMLFooter('<table width="100%">
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
		Emitido em '.$dataHoraAtual.'
	</td>
</tr>
</table>');
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
?>