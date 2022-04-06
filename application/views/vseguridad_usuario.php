<!-- le recomiendo esta pagina yo no las aplique, por falta de tiempo: https://github.com/jonmircha/buenas-practicas-frontend -->

<h4>Configuración de Usuarios</h4>

<div class="container">
<div class="row">
<form role = "form" action="<?php echo base_url();?>index.php/Cseguridad_usuario/ingresar" method="POST">
      <div class="col-xs-3">
     <label for="">Indicador</label>
 <div class="input-group form-control form-group-sm" style="padding-bottom: 0px;padding-top: 0px;padding-left: 0px;padding-right: 0px;border-top-width: 0px;border-bottom-width: 0px;">
 <input type="text" class="form-control" name="tx_indicador" id="tx_indicador" readonly placeholder="INDICADOR DE RED">

 <span class="input-group-btn" id="spam">
 		    
    <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#modal-default" style="margin-top:-4px;"><span class="fa fa-search"></span> Buscar</button>
         </span>
         </div>
<label for="">Nivel de Acceso</label>
    <select name="co_nivel_usuario" class="form-control input-sm" id="co_nivel_usuario" >
    <?php foreach ($combo_nivel_acceso as $value){ ?>
    <option value="<?php echo $value->co_nivel_usuario?>"><?php echo $value->tx_nivel?></option>
    <?php } ?>
    </select>
    </div>

            
 <div class="col-xs-2">
     <div class="form-group form-group-sm">
     <label for="">Nombre</label>
     <input type="text" class="form-control" name="tx_nombre" id="tx_nombre" readonly placeholder="NOMBRE">
     </div>
     </div>

     <div class="col-xs-2">
     <div class="form-group form-group-sm">
     <label for="">Apellido</label>
     <input type="text" class="form-control" id="tx_apellido" name="tx_apellido" readonly placeholder="APELLIDO">
     </div>
     </div>

     <div class="col-xs-1">
     <br>
 <button type="submit" class="btn btn-danger btn-sm" value="ingresar" style="margin-top: 3px;">Ingresar</button>
 </div>
         </form>



        
<div class="col-xs-10">
<br>
		<table class="table table-bordered table-hover" id="manageMemberTable">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Indicador</th>
                    <th>Nivel de Acceso</th>
                    <th>Opciones</th>
				</tr>
			</thead>
		</table>
    </div>
	



<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Usuario PDVSA</h4>
            </div>
            <div class="modal-body">
                <table  class="table table-bordered table-striped table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Indicador</th>
                            <th>Cargo</th>
                            <th>Opciones </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($usuarioPDVSA)):?>
                    <?php foreach ($usuarioPDVSA as $value):?>
                    <td> <?php echo $value->tx_nombre ?></td>
                    <td> <?php echo $value->tx_apellido ?></td>
                    <td> <?php echo $value->tx_indicador_red ?></td>
                    <td> <?php echo $value->tx_cargo?></td>
                
                    <?php $data=$value->tx_nombre."*".$value->tx_apellido."*".$value->tx_indicador_red;?>
        <td><button type="button" class="btn btn-danger btn-check btn-xs" value="<?php echo $data;?>"><span class="glyphicon glyphicon-ok"></span> </button> </td>
                    </tr>
    <?php endforeach;?>
    <?php endif;?>
                   
                    </tbody>
                </table>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar</h4>
      </div>
      <form method="post" action="<?php echo base_url();?>index.php/Cseguridad_usuario/edit" id="editForm">
      <div class="modal-body">        
			<label for="">Nivel de Acceso</label>
    <select name="edit_co_nivel_usuario" class="form-control input-sm" id="edit_co_nivel_usuario" >
    <?php foreach ($combo_nivel_acceso as $value){ ?>
    <option value="<?php echo $value->co_nivel_usuario?>"><?php echo $value->tx_nivel?></option>
    <?php } ?>
    </select>  
  
      </div>
      <br>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Editar</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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


</div>
</div>

<?php if(validation_errors() != false) { echo '<script>alert("'.str_replace(array("\r","\n"), '\n', validation_errors()).'")</script>'; }?>   
<?php if($this->session->flashdata('mensaje')!='') 
{
?>
<?php echo'<script>alert("Registro ingresado exitosamente")</script>';?>"
<?php 
}
?>

<script>
var manageMemberTable;
$(document).ready(function() {
  manageMemberTable = $("#datatable").DataTable({
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
$(document).ready(function() {
	manageMemberTable = $("#manageMemberTable").DataTable({
		'ajax': baseurl+'index.php/Cseguridad_usuario/tabla',
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
$(document).on("click",".btn-check",function(){ //
usuario=$(this).val(); //recupera la informacion
info_usuario =usuario.split("*");
$("#tx_nombre").val(info_usuario[0]);
$("#tx_apellido").val(info_usuario[1]);
$("#tx_indicador").val(info_usuario[2]);
$("#modal-default").modal("hide");
});

function edit(co_usuario = null) 
{
	if(co_usuario) {
		$("#editForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$.ajax({
			url: baseurl+'index.php/Cseguridad_usuario/obtener_tabla/'+co_usuario,
			type: 'post',
			dataType: 'json',
			success:function(response) {

				$("#edit_co_nivel_usuario").val(response.co_nivel_usuario);	
				$("#editForm").unbind('submit').bind('submit', function() {
					var form = $(this);
					$.ajax({
						url: form.attr('action') + '/' +co_usuario,
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

function eliminar(co_usuario = null) 
{
	if(co_usuario) {
		$("#removeMemberBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: baseurl+'index.php/Cseguridad_usuario/eliminar' + '/' + co_usuario,
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