<?php

require_once "core/Model.php";
require_once "core/Session.php";
require_once "core/database.php";
/**
 * 
 */
class UserModel extends Model{
	protected $username;
	protected $name;
	protected $password;
	protected $email;
	public static $types_array = array(
		'username' => "VARCHAR( 80 ) NOT NULL UNIQUE",
		'name' => "VARCHAR( 120 ) NOT NULL",
		'password' => "VARCHAR( 80 ) NOT NULL",
		'email' => 'varchar ( 100 ) NOT NULL'
 		);

	public static function user_loged(){
		if(isset(Session::$values["username"]))
			return self::find_username(Session::$values["username"]);
	}
	public static function find_username($username){
	try{
		$pdo = DB::get();
		$tabla = self::get_table_name();
		$sql = "select ID from $tabla where username = '$username'";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		var_dump($res);
		$um = new UserModel();
		$um->ID = $res[0]['ID'];
		$um->load();
		return $um;
		} catch (Exception $e) {
			return null;	
		}
	}

	public static function login($username, $password){
		$user = self::find_username($username);
		if(!is_null($user) && $user->password == md5($password))echo "login existoso";
		else var_dump($user);
	}

}