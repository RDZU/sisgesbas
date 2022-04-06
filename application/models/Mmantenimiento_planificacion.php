<?php 

class Mmantenimiento_planificacion extends CI_Model
{
	
	function __construct()
	{
	parent::__construct();
	$this->load->database();
    }
	
	
public function insertar($data,$co_plan_mtto){
	$this->db->where('co_plan_mtto',$co_plan_mtto);
    $this->db->update('sisgesbas.c001t_plan_mtto', $data);
}

public function ID($data){
	$this->db->insert('sisgesbas.c001t_plan_mtto', $data);
///	$this->db->last_query($che); exit;
}

public function tabla($co_frecuencia_mtto= null) 
{
	//SELECT * from sisgesbas.c001t_plan_mtto  join sisgesbas.c003t_frecuencia_mtto USING(co_frecuencia_mtto) WHERE co_frecuencia_mtto= 10
	if($co_frecuencia_mtto) {
		$sql = " SELECT * from sisgesbas.c001t_plan_mtto  join sisgesbas.c003t_frecuencia_mtto USING(co_frecuencia_mtto) WHERE co_frecuencia_mtto= ?";
		$query = $this->db->query($sql, array($co_frecuencia_mtto));
		return $query->row_array();
	}
}


public function plan_mtto($co_plan_mtto = null) 
			{
				if($co_plan_mtto) {
					$data = array(
						'fe_planificada' => $this->input->post('fe'),
						'in_estado_mtto' => 1
					);
		
					$this->db->where('co_plan_mtto', $co_plan_mtto);
					$sql = $this->db->update('sisgesbas.c001t_plan_mtto',$data);
		
					if($sql === true) {
						return true; 
					} else {
						return false;
					}
				}
					
			}


			public function getEventos(){

				$this->db->select('co_frecuencia_mtto as id, tx_tarea_mtto title, fe_planificada start, fe_reprogramada end, in_estado_mtto evento, tx_serial, nu_tiempo_tarea tiempo');
				$this->db->from('sisgesbas.c001t_plan_mtto');
				$this->db->join('sisgesbas.c003t_frecuencia_mtto','co_frecuencia_mtto');
$this->db->join('activo.c001t_activo','co_activo');
$this->db->join('sisgesbas.i002t_tarea_mtto','sisgesbas.c003t_frecuencia_mtto.co_tarea_mtto=sisgesbas.i002t_tarea_mtto.co_tarea_mtto');
$this->db->where('in_estado_mtto','1' );
$this->db->or_where('in_estado_mtto','3');
//$this->db->join('sisgesbas.i002t_tarea_mtto','co_tarea_mtto');
				return $this->db->get()->result();
			}

		

