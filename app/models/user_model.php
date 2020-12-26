<?php

require_once "core/Model.php";
require_once "core/Session.php";
/**
 * 
 */
class UserModel extends Model{
	protected $username;
	protected $nombre;
	protected $password;
	self::$types_array = array(
		'username' => "VARCHAR( 80 ) NOT NULL",
		'name' => "VARCHAR( 120 ) NOT NULL",
		'password' => "VARCHAR( 80 ) NOT NULL",
		'email' = 'varchar ( 100 ) NOT NULL'
 		);

	public static function user_loged()

}