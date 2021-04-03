<?php


require_once "core/Controller.php";
require_once "config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
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
		$visita->identificacion = $id;
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
		$vis->load();
		list($ancho, $alto) = getimagesize($filename);
		$origen = imagecreatefrompng($filename);
		$thumb = imagecreatetruecolor(400,(400/$ancho)*$alto);
		unlink($filename);
		$ext = ".jpg";
		$filename = Config::$base_folder. $link.$ext;
		
		imagecopyresized($thumb, $origen, 0, 0, 0, 0, 400, (400/$ancho)*$alto, $ancho, $alto);
		imagejpeg($thumb,$filename);
		$visita->visitado = $vis;
		$visita->cliente = $user;
		$user->load();
		$visita->foto = Config::$base_url.$link.$ext;
		$visita->save();
		$mail = new PHPMailer(true);
		try {
		    //Server settings
		    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		    $mail->isSMTP();                                            //Send using SMTP
		    $mail->Host       = Config::$mail_host;                     //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = "djmbdv@gmail.com";                     //SMTP username
		    $mail->Password   = "4363747rosy";                               //SMTP password
		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; 
		    $mail->Port       = Config::$mail_port;                                     //TCP port to connect to, use 465 
		    $mail->setFrom('djmbdv@gmail.com', 'David Marquez');
		    $mail->addAddress($vis->email, $vis->nombre);     //Add a recipient
	//	    $mail->addAddress('ellen@example.com');               //Name is optional
	//	    $mail->addReplyTo('info@example.com', 'Information');
		//    $mail->addCC('cc@example.com');
		//    $mail->addBCC('bcc@example.com');

		    //Attachments
			//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = 'Nueva Visita';
		    $mail->Body    = "<h1>Sistema de control de visitas</h1>"
		    ."<h2>{$user->titulo}</h2>"
		    .'<h3>Tiene una nueva visita <b>in bold!</b><h3>'
		    ."<p> Nombre: {$visita->nombre}";
		 //   $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		  //  echo 'Message has been sent';
		} catch (Exception $e) {
		    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		    return;
		}
		header('location: /saludo');
	}
}