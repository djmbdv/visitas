<?php
class RegistroTemplate extends Template{

	function config(){
		$this->set_parent("layout");
		$this->add_part("topbar","topbar");	
	}

	function render(){?>
<?php $this->render_part("topbar"); ?>
<div class="container">
<h1 class="text-center">
Registro</h1>
<a class="btn btn-primary" href="">Registro de visitas</a>
<a class="btn btn-warning">Registro de habitante</a>
<a  class="btn btn-danger">Lista de visitas</a>
<a  class="btn btn-primary">Edificios</a>
<a class="btn btn-primary"> </a>
</div>
<?php 

	}
}