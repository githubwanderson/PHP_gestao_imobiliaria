<?php

/**
 * Recebe o nome da class e retira do POST
 */
$class = explode("/" , $_POST['CL']); unset($_POST['CL']);

require_once __DIR__.'/../app/'.$class[0].'/'.$class[1].'.php'; 

/**
 * Instancia um novo obj e cadastra dados no banco
 * @return boolean Id cadastrado
 */
$obj    = new $class[1]();
$obj->setDados($_POST);
$result = $obj->update();

echo json_encode($result );
