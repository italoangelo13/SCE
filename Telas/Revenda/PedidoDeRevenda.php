<?php include '../headerTelas.inc.php'; ?>

<div class="row bg-fariamodas text-fariamodas-gold">
    <div class="col-lg-12 text-lg-right text-center">
        <h5>Gestão de Pedidos de Revenda</h5>
    </div>
</div>

<div class="row alert alert-info">
    <div class="col-lg-12 text-center">No Painel de Pedidos de Revenda, você controla todos os pedidos emitidos para
        revendedores.</div>
</div>

<div id="pnl_Pesq" class="display-show">
    <div class="row alert-secondary" style="padding: 10px;">
        <div class="col-lg-12">
            <div class="btn btn-primary " onclick="Cadastrar()">
                <i class="icone-plus"></i> Cadastrar Novo Pedido
            </div>
            <div class="btn btn-secondary" onclick="GerarRelatorio()">
                <i class="icone-print"></i>Relatorio
            </div>
        </div>
    </div>


    <div class="row bg-light" style="margin-top:5px; padding:5px;">
        <div class="col-lg-12 table-responsive-md">
            <table id="_gridPesq" class="table table-striped text-center ">
                <thead class="bg-fariamodas text-fariamodas-gold">
                    <tr>
                        <th>Nº Pedido</th>
                        <th>Data Pedido</th>
                        <th>Revendedor</th>
                        <th>Status</th>
                        <th>Vlr Pedido</th>
                        <th>Qtde Itens</th>
                        <th>Detalhes</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="Pnl_CadAtu" class="display-hide">
    <div class="row">
        <ul class="nav nav-tabs col-lg-12">
            <li class="nav-item">
                <span id="_bntAbaPedido" onclick="TrocaAba(1)" class="nav-link active">Pedido de Revenda</span>
            </li>
            <li class="nav-item">
                <span id="_bntAbaItens" onclick="TrocaAba(2)" class="nav-link">Itens do Pedido</span>
            </li>
        </ul>
    </div>
    <div id="_AbaPedido" class="display-show">
        <div class="row" style="margin-top:15px;">
            <div class="col-lg-6" style="margin-top:15px;">
                <div class="btn-group">
                    <div class="btn btn-dark" onclick="VoltarTelaPesq('#Pnl_CadAtu')"> <i class="icone-back"></i>Voltar
                    </div>
                    <div class="btn btn-danger" onclick="LimparCampos()"> <i class="icone-cancel"></i> Limpar</div>
                    <div class="btn btn-success" onclick="InsereAtualiza()"><i class="icone-floppy"></i> Salvar</div>
                    <div id="_btnEmitirPedido" class="btn btn-secondary display-hide" onclick="EmitirPedidoRevenda()"><i class="icone-print"></i> Emitir Pedido</div>
                </div>
            </div>
            <div class="col-lg-6" style="margin-top:15px;">
                <div class="btn-group">
                    <div class="btn btn-primary" onclick="AprovarPedido()"> <i class="icone-check"></i>Enviar Para
                        Revenda</div>
                    <div class="btn btn-danger" onclick="CancelarPedido()"> <i class="icone-cancel"></i> Cancelar Pedido</div>
                    <div class="btn btn-success" onclick="FaturarPedido()"><i class="icone-money"></i> Processar Pedido</div>
                </div>
            </div>
        </div>
        <div class="row bg-fariamodas text-fariamodas-gold" style="margin-top:5px;">
            <div class="col-lg-12 text-center">
                Dados do Pedido de Revenda
            </div>
        </div>
        <div class="row bg-white text-center" style="margin-top:5px;">
            <div class="form-group col-lg-4">
                <label for="_edDataPedido">Valor</label>
                <span for="_edDataPedido">
                    <h4><label id="_lblVlrPedido" for="">R$ 0,00</label></h4>
                </span>
            </div>

            <div class="form-group col-lg-4">
                <label for="_edDataPedido">Itens no Pedido</label>
                <span for="_edDataPedido">
                    <h4><label id="_lblQtdeItens" for="">0</label></h4>
                </span>
            </div>

            <div class="form-group col-lg-4">
                <label for="_edDataPedido">Situação</label>
                <span for="_edDataPedido">
                    <h4><label id="_lblSituacao" for="">Novo</label></h4>
                </span>
            </div>
        </div>
        <div class="row alert-secondary" style="margin-top:5px;">
            <div class="form-group col-lg-2">
                <label for="_edCod">Cod</label>
                <input type="text" value="" class="form-control" id="_edCod" name="_edCod" readonly>
            </div>
            <div class="form-group col-lg-2">
                <label for="_edDescricao">Nº Pedido</label>
                <input type="text" value="" class="form-control" id="_edNumPedido" name="_edNumPedido" readonly>
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="text-danger">Revendedor</label>
                <div class="container-fluid">
                    <div class="form-row">
                        <div class="form-group col-4 col-lg-2">
                            <input type="text" value="" class="form-control" id="_edCodRevendedor" name="_edCodRevendedor" readonly>
                        </div>
                        <div class="form-group col-8 col-lg-8">
                            <input type="text" value="" class="form-control" id="_edRevendedor" name="_edRevendedor">
                        </div>

                        <!-- Tela Grande -->
                        <div class="form-group col-6 col-lg-1 d-none d-sm-block" onclick="AbrirModalSelecionarRevendedor();">
                            <div class="btn btn-primary">
                                <i class="icone-search"></i>
                            </div>
                        </div>
                        <div class="form-group  col-6 col-lg-1  d-none d-sm-block" onclick="LimparCamposSelecao('#_edCodRevendedor','#_edRevendedor');">
                            <div class="btn btn-danger">
                                <i class="icone-trash"></i>
                            </div>
                        </div>

                        <!-- Tela Pequena -->
                        <div class="form-group col-6 col-lg-1 d-block d-sm-none" onclick="AbrirModalSelecionarRevendedor();">
                            <div class="btn btn-primary btn-block">
                                <i class="icone-search"></i> Pesquisar
                            </div>
                        </div>
                        <div class="form-group  col-6 col-lg-1  d-block d-sm-none" onclick="LimparCamposSelecao('#_edCodRevendedor','#_edRevendedor');">
                            <div class="btn btn-danger  btn-block">
                                <i class="icone-trash"></i> Limpar
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group col-lg-2">
                <label for="_edDataPedido" class="text-danger">Data Pedido</label>
                <input type="date" value="" class="form-control" id="_edDataPedido" name="_edDataPedido">
            </div>
        </div>
        <div class="row bg-white" style="margin-top:5px;">
            <div class="form-group col-lg-2">
                <label for="_edDataDevolucao" class="text-danger">Data Devolução</label>
                <input type="date" value="" class="form-control" id="_edDataDevolucao" name="_edDataDevolucao">
            </div>

            <div class="form-group col-lg-2">
                <label for="_edDataAcerto" class="text-danger">Data Acerto</label>
                <input type="date" value="" class="form-control" id="_edDataAcerto" name="_edDataAcerto">
            </div>
        </div>
    </div>
    <div id="_AbaItens" class="display-hide">
        <div class="row" style="margin-top:15px;">
            <div class="col-lg-12">
                <div class="btn-group">
                    <div class="btn btn-dark" onclick="VoltarTelaPesq('#Pnl_CadAtu')"> <i class="icone-back"></i>Voltar
                    </div>
                    <div class="btn btn-danger" onclick="DeletaItensPedido()"> <i class="icone-cancel"></i> Limpar Itens
                        do Pedido</div>
                    <div class="btn btn-success" onclick="InsereItemPedido()"><i class="icone-plus"></i> Adicionar Item
                    </div>
                </div>
            </div>
        </div>
        <div class="row bg-fariamodas text-fariamodas-gold" style="margin-top:5px;">
            <div class="col-lg-12 text-center">
                Itens do Pedido de Revenda
            </div>
        </div>
        <div class="row bg-white" style="margin-top:5px;">
            <div class=" col-lg-12 table-responsive-md">
                <table id="_gridItens" class="table table-striped text-center " style="width: 100%;">
                    <thead class="bg-fariamodas text-fariamodas-gold">
                        <tr>
                            <th style="width: 20%;"></th>
                            <th>SKU</th>
                            <th>Produto</th>
                            <th>Qtde</th>
                            <th>Vlr Unit</th>
                            <th>Vlr Promocional</th>
                            <th>SubTotal</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>



