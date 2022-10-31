<?php

class Contrato{

    /**
     * identificador unico
     * @var integer
     */
    private $id;    

    /**
     * Identiicador do Locatario
     * @var integer
     */
    private $idLocatario;

    /**
     * Identiicador do Imovel
     * @var integer
     */
    private $idImovel;
    
    /**
     * Data inicio
     * @var string
     */
    private $dataInicio;

    /**
     * Data fim
     * @var string
     */
    private $dataFim;

    /**
     * Duração em meses / default = 12
     * @var integer
     */
    private $duracao = 12;

    /**
     * Taxa da administração
     * @var float
     */
    private $taxaAdm;

    /**
     * Valor do aluguel
     * @var float
     */
    private $valorAluguel;

    /**
     * Valor do condominio
     * @var float
     */
    private $valorCondominio;

    /**
     * Valor do IPTU
     * @var float
     */
    private $valorIptu;

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param integer idLocatario
     * @param integer idImovel
     * @param string  dataInicio
     * @param integer duracao
     * @param float taxaAdm
     * @param float valorAluguel
     * @param float valorCondominio
     * @param float valorIptu
     * 
     */             
    public function __construct( 
        $idLocatario,
        $idImovel,
        $dataInicio,
        $duracao,
        $taxaAdm,
        $valorAluguel,    
        $valorCondominio,
        $valorIptu 
    ){
        $this->idLocatario      = $idLocatario;
        $this->idImovel         = $idImovel;
        $this->duracao          = $duracao;
        $this->taxaAdm          = $taxaAdm;
        $this->valorAluguel     = $valorAluguel;
        $this->valorCondominio  = $valorCondominio;
        $this->valorIptu        = $valorIptu;
        $this->setDataInicio( $dataInicio );
    }

    /**
     * *********** GETTERS AND SETTERS ***********
     */

    public function setId( $id ){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setIdLocatario( $idLocatario ){
        $this->idLocatario = $idLocatario;
    }

    public function getIdLocatario(){
        return $this->idLocatario;
    }

    public function setIdImovel( $idImovel ){
        $this->idImovel = $idImovel;
    }

    public function getIdImovel(){
        return $this->idImovel;
    }
 
    public function setDataInicio( $dataInicio ){
        $this->dataInicio = $dataInicio;
        $this->calculeDataFim();
    }

    public function getDataInicio(){
        return $this->dataInicio;
    }

    public function setDuracao( $duracao ){
        $this->duracao = $duracao;
    }

    public function getDuracao(){
        return $this->duracao;
    }

    public function setTaxaAdm( $taxaAdm ){
        $this->taxaAdm = $taxaAdm;
    }

    public function getTaxaAdm(){
        return $this->taxaAdm;
    }

    public function setValorAluguel( $valorAluguel ){
        $this->valorAluguel = $valorAluguel;
    }

    public function getValorAluguel(){
        return $this->valorAluguel;
    }
    
    public function setValorCondominio( $valorCondominio ){
        $this->valorCondominio = $valorCondominio;
    }

    public function getValorCondominio(){
        return $this->valorCondominio;
    }

    public function setValorIptu( $valorIptu ){
        $this->valorIptu = $valorIptu;
    }

    public function getValorIptu(){
        return $this->valorIptu;
    }

    /**
     * 
     * Metodo responsavel por calcular a data de fim do contrato
     * O contrato deve conter a quantidade de meses definido na @var $this->duracao independente dos dias
     * O contrato deve terminar no ultimo dia do mês em questão
     * @return boolean 
     */
    private function calculeDataFim(){   

        /**
         * Adicionando a quantidade de meses definido na @var $this->duracao sobre a @var $this->dataInicio e definido dia igual a um (1) 
         */
        $temp = date('Y-m-01' , strtotime($this->dataInicio.' + '.$this->duracao.' months' ));

        /**
         * Retiro um dia da @var $temp para obter a data final do contrato
         */
        $this->dataFim = date('Y-m-d', strtotime($temp.' - 1 day'));

        return true;
    }



    

    
    
}