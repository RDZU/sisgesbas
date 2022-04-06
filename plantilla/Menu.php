<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Sistema de Mantenimiento Preventivo</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />     
<link rel="stylesheet" type="text/css" href="plantilla/Templates/_css/main-aplicacion.css?<?php echo 'VERSION_APLICACION';?>">
 <link href="plantilla/css/bootstrap.css" rel="stylesheet">
 <link href="plantilla/css/style.css" rel="stylesheet">
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />

</head>
<body>

<table width="1100" border="0" cellspacing="0" cellpadding="0" align="center">
  <div class="Contenedor" id="Main-externo">
      <tr><td colspan="3">
      <div class="Contenedor" id="Main-header">
        <span class="Contenedor-con-Imagen" id="Main-Logo"></span>
        <div class="Contenedor" id="Contenedor-Degradado">
          <div class="Contenedor-con-Imagen" id="Logo-Continuacion">
            <span class="Contenedor" id="Nombre-Aplicacion">SISTEMA DE MANTENIMIENTO PREVENTIVO</span>
          </div>
          <div class="Contenedor-con-Imagen" id="Logo-Final"></div>
        </div>
      </div>
    </td></tr>
    <tr><td colspan="3">
      <div class="Contenedor-con-sombra" id="Main-BackCuerpoRight">
              <div class="Contenedor-con-sombra" id="Main-BackCuerpoLeft"> 
                  <div class="Contenedor" id="Main-Cuerpo">
            <div class="Contenedor-con-Bordes" id="Main-Identificador_usuario">
              <span class="Texto-Identificador" id="Main-Usuario"><?php echo 'Usuario: usuario';?></span>
              <span class="Texto-Identificador" id="Main-Fecha">
                               <!-- <?php echo ''; ?>-->
                            </span>
            </div>
            <div class="Contenedor" id="Main-breadcrumbs">
              <div id="Main-Traza">
                <div id="Main-Traza-aux"></div>
              </div>
              <div class="EsquinasBread" id="EsquinaBreadDerecha"></div>
            </div>   
            <div class="Contenedor-Editable-Fondo" id="Vista">
              <div class="Contenedor-Editable" id="Menu">
           

                           <div class="dropdown" id="listas">
    <a data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Monitoreo
          <span class="caret"></span>
        </a>
 
        <ul class="dropdown-menu">
 
          <li><a href="#"><span aria-hidden="true"></span> Nagios</a></li>
          <li><a href="#"><span  aria-hidden="true"></span> SigaAIT</a></li>
          <li><a href="#"><span aria-hidden="true"></span>Bitacoras</a></li>
 
        </ul>
  </div>
          
      <div class="dropdown">
      <a data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Inventario
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a href=""><span aria-hidden="true"></span> Agregar Item</a></li>
          <li><a href="#"><span  aria-hidden="true"></span> Configurado</a></li>
          <li><a href="#"><span aria-hidden="true"></span>Ingreso de Equipo</a></li>
        </ul>
  </div>

          <div class="dropdown">
      <a data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Mantenimiento
          <span class="caret"></span>
        </a>
 
        <ul class="dropdown-menu">
 
          <li><a href="http://bing.com"><span aria-hidden="true"></span>Programacion de Mantenimiento</a></li>
        </ul>
  </div>                     
             

          <div class="dropdown">
      <a data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
         Solicitudes
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#"><span aria-hidden="true"></span>Orden de Servicios</a></li>
        </ul>
  </div>   
  </a>
        <ul class="list-unstyled">
          <li><a href="http://bing.com"><span aria-hidden="true"></span>Reportes</a></li>
                                
           
          <li><a href="#"><span aria-hidden="true"></span>Tablas Generales</a></li>
        </ul>                         
  
                                <!--$str_MenuPuntoCortito = '<span class="PuntoHo_Cortico"></span>'."\n";-->
                  <!--$Menu Inicio = '<a href="#" class="Contenedor-Texto-Menu"><span class="Text-menu" >--> <!--Inicio</span></a>'."\n";>-->
                <!--  $str_Menucbarra = '<a href="#" class="Contenedor-Texto-Menu"><span class="Text-menu" > -->
<!--C&oacute;digo de Barra</span></a>'."\n";-->   
                  
                  <!--$str_MenuLogout = '<a href="#" class="Contenedor-Texto-Menu"><span class="Text-menu" > Cerrar-->
<!--Sesi&oacute;n</span></a>'."\n";-->    
                
                


                
<!--                    $str_Menu  = '';-->
<!--                    $str_Menu .= $str_MenuInicio;-->
<!--                    $str_Menu .= $str_Menucbarra;-->
<!--                    $str_Menu .= $str_MenuPuntoCortito;-->
<!--                    $str_Menu .= $str_MenuLogout;-->
                    
                    
<!--                     echo $str_MenuInicio;-->
                
                
                
                
                
                
                
                
                
                
                
                 
              </div>
            </div>
          
<form action="<?php echo base_url(); ?>cEquipo/guardar" method="POST">

      <table>
        <tr>
          <td><label>Codigo</label></td>
          <td><input type="text" name="txtCodigo"></td>

        </tr>

<tr>
          <td><label>Serial</label></td>
          <td><input type="text" name="txtSerial"></td>
          
        </tr>
<tr>
          <td><label>Etiqueta PDVSA</label></td>
          <td><input type="text" name="txtEtiqueta"></td>
          
        </tr>
<tr>
          <td><label>Tipo de Equipo</label></td>
          <td><input type="text" name="txtTipo"></td>
          
        </tr>
<tr>
    <br>
          <td colspan="2"><input type="submit" class="btn btn-default" value="Ingresar"></label></td>
          
          
        </tr>
      </table>



    </form>
          </div>
        </div>
      </div>
      <div class="Contenedor-con-Bordes " id="Main-Contenedor-footer" ><div class="GrisC_12" ><?php echo '';?></div>
            </div>
    </td></tr>
        
  </div>
    
</table>
    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="plantilla/js/bootstrap.min.js"></script>
</body>
</html>
