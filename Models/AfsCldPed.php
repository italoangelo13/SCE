<?php

class Pedidos
{
    public $Id;
    public $DtCadastro;
    public $User;
    public $Data;
    public $Cliente;

    public function __construct()
    {
        $Id = null;
        $DtCadastro= null;
        $User= null;
        $Descricao= null;
        $Tipo= null;
        
    }

    public function selecionarTodosPedidos(){
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT PED.PEDCOD,
        PED.PEDDAT,
        COL.COLNOMEABREVIADO,
        CLI.CLINOME,
        CNL.CNLDESCRICAO,
        PED.PEDSTATUS
        FROM afstblped AS PED
        LEFT JOIN AFSTBLITE AS ITE
        ON PED.PEDCOD = ITE.PEDCOD
        INNER JOIN AFSTBLCLI AS CLI
        ON PED.CLICOD = CLI.CLICOD
        INNER JOIN AFSTBLCNL AS CNL
        ON PED.CNLCOD = CNL.CNLCOD
        INNER JOIN AFSTBLCOL AS COL
        ON PED.COLCOD = COL.COLCOD
        ORDER BY PEDDAT DESC");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }


    public function selecionarPlanosDeContasPorCod($cod){
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT PDCCOD,
        PDCDESCRICAO,
        PDC.TPCCOD,
        TPC.TPCDESCRICAO,
        PDCUSER,
        PDCDATCADASTRO
        FROM afstblpdc as pdc
        inner join afstbltpc as tpc
        on pdc.tpccod = tpc.tpccod
        where PDCCOD = $cod");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }

    public function InserePlanoDeContas()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("INSERT INTO afstblpdc(
            PDCDESCRICAO,
            TPCCOD,
            PDCUSER,
            PDCDATCADASTRO)
            VALUES(
            '$this->Descricao',
            $this->Tipo,
            '$this->User',
            CURRENT_TIMESTAMP)");
        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        }
        else{
            return false;
        }
    }



    public function BuscaUltimoCodPorUser(){
        try{
            $pdo = new PDO(server, user, senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $smtp = $pdo->prepare("SELECT MAX(PDCCOD) AS ULTIMO FROM afstblpdc WHERE PDCUSER = '$this->User'");
            $smtp->execute();
            $result = $smtp->fetchAll(PDO::FETCH_CLASS);
            return $result[0]->ULTIMO;
        }
        catch(Exception $e){
            throw $e;
        }
    }

    public function AtualzaPlanoDeContasPorCod()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("UPDATE afstblpdc
            SET PDCDESCRICAO = '$this->Descricao',
            TPCCOD = $this->Tipo
            WHERE PDCCOD = $this->Id");
        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        }
        else{
            return false;
        }
    }
    

    public function ExcluirPlanoDeContasPorCod($Id)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("DELETE from afstblpdc WHERE PDCCOD = $Id");
        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        }
        else{
            return false;
        }
    }

}