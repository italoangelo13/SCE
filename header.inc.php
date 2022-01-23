<?php
require_once 'Config/ConexaoBD.php';
require_once 'Config/Util.php';
require_once 'Models/AfsCldCol.php';


$util = new Util();


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="57x57" href="assets/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>SCE - Aninha Faria Semijoias</title>
    <link rel="stylesheet" href="assets/Jquery-Ui/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontello/css/fontello.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/fariamodas.css">
    <link rel="stylesheet" href="assets/jquery-confirm/jquery-confirm.min.css">
    <link rel="stylesheet" href="assets/chartjs/Chart.min.css">
    <link rel="stylesheet" href="assets/jQueryte.1.4.0/jquery-te-1.4.0.css">
    <link rel="stylesheet" href="assets/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/lightgallery/css/lightgallery.min.css">
    <link rel="stylesheet" href="assets/JPages/css/jPages.css">
    <link rel="stylesheet" href="assets/JPages/css/animate.css">
    <script src="assets/jquery-3.3.1.min.js"></script>
    <script src="assets/Jquery-Ui/jquery-ui.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/fontawesome/js/all.min.js"></script>
    <script src="assets/jquery-confirm/jquery-confirm.min.js"></script>
    <script src="assets/Loader/jquery.loading.min.js"></script>
    <script src="assets/Mascaras.js"></script>
    <script src="assets/chartjs/Chart.min.js"></script>
    <script src="assets/jQueryte.1.4.0/jquery-te-1.4.0.min.js"></script>
    <script src="assets/DataTables/datatables.min.js"></script>
    <script src="assets/lightgallery/js/lightgallery.min.js"></script>
    <script src="assets/JPages/js/jPages.js"></script>
    <script src="assets/fariamodas.js"></script>
    <script src="assets/mlens.js"></script>
    <style>
        .holder a {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #007bff;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#_ddlMarca").change(function() {
                CarregaDdlModelo();
            });

            function SuccessBox(msg) {
                $.alert({
                    title: 'KingCar Alerta',
                    content: msg,
                    type: 'green',
                    typeAnimated: true,
                });
            }

            function WarningBox(msg) {
                $.alert({
                    title: 'KingCar Alerta',
                    content: msg,
                    type: 'orange',
                    typeAnimated: true,
                });
            }

            function ErrorBox(msg) {
                $.alert({
                    title: 'KingCar Alerta',
                    content: msg,
                    type: 'red',
                    typeAnimated: true,
                });
            }


            function DefaultBox(msg) {
                $.alert({
                    title: 'KingCar Alerta',
                    content: msg,
                    type: 'dark',
                    typeAnimated: true,
                });
            }


            function showLoad(msg) {
                if (msg == null || msg == '') {
                    msg = 'Carregando...'
                }

                $('body').loading({
                    theme: 'dark',
                    message: msg
                });
            }


            function hideLoad() {
                $('body').loading('stop');
            }
        });
    </script>
</head>

<body class="">
    <div class="container-fluid">
        <div class="d-none d-md-block">
            <!-- Telas Grandes-->
            <div class="row bg-fariamodas text-fariamodas-gold" style="padding: 5px;">
                <div class="col-lg-6 text-lg-left text-center">
                    <h4>SCE <small>Sistema de Controle Empresarial</small></h4>
                </div>
                <div class="col-lg-6 text-right">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-9 col-6 text-lg-right text-center">Olá, <?php echo $usuarioLogado; ?></div>
                            <div class="col-lg-3 col-6 text-lg-right text-center"><a href="logout.php">Sair</a></div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-light bg-fariamodas-gold col-lg-12">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="conteudoIframe.php" target="_ifrConteudo">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="MenuAdmin.php" target="_ifrConteudo">Administrativo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="MenuComercial.php" target="_ifrConteudo">Comercial</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="MenuFinanceiro.php" target="_ifrConteudo">Financeiro</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="MenuRevenda.php" target="_ifrConteudo">Revenda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="MenuAlmoxarifado.php" target="_ifrConteudo">Almoxarifado</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="d-block d-md-none">
            <!-- Telas Pequenas-->
            <div class="row bg-fariamodas-gold " style="padding: 5px; font-size: 15pt;">
                <div class="col-9">
                    <a href="conteudoIframe.php" target="_ifrConteudo" class="text-fariamodas">
                        Aninha Faria Semijoias
                    </a>
                </div>
                <div class="col-3 text-right">
                    <a href="conteudoIframe.php" target="_ifrConteudo" class="text-fariamodas">
                        <i class="icone-home" ></i>
                    </a>
                </div>
            </div>
            <div class="row bg-fariamodas text-fariamodas-gold" style="padding: 5px; font-size: 12pt;">
                <div class="col-6 text-lg-right text-left">Olá, <?php echo $usuarioLogado; ?></div>
                <div class="col-6 text-lg-right text-right"><a href="logout.php"> <i class="icone-logout"></i> Sair</a></div>
            </div>
        </div>