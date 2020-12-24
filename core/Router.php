<?php

require_once "core/Controller.php";

/**
 * 
 */
class Router {
	public $array = null; // Array de enlace
	public $link;
	public $head;
	public $tail;
	public $noRoute;
	function __construct($str = "") 
	{
		if($str != "")$this->set_link($str);
	}


	function set_link($str){
		$this->link = $str;
		list($this->head, $this->teil) = preg_split ('/\//',$this->link, 2);
	}

	function get_head(){
		var_dump($this->head);
	}

	function link($head_value,$controller_or_subrouter,$method = "index"){
		if (get_class($controller_or_subrouter)== 'Router') {
			$controller_or_subrouter->set_link($this->tail);
		}
		$this->$array[] = array("$head_value" => [$controller_or_subrouter,$method] );
	}

	function setNoRoute($controller,$method){
		$this->noRoute =  array("$controller" => $method ); 
	}

	function call(){
		if(isset($array[$this->head])){
			$array[$this->head][0]->main_method($array[$this->head][1],($array[$this->head][2]));
		}
	}
}

