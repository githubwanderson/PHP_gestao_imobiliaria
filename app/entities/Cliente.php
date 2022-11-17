<?php

abstract class Cliente{

    /**
     * identificador unico
     * @var integer
     */
    protected $ID;

    /**
     * Tipo de cliente conforme especificado no banco de dados na tabela 'cliente_tipo'
     * @var int
     */
    private $TIPO; 

    /**
     * Nome
     * @var string
     */
    protected $NOME;
    
    /**
     * Email
     * @var string
     */
    protected $EMAIL;
    
    /**
     * Telefone
     * @var string
     */
    protected $TELEFONE;

    /**
     * Datatime do cadastro
     * @var string
     */
    protected $CREATED_DATETIME;

    /**
     * *********** CONSTRUCT ***********
     */
    public function __construct(){}

    /**
     * *********** GETTERS AND SETTERS ***********
     */

    public function setId( $ID ){
        $this->ID = $ID;
    }

    public function getId(){
        return $this->ID;
    }

    public function setTipo( $TIPO ){
        $this->TIPO = $TIPO;
    }

    public function getTipo(){
        return $this->TIPO;
    }

    public function setNome( $NOME ){
        $this->NOME = $NOME;
    }

    public function getNome(){
        return $this->NOME;
    }

    public function setEmail( $EMAIL ){
        $this->EMAIL = $EMAIL;
    }

    public function getEmail(){
        return $this->EMAIL;
    }

    public function setTelefone( $TELEFONE ){
        $this->TELEFONE = $TELEFONE;
    }

    public function getTelefone(){
        return $this->TELEFONE;
    }

    public function setCreatedDatatime( $CREATED_DATETIME ){
        $this->CREATED_DATETIME = $CREATED_DATETIME;
    }

    public function getCreatedDatatime(){
        return $this->CREATED_DATETIME;
    }

    /**
     * Metodo responsavel por povoar o objeto com array
     */
    public function setDadosCliente( $arr = [] ){
        if(isset($arr['ID']))$this->setId( $arr['ID'] );
        $this->setNome( $arr['NOME'] );
        $this->setEmail( $arr['EMAIL'] );
        $this->setTelefone( $arr['TELEFONE']);
    }

}