<?php

require __DIR__.'/../database/Database.php';

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
    private $ID_CLIENTE;
    
    /**
     * Endereço do imovel
     * @var string
     */
    private $ENDERECO;

    /**
     * Datatime do cadastro
     * @var string
     */
    protected $CREATED_DATETIME;

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param array $arr [ ID_CLIENTE , ENDERECO ]
     * 
     */
    public function __construct( $arr )
    {
        $this->setIdLocador( $arr['ID_CLIENTE'] );
        $this->setEndereco( $arr['ENDERECO'] );
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

    public function setIdLocador( $ID_CLIENTE ){
        $this->ID_CLIENTE = $ID_CLIENTE;
    }

    public function getIdLocador(){
        return $this->ID_CLIENTE;
    }

    public function setEndereco( $ENDERECO ){
        $this->ENDERECO = $ENDERECO;
    }

    public function getEndereco(){
        return $this->ENDERECO;
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
    public function Cadastrar(){

        // Data do cadastro
        $this->setCreatedDatatime( date('Y-m-d H:i:s') );

        //inserir no banco
        $db = new Database('imovel');
        $this->setId( $db->insert(get_object_vars($this) ) );

        //retornar sucesso
        return $this->getId();
    }

}