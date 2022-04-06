<?php 

class Mnagios extends CI_Model
{
	
	function __construct()
	{
	parent::__construct();
	$this->load->database();
	}/*
public function tabla(){
$this->db->select('*');
$this->db->from('sisgesbas.x001t_historico_monitoreo');
$r = $this->db->get();
return $r->result();
}*/

public function tabla($co_registro_monitoreo = null) 
{
	if($co_registro_monitoreo) {
		$sql = "SELECT * FROM sisgesbas.x001t_historico_monitoreo WHERE co_registro_monitoreo = ?";
		$query = $this->db->query($sql, array($co_registro_monitoreo));
		return $query->row_array();
	}

	$sql = "SELECT * FROM sisgesbas.x001t_historico_monitoreo";
	$query = $this->db->query($sql);
	return $query->result_array();
}

public function insertar($parametro){
$campos = array(
			'tx_nombre_servicio_nagios' => $parametro['tx_nombre_servicio_nagios'],
			'nu_porcent_toner_negro' => $parametro['nu_toner_negro'],
			'nu_porcent_deposito_toner' => $parametro['nu_deposito_toner'],
			'nu_porcent_tambor_negro' => $parametro['nu_tambor'],
			'nu_porcent_revelador_negro' => $parametro['nu_revelador_negro'],
			'nu_total_contador' => $parametro['nu_total_contador'],
			'tx_estado' => $parametro['tx_estado'],
			'nu_porcent_fusor' => $parametro['nu_unidad_fusora'],
			'in_estado_host' => $parametro['host_state'],
			'in_estado_servicio' => $parametro['state'],
		   'fe_fecha_monitoreo' =>strftime( "%Y-%m-%d %H:%M:%S", time() )
			);

		$this->db->insert('sisgesbas.x001t_historico_monitoreo',$campos);

		}



		public function year(){
			//SELECT extract(YEAR from fe_planificada)  as años FROM sisgesbas.c001t_plan_mtto GROUP BY años ORDER BY años DESC
			
							$this->db->select("extract(YEAR from fe_fecha_monitoreo)  as años");
							$this->db->from("sisgesbas.x001t_historico_monitoreo");
							$this->db->group_by("años");
							$this->db->order_by("años","asc");
							$resultado= $this->db->get();
							return $resultado->result(); // formato de array 
			
						}
			//SELECT extract(MONTH from fe_planificada)  as mes, "count"(*) as registro FROM sisgesbas.c001t_plan_mtto WHERE fe_planificada BETWEEN '2018-01-01' and '2018-12-31' GROUP BY mes
			
			
			
			//SELECT extract(MONTH from fe_planificada)  as mes, count(*) as registro FROM sisgesbas.c001t_plan_mtto WHERE fe_planificada BETWEEN '2018-01-01' and '2018-12-31' and  in_estado_mtto = '1'  GROUP BY mes
			//SELECT extract(MONTH from fe_reprogramada)  as mes, count(*) as registro FROM sisgesbas.c001t_plan_mtto WHERE fe_reprogramada BETWEEN '2018-01-01' and '2018-12-31' and  in_estado_mtto = '3'  GROUP BY mes
			//SELECT extract(MONTH from fe_real_culminada)  as mes, count(*) as registro FROM sisgesbas.c001t_plan_mtto WHERE fe_real_culminada BETWEEN '2018-01-01' and '2018-12-31' and  in_estado_mtto = '2'  GROUP BY mes
//SELECT extract(MONTH from fe_fecha_monitoreo) as mes, "tx_nombre_servicio_nagios", avg(nu_porcent_toner_negro)  as  toner_negro, AVG(nu_porcent_deposito_toner) as deposito_toner, AVG(nu_porcent_tambor_negro) as tambor_negro, AVG(nu_porcent_revelador_negro) as revelador_negro, AVG(nu_porcent_fusor) as fusor FROM "sisgesbas"."x001t_historico_monitoreo" WHERE "fe_fecha_monitoreo" >= '2018-01-01' AND "fe_fecha_monitoreo" <= '2018-12-31' GROUP BY "mes", "tx_nombre_servicio_nagios" ORDER BY "mes" ASC
			public function registro($year){
			$this->db->select("extract(MONTH from fe_fecha_monitoreo) as mes, tx_nombre_servicio_nagios, avg(nu_porcent_toner_negro)  as  toner_negro, AVG(nu_porcent_deposito_toner) as deposito_toner, AVG(nu_porcent_tambor_negro) as tambor_negro, AVG(nu_porcent_revelador_negro) as revelador_negro, AVG(nu_porcent_fusor) as fusor");
			$this->db->from("sisgesbas.x001t_historico_monitoreo");
			$this->db->where("fe_fecha_monitoreo>=",$year."-01-01");
			$this->db->where("fe_fecha_monitoreo<=",$year."-12-31");
			//$this->db->where("tx_nombre_servicio_nagios",$nombre);
			$this->db->group_by("mes,tx_nombre_servicio_nagios");
			$this->db->order_by("mes","asc");
			$resultado= $this->db->get();
		//	$this->db->last_query();exit;
			return $resultado->result(); //array de objetos
			}

}