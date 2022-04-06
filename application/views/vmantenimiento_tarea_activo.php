<h4> <?php echo $nombre_tarea?> </h4>
<div class="container">
<div class="row">


<form role = "form" action="<?php echo base_url();?>index.php/Cmantenimiento_tarea/ingresar_tarea_activo" method="POST">
<input type="hidden" name="co_tarea_mtto" value="<?php echo  $co_mto_tarea?>"/>
<div class="col-xs-3">
    <label for="">Clase Activo</label>
    <select name="co_clase_activo" id='co_clase_activo' class="form-control input-sm" >
    <option value="22">-Elejir Clase de Activo-</option>
    <?php foreach ($combo as $value){ ?>
   
    echo '<option value="<?php echo $value->co_clase_activo?>"> <?php echo $value->tx_clase_activo?> </option>';
    <?php } ?>
    </select>
    </div> 

 <div class="col-xs-3">
    <label for="">Tipo de Activo</label>
 <select id="co_clase_activo_detalle" name="co_clase_activo_detalle" class="form-control input-sm" >
  <option value="0">-Tipo de Activo-</option>
    </select>
    </div> 
    <button type="submit" value="ingresar" class="btn btn-danger btn-sm" style="margin-top:21px;">Ingresar</button>
</form>
<br>
<div class="col-xs-10">

<table  class="table table-bordered table-striped table-hover" id="Table">
                    <thead>
                        <tr>
            
            <th>Clase de Activo</th>
            <th>Abreviatura</th>
            <th>Tipo de Activo</th>
            <th>Abreviatura</th>
            <th>Eliminar</th>
            </tr>
            <tbody>
            </thead>
           
                            <?php if(!empty($tabla)):?>
                    <?php foreach ($tabla as $value):?>
                    <tr>
                   
            
                    <td> <?php echo $value->tx_clase_activo?></td>
                    <td> <?php echo $value->clase_abreviatura?></td>
                    <td> <?php echo $value->tx_clase_activo_detalle?></td>
                    <td> <?php echo $value->tipo_abreviatura?></td>
    <td><a href="" type="button" class="btn btn-danger btn-check btn-xs" data-toggle="modal" data-target="#removeModal" ><span class="glyphicon glyphicon-trash"></span> </a> 
    </td>
                     </tr>
    <?php endforeach;?>
    <?php endif;?>
                       
                   
                    <tbody>
                   <td>  </td>
                   <td>  </td>
                    </tbody>
                </table>
 
            


</div>  <!-- xs-10  --> 

</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Eliminar</h4>
        <form method="post" action="<?php echo base_url();?>index.php/Cmantenimiento_tarea/eliminar_tipo_activo/<?php echo $value->co_tarea_mtto_activo?>" id="editForm">
      </div>
      <div class="modal-body">
        <p>¿Desea eliminar el registro?</p>
        <input type="hidden" name="co_tarea" value="<?php echo  $co_mto_tarea?>"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Eliminar</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">   
            $(document).ready(function() {                       
                $("#co_clase_activo").change(function() {
                    $("#co_clase_activo option:selected").each(function() {
                        co_clase_activo = $('#co_clase_activo').val();
                        $.post("<?php echo base_url(); ?>index.php/Cmantenimiento_tarea/get_tipo_activo", {
                            co_clase_activo : co_clase_activo
                        }, function(data) {
                            $("#co_clase_activo_detalle").html(data);
                        });
                    });
                });
            });


var manageMemberTable;

$(document).ready(function() {
	manageMemberTable = $("#Table").DataTable({
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
    }    
}
	});	
});

        </script>
