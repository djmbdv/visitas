<?php

require_once "core/Model.php";

/**
 * 
 */
class HabitanteModel extends Model
{
	
	public $apartamento;
	public $email;
	public $telefono;
	public $nombre;
	public $foto;
	public static function types_array(){
		return array(
		'nombre' => "VARCHAR( 150 ) NOT NULL",
		'apartamento' => "INT( 11 ) NOT NULL",
		'foto' => 'varchar( 100 )  NULL',	
 		);
	}
}