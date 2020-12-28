<?php
class VisitasTemplate extends Template{

	function config(){
		$this->set_parent("layout");
		$this->add_part("paginator","paginator");
		$this->add_part("topbar","topbar");	
		$this->add_part("table","table");
	}

	function render(){
		$c = $this->T("count");
		$p = $this->T("page");

		?>
<?php $this->render_part("topbar"); ?>
<div class="container">
	<div class="row">
	<h1 class="text-center">Visitas</h1>
	<hr/>
<?php $this->render_part("table");?>
</div>
<?php $this->render_part("paginator");?>
</div>
<?php 

	}
}