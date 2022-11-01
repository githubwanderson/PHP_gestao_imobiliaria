<?php

/**
 * Recebe o nome da class e retira do POST
 */
$class  = $_POST['dados'][0]; 
$folder = $_POST['dados'][1];
$metod  = $_POST['dados'][2];

require_once __DIR__.'/../app/'.$folder.'/'.$class.'.php'; 

/**
 * Instancia um novo obj e cadastra dados no banco
 * @return integer Id cadastrado
 */
$obj    = ( new $class() )->$metod();

echo json_encode($obj);
