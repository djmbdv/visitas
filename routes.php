<?php

require_once 'core/Router.php';

$hc  = new HomeController();
$main_router = new Router($_GET['g']);
$main_router->link("", $hc);
$main_router->setNoRoute($hc, "error");
$main_router->link("login", new LoginController());
$main_router->link("registro", new RegistroController());



$main_router->call();
