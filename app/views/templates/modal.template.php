<?php
class ModalTemplate extends Template{


	function render(){?>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Datos de <?= $this->T("title") ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form>
			  <?php foreach ($this->T("modal_vars") as $v):?>
			  <div class="form-group">
			    <label for="campo<?= ucfirst($v) ?>"><?= ucfirst($v) ?></label>
			    <input type="email" class="form-control" id="campo<?= ucfirst($v) ?>" aria-describedby="<?= $v ?>Help" placeholder="<?= $this->T("modal_class")::search_description($v) ?>">
			    <small id="<?= $v ?>Help" class="form-text text-muted"></small>
			  </div>
			  <?php endforeach; ?>
			  <div class="form-group">
			    <label for="campoNombre">Foto</label>
			    <div id="captura"  class="m-2" style="border-radius: 10px;min-height: 250px; min-width: 250px;background-color: gray;" >
			    	<video id="video" style="width: 100%;"></video>
			    </div>
			    <a class="button-photo btn-sm m-2 btn-success text-center" style="margin-right: auto;margin-left: auto;">Tomar Captura</a>
			  </div>
			 </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	        <button type="button" class="btn btn-primary">Guardar</button>
	      </div>
	    </div>
	  </div>
	</div>

<?php
	}
}