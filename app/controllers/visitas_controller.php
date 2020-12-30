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
		if(Session::g('control_visitas')){
			header('location: /');
			return;
		}
		$headers  = VisitaModel::get_vars();
		$headers[] = "fecha";
		$user = UserModel::user_logged();
		$page = $this->get_param("page");
		$fecha = $this->get_param("fecha");
		$hora = $this->get_param("hora");
		$nombre =  $this->get_param("nombre");
		$destino = $this->get_param("destino");
		$page = $page?$page:1;
		$vv = new VisitasView(array(
			'items' => VisitaModel::all(20,$page),
			'filtros'=> ['fecha' => $fecha ,'hora' => $fecha ,'nombre' => $nombre],
			'user'=> $user,
			"table_vars" => VisitaModel::get_vars(),
			'page'=> $page,
			'count'=>VisitaModel::count()
		));
	//	var_dump($page);
		return $vv->render();
	}
}