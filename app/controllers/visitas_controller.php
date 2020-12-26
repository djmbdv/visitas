<?php



require_once "core/Controller.php";
require_once "core/Session.php";


/**
 * 
 */
class VisitasController extends ControllerRest
{

	function get($argument = null){
		Session::load();
		$user = UserModel::user_logged();
		if(is_null($user)){
			header('location: /login');
			return;
		}
		/*$rv = new RegistroView(array('user' => $user ));
		return $rv->render();*/
		var_dump(UserModel::all());
		echo "VisitasController";
	}
}