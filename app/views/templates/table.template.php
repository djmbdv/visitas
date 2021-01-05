<?php

class TableTemplate extends Template{


	function render(){ 
		$c = $this->T("count");
		$p = $this->T("page");
		?>
<div class="table-responsive">
<table class="table table-hover">
	<thead class="table-light">
	    <tr>
<?php
foreach($this->T('table_vars') as  $value): ?>
			<th scope="col"><?= ucfirst( $value) ?></th>
<?php 
endforeach; ?>
			<th scope="col">Fecha Creación</th>
			<th scope="col">Fecha Modificación</th>
			<th scope="col">Acciones</th>
	    </tr>
	</thead>
	<tbody>
<?php
foreach($this->T('items') as $it):
	$it->load();?>
	<tr>
<?php
	foreach($this->T('table_vars') as $value):
	if($it->get_attribute_type($value) == "mediumblob" ):?>
		<td><img src="<?= $it->{$value} ?>" class="image-table"></img></td>
<?php
	elseif(is_subclass_of($it->{$value}, "Model")): 
		 	?>
		<td><?=!is_null( $it->{$value}) && $it->{$value}->exist() ? $it->{$value}->to_str():'' ?></td>
<?php
	else:?>
		<td><?= $it->{$value} ?></td>
<?php
endif; 
endforeach; ?>
		<td><?= $it->get_create_at() ?></td>
		<td><?= $it->get_modified_at() ?></td>
		<td>
			<div class="btn-group" role="group" aria-label="Basic example">
			<button class="btn btn-view btn-info btn-sm" data-model="<?=  get_class($it)::classname() ?>" data-key="<?= $it->get_key() ?>"><i class="fa fa-eye"></i></button>
			<button class="btn btn-edit btn-warning btn-sm" data-model="<?=  get_class($it)::classname()?>" data-key="<?= $it->get_key() ?>"><i class="fa fa-pencil"></i></button>
			<button class="btn btn-delete btn-danger btn-sm" data-model="<?=  get_class($it)::classname()?>" data-key="<?= $it->get_key() ?>">
				<i class="fa fa-trash"></i></button>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
</table>
</div>
<?php
	}
}