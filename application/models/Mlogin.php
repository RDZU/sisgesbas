<?php 
class Mlogin extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function valida_usuario($usuario/*, $clave*/)
		{   
			$id_usu = 0;
			if ($usuario)
				{
					//Codigo de acceso del sistema esta incompleto ya que contiene informacion confidencial del domain control PDVSA
					
				   // $bind=1;
				   $indicador=$this->Mseguridad_usuario->indicador($usuario);
					//if ($bind==1)
					if($indicador==1)
						{ 
							

							//	print_r($consulta);exit;
							//$indicador=$this->Mseguridad_usuario->indicador($usuario);
							//print_r($indicador);exit;
							//if($indicador==1)
							$co_rol=$this->Mseguridad_permisologia->permisologia($usuario);
							$co_usuario=$this->Mseguridad_usuario->numero_usuario($usuario);
							$nombre=$this->Mseguridad_usuario->nombre($usuario);
							$apellido=$this->Mseguridad_usuario->apellido($usuario);
							/*$permisologia=$this->Mseguridad_permisologia->permiso($co_rol);
							if (in_array(3, $permisologia)) {
								print_r("Entro");exit;
							}*/
								
						
								
							$Session_covi = array('user'         => $usuario,
												  'nombre'       => $nombre,
												  'apellido'     => $apellido,
												  'co_rol'       => 1,
												  'ultimoAcceso' => date("Y-n-j H:i:s"),
												  'co_usuario'    => $co_usuario,
												  'co_rol'   => $co_rol);
											
							$this->session->set_userdata('usuario_covi', $Session_covi);
							$id_usu = 1;
						}
						
					}
			return $id_usu;
		}
}

?>
