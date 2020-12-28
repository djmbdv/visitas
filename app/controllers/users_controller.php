<?php





require_once "core/Controller.php";
require_once "core/Session.php";

class UsersController extends ControllerRest
{

	public function get()
	{
		$user = UserModel::user_logged();
		$page = $this->get_param("page");
		$page = $page?$page:1;	
		$hv = new UsersView( array(
			'items' => UserModel::all(20,$page),
			'user'=> $user,
			"table_vars" => UserModel::get_vars(),
			"modal_vars" => UserModel::get_vars(),
			"modal_class" => 'UserModel',
			'page'=> $page,
			'count'=>UserModel::count(),
			'title'=>'Usuarios'
		));
		return $hv->render();
	}
}