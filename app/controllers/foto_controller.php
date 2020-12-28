<?php



require_once "core/Controller.php";


/**
 * 
 */
class FotoController extends ControllerRest
{

	public function post($argument= null){
		
		$id = $_POST['identificacion'];
		$apartamento  = $_POST['apartamento'];
		$visitado = $_POST['visitado'];
		$nombre = $_POST['nombre'];
		$vista = new FotoView(array('id'=>$id,'apartamento'=>$apartamento,'visitado'=>$visitado,'nombre'=>$nombre ));
		return $vista->render();
	}

	public function any($argument = null){
		header('location: /');
	}

	public function visita($argument = null){
		$id = $_POST['identificacion'];
		$apartamento  = $_POST['apartamento'];
		$visitado = $_POST['visitado'];
		$nombre = $_POST['nombre'];
		$foto = $_POST['foto'];
		$visita  = new VisitaModel();
		$visita->nombre = $nombre;
		$visita->destino= $apartamento;
		$visita->foto = $foto;
		$visita->visitado = $visitado;
		$visita->save();
		header('location: /');
	}
}