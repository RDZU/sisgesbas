<?php
	$validadot = $datos['validadot'];
	if (isset($datos['user']))
		{
			$user      = $datos['user'];
		}
	else
		{
			$user      = '';
		}
		
	if (isset($datos['pass']))
		{
			$pass      = $datos['pass'];
		}
	else
		{
			$pass      = '';
		}
?> 

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>

<title>SISGESBAS - Alpha</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Templates/_css/main-aplicacion2.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>login/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>login/bootstrap-responsive.min.css">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>img/favicon.ico" />
<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>js/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>js/bootstrap.js"></script>
<script type="text/javascript" charset="utf-8">	

window.onload = function () {
document.formularioInicio.user.focus();
document.formularioInicio.addEventListener('submit', validarFormulario);


function validarFormulario(evObject) {
evObject.preventDefault();
var todoCorrecto = true;
var formulario = document.formularioInicio;
usuario = document.getElementById("user").value.length;
pass    = document.getElementById("pass").value.length;
//captcha    = document.getElementById("captcha").value.length;
if (usuario <= 0)
	{
		alert("Debe colocar un usuario");
		formulario.user.focus();
        todoCorrecto=false;
	}
else
	{
		if (pass <= 0)
			{
				alert("Debe colocar el password");
				formulario.pass.focus();
				todoCorrecto=false;
			}
			/*
		else
			{
				if (captcha <= 0)
					{
						alert("Debe colocar el código que se visualiza en la imagen");
						formulario.captcha.focus();
						todoCorrecto=false;
					}
			}
			*/
	}


	
if (todoCorrecto ==true) {formulario.submit();}
}  

if (typeof history.pushState === "function") 
	{
		history.pushState("jibberish", null, null);
		window.onpopstate = function () 
			{
				history.pushState('newjibberish', null, null);
			// Handle the back (or forward) buttons here
			// Will NOT handle refresh, use onbeforeunload for this.
			};
	}
};

<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function Solo_Numerico(variable){
        Numer=parseInt(variable);
        if (isNaN(Numer)){
            return "";
        }
        return Numer;
    }
function ValNumero(Control){
        Control.value=Solo_Numerico(Control.value);
}
//-->


    //obtiene la direccion IP:
    function getIPs(callback){
        var ip_dups = {};

        //compatibilidad exclusiva de firefox y chrome, el usuario @guzgarcia compartio este enlace muy util: http://iswebrtcreadyyet.com/
        var RTCPeerConnection = window.RTCPeerConnection
            || window.mozRTCPeerConnection
            || window.webkitRTCPeerConnection;
        var useWebKit = !!window.webkitRTCPeerConnection;

        //bypass naive webrtc blocking using an iframe
        if(!RTCPeerConnection){
            //NOTE: necesitas tener un iframe in la pagina, exactamente arriba de la etiqueta script
            //
            //<iframe id="iframe" sandbox="allow-same-origin" style="display: none"></iframe>
            //<script>... se llama a la funcion getIPs aqui...
            //
            var win = iframe.contentWindow;
            RTCPeerConnection = win.RTCPeerConnection
                || win.mozRTCPeerConnection
                || win.webkitRTCPeerConnection;
            useWebKit = !!win.webkitRTCPeerConnection;
        }

        //requisitos minimos para conexion de datos
        var mediaConstraints = {
            optional: [{RtpDataChannels: true}]
        };

        var servers = {iceServers: [{urls: "stun:stun.services.mozilla.com"}]};

        //construccion de una nueva RTCPeerConnection
        var pc = new RTCPeerConnection(servers, mediaConstraints);

        function handleCandidate(candidate){
            // coincidimos con la direccion IP
            var ip_regex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/
            var ip_addr = ip_regex.exec(candidate)[1];

            //eliminamos duplicados
            if(ip_dups[ip_addr] === undefined)
                callback(ip_addr);

            ip_dups[ip_addr] = true;
        }

        //escuchamos eventos candidatos
        pc.onicecandidate = function(ice){

            //dejamos de lado a los eventos que no son candidatos
            if(ice.candidate)
                handleCandidate(ice.candidate.candidate);
        };

        //creamos el canal de datos
        pc.createDataChannel("");

        //creamos un offer sdp
        pc.createOffer(function(result){

            //disparamos la peticion (request) al stun server (para entender mejor debemos ver la documentacion de WebRTC.
            pc.setLocalDescription(result, function(){}, function(){});

        }, function(){});

        //esperamos un rato para dejar que todo se complete:
        setTimeout(function(){
            //leemos la informacion del candidato desde la descripcion local
            var lines = pc.localDescription.sdp.split('\n');

            lines.forEach(function(line){
                if(line.indexOf('a=candidate:') === 0)
                    handleCandidate(line);
            });
        }, 1000);
    }

    //Llego la hora de la verdad! vamos a probar: con esto veremos nuestra IP Local:
