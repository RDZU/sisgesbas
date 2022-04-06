<?php 
/**
* 
*/
class Cactivo_modelo extends CI_Controller
{
	
	function __construct()
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
    $this->load->library('form_validation');


$this->load->model('Mactivo_modelo');
	$this->load->helper(array('fechas_helper','url','download'));
	}
	public function index(){
       $this->load->view('layout/header');
	   $this->load->view('layout/body');
      // $data['tabla']= $this->Mactivo_modelo->tabla();
    //   $data['combo']=$this->Mactivo_marca->combo();
      //  $data['id']=$this->Mactivo_modelo->id();
		$this->load->view('vactivo_modelo'/*,$data*/);
          $this->load->view('layout/footer');
	}/*
public function ingresar (){
$parametro['co_marca']=$this->input->post('co_marca');
$parametro['tx_modelo']=strtoupper($this->input->post('tx_modelo'));
$parametro['tx_numero_producto']=strtoupper($this->input->post('tx_numero_producto'));
$parametro['nu_modelo']=strtoupper($this->input->post('nu_modelo'));
 $this->Mactivo_modelo->ingresar($parametro);
redirect('Cactivo_modelo');
}
*/
public function tabla() 
    {
        $result = array('data' => array());

        $data = $this->Mactivo_modelo->tabla();
    /// $data['combo']=$this->Mseguridad_usuario->combo();
        foreach ($data as $key => $value) {
       // $name = $value['tx_marca'];
  $base=base_url();
            // button
            $buttons = '
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Opcion <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
         
               
               <li> </li>        
              </ul>
            </div>
            ';
            $result['data'][$key] = array(
               $value['marca'],
                $value['modelo'],
                $value['parte']//,
                //$value['nu_modelo'],
                 //revisar
                //$buttons
            );
        } // /foreach

        echo json_encode($result);
    }

    public function obtener_tabla($co_modelo) 
    {
        if($co_modelo) {
            $data = $this->Mactivo_modelo->tabla($co_modelo);
            echo json_encode($data);
        }
    }

    


}