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
		$user = UserModel::user_logged();
		if(is_null($user)){
			header('location: /login/');
			return;
		}
		$id = $_POST['identificacion'];
		$apartamento  = $_POST['apartamento'];
		$visitado = $_POST['visitado'];
		$vis = new HabitanteModel();
		$vis->ID = $visitado; 
		$nombre = $_POST['nombre'];
		$foto = $_POST['foto'];
		$visita  = new VisitaModel();
		$visita->nombre = $nombre;
		$a = new ApartamentoModel();
		$a->ID = $apartamento;
		$visita->destino= $a;
		$visita->foto = $foto;
		$visita->visitado = $vis;
		$visita->cliente = $user;
		$visita->save();
		header('location: /');
	}
}