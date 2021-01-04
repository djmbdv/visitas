<?php
require_once "core/Controller.php";



class ApiController extends Controller{

	public function search_habitantes(){
		header("Content-type:application/json");
		$nombre = $_POST["s"];
		print_r(HabitanteModel::search_nombre($nombre,12));
	}
	public function search_users(){
		header("Content-type:application/json");
		$nombre = $_POST["s"];
		print_r(UserModel::search_nombre($nombre,12));
	}
	public function search_tipos(){
		header("Content-type:application/json");
		$nombre = $_POST["s"];
		print_r(TipoModel::search_descripcion($nombre,12));
	}
	public function search_apartamentos(){
		header("Content-type:application/json");
		$nombre = $_POST["s"];
		print_r(ApartamentoModel::search_nombre($nombre,12));
	}
	public function search_edificios(){
		header("Content-type:application/json");
		$nombre = $_POST["s"];
		print_r(EdificioModel::search_nombre($nombre,12));
	}
	public function get_tipo(){
		header("Content-type:application/json");
		$id  = $_POST['key'];
		$h = new TipoModel();
		$h->ID = $id;
		$h->load();
		echo  $h->get_json();
	}
	public function get_edificio(){
		header("Content-type:application/json");
		$id  = $_POST['key'];
		$h = new EdificioModel();
		$h->ID = $id;
		$h->load();
		echo  $h->get_json();
	}
	public function get_user(){
		header("Content-type:application/json");
		$id  = $_POST['key'];
		$h = new UserModel();
		$h->ID = $id;
		$h->load();
		echo  $h->get_json();
	}

	public function get_habitante(){
		header("Content-type:application/json");
		$id  = $_POST['key'];
		$h = new HabitanteModel();
		$h->ID = $id;
		$h->load();
		echo  $h->get_json();
	}
	public function get_apartamento(){
		header("Content-type:application/json");
		$id  = $_POST['key'];
		$a = new ApartamentoModel();
		$a->ID = $id;
		$a->load();
	//	var_dump($a);
		echo  $a->get_json();
	}

}