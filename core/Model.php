<?php
require "database.php";

abstract class Model{
	private static  $table_name;
	private static   $index_name;
	private static  $types_array;
	public function load(){

	}

	public function save(){
		//$vars = get_class_vars():
		foreach ($vars as $v) {
	//		$sql = 
		}
	}

	public static function table_exist(){
		$pdo = DB::get();
		$tn =  self::get_table_name();
		$dbname = DB::getDBname();
		$stmt = $pdo->prepare("SELECT count(TABLE_NAME) as conteo FROM information_schema.tables WHERE table_schema = '$dbname' and TABLE_NAME like '$tn'");
		$stmt->execute();

		return $stmt->fetchAll()[0]["conteo"] == 1;
	}

	private static function search_type($atribute){
		if(isset(self::$types_array))
		foreach (self::$types_array as $atributo => $tipo) {
			if($atribute == $atributo)return $tipo;
		}
		return 'VARCHAR( 50 ) NOT NULL';
	}
	public static function get_table_name(){
		return isset(self::$table_name)?self::$table_name:get_called_class().'s';
	}

	public static function create_table(){
		if(self::table_exist())return false;
		$pdo = DB::get();
		$tn =  self::get_table_name();
		$sql ="CREATE table $tn(
     ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY";

     	$atributes = get_class_vars(get_called_class());
     	//var_dump($atributes);
		foreach ($atributes as $att => $value) {
			if ($att == 'table_name'||
				$att == 'types_array'||
				$att == 'index_name')
					continue;
			$sql.=",$att ".self::search_type($att);
		}
		$sql.="
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp());";
		var_dump($sql);
		$pdo->query($sql);
/*
     Prename VARCHAR( 50 ) NOT NULL, 
     Name VARCHAR( 250 ) NOT NULL,
     StreetA VARCHAR( 150 ) NOT NULL, 
     StreetB VARCHAR( 150 ) NOT NULL, 
     StreetC VARCHAR( 150 ) NOT NULL, 
     County VARCHAR( 100 ) NOT NULL,
     Postcode VARCHAR( 50 ) NOT NULL,
     Country VARCHAR( 50 ) NOT NULL);" ;
     $pdo->exec($sql);*/
     	return true;
	}

	public static function find(){}

	public static function get_all(){

	}

}



/**
 * 
 */
class ClassName extends Model
{
	

	var $uno;
	var $dos;
	function __construct()
	{
		var_dump(get_class_vars(get_class($this)));
	}
}


var_dump(ClassName::table_exist());