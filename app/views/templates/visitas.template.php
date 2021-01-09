<?php
class VisitasTemplate extends Template{

	function config(){
		$this->set_parent("layout");
		$this->add_part("paginator","paginator");
		$this->add_part("topbar","topbar");	
		$this->add_part("table","table");

		$this->filtros =  $this->T("filtros");
			$this->add_part("campoVisitado","campo",
		 array('name' => "visitado" ,
		 		'autocomplete' => false,
		 		'placeholder'=> "Persona que visitó",
		 		'end_point'=> '/api/habitantes/',
		 		'autocomplete_att'=>'s',
		 		'add_class' => 'col mt-auto',
		 		'form_type' => 'select',
		 		'size'=>'sm',
		 		'attributes'=>  array('s' => "" ),
		  )
		);
$this->add_part("campoApartamento","campo",
		 array('name' => "apartamento" ,
		 		'autocomplete' => false,
		 		'placeholder'=> "Apartamento",
		 		'end_point'=> '/api/apartamentos/',
		 		'autocomplete_att'=>'s',
		 		'clase'=> 'apartamento',
		 		'add_class' => 'mt-auto col',
		 		'form_type' => 'select',
		 		'size'=>'sm',
		 		'autoload'=>true,
		 		'attributes'=>  array('s' => "" ),
		 		'children' => ['inputVisitado'],
		  )
		);
	}

	function render(){
		$c = $this->T("count");
		$p = $this->T("page");
		?>
<?php $this->render_part("topbar"); ?>
<div class="container">
	<div class="row">
	<h1 class="text-center">Visitas</h1>
	<h4>Filtros <i class="fa fa-filter"></i></h4>
	<form class="form-row form-filter" >
	<div class="form-group col">
	<label class="small">Desde</label> <input name="desde" class="form-control form-control-sm" type="date" name="" value="<?= $this->filtros['desde'] ?? '' ?>">
	</div>
	<div class="form-group col "> 
	<label class="small">Hasta</label> <input name="hasta" class="form-control form-control-sm" type="date" name="" value="<?= $this->filtros['hasta'] ?? '' ?>">
	</div>
			<?php $this->render_part("campoApartamento");?>
			<?php $this->render_part("campoVisitado");?>
	<div class="form-group col-md-2  mt-auto "> 
		<input class="btn btn-warning" type="submit" value="filtrar"/>
	</div>
	</form>
	<hr/>
<?php $this->render_part("table");?>
</div>
<?php $this->render_part("paginator");?>
</div>
<?php 

	}
}