<?php

require_once "core/Model.php";

class EdificioModel extends Model
{
	public $nombre;
	public $direccion;

	public static function types_array(){
		return array(
		'nombre' => "VARCHAR( 150 ) NOT NULL",
		'direccion' => "TEXT NOT NULL"
 		);
	}

	public static function seeds(){
		$e = new EdificioModel();
		$e->nombre = "Torre A";
		$e->direccion ="Primera Esquina frente la calle Ciega";
		$e->save();
	}

	public static function search_nombre($nombre, $cantidad = 20){
		$a = self::all_where_like("nombre",$nombre,$cantidad,null,true);
		$k = array_map(function($a){return $a->no_class_values(); }, $a);
		return json_encode($k);
	}
	public static function presentation($h){
		return $h->nombre;
	}

}