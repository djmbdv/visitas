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
<a href="./habitantes/" class="btn btn-warning">Habitantes</a>
<a href="./visitas/" class="btn btn-danger">Visitas</a>
<a href="./edificios/" class="btn btn-primary">Edificios</a>
</div>
<?php 

	}
}