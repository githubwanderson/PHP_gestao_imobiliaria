<?php

class Taxa{

    /**
     * Valor da taxa cobrada sobre o valor do aluguel
     * @var float
     */
    private static $valorTaxa; 
    
    /**
     * *********** GETTERS AND SETTERS ***********
     */

    public function setValorTaxa( $valorTaxa ){
        $this->valorTaxa = $valorTaxa;
    }

    public function getValorTaxa(){
        return $this->valorTaxa;
    }

}