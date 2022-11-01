<?php

class AdmTaxa{

    /**
     * valor da taxa de administração sobre o aluguel
     * @var float
     */
    private $VALOR; 

    /**
     * *********** CONSTRUCT ***********
     *  
     */
    public function __construct()
    {
        $this->VALOR = $this->getTaxaAdministracao();
    }

    /**
     * *********** GETTERS AND SETTERS ***********
     */

    /**
     * Metodo responsavel por alterar o valor da taxa
     * Deve salvar no banco de dados
     * indisponivel no momento
     */

    // public function setValorTaxaAdm( $VALOR ){
    //     $this->VALOR = $VALOR;
    // }

    public function getValor(){
        return $this->VALOR;
    }
    
    /**
     * Metodo responsavel por pegar o valor da taxa de administração
     * @return int utimo ID com status = ATIVO cadastrado
     */
    private function getTaxaAdministracao(){

        require_once __DIR__.'/../database/Database.php';

        $db     = new Database('adm_taxa');
        $result = $db->select( 'ATIVO = 1' , null , 'ID DESC' , '1' , 'VALOR' )->fetch(PDO::FETCH_ASSOC);
        return $result['VALOR'];
    }


}