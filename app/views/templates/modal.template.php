<?php
class ModalTemplate extends Template{
	public $camara;

function config(){
	$this->camara = false;
	foreach ($this->T("modal_vars") as $v){
		preg_match("/([\S]*)Model/", $this->T("modal_class")::get_attribute_class($v), $matches);
		//var_dump($this->T("modal_class")::get_attribute_class('tipo'));
		$campo = array('name' => "$v" ,
				'label' => ucfirst($v),
		 		'autocomplete' => is_subclass_of($this->T("modal_class")::get_attribute_class($v), 'Model'),
		 		'required' => true,
		 		'placeholder'=> $this->T("modal_class")::search_description($v),
		 		'end_point'=> isset($matches[1])? '/api/'.strtolower($matches[1]).'/':null,
		 		'autocomplete_att'=>'s',
		 		'form_type' => $this->T("modal_class")::search_attribute_form_type($v)
		  ); 
		if($campo['form_type'] == 'foto')$this->camara = true; 
		$this->add_part("campo".ucfirst($v),"campo",
		 $campo
		);
		//var_dump($campo);
	}
}
	
function render(){?>
	<div class="modal <?= $this->camara ? "modal-camara":"" ?> fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Datos de <?= $this->T("title") ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form id="form-modal" method="post">
			  <?php foreach ($this->T("modal_vars") as $v):
			  	$this->render_part("campo".ucfirst($v));
			  	?>
			  <?php endforeach; ?>
			 </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	        <button type="button" class="btn btn-primary save-modal">Guardar</button>
	      </div>
	    </div>
	  </div>
	</div>

<?php
	}
}