<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cactivo_listado extends CI_Controller {

        public function __construct()
    {
      
        parent::__construct();

       $Session_covi=$this->session->userdata('usuario_covi');
       $co_rol = $Session_covi['co_rol'];
        $permiso=$this->Mseguridad_permisologia->getPermisos(1,$co_rol);
        if($co_rol==null){
			redirect('Clogin');
		}
		if ($permiso==0){
            show_404();
		}
        $this->load->model('Mactivo_listado_activo','activo');
        $this->load->model('Mactivo_clase_activo');
        $this->load->helper(array('fechas_helper','url'));
        
        if(!$this->session->userdata('usuario_covi')){
            redirect('Clogin');
          }
    }

	public function index()
	{
		$this->load->view('layout/header');
        $this->load->view('layout/body');
		$combo=$this->Mactivo_clase_activo->combo();
		$combo2=$this->Mactivo_clase_activo->combo2();
		$this->load->view('vactivo_listado',compact('combo','combo2'));
		$this->load->view('layout/footer');
	}

   

    public function ajax_list()
    {
        $list = $this->activo->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $activo) {
			$no++;
		//	tx_serial, tx_nota, co_modelo, tx_etiqueta,fe_inicio_asig, tx_direccion, co_clase_activo_detalle,nu_prioridad,tx_criticidad,tx_sap 
            $row = array();
            $row[] = $activo->tx_serial;
            $row[] = $activo->tx_nota;
			$row[] = $activo->tx_nombre;
			$row[] = $activo->tx_numero_parte;
            $row[] = $activo->tx_etiqueta;
            $row[] = $activo->fe_inicio_asig;
            $row[] = $activo->tx_direccion;
           $row[] = $activo->tx_clase_activo;
            $row[] = $activo->tx_clase_activo_detalle;
           // $row[] = $person->nu_prioridad;
            $row[] = $activo->tx_criticidad;
          
//var $column = array('tx_serial','tx_nota','co_modelo','tx_etiqueta','fe_inicio_asig','tx_direccion','co_clase_activo_detalle','nu_prioridad','tx_criticidad','tx_sap');
            //add html for action
        $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Editar" onclick="edit_person('."'".$activo->co_activo."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
        ';
            
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->activo->count_all(),
                        "recordsFiltered" => $this->activo->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->activo->get_by_id($id);
        echo json_encode($data);
    }


    public function ajax_update()
    {
        $data = array(
			
				'co_clase_activo_detalle' => $this->input->post('co_clase_activo_detalle'),
                'nu_prioridad' => $this->input->post('nu_prioridad'),
                'tx_criticidad' => $this->input->post('tx_criticidad'),
              //  'address' => $this->input->post('address'),
                //'dob' => $this->input->post('dob'),
            );
        $this->activo->update(array('co_activo' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

   

       /* public function list_by_id($id){

    $data['output'] = $this->activo->get_by_id_view($id);
    $this->load->view('view_Detail', $data);
}*/

}
