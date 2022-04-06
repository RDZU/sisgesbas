<?php 

/**
* 
*/
class Mseguridad_modulo extends CI_Model
{

	function __construct()
	{
	parent::__construct();
	$this->load->database();
	//$this->load->model('Mtipo_equipo');
	}

 public function ingresar( $parametro){
$campos=array('tx_modulo' => $parametro['tx_modulo']);
$this->db->insert('sisgesbas.i002t_modulo',$campos);
	}


	
public function edit($co_modulo = null) 
	{
		if($co_modulo) {
			$data = array(
		'tx_modulo' => strtoupper($this->input->post('edit_tx_modulo'))
			);

			$this->db->where('co_modulo', $co_modulo);
			$sql = $this->db->update('sisgesbas.i002t_modulo', $data);
			if($sql === true) {
				return true; 
			} else {
				return false;
			}
		}
	}
	public function tabla($co_modulo = null) 
	{
		if($co_modulo) {
			$sql = "SELECT * FROM sisgesbas.i002t_modulo WHERE co_modulo = ?";
			$query = $this->db->query($sql, array($co_modulo));
			return $query->row_array();
		}

		$sql = "SELECT * FROM sisgesbas.i002t_modulo";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function eliminar($co_modulo= null) {
		if($co_modulo) {
			$sql = "DELETE FROM sisgesbas.i002t_modulo WHERE co_modulo = ?";
			$query = $this->db->query($sql, array($co_modulo));

			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}

public function combo_menu(){
		$this->db->order_by('tx_modulo','asc');
		$tx_modulo= $this->db->get('sisgesbas.i002t_modulo');
		//echo $this->db->last_query();exit;
			return $tx_modulo->result();		
	}
	
public function check_modulo($tx_modulo){
				$this->db->select('tx_modulo')
				->where('tx_modulo',$tx_modulo);
				$consulta=$this->db->get('sisgesbas.i002t_modulo');
				if($consulta->num_rows()>0){
					return true;
				}
			}

}



