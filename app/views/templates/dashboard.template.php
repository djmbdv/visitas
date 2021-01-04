<?php
class DashboardTemplate extends Template{

	function config(){
		$this->set_parent("layout");
		$this->add_part("topbar","topbar");	
	}

	function render(){?>
<?php $this->render_part("topbar"); ?>
<div class="container mb-4">
	<h1 class="text-center m-2">Dashboard</h1>
	<a href="./visitas/" class="btn btn-info"><i class="fa fa-users"></i> Visitas</a>
<?php
	$t = $this->T("user")->tipo;
	$t->load();
 if( $t->descripcion == "admin"):?>
	<a href="./habitantes/" class="btn btn-warning m-2"><i class="fa fa-users"></i> Habitantes</a>
	<a href="./apartamentos/" class="btn btn-primary m-2"><i class="fa fa-home"></i> Apartamentos</a>
	<a href="./edificios/" class="btn btn-primary m-2"><i class="fa fa-building"></i> Edificios</a>
	<a href="./usuarios/" class="btn btn-dark m-2"><i class="fa fa-user"></i> Usuarios</a>
<?php endif;?>
</div>
<?php 
	}
}