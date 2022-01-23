<?php

class SceCldPdc
{
    public $Id;
    public $DtCadastro;
    public $User;
    public $Descricao;
    public $Tipo;

    public function __construct()
    {
        $Id = null;
        $DtCadastro= null;
        $User= null;
        $Descricao= null;
        $Tipo= null;
        
    }

    public function selecionarTodosPlanosDeContas(){
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT PDCCOD,
        PDCDESCRICAO,
        PDC.TPCCOD,
        TPC.TPCDESCRICAO,
        PDCUSER,
        PDCDATCADASTRO
        FROM scetblpdc as pdc
        inner join scetbltpc as tpc
        on pdc.tpccod = tpc.tpccod");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }

    public function selecionarTodosPlanosDeContasAutoComplete($filter){
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT PDCCOD,
        PDCDESCRICAO,
        PDC.TPCCOD,
        TPC.TPCDESCRICAO,
        PDCUSER,
        PDCDATCADASTRO
        FROM scetblpdc as pdc
        inner join scetbltpc as tpc
        on pdc.tpccod = tpc.tpccod
        where PDCDESCRICAO like '%$filter%'
        or PDCCOD like '%$filter%'");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }

    public function selecionarPlanosDeContasRelatorio($dataini,$dataFim,$tipos)
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

        if($dataini){
            $sql = $sql . " and PDCDATCADASTRO >= '$dataini' ";
        }

        if($dataFim){
            $sql = $sql . " and PDCDATCADASTRO <= '$dataFim' ";
        }

        if($tipos){
            $sql = $sql . " and PDC.TPCCOD in($tipos) ";
        }
        $smtp = $pdo->prepare($sql);
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
        FROM scetblpdc as pdc
        inner join scetbltpc as tpc
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

        $smtp = $pdo->prepare("INSERT INTO scetblpdc(
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

            $smtp = $pdo->prepare("SELECT MAX(PDCCOD) AS ULTIMO FROM scetblpdc WHERE PDCUSER = '$this->User'");
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

        $smtp = $pdo->prepare("UPDATE scetblpdc
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

        $smtp = $pdo->prepare("DELETE from scetblpdc WHERE PDCCOD = $Id");
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