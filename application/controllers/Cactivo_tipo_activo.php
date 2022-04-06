<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cactivo_tipo_activo extends CI_Controller {
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
		$this->load->model('Mactivo_clase_activo');
		$this->load->helper(array('fechas_helper','url'));
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/body');
		$this->load->view('vactivo_clase_activo');
		$this->load->view('layout/footer');
	}

public function ingresar(){

//$this->form_validation->set_rules('tx_tipo_parte','tipo de parte','required');

$config = array(
		   array(
        'field' => 'tx_clase_activo',
        'label' => 'Clase de Activo',
        'rules' => 'trim|callback_alpha_dash_space|callback_check_tipo_activo'
		   ),
		   array(
			'field' => 'tx_abreviatura',
			'label' => 'Abreviatura',
			'rules' => 'trim|required|alpha|exact_length[2]|callback_check_abreviatura'
		   )
		);

$this->form_validation->set_rules($config);

if($this->form_validation->run() === FALSE){
	$this->form_validation->set_error_delimiters('','');
	validation_errors();
	$this->load->view('layout/header');
		$this->load->view('layout/body');
		$this->load->view('vactivo_clase_activo');
		$this->load->view('layout/footer');
}
else{
	//strtoupper($this->input->post('tx_serial',true));
$parametro['tx_clase_activo'] =$this->input->post('tx_clase_activo');
$parametro['tx_abreviatura'] =$this->input->post('tx_abreviatura');
$this->Mactivo_clase_activo->ingresar($parametro);
$this->session->set_flashdata('mensaje','exitoso');
	redirect('Cactivo_tipo_activo');    ////dsdsadasd
}	
}

function alpha_dash_space($fullname){
    if (! preg_match('/^[a-zA-Z\s]+$/', $fullname)) {
        $this->form_validation->set_message('alpha_dash_space', 'El campo %s es obligatorio y sólo puede contener caracteres alfabéticos');
        return FALSE;
    } else {
        return TRUE;
    }
}


public function check_tipo_activo($tx_clase_activo){
//	$tx_clase_activo=strtoupper($this->input->post('tx_clase_activo',true));
	if($this->Mactivo_clase_activo->check_tipo_activo($tx_clase_activo)){
		$this->form_validation->set_message('check_tipo_activo', 'El tipo de activo '.$tx_clase_activo.' esta registrado en el sistema');
		return false;
	}
	else{
		return true;
	}
}

public function check_tipo_activo_edit($tx_clase_activo){
	$id=$this->uri->segment(3);
		if($this->Mactivo_clase_activo->check_tipo_activo_edit($id,$tx_clase_activo)){
			$this->form_validation->set_message('check_tipo_activo_edit', 'El tipo de activo '.$tx_clase_activo.' esta registrado en el sistema');
			return false;
		}
		else{
			return true;
		}
	}

	public function check_abreviatura_edit($tx_abreviatura){
		$id=$this->uri->segment(3);
			if($this->Mactivo_clase_activo->check_abreviatura_edit($id,$tx_abreviatura)){
				$this->form_validation->set_message('check_abreviatura_edit', 'La abreviatura '.$tx_abreviatura.' esta registrado en el sistema');
				return false;
			}
			else{
				return true;
			}
		}

public function check_abreviatura($tx_abreviatura){
//	$tx_abreviatura=strtoupper($this->input->post('tx_abreviatura',true));
	if($this->Mactivo_clase_activo->check_abreviatura($tx_abreviatura)){
		$this->form_validation->set_message('check_abreviatura', 'La abreviatura '.$tx_abreviatura.' esta registrado en el sistema');
		return false;
	}
	else{
		return true;
	}
}

	



	public function tabla() 
	{
		$result = array('data' => array());

		$data = $this->Mactivo_clase_activo->tabla();
		foreach ($data as $key => $value) {
			//$name = $value['tx_descripcion'] . ' ' . $value['tx_descripcion'];

			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Opcion <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a type="button" onclick="edit('.$value['co_clase_activo'].')" data-toggle="modal" data-target="#editModal">Editar</a></li>
			    <li><a type="button" onclick="eliminar('.$value['co_clase_activo'].')" data-toggle="modal" data-target="#removeModal">Eliminar</a></li>			    
			  </ul>
			</div>
			';

			$result['data'][$key] = array(
				$value['tx_clase_activo'],
				$value['tx_abreviatura'],             
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function obtener_tabla($co_clase_activo) 
	{
		if($co_clase_activo) {
			$data = $this->Mactivo_clase_activo->tabla($co_clase_activo);
			echo json_encode($data);
		}
	}

	
	public function edit($co_clase_activo = null) 
	{
		if($co_clase_activo) {
			$validator = array('success' => false, 'messages' => array());

			$config = array(
		   array(
        'field' => 'edit_tx_clase_activo',
        'label' => 'Clase activo',
        'rules' => 'trim|callback_alpha_dash_space|callback_check_tipo_activo_edit'
	    ),
		array(
        'field' => 'edit_tx_abreviatura',
        'label' => 'Abreviatura',
        'rules' => 'trim|required|alpha|exact_length[2]|callback_check_abreviatura_edit'
	    ),
		);

			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {

				$editMember = $this->Mactivo_clase_activo->edit($co_clase_activo); 
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


	public function eliminar($co_clase_activo = null)
	{
		if($co_clase_activo) {
			$validator = array('success' => false, 'messages' => array());

			$removeMember = $this->Mactivo_clase_activo->eliminar($co_clase_activo);
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
