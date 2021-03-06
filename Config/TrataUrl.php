<?php

class Url{

    public function AtualizaParametroPorCod($val,$codParam)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("UPDATE KGCTBLPRM SET PRMVAL = '$val' WHERE PRMCOD = $codParam");
        $smtp->execute();

        $r = $smtp->rowCount();

        if($r){
            return true;
        }
        else{
            return false;
        }
    }

    public function VerificaUrl($url)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT URLCOD,
        TURCOD,
        URLCODTABELA,
        URLDTCADASTRO,
        URLUSER
        FROM afstblurl
        WHERE URLLINK = '$url'");
        $smtp->execute();


        return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
    }

    public function VerificaUrlColecao($url)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT COLCOD FROM afstblcol WHERE COLURL = '$url'");
        $smtp->execute();


        return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
    }

    public function SelecionarItensVeiculo()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT COMPCOD, COMPDESC, COMPNOMCAMPO FROM KGCTBLINFOCOMP");
        $smtp->execute();


        return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
    }



    public function SelecionarInformaĆ§ĆµesComplementares()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT COMPDESC, COMPNOMCAMPO FROM KGCTBLINFOCOMP");
        $smtp->execute();


        return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
    }

    public function SelecionarParametroPorCod($codParametro)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT
        PRMNOMECAMPO, PRMCAMPO, PRMVAL, PRMDESCRICAO
        FROM KGCTBLPRM where PRMCOD = $codParametro");
        $smtp->execute();


        return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
    }

    public function InserirEmailNewsletter($email)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("INSERT INTO KGCTBLRECANU(RECEMAIL) VALUES ('$email')");
        $smtp->execute();


        return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        
    }


    public function FormatarTelefone($var)
    {
        $var = str_replace('(','',$var);
        $var = str_replace(')','',$var);
        $var = str_replace('-','',$var);
        $var = str_replace(' ','',$var);
        return $var;
    }



     function tirarAcento($texto){
        // array com letras acentuadas
        $com_acento = array('Ć ','Ć”','Ć¢','Ć£','Ć¤','Ć„','Ć§','ĆØ','Ć©','ĆŖ','Ć«','Ć¬','Ć­'
        ,'Ć®','ĆÆ','Ć±','Ć²','Ć³','Ć“','Ćµ','Ć¶','Ć¹','Ć¼','Ćŗ','Ćæ','Ć','Ć','Ć','Ć','Ć','Ć'
        ,'Ć','Ć','Ć','Ć','Ć','Ć','Ć','Ć','Ć','Ć','Ć','Ć','Ć','Ć','Ć','O','Ć','Ć'
        ,'Ć','Åø',);
        // array com letras correspondentes ao array anterior, porĆ©m sem acento
        $sem_acento = array('a','a','a','a','a','a','c','e','e','e','e','i','i',
        'i','i','n','o','o','o','o','o','u','u','u','y','A','A','A','A','A','A',
        'C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','O','U','U',
        'U','Y',);
        // procuramos no nosso texto qualquer caractere do primeiro array e 
        #substituĆ­mos pelo seu correspondente presente no 2Āŗ array
        $final = str_replace($com_acento, $sem_acento, $texto);
        // array com pontuaĆ§Ć£o e acentos
        $com_pontuacao = array('Ā“','`','ĀØ','^','~','-');
        // array com substitutos para o array anterior
        $sem_pontuacao = array('','','','','','_');
        // procuramos no nosso texto qualquer caractere do primeiro array e 
        #substituĆ­mos pelo seu correspondente presente no 2Āŗ array
        $final = str_replace($com_pontuacao, $sem_pontuacao, $final);
        // retornamos a variĆ”vel com nosso texto sem pontuaĆ§Ćµes, acentos e 
        #letras acentuadas
        return $final;
    } // -> fim function tirarAcento()


    
}

?>