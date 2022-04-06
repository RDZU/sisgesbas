<h4> Planificación de Mantenimiento</h4>
<div class="container">
<div class="row">

<!--
<input type="text" name="id_estado" id="id_estado">

<div class="Contenedor-Editable" >
<div class="col-xs-12" style="padding-left: 250px;">

<label class="radio-inline">
  <input type="radio" name="estado" id="estado" value="0"> <b>Por planificar</b>
</label>
<label class="radio-inline">
  <input type="radio" name="estado" id="estado" value="1"><b> Planificados</b>
</label>
<label class="radio-inline">
  <input type="radio" name="estado" id="estado" value="2"> <b>Cerrados</b>
</label>
<label class="radio-inline">
  <input type="radio" name="estado" id="estado" value="3"><b> Diferidos</b>
</label>

 </div>
</div>
-->
<div class="container">
<div class="col-xs-10">
		<table class="table table-bordered table-hover" id="manageMemberTable">
			<thead>
				<tr>
				<th style= "width:30px; border-bottom-width: 0px;">N°</th>
					<th style= "width:109px; border-bottom-width: 0px;">Activo</th>
					<th style= " width:82px; border-bottom-width: 0px;">Criticidad</th>
					<th style= "width:84px;border-bottom-width: 0px;">Tipo Mtto.</th>
            <th style= "width:84px;border-bottom-width: 0px;">Nivel Mtto.</th>
					<th style= "width:115px;border-bottom-width: 0px;">Frecuencia Mtto.</th>
					<th style= "width:250px;border-bottom-width: 0px;">Tarea Mtto.</th>
            <th style= "width:140px;border-bottom-width: 0px;">Tipo de Activo</th>
						<th style= "width:84px;border-bottom-width: 0px;">Fecha Planificada</th>
						<th style= "width:84px;border-bottom-width: 0px;">Fecha Reprogramada</th>
						<th style= "width:88px;border-bottom-width: 0px;">Fecha de Culminación</th>
						<th style= "width:220px;border-bottom-width: 0px;">Realizado por</th>
            <th style= "width:84px;border-bottom-width: 0px;">Estado</th>
            <th style= "width:110px;border-bottom-width: 0px;">Plan Mtto.</th>
				</tr>
			</thead>
		</table>
    </div>
	</div>

</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="plan_mtto">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Planificar Mantenimiento</h4>
      </div>
      <form method="post" action="<?php echo base_url();?>index.php/Cmantenimiento_planificacion/plan_mtto" id="editForm">
      <div class="modal-body">       
	  

			 	<div class="form-group form-group-sm">
			    <label for="fe">Fecha planificada </label>
			    <input type="text" class="form-control datepicker" id="fe" name="fe" data-date-format="dd/mm/yyyy">
			  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Planificar</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- /edit mmeber-->

	<div class="modal fade" tabindex="-1" role="dialog" id="reprogramar_mtto">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Reprogramar Mantenimiento</h4>
      </div>
      <form method="post" action="<?php echo base_url();?>index.php/Cmantenimiento_planificacion/reprogramar_mtto" id="editForm2">
      <div class="modal-body">       
	  
				
			 	<div class="form-group form-group-sm">
			    <label for="fe">Reprogramar Mantenimiento </label>
			    <input type="text" class="form-control datepicker" id="reprogramar" name="reprogramar" data-date-format="dd/mm/yyyy">
			  </div>
		
		

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Reprogramar</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- /edit mmeber-->



	<div class="messages"></div>
	<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Frecuencia</h4>
      </div>
      <form method="post" action="<?php echo base_url();?>index.php/Cmantenimiento_planificacion/edit" id="editForm3">
      <div class="modal-body">        
			  
			<label for="">Frecuencia</label>
    <select name="co_unidad_tiempo" id="co_unidad_tiempo" class="form-control input-sm" >
    <?php foreach ($combo_ud_tiempo as $value){ ?>
    <option  value="<?php echo $value->co_unidad_tiempo?>"<?php echo set_select('co_unidad_tiempo', $value->co_unidad_tiempo, False); ?>><?php echo $value->tx_unidad_tiempo?></option>
    <?php } ?>
    </select>
		
<div class="form-group form-group-sm">
<label for="edit_tx_unidad_tiempo" class="">Intervalo</label>  
 <input name="nu_frecuencia_mtto" id="nu_frecuencia_mtto" class="form-control" type="text" maxlength="1" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"> 
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



<script type="text/javascript">

//var estado=null;
/*
var mensaje = "gana la de fuera";
function muestraMensaje() {
  mensaje = "gana la de dentro";
  alert(mensaje);
}
*/


//cambio();
//function cambio(){

//}


