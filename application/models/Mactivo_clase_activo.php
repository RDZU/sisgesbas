<?php 

class Mactivo_clase_activo extends CI_Model
{
	
	function __construct()
	{
	parent::__construct();
	$this->load->database();
	}

 public function ingresar( $parametro){
$campos=array(
'tx_clase_activo' => $parametro['tx_clase_activo'],
'tx_abreviatura' => $parametro['tx_abreviatura']
);
$mensaje=$this->db->insert('sisgesbas.i007t_clase_activo',$campos);
if($mensaje === true) {
	return true; 
} else {
	return false;
}
	}

public function combo(){
$sql= $this->db->query("select co_clase_activo, tx_clase_activo from sisgesbas.i007t_clase_activo order by tx_clase_activo asc");
return $sql->result();
}
public function combo2(){
	$sql= $this->db->query("select co_clase_activo_detalle, tx_clase_activo_detalle from sisgesbas.i006t_clase_activo_detalle order by tx_clase_activo_detalle asc");
	return $sql->result();
	}

/*
 $query = $this->db->get_where(TABLE_PRODUCTOS, array('key_suscriptor' => $data['key_suscriptor']));
            if ($query->num_rows() > 0) {
                echo'<script>alert("Error. !alguien ya ah registrado ese código!")</script>';
            } else {
     echo'<script>alert("!Gracias por resgistrarte!")/script>'             
$this->db->insert(TABLE_PRODUCTOS,$data);
                }
*/
public function edit($co_clase_activo = null) {
if($co_clase_activo) {
$data = array(
'tx_clase_activo' => $this->input->post('edit_tx_clase_activo'),
'tx_abreviatura' =>  $this->input->post('edit_tx_abreviatura'));

$this->db->where('co_clase_activo', $co_clase_activo);
$sql = $this->db->update('sisgesbas.i007t_clase_activo',$data);

			if($sql === true) {
				return true; 
			} else {

			//	echo'<script>alert("Ha ocurrido un error interno dentro de la base de datos")/script>'; 
				return false;
			}
		}
			
	}
	public function tabla($co_clase_activo = null) 
	{
		if($co_clase_activo) {
			$sql = "SELECT * FROM sisgesbas.i007t_clase_activo WHERE co_clase_activo = ?";
			$query = $this->db->query($sql, array($co_clase_activo));
			return $query->row_array();
		}

		$sql = "SELECT * FROM sisgesbas.i007t_clase_activo";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function eliminar($co_clase_activo= null) {
		if($co_clase_activo) {
			$sql = "DELETE FROM sisgesbas.i007t_clase_activo WHERE co_clase_activo = ?";
			$query = $this->db->query($sql, array($co_clase_activo));

			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}
	
	// insert 
	public function check_tipo_activo($tx_clase_activo){
		//$tx_clase_activo=strtoupper($tx_clase_activo);
	$this->db->select('tx_clase_activo', COUNT('tx_clase_activo'))
		->where('tx_clase_activo',$tx_clase_activo);
		$consulta=$this->db->get('sisgesbas.i007t_clase_activo');
		if($consulta->num_rows()>0){
			return true;
		}
	}
	public function check_tipo_activo_edit($co_clase_activo,$tx_clase_activo){
		//$tx_clase_activo=strtoupper($tx_clase_activo);
	$this->db->select('tx_clase_activo', COUNT('tx_clase_activo'))
		->where('tx_clase_activo',$tx_clase_activo)
		->where('co_clase_activo !=',$co_clase_activo);
		$consulta=$this->db->get('sisgesbas.i007t_clase_activo');
		if($consulta->num_rows()>0){
			return true;
		}
		return false;
	}

	public function check_abreviatura($tx_abreviatura){
		$this->db->select('tx_abreviatura')
		->where('tx_abreviatura',$tx_abreviatura);
		$consulta=$this->db->get('sisgesbas.i007t_clase_activo');
		if($consulta->num_rows()>0){
		
			return true;
		}
	}

	public function check_abreviatura_edit($co_clase_activo,$tx_abreviatura){
		$this->db->select('tx_abreviatura')
		->where('tx_abreviatura',$tx_abreviatura)
		->where('co_clase_activo !=',$co_clase_activo);
		$consulta=$this->db->get('sisgesbas.i007t_clase_activo');
		if($consulta->num_rows()>0){
		
			return true;
		}
		return false;
	
	}


}