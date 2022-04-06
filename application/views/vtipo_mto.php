
<h4 align="center"> Tipos de Mantenimiento</h4>

<div class="container">
<div class="row">



<form role = "form" action="<?php echo base_url();?>index.php/Ctipo_mto/ingresar" method="POST">
<div class="col-xs-2">
    <label>Tipo de Mantenimiento</label>

<select class="form-control input-sm" id="tx_mto_tipo" name="tx_mto_tipo">
            <option value="PREVENTIVO"  <?php echo  set_select('tx_mto_tipo', 'PREVENTIVO'); ?>>Preventivo</option>
     
          </select>

</div>


<div class="col-xs-2">
<label>Nivel de Mtto.</label>
<select class="form-control input-sm" name="nu_mto_nivel" id="nu_mto_nivel"> 
            <option value="1"  <?php echo  set_select('nu_mto_nivel', '1'); ?> >1</option>
            <option value="2" <?php echo  set_select('nu_mto_nivel', '2'); ?>>2</option>
            <option value="3"<?php echo  set_select('nu_mto_nivel', '3'); ?>>3</option>
            <option value="4" <?php echo  set_select('nu_mto_nivel', '4'); ?>>4</option>
            <option value="5" <?php echo  set_select('nu_mto_nivel', '5'); ?>>5</option>
            </select>
</div>
    
  <div class="col-xs-5">
  <div class="form-group form-group-sm">
  
    <label for="">Descripcion </label>
    <textarea class="form-control input-sm" rows="3" name="tx_mto_descripcion" placeholder="Descripcion" maxlength="2000"> <?php echo set_value('tx_mto_descripcion'); ?></textarea>
      </div>
    </div>
    
    <br><br>
    <div class="col-xs-1">
    <button type="submit" value="ingresar" class="btn btn-danger btn-sm" style="margin-top:-14px;">Ingresar</button>
  </div>
      
 </form>

		
<div class="col-xs-10">
		<table class="table table-bordered table-hover" id="manageMemberTable">
			<thead>
				<tr>
					<th style="width: 6em;">Tipo Mtto  </th>
					<th style="width: 6em;">Nivel Mtto</th>
					<th>Descripcion</th>
            <th style="width: 6em;">Opciones</th>
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
      <form method="post" action="<?php echo base_url();?>index.php/Ctipo_mto/edit" id="editForm">
      <div class="modal-body">        
			  
			   <label for="edit_tx_mto_tipo">Tipo de Mantenimiento</label>
			     <select class="form-control input-sm" id="edit_tx_mto_tipo" name="edit_tx_mto_tipo">
			     <option value="PREVENTIVO">PREVENTIVO</option>
			  
			    </select>	
<br>
			  <label for="edit_nu_mto_nivel">Nivel de Mantenimiento</label>
			    <select class="form-control input-sm"  id="edit_nu_mto_nivel" name="edit_nu_mto_nivel">
			    <option value="1">1</option>
			    <option value="2">2</option>
			    <option value="3">3</option>
			    <option value="4">4</option>
			    <option value="5">5</option>
			    </select>

			<br>
			    <label for="edit_tx_mto_descripcion">Descripcion </label>
    <textarea class="form-control input-sm" rows="3" name="edit_tx_mto_descripcion"  id="edit_tx_mto_descripcion"></textarea>
		
			  
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

	<!-- custom js -->

<?php if(validation_errors() != false) { echo '<script>alert("'.str_replace(array("\r","\n"), '\n', validation_errors()).'")</script>'; }?>   
<?php if($this->session->flashdata('mensaje')!='') 
{
?>
<?php echo'<script>alert("Registro ingresado exitosamente")</script>';?>"
<?php 
}
?>
<script type="text/javascript">
  

var manageMemberTable;

$(document).ready(function() {
  manageMemberTable = $("#manageMemberTable").DataTable({
    'ajax': baseurl+'index.php/Ctipo_mto/tabla',
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


/*
function edit(co_mto_tipo = null) 
{
  if(co_mto_tipo) {

    $("#editForm")[0].reset();
    $('.form-group').removeClass('has-error').removeClass('has-success');
    $('.text-danger').remove();

    $.ajax({
      url: baseurl+'index.php/Ctipo_mto/obtener_tabla/'+co_mto_tipo,
      type: 'post',
      dataType: 'json',
      success:function(response) {
        

        

        $("#edit_tx_mto_tipo").val(response.tx_tipo_mtto); 

        $("#edit_nu_mto_nivel").val(response.nu_nivel_mtto);

        $("#edit_tx_mto_descripcion").val(response.tx_descripcion_mtto);   

        $("#editForm").unbind('submit').bind('submit', function() {
          
          var form = $(this);

          $.ajax({
            url: form.attr('action') + '/' + co_mto_tipo,
            type: 'post',
            data: form.serialize(),
            dataType: 'json',
            success:function(response) {
              if(response.success === true) {
             

                // hide the modal
                $("#editModal").modal('hide');

                // update the manageMemberTable
                manageMemberTable.ajax.reload(null, false); 
                alert ("Registro editado exitosamente");
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
                }  else {
								
								alert ("Ha ocurrido un error");
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

*/


function edit(co_tipo_mtto = null) 
{
	if(co_tipo_mtto) {
		$("#editForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$.ajax({
			url: baseurl+'index.php/Ctipo_mto/obtener_tabla/'+co_tipo_mtto,
			type: 'post',
			dataType: 'json',
			success:function(response) {
				$("#edit_tx_mto_tipo").val(response.tx_tipo_mtto);	
        $("#edit_nu_mto_nivel").val(response.nu_nivel_mtto);	
        $("#edit_tx_mto_descripcion").val(response.tx_descripcion_mtto);	
				$("#editForm").unbind('submit').bind('submit', function() {
					var form = $(this);
					$.ajax({
						url: form.attr('action') + '/' + co_tipo_mtto,
						type: 'post',
						data: form.serialize(),
						dataType: 'json',
						success:function(response) {
							if(response.success === true) {
				
								$("#editModal").modal('hide');
			
								// update the manageMemberTable
								manageMemberTable.ajax.reload(null, false); 
				alert("Registro actualizado exitosamente");
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
										alert ("Ha ocurrido un error");
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



function eliminar(co_tipo_mtto = null) 
{
  if(co_tipo_mtto) {
    $("#removeMemberBtn").unbind('click').bind('click', function() {
      $.ajax({
        url: baseurl+'index.php/Ctipo_mto/eliminar' + '/' + co_tipo_mtto,
        type: 'post',       
        dataType: 'json',
        success:function(response) {
          if(response.success === true) {
         	$("#removeModal").modal('hide');
            alert ("Registro eliminado exitosamente");
						manageMemberTable.ajax.reload(null, false); 
					} 
						 else {
							alert ("Ha ocurrido un error ");
						}
					
				} // /succes
			}); // /ajax
		});
	}
}

</script>

</div>
</div>