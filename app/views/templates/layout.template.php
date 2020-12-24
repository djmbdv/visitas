<?php


/**
 * 
 */
class LayoutTemplate extends Template
{
	
	function config(){
		$this->add_part('header','header');
		$this->add_part('footer','footer');
	}

	function render(){
		$this->render_part('header');
		echo "Hola mundo";
		$this->render_part('footer');
	}
}