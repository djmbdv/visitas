<?php

require_once "core/Model.php";

class ApartamentoModel extends Model
{


	protected $nombre;
	protected EdificioModel $edificio;
	protected HabitanteModel $propietario;
	
	public static function types_array(){
		return array(
			'nombre' => "VARCHAR( 150 ) NOT NULL",
			'propietario' => "INT( 11 )",
			'edificio' => 'VARCHAR( 11 ) NOT NULL'
	 	);	
		
	}
	public static function seeds(){
		$propietarios = HabitanteModel::all();
		for($i = 0; $i < 25; $i++){
			//echo "seedd";
			$a =  new ApartamentoModel();
			$a->nombre = "A - ".random_int(1000, 2000);
			$a->edificio = EdificioModel::all()[0]; 
		//	$a->propietario = new HabitanteModel();

		//	$a->propietario = $propietarios[0];
			//var_dump($a);
		    $a->save();
		 }
	}
	public static function search_nombre($nombre, $cantidad = 20){
		$a = self::all_where_like("nombre",$nombre,$cantidad,null,true);
		$k = array_map(function($a){return $a->no_class_values(); }, $a);
		return json_encode($k);
	}
	public static function presentation($a){
		if($a->edificio->exist())$a->edificio->load();
		return ($a->edificio->exist()?$a->edificio->nombre.' | ':'').$a->nombre;
	}

}