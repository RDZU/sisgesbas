<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*! 
 \fechas.php Página que contiene las funciones para el manejo de fechas
*/

//****************************************************************************************************	
function NumeroMes($mes)
    {
	  switch ($mes)
		{
			case "Enero":  $nombre_mes = 1;
		    		 break;
			case "Febrero":  $nombre_mes = 2;
					 break;
			case "Marzo":  $nombre_mes = 3;
					 break;
			case "Abril":  $nombre_mes = 4;
					 break;
			case "Mayo":  $nombre_mes = 5;
					 break;
			case "Junio":  $nombre_mes = 6;
					 break;
			case "Julio":  $nombre_mes = 7;
					 break;
			case "Agosto":  $nombre_mes = 8;
					 break;
			case "Septiembre":  $nombre_mes = 9;
					 break;
			case "Octubre": $nombre_mes = 10;
					 break;
			case "Noviembre": $nombre_mes = 11;
					 break;
			case "Diciembre": $nombre_mes = 12;
					 break;
		}	  
	  return $nombre_mes;
	}
//Función que retorna el nombre del dia de un mes. Ej: Junio
//****************************************************************************************************	
function NombreMes($mes)
    {
	  switch ($mes)
		{
			case 1:  $nombre_mes = "Enero";
		    		 break;
			case 2:  $nombre_mes = "Febrero";
					 break;
			case 3:  $nombre_mes = "Marzo";
					 break;
			case 4:  $nombre_mes = "Abril";
					 break;
			case 5:  $nombre_mes = "Mayo";
					 break;
			case 6:  $nombre_mes = "Junio";
					 break;
			case 7:  $nombre_mes = "Julio";
					 break;
			case 8:  $nombre_mes = "Agosto";
					 break;
			case 9:  $nombre_mes = "Septiembre";
					 break;
			case 10: $nombre_mes = "Octubre";
					 break;
			case 11: $nombre_mes = "Noviembre";
					 break;
			case 12: $nombre_mes = "Diciembre";
					 break;
		}	  
	  return $nombre_mes;
	}		
//***************************************************************************************************


//Función que retorna el nombre del dia de semana. Ej: Domingo
//****************************************************************************************************	
function NombreDiaSemana($dia)
    {	  		
		switch ($dia)
		  {
			case 0: $nombre_dia = "Domingo";
					break;
			case 1: $nombre_dia = "Lunes";
					break;
			case 2: $nombre_dia = "Martes";
					break;
			case 3: $nombre_dia = "Mi&eacute;rcoles";
					break;
			case 4: $nombre_dia = "Jueves";
					break;
			case 5: $nombre_dia = "Viernes";
					break;
			case 6: $nombre_dia = "S&aacute;bado";
					break;
		  }		
		return $nombre_dia;	  
	}		

/****************************************************************************************************************************/

//fecha formato  lunes, 7 de Marzo de 2011
function fecha()
{	//$locacionactual = setlocale(LC_TIME, NULL);//Guarda la locación actual
	//setlocale(LC_TIME, 'es_VE');//Establece la locación a español - Venezuela
	//$fecha = ucwords(strftime("%A, %d de %B de %Y"));//Imprime la fecha
	$fecha = NombreDiaSemana(strftime("%w")).', '.strftime("%d").' de '.NombreMes(strftime("%m")).' de '.strftime("%Y"); //Imprime la fecha
	//setlocale(LC_TIME, $locacionactual);//Restablece la locación
	return $fecha;//Retorna la fecha actual
}  

/****************************************************************************************************************************/
//Devuelve la fecha con el formato el PostgreSQL para hacer las inserciones
function fecha_bd() 
{	return date("Y-m-d H:i:s");
}
/****************************************************************************************************************************/
//Devuelve la fecha con el formato venezolano para hacer las inserciones
function fecha_dmahms() 
{	return date("d-m-Y H:i:s");
}

