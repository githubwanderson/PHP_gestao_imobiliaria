<?php

include './app/entities/Cliente.php';

class Locatario extends Cliente{

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param string $nome $email $telefone
     * 
     */
    public function __construct($nome , $email , $telefone)
    {
        parent::__construct($nome , $email , $telefone);
    }

}