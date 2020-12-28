<?php



require_once "core/Controller.php";
require_once "core/Session.php";


/**
 * 
 */
class VisitasController extends ControllerRest
{
	function get(){
		Session::load();
		VisitaModel::create_table();
		$user = UserModel::user_logged();
		if(is_null($user)){
			header('location: /login/');
			return;
		}
		$headers  = VisitaModel::get_vars();
		$headers[] = "fecha";
		$user = UserModel::user_logged();
		$page = $this->get_param("page");
		$fecha = $this->get_param("fecha");
		$hora = $this->get_param("hora");
		$visitado = $this->get_param("visitado");
		$destino = $this->get_param("destino");
		$page = $page?$page:1;
		$vv = new VisitasView(array(
			'visitas' => VisitaModel::all(20,$page),
			'user'=> $user,
			"table_headers" => $headers,
			'page'=> $page,
			'count'=>VisitaModel::count()
		));
	//	var_dump($page);
		return $vv->render();
	}
}