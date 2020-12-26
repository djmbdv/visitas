<?php

require_once "core/Model.php";

/**
 * 
 */
class HabitanteModel extends Model
{
	
	self::$types_array = array(
		'nombre' => "VARCHAR( 150 ) NOT NULL",
		'edificio' => "INT( 11 ) NOT NULL",
		'foto' = 'varchar( 100 ) NOT NULL'
 		);
	
}