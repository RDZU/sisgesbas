
<body>

<table width="1100" border="0" cellspacing="0" cellpadding="0" align="center">
  <div class="Contenedor" id="Main-externo">
      <tr><td colspan="3">
      <div class="Contenedor" id="Main-header">
        <span class="Contenedor-con-Imagen" id="Main-Logo"></span>
        <div class="Contenedor" id="Contenedor-Degradado">
          <div class="Contenedor-con-Imagen" id="Logo-Continuacion">
    <span class="Contenedor" id="Nombre-Aplicacion">Sistema de Control y Gestión de Soporte Básico</span>
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
       <span class="Texto-Identificador" id="Main-Usuario">Bienvenido:
       <?php 
      
       $Session_covi=$this->session->userdata('usuario_covi');
  $co_usuario = $Session_covi['co_usuario'];
 $co_rol = $Session_covi['co_rol'];
 //$permisologia= $Session_covi['permisologia']['co_modulo'];
 /*foreach ($permisologia as $value){
    $value->co_modulo;
   $value->in_entrar;
         }*/
         if(!$this->session->userdata('usuario_covi')){
          redirect('Clogin');
        }

 $usuario = $Session_covi['nombre'];
 $apellido = $Session_covi['apellido'];
 // echo $usuario." ".$apellido ." N# Permiso:".$co_rol." N# usuario:".$co_usuario;
       echo $usuario." ".$apellido;?> 
        </span>
              <span class="Texto-Identificador" id="Main-Fecha">
                               <?php echo fecha(); ?>
                            </span>
            </div>
            <input  type ="hidden" id="permiso" value="<?php echo $co_rol?>">
            <div class="Contenedor" id="Main-breadcrumbs">
              <div id="Main-Traza">
               
              </div>
              <div class="EsquinasBread" id="EsquinaBreadDerecha"></div>
            </div>   
            <div class="Contenedor-Editable-Fondo" id="Vista">
              <div class="Contenedor-Editable" id="Menu">
           

                         
    
    <div id='cssmenu'>

 <ul>
 <?php 
 if($co_rol==4):?>
   <li class='active' id=inicio><a href='<?php echo base_url();?>index.php/Cactivo_listado'><span>Inicio</span></a></li>
   <?php endif;?>
   <?php 
   if($co_rol!=4):?>
   <li class='active' id=inicio><a href='<?php echo base_url();?>index.php/Cmantenimiento_planificacion'><span>Inicio</span></a></li>
   <?php endif;?>


   <?php 
   $permiso=$this->Mseguridad_permisologia->getPermisos(1,$co_rol);
   //print_r($permiso);exit;
   if ($permiso==1):?>
   <li class='has-sub' id='activo'><a href='#'><span>Activo</span></a>
      <ul>
         <li><a href=  "<?php echo base_url();?>index.php/Cactivo_listado"><span>Listados de Activos</span></a></li>
         <li><a href="<?php echo base_url();?>index.php/Cactivo_modelo"><span>Consultar Marcas y Modelos</span></a></li>
        
         <?php 
         if ($permiso==1 && $co_rol==4):?>
          
         <li><a href="<?php echo base_url();?>index.php/Cactivo_tipo_activo"><span>Clases de Activos</span></a></li>
       <li><a href="<?php echo base_url();?>index.php/Cactivo_clase_activo_detalle"><span>Tipos de Activos</span></a></li>
       <?php endif;?>
      </ul>
   </li>
   <?php endif;?>

   <?php 
   $permiso=$this->Mseguridad_permisologia->getPermisos(2,$co_rol);
   if ($permiso==1):?>
   <li class='has-sub' id='mantenimiento' ><a href='#'><span>Mantenimiento</span></a>
      <ul>

      <?php 
      if ($permiso==1 && $co_rol==2):?>
      <li class='last'><a href="<?php echo base_url();?>index.php/Cmantenimiento_planificacion"><span>Planificación de Mantenimiento</span></a></li>
         <li class='last'><a href="<?php echo base_url();?>index.php/Cmantenimiento_calendario"><span>Calendario de Tareas</span></a></li>
         <?php endif;?>
         <?php 
      if ($permiso==1 && $co_rol!=2):?>
         <li class='last'><a href="<?php echo base_url();?>index.php/Cmantenimiento_registro"><span>Registro de Mantenimiento </span></a></li>
         <li class='last'><a href="<?php echo base_url();?>index.php/Cmantenimiento_planificacion"><span>Planificación de Mantenimiento</span></a></li>
         <li class='last'><a href="<?php echo base_url();?>index.php/Cmantenimiento_calendario"><span>Calendario de Tareas</span></a></li>
         <?php endif;?>
         <?php 
         if ($permiso==1 && $co_rol==5):?>
          
        <li><a href="<?php echo base_url();?>index.php/Cmantenimiento_ud_tiempo"><span>Frecuencia</span></a></li>
       <li class='last'><a href="<?php echo base_url();?>index.php/Cmantenimiento_tarea"><span>Tareas de mantenimiento</span></a></li>
       <li class='last'><a href="<?php echo base_url();?>index.php/Ctipo_mto"><span>Tipos de Mantenimiento</span></a></li>
       <li><a href="<?php echo base_url();?>index.php/Cmantenimiento_herramienta"><span>Herramientas</span></a></li>

       <?php endif;?>
       <?php 
 
   if ($permiso==1 && $co_rol== 3):?>
      <li class='last'><a href="<?php echo base_url();?>index.php/Cmantenimiento_tarea"><span>Tareas de mantenimiento</span></a></li>
      <?php endif;?>

      </ul>
   </li>
   <?php endif;?>


   
   <?php 
   $permiso=$this->Mseguridad_permisologia->getPermisos(6,$co_rol);
   if ($permiso==1):?>
   <li class='has-sub' id='configuraciones'><a href='#'><span>Configuraciones</span></a>
      <ul>

    
       <li><a href="<?php echo base_url();?>index.php/Cactivo_tipo_activo"><span>Clases de Activos</span></a></li>
       <li><a href="<?php echo base_url();?>index.php/Cactivo_clase_activo_detalle"><span>Tipos de Activos</span></a></li>
         <li><a href="<?php echo base_url();?>index.php/Cmantenimiento_ud_tiempo"><span>Frecuencia</span></a></li>
         <li class='last'><a href="<?php echo base_url();?>index.php/Cmantenimiento_tarea"><span>Tareas de mantenimiento</span></a></li>
       <li class='last'><a href="<?php echo base_url();?>index.php/Ctipo_mto"><span>Tipos de Mantenimiento</span></a></li>
       <li><a href="<?php echo base_url();?>index.php/Cmantenimiento_herramienta"><span>Herramientas</span></a></li>
      
      </ul>
   </li>
   <?php endif;?>
  
 

   <?php 
   $permiso=$this->Mseguridad_permisologia->getPermisos(3,$co_rol);
   if ($permiso==1):?>
   <li class='has-sub' id='historicos'><a href='#'><span>Historicos</span></a>
      <ul>
         <li><a href="<?php echo base_url();?>index.php/Cnagios"><span>Nagios</span></a></li>
         
      </ul>
   </li>
   <?php endif;?>

   <?php 
   $permiso=$this->Mseguridad_permisologia->getPermisos(4,$co_rol);
   if ($permiso==1):?>
