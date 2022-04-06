<h4> Permisología</h4>
 <form role = "form" action="<?php echo base_url();?>index.php/Cseguridad_permisologia/ingresar" method="POST">
<div class ="container">
<div class="row">

<div class="col-xs-3">
<label for="">Rol de Usuario</label>
    <select name="co_nivel_usuario" id="co_nivel_usuario" class="form-control input-sm" >
    <?php foreach ($combo_rol as $value){ ?>
    <option value="<?php echo $value->co_nivel_usuario?>"><?php echo $value->tx_nivel?></option>
    <?php } ?>
    </select>
</div>  
<div class="col-xs-2">
<label for="">Menu</label>
    <select name="co_modulo" class="form-control input-sm" >
    <?php foreach ($combo_menu as $value){ ?>
    <option value="<?php echo $value->co_modulo?>"><?php echo $value->tx_modulo?></option>
    <?php } ?>
    </select>
</div> 

<div class="col-xs-2">
    <label>Acceso</label>
     <select class="form-control input-sm" id="in_entrar" name="in_entrar">
            <option value="1">VERDADERO</option>
            <option value ="0">FALSO</option>
          </select>
          </div>
          



<div class="col-xs-1">
<button type="submit" value="ingresar" class="btn btn-danger btn-sm" style="margin-top: 21px;">Ingresar</button>
    </div>
</form>

 


<div class="col-xs-10">
<br>
		<table class="table table-bordered table-hover" id="manageMemberTable">
			<thead>
				<tr>
			<th>Rol del Usuario</th>
			<th>Modulo del Sistema</th>
			<th>Acceso</th>
      <th>Opciones</th>
				</tr>
			</thead>
		</table>
    </div>
	


  </div>
  </div>







	<!-- edit member -->
	<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar</h4>
      </div>
      <form method="post" action="<?php echo base_url();?>index.php/Cseguridad_permisologia/edit" id="editForm">
      <div class="modal-body">        
			  



    <label>Acceso</label>
     <select class="form-control input-sm" id="edit_in_entrar" name="edit_in_entrar">
            <option value="1">VERDADERO</option>
            <option value ="0">FALSO</option>
          </select>
          <br><br>
          

                          
			  
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
		'ajax': baseurl+'index.php/Cseguridad_permisologia/tabla',
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

function edit(co_permisologia = null) 
{
	if(co_permisologia) {
		$("#editForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$.ajax({
			url: baseurl+'index.php/Cseguridad_permisologia/obtener_tabla/'+co_permisologia,
			type: 'post',
			dataType: 'json',
			success:function(response) {

				$("#edit_co_modulo").val(response.co_modulo);	

        $("#edit_co_nivel_usuario").val(response.co_nivel_usuario);	

        $("#edit_in_entrar").val(response.in_entrar);	

				$("#editForm").unbind('submit').bind('submit', function() {
					
					var form = $(this);

					$.ajax({
						url: form.attr('action') + '/' +co_permisologia,
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


function eliminar(co_permisologia = null) 
{
	if(co_permisologia) {
		$("#removeMemberBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: baseurl+'index.php/Cseguridad_permisologia/eliminar' + '/' + co_permisologia,
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