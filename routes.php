<?php

require_once 'core/Router.php';

$hc  = new HomeController();
$lc = new LoginController();
$main_router = new Router($_GET['g']);
$main_router->link("", $hc);
$main_router->setNoRoute($hc, "error");
$main_router->link("login",$lc );
$main_router->link("logout",$lc,"logout");
$main_router->link("registro", new RegistroController());



$main_router->call();
