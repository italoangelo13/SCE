<?php
require 'SceCldRev.php';
class PedidoRevenda
{
    public $Id;
    public $DataCadastro;
    public $UsuarioCadastro;
    public $NumeroPedido;
    public $CodigoRevendedor;
    public $Revendedor;
    public $DataPedido;
    public $CodigoStatus;
    public $Status;
    public $DataDevolucao;
    public $DataAcerto;
    public $ValorTotalPedido;
    public $QtdeItensPedido;
    public $TaxaComissao;
    public $ValorComissao;

    public function __construct()
    {
        $Id = null;
        $DataCadastro = null;
        $UsuarioCadastro = null;
        $CodigoRevendedor = null;
        $Revendedor = null;
        $NumeroPedido = null;
        $DataPedido = null;
        $DataDevolucao = null;
        $DataAcerto = null;
        $ValorTotalPedido = null;
        $QtdeItensPedido = null;
        $Status = null;
        $TaxaComissao = null;
        $ValorComissao = null;
    }

    public function GeraNumeroPedidoRevenda()
    {
        $numPed = uniqid();
        $numPed = str_replace("-","",$numPed);
        $numPed = str_pad($numPed , 15 , '0' , STR_PAD_LEFT);
        return strtoupper($numPed);
    }

    public function SelecionarPedidosEmRevenda()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT
                PDRCOD
                FROM scetblpdr
                where PDRSTATUS = 'R' ");
        $smtp->execute();

            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
    }

    public function AtualizarStatusPedidoRevendaPorCod()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("UPDATE scetblpdr
        set PDRSTATUS = '$this->Status'
        where PDRCOD = $this->Id");
        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function AtualizarTaxaValorComissao()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("UPDATE scetblpdr
        set PDRTAXACOMISSAO = $this->TaxaComissao
        ,PDRVLRCOMISSAO = $this->ValorComissao
        where PDRCOD = $this->Id");
        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function selecionarSituacaoPedidoRevendaPorCod($cod)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT
                PDRSTATUS
                FROM scetblpdr
                where PDRCOD = $cod");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }

    public function selecionarTodosPedidosRevenda($order)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT
                PDRCOD,PDRNUMEROPEDIDO,PDR.REVCOD,REV.REVNOMECOMPLETO,PDRDATAPEDIDO,PDRUSER,PDRDATCADASTRO,PDRDATADEVOLUCAO,PDRDATAACERTO,PDRVALORTOTALPEDIDO,PDRQTDEITENSPEDIDO,PDRSTATUS, PDRTAXACOMISSAO, PDRVLRCOMISSAO
                FROM scetblpdr AS PDR
                INNER JOIN scetblrev AS REV
                ON PDR.REVCOD = REV.REVCOD
                ORDER BY  $order ");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }


    public function selecionarPedidosRevendaPorNumPedido($numPedido, $order)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT
                PDRCOD,PDRNUMEROPEDIDO,PDR.REVCOD,REV.REVNOMECOMPLETO,PDRDATAPEDIDO,PDRUSER,PDRDATCADASTRO,PDRDATADEVOLUCAO,PDRDATAACERTO,PDRVALORTOTALPEDIDO,PDRQTDEITENSPEDIDO,PDRSTATUS, PDRTAXACOMISSAO, PDRVLRCOMISSAO
                FROM scetblpdr AS PDR
                INNER JOIN scetblrev AS REV
                ON PDR.REVCOD = REV.REVCOD
                where PDRNUMEROPEDIDO like '%$numPedido%'
                ORDER BY $order ");
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

    public function AtualizarValorEQuantidadePedidoPorCodigo($cod, $TotalPedido, $QtdePedido)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("UPDATE scetblpdr
        SET PDRVALORTOTALPEDIDO = $TotalPedido,
        PDRQTDEITENSPEDIDO = $QtdePedido
        WHERE PDRCOD = $cod");
        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function SelecionarVlrTotalEQtdePedido($cod)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT sum(IPRQTDE) as QTDE, SUM(IPRSUBTOTAL) AS VLRTOTAL
        FROM scetblipr
        where PDRCOD  = $cod");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }

    public function selecionarPedidoRevendaPorCod($cod)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT PDRCOD,
        PDRNUMEROPEDIDO,
        rev.REVCOD,
        rev.REVNOMECOMPLETO,
        PDRDATAPEDIDO,
        PDRUSER,
        PDRDATCADASTRO,
        PDRDATADEVOLUCAO,
        PDRDATAACERTO,
        PDRVALORTOTALPEDIDO,
        PDRQTDEITENSPEDIDO,
        PDRSTATUS, PDRTAXACOMISSAO, PDRVLRCOMISSAO
        FROM scetblpdr as pdr
        inner join scetblrev as rev
        on pdr.revcod = rev.revcod
        where PDRCOD  = $cod");
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

    public function AtualizaRevendedorPorCod()
    {
            $pdo = new PDO(server, user, senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $smtp = $pdo->prepare("UPDATE scetblrev
    set REVNOMECOMPLETO = '$this->Nome',
        REVENDERECO = '$this->Endereco',
        REVBAIRRO = '$this->Bairro',
        REVMUNICIPIO = '$this->Cidade',
        REVUF = '$this->UF',
        REVCEP = '$this->Cep',
        REVTELEFONE = '$this->Telefone',
        REVCPFCNPJ = '$this->CpfCnpj',
        REVRG = '$this->RG',
        REVDATAINICIOCONTRATO = '$this->DataInicioContrato'
    where REVCOD = $this->Id
    ");
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
