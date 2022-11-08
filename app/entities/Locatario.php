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

    /**
     * metodo responsavel por cadastrar o obj no banco de dados
     * @return integer id
     */
    public function Cadastrar(){

        require_once __DIR__.'/../database/Database.php';

        // Data do cadastro
        $this->setCreatedDatatime( date('Y-m-d H:i:s') );

        //inserir no banco
        $db = new Database('cliente');

        $this->setId( 
            $db->insert(
            [
                'TIPO'        => $this->getTipo(),
                'NOME'        => $this->getNome(),
                'EMAIL'       => $this->getEmail(),
                'TELEFONE'    => $this->getTelefone()
            ])
        );

        return $this->getId();
    }

    /**
     * Metodo responsavel por atualizar um Locador
     */
    public function update(){

        require_once __DIR__.'/../database/Database.php';

        $db = new Database('cliente');

        return $db->update( 'ID = '.$this->getId(), [
            'NOME'     => $this->getNome(),
            'EMAIL'    => $this->getEmail(),
            'TELEFONE' => $this->getTelefone()
        ]);
    }
}