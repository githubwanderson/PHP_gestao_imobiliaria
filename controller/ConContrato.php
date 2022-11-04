<?php

require_once __DIR__.'/../app/database/Database.php';

class ConContrato{

    /**
     * nome do arquivo que sera incluido
     */
    public static $include = 'mainContrato';

    /**
     * Nome do titulo Apresentação
     */
    public static $titulo = 'Contrato';

    /**
     * Nome do titulo da modal
     */
    public static $tituloModal = 'Dados do novo contrato';

    /**
     * Nome do arquivo JS 
     */
    public static $js = 'asset/js/contrato.js';    
    
    /**
     * Formulario com os campos de Locatario
     * DURACAO_MES = 12 default
     * @var string
     */
    public static $form = "<div class='form-group'>
                                <label>Locatário ( Cliente ) </label>
                                <select id='ID_CLIENTE' name='ID_CLIENTE' class='form-control'></select>
                            </div>

                            <div class='form-group'>
                                <label>Locador ( Proprietário ) | Endereço Imóvel </label>
                                <select id='ID_IMOVEL' name='ID_IMOVEL' class='form-control'></select>
                            </div>

                            <div class='form-group'>
                                <label>Duração contrato ( mês )</label>
                                <input type='number' class='form-control' name='DURACAO_MES' readonly  min='12' value=12>
                            </div>

                            <div class='form-group'>
                                <label>Data de inicio</label>
                                <input type='date' class='form-control' name='DT_INICIO' required>
                            </div>

                            <div class='form-group'>
                                <label>Valor aluguel ( R$ )</label>
                                <input type='number' class='form-control' name='VALOR_ALUGUEL' min='0.00' required>
                            </div>

                            <div class='form-group'>
                                <label>Valor condomínio ( R$ )</label>
                                <input type='number' class='form-control' name='VALOR_CONDOMINIO' min='0.00' required>
                            </div>

                            <div class='form-group'>
                                <label>Valor IPTU ( R$ )</label>
                                <input type='number' class='form-control' name='VALOR_IPTU' min='0.00' required>
                            </div>

                            <div class='form-group'>
                                <label>Valor taxa de administração ( % )</label>
                                <input id='VALOR_TX_ADM' type='number' class='form-control' disabled></div>";

    /**
     * *********** GETTERS AND SETTERS ***********
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
     * Metodo responsavel por gerar o head da tabela
     */
    public function getHeadTabela(){

        return '
            <tr>
                <th>ID</th> 	
                <th>CLIENTE</th> 	
                <th>IMOVEL</th> 	
                <th>DATA INICIO</th> 
                <th>DATA FIM</th> 
                <th>MENSALIDADE</th> 
                <th>REPASSE</th> 
                <th>EDITAR</th> 
            </tr>
            ';
    }



}