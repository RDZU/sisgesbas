<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cactivo_clase_activo_detalle extends CI_Controller {
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
		$this->load->model(array('Mactivo_clase_activo','Mactivo_clase_activo_detalle'));
		$this->load->helper(array('fechas_helper','url'));
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/body');
        $data['combo']=$this->Mactivo_clase_activo->combo();
        $this->load->view('vactivo_clase_activo_detalle',$data);
		$this->load->view('layout/footer');
	}

public function ingresar(){

//$this->form_validation->set_rules('tx_tipo_parte','tipo de parte','required');

$config = array(
		   array(
        'field' => 'tx_clase_activo_detalle',
        'label' => 'Clase de Activo',
        'rules' => 'trim|callback_alpha_dash_space|callback_check_clase_activo'
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
        $data['combo']=$this->Mactivo_clase_activo->combo();
        $this->load->view('vactivo_clase_activo_detalle',$data);
		$this->load->view('layout/footer');
}
else{
$parametro['tx_clase_activo_detalle'] =$this->input->post('tx_clase_activo_detalle');
$parametro['tx_abreviatura'] =$this->input->post('tx_abreviatura');
$parametro['co_clase_activo'] =$this->input->post('co_clase_activo');
$this->Mactivo_clase_activo_detalle->ingresar($parametro);
$this->session->set_flashdata('mensaje','exitoso');
	redirect('Cactivo_clase_activo_detalle');    ////dsdsadasd
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


public function check_clase_activo($tx_clase_activo_detalle){
//	$tx_clase_activo=strtoupper($this->input->post('tx_clase_activo',true));
	if($this->Mactivo_clase_activo_detalle->check_clase_activo($tx_clase_activo_detalle)){
		$this->form_validation->set_message('check_clase_activo', 'El clase de activo '.$tx_clase_activo_detalle.' esta registrado en el sistema');
		return false;
	}
	else{
		return true;
	}
}


public function check_clase_activo_edit($tx_clase_activo_detalle){
	$id=$this->uri->segment(3);
		if($this->Mactivo_clase_activo_detalle->check_clase_activo_edit($id,$tx_clase_activo_detalle)){
			$this->form_validation->set_message('check_clase_activo_edit', 'El clase de activo '.$tx_clase_activo_detalle.' esta registrado en el sistema');
			return false;
		}
		else{
			return true;
		}
	}
public function check_abreviatura($tx_abreviatura){
//	$tx_abreviatura=strtoupper($this->input->post('tx_abreviatura',true));
	if($this->Mactivo_clase_activo_detalle->check_abreviatura($tx_abreviatura)){
		$this->form_validation->set_message('check_abreviatura', 'La abreviatura '.$tx_abreviatura.' esta registrado en el sistema');
		return false;
	}
	else{
		return true;
	}
}

public function check_abreviatura_edit($tx_abreviatura){
	$id=$this->uri->segment(3);
		//print_r($id);
		if($this->Mactivo_clase_activo_detalle->check_abreviatura_edit($id,$tx_abreviatura)){
			$this->form_validation->set_message('check_abreviatura_edit', 'La abreviatura '.$tx_abreviatura.' esta registrado en el sistema');
			return false;
		}
		else{
			return true;
		}
	}

	public function tabla() 
	{
		$result = array('data' => array());

		$data = $this->Mactivo_clase_activo_detalle->tabla();
		foreach ($data as $key => $value) {
			//$name = $value['tx_descripcion'] . ' ' . $value['tx_descripcion'];

			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Opcion <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a type="button" onclick="edit('.$value['co_clase_activo_detalle'].')" data-toggle="modal" data-target="#editModal">Editar</a></li>
			    <li><a type="button" onclick="eliminar('.$value['co_clase_activo_detalle'].')" data-toggle="modal" data-target="#removeModal">Eliminar</a></li>			    
			  </ul>
			</div>
			';

			$result['data'][$key] = array(
				$value['clase'],
                $value['abreviatura_clase'], 
                $value['tipo'],
                $value['abreviatura_tipo'],  
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function obtener_tabla($co_clase_activo_detalle) 
	{
		if($co_clase_activo_detalle) {
			$data = $this->Mactivo_clase_activo_detalle->tabla($co_clase_activo_detalle);
			echo json_encode($data);
		}
	}


	
	public function edit($co_clase_activo_detalle = null) 
	{
	//	check_abreviatura_edit(null,$co_clase_activo_detalle);
		if($co_clase_activo_detalle) {
			$validator = array('success' => false, 'messages' => array());

			$config = array(
		   array(
        'field' => 'edit_tx_clase_activo_detalle',
        'label' => 'Clase activo',
        'rules' => 'trim|callback_alpha_dash_space|callback_check_clase_activo_edit'
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

				$editMember = $this->Mactivo_clase_activo_detalle->edit($co_clase_activo_detalle); 
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


	public function eliminar($co_clase_activo_detalle = null)
	{
		if($co_clase_activo_detalle) {
			$validator = array('success' => false, 'messages' => array());

			$removeMember = $this->Mactivo_clase_activo_detalle->eliminar($co_clase_activo_detalle);
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
