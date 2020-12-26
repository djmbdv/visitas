<?php

require_once 'core/Router.php';

$hc  = new HomeController();
$lc = new LoginController();
$main_router = new Router($_GET['g']);
$main_router->link("", $hc);
$main_router->setNoRoute($hc, "error");
$main_router->link("login",$lc );
$main_router->link("logout",$lc,"logout");



// Rutas /registro
$rc = new RegistroController();

$vc = new VisitasController();
$router_registro = new Router();
$router_registro->link("",$rc);


$router_registro->link("visitas",$vc);

$main_router->link("registro",$router_registro);



$main_router->call();
