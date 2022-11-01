<?php

// var_dump($controller); exit; 
// print_r($page); echo "</pre>"; exit; 

include_once './app/services/Mensalidade.php';
include_once './app/entities/Contrato.php';

$arr = [
    'ID_CLIENTE' => '22',
    'ID_IMOVEL' => '1',
    'DURACAO_MES' => '12',
    'DT_INICIO' => '2022-02-21',
    'VALOR_ALUGUEL' => '2000',
    'VALOR_CONDOMINIO' => '800',
    'VALOR_IPTU' => '200'
];

$ob = new Contrato( $arr );

$ob->Cadastrar();

// ;

print_r($ob ); echo "</pre>"; exit; 

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
 