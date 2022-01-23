<?php
class Produto
{
    public $Id;
    public $DataCadastro;
    public $UsuarioCadastro;
    public $SKU;
    public $Produto;
    public $PrecoVenda;
    public $PrecoPromocional;
    public $Imagem;
    public $StatusEstoque;
    public $QuatidadeEstoque;
    public $StatusSite;
    public $Categoria;

    public function __construct()
    {
        $Id = null;
        $DataCadastro = null;
        $UsuarioCadastro = null;
        $SKU = null;
        $Produto = null;
        $PrecoVenda = null;
        $PrecoPromocional = null;
        $Imagem = null;
        $StatusEstoque = null;
        $QuatidadeEstoque = null;
        $QtdeItensPedido = null;
        $StatusSite = null;
        $Categoria = null;
    }

    public function GeraNumeroSkuProduto()
    {
        $numPed = uniqid();
        $numPed = str_replace("-","",$numPed);
        $numPed = str_pad($numPed , 15 , '0' , STR_PAD_LEFT);
        return strtoupper($numPed);
    }

    public function selecionarTodosProdutosEmEstoque()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT
        PROCOD,
        PRONOME,
        PROSKU,
        PROPRECOVENDA,
        PROPRECOPROMOCIONAL,
        wpp.guid as PROIMG,
        STATUSESTOQUE,
        PROQTDESTOQUE,
        PROSTATUSSITE,
        PROCATEGORIA
        FROM scetblpro as pro
        left join wp_posts wpp
                on pro.proimg = wpp.id
                where PROQTDESTOQUE > 0");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }
    public function selecionarTodosProdutos()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT
        PROCOD,
        PRONOME,
        PROSKU,
        PROPRECOVENDA,
        PROPRECOPROMOCIONAL,
        wpp.guid as PROIMG,
        STATUSESTOQUE,
        PROQTDESTOQUE,
        PROSTATUSSITE,
        PROCATEGORIA
        FROM scetblpro as pro
        left join wp_posts wpp
                on pro.proimg = wpp.id");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }

    public function selecionarPlanosDeContasRelatorio($dataini, $dataFim, $tipos)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT PDCCOD,
PDCDESCRICAO,
PDC.TPCCOD,
TPC.TPCDESCRICAO,
PDCUSER,
PDCDATCADASTRO
FROM scetblpdc as pdc
inner join scetbltpc as tpc
on pdc.tpccod = tpc.tpccod
where 1 = 1";

        if ($dataini) {
            $sql = $sql . " and PDCDATCADASTRO >= '$dataini' ";
        }

        if ($dataFim) {
            $sql = $sql . " and PDCDATCADASTRO <= '$dataFim' ";
        }

        if ($tipos) {
            $sql = $sql . " and PDC.TPCCOD in($tipos) ";
        }
        $smtp = $pdo->prepare($sql);
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }



    public function selecionarProdutoPorCod($cod)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT
        PROCOD,
        PRONOME,
        PROSKU,
        PROPRECOVENDA,
        PROPRECOPROMOCIONAL,
        wpp.guid as PROIMG,
        STATUSESTOQUE,
        PROQTDESTOQUE,
        PROSTATUSSITE,
        PROCATEGORIA
        FROM scetblpro as pro
        left join wp_posts wpp
                on pro.proimg = wpp.id
                where PROCOD  = $cod");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }

    public function InserePedidoRevenda()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("INSERT INTO scetblpdr(
            PDRNUMEROPEDIDO,
            REVCOD,
            PDRDATAPEDIDO,
            PDRUSER,
            PDRDATCADASTRO,
            PDRDATADEVOLUCAO,
            PDRDATAACERTO,
            PDRVALORTOTALPEDIDO,
            PDRQTDEITENSPEDIDO,
            PDRSTATUS)
            VALUES(
            '$this->NumeroPedido',
            $this->Revendedor,
            '$this->DataPedido',
            '$this->UsuarioCadastro',
            CURRENT_TIMESTAMP,
            '$this->DataDevolucao',
            '$this->DataAcerto',
            0,
            0,
            'N'
            )");
        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function BuscaRevendedorPorCpfCnpj($Cpf)
    {
        try {
            $pdo = new PDO(server, user, senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $smtp = $pdo->prepare("SELECT REVCOD,
    REVNOMECOMPLETO,
    REVENDERECO,
    REVBAIRRO,
    REVMUNICIPIO,
    REVUF,
    REVCEP,
    REVTELEFONE,
    REVCPFCNPJ,
    REVRG,
    REVDATCADASTRO,
    REVUSER,
    REVDATAINICIOCONTRATO
    FROM scetblrev
    where REVCPFCNPJ = '$Cpf'");
            $smtp->execute();
            $result = $smtp->fetchAll(PDO::FETCH_CLASS);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function BuscaUltimoCodPorUser()
    {
        try {
            $pdo = new PDO(server, user, senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $smtp = $pdo->prepare("SELECT MAX(PDRCOD) AS ULTIMO FROM scetblpdr WHERE PDRUSER = '$this->UsuarioCadastro'");
            $smtp->execute();
            $result = $smtp->fetchAll(PDO::FETCH_CLASS);
            return $result[0]->ULTIMO;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function AtualizaQtdeSaidaEstoquePorCod($cod, $qtde)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("UPDATE wp_postmeta
        set meta_value = meta_value - $qtde
        where post_id = $cod
        and meta_key = '_stock'");
        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            
            return true;
        } else {
            return false;
        }
    }

    public function AtualizaStatusSaidaEstoquePorCod($cod)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("UPDATE wp_postmeta as wpp
        inner join (select post_id, meta_key,meta_value from wp_postmeta where post_id = $cod and meta_key = '_stock') wppStock
        on wpp.post_id = wppStock.post_id
                set wpp.meta_value =  Case
                                            when wppStock.meta_value <= 0
                                              then 'outofstock'
                                            when wppStock.meta_value > 0
                                              then 'instock'
                                          end
                    where wpp.post_id = $cod
                and wpp.meta_key = '_stock_status'");
        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function ExcluirRevendedorPorCod($Id)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("DELETE from scetblrev WHERE REVCOD = $Id");
        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }
}
