<?php





require_once "core/Controller.php";
require_once "core/Session.php";


/**
 * 
 */
class EdificiosController extends ControllerRest
{

	public function get()
	{

		$user = UserModel::user_logged();
		if(is_null($user)){
			header('location: /login/');
			return;
		}
		if(Session::g('control_visitas')){
			header('location: /');
			return;
		}
		$page = $this->get_param("page");
		$page = $page?$page:1;	

		$hv = new EdificiosView( array(
			'items' => EdificioModel::all(20,$page),
			'user'=> $user,
			"table_vars" => EdificioModel::get_vars(),
			"modal_vars" => EdificioModel::get_vars(),
			"modal_class" => 'EdificioModel',
			'page'=> $page,
			'count'=> EdificioModel::count(),
			'title'=>'Edificios'
		));
		return $hv->render();
	}
	public function post(){
		$u = new EdificioModel();
		if(isset($this->_POST["nombre"]))$u->nombre = $this->_POST["nombre"]; 
		if(isset($this->_POST["direccion"]))$u->direccion = $this->_POST["direccion"];
		$respose = new stdClass;
		if($u->save())
		
		$respose->ok = true;
		else $respose->errorMsj = "Error al crear";
		header("Content-type:application/json");
		print_r(json_encode($respose)); 
	}

	public function put(){
		$u = new EdificioModel();
		if(isset($this->_PUT["key"]))$u->ID = $this->_PUT["key"]; 
		if(isset($this->_PUT["nombre"]))$u->nombre = $this->_PUT["nombre"]; 
		if(isset($this->_PUT["direccion"]))$u->direccion = $this->_PUT["direccion"];
		$respose = new stdClass;
		if($u->save())
		
		$respose->ok = true;
		else $respose->errorMsj = "Error al crear";
		header("Content-type:application/json");
		print_r(json_encode($respose)); 
	}
	public function delete(){
		$key = $this->get_param('key');
		
		$respose = new stdClass;
		if(EdificioModel::remove($key))
		$respose->ok = true;
		else $respose->errorMsj = "Error al eliminar";
		header("Content-type:application/json");
		print_r(json_encode($respose));
	}

}