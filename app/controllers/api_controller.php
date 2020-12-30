<?php
require_once "core/Controller.php";



class ApiController extends Controller{

	public function search_habitantes(){
		header("Content-type:application/json");
		$nombre = $_POST["s"];
		//var_dump($nombre);
		print_r(HabitanteModel::search_nombre($nombre,12));
	}
	public function search_users(){
		header("Content-type:application/json");
		$nombre = $_POST["s"];
		//var_dump($nombre);
		print_r(UserModel::search_nombre($nombre,12));
	}
	public function search_tipos(){
		header("Content-type:application/json");
		$nombre = $_POST["s"];
		//var_dump($nombre);
		print_r(TipoModel::search_descripcion($nombre,12));
	}
	public function search_apartamentos(){
		header("Content-type:application/json");
		$nombre = $_POST["s"];
		//var_dump($nombre);
		print_r(ApartamentoModel::search_nombre($nombre,12));
	}
	public function search_edificios(){
		header("Content-type:application/json");
		$nombre = $_POST["s"];
		//var_dump($nombre);
		print_r(EdificioModel::search_nombre($nombre,12));
	}

}