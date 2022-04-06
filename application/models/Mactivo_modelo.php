<?php 

class Mactivo_modelo extends CI_Model
{
	
	function __construct()
	{
	parent::__construct();
	$this->load->database();

	}



function ingresar($parametro){

	$campos=array(

		'co_marca' => $parametro['co_marca'],
		'tx_modelo' => $parametro['tx_modelo'],
		'tx_numero_producto' => $parametro['tx_numero_producto'],
		'nu_modelo' => $parametro['nu_modelo']
	);
		$this->db->insert('activo.i005t_modelo',$campos);
	
}

public function edit($co_modelo = null) 
	{
		if($co_modelo) {
			$data = array(

'co_marca' => $this->input->post('edit_co_marca'),
'tx_modelo' => $this->input->post('edit_tx_modelo'),
'tx_numero_producto' => $this->input->post('edit_tx_numero_producto'),
'nu_modelo'=>$this->input->post('edit_nu_modelo')
			);

			$this->db->where('co_modelo', $co_modelo);
			$sql = $this->db->update('activo.i005t_modelo',$data);

			if($sql === true) {
				return true; 
			} else {
				return false;
			}
		}
			
	}

	public function tabla($co_modelo= null) 
	{
		if($co_modelo) {
			$sql = "SELECT activo.i004t_marca.tx_nombre AS marca , activo.i003t_modelo.tx_nombre AS modelo, activo.i003t_modelo.tx_numero_parte AS parte FROM activo.i003t_modelo JOIN activo.i004t_marca USING(co_marca) WHERE co_modelo = ?";
			$query = $this->db->query($sql, array($co_modelo));
			return $query->row_array();
		}

		$sql = "SELECT activo.i004t_marca.tx_nombre AS marca , activo.i003t_modelo.tx_nombre AS modelo, activo.i003t_modelo.tx_numero_parte AS parte FROM activo.i003t_modelo JOIN activo.i004t_marca USING(co_marca)";
		$query = $this->db->query($sql);
		return $query->result_array();
	}


/*
	public function eliminar($co_modelo= null) {
		if($co_modelo) {
			$sql = "DELETE FROM activo.i005t_modelo WHERE co_modelo = ?";
			$query = $this->db->query($sql, array($co_modelo));

			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}

public function id(){
$sql= $this->db->query("select co_modelo, tx_modelo from activo.i005t_modelo");
return $sql->result();
}

function archivo($parametro){
	$campos=array(
		'id' => $parametro['id'],
	);
		$this->db->insert('activo.udo',$campos);
}

 public function obtenerId($co_modelo)
    {
        $query=$this->db
                ->select("co_modelo, tx_modelo")
                ->from("activo.i005t_modelo")
                ->where(array("co_modelo"=>$co_modelo))
                ->get();
        //echo $this->db->last_query();exit;        
        return $query->row();      
//retorna una cola columna

}

public function insertar_archivo($data=array()){
	$this->db->insert('activo.i002t_archivo_modelo',$data);
        return $this->db->insert_id();
}

public function getArchivo($co_modelo)
    {
        $query=$this->db
                ->select("co_archivo_modelo,co_modelo,tx_nombre_archivo")
                ->from("activo.i002t_archivo_modelo")
                ->where(array("co_modelo"=>$co_modelo))
                ->get();
        //echo $this->db->last_query();exit;        
        return $query->result();   
}

public function eliminarArchivo($co_archivo_modelo)
    {
        $this->db->where('co_archivo_modelo',$co_archivo_modelo);
        $this->db->delete('activo.i002t_archivo_modelo');
    }

 public function getArchivo_co_archivo($co_archivo_modelo)
    {
        $query=$this->db
                ->select("*")
                ->from("activo.i002t_archivo_modelo")
                ->where(array("co_archivo_modelo"=>$co_archivo_modelo))
                ->get();
        //echo $this->db->last_query();exit;        
        return $query->row();            
    } 




public function getMarcas(){

	$this->db->order_by('tx_marca','asc');
	$marcas= $this->db->get('activo.i004t_marca');

	if($marcas->num_rows()>0 ){
		return $marcas->result();
	}
}

public function getModelos($co_marca){
$this->db->where('co_marca',$co_marca);
$this->db->order_by('tx_modelo','asc');
$modelos= $this->db->get('activo.i005t_modelo');

if($modelos->num_rows()>0){
	return $modelos->result();
}
}
*/

}