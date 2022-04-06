
 <?php 
$Session_covi=$this->session->userdata('usuario_covi');
  $co_usuario = $Session_covi['co_usuario'];
 $usuario = $Session_covi['nombre'];
 $apellido = $Session_covi['apellido'];?>

<h4>Realizar  Mantenimiento</h4>
<div class="container">
<div class="row">     

<div class="col-xs-4">



<input type="hidden" class="form-control datepicker" id="fe_real" name="fe_real" data-date-format="dd/mm/yyyy" readonly>
<input type="hidden" name="fe_planificada" id="fe_planificada" value="<?php echo $fecha_planificada?>">
<input type="hidden" name="fe_reprogramada" id="fe_reprogramada" value="<?php echo $fecha_reprogramada?>">
<?php if(!empty($activo)):?>
<?php foreach ($activo as $value):?>
 
<h5><b>Ficha tecnica del activo: </b></h5>
<li class="list-unstyled" ><b>Serial: </b><?php echo $value->tx_serial?></li>
<input type="hidden" class="form-control" id="serial" value="<?php echo $value->tx_serial?>">
<li class="list-unstyled"><b>Marca: </b><?php echo $value->marca?></li>
<li class="list-unstyled"><b>Modelo: </b><?php echo $value->modelo?></li>
<li class="list-unstyled"><b>Clase de Activo: </b><?php echo $value->tx_clase_activo?></li>
<li class="list-unstyled"><b>Tipo de Activo: </b><?php echo $value->tx_clase_activo_detalle?></li>
<li class="list-unstyled"><b>Criticidad: </b><?php echo $value->tx_criticidad?></li>
<li class="list-unstyled"><b>Ubicacion: </b><?php echo $value->tx_direccion?></li>


 <?php endforeach;?>
    <?php endif;?>


    <?php if(!empty($tarea)):?>
<?php foreach ($tarea as $value):?>

<h5><b>Tarea: </b></h5>
<li class="list-unstyled"><b>Tarea: </b><?php echo $value->tx_tarea_mtto?></li>
<li class="list-unstyled"><b>Descripción: </b><?php echo $value->tx_descripcion_mtto?></li>
<li class="list-unstyled"><b>Duración: </b><?php echo date("H:i",strtotime($value->nu_tiempo_tarea))?></li>
<li class="list-unstyled"><b>Frecuencia: </b><?php echo $frecuencia?> <?php echo $datos_frecuencia?> </li>
 <?php endforeach;?>
    <?php endif;?>
   
</div>



<div class='col-xs-5'>

<label for="edit_tx_mto_descripcion">Descripcion </label>
    <textarea class="form-control input-sm" rows="2" name="tx_mto_descripcion"  id="tx_mto_descripcion" placeholder="Descripcion" required></textarea>
   
    
    
     <h5><b>Listados de Herramientas y Materiales</b></h5>
<table  class="table table-bordered table-striped table-hover" id="manageMemberTable">
    <thead>
                        <tr>
                            <th>Herramienta</th>
                            <th>Tipo</th>
                          
                            
                        </tr>
                    </thead>
                  <tbody>   
 <?php if(!empty($herramienta)):?>
 <?php foreach ($herramienta as $value):?>
<tr>
<td><?php echo $value->tx_herramienta?></td>
<td><?php echo $value->tx_tipo?></td>

</tr>
    
    <?php endforeach;?>
    <?php endif;?>
         </tbody>
         </table>
 </div>
<div class="col-xs-1">
 <button type="submit" value="ingresar" onclick="ingresar()" id="che" class="btn btn-danger btn-sm" style="margin-top:22px; margin-left:-15px">Ingresar</button>
 </div>

 <div class="modal fade" tabindex="-1" role="dialog" id="finalizar_mtto">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Realizar Mantenimiento</h4>
        <form method="post" action="<?php echo base_url();?>index.php/Cmantenimiento_planificacion/realizar_mtto" id="editForm">
      </div>
      <div class="modal-body">
        <li class="list-unstyled" id="tx_serial">¿Esta seguro que se culmino el mantenimiento?</li>
<br>
<input type="hidden"  class="form-control" id="fecha" name="fecha" data-date-format="dd/mm/yyyy" value="<?php echo set_value('fe_real'); ?>">
<input type="hidden"  class="form-control" id="descripcion" name="descripcion">
 <input type="hidden" name="co_usuario" id="co_usuario" value="<?php echo $co_usuario?>">
