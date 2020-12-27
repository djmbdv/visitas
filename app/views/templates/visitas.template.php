<?php
class VisitasTemplate extends Template{

	function config(){
		$this->set_parent("layout");
		$this->add_part("modal","modal");
		$this->add_part("topbar","topbar");	
	}

	function render(){?>
<?php $this->render_part("topbar"); ?>
<?php $this->render_part("modal"); ?>
<div class="container">
	<div class="row">
	<h1 class="text-center">Visitas</h1>
	<a type="button"  data-toggle="modal" data-target="#exampleModal" class="btn btn-warning m-3">Nueva visita</a>
	<hr/>
		<table class="table table-dark">
			<thead>
    <tr>
<?php foreach ($this->T('table_headers') as  $value): ?>
      <th scope="col"><?= ucfirst( $value) ?></th>
<?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
<?php foreach($this->T('visitas') as $visita):
	$visita->load();
 ?>
<tr>
	<td><?= $visita->nombre ?></td>
	<td><?= $visita->destino ?></td>
	<td><img src="<?= $visita->foto ?>" class="image-table"></img></td>
	<td><?= $visita->visitado ?></td>
	<td><?= $visita->get_create_at() ?></td>
</tr>
<?php endforeach; ?>
</tbody>
		</table>
	
</div>
<?php 

	}
}