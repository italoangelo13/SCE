<?php include '../headerTelas.inc.php'; ?>

<div class="row bg-fariamodas text-fariamodas-gold">
    <div class="col-lg-12 text-lg-right text-center">
        <h5>Gestão de Contas a Receber</h5>
    </div>
</div>



<div id="pnl_Pesq" class="display-show">
    <div class="row alert alert-info">
        <div class="col-lg-12 text-center">No Painel de Gestão de Contas a Receber, você poderá Cadastrar, alterar, Pesquisar
            e excluir Todas as suas contas a receber. Você tambem poderá emitir duplicatas de pagamentos realizar baixa de contas pagas.</div>
    </div>

    <div class="row alert-secondary" style="padding: 10px;">
        <div class="col-lg-12">
            <div class="btn btn-primary " onclick="Cadastrar()">
                <i class="icone-plus"></i> Nova Conta a Receber
            </div>
            <div class="btn btn-dark " onclick="GerarRelatorio()">
                <i class="icone-print"></i> Gerar Relatorio
            </div>
        </div>
    </div>

    <div class="row alert-dark" style="padding: 10px; margin-top:5px;">

        <div class="col-lg-6">
            <label for="">Pesquisar Por</label>
            <div class="container-fluid" style="padding: 1px;">
                <div class="row">
                    <div class="col-lg-4">
                        <select name="" id="" class="form-control">
                            <option value="">Codigo</option>
                            <option value="">Dt. Vencimento</option>
                            <option value="">Num. Pedido</option>
                            <option value="">Cod. Cliente</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="_edPesquisa">
                    </div>
                    <div class="col-lg-2">
                        <div class="btn btn-primary">
                            <i class="icone-search-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <label for="">Ordenar Por</label>
            <div class="container-fluid" style="padding: 1px;">
                <div class="row">
                    <div class="col-lg-9">
                        <input type="radio" name="order" id="_edOrderCarcod" value="carcod" checked> <label for="_edOrderCarcod">Código</label>
                        <input type="radio" name="order" id="_edOrderDtVenc" value="carcod"> <label for="_edOrderDtVenc">Dt. Vencimento</label>
                        <input type="radio" name="order" id="_edOrderNumPed" value="carcod"> <label for="_edOrderNumPed">Num. Pedido</label>
                        <input type="radio" name="order" id="_edOrderCliente" value="carcod"> <label for="_edOrderCliente">Cod. Cliente</label>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row bg-light" style="margin-top:5px; padding:5px;">
        <div class="col-lg-12">
            <table id="_gridPesq" class="table table-striped">
                <thead class="bg-fariamodas text-fariamodas-gold">
                    <tr>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="Pnl_CadAtu" class="display-hide">
    <div class="row" style="margin-top: 5px; background: lightgray; padding: 20px;">
        <div class="col-lg-3">

        </div>
        <div class="col-lg-6" style="background: whitesmoke;  padding: 10px; ">
            <div class="container-fluid">
                <div class="row" style="padding: 5px;">
                    <div class="col-lg-6 text-left">
                        <div class="btn-group">
                            <div class="btn btn-dark" onclick="VoltarTelaPesq()"> <i class="icone-back"></i>Voltar</div>
                            <div class="btn btn-danger" onclick="LimparCampos()"> <i class="icone-cancel"></i> Limpar</div>
                            <div class="btn btn-success" onclick="InsereAtualiza()"><i class="icone-floppy"></i> Salvar</div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-right">
                        <div class="btn-group">
                            <div class="btn btn-success" onclick="ProcessarPedido()"> <i class="icone-money"></i> Baixar C.R.</div>
                            <div class="btn btn-danger" onclick="CancelarPedido()"> <i class="icone-cancel"></i> Cancelar C.R.</div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 5px;">
                    <div class="col-lg-12 bg-fariamodas text-fariamodas-gold">
                        <i class="icone-doc-alt"></i> Informações da C.R.
                    </div>
                </div>
                <div class="row" style="padding: 5px;">
                    <div class="col-lg-3">
                        <label for="_edCod">Cod</label>
                        <input type="text" value="" class="form-control" id="_edCod" name="_edCod" readonly>
                    </div>
                </div>
                <div class="row" style="padding: 5px;">
                    <div class="col-lg-6">
                        <label for="_edDesc">Descrição</label> <span class="text-muted" style="font-size: 10pt;">max 150 caract.</span>
                        <input type="text" value="" class="form-control" id="_edDesc" name="_edDesc">
                    </div>
                    <div class="col-lg-6">
                        <label for="_edPdc">Plano de Contas</label>
                        <input type="hidden" value="" class="form-control" id="_edCodPdc" name="_edCodPdc">
                        <input type="text" value="" class="form-control" id="_edPdc" name="_edPdc">
                    </div>


                </div>
                


                <div class="row" style="padding: 5px;">

                    <div class="col-lg-6">
                        <label for="_edCrt">Carteira</label>
                        <input type="hidden" value="" class="form-control" id="_edCodCrt" name="_edCodCrt">
                        <input type="text" value="" class="form-control" id="_edCrt" name="_edCrt">
                    </div>
                    <div class="col-lg-6">
                        <label for="_edCli">Cliente</label>
                        <input type="hidden" value="" class="form-control" id="_edCodCli" name="_edCodCli">
                        <input type="text" value="" class="form-control" id="_edCli" name="_edCli">
                    </div>
                </div>

                <div class="row" style="padding: 5px;">
                    <div class="col-lg-4">
                        <label for="_edDtVenc">Dt. Vencimento</label>
                        <input type="date" value="" class="form-control" id="_edDtVenc" name="_edDtVenc">
                    </div>
                    <div class="col-lg-4">
                        <label for="_edVlrCr">Valor C.R.</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">R$</div>
                            </div>
                            <input type="text" value="" onkeypress="Mascara(this,Valor)" class="form-control" id="_edVlrCr" name="_edVlrCr">
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <label for="_edPagto">Forma de Pagamento</label>
                        <input type="text" value="" class="form-control" id="_edPagto" name="_edPagto">
                    </div>
                </div>
                <div class="row" style="padding: 5px;">
                    <div class="col-lg-12">
                        <label for="_edObs">Observação</label> <span class="text-muted" style="font-size: 10pt;">max 500 caract.</span>
                        <textarea class="form-control" id="_edObs" name="_edObs"  rows="10"></textarea>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">

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


        //autocomplete digitando
        $('#_edPdc').keyup(function() {
            $.ajax({
                type: 'GET',
                url: '../../Api/PlanoDeContas/GetBuscarTodosPlanosDeContas.php',
                dataType: "json",
                success: function(data) {
                    var PlanoContas = data.PlanoContas;
                    var ArrayPdc = [];
                    PlanoContas.forEach(e => {
                        ArrayPdc.push(e.Id + " - " + e.Descricao);
                    });
                    console.log(ArrayPdc);
                    //console.log(PlanoContas);
                    $("#_edPdc").autocomplete({
                        source: ArrayPdc,
                        minLength: 0,
                        select: function(event, ui) {
                            $("#_edPdc").val(ui.item.label);
                        },
                    });
                }

            });

        });

        $('#_edCrt').keyup(function() {
            $.ajax({
                type: 'GET',
                url: '../../Api/Carteiras/GetBuscarTodasCarteiras.php',
                dataType: "json",
                success: function(data) {
                    var Carteiras = data.Carteiras;
                    var ArrayCrt = [];
                    Carteiras.forEach(e => {
                        ArrayCrt.push(e.Id + " - " + e.Descricao);
                    });
                    console.log(ArrayCrt);
                    //console.log(PlanoContas);
                    $("#_edCrt").autocomplete({
                        source: ArrayCrt,
                        minLength: 0,
                        select: function(event, ui) {
                            $("#_edCrt").val(ui.item.label);
                        },
                    });
                }

            });

        });


        $('#_edCli').keyup(function() {
            $.ajax({
                type: 'GET',
                url: '../../Api/Clientes/GetBuscarTodosClientesAtivos.php',
                dataType: "json",
                success: function(data) {
                    var Clientes = data.Clientes;
                    var ArrayCli = [];
                    Clientes.forEach(e => {
                        ArrayCli.push(e.Id + " - " + e.Nome);
                    });
                    console.log(ArrayCli);
                    //console.log(PlanoContas);
                    $("#_edCli").autocomplete({
                        source: ArrayCli,
                        minLength: 0,
                        select: function(event, ui) {
                            $("#_edCli").val(ui.item.label);
                        },
                    });
                }

            });

        });


        $('#_edPagto').keyup(function() {
            $.ajax({
                type: 'GET',
                url: '../../Api/Clientes/GetBuscarTodosClientesAtivos.php',
                dataType: "json",
                success: function(data) {
                    var Clientes = data.Clientes;
                    var ArrayCli = [];
                    Clientes.forEach(e => {
                        ArrayCli.push(e.Id + " - " + e.Nome);
                    });
                    console.log(ArrayCli);
                    //console.log(PlanoContas);
                    $("#_edCli").autocomplete({
                        source: ArrayCli,
                        minLength: 0,
                        select: function(event, ui) {
                            $("#_edCli").val(ui.item.label);
                        },
                    });
                }

            });

        });

        //autocomplete clicando
        $('#_edPdc').focus(function() {
            $.ajax({
                type: 'GET',
                url: '../../Api/PlanoDeContas/GetBuscarTodosPlanosDeContas.php',
                dataType: "json",
                success: function(data) {
                    var PlanoContas = data.PlanoContas;
                    var ArrayPdc = [];
                    PlanoContas.forEach(e => {
                        ArrayPdc.push(e.Id + " - " + e.Descricao);
                    });
                    console.log(ArrayPdc);
                    //console.log(PlanoContas);
                    $("#_edPdc").autocomplete({
                        source: ArrayPdc,
                        minLength: 0,
                        select: function(event, ui) {
                            $("#_edPdc").val(ui.item.label);
                        },
                    });
                }

            });

        });

        $('#_edCrt').focus(function() {
            $.ajax({
                type: 'GET',
                url: '../../Api/Carteiras/GetBuscarTodasCarteiras.php',
                dataType: "json",
                success: function(data) {
                    var Carteiras = data.Carteiras;
                    var ArrayCrt = [];
                    Carteiras.forEach(e => {
                        ArrayCrt.push(e.Id + " - " + e.Descricao);
                    });
                    console.log(ArrayCrt);
                    //console.log(PlanoContas);
                    $("#_edCrt").autocomplete({
                        source: ArrayCrt,
                        minLength: 0,
                        select: function(event, ui) {
                            $("#_edCrt").val(ui.item.label);
                        },
                    });
                }

            });

        });


        $('#_edCli').focus(function() {
            $.ajax({
                type: 'GET',
                url: '../../Api/Clientes/GetBuscarTodosClientesAtivos.php',
                dataType: "json",
                success: function(data) {
                    var Clientes = data.Clientes;
                    var ArrayCli = [];
                    Clientes.forEach(e => {
                        ArrayCli.push(e.Id + " - " + e.Nome);
                    });
                    console.log(ArrayCli);
                    //console.log(PlanoContas);
                    $("#_edCli").autocomplete({
                        source: ArrayCli,
                        minLength: 0,
                        select: function(event, ui) {
                            $("#_edCli").val(ui.item.label);
                        },
                    });
                }

            });

        });

        atualizaGridPrincipal();

    });

    function BuscaDadosPedido() {
        var numPedido = $("#_edNumPedido").val();
        $.ajax({
            url: "../../Api/Pedidos/GetBuscaPedidoPorCodigo.php?Id=" + numPedido,
            type: 'GET',
            async: false,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(resultado) {
                debugger;
                res = resultado.Pedido;
                console.log(res);
                $("#_edCnl").val(res.IdRevendedor + " - " + res.Revendedor)
                if (res.IdCanalVenda == 4) {
                    $("#_edRev").val(res.IdRevendedor + " - " + res.Revendedor)
                } else {

                }
            }
        });
    }


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