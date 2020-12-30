<?php





require_once "core/Controller.php";
require_once "core/Session.php";


/**
 * 
 */
class EdificiosController extends ControllerRest
{

	public function get()
	{

		$user = UserModel::user_logged();
		if(is_null($user)){
			header('location: /login/');
			return;
		}
		if(Session::g('control_visitas')){
			header('location: /');
			return;
		}
		$page = $this->get_param("page");
		$page = $page?$page:1;	

		$hv = new EdificiosView( array(
			'items' => EdificioModel::all(20,$page),
			'user'=> $user,
			"table_vars" => EdificioModel::get_vars(),
			"modal_vars" => EdificioModel::get_vars(),
			"modal_class" => 'ApartamentoModel',
			'page'=> $page,
			'count'=> EdificioModel::count(),
			'title'=>'Edificios'
		));
		return $hv->render();
	}

}