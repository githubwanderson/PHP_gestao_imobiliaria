<?php

/**
 * Recebe o nome da class e retira do POST
 */
$class = $_POST['dados'][0]; 
$metod = $_POST['dados'][1];

require_once __DIR__.'/../app/entities/'.$class.'.php'; 

/**
 * Instancia um novo obj e cadastra dados no banco
 * @return integer Id cadastrado
 */
$obj    = ( new $class() )->$metod();

echo json_encode($obj);
