<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cseguridad_permisologia extends CI_Controller {
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
		$this->load->model (array('Mseguridad_nivel_usuario','Mseguridad_modulo','Mseguridad_permisologia'));
		$this->load->helper(array('fechas_helper','url'));
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/body');
	//	$datos['titulo']='Validacion de formularios';
$data['combo_rol']=$this->Mseguridad_nivel_usuario->combo_rol();
$data['combo_menu']=$this->Mseguridad_modulo->combo_menu();
		$this->load->view('vseguridad_permisologia',$data);
		$this->load->view('layout/footer');
	}



public function ingresar(){
	$config = array(
		array(
	 'field' => 'co_modulo',
	 'label' => 'Modulo',
	 'rules' => 'callback_datos_repetidos'
	 ));

$this->form_validation->set_rules($config);
if($this->form_validation->run() === FALSE){
 $this->form_validation->set_error_delimiters('','');
$base= validation_errors();
$this->load->view('layout/header');
$this->load->view('layout/body');
//	$datos['titulo']='Validacion de formularios';
$data['combo_rol']=$this->Mseguridad_nivel_usuario->combo_rol();
$data['combo_menu']=$this->Mseguridad_modulo->combo_menu();
$this->load->view('vseguridad_permisologia',$data);
$this->load->view('layout/footer');
}
else{
$parametro['co_nivel_usuario'] = $this->input->post('co_nivel_usuario');
$parametro['co_modulo'] = $this->input->post('co_modulo');
$parametro['in_insertar'] = $this->input->post('in_insertar');
$parametro['in_editar'] = $this->input->post('in_editar');
$parametro['in_eliminar'] = $this->input->post('in_eliminar');
$parametro['in_entrar'] = $this->input->post('in_entrar');
 $this->Mseguridad_permisologia->ingresar($parametro);	
redirect('Cseguridad_permisologia');

}

}


public function datos_repetidos(){

	$co_nivel_usuario = $this->input->post('co_nivel_usuario');
	$co_modulo = $this->input->post('co_modulo');
//	print_r($tx_mto_tipo. ' '. $nu_mto_nivel);exit;
	if($this->Mseguridad_permisologia->datos_repetidos($co_nivel_usuario,$co_modulo)){
		$this->form_validation->set_message('datos_repetidos', 'El Nivel de usuario y  el modulo seleccionado  ya se encuentra registrado en el sistema');
		return false;
	}
	else{
		return true;
	}
}
public function tabla() 
	{
		$result = array('data' => array());

		$data = $this->Mseguridad_permisologia->tabla();
		foreach ($data as $key => $value) {
			//$name = $value['tx_descripcion'] . ' ' . $value['tx_descripcion'];

			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Opcion <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a type="button" onclick="edit('.$value['co_permisologia'].')" data-toggle="modal" data-target="#editModal">Editar</a></li>
			    <li><a type="button" onclick="eliminar('.$value['co_permisologia'].')" data-toggle="modal" data-target="#removeModal">Eliminar</a></li>			    
			  </ul>
			</div>
			';

			$result['data'][$key] = array(
				$value['tx_nivel'],
				$value['tx_modulo'],
				//$value['in_insertar'],
				//$value['in_editar'],
				//$value['in_eliminar'],
				$value['in_entrar'],
				                //revisar
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function obtener_tabla($co_permisologia) 
	{
		if($co_permisologia) {
			$data = $this->Mseguridad_permisologia->tabla($co_permisologia);
			echo json_encode($data);
		}
	}


	public function edit($co_permisologia = null) 
	{
		if($co_permisologia) {
			$validator = array('success' => false, 'messages' => array());
	
$config = array(
		   array(
			'field' => 'edit_in_entrar',
			'label' => 'Modulo',
			'rules' => 'trim|required'
		   )
		);

			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {

				$editMember = $this->Mseguridad_permisologia->edit($co_permisologia); 
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
	public function eliminar($co_permisologia = null)
	{
		if($co_permisologia) {
			$validator = array('success' => false, 'messages' => array());

			$removeMember = $this->Mseguridad_permisologia->eliminar($co_permisologia);
			if($removeMember === true) {
				$validator['success'] = true;
				$validator['messages'] = "Registro eliminado";
			}
			else {
				$validator['success'] = true;
				$validator['messages'] = "Ha ocurrido un error";
			}

			echo json_encode($validator);
		}
	}



}
