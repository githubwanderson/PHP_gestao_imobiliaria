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
        $this->dataPrimeiraParcela();
    }

    /**
     * Metodo responsavel por calcular o valor do repasse
     * 
     * @return float
     */
    private function valorRepasse(){

        require_once __DIR__.'/AdmTaxa.php';

        $taxa = ( new AdmTaxa() )->getValor();

        $taxa *= $this->contrato->getValorAluguel() / 100;

        return $this->contrato->getValorAluguel() + $this->contrato->getValorIptu() - $taxa;

    }

    /**
     * Metodo responsavel por gerar a data de vencimento do primeiro repasse
     * Identifica o imovel e paga o ID do proprietario
     * Identifica o proprietario e pega o dia de repasse para gerar a data
     * 
     */
    public function dataPrimeiraParcela(){
        
        require_once __DIR__.'/../entities/Imovel.php';
        require_once __DIR__.'/../entities/Locador.php';

        $imovel = new Imovel();
        $imovel->getImovel( $this->contrato->getIdImovel() );

        $locador = new Locador();
        $locador->getLocador( $imovel->getIdLocador() );
        $diaRepasse = $locador->getDiaRepasse();

        $this->setDataVencimento( date('Y-m-'.$diaRepasse , strtotime($this->contrato->getDataInicio().' +1 month')) );
    }

}