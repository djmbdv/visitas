<?php 

function autoload_view($nombreClase) {
	if(preg_match("/([\S]*)View/", $nombreClase, $matches)){
		$archivo = "app/views/".strtolower($matches[1]).'_view.php';
		if(file_exists($archivo)) {
        	require_once($archivo);
    	} else {
       		 die("El archivo $archivo no se ha podido encontrar.");
    	}
	}
}



spl_autoload_register('autoload_view');



abstract class Controller 
{

	public function main_method($method = "index",$argument =  null){
		if(method_exists($this,$method)){
			return $this->{$method}($argument);
		}else {
			$this->error();
		}
		
	}

	public function error(){
		print_r("Controller error: Método no encontredo");
		exit(1);
	}

}

/**
 * 
 */
abstract class ControllerRest extends Controller
{
	public function main_method(){

	}
	
}