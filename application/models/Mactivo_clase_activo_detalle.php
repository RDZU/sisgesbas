<?php 

class Mactivo_clase_activo_detalle extends CI_Model
{
	
	function __construct()
	{
	parent::__construct();
	$this->load->database();
	}

 public function ingresar( $parametro){
$campos=array(
'tx_clase_activo_detalle' => $parametro['tx_clase_activo_detalle'],
'tx_abreviatura' => $parametro['tx_abreviatura'],
'co_clase_activo' => $parametro['co_clase_activo']
);
$mensaje=$this->db->insert('sisgesbas.i006t_clase_activo_detalle',$campos);
if($mensaje === true) {
	return true; 
} else {
	return false;
}
	}

public function combo(){
$sql= $this->db->query("select co_clase_activo_detalle, tx_clase_activo_detalle from sisgesbas.i006t_clase_activo_detalle order by tx_clase_activo_detalle asc");
return $sql->result();
}


public function edit($co_clase_activo_detalle = null) {
if($co_clase_activo_detalle) {
$data = array(
'tx_clase_activo_detalle' => $this->input->post('edit_tx_clase_activo_detalle'),
'tx_abreviatura' =>  $this->input->post('edit_tx_abreviatura'),
'co_clase_activo' =>  $this->input->post('edit_co_clase_activo'));

$this->db->where('co_clase_activo_detalle', $co_clase_activo_detalle);
$sql = $this->db->update('sisgesbas.i006t_clase_activo_detalle',$data);

			if($sql === true) {
				return true; 
			} else {
				return false;
			}
		}
			
	}
	public function tabla($co_clase_activo_detalle = null) 
	{
		if($co_clase_activo_detalle) {
$sql = " SELECT sisgesbas.i006t_clase_activo_detalle.co_clase_activo_detalle , sisgesbas.i007t_clase_activo.co_clase_activo , sisgesbas.i007t_clase_activo.tx_clase_activo as clase , sisgesbas.i007t_clase_activo.tx_abreviatura as abreviatura_clase , sisgesbas.i006t_clase_activo_detalle.tx_clase_activo_detalle as tipo ,  sisgesbas.i006t_clase_activo_detalle.tx_abreviatura as abreviatura_tipo from sisgesbas.i006t_clase_activo_detalle   join sisgesbas.i007t_clase_activo USING(co_clase_activo) WHERE co_clase_activo_detalle = ?";
			$query = $this->db->query($sql, array($co_clase_activo_detalle));
			return $query->row_array();
		}

		$sql = " SELECT sisgesbas.i006t_clase_activo_detalle.co_clase_activo_detalle , sisgesbas.i007t_clase_activo.co_clase_activo  ,sisgesbas.i007t_clase_activo.tx_clase_activo as clase , sisgesbas.i007t_clase_activo.tx_abreviatura as abreviatura_clase , sisgesbas.i006t_clase_activo_detalle.tx_clase_activo_detalle as tipo ,  sisgesbas.i006t_clase_activo_detalle.tx_abreviatura as abreviatura_tipo from sisgesbas.i006t_clase_activo_detalle   join sisgesbas.i007t_clase_activo USING(co_clase_activo)";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function eliminar($co_clase_activo_detalle= null) {
		if($co_clase_activo_detalle) {
			$sql = "DELETE FROM sisgesbas.i006t_clase_activo_detalle WHERE co_clase_activo_detalle = ?";
			$query = $this->db->query($sql, array($co_clase_activo_detalle));

			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}
	
	// insert 
	public function check_abreviatura($tx_abreviatura){
		$this->db->select('tx_abreviatura')
		->where('tx_abreviatura',$tx_abreviatura);
		$consulta=$this->db->get('sisgesbas.i006t_clase_activo_detalle');
		if($consulta->num_rows()>0){
			return true;
		}
	}

	public function check_abreviatura_edit($co_clase_activo_detalle,$tx_abreviatura){
		$this->db->select('co_clase_activo_detalle,tx_abreviatura')
		->where('tx_abreviatura',$tx_abreviatura)
		->where('co_clase_activo_detalle !=',$co_clase_activo_detalle);
		$consulta=$this->db->get('sisgesbas.i006t_clase_activo_detalle');
		//print_r($consulta);
		//echo $this->db->last_query($consulta); exit;
		if($consulta->num_rows()>0){
			return true;
		}
		return false;
	}


	/*

public function getModelos($co_marca){
$this->db->where('co_marca',$co_marca);
$this->db->order_by('tx_modelo','asc');
$modelos= $this->db->get('activo.i005t_modelo');

if($modelos->num_rows()>0){
	return $modelos->result();
}
}
	*/

	

	public function get_tipo_activo($co_clase_activo){
$this->db->where('co_clase_activo',$co_clase_activo);
$this->db->order_by('tx_clase_activo_detalle','asc');
$tipo_activo= $this->db->get('sisgesbas.i006t_clase_activo_detalle');

if($tipo_activo->num_rows()>0){
	return $tipo_activo->result();
}

	}

	public function check_clase_activo($tx_clase_activo_detalle){
		$this->db->select('tx_clase_activo_detalle')
		->where('tx_clase_activo_detalle',$tx_clase_activo_detalle);
		$consulta=$this->db->get('sisgesbas.i006t_clase_activo_detalle');
		if($consulta->num_rows()>0){
			return true;
		}
	}

	public function check_clase_activo_edit($co_clase_activo_detalle,$tx_clase_activo_detalle){
		$this->db->select('tx_clase_activo_detalle')
		->where('tx_clase_activo_detalle',$tx_clase_activo_detalle)
		->where('co_clase_activo_detalle !=',$co_clase_activo_detalle);
		$consulta=$this->db->get('sisgesbas.i006t_clase_activo_detalle');
		if($consulta->num_rows()>0){
			return true;
		}
		return false;
	}
}