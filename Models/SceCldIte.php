<?php

class SceCldIte
{
    public $Id;
    public $Produto;
    public $SKU;
    public $Quantidade;
    public $ValorUnitario;
    public $ValorTotal;
    public $Pedido;
    public $DataCadastro;
    public $UsuarioCadastro;

    public function __construct()
    {
        $Id = null;
        $Produto = null;
        $Quantidade = null;
        $ValorUnitario = null;
        $ValorTotal = null;
        $Pedido = null;
        $DataCadastro = null;
        $UsuarioCadastro = null;
        $SKU = null;
        
    }
    
    public function LeLinha($dados)
    {
        $Id = $dados->ITECOD;
        $Produto = $dados->PROCOD;
        $Quantidade = $dados->ITEQTDE;
        $ValorUnitario = $dados->ITEVLRUNITARIO;
        $ValorTotal = $dados->ITEVLRTOTAL;
        $Pedido = $dados->PEDCOD;
        $DataCadastro = $dados->ITEDATACADASTRO;
        $UsuarioCadastro = $dados->ITEUSER;
    }
    
    public function SelecionaItemPedidoPorCodigo($cod)
    {
        # code...
    }

    public function SelecionaTodosItensPedido($codPedido)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT ITECOD,
        ite.PROCOD,
        pro.PROSKU,
        pro.PRONOME,
        ITEQTDE,
        ITEVLRUNITARIO,
        ITEVLRTOTAL,
        ITEDATACADASTRO,
        ITEUSER,
        PEDCOD
        FROM scetblite as ite
        inner join scetblpro as pro
        on ite.procod = pro.procod
        where PEDCOD = $codPedido");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }

    public function InsereItensPedidoViaRevenda($codPedido)
    {
        try {
            $pdo = new PDO(server, user, senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $smtp = $pdo->prepare("INSERT INTO scetblite
            (PROCOD,
            ITEQTDE,
            ITEVLRUNITARIO,
            ITEVLRTOTAL,
            ITEDATACADASTRO,
            ITEUSER,
            PEDCOD)
            select
            ipr.PROCOD,
            IPRQTDEVENDIDA,
            case
              when pro.proprecopromocional > 0
                then pro.proprecopromocional
              else
                pro.proprecovenda
            end as preco,
            IFNULL(CASE
                    WHEN pro.PROPRECOPROMOCIONAL > 0
                      THEN ipr.IPRQTDEVENDIDA * pro.PROPRECOPROMOCIONAL
                    ELSE
                       ipr.IPRQTDEVENDIDA * pro.PROPRECOVENDA
                  END,0.00) AS VLRVENDIDO,
            CURRENT_TIMESTAMP,
            '$this->UsuarioCadastro',
            $this->Pedido
            from  scetblipr as ipr
            inner join scetblpro as pro
            on ipr.procod = pro.procod
            where PDRCOD = $codPedido
            and IPRITEMVENDIDO = 'S'");
            $smtp->execute();
            $result = $smtp->rowCount();
            if($result > 0){
                return true;
            }
            else{
                return false;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function InsereItemPedido()
    {
        try {
            $pdo = new PDO(server, user, senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $smtp = $pdo->prepare("INSERT INTO scetblite
            (PROCOD,
            ITEQTDE,
            ITEVLRUNITARIO,
            ITEVLRTOTAL,
            ITEDATACADASTRO,
            ITEUSER,
            PEDCOD)
            values(
            $this->Produto,
            $this->Quatidade,
            $this->ValorUnitario,
            $this->ValorTotal,
            CURRENT_TIMESTAMP,
            '$this->UsuarioCadastro',
            $this->Pedido)");
            $smtp->execute();
            $result = $smtp->rowCount();
            if($result > 0){
                return true;
            }
            else{
                return false;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>