<li class='has-sub' id='seguridad'><a href='#'><span>Seguridad</span></a>
      <ul>
         <li><a href='<?php echo base_url()?>index.php/Cseguridad_usuario'><span>Configuración de Usuarios</span></a></li>
           <li><a href='<?php echo base_url()?>index.php/Cseguridad_nivel_usuario'><span>Roles del Usuario </span></a></li>
             <li><a href='<?php echo base_url()?>index.php/Cseguridad_modulo'><span>Modulos</span></a></li>
             <li><a href='<?php echo base_url()?>index.php/Cseguridad_permisologia'><span>Permisología</span></a></li>
      </ul>
   </li>
   <?php endif;?>

   <?php 
   $permiso=$this->Mseguridad_permisologia->getPermisos(5,$co_rol);
   if ($permiso==1):?>
<li class='has-sub' id='reportes'><a href='#'><span>Reportes</span></a>
      <ul>
        
         <li class='last'><a href='<?php echo base_url()?>index.php/Creportes'><span>Oficiales</span></a></li>
      </ul>
   </li>
   <?php endif;?>


    <li class='last'><a href="<?php echo base_url();?>index.php/Clogin/logout"><span>Salir</span></a></li>
</ul>
</div>
  
                       
                     
                   
                 
              </div>
            </div>
          