<?php

class ConLocador{

    /**
     * nome do arquivo que sera incluido
     */
    public static $include = 'main';

    /**
     * Nome do titulo Apresentação
     */
    public static $titulo = 'Locador';

    /**
     * Nome do arquivo JS 
     */
    public static $js = 'asset/js/locador.js'; 

    /**
     * Formulario com os campos de Locatario
     */
    public static $form = '<div class="form-group" style="display:none">
                                <label>ID</label>
                                <input type="text" class="form-control" name="ID">
                            </div>
                            
                            <div class="form-group">
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
                            </div>
                            
                            <div class="form-group">
                                <label>Dia do repasse</label>
                                <input type="number" class="form-control" name="DIA_REPASSE">
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
                <th>NOME</th> 	
                <th>EMAIL</th> 
                <th>TELEFONE</th> 
                <th>DIA REPASSE</th> 
                <th>EDITAR</th> 
            </tr>
            ';
    }



}