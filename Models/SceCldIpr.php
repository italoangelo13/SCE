<?php

class ItensPedidoRevenda
{
    public $Id;
    public $DataCadastro;
    public $UsuarioCadastro;
    public $PedidoRevenda;
    public $Produto;
    public $Quantidade;
    public $PrecoVenda;
    public $PrecoPromocional;
    public $Imagem;
    public $SubTotal;
    public $SKU;

    public function __construct()
    {
        $Id = null;
        $DataCadastro = null;
        $UsuarioCadastro = null;
        $PedidoRevenda = null;
        $Produto = null;
        $Quantidade = null;
        $PrecoVenda = null;
        $PrecoPromocional = null;
        $Imagem = null;
        $SubTotal = null;
        $SKU = null;
    }

    public function GeraNumeroPedidoRevenda()
    {
        $numPed = uniqid();
        $numPed = str_replace("-","",$numPed);
        $numPed = str_pad($numPed , 15 , '0' , STR_PAD_LEFT);
        return strtoupper($numPed);
    }

    public function selecionarTodosPedidosRevenda()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT
                PDRCOD,PDRNUMEROPEDIDO,PDR.REVCOD,REV.REVNOMECOMPLETO,PDRDATAPEDIDO,PDRUSER,PDRDATCADASTRO,PDRDATADEVOLUCAO,PDRDATAACERTO,PDRVALORTOTALPEDIDO,PDRQTDEITENSPEDIDO,PDRSTATUS
                FROM scetblpdr AS PDR
                INNER JOIN scetblrev AS REV
                ON PDR.REVCOD = REV.REVCOD
                ORDER BY PDRDATAPEDIDO DESC");
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
FROM scetblpdc as PDC
inner join scetbltpc as TPC
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

    public function selecionarValorVendidoPedido($cod)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT SUM(IFNULL(CASE
        WHEN PRO.PROPRECOPROMOCIONAL > 0
          THEN IPR.IPRQTDEVENDIDA * PRO.PROPRECOPROMOCIONAL
        ELSE
           IPR.IPRQTDEVENDIDA * PRO.PROPRECOVENDA
      END,0.00)) AS VLRVENDIDO
        FROM scetblipr as IPR
        inner join scetblpro as PRO
        on IPR.procod = PRO.procod
        WHERE PDRCOD = $cod
        and IPR.IPRITEMVENDIDO = 'S'");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            $result = $smtp->fetchAll(PDO::FETCH_CLASS);
            return $result[0]->VLRVENDIDO;
        }
    }


    public function selecionarQtdeVendidoPedido($cod)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT IFNULL(SUM(IPRQTDEVENDIDA),0) as IPRQTDEVENDIDA FROM scetblipr
        WHERE PDRCOD = $cod
        and IPRITEMVENDIDO = 'S'");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
             $result = $smtp->fetchAll(PDO::FETCH_CLASS);
             return $result[0]->IPRQTDEVENDIDA;
        }
        else{
            return null;
        }
    }

    public function selecionarItensVendidosPedidoRevendaParaFaturamentoPorCodigoPedido($cod)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT IPRCOD,
        IPR.PROCOD,
        PDRCOD,
        IPRQTDE,
        IPRUSER,
        IPRDATCADASTRO,
        IPRSUBTOTAL,
        PRO.PRONOME,
        PRO.PROPRECOVENDA,
        PRO.PROPRECOPROMOCIONAL,
        wpp.guid PROIMG,
        IPRQTDEVENDIDA,
        PRO.PROSKU FROM scetblipr as IPR
        inner join scetblpro as PRO
        on IPR.procod = PRO.procod
        left join wp_posts wpp
        on PRO.proimg = wpp.id
        WHERE PDRCOD = $cod
        and IPR.IPRITEMVENDIDO = 'S'");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }

    public function selecionarItensPedidoRevendaParaFaturamentoPorCodigoPedido($cod)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT IPRCOD,
        IPR.PROCOD,
        PDRCOD,
        IPRQTDE,
        IPRUSER,
        IPRDATCADASTRO,
        IPRSUBTOTAL,
        PRO.PRONOME,
        PRO.PROPRECOVENDA,
        PRO.PROPRECOPROMOCIONAL,
        wpp.guid PROIMG,
        PRO.PROSKU FROM scetblipr as IPR
        inner join scetblpro as PRO
        on IPR.procod = PRO.procod
        left join wp_posts wpp
        on PRO.proimg = wpp.id
        WHERE PDRCOD = $cod
        and IPR.IPRITEMVENDIDO = 'N'");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }


    public function selecionarItensPedidoRevendaPorCodigoPedido($cod)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT IPRCOD,
        IPR.PROCOD,
        PDRCOD,
        IPRQTDE,
        IPRUSER,
        IPRDATCADASTRO,
        IPRSUBTOTAL,
        PRO.PRONOME,
        PRO.PROPRECOVENDA,
        PRO.PROPRECOPROMOCIONAL,
        wpp.guid PROIMG,
        PRO.PROSKU FROM scetblipr as IPR
        inner join scetblpro as PRO
        on IPR.procod = PRO.procod
        left join wp_posts wpp
        on PRO.proimg = wpp.id
        WHERE PDRCOD = $cod");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }

    public function InsereItemPedidoRevenda()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("INSERT INTO scetblipr (
            PROCOD,
            PDRCOD,
            IPRQTDE,
            IPRUSER,
            IPRDATCADASTRO,
            IPRSUBTOTAL     )
            VALUES(
            $this->Produto,
            $this->PedidoRevenda,
            $this->Quantidade,
            '$this->UsuarioCadastro',
            CURRENT_TIMESTAMP,
            $this->SubTotal)");
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

    public function AtualizarItemPedidoRevenda()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("UPDATE scetblipr
        set IPRQTDE = $this->Quantidade,
            IPRSUBTOTAL = $this->SubTotal
        where PROCOD = $this->Produto
        and PDRCOD = $this->PedidoRevenda
        ");
        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function ExcluirItemPorCod($Id)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("DELETE from scetblipr WHERE IPRCOD = $Id");
        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function AtualizarTodosItensVendidosPorCodigoPedido($Status)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "UPDATE scetblipr ";

        if($Status == 'S'){
            $query = $query . " SET IPRQTDEVENDIDA = IPRQTDE
            ,IPRITEMVENDIDO = '$Status' ";
        }
        else{
            $query = $query . " SET IPRQTDEVENDIDA = 0
            ,IPRITEMVENDIDO = '$Status' ";
        }

        $query = $query . " WHERE PDRCOD = $this->PedidoRevenda";

        $smtp = $pdo->prepare($query);
        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function AtualizarItemVendidoPorCodigo($qtde,$Status)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("UPDATE scetblipr
        SET IPRQTDEVENDIDA = $qtde
        ,IPRITEMVENDIDO = '$Status'
        WHERE IPRCOD = $this->Id;");
        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ExcluirTodosItensPorCodigoPedido($cod)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("DELETE from scetblipr WHERE PDRCOD = $cod");
        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function VerificaItemNoPedido($codPro, $codPed)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT IPRCOD FROM scetblipr WHERE PROCOD =  $codPro AND PDRCOD = $codPed");
        $smtp->execute();
        return $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function BuscaQtdeItemPedido($codPro, $codPed)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT IPRQTDE FROM scetblipr WHERE PROCOD =  $codPro  AND PDRCOD = $codPed");
        $smtp->execute();
            $result = $smtp->fetchAll(PDO::FETCH_CLASS);
            return $result;
    }
}
