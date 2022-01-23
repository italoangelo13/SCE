<?php include '../headerTelas.inc.php'; ?>

<div class="row bg-fariamodas text-fariamodas-gold">
    <div class="col-lg-12 text-lg-right text-center">
        <h5>Gestão de Plano de contas</h5>
    </div>
</div>

<div class="row alert alert-info">
    <div class="col-lg-12 text-center">No Painel de Gestão de Plano de contas, você poderá Cadastrar, alterar, Pesquisar
        e excluir seus planos de contas. Estes Planos de contas são mecanismos usados para categorizar seus registros
        financeiros, classificando-os entre receitas e despesas.</div>
</div>

<div id="pnl_Pesq" class="display-show">
    <div class="row alert-secondary" style="padding: 10px;">
        <div class="col-lg-12">
            <div class="btn btn-primary " onclick="Cadastrar()">
                <i class="icone-plus"></i> Cadastrar Plano de Contas
            </div>
            <div class="btn btn-secondary" onclick="GerarRelatorio()">
                <i class="icone-print"></i>Relatorio
            </div>
        </div>
    </div>


    <div class="row bg-light" style="margin-top:5px; padding:5px;">
        <div class="col-lg-12">
            <table id="_gridPesq" class="table table-striped text-center ">
                <thead class="bg-fariamodas text-fariamodas-gold">
                    <tr>
                        <th>Id</th>
                        <th>Plano de Contas</th>
                        <th>Tipo</th>
                        <th>Editar</th>
                        <th>Excluir</th>
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
        <div class="col-lg-12">
            <div class="btn-group">
                <div class="btn btn-dark" onclick="VoltarTelaPesq('#Pnl_CadAtu')"> <i class="icone-back"></i>Voltar</div>
                <div class="btn btn-danger" onclick="LimparCampos()"> <i class="icone-cancel"></i> Limpar</div>
                <div class="btn btn-success" onclick="InsereAtualiza()"><i class="icone-floppy"></i> Salvar</div>
            </div>
        </div>
    </div>
    <div class="row bg-fariamodas text-fariamodas-gold" style="margin-top:5px;">
        <div class="col-lg-12 text-center">
            Dados do Plano de Contas
        </div>
    </div>
    <div class="row bg-white" style="margin-top:5px;">
        <div class="form-group col-lg-2">
            <label for="_edCod">Cod</label>
            <input type="text" value="" class="form-control" id="_edCod" name="_edCod" readonly>
        </div>
        <div class="form-group col-lg-5">
            <label for="_edDescricao" class="text-danger">Descrição</label>
            <input type="text" value="" class="form-control" maxlength="255" id="_edDescricao" name="_edDescricao">
        </div>
        <div class="form-group col-lg-3">
            <label for="_ddlTipo" class="text-danger">Tipo</label>
            <Select class="form-control" required id="_ddlTipo" name="_ddlTipo">
                <option value="">Selecionar</option>
            </Select>
        </div>
    </div>
</div>



<div id="Pnl_GerRel" class="display-hide">
    <form action="../../Relatorios/PlanoDeContas/RelPlanContas.php" method="post" target="_blank">
    <div class="row" style="margin-top:5px;">
        <div class="col-lg-12">
            <div class="btn-group">
                <div class="btn btn-dark" onclick="VoltarTelaPesq('#Pnl_GerRel')"> <i class="icone-back"></i>Voltar</div>
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
<script>
$(document).ready(function() {
    atualizaGridPrincipal();
    BuscaDadosTodosTipos();

});

function LimparCampos() {
    $('#_edCod').val('');
    $('#_edDescricao').val('');
    $('#_ddlTipo').val('');
}


function LimparCamposRel() {
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

function TrocaTela(h, s) {
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
            url: "../../Api/PlanoDeContas/PostInserePlanoDeContas.php",
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
            url: "../../Api/PlanoDeContas/PutAtualizarPlanoDeContasPorCod.php",
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
        url: "../../Api/PlanoDeContas/DeleteExcluirPlanoDeContasPorCod.php",
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
        url: "../../Api/PlanoDeContas/GetBuscarDadosPlanoDeContas.php?Id="+cod,
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
        url: "../../Api/TiposPlanoDeContas/GetBuscarTodosTipos.php",
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
        url: "../../Api/PlanoDeContas/GetBuscarTodosPlanosDeContas.php",
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
                        "data": "id",
                        "render": function(data, type, row, meta) {
                            if (type === 'display') {
                                data = '<label>' + data + '</label>';
                            }

                            return data;
                        }
                    },
                    {
                        "data": "plano",
                        "render": function(data, type, row, meta) {
                            if (type === 'display') {
                                data = '<label>' + data + '</label>';
                            }

                            return data;
                        }
                    },
                    {
                        "data": "tipo",
                        "render": function(data, type, row, meta) {
                            if (type === 'display') {
                                data = '<label>' + data + '</label>';
                            }

                            return data;
                        }
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) {
                            if (type === 'display') {
                                data =
                                    '<div style="cursor:pointer;" onClick="Atualiza(' +
                                    data +
                                    ')" class="btn btn-success"><i class="icone-pencil"></i></div>';
                            }

                            return data;
                        }
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) {
                            if (type === 'display') {
                                data =
                                    '<div style="cursor:pointer;" onClick="Deleta(' +
                                    data +
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
</script>

<?php include '../footerTelas.inc.php'; ?>