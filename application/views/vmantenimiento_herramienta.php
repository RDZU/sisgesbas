<h4 align="center" >Herramientas y Materiales</h4>    
    <form role = "form" action="<?php echo base_url();?>index.php/Cmantenimiento_herramienta/ingresar" method="POST">
		<div class="col-xs-7">
<div class="form-group form-group-sm">
<label for="" class="">Herramienta o Material</label>  
 <input name="tx_herramienta" id="tx_herramienta" class="form-control" type="text" placeholder="herramienta o material" maxlength="100" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo set_value('tx_herramienta'); ?>"> 
    </div>
</div>
<div class="col-xs-2">
    <label>Tipo</label>
<select class="form-control input-sm" id="tx_tipo" name="tx_tipo">
            <option value="HERRAMIENTA"  <?php echo  set_select('tx_tipo', 'HERRAMIENTA'); ?>>Herramienta</option>
						<option value="MATERIAL"  <?php echo  set_select('tx_tipo', 'MATERIAL'); ?>>Material</option>
          </select>
</div>
<div class="col-xs-1">
<br>
<button type="submit" value="ingresar" class="btn btn-danger btn-sm" style="margin-top:4px;">Ingresar</button>
    </div>
</form>
    



<div class="container">
<div class="col-xs-10">

		<table class="table table-bordered table-hover" id="manageMemberTable">
			<thead>
				<tr>
			<th>Herramienta</th>
			<th>Tipo</th>	
          <th>Opciones</th>
				</tr>
			</thead>
		</table>
    </div>
</div>
	<!-- edit member -->
	
	
	<div class="messages"></div>
	<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar</h4>
      </div>
      <form method="post" action="<?php echo base_url();?>index.php/Cmantenimiento_herramienta/edit" id="editForm">
      <div class="modal-body">        
			  
<div class="form-group form-group-sm">
<label for="edit_tx_herramienta" class="">Herramienta</label>  
 <input name="edit_tx_herramienta" id="edit_tx_herramienta" class="form-control" type="text" maxlength="100" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"> 
    </div>
    <label>Tipo</label>
<select class="form-control input-sm" id="edit_tx_tipo" name="edit_tx_tipo">
            <option value="HERRAMIENTA">Herramienta</option>
						<option value="MATERIAL">Material</option>
          </select>
<br>
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
		'ajax': baseurl+'index.php/Cmantenimiento_herramienta/tabla',
      
      
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

function edit(co_herramienta = null) 
{
	if(co_herramienta) {
		$("#editForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$.ajax({
			url: baseurl+'index.php/Cmantenimiento_herramienta/obtener_tabla/'+co_herramienta,
			type: 'post',
			dataType: 'json',
			success:function(response) {

				$("#edit_tx_herramienta").val(response.tx_herramienta);	

				$("#editForm").unbind('submit').bind('submit', function() {
					
					var form = $(this);

					$.ajax({
						url: form.attr('action') + '/' +co_herramienta,
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


function eliminar(co_herramienta = null) 
{
	if(co_herramienta) {
		$("#removeMemberBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: baseurl+'index.php/Cmantenimiento_herramienta/eliminar' + '/' + co_herramienta,
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