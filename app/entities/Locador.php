<?php

include './app/entities/Cliente.php';

class Locador extends Cliente{

    /**
     * Dia para repasse do aluguel
     * @var integer 1-31
     */
    private $diaRepasse;

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param string $nome $email $telefone
     * @param integer $diaRepasse
     * 
     */
    public function __construct($nome , $email , $telefone , $diaRepasse)
    {
        parent::__construct($nome , $email , $telefone);

        $this->setDiaRepasse( $diaRepasse );
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
    public function setDiaRepasse( $diaRepasse ){

        if($diaRepasse >= 1 && $diaRepasse <= 31){
            $this->diaRepasse = $diaRepasse;
            return true;
        }
        else
        {
            return false;
            // die('Data deve estar entre 01 e 31');
        }
        
    }

    public function getDiaRepasse(){
        return $this->diaRepasse;
    }

}