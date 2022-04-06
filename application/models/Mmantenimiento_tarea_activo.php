<?php
class Mmantenimiento_tarea_activo extends CI_Model
{
	
	function __construct()
	{
	parent::__construct();
	$this->load->database();
	}

    public function insertar($data){
$this->db->insert('sisgesbas.i008t_tarea_mtto_activo',$data);
    }


    public function tabla_tipo_activo($co_tarea_mtto = null,$co_tarea_mtto_activo) 
	{ ///metodos editar e eliminar debido aque solo recoje los datos de la fila seleccionada con esto se hace la auditoria 
		if($co_tarea_mtto_activo) {
//SELECT tarea.co_tarea_mtto,  tarea.tx_tarea_mtto, tarea.tx_descripcion_mtto as tarea_descripcion, tarea.nu_tiempo_tarea, tarea.co_tipo_mtto, tipo.tx_tipo_mtto, tipo.nu_nivel_mtto as tipo_descripcion, tipo.nu_nivel_mtto FROM sisgesbas.i002t_tarea_mtto as tarea  left JOIN sisgesbas.i001t_tipo_mtto as tipo USING(co_tipo_mtto)			
			$sql = "  SELECT tarea.co_tarea_mtto_activo,clase.tx_clase_activo, clase.tx_abreviatura as clase_abreviatura,tipo.tx_clase_activo_detalle, tipo.tx_abreviatura tipo_abreviatura  FROM sisgesbas.i008t_tarea_mtto_activo as tarea JOIN sisgesbas.i006t_clase_activo_detalle as tipo USING(co_clase_activo_detalle) JOIN sisgesbas.i007t_clase_activo as clase USING(co_clase_activo) WHERE co_tarea_mtto_activo = $co_tarea_mtto_activo";
			$query = $this->db->query($sql, array($co_tarea_mtto_activo));
			return $query->row_array();
        }
        if($co_tarea_mtto){
		// esto muestra toda la tabla
		$sql = "SELECT tarea.co_tarea_mtto_activo,clase.tx_clase_activo, clase.tx_abreviatura as clase_abreviatura,tipo.tx_clase_activo_detalle, tipo.tx_abreviatura tipo_abreviatura  FROM sisgesbas.i008t_tarea_mtto_activo as tarea JOIN sisgesbas.i006t_clase_activo_detalle as tipo USING(co_clase_activo_detalle) JOIN sisgesbas.i007t_clase_activo as clase USING(co_clase_activo) WHERE co_tarea_mtto = $co_tarea_mtto";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
}

public function eliminar_tipo_activo($co_tarea_mtto_activo){
	if($co_tarea_mtto_activo) {
				$sql = "DELETE FROM sisgesbas.i008t_tarea_mtto_activo WHERE co_tarea_mtto_activo = ?";
				$query = $this->db->query($sql, array($co_tarea_mtto_activo));
				// ternary operator
				return ($query === true) ? true : false;			
			} // /if
	}
	
	public function tabla($co_tarea_mtto= null) 
		{
			if($co_tarea_mtto) {
				$sql = "SELECT tarea.co_tarea_mtto_activo,clase.tx_clase_activo, clase.tx_abreviatura as clase_abreviatura,tipo.tx_clase_activo_detalle, tipo.tx_abreviatura tipo_abreviatura  FROM sisgesbas.i008t_tarea_mtto_activo as tarea JOIN sisgesbas.i006t_clase_activo_detalle as tipo USING(co_clase_activo_detalle) JOIN sisgesbas.i007t_clase_activo as clase USING(co_clase_activo) WHERE co_tarea_mtto = $co_tarea_mtto";
				//$sql = "SELECT * FROM sisgesbas.i008t_tarea_mtto_activo join sisgesbas.i006t_clase_activo_detalle using(co_clase_activo_detalle)  WHERE co_tarea_mtto = ?";
				$query = $this->db->query($sql, array($co_tarea_mtto));
				return $query->result();
	
			//	echo last_query(); exit;
			}
	
		}

}
