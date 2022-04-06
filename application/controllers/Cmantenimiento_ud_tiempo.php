<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cmantenimiento_ud_tiempo extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$Session_covi=$this->session->userdata('usuario_covi');
		$co_rol = $Session_covi['co_rol'];
		$permiso=$this->Mseguridad_permisologia->getPermisos(6,$co_rol);
		if($co_rol==null){
			redirect('Clogin');
		}
		if ($permiso==0){
			show_404();
		}
		$this->load->library('form_validation');
		$this->load->model('Mmantenimiento_ud_tiempo');
		$this->load->helper(array('fechas_helper','url'));
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/body');
		$this->load->view('vmantenimiento_ud_tiempo');
		$this->load->view('layout/footer');
	}

public function ingresar(){

//$this->form_validation->set_rules('tx_tipo_parte','tipo de parte','required');

$config = array(
	
		   array(
			'field' => 'tx_unidad_tiempo',
			'label' => 'Unidad de Tiempo',
			'rules' => 'trim|required|alpha|callback_check_unidad_tiempo'
		   )
		);

$this->form_validation->set_rules($config);

if($this->form_validation->run() === FALSE){
	$this->form_validation->set_error_delimiters('','');
	validation_errors();
	$this->load->view('layout/header');
		$this->load->view('layout/body');
		$this->load->view('vmantenimiento_ud_tiempo');
		$this->load->view('layout/footer');
}
else{
$parametro['tx_unidad_tiempo'] =$this->input->post('tx_unidad_tiempo');
$this->Mmantenimiento_ud_tiempo->ingresar($parametro);
$this->session->set_flashdata('mensaje','exitoso');
	redirect('Cmantenimiento_ud_tiempo');    ////dsdsadasd
}	
}

public function check_unidad_tiempo($tx_unidad_tiempo){
//	$tx_clase_activo=strtoupper($this->input->post('tx_clase_activo',true));
	if($this->Mmantenimiento_ud_tiempo->check_unidad_tiempo($tx_unidad_tiempo)){
		$this->form_validation->set_message('check_unidad_tiempo', 'La Unidad de tiempo '.$tx_unidad_tiempo.' esta registrado en el sistema');
		return false;
	}
	else{
		return true;
	}
}

	public function tabla() 
	{
		$result = array('data' => array());

		$data = $this->Mmantenimiento_ud_tiempo->tabla();
		foreach ($data as $key => $value) {
			//$name = $value['tx_descripcion'] . ' ' . $value['tx_descripcion'];

			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Opcion <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a type="button" onclick="edit('.$value['co_unidad_tiempo'].')" data-toggle="modal" data-target="#editModal">Editar</a></li>
			    <li><a type="button" onclick="eliminar('.$value['co_unidad_tiempo'].')" data-toggle="modal" data-target="#removeModal">Eliminar</a></li>			    
			  </ul>
			</div>
			';

			$result['data'][$key] = array(
				$value['tx_unidad_tiempo'],          
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function obtener_tabla($co_unidad_tiempo) 
	{
		if($co_unidad_tiempo) {
			$data = $this->Mmantenimiento_ud_tiempo->tabla($co_unidad_tiempo);
			echo json_encode($data);
		}
	}

	/*
	public function edit($co_unidad_tiempo = null) 
	{
		if($co_unidad_tiempo) {
			$validator = array('success' => false, 'messages' => array());
	
$config = array(
		   array(
			'field' => 'edit_tx_unidad_tiempo',
			'label' => 'Unidad de tiempo',
			'rules' => 'trim|required|alpha|callback_check_unidad_tiempo'
		   )
		);

			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {

				$editMember = $this->Mmantenimiento_ud_tiempo->edit($co_unidad_tiempo); 
				if($editMember === true) {
					$validator['success'] = true;
				} else {
					$validator['success'] = false;
					
				}			
			} 
			else {
				$validator['success'] = false;
			
				foreach ($_POST as $key => $value) {
				
					$validator['messages'][$key] = form_error($key);	
				}			
			}

			echo json_encode($validator);
		}
	}*/

	public function edit($co_unidad_tiempo = null) 
	{
		if($co_unidad_tiempo) {
			$validator = array('success' => false, 'messages' => array());

			$config = array(
		   array(
        'field' => 'edit_tx_unidad_tiempo',
        'label' => 'Unidad de Tiempo',
        'rules' => 'trim|required|alpha|callback_check_unidad_tiempo'
	    )
		);

			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {

				$editMember = $this->Mmantenimiento_ud_tiempo->edit($co_unidad_tiempo); 

				if($editMember === true) {
					$validator['success'] = true;
					
				} else {
					$validator['success'] = false;
					
				}			
			} 
			else {
				$validator['success'] = false;
				foreach ($_POST as $key => $value) {
					$validator['messages'][$key] = form_error($key);	
				}			
			}

			echo json_encode($validator);
		}
	}
	

	public function eliminar($co_unidad_tiempo = null)
	{
		if($co_unidad_tiempo) {
			$validator = array('success' => false, 'messages' => array());

			$removeMember = $this->Mmantenimiento_ud_tiempo->eliminar($co_unidad_tiempo);
			if($removeMember === true) {
				$validator['success'] = true;
			}
			else {
				$validator['success'] = false;
			}
			echo json_encode($validator);
		}
	}


}
