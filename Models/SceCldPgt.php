<?php

class SceCldPgt
{
    public $Id;
    public $FormaPagamento;
    public $PermiteParcelamento;
    public $QuantidadeParecelas;
    public $DataCadastro;
    public $UsuarioCadastro;
    

    public function __construct()
    {
        $Id = null;
        $FormaPagamento = null;
        $PermiteParcelamento = null;
        $QuantidadeParecelas = null;
        $DataCadastro = null;
        $UsuarioCadastro = null;
        
    }


    public function SelecionaTodasFormasPagamento()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT PGTCOD, 
        PGTDESCRICAO, 
        PGTPERMITEPARCELAMENTO, 
        PGTQTDEPARCELAS, 
        PGTDATACADASTRO, 
        PGTUSER
        FROM scetblpgt order by PGTDESCRICAO asc");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }
}