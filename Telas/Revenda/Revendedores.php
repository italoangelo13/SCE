<?php include '../headerTelas.inc.php'; ?>

<div class="row bg-fariamodas text-fariamodas-gold">
    <div class="col-lg-12 text-lg-right text-center">
        <h5>Gestão de Revendedores</h5>
    </div>
</div>

<div class="row alert alert-info">
    <div class="col-lg-12 text-center">No Painel de Gestão de Revendedores, você poderá Cadastrar, alterar, Pesquisar
        e excluir seus Revendedores. Estes Revendedores, são pessoas que estarão comercializando seus produtos por você sem qualquer vinculo empregaticio.
    </div>
</div>

<div id="pnl_Pesq" class="display-show">
    <div class="row alert-secondary" style="padding: 10px;">
        <div class="col-lg-12">
            <div class="btn btn-primary " onclick="Cadastrar()">
                <i class="icone-plus"></i> Cadastrar Revendedor
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
                        <th>Revendedor</th>
                        <th>CPF</th>
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
            Dados do Revendedor
        </div>
    </div>
    <div class="row bg-white" style="margin-top:5px;">
        <div class="form-group col-lg-2">
            <label for="_edCod">Cod</label>
            <input type="text" value="" class="form-control" id="_edCod" name="_edCod" readonly>
        </div>
        <div class="form-group col-lg-4">
            <label for="_edNome" class="text-danger">Nome</label>
            <input type="text" value="" class="form-control" maxlength="255" id="_edNome" name="_edNome">
        </div>
        <div class="form-group col-lg-2">
            <label for="_edCpf" class="text-danger">CPF</label>
            <input type="text" onkeyup="Mascara(this,Cpf)" value="" class="form-control" maxlength="14" id="_edCpf" name="_edCpf">
        </div>
        <div class="form-group col-lg-2">
            <label for="_edRg">RG</label>
            <input type="text" value="" class="form-control" maxlength="255" id="_edRg" name="_edRg">
        </div>
        <div class="form-group col-lg-2">
            <label for="_edData" class="text-danger">Data Inicio do Contrato</label>
            <input type="date" value="" class="form-control" maxlength="10" id="_edData" name="_edData">
        </div>
    </div>
    <div class="row alert-secondary" style="margin-top:5px;">
        <div class="form-group col-lg-5">
            <label for="_edEndereco">Endereço</label>
            <input type="text" value="" class="form-control" maxlength="255" id="_edEndereco" name="_edEndereco">
        </div>
        <div class="form-group col-lg-3">
            <label for="_edBairro">Bairro</label>
            <input type="text" value="" class="form-control" maxlength="255" id="_edBairro" name="_edBairro">
        </div>
        <div class="form-group col-lg-3">
            <label for="_edMunicipio">Cidade</label>
            <input type="text" value="" class="form-control" maxlength="255" id="_edMunicipio" name="_edMunicipio">
        </div>
        <div class="form-group col-lg-1">
            <label for="_edUf">UF</label>
            <select class="form-control" id="_edUf" name="_edUf">
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
                <option value="MG" selected>MG</option>
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
            </select>
        </div>
    </div>
    <div class="row bg-white" style="margin-top:5px;">
        <div class="form-group col-lg-2">
            <label for="_edCep">Cep</label>
            <input type="text" onkeyup="Mascara(this,Cep)" value="" class="form-control" id="_edCep" name="_edCep">
        </div>
        <div class="form-group col-lg-2">
            <label for="_edTelefone">Telefone</label>
            <input type="text" value="" onkeyup="Mascara(this,Telefone)" class="form-control" id="_edTelefone" name="_edTelefone">
        </div>


    </div>
</div>