/*
	estado= null
var manageMemberTable;
$(document).ready(function() {
	$("input[name=estado]").change(function () {	 
		estado=$(this).val();
	//	document.getElementById('id_estado').value=estado
//		x=document.getElementById("id_estado").value
		//console.log(estado)
		tabla(estado);
//return x
});
tabla(estado);
	function tabla(estado){
		console.log(estado)*/
		$(document).ready(function() {
	manageMemberTable = $("#manageMemberTable").DataTable({
	
		'ajax': baseurl+'index.php/Cmantenimiento_planificacion/tabla',
		//type:"POST",
    //data:{estado: estado},
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


function edit(co_frecuencia_mtto = null) 
{
	if(co_frecuencia_mtto) {
		$("#editForm3")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$.ajax({
			url: baseurl+'index.php/Cmantenimiento_planificacion/obtener_tabla/'+co_frecuencia_mtto,
			type: 'post',
			dataType: 'json',
			success:function(response) {

console.log(response.co_frecuencia_mtto);
				$("#co_unidad_tiempo").val(response.co_unidad_tiempo);	
				$("#nu_frecuencia_mtto").val(response.nu_frecuencia_mtto);	

				$("#editForm3").unbind('submit').bind('submit', function() {
					
					var form = $(this);

					$.ajax({
						url: form.attr('action') + '/' +co_frecuencia_mtto,
						type: 'post',
						data: form.serialize(),
						dataType: 'json',
						success:function(response) {
							if(response.success === true) {
							
								// hide the modal
								$("#editModal").modal('hide');

								// update the manageMemberTable
								manageMemberTable.ajax.reload(null, false); 
alert ("Frecuencia editada exitosamente");
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


function plan_mtto(co_frecuencia_mtto = null) 

{//console.log(co_frecuencia_mtto);
	if(co_frecuencia_mtto) {
		$("#editForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$.ajax({
			url: baseurl+'index.php/Cmantenimiento_planificacion/obtener_tabla/'+co_frecuencia_mtto,
			type: 'post',
			dataType: 'json',
			success:function(response) {
		c=moment(response.fe_planificada).format('l'); 
		//console.log(c)
				$("#co_plan_mtto").val(response.co_plan_mtto);	
				$("#in_estado_mtto").val(response.in_estado_mtto);	
				$("#fe_planificada").val(response.fe_planificada);	
				$("#fe").val(response.fe_planificada);

				$("#editForm").unbind('submit').bind('submit', function() {
					
					var form = $(this);

					$.ajax({
						url: form.attr('action') + '/' +response.co_plan_mtto,
						type: 'post',
						data: form.serialize(),
						dataType: 'json',
						success:function(response) {
							if(response.success === true) {
							

								// hide the modal
								$("#plan_mtto").modal('hide');

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

function reprogramar_mtto(co_frecuencia_mtto = null) 
{
	if(co_frecuencia_mtto) {
		$("#editForm2")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$.ajax({
			url: baseurl+'index.php/Cmantenimiento_planificacion/obtener_tabla/'+co_frecuencia_mtto,
			type: 'post',
			dataType: 'json',
			success:function(response) {
				console.log(response.fe_reprogramada)
			//	c=moment(response.fe_reprogramada).format('l'); 
				$("#co_plan_mtto").val(response.co_plan_mtto);	
				$('[name="estado"]').val(response.co_plan_mtto);
			//	$("#estado").val(response.in_estado_mtto);	
				$("#reprogramar").val(response.fe_reprogramada);	
			console.log(response.fe_reprogramada)
		//	c=moment(response.fe_planificada).format('DD-MM-YYYY'); 
		//console.log(c)
				$("#editForm2").unbind('submit').bind('submit', function() {
					
					var form = $(this);

					$.ajax({
						url: form.attr('action') + '/' +response.co_plan_mtto,
						type: 'post',
						data: form.serialize(),
						dataType: 'json',
						success:function(response) {
							if(response.success === true) {
							

								// hide the modal
								$("#reprogramar_mtto").modal('hide');

								// update the manageMemberTable
								manageMemberTable.ajax.reload(null, false); 
alert ("Fecha planificada exitosamente");
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

$('.datepicker').datepicker({
        autoclose: true,
				format: "dd-mm-yyyy",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
				minDate: 0,
				beforeShowDay: $.datepicker.noWeekends,
    });

		$.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fe").datepicker();
$("#reprogramar").datepicker();

});

//$("#fe").datetimepicker({ format: 'YYYY-MM-DD' }); //desactiva la hora
//'fecnac' => date('Y-m-d',strtotime(str_replace('/','-',$param['fecnac'])))
c=moment().month()+1;
//console.log(c)
  </script>