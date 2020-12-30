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

	public function post(){
		$u = new ApartamentoModel();
		if(isset($_POST["id"]))$u->ID = $_POST["id"]; 
		if(isset($_POST["nombre"]))$u->nombre = $_POST["nombre"]; 
		
		if(isset($_POST["edificio"])){
			$a  = new EdificioModel();
			$a->ID = $_POST["edificio"];
			$u->edificio = $a;
		}
		if(isset($_POST["propietario"])){
			$a  = new HabitanteModel();
			$a->ID = $_POST["propietario"];
			$u->propietario = $a;
		}
		$u->save();
		return $this->get();
	}

}