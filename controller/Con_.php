<?php

abstract class Con_{

    /**
     * nome do arquivo que sera incluido
     */
    protected $include;

    /**
     * Nome do titulo Apresentação
     */
    public static $titulo = 'Imóveis';

    /**
     * Nome do titulo da modal
     */
    public static $tituloModal = 'Dados do novo imóvel';

    /**
     * Nome do arquivo JS 
     */
    public static $js = 'asset/js/imovel.js'; 

    /**
     * Formulario com os campos de Locatario
     */
    public static $form = '<div class="form-group">
                                <label>Locador ( Proprietário ) </label>
                                <select id="ID_CLIENTE" name="ID_CLIENTE" class="form-control"></select>
                            </div>

                            <div class="form-group">
                                <label>Endereço</label>
                                <input type="text" class="form-control" name="ENDERECO">
                            </div>';

    /**
     * *********** GETTERS AND SETTERS ***********
     */

    abstract function setInclude( $var );

    public function getInclude(){
        return self::$include;
    }

    public function getTitulo(){
        return self::$titulo;
    }

    public function getTituloModal(){
        return self::$tituloModal;
    }

    public function getForm(){
        return self::$form;
    }

    public function getJs(){
        return self::$js;
    }

    /**
     * Metodo responsavel por gerar a tabela
     */



}