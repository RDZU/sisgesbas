<?php include('../config.php');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script type="text/javascript" src="../config/javascript.config.php"></script>
<!-- TemplateBeginEditable name="doctitle" -->
<title><?=NOMBRE_APLICACION?></title>
    <!-- TemplateEndEditable -->

    <link href="../css/pdvsastyle.css" rel="stylesheet" type="text/css" />
    <link href="../css/pdvsa.css" rel="stylesheet" type="text/css" />
</head>
<body>  
      <div id="Main">
      <?php include('../cabecera.php'); ?>
       <div class="Contenedor-con-sombra" id="Main-BackCuerpoRight">
            <div class="Contenedor-con-sombra" id="Main-BackCuerpoLeft"> 
                <div class="Contenedor" id="Main-Cuerpo">
					<!-- Capa con texto de bienvenida-->
					<div class="Contenedor-con-Bordes" id="Main-Identificador_usuario">
						
                    </div>
					<!-- Capa con franja gris en el tope del contenido-->                    
                    <div class="Contenedor" id="Main-breadcrumbs">
                        <div id="Main-Traza"><div id="Main-Traza-aux"></div></div>
						<div class="EsquinasBread" id="EsquinaBreadDerecha"></div>
					</div>					
					<div class="Contenedor-Editable-Fondo" id="Vista">
					   <div class="Contenedor-Editable" id="Menu">
					  
					   </div>
				       <div class="Contenedor-Editable" id="Region-Editable">
						<!-- TemplateBeginEditable name="content" -->
							<span class="Titulo-Aplicacion">EJEMPLO</span>		
						    <hr class="Separador_Modulo">
							<span class="Sub-Titulo-Aplicacion">Subtitulo de ejemplo </span>	
							<span class="Texto">Agregue aqui el texto a mostrar </span>						
						<!-- TemplateEndEditable -->
						</div>
					</div>
  		    	</div>
          </div>
        </div> 
        <?php include('../pie.php');?> 
     </div>
     </div>
   </body>
</html>
