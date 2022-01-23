<?php include '../headerTelas.inc.php'; ?>

<div class="row bg-fariamodas text-fariamodas-gold">
    <div class="col-lg-12 text-lg-right text-center">
        <h5>Gestão de Pedidos</h5>
    </div>
</div>

<div class="row alert alert-info">
    <div class="col-lg-12 text-center">No Painel de Gestão de Pedidos, você poderá Cadastrar, alterar, Pesquisar
        e excluir Todos os seus pedidos. Você tambem poderá controlar o status dos seus pedidos, Realizar o faturamento
        de suas vendas e muito mais.</div>
</div>

<div id="pnl_Pesq" class="display-show">
    <div class="row alert-secondary" style="padding: 10px;">
        <div class="col-lg-12">
            <div class="btn btn-primary " onclick="Cadastrar()">
                <i class="icone-plus"></i> Novo Pedido
            </div>
            <div class="btn btn-danger " onclick="ExcluirEmMassa()">
                <i class="icone-trash"></i> Excluir Pedidos em Massa
            </div>
        </div>
    </div>


    <div class="row bg-light" style="margin-top:5px; padding:5px;">
        <div class="col-lg-12">
            <table id="_gridPesq" class="table table-striped">
                <thead class="bg-fariamodas text-fariamodas-gold">
                    <tr>
                        <th>Pedido</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="Pnl_CadAtu" class="display-hide">
    <div class="row" style="margin-top:5px;">
        <div class="col-lg-6">
            <div class="btn-group">
                <div class="btn btn-dark" onclick="VoltarTelaPesq()"> <i class="icone-back"></i>Voltar</div>
                <div class="btn btn-danger" onclick="LimparCampos()"> <i class="icone-cancel"></i> Limpar</div>
                <div class="btn btn-success" onclick="InsereAtualiza()"><i class="icone-floppy"></i> Salvar</div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="btn-group">
                <div class="btn btn-warning" onclick="ProcessarPedido()"> <i class="icone-arrows-ccw"></i>Processar Pedido</div>
                <div class="btn btn-danger" onclick="CancelarPedido()"> <i class="icone-cancel"></i> Cancelar Pedido</div>
                <div class="btn btn-success" onclick="FaturarPedido()"><i class="icone-money"></i> Faturar Pedido</div>
            </div>
        </div>
    </div>
    <div class="row bg-fariamodas text-fariamodas-gold" style="margin-top:5px;">
        <div class="col-lg-12 text-center">
            Dados do Pedido
        </div>
    </div>
    <div class="row bg-white" style="margin-top:5px;">
        <div class="form-group col-lg-2">
            <label for="_edCod">Cod</label>
            <input type="text" value="" class="form-control" id="_edCod" name="_edCod" readonly>
        </div>
        <div class="form-group col-lg-2">
            <label for="_edNumPedido" class="text-danger">Nº Pedido</label>
            <input type="text" value="" class="form-control" readonly id="_edNumPedido" name="_edNumPedido">
        </div>
        <div class="form-group col-lg-2">
            <label for="_edData" class="text-danger">Data</label>
            <input type="date" value="" class="form-control" maxlength="255" id="_edData" name="_edData">
        </div>
        <div class="form-group col-lg-2">
            <label for="" class="text-danger">Status</label>
            <br>
            <label id="_lblStatus" class="badge badge-secondary" style="font-size: 20px;">AGUARDANDO</label>
        </div>
        <div class="form-group col-lg-2">
            <label class="">Vlr Pedido</label>
            <br>
            <label id="_lblVlrPedido" class="" style="font-size: 20px;">R$ 0,00</label>
        </div>
        <div class="form-group col-lg-2">
            <label class="">Itens</label>
            <br>
            <label id="_lblItensPedido" class="" style="font-size: 20px;">0</label>
        </div>
    </div>
    <div class="row" style="margin-top:5px;">
        <div class="col-lg-6">
            <label>Canal de Vendas</label>
            <div class="container-fluid">
                <div class="form-row">
                    <div class="form-group col-lg-2">
                        <input type="text" value="" class="form-control" id="_edCodCanal" name="_edCodCanal" readonly>
                    </div>
                    <div class="form-group col-lg-8">
                        <input type="text" value="" class="form-control" id="_edCanal" name="_edCanal">
                    </div>
                    <div class="form-group col-lg-1" onclick="AbrirModalSelecionarCliente();">
                        <div class="btn btn-primary">
                            <i class="icone-search"></i>
                        </div>
                    </div>
                    <div class="form-group col-lg-1" onclick="LimparCamposSelecao('#_edCodCanal','#_edCanal');">
                        <div class="btn btn-danger">
                            <i class="icone-trash"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="linhaColCli" class="display-show">
        <div class="row" style="margin-top:5px;">
            <div class="col-lg-6">
                <label>Cliente</label>
                <div class="container-fluid">
                    <div class="form-row">
                        <div class="form-group col-lg-2">
                            <input type="text" value="" class="form-control" id="_edCodCliente" name="_edCodCliente" readonly>
                        </div>
                        <div class="form-group col-lg-8">
                            <input type="text" value="" class="form-control" id="_edCliente" name="_edCliente">
                        </div>
                        <div class="form-group col-lg-1" onclick="AbrirModalSelecionarCliente();">
                            <div class="btn btn-primary">
                                <i class="icone-search"></i>
                            </div>
                        </div>
                        <div class="form-group col-lg-1" onclick="LimparCamposSelecao('#_edCodCliente','#_edCliente');">
                            <div class="btn btn-danger">
                                <i class="icone-trash"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <label>Colaborador</label>
                <div class="container-fluid">
                    <div class="form-row">
                        <div class="form-group col-lg-2">
                            <input type="text" value="" class="form-control" id="_edCodColaborador" name="_edCodColaborador" readonly>
                        </div>
                        <div class="form-group col-lg-8">
                            <input type="text" value="" class="form-control" id="_edColaborador" name="_edColaborador">
                        </div>
                        <div class="form-group col-lg-1" onclick="AbrirModalSelecionarVendedor();">
                            <div class="btn btn-primary">
                                <i class="icone-search"></i>
                            </div>
                        </div>
                        <div class="form-group col-lg-1" onclick="LimparCamposSelecao('#_edCodColaborador','#_edColaborador');">
                            <div class="btn btn-danger">
                                <i class="icone-trash"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="linhaRevenda" class="display-hide">
        <div class="row" style="margin-top:5px;">
            <div class="col-lg-6">
                <label>Revendedor</label>
                <div class="container-fluid">
                    <div class="form-row">
                        <div class="form-group col-lg-2">
                            <input type="text" value="" class="form-control" id="_edCodRevendedor" name="_edCodRevendedor" readonly>
                        </div>
                        <div class="form-group col-lg-8">
                            <input type="text" value="" class="form-control" id="_edRevendedor" name="_edRevendedor">
                        </div>
                        <div class="form-group col-lg-1" onclick="AbrirModalSelecionarRevendedor();">
                            <div class="btn btn-primary">
                                <i class="icone-search"></i>
                            </div>
                        </div>
                        <div class="form-group col-lg-1" onclick="LimparCamposSelecao('#_edCodRevendedor','#_edRevendedor');">
                            <div class="btn btn-danger">
                                <i class="icone-trash"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group col-lg-2">
                <label class="">Taxa Comissão</label>
                <br>
                <label id="_lblTaxaComissao" class="" style="font-size: 20px;">0%</label>
            </div>
            <div class="form-group col-lg-2">
                <label class="">Comissão</label>
                <br>
                <label id="_lblValorComissao" class="" style="font-size: 20px;">R$ 0,00</label>
            </div>

        </div>
    </div>
    <div class="row bg-fariamodas text-fariamodas-gold" style="margin-top:5px;">
        <div class="col-lg-12 text-center">
            Itens do Pedido
        </div>
    </div>

    <div class="row" style="margin-top:5px;">
        <div class="col-lg-12">
            <div class="btn btn-success" onclick="AdicionarNovoItem()">
                <i class="icone-plus-1"></i> Novo Item
            </div>
        </div>
    </div>

    <div class="row alert-white" style="margin-top:5px;">
        <div class="col-lg-12 table-responsive-lg">
            <table id="_gridItens" class="table table-striped ">
                <thead class="bg-fariamodas text-fariamodas-gold">
                    <th style="width: 10%;">SKU</th>
                    <th style="width: 50%;">Produto</th>
                    <th style="width: 10%;">Vlr Unitario</th>
                    <th style="width: 10%;">Qtde</th>
                    <th style="width: 10%;">Sub-Total</th>
                    <th style="width: 10%;">Remover Item</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>


    </div>

    <div class="row" style="margin-bottom: 10px;">
        <div class="col-lg-12">
            <div class="btn btn-success" onclick="AdicionarNovoItem()">
                <i class="icone-plus-1"></i> Novo Item
            </div>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalSelCliente" aria-labelledby="modalSelCliente" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-header bg-fariamodas text-fariamodas-gold">
            Selecionar Cliente
        </div>
        <div class="modal-content">
            <div class="container-fluid">
                <div class="row bg-light" style="margin-top:5px; padding:5px;">
                    <div class="col-lg-12">
                        <table id="_gridPesqCliente" class="table table-striped text-center table-responsive-sm">
                            <thead class="bg-fariamodas text-fariamodas-gold">
                                <tr>
                                    <th></th>
                                    <th>Id</th>
                                    <th>Cliente</th>
                                    <th>CPF</th>

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


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalSelVendedor" aria-labelledby="modalSelVendedor" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-header bg-fariamodas text-fariamodas-gold">
            Selecionar Vendedor
        </div>
        <div class="modal-content">
            <div class="container-fluid">
                <div class="row bg-light" style="margin-top:5px; padding:5px;">
                    <div class="col-lg-12">
                        <table id="_gridPesqVendedor" class="table table-striped text-center table-responsive-sm">
                            <thead class="bg-fariamodas text-fariamodas-gold">
                                <tr>
                                    <th></th>
                                    <th>Id</th>
                                    <th>Vendedor</th>
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


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalFaturarPedido" aria-labelledby="modalSelVendedor" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-header bg-fariamodas text-fariamodas-gold">
            Faturar Pedido
        </div>
        <div class="modal-content">
            <div class="container-fluid">
                <div class="row bg-light" style="margin-top:5px; padding:5px;">
                    <div class="form-group col-lg-5 col-12">
                        <label for="_edNumPedidoFat" class="text-danger">Nº Pedido</label>
                        <input type="text" value="" class="form-control" readonly id="_edNumPedidoFat" name="_edNumPedidoFat">
                    </div>
                    <div class="form-group col-lg-3 col-12">
                        <label for="_edVlrPedidoFat" class="text-danger">Vlr Pedido</label>
                        <input type="text" value="" class="form-control" readonly id="_edVlrPedidoFat" name="_edVlrPedidoFat">
                    </div>
                    <div class="form-group col-lg-4 col-12">
                        <label for="_edDataVencFat" class="text-danger">Data Vencimento</label>
                        <input type="date" value="" class="form-control" id="_edDataVencFat" name="_edDataVencFat">
                    </div>
                </div>
                <div id="_linhaComissaoFat">
                <div  class="row bg-light" style="margin-top:5px; padding:5px;">
                    <div class="form-group col-lg-4 col-12">
                        <label for="_edNumPedidoFat" class="text-danger">Taxa Comissão</label>
                        <input type="text" value="" class="form-control" readonly id="_edTxComFat" name="_edTxComFat">
                    </div>
                    <div class="form-group col-lg-4 col-12">
                        <label for="_edVlrPedidoFat" class="text-danger">Vlr Comissão</label>
                        <input type="text" value="" class="form-control" readonly id="_edVlrComFat" name="_edVlrComFat">
                    </div>
                    <div class="form-group col-lg-4 col-12">
                        <label for="_edVlrBonusFat" class="text-danger">Bônus <span class="text-muted" style="font-size: 8pt;"> em R$</span></label>
                        <input type="text" value="" class="form-control" id="_edVlrBonusFat" name="_edVlrBonusFat">
                    </div>
                </div>
                </div>
                <div class="row bg-light" style="margin-top:5px; padding:5px;">
                    <div class="form-group col-lg-3 col-12">
                        <label for="_edNumPedidoFat" class="text-danger">Forma Pagto</label>
                        <select name="_ddlFormaPagto" id="_ddlFormaPagto" class="form-control">
                            <option value="0">Selecionar</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-3 col-12">
                        <label for="_ddlParcelas" class="text-danger">Qtde Parcelas</label>
                        <select name="_ddlParcelas" id="_ddlParcelas" class="form-control">
                            <option value="1">Á Vista</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        //Array de parametros 'chave=valor'
        var params = window.location.search.substring(1).split('&');

        //Criar objeto que vai conter os parametros
        var paramArray = {};

        //Passar por todos os parametros
        for (var i = 0; i < params.length; i++) {
            //Dividir os parametros chave e valor
            var param = params[i].split('=');

            //Adicionar ao objeto criado antes
            paramArray[param[0]] = param[1];
        }

        if (paramArray["Id"] != null && paramArray["Id"] != "") {
            showLoad('Aguarde!<br>Carregando as informações.');
            TrocaTela('#pnl_Pesq', '#Pnl_CadAtu');
            $('#_edCod').val(paramArray["Id"]);
            BuscaDados(paramArray["Id"]);
        }

        atualizaGridPrincipal();

    });

    function BuscaDadosFormaPagamento() {
        debugger;
        $.ajax({
            url: "../../Api/FormasDePagamento/GetBuscarTodasFormasPagtos.php",
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                var dados = data.FormasPagtos;
                console.log(dados);
                var selectbox = $('#_ddlFormaPagto');
                selectbox.find('option').remove();
                dados.forEach(function(o, index) {
                    $('<option>').val(o.Id).text(o.FormaPagamento.toUpperCase()).appendTo(selectbox);
                });
                $('<option>').val('').text('Selecionar').appendTo(selectbox);
                $('#_ddlFormaPagto option[value=""]').attr('selected', 'selected');
            }
        });
    }

    function BuscaSituacaoPedido(codPedido) {
        var situacao = null;

        $.ajax({
            url: "../../Api/Pedidos/GetBuscarSituacaoPedido.php?Id=" + codPedido,
            type: 'GET',
            async: false,
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

    function ProcessarPedido() {
        var codPedido = $("#_edCod").val();
        var sit = BuscaSituacaoPedido(codPedido);

        if (sit != "N") {
            WarningBox("Somente pedidos novos podem ser Processados.");
            return;
        }
    }

    function CancelarPedido() {
        var codPedido = $("#_edCod").val();
        var sit = BuscaSituacaoPedido(codPedido);

        if (sit != "N" && sit != 'P') {
            WarningBox("Somente pedidos novos ou processados podem ser Cancelados.");
            return;
        }
    }

    function FaturarPedido() {
        var codPedido = $("#_edCod").val();
        var codCanal = $("#_edCodCanal").val();
        var sit = BuscaSituacaoPedido(codPedido);
        if (sit != 'P') {
            WarningBox("Somente pedidos processados podem ser Faturados.");
            return;
        }

        BuscaDadosFormaPagamento();
        var numPedido = $("#_edNumPedidoFat");
        var vlrPedido = $("#_edVlrPedidoFat");
        var txComissao = $("#_edTxComFat");
        var vlrComissao = $("#_edVlrComFat");

        numPedido.val($("#_edNumPedido").val());
        vlrPedido.val($("#_lblVlrPedido").text());
        txComissao.val($("#_lblTaxaComissao").text());
        vlrComissao.val($("#_lblValorComissao").text());

        if (codCanal == 4) {
            $("#_linhaComissaoFat").addClass("display-show");
            $("#_linhaComissaoFat").removeClass("display-hide");
        } else {
            $("#_linhaComissaoFat").removeClass("display-show");
            $("#_linhaComissaoFat").addClass("display-hide");
        }

        $("#modalFaturarPedido").modal('show');
    }

    function AdicionarNovoItem() {
        var codPedido = $("#_edCod").val();
        var sit = BuscaSituacaoPedido(codPedido);

        if (sit != "N") {
            WarningBox("Só é possivel adicionar ou retirar itens do pedido quando o mesmo estiver em status de NOVO.");
            return;
        }

        $("#_modalNovoItem").show();
    }

    function LimparCamposSelecao(cod, text) {
        $(cod).val("");
        $(text).val("");
    }

    function AbrirModalSelecionarCliente() {
        atualizaGridCliente();
        $('#modalSelCliente').modal('show');
    }

    function AbrirModalSelecionarVendedor() {
        atualizaGridVendedor();
        $('#modalSelVendedor').modal('show');
    }

    function LimparCampos() {
        $('#_edCod').val('');
        $('#_edDescricao').val('');
        $('#_ddlTipo').val('');
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

    function atualizaGridItens() {
        //debugger;
        if ($.fn.DataTable.isDataTable('#_gridItens')) {
            var table = $('#_gridItens').DataTable();
            table.destroy();
            CarregaGridItens();
        } else {
            CarregaGridItens();
        }
    }

    function atualizaGridCliente() {
        //debugger;
        if ($.fn.DataTable.isDataTable('#_gridPesqCliente')) {
            var table = $('#_gridPesqCliente').DataTable();
            table.destroy();
            CarregaGridSelCliente()
        } else {
            CarregaGridSelCliente()
        }
    }

    function atualizaGridVendedor() {
        //debugger;
        if ($.fn.DataTable.isDataTable('#_gridPesqVendedor')) {
            var table = $('#_gridPesqVendedor').DataTable();
            table.destroy();
            CarregaGridSelVendedor();
        } else {
            CarregaGridSelVendedor();
        }
    }

    function TrocaTela(h, s) {
        //s -> Tela a ser mostrada
        //h -> Tela a ser ocultada
        $(h).removeClass("display-show");
        $(h).addClass("display-hide");

        $(s).removeClass("display-hide");
        $(s).addClass("display-show");

    }

    function VoltarTelaPesq() {
        showLoad('Aguarde!');
        LimparCampos();
        TrocaTela('#Pnl_CadAtu', '#pnl_Pesq');
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
        var descricao = $('#_edDescricao').val();
        var tipo = $('#_ddlTipo').val();

        if (!descricao) {
            $('#_edDescricao').focus();
            hideLoad();
            WarningBox('O Campo Descricao é obrigatório');
        }

        if (!tipo || tipo == "0") {
            $('#_ddlTipo').focus();
            hideLoad();
            WarningBox('O campo Tipo é obrigatório');
            return;
        }

        var obj = {
            Id: cod,
            Descricao: descricao,
            Tipo: tipo
        };


        var obj = {
            Id: cod,
            Descricao: descricao,
            Tipo: tipo
        };

        if (!cod) { //INSERT
            showLoad('Aguarde!<br>Inserindo Novo Registro.');

            console.log(obj);
            console.log(JSON.stringify(obj));
            $.ajax({
                url: "Api/PlanoDeContas/PostInserePlanoDeContas.php",
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

    function AbrirPedido(cod) {
        showLoad('Aguarde!<br>Carregando as informações.');
        TrocaTela('#pnl_Pesq', '#Pnl_CadAtu');
        $('#_edCod').val(cod);
        BuscaDados(cod);
    }

    function Cadastrar() {
        var data = new Date;
        showLoad('Aguarde!');
        TrocaTela('#pnl_Pesq', '#Pnl_CadAtu');
        $("#_edData").val(data.getDate());
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
            url: "../../Api/Pedidos/GetBuscaPedidoPorCodigo.php?Id=" + cod,
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                var dados = data.Pedido;
                if (data.Transcod == 0) {
                    hideLoad();
                    ErrorBox(data.msg);
                } else {
                    hideLoad();
                    var lblStatus = $("#_lblStatus");
                    var lblvlrPedido = $("#_lblVlrPedido");
                    var lblItensPedido = $("#_lblItensPedido");
                    var edNumPedido = $("#_edNumPedido");
                    var edCodCliente = $("#_edCodCliente");
                    var edCliente = $("#_edCliente");
                    var edCodColaborador = $("#_edCodColaborador");
                    var edColaborador = $("#_edColaborador");
                    var edCodCanal = $("#_edCodCanal");
                    var edCanal = $("#_edCanal");

                    edCodCanal.val(dados.IdCanalVenda);
                    edCanal.val(dados.CanalVenda);

                    sessionStorage.setItem("Situacao", dados.CodStatus);
                    atualizaGridItens();
                    if (dados.IdCanalVenda == 4) {
                        $("#linhaRevenda").removeClass("display-hide");
                        $("#linhaRevenda").addClass("display-show");

                        $("#linhaColCli").removeClass("display-show");
                        $("#linhaColCli").addClass("display-hide");

                        $('#_edCodRevendedor').val(dados.IdRevendedor);
                        $('#_edRevendedor').val(dados.Revendedor);

                        $('#_lblTaxaComissao').text(dados.TaxaComissao + '%');
                        $('#_lblValorComissao').text('R$' + dados.ValorComissao);
                    } else {
                        $("#linhaRevenda").addClass("display-hide");
                        $("#linhaRevenda").removeClass("display-show");

                        $("#linhaColCli").addClass("display-show");
                        $("#linhaColCli").removeClass("display-hide");

                        edCodCliente.val(dados.IdCliente);
                        edCliente.val(dados.Cliente);

                        edCodColaborador.val(dados.IdColaborador);
                        edColaborador.val(dados.Colaborador);

                    }

                    $('#_edData').val(dados.DataPedidoSemFormatar);
                    edNumPedido.val(res.NumeroPedido);
                    if (dados.CodStatus == 'N') {
                        lblStatus.addClass("badge-primary");
                        lblStatus.removeClass("badge-secondary");
                        lblStatus.removeClass("badge-success");
                        lblStatus.removeClass("badge-danger");
                        lblStatus.removeClass("badge-warning");

                        lblStatus.text('NOVO');
                    } else if (dados.CodStatus == 'C') {
                        lblStatus.removeClass("badge-primary");
                        lblStatus.removeClass("badge-secondary");
                        lblStatus.removeClass("badge-success");
                        lblStatus.addClass("badge-danger");
                        lblStatus.removeClass("badge-warning");

                        lblStatus.text('CANCELADO');
                    } else if (dados.CodStatus == 'P') {
                        lblStatus.removeClass("badge-primary");
                        lblStatus.removeClass("badge-secondary");
                        lblStatus.removeClass("badge-success");
                        lblStatus.removeClass("badge-danger");
                        lblStatus.addClass("badge-warning");

                        lblStatus.text('PROCESSADO');
                    } else {
                        lblStatus.removeClass("badge-primary");
                        lblStatus.removeClass("badge-secondary");
                        lblStatus.addClass("badge-success");
                        lblStatus.removeClass("badge-danger");
                        lblStatus.removeClass("badge-warning");

                        lblStatus.text('FATURADO');
                    }

                    lblvlrPedido.text("R$ " + dados.ValorPedido);
                    lblItensPedido.text(dados.QuantidadeItens);

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

    function CarregaGridItens() {
        showLoad('Carregando Informações!');
        var codPedido = $("#_edCod").val();
        $.ajax({
            url: "../../Api/Pedidos/GetBuscaTodosItensPedido.php?Id=" + codPedido,
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                var dados = data.Itens;
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
                            "data": "SKU",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        }, {
                            "data": "Produto",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "ValorUnitario",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>R$ ' + data + '</label>';
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
                            "data": "ValorTotal",
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
                                    data = '<div class="btn btn-danger " onclick="RemoverItem(' + data + ')"><i class="icone-trash"></i></div>';
                                }

                                return data;
                            }
                        }
                    ]
                });
            }
        });

    }

    //Carregando Grid Pincipal
    function CarregaGridPrincipal() {
        showLoad('Carregando Informações!');

        $.ajax({
            url: "../../Api/Pedidos/GetBuscaTodosPedidos.php",
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                var dados = data.Pedidos;
                console.log(dados);
                hideLoad();
                $('#_gridPesq').DataTable({
                    "ordering": false,
                    "searching": false,
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
                            var ret = '';
                            if (type === 'display') {
                                $.ajax({
                                    url: "../../Api/Pedidos/GetBuscaPedidoPorCodigo.php?Id=" + data,
                                    type: 'GET',
                                    async: false,
                                    contentType: "application/json; charset=utf-8",
                                    dataType: "json",
                                    data: {},
                                    success: function(resultado) {
                                        debugger;
                                        res = resultado.Pedido;
                                        var bgFundo = '';
                                        if (res.CodStatus == 'N') {
                                            bgFundo = 'alert-primary';
                                        } else if (res.CodStatus == 'C') {
                                            bgFundo = 'alert-danger';
                                        } else if (res.CodStatus == 'P') {
                                            bgFundo = 'alert-warning';
                                        } else {
                                            bgFundo = 'alert-success';
                                        }

                                        ret = '<div style="cursor:pointer; padding:10px" class="container-fluid ' + bgFundo + '" onclick="AbrirPedido(' + res.Id + ')">';
                                        ret = ret + '     <div class="row">';
                                        ret = ret + '         <div class="col-12 col-lg-4">';
                                        ret = ret + '             <strong>Pedido:</strong> ' + res.NumeroPedido;
                                        ret = ret + '         </div>';
                                        ret = ret + '         <div class="col-12 col-lg-4">';
                                        ret = ret + '         <strong>Status: </strong> ' + res.Status;
                                        ret = ret + '         </div>';
                                        ret = ret + '         <div class="col-12 col-lg-4">';
                                        ret = ret + '         <strong>Data: </strong> ' + res.DataPedido;
                                        ret = ret + '         </div>';
                                        ret = ret + '     </div>';
                                        if (res.IdCanalVenda == 4) {
                                            ret = ret + '     <div class="row">';
                                            if (res.Revendedor) {
                                                ret = ret + '         <div class="col-12 col-lg-4">';
                                                ret = ret + '             <strong>Revendedor:</strong> ' + res.IdRevendedor + ' - ' + res.Revendedor;
                                                ret = ret + '         </div>';
                                            }

                                            if (res.ValorComissao) {
                                                ret = ret + '         <div class="col-12 col-lg-4">';
                                                ret = ret + '             <strong>Comissão:</strong> R$ ' + res.ValorComissao;
                                                ret = ret + '         </div>';
                                            }

                                            if (res.TaxaComissao) {
                                                ret = ret + '         <div class="col-12 col-lg-4">';
                                                ret = ret + '             <strong>Taxa Comissão:</strong> ' + res.TaxaComissao + '%';
                                                ret = ret + '         </div>';
                                            }
                                            ret = ret + '     </div>';
                                        } else {
                                            ret = ret + '     <div class="row">';
                                            if (res.Colaborador) {
                                                ret = ret + '         <div class="col-12 col-lg-4">';
                                                ret = ret + '             <strong>Colaborador:</strong> ' + res.IdColaborador + ' - ' + res.Colaborador;
                                                ret = ret + '         </div>';
                                            }

                                            if (res.Cliente) {
                                                ret = ret + '         <div class="col-12 col-lg-4">';
                                                ret = ret + '             <strong>Cliente:</strong> ' + res.IdCliente + ' - ' + res.Cliente;
                                                ret = ret + '         </div>';
                                            }
                                            ret = ret + '     </div>';
                                        }





                                        ret = ret + '     <div class="row">';
                                        ret = ret + '         <div class="col-12 col-lg-4">';
                                        ret = ret + '             <strong>Valor Total: </strong> R$ ' + res.ValorPedido;
                                        ret = ret + '         </div>';
                                        ret = ret + '         <div class="col-12 col-lg-4">';
                                        ret = ret + '             <strong>Itens: </strong> ' + res.QuantidadeItens;
                                        ret = ret + '         </div>';
                                        ret = ret + '         <div class="col-12 col-lg-4">';
                                        ret = ret + '             <strong>Canal de venda: </strong> ' + res.IdCanalVenda + ' - ' + res.CanalVenda;
                                        ret = ret + '         </div>';
                                        ret = ret + '     </div>';
                                        ret = ret + ' </div>';


                                    }
                                });
                            }

                            return ret;
                        }
                    }]
                });
            }
        });

    }


    function SelecionarCliente(cod) {
        $.ajax({
            url: "Api/Clientes/PostBuscaDadosClientePorCod.php?id=" + cod,
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                var dados = JSON.parse(data);
                console.log(dados);
                hideLoad();
                $('#_edCodCliente').val(dados[0].id);
                $('#_edCliente').val(dados[0].cliente);
                $('#modalSelCliente').modal('hide');
            }
        });
    }

    function CarregaGridSelCliente() {
        showLoad('Carregando Informações!');

        $.ajax({
            url: "Api/Clientes/GetBuscarTodosClientesAtivos.php",
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                var dados = JSON.parse(data);
                console.log(dados);
                hideLoad();
                $('#_gridPesqCliente').DataTable({
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
                            "data": "id",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data =
                                        '<div style="cursor:pointer;" onClick="SelecionarCliente(' +
                                        data +
                                        ')" class="btn btn-success"><i class="icone-check"></i></div>';
                                }

                                return data;
                            }
                        }, {
                            "data": "id",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "cliente",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "cpf",
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

    function SelecionarVendedor(cod) {
        $.ajax({
            url: "Api/Vendedor/GetBuscarTodosVendedoresPorCod.php?id=" + cod,
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                var dados = JSON.parse(data);
                console.log(dados);
                hideLoad();
                $('#_edCodVendedor').val(dados[0].id);
                $('#_edVendedor').val(dados[0].nomeAbv);
                $('#modalSelVendedor').modal('hide');
            }
        });
    }


    function CarregaGridSelVendedor() {
        showLoad('Carregando Informações!');

        $.ajax({
            url: "Api/Vendedor/GetBuscarTodosVendedores.php",
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                var dados = JSON.parse(data);
                console.log(dados);
                hideLoad();
                $('#_gridPesqVendedor').DataTable({
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
                            "data": "id",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data =
                                        '<div style="cursor:pointer;" onClick="SelecionarVendedor(' +
                                        data +
                                        ')" class="btn btn-success"><i class="icone-check"></i></div>';
                                }

                                return data;
                            }
                        }, {
                            "data": "id",
                            "render": function(data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<label>' + data + '</label>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "nomeAbv",
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
</script>

<?php include '../footerTelas.inc.php'; ?>