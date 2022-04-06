<?php 

/**
* 
*/
class Mtipo_mto extends CI_Model
{



//private $BASE_DE_DATOS_LOCAL;

//// private $db3; //base de datos de la workstation

    function __construct() {
        parent::__construct();
     //   $this->BASE_DE_DATOS_LOCAL = $this->load->database('default', TRUE);
     ////   $this->db3=$this->load->database('workstation', TRUE);

    }

public function ingresar( $parametro){
$campos=array(
'tx_tipo_mtto' => $parametro['tx_mto_tipo'],
'nu_nivel_mtto' => $parametro['nu_mto_nivel'],
'tx_descripcion_mtto' => $parametro['tx_mto_descripcion']
);
$this->db->insert('sisgesbas.i001t_tipo_mtto',$campos);
	}



	public function edit($co_tipo_mtto = null) 
	{
		if($co_tipo_mtto) {
			$data = array(
			
				'tx_tipo_mtto' => $this->input->post('edit_tx_mto_tipo'),
				'nu_nivel_mtto' => $this->input->post('edit_nu_mto_nivel'),
				'tx_descripcion_mtto' => $this->input->post('edit_tx_mto_descripcion',true)
			);

			$this->db->where('co_tipo_mtto', $co_tipo_mtto);
			$sql = $this->db->update('sisgesbas.i001t_tipo_mtto', $data);

			if($sql === true) {
				return true; 
			} else {
				return false;
			}
		}				
	}



	public function tabla($co_tipo_mtto = null) 
	{
		if($co_tipo_mtto) {
			$sql = "SELECT * FROM sisgesbas.i001t_tipo_mtto WHERE co_tipo_mtto = ?";
			$query = $this->db->query($sql, array($co_tipo_mtto));
			return $query->row_array();
		}

		$sql = "SELECT * FROM sisgesbas.i001t_tipo_mtto";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function eliminar($co_tipo_mtto= null) {
		if($co_tipo_mtto) {
			$sql = "DELETE FROM sisgesbas.i001t_tipo_mtto WHERE co_tipo_mtto = ?";
			$query = $this->db->query($sql, array($co_tipo_mtto));

			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}

	public function  combo_nivel_mtto(){
		$this->db->order_by('nu_nivel_mtto','asc');
		$nu_nivel_mtto= $this->db->get('sisgesbas.i001t_tipo_mtto');
			return $nu_nivel_mtto->result();
	}

	public function buscar_nivel_mtto($co_tipo_mtto){
		//SELECT * from sisgesbas.i001t_tipo_mtto where co_tipo_mtto = 6
		$this->db->select('nu_nivel_mtto');
		$this->db->where('co_tipo_mtto',$co_tipo_mtto);
		$query=$this->db->get('sisgesbas.i001t_tipo_mtto');
	//	echo $this->db->last_query($query); exit;
		return $query->row_array();
	
	}

	public function check_mtto($tx_mto_tipo,$nu_mto_nivel){
	
			$this->db->select('tx_tipo_mtto','nu_nivel_mtto');
			$this->db->where('tx_tipo_mtto',$tx_mto_tipo);
			$this->db->where('nu_nivel_mtto',$nu_mto_nivel);
			$consulta=$this->db->get('sisgesbas.i001t_tipo_mtto');
			if($consulta->num_rows()>0){
				return true;
			}
	}
	public function nivel_mtto_edit($id){
		$nu_mto_nivel=$this->db->select("nu_nivel_mtto")
		->from("sisgesbas.i001t_tipo_mtto")
		->where(array("co_tipo_mtto"=>$id))
		->get();
		$row = $nu_mto_nivel->row();
		return $row->nu_nivel_mtto;
	}
	public function check_mtto_edit($id,$tx_mto_tipo,$nu_mto_nivel){
		
				$this->db->select('tx_tipo_mtto','nu_nivel_mtto');
				$this->db->where('tx_tipo_mtto',$tx_mto_tipo);
				$this->db->where('nu_nivel_mtto',$nu_mto_nivel);
				$this->db->where('co_tipo_mtto !=',$id);
				$consulta=$this->db->get('sisgesbas.i001t_tipo_mtto');
				if($consulta->num_rows()>0){
					return true;
				}
				return false;
		}
}