<?php



require_once "core/Controller.php";
require_once "core/Session.php";


/**
 * 
 */
class RegistroController extends Controller
{

	function index(){
		Session::load();
		$user = UserModel::user_logged();
		if(is_null($user)){
			header('location: /login/');
			return;
		}
		
		$rv = new RegistroView(array('user' => $user ));
		return $rv->render();
	}
}