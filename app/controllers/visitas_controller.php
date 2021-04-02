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
		$page = $this->get_param("page");
		$desde = $this->get_param("desde");
		$hasta = $this->get_param("hasta");
		$apartamento =  $this->get_param("apartamento");
		$visitado = $this->get_param("visitado");
		$page = $page?$page:1;
		if(!$user->is_admin()){
			$condicion = [['cliente','=',$user->get_key()]];
         //   if($apartamento)$condicion[]=["apartamento",'=',$apartamento];
            if($visitado)$condicion[]=["visitado",'=',$visitado];
            if($desde)$condicion[]=["create_at",'>=', $desde];
            if($hasta)$condicion[]=["create_at", '<=',$hasta.=" 23:59:59"];
			$vars = array_filter(VisitaModel::get_vars(),function($a){ return $a != 'cliente';});
			$count = VisitaModel::count($condicion);
			$items = VisitaModel::all_where_and($condicion,20,$page);	
		}else{
			$condicion = [];
			if($visitado)$condicion[]=["visitado",'=',$visitado];
            if($desde)$condicion[]=["create_at",'>=', $desde];
            if($hasta)$condicion[]=["create_at", '<=',$hasta.=" 23:59:59"];
			$vars = VisitaModel::get_vars();
			$count = VisitaModel::count($condicion);
			$items = VisitaModel::all_where_and($condicion,20,$page);
		}
		$vv = new VisitasView(array(
			'items' => $items,
			'filtros'=> ['desde' => $desde ,'hasta' => $hasta ,'visitado' => $visitado,'apartamento'=>$apartamento],
			'user'=> $user,
			"table_vars" => $vars,
			'page'=> $page,
			'count'=>$count,
            'hide_modified' => true,
            'hide_actions' => true
		));
		return $vv->render();
	}
}