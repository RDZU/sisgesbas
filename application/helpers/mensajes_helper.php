<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//En esta página se encuentran los diferentes mensajes que se muestran en la aplicación

function mensaje($num)
{ $lista = array (
                1=> 'Password o indicador no valido', /* mensaje de error. pagina index.php*/
				2=> 'Su clave no coincide con la &uacute;ltima registrada en el sistema. El servicio est&aacute; caido.por lo tanto, intentelo con la clave anterior',  /*Mensaje de error. pagina index.php*/
				3=> 'El Directorio Activo est&aacute; ca&iacute;do, por favor p&oacute;ngase en contacto con el administrador del sistema.',  /*Mensaje de error. pagina index.php*/
				4=> 'VERIFIQUE SUS DATOS DEL SISTEMA', /*Titulo de la pagina verificar_datos.php*/
				5=> '&copy;PDVSA 2017 - &Uacute;ltima actualizaci&oacute;n Marzo de 2017', /*Mensaje para el pie de pagina; todas las páginas*/
				6=> 'SISTEST CS', /*Nombre de la aplicación; todas las paginas*/
				7=> 'SISTEST CS',  /*Titulo de la aplicación; todas las paginas; aparece en la barra superior del navegador. todas las paginas*/
				8=> 'SELECCIONAR UNA CATEGOR&Iacute;A:', /*Titulo de la página de categoria. categoria.php*/
				9=> 'Equipo inform&aacute;tico', /*Titulo grupo categoria. categoria.php*/
				10=> '- Adquisici&oacute;n de equipo inform&aacute;tico', /*tipo de solicitud. categoria.php*/
				11=> 'Equipo telef&oacute;nico', /*Titulo grupo categoria. categoria.php*/
				12=>'- Adquisici&oacute;n de tel&eacute;fono/ fax/ celular', /*tipo de solicitud. categoria.php*/
				13=>'Datos del solicitante: ',/*titulo de la pagina superior de creacion de sulicitud .datos_solicitante.php*/
				14=> 'Requerimiento para adquisici&oacute;n de equipo', /*titulo de la pagina de la categoria. cat_adq_equipo*/
				15=> 'Estimado usuario, esta solicitud requiere la autorizaci&oacute;n del nivel aprobatorio antes mencionado, por favor ingrese el indicador de red del mismo, luego presione "ENTER"; finalmente luego de completar toda la informaci&oacute;n presione el bot&oacute;n "Continuar" para enviar la solicitud de aprobaci&oacute;n.', /*Mensaje que le indica al usuario que su solicitud tiene que ser aprobada su supervidor, gerente, etc...*/
				16=> '( * ) Datos obligatorios', /*Indica que los datos que tienen asterisco son obligatorios*/ 
				17=> 'Los datos suministrados por usted podr&aacute;n ser verificados por el personal responsable de la protecci&oacute;n de activos de informaci&oacute;n, raz&oacute;n por la cual, cualquier inconsistencia en la informaci&oacute;n podr&aacute; ser objeto de investigaci&oacute;n seg&uacute;n las Pol&iacute;ticas de Seguridad de Informaci&oacute;n (PSI) de la corporaci&oacute;n.<br><br>La seguridad es responsabilidad de todos<br><br>Puede consultar las Pol&iacute;ticas de Seguridad de Informaci&oacute;n y la Norma de Protecci&oacute;n de Activos de Informaci&oacute;n a trav&eacute;s de la siguiente p&aacute;gina:    
<a target="_new" href= "http://intranet.pdvsa.com/portal_corporacion/funciones/pcp/documentos/politicas_seguridad.pdf">Pol&iacute;ticas de Seguridad</a>', /*Nota de advertencia donde se indica que la información que se escriba en la solicitud debe de ser cierta*/
				18=> '- Reporte de problema con equipo inform&aacute;tico', /*tipo de solicitud. categoria.php*/
				19=> 'Incidente con equipo inform&aacute;tico',  /*titulo de la pagina cat_prob_equipo_infor.php*/
				20=> 'Detalle de la solicitud',    /*titulo de detalle de solicitud, totas las paginas de categorias*/
				21=> '- Emisi&oacute;n de pase de equipo de PDVSA',  /*tipo de solicitud. categoria.php*/
				22=> 'Requerimiento para emisi&oacute;n de pase de equipo PDVSA', /*titulo de la pagina cat_pases_equipo_pdvsa.php*/
				23=> '- Emisi&oacute;n de pase de equipo de tercero',  /*tipo de solicitud. categoria.php*/
				24=> 'Requerimiento para emisi&oacute;n de pase de equipo de tercero', /*titulo de la pagina cat_pases_equipo_tercero.php*/
				25=> '- Evaluaci&oacute;n de reemplazo de equipo inform&aacute;tico', /*tipo de solicitud. categoria.php*/
				26=> 'Requerimiento para reemplazo de equipo inform&aacute;tico', /*titulo de la pagina cat_reemp_equipo_infor.php*/
				27=> '- Reasignaci&oacute;n de equipo inform&aacute;tico', /*tipo de solicitud. categoria.php*/
				28=> 'Requerimiento para reasignaci&oacute;n de equipo inform&aacute;tico', /*titulo de la pagina cat_asig_equipo_infor.php*/
				29=> 'Requerimiento para adquisici&oacute;n de equipo telef&oacute;nico', /*titulo de la pagina cat_adq_equipo_telef.php*/
				30=> '- Reporte de problema con tel&eacute;fono/ celular/ fax', /*tipo de solicitud. categoria.php*/
				31=> 'Incidente con equipo telef&oacute;nico', /*titulo de la pagina. cat_prob_equipo_telef.php*/
				32=> '- Acceso de l&iacute;neas telef&oacute;nica', /*tipo de solicitud. categoria.php*/
				33=> 'Requerimiento para acceso telef&oacute;nico ', /*titulo de la categoria. cat_acceso_telefonico*/
				34=> '- Reemplazo de aparato telef&oacute;nico/ celular/ fax ',   /*tipo de solicitud. categoria.php*/
				35=> 'Requerimiento para reemplazo de equipo telef&oacute;nico', /*titulo de la categoria cat_reemp_equipo_telef.php*/
				36=> '- Reasignaci&oacute;n de equipo telef&oacute;nico', /*tipo de solicitud. categoria.php*/
				37=> 'Requerimiento para reasignaci&oacute;n de equipo telef&oacute;nico', /*titulo de la categoria cat_asig_equipo_telef.php*/
				38=> 'Mudanza', /*Titulo grupo categoria. categoria.php*/
				39=> '- Mudanza de equipo inform&aacute;tico', /*tipo de solicitud. categoria.php*/
				40=> 'Requerimiento para mudanza de equipo inform&aacute;tico', /*titulo de la categoria cat_mud_equipo_infor.php*/
				41=> '- Mudanza de data', /*tipo de solicitud. categoria.php*/
				42=> 'Requerimiento para mudanza de data', /*titulo de la categoria cat_mud_data.php*/
				43=> '- Mudanza de l&iacute;nea telef&oacute;nica', /*tipo de solicitud. categoria.php*/
				44=> 'Requerimiento para mudanza de l&iacute;nea telef&oacute;nica', /*titulo de la categoria cat_mud_linea_telef.php*/
				45=> '- Mudanza de punto de red', /*tipo de solicitud. categoria.php*/
				46=> 'Requerimiento para mudanza de punto de red', /*titulo de la categoria cat_mud_punto_red.php*/
				47=> 'Cuenta', /*Titulo grupo categoria. categoria.php*/
				48=> '- Creaci&oacute;n/habilitaci&oacute;n de cuenta de red y correo', /*tipo de solicitud. categoria.php*/
				49=> 'Requerimiento para creaci&oacute;n/habilitaci&oacute;n de cuenta de red y correo', /*titulo de la categoria cat_cuenta_red.php*/
				50=> '- Creaci&oacute;n/habilitaci&oacute;n de cuenta VPN', /*tipo de solicitud. categoria.php*/
				51=> 'Requerimiento para creaci&oacute;n/habilitaci&oacute;n de cuenta VPN', /*titulo de la categoria cat_cuenta_vpn.php*/
				52=> '- Creaci&oacute;n/habilitaci&oacute;n de simde', /*tipo de solicitud. categoria.php*/
				53=> 'Requerimiento para creaci&oacute;n/habilitaci&oacute;n de cuenta simde', /*titulo de la categoria cat_cuenta_simde.php*/
				54=> 'Aplicaciones', /*Titulo grupo categoria. categoria.php*/
				55=> '- Instalaci&oacute;n de aplicaci&oacute;n', /*tipo de solicitud. categoria.php*/
				56=> 'Requerimiento para instalaci&oacute;n de aplicaci&oacute;n', /*titulo de la categoria cat_inst_aplicacion.php*/
				57=> '- Reporte de problema con aplicaci&oacute;n', /*tipo de solicitud. categoria.php*/
				58=> 'Incidente con aplicaci&oacute;n', /*titulo de la categoria cat_prob_aplicacion.php*/
				59=> 'Red e internet', /*Titulo grupo categoria. categoria.php*/
				60=> '-  Reporte de problema de conexi&oacute;n a la red', /*tipo de solicitud. categoria.php*/
				61=> 'Incidente de conexi&oacute;n a la red', /*titulo de la categoria cat_prob_red.php*/
				62=> '- Activaci&oacute;n e instalaci&oacute;n de punto de red', /*tipo de solicitud. categoria.php*/
				63=> 'Requerimiento para activaci&oacute;n e instalaci&oacute;n de punto de red', /*titulo de la categoria cat_crear_red.php*/
				64=> ' Servidor/carpeta', /*Titulo grupo categoria. categoria.php*/
				65=> '- Permisolog&iacute;a en carpeta y servidor ', /*tipo de solicitud. categoria.php*/
				66=> 'Requerimiento para permisolog&iacute;a en carpeta y servidor', /*titulo de la categoria cat_perm_carpeta.php*/
				67=> ' Respaldo', /*Titulo grupo categoria. categoria.php*/
				68=> '- Respaldo y transferencia de data en dispositivo', /*tipo de solicitud. categoria.php*/
				69=> 'Requerimiento para respaldo/transferencia de data', /*titulo de la categoria cat_resp_data.php*/
				70=> 'Consulta de solicitudes realizadas:', /*titulo de la consulta con_sol_.php*/
				71=> 'Consulta de solicitudes para ser aprobadas por usted:', /*titulo de la consulta con_sol_.php*/
				72=> 'Consulta de solicitudes rechazadas por el aprobador:', /*titulo de la consulta con_sol_.php*/
				73=> 'Consulta de solicitudes aprobadas y casos creados:', /*titulo de la consulta con_sol_.php*/
				74=> 'Consulta de solicitudes realizadas por el usuario:', /*titulo de la consulta con_sol_.php*/
				75=> 'Todos', /*para seleccionar el nivel de alcanze  funcion llenar_combo; de la pagina comunes.php  */
				76=> 'Seleccione...', /*para seleccionar una ubicación  funcion llenar_combo; de la pagina comunes.php  */
				77=> '* Haga clic en el n&uacute;mero de la solicitud para visualizar su informaci&oacute;n detallada', /*mensaje para indicar al analista que ingrese el número de cédula en la pagina con_sol_usu.php  */
				78=> '* Por favor, ingrese el n&uacute;mero de c&eacute;dula del usuario', /*mensaje para la visualización del detalle de una solicitud en las paginas de consulta de Solicitudes y casos  */
				79=> 'Por favor, seleccione el tipo de solicitud deseado, luego complete toda informaci&oacute;n requerida y presione el bot&oacute;n "Continuar"',    /*Mensaje para la selección de tipo de solicitud*/
				80=> 'Estimado Usuario, para realizar una solicitud es importante <strong>verificar y confirmar</strong> la informaci&oacute;n registrada en nuestro sistema. Para actualizar presione el bot&oacute;n "Modificar", si la informaci&oacute;n es correcta presione "Confirmar".',    /*Mensaje para la verificación de información*/
				81=> 'Para realizar una solicitud identifique la categor&iacute;a deseada:',    /*Mensaje para la verificación de información*/
				82=> 'Solicitudes para ser aprobadas por ServiciosOri:', /*titulo de la consulta con_sol_serv_ori.php*/
				83=> 'No hay informaci&oacute;n referente a la palabra ingresada en su b&uacute;squeda.', /*mensaje de falla en la búsqueda pagina categoria.php*/
				84=> 'Como recomendaci&oacute;n utilice s&oacute;lo una palabra clave, tal como: <br>impresora<br>mudanza<br>telefon&iacute;a<br>port&aacute;til<br>carpeta<br>u otra de su preferencia', /*mensaje de falla en la búsqueda pagina categoria.php*/
				85=> 'COMPLETE LA INFORMACI&Oacute;N PARA SU SOLICITUD', /*Título de las plantilla de solicitud*/
				86=> 'PASOS PARA LA CREACI&Oacute;N DE UNA SOLICITUD', /*Título de la pagina paso_crear_solicitud.php*/
				87=> 'Estimado usuario, para la creaci&oacute;n de una solicitud siga los pasos que se muestran a continuaci&oacute;n:', /*Mensaje de la pagina paso_crear_solicitud.php*/
				88=> '1) Si sus datos personales han cambiado recientemente, por favor verifique su informaci&oacute;n en el sistema', /*Mensaje de la pagina paso_crear_solicitud.php*/
				89=> '2) Seleccione una categor&iacute;a referente a su solicitud ', /*Mensaje de la pagina paso_crear_solicitud.php*/
				90=> '3) Complemente la informaci&oacute;n de su requerimiento', /*Mensaje de la pagina paso_crear_solicitud.php*/
				91=> 'Si sus datos fueron verificados, haga clic en "Continuar" para seleccionar una categor&iacute;a', /*Mensaje de la pagina paso_crear_solicitud.php*/
				92=> ' / ', /*Separador para la identificación de la navegación de páginas*/
				93=> 'Pasos para la creaci&oacute;n de una solicitud', /*Subtitulo de navedación de la página pasos_crear_solicitud.php*/
				94=> 'Modificar', /*Subtitulo de navedación de la página datos_usuario_modificar.php*/
				95=> 'Selecci&oacute;n de categor&iacute;a', /*Subtitulo de navedación de la página categoria.php*/
				96=> 'Completar informaci&oacute;n de solicitud', /*Subtitulo de navedación de la plantillas de solicitudes*/
				97=> 'Detalle de la solicitud:', /*Subtitulo de la página con_sol_pro.php*/
				98=> 'Estimado usuario, esta solicitud requiere la autorizaci&oacute;n del nivel aprobatorio antes mencionado, por favor ingrese el indicador de red del mismo, luego presione "ENTER"; finalmente presione el bot&oacute;n "Reenviar solicitud".', /*Mensaje que le indica al usuario que su solicitud tiene que ser aprobada su supervidor, gerente, etc...*/

				/*Mensajes para el Menú*/
				148=>  'Principal', /*categoria del menú menu_administrador.htm*/
				149=>  'Autoservicios AIT', /*categoria del menú menu_administrador.htm*/
				150=> 'Autogesti&oacute;n AIT', /*categoria del menú menu_administrador.htm*/
				151=> 'Atenci&oacute;n Telef&oacute;nica',/*categoria del menú menu_administrador.htm*/				
				152=> 'ServiciosOri', /*categoria del menú menu_administrador.htm*/				
				153=> 'Ivr', /*categoria del menú menu_administrador.htm*/				
				154=> 'Acd', /*categoria del menú menu_administrador.htm*/				
				155=> 'Consolidado', /*categoria del menú menu_administrador.htm*/	
				156=> 'Solicitudes de usuarios', /*categoria del menú menu_administrador.htm*/				
				157=> 'Solicitudes ServiciosOri pendientes por aprobaci&oacute;n', /*categoria del menú menu_administrador.htm*/				
				
				160=> 'Administrar sistema', /*categoria del menú menu_administrador.htm*/				
				161=> 'Rol de usuario', /*categoria del menú menu_administrador.htm*/				
				162=> 'Tipos de solicitud', /*categoria del menú menu_administrador.htm*/				
				163=> 'Grupos y categor&iacute;as', /*categoria del menú menu_administrador.htm*/				
				164=> 'Nivel aprobatorio', /*categoria del menú menu_administrador.htm*/
				165=> 'Diccionario de datos', /*Diccionario de Datos.htm*/				
				166=> 'Lista de excepci&oacute;n', /*Diccionario de Datos.htm*/	
				167=> 'Configuraciones', /*Diccionario de Datos.htm*/		
				
				170=> 'Autogesti&oacute;n AIT', /*categoria del menú menu_administrador.htm*/				
				171=> 'Solicitudes creadas', /*categoria del menú menu_administrador.htm*/				
				172=> 'Solicitudes pendientes', /*categoria del menú menu_administrador.htm*/				
				173=> 'Solicitudes aprobadas', /*categoria del menú menu_administrador.htm*/
				174=> 'Solicitudes rechazadas', /*categoria del menú menu_administrador.htm*/
				175=> 'Solicitudes por d&iacute;as', /*categoria del menú menu_administrador.htm*/
				176=> 'Solicitudes por semanas', /*categoria del menú menu_administrador.htm*/
				177=> 'Solicitudes por mes', /*categoria del menú menu_administrador.htm*/
				
				180=> 'Ayuda', /*categoria del menú menu_administrador.htm*/
				181=> 'Cerrar sesi&oacute;n', /*categoria del menú menu_administrador.htm*/
				
				/*Mensajes de ayuda para el menú*/
				188=>  'Permite ingresar al men&uacute; Principal para seleccionar las estad&iacute;ticas', /*Mensaje de ayuda del menú*/
				189=>  'Permite consultar las estad&iacute;sticas de Autoservicios AIT', /*Mensaje de ayuda del menú*/
				190=>  'Permite consultar las estad&iacute;sticas de Autogestion AIT', /*Mensaje de ayuda del menú*/
				191=>  'Permite consultar las estad&iacute;sticas de Atenci&oacute;n telef&oacute;nica', /*Mensaje de ayuda del menú*/
				192=>  'Permite consultar las estad&iacute;sticas de ServiciosOri', /*Mensaje de ayuda del menú*/
				193=>  'Permite consultar las estad&iacute;sticas de Ivr', /*Mensaje de ayuda del menú*/
				194=>  'Permite consultar las estad&iacute;sticas de Acd', /*Mensaje de ayuda del menú*/
				195=>  'Permite consultar las estad&iacute;sticas consolidadas de la Gesti&oacute;n del Centro de Servicios AIT', /*Mensaje de ayuda del menú*/
				196=>  'Permite visualizar solicitudes realizadas por los usuarios', /*Mensaje de ayuda del menú*/
				197=>  'Permite visualizar solicitudes de casos especiales, los cuales necesitan la evaluaci&oacute;n del personal de ServicioOri', /*Mensaje de ayuda del menú*/
				
				200=>  'Permite la administraci&oacute;n del sistema de Autogesti&oacute;n AIT', /*Mensaje de ayuda del menú*/
				201=>  'Permite la administraci&oacute;n de los roles de usuario', /*Mensaje de ayuda del menú*/
				202=>  'Permite la administraci&oacute;n de los tipos de solicitud', /*Mensaje de ayuda del menú*/
				203=>  'Permite la administraci&oacute;n de los grupos y las categor&iacute;as del cat&aacute;logo de servicio', /*Mensaje de ayuda del menú*/
				204=>  'Permite la administraci&oacute;n de los niveles aprobatorios', /*Mensaje de ayuda del menú*/
				205=>  'Permite visualizar el diccinario de datos de Autogesti&oacute;n AIT', /*Mensaje de ayuda del menú*/
				206=>  'Permite la administraci&oacute;n de los usuarios en la lista de excepciones', /*Mensaje de ayuda del menú*/
				207=>  'Permite la administraci&oacute;n de configuraciones en Autogesti&oacute;n', /*Mensaje de ayuda del menú*/
				210=>  'Permite realizar reportes del sistema de Autogesti&oacute;n AIT', /*Mensaje de ayuda del menú*/
				211=>  'Permite realizar reportes de solicitudes creadas', /*Mensaje de ayuda del menú*/
				212=>  'Permite realizar reportes de solicitudes pendientes', /*Mensaje de ayuda del menú*/
				213=>  'Permite realizar reportes de solicitudes aprobadas', /*Mensaje de ayuda del menú*/
				214=>  'Permite realizar reportes de solicitudes rechazadas', /*Mensaje de ayuda del menú*/
				215=>  'Permite realizar reportes de solicitudes por d&iacute;as', /*Mensaje de ayuda del menú*/
				216=>  'Permite realizar reportes de solicitudes por semanas', /*Mensaje de ayuda del menú*/
				217=>  'Permite realizar reportes de solicitudes por mes', /*Mensaje de ayuda del menú*/
				
				220=>  'Permite visualizar la ayuda', /*Mensaje de ayuda del menú*/
				221=>  'Permite cerrar o finalizar la sesi&oacute;n' /*Mensaje de ayuda del menú*/
				/*Fin de Mensajes para el Menú*/
								
              );
  return $lista[$num];
} 


?>
