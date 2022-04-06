<h4>Registro de Mantenimiento</h4>

<div class="container">
<div class="row">
<form  method="POST" action="<?php echo base_url();?>index.php/Cmantenimiento_registro/buscar_activo">
<input type="hidden" name="co_activo" id="co_activo">
<div class="col-xs-2">
     <label for="">Frecuencia</label>
    <select name="co_unidad_tiempo" id="co_unidad_tiempo" class="form-control input-sm" >
    <?php foreach ($combo_ud_tiempo as $value){ ?>
    <option  value="<?php echo $value->co_unidad_tiempo?>"<?php echo set_select('co_unidad_tiempo', $value->co_unidad_tiempo, False); ?>><?php echo $value->tx_unidad_tiempo?></option>
    <?php } ?>
    </select>
</div>

<div class="col-xs-1">
<div class="form-group form-group-sm">
        <label for="" class="">Intervalo</label>  
        <input type="text"  class="form-control" name="nu_frecuencia_mtto" id="nu_frecuencia_mtto" min="1" max="50" placeholder="N°" value="<?php echo set_value('nu_frecuencia_mtto'); ?>">
    </div>
</div>
<div class="col-xs-2">
   <label for="">Tipo de Mantenimiento</label>
    <select name="co_tipo_mtto" class="form-control input-sm" id="co_tipo_mtto" >
    <option>Preventivo</option>
    </select>
</div>        

    <div class="col-xs-2">
   <label for="">Nivel de Mtto.</label>
    <select name="nu_nivel_mtto" class="form-control input-sm" id="nu_nivel_mtto" >
    <?php foreach ($combo_nivel_mtto as $value){ ?>
    <option value="<?php echo $value->co_tipo_mtto?>"<?php echo set_select('nu_nivel_mtto', $value->co_tipo_mtto, False); ?>><?php echo $value->nu_nivel_mtto?></option>
    <?php } ?>
    </select>
</div>        
<div class="col-xs-3">
     <label for="">Activo</label>
 <div class="input-group form-control form-group-sm" style="padding-bottom: 0px;padding-top: 0px;padding-left: 0px;padding-right: 0px;border-top-width: 0px;border-bottom-width: 0px;">
 <input type="text" class="form-control" name="tx_serial" id="tx_serial"  placeholder="Serial o Etiqueta" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo set_value('tx_serial'); ?>">

 <span class="input-group-btn" id="spam">
 <!--<button type="submit" value="buscar2" class="btn btn-danger btn-sm"><span class="fa fa-search"></span> Buscar</button>-->  
    <button class="btn btn-danger btn-sm" id="buscar" type="submit"   style="margin-top:-4px;"><span class="glyphicon glyphicon-search"></span> Buscar</button>
         </span>
         </div>

</div>
        </form>
         <div class="col-xs-10">
<br>
		<table class="table table-bordered table-hover" id="datatable">
			<thead>
				<tr>
					<th>Tarea</th>
					<th>Descripción</th>
					<th>Tiempo</th>
                    <th>Mtto</th>
                   
				</tr>
                
			</thead>
            <tbody>
            <?php if(!empty($tabla)):?>
                    <?php foreach ($tabla as $value):?>
                    <tr>
                    <td> <?php echo $value->tx_tarea_mtto?></td>
                    <td> <?php echo $value->tx_descripcion_mtto?></td>
                    <td> <?php echo $value->nu_tiempo_tarea?></td>
                    <td><button type="button" value="<?php echo $value->co_tarea_mtto?>" class="btn btn-danger btn-check btn-xs" data-toggle="modal" data-target="#Modal"><span class="glyphicon glyphicon-wrench"></span> </button> </td>
                    </tr>
    <?php endforeach;?>
    <?php endif;?>
   
    
    </tbody>
		</table>
    </div>

</div>
</div>


                       
<div class="modal fade" tabindex="-1" role="dialog" id="Modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Registrar Mantenimiento</h4>
        <form method="post" action="<?php echo base_url();?>index.php/Cmantenimiento_registro/ingresar" id="editForm">
      </div>
      <div class="modal-body">
        <p>¿Esta seguro que desea registrar el mantenimiento al activo <?php echo set_value('tx_serial'); ?> ?</p>
        <input name="co_tarea_mtto" id="co_tarea_mtto" placeholder="Tarea" class="form-control" type="hidden" value="<?php echo $value->co_tarea_mtto?>">
        <input type="hidden"  class="form-control" placeholder="frecuencia mtto" name="nu_frecuencia_mtto" id="nu_frecuencia_mtto" value="<?php echo set_value('nu_frecuencia_mtto'); ?>">
        <input type="hidden"  class="form-control" placeholder="co_activo" name="co_activo" id="co_activo" value="<?php echo $co_activo?>">
        <input type="hidden"  class="form-control" placeholder="unidad tiempo" name="co_unidad_tiempo" id="co_unidad_tiempo" value="<?php echo set_value('co_unidad_tiempo'); ?>">
        <input type="hidden"  class="form-control" placeholder="tipo mtto" name="co_tipo_mtto" id="co_tipo_mtto" value="<?php echo set_value('nu_nivel_mtto'); ?>">
        <input type="hidden"   placeholder="Estado Mtto" name="nu_estado_mtto" id="nu_estado_mtto" value="0">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Registrar</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
       
<?php if(validation_errors() != false) { echo '<script>alert("'.str_replace(array("\r","\n"), '\n', validation_errors()).'")</script>'; }?>   
<?php if($this->session->flashdata('mensaje3')!='') 
{
?>
<?php echo'<script>alert("Registro ingresado exitosamente")</script>';?>"
<?php 
}
?>       




<?php  if($this->session->flashdata('mensaje2')!='') 
{
  
?>
<?php  print "<script type=\"text/javascript\">alert('El serial o etiqueta del activo no fue encontrado')</script>";?>
<?php 
}
?>      



<script>
var manageMemberTable;
$(document).ready(function() {
  manageMemberTable = $("#datatable").DataTable({
  //  'ajax': baseurl+'index.php/Cmantenimiento_registro/buscar_activo',
//	'orders': [],

     "oLanguage":
		{    
    "sProcessing":     "Procesando...",
    "sLengthMenu": " Mostrar _MENU_ registros",   
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Filtrar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Por favor espere - cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    
}
  }); 
});

$(document).on("click",".btn-check",function(){ //
tarea=$(this).val(); //recupera la informacion
info_tarea =tarea.split("*");
$("#co_tarea_mtto").val(info_tarea[0]);
$("#tx_tarea_mtto").val(info_tarea[1]);
$("#tx_descripcion").val(info_tarea[2]);
$("#co_tipo_mtto").val(info_tarea[3]);
$("#modal-default").modal("hide");
});
/*
$(document).on("click",".btn-danger btn-sm",function(){
valor = document.getElementById("tx_serial").value;
if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  alert("El campo activo es obligatorio");
}
});*//*
$( "#buscar" ).click(function() {
document.getElementById("nu_nivel_mtto").disabled = true;
document.getElementById("co_unidad_tiempo").disabled = true;
document.getElementById("co_tipo_mtto").disabled = true;
document.getElementById("nu_frecuencia_mtto").disabled = true;
document.getElementById("tx_serial").disabled = true;
});*/
</script>