<?php





require_once "core/Controller.php";
require_once "core/Session.php";

class UsersController extends ControllerRest
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
		$hv = new UsersView( array(
			'items' => UserModel::all(20,$page),
			'user'=> $user,
			"table_vars" => UserModel::get_vars(),
			"modal_vars" => UserModel::get_vars(),
			"modal_class" => 'UserModel',
			'page'=> $page,
			'count'=>UserModel::count(),
			'title'=>'Usuarios'
		));
		return $hv->render();
	}
	public function post(){
		$u = new UserModel();
		if(isset($_POST["id"]))$u->ID = $_POST["id"]; 
		if(isset($_POST["name"]))$u->name = $_POST["name"]; 
		if(isset($_POST["username"]))$u->username = $_POST["username"]; 
		if(isset($_POST["password"]))$u->password = $_POST["password"]; 
		if(isset($_POST["email"]))$u->email = $_POST["email"]; 
		if(isset($_POST["tipo"])){
			$t  = new TipoModel();
			$t->ID = $_POST["tipo"];
			$u->tipo = $t;
		}
		$u->save();
		return $this->get();

	}
}