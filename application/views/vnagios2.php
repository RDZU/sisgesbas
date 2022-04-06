<h4>Nagios</h4>
<div class ="col-xs-10">
<table  class="table table-bordered table-striped table-hover" id="datatable">
                    <thead>
                       
                            <th>Nombre del Servicio</th>
                            <th>% Toner Negro</th>
                            <th>% Deposito Toner</th>
                            <th>% Tambor Negro</th>
                            <th>% Revelador Negro</th>
                            <th>N° Contador</th>
                            <th>% Fusor</th>
                           
                            <th>Estado del Host</th>
                            <th>Estado del Servicio</th>
                            <th>Fecha Monitoreo</th>
                        </tr>
                    </thead>
            
                </table>

</div>

<?php
$impresiones = file_get_contents('http://localhost/pdvsa.com/nagios/consumible.php');
$consumibles = file_get_contents('http://localhost/pdvsa.com/nagios/impresora.php');



?>

  

  
  <script>

var manageMemberTable;

$(document).ready(function() {
  manageMemberTable = $("#datatable").DataTable({
    'ajax': baseurl+'index.php/Cnagios/tabla',
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
    },
    "scrollX": true
}
  }); 
});
/* La recoleccion de datos de nagios Esta desactivado para la prueba local las 2 direcciones exacta son:


Nagios_imp = <?php echo $impresiones?>;
Nagios = <?php echo $consumibles?>;

JSON.stringify(Nagios_imp);
JSON.stringify(Nagios);

var tx_nombre_servicio_nagios=Nagios_imp.host_name;  //nombre del servicio en nagios
var host_state=Nagios.host_state;  //estado de la impresora UP o OFF
var state=Nagios.state;  //si OK Critical o Warning
var impresiones=Nagios_imp.plugin_output.split(' '); 
var nu_total_contador= impresiones[2].replace(",","."); //numero total de impresiones
var tx_estado=Nagios.plugin_output;
var datos_consumibles=Nagios.perf_data.split("=");
toner_negro=datos_consumibles[1].split(";");
nu_toner_negro=toner_negro[0]; //porcentaje del toner negro
deposito_toner=datos_consumibles[2].split(";");
nu_deposito_toner=deposito_toner[0]; //porcentaje del deposito del toner
tambor_negro=datos_consumibles[3].split(";");
nu_tambor=tambor_negro[0]; // porcentaje tambor photoconductor
revelador_negro=datos_consumibles[4].split(";");
nu_revelador_negro=revelador_negro[0]; //porcentaje revelador
unidad_fusora=datos_consumibles[5].split(";");
nu_unidad_fusora=unidad_fusora[0];  //unidad_fusora

// alert(state);

  $.post(baseurl+"index.php/Cnagios/insertar", 
  {
tx_nombre_servicio_nagios:tx_nombre_servicio_nagios,
nu_total_contador:nu_total_contador,
nu_toner_negro:nu_toner_negro,
nu_deposito_toner:nu_deposito_toner,
nu_tambor:nu_tambor,
nu_revelador_negro:nu_revelador_negro,
nu_unidad_fusora:nu_unidad_fusora,
tx_estado:tx_estado,
host_state:host_state,
state:state
  },
  function(data){

  });

  var f1 = new Date(); 


if (f1.getHours()+":"+f1.getMinutes()){
    console.log(f1);
}


*/
  </script>
 