<?php

class Revendedores
{
    public $Id;
    public $DataCadastro;
    public $UsuarioCadastro;
    public $Nome;
    public $CpfCnpj;
    public $Endereco;
    public $Bairro;
    public $Cidade;
    public $UF;
    public $Cep;
    public $Telefone;
    public $RG;
    public $DataInicioContrato;

    public function __construct()
    {
        $Id = null;
        $DataCadastro= null;
        $UsuarioCadastro= null;
        $Nome= null;
        $CpfCnpj= null;
        $Endereco= null;
        $Bairro= null;
        $Cidade= null;
        $UF= null;
        $Cep= null;
        $Telefone= null;
        $RG= null;
        $DataInicioContrato= null;
    }

    public function selecionarTodosRevendedores(){
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
        FROM scetblrev");
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



    public function selecionarRevendedorPorCod($cod){
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
        where REVCOD = $cod");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }

    public function InsereRevendedor()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("INSERT INTO scetblrev(
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
            REVDATAINICIOCONTRATO)
            VALUES(
            '$this->Nome',
            '$this->Endereco',
            '$this->Bairro',
            '$this->Cidade',
            '$this->UF',
            '$this->Cep',
            '$this->Telefone',
            '$this->CpfCnpj',
            '$this->RG',
            CURRENT_TIMESTAMP,
            '$this->UsuarioCadastro',
            '$this->DataInicioContrato')");
        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        }
        else{
            return false;
        }
    }

    public function BuscaRevendedorPorCpfCnpj($Cpf)
    {
        try{
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
        }
        catch(Exception $e){
            throw $e;
        }
    }

    public function BuscaUltimoCodPorUser(){
        try{
            $pdo = new PDO(server, user, senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $smtp = $pdo->prepare("SELECT MAX(REVCOD) AS ULTIMO FROM scetblrev WHERE REVUSER = '$this->UsuarioCadastro'");
            $smtp->execute();
            $result = $smtp->fetchAll(PDO::FETCH_CLASS);
            return $result[0]->ULTIMO;
        }
        catch(Exception $e){
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
        }
        else{
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
        }
        else{
            return false;
        }
    }

}