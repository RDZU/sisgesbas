<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cmantenimiento_herramienta extends CI_Controller {
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
		$this->load->model('Mmantenimiento_herramienta');
		$this->load->helper(array('fechas_helper','url'));
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/body');
		$this->load->view('vmantenimiento_herramienta');
		$this->load->view('layout/footer');
	}

public function ingresar(){

//$this->form_validation->set_rules('tx_tipo_parte','tipo de parte','required');

$config = array(
	
		   array(
			'field' => 'tx_herramienta',
			'label' => 'Herramienta',
			'rules' => 'trim|required|callback_check_herramienta'
		   )
		);

$this->form_validation->set_rules($config);

if($this->form_validation->run() === FALSE){
	$this->form_validation->set_error_delimiters('','');
	validation_errors();
	$this->load->view('layout/header');
		$this->load->view('layout/body');
		$this->load->view('vmantenimiento_herramienta');
		$this->load->view('layout/footer');
}
else{
$parametro['tx_herramienta'] =$this->input->post('tx_herramienta',true);
$parametro['tx_tipo'] =$this->input->post('tx_tipo');
$this->Mmantenimiento_herramienta->ingresar($parametro);
$this->session->set_flashdata('mensaje','exitoso');
	redirect('Cmantenimiento_herramienta');    ////dsdsadasd
}	
}

public function check_herramienta_edit($tx_herramienta){
	$id=$this->uri->segment(3);
	//	$tx_clase_activo=strtoupper($this->input->post('tx_clase_activo',true));
		if($this->Mmantenimiento_herramienta->check_herramienta_edit($id,$tx_herramienta)){
			$this->form_validation->set_message('check_herramienta_edit', 'La herramienta '.$tx_herramienta.' esta registrado en el sistema');
			return false;
		}
		else{
			return true;
		}
	}


public function check_herramienta($tx_herramienta){
//	$tx_clase_activo=strtoupper($this->input->post('tx_clase_activo',true));
	if($this->Mmantenimiento_herramienta->check_herramienta($tx_herramienta)){
		$this->form_validation->set_message('check_herramienta', 'La herramienta '.$tx_herramienta.' esta registrado en el sistema');
		return false;
	}
	else{
		return true;
	}
}

	public function tabla() 
	{
		$result = array('data' => array());

		$data = $this->Mmantenimiento_herramienta->tabla();
		foreach ($data as $key => $value) {
			//$name = $value['tx_descripcion'] . ' ' . $value['tx_descripcion'];

			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Opcion <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a type="button" onclick="edit('.$value['co_herramienta'].')" data-toggle="modal" data-target="#editModal">Editar</a></li>
			    <li><a type="button" onclick="eliminar('.$value['co_herramienta'].')" data-toggle="modal" data-target="#removeModal">Eliminar</a></li>			    
			  </ul>
			</div>
			';

			$result['data'][$key] = array(
				$value['tx_herramienta'], 
				$value['tx_tipo'],         
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function obtener_tabla($co_herramienta) 
	{
		if($co_herramienta) {
			$data = $this->Mmantenimiento_herramienta->tabla($co_herramienta);
			echo json_encode($data);
		}
	}

	
	public function edit($co_herramienta = null) 
	{
		if($co_herramienta) {
			$validator = array('success' => false, 'messages' => array());
	
$config = array(
		   array(
			'field' => 'edit_tx_herramienta',
			'label' => 'Herramienta',
			'rules' => 'trim|required|callback_check_herramienta_edit'
		   )
		);

			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {

				$editMember = $this->Mmantenimiento_herramienta->edit($co_herramienta); 
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


	public function eliminar($co_herramienta = null)
	{
		if($co_herramienta) {
			$validator = array('success' => false, 'messages' => array());

			$removeMember = $this->Mmantenimiento_herramienta->eliminar($co_herramienta);
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
