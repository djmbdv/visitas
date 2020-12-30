<?php
class MenuTemplate extends Template{

	function config(){
		$this->set_parent("layout");
		$this->add_part("topbar","topbar");	
	}

	function render(){?>
<?php $this->render_part("topbar"); ?>
<div class="container mb-4">
<h1 class="text-center">

Menú</h1>
<div class="row m-4 pb-4">
	<div class="col">
<a href="/dashboard/" class="btn btn-primary btn-block p-3 mt-4">Dashboard</a>
</div>
	<div class="col">
<a href="/activec/" class="btn btn-info btn-block p-3 mt-4">Activar Control de Visitas</a>
</div>

</div>
</div>
<?php 

	}
}