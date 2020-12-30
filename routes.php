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
	$apic = new ApiController();
		
	$dashboard_router = new Router();
	$dashboard_router->link("",$rc);


		//ruta /registro/visitas
		$vc = new VisitasController();
		$hc = new HabitantesController();
		$uc = new UsersController();
		$ac = new ApartamentosController();
		$ec = new EdificiosController();

	$dashboard_router->link("visitas",$vc);
	$dashboard_router->link("habitantes", $hc);
	$dashboard_router->link("usuarios", $uc);
	$dashboard_router->link("apartamentos", $ac);
	$dashboard_router->link("edificios", $ec);

	$api_router = new Router();
	$api_router->link("habitante",$apic,"search_habitantes");
	$api_router->link("user",$apic,"search_users");
	$api_router->link("tipo",$apic,"search_tipos");
	$api_router->link("visita",$apic,"search_visitas");
	$api_router->link("apartamento",$apic,"search_apartamentos");

	$api_router->link("edificio",$apic,"search_edificios");
	

$main_router->link("api",$api_router);
$main_router->link("dashboard",$dashboard_router);
$main_router->link("menu", $rc , "menu");
$main_router->link("activec",$rc,"active_control_visitas");
//var_dump($main_router);
$main_router->set_link($_GET['g']);

$main_router->call();
