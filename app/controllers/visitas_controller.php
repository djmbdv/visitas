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
		VisitaModel::create_table();
		$user = UserModel::user_logged();
		if(is_null($user)){
			header('location: /login');
			return;
		}
		$headers  = VisitaModel::get_vars();
		$headers[] = "fecha";
		$user = UserModel::user_logged();
		//print_r(VisitaModel::all());
		$vv = new VisitasView(array('visitas' => VisitaModel::all(), 'user'=> $user, "table_headers" => $headers ));
		return $vv->render();
	}
}