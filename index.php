<?php
session_start();
include_once 'Config/ConexaoBD.php';
$usuarioLogado = null;
if(isset($_SESSION["User"])){
    $usuarioLogado = $_SESSION["NomeUsuario"];
}
else{
    header("Location:login.php");
}


include 'header.inc.php'; ?>
<div class="row">
            <iframe class="col-lg-12" name="_ifrConteudo" id="_ifrConteudo" src="conteudoIframe.php" style="height:85vh;" frameborder="0"></iframe>
        </div>
