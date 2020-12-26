<?php

require_once "core/Model.php";

class ApartamentoModel extends Model
{


	public $nombre;
	public $edificio;
	public $propietario;
	
	self::$types_array = array(
		'nombre' => "VARCHAR( 150 ) NOT NULL",
		'propietario' => "INT( 11 ) NOT NULL",
		'edificio' = 'INT( 11 ) NOT NULL'
 	);

}