<?php


/**
 * 
 */
class Template 
{
	public $parts;

	function __construct($model){
		$this->parts = [];
		$this->model = $model;
		$this->config();
	}
	public function T($name){
		return $this->model[$name];
	}
	public function add_part($template, $name){
		require_once("app/views/templates/".$template.".template.php");
		$t = ucfirst($template).'Template';
		$this->parts[$name] = new $t($this->model);
	}
	public function render_part($name){
		if(isset($this->parts[$name]))
			$this->parts[$name]->render();
	}
	public function config(){
	}
	function render(){
		echo "Plantilla vacia";
	}
}