<?php

require_once "core/Controller.php";


/**
 * 
 */
class HomeController extends Controller
{
	
	function index(){

		return (new MainView())->render(array(["var" => 1,]));
	}
}