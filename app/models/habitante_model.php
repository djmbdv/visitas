<?php

require_once "core/Model.php";

/**
 * 
 */
class HabitanteModel extends Model
{
	
	protected ApartamentoModel $apartamento;
	protected $email;
	protected $telefono;
	protected $nombre;
//	protected $foto;
	protected $identificacion;
	protected UserModel $cliente;
	public static function types_array(){
		return array(
		'nombre' => "VARCHAR( 150 ) NOT NULL",
		'apartamento' => "INT( 11 ) ",
//		'foto' => ' MEDIUMBLOB NOT NULL',	
 		);
	}
	public static function descriptions_array(){
		return array(
		'nombre' => "Nombre Completo",
		'apartamento' => "apartamento o casa donde habita"	
 		);
	}

	public static function form_types_array(){
		return array(
		'email' => "email",
		'telefono' => "tel",
 		);
	}
	public static function search_nombre($nombre, $cantidad = 20, $apartamento = null){
		$usuario = UserModel::user_logged();
		if(!$usuario)return;
		$condicion = [['nombre','like',"%$nombre%"]];
		if($apartamento)$condicion[] = ['apartamento','=',$apartamento];
		if(!$usuario->is_admin())$condicion[] = ["cliente","=",$usuario->get_key()];
		$a = self::all_where_and($condicion, $cantidad,null, true);
		$k = array_map(function($a){return $a->no_class_values(); }, $a);
		return json_encode($k);
	}
	public static function presentation($h){
		return $h->nombre; 
	}
	public static function seeds(){
	  //return;
		$foto = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHoAAAB6CAMAAABHh7fWAAAAaVBMVEX///8AAADo6Oja2tojIyPd3d0mJiYNDQ26uroQEBDIyMjh4eHl5eXW1tbr6+sHBwdOTk6Hh4eTk5NBQUGcnJzx8fEWFhZbW1srKyszMzNvb28eHh53d3dWVlZ/f39HR0epqallZWU6Ojo1/jOrAAACqklEQVRoge2a6XaqMBRGCRZk1IrggBWp7/+Q90ZKV1uL5Hz5hP7IfgD2WhkOZ4jnWZI0KrH9BkJenJQ6VJN7/faiNM3E3iqpT6qjmFS8Krfqk/cJxUmtvtFO5K3KpfrJeYozntd33o63KHuqODkPiDXxtkmedc0eijuOTf4Ecfo+Kr5R0xc+MhNrIq65NDeTY0whMVPdrcxMXPPsPoiMELPO2lAYecAbx7yQm5VKKWrhGesoKertuOieC8O8ekHUISOcBzGi3jE2e7FG1OvFbOqlUzu1U/9ltfhvfVMHs6ljp3Zqp/7DaixBoqhzxKwUo9DeYOqNvRnKwjXWmbigpP+JbbmZ4GrbjlaFq63rDyhR0Oxszd4eVe+t1aIGzlfsy1z4iNv3UwJUTYik4Dlb25u9V0z9SlDPF8PRc8bo2gVYqkDpXkGbzdhqcMU5XVIf6F6FK4oaCeP2AbwDuF6Mq6UBNpvVEE/lak5j+D8XqZlztTTitjRv+CFeceKsSziCII0fbmQytU9Uy3abM3z4RPAP4R3vjsy41I2py605mqqPbLN3MFUf2ObqNC7tOLFH96lxmrSkxe8PBG0N9psBwY+T/VJkvgcDkul5S1YLkiRWctQzXyAVFfjM30dlHEU7rjx1IzMTt9s8iPbQnhsCbTtWWAEeh9Qcc3WVq6+cFYca4pR/SAb1C/f2qfhKfLF6GrsSe1XsULNSuwKXV2WIizVhCZ621jgTHObQAuKIINYcpZlDAtzlQbkktCXiWv4xF1N5Pv5UVczZJMQEQMQ2oR7rj/twBBmneVQHVmAD2pTN4DWHJyzm/J62TSD+Xd6KkyCUl/abOBKmnHZ8CXABOFnBOfc37QkhZNT9cZehh6J2hL5TO7VTO7VTM9TyMZY9fYMrhZ+9oNxK4H/iGzEkYE2a3gAAAABJRU5ErkJggg==';
		for ($i=0; $i < 25; $i++) { 
			$h = new HabitanteModel();
			$apellidos = array('Rios','Gutierrez','Martinez', 'Gonzalez', 'Patiño','Alzolar', 'Noriega', 'Pastrano', 'Peres','Ruiz', 'Aguilera','Sarmiento','Garcia','Hernandez','Coa', 'Espejo', 'Calvo', 'Cabello','Bello','Feo','Leon', 'Sotillo','Bolivar','Marcano','Miranda', 'Smith','Matsumoto', 'Chang', 'Marquez','Suarez','Herrera', 'Arenas','Landaez', 'Fuentes', 'Fernandez', 'Padilla','Infante','Gomez', 'Doni', 'Bozzi','Pacheco','Agreda','Espada', 'Sierra','Colmenares');
			$nombre = array('Ana','Felix');
			$array =array("Juan" ,"Peres",
				"Alfredo","Jaime","Adolfo","Casimiro", "Fabio", "Jean", "Doni","Tarek","Chavez", "Maria", "Espejo","Fabian", "Rosa", "David","Uzumaki", "Sasuke","Gonzalez","McGregor", "Messi", "Marcano", "Adriana", "Jonh", "Smith" );
			$h->apartamento = new ApartamentoModel();
			$h->telefono = random_int(1000, 2000);
			$h->email = strtolower($array[random_int(0,count($array)-1)].random_int(1000, 2000).'@gmail.com');
			$h->nombre =ucfirst( $array[random_int(0,count($array)-1)])." ".ucfirst($array[random_int(0,count($array)-1)]);
			$h->identificacion =  random_int(1000000, 90000000);
			$h->foto = $foto;
		//var_dump($h);
			$h->cliente = UserModel::all()[0];
			$h->save();
		}
	}
}