			public function year(){
//SELECT extract(YEAR from fe_planificada)  as años FROM sisgesbas.c001t_plan_mtto GROUP BY años ORDER BY años DESC

				$this->db->select("extract(YEAR from fe_planificada)  as años");
				$this->db->from("sisgesbas.c001t_plan_mtto");
				$this->db->group_by("años");
				$this->db->order_by("años","asc");
				$resultado= $this->db->get();
				return $resultado->result(); // formato de array 

			}
//SELECT extract(MONTH from fe_planificada)  as mes, "count"(*) as registro FROM sisgesbas.c001t_plan_mtto WHERE fe_planificada BETWEEN '2018-01-01' and '2018-12-31' GROUP BY mes



//SELECT extract(MONTH from fe_planificada)  as mes, count(*) as registro FROM sisgesbas.c001t_plan_mtto WHERE fe_planificada BETWEEN '2018-01-01' and '2018-12-31' and  in_estado_mtto = '1'  GROUP BY mes
//SELECT extract(MONTH from fe_reprogramada)  as mes, count(*) as registro FROM sisgesbas.c001t_plan_mtto WHERE fe_reprogramada BETWEEN '2018-01-01' and '2018-12-31' and  in_estado_mtto = '3'  GROUP BY mes
//SELECT extract(MONTH from fe_real_culminada)  as mes, count(*) as registro FROM sisgesbas.c001t_plan_mtto WHERE fe_real_culminada BETWEEN '2018-01-01' and '2018-12-31' and  in_estado_mtto = '2'  GROUP BY mes
public function registro($year){
$this->db->select("extract(MONTH from fe_planificada)  as mes, count(*) as registro");
$this->db->from("sisgesbas.c001t_plan_mtto");
$this->db->where("fe_planificada>=",$year."-01-01");
$this->db->where("fe_planificada<=",$year."-12-31");
$this->db->group_by("mes");
$this->db->order_by("mes","asc");
$resultado= $this->db->get();
return $resultado->result(); //array de objetos
}

public function prueba0($year){

	$resultado=$this->db->select("extract(MONTH from fe_planificada)  as mes, count(*) as registro_pla")
	->from("sisgesbas.c001t_plan_mtto")
	->where("fe_planificada>=",$year."-01-01")
	->where("fe_planificada<=",$year."-12-31")
	->where("in_estado_mtto","1")
	->group_by("mes")
	->order_by("mes","asc")
	->get();
	return $resultado->result_array();
}

public function prueba($year){

	$resultado=$this->db->select("extract(MONTH from fe_reprogramada)  as mes, count(*) as registro_rep")
	->from("sisgesbas.c001t_plan_mtto")
	->where("fe_reprogramada>=",$year."-01-01")
	->where("fe_reprogramada<=",$year."-12-31")
	->where("in_estado_mtto","3")
	->group_by("mes")
	->order_by("mes","asc")
	 ->get();
	
	 return $resultado->result_array();
}
public function prueba2($year){

	$resultado3= $this->db->select("extract(MONTH from fe_real_culminada)  as mes, count(*) as registro_cul")
	->from("sisgesbas.c001t_plan_mtto")
	->where("fe_real_culminada>=",$year."-01-01")
	->where("fe_real_culminada<=",$year."-12-31")
	->where("in_estado_mtto","2")
	->group_by("mes")
	->order_by("mes","asc")
	 ->get();
	 return $resultado3->result_array();

}


public function registro2($year){
	$resultado=$this->db->select("extract(MONTH from fe_planificada)  as mes, count(*) as registro_pla")
	->from("sisgesbas.c001t_plan_mtto")
	->where("fe_planificada>=",$year."-01-01")
	->where("fe_planificada<=",$year."-12-31")
	->where("in_estado_mtto","1")
	->group_by("mes")
	->order_by("mes","asc")
	->get();
	$resultado->result();

	$resultado2=$this->db->select("extract(MONTH from fe_reprogramada)  as mes, count(*) as registro_rep")
	->from("sisgesbas.c001t_plan_mtto")
	->where("fe_reprogramada>=",$year."-01-01")
	->where("fe_reprogramada<=",$year."-12-31")
	->where("in_estado_mtto","3")
	->group_by("mes")
	->order_by("mes","asc")
	 ->get();
	 $resultado2->result();


	 $resultado3= $this->db->select("extract(MONTH from fe_real_culminada)  as mes, count(*) as registro_cul")
	->from("sisgesbas.c001t_plan_mtto")
	->where("fe_real_culminada>=",$year."-01-01")
	->where("fe_real_culminada<=",$year."-12-31")
	->where("in_estado_mtto","2")
	->group_by("mes")
	->order_by("mes","asc")
	 ->get();
	 $resultado3->result();

	$retornar = array(
		'fe_planificada' => $resultado,
		'fe_reprogramada' => $resultado2,
		'fe_real_culminada' => $resultado3
		);

	
	return $retornar; //array de objetos
	}

			public function reprogramar_mtto($co_plan_mtto = null) 
			{
				if($co_plan_mtto) {
					$data = array(
						'fe_reprogramada' => $this->input->post('reprogramar'),
						'in_estado_mtto' => 3,
					
					);
		
					$this->db->where('co_plan_mtto', $co_plan_mtto);
					$sql = $this->db->update('sisgesbas.c001t_plan_mtto',$data);
		
					if($sql === true) {
						return true; 
					} else {
						return false;
					}
				}
					
			}

public function estado(){
	

//$this->db->set('in_estado_mtto', '3');
//$this->db->where('fe_planificada < NOW()');
//$this->db->where('in_estado_mtto','1');
//$query = $this->db->update('sisgesbas.c001t_plan_mtto');
//$this->db->last_query($query);exit;
//$resultado=$this->db->update(' sisgesbas.c001t_plan_mtto');

$sql="UPDATE sisgesbas.c001t_plan_mtto SET in_estado_mtto = '3' WHERE fe_planificada < NOW() - INTERVAL '1' day AND in_estado_mtto = '1'";
$this->db->query($sql);
return true;
}




/*
$sql="UPDATE sisgesbas.c001t_plan_mtto  SET in_estado_mtto='3'
where fe_planificada < current_date AND in_estado_mtto='1'";


$sql="UPDATE sisgesbas.c001t_plan_mtto  SET in_estado_mtto='3'
where fe_planificada < current_date AND in_estado_mtto='1'";
*/

/*
	
	//$this->db->from("sisgesbas.c001t_plan_mtto")*/

	public function frecuencia_edit($id){
		$co_unidad_tiempo=$this->db->select("co_unidad_tiempo")
		->from("sisgesbas.c003t_frecuencia_mtto")
		->where(array("co_frecuencia_mtto"=>$id))
		->get();
		$row = $co_unidad_tiempo->row();
		return $row->co_unidad_tiempo;
	}

			public function edit($co_frecuencia_mtto = null){
				
				if($co_frecuencia_mtto) {
					$data = array(
				'co_unidad_tiempo' => strtoupper($this->input->post('co_unidad_tiempo')),
				'nu_frecuencia_mtto' => strtoupper($this->input->post('nu_frecuencia_mtto'))
					);
			
					$this->db->where('co_frecuencia_mtto', $co_frecuencia_mtto);
					$sql = $this->db->update('sisgesbas.c003t_frecuencia_mtto', $data);
					if($sql === true) {
						return true; 
					} else {
						return false;
					}
				}
							}
}
