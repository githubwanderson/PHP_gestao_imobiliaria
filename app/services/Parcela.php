<?php

class Parcela{

    /**
     * id da mensalidade
     * @var integer
     */
    private $ID;
    
    /**
     * id Contrato
     * @var integer
     */
    private $ID_CONTRATO;

    /**
     * tipo parcela : 1 = MENSALIDADE , 2 = REPASSE
     * @var integer
     */
    private $TIPO;

    /**
     * Numero parcela
     * @var integer
     */
    private $PARCELA;

    /**
     * Valor
     * @var float
     */
    private $VALOR;

    /**
     * Data de vencimento
     * @var string
     */
    private $DT_VENCIMENTO;

    /**
     * Realizado pagamento : 1=SIM 2=NÃO
     * @var integer
     */
    private $REALIZADO;

    /**
     * Data que foi realizado o pagamento
     * @var integer
     */
    private $DT_REALIZADO;

    /**
     * objeto Contrato
     * @var Contrato
     */
    public $contrato;

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param Contrato 
     * 
     */             
    public function __construct( Contrato $contrato = null ){
        $this->contrato = $contrato;
    }

    /**
     * *********** GETTERS AND SETTERS ***********
     */

    public function setId( $ID ){
        $this->id = $ID;
    }

    public function getId(){
        return $this->ID;
    }

    public function setIdContrato( $ID_CONTRATO ){
        $this->ID_CONTRATO = $ID_CONTRATO;
    }

    public function getIdContrato(){
        return $this->ID_CONTRATO;
    }

    public function setTipo( $TIPO ){
        $this->TIPO = $TIPO;
    }

    public function getTipo(){
        return $this->TIPO;
    }

    public function setParcela( $PARCELA ){
        $this->PARCELA = $PARCELA;
    }

    public function getParcela(){
        return $this->PARCELA;
    }

    public function setValor( $VALOR ){
        $this->VALOR = $VALOR;
    }

    public function getValor(){
        return $this->VALOR;
    }

    public function setDataVencimento( $DT_VENCIMENTO ){
        $this->DT_VENCIMENTO = $DT_VENCIMENTO;
    }

    public function getDataVencimento(){
        return $this->DT_VENCIMENTO;
    }

    public function setRealizado( $REALIZADO ){
        $this->REALIZADO = $REALIZADO;
    }

    public function getRealizado(){
        return $this->REALIZADO;
    }

    public function setDataRealizado( $DT_REALIZADO ){
        $this->DT_REALIZADO = $DT_REALIZADO;
    }

    public function getDataRealizado(){
        return $this->DT_REALIZADO;
    }

    /**
     * Metodo responsavel por gerar parcelas
     * @var $duracao
     * @var $data_inicio
     */ 
    public function cadastrarParcelas(){    

        $db = new Database('contrato_parcela');

        for ($i=0; $i < $this->contrato->getDuracao(); $i++) { 

            $dt = date('Y-m-01' , strtotime($this->contrato->getDataInicio().' + '.($i+1).' month'));

            $db->insert(
            [
                'ID_CONTRATO'   => $this->contrato->getId(),
                'TIPO'          => $this->getTipo(),
                'PARCELA'       => $i+1,
                'VALOR'         => $i == 0 ? $this->valorPrimeiraparcela() : $this->getValor(),
                'DT_VENCIMENTO' => $dt
            ]);

        }
        return true;
    }

    /**
     * Metodo responsavel por gerar o valor da primeira mensalidade
     * Para cobrar o dia em que o contrato foi assinado somar 1 em $qtdeDeDias : $qtdeDeDias + 1
     * @return float
     */
    private function valorPrimeiraparcela(){

        /**
         * obtendo o primeiro dia do contrato e o ultimo dia do mês inicial
         */
        $primeiroDia    = date('d', strtotime($this->contrato->getDataInicio()));
        $ultimoDia      = date('t', strtotime($this->contrato->getDataInicio()));

        /**
         * Verificar se o dia inicio é diferente de 1 , se sim gerar valor proporcional da primeira mensalidade
         */
        if( $primeiroDia != 1 ){

            $valorPorDia    = $this->getValor() / 30;
            $qtdeDeDias     = $ultimoDia - $primeiroDia;
            $valorPrimeiraMensalidade = $valorPorDia * $qtdeDeDias;
        }
        else
        {
            $valorPrimeiraMensalidade = $this->getValor();
        }
        return $valorPrimeiraMensalidade;
    }

}