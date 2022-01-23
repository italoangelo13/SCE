<?php

class Util{

    function gravar($texto){
        //Variável arquivo armazena o nome e extensão do arquivo.
        $arquivo = "log_sce.txt";
        
        //Variável $fp armazena a conexão com o arquivo e o tipo de ação.
        $fp = fopen($arquivo, "a+");
    
        //Colocando Data e Hora no log
        $texto .= date('d-m-Y h:i:s') . ' :: ' . $texto . "\n";
        //Escreve no arquivo aberto.
        fwrite($fp, $texto);
        
        //Fecha o arquivo.
        fclose($fp);
    }

    public static function convert_from_latin1_to_utf8_recursively($dat)
    {
        if (is_string($dat)) {
            return utf8_encode($dat);
        } elseif (is_array($dat)) {
            $ret = [];
            foreach ($dat as $i => $d) $ret[ $i ] = self::convert_from_latin1_to_utf8_recursively($d);

            return $ret;
        } elseif (is_object($dat)) {
            foreach ($dat as $i => $d) $dat->$i = self::convert_from_latin1_to_utf8_recursively($d);

            return $dat;
        } else {
            return $dat;
        }
    }

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

    public function SelecionarParametros()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT
        PRMCOD, PRMNOMECAMPO, PRMCAMPO, PRMVAL, PRMDESCRICAO
        FROM KGCTBLPRM");
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



    public function SelecionarInformaçõesComplementares()
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
        $com_acento = array('à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í'
        ,'î','ï','ñ','ò','ó','ô','õ','ö','ù','ü','ú','ÿ','À','Á','Â','Ã','Ä','Å'
        ,'Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','O','Ù','Ü'
        ,'Ú','Ÿ',);
        // array com letras correspondentes ao array anterior, porém sem acento
        $sem_acento = array('a','a','a','a','a','a','c','e','e','e','e','i','i',
        'i','i','n','o','o','o','o','o','u','u','u','y','A','A','A','A','A','A',
        'C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','O','U','U',
        'U','Y',);
        // procuramos no nosso texto qualquer caractere do primeiro array e 
        #substituímos pelo seu correspondente presente no 2º array
        $final = str_replace($com_acento, $sem_acento, $texto);
        // array com pontuação e acentos
        $com_pontuacao = array('´','`','¨','^','~','-');
        // array com substitutos para o array anterior
        $sem_pontuacao = array('','','','','','_');
        // procuramos no nosso texto qualquer caractere do primeiro array e 
        #substituímos pelo seu correspondente presente no 2º array
        $final = str_replace($com_pontuacao, $sem_pontuacao, $final);
        // retornamos a variável com nosso texto sem pontuações, acentos e 
        #letras acentuadas
        return $final;
    } // -> fim function tirarAcento()


    
}

?>