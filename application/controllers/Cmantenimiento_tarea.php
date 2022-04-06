<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cmantenimiento_tarea extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$Session_covi=$this->session->userdata('usuario_covi');
		$co_rol = $Session_covi['co_rol'];
		$permiso=$this->Mseguridad_permisologia->getPermisos(6,$co_rol);
		if($co_rol==null){
			redirect('Clogin');
		}
		if($co_rol==null){
			redirect('Clogin');
		}
		if ($permiso==0){
			show_404();
		}
		$this->load->library('form_validation');

		$this->load->model(array('Mmantenimiento_tarea','Mmantenimiento_herramienta','Mmantenimiento_herramienta_tarea','Mtipo_mto','Mactivo_clase_activo','Mmantenimiento_tarea_activo'));
		$this->load->helper(array('fechas_helper','url'));
	}

	public function index()
	{

		$this->load->view('layout/header');
		$this->load->view('layout/body');
		$data['combo_nivel_mtto']=$this->Mtipo_mto->combo_nivel_mtto();
		//print_r($data['combo_nivel_mtto']);exit;
		$this->load->view('vmantenimiento_tarea',$data);
		$this->load->view('layout/footer');
	}

public function ingresar(){

$config = array(
		   array(
        'field' => 'tx_mto_tarea',
        'label' => 'Tarea',
        'rules' => 'trim|required|callback_alpha_dash_space|callback_check_mtto'
	    ),
		 array(
        'field' => 'nu_tiempo_tarea',
        'label' => 'Tiempo de la tarea',
        'rules' => 'trim|required|min_length[3]|max_length[5]'
	    ),
		 array(
        'field' => 'tx_mto_descripcion',
        'label' => 'Descripcion de la tarea',
        'rules' => 'trim|required'
	    ),
		);
		
		//;echo form_textarea($config);
$this->form_validation->set_rules($config);
if($this->form_validation->run() === false) {
	$this->form_validation->set_error_delimiters('','');
 validation_errors();
		$this->load->view('layout/header');
		$this->load->view('layout/body');
		$data['combo_nivel_mtto']=$this->Mtipo_mto->combo_nivel_mtto();
		//print_r($data['combo_nivel_mtto']);exit;
		$this->load->view('vmantenimiento_tarea',$data);
		$this->load->view('layout/footer');

}
else{
$parametro['tx_mto_tarea'] = $this->input->post('tx_mto_tarea');
$parametro['tx_mto_descripcion'] = $this->input->post('tx_mto_descripcion');
$parametro['nu_tiempo_tarea'] = $this->input->post('nu_tiempo_tarea');
$parametro['co_tipo_mto'] = $this->input->post('co_tipo_mto');

$validacion=$this->Mmantenimiento_tarea->ingresar($parametro);
$this->session->set_flashdata('mensaje','exitoso');
redirect('Cmantenimiento_tarea');

	
}
}


public function check_mtto_edit($tx_mto_tarea){
	$id=$this->uri->segment(3);
	$co_tipo_mtto=$this->Mmantenimiento_tarea->nivel_mtto_edit($id);
	//print_r($nivel_mtto);exit;
//	print_r($tx_mto_tipo. ' '. $nu_mto_nivel);exit;
	if($this->Mtipo_mto->check_mtto_edit($id,$tx_mto_tarea,$co_tipo_mtto)){
		$this->form_validation->set_message('check_mtto_edit', 'El tipo de mantenimiento '.$tx_mto_tipo.' con el nivel de mantenimiento ya se encuentra registrado en el sistema');
		return false;
	}
	else{
		return true;
	}
}
public function check_mtto($tx_mto_tarea){
	$co_tipo_mto = $this->input->post('co_tipo_mto');
//	print_r($tx_mto_tipo. ' '. $nu_mto_nivel);exit;
	if($this->Mmantenimiento_tarea->check_mtto($tx_mto_tarea,$co_tipo_mto)){
		$this->form_validation->set_message('check_mtto', 'La tarea de mantenimiento '.$tx_mto_tarea.' con el tipo de mantenimiento  ya se encuentra registrado en el sistema');
		return false;
	}
	else{
		return true;
	}
}

