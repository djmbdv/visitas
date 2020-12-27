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
		print_r("no implemented");
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
	public function post($argument = null){
		$this->any($argument);
	}

	public function put($argument = null){
		$this->any($argument);
	}
	public function get($argument = null){
		$this->any($argument);
	}
	public function delete($argument = null){
		$this->any($argument);
	}

	public function any(){
		print_r("no implemented");
	}

}