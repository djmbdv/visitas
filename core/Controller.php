<?php 





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
		print_r("Controller error: Método no encontrado");
		exit(1);
	}

}

/**
 * 
 */
abstract class ControllerRest extends Controller
{
	public function main_method($method = "index",$argument =  null){
 
	}
	
}