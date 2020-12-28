<?php

require_once 'core/Router.php';

$hc  = new HomeController();
$lc = new LoginController();
$fc = new FotoController();
$main_router = new Router();
$main_router->link("", $hc);
$main_router->setNoRoute($hc, "error");
$main_router->link("login",$lc );
$main_router->link("logout",$lc,"logout");
$main_router->link("foto", $fc);
$main_router->link("visita",$fc,"visita");

// ruta /registro
	$rc = new RegistroController();

		
	$registro_router = new Router();
	$registro_router->link("",$rc);


		//ruta /registro/visitas
		$vc = new VisitasController();

	$registro_router->link("visitas",$vc);

$main_router->link("registro",$registro_router);
//var_dump($main_router);
$main_router->set_link($_GET['g']);

$main_router->call();
