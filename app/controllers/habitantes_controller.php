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
		$h = new HabitanteModel();
		$array =array("juan" ,"peres", "maria", "espejo","fabian", "rosa", "david" );
		$h->apartamento = random_int(1000, 2000);
		$h->telefono = random_int(1000, 2000);
		$h->email = $array[random_int(0,6)].random_int(1000, 2000).'@gmail.com';
		$h->nombre = $array[random_int(0,6)]." ".$array[random_int(0,6)];
		$h->save();
		$hv = new HabitantesView( array(
			'items' => HabitanteModel::all(20,$page),
			'user'=> $user,
			"table_vars" => HabitanteModel::get_vars(),
			'page'=> $page,
			'count'=>HabitanteModel::count(),
			'title'=>'Habitantes'
		));
		return $hv->render();
	}
}