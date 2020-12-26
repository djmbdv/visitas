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
			    <label for="campoNombre">Apartamento Destino</label>
			    <input type="email" class="form-control" id="campoNombre" aria-describedby="nombreHelp" placeholder="Nombre Completo">
			    <small id="nombreHelp" class="form-text text-muted">Ej. Fabián Espejo.</small>
			  </div>
			  <div class="form-group">
			    <label for="campoNombre">Foto</label>
			    <div class="m-2" style="border-radius: 10px;min-height: 250px; min-width: 250px;background-color: gray;" >
			    </div>
			    <button class="btn-sm m-2 btn-success text-center" style="margin-right: auto;margin-left: auto;">Tomar Captura</button>
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