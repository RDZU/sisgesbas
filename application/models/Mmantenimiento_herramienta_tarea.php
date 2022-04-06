<?php 

class Mmantenimiento_herramienta_tarea extends CI_Model
{
	
	function __construct()
	{
	parent::__construct();
	$this->load->database();
	}

public function insertar($data){
return $this->db->insert("sisgesbas.i004t_tarea_mtto_herramienta",$data);

}



public function Nombre_tarea($co_tarea_mtto=null)
{

$query=$this->db->select("tx_tarea_mtto")
                ->from("sisgesbas.i002t_tarea_mtto")
                ->where(array("co_tarea_mtto"=>$co_tarea_mtto))
                ->get();
            $row = $query->row();
return $row->tx_tarea_mtto;


}
public function eliminar($co_herramienta= null) {
		if($co_herramienta) {
			$sql = "DELETE FROM sisgesbas.i003t_herramienta WHERE co_herramienta = ?";
			$query = $this->db->query($sql, array($co_herramienta));
			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}
public function eliminar_herramienta($co_tarea_mtto_herramienta){
if($co_tarea_mtto_herramienta) {
			$sql = "DELETE FROM sisgesbas.i004t_tarea_mtto_herramienta WHERE co_tarea_mtto_herramienta = ?";
			$query = $this->db->query($sql, array($co_tarea_mtto_herramienta));
			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
}

public function tabla($co_tarea_mtto= null) 
	{
		if($co_tarea_mtto) {
			$sql = "SELECT * FROM sisgesbas.i004t_tarea_mtto_herramienta join sisgesbas.i003t_herramienta using(co_herramienta)  WHERE co_tarea_mtto = ?";
			$query = $this->db->query($sql, array($co_tarea_mtto));
			return $query->result();

		//	echo last_query(); exit;
		}


	
/*
		$sql = "SELECT * FROM sisgesbas.i004t_tarea_mtto_herramienta";
		$query = $this->db->query($sql);
		return $query->result_array();*/
	}

}