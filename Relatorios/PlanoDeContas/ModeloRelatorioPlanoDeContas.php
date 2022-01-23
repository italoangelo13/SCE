<?php
require_once ("../../Config/ConexaoBD.php");
require_once ("../../Models/AfsCldPdc.php");

$p = new PlanodeContas();
$listaPlanos = $p->selecionarPlanosDeContasRelatorio($dataini,$dataFim,$tipos);



?>


<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
	<br>
	<table style="width: 100%;">
		<tr>
			<td>
				<div>
					<strong>Codigo</strong>
					<span>1</span>
				</div>
			</td>
			<td>
				<div>
					<strong>Revendedora</strong>
					<span>Hedena de Faria</span>
				</div>
			</td>
		</tr>
	</table>	


<option value=""></option>
<option value="AC">AC</option>
<option value="AL">AL</option>
<option value="AP">AP</option>
<option value="AM">AM</option>
<option value="BA">BA</option>
<option value="CE">CE</option>
<option value="ES">ES</option>
<option value="GO">GO</option>
<option value="MA">MA</option>
<option value="MT">MT</option>
<option value="MS">MS</option>
<option value="MG">MG</option>
<option value="PA">PA</option>
<option value="PB">PB</option>
<option value="PR">PR</option>
<option value="PE">PE</option>
<option value="PI">PI</option>
<option value="RJ">RJ</option>
<option value="RN">RN</option>
<option value="RS">RS</option>
<option value="RO">RO</option>
<option value="RR">RR</option>
<option value="SC">SC</option>
<option value="SP">SP</option>
<option value="SE">SE</option>
<option value="TO">TO</option>
<option value="DF">DF</option>



<input type="number" class="form-control" width="70px" min="1" name="_iteGridFat_" id="_iteGridFat_">

<div class="btn btn-success" onclick="RegistrarItenVendido()">
	<i class="icone-check-3"></i>
</div>
</body>
</html>


"SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 17"