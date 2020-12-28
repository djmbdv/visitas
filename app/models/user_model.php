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
	protected $tipo;
	public static function types_array(){ 
		return 	array(
		'username' => "VARCHAR( 80 ) NOT NULL UNIQUE",
		'name' => "VARCHAR( 120 ) NOT NULL",
		'password' => "VARCHAR( 80 ) NOT NULL",
		'email' => 'varchar ( 100 ) NOT NULL',
		'tipo' => 'INT( 9)  NOT NULL'
 		);
	}

	public static function seeds(){
		$client  = new UserModel();
			$client->username = 'cliente';
			$client->name = 'Cliente de Prueba';
			$client->password =md5( '1234');
			$client->tipo = 1;
			$client->save();
			$client  = new UserModel();
			$client->username = 'admin';
			$client->name = 'Admin de Prueba';
			$client->password =md5( '1234');
			$client->tipo = 2;
			$client->save();

	}
	public static function user_logged(){
		Session::load();
		if(isset(Session::$values["username"]))
			return self::find_username(Session::$values["username"]);
		else return null;
	}
	public static function find_username($username){
	try{
		$pdo = DB::get();
		$tabla = self::get_table_name();
		$sql = "select ID from $tabla where username = '$username'";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if(!isset($res[0]))return null;
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
		if(!is_null($user) && $user->password == md5($password)){
			Session::load( array('login' => true,'username' => $username,'logged_at' => time() ));
			return true;
		}
		else return false;
	}

}