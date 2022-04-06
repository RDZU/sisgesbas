<?php 


class Mseguridad_usuario extends CI_Model
{
	public function ingresar( $parametro){
		$campos=array(
		'tx_nombre' => $parametro['tx_nombre'],
		'tx_apellido' => $parametro['tx_apellido'],
		'tx_indicador' => $parametro ['tx_indicador'],
		'co_nivel_usuario' => $parametro ['co_nivel_usuario'],
		);
		$mensaje=$this->db->insert('sisgesbas.i001t_usuario',$campos);
		if($mensaje === true) {
						return true; 
					} else {
						return false;
					}
			}
		
			public function edit($co_usuario = null) 
			{
				if($co_usuario) {
					$data = array(
						'co_nivel_usuario' => $this->input->post('edit_co_nivel_usuario')
					);
		
					$this->db->where('co_usuario', $co_usuario);
					$sql = $this->db->update('sisgesbas.i001t_usuario',$data);
		
					if($sql === true) {
						return true; 
					} else {
						return false;
					}
				}
					
			}
		
			public function tabla($co_usuario = null) 
			{
				if($co_usuario) {
					$sql = "SELECT * FROM sisgesbas.i001t_usuario JOIN sisgesbas.i003t_nivel_usuario USING(co_nivel_usuario) WHERE co_usuario = ?";
					$query = $this->db->query($sql, array($co_usuario));
					return $query->row_array();
				}
		
				$sql = "SELECT * FROM sisgesbas.i001t_usuario  JOIN sisgesbas.i003t_nivel_usuario USING(co_nivel_usuario)";
				$query = $this->db->query($sql);
				return $query->result_array();
			}
		
			public function eliminar($co_usuario= null) {
				if($co_usuario) {
					$sql = "DELETE FROM sisgesbas.i001t_usuario WHERE co_usuario = ?";
					$query = $this->db->query($sql, array($co_usuario));
		
					// ternary operator
					return ($query === true) ? true : false;			
				} //
			}

			public function check_indicador($tx_indicador){
				$this->db->select('tx_indicador')
				->where('tx_indicador',$tx_indicador);
				$consulta=$this->db->get('sisgesbas.i001t_usuario');
				if($consulta->num_rows()>0){
					return true;
				}
			
			}

			public function login($usuario){
							$this->db->select('tx_indicador')
							->where('tx_indicador',$usuario);
							$usuario_sistema=$this->db->get('sisgesbas.i001t_usuario');
							if($usuario_sistema->num_rows()>0){
								return 1;
}
			}



public function numero_usuario($usuario){
$numero_usu=$this->db->select("co_usuario")
    ->from("sisgesbas.i001t_usuario")
    ->where(array("tx_indicador"=>$usuario))
    ->get();
    $row = $numero_usu->row();
	return $row->co_usuario;
}		


//SE AGREGO PORQUEEN LA RPESENTACION DE LA TESIS NO SE PUEDE CONECTAR AL DIRECTORIO ACTIVO, 
public function indicador($usuario){
	$indicador=$this->db->select("tx_indicador")
		->from("sisgesbas.i001t_usuario")
		->where(array("tx_indicador"=>$usuario))
		->get();
		if($indicador->num_rows()>0){
			return 1;
			}
	}	

public function nombre($usuario){
	$nombre=$this->db->select("tx_nombre")
		->from("sisgesbas.i001t_usuario")
		->where(array("tx_indicador"=>$usuario))
		->get();
		$row = $nombre->row();
		return $row->tx_nombre;
	}	
	public function apellido($usuario){
		$apellido=$this->db->select("tx_apellido")
			->from("sisgesbas.i001t_usuario")
			->where(array("tx_indicador"=>$usuario))
			->get();
			$row = $apellido->row();
			return $row->tx_apellido;
		}		
}