
<script type="text/javascript"> var baseurl="<?php echo base_url();?>";  </script>

<script src='<?php echo base_url();?>assets/highcharts/series-label.js'></script>
<script src='<?php echo base_url();?>assets/highcharts/highcharts.js'></script>
<script src='<?php echo base_url();?>assets/highcharts/exporting.js'></script>
        <style type="text/css">
#container {
	min-width: 310px;
	max-width: 800px;
	height: 400px;
	margin: 0 auto
}
		</style>
	

<div id="container"></div>
		<script type="text/javascript">
       
        var año=moment().year();
datagrafico(año);
function datagrafico(año){
    Nombre_Mes=['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
    $.ajax({
        url: baseurl+"index.php/Creportes/getNagios",
        type: "post",
        data:{year:año},
        dataType: "json",
        success: function(data){
            var meses = new Array();
            var registro1 = new Array();
            var registro2 = new Array();
            var registro3 = new Array();
            var registro4 = new Array();
            var registro5 = new Array();
            $.each(data,function(key,value){
                meses.push(Nombre_Mes[value.mes-1]);
                valor1= Number(value.toner_negro);
                registro1.push(valor1);
                valor2= Number(value.deposito_toner);
                registro2.push(valor2);
                valor3= Number(value.tambor_negro);
                registro3.push(valor3);
                valor4= Number(value.revelador_negro);
                registro4.push(valor4);
                valor5= Number(value.fusor);
                registro5.push(valor5);
//avg(nu_porcent_toner_negro)  as  toner_negro, AVG(nu_porcent_deposito_toner) as deposito_toner, AVG(nu_porcent_tambor_negro) as tambor_negro, AVG(nu_porcent_revelador_negro) as revelador_negro, AVG(nu_porcent_fusor) as fusor FROM "sisgesbas"."x001t_historico_monitoreo" WHERE "fe_fecha_monitoreo" >= '2018-01-01' AND "fe_fecha_monitoreo" <= '2018-12-31' GROUP BY "mes", "tx_nombre_servicio_nagios" ORDER BY "mes" ASC                
/*
 valor3 = Number(value.registro_cul);
                registros3.push(valor3);
*/
            });//each
            graficar(meses,registro1,registro2,registro3,registro4,registro5);
            
} //success
    });//peticion ajax
}//function
function graficar(mes,registro1,registro2,registro3,registro4,registro5){
Highcharts.chart('container', {

    title: {
        text: 'Servicios de Impresion Nagios'
    },

    subtitle: {
        text: 'Año: 2018'
    },
xAxis:{
    categories:mes,
    crosshair:true
},
    yAxis: {
        min:0,
        max:100,
        title: {
            text: 'Porcentaje (%)'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 0
        }
    },
//nu_porcent_toner_negro,nu_porcent_deposito_toner,nu_porcent_tambor_negro,nu_porcent_revelador_negro
    series: [{
        name: '% Toner Negro',
        data: registro1
    }, {
        name: '% Deposito Toner',
        data: registro2
    }, {
        name: '% Tambor negro',
        data: registro3
    }, {
        name: '% Revelador negro',
        data: registro4
    },
    {
        name: '% Unidad Fusora',
        data: registro5
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    },
    exporting: {
        chartOptions: {
          chart: {
            spacingBottom: 90
          },
          subtitle: {
            verticalAlign: 'bottom',
          
            text: `  <br> Atentamente <br>  ________________  <br>Nestor Garcia <br>Supervisor Soporte Basico <br>AIT/Anzoategui Norte <br>EXT:74546`
          }
        }
    }
});


}
/*
xAxis:{
    categories:[
        'Ene',
        'Feb',
        'Mar',
        'Abr',
        'May',
        'Jun',
        'Jul',
        'Ago',
        'Sep',
        'Oct',
        'Nov',
        'Dic'
    ],
    crosshair:true
},

*/
		</script>

