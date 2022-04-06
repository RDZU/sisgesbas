<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctipo_mto extends CI_Controller {
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

		$this->load->model('Mtipo_mto');
		$this->load->helper(array('fechas_helper','url'));
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/body');
		$this->load->view('vtipo_mto');
		$this->load->view('layout/footer');
	}

public function ingresar(){
	$config = array(
		array(
	 'field' => 'tx_mto_tipo',
	 'label' => 'Tipo de mantenimiento',
	 'rules' => 'required|callback_check_mtto'
	 ),
	  array(
	 'field' => 'nu_mto_nivel',
	 'label' => 'Nivel de mantenimiento',
	 'rules' => 'required'
	 ),
	 array(
		 'field' => 'tx_mto_descripcion',
		 'label' => 'Descripcion del mantenimiento',
		 'rules' => 'trim|required'
		 )
	 );
	 $this->form_validation->set_rules($config);
	 if($this->form_validation->run() === false) {
		 $this->form_validation->set_error_delimiters('','');
	  validation_errors();
	  $this->load->view('layout/header');
	  $this->load->view('layout/body');
	  $this->load->view('vtipo_mto');
	  $this->load->view('layout/footer');
	 }
	 else{
$parametro['tx_mto_tipo'] = $this->input->post('tx_mto_tipo');
$parametro['nu_mto_nivel'] = $this->input->post('nu_mto_nivel');
$parametro['tx_mto_descripcion'] = $this->input->post('tx_mto_descripcion',true);
$this->Mtipo_mto->ingresar($parametro);
$this->session->set_flashdata('mensaje','exitoso');
redirect('Ctipo_mto');
	 }
	}

	public function check_mtto_edit($tx_mto_tipo){
		$id=$this->uri->segment(3);
		$nivel_mtto=$this->Mtipo_mto->nivel_mtto_edit($id);
		//print_r($nivel_mtto);exit;
	//	print_r($tx_mto_tipo. ' '. $nu_mto_nivel);exit;
		if($this->Mtipo_mto->check_mtto_edit($id,$tx_mto_tipo,$nivel_mtto)){
			$this->form_validation->set_message('check_mtto_edit', 'El tipo de mantenimiento '.$tx_mto_tipo.' y el nivel de mantenimiento '.$nivel_mtto.' ya se encuentra registrado en el sistema');
			return false;
		}
		else{
			return true;
		}
	}
	
	public function check_mtto(){
		$tx_mto_tipo = $this->input->post('tx_mto_tipo');
		$nu_mto_nivel = $this->input->post('nu_mto_nivel');
	//	print_r($tx_mto_tipo. ' '. $nu_mto_nivel);exit;
		if($this->Mtipo_mto->check_mtto($tx_mto_tipo,$nu_mto_nivel)){
			$this->form_validation->set_message('check_mtto', 'El tipo de mantenimiento '.$tx_mto_tipo.' y el nivel de mantenimiento '.$nu_mto_nivel.' ya se encuentra registrado en el sistema');
			return false;
		}
		else{
			return true;
		}
	}



	public function tabla() 
	{
		$result = array('data' => array());

		$data = $this->Mtipo_mto->tabla();
		foreach ($data as $key => $value) {
			//$name = $value['tx_descripcion'] . ' ' . $value['tx_descripcion'];

			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Opcion <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a type="button" onclick="edit('.$value['co_tipo_mtto'].')" data-toggle="modal" data-target="#editModal">Editar</a></li>
			    <li><a type="button" onclick="eliminar('.$value['co_tipo_mtto'].')" data-toggle="modal" data-target="#removeModal">Eliminar</a></li>			    
			  </ul>
			</div>
			';

			$result['data'][$key] = array(
				$value['tx_tipo_mtto'],
				$value['nu_nivel_mtto'],
				$value['tx_descripcion_mtto'],
				
				                //revisar
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function obtener_tabla($co_tipo_mtto) 
	{
		if($co_tipo_mtto) {
			$data = $this->Mtipo_mto->tabla($co_tipo_mtto);
			echo json_encode($data);
		}
	}


	public function edit($co_tipo_mtto = null) 
	{

		/*
{"success":false,"messages":{"edit_tx_herramienta":"
La herramienta DESTORNILLADOR esta registrado en el sistema<\/p>","edit_tx_tipo":""}}

{"success":false,"messages":{"edit_tx_mto_tipo":"","edit_nu_mto_nivel":"","edit_tx_mto_descripcion":"

El campo Descripcion es obligatorio.<\/p>"}}
		*/
		if($co_tipo_mtto) {
			$validator = array('success' => false, 'messages' => array());

			$config = array(
				array(
					'field' => 'edit_tx_mto_tipo',
					'label' => 'Tipo de Mantenimiento',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'edit_nu_mto_nivel',
					'label' => 'Intervalo',
					'rules' => 'trim|required|callback_check_mtto_edit'
				),
		   array(
        'field' => 'edit_tx_mto_descripcion',
        'label' => 'Descripcion',
        'rules' => 'trim|required'
	    )
		);

			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {

				$editMember = $this->Mtipo_mto->edit($co_tipo_mtto); 

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
	

	public function eliminar($co_tipo_mtto = null)
	{
		if($co_tipo_mtto) {
			$validator = array('success' => false, 'messages' => array());

			$removeMember = $this->Mtipo_mto->eliminar($co_tipo_mtto);
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
