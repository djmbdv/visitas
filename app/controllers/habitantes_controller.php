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

	public function post(){
		$u = new HabitanteModel();
		if(isset($_POST["id"]))$u->ID = $_POST["id"]; 
		if(isset($_POST["nombre"]))$u->nombre = $_POST["nombre"]; 
		if(isset($_POST["identificacion"]))$u->identificacion = $_POST["identificacion"]; 
		if(isset($_POST["telefono"]))$u->telefono = $_POST["telefono"]; 
		if(isset($_POST["email"]))$u->email = $_POST["email"]; 
		if(isset($_POST["foto"]) )$u->foto = $_POST["foto"]; 
		
		if(isset($_POST["apartamento"])){
			$a  = new ApartamentoModel();
			$a->ID = $_POST["apartamento"];
			$u->apartamento = $a;
		}
		$u->save();
		return $this->get();
	}

}