<div id="Pnl_GerRel" class="display-hide">
    <form action="Relatorios/PlanoDeContas/RelPlanContas.php" method="post" target="_blank">
        <div class="row" style="margin-top:5px;">
            <div class="col-lg-12">
                <div class="btn-group">
                    <div class="btn btn-dark" onclick="VoltarTelaPesq('#Pnl_GerRel')"> <i class="icone-back"></i>Voltar
                    </div>
                    <div class="btn btn-danger" onclick="LimparCamposRel()"> <i class="icone-cancel"></i> Limpar</div>
                    <button class="btn btn-secondary" name="rel"><i class="icone-print"></i> Emitir Relatorio</button>
                </div>
            </div>
        </div>
        <div class="row bg-fariamodas text-fariamodas-gold" style="margin-top:5px;">
            <div class="col-lg-12 text-center">
                Parâmetros do Relatorio de Plano de Contas
            </div>
        </div>
        <div class="row bg-white" style="margin-top:5px;">
            <div class="form-group col-lg-2 alert-secondary">
                <label>Data</label>
            </div>
            <div class="form-group form-inline col-lg-10">
                <input type="date" value="" class="form-control" id="_edDataIni" name="_edDataIni" width="100px">
                Á
                <input type="date" value="" class="form-control" id="_edDataFim" name="_edDataFim" width="100px">
            </div>
        </div>
        <div class="row bg-white" style="margin-top:1px;">
            <div class="form-group col-lg-2 alert-secondary">
                <label>Tipo de Plano de Contas</label>
            </div>
            <div class="form-group form-inline col-lg-10">
                <input type="checkbox" name="_ckplancontas[1]" value="1" checked id="_ckplancontas[1]"> <label for="_ckplancontas[1]">Receitas</label>
                <input type="checkbox" name="_ckplancontas[2]" value="2" checked id="_ckplancontas[2]"> <label for="_ckplancontas[2]">Despesas</label>
            </div>
        </div>
    </form>
</div>


