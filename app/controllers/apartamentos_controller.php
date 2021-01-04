<?php





require_once "core/Controller.php";
require_once "core/Session.php";


/**
 * 
 */
class ApartamentosController extends ControllerRest
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
//		var_dump(EdificioModel::all());
		$hv = new ApartamentosView( array(
			'items' => ApartamentoModel::all(20,$page),
			'user'=> $user,
			"table_vars" => ApartamentoModel::get_vars(),
			"modal_vars" => ApartamentoModel::get_vars(),
			"modal_class" => 'ApartamentoModel',
			'page'=> $page,
			'count'=> ApartamentoModel::count(),
			'title'=>'Apartamentos'
		));
		return $hv->render();
	}


	public function delete(){
		$key = $this->get_param('key');
		
		$respose = new stdClass;
		if(ApartamentoModel::remove($key))
		$respose->ok = true;
		else $respose->errorMsj = "Error al eliminar";
		header("Content-type:application/json");
		print_r(json_encode($respose));
	}

	public function put(){
		$u = new ApartamentoModel();
		if(isset($this->_PUT["key"]))$u->ID = $this->_PUT["key"]; 
		if(isset($this->_PUT["nombre"]))$u->nombre = $this->_PUT["nombre"]; 
		
		if(isset($this->_PUT["edificio"])){
			$a  = new EdificioModel();
			$a->ID = $this->_PUT["edificio"];
			$u->edificio = $a;
		}
		if(isset($this->_PUT["propietario"])){
			$a  = new HabitanteModel();
			$a->ID = $this->_PUT["propietario"];
			$u->propietario = $a;
		}
		$respose = new stdClass;
		if($u->save())
		
		$respose->ok = true;
		else $respose->errorMsj = "Error al ingresar";
		header("Content-type:application/json");
		print_r(json_encode($respose));
	}
	public function post(){
		$u = new ApartamentoModel();
		if(isset($this->_POST["nombre"]))$u->nombre = $this->_POST["nombre"]; 
		
		if(isset($this->_POST["edificio"])){
			$a  = new EdificioModel();
			$a->ID = $this->_POST["edificio"];
			$u->edificio = $a;
		}
		if(isset($this->_POST["propietario"])){
			$a  = new HabitanteModel();
			$a->ID = $this->_POST["propietario"];
			$u->propietario = $a;
		}
		$respose = new stdClass;
		if($u->save())
		
		$respose->ok = true;
		else $respose->errorMsj = "Error al ingresar";
		header("Content-type:application/json");
		print_r(json_encode($respose));
	}

}