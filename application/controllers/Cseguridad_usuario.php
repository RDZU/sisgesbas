<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cseguridad_usuario extends CI_Controller {
	public function __construct() {
		parent::__construct();
	
		$Session_covi=$this->session->userdata('usuario_covi');
		$co_rol = $Session_covi['co_rol'];
		$permiso=$this->Mseguridad_permisologia->getPermisos(4,$co_rol);
		if($co_rol==null){
			redirect('Clogin');
		}
		if ($permiso==0){
			show_404();
		}
		$this->load->library('form_validation');
		$this->load->model(array('Mseguridad_usuario','Mseguridad_persona','Mseguridad_nivel_usuario'));
		$this->load->helper(array('fechas_helper','url'));
	}
	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/body');
		$data['usuarioPDVSA']=$this->Mseguridad_persona->usuarioPDVSA();
		$data['combo_nivel_acceso']=$this->Mseguridad_nivel_usuario->combo_nivel_acceso();
		$this->load->view('vseguridad_usuario',$data);
		$this->load->view('layout/footer');
	}

	public function ingresar(){
$config = array(
		   array(
        'field' => 'tx_nombre',
        'label' => 'Nombre',
        'rules' => 'required'
	    ),
		 array(
        'field' => 'tx_apellido',
        'label' => 'Apellido',
        'rules' => 'required'
		),
		array(
			'field' => 'tx_indicador',
			'label' => 'Indicador de red',
			'rules' => 'required|callback_check_indicador'
			),
		array(
		'field' => 'co_nivel_usuario',
        'label' => 'Nivel de Usuario',
        'rules' => 'required'
		)
		);
		
		//;echo form_textarea($config);
$this->form_validation->set_rules($config);
if($this->form_validation->run() === false) {
	$this->form_validation->set_error_delimiters('','');
 validation_errors();
		$this->load->view('layout/header');
		$this->load->view('layout/body');
		$data['usuarioPDVSA']=$this->Mseguridad_persona->usuarioPDVSA();
		$data['combo_nivel_acceso']=$this->Mseguridad_nivel_usuario->combo_nivel_acceso();
		$this->load->view('vseguridad_usuario',$data);
		$this->load->view('layout/footer');

}
else{
$parametro['tx_nombre'] = $this->input->post('tx_nombre');
$parametro['tx_apellido'] = $this->input->post('tx_apellido');
$parametro['tx_indicador'] = $this->input->post('tx_indicador');
$parametro['co_nivel_usuario'] = $this->input->post('co_nivel_usuario');
$validacion=$this->Mseguridad_usuario->ingresar($parametro);
$this->session->set_flashdata('mensaje','exitoso');
redirect('Cseguridad_usuario');	
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


public function check_indicador($tx_indicador){
	if($this->Mseguridad_usuario->check_indicador($tx_indicador)){
		$this->form_validation->set_message('check_indicador', 'El indicador de red '.$tx_indicador.' esta registrado en el sistema');
		return false;
	}
	else{
		return true;
	}
}

	public function tabla() 
	{
		$result = array('data' => array());

		$data = $this->Mseguridad_usuario->tabla();
		foreach ($data as $key => $value) {
			//$name = $value['tx_descripcion'] . ' ' . $value['tx_descripcion'];

			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Opcion <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a type="button" onclick="edit('.$value['co_usuario'].')" data-toggle="modal" data-target="#editModal">Editar</a></li>
			    <li><a type="button" onclick="eliminar('.$value['co_usuario'].')" data-toggle="modal" data-target="#removeModal">Eliminar</a></li>			    
			  </ul>
			</div>
			';

			$result['data'][$key] = array(
				$value['tx_nombre'],
				$value['tx_apellido'],
				$value['tx_indicador'],
				$value['tx_nivel'],
				
				                //revisar
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function obtener_tabla($co_usuario) 
	{
		if($co_usuario) {
			$data = $this->Mseguridad_usuario->tabla($co_usuario);
			echo json_encode($data);
		}
	}

		public function edit($co_usuario = null) 
	{
		if($co_usuario) {
			$validator = array('success' => false, 'messages' => array());

			$config = array(
		   array(
        'field' => 'edit_co_nivel_usuario',
        'label' => 'Nivel de Usuario',
        'rules' => 'trim|required'
	    )
		);

			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {

				$editMember = $this->Mseguridad_usuario->edit($co_usuario); 

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

	public function eliminar($co_usuario = null)
	{
		if($co_usuario) {
			$validator = array('success' => false, 'messages' => array());

			$removeMember = $this->Mseguridad_usuario->eliminar($co_usuario);
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
