<?php 
/**
* 
*/


class Cnagios extends CI_Controller
{
	function __construct()
	{
	
		parent::__construct();
		$Session_covi=$this->session->userdata('usuario_covi');
		$co_rol = $Session_covi['co_rol'];
		$permiso=$this->Mseguridad_permisologia->getPermisos(3,$co_rol);
		if ($permiso==0){
			show_404();
		}
    $this->load->library('form_validation');
	$this->load->model('Mnagios');
	$this->load->helper(array('fechas_helper','url'));
	}

	public function index(){
		//trae todos los registro de la tabla
	// obtenerdatos
      $this->load->view('layout/header');
	   $this->load->view('layout/body');
	  //$data['combo_catalogo']=$this->Minventario_catalogo->combo_catalogo();
	// $data['nagios']=$this->Mnagios->nagios();
		//print_r($data);exit;
	//	$this->load->view('vnagios',$data);
		//$this->load->view('vnagios2',$data);
		$data['tabla']=$this->Mnagios->tabla();
	$this->load->view('vnagios2'/*,$data*/);
    $this->load->view('layout/footer');
		//$this->load->view('vtipo_equipo',$data);
	}
	public function tabla() 
	{
		$result = array('data' => array());

		$data = $this->Mnagios->tabla();
		foreach ($data as $key => $value) {
			//$name = $value['tx_descripcion'] . ' ' . $value['tx_descripcion'];
			if ( $value['in_estado_host'] == 0){
				$estado_host='<span class="label label-success">Encendido</span>';
			  }
			  if ( $value['in_estado_host'] == 1){
				  $estado_host='<span class="label label-danger">Apagado</span>';
				}
				if ( $value['in_estado_servicio'] == 2){
				  $estado_servicio='<span class="label label-danger">Critico</span>';
				}
				if ( $value['in_estado_servicio'] == 1){
				  $estado_servicio='<span class="label label-danger">Advertencia</span>';
				}
				if ( $value['in_estado_servicio'] == 0){
					$estado_servicio='<span class="label label-default">Desconocido</span>';
				  }

			$result['data'][$key] = array(
			
				$value['tx_nombre_servicio_nagios'],
				$value['nu_porcent_toner_negro'],
				$value['nu_porcent_deposito_toner'],
				$value['nu_porcent_tambor_negro'],
				$value['nu_porcent_revelador_negro'],
				$value['nu_total_contador'],
				$value['nu_porcent_fusor'],
				$estado_host,
				$estado_servicio,
				$value['fe_fecha_monitoreo'],
				
				                //revisar
			
			);
		} // /foreach

		echo json_encode($result);
	}
	
		public function obtener_tabla($co_registro_monitoreo) 
		{
			if($co_registro_monitoreo) {
				$data = $this->Mnagios->tabla($co_registro_monitoreo);
				echo json_encode($data);
			}
		}

	public function insertar(){
	
		$parametro['tx_nombre_servicio_nagios']=$this->input->post('tx_nombre_servicio_nagios');
		$parametro['nu_toner_negro']=$this->input->post('nu_toner_negro');
		$parametro['nu_deposito_toner']=$this->input->post('nu_deposito_toner');
		$parametro['nu_tambor']=$this->input->post('nu_tambor');
		$parametro['nu_revelador_negro']=$this->input->post('nu_revelador_negro');
		$parametro['nu_total_contador']=$this->input->post('nu_total_contador');
		$parametro['tx_estado']=$this->input->post('tx_estado');
		$parametro['nu_unidad_fusora']=$this->input->post('nu_unidad_fusora');
		$parametro['host_state']=$this->input->post('host_state');
		$parametro['state']=$this->input->post('state');
		$this->Mnagios->insertar($parametro);

}


}