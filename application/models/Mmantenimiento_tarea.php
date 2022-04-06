<?php 

/**
* 
*/
class Mmantenimiento_tarea extends CI_Model
{
public function ingresar( $parametro){
$campos=array(
'tx_tarea_mtto' => $parametro['tx_mto_tarea'],
'tx_descripcion_mtto' => $parametro['tx_mto_descripcion'],
'nu_tiempo_tarea' => $parametro ['nu_tiempo_tarea'],
'co_tipo_mtto' => $parametro ['co_tipo_mto'],
);
$mensaje=$this->db->insert('sisgesbas.i002t_tarea_mtto',$campos);
if($mensaje === true) {
				return true; 
			} else {
				return false;
			}
	}




	public function buscar_tarea(){
		$query=$this->db->get("sisgesbas.i002t_tarea_mtto");
		return $query->result();
	}


	public function datos_tarea($co_tarea_mtto){
		$this->db->where('co_tarea_mtto',$co_tarea_mtto);
		$query=$this->db->get("sisgesbas.i002t_tarea_mtto");
		return $query->result();
	}

	public function check_mtto($tx_mto_tarea,$co_tipo_mto){
		
				$this->db->select('tx_tarea_mtto','co_tipo_mtto');
				$this->db->where('tx_tarea_mtto',$tx_mto_tarea);
				$this->db->where('co_tipo_mtto',$co_tipo_mto);
				$consulta=$this->db->get('sisgesbas.i002t_tarea_mtto');
				if($consulta->num_rows()>0){
					return true;
				}
		}
		public function nivel_mtto_edit($id){
			$nu_mto_nivel=$this->db->select("co_tipo_mtto")
			->from("sisgesbas.i002t_tarea_mtto")
			->where(array("co_tarea_mtto"=>$id))
			->get();
			$row = $nu_mto_nivel->row();
			return $row->co_tipo_mtto;
		}
		public function check_mtto_edit($id,$tx_tarea_mtto,$co_tipo_mto){
			
					$this->db->select('tx_tarea_mtto','co_tipo_mtto');
					$this->db->where('tx_tarea_mtto',$tx_tarea_mtto);
					$this->db->where('co_tipo_mtto',$co_tipo_mto);
					$this->db->where('co_tarea_mtto !=',$id);
					$consulta=$this->db->get('sisgesbas.i002t_tarea_mtto');
					if($consulta->num_rows()>0){
						return true;
					}
					return false;
			}

public function buscar_tarea_tipo_activo_nivel_mtto($nu_nivel_mtto,$tipo_activo){
	
	$sql="SELECT tarea.co_tarea_mtto, tarea.tx_tarea_mtto,tarea.tx_descripcion_mtto, tarea.nu_tiempo_tarea FROM sisgesbas.i002t_tarea_mtto as tarea 
	JOIN sisgesbas.i001t_tipo_mtto as tipo on tarea.co_tipo_mtto= tipo.co_tipo_mtto 
	join sisgesbas.i008t_tarea_mtto_activo as tarea_activo on tarea_activo.co_tarea_mtto = tarea.co_tarea_mtto
	join sisgesbas.i006t_clase_activo_detalle as clase_activo using(co_clase_activo_detalle) WHERE tipo.nu_nivel_mtto = $nu_nivel_mtto AND  clase_activo.co_clase_activo_detalle=$tipo_activo";
	$query=$this->db->query($sql);
//echo $this->db->last_query($query); exit();
return $query->result();

}


	public function edit($co_tarea_mtto = null) 
	{
		if($co_tarea_mtto) {
			$data = array(
				'tx_tarea_mtto' => $this->input->post('edit_tx_mto_tarea'),
				'tx_descripcion_mtto' => $this->input->post('edit_tx_mto_descripcion'),
				'nu_tiempo_tarea' => $this->input->post('edit_nu_tiempo_tarea'),
				'co_tipo_mtto' => $this->input->post('edit_co_tipo_mto')
				
			);

			$this->db->where('co_tarea_mtto', $co_tarea_mtto);
			$sql = $this->db->update('sisgesbas.i002t_tarea_mtto', $data);

			if($sql === true) {
				return true; 
			} else {
				return false;
			}
		}
			
	}

	public function tabla($co_tarea_mtto = null) 
	{ ///metodos editar e eliminar debido aque solo recoje los datos de la fila seleccionada con esto se hace la auditoria 
		if($co_tarea_mtto) {
//SELECT tarea.co_tarea_mtto,  tarea.tx_tarea_mtto, tarea.tx_descripcion_mtto as tarea_descripcion, tarea.nu_tiempo_tarea, tarea.co_tipo_mtto, tipo.tx_tipo_mtto, tipo.nu_nivel_mtto as tipo_descripcion, tipo.nu_nivel_mtto FROM sisgesbas.i002t_tarea_mtto as tarea  left JOIN sisgesbas.i001t_tipo_mtto as tipo USING(co_tipo_mtto)			
			$sql = "SELECT tarea.co_tarea_mtto,  tarea.tx_tarea_mtto, tarea.tx_descripcion_mtto as tarea_descripcion, tarea.nu_tiempo_tarea, tarea.co_tipo_mtto, tipo.tx_tipo_mtto, tipo.nu_nivel_mtto as tipo_descripcion, tipo.nu_nivel_mtto FROM sisgesbas.i002t_tarea_mtto as tarea  left JOIN sisgesbas.i001t_tipo_mtto as tipo USING(co_tipo_mtto) WHERE co_tarea_mtto = ?";
			$query = $this->db->query($sql, array($co_tarea_mtto));
			return $query->row_array();
		}
		// esto muestra toda la tabla
		$sql = "SELECT tarea.co_tarea_mtto,  tarea.tx_tarea_mtto, tarea.tx_descripcion_mtto as tarea_descripcion, tarea.nu_tiempo_tarea, tarea.co_tipo_mtto, tipo.tx_tipo_mtto, tipo.nu_nivel_mtto as tipo_descripcion, tipo.nu_nivel_mtto FROM sisgesbas.i002t_tarea_mtto as tarea  left JOIN sisgesbas.i001t_tipo_mtto as tipo USING(co_tipo_mtto)";
		$query = $this->db->query($sql);
		return $query->result_array();
	}




public function obtenerId($co_tarea_mtto)
    {
 $query=$this->db
                ->select("co_tarea_mtto")
                ->from("sisgesbas.i002t_tarea_mtto")
                ->where(array("co_tarea_mtto"=>$co_tarea_mtto))
                ->get();
        //echo $this->db->last_query();exit;        
        return $query->row();     
	}




	public function eliminar($co_tarea_mtto= null) {
		if($co_tarea_mtto) {
			$sql = "DELETE FROM sisgesbas.i002t_tarea_mtto WHERE co_tarea_mtto = ?";
			$query = $this->db->query($sql, array($co_tarea_mtto));

			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}
	
}