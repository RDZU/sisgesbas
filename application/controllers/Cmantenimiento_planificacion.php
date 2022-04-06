<?php
/**
* 
*/
class Cmantenimiento_planificacion extends CI_Controller
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
	$this->load->model(array('Mactivo_listado_activo','Mtipo_mto','Mmantenimiento_ud_tiempo','Mmantenimiento_tarea','Mmantenimiento_registro','Mtipo_mto','Mmantenimiento_planificacion','Mmantenimiento_herramienta_tarea'));
  $this->load->helper(array('fechas_helper','url'));
  $this->Mmantenimiento_planificacion->estado();
  //print_r($che);exit;
 
	}


	public function index(){
       $this->load->view('layout/header');
     $this->load->view('layout/body');
     $data['combo_ud_tiempo']=$this->Mmantenimiento_ud_tiempo->combo_ud_tiempo();
		$this->load->view('vmantenimiento_planificacion',$data);
          $this->load->view('layout/footer');
        
    }
    public function prueba (){
    $estado = $this->input->post("estado");
    print_r($estado);
    }
    public function tabla() 
	{ 
    $Session_covi=$this->session->userdata('usuario_covi');
    $co_rol = $Session_covi['co_rol'];
    $estado = $this->input->post("estado");
    print_r($estado);
		$result = array('data' => array());
    $base=base_url();
    $data = $this->Mmantenimiento_registro->tabla(null,$estado);
    //$this->Mseguridad_permisologia->permisologia($usuario);
    if($co_rol==1||$co_rol==3||$co_rol==5){
		foreach ($data as $key => $value) {
      $usuario= $value['tx_nombre']. ' '.$value['tx_apellido'];
			$frecuencia = $value['nu_frecuencia_mtto'] . ' ' . $value['tx_unidad_tiempo'];
         //   $tipo_mtto = $value['tx_tipo_mtto'] . ' ' . $value['nu_nivel_mtto'];
			// button glyphicon glyphicon-calendar < href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->co_activo."'".')"><i class="glyphicon glyphicon-pencil"></i></a>'
            if ( $value['in_estado_mtto'] == 0){
              $estado='<span class="label label-warning">Por Planificar</span>';
              $buttons= '<a type="button"  onclick="plan_mtto('.$value['co_frecuencia_mtto'].')" class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#plan_mtto" href="" title="Planificar Mtto."><span class="glyphicon glyphicon-calendar"></span></a>
              <a type="button"  onclick="edit('.$value['co_frecuencia_mtto'].')" class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#editModal" href="" title="Editar Frecuencia."><i class="glyphicon  glyphicon glyphicon-time"></i></a>
              <a type="button" disabled  class="btn btn-xs btn-primary"   title="Reprogramar Mtto."><i class="glyphicon glyphicon-exclamation-sign"></i></a>
              <a type="button" disabled  class="btn btn-xs btn-primary"  title="Realizar Mtto."><i class="glyphicon glyphicon-list-alt"></i></a>';
            }
            if ( $value['in_estado_mtto'] == 1){
                $estado='<span class="label label-success">Planificados</span>';
                $buttons= '<a type="button" disabled class="btn btn-xs btn-primary"   title="Planificar Mtto."><span class="glyphicon glyphicon-calendar"></span></a>
                <a type="button"  onclick="edit('.$value['co_frecuencia_mtto'].')" class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#editModal" href="" title="Editar Frecuencia."><i class="glyphicon  glyphicon glyphicon-time"></i></a>
                <a type="button" id="vamos" onclick="reprogramar_mtto('.$value['co_frecuencia_mtto'].')" class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#reprogramar_mtto" href="" title="Reprogramar Mtto."><i class="glyphicon glyphicon-exclamation-sign"></i></a>
                <abbr title="Realizar Mtto."> <a href="'.$base.'index.php/Cmantenimiento_planificacion/planificacion/'.$value['co_plan_mtto'].'/'.$value['co_frecuencia_mtto'].'" type="button" class="btn btn-xs btn-primary" onclick="edit('.$value['co_frecuencia_mtto'].')" > <i class="glyphicon glyphicon-list-alt"></i></a>'
                ;
               
              }
              if ( $value['in_estado_mtto'] == 2){
                $estado='<span class="label label-primary">Cerrados</span>';
                $buttons= '<a type="button" disabled  class="btn btn-xs btn-primary"  title="Planificar Mtto."><span class="glyphicon glyphicon-calendar"></span></a>
                <a type="button" disabled   class="btn btn-xs btn-primary"  title="Editar Frecuencia."><i class="glyphicon  glyphicon glyphicon-time"></i></a>
                <a type="button" disabled  class="btn btn-xs btn-primary"   title="Reprogramar Mtto."><i class="glyphicon glyphicon-exclamation-sign"></i></a>
                <a type="button" disabled  class="btn btn-xs btn-primary"  title="Realizar Mtto."><i class="glyphicon glyphicon-list-alt"></i></a>';
              }
              if ( $value['in_estado_mtto'] == 3){
                $estado='<span class="label label-danger">Diferidos</span>';
                $buttons= '<a type="button" disabled class="btn btn-xs btn-primary"   title="Planificar Mtto."><span class="glyphicon glyphicon-calendar"></span></a>
                <a type="button"  onclick="edit('.$value['co_frecuencia_mtto'].')" class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#editModal" href="" title="Editar Frecuencia."><i class="glyphicon  glyphicon glyphicon-time"></i></a>
                <a type="button"  onclick="reprogramar_mtto('.$value['co_frecuencia_mtto'].')" class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#reprogramar_mtto" href="" title="Reprogramar Mtto."><i class="glyphicon glyphicon-exclamation-sign"></i></a>
                <abbr title="Realizar Mtto."> <a href="'.$base.'index.php/Cmantenimiento_planificacion/planificacion/'.$value['co_plan_mtto'].'/'.$value['co_frecuencia_mtto'].'" type="button" class="btn btn-xs btn-primary" onclick="edit('.$value['co_frecuencia_mtto'].')" > <i class="glyphicon glyphicon-list-alt"></i></a>';
               
              }
              if ( $value['tx_criticidad'] == 'BAJA'){
                $criticidad='<span class="label label-info">BAJA</span>';
              }
              if ( $value['tx_criticidad'] == 'MEDIA'){
                $criticidad='<span class="label label-warning">MEDIA</span>';
              }
              if ( $value['tx_criticidad'] == 'ALTA'){
                $criticidad='<span class="label label-danger">ALTA</span>';
              }

            //glyphicon glyphicon-exclamation-sign
          //  echo $estado;exit();
          /*   $buttons= '<a class="btn btn-xs btn-primary" type="button" data-toggle="modal" data-target="#editForm" href="javascript:void(0)" title="Planificacion Mtto." onclick="plan_mtto('."'".$value['co_frecuencia_mtto']."'".')"><i class="glyphicon glyphicon-calendar"></i></a>
      <a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Ejecutar Mtto." onclick="plan_mtto('."'".$value['co_frecuencia_mtto']."'".')"><i class="glyphicon glyphicon-tasks"></i></a>';*/
          /*  $buttons = '
            <abbr title="Planificar Mantenimiento"> <a href="'.$base.'index.php/Cmantenimiento_registro/planificacion/'.$value['co_frecuencia_mtto'].'" type="button" class="btn btn-xs btn-info" onclick="edit('.$value['co_frecuencia_mtto'].')" > <i class="glyphicon glyphicon-list-alt"></i></a>
                </abbr>
                  <li><a type="button" onclick="eliminar('.$value['co_modulo'].')" data-toggle="modal" data-target="#removeModal">Eliminar</a></li>			    
               <a  href="" type="button" class="btn btn-danger btn-check btn-xs" data-toggle="modal" data-target="#removeModal" ><span class="glyphicon glyphicon-trash"></span> </a> 
                $buttons= '<a type="button"  onclick="plan_mtto('.$value['co_frecuencia_mtto'].')" class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#plan_mtto" href="" title="Planificar Mtto."><span class="glyphicon glyphicon-calendar"></span></a>
              <a type="button"  onclick="plan_mtto('.$value['co_frecuencia_mtto'].')" class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#plan_mtto" href="" title="Reprogramar Mtto."><i class="glyphicon glyphicon-exclamation-sign"></i></a>
              <a type="button"  onclick="plan_mtto('.$value['co_frecuencia_mtto'].')" class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#ejecutar_mtto" href="" title="Ejecución Mtto."><i class="glyphicon glyphicon-list-alt"></i></a>';
      ';*/
   /*   if ($value['fe_planificada'] != "0000-00-00")
      { return $fecha=date('d-m-Y',strtotime($value['fe_planificada']));
      }*/
   
			$result['data'][$key] = array(
                $value['co_frecuencia_mtto'],
                $value['tx_serial'],
                $criticidad,
                $value['tx_tipo_mtto'],
                $value['nu_nivel_mtto'],
                $frecuencia,
                $value['tx_tarea_mtto'],   
                $value['tx_clase_activo_detalle'],
               // ->format('d-m-Y H:i:s'),
               // date_format($x, 'd-m-Y H:i:s'),
              
              // $fecha=date("Y-m-d",strtotime($value['fe_planificada'])),
               $value['fe_planificada'],
               $value['fe_reprogramada'],
               $value['fe_real_culminada'],
              $usuario,
              // $value['fe_planificada'],
                $estado,  
				$buttons
      );
    }//
    } // /foreach
    
    //si es analista de soporte, si tubiera mas tiempo hubiera optimizado el codigo

    if($co_rol==2){
      foreach ($data as $key => $value) {
        $usuario= $value['tx_nombre']. ' '.$value['tx_apellido'];
        $frecuencia = $value['nu_frecuencia_mtto'] . ' ' . $value['tx_unidad_tiempo'];
           //   $tipo_mtto = $value['tx_tipo_mtto'] . ' ' . $value['nu_nivel_mtto'];
        // button glyphicon glyphicon-calendar < href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->co_activo."'".')"><i class="glyphicon glyphicon-pencil"></i></a>'
              if ( $value['in_estado_mtto'] == 0){
                $estado='<span class="label label-warning">Por Planificar</span>';
                $buttons= '
                <a type="button" disabled  class="btn btn-xs btn-primary"  title="Realizar Mtto."><i class="glyphicon glyphicon-list-alt"></i></a>';
              }
              if ( $value['in_estado_mtto'] == 1){
                  $estado='<span class="label label-success">Planificados</span>';
                  $buttons= '
                  <abbr title="Realizar Mtto."> <a href="'.$base.'index.php/Cmantenimiento_planificacion/planificacion/'.$value['co_plan_mtto'].'/'.$value['co_frecuencia_mtto'].'" type="button" class="btn btn-xs btn-primary" onclick="edit('.$value['co_frecuencia_mtto'].')" > <i class="glyphicon glyphicon-list-alt"></i></a>'
                  ;
                 
                }
                if ( $value['in_estado_mtto'] == 2){
                  $estado='<span class="label label-primary">Cerrados</span>';
                  $buttons= '
                  <a type="button" disabled  class="btn btn-xs btn-primary"  title="Realizar Mtto."><i class="glyphicon glyphicon-list-alt"></i></a>';
                }
                if ( $value['in_estado_mtto'] == 3){
                  $estado='<span class="label label-danger">Diferidos</span>';
                  $buttons= '
                  <abbr title="Realizar Mtto."> <a href="'.$base.'index.php/Cmantenimiento_planificacion/planificacion/'.$value['co_plan_mtto'].'/'.$value['co_frecuencia_mtto'].'" type="button" class="btn btn-xs btn-primary" onclick="edit('.$value['co_frecuencia_mtto'].')" > <i class="glyphicon glyphicon-list-alt"></i></a>';
                 
                }
                if ( $value['tx_criticidad'] == 'BAJA'){
                  $criticidad='<span class="label label-info">BAJA</span>';
                }
                if ( $value['tx_criticidad'] == 'MEDIA'){
                  $criticidad='<span class="label label-warning">MEDIA</span>';
                }
                if ( $value['tx_criticidad'] == 'ALTA'){
                  $criticidad='<span class="label label-danger">ALTA</span>';
                }
  
              //glyphicon glyphicon-exclamation-sign
            //  echo $estado;exit();
            /*   $buttons= '<a class="btn btn-xs btn-primary" type="button" data-toggle="modal" data-target="#editForm" href="javascript:void(0)" title="Planificacion Mtto." onclick="plan_mtto('."'".$value['co_frecuencia_mtto']."'".')"><i class="glyphicon glyphicon-calendar"></i></a>
        <a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Ejecutar Mtto." onclick="plan_mtto('."'".$value['co_frecuencia_mtto']."'".')"><i class="glyphicon glyphicon-tasks"></i></a>';*/
            /*  $buttons = '
              <abbr title="Planificar Mantenimiento"> <a href="'.$base.'index.php/Cmantenimiento_registro/planificacion/'.$value['co_frecuencia_mtto'].'" type="button" class="btn btn-xs btn-info" onclick="edit('.$value['co_frecuencia_mtto'].')" > <i class="glyphicon glyphicon-list-alt"></i></a>
                  </abbr>
                    <li><a type="button" onclick="eliminar('.$value['co_modulo'].')" data-toggle="modal" data-target="#removeModal">Eliminar</a></li>			    
                 <a  href="" type="button" class="btn btn-danger btn-check btn-xs" data-toggle="modal" data-target="#removeModal" ><span class="glyphicon glyphicon-trash"></span> </a> 
                  $buttons= '<a type="button"  onclick="plan_mtto('.$value['co_frecuencia_mtto'].')" class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#plan_mtto" href="" title="Planificar Mtto."><span class="glyphicon glyphicon-calendar"></span></a>
                <a type="button"  onclick="plan_mtto('.$value['co_frecuencia_mtto'].')" class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#plan_mtto" href="" title="Reprogramar Mtto."><i class="glyphicon glyphicon-exclamation-sign"></i></a>
                <a type="button"  onclick="plan_mtto('.$value['co_frecuencia_mtto'].')" class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#ejecutar_mtto" href="" title="Ejecución Mtto."><i class="glyphicon glyphicon-list-alt"></i></a>';
        ';*/
     /*   if ($value['fe_planificada'] != "0000-00-00")
        { return $fecha=date('d-m-Y',strtotime($value['fe_planificada']));
        }*/
     
        $result['data'][$key] = array(
                  $value['co_frecuencia_mtto'],
                  $value['tx_serial'],
                  $criticidad,
                  $value['tx_tipo_mtto'],
                  $value['nu_nivel_mtto'],
                  $frecuencia,
                  $value['tx_tarea_mtto'],   
                  $value['tx_clase_activo_detalle'],
                 // ->format('d-m-Y H:i:s'),
                 // date_format($x, 'd-m-Y H:i:s'),
                
                 $fecha=date("d-m-Y",strtotime($value['fe_planificada'])),
               //  $value['fe_planificada'],
                 $value['fe_reprogramada'],
                 $value['fe_real_culminada'],
                $usuario,
                // $value['fe_planificada'],
                  $estado,  
          $buttons
        );
      }//
      } // /foreach

		echo json_encode($result);
	}
