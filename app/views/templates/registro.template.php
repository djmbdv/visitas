<?php
class RegistroTemplate extends Template{

	function config(){
		$this->set_parent("layout");
		$this->add_part("topbar","topbar");	
	}

	function render(){?>
<?php $this->render_part("topbar"); ?>
<div class="container mb-4">
<h1 class="text-center">
Registro</h1>

<a href="./visitas/" class="btn btn-info">Visitas</a>
<?php if($this->T("user")->tipo  == 2):?>
	<a href="./usuarios/" class="btn btn-dark">Usuarios</a>
	<a href="./habitantes/" class="btn btn-warning">Habitantes</a>
	<a href="./edificios/" class="btn btn-primary">Edificios</a>
<?php endif;?>
</div>
<?php 

	}
}