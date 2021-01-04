<?php





require_once "core/Controller.php";
require_once "core/Session.php";


/**
 * 
 */
class HabitantesController extends ControllerRest
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

		$hv = new HabitantesView( array(
			'items' => HabitanteModel::all(20,$page),
			'user'=> $user,
			"table_vars" => HabitanteModel::get_vars(),
			"modal_vars" => HabitanteModel::get_vars(),
			"modal_class" => 'HabitanteModel',
			'page'=> $page,
			'count'=>HabitanteModel::count(),
			'title'=>'Habitantes'
		));
		return $hv->render();
	}

	public function delete(){
		$key = $this->get_param('key');
		
		$respose = new stdClass;
		if(HabitanteModel::remove($key))
		$respose->ok = true;
		else $respose->errorMsj = "Error al eliminar";
		header("Content-type:application/json");
		print_r(json_encode($respose));
	}

	public function put(){
		$u = new HabitanteModel();
		if(isset($this->_PUT["key"]))$u->ID = $this->_PUT["key"]; 
		if(isset($this->_PUT["nombre"]))$u->nombre = $this->_PUT["nombre"]; 
		if(isset($this->_PUT["identificacion"]))$u->identificacion = $this->_PUT["identificacion"]; 
		if(isset($this->_PUT["telefono"]))$u->telefono = $this->_PUT["telefono"]; 
		if(isset($this->_PUT["email"]))$u->email = $this->_PUT["email"]; 
		if(isset($this->_PUT["foto"]) )$u->foto = $this->_PUT["foto"]; 
		
		if(isset($this->_PUT["apartamento"])){
			$a  = new ApartamentoModel();
			$a->ID = $this->_PUT["apartamento"];
			$u->apartamento = $a;
		}
	//	print_r($u);
	//	print_r($this->_PUT["key"]);
		$respose = new stdClass;
		if($u->save())
		
		$respose->ok = true;
		else $respose->errorMsj = "Error al actualizar";
		header("Content-type:application/json");
		print_r(json_encode($respose));
		//return $this->get();
	}

	public function post(){
		$u = new HabitanteModel();
		if(isset($this->_POST["nombre"]))$u->nombre = $this->_POST["nombre"]; 
		if(isset($this->_POST["identificacion"]))$u->identificacion = $this->_POST["identificacion"]; 
		if(isset($this->_POST["telefono"]))$u->telefono = $this->_POST["telefono"]; 
		if(isset($this->_POST["email"]))$u->email = $this->_POST["email"]; 
		if(isset($this->_POST["foto"]) )$u->foto = $this->_POST["foto"]; 
		
		if(isset($this->_POST["apartamento"])){
			$a  = new ApartamentoModel();
			$a->ID = $this->_POST["apartamento"];
			$u->apartamento = $a;
		}
		$respose = new stdClass;
		if($u->save())
		
		$respose->ok = true;
		else $respose->errorMsj = "Error al crear";
		header("Content-type:application/json");
		print_r(json_encode($respose));
	}

}