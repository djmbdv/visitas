<?php

require_once "core/Model.php";
/**
 * 
 */
class VisitaModel extends Model
{
	public $nombre;
	public $destino;
	public $foto;
	public static $types_array = array(
		'nombre' => "VARCHAR( 150 ) NOT NULL",
		'destino' => "INT( 11 ) NOT NULL",
		'foto' => 'VARCHAR ( 100 ) NOT NULL'
 		);	
}