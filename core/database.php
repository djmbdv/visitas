<?php 
require '../config.php';
class DB{
	private static $conn = null;
	public static function getDBName(){ 
		global $dbname;
		return $dbname;
	}
	public static function get(){
		global $username;
		global $dbname;
		global $servername;
		global $password;
		if(is_null(self::$conn))self::$conn =  new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
		self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return self::$conn;
	}
}