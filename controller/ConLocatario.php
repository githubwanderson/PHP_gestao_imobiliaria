<?php

class ConLocatario{

    /**
     * nome do arquivo que sera incluido
     */
    public static $include = 'main';

    /**
     * Nome do titulo Apresentação
     */
    public static $titulo = 'Locatário';

    /**
     * Nome do titulo da modal
     */
    public static $tituloModal = 'Dados do novo Locatário';

    /**
     * Nome do arquivo JS 
     */
    public static $js = 'asset/js/locatario.js';    

    /**
     * Formulario com os campos de Locatario
     */
    public static $form = '<div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="NOME">
                            </div>

                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" class="form-control" name="EMAIL">
                            </div>

                            <div class="form-group">
                                <label>Telefone</label>
                                <input type="number" class="form-control" name="TELEFONE">
                            </div>';


    /**
     * *********** GETTERS ***********
     */

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