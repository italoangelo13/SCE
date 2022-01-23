<?php

class TipoPlanoDeContas
{
    public $Id;
    public $DtCadastro;
    public $User;
    public $Descricao;

    public function __construct()
    {
        $Id = null;
        $DtCadastro= null;
        $User= null;
        $Descricao= null;
        
    }

    public function selecionarTodosTiposPlanoDeContas(){
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT TPCCOD,
        TPCDESCRICAO,
        TPCUSER,
        TPCDATCADASTRO
        FROM afstbltpc");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }


    


}