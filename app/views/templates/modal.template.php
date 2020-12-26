<?php
class ModalTemplate extends Template{


	function render(){?>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Ingrese los datos de la visita</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form>
			  <div class="form-group">
			    <label for="campoNombre">Nombre</label>
			    <input type="email" class="form-control" id="campoNombre" aria-describedby="nombreHelp" placeholder="Nombre Completo">
			    <small id="nombreHelp" class="form-text text-muted">Ej. Fabián Espejo.</small>
			  </div>
			  <div class="form-group">
			    <label for="campoNombre">Nombre</label>
			    <input type="email" class="form-control" id="campoNombre" aria-describedby="nombreHelp" placeholder="Nombre Completo">
			    <small id="nombreHelp" class="form-text text-muted">Ej. Fabián Espejo.</small>
			  </div>
			  <div class="form-group">
			    <label for="campoNombre">Foto</label>
			    <input type="email" class="form-control" id="campoNombre" aria-describedby="nombreHelp" placeholder="Nombre Completo">
			    <small id="nombreHelp" class="form-text text-muted">Ej. Fabián Espejo.</small>
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