<?php





require_once "core/Controller.php";
require_once "core/Session.php";


/**
 * 
 */
class HabitantesController extends ControllerRest
{

	public function get()
	{
		$user = UserModel::user_logged();
		$page = $this->get_param("page");
		$page = $page?$page:1;	

		$hv = new HabitantesView( array(
			'items' => HabitanteModel::all(20,$page),
			'user'=> $user,
			"table_vars" => HabitanteModel::get_vars(),
			"modal_vars" => HabitanteModel::get_vars(),
			"modal_class" => 'HabitanteModel',
			'page'=> $page,
			'count'=>HabitanteModel::count(),
			'title'=>'Habitantes'
		));
		return $hv->render();
	}
	public function search(){
		header("Content-type:application/json");
		$nombre = $this->get_param("nombre");
		//var_dump($nombre);
		print_r(HabitanteModel::search_nombre($nombre));
	}
}