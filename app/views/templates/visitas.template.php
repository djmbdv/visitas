<?php
class VisitasTemplate extends Template{

	function config(){
		$this->set_parent("layout");
		$this->add_part("paginator","paginator");
		$this->add_part("topbar","topbar");	
	}

	function render(){
		$c = $this->T("count");
		$p = $this->T("page");

		?>
<?php $this->render_part("topbar"); ?>
<div class="container">
	<div class="row">
	<h1 class="text-center">Visitas</h1>
	<a type="button"  data-toggle="modal" data-target="#exampleModal" class="btn btn-warning m-3">Nueva visita</a>
	<hr/>
		<table class="table">
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
<?php $this->render_part("paginator");?>
</div>
<?php 

	}
}