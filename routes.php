<?php

require_once 'core/Router.php';



function __autoload($nombreClase) {
	if(preg_match("/([\S]*)Controller/", $nombreClase, $matches)){
		$archivo = "app/controllers/".strtolower($matches[1]).'_controller.php';
		if(file_exists($archivo)) {
			echo "fino";
        	require_once($archivo);
    	} else {
       		 die("El archivo $archivo no se ha podido encontrar.");
    	}
	}
}
/**
 * 
 */
$main_router = new Router()