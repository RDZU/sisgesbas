<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cseguridad_modulo extends CI_Controller {
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
		$this->load->model('Mseguridad_modulo');
		$this->load->helper(array('fechas_helper','url'));
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/body');
	//	$datos['titulo']='Validacion de formularios';
		$this->load->view('vseguridad_modulo');
		$this->load->view('layout/footer');
	}

public function ingresar(){
$config = array(
		   array(
        'field' => 'tx_modulo',
        'label' => 'Modulo',
        'rules' => 'trim|required|alpha|callback_check_modulo'
	    )
		);
$this->form_validation->set_rules($config);
if($this->form_validation->run() === FALSE){
$this->form_validation->set_error_delimiters('','');
 validation_errors();
	$this->load->view('layout/header');
		$this->load->view('layout/body');
		$this->load->view('vseguridad_modulo');
		$this->load->view('layout/footer');
}
else{
$parametro['tx_modulo'] =$this->input->post('tx_modulo');
$this->Mseguridad_modulo->ingresar($parametro);
$this->session->set_flashdata('mensaje','exitoso');
	redirect('Cseguridad_modulo');    ////dsdsadasd

}
}
public function check_modulo($tx_modulo){
	if($this->Mseguridad_modulo->check_modulo($tx_modulo)){
		$this->form_validation->set_message('check_modulo', 'El modulo '.$tx_modulo.' esta registrado en el sistema');
		return false;
	}
	else{
		return true;
	}
}


	public function tabla() 
	{
		$result = array('data' => array());

		$data = $this->Mseguridad_modulo->tabla();
		foreach ($data as $key => $value) {
			//$name = $value['tx_descripcion'] . ' ' . $value['tx_descripcion'];

			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Opcion <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a type="button" onclick="edit('.$value['co_modulo'].')" data-toggle="modal" data-target="#editModal">Editar</a></li>
			    <li><a type="button" onclick="eliminar('.$value['co_modulo'].')" data-toggle="modal" data-target="#removeModal">Eliminar</a></li>			    
			  </ul>
			</div>
			';

			$result['data'][$key] = array(
				$value['co_modulo'],
				$value['tx_modulo'],
				                //revisar
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function obtener_tabla($co_modulo) 
	{
		if($co_modulo) {
			$data = $this->Mseguridad_modulo->tabla($co_modulo);
			echo json_encode($data);
		}
	}

	public function edit($co_modulo = null) 
	{
		if($co_modulo) {
			$validator = array('success' => false, 'messages' => array());

			$config = array(
		   array(
        'field' => 'edit_tx_modulo',
        'label' => 'Modulo',
        'rules' => 'trim|required|alpha'
	    )
		);

			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {

				$editMember = $this->Mseguridad_modulo->edit($co_modulo); 

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

	public function eliminar($co_modulo = null)
	{
		if($co_modulo) {
			$validator = array('success' => false, 'messages' => array());

			$removeMember = $this->Mseguridad_modulo->eliminar($co_modulo);
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
