<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Cmantenimiento_calendario extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$Session_covi=$this->session->userdata('usuario_covi');
		$co_rol = $Session_covi['co_rol'];
		$permiso=$this->Mseguridad_permisologia->getPermisos(2,$co_rol);
		if($co_rol==null){
			redirect('Clogin');
		}
		if ($permiso==0){
			show_404();
		}
        $this->load->library('form_validation');
		$this->load->model('Mmantenimiento_planificacion');
		$this->load->helper(array('fechas_helper','url'));
	}

	public function index(){
		$this->load->view('layout/header');
		$this->load->view('layout/body');
		$this->load->view('vmantenimiento_calendario');
		$this->load->view('layout/footer');
    }
    

public function getEventos(){
    $r= $this->Mmantenimiento_planificacion->getEventos();
    echo json_encode($r);
}

}