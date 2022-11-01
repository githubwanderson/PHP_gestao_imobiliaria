<?php

require __DIR__.'/Parcela.php';

class Repasse extends Parcela{

    /**
     * Tipo de parcela conforme especificado no banco de dados na tabela 'contrato_parcela_tipo'
     * valor 2 = repasse
     * @var int
     */
    private $BD_PARCELA_TIPO = 2;  

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param integer $idContrato , $idMensalidade
     * 
     */
    public function __construct( $idContrato , $idMensalidade )
    {
        parent::__construct($idContrato , $idMensalidade);
    }

    /**
     * *********** GETTERS AND SETTERS ***********
     */


    
    /**
     * Metodo responsavel por alterar o status de uma mensalidade
     */
    




    





}