<?php

require __DIR__.'/Cliente.php';

class Locatario extends Cliente{

    /**
     * Tipo de cliente conforme especificado no banco de dados na tabela 'cliente_tipo'
     * valor 2 = LOCATARIO
     * @var int
     */
    private $TIPO = 2; 

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param array $post [ NOME , EMAIL , TELEFONE ]
     * @param integer $BD_CLIENTE_TIPO
     * 
     */
    public function __construct( $post = [] )
    {
        parent::__construct($post );
    }
    
    /**
     * metodo responsavel por cadastrar o obj no banco de dados
     */
    public function Cadastrar(){

        // Data do cadastro
        $this->setCreatedDatatime( date('Y-m-d H:i:s') );

        //inserir no banco
        $db = new Database('cliente');
        $this->setId( $db->insert(get_object_vars($this) ) );

        //retornar sucesso
        return $this->getId();
    }

}