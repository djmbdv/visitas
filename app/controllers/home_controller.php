<?php

require_once "core/Controller.php";


/**
 * 
 */
class HomeController extends Controller
{
	
	
	function index(){
		$main_view = new MainView(array());
		$create = new UserModel();
		return $main_view->render();
	}
	function error(){
		$error_view = new ErrorView();
		return $error_view->render();
	}
}