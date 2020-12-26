<?php

require_once "core/Model.php";
require_once "core/Session.php";
require_once "core/database.php";
/**
 * 
 */
class UserModel extends Model{
	protected $username;
	protected $nombre;
	protected $password;
	self::$types_array = array(
		'username' => "VARCHAR( 80 ) NOT NULL UNIQUE",
		'name' => "VARCHAR( 120 ) NOT NULL",
		'password' => "VARCHAR( 80 ) NOT NULL",
		'email' = 'varchar ( 100 ) NOT NULL'
 		);

	public static function user_loged(){
		if(isset(Session::$values["username"]))
			return self::find_username(Session::$values["username"]);
	}
	public static function find_username($username){
		$pdo = DB::get();
		$sql = "select ID where username = 'username'";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$um = new UserModel();
		$um = $res[0]['ID'];
		$um->load();
		return $um;
	}

}