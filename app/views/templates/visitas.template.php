<?php
class VisitasTemplate extends Template{

	function config(){
		$this->set_parent("layout");
		$this->add_part("topbar","topbar");	
	}

	function render(){?>
<?php $this->render_part("topbar"); ?>
<div class="container">
	<div class="row">
	<h1 class="text-center">Visitas</h1>
	<a href="./add" class="btn btn-warning">Nueva visita</a>
	<div class="card">
		<table class="table table-dark">
			<thead>
    <tr>
<?php foreach ($this->T('table_headers') as  $value): ?>
      <th scope="col"><?= $value ?></th>
<?php endforeach; ?>
    </tr>
  </thead>
			<?php print_r($this->T('visitas')) ?>
		</table>
	</div>
</div>
<?php 

	}
}