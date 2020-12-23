<?php

require_once "Controller.php";

/**
 * 
 */
class Router {
	public $array = null; // Array de enlace
	public $link;
	function __construct($str)
	{
		$this->$link = $str;
	}
	function get_head(){
		str_split($this->$link,'/');
	}

	function link($head_value,$controller){
		$this->$array[] = array("$head_value" => $controller );
	}
}