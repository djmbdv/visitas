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
	public $visitado;


	public static function types_array(){
		return array(
		'nombre' => "VARCHAR( 150 ) NOT NULL",
		'destino' => "INT( 11 ) NOT NULL",
		'foto' => ' MEDIUMBLOB NOT NULL',
		'visitado'=>'VARCHAR (100) NOT NULL'
 		);
	}
}