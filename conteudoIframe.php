<?php
include_once 'headerContent.inc.php';
require_once 'config/ConexaoBD.php';
require_once 'Models/SceCldPdr.php';
require_once 'Models/SceCldRev.php';

$vxobPdr = new PedidoRevenda();
$vxobRev = new Revendedores();

$listaPedidos = $vxobPdr->SelecionarPedidosEmRevenda();
$listaRevendedores = $vxobRev->selecionarTodosRevendedores();
?>
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="card bg-success text-white">
            <div class="card-body" style="padding: 2px;">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-12 d-none d-md-block">
                            <span class="display-6" style="font-size: 12pt;">Pedidos Em Revenda</span>
                        </div>
                        <div class="col-12 d-block d-md-none ">
                            <span class="display-7" style="font-size: 8pt;">Pedidos Em Revenda</span>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-8 d-none d-md-block" style="font-size: 30pt;">
                            <?php echo count($listaPedidos); ?>
                        </div>
                        <div class="col-lg-4 text-right d-none d-md-block" style="font-size: 30pt;">
                            <i class="icone-basket-4"></i>
                        </div>
                        <div class="col-6 text-center d-block d-md-none" style="font-size: 15pt;">
                            <?php echo count($listaPedidos); ?>
                        </div>
                        <div class="col-6 text-center d-block d-md-none" style="font-size: 15pt;">
                            <i class="icone-basket-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="card bg-success text-white">
            <div class="card-body" style="padding: 2px;">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-12 d-none d-md-block">
                            <span class="display-6" style="font-size: 12pt;">Revendedores</span>
                        </div>
                        <div class="col-12 d-block d-md-none ">
                            <span class="display-7" style="font-size: 8pt;">Revendedores</span>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-8 d-none d-md-block" style="font-size: 30pt;">
                            <?php echo count($listaRevendedores); ?>
                        </div>
                        <div class="col-lg-4 text-right d-none d-md-block" style="font-size: 30pt;">
                            <i class="icone-users-2"></i>
                        </div>
                        <div class="col-6 text-center d-block d-md-none" style="font-size: 15pt;">
                            <?php echo count($listaRevendedores); ?>
                        </div>
                        <div class="col-6 text-center d-block d-md-none" style="font-size: 15pt;">
                            <i class="icone-users-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6"></div>
    <div class="col-lg-3 col-6"></div>
</div>
<div class="d-block d-md-none">
    <div class="row">
        <div class="col-6" style="padding: 5px;">
            <a href="MenuAdmin.php" class="card bg-fariamodas text-fariamodas-gold text-center" style="text-decoration: none;">
                <div class="card-body text-center" style="font-size: 30pt;">
                    <i class="icone-building"></i>
                </div>
                <div class="card-footer" style="font-size: 10pt;">
                    Administrativo
                </div>
            </a>
        </div>

        <div class="col-6" style="padding: 5px;">
            <a href="MenuComercial.php" class="card bg-fariamodas text-fariamodas-gold text-center" style="text-decoration: none;">
                <div class="card-body text-center" style="font-size: 30pt;">
                    <i class="icone-basket"></i>
                </div>
                <div class="card-footer" style="font-size: 10pt;">
                    Comercial
                </div>
            </a>
        </div>
        <div class="col-6" style="padding: 5px;">
            <a href="MenuFinanceiro.php" class="card bg-fariamodas text-fariamodas-gold text-center" style="text-decoration: none;">
                <div class="card-body text-center" style="font-size: 30pt;">
                    <i class="icone-money"></i>
                </div>
                <div class="card-footer" style="font-size: 10pt;">
                    Financeiro
                </div>
            </a>
        </div>

        <div class="col-6" style="padding: 5px;">
            <a href="MenuRevenda.php" class="card bg-fariamodas text-fariamodas-gold text-center" style="text-decoration: none;">
                <div class="card-body text-center" style="font-size: 30pt;">
                    <i class="icone-arrows-ccw"></i>
                </div>
                <div class="card-footer" style="font-size: 10pt;">
                    Revenda
                </div>
            </a>
        </div>
    </div>
</div>


<?php include_once 'footerContent.inc.php'; ?>