<div id="Pnl_FatPedido" class="display-hide">
    <div class="row" style="margin-top:15px;">
        <div class="col-lg-6 col-12">
            <div class="btn-group">
                <div style="padding: 5px;" class="btn btn-dark" onclick="VoltarTelaPesq('#Pnl_CadAtu')"> <i class="icone-back"></i>Voltar
                </div>
                <div style="padding: 5px;" class="btn btn-primary" onclick="TodosItensVendidos()"><i class="icone-check"></i> Todos os Itens Vendidos
                </div>
                <div style="padding: 5px;" class="btn btn-danger" onclick="LimparItensVendidos()"><i class="icone-cancel"></i> Nenhum Item Vendido
                </div>
                <div style="padding: 5px;" class="btn btn-success" onclick="FinalizarPedido()"><i class="icone-money"></i> Finalizar Pedido
                </div>
            </div>

        </div>
        <div class="col-lg-3 col-6 text-center">
            <h4>Itens Vendidos</h4>
            <label for="" id="_lblItensVendidos">0</label>
        </div>
        <div class="col-lg-3 col-6 text-center">
            <h4>Valor Vendido</h4>
            <label for="" id="_lblValorVendido">R$ 0,00</label>
        </div>
    </div>
    <div class="row bg-fariamodas text-fariamodas-gold" style="margin-top:5px;">
        <div class="col-lg-12 text-center">
            Marque os itens do pedido que forma vendidos e informe a quantidade.
        </div>
    </div>
    <div class="row bg-white" style="margin-top:5px;">
        <div class=" col-lg-6 table-responsive-md">
            <h4 class="alert alert-success">Itens Pendentes</h4>
            <table id="_gridItensFatura" class="table table-striped text-center " style="width: 100%;">
                <thead class="bg-fariamodas text-fariamodas-gold">
                    <tr>
                        <th>SKU</th>
                        <th>Produto</th>
                        <th style="width: 10%;">Qtde</th>
                        <th>Vendido</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

        <div class=" col-lg-6 table-responsive-md">
        <h4 class="alert alert-primary">Itens Vendidos</h4>
            <table id="_gridItensFaturaVendidos" class="table table-striped text-center " style="width: 100%;">
                <thead class="bg-fariamodas text-fariamodas-gold">
                    <tr>
                        <th>SKU</th>
                        <th>Produto</th>
                        <th style="width: 10%;">Qtde</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalSelRevendedor" aria-labelledby="modalSelRevendedor" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-header bg-fariamodas text-fariamodas-gold">
            Selecionar Revendedor
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-content">
            <div class="container-fluid">
                <div class="row bg-light" style="margin-top:5px; padding:5px;">
                    <div class="col-lg-12 table-responsive-md">
                        <table id="_gridPesqRevendedor" class="table table-striped text-center ">
                            <thead class="bg-fariamodas text-fariamodas-gold">
                                <tr>
                                    <th></th>
                                    <th>Id</th>
                                    <th>Revendedor</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalIncItem" aria-labelledby="modalIncItem" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <div class="modal-header bg-fariamodas text-fariamodas-gold">
            Incluir Item
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-content">
            <div class="container-fluid">
                <div class="row bg-light" style="margin-top:5px; padding:5px;">
                    <div class="col-12 col-lg-12">
                        <label class="text-danger">Produto</label>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="form-group col-6 col-lg-2">
                                    <input type="hidden" value="" class="form-control" id="_edCodProduto" name="_edCodProduto">
                                    <input type="text" value="" class="form-control" id="_edSkuProduto" name="_edSkuProduto" readonly>
                                </div>
                                <div class="form-group col-12 col-lg-8">
                                    <input type="text" value="" class="form-control" id="_edProduto" name="_edProduto" readonly>
                                </div>

                                <!-- Tela Grande -->
                                <div class="form-group col-6 col-lg-1 d-none d-sm-block" onclick="AbrirModalSelecionarProduto();">
                                    <div class="btn btn-primary">
                                        <i class="icone-search"></i>
                                    </div>
                                </div>
                                <div class="form-group  col-6 col-lg-1  d-none d-sm-block" onclick="LimparCamposSelecaoProduto();">
                                    <div class="btn btn-danger">
                                        <i class="icone-trash"></i>
                                    </div>
                                </div>

                                <!-- Tela Pequena -->
                                <div class="form-group col-12 col-lg-1 d-block d-sm-none" onclick="AbrirModalSelecionarProduto();">
                                    <div class="btn btn-primary btn-block">
                                        <i class="icone-search"></i> Pesquisar
                                    </div>
                                </div>
                                <div class="form-group  col-12 col-lg-1  d-block d-sm-none" onclick="LimparCamposSelecaoProduto();">
                                    <div class="btn btn-danger  btn-block">
                                        <i class="icone-trash"></i> Limpar
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-2">
                        <label class="text-danger">Quantidade</label>
                        <input type="number" min="1" value="1" class="form-control" id="_edQtdeItem" name="_edQtdeItem">
                    </div>
                    <!-- Tela Grande -->
                    <div class="form-group col-6 col-lg-12 d-none d-sm-block" style="margin-top: 5px;" onclick="InserirItemPedido();">
                        <div class="btn btn-primary btn-block">
                            <i class="icone-plus"></i> Adicionar
                        </div>
                    </div>
                    <!-- Tela Pequena -->
                    <div class="form-group col-12 col-lg-2 d-block d-sm-none" style="margin-top: 5px;" onclick="InserirItemPedido();">
                        <div class="btn btn-primary btn-block">
                            <i class="icone-plus"></i> Adicionar
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="modalSelProduto" aria-labelledby="modalSelProduto" aria-hidden="true">
    <div class="modal-dialog modal-xl">

        <div class="modal-header bg-fariamodas text-fariamodas-gold">
            Selecionar Produto
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-content">
            <div class="container-fluid">
                <div class="row bg-light" style="margin-top:5px; padding:5px;">
                    <div class="col-lg-12 table-responsive-md">
                        <table id="_gridPesqProduto" class="table table-striped text-center ">
                            <thead class="bg-fariamodas text-fariamodas-gold">
                                <tr>
                                    <th></th>
                                    <th>SKU</th>
                                    <th>Produto</th>
                                    <th>Vlr Unit.</th>
                                    <th>Vlr Promo.</th>
                                    <th>Qtde</th>
                                    <th>Categoria</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        atualizaGridPrincipal();
        BuscaDadosTodosTipos();

        $(document).on('show.bs.modal', '.modal', function() {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass(
                    'modal-stack');
            }, 0);
        });
    });

    function AprovarPedido() {
        var retConfirm = confirm('Deseja Realmente enviar este Pedido Para Revenda?');

        if (!retConfirm) {
            return false;
        }

        var cod = $("#_edCod").val();

        if (!cod) {
            WarningBox('Cadastre o Pedido Antes de Aprová-lo.')
            return;
        }

        var situacao = sessionStorage.getItem('statusPedido');

        if (situacao != 'N') {
            WarningBox('Somente um Novo Pedido Pode Ser Enviado para revenda.')
            return;
        }

        showLoad('Aguarde <br> Estamos Processando sua Solicitação.');

        var obj = {
            Id: cod,
            Status: 'R' //Em Revenda
        };

        $.ajax({
            url: "../../Api/Revenda/PutAtualizarSituacaoPedidoRevenda.php",
            type: 'PUT',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: JSON.stringify(obj),
            success: function(data) {
                debugger;
                console.log(data);
                if (data.Transcod == 1) {
                    hideLoad();
                    $('#_lblSituacao').text('EM REVENDA');
                    sessionStorage.setItem('statusPedido','R');
                    SuccessBox(data.msg);
                } else {
                    hideLoad();
                    ErrorBox(data.msg);
                }
            }
        });
    }


    function FaturarPedido() {

        debugger;
        var codPedido = $("#_edCod").val();
        var Sit = sessionStorage.getItem('statusPedido');

        if (Sit == 'C' || Sit == 'F') {
            WarningBox("Você só pode Finalizar um pedido que está em Revenda.");
            return;
        }

        if (Sit == 'N') {
            WarningBox("Você Deve Enviar Este Pedido Para revenda antes de Finaliza-lo.");
            return;
        }

        atualizaGridItensFaturamento();
        atualizaGridItensFaturamentoVendidos();

        $("#Pnl_CadAtu").removeClass('display-show');
        $("#Pnl_CadAtu").addClass('display-hide');

        $("#Pnl_FatPedido").removeClass('display-hide');
        $("#Pnl_FatPedido").addClass('display-show');



    }

    function CancelarPedido() {
        var retConfirm = confirm('Deseja Realmente Cancelar este Pedido?');

        if (!retConfirm) {
            return false;
        }

        var cod = $("#_edCod").val();

        if (!cod) {
            WarningBox('Não é Possivel Cancelar um Pedido Que ainda Não foi cadastrado.')
            return;
        }

        var situacao = sessionStorage.getItem('statusPedido');

        if (situacao == 'C') {
            WarningBox('Você não pode Cancelar um pedido que já está Cancelado.')
            return;
        } else if (situacao == 'F') {
            WarningBox('Você não pode Cancelar um pedido que já está Faturado.')
            return;
        }

        showLoad('Aguarde <br> Estamos Processando sua Solicitação.');

        var obj = {
            Id: cod,
            Status: 'C' //Cancelado
        };

        $.ajax({
            url: "../../Api/Revenda/PutAtualizarSituacaoPedidoRevenda.php",
            type: 'PUT',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: JSON.stringify(obj),
            success: function(data) {
                debugger;
                console.log(data);
                if (data.Transcod == 1) {
                    hideLoad();
                    $('#_lblSituacao').text('CANCELADO');
                    sessionStorage.setItem('statusPedido','C');
                    SuccessBox(data.msg);
                } else {
                    hideLoad();
                    ErrorBox(data.msg);
                }
            }
        });
    }

    function BuscaSituacaoPedido(codPedido) {
        var situacao = null;

        $.ajax({
            url: "../../Api/Revenda/GetBuscarSituacaoPedidoRevenda.php?Id=" + codPedido,
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                if (data.Transcod == 1) {
                    situacao = data.Situacao;
                } else {
                    console.error(data.msg);
                }
            }
        });

        return situacao;
    }

    function EmitirPedidoRevenda() {
        var cod = $("#_edCod").val();

        window.open('../../Relatorios/Revenda/RelPedidoRevendedora.php?Pedido=' + cod, '_blank');
    }

    function adicionaZero(numero) {
        if (numero <= 9)
            return "0" + numero;
        else
            return numero;
    }

    function LimparCampos() {
        $('#_edCod').val('');
        $('#_edNumPedido').val('');
        $('#_edDataPedido').val('');
        $('#_edCodRevendedor').val('');
        $('#_edRevendedor').val('');
        $('#_edDataAcerto').val('');
        $('#_edDataDevolucao').val('');
        $('#_lblSituacao').text('NOVO');
        $('#_lblVlrPedido').text('R$ 0,00');
        $('#_lblQtdeItens').text('0');

        $('#_btnEmitirPedido').addClass('display-hide');
        $('#_btnEmitirPedido').removeClass("display-show");
    }

    function TrocaAba(codAba) {
        debugger;
        var codPedido = $("#_edCod").val();
        if (codAba != 1 && (codPedido == "" || codPedido == null)) {
            WarningBox("Antes de acessar esta Aba, você deve finalizar o cadastro do Pedido.");
            return;
        }

        switch (codAba) {
            case 1:
                $('#_AbaItens').addClass('display-hide');
                $('#_AbaItens').removeClass("display-show");
                $('#_bntAbaItens').removeClass("active");

                $('#_AbaPedido').removeClass('display-hide');
                $('#_AbaPedido').addClass("display-show");
                $('#_bntAbaPedido').addClass("active");
                break;
            case 2:
                $('#_AbaPedido').addClass('display-hide');
                $('#_AbaPedido').removeClass("display-show");
                $('#_bntAbaPedido').removeClass("active");

                $('#_AbaItens').removeClass('display-hide');
                $('#_AbaItens').addClass("display-show");
                $('#_bntAbaItens').addClass("active");
                break;

            default:
                $('#_AbaItens').addClass('display-hide');
                $('#_AbaItens').removeClass("display-show");
                $('#_bntAbaItens').removeClass("active");

                $('#_AbaPedido').removeClass('display-hide');
                $('#_AbaPedido').addClass("display-show");
                $('#_bntAbaPedido').addClass("active");
                break;
        }
    }

    function LimparCamposRel() {
        $('#_edCod').val('');
        $('#_edDescricao').val('');
        $('#_ddlTipo').val('');
    }

    function LimparCamposSelecao(cod, text) {
        $(cod).val("");
        $(text).val("");
    }

    function LimparCamposSelecaoProduto() {
        $('#_edCodProduto').val("");
        $('#_edProduto').val("");
        $('#_edSkuProduto').val("");
        $("#_edQtdeItem").val(1);
    }

    function AbrirModalSelecionarRevendedor() {
        atualizaGridRevendedor();
        $('#modalSelRevendedor').modal('show');
    }

    function DeletarItem(cod) {
        var status = $("#_lblSituacao").text();
        if (status != "NOVO") {
            WarningBox("Não é Possivel Limpar os itens neste pedido. Favor iniciar um Novo Pedido.");
            return;
        }

        var codPedido = $("#_edCod").val();

        showLoad('Aguarde <br> Excluindo Registro Selecionado.');
        var obj = {
            Id: cod,
            CodPedido: codPedido
        };

        $.ajax({
            url: "../../Api/Revenda/DeleteExcluirItemPedidoRevendaPorCodigo.php",
            type: 'DELETE',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: JSON.stringify(obj),
            success: function(data) {
                debugger;
                console.log(data);
                if (data.Transcod == 1) {
                    hideLoad();
                    $('#_lblVlrPedido').text('R$ ' + data.ValorPedido);
                    $('#_lblQtdeItens').text(data.Quantidade);
                    SuccessBox(data.msg);
                    atualizaGridItens(null);
                } else {
                    hideLoad();
                    ErrorBox(data.msg);
                }
            }
        });
    }

    function DeletaItensPedido() {
        var status = $("#_lblSituacao").text();
        if (status != "NOVO") {
            WarningBox("Não é Possivel Limpar os itens neste pedido. Favor iniciar um Novo Pedido.");
            return;
        }

        var cod = $("#_edCod").val();

        showLoad('Aguarde <br> Excluindo Registros.');
        var obj = {
            Id: cod
        };

        $.ajax({
            url: "../../Api/Revenda/DeleteExcluirAllItensPedidoRevenda.php",
            type: 'DELETE',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: JSON.stringify(obj),
            success: function(data) {
                debugger;
                console.log(data);
                if (data.Transcod == 1) {
                    hideLoad();
                    $('#_lblVlrPedido').text('R$ ' + data.ValorPedido);
                    $('#_lblQtdeItens').text(data.Quantidade);
                    SuccessBox(data.msg);
                    atualizaGridItens(null);
                } else {
                    hideLoad();
                    ErrorBox(data.msg);
                }
            }
        });


    }

    function InsereItemPedido() {
        var status = $("#_lblSituacao").text();
        if (status != "NOVO") {
            WarningBox("Não é Possivel Adicionar mais itens neste pedido. Favor iniciar um Novo Pedido.");
            return;
        }
        $('#modalIncItem').modal('show');
    }

    function AbrirModalSelecionarProduto() {
        LimparCamposSelecaoProduto();
        atualizaGridProdutos();
        $('#modalSelProduto').modal('show');
    }

    function atualizaGridProdutos() {
        //debugger;
        if ($.fn.DataTable.isDataTable('#_gridPesqProduto')) {
            var table = $('#_gridPesqProduto').DataTable();
            table.destroy();
            CarregaGridSelProduto()
        } else {
            CarregaGridSelProduto()
        }
    }

    function CarregaGridSelProduto() {
        showLoad('Carregando Informações!');

        $.ajax({
            url: "../../Api/Produtos/GetBuscarAllProdutosEmEstoque.php",
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                dados = data.Produtos;
                console.log(dados);
                hideLoad();
                $('#_gridPesqProduto').DataTable({
                    "language": {
                        "sEmptyTable": "Nenhum registro encontrado",
                        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sInfoThousands": ".",
                        "sLengthMenu": "_MENU_ resultados por página",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing": "Processando...",
                        "sZeroRecords": "Nenhum registro encontrado",
                        "sSearch": "Pesquisar",
                        "oPaginate": {
                            "sNext": "Próximo",
                            "sPrevious": "Anterior",
                            "sFirst": "Primeiro",
                            "sLast": "Último"
                        },
                        "oAria": {
                            "sSortAscending": ": Ordenar colunas de forma ascendente",
                            "sSortDescending": ": Ordenar colunas de forma descendente"
                        },
                        "select": {
                            "rows": {
                                "_": "Selecionado %d linhas",
                                "0": "Nenhuma linha selecionada",
                                "1": "Selecionado 1 linha"
                            }
                        }
                    },
                    "data": dados,
                    "columns": [{
                            "data": "Id",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data =
                                        '<div style="cursor:pointer;" onClick="SelecionarProduto(' +
                                        data +
                                        ')" class="btn btn-success"><i class="icone-check"></i></div>';
                                }

                                return data;
                            }
                        }, {
                            "data": "SKU",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "Produto",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "PrecoVenda",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>R$ ' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "PrecoPromocional",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>R$' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "QuatidadeEstoque",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "Categoria",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        }
                    ]
                });
            }
        });

    }

    function atualizaGridRevendedor() {
        //debugger;
        if ($.fn.DataTable.isDataTable('#_gridPesqRevendedor')) {
            var table = $('#_gridPesqRevendedor').DataTable();
            table.destroy();
            CarregaGridSelRevendedor()
        } else {
            CarregaGridSelRevendedor()
        }
    }


    function CarregaGridSelRevendedor() {
        showLoad('Carregando Informações!');

        $.ajax({
            url: "../../Api/Revenda/GetBuscarAllRevendedores.php",
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                dados = data.Revendedores;
                console.log(dados);
                hideLoad();
                $('#_gridPesqRevendedor').DataTable({
                    "language": {
                        "sEmptyTable": "Nenhum registro encontrado",
                        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sInfoThousands": ".",
                        "sLengthMenu": "_MENU_ resultados por página",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing": "Processando...",
                        "sZeroRecords": "Nenhum registro encontrado",
                        "sSearch": "Pesquisar",
                        "oPaginate": {
                            "sNext": "Próximo",
                            "sPrevious": "Anterior",
                            "sFirst": "Primeiro",
                            "sLast": "Último"
                        },
                        "oAria": {
                            "sSortAscending": ": Ordenar colunas de forma ascendente",
                            "sSortDescending": ": Ordenar colunas de forma descendente"
                        },
                        "select": {
                            "rows": {
                                "_": "Selecionado %d linhas",
                                "0": "Nenhuma linha selecionada",
                                "1": "Selecionado 1 linha"
                            }
                        }
                    },
                    "data": dados,
                    "columns": [{
                            "data": "Id",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data =
                                        '<div style="cursor:pointer;" onClick="SelecionarRevendedor(' +
                                        data +
                                        ')" class="btn btn-success"><i class="icone-check"></i></div>';
                                }

                                return data;
                            }
                        }, {
                            "data": "Id",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "Nome",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        }
                    ]
                });
            }
        });

    }

    function atualizaGridItensFaturamento() {
        //debugger;
        if ($.fn.DataTable.isDataTable('#_gridItensFatura')) {
            var table = $('#_gridItensFatura').DataTable();
            table.destroy();
            CarregaGridItensFaturamento()
        } else {
            CarregaGridItensFaturamento()
        }
    }

    function atualizaGridItensFaturamentoVendidos() {
        //debugger;
        if ($.fn.DataTable.isDataTable('#_gridItensFaturaVendidos')) {
            var table = $('#_gridItensFaturaVendidos').DataTable();
            table.destroy();
            CarregaGridItensFaturamentoVendidos()
        } else {
            CarregaGridItensFaturamentoVendidos()
        }
    }

    

    function CarregaGridItensFaturamento() {
        showLoad('Carregando Informações!');
        var codPedido = $("#_edCod").val();

        $.ajax({
            url: "../../Api/Revenda/GetBuscarItensPedidoRevendaParaFaturamentoPorCodigoPedido.php?Id=" + codPedido,
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                dados = data.Itens;
                qtde = data.QtdeVendido;
                vlr = data.VlrVendido;
                console.log(dados);
                hideLoad();
                $("#_lblValorVendido").text("R$ " + vlr);
                $("#_lblItensVendidos").text(qtde);
                $('#_gridItensFatura').DataTable({
                    "language": {
                        "sEmptyTable": "Nenhum registro encontrado",
                        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sInfoThousands": ".",
                        "sLengthMenu": "_MENU_ resultados por página",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing": "Processando...",
                        "sZeroRecords": "Nenhum registro encontrado",
                        "sSearch": "Pesquisar",
                        "oPaginate": {
                            "sNext": "Próximo",
                            "sPrevious": "Anterior",
                            "sFirst": "Primeiro",
                            "sLast": "Último"
                        },
                        "oAria": {
                            "sSortAscending": ": Ordenar colunas de forma ascendente",
                            "sSortDescending": ": Ordenar colunas de forma descendente"
                        },
                        "select": {
                            "rows": {
                                "_": "Selecionado %d linhas",
                                "0": "Nenhuma linha selecionada",
                                "1": "Selecionado 1 linha"
                            }
                        }
                    },
                    "data": dados,
                    "columns": [{
                            "data": "SKU",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "Produto",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "Id",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<input type="number" class="form-control" width="70px" value="1" min="1" name="_iteGridFat_' + data + '" id="_iteGridFat_' + data + '">';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "Id",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<div class="btn btn-success" onclick="RegistrarItenVendido(' + data + ')"><i class="icone-check-3"></i></div>';
                                }

                                return data;
                            }
                        }
                    ]
                });
            }
        });

    }

    function CarregaGridItensFaturamentoVendidos() {
        showLoad('Carregando Informações!');
        var codPedido = $("#_edCod").val();

        $.ajax({
            url: "../../Api/Revenda/GetBuscarItensVendidosPedidoRevendaParaFaturamentoPorCodigoPedido.php?Id=" + codPedido,
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                dados = data.Itens;
                console.log(dados);
                hideLoad();
                $('#_gridItensFaturaVendidos').DataTable({
                    "language": {
                        "sEmptyTable": "Nenhum registro encontrado",
                        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sInfoThousands": ".",
                        "sLengthMenu": "_MENU_ resultados por página",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing": "Processando...",
                        "sZeroRecords": "Nenhum registro encontrado",
                        "sSearch": "Pesquisar",
                        "oPaginate": {
                            "sNext": "Próximo",
                            "sPrevious": "Anterior",
                            "sFirst": "Primeiro",
                            "sLast": "Último"
                        },
                        "oAria": {
                            "sSortAscending": ": Ordenar colunas de forma ascendente",
                            "sSortDescending": ": Ordenar colunas de forma descendente"
                        },
                        "select": {
                            "rows": {
                                "_": "Selecionado %d linhas",
                                "0": "Nenhuma linha selecionada",
                                "1": "Selecionado 1 linha"
                            }
                        }
                    },
                    "data": dados,
                    "columns": [{
                            "data": "SKU",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "Produto",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "Quantidade",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "Id",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<div class="btn btn-danger" onclick="RemoverItemVendido(' + data + ')"><i class="icone-cancel-3"></i></div>';
                                }

                                return data;
                            }
                        }
                    ]
                });
            }
        });

    }

    function FinalizarPedido() {
        var retConfirm = confirm('Deseja Finalizar Este Pedido de Revenda?');

        if (!retConfirm) {
            return false;
        }

        if(sessionStorage.getItem('statusPedido') != 'R'){
            WarningBox("Para Finalizar o Pedido, o mesmo deve estar em situação de revenda.");
            return;
        }

        var codPedido = $("#_edCod").val();

        var obj = {
            Id: codPedido
        };


        $.ajax({
            url: "../../Api/Revenda/PostFinalizarPedidoRevenda.php",
            type: 'POST',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: JSON.stringify(obj),
            success: function(data) {
                debugger;
                console.log(data);
                if (data.Transcod == 1) {
                    hideLoad();
                    SuccessBox(data.msg);
                   setTimeout(function() { 
                    window.open('../Comecial/Pedidos.php?Id='+data.Pedido,'_ifrConteudo');
                    }, 5000);
                } else if (data.Transcod == 2) {
                    hideLoad();
                    WarningBox(data.msg);
                    atualizaGridItensFaturamento();
                    atualizaGridItensFaturamentoVendidos();
                }
                else{
                    hideLoad();
                    ErrorBox(data.msg);
                }
            }
        });

    }

    function TodosItensVendidos() {
        var retConfirm = confirm('Ao Marcar Todos os Itens como vendidos, será considerado a quantidade informada inicialmente no pedido. \n Tem Certeza que deseja marcar todos os itens como Vendidos?');

        if (!retConfirm) {
            return false;
        }

        if(sessionStorage.getItem('statusPedido') != 'R'){
            WarningBox("Para marcar um item como vendido, o pedido deve estar em situação de revenda.");
            return;
        }

        var codPedido = $("#_edCod").val();

        var obj = {
            Id: codPedido,
            Status: 'S'
        };

        $.ajax({
            url: "../../Api/Revenda/PutAtualizarTodosItensPedidoVendidos.php",
            type: 'PUT',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: JSON.stringify(obj),
            success: function(data) {
                debugger;
                console.log(data);
                if (data.Transcod == 1) {
                    hideLoad();
                    SuccessBox(data.msg);
                    atualizaGridItensFaturamento();
                    atualizaGridItensFaturamentoVendidos();
                } else {
                    hideLoad();
                    ErrorBox(data.msg);
                }
            }
        });

    }

    function LimparItensVendidos() {
        var retConfirm = confirm('Ao Desmarcar Todos os Itens, Todo o Valor e Quantidade Vendida será zerado. \n Tem Certeza que deseja desmarcar todos os itens?');

        if (!retConfirm) {
            return false;
        }

        if(sessionStorage.getItem('statusPedido') != 'R'){
            WarningBox("Para marcar um item como vendido, o pedido deve estar em situação de revenda.");
            return;
        }

        var codPedido = $("#_edCod").val();

        var obj = {
            Id: codPedido,
            Status: 'N'
        };

        $.ajax({
            url: "../../Api/Revenda/PutAtualizarTodosItensPedidoVendidos.php",
            type: 'PUT',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: JSON.stringify(obj),
            success: function(data) {
                debugger;
                console.log(data);
                if (data.Transcod == 1) {
                    hideLoad();
                    SuccessBox(data.msg);
                    atualizaGridItensFaturamento();
                    atualizaGridItensFaturamentoVendidos();
                } else {
                    hideLoad();
                    ErrorBox(data.msg);
                }
            }
        });

    }


    function RegistrarItenVendido(codItem) {
        var retConfirm = confirm('Deseja Marcar Este Item como Vendido?');

        if (!retConfirm) {
            return false;
        }

        showLoad('Atualizando Registro.')

        if(sessionStorage.getItem('statusPedido') != 'R'){
            WarningBox("Para marcar um item como vendido, o pedido deve estar em situação de revenda.");
            return;
        }

        var qtde = $("#_iteGridFat_"+codItem).val();

        var obj = {
            Id: codItem,
            Qtde: qtde,
            Status: 'S'
        };

        $.ajax({
            url: "../../Api/Revenda/PutAtualizarItemPedidoVendido.php",
            type: 'PUT',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: JSON.stringify(obj),
            success: function(data) {
                debugger;
                console.log(data);
                if (data.Transcod == 1) {
                    hideLoad();
                    SuccessBox('Item Marcado como Vendido.');
                    atualizaGridItensFaturamento();
                    atualizaGridItensFaturamentoVendidos();
                } else {
                    hideLoad();
                    ErrorBox(data.msg);
                }
            }
        });
    }

    function RemoverItemVendido(cod) {
        var retConfirm = confirm('Deseja Desmarcar este item como vendido?');

        if (!retConfirm) {
            return false;
        }

        showLoad('Atualizando Registro.')

        if(sessionStorage.getItem('statusPedido') != 'R'){
            WarningBox("Para desmarcar um item como vendido, o pedido deve estar em situação de revenda.");
            return;
        }

        

        var obj = {
            Id: cod,
            Qtde: 0,
            Status: 'N'
        };

        $.ajax({
            url: "../../Api/Revenda/PutAtualizarItemPedidoVendido.php",
            type: 'PUT',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: JSON.stringify(obj),
            success: function(data) {
                debugger;
                console.log(data);
                if (data.Transcod == 1) {
                    hideLoad();
                    SuccessBox('Item Desmarcado.');
                    atualizaGridItensFaturamento();
                    atualizaGridItensFaturamentoVendidos();
                } else {
                    hideLoad();
                    ErrorBox(data.msg);
                }
            }
        });
      }


    function SelecionarProduto(cod) {
        $.ajax({
            url: "../../Api/Produtos/GetBuscaDadosProdutoPorCodigo.php?Id=" + cod,
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                dados = data.Produtos;
                hideLoad();
                $('#_edCodProduto').val(dados[0].Id);
                $('#_edProduto').val(dados[0].Produto);
                $('#_edSkuProduto').val(dados[0].SKU);
                $('#modalSelProduto').modal('hide');
            }
        });
    }

    function SelecionarRevendedor(cod) {
        $.ajax({
            url: "../../Api/Revenda/GetBuscaDadosRevendedorPorCodigo.php?Id=" + cod,
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                dados = data.Revendedores;
                hideLoad();
                $('#_edCodRevendedor').val(dados[0].Id);
                $('#_edRevendedor').val(dados[0].Nome);
                $('#modalSelRevendedor').modal('hide');
            }
        });
    }

    function AbrirPedido(cod) {
        showLoad('Aguarde!<br>Carregando as informações.');
        TrocaAba(1);
        TrocaTela('#pnl_Pesq', '#Pnl_CadAtu');
        $('#_edCod').val(cod);
        $.ajax({
            url: "../../Api/Revenda/GetBuscarDadosPedidoRevendaPorCodigo.php?Id=" + cod,
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                var Pedido = data.PedidoRevenda.Pedido;
                var Itens = data.PedidoRevenda.Itens;
                console.log(Pedido);
                console.log(Itens);
                hideLoad();

                $('#_btnEmitirPedido').removeClass('display-hide');
                $('#_btnEmitirPedido').addClass("display-show");
                $('#_edCod').val(Pedido[0].Id);
                $('#_edNumPedido').val(Pedido[0].NumeroPedido);
                $('#_edCodRevendedor').val(Pedido[0].CodigoRevendedor);
                $('#_edRevendedor').val(Pedido[0].Revendedor);
                $('#_edDataPedido').val(Pedido[0].DataPedido);
                $('#_edDataDevolucao').val(Pedido[0].DataDevolucao);
                $('#_edDataAcerto').val(Pedido[0].DataAcerto);
                $('#_lblSituacao').text(Pedido[0].Status);
                $('#_lblVlrPedido').text('R$ ' + Pedido[0].ValorTotalPedido);
                $('#_lblQtdeItens').text(Pedido[0].QtdeItensPedido);
                atualizaGridItens(Itens);

                switch (Pedido[0].Status) {
                    case 'NOVO':
                        sessionStorage.setItem('statusPedido', 'N');
                        break;
                    case 'EM REVENDA':
                        sessionStorage.setItem('statusPedido', 'R');
                        break;
                    case 'CANCELADO':
                        sessionStorage.setItem('statusPedido', 'C');
                        break;
                    case 'FATURADO':
                        sessionStorage.setItem('statusPedido', 'F');
                        break;
                }
            }
        });
    }

    function atualizaGridItens(vXobDataItens) {
        //debugger;
        if ($.fn.DataTable.isDataTable('#_gridItens')) {
            var table = $('#_gridItens').DataTable();
            table.destroy();
            if (vXobDataItens) {
                CarregaGridItens(vXobDataItens)
            } else {
                CarregaGridItens(null)
            }

        } else {
            if (vXobDataItens) {
                CarregaGridItens(vXobDataItens)
            } else {
                CarregaGridItens(null)
            }
        }
    }

    function CarregaGridItens(vXobDataItens) {
        showLoad('Carregando Informações!');

        if (vXobDataItens) {
            hideLoad();
            $('#_gridItens').DataTable({
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    },
                    "select": {
                        "rows": {
                            "_": "Selecionado %d linhas",
                            "0": "Nenhuma linha selecionada",
                            "1": "Selecionado 1 linha"
                        }
                    }
                },
                "data": vXobDataItens,
                "columns": [{
                        "data": "Imagem",
                        "render": function(data, type, row, meta) {
                            if (type === 'display') {
                                if (data) {
                                    data =
                                        '<img style="width:80px; height:80px" src="' +
                                        data +
                                        '"  />';
                                } else {
                                    data =
                                        '<img style="width:120px; height:120px" src="../../assets/img/sem-foto.gif"  />';
                                }
                            }

                            return data;
                        }
                    }, {
                        "data": "SKU",
                        "render": function(data, type, row, meta) {
                            if (type === 'display') {
                                data = '<label>' + data + '</label>';
                            }

                            return data;
                        }
                    },
                    {
                        "data": "Produto",
                        "render": function(data, type, row, meta) {
                            if (type === 'display') {
                                data = '<label>' + data + '</label>';
                            }

                            return data;
                        }
                    },
                    {
                        "data": "Quantidade",
                        "render": function(data, type, row, meta) {
                            if (type === 'display') {
                                data = '<label>' + data + '</label>';
                            }

                            return data;
                        }
                    },
                    {
                        "data": "PrecoVenda",
                        "render": function(data, type, row, meta) {
                            if (type === 'display') {
                                data = '<label> R$' + data + '</label>';
                            }

                            return data;
                        }
                    },
                    {
                        "data": "PrecoPromocional",
                        "render": function(data, type, row, meta) {
                            if (type === 'display') {
                                data = '<label>R$ ' + data + '</label>';
                            }

                            return data;
                        }
                    },
                    {
                        "data": "SubTotal",
                        "render": function(data, type, row, meta) {
                            if (type === 'display') {
                                data = '<label>R$ ' + data + '</label>';
                            }

                            return data;
                        }
                    },
                    {
                        "data": "Id",
                        "render": function(data, type, row, meta) {
                            if (type === 'display') {
                                data = '<div onClick="DeletarItem(' + data +
                                    ')" class="btn btn-danger"><i class="icone-trash"></i></div>';
                            }

                            return data;
                        }
                    }
                ]
            });
        } else {
            var codPedido = $("#_edCod").val();
            $.ajax({
                url: "../../Api/Revenda/GetBuscarItensPedidoRevendaPorCodigoPedido.php?Id=" + codPedido,
                type: 'GET',
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: {},
                success: function(data) {
                    debugger;
                    console.log(data);
                    dados = data.Itens;
                    console.log(dados);
                    hideLoad();
                    $('#_gridItens').DataTable({
                        "language": {
                            "sEmptyTable": "Nenhum registro encontrado",
                            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                            "sInfoPostFix": "",
                            "sInfoThousands": ".",
                            "sLengthMenu": "_MENU_ resultados por página",
                            "sLoadingRecords": "Carregando...",
                            "sProcessing": "Processando...",
                            "sZeroRecords": "Nenhum registro encontrado",
                            "sSearch": "Pesquisar",
                            "oPaginate": {
                                "sNext": "Próximo",
                                "sPrevious": "Anterior",
                                "sFirst": "Primeiro",
                                "sLast": "Último"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar colunas de forma ascendente",
                                "sSortDescending": ": Ordenar colunas de forma descendente"
                            },
                            "select": {
                                "rows": {
                                    "_": "Selecionado %d linhas",
                                    "0": "Nenhuma linha selecionada",
                                    "1": "Selecionado 1 linha"
                                }
                            }
                        },
                        "data": dados,
                        "columns": [{
                                "data": "Imagem",
                                "render": function(data, type, row, meta) {
                                    if (type === 'display') {
                                        console.log('Imagem: ' + data);
                                        data =
                                            '<img style="width:80px; height:80px" src="' +
                                            data +
                                            '"  />';

                                    }

                                    return data;
                                }
                            }, {
                                "data": "SKU",
                                "render": function(data, type, row, meta) {
                                    if (type === 'display') {
                                        data = '<label>' + data + '</label>';
                                    }

                                    return data;
                                }
                            },
                            {
                                "data": "Produto",
                                "render": function(data, type, row, meta) {
                                    if (type === 'display') {
                                        data = '<label>' + data + '</label>';
                                    }

                                    return data;
                                }
                            },
                            {
                                "data": "Quantidade",
                                "render": function(data, type, row, meta) {
                                    if (type === 'display') {
                                        data = '<label>' + data + '</label>';
                                    }

                                    return data;
                                }
                            },
                            {
                                "data": "PrecoVenda",
                                "render": function(data, type, row, meta) {
                                    if (type === 'display') {
                                        data = '<label> R$' + data + '</label>';
                                    }

                                    return data;
                                }
                            },
                            {
                                "data": "PrecoPromocional",
                                "render": function(data, type, row, meta) {
                                    if (type === 'display') {
                                        data = '<label>R$ ' + data + '</label>';
                                    }

                                    return data;
                                }
                            },
                            {
                                "data": "SubTotal",
                                "render": function(data, type, row, meta) {
                                    if (type === 'display') {
                                        data = '<label>R$ ' + data + '</label>';
                                    }

                                    return data;
                                }
                            },
                            {
                                "data": "Id",
                                "render": function(data, type, row, meta) {
                                    if (type === 'display') {
                                        data = '<div onClick="DeletarItem(' + data +
                                            ')" class="btn btn-danger"><i class="icone-trash"></i></div>';
                                    }

                                    return data;
                                }
                            }
                        ]
                    });
                }
            });
        }


    }


    function InserirItemPedido() {
        var codProduto = $("#_edCodProduto").val();
        var qtde = $("#_edQtdeItem").val();
        var pedido = $("#_edCod").val();

        if (!codProduto) {
            $('#_edCodProduto').focus();
            hideLoad();
            WarningBox('Informe o Produto a Ser Inserido.');
            return;
        }

        if (qtde < 1 || qtde == null || qtde == "") {
            $('#_edQtdeItem').focus();
            hideLoad();
            WarningBox('Informe a quantidade do produto.');
            return;
        }

        var obj = {
            Id: codProduto,
            Qtde: qtde,
            Pedido: pedido
        };

        showLoad('Aguarde!<br>Inserindo Novo Registro.');

        console.log(obj);
        console.log(JSON.stringify(obj));
        $.ajax({
            url: "../../Api/Revenda/PostInsereItemPedidoRevenda.php",
            type: 'POST',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: JSON.stringify(obj),
            success: function(data) {
                debugger;
                console.log(data);
                console.log(dados[0]);
                switch (data.Transcod) {
                    case 0:
                        hideLoad();
                        ErrorBox(data.msg);
                        break;
                    case 1:
                        $('#modalIncItem').modal('hide');
                        LimparCamposSelecaoProduto();
                        atualizaGridItens(null);
                        $('#_lblVlrPedido').text('R$ ' + data.ValorPedido);
                        $('#_lblQtdeItens').text(data.Quantidade);
                        SuccessBox(data.msg);
                        hideLoad();
                        break;
                    case 2:
                        hideLoad();
                        WarningBox(data.msg);
                        break;
                }
            }
        });

    }


    //Atualiza Grid Principal
    function atualizaGridPrincipal() {
        //debugger;
        if ($.fn.DataTable.isDataTable('#_gridPesq')) {
            var table = $('#_gridPesq').DataTable();
            table.destroy();
            CarregaGridPrincipal();
        } else {
            CarregaGridPrincipal();
        }
    }

    function TrocaTela(h, s) {
        //s -> Tela a ser mostrada
        //h -> Tela a ser ocultada
        $(h).removeClass("display-show");
        $(h).addClass("display-hide");

        $(s).removeClass("display-hide");
        $(s).addClass("display-show");

        $("#Pnl_FatPedido").removeClass("display-show");
        $("#Pnl_FatPedido").addClass("display-hide");

    }



    function TrocaClasseAba(codAba) {
        //s -> Tela a ser mostrada
        //h -> Tela a ser ocultada
        $(h).removeClass("display-show");
        $(h).addClass("display-hide");

        $(s).removeClass("display-hide");
        $(s).addClass("display-show");

    }

    function VoltarTelaPesq(painel) {
        showLoad('Aguarde!');
        LimparCampos();
        TrocaTela(painel, '#pnl_Pesq');
        atualizaGridPrincipal();
        hideLoad();
    }

    function InsereAtualiza() {
        //TRANSCOD
        //0 - ERRO DE CODIGO
        //1 - OPERAÇÃO CONCLUIDA COM SUCESSO
        //2 - ativo JÁ CADASTRADO
        //3 - SENHA IGUAL A ANTERIOR


        showLoad('Aguarde!<br>Validando Informações do Registro.');
        var cod = $('#_edCod').val();
        var NumPedido = $('#_edNumPedido').val();
        var DataPedido = $('#_edDataPedido').val();
        var Revendedor = $('#_edCodRevendedor').val();
        var DataAcerto = $('#_edDataAcerto').val();
        var DataDevolucao = $('#_edDataDevolucao').val();

        if (!Revendedor) {
            $('#_edCodRevendedor').focus();
            hideLoad();
            WarningBox('O Campo Revendedor é obrigatório');
            return;
        }

        if (!DataPedido) {
            $('#_edDataPedido').focus();
            hideLoad();
            WarningBox('O Campo Data do Pedido é obrigatório');
            return;
        }

        if (!DataAcerto) {
            $('#_edDataAcerto').focus();
            hideLoad();
            WarningBox('O Campo Data de Acerto é obrigatório');
            return;
        }

        if (!DataDevolucao) {
            $('#_edDataDevolucao').focus();
            hideLoad();
            WarningBox('O Campo Data de Devolução é obrigatório');
            return;
        }

        var obj = {
            Id: cod,
            NumeroPedido: NumPedido,
            DataPed: DataPedido,
            Revend: Revendedor,
            DataAcert: DataAcerto,
            DataDev: DataDevolucao

        };


        if (!cod) { //INSERT
            showLoad('Aguarde!<br>Inserindo Novo Registro.');

            console.log(obj);
            console.log(JSON.stringify(obj));
            $.ajax({
                url: "../../Api/Revenda/PostInserePedidoRevenda.php",
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: JSON.stringify(obj),
                success: function(data) {
                    debugger;
                    console.log(data);
                    console.log(dados[0]);
                    switch (data.Transcod) {
                        case 0:
                            hideLoad();
                            ErrorBox(data.msg);
                            break;
                        case 1:
                            if (data.Acao == 1) {
                                $('#_edCod').val(data.Id);
                                $('#_edNumPedido').val(data.NumPedido);
                                $('#_btnEmitirPedido').removeClass('display-hide');
                                $('#_btnEmitirPedido').addClass("display-show");
                            }
                            hideLoad();
                            SuccessBox(data.msg);
                            break;
                        case 2:
                            hideLoad();
                            WarningBox(data.msg);
                            break;
                    }
                }
            });
        } else { //UPDATE
            $.ajax({
                url: "Api/PlanoDeContas/PutAtualizarPlanoDeContasPorCod.php",
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: JSON.stringify(obj),
                success: function(data) {
                    debugger;
                    console.log(data);
                    var dados = JSON.parse(data);
                    console.log(dados[0]);
                    switch (dados[0].TransCod) {
                        case 0:
                            hideLoad();
                            ErrorBox('Não Foi Possivel Cadastrar este Registro.');
                            break;
                        case 1:
                            $('#_edCod').val(dados[0].UltCod);
                            hideLoad();
                            SuccessBox('Registro cadastrado com Sucesso.');
                            break;
                        case 2:
                            hideLoad();
                            SuccessBox('Registro Atualizado com Sucesso.');
                            break;
                    }
                }
            });
        }
    }

    function Atualiza(cod) {
        showLoad('Aguarde!<br>Carregando as informações.');
        TrocaTela('#pnl_Pesq', '#Pnl_CadAtu');
        $('#_edCod').val(cod);
        BuscaDados(cod);
    }

    function Cadastrar() {
        showLoad('Aguarde!');
        TrocaAba(1);
        LimparCampos();
        atualizaGridItens([])
        TrocaTela('#pnl_Pesq', '#Pnl_CadAtu');
        hideLoad();
    }

    function GerarRelatorio() {
        showLoad('Aguarde!');
        TrocaTela('#pnl_Pesq', '#Pnl_GerRel');
        hideLoad();
    }

    function Deleta(cod) {
        showLoad('Aguarde <br> Excluindo Registro Selecionado.');
        var obj = {
            Id: cod
        };

        $.ajax({
            url: "Api/PlanoDeContas/DeleteExcluirPlanoDeContasPorCod.php",
            type: 'DELETE',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: JSON.stringify(obj),
            success: function(data) {
                debugger;
                console.log(data);
                var dados = JSON.parse(data);
                console.log(dados[0]);
                if (dados[0].TransCod == 3) {
                    hideLoad();
                    SuccessBox('Registro Deletado com Sucesso.');
                    atualizaGridPrincipal();
                } else {
                    hideLoad();
                    ErrorBox(dados[0].msg);
                }
            }
        });
    }

    function BuscaDados(cod) {
        var obj = {
            Id: cod
        };
        $.ajax({
            url: "Api/PlanoDeContas/GetBuscarDadosPlanoDeContas.php?Id=" + cod,
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                var dados = JSON.parse(data);
                console.log(dados[0]);
                if (dados[0].TransCod == 0) {
                    hideLoad();
                    ErrorBox(dados[0].msg);
                } else {
                    $('#_edDescricao').val(dados[0].plano);
                    $('#_ddlTipo').val(dados[0].tipo);
                    hideLoad();
                }
            }
        });
    }


    function BuscaDadosTodosTipos() {
        debugger;
        $.ajax({
            url: "Api/TiposPlanoDeContas/GetBuscarTodosTipos.php",
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                var dados = JSON.parse(data);
                console.log(dados);
                var selectbox = $('#_ddlTipo');
                selectbox.find('option').remove();
                dados.forEach(function(o, index) {
                    $('<option>').val(o.id).text(o.tipo.toUpperCase()).appendTo(selectbox);
                });
                $('<option>').val('').text('Selecionar').appendTo(selectbox);
                $('#_ddlTipo option[value=""]').attr('selected', 'selected');
            }
        });
    }

    //Carregando Grid Pincipal
    function CarregaGridPrincipal() {
        showLoad('Carregando Informações!');

        $.ajax({
            url: "../../Api/Revenda/GetBuscarAllPedidosRevenda.php",
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                dados = data.Pedidos
                hideLoad();
                $('#_gridPesq').DataTable({
                    "language": {
                        "sEmptyTable": "Nenhum registro encontrado",
                        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sInfoThousands": ".",
                        "sLengthMenu": "_MENU_ resultados por página",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing": "Processando...",
                        "sZeroRecords": "Nenhum registro encontrado",
                        "sSearch": "Pesquisar",
                        "oPaginate": {
                            "sNext": "Próximo",
                            "sPrevious": "Anterior",
                            "sFirst": "Primeiro",
                            "sLast": "Último"
                        },
                        "oAria": {
                            "sSortAscending": ": Ordenar colunas de forma ascendente",
                            "sSortDescending": ": Ordenar colunas de forma descendente"
                        },
                        "select": {
                            "rows": {
                                "_": "Selecionado %d linhas",
                                "0": "Nenhuma linha selecionada",
                                "1": "Selecionado 1 linha"
                            }
                        }
                    },
                    "data": dados,
                    "columns": [{
                            "data": "NumeroPedido",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "DataPedido",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "Revendedor",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "Status",
                            "render": function(data, type, row, meta) {


                                return data;
                            }
                        },
                        {
                            "data": "ValorTotalPedido",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>R$ ' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "QtdeItensPedido",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label> ' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "Id",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data =
                                        '<div title="Abrir Detalhes do Pedido" style="cursor:pointer;" onClick="AbrirPedido(' +
                                        data +
                                        ')" class="btn btn-success"><i class="icone-folder"></i></div>';
                                }

                                return data;
                            }
                        }
                    ]
                });
            }
        });

    }
</script>

<?php include '../footerTelas.inc.php'; ?>