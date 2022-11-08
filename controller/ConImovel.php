<?php

class Conimovel{

    /**
     * nome do arquivo que sera incluido
     */
    public static $include = 'main';

    /**
     * Nome do titulo Apresentação
     */
    public static $titulo = 'Imóvel';

    /**
     * Nome do arquivo JS 
     */
    public static $js = 'asset/js/imovel.js'; 

    /**
     * Formulario com os campos de Locatario
     */
    public static $form = '<div class="form-group" style="display:none">
                                <label>ID</label>
                                <input type="text" class="form-control" name="ID">
                            </div>

                            <div class="form-group">
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

    public function getInclude(){
        return self::$include;
    }

    public function getTitulo(){
        return self::$titulo;
    }

    public function getForm(){
        return self::$form;
    }

    public function getJs(){
        return self::$js;
    }

    /**
     * Metodo responsavel por gerar o head da tabela
     */
    public function getHeadTabela(){

        return '
            <tr>
                <th>ID</th> 
                <th>LOCADOR</th> 
                <th>ENDEREÇO</th> 
                <th>EDITAR</th>
            </tr>
            ';
    }



}