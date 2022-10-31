<?php

class imovel{

    /**
     * identificador unico
     * @var integer
     */
    private $id;    

    /**
     * Identiicador do Locador
     * @var integer
     */
    private $idLocador;
    
    /**
     * Endereço do imovel
     * @var string
     */
    private $endereco;

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param integer $idLocador
     * @param string $endereco
     * 
     */
    public function __construct( $idLocador , $endereco )
    {
        $this->idLocador  = $idLocador;
        $this->endereco   = $endereco;
    }

    /**
     * *********** GETTERS AND SETTERS ***********
     */

    public function setIdLocador( $idLocador ){
        $this->idLocador = $idLocador;
    }

    public function getIdLocador(){
        return $this->idLocador;
    }

    public function setEndereco( $endereco ){
        $this->endereco = $endereco;
    }

    public function getEndereco(){
        return $this->endereco;
    }

}