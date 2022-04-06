 

  <h4 align="center" >Tareas de Mantenimiento</h4>
<?php $error=validation_errors('<li>','</li>'); ?>
<div class="container">
<div class="row">         


<form role = "form" action="<?php echo base_url();?>index.php/Cmantenimiento_tarea/ingresar" method="POST">
<div class="col-xs-4">
    
    <div class="form-group form-group-sm">
        <label for="" class="">Tareas</label>  
            <input name="tx_mto_tarea"  class="form-control" type="text" placeholder="Nombre de la tarea"  maxlength="150" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"> 
    </div>

	
  <div class="form-group form-group-sm">  
    <label> Descripcion </label>
 <textarea class="form-control input-sm" rows="2" name="tx_mto_descripcion"  placeholder="Descripción de la tarea" maxlength="150"></textarea>
</div>


    </div>
    

 


<div class="col-xs-2">
<label for="">Tipo de Mantenimiento</label>
<select name="co_tipo_mto" class="form-control input-sm" id="co_tipo_mto" >

    <option >Preventivo</option>
    </select>
	
		<div class="form-group form-group-sm">
<label for="" class="control-label"  style="margin-top: 14px;">Tiempo de la tarea </label>
<input name="nu_tiempo_tarea" id='nu_tiempo_tarea'  class="form-control" type="text"  placeholder="hh:mm">
</div>
</div>


<div class="col-xs-2">
<label for="">Nivel de Mtto.</label>

    <select name="co_tipo_mto" class="form-control input-sm" id="co_tipo_mto" >
    <?php foreach ($combo_nivel_mtto as $value){ ?>
    <option value="<?php echo $value->co_tipo_mtto?>"><?php echo $value->nu_nivel_mtto?></option>
    <?php } ?>
    </select>
	
    </div>  

		<button type="submit" class="btn btn-danger btn-sm" value="ingresar" style="margin-top:87px;margin-right: 0px;margin-left: -179px;">Ingresar</button>
    
</form>
    
	<div class="container">

<div class="col-xs-10">

		<table class="table table-bordered table-hover" id="manageMemberTable">
			<thead>
				<tr>
					<th  style= "width:300px; border-bottom-width: 0px;">Tarea</th>
					<th  style= "width:550px; border-bottom-width: 0px;">Descripcion de la tarea</th>
					<th style= "width:59px; border-bottom-width: 0px;">Tiempo</th>
					<th style= "width:40px; border-bottom-width: 0px;">Tipo Mtto.</th>
					<th  style= "width:85px; border-bottom-width: 0px;">Nivel Mtto.</th>
          <th style= "width:110px; border-bottom-width: 0px;">Opciones</th>
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
      <form method="post" action="<?php echo base_url();?>index.php/Cmantenimiento_tarea/edit" id="editForm">
      <div class="modal-body">        
			   <div class="form-group form-group-sm">
			    <label for="edit_tx_mto_tarea">Tarea </label>
			    <input type="text" class="form-control" id="edit_tx_mto_tarea" name="edit_tx_mto_tarea" placeholder="Descripcion">
			  </div>

<label for="">Tipo de Mantenimiento</label>
<select name="co_tipo_mto" class="form-control input-sm" id="co_tipo_mto" >
    <option >Preventivo</option>
    </select>

			<br>
			
<label for="">Nivel de Mantenimiento</label>
    <select name="edit_co_tipo_mto" class="form-control input-sm" id="edit_co_tipo_mto" >
    <?php foreach ($combo_nivel_mtto as $value){ ?>
    <option value="<?php echo $value->co_tipo_mtto?>"><?php echo $value->nu_nivel_mtto?></option>
    <?php } ?>
    </select>


			<br>
			   <label for="edit_tx_mto_descripcion">Descripcion </label>
    <textarea class="form-control input-sm" rows="4" name="edit_tx_mto_descripcion"  id="edit_tx_mto_descripcion"></textarea>
		

			 	<div class="form-group form-group-sm">
			    <label for="edit_nu_tiempo_tarea">Tiempo de la Tarea </label>
			    <input type="text" class="form-control" id="edit_nu_tiempo_tarea" name="edit_nu_tiempo_tarea" placeholder="Descripcion">
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
/*
timeFormat: 'h:mm ',
 

$('.timepicker').timepicker({
    timeFormat: 'h:mm',
    interval: 60,
    minTime: '10',
    maxTime: '6:00pm',
    defaultTime: '11',
    startTime: '10:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});

*/
$(document).ready(function(){
	$('#nu_tiempo_tarea').timepicker({

		timeFormat: 'H:i',
		step: 15,
    interval: 10,
    minTime: '0',
    maxTime: '10:00pm',
    defaultTime: '11',
    startTime: '10:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true


	});
});

$(document).ready(function(){
	$('#edit_nu_tiempo_tarea').timepicker({

		timeFormat: 'H:i',
		step: 15,
    interval: 10,
    minTime: '0',
    maxTime: '10:00pm',
    defaultTime: '11',
    startTime: '10:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true


	});
});


  var manageMemberTable;

$(document).ready(function() {


	manageMemberTable = $("#manageMemberTable").DataTable({
		'ajax': baseurl+'index.php/Cmantenimiento_tarea/tabla',
		'orders': [],
		"scrollX": true,

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


function edit(co_tarea_mtto = null) 
{
	if(co_tarea_mtto) {
		$("#editForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$.ajax({
			url: baseurl+'index.php/Cmantenimiento_tarea/obtener_tabla/'+co_tarea_mtto,
			type: 'post',
			dataType: 'json',
			success:function(response) {

				$("#edit_tx_mto_tarea").val(response.tx_tarea_mtto);	

        $("#edit_tx_mto_descripcion").val(response.tarea_descripcion);	
				var mom = moment(response.nu_tiempo_tarea, 'HH:mm:ss');
						//tiempo=moment(event.tiempo).format('HH:mm');
						//console.log(mom.format());
						console.log(mom.format('HH:mm'));
						$("#edit_nu_tiempo_tarea").val(mom.format('HH:mm'));
				//$("#edit_nu_tiempo_tarea").val(response.nu_tiempo_tarea);

				$("#edit_co_tipo_mto").val(response.co_tipo_mtto);

				$("#editForm").unbind('submit').bind('submit', function() {
					
					var form = $(this);

					$.ajax({
						url: form.attr('action') + '/' +co_tarea_mtto,
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

function eliminar(co_tarea_mtto = null) 
{
	if(co_tarea_mtto) {
		$("#removeMemberBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: baseurl+'index.php/Cmantenimiento_tarea/eliminar' + '/' + co_tarea_mtto,
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
    </div>
</div>