<?php

require_once 'core/Router.php';

$hc  = new HomeController();
$lc = new LoginController();
$fc = new FotoController();
$main_router = new Router($_GET['g']);
$main_router->link("", $hc);
$main_router->setNoRoute($hc, "error");
$main_router->link("login",$lc );
$main_router->link("logout",$lc,"logout");
$main_router->link("foto", $fc);


// ruta /registro
	$rc = new RegistroController();

		
	$registro_router = new Router();
	$registro_router->link("",$rc);


		//ruta /registro/visitas
		$vc = new VisitasController();
		$visitas_router = new Router();
		$visitas_router->link("add", $vc, "add");
		$visitas_router->link("view",$vc, "view");
		$visitas_router->link("", $vc);
	
// var_dump($registro_router);

	$registro_router->link("visitas",$visitas_router);

$main_router->link("registro",$registro_router);
//var_dump($main_router);

$main_router->call();
