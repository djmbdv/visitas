<?php
require_once "core/Controller.php";
require_once "core/Session.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Html;
/**
 * 
 */
class VisitasController extends ControllerRest
{
	function get(){
		Session::load();
		VisitaModel::create_table();
		$user = UserModel::user_logged();
		if(is_null($user)){
			header('location: /login/');
			return;
		}
		if(Session::g('control_visitas')){
			header('location: /');
			return;
		}
		
		$headers  = VisitaModel::get_vars();
		$headers[] = "fecha";
		$page = $this->get_param("page");
		$desde = $this->get_param("desde");
		$hasta = $this->get_param("hasta");
		$apartamento =  $this->get_param("apartamento");
		$visitado = $this->get_param("visitado");
		$page = $page?$page:1;
		if(!$user->is_admin()){
			$condicion = [['cliente','=',$user->get_key()]];
            if($visitado)$condicion[]=["visitado",'=',$visitado];
            if($desde)$condicion[]=["create_at",'>=', $desde];
            if($hasta)$condicion[]=["create_at", '<=',$hasta.=" 23:59:59"];
			$vars = array_filter(VisitaModel::get_vars(),function($a){ return $a != 'cliente';});
			$count = VisitaModel::count($condicion);
			$items = VisitaModel::all_where_and($condicion,20,$page);	
		}else{
			$condicion = [];
			if($visitado)$condicion[]=["visitado",'=',$visitado];
            if($desde)$condicion[]=["create_at",'>=', $desde];
            if($hasta)$condicion[]=["create_at", '<=',$hasta.=" 23:59:59"];
			$vars = VisitaModel::get_vars();
			$count = VisitaModel::count($condicion);
			$items = VisitaModel::all_where_and($condicion,20,$page);
		}
		$vv = new VisitasView(array(
			'items' => $items,
			'filtros'=> ['desde' => $desde ,'hasta' => $hasta ,'visitado' => $visitado,'apartamento'=>$apartamento],
			'user'=> $user,
			"table_vars" => $vars,
			'page'=> $page,
			'count'=>$count,
            'hide_modified' => true,
            'hide_actions' => true
		));
		return $vv->render();
	}

	function reporte(){
		Session::load();
		$user = UserModel::user_logged();
		$spreadsheet = new Spreadsheet();
		$cc = [];
		$desde = $this->get_param("desde");
		$hasta = $this->get_param("hasta");
		if(!$user->is_admin()){
			$cc = [['cliente','=',$user->get_key()]];
		}
		$condv = $cc;
		if($desde)$condv[]=["create_at",'>=', $desde];
        if($hasta)$condv[]=["create_at", '<=',$hasta.=" 23:59:59"];
		$apartamento =  $this->get_param("apartamento");

		$edi =  EdificioModel::all_where_and($cc,null,true);
	//	$sheet = $spreadsheet->getActiveSheet();
		foreach ($edi as $edificio) {
			$linea = 1;
			$myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet,$edificio->nombre);
			$condicion = $cc;
			$condicion[] = ["edificio", "=","{$edificio->ID}"];
			$apartamentos = ApartamentoModel::all_where_and($condicion,null,null, false);
			$myWorkSheet->setCellValue('C'.$linea, "NOMBRE");
			$myWorkSheet->setCellValue('B'.$linea, "IDENTIFICACIÓN");
			$myWorkSheet->setCellValue('A'.$linea, "FECHA");
			$myWorkSheet->setCellValue('D'.$linea, "DESTINO");
			$linea++;
			foreach ($apartamentos as $apartamento) {
				$cond = $condv;
				$cond[] = ["destino","=","{$apartamento->ID}"];
				$visitas = VisitaModel::all_where_and($cond,null,null,true);
				foreach ($visitas as $visita) {
					$myWorkSheet->setCellValue('C'.$linea, $visita->nombre);
					$myWorkSheet->setCellValue('B'.$linea, $visita->identificacion);
					$myWorkSheet->setCellValue('A'.$linea, $visita->get_create_at());
					$myWorkSheet->setCellValue('D'.$linea, $visita->destino->load()->nombre);
					$linea++;
				}
					
			}
			$spreadsheet->addSheet($myWorkSheet);
		}

		$spreadsheet->removeSheetByIndex(0);
		$writer = new Html($spreadsheet);
		$file  = "_static/reporte".uniqid().".html";
		$writer->save($file);
		echo file_get_contents($file);
		unlink($file);
	}
}