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

abstract class ControllerRest extends Controller{
	public function main_method($method = "index",$argument =  null){
		if($method == "index")
	 		switch($_SERVER['REQUEST_METHOD']){
				case 'GET': 
					$this->get($argument);
				break;
				case 'POST': 
					$this->post($argument);
				break;
				case 'PUT':
					$this->put($argument);
				break;
				case 'DELETE':
					$this->delete($argument);
				default:
					break;
		}else if(method_exists($this,$method)){
			return $this->{$method}($argument);
		}else {
			$this->error();
		}
	}
	public function post(){
		print_r("default post");
	}

	public function put(){
		print_r("default put");
	}
	public function get(){
		print_r("default get");
	}
	public function delete(){
		print_r("default delete");
	}
}