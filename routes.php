<?php

require_once 'core/Router.php';


$main_router = new Router($_GET['g']);
$main_router->link("", new HomeController());
$main_router->call();
