
<?php 


class Mseguridad_permisologia extends CI_Model
{
public function ingresar( $parametro){
$campos=array(
'co_nivel_usuario' => $parametro['co_nivel_usuario'],
'co_modulo' => $parametro ['co_modulo'],
'in_insertar' => $parametro['in_insertar'],
'in_editar' => $parametro['in_editar'],
'in_eliminar' => $parametro['in_eliminar'],
'in_entrar' => $parametro['in_entrar']
);
$this->db->insert('sisgesbas.i004t_permisologia',$campos);
}
	public function edit($co_permisologia = null) 
	{
		if($co_permisologia) {
			$data = array(
			//	'co_nivel_usuario' => $this->input->post('edit_co_nivel_usuario'),
			//	'co_modulo' => $this->input->post('edit_co_modulo'),
			//	'in_insertar' => $this->input->post('edit_in_insertar'),
			//	'in_editar' => $this->input->post('edit_in_editar'),
			//	'in_eliminar' => $this->input->post('edit_in_eliminar'),
				'in_entrar' => $this->input->post('edit_in_entrar')
			);
			
			$this->db->where('co_permisologia', $co_permisologia);
			$sql = $this->db->update('sisgesbas.i004t_permisologia', $data);
			if($sql === true) {
				return true; 
			} else {
				return false;
			}
		}	
	}
	public function tabla($co_permisologia = null) 
	{
		if($co_permisologia) {
			$sql = "SELECT * FROM sisgesbas.i004t_permisologia JOIN sisgesbas.i003t_nivel_usuario USING(co_nivel_usuario) JOIN sisgesbas.i002t_modulo on sisgesbas.i002t_modulo.co_modulo=sisgesbas.i004t_permisologia.co_modulo  WHERE co_permisologia = ?";
			$query = $this->db->query($sql, array($co_permisologia));
			return $query->row_array();
		}
		$sql = "SELECT * FROM sisgesbas.i004t_permisologia JOIN sisgesbas.i003t_nivel_usuario USING(co_nivel_usuario) JOIN sisgesbas.i002t_modulo on sisgesbas.i002t_modulo.co_modulo=sisgesbas.i004t_permisologia.co_modulo";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
//// revisar este motodo
	public function permisologia($usuario){
		$permiso=$this->db->select("co_nivel_usuario")
		->from("sisgesbas.i001t_usuario")
		->where(array("tx_indicador"=>$usuario))
		->get();
		$row = $permiso->row();
		return $row->co_nivel_usuario;
	  //$co_permiso= $row['co_nivel_usuario'];
	  //	echo $this->db->last_query(); exit;
	
				}



		public function datos_repetidos($co_nivel_usuario,$co_modulo){
					
							$this->db->select('co_nivel_usuario','co_modulo');
							$this->db->where('co_nivel_usuario',$co_nivel_usuario);
							$this->db->where('co_modulo',$co_modulo);
							$consulta=$this->db->get('sisgesbas.i004t_permisologia');
							if($consulta->num_rows()>0){
								return true;
							}
					}
				public function permiso($co_rol){
					$co_permiso=$this->db->select("co_modulo,in_entrar")
					->from("sisgesbas.i004t_permisologia")
					->where(array("co_nivel_usuario"=>$co_rol))
					->get();
				
				//	return $co_permiso->result_array();
					return $co_permiso->result();
					
				}

				// permiso= this->Mseguridad_permisologia->getPermisos(co_modulo=2, )

				//if permiso['co_nivel_usuario']==1 && permiso['in_entrar']==1 TRUE
				public function getPermisos($co_modulo,$rol){
					$permiso= $this->db->select("in_entrar")
					->from("sisgesbas.i004t_permisologia")
					->where("co_modulo",$co_modulo)
					->where("co_nivel_usuario",$rol)
					->get();
					$row = $permiso->row();
					return $row->in_entrar;
				}

	public function eliminar($co_permisologia= null) {
		if($co_permisologia) {
			$sql = "DELETE FROM sisgesbas.i004t_permisologia WHERE  co_permisologia = ?";
			$query = $this->db->query($sql, array($co_permisologia));
			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}
}