<?php
class HomeTemplate extends Template{

	function config(){
		$this->set_parent("layout");	
	}

	function render(){?>

<div class="container">
<h1 class="text-center">Administración de Visitas</h1>

<a href="/login">Login</a>
</div>
<?php 

	}
}