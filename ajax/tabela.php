<?php

/**
 * Recebe o nome da class e retira do POST
 */
require_once __DIR__.'/../app/database/Database.php'; 

/**
 * Instancia um novo obj e cadastra dados no banco
 * @return integer Id cadastrado
 */
$db     = new Database($_POST['dados'][0]);
$lista  = $db->select( $_POST['dados'][1] , $_POST['dados'][2] , $_POST['dados'][3] , $_POST['dados'][4] , $_POST['dados'][5] )->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($lista);
