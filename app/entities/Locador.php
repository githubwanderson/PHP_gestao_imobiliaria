<?php

require __DIR__.'/Cliente.php';

class Locador extends Cliente{

    /**
     * Tipo de cliente conforme especificado no banco de dados na tabela 'cliente_tipo'
     * valor 1 = LOCADOR
     * @var int
     */
    private $TIPO_CLIENTE = 1;

    /**
     * Dia para repasse do aluguel
     * @var integer 1-31
     */
    private $DIA_REPASSE;

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param array $arr [ NOME , EMAIL , TELEFONE ]
     * @param integer $BD_CLIENTE_TIPO
     * 
     */
    public function __construct()
    {
        $this->setTipo( $this->getTipoCliente() );
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
            $this->DIA_REPASSE = 1; 
        }
        
    }

    public function getDiaRepasse(){
        return $this->DIA_REPASSE;
    }

    public function getTipoCliente(){
        return $this->TIPO_CLIENTE;
    }

    /**
     * Metodo responsavel por povoar o objeto com array
     */
    public function setDados( $arr = [] ){
        $this->setDadosCliente( $arr );  
        $this->setDiaRepasse( $arr['DIA_REPASSE'] );
    }

    /**
     * metodo responsavel por povoar obj com dados do banco
     * @param integer $id
     * @return boolean
     */
    public function getLocador( $id ){

        require_once __DIR__.'/../database/Database.php';
        
        $bd = new Database('cliente');
        $result =  $bd->select( 'ID = '.$id )
                        ->fetchAll( PDO::FETCH_ASSOC );
        $this->setDados(  $result[0]  );
        return true;
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
                'TELEFONE'    => $this->getTelefone(),
                'DIA_REPASSE' => $this->getDiaRepasse()
            ])
        );

        //retornar 
        return $this->getId();

    }

}