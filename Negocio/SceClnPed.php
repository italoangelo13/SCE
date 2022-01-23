<?php

class SceClnPed
{

    public function CalculaTaxaVlrComissao($vlrVenda)
    {
        $Comissao = array();

        switch ($vlrVenda) {
            case $vlrVenda <= 500:
                $vlrCom = ($vlrVenda * 20) / 100; //20%
                $Comissao = [
                    "Taxa" => 20,
                    "ValorComissao" => $vlrCom
                ];
                break;
            case $vlrVenda >= 501 && $vlrVenda <= 1000:
                $vlrCom = ($vlrVenda * 30) / 100; //30%
                $Comissao = [
                    "Taxa" => 30,
                    "ValorComissao" => $vlrCom
                ];
                break;
            case $vlrVenda >= 1001:
                $vlrCom = ($vlrVenda * 35) / 100; //35%
                $Comissao = [
                    "Taxa" => 35,
                    "ValorComissao" => $vlrCom
                ];
                break;
        }

        return $Comissao;
    }
}
