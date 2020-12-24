<?php



require_once "core/Controller.php";



/**
 * 
 */
class LoginController extends Controller
{

	function index(){
		$hola = new LoginView(array(["var" => 1,]));
		return $hola->render();
	}
}