function alpha_dash_space($fullname){
    if (! preg_match('/^[a-zA-Z\s]+$/', $fullname)) {
        $this->form_validation->set_message('alpha_dash_space', 'El campo %s solo puede contener caracteres alfabeticos y espacios en blanco');
        return FALSE;
    } else {
        return TRUE;
    }
}

	public function tabla() 
	{
		$result = array('data' => array());

		$data = $this->Mmantenimiento_tarea->tabla();
		foreach ($data as $key => $value) {
			//$name = $value['tx_descripcion'] . ' ' . $value['tx_descripcion'];
	$base=base_url();
			// button

//  <a type="button"  onclick="edit('.$value['co_frecuencia_mtto'].')" class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#editModal" href="" title="Editar Frecuencia."><i class="glyphicon  glyphicon glyphicon-time"></i></a>			
			$buttons = '
	
			 
			    <a type="button" title="Editar" onclick="edit('.$value['co_tarea_mtto'].')" data-toggle="modal" data-target="#editModal" class="btn btn-xs btn-primary"><i class="glyphicon  glyphicon glyphicon-edit"></i></a></li>
				<a type="button" title="Eliminar" onclick="eliminar('.$value['co_tarea_mtto'].')" data-toggle="modal" data-target="#removeModal" class="btn btn-xs btn-primary"><i class="glyphicon  glyphicon glyphicon-trash"></i></a></li>
				
				<a title="Asignar herramientas y/o materiales." class="btn btn-xs btn-primary" href="'.$base.'index.php/Cmantenimiento_tarea/herramienta/'.$value['co_tarea_mtto'].'" type="button"('.$value['co_tarea_mtto'].')"><i class="glyphicon glyphicon-wrench"></i></a>
				<a title="Asignar activos" class="btn btn-xs btn-primary" href="'.$base.'index.php/Cmantenimiento_tarea/tipo_activo/'.$value['co_tarea_mtto'].'" type="button"('.$value['co_tarea_mtto'].')"><i class="glyphicon glyphicon-plus"></i></a>		    
			
			</div>
			';

			$result['data'][$key] = array(
				$value['tx_tarea_mtto'],
				$value['tarea_descripcion'],
				$hora=date("H:i",strtotime($value['nu_tiempo_tarea'])),
				//$value['nu_tiempo_tarea'],
				$value['tx_tipo_mtto'],
				$value['nu_nivel_mtto'],
				                //revisar
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}




	public function obtener_tabla($co_mto_tarea) 
	{
		if($co_mto_tarea) {
			$data = $this->Mmantenimiento_tarea->tabla($co_mto_tarea);
			echo json_encode($data);
		}
	}

	public function edit($co_mto_tarea = null) 
	{
		if($co_mto_tarea) {
			$validator = array('success' => false, 'messages' => array());

			$config = array(
		   array(
        'field' => 'edit_tx_mto_tarea',
        'label' => 'Descripcion',
        'rules' => 'trim|required|callback_check_mtto_edit'
	    ),
		array(
        'field' => 'edit_nu_tiempo_tarea',
        'label' => 'Tiempo de la tarea',
        'rules' => 'trim|required'
	    ),
		 array(
        'field' => 'edit_tx_mto_descripcion',
        'label' => 'Descripcion de la tarea',
        'rules' => 'trim|required'
	    ),

		);

			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {

				$editMember = $this->Mmantenimiento_tarea->edit($co_mto_tarea); 

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


	public function eliminar($co_mto_tarea = null)
	{
		if($co_mto_tarea) {
			$validator = array('success' => false, 'messages' => array());

			$removeMember = $this->Mmantenimiento_tarea->eliminar($co_mto_tarea);
			if($removeMember === true) {
				$validator['success'] = true;
			
			}
			else {
				$validator['success'] = true;
				
			}

			echo json_encode($validator);
		}
	}



	/////////////////////////// VISTA HERRAMIENTAS TAREAS
public function herramienta($co_mto_tarea=null){
	if(!$co_mto_tarea){show_404();}
	$datos=$this->Mmantenimiento_tarea->obtenerId($co_mto_tarea);
	//$tabla=$this->Mmantenimiento_herramienta_tarea->tabla($co_mto_tarea);
	if(sizeof($datos)==0){show_404();}
	$nombre_tarea=$this->Mmantenimiento_herramienta_tarea->Nombre_tarea($co_mto_tarea);
	$buscar_herramienta=$this->Mmantenimiento_herramienta-> buscar_herramienta();
 	$tabla=$this->Mmantenimiento_herramienta_tarea->tabla($co_mto_tarea);
	 //print_r($data)
	$this->load->view('layout/header');
	$this->load->view('layout/body');
	$this->load->view('vmantenimiento_tarea_herramienta',compact('co_mto_tarea','buscar_herramienta','tabla','nombre_tarea'));
	$this->load->view('layout/footer');
}

public function lista_herramienta(){
//$co_herramienta= $this->input->post('co_herramienta');
//$tx_herramienta = $this->input->post('tx_herramienta');

$co_tarea_mtto=$this->input->post("co_mto_tarea");
$herramienta = $this->input->post("co_herramienta");
//print_r($co_tarea_mtto);exit;
/* $
$data = array(
	
	'co_herramienta'=>$co_herramienta,
	'tx_herramienta'=>$tx_herramienta
	);
*/

$this->insertar_herramientas($herramienta,$co_tarea_mtto);

//if($this->Mmantenimiento_herramienta_tarea->insertar($co_herramienta)){

//}else{
	
//}
redirect(base_url()."index.php/Cmantenimiento_tarea/herramienta/".$co_tarea_mtto);
}

protected function insertar_herramientas($herramienta,$co_tarea_mtto){

for ($i=0; $i <count($herramienta); $i++){
	$data= array(
		'co_herramienta'=>$herramienta[$i],
		'co_tarea_mtto'=>$co_tarea_mtto,
		
		);

		$this->Mmantenimiento_herramienta_tarea->insertar($data);
}
}


public function eliminar_herramienta ($co_tarea_mtto_herramienta){
if($co_tarea_mtto_herramienta){
	$co_tarea = $this->input->post('co_tarea');
	$removeMember = $this->Mmantenimiento_herramienta_tarea->eliminar_herramienta($co_tarea_mtto_herramienta);
	redirect(base_url()."index.php/Cmantenimiento_tarea/herramienta/".$co_tarea);
}

}
///////////////////////////////////VISTA ACTIVO TAREAS

public function tipo_activo($co_mto_tarea=null){
	if(!$co_mto_tarea){show_404();}
	//print_r($co_mto_tarea); exit();
	$this->Mmantenimiento_tarea->obtenerId($co_mto_tarea);
	$datos=$this->Mmantenimiento_tarea->obtenerId($co_mto_tarea);
	//$tabla=$this->Mmantenimiento_herramienta_tarea->tabla($co_mto_tarea);
	if(sizeof($datos)==0){show_404();}
//	$nombre_tarea=$this->Mmantenimiento_herramienta_tarea->Nombre_tarea($co_mto_tarea);
//	$buscar_herramienta=$this->Mmantenimiento_herramienta-> buscar_herramienta();
 	$tabla=$this->Mmantenimiento_tarea_activo->tabla($co_mto_tarea);
	 //print_r($data)
	$this->load->view('layout/header');
	$this->load->view('layout/body');
	$nombre_tarea=$this->Mmantenimiento_herramienta_tarea->Nombre_tarea($co_mto_tarea);
	$combo=$this->Mactivo_clase_activo->combo();
	
	//$this->load->view('vmantenimiento_tarea_herramienta',compact('co_mto_tarea','buscar_herramienta','tabla','nombre_tarea'));
	$this->load->view('vmantenimiento_tarea_activo',compact('co_mto_tarea','combo','nombre_tarea','tabla'));
	$this->load->view('layout/footer');


}
public function eliminar_tipo_activo ($co_tarea_mtto_activo){
	if($co_tarea_mtto_activo){
		$co_tarea = $this->input->post('co_tarea');
		$removeMember = $this->Mmantenimiento_tarea_activo->eliminar_tipo_activo($co_tarea_mtto_activo);
		redirect(base_url()."index.php/Cmantenimiento_tarea/tipo_activo/".$co_tarea);
	}
	}
public function get_tipo_activo(){
	$co_clase_activo= $this->input->post('co_clase_activo');
	if($co_clase_activo){
		$this->load->model('Mactivo_clase_activo_detalle');
		$tipo_activo= $this->Mactivo_clase_activo_detalle->get_tipo_activo($co_clase_activo);
	//	echo '<option value="0">Modelos</option>';
		foreach ($tipo_activo as $fila){
			echo '<option value="'.$fila->co_clase_activo_detalle.'">'.$fila->tx_clase_activo_detalle.'</option>';
		}
	}else {
	//	echo '<option value="0">Modelos</option>';
	}
}

public function ingresar_tarea_activo(){
	$data = array(
		'co_tarea_mtto' => $this->input->post('co_tarea_mtto'),
		'co_clase_activo_detalle' => $this->input->post('co_clase_activo_detalle'),
	);
$this->Mmantenimiento_tarea_activo->insertar($data);
redirect(base_url()."index.php/Cmantenimiento_tarea/tipo_activo/".$data['co_tarea_mtto']);
}

	


}
