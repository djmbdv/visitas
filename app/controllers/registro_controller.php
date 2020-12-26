<?php



require_once "core/Controller.php";



/**
 * 
 */
class RegistroController extends Controller
{

	function index(){
		$hola = new MainView();
		return $hola->render();
	}
}