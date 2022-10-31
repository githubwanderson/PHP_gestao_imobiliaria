<?php

abstract class Cliente{

    /**
     * identificador unico
     * @var integer
     */
    protected $id;

    /**
     * Nome
     * @var string
     */
    protected $nome;
    
    /**
     * Email
     * @var string
     */
    protected $email;
    
    /**
     * Telefone
     * @var string
     */
    protected $telefone;

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param string $nome $email $telefone
     * 
     */
    public function __construct( $nome , $email , $telefone )
    {
        $this->nome     = $nome;
        $this->email    = $email;
        $this->telefone = $telefone;
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

    public function setNome( $nome ){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setEmail( $email ){
        $this->nemailome = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setTelefone( $telefone ){
        $this->telefone = $telefone;
    }

    public function getTelefone(){
        return $this->telefone;
    }

}