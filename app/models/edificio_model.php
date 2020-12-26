<?php

require_once "core/Model.php";

class EdificioModel extends Model
{
	public $nombre;
	public $direccion;

	self::$types_array = array(
		'nombre' => "VARCHAR( 150 ) NOT NULL",
		'direccion' => "TEXT NOT NULL"
 		);

}