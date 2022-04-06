<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$private $permisos;
class Cseguridad_nivel_usuario extends CI_Controller {
//private $permisos;
	public function __construct() {
		 //crea la variable permisos
		parent::__construct();
	;
		$Session_covi=$this->session->userdata('usuario_covi');
		$co_rol = $Session_covi['co_rol'];
		$permiso=$this->Mseguridad_permisologia->getPermisos(4,$co_rol);
		if($co_rol==null){
			redirect('Clogin');
		}
		if ($permiso==0){
			show_404();
		}

	///	$this->permisos=$this->Backend_lib->control();
		$this->load->library('form_validation');
		$this->load->model('Mseguridad_nivel_usuario');
		$this->load->helper(array('fechas_helper','url'));
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/body');

		$this->load->view('vseguridad_nivel_usuario');
		$this->load->view('layout/footer');
	}

public function ingresar(){

//$this->form_validation->set_rules('tx_tipo_parte','tipo de parte','required');

$config = array(
		   array(
        'field' => 'tx_nivel',
        'label' => 'Nivel de usuario',
        'rules' => 'trim|required|callback_alpha_dash_space|callback_check_nivel_usuario'
		));

$this->form_validation->set_rules($config);
if($this->form_validation->run() === FALSE){
	$this->form_validation->set_error_delimiters('','');
$base= validation_errors();
		$this->load->view('layout/header');
		$this->load->view('layout/body');
		$this->load->view('vseguridad_nivel_usuario');
		$this->load->view('layout/footer');
}
else{
$parametro['tx_nivel'] =$this->input->post('tx_nivel');
$this->Mseguridad_nivel_usuario->ingresar($parametro);
$this->session->set_flashdata('mensaje','exitoso');
	redirect('Cseguridad_nivel_usuario'); 	
}		
}
	public function tabla() 
	{
		$result = array('data' => array());
		$data = $this->Mseguridad_nivel_usuario->tabla();
		foreach ($data as $key => $value) {
			//$name = $value['tx_descripcion'] . ' ' . $value['tx_descripcion'];
			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Opcion <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a type="button" onclick="edit('.$value['co_nivel_usuario'].')" data-toggle="modal" data-target="#editModal">Editar</a></li>
			    <li><a type="button" onclick="eliminar('.$value['co_nivel_usuario'].')" data-toggle="modal" data-target="#removeModal">Eliminar</a></li>			    
			  </ul>
			</div>
			';
			$result['data'][$key] = array(
				$value['tx_nivel'],
				                //revisar
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function obtener_tabla($co_nivel_usuario) 
	{
		if($co_nivel_usuario) {
			$data = $this->Mseguridad_nivel_usuario->tabla($co_nivel_usuario);
			echo json_encode($data);
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


public function check_nivel_usuario($tx_nivel){
	if($this->Mseguridad_nivel_usuario->check_nivel_usuario($tx_nivel)){
		$this->form_validation->set_message('check_nivel_usuario', 'El Nivel de usuario '.$tx_nivel.' esta registrado en el sistema');
		return false;
	}
	else{
		return true;
	}
}

	public function edit($co_nivel_usuario = null) 
	{
		if($co_nivel_usuario) {
			$validator = array('success' => false, 'messages' => array());

			$config = array(
		   array(
        'field' => 'edit_tx_nivel',
        'label' => 'Nivel de  usuario',
        'rules' => 'trim|required|callback_alpha_dash_space|callback_check_nivel_usuario'
	    )
		);

			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {

				$editMember = $this->Mseguridad_nivel_usuario->edit($co_nivel_usuario); 

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

	public function eliminar($co_nivel_usuario = null)
	{
		if($co_nivel_usuario) {
			$validator = array('success' => false, 'messages' => array());

			$removeMember = $this->Mseguridad_nivel_usuario->eliminar($co_nivel_usuario);
			if($removeMember === true) {
				$validator['success'] = true;
			
			}
			else {
				$validator['success'] = true;
			
			}

			echo json_encode($validator);
		}
	}


}
