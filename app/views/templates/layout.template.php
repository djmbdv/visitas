<?php


/**
 * 
 */
class LayoutTemplate extends Template
{
	
	function config(){
		$this->add_part('header','header');
	}

	function render(){
		$this->render_part('header');
		echo "Hola mundo";
	}
}