<input type="hidden" name="co_plan_mtto" id="co_plan_mtto" value="<?php echo $co_plan_mtto?>">
<input type="hidden" name="nu_frecuencia_mtto" id="nu_frecuencia_mtto" value="<?php echo $frecuencia?>">
<input type="hidden" name="co_activo" id="co_activo" value="<?php echo $co_activo?>">
<input type="hidden" name="co_unidad_tiempo" id="co_unidad_tiempo" value="<?php echo $tiempo?>">
<input type="hidden" name="co_tipo_mtto" id="co_tipo_mtto" value="<?php echo $tipo_mtto?>">
<input type="hidden" name="co_tarea_mtto" id="co_tarea_mtto" value="<?php echo $co_tarea?>">
<label>Fecha del Proximo Mantenimiento: </label>
<input type="text" name="fe_pro_mtto" id="fe_pro_mtto" class="form-control" readonly>
<input type="hidden" name="tx_nombre" id="tx_nombre">


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Registrar</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 





</div>
</div>

<script>


//boton desabilita si no es la fecha del mtto. planificado
$('#che').prop( "disabled", true);


var fecha_planificada =  document.getElementById('fe_planificada').value
fecha_reprogramada = document.getElementById('fe_reprogramada').value

diferencia=moment().diff(fecha_planificada, 'days') // 1
diferencia2=moment().diff(fecha_reprogramada, 'days') // 1
console.log(diferencia)
console.log(diferencia2)

if(diferencia==0 || diferencia2==0||coment == ""){   
$('#che').prop( "disabled", false);
}
//('#che').toggle();
function ingresar(){
var coment = document.getElementsByName("tx_mto_descripcion")[0].value;
console.log('longitud'+coment)

// valida si esta vacio el modal en donde #finalizar_mtto es rl id del modal toggle tipo 
if ( (coment == "")) {  //COMPRUEBA CAMPOS VACIOS
    alert("El campo descripción es obligatorio ");
}
else{
    $('#finalizar_mtto').modal('toggle');
}
}

$("#che").on("click", function(){


descripcion = document.getElementById('tx_mto_descripcion').value; //recibe
console.log(descripcion)
 document.getElementById('descripcion').value=descripcion;//envia

 //
serial=document.getElementById('serial').value
console.log(serial)
document.getElementById('tx_serial').value=serial


 fecha_real = document.getElementById('fe_real').value; //recibe
console.log(fecha_real)
 document.getElementById('fecha').value=fecha_real//envia
});

