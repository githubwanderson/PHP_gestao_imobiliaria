<?php

/**
 * Recebe o nome da class e retira do POST
 */
require_once __DIR__.'/../app/database/Database.php'; 

/**
 * Instancia um novo obj e cadastra dados no banco
 * @return integer Id cadastrado
 */
$obj    = new Database($_POST['dados'][0]);
$lista  = $obj->select( $_POST['dados'][2] , $_POST['dados'][1] )->fetchAll(PDO::FETCH_ASSOC);
// $lista  = $obj->select( $_POST['dados'][1] , $_POST['dados'][2] );

echo json_encode($lista);
