<?php



require_once "core/Controller.php";



/**
 * 
 */
class RegistroController extends Controller
{

	function index(){
		$rv = new RegistroView();
		return $rv->render();
	}
}