<div id="Pnl_GerRel" class="display-hide">
    <form action="Relatorios/PlanoDeContas/RelPlanContas.php" method="post" target="_blank">
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
        $('#_edNome').val('');
        $('#_edCpf').val('');
        $('#_edRg').val('');
        $('#_edData').val('');
        $('#_edEndereco').val('');
        $('#_edBairro').val('');
        $('#_edMunicipio').val('');
        $('#_edUf').val('MG');
        $('#_edCep').val('');
        $('#_edTelefone').val('');
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
        var nome = $('#_edNome').val();
        var cpf = $('#_edCpf').val();
        var rg = $('#_edRg').val();
        var dataIniciocontrato = $('#_edData').val();
        var endereco = $('#_edEndereco').val();
        var bairro = $('#_edBairro').val();
        var cidade = $('#_edMunicipio').val();
        var uf = $('#_edUf').val();
        var cep = $('#_edCep').val();
        var telefone = $('#_edTelefone').val();

        if (!nome) {
            $('#_edNome').focus();
            hideLoad();
            WarningBox('O Campo Nome é obrigatório');
        }

        if (!cpf) {
            $('#_edNome').focus();
            hideLoad();
            WarningBox('O Campo CPF é obrigatório');
        }

        if (!dataIniciocontrato) {
            $('#_edNome').focus();
            hideLoad();
            WarningBox('O Campo Data Inicio do Contrato é obrigatório');
        }


        var obj = {
            Id: cod,
            Nome: nome,
            Cpf: cpf,
            Rg: rg,
            DataInicioContrato: dataIniciocontrato,
            Endereco: endereco,
            Bairro: bairro,
            Municipio: cidade,
            Uf: uf,
            Cep: cep,
            Telefone: telefone
        };


        if (!cod) { //INSERT
            showLoad('Aguarde!<br>Inserindo Novo Registro.');

            console.log(obj);
            console.log(JSON.stringify(obj));
            $.ajax({
                url: "../../Api/Revenda/PostInsereRevendedor.php",
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: JSON.stringify(obj),
                success: function(data) {
                    debugger;
                    console.log(data);
                    switch (data.Transcod) {
                        case 0:
                            hideLoad();
                            ErrorBox(data.msg);
                            break;
                        case 1:
                            if (data.Acao == 1) {
                                $('#_edCod').val(data.Id);
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
                url: "../../Api/Revenda/PutAtualizaRevendedorPorCodigo.php",
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: JSON.stringify(obj),
                success: function(data) {
                    debugger;
                    console.log(data);
                    switch (data.Transcod) {
                        case 0:
                            hideLoad();
                            ErrorBox(data.msg);
                            break;
                        case 1:
                            if (data.Acao == 1) {
                                $('#_edCod').val(data.Id);
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
            url: "../../Api/Revenda/DeleteExcluirRevendedorPorCodigo.php",
            type: 'DELETE',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: JSON.stringify(obj),
            success: function(data) {
                debugger;
                console.log(data);
                if (data.Transcod == 1) {
                    hideLoad();
                    SuccessBox(data.msg);
                    atualizaGridPrincipal();
                } else {
                    hideLoad();
                    ErrorBox(data.msg);
                }
            }
        });
    }

    function BuscaDados(cod) {
        var obj = {
            Id: cod
        };
        $.ajax({
            url: "../../Api/Revenda/GetBuscaDadosRevendedorPorCodigo.php?Id=" + cod,
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                debugger;
                console.log(data);
                if (data.TransCod == 0) {
                    hideLoad();
                    ErrorBox(data.msg);
                } else {
                    dataCont = data.Revendedores[0].DataInicioContrato.split(" ", 1);
                    $('#_edNome').val(data.Revendedores[0].Nome);
                    $('#_edCpf').val(data.Revendedores[0].CpfCnpj);
                    $('#_edRg').val(data.Revendedores[0].RG);
                    $('#_edData').val(dataCont);
                    $('#_edEndereco').val(data.Revendedores[0].Endereco);
                    $('#_edBairro').val(data.Revendedores[0].Bairro);
                    $('#_edMunicipio').val(data.Revendedores[0].Cidade);
                    $('#_edUf').val(data.Revendedores[0].UF);
                    $('#_edCep').val(data.Revendedores[0].Cep);
                    $('#_edTelefone').val(data.Revendedores[0].Telefone);

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
            url: "../../Api/Revenda/GetBuscarAllRevendedores.php",
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {},
            success: function(data) {
                dados = data.Revendedores;
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
                        },
                        {
                            "data": "CpfCnpj",
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
                                    data =
                                        '<div style="cursor:pointer;" onClick="Atualiza(' +
                                        data +
                                        ')" class="btn btn-success"><i class="icone-pencil"></i></div>';
                                }

                                return data;
                            }
                        },
                        {
                            "data": "Id",
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

<?php include '../../footerContent.inc.php'; ?>