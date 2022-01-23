<?php

class SceCldCli
{
    public $Id;
    public $DtCadastro;
    public $User;
    public $Nome;
    public $Cpf;
    public $Cnpj;
    public $Email;
    public $Senha;
    public $TipoPessoa;

    public function __construct()
    {
        $Id = null;
        $DtCadastro= null;
        $User= null;
        $Nome= null;
        $Cpf= null;
        $Cnpj= null;
        $Email= null;
        $Senha= null;
        $TipoPessoa= null;
        
    }

    public function InsereCliente(){
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("INSERT into scetblcli
        (CLINOME,
        CLICPF,
        CLICNPJ,
        CLITIP,
        CLIEMAIL,
        CLISENHA,
        CLIDATCADASTRO)
        VALUES(
        '$this->Nome',
        '$this->Cpf',
        '$this->Cnpj',
        '$this->TipoPessoa',
        '$this->Email',
        '$this->Senha',
        CURRENT_TIMESTAMP
        )");

        $smtp->execute();
        $res = $smtp->rowCount();
        if ($res > 0) {
            return true;
        }
        else{
            return false;
        }
    } 

    public function SelecionarCodClientePorCpfCnpj($doc){
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT CLICOD
        FROM scetblcli
        WHERE CLICPF  = '$doc' OR CLICNPJ = '$doc'");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }


    public function SelecionarDadosClientePorCod($cod){
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT CLICOD, CLINOME, CLIDATACADASTRO,
        CLICPF FROM scetblcli
        where CLICOD = $cod");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }

    public function SelecionarDadosClientePorEmail($email)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT CLISENHA,CLICOD,CLINOME,CLIEMAIL,CLICNPJ,CLICPF
        FROM scetblcli
        where CLIEMAIL = '$email'");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }


    public function SelecionarClientes()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT CLICOD,
        CLINOME,
        CLICPF
        FROM scetblcli");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }

    


}