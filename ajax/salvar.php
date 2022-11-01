<?php

/**
 * Recebe o nome da class e retira do POST
 */
$class = $_POST['CL']; unset($_POST['CL']);

require_once __DIR__.'/../app/entities/'.$class.'.php'; 

/**
 * Instancia um novo obj e cadastra dados no banco
 * @return integer Id cadastrado
 */
$obj    = new $class();
$obj->setDados($_POST);
$id     = $obj->cadastrar();

echo json_encode($id);
