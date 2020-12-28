<?php

require_once "core/Model.php";

/**
 * 
 */
class HabitanteModel extends Model
{
	
	protected $apartamento;
	protected $email;
	protected $telefono;
	protected $nombre;
	protected $foto;
	protected $identificacion;
	public static function types_array(){
		return array(
		'nombre' => "VARCHAR( 150 ) NOT NULL",
		'apartamento' => "INT( 11 ) NOT NULL",
		'foto' => 'varchar( 100 )  NULL',	
 		);
	}
	public static function descriptions_array(){
		return array(
		'nombre' => "Nombre Completo",
		'apartamento' => "X"	
 		);
	}
	public static function search_nombre($nombre){
		$a = self::all_where_like("nombre",$nombre,20,null,true);
		$k = array_map(function($a){return $a->no_class_values(); }, $a);
		return json_encode($k);
	}

	public static function seeds(){
		for ($i=0; $i < 25; $i++) { 
			$h = new HabitanteModel();
			$array =array("juan" ,"peres", "maria", "espejo","fabian", "rosa", "david" );
			$h->apartamento = random_int(1000, 2000);
			$h->telefono = random_int(1000, 2000);
			$h->email = $array[random_int(0,6)].random_int(1000, 2000).'@gmail.com';
			$h->nombre = $array[random_int(0,6)]." ".$array[random_int(0,6)];
			$h->identificacion =  random_int(1000000, 90000000);
			$h->save();
		}
	}
}