<?php 

class Mmantenimiento_herramienta extends CI_Model
{
	
	function __construct()
	{
	parent::__construct();
	$this->load->database();
	}

 public function ingresar($parametro){
$campos=array(
'tx_herramienta' => $parametro['tx_herramienta'],
'tx_tipo' => $parametro['tx_tipo']
);
$mensaje=$this->db->insert('sisgesbas.i003t_herramienta',$campos);
if($mensaje === true) {
	return true; 
} else {
	return false;
}
	}

public function combo_herramienta(){
$sql= $this->db->query("select co_herramienta, tx_herramienta from sisgesbas.i003t_herramienta order by tx_herramienta asc");
return $sql->result();
}


public function edit($co_herramienta = null) {
if($co_herramienta) {
$data = array(
'tx_herramienta' =>  $this->input->post('edit_tx_herramienta',true),
'tx_tipo' =>  $this->input->post('edit_tx_tipo'));

$this->db->where('co_herramienta', $co_herramienta);
$sql = $this->db->update('sisgesbas.i003t_herramienta',$data);

			if($sql === true) {
				return true; 
			} else {
				return false;
			}
		}
			
	}
	public function tabla($co_herramienta= null) 
	{
		if($co_herramienta) {
			$sql = "SELECT * FROM sisgesbas.i003t_herramienta WHERE co_herramienta = ?";
			$query = $this->db->query($sql, array($co_herramienta));
			return $query->row_array();
		}

		$sql = "SELECT * FROM sisgesbas.i003t_herramienta";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function eliminar($co_herramienta= null) {
		if($co_herramienta) {
			$sql = "DELETE FROM sisgesbas.i003t_herramienta WHERE co_herramienta = ?";
			$query = $this->db->query($sql, array($co_herramienta));
			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}
	
public function buscar_herramienta(){
	$sql =  "SELECT * FROM sisgesbas.i003t_herramienta";
	$query = $this->db->query($sql);
	return $query->result();
}


public function check_herramienta_edit($id,$tx_herramienta){
	
	$this->db->select('tx_herramienta')

		->where('tx_herramienta',$tx_herramienta)
		->where('co_herramienta !=',$id);
		$consulta=$this->db->get('sisgesbas.i003t_herramienta');
		if($consulta->num_rows()>0){
			return true;
		}
		return false;
	}

	public function check_herramienta($tx_herramienta){
	
	$this->db->select('tx_herramienta')
		->where('tx_herramienta',$tx_herramienta);
		$consulta=$this->db->get('sisgesbas.i003t_herramienta');
		if($consulta->num_rows()>0){
			return true;
		}
	}

}