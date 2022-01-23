$(document).ready(function () {

});


function validaCpfCnpj(val) {
    if (val.length == 14) {
        var cpf = val.trim();

        cpf = cpf.replace(/\./g, '');
        cpf = cpf.replace('-', '');
        cpf = cpf.split('');

        var v1 = 0;
        var v2 = 0;
        var aux = false;

        for (var i = 1; cpf.length > i; i++) {
            if (cpf[i - 1] != cpf[i]) {
                aux = true;
            }
        }

        if (aux == false) {
            return false;
        }

        for (var i = 0, p = 10; (cpf.length - 2) > i; i++, p--) {
            v1 += cpf[i] * p;
        }

        v1 = ((v1 * 10) % 11);

        if (v1 == 10) {
            v1 = 0;
        }

        if (v1 != cpf[9]) {
            return false;
        }

        for (var i = 0, p = 11; (cpf.length - 1) > i; i++, p--) {
            v2 += cpf[i] * p;
        }

        v2 = ((v2 * 10) % 11);

        if (v2 == 10) {
            v2 = 0;
        }

        if (v2 != cpf[10]) {
            return false;
        } else {
            return true;
        }
    } else if (val.length == 18) {
        var cnpj = val.trim();

        cnpj = cnpj.replace(/\./g, '');
        cnpj = cnpj.replace('-', '');
        cnpj = cnpj.replace('/', '');
        cnpj = cnpj.split('');

        var v1 = 0;
        var v2 = 0;
        var aux = false;

        for (var i = 1; cnpj.length > i; i++) {
            if (cnpj[i - 1] != cnpj[i]) {
                aux = true;
            }
        }

        if (aux == false) {
            return false;
        }

        for (var i = 0, p1 = 5, p2 = 13; (cnpj.length - 2) > i; i++, p1--, p2--) {
            if (p1 >= 2) {
                v1 += cnpj[i] * p1;
            } else {
                v1 += cnpj[i] * p2;
            }
        }

        v1 = (v1 % 11);

        if (v1 < 2) {
            v1 = 0;
        } else {
            v1 = (11 - v1);
        }

        if (v1 != cnpj[12]) {
            return false;
        }

        for (var i = 0, p1 = 6, p2 = 14; (cnpj.length - 1) > i; i++, p1--, p2--) {
            if (p1 >= 2) {
                v2 += cnpj[i] * p1;
            } else {
                v2 += cnpj[i] * p2;
            }
        }

        v2 = (v2 % 11);

        if (v2 < 2) {
            v2 = 0;
        } else {
            v2 = (11 - v2);
        }

        if (v2 != cnpj[13]) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}


function CarregaDdlModelo() {
    let CodMarca = $("#_ddlMarca option:selected").val();//$("#_ddlMarca").val();  
    var obj = {
        CODMARCA: CodMarca,
    };

    //var param = JSON.stringify(obj);

    $.ajax({
        url: "service/BuscaModelos.php?codMarca=" + CodMarca,
        type: 'GET',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
            debugger;
            console.log(data);
            var selectbox = $('#_ddlModelo');
            selectbox.find('option').remove();
            data.forEach(function (o, index) {
                $('<option>').val(o.MODCOD).text(o.MODDESCRICAO).appendTo(selectbox);
            });
            $('<option>').val('0').text('Selecionar').appendTo(selectbox);
            $('#_ddlModelo option[value=0]').attr('selected', 'selected');

        }
    });
}



//Altera Painel
function AlternaPainel(s, h) {
    //s -> Tela a ser mostrada
    //h -> Tela a ser ocultada
    $("#" + h).removeClass("display-show");
    $("#" + h).addClass("display-hide");
    $("#" + s).removeClass("display-hide");
    $("#" + s).addClass("display-show");
}


function confirmBox(msg) {
  return  $.confirm({
        title: 'SCE',
        content: msg,
        buttons: {
            Sim: {
                btnClass: 'btn-success',
                text: "Sim",
                action: function () {
                    return 1;
                }
            },
            Nao: {
                btnClass: 'btn-red', // multiple classes.
                text: "Não",
                action: function () {
                    return 0;
                }
            },
        }
    });
    
}

function SuccessBox(msg) {
    $.alert({
        title: 'Aninha Faria Semijoias',
        content: msg,
        type: 'green',
        typeAnimated: true,
    });
}

function WarningBox(msg) {
    $.alert({
        title: 'Aninha Faria Semijoias',
        content: msg,
        type: 'orange',
        typeAnimated: true,
    });
}

function ErrorBox(msg) {
    $.alert({
        title: 'Aninha Faria Semijoias',
        content: msg,
        type: 'red',
        typeAnimated: true,
    });
}


function DefaultBox(msg) {
    $.alert({
        title: 'Aninha Faria Semijoias',
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


function showLoadModal(msg, e) {
    if (msg == null || msg == '') {
        msg = 'Carregando...'
    }

    $(e).loading({
        theme: 'dark',
        message: msg
    });
}


function hideLoadModal(e) {
    $(e).loading('stop');
}


function formatReal(int) {
    var tmp = int + '';
    tmp = tmp.replace(/([0-9]{2})$/g, "0,$1");
    if (tmp.length > 6)
        tmp = tmp.replace(/([0-9]{10}).([0-9]{2}$)/g, ".$1,$2");
    return tmp;
}