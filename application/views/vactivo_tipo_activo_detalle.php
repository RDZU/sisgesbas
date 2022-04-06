
<h4 align="center"> Tipo de Activos</h4>


	<div class="container">
<div class="row">

<form role = "form" action="<?php echo base_url();?>index.php/Cactivo_tipo_activo_detalle/ingresar" method="POST">

<div class="col-xs-2">
<div class="form-group form-group-sm">
     <label for="tx_clase_activo" class="">Clase de activo</label>  
     <input maxlength="100" name="tx_clase_activo" id="tx_clase_activo" class="form-control" type="text" value="<?php echo set_value('tx_clase_activo');?>">
     <?php echo form_error('tx_clase_activo');?> 
    </div> 
</div>


<div class="col-xs-1">
<div class="form-group form-group-sm">
     <label for="tx_abreviatura_clase" class="">Abre. Clase</label>  
     <input maxlength="3" name="tx_abreviatura_clase" id="tx_abreviatura_clase" class="form-control" type="text"  value="<?php echo set_value('tx_abreviatura_clase');?>" > 
      <?php echo form_error('tx_abreviatura_clase');?> 
    </div> 
</div>

<div class="col-xs-2">
<div class="form-group form-group-sm">
     <label for="tx_tipo_activo" class="">Tipo de Activo</label>  
     <input maxlength="100" name="tx_tipo_activo" id="tx_tipo_activo" class="form-control" type="text" value="<?php echo set_value('tx_clase_activo');?>" >
     <?php echo form_error('tx_tipo_activo');?> 
    </div> 
</div>


<div class="col-xs-1">
<div class="form-group form-group-sm">
     <label for="tx_abreviatura_tipo" class="">Abre. Tipo</label>  
     <input maxlength="3" name="tx_abreviatura_tipo" id="tx_abreviatura_tipo" class="form-control" type="text" value="<?php echo set_value('tx_abreviatura_tipo');?>" >
     <?php echo form_error('tx_abreviatura_tipo');?>  
    </div> 
</div>

<div class="col-xs-2">
<div class="form-group form-group-sm">
     <label for="tx_familia" class="">Familia</label>  
     <input maxlength="100" name="tx_familia" id="tx_familia" class="form-control" type="text" value="<?php echo set_value('tx_familia');?>" > 
     <?php echo form_error('tx_familia');?> 
    </div> 
</div>

<div class="col-xs-1">
<br>
<button type="submit" class="btn btn-danger btn-sm" value="ingresar">Ingresar</button>
</div>
 </form>


		
<div class="col-xs-10">
		<table class="table table-bordered table-hover" id="manageMemberTable">
			<thead>
				<tr>
					<th>Clase de Activo</th>
					<th>Abreviatura Clase</th>
					<th>Tipo de Activo</th>
            <th>Abreviatura de Tipo</th>
           <th>Familia</th>
            <th>Opciones</th>
				</tr>
			</thead>
		</table>
    </div>
	</div>

			<div class="messages"></div>

	<!-- edit member -->
	<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar</h4>
      </div>
      <form method="post" action="<?php echo base_url();?>index.php/Cactivo_tipo_activo_detalle/edit" id="editForm">
      <div class="modal-body">        
			  


<div class="form-group form-group-sm">
     <label for="edit_tx_clase_activo" class="">Clase de activo</label>  
     <input maxlength="100" name="edit_tx_clase_activo" id="edit_tx_clase_activo" class="form-control" type="text"> 
    </div> 




<div class="form-group form-group-sm">
     <label for="edit_tx_abreviatura_clase" class="">Abre. Clase</label>  
     <input maxlength="3" name="edit_tx_abreviatura_clase" id="edit_tx_abreviatura_clase" class="form-control" type="text"> 
    </div> 



<div class="form-group form-group-sm">
     <label for="edit_tx_tipo_activo" class="">Tipo de Activo</label>  
     <input maxlength="100" name="edit_tx_tipo_activo" id="edit_tx_tipo_activo" class="form-control" type="text"> 
    </div> 