var manageMemberTable;
$(document).ready(function() {
  manageMemberTable = $("#manageMemberTable").DataTable({
    //'ajax': baseurl+'index.php/Cactivo_modelo/tabla',
   // 'orders': [],

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
moment().format('l')
 frecuencia = document.getElementById("nu_frecuencia_mtto").value; //recibe
 tiempo = document.getElementById('co_unidad_tiempo').value; //recibe
 document.getElementById('fe_pro_mtto').value=tiempo//envia
 document.getElementById('fe_real').value=moment().format('L') //envia
//alert(frecuencia)
//frecuencia=3
//tiempo=2
console.log(frecuencia);
console.log(tiempo);

moment.locale('es'); //traduce a español
//MENSUAL
//Mensual LISTO
if(tiempo==2){
    if(frecuencia==1){
        resultado=moment().add( 1, 'M').calendar();
    }
    else{
        resultado=moment().add(4/frecuencia,'w')
        resultado=moment(resultado).format('l')
       // console.log(moment(resultado).format('l'))
    }

//resultado=moment().add( 4/frecuencia, 'w').calendar();
//console.log(resultado)
}


//Semanal Arreglar Formato
if(tiempo==1){
  //  moment(date2).add(1,'day').format('l')
    if(frecuencia==1){
        var fecha_actual = new Date(moment().format('l'))
  
        resultado=moment().add( 1, 'w').calendar();
    }
    else{
        resultado=moment(fecha_actual).add( 1/frecuencia, 'w').format('l');
      
    }
}
//Diaria LISTO 
if(tiempo==3){ 
    var fecha_actual = new Date(moment().format('l'))

    if(frecuencia==1){//verificar esto
        resultado=moment(fecha_actual).add( 0, 'd').format('l');
       //resultado=moment(resul).format('l')
     //  console.log(moment(resul).format('l'))
    }
}

//Anual LISTO
if(tiempo==4){
    if(frecuencia==1){
        resultado=moment().add( 1, 'y').calendar();
    }
    else{
        resultado=moment().add( 12/frecuencia, 'M').calendar();
    }

}
//CAUTRIMESTRE LA FRECUENCIA DIVIDIA ENTRE 3 NO funciona
frecuencia==3
if(tiempo==5){
    if(frecuencia==1){
        resultado=moment().add( 1, 'Q').calendar();
    }
    else if(frecuencia==2){
        
        resultado=moment().add( 1/2, 'Q').calendar();
    }
    else {
        alert("entro")
        resultado=moment().add( 6, 'w').calendar();
    }
    
}

console.log(resultado)
document.getElementById('fe_pro_mtto').value=resultado
/*
c=4
if( c=2){
    //MENSUAL
    nu_frecuencia=2
    30/2
    c=moment().add( 1, 'w').calendar(); //fe_planificada o reprogramada
 //   c=moment().add(3, 'days').calendar();
 console.log(c); 
}
//SEMANAL
if(c=1){
c=moment().add( 1, 'w').calendar();
console.log(c); 
}
// DIARIA
if(3){
    c=moment().add( 1, 'd').calendar();
    console.log(c); 
}
// ANUAL
if(4){
 //frecuencia 4
    c=moment().add( 12/4, 'M').calendar();
    console.log(c); 
}*/

//c=moment().add(3, 'days').calendar();
//console.log(c);  
/*
var hora_actual=moment().format('LTS');  // 11:32:46
console.log(hora_actual)
//Libreria Moment.js
//get star
var date= '2015-04-03'
var format= 'LLLL'
var result= moment(date).format(format)
console.log(result)//Friday, April 3, 2015 12:00 AM
// Calculate
var date2 = new Date('2014/12/31')
//var dateString= moment(date2).add({day:1,months:6}.format('1'))
var dateString=moment(date2).add(1,'day').add(6,'months').format('l')// 7/1/2015
console.log(dateString)
//Interval Time

var date3 ='2010-06-30'
var end = '2010-01-25'
var start = '2010-12-31'
var result= moment(date3).isBetween(end,start,'months') //true
console.log(result) 

//Relative Time
var start2= '2010-10-25'
var end2= '2010-12-25'
var result=moment(end2).diff(moment(start2))
console.log(result) // direrencia milisegundos 5270400000
var humanize= moment.duration(result).humanize();
console.log(humanize) // 2 months
var asHours= moment.duration(result).as('hours')
console.log(asHours) //1464
var result =moment(start).fromNow() //diferencia fecha actual en años
console.log(result) // 7 years ago

// Humanization languaje 
//var result =moment(date).locate('fr').fromNow()
console.log(result)

<input type="hidden" name="co_usuario" id="co_usuario" value="<?php echo $co_usuario?>">
<input type="hidden" name="co_plan_mtto" id="co_plan_mtto" value="<?php echo $co_plan_mtto?>">
<input type="hidden" name="nu_frecuencia_mtto" id="nu_frecuencia_mtto" value="<?php echo $frecuencia?>">
<input type="hidden" name="co_activo" id="co_activo" value="<?php echo $co_activo?>">
<input type="hidden" name="co_unidad_tiempo" id="co_unidad_tiempo" value="<?php echo $tiempo?>">
<input type="hidden" name="co_tipo_mtto" id="co_tipo_mtto" value="<?php echo $tipo_mtto?>">
<input type="hidden" name="co_tarea_mtto" id="co_tarea_mtto" value="<?php echo $co_tarea?>">
<input type="hidden" name="fe_pro_mtto" id="fe_pro_mtto">
<input type="hidden" name="tx_nombre" id="tx_nombre">
<input type="text" name="tx_plan" id="tx_plan">
*/
$('.datepicker').datepicker({
        autoclose: true,
    //    format: "dd-mm-yyyy",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
        minDate: 0,
        maxDate: 0,
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


//$('#fe_real').datepicker('option', 'minDate', new Date(moment().year(), moment().month()+1, moment().date())); 
//$("#fe").datetimepicker({ format: 'YYYY-MM-DD' }); //desactiva la hora
//'fecnac' => date('Y-m-d',strtotime(str_replace('/','-',$param['fecnac'])))


</script>