<?php

require_once "core/Controller.php";


/**
 * 
 */
class HomeController extends Controller
{
	
	function index(){
		$hola = new MainView(array(["var" => 1,]));
		return $hola->render();
	}
}