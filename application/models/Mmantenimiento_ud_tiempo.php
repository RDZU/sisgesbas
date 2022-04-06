<?php 

class Mmantenimiento_ud_tiempo extends CI_Model
{
	
	function __construct()
	{
	parent::__construct();
	$this->load->database();
	}

 public function ingresar($parametro){
$campos=array(
'tx_unidad_tiempo' => $parametro['tx_unidad_tiempo']
);
$mensaje=$this->db->insert('sisgesbas.i005t_unidad_tiempo',$campos);
if($mensaje === true) {
	return true; 
} else {
	return false;
}
	}

public function combo_tiempo(){
$sql= $this->db->query("select * from sisgesbas.i005t_unidad_tiempo order by tx_unidad_tiempo asc");
return $sql->result();
}
public function  combo_ud_tiempo(){
	$this->db->order_by('tx_unidad_tiempo','asc');
	$unidad_tiempo =$this->db->get('sisgesbas.i005t_unidad_tiempo');
		return $unidad_tiempo->result();
}
	
public function edit($co_unidad_tiempo = null) 
	{
		if($co_unidad_tiempo) {
			$data = array(
		'tx_unidad_tiempo' => strtoupper($this->input->post('edit_tx_unidad_tiempo'))
			);

			$this->db->where('co_unidad_tiempo', $co_unidad_tiempo);
			$sql = $this->db->update('sisgesbas.i005t_unidad_tiempo', $data);
			if($sql === true) {
				return true; 
			} else {
				return false;
			}
		}
	}
			
	
	public function tabla($co_unidad_tiempo= null) 
	{
		if($co_unidad_tiempo) {
			$sql = "SELECT * FROM sisgesbas.i005t_unidad_tiempo WHERE co_unidad_tiempo = ?";
			$query = $this->db->query($sql, array($co_unidad_tiempo));
			return $query->row_array();
		}

		$sql = "SELECT * FROM sisgesbas.i005t_unidad_tiempo";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function eliminar($co_unidad_tiempo= null) {
		if($co_unidad_tiempo) {
			$sql = "DELETE FROM sisgesbas.i005t_unidad_tiempo WHERE co_unidad_tiempo = ?";
			$query = $this->db->query($sql, array($co_unidad_tiempo));
			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}/*
	public function check_modulo($tx_modulo){
				$this->db->select('tx_modulo')
				->where('tx_modulo',$tx_modulo);
				$consulta=$this->db->get('sisgesbas.i002t_modulo');
				if($consulta->num_rows()>0){
					return true;
				}
			}*/
	// insert 
	public function check_unidad_tiempo($tx_unidad_tiempo){
	
	$this->db->select('tx_unidad_tiempo')
		->where('tx_unidad_tiempo',$tx_unidad_tiempo);
		$consulta=$this->db->get('sisgesbas.i005t_unidad_tiempo');
		if($consulta->num_rows()>0){
			return true;
		}
	}

public function datos_frecuencia($id){
	$datos=$this->db->select('tx_unidad_tiempo')
	->from('sisgesbas.i005t_unidad_tiempo')
	->where('co_unidad_tiempo',$id)
	->get();
	$row=$datos->row();
	return $row->tx_unidad_tiempo;
}


}