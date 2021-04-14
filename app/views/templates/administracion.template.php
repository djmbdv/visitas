<?php
class AdministracionTemplate extends Template{

	function config(){
		$this->set_parent("layout");
		$this->add_part("paginator","paginator");
		$this->add_part("topbar","topbar");	
		$this->add_part("admintable","admintable");

		$this->filtros =  $this->T("filtros");
		

	}

	function render(){
		$c = $this->T("count");
		$p = $this->T("page");
		?>
<?php $this->render_part("topbar"); ?>
<div class="container">
	<div class="row">
	<h1 class="text-center">Administración</h1>
	<form class="form-row form-filter" >
	<div class="form-group col">
	<label class="small">Desde</label> <input id="inputDesde" name="desde" class="form-control form-control-sm" type="date" name="" value="<?= $this->filtros['desde'] ?? '' ?>">
	</div>
	<div class="form-group col "> 
	<label class="small">Hasta</label> <input id="inputHasta" name="hasta" class="form-control form-control-sm" type="date" name="" value="<?= $this->filtros['hasta'] ?? '' ?>">
	</div>
		
	<div class="form-group col-md-2  mt-auto "> 
		<button class="btn btn-warning" type="submit" ><i class="fa fa-filter"></i> Filtrar</button>
	</div>
	<div class="form-group col-md-2  mt-auto "> 
		<a class="btn btn-success btn-download"  ><i class="fa fa-download"></i> Descargar Reporte</a>
	</div>
	</form>
	<hr/>
<?php $this->render_part("admintable");?>
</div>
<?php $this->render_part("paginator");?>
</div>
<?php 
	}
}