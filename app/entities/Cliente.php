<?php

require __DIR__.'/../database/Database.php';

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
     * Datatime do cadastro
     * @var string
     */
    protected $CREATED_DATETIME;

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param array $arr [ NOME , EMAIL , TELEFONE ]
     * 
     */
    public function __construct( $arr = [] )
    {
        $this->setNome( $arr['NOME'] );
        $this->setEmail( $arr['EMAIL'] );
        $this->setTelefone( $arr['TELEFONE']);
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
        $this->email = $email;
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

    public function setCreatedDatatime( $CREATED_DATETIME ){
        $this->CREATED_DATETIME = $CREATED_DATETIME;
    }

    public function getCreatedDatatime(){
        return $this->CREATED_DATETIME;
    }

    /**
     * metodo responsavel por cadastrar o obj no banco de dados
     */
    public abstract function Cadastrar();

}