<?php

// var_dump($controller); exit; 
// print_r($page); echo "</pre>"; exit; 

// include_once './controller/ConContrato.php';
// include_once './app/entities/Contrato.php';

// $arr = [
//     'ID_CLIENTE' => '2',
//     'ID_IMOVEL' => '1',
//     'DURACAO_MES' => '12',
//     'DT_INICIO' => '2022-11-01',
//     'VALOR_ALUGUEL' => '1900',
//     'VALOR_CONDOMINIO' => '150',
//     'VALOR_IPTU' => '100'
// ];

// $ob = new Contrato( $arr );

// ;

// print_r($ob->Cadastrar() ); echo "</pre>"; exit; 

/**
 * Nome da view default / home page
 */
$PAGE = 'home';

/**
 * Nome da entidade que o usuario estiver trabalhando
 */
$TITULO_APRESENTACAO = 'Bem vindo';

/**
 * identificar a pagina
 * pegar Get e verificar se tem arquivo
 * -- se sim: pegar dados
 * -- se nao: ir para home page
 */
if(isset($_GET['p']))
{
    include_once './controller/Routes.php';

    $dataPage = (new Routes())->getController($_GET['p']);

    if($dataPage)
    {
        $PAGE = $dataPage->getInclude(); 
        $TITULO_APRESENTACAO = $dataPage->getTitulo();
    }
}

/**
 * Carregar view
 */
include __DIR__.'/views/layout/header.php';
include __DIR__.'\/views/'.$PAGE.'.php';
include __DIR__.'/views/layout/footer.php';
 