/****************************************************************************************************************************/
//Devuelve la suma de una fecha más un número de días
function sumaDia($fecha,$dia)
{	list($year,$mon,$day) = explode('-',$fecha);
	return date('Y-m-d',mktime(0,0,0,$mon,$day+$dia,$year));		
}
/****************************************************************************************************************************/
//Devuelve la suma de una fecha más un número de días
function sumaMes($fecha,$mes)
{	list($year,$mon,$day) = explode('-',$fecha);
	return date('Y-m-d',mktime(0,0,0,$mon+$mes,$day,$year));		
}
/****************************************************************************************************************************/
//Devuelve la la fecha en formato dia-mes-ano
function formato_dmy($fecha)
{	list($year,$mon,$day) = explode('-',$fecha);
	return date('d-m-Y',mktime(0,0,0,$mon,$day,$year));		
}
/****************************************************************************************************************************/
// Función titulo_fecha: retorna el título según el rango de la fecha indicada
function titulo_fecha($fecha_inicio,$fecha_final,$tipo)
{	$fecha_inicio = date("Y-m-d",strtotime($fecha_inicio));
	$fecha_final = date("Y-m-d",strtotime($fecha_final));
	if ($tipo == "SEMANA")
	{	$fecha_aux_inicio = sumaDia($fecha_final,(-6));
	}
	if ($tipo == "MES")
	{	list($year,$mon,$day) = explode('-',$fecha_final);
		$fecha_aux_inicio = date('Y-m-d',mktime(0,0,0,$mon,1,$year));
	}
	if ($tipo == "DIA")
	{	$fecha_aux_inicio = $fecha_inicio;
	}
	$fecha_aux_final = $fecha_final;
	$tipo_aux = $tipo;
	
	if ($tipo == "DIA")
	{	if ($fecha_aux_inicio == $fecha_aux_final)
			$titulo_grafica2 = "del dia ".date("d-m-Y",strtotime($fecha_aux_inicio));
		else
			if (date("Y-m",strtotime($fecha_aux_inicio)) == date("Y-m",strtotime($fecha_aux_final)))
				$titulo_grafica2 = "desde el ".date("d",strtotime($fecha_aux_inicio))." al ".date("d-m-Y",strtotime($fecha_aux_final));
			else
				if (date("Y",strtotime($fecha_aux_inicio)) == date("Y",strtotime($fecha_aux_final)))
					$titulo_grafica2 = "desde el ".date("d-m",strtotime($fecha_aux_inicio))." al ".date("d-m-Y",strtotime($fecha_aux_final));
				else
					$titulo_grafica2 = "desde el ".date("d-m-Y",strtotime($fecha_aux_inicio))." al ".date("d-m-Y",strtotime($fecha_aux_final));
	}
	if ($tipo == "SEMANA")
	{	if (date("Y-m",strtotime($fecha_aux_inicio)) == date("Y-m",strtotime($fecha_aux_final)))
			$titulo_grafica2 = "Semana del ".date("d",strtotime($fecha_aux_inicio))." al ".date("d-m-Y",strtotime($fecha_aux_final));
		else
			if (date("Y",strtotime($fecha_aux_inicio)) == date("Y",strtotime($fecha_aux_final)))
				$titulo_grafica2 = "Semana del ".date("d-m",strtotime($fecha_aux_inicio))." al ".date("d-m-Y",strtotime($fecha_aux_final));
			else
				$titulo_grafica2 = "Semana del ".date("d-m-Y",strtotime($fecha_aux_inicio))." al ".date("d-m-Y",strtotime($fecha_aux_final));
	}
	if ($tipo == "MES")
	{	$titulo_grafica2 = "Del Mes de ".NombreMes(date("m",strtotime($fecha_aux_inicio)))." de ".date("Y",strtotime($fecha_aux_inicio));
	}
	return $titulo_grafica2;
}
/**********************************************************************************************/
// Función fecha_inicio_tipo: retorna la fecha inicial correspondiente al tipo de grafica
function fecha_inicio_tipo($tipo)
{	$fecha_inicial_inicio = date("Y-m-d");
	if ($tipo == 'MES')
	{	list($year,$mon,$day) = explode('-',$fecha_inicial_inicio);
		$fecha_inicial_inicio = date('Y-m-d',mktime(0,0,0,$mon-12,01,$year));
	}
	 else
	{	if ($tipo == 'SEMANA')
		{	$dia_semana = strftime("%w");
			$dias_sumar = 4 - $dia_semana;
			$fecha_inicial_inicio = sumaDia($fecha_inicial_inicio,$dias_sumar);
			if ($dia_semana <= 4)
				$fecha_inicial_inicio = sumaDia($fecha_inicial_inicio,(-13));
			else
				$fecha_inicial_inicio = sumaDia($fecha_inicial_inicio,(-6));
		}
	}
	return $fecha_inicial_inicio;
}
/**********************************************************************************************/
// Función fecha_final_tipo: retorna la fecha final correspondiente al tipo de grafica
function fecha_final_tipo($tipo)
{	$fecha_inicial_inicio = date("Y-m-d");
	$fecha_inicial_fin = date("Y-m-d");
	if ($tipo == 'MES')
	{	list($year,$mon,$day) = explode('-',$fecha_inicial_inicio);
		$fecha_inicial_inicio = date('Y-m-d',mktime(0,0,0,$mon-12,01,$year));
		$fecha_inicial_fin = sumaMes($fecha_inicial_inicio,12);
		$fecha_inicial_fin = sumaDia($fecha_inicial_fin,(-1));
		//echo "mes";
	}
	 else
	{	if ($tipo == 'SEMANA')
		{	$dia_semana = strftime("%w");
			$dias_sumar = 4 - $dia_semana;
			$fecha_inicial_inicio = sumaDia($fecha_inicial_inicio,$dias_sumar);
			if ($dia_semana <= 4)
				$fecha_inicial_inicio = sumaDia($fecha_inicial_inicio,(-13));
			else
				$fecha_inicial_inicio = sumaDia($fecha_inicial_inicio,(-6));
			$fecha_inicial_fin = sumaDia($fecha_inicial_inicio,(6));
			$fecha_inicial_inicio = sumaDia($fecha_inicial_inicio,(-(7*3)));
		}
	}
	return $fecha_inicial_fin;
}
?>