

<?php 
// por los diagramas de clases y colaboracion,cada modelo accede a una sola tabla de la base de datos, al menos que sea unas consultas sql que necesiten usar join
class Mseguridad_persona extends CI_Model
{
public function usuarioPDVSA(){
		$sql =  "SELECT  i001t_persona.tx_nombre, i001t_persona.tx_apellido, i001t_persona.tx_indicador_red, i001t_persona.tx_cargo  FROM rrhh.i001t_persona WHERE co_organizacion=30";
		$query = $this->db->query($sql);
		return $query->result();
    }
}