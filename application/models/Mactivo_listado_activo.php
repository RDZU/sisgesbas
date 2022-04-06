<?php 

class Mactivo_listado_activo extends CI_Model
{
	
	
    var $table = 'activo.c001t_activo activo';
    var $column = array('tx_serial','tx_nota','tx_nombre','tx_etiqueta','fe_inicio_asig','tx_direccion','co_clase_activo','co_clase_activo_detalle','tx_clase_activo','tx_clase_activo_detalle','nu_prioridad','tx_criticidad');
	//var $column = array('tx_serial','tx_nota','co_modelo','tx_etiqueta','fe_inicio_asig','tx_direccion','co_clase_activo_detalle','nu_prioridad','tx_criticidad','tx_sap');
	var $order = array('co_activo' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		    $this->search = '';

	}

/*
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
    
    */
    

    
//serve side processing
//row_array returns a single result and 
//result_array returns multiple results
//	Number of rows in the result set


public function encontrar_activo($valor){
$activo=$this->db->select("tx_etiqueta,tx_serial")
		->from("activo.c001t_activo")
		->where("tx_serial",$valor)
		->or_where('tx_etiqueta', $valor)
		->get();
		//true
		if($activo->num_rows()>0){
			return 1;
			}

}

public function datos_activo($co_activo){
	$this->db->select('co_activo,tx_serial, activo.i004t_marca.tx_nombre as marca, activo.i003t_modelo.tx_nombre as modelo,tx_clase_activo_detalle,tx_clase_activo,tx_etiqueta,tx_direccion,tx_criticidad');
	$this->db->from("activo.c001t_activo");
	$this->db->join('activo.i003t_modelo','co_modelo');
	$this->db->join('activo.i004t_marca','co_marca');
	$this->db->join('sisgesbas.i006t_clase_activo_detalle','activo.c001t_activo.co_clase_activo_detalle=sisgesbas.i006t_clase_activo_detalle.co_clase_activo_detalle');
	$this->db->join('sisgesbas.i007t_clase_activo','sisgesbas.i006t_clase_activo_detalle.co_clase_activo=sisgesbas.i007t_clase_activo.co_clase_activo');
	$this->db->where('co_activo',$co_activo);
	$resultado=$this->db->get();
//	$this->db->last_query(); exit;
	return $resultado->result();
}

public function check_encontrar_asig_activo($valor){
	/*
	public function check_unidad_tiempo($tx_unidad_tiempo){
	
	$this->db->select('tx_unidad_tiempo')
		->where('tx_unidad_tiempo',$tx_unidad_tiempo);
		$consulta=$this->db->get('sisgesbas.i005t_unidad_tiempo');
		if($consulta->num_rows()>0){
			return true;
		}
	}

SELECT i006t_clase_activo_detalle.co_clase_activo_detalle
FROM activo.c001t_activo JOIN sisgesbas.i006t_clase_activo_detalle USING(co_clase_activo_detalle)
WHERE tx_serial
	*/
	$this->db->from("activo.c001t_activo");
	$this->db->join('sisgesbas.i006t_clase_activo_detalle','co_clase_activo_detalle');
	$this->db->where('tx_serial',$valor);
	$this->db->or_where('tx_etiqueta', $valor);
	$resultado=$this->db->get();

	$this->db->from("activo.c001t_activo");
	$this->db->where('tx_serial',$valor);
	$this->db->or_where('tx_etiqueta', $valor);
	$resultado2=$this->db->get();
	if($resultado2->num_rows()==0){
		return 1;
	}
	if($resultado->num_rows()==0 && $resultado2->num_rows()>0){
		return 2;
	}
	// echo $this->db->last_query($resultado); exit;
}

public function buscar_activo($valor){
$this->db->select("co_activo, tx_serial, tx_etiqueta, co_clase_activo_detalle");
$this->db->from("activo.c001t_activo");
$this->db->where("tx_serial",$valor);
$this->db->or_where('tx_etiqueta', $valor); 
//$this->db->limit(100);
$resultado=$this->db->get();
 // echo $this->db->last_query($resultado); exit;
return $resultado->row_array();

}

private function _get_datatables_query()
{
	/////////JOIN

	$this->db->from($this->table);
	$this->db->join('activo.i003t_modelo modelo','co_modelo');
	$this->db->join('activo.i004t_marca','co_marca');
	$this->db->join('sisgesbas.i006t_clase_activo_detalle tipo','co_clase_activo_detalle','left');
	$this->db->join('sisgesbas.i007t_clase_activo clase', 'tipo.co_clase_activo = clase.co_clase_activo', 'left');
	//$this->db->join('activo.i004t_marca', 'activo.i004t_marca.co_marca = activo.i003t_modelo.co_marca', 'INNER');
	$i = 0;

	foreach ($this->column as $item) 
	{
		if($_POST['search']['value'])
			($i===0) ? $this->db->like('tx_serial', $_POST['search']['value']) : $this->db->or_like('tx_etiqueta', $_POST['search']['value']);
		$column[$i] = $item;
		$i++;
	}
	
	if(isset($_POST['order']))
	{
		$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	} 
	else if(isset($this->order))
	{
		$order = $this->order;
		$this->db->order_by(key($order), $order[key($order)]);
	}
}

function get_datatables()
{
	$this->_get_datatables_query();
	if($_POST['length'] != -1)
	$this->db->limit($_POST['length'], $_POST['start']);
	$query = $this->db->get();
   // echo $this->db->last_query($query);exit;
	return $query->result();
}

function count_filtered()
{
	$this->_get_datatables_query();
	$query = $this->db->get();
	return $query->num_rows();
}

public function count_all()
{/////////////////////////////////JOIN
	$this->db->from($this->table);
	return $this->db->count_all_results();
}

public function get_by_id($id)
{//////////////////////////////////////JOIN
	$this->db->from($this->table);
	$this->db->join('activo.i003t_modelo modelo','co_modelo');
	$this->db->join('activo.i004t_marca','co_marca');
	$this->db->join('sisgesbas.i006t_clase_activo_detalle tipo','co_clase_activo_detalle','left');
	$this->db->join('sisgesbas.i007t_clase_activo clase', 'tipo.co_clase_activo = clase.co_clase_activo', 'left');
	$this->db->where('co_activo',$id);
	$query = $this->db->get();

	return $query->row();
}

public function save($data)
{
	$this->db->insert($this->table, $data);
	return $this->db->insert_id();
}

public function update($where, $data)
{
	$che=$this->db->update($this->table, $data, $where);
	//echo $this->db->last_query($che);exit;
	return $this->db->affected_rows();
}

public function delete_by_id($id)
{
	$this->db->where('co_activo', $id);
	$this->db->delete($this->table);
}

	public function get_by_id_view($id)
{///////////////////////////////////////JOIN
	$this->db->from($this->table);
	
	$this->db->where('co_activo',$id);
	$query = $this->db->get();
	if($query->num_rows() > 0) {
		$results = $query->result();
	}
	return $results;
}

}



