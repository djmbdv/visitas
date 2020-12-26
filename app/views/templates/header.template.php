<?php

/**
 * 
 */
class HeaderTemplate extends Template
{
	
	function config()
	{
		# code...
	}
	function render(){?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= $this->S("favicon.png")?>">

    <title>Administrador de Visitas</title>

    <link href="<?= $this->S("css/bootstrap.min.css")?>" rel="stylesheet">
  </head>

<?php	}
}