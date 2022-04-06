<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creportes extends CI_Controller {
	public function __construct() {
		parent::__construct();

	
		$Session_covi=$this->session->userdata('usuario_covi');
		$co_rol = $Session_covi['co_rol'];
		$permiso=$this->Mseguridad_permisologia->getPermisos(5,$co_rol);
		if($co_rol==null){
			redirect('Clogin');
		}
		if ($permiso==0){
			show_404();
		}
	
		$this->load->library('form_validation');
		$this->load->model(array('Mmantenimiento_ud_tiempo','Mmantenimiento_planificacion','Mnagios'));
		$this->load->helper(array('fechas_helper','url'));
	}

	public function index()
	{
	//	$data=array('year'=>$this->Mmantenimiento_planificacion->year());
		$this->load->view('layout/header');
		$this->load->view('layout/body');

    $this->load->view('vreportes3'/*,$data*/);
		$this->load->view('layout/footer');
    }
    


    public function grafico_activo(){
		$data['planificada'] = $this->Mmantenimiento_planificacion->prueba0(2018);
		$planificada = array('name' =>'planificada','data'=> $this->Mmantenimiento_planificacion->prueba0(2018));
		$reprogramada = array('name' =>'reprogramada','data'=> $this->Mmantenimiento_planificacion->prueba(2018));
		$culminada = array('name' =>'culminada','data'=> $this->Mmantenimiento_planificacion->prueba2(2018));
//$visitas = array( 'name' => 'Visitas' , 'data' => array(103,474,402,536,1041,270,0,160,2462,3797,3527,4505,8090,7493,7048,11408,10886)) ;
//print_r($culminada);exit;
$meses = array('name' =>'meses','data'=>array('Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'));

$grafico = array();
array_push( $grafico, $meses);
array_push( $grafico, $planificada);
array_push( $grafico, $reprogramada);
array_push( $grafico, $culminada);


echo json_encode($grafico, JSON_NUMERIC_CHECK);
		/*
$this->load->view('layout/header');
$this->load->view('layout/body');
$this->load->view('vreportes0',$grafico,$meses);
$this->load->view('layout/footer');*/

$this->load->view('layout/header');
$this->load->view('layout/body');

$this->load->view('vreportes0'/*,$data*/);
$this->load->view('layout/footer');
}

	public function nagios(){
		$this->load->view('layout/header');
		$this->load->view('layout/body');
		
		$this->load->view('vrep_nagios'/*,$data*/);
		$this->load->view('layout/footer');
	}
public function getNagios(){
	//$year = $this->input->post("year");
	//$nombre=$this->input->post("nombre");
			$resultados = $this->Mnagios->registro(2018);
		//	print_r($resultados);exit;
		
			echo json_encode($resultados);
		}



public function estado_mtto(){
	$data=array('year'=>$this->Mmantenimiento_planificacion->year());
	$this->load->view('layout/header');
	$this->load->view('layout/body');

	$this->load->view('vrep_mtto',$data);
	$this->load->view('layout/footer');
}



public function getMtto(){
	$year = $this->input->post("year"); ///variable quje se esta enviado del combo box
	$resultados = $this->Mmantenimiento_planificacion->prueba2($year);
//	$resultados2 = $this->Mmantenimiento_planificacion->registro($year);
//	print_r($resultados2);exit;
//	print_r($resultados);exit;
	echo json_encode($resultados);

}

}
	/*public function getData(){
		$year = $this->input->post("year"); ///variable quje se esta enviado del combo box
		//$resultados = $this->Mmantenimiento_planificacion->registro2($year);
	//	$resultados = $this->Mmantenimiento_planificacion->registro($year);
		$resultados = $this->Mmantenimiento_planificacion->prueba0($year);
	//	print_r($resultados2);exit;
	//	print_r($resultados);exit;
		echo json_encode($resultados);
	}

	public function getData2(){
		$year = $this->input->post("year"); ///variable quje se esta enviado del combo box
		$resultados = $this->Mmantenimiento_planificacion->prueba($year);
	//	$resultados2 = $this->Mmantenimiento_planificacion->registro($year);
	//	print_r($resultados2);exit;
	//	print_r($resultados);exit;
		echo json_encode($resultados);
	}

	public function getData3(){
		$year = $this->input->post("year"); ///variable quje se esta enviado del combo box
		$resultados = $this->Mmantenimiento_planificacion->prueba2($year);
	//	$resultados2 = $this->Mmantenimiento_planificacion->registro($year);
	//	print_r($resultados2);exit;
	//	print_r($resultados);exit;
		echo json_encode($resultados);
	}*/



