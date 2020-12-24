<?php

require_once 'core/Router.php';



function autoload_controller($nombreClase) {
	if(preg_match("/([\S]*)Controller/", $nombreClase, $matches)){
		$archivo = "app/controllers/".strtolower($matches[1]).'_controller.php';
		if(file_exists($archivo)) {
        	require_once($archivo);
    	} else {
       		 die("El archivo $archivo no se ha podido encontrar.");
    	}
	}
}

spl_autoload_register('autoload_controller');
/**
 * 
 */

$main_router = new Router($_GET['g']);
$main_router->link("", new HomeController());
$main_router->call();