//    	getIPs(function(ip){console.log(ip);});
		getIPs(function(ip){document.getElementById("ipp").value = ip;});


</script>

</head>
<body>
<div class="container">
<div class="row">

<div class="col-xs-8">

<table width="1100" border="0" cellspacing="0" cellpadding="0" align="center">
	<div class="Contenedor" id="Main-externo">
  		<tr><td colspan="3">
			<div class="Contenedor" id="Main-header">
				<span class="Contenedor-con-Imagen" id="Main-Logo"></span>
				<div class="Contenedor" id="Contenedor-Degradado">
					<div class="Contenedor-con-Imagen" id="Logo-Continuacion">
						<span class="Contenedor" id="Nombre-Aplicacion">Sistema de Control y Gestión de Soporte Básico</span>
					</div>
					<div class="Contenedor-con-Imagen" id="Logo-Final"></div>
				</div>
			</div>
		</td></tr>
		<tr><td colspan="3">
			<div class="Contenedor-con-sombra" id="Main-BackCuerpoRight">
            	<div class="Contenedor-con-sombra" id="Main-BackCuerpoLeft"> 
              		<div class="Contenedor" id="Main-Cuerpo">
						<div class="Contenedor-con-Bordes" id="Main-Identificador_usuario">
							<span class="Texto-Identificador" id="Main-Usuario">Bienvenido</span>
							<span class="Texto-Identificador" id="Main-Fecha"><?php echo fecha(); ?></span>
						</div>
						<div class="Contenedor" id="Main-breadcrumbs">
							<div id="Main-Traza">
								
							</div>
							<div class="EsquinasBread" id="EsquinaBreadDerecha"></div>
						</div>  
						

						
						
						
						
						<br><br><br><br>
							<div class="row-fluid">
							  <div class="span12">

									<div class="span6" style="margin-left: 250px;">
										<center>
											<legend class="text-center"><font style="color:#D84040; font-weight:bold;  text-shadow: 0.1em 0.1em 0.8em #fff;">INGRESO AL SISTEMA</font></legend>
											<?php echo $datos['mensaje']; ?>
										  
										  		<?php 
												$attribute = Array ('name'  => 'formularioInicio');
												echo form_open('clogin/validar',$attribute); ?>
												
												<input id="validadot" name="validadot" value="<?php echo $validadot; ?>" type="hidden">
												<input id="ipp" name="ipp" type="hidden">
												
												<div class="control-group">
													<div  class="input-prepend"> <span class="add-on" style="height:18px"><i class="icon-user"></i></span>
														
														<input id="user" value="<?php echo $user; ?>"style="height:28px" placeholder = "Usuario" name="user" type="text">										  													
													</div>
												</div>
												<div class="control-group">
													<div  class="input-prepend"> <span class="add-on" style="height:18px" ><i class="icon-pencil"></i></span>
														<input id="pass"  value="<?php echo $pass; ?>" style="height:28px" name="pass" placeholder = "Contrase&ntilde;a" type="password">
													</div>
												</div>
												
												
												
												
												                                                
												<div class="control-group">
													<button type="submit" class="btn btn-danger">Entrar</button>
												</div>
										
												<?php echo form_close(); ?>
											
										
										</center>
									</div>
									
									
									<div class="span6"> 
										<center>
											<div class="scrollable">
												<div class="items">
												
												</div>
											</div>
										</center>
									</div>
							  
							  </div>
							</div>
						</div>
						<br><br><br><br>
						
						 
						
						
						
						
					</div>
			</div>
			</div>
			<div class="Contenedor-con-Bordes " id="Main-Contenedor-footer" ><div class="GrisC_12" ><?php echo mensaje(5);?></div>
			
		</td></tr>
	</div>
</table>
</div>
</div>
</div>
</body>
</html>

