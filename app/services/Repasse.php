<?php

require_once __DIR__.'/Parcela.php';

class Repasse extends Parcela{

    /**
     * Tipo de parcela conforme especificado no banco de dados na tabela 'contrato_parcela_tipo'
     * valor 2 = repasse
     * @var int
     */
    private $BD_PARCELA_TIPO = 2;  

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param Contrato $contrato
     * @param integer $idRepasse
     * 
     */
    public function __construct( $contrato , $idRepasse = null )
    {
        parent::__construct($contrato );
        $this->setTipo( $this->BD_PARCELA_TIPO );
        $this->setValor( $this->valorRepasse() );
    }

    /**
     * Metodo responsavel por calcular o valor do repasse
     * 
     * @return float
     */
    private function valorRepasse(){

        require_once __DIR__.'/../entities/AdmTaxa.php';

        $taxa = ( new AdmTaxa() )->getValor();

        $taxa *= $this->contrato->getValorAluguel() / 100;

        return $this->contrato->getValorAluguel() + $this->contrato->getValorIptu() - $taxa;

    }

}