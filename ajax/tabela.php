<?php

require_once __DIR__.'/../app/database/Database.php'; 

/**
 * @param array [ 0=tabela , 1=where , 2=join , 3=order , 4=limit , 5=fields ]
 * @return [{}]
 */
$db     = new Database($_POST['dados'][0]);
$lista  = $db->select( $_POST['dados'][1] , $_POST['dados'][2] , $_POST['dados'][3] , $_POST['dados'][4] , $_POST['dados'][5] )->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($lista);
