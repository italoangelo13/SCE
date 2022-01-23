<?php

class Produtos
{
    public $Id;
    public $DtCadastro;
    public $User;
    public $Nome;
    public $Fornecedor;
    public $Categoria;
    public $Destaque;
    public $Status;
    public $Perecivel;
    public $PesoBruto;
    public $PesoLiquido;
    public $Gramatura;
    public $PrecoCusto;
    public $PrecoVenda;
    public $QtdeVisitas;
    public $Tipo;
    public $EstoqueMinimo;
    public $ImgCapa;

    public function __construct()
    {
        $Id = null;
        $DtCadastro = null;
        $User = null;
        $Nome = null;
        $Fornecedor = null;
        $Categoria = null;
        $Destaque = null;
        $Status = null;
        $Perecivel = null;
        $PesoBruto = null;
        $PesoLiquido = null;
        $Gramatura = null;
        $PrecoCusto = null;
        $PrecoVenda = null;
        $QtdeVisitas = null;
        $Tipo = null;
        $EstoqueMinimo = null;
    }

    public function selecionarProdutosEmDestaque()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT
        P.PROCOD,
        P.PRONOME,
        P.PROSKU,
        C.CATDESCRICAO,
        P.PROIMG,
        P.PROPRECOVENDA
        FROM AFSTBLPRO AS P
        INNER JOIN AFSTBLCAT AS C
        ON P.CATCOD = C.CATCOD
        where P.PRODESTAQUE = 'S'
        AND P.PROATIVO = 'S'
        order by P.PROQTDEVISITAS desc");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }


    public function selecionarProdutosVitrine()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT
        P.PROCOD,
        P.PRONOME,
        P.PROSKU,
        C.CATDESCRICAO,
        P.PROIMG,
        P.PROPRECOVENDA,
        U.URLLINK
        FROM AFSTBLPRO AS P
        INNER JOIN AFSTBLCAT AS C
        ON P.CATCOD = C.CATCOD
        left join afstblurl U
        on P.procod = U.urlcodtabela
        WHERE P.PROATIVO = 'S'
        order by P.PROQTDEVISITAS desc");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }

    public function AtualizaNumVisitas($codproduto)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $smtp = $pdo->prepare("SELECT (PROQTDEVISITAS + 1) AS QTDE FROM AFSTBLPRO WHERE PROCOD = $codproduto");
        $smtp->execute();
        $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        $qtdeAtu = $result[0]->QTDE;
        $smtp = $pdo->prepare("UPDATE AFSTBLPRO SET PROQTDEVISITAS = $qtdeAtu WHERE PROCOD = $codproduto");
        $smtp->execute();
        $result = $smtp->rowCount();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function SelecionarTodosProdutos()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT PROCOD,
        PRONOME,
        PROSKU,
        PROPRECOVENDA,
        PROPRECOPROMOCIONAL,
        WPP.GUID AS PROIMG,
        CASE
          WHEN STATUSESTOQUE = 'INSTOCK'
           THEN 'EM ESTOQUE'
          ELSE  'FORA DE ESTOQUE'
         END AS STATUSESTOQUE,
        PROQTDESTOQUE,
        PROSTATUSSITE
        FROM scetblpro PRO
        LEFT JOIN WP_POSTS WPP
        ON PRO.PROIMG = WPP.ID");
        $smtp->execute();


        return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
    }
}