//<li><a href="'.$base.'index.php/Cmantenimiento_tarea/herramienta/'.$value['co_tarea_mtto'].'" type="button"('.$value['co_tarea_mtto'].')">Herramientas</a>
  

public function obtener_tabla($co_frecuencia_mtto) 
	{
		if($co_frecuencia_mtto) {
            $data = $this->Mmantenimiento_registro->tabla($co_frecuencia_mtto);
			  echo json_encode($data);
		}
	}


public function plan_mtto($co_plan_mtto = null) 
{
  if($co_plan_mtto) {
    $validator = array('success' => false, 'messages' => array());

    $config = array(
     array(
      'field' => 'fe',
      'label' => 'Fecha Planificada',
      'rules' => 'trim'
    )
  );

    $this->form_validation->set_rules($config);
    $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

    if($this->form_validation->run() === true) {

      $editMember = $this->Mmantenimiento_planificacion->plan_mtto($co_plan_mtto); 

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


public function reprogramar_mtto($co_plan_mtto = null) 
{
  if($co_plan_mtto) {
    $validator = array('success' => false, 'messages' => array());

    $config = array(
     array(
      'field' => 'fe_re',
      'label' => 'Fecha Planificada',
      'rules' => 'trim'
    )
  );

    $this->form_validation->set_rules($config);
    $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

    if($this->form_validation->run() === true) {

      $editMember = $this->Mmantenimiento_planificacion->reprogramar_mtto($co_plan_mtto); 

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

public function planificacion($co_plan_mtto,$co_frecuencia_mtto){
  if(!$co_plan_mtto && !$co_frecuencia_mtto){show_404();}

  $retornar=$this->Mmantenimiento_registro->datos_registro($co_frecuencia_mtto);
//print_r($retornar['fe_reprogramada']);exit();
//$tarea=$this->Mmantenimiento_tarea->datos_tarea($retornar['co_tarea_mtto']);
//
$fecha_planificada=$retornar['fe_planificada'];
$fecha_reprogramada=$retornar['fe_reprogramada'];
$tiempo=$retornar['co_unidad_tiempo'];
$datos_frecuencia=$this->Mmantenimiento_ud_tiempo->datos_frecuencia($tiempo);
$frecuencia=$retornar['nu_frecuencia_mtto'];
$tipo_mtto=$retornar['co_tipo_mtto'];
$co_activo=$retornar['co_activo'];
$co_tarea=$retornar['co_tarea_mtto'];
$tarea=$this->Mmantenimiento_tarea->datos_tarea($retornar['co_tarea_mtto']);
$herramienta=$this->Mmantenimiento_herramienta_tarea->tabla($retornar['co_tarea_mtto']);
$activo=$this->Mactivo_listado_activo->datos_activo($retornar['co_activo']);

//rint_r($retornar['co_tarea_mtto']);exit();
//print_r($tipo_mtto);exit();

//print_r($co_frecuencia_mtto);
  $this->load->view('layout/header');
	$this->load->view('layout/body');
	//$nombre_tarea=$this->Mmantenimiento_herramienta_tarea->Nombre_tarea($co_mto_tarea);
	//$combo=$this->Mactivo_clase_activo->combo();
	//$this->load->view('vmantenimiento_tarea_herramienta',compact('co_mto_tarea','buscar_herramienta','tabla','nombre_tarea'));
	$this->load->view('vmantenimiento_realizar_mtto',compact('co_plan_mtto','tarea','herramienta','activo','tiempo','frecuencia','tipo_mtto','co_activo','co_tarea','datos_frecuencia','fecha_planificada','fecha_reprogramada'));
	$this->load->view('layout/footer');

}


public function realizar_mtto(){

  //actualiza el plan mtto
$co_plan_mtto=$this->input->post('co_plan_mtto');
  $data = array(
		'co_usuario' => $this->input->post('co_usuario'),
    'fe_real_culminada' => $this->input->post('fecha'),
    'in_estado_mtto' =>2,
    'tx_nombre' => $this->input->post('tx_nombre'),
  );
  $this->Mmantenimiento_planificacion->insertar($data,$co_plan_mtto);
 // $this->Mmantenimiento_registro->ingresar($data);

//crea un nuevo mtto con la fecha prox

  //if ($lastId > 0) {
    $data2 = array(
      'co_activo' => $this->input->post('co_activo'),
			'co_tipo_mtto' => $this->input->post('co_tipo_mtto'),
			'nu_frecuencia_mtto' => $this->input->post('nu_frecuencia_mtto'),
			'co_unidad_tiempo' => $this->input->post('co_unidad_tiempo'),
			'co_tarea_mtto' => $this->input->post('co_tarea_mtto')
    );
   

    $lastId=$this->Mmantenimiento_registro->ingresar($data2);
    if ($lastId > 0) {
     $data3 = array(
       'co_frecuencia_mtto' =>$lastId,
       'in_estado_mtto'=>1,
       'fe_planificada' => $this->input->post('fe_pro_mtto'),
     );
     $this->Mmantenimiento_planificacion->ID($data3);
   //  $this->session->set_flashdata('mensaje3','exitoso');
   }
   redirect('Cmantenimiento_planificacion');

}

public function insertar(){
  $co_plan_mtto=$this->input->post('co_plan_mtto');
  $data = array(
		'co_usuario' => $this->input->post('co_usuario'),
    'fe_real_culminada' => $this->input->post('fe_real'),
    'in_estado_mtto' =>2,
    'tx_nombre' => $this->input->post('tx_nombre'),
  );
 
$this->Mmantenimiento_planificacion->insertar($data,$co_plan_mtto);
///////actualizacion del estado de mtto
//////////////
//$co_frecuencia_mtto=$this->input->post('co_frecuencia_mtto');
//$nu_estado_mtto=1;
//print_r($where); exit;
//$this->Mmantenimiento_registro->estado_mtto($nu_estado_mtto,$co_frecuencia_mtto);
  redirect('Cmantenimiento_planificacion');
}

public function frecuencia($nu_frecuencia_mtto){
  $id=$this->uri->segment(3);
	$tiempo=$this->Mmantenimiento_planificacion->frecuencia_edit($id);
    if($nu_frecuencia_mtto>1&&$tiempo==3){
      $this->form_validation->set_message('frecuencia', 'No se puede realizar varias frecuencia diarias.');
      return false;
    }
    else{
      return true;
    }
  }
public function edit($co_frecuencia_mtto = null) 
{


  if($co_frecuencia_mtto) {

    $validator = array('success' => false, 'messages' => array());

    $config = array(
     array(
      'field' => 'nu_frecuencia_mtto',
      'label' => 'Invervalo',
      'rules' => 'trim|required|is_natural_no_zero|less_than[4]|callback_frecuencia'
    )
  );

    $this->form_validation->set_rules($config);
    $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

    if($this->form_validation->run() === true) {

      $editMember = $this->Mmantenimiento_planificacion->edit($co_frecuencia_mtto); 

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


}