<?php

require_once "core/Controller.php";


/**
 * 
 */
class HomeController extends Controller
{
	
	
	function index(){
		Session::load();
		$user = UserModel::user_logged();
		if(is_null($user)){
			header('location: /login/');
			return;
		}
		$main_view = new MainView(array());
		return $main_view->render();
	}
	function error(){
		$error_view = new ErrorView();
		return $error_view->render();
	}
}