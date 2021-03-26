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
        $link = "/_static/fotos/".uniqid();
        $ext = ".png";
		
		$filename = Config::$base_folder. $link.$ext;
		$ifp = fopen(  $filename, 'wb' ); 
		
		fwrite($ifp,$foto);
		fclose($ifp);
		
		list($ancho, $alto) = getimagesize($filename);
		$origen = imagecreatefrompng($filename);
		$thumb = imagecreatetruecolor(400,(400/$ancho)*$alto);
		$ext = ".jpg";
		$filename = Config::$base_folder. $link.$ext;
		unlink($filename);
		imagecopyresized($thumb, $origen, 0, 0, 0, 0, 400, (400/$ancho)*$alto, $ancho, $alto);
		imagejpeg($thumb,$filename);
		$visita->visitado = $vis;
		$visita->cliente = $user;
		$visita->foto = Config::$base_url.$link.$ext;
		$visita->save();
		header('location: /');
	}
}