<?php
require "database.php";

abstract class Model{
	private static  $table_name;
	private static  $index_name = "ID";
	private static  $types_array;

	private $isLoaded = false;
	public function load() {
		if(!is_null($this->get_key())){
			$pdo = DB::get();
			$key = $this->get_key();
			$table = self::get_table_name();
			$index = self::$index_name;
			$sql = "SELECT * from $table WHERE $index = :key";
			$stmt  = $pdo->prepare($sql);
			$stmt->bindParam(":key", $key);
			$stmt->execute();
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
			foreach (get_class_vars(get_called_class()) as $k  => $v){
				if ($k == 'table_name'||
				$k == 'types_array'||
				$k == 'index_name' ||
				$k == 'isLoaded'  ||
				$k == self::$index_name
				)continue;
				$this->{$k} = $res[0][$k];
			}
			$this->isLoaded = true;
		}
	}


	public function __set($name,$value){
	//	echo "Set de atributo oculto";
		$this->{$name} = $value;
	}

	public  function __get($name){
	//	echo "Get de atributo oculto";
		$k =  $this->{$name};
		return $k;
	}

	public static function get_index(){
		return self::$index_name;
	}

	public function get_key(){
		$c = get_called_class();
		$index = $c::get_index();

		return isset($this->{$index}) && $this->{$index} != null?$this->{$index}:null; 
	}

	public function save(){
		$vars = get_class_vars(get_called_class());
		$table = self::get_table_name();
		$index = self::$index_name;
		
		if(!is_null($this->get_key()) && $this->isLoaded){
			$key = $this->get_key();	
			$sql = "UPDATE $table ";
			$count = 0;
			foreach ($vars as $k  => $v) {
				if ($k == 'table_name'||
				$k == 'types_array'||
				$k == 'index_name' ||
				$k == 'isLoaded'  ||
				$k == self::$index_name
				)continue;
				$value = $this->{$k};
				if($count++ == 0)$sql.=" set $k = '$value' ";
				else $sql.=",  $k = '$value' ";
			}
			$sql.=" where $index = '$key'";
			$pdo = DB::get();
			$pdo->query($sql);
		}else if(is_null($this->get_key())){
			$sql = "INSERT INTO `$table`";
			$count = 0;
			foreach ($vars as $k  => $v) {
				if ($k == 'table_name'||
				$k == 'types_array'||
				$k == 'index_name' ||
				$k == 'isLoaded'  ||
				$k == self::$index_name
				)continue;
				if($count++ == 0)$sql.="( `$k`";
				else $sql.=", `$k` ";
			}
			$sql.= ") VALUES ";
			$count = 0;
			foreach ($vars as $k  => $v) {
				if ($k == 'table_name'||
				$k == 'types_array'||
				$k == 'index_name' ||
				$k == 'isLoaded'  ||
				$k == self::$index_name
				)continue;
				$value = $this->{$k};
				if($count++ == 0)$sql.="( '$value'";
				else $sql.=", '$value' ";
			}
			$sql.=")";
			var_dump($sql);
			$pdo = DB::get();
			$nkey = self::next_key();
			$pdo->query($sql);
			$this->isLoaded = true;
			$this->{$index} = $nkey;
		}
	}
	public static function next_key(){
		$pdo = DB::get();
		$table = self::get_table_name();
		$q = $pdo->query("SHOW TABLE STATUS LIKE '$table'");
		$next = $q->fetch(PDO::FETCH_ASSOC);
		//var_dump($q);
		return  $next['Auto_increment'];
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
		return 'VARCHAR( 120 )  NULL';
	}
	public static function get_table_name(){
		return isset(self::$table_name)?self::$table_name:get_called_class().'s';
	}

	public static function create_table(){
		if(self::table_exist())return false;
		$pdo = DB::get();
		$tn =  self::get_table_name();
		$index_name = self::$index_name;
		$sql = "CREATE table `$tn` ( $index_name INT( 11 ) AUTO_INCREMENT PRIMARY KEY";

     	$atributes = get_class_vars(get_called_class());

		foreach ($atributes as $att => $value) {
			if ($att == 'table_name'||
				$att == 'types_array'||
				$att == 'index_name' ||
				$att == 'isLoaded'  ||
				$att == self::$index_name
			)
					continue;
			$sql.=",$att ".self::search_type($att);

			try{
				$rp = new ReflectionProperty(get_called_class(), $att);
				$tipo =  $rp->getType()->getName();
				if(is_subclass_of($tipo, get_class())){
					if($tipo::table_exist()){
						echo "tabla creada";
					}
				}
			}catch (Throwable $t){
				// Executed only in PHP 7, will not match in PHP 5
			}
		}
		$sql.=",`create_at` timestamp NOT NULL DEFAULT current_timestamp(),`modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() );";
		//var_dump($sql);
		$pdo->query($sql);
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
	protected $ID;
	function __construct()
	{
		ClassName::create_table();
		//var_dump(get_class_vars(get_class($this)));
	}
}

/**
 * 
 */
class ClassName2 extends Model
{
	public ClassName $toto;
	
	function __construct()
	{
		ClassName2::create_table();
		# code...
	}
}

$m = new ClassName();
$m->ID = "1";
$m->load();

var_dump($m);

//new ClassName2();

//var_dump($m->next_key());