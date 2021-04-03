<?php

require_once "core/Model.php";
/**
 * 
 */
class VisitaModel extends Model
{
	public $nombre;
	public $identificacion;
	public ApartamentoModel $destino;
	public $foto;
	public HabitanteModel $visitado;
	public UserModel $cliente;


	public static function types_array(){
		return array(
		'nombre' => "VARCHAR( 150 ) NOT NULL",
		'destino' => "INT( 11 ) NOT NULL",
		'foto' => ' MEDIUMBLOB NOT NULL',
		'visitado'=>'int (11) NOT NULL',
		'identificacion'=>'VARCHAR (20) NOT NULL',
		'cliente' => 'int (11) NOT NULL'
 		);
	}
}