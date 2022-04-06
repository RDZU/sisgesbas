<h4> Reportes</h4>
<script type="text/javascript"> var baseurl="<?php echo base_url();?>";  </script>

<script src='<?php echo base_url();?>assets/highcharts/series-label.js'></script>
<script src='<?php echo base_url();?>assets/highcharts/highcharts.js'></script>
<script src='<?php echo base_url();?>assets/highcharts/exporting.js'></script>



<div class="col-xs-10">



<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
<div class="col-xs-1">
<label>Año</label>
<select name="year" id="year" class="form-control input-sm"style="padding-left: 5px;">
<?php foreach($year as $value): ?>

<option value="<?php echo $value->años;?>">
<?php echo $value->años;?>
</option>
<?php endforeach; ?>

</div>
<script type="text/javascript">
//$(document).ready(function () {
var año=moment().year();
datagrafico(año);
$("#year").on("change",function(){
 //captura la fecha actual libreria moment 
 var yearselect= $(this).val();
 datagrafico(yearselect);

});

function datagrafico(age){
    namesMonth= ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Set","Oct","Nov","Dic"];
    $.ajax({
        url: baseurl + "index.php/Creportes/getData",
        type:"POST",
        data:{year: age},
        dataType:"json",
        success:function(data){
            var meses = new Array();
            var registros = new Array();
            $.each(data,function(key, value){
                meses.push(namesMonth[value.mes - 1]);
                valor = Number(value.registro);
                registros.push(valor);
            }); //each data


            graficar(meses,registros,year);
        //    graficar(meses,registros,year);
        } //function data
        });//ajax
}//function
function graficar(meses,registros,year){
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Estatus del mantenimiento'
    },
    subtitle: {
        text: 'Año:'+año
    },
    xAxis: {
        categories: meses,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Cantidad (und.)'
        }
    },
    tooltip: { // point.y:.1f 1 decimal
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Planificados',
        data: registros

    }, {
        name: 'Reprogramados',
        data: [6, 8, 5, 4, 0,5,10,13,2,5,6,3]

    }, {
        name: 'Cerrados',
        data: [9, 8,3,4,4,4,9,6,4,2,3,2]

   

    }]//series



   
//}) //document ready
});//highchart
}//function
		</script>