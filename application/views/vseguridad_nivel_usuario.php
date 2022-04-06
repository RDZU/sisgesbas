<h4> Roles del Usuario</h4>
<div class="col-xs-4">

    <form role = "form" action="<?php echo base_url();?>index.php/Cseguridad_nivel_usuario/ingresar" method="POST">
    <div class="form-group form-group-sm">
        <label for="" class="">Rol del Usuario</label>  
<input name="tx_nivel" id="tx_nivel" class="form-control" type="text" placeholder="Rol del Usuario" maxlength="40" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo set_value('tx_nivel'); ?>"> 
    </div>
</div>
<div class="col-xs-1">
<br>
<button type="submit" value="ingresar" class="btn btn-danger btn-sm"  style="margin-top:4px;">Ingresar</button>
    </div>
</form>
    
	<div class="container">

<div class="col-xs-10">
<br>
		<table class="table table-bordered table-hover" id="manageMemberTable">
			<thead>
				<tr>
					<th>Rol del Usuario</th>
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
      <form method="post" action="<?php echo base_url();?>index.php/Cseguridad_nivel_usuario/edit" id="editForm">
      <div class="modal-body">        
			  
			   <div class="form-group form-group-sm">
			    <label for="edit_tx_nivel">Rol del usuario</label>
			    <input type="text" class="form-control" id="edit_tx_nivel" name="edit_tx_nivel" placeholder="Rol del Usuario" maxlength="40" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();">
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
		'ajax': baseurl+'index.php/Cseguridad_nivel_usuario/tabla',
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



function edit(co_nivel_usuario = null) 
{
	if(co_nivel_usuario) {
		$("#editForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$.ajax({
			url: baseurl+'index.php/Cseguridad_nivel_usuario/obtener_tabla/'+co_nivel_usuario,
			type: 'post',
			dataType: 'json',
			success:function(response) {
				$("#edit_tx_nivel").val(response.tx_nivel);	
				$("#editForm").unbind('submit').bind('submit', function() {
					var form = $(this);
					$.ajax({
						url: form.attr('action') + '/' + co_nivel_usuario,
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

function eliminar(co_nivel_usuario = null) 
{
	if(co_nivel_usuario) {
		$("#removeMemberBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: baseurl+'index.php/Cseguridad_nivel_usuario/eliminar' + '/' + co_nivel_usuario,
				type: 'post',				
				dataType: 'json',
				success:function(response) {
				if(response.success === true) {
						$("#removeModal").modal('hide');
                alert ("Registro eliminado exitosamente");
						// update the manageMemberTable
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