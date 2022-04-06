<?php 

/**
* 
*/
class Mseguridad_nivel_usuario extends CI_Model
{

	function __construct()
	{
	parent::__construct();
	$this->load->database();
	//$this->load->model('Mtipo_equipo');
	}


 public function ingresar( $parametro){
$campos=array('tx_nivel' => $parametro['tx_nivel']);
$this->db->insert('sisgesbas.i003t_nivel_usuario',$campos);
	}
public function edit($co_nivel_usuario = null) 
	{
		if($co_nivel_usuario) {
			$data = array(
'tx_nivel' => strtoupper($this->input->post('edit_tx_nivel'))
			);
			$this->db->where('co_nivel_usuario', $co_nivel_usuario);
			$sql = $this->db->update('sisgesbas.i003t_nivel_usuario', $data);

			if($sql === true) {
				return true; 
			} else {
				return false;
			}
		}
	}
	public function tabla($co_nivel_usuario = null) 
	{
		if($co_nivel_usuario) {
			$sql = "SELECT * FROM sisgesbas.i003t_nivel_usuario WHERE co_nivel_usuario = ?";
			$query = $this->db->query($sql, array($co_nivel_usuario));
			return $query->row_array();
		}
		$sql = "SELECT * FROM sisgesbas.i003t_nivel_usuario";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

public function getCombo(){
		$resultados = $this->db->get("sisgesbas.i003t_nivel_usuario");
		return $resultados->result();
	}
	
	public function  combo_nivel_acceso(){
		$this->db->order_by('tx_nivel','asc');
		$tx_nivel_usuario= $this->db->get('sisgesbas.i003t_nivel_usuario');
	//echo $this->db->last_query();exit;
			return $tx_nivel_usuario->result();
	}
public function combo_rol(){
		$this->db->order_by('tx_nivel','asc');
		$tx_nivel= $this->db->get('sisgesbas.i003t_nivel_usuario');
		//echo $this->db->last_query();exit;
			return $tx_nivel->result();
	}

public function check_nivel_usuario($tx_nivel){
				$this->db->select('tx_nivel')
				->where('tx_nivel',$tx_nivel);
				$consulta=$this->db->get('sisgesbas.i003t_nivel_usuario');
				if($consulta->num_rows()>0){
					return true;
				}
			
			}

	public function eliminar($co_nivel_usuario= null) {
		if($co_nivel_usuario) {
			$sql = "DELETE FROM sisgesbas.i003t_nivel_usuario WHERE co_nivel_usuario = ?";
			$query = $this->db->query($sql, array($co_nivel_usuario));

			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}
}

