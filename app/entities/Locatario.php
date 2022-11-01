<?php

require __DIR__.'/Cliente.php';

class Locatario extends Cliente{

    /**
     * Tipo de cliente conforme especificado no banco de dados na tabela 'cliente_tipo'
     * valor 2 = LOCATARIO
     * @var int
     */
    private $TIPO_CLIENTE = 2; 

    /**
     * *********** CONSTRUCT ***********
     */
    public function __construct(){
        $this->setTipo( $this->getTipoCliente() );
    }

    /**
     * Metodo get para Tipo
     */
    public function getTipoCliente(){
        return $this->TIPO_CLIENTE;
    }

    /**
     * Metodo responsavel por povoar o objeto com array
     */
    public function setDados( $arr = [] ){
        $this->setDadosCliente( $arr );        
    }
}