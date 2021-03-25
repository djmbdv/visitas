<?php



require_once "core/Controller.php";
require_once "config.php";
/**
 * 
 */
class FotoController extends ControllerRest
{

	public function post($argument= null){
		$user = UserModel::user_logged();
		if(is_null($user)){
			header('location: /login/');
			return;
		}
		$id = $_POST['identificacion'];
		$apartamento  = $_POST['apartamento'];
		$visitado = $_POST['visitado'];
		$nombre = $_POST['nombre'];
		$vista = new FotoView(array('id'=>$id,'user'=>$user,'apartamento'=>$apartamento,'visitado'=>$visitado,'nombre'=>$nombre ));
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
		$foto = explode(',',$foto)[1];
		$foto = base64_decode($foto);
		imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
        $link = "/_static/fotos/".uniqid().".png";
		$filename = Config::$base_folder. $link;
		$ifp = fopen(  $filename, 'wb' ); 
		
		fwrite($ifp,$foto);
		fclose($ifp);
		
		list($ancho, $alto) = getimagesize($filename);
		$origen = imagecreatefromjpeg($filename);
		$thumb = imagecreatetruecolor(400,(400/ancho)*alto);
		$origen = imagecreatefrompng($filename);


		$visita->visitado = $vis;
		$visita->cliente = $user;
		$visita->foto = Config::$base_url.$link;
		$visita->save();
		header('location: /');
	}
}