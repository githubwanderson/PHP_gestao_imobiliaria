<?php

require_once __DIR__.'/Parcela.php';

class Mensalidade extends Parcela{

    /**
     * Tipo de parcela conforme especificado no banco de dados na tabela 'contrato_parcela_tipo'
     * valor 1 = mensalidade
     * @var int
     */
    private $BD_PARCELA_TIPO = 1;  

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param Contrato $contrato
     * @param integer $idMensalidade
     * 
     */
    public function __construct( $contrato , $idMensalidade = null )
    {
        parent::__construct($contrato );
        $this->setTipo( $this->BD_PARCELA_TIPO );
        $this->setValor( $this->valorMensalidade() );
        $this->dataPrimeiraParcela();
    }

    /**
     * Metodo responsavel por calcular o valor da mensalidade
     * @return float
     */
    private function valorMensalidade(){
        return $this->contrato->getValorAluguel() + $this->contrato->getValorCondominio() + $this->contrato->getValorIptu();
    }

    /**
     * Metodo responsavel por gerar a data da primeira parcela
     */
    public function dataPrimeiraParcela(){
        $this->setDataVencimento( date('Y-m-01' , strtotime($this->contrato->getDataInicio().' +1 month')) );
    }
    
}