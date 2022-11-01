<?php

use LDAP\Result;

require __DIR__.'/AdmTaxa.php';

class Contrato{

    /**
     * identificador unico
     * @var integer
     */
    private $ID;    

    /**
     * Identiicador do Locatario
     * @var integer
     */
    private $ID_CLIENTE;

    /**
     * Identiicador do Imovel
     * @var integer
     */
    private $ID_IMOVEL;
    
    /**
     * Data inicio
     * @var string
     */
    private $DT_INICIO;

    /**
     * Data fim
     * @var string
     */
    private $DT_FIM;

    /**
     * Duração em meses / default = 12
     * @var integer
     */
    private $DURACAO_MES = 12;

    /**
     * Taxa da administração
     * @var float
     */
    private $VALOR_TX_ADM;

    /**
     * Valor do aluguel
     * @var float
     */
    private $VALOR_ALUGUEL;

    /**
     * Valor do condominio
     * @var float
     */
    private $VALOR_CONDOMINIO;

    /**
     * Valor do IPTU
     * @var float
     */
    private $VALOR_IPTU;

    /**
     * Datatime do cadastro
     * @var string
     */
    protected $CREATED_DATETIME;
    

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param array $arr [ ID_CLIENTE , ID_IMOVEL , DURACAO_MES , DT_INICIO , VALOR_CONDOMINIO , VALOR_IPTU , DT_INICIO ]
     * 
     */
    public function __construct( $arr = [] )
    {
        $this->setIdLocatario( $arr['ID_CLIENTE'] );
        $this->setIdImovel( $arr['ID_IMOVEL'] );
        $this->setDataInicio( $arr['DT_INICIO'] );
        $this->setDuracao( $arr['DURACAO_MES'] );
        $this->setValorCondominio( $arr['VALOR_CONDOMINIO'] );
        $this->setValorIptu( $arr['VALOR_IPTU'] );
        $this->setValorAluguel( $arr['VALOR_ALUGUEL'] );
        $this->setTaxaAdm();
    }

    /**
     * *********** GETTERS AND SETTERS ***********
     */

    public function setId( $ID ){
        $this->ID = $ID;
    }

    public function getId(){
        return $this->ID;
    }

    public function setIdLocatario( $ID_CLIENTE ){
        $this->ID_CLIENTE = $ID_CLIENTE;
    }

    public function getIdLocatario(){
        return $this->ID_CLIENTE;
    }

    public function setIdImovel( $ID_IMOVEL ){
        $this->ID_IMOVEL = $ID_IMOVEL;
    }

    public function getIdImovel(){
        return $this->ID_IMOVEL;
    }
 
    public function setDataInicio( $DT_INICIO ){
        $this->DT_INICIO = $DT_INICIO;
        $this->calculeDataFim();
    }

    public function getDataInicio(){
        return $this->DT_INICIO;
    }

    public function getDataFim(){
        return $this->DT_FIM;
    }

    public function setDuracao( $DURACAO_MES ){
        $this->DURACAO_MES = $DURACAO_MES;
    }

    public function getDuracao(){
        return $this->DURACAO_MES;
    }

    public function getTaxaAdm(){
        return $this->VALOR_TX_ADM;
    }

    public function setValorAluguel( $VALOR_ALUGUEL ){
        $this->VALOR_ALUGUEL = $VALOR_ALUGUEL;
    }

    public function getValorAluguel(){
        return $this->VALOR_ALUGUEL;
    }
    
    public function setValorCondominio( $VALOR_CONDOMINIO ){
        $this->VALOR_CONDOMINIO = $VALOR_CONDOMINIO;
    }

    public function getValorCondominio(){
        return $this->VALOR_CONDOMINIO;
    }

    public function setValorIptu( $VALOR_IPTU ){
        $this->VALOR_IPTU = $VALOR_IPTU;
    }

    public function getValorIptu(){
        return $this->VALOR_IPTU;
    }

    public function setCreatedDatatime( $CREATED_DATETIME ){
        $this->CREATED_DATETIME = $CREATED_DATETIME;
    }

    public function getCreatedDatatime(){
        return $this->CREATED_DATETIME;
    }

    /** 
     * Metodo responsavel por calcular a data de fim do contrato
     * O contrato deve conter a quantidade de meses definido na @var $this->duracao independente dos dias
     * O contrato deve terminar no ultimo dia do mês em questão
     * @return boolean 
     */
    private function calculeDataFim(){   
        /**
         * Adicionando a quantidade de meses definido na @var $this->duracao sobre a @var $this->dataInicio e definido dia igual a um (1) 
         */
        $temp = date('Y-m-01' , strtotime($this->DT_INICIO.' + '.$this->getDuracao().' months' ));

        /**
         * Retiro um dia da @var $temp para obter a data final do contrato
         */
        $this->DT_FIM = date('Y-m-d', strtotime($temp.' - 1 day'));

        return true;
    }

    /**
     * Metodo responsavel por buscar o valor da taxa de administração
     */
    private function setTaxaAdm(){
        $this->VALOR_TX_ADM = ( new AdmTaxa() )->getValor();
    }

    /**
     * metodo responsavel por cadastrar o obj no banco de dados
     */
    public function Cadastrar(){

        require_once __DIR__.'/../database/Database.php';
        require_once __DIR__.'/../services/Mensalidade.php';
        require_once __DIR__.'/../services/Repasse.php';

        // Data do cadastro
        $this->setCreatedDatatime( date('Y-m-d H:i:s') );

        //inserir no banco
        $db = new Database('contrato');
        $this->setId( $db->insert(get_object_vars($this) ) );

        //Cadastrar parcelas
        $p = new Mensalidade( $this );
        $p->cadastrarParcelas();

        //Cadastrar repasse
        $r = new Repasse( $this );
        $r->cadastrarParcelas();

        //retornar sucesso
        return $this->getId();
    }



    

    
    
}