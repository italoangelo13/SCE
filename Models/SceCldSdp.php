<?php

class SceCldSdp
{
    public $Id;
    public $Produto;
    public $Quatidade;
    public $TipoSaidaProduto;
    public $DataSaida;
    public $Pedido;
    public $DataCadastro;
    public $UsuarioCadastro;

    public function __construct()
    {
        $Id = null;
        $Produto = null;
        $Quatidade = null;
        $TipoSaidaProduto = null;
        $DataSaida = null;
        $Pedido = null;
        $DataCadastro = null;
        $UsuarioCadastro = null;
        
    }
    
    
    public function SelecionaItemPedidoPorCodigo($cod)
    {
        # code...
    }

    public function InsereSaidaDeProduto()
    {
        try {
            $pdo = new PDO(server, user, senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $smtp = $pdo->prepare("INSERT INTO scetblsdp
            (SDPDATASAIDA, PROCOD, SDPQTDE, TSPCOD, SDPUSER, SDPDATACADASTRO, PEDCOD)
            values(
            '$this->DataSaida',
            $this->Produto,
            $this->Quatidade,
            $this->TipoSaidaProduto,
            '$this->UsuarioCadastro',
            CURRENT_TIMESTAMP,
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