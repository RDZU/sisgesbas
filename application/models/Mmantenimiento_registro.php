<?php 

/**
* 
*/
class Mmantenimiento_registro extends CI_Model
{
    public function ingresar($data)
	{
        $this->db->insert('sisgesbas.c003t_frecuencia_mtto', $data);
      //  echo $this->db->last_query($prueba);
		 return $this->db->insert_id();
	}

	
	/*
		$permiso=$this->db->select("co_nivel_usuario")
		->from("sisgesbas.i001t_usuario")
		->where(array("tx_indicador"=>$usuario))
		->get();
		$row = $permiso->row();
		return $row->co_nivel_usuario;
	*/

public function datos_registro2($co_frecuencia_mtto){
	$frecuencia=$this->db->select("co_unidad_tiempo")
	->from("sisgesbas.c003t_frecuencia_mtto")
	->where("co_frecuencia_mtto",$co_frecuencia_mtto)
	->get();
	$row = $frecuencia->row();
	return $row->co_unidad_tiempo;
}

public function datos_registro3($co_frecuencia_mtto){
	$frecuencia=$this->db->select("nu_frecuencia_mtto")
	->from("sisgesbas.c003t_frecuencia_mtto")
	->where("co_frecuencia_mtto",$co_frecuencia_mtto)
	->get();
	$row = $frecuencia->row();
	return $row->nu_frecuencia_mtto;
}
	public function datos_registro($co_frecuencia_mtto){

		$datos=$this->db->select('co_activo')
		->from('sisgesbas.c003t_frecuencia_mtto')
		->where('co_frecuencia_mtto',$co_frecuencia_mtto)
		->get();
		$row=$datos->row();

		$datos2=$this->db->select('co_tarea_mtto')
		->from('sisgesbas.c003t_frecuencia_mtto')
		->where('co_frecuencia_mtto',$co_frecuencia_mtto)
		->get();
		$row2=$datos2->row();

		$datos3=$this->db->select('nu_frecuencia_mtto')
		->from('sisgesbas.c003t_frecuencia_mtto')
		->where('co_frecuencia_mtto',$co_frecuencia_mtto)
		->get();
		$row3=$datos3->row();

		$datos4=$this->db->select('co_unidad_tiempo')
		->from('sisgesbas.c003t_frecuencia_mtto')
		->where('co_frecuencia_mtto',$co_frecuencia_mtto)
		->get();
		$row4=$datos4->row();

		$datos5=$this->db->select('co_tipo_mtto')
		->from('sisgesbas.c003t_frecuencia_mtto')
		->where('co_frecuencia_mtto',$co_frecuencia_mtto)
		->get();
		$row5=$datos5->row();

		$datos6=$this->db->select('co_tarea_mtto')
		->from('sisgesbas.c003t_frecuencia_mtto')
		->where('co_frecuencia_mtto',$co_frecuencia_mtto)
		->get();
		$row6=$datos6->row();

		$datos7=$this->db->select('fe_planificada')
		->from('sisgesbas.c001t_plan_mtto')
		->where('co_frecuencia_mtto',$co_frecuencia_mtto)
		->get();
		$row7=$datos7->row();

		$datos8=$this->db->select('fe_reprogramada')
		->from('sisgesbas.c001t_plan_mtto')
		->where('co_frecuencia_mtto',$co_frecuencia_mtto)
		->get();
		$row8=$datos8->row();

		$retornar = array(
			'co_activo' => $row->co_activo,
			'co_tarea_mtto' => $row2->co_tarea_mtto,
			'nu_frecuencia_mtto' => $row3->nu_frecuencia_mtto,
			'co_unidad_tiempo' => $row4->co_unidad_tiempo,
			'co_tipo_mtto' => $row5->co_tipo_mtto,
			'co_tarea_mtto' => $row6->co_tarea_mtto,
			'fe_planificada' => $row7->fe_planificada,
			'fe_reprogramada' => $row8->fe_reprogramada,

			
			);
	
		return $retornar;
	}

    public function tabla($co_frecuencia_mtto= null, $in_estado_mtto=null) {
	/*{
		if($co_frecuencia_mtto) {
			$sql = "select  registro.co_frecuencia_mtto,activo.tx_serial,  registro.nu_frecuencia_mtto , frecuencia.tx_unidad_tiempo, tipo.tx_tipo_mtto, tipo.nu_nivel_mtto, tarea.tx_tarea_mtto,tipo_activo.tx_clase_activo_detalle,registro.nu_estado_mtto from sisgesbas.c003t_frecuencia_mtto as registro join activo.c001t_activo as activo using(co_activo) JOIN sisgesbas.i006t_clase_activo_detalle as tipo_activo USING(co_clase_activo_detalle)  join sisgesbas.i002t_tarea_mtto as tarea on registro.co_tarea_mtto=tarea.co_tarea_mtto join sisgesbas.i001t_tipo_mtto tipo on registro.co_tipo_mtto=tipo.co_tipo_mtto join sisgesbas.i005t_unidad_tiempo as frecuencia on registro.co_unidad_tiempo=frecuencia.co_unidad_tiempo WHERE co_frecuencia_mtto= ?";
			$query = $this->db->query($sql, array($co_frecuencia_mtto));
			return $query->row_array();
		}*/
		if($co_frecuencia_mtto) {
			$sql = " SELECT * from sisgesbas.c001t_plan_mtto  join sisgesbas.c003t_frecuencia_mtto USING(co_frecuencia_mtto) WHERE co_frecuencia_mtto= ?";
			$query = $this->db->query($sql, array($co_frecuencia_mtto));
			return $query->row_array();
		}
if($in_estado_mtto){
		$sql = "select  registro.co_frecuencia_mtto,activo.tx_serial,  registro.nu_frecuencia_mtto , frecuencia.tx_unidad_tiempo, tipo.tx_tipo_mtto, tipo.nu_nivel_mtto, tarea.tx_tarea_mtto,tipo_activo.tx_clase_activo_detalle,plan.in_estado_mtto, plan.fe_planificada, plan.fe_reprogramada, plan.fe_real_culminada,activo.tx_criticidad, usuario.tx_nombre,usuario.tx_apellido,plan.co_plan_mtto from sisgesbas.c003t_frecuencia_mtto as registro join activo.c001t_activo as activo using(co_activo) JOIN sisgesbas.i006t_clase_activo_detalle as tipo_activo USING(co_clase_activo_detalle)  join sisgesbas.i002t_tarea_mtto as tarea on registro.co_tarea_mtto=tarea.co_tarea_mtto join sisgesbas.i001t_tipo_mtto tipo on registro.co_tipo_mtto=tipo.co_tipo_mtto join sisgesbas.i005t_unidad_tiempo as frecuencia on registro.co_unidad_tiempo=frecuencia.co_unidad_tiempo  JOIN  sisgesbas.c001t_plan_mtto as plan ON registro.co_frecuencia_mtto=plan.co_frecuencia_mtto LEFT JOIN sisgesbas.i001t_usuario as usuario USING(co_usuario) WHERE plan.in_estado_mtto = '$in_estado_mtto'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	$sql = "select  registro.co_frecuencia_mtto,activo.tx_serial,  registro.nu_frecuencia_mtto , frecuencia.tx_unidad_tiempo, tipo.tx_tipo_mtto, tipo.nu_nivel_mtto, tarea.tx_tarea_mtto,tipo_activo.tx_clase_activo_detalle,plan.in_estado_mtto, plan.fe_planificada, plan.fe_reprogramada, plan.fe_real_culminada,activo.tx_criticidad, usuario.tx_nombre,usuario.tx_apellido,plan.co_plan_mtto from sisgesbas.c003t_frecuencia_mtto as registro join activo.c001t_activo as activo using(co_activo) JOIN sisgesbas.i006t_clase_activo_detalle as tipo_activo USING(co_clase_activo_detalle)  join sisgesbas.i002t_tarea_mtto as tarea on registro.co_tarea_mtto=tarea.co_tarea_mtto join sisgesbas.i001t_tipo_mtto tipo on registro.co_tipo_mtto=tipo.co_tipo_mtto join sisgesbas.i005t_unidad_tiempo as frecuencia on registro.co_unidad_tiempo=frecuencia.co_unidad_tiempo  JOIN  sisgesbas.c001t_plan_mtto as plan ON registro.co_frecuencia_mtto=plan.co_frecuencia_mtto LEFT JOIN sisgesbas.i001t_usuario as usuario USING(co_usuario)";
	$query = $this->db->query($sql);
	return $query->result_array();

	}

public function estado_mtto($nu_estado_mtto,$co_frecuencia_mtto){
	$che=$this->db->set('nu_estado_mtto', $nu_estado_mtto)
	->where('co_frecuencia_mtto',$co_frecuencia_mtto)
	->update('sisgesbas.c003t_frecuencia_mtto'); 
//echo $this->db->last_query();exit();
}


public function edit_frecuencia($co_frecuencia_mtto = null){
	
	if($co_frecuencia_mtto) {
		$data = array(
	'tx_unidad_tiempo' => strtoupper($this->input->post('tx_unidad_tiempo')),
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