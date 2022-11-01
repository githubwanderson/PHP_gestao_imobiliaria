<?php

/**
 * class responsalvel por carregar um controller
 */

class Routes{

    /**
     * Metodo responsavel por verificar se controller existe
     */
    public static function getController($dir){

        $r = [];

        $file = __DIR__.'/'.$dir.'.php';

        if(file_exists($file)){

            include_once './controller/'.$dir.'.php';

            return new $dir();

        }
        else
        {
            return false;
        }


    }

}