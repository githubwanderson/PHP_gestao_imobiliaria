<?php

/**
 * Class responsavel por gerar mensalidade conforme as regras estabelecidas
 */

class ContratoMensalidade {

    /**
     * objeto Contrato
     * @var Contrato
     */
    private $contrato;

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param Contrato 
     * 
     */             
    public function __construct( Contrato $contrato ){
        $this->contrato = $contrato;
    }

    /**
     * Metodo responsavel por gerar o valor da primeira mensalidade
     * @return float
     */
    private function valorPrimeiraMensalidade(){

        /**
         * obtendo o primeiro e ultimo dia do mês inicial do contrato
         */
        $primeiroDia    = date('d', strtotime($this->contrato->getDataInicio()));
        $ultimoDia      = date('t', strtotime($this->contrato->getDataInicio()));


        /**
         * Verificar se o dia inicio é diferente de 1 , se sim gerar valor proporcional da primeira mensalidade
         */
        if( $primeiroDia != 1 ){

            $valorPorDia    = $this->valorMensalidadeCheia() / 30;
            $qtdeDeDias     = $ultimoDia - $primeiroDia;
            $valorPrimeiraMensalidade = $valorPorDia * $qtdeDeDias;
        }
        else
        {
            $valorPrimeiraMensalidade = $this->valorMensalidadeCheia();
        }
        return $valorPrimeiraMensalidade;
    }

    /**
     * Metodo responsavel por gerar o valor da mensalidade cheia
     * @return float
     */
    private function valorMensalidadeCheia(){
        return $this->contrato->getValorIptu() + $this->contrato->getValorCondominio() + $this->contrato->getValorAluguel();
    }

    /**
     * Metodo responsavel por gerar as mensalidades do contrato
     * @return array  
     */
    public function gerarMensalidade(){        

        $mensalidade = [];

        for ($i=0; $i < $this->contrato->getDuracao(); $i++) { 

            
            $arr = [
                'ID_CONTRATO'       => $this->contrato->getId(),
                'PARCELA'           => $i + 1,
                'VALOR'             => $i == 0 ? $this->valorPrimeiraMensalidade() : $this->valorMensalidadeCheia(),
                'DT_VENCIMENTO'     => date('Y-m-01' , strtotime($this->contrato->getDataInicio().' + '. ($i+1) .' month' ))
            ];

            $mensalidade[$i] = $arr;            
        }

        return $mensalidade;
    }
}