<?php

class Colaborador
{
    public $Id;
    public $DtCadastro;
    public $User;
    public $Titulo;
    public $Status;
    public $Url;

    public function __construct()
    {
        $Id = null;
        $DtCadastro= null;
        $User= null;
        $Titulo= null;
        $Status= null;
        $Url= null;
        
    }

    public function selecionarColaboradoresAtivos(){
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT COLCOD,
        COLNOMECOMPLETO,
        COLNOMEABREVIADO,
        COLCPF,
        COLEMAIL,
        COLTEL,
        COLENDERECO,
        COLSTATUS,
        COLDATACADASTRO,
        COLUSER FROM afstblcol");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }


    public function selecionarColaboradoresPorCod($cod){
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT COLCOD,
        COLNOMECOMPLETO,
        COLNOMEABREVIADO,
        COLCPF,
        COLEMAIL,
        COLTEL,
        COLENDERECO,
        COLSTATUS,
        COLDATACADASTRO,
        COLUSER FROM afstblcol
        where COLCOD = $cod");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }


    


}