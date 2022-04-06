
<script type="text/javascript"> var baseurl="<?php echo base_url();?>";  </script>

<script src='<?php echo base_url();?>assets/highcharts/series-label.js'></script>
<script src='<?php echo base_url();?>assets/highcharts/highcharts.js'></script>
<script src='<?php echo base_url();?>assets/highcharts/exporting.js'></script>



<div class="col-xs-10">



<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
<div class="col-xs-1">

<select name="year" id="year" class="form-control input-sm" style="padding-left: 5px;padding-left: 5px;margin-top: -390px;margin-left: 40px;">
<?php foreach($year as $value): ?>

<option value="<?php echo $value->años;?>">
<?php echo $value->años;?>
</option>
<?php endforeach; ?>

</div>

<script type="text/javascript">

var registros = new Array();
var registros2 = new Array();
var registros3 = new Array();
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
        url: baseurl + "index.php/Creportes/getMtto",
        type:"POST",
        data:{year: age},
        dataType:"json",
        success:function(data){ 
           
            var meses = new Array();
        //    var registros3 = new Array();
            $.each(data,function(key, value){
                meses.push(namesMonth[value.mes-1 ]);
                valor3 = Number(value.registro_cul);
                registros3.push(valor3);
                console.log(registros3)
            }); //each data


            graficar(meses,year);
         
        } //function data
      //  });//ajax
  //  });
}); 

}//function
function graficar(meses,year){
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Mantenimientos Culminados'
    },
    subtitle: {
        text: 'Año:'+año
    },
    xAxis: {
        categories:meses,
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
     
        name: 'Culminados',
        data: registros3

   

    }],//series

    exporting: {
        chartOptions: {
          chart: {
            spacingBottom: 90
          },
          subtitle: {
            verticalAlign: 'bottom',
            text: `  <br> Atentamente <br> <br> <br> ________________  <br>Nestor Garcia <br>Supervisor Soporte Basico <br>AIT/Anzoategui Norte <br>EXT:74546`
          }
        }
    }
   
//}) //document ready
});//highchart
}//function
		</script>