<?php 
session_start();

include('../config/includes.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- TemplateBeginEditable name="doctitle" -->
<title><?php echo TITULO_APLICACION; ?></title>
<!-- TemplateEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet"  type="text/css" href="_css/main-aplicacion.css">

<script type="text/javascript" src="../menu/js/nuevomenu/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../menu/js/nuevomenu/funciones_menu_opcion.js"></script>
<script type="text/javascript" src="../menu/js/nuevomenu/ddaccordion.js"></script>
<script type="text/javascript" src="../menu/js/nuevomenu/iniciar_ddaccordion.js"></script>
<link rel="stylesheet"    type="text/css"   href="../menu/_css/estilos_menu.css" />


<!-- TemplateBeginEditable name="head" -->
<?php include('../config/includes_js.php'); ?>
<script LANGUAGE='JavaScript'>

 
</script>
<!-- TemplateEndEditable -->
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="780" border="0" cellspacing="0" cellpadding="0" align="center">
<div class="Contenedor" id="Main-externo">
  <tr> 
    <td colspan="3">
	 <div class="Contenedor" id="Main-header">
            <span class="Contenedor-con-Imagen" id="Main-Logo"></span>
			<div class="Contenedor" id="Contenedor-Degradado">
			    <div class="Contenedor-con-Imagen" id="Logo-Continuacion">
			    	<span class="Contenedor" id="Nombre-Aplicacion"><!-- TemplateBeginEditable name="nombreaplicacion" --><?php echo NOMBRE_APLICACION; ?><!-- TemplateEndEditable --></span>
				</div>
				<div class="Contenedor-con-Imagen" id="Logo-Final">
				</div>
			</div>
     </div>
	</td>
</tr>
<tr>
<td colspan="3">
<div class="Contenedor-con-sombra" id="Main-BackCuerpoRight">
            <div class="Contenedor-con-sombra" id="Main-BackCuerpoLeft"> 
              <div class="Contenedor" id="Main-Cuerpo">
                    <div class="Contenedor-con-Bordes" id="Main-Identificador_usuario">
                        <span class="Texto-Identificador" id="Main-Usuario"><!-- TemplateBeginEditable name="usuario" --><?php echo USUARIO; ?><!-- TemplateEndEditable --></span>
                        <span class="Texto-Identificador" id="Main-Fecha"><!-- TemplateBeginEditable name="fecha" --><?php echo FECHA; ?><!-- TemplateEndEditable --></span>					
					</div>
                    <div class="Contenedor" id="Main-breadcrumbs">
                       <div id="Main-Traza">
				         <div id="Main-Traza-aux">
			             </div>
				       </div>
	                   <div class="EsquinasBread" id="EsquinaBreadDerecha">
			           </div>
					</div>   
	                  <div class="Contenedor-Editable-Fondo" id="Vista">
					     <div class="Contenedor-Editable" id="Menu">
						    <!-- TemplateBeginEditable name="menu1" -->
							 <?php include('../menu/menu.php'); ?>
							 <!-- TemplateEndEditable -->
						 </div>	
						</div>     
                     </div>			  
			        <table  width="75%" border="0">
					  <tr>
					    <td>
					     <!-- TemplateBeginEditable name="EditRegion1" -->EditRegion1<!-- TemplateEndEditable -->
					     </td>
						</tr> 
						</table>
					</div>			
	          </div>
	        </div>
		<div class="Contenedor-con-Bordes " id="Main-Contenedor-footer" ><div class="GrisC_12" ><!-- TemplateBeginEditable name="piepagina" --><?php echo PIEPAGINA; ?><!-- TemplateEndEditable --></div></div>
</td>		
</tr>
  
 </div>
</table>
 
</body>
</html>
