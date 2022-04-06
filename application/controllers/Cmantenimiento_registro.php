<?php
/**
* 
*/
class Cmantenimiento_registro extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$Session_covi=$this->session->userdata('usuario_covi');
		$co_rol = $Session_covi['co_rol'];
		$permiso=$this->Mseguridad_permisologia->getPermisos(2,$co_rol);
		if($co_rol==null){
			redirect('Clogin');
		}
		if ($permiso==0){
			show_404();
		}
    $this->load->library('form_validation');
	$this->load->model(array('Mactivo_listado_activo','Mtipo_mto','Mmantenimiento_ud_tiempo','Mmantenimiento_tarea','Mmantenimiento_registro','Mtipo_mto','Mmantenimiento_planificacion'));
	$this->load->helper(array('fechas_helper','url'));

	}


	public function index(){
       $this->load->view('layout/header');
	   $this->load->view('layout/body');
	//   $data['activo']=1;
	   $data['buscar_tarea']=$this->Mmantenimiento_tarea->buscar_tarea();
	   $data['combo_ud_tiempo']=$this->Mmantenimiento_ud_tiempo->combo_ud_tiempo();
	   $data['combo_nivel_mtto']=$this->Mtipo_mto->combo_nivel_mtto();
		$this->load->view('vmantenimiento_registro',$data);
          $this->load->view('layout/footer');
        
	}



	public function ingresar(){

		$data = array(
			'co_activo' => $this->input->post('co_activo'),
			'co_tipo_mtto' => $this->input->post('co_tipo_mtto'),
			'nu_frecuencia_mtto' => $this->input->post('nu_frecuencia_mtto'),
			'co_unidad_tiempo' => $this->input->post('co_unidad_tiempo'),
			'co_tarea_mtto' => $this->input->post('co_tarea_mtto')
		);
 $lastId=$this->Mmantenimiento_registro->ingresar($data);

 if ($lastId > 0) {
	$data = array(
		'co_frecuencia_mtto' =>$lastId,
		'in_estado_mtto'=>0
	);
	$che=$this->Mmantenimiento_planificacion->ID($data);
	//print_r($che); exit;
	$this->session->set_flashdata('mensaje3','exitoso');
}
redirect('Cmantenimiento_registro');
	}

	public function tabla() 
	{
		$result = array('data' => array());
		$data = $this->Mactivo_clase_activo_detalle->tabla();
		foreach ($data as $key => $value) {
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

/*
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
	*/
//nueva funcion agregadala anterior (encontrar==1)queda en desuso

public function frecuencia(){
$frecuencia=$this->input->post('nu_frecuencia_mtto');
 $tiempo=$this->input->post('co_unidad_tiempo');
	if($frecuencia>1&&$tiempo==3){
		$this->form_validation->set_message('frecuencia', 'No se puede realizar varias frecuencia diarias.');
		return false;
	}
	else{
		return true;
	}
}
	public function encontrar_asig_activo($valor){
		//	$valor=strtoupper($this->input->post('tx_serial',true));
			if($valor=$this->Mactivo_listado_activo->check_encontrar_asig_activo($valor)){
				if($valor==1){
					$this->form_validation->set_message('encontrar_asig_activo', 'El serial o la etiqueta del activo no fue encontrado.');
					return false;
				}
				if($valor==2){
				$this->form_validation->set_message('encontrar_asig_activo', 'El  activo no tiene asignado el tipo de activo, por favor ingrese al menu Activo -> Listados de Activos y seleccione el tipo y clase de activo en la opción editar.');
				return false;
				}
			}
			else{
				return true;
			}
		}
	public function buscar_activo(){
		$config = array(
			
				   array(
					'field' => 'tx_serial',
					'label' => 'Serial o Etiqueta',
					'rules' => 'trim|required|alpha_numeric|callback_encontrar_asig_activo'
				   ),
				   array(
					'field' => 'nu_frecuencia_mtto',
					'label' => 'Invervalo',
					'rules' => 'trim|required|is_natural_no_zero|less_than[4]|callback_frecuencia'
				   )
				);
				$this->form_validation->set_rules($config);
				
				if($this->form_validation->run() === FALSE){
					$this->form_validation->set_error_delimiters('','');
					validation_errors();
					$this->load->view('layout/header');
					$this->load->view('layout/body');
				//	$data['activo']=1;
					$data['buscar_tarea']=$this->Mmantenimiento_tarea->buscar_tarea();
					$data['combo_ud_tiempo']=$this->Mmantenimiento_ud_tiempo->combo_ud_tiempo();
					$data['combo_nivel_mtto']=$this->Mtipo_mto->combo_nivel_mtto();
					 $this->load->view('vmantenimiento_registro',$data);
					   $this->load->view('layout/footer');
				}
				else {
					$valor=$this->input->post("tx_serial");
					$encontrar=$this->Mactivo_listado_activo->encontrar_activo($valor);
					//print_r($encontrar);exit;
					if($encontrar==1){
		$co_tipo_mtto=$this->input->post('nu_nivel_mtto');//recibe el codigo tipo mtto
		$nu_nivel_mtto=$this->Mtipo_mto->buscar_nivel_mtto($co_tipo_mtto);//obtiene nivel mtto
		// DATOS DEL ACTIVO
		
		$valor=$this->input->post("tx_serial");//ZUHJHTJC103544
		$encontrar=$this->Mactivo_listado_activo->encontrar_activo($valor);

	//	print_r($co_tipo_mtto);exit();
		$activo=$this->Mactivo_listado_activo->buscar_activo($valor);// ( [co_activo] => 86570 [tx_serial] => ZUHJHTJC103544 [tx_etiqueta] => [co_clase_activo_detalle] => 8 ) )
		//evitar error 
		//$verificar_asignacion_activo=$this->Mactivo_listado_activo->encontrar_asig_activo($valor);
		//print_r($verificar_asignacion_activo);exit();

	$tabla=$this->Mmantenimiento_tarea->buscar_tarea_tipo_activo_nivel_mtto($nu_nivel_mtto['nu_nivel_mtto'],$activo['co_clase_activo_detalle']);
	//	print_r($nu_nivel_mtto['nu_nivel_mtto']);exit(); 
		//Busca las tareas de acuerdo al nivel de mtto y tipo de activo
		/*$result = array('data' => array());
		
	//	print_r($data);exit(); 
	foreach ($data as $key => $value) { //key retorna el index elemento posicion del arreglo
		$result['data'][$key] = array(
			$value['tx_tarea_mtto'],
			$value['tx_descripcion_mtto'], 
			$value['nu_tiempo_tarea']
	
		);
		}//print_r($value['tx_tarea_mtto']);exit(); 
		echo json_encode($result);*/
	//	print_r($data['tabla']);exit();
		$co_activo=$activo['co_activo'];
	//	print_r($co_activo);exit();
	$this->session->set_flashdata('mensaje2','');
		$this->load->view('layout/header');
		$this->load->view('layout/body');
		$combo_ud_tiempo=$this->Mmantenimiento_ud_tiempo->combo_ud_tiempo();
		$combo_nivel_mtto=$this->Mtipo_mto->combo_nivel_mtto();
		$this->load->view('vmantenimiento_registro',compact('co_activo','combo_ud_tiempo','combo_nivel_mtto','tabla'));
		//$data['buscar_tarea']=$this->Mmantenimiento_tarea->buscar_tarea();
		//$data['combo_ud_tiempo']=$this->Mmantenimiento_ud_tiempo->combo_ud_tiempo();
		//$data['combo_nivel_mtto']=$this->Mtipo_mto->combo_nivel_mtto();
	//	$activo['buscar_activo']=$this->Mactivo_listado_activo->buscar_activo($valor);
	//$data['combo_nivel_mtto']=$this->Mtipo_mto->combo_nivel_mtto();
		// $this->load->view('vmantenimiento_registro',compact('activo'),$data);
		   $this->load->view('layout/footer');
	}
	//encontrar
	if($encontrar!=1){
		$this->session->set_flashdata('mensaje2','exitoso');
		$this->load->view('layout/header');
		$this->load->view('layout/body');
		//echo'<script>alert(El serial o etiqueta del activo no fue encontrado")</script>';
	//	$data['js'] = '<script>alert("hello")</script>';
//	$data['activo']=0;
		$data['buscar_tarea']=$this->Mmantenimiento_tarea->buscar_tarea();
		$data['combo_ud_tiempo']=$this->Mmantenimiento_ud_tiempo->combo_ud_tiempo();
		$data['combo_nivel_mtto']=$this->Mtipo_mto->combo_nivel_mtto();
		 $this->load->view('vmantenimiento_registro',$data);
		   $this->load->view('layout/footer');
		//   print "<script type=\"text/javascript\">alert('El serial o etiqueta del activo no fue encontrado');</script>";
	}

	}

	}
}