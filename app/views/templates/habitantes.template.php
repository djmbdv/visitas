<?php
class HabitantesTemplate extends Template{

	function config(){
		$this->set_parent("layout");
		$this->add_part("paginator","paginator");
		$this->add_part("topbar","topbar");
		$this->add_part("table","table");
		$this->add_part("modal","modal");
	}

	function render(){
		$c = $this->T("count");
		$p = $this->T("page");
		$this->render_part("topbar"); 
		$this->render_part("modal");
		?>

<div class="container">
	<div class="row">
	<h1 class="text-center"><?= $this->T('title') ?></h1>
	<a type="button"  data-toggle="modal" data-target="#exampleModal" class="btn btn-warning m-3">Nuevo Habitante</a>
	<hr/>
<?php 
if($c > 0): 
	$this->render_part("table");
 else: ?>
	<h1>No hay Registros</h1>
<?php endif; ?>
</div>
<?php $this->render_part("paginator");?>
</div>
<?php 

	}
}