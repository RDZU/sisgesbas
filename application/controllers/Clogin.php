<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clogin extends CI_Controller 
	{

		public function __construct()
			{
				parent::__construct();
				
				$this->load->helper(array('mensajes_helper','url'));
				$this->load->helper(array('fechas_helper','url'));
				date_default_timezone_set('america/caracas');
				$this->load->database('default');
			}	
	
		public function index()
			{
		
				$entrada['datos'] = array();
				$entrada['datos'] = array('nombre'    => '', 
				                          'mensaje'   => '',
										  'validadot' => '');
				$this->load->view('vlogin',$entrada);
				
			}
		public function validar()
			{
				if (isset($_POST['user']))
					{
					//	if ($_POST['captcha'] != '')
					//		{
								$user=strtoupper($_POST['user']);
								$pass=$_POST['pass'];
								$this->load->model('Mlogin');
								$this->load->model('Mseguridad_usuario');
								$this->load->model('Mseguridad_permisologia');
					//			$captcha   = $_POST['captcha'];
					//			$Session_covi=$this->session->userdata('usuario_covi');
                     //   		if($captcha == $Session_covi['captcha'])
					//				{
					$validado=$this->Mlogin->valida_usuario($user/*,$pass*/);
										$validador_sistema=$this->Mseguridad_usuario->login($user);
									//	$prueba=$this->Mseguridad_usuario->permisologia($user);
									//print_r ($prueba);exit;
										if ($validado == 1 && $validador_sistema==1)
											{
												$co_rol=$this->Mseguridad_permisologia->permisologia($user);
												if($co_rol!=4){
												redirect('Cmantenimiento_planificacion');
												}
											
											else if ($co_rol==4){
												redirect('Cactivo_listado');
											}
										}
										else
											{
												$mensaje='<div class="alert alert-error">
												<button type="button" class="close" data-dismiss="alert">&times;</button>
												<h4>Informaci&oacute;n!</h4>
												Usuario o Clave incorrecta. Por favor vuelva a intentarlo, si el problema persiste contacte al Administrador</div>';
												$entrada['datos'] = array('nombre'    => '', 
																		  'mensaje'   => $mensaje,
																		  'validadot' => '');
												$this->load->view('vlogin',$entrada);
											}
					/*
								
									}
								else
									{
										{
											$mensaje='<div class="alert alert-error">
											<button type="button" class="close" data-dismiss="alert">&times;</button>
											<h4>Informaci&oacute;n!</h4>
											El C&oacute;digo ingresado es invalido.
											</div>';
											$entrada['datos'] = array('nombre'    => '', 
																	  'mensaje'   => $mensaje,
																	  'validadot' => '');
											$this->load->view('vlogin',$entrada);
										}
									}
								
							}	
							*/				 
											
						}
					else
						{
							$this->index();
						}
	
				}
		
		public function logout()
			{
				// creamos un array con las variables de sesión en blanco
				$this->session->sess_destroy();
				redirect('Clogin');
			}

}


?>
