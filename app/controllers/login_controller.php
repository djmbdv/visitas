<?php



require_once "core/Controller.php";


/**
 * 
 */
class LoginController extends ControllerRest
{

	function get(){
		$lv = new LoginView(array(["var" => 1,]));
		return $lv->render();
	}
	function post(){
		$user = $_POST['username'];
		$password = $_POST['password'];
		if(UserModel::login($user,$password))
		$lv = new RegistroView();
		else
		$lv = new LoginView(array("error" => 1,));
		return $lv->render();
	}

	function logout(){
		Session::destroy();
	}
}