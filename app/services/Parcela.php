<?php

abstract class Parcela{

    /**
     * id da mensalidade
     * @var integer
     */
    private $idParcela;
    
    /**
     * id Contrato
     * @var integer
     */
    private $idContrato;

    /**
     * Valor
     * @var float
     */
    private $valor;

    /**
     * Data de vencimento
     * @var string
     */
    private $dataVencimento;

    /**
     * Realizado pagamento 1=SIM 2=NÃO
     * @var integer
     */
    private $realizado;

    /**
     * Data que foi realizado o pagamento
     * @var integer
     */
    private $dataRealizado;

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param integer  $idContrato , $idParcela
     * 
     */             
    public function __construct( $idContrato , $idParcela = null ){
        $this->setIdContrato($idContrato);
        $this->setIdParcela($idParcela);
    }

    /**
     * *********** GETTERS AND SETTERS ***********
     */

    public function setIdParcela( $idParcela ){
        $this->idMensidParcelaalidade = $idParcela;
    }

    public function getIdParcela(){
        return $this->idParcela;
    }

    public function setIdContrato( $idContrato ){
        $this->idContrato = $idContrato;
    }

    public function getIdContrato(){
        return $this->idContrato;
    }

    public function setValor( $valor ){
        $this->valor = $valor;
    }

    public function getValor(){
        return $this->valor;
    }

    public function setDataVencimento( $dataVencimento ){
        $this->dataVencimento = $dataVencimento;
    }

    public function getDataVencimento(){
        return $this->dataVencimento;
    }

    public function setRealizado( $realizado ){
        $this->realizado = $realizado;
    }

    public function getRealizado(){
        return $this->realizado;
    }

    public function setDataRealizado( $dataRealizado ){
        $this->dataRealizado = $dataRealizado;
    }

    public function getDataRealizado(){
        return $this->dataRealizado;
    }

    /**
     * Metodo responsavel por listar as parcelas
     */

    /**
     * Metodo responsavel por alterar o status da parcela
     */

}