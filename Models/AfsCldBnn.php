<?php

class Banners
{
    public $Id;
    public $DtCadastro;
    public $User;
    public $Titulo;
    public $Status;
    public $ImgCapa;

    public function __construct()
    {
        $Id = null;
        $DtCadastro= null;
        $User= null;
        $Titulo= null;
        $ImgCapa= null;
        $Status= null;
        
    }

    public function selecionarBannersAtivos(){
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT BNNCOD,
        BNNTITULO,
        BNNIMG,
        BNNLINK
        FROM afstblbnn
        WHERE BNNSTATUS = 'S'");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }


    


}