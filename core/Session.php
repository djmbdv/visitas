<?php

class Session{
	public static $values;
	public static $session_loaded = false;
	public static function load($array){
		if(self::$session_loaded){
			throw new Exception("Session cargada", 1);
		}
		session_start();
		foreach ($array as $key => $value) {
			$_SESSION[$key] =  $value;
		}
		self::$values = $_SESSION;
		session_commit();
		self::$session_loaded = true;
	}
}