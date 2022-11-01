<?php

require __DIR__.'/Cliente.php';

class Locador extends Cliente{

    /**
     * Tipo de cliente conforme especificado no banco de dados na tabela 'cliente_tipo'
     * valor 1 = LOCADOR
     * @var int
     */
    private $TIPO = 1; 

    /**
     * Dia para repasse do aluguel
     * @var integer 1-31
     */
    private $DIA_REPASSE;

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param array $post [ NOME , EMAIL , TELEFONE ]
     * @param integer $BD_CLIENTE_TIPO
     * 
     */
    public function __construct( $post )
    {
        parent::__construct($post );

        $this->setDiaRepasse( $post['DIA_REPASSE'] );
    }

    /**
     * *********** GETTERS AND SETTERS ***********
     */

    /**
     * set dia repasse
     * valida entrada que deve estar entre 01 e 31
     * @param integer 
     * @return boolean
     */
    public function setDiaRepasse( $DIA_REPASSE ){

        if($DIA_REPASSE >= 1 && $DIA_REPASSE <= 31){
            $this->DIA_REPASSE = $DIA_REPASSE;
        }
        else
        {
            return false;
        }
        
    }

    public function getDiaRepasse(){
        return $this->DIA_REPASSE;
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