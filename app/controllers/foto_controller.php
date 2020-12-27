<?php



require_once "core/Controller.php";


/**
 * 
 */
class FotoController extends ControllerRest
{

	public function post($argument= null){
		$vista = new FotoView(array( )); 
		return $vista->render();
	}

	public function any($argument = null){
		header('location: /');
	}

}