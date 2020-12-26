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
		$this->array = [];
	}


	function set_link($str){
		$this->link = $str;
		$l = preg_split ('/\//',$this->link, 2);
		$this->head = $l[0];
	 	$this->tail = isset($l[1])?$l[1]:null;
	}

	function get_head(){
		var_dump($this->head);
	}

	function link($head_value,$controller_or_subrouter,$method = "index"){
		if (get_class($controller_or_subrouter)== 'Router') {
			$controller_or_subrouter->set_link($this->tail);
//			var_dump($this->tail);
		}
		$this->array["$head_value"] =  [$controller_or_subrouter,$method];
	}

	function setNoRoute($controller,$method ){
		$this->noRoute =  array("controller" => $controller, "method" => $method ); 
	}

	function call(){
		if(isset($this->array[$this->head])){
			if (get_class($this->array[$this->head][0])== 'Router') {
				$this->array[$this->head][0]->call();
			}else $this->array[$this->head][0]->main_method(
				$this->array[$this->head][1],
				$this->tail);
		}else if (isset($this->noRoute)) {
			$this->noRoute["controller"]->main_method($this->noRoute["method"]);
		}
	}
}

