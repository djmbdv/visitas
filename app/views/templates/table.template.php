<?php

class TableTemplate extends Template{


	function render(){ 
		$c = $this->T("count");
		$p = $this->T("page");
		?>
<table class="table">
			<thead>
    <tr>
<?php foreach ($this->T('table_vars') as  $value): ?>
      <th scope="col"><?= ucfirst( $value) ?></th>
<?php endforeach; ?>
		<th scope="col">Fecha Creación</th>
		<th scope="col">Fecha Modificación</th>
    </tr>
  </thead>
  <tbody>
<?php
 foreach($this->T('items') as $it):
	$it->load();
 ?>
<tr>
<?php foreach ($this->T('table_vars') as $value):
		 if ($it->get_attribute_type($value) == "mediumblob"):?>
		 	<td><img src="<?= $it->{$value} ?>" class="image-table"></img></td>
		 <?php else:?>
	<td><?= $it->{$value} ?></td>
<?php
endif; 
endforeach; ?>
	<td><?= $it->get_create_at() ?></td>
	<td><?= $it->get_modified_at() ?></td>
</tr>
<?php endforeach; ?>
</tbody>

</table>
<?php
	}
}