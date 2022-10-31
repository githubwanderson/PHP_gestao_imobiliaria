<?php

// include_once './app/entities/Locatario.php';
include_once './app/entities/Contrato.php';
include_once './app/services/Mensalidade.php';

$ob = new Contrato(21,12,'2022-02-10', 12 , 10 , 1800.00 , 150.00 , 100.00 );

$ob2 = new Mensalidade($ob);

// $ob->setDataInicio('2022-02-15');

echo "<pre>"; print_r($ob); 
print_r($ob2->gerarMensalidade()); echo "</pre>"; exit; 
 