<div class="form-group form-group-sm">
     <label for="edit_tx_abreviatura_tipo" class="">Abre. Tipo</label>  
     <input maxlength="3" name="edit_tx_abreviatura_tipo" id="edit_tx_abreviatura_tipo" class="form-control" type="text"> 
    </div> 


<div class="form-group form-group-sm">
     <label for="edit_tx_familia" class="">Familia</label>  
     <input maxlength="100" name="edit_tx_familia" id="edit_tx_familia" class="form-control" type="text"> 
    </div> 
			  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Editar</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- /edit mmebers -->

<!-- removeMember -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Eliminar</h4>
      </div>
      <div class="modal-body">
        <p>¿Desea eliminar el registro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" id="removeMemberBtn" class="btn btn-danger">Eliminar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- removeMember -->





<script type="text/javascript">
  

var manageMemberTable;

$(document).ready(function() {
  manageMemberTable = $("#manageMemberTable").DataTable({
    'ajax': baseurl+'index.php/Cactivo_tipo_activo_detalle/tabla',
    'orders': [],

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



function edit(co_tipo_activo_detalle = null) 
{
  if(co_tipo_activo_detalle) {

    $("#editForm")[0].reset();
    $('.form-group').removeClass('has-error').removeClass('has-success');
    $('.text-danger').remove();

    $.ajax({
      url: baseurl+'index.php/Cactivo_tipo_activo_detalle/obtener_tabla/'+co_tipo_activo_detalle,
      type: 'post',
      dataType: 'json',
      success:function(response) {
        

        

        $("#edit_tx_clase_activo").val(response.tx_clase_activo); 

        $("#edit_tx_abreviatura_clase").val(response.tx_abreviatura_clase);

        $("#edit_tx_tipo_activo").val(response.tx_tipo_activo);   

         $("#edit_tx_abreviatura_tipo").val(response.tx_abreviatura_tipo); 

          $("#edit_tx_familia").val(response.tx_familia); 

        $("#editForm").unbind('submit').bind('submit', function() {
          
          var form = $(this);

          $.ajax({
            url: form.attr('action') + '/' + co_tipo_activo_detalle,
            type: 'post',
            data: form.serialize(),
            dataType: 'json',
            success:function(response) {
              if(response.success === true) {
                $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                '</div>');

                // hide the modal
                $("#editModal").modal('hide');

                // update the manageMemberTable
                manageMemberTable.ajax.reload(null, false); 

              } else {
                $('.text-danger').remove()
                if(response.messages instanceof Object) {
                  $.each(response.messages, function(index, value) {
                    var idi = $("#"+index);

                    idi
                    .closest('.form-group')
                    .removeClass('has-error')
                    .removeClass('has-success')
                    .addClass(value.length > 0 ? 'has-error' : 'has-success')                   
                    .after(value);                    

                  });
                } else {
                  $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                  '</div>');
                }
              }
            } // /succes
          }); // /ajax

          return false;
        });
        
      }
    });
  }
  else {
    alert('error');
  }
}

function eliminar(co_tipo_activo_detalle = null) 
{
  if(co_tipo_activo_detalle) {
    $("#removeMemberBtn").unbind('click').bind('click', function() {
      $.ajax({
        url: baseurl+'index.php/Cactivo_tipo_activo_detalle/eliminar' + '/' + co_tipo_activo_detalle,
        type: 'post',       
        dataType: 'json',
        success:function(response) {
          if(response.success === true) {
            $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

            // update the manageMemberTable
            manageMemberTable.ajax.reload(null, false); 

          } else {
            $('.text-danger').remove()
            if(response.messages instanceof Object) {
              $.each(response.messages, function(index, value) {
                var idi = $("#"+index);

                idi
                .closest('.form-group')
                .removeClass('has-error')
                .removeClass('has-success')
                .addClass(value.length > 0 ? 'has-error' : 'has-success')                   
                .after(value);                    

              });
            } else {
              $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
              '</div>');
            }
          }
        } // /succes
      }); // /ajax
    });
  }
}

</script>

</div>
</div>