<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='<?php echo base_url();?>assets/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url();?>assets/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>

<script src='<?php echo base_url();?>assets/fullcalendar/lib/moment.min.js'></script>
<!-- <script src='<?php echo base_url();?>assets/fullcalendar/lib/jquery.min.js'></script> -->
<script src='<?php echo base_url();?>assets/fullcalendar/fullcalendar.min.js'></script>
<script src='<?php echo base_url();?>assets/fullcalendar/locale/es.js'></script>


	                  <h4>Calendario de Tareas</h4>


<div class="modal fade" id="modalEvento" tabindex="-1" role="dialog">
<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detalles</h4>
      </div>
      <form method="post" action="<?php echo base_url();?>index.php/Cmantenimiento_ud_tiempo/edit" id="editForm">
      <div class="modal-body">        
			  
<div class="form-group form-group-sm">
<label>N° Mantenimiento</label>
<input type="text" class="form-control" id="txtserial">			
    </div>

	<div class="form-group form-group-sm">
	<label>Serial del Activo</label>
<input type="text" class="form-control" id="serial">
</div>

	<div class="form-group form-group-sm">
<label>Nombre de la Tarea</label>
<input type="text" class="form-control" id="txtnombre">
</div>


<div class="form-group form-group-sm">
	<label>Tiempo estimado de la tarea</label>
<input type="text" class="form-control" id="tiempo">
</div>

	<div class="form-group form-group-sm">
	<label>Fecha Planificada</label>
	<input type="text" class="form-control" id="fecha1">
</div>

	<div class="form-group form-group-sm">
	<label>Fecha Reprogramada</label>
<input type="text" class="form-control" id="fecha2">
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- /edit mmebers -->

<script>

	$(document).ready(function() {


		$.post('<?php echo base_url();?>index.php/Cmantenimiento_calendario/getEventos',
			function(data){
               console.log(data);

		$('#calendar').fullCalendar({
		//	height: 650,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month'
				//agendaWeek,agendaDay,listMonth'
			},
			defaultDate: new Date(),
			navLinks: true, // can click day/week names to navigate views
			businessHours: false, // display business hours
			editable: false,
                events: $.parseJSON(data),
				eventClick: function(event, jsEvent, view) {

				    	// alert(event.title);
				    	$('#mhdnIdEvento').val(event.id);
				    	$('#mtitulo').html(event.title);
				    	$('#txtserial').val(event.id);
						$('#serial').val(event.tx_serial);
						var mom = moment(event.tiempo, 'HH:mm:ss');
						//tiempo=moment(event.tiempo).format('HH:mm');
						//console.log(mom.format());
						console.log(mom.format('HH:mm'));
						$('#tiempo').val(mom.format('HH:mm'));
						$('#txtnombre').val(event.title);
						c=moment(event.start).format('DD-MM-YYYY'); 
						if(event.end==null){
							$('#fecha2').val(event.end);
						}
						else{
							d=moment(event.end).format('DD-MM-YYYY'); 
							$('#fecha2').val(d);
						}
					
						$('#fecha1').val(c);	
						//if (moment(event.end).format('DD-MM-YYYY').isValid()) {d=""}
						
						$('#fecha3').val(event.evento);
				    	$('#modalEvento').modal();
//var end_date_moment, end_date; jsonNC.end_date = jsonNC.end_date.replace(" ", "T"); end_date_moment = moment(jsonNC.end_date); end_date = end_date_moment.isValid() ? end_date_moment.format("L") : "";
				    	if (event.url) {
				    		window.open(event.url);
				    		return false;
				    	}

				    }
			/*events: [
				{
					title: 'Business Lunch',
					start: '2016-12-03T13:00:00',
					constraint: 'businessHours'
				},
				{
					title: 'Meeting',
					start: '2016-12-13T11:00:00',
					constraint: 'availableForMeeting', // defined below
					color: '#257e4a'
				},
				{
					title: 'Conference',
					start: '2016-12-18',
					end: '2016-12-20'
				},
				{
					title: 'Party',
					start: '2016-12-29T20:00:00'
				},

				// areas where "Meeting" must be dropped
				{
					id: 'availableForMeeting',
					start: '2016-12-11T10:00:00',
					end: '2016-12-11T16:00:00',
					rendering: 'background'
				},
				{
					id: 'availableForMeeting',
					start: '2016-12-13T10:00:00',
					end: '2016-12-13T16:00:00',
					rendering: 'background'
				},

				// red areas where no events can be dropped
				{
					start: '2016-12-24',
					end: '2016-12-28',
					overlap: false,
					rendering: 'background',
					color: '#ff9f89'
				},
				{
					start: '2016-12-06',
					end: '2016-12-08',
					overlap: false,
					rendering: 'background',
					color: '#ff9f89'
				}
			]*/
        });

		
		});
		
	});

</script>
<style>
		Table > thead{
    background: white !important;
    color: white;

}
	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 10px;
        color:black;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
		color: black !important;

	}

</style>


<div class="col-xs-10">
	<div id='calendar'></div>
</div>
</body>
</html>
