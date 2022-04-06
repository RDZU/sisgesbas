<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<title>Aplicaciones de PDVSA</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="_css/main-aplicacion.css" rel="stylesheet" type="text/css">
<style type="text/css">
.style1 {color: #666666}
.style2 {color: #000000}
</style>
<script LANGUAGE='JavaScript'>
function idp(forma)
{		
	forma.action="idp.jsp";	
	capaEsperaShow();	 
    forma.submit();		
    (true);

}
function idp_dist(forma)
{		
	
	forma.action="idp_dist.jsp";	
	capaEsperaShow();	 
    forma.submit();		
	(true);

}
function idp_segr(forma)
{		
	forma.action="idp_segr.jsp";	
	capaEsperaShow();	 
    forma.submit();		
	(true);

}
function catc_term(forma)
{		
	
	forma.action="patio_term.jsp";	
	capaEsperaShow();	 
    forma.submit();		
	(true);

}
function graficas(forma)
{		
	
	forma.action="seleccionar_grafico.jsp";	
	capaEsperaShow();
    forma.submit();		
	(true);

}
function pano_merey(forma)
{		
	
	forma.action="panoramica_merey.jsp";	
	capaEsperaShow(); 
    forma.submit();		
	(true);

}
function pano_anacowax(forma)
{		
	
	forma.action="panoramica_anaco.jsp";	
	capaEsperaShow(); 
    forma.submit();		
	(true);

}
function pano_sb(forma)
{		
	
	 forma.action="panoramica_sb.jsp";	
	 capaEsperaShow();
     forma.submit();		
	(true);

}
function pano_mesa(forma)
{		
	 forma.action="panoramica_mesa.jsp";	
	 capaEsperaShow();
     forma.submit();		
	 (true);

}
function salir(forma)
{		
	forma.action="index.jsp";	
	capaEsperaShow();
    forma.submit();		
	(true);

}
function inicial() {
	color_scrollbar();
}
 
</script>
<!-- ==================================== Para la capa de espera -->
	<SCRIPT language="JavaScript" src="../plantilla/scripts/src/dynapi.js"></SCRIPT>
	<SCRIPT language="Javascript">
		dynapi.library.setPath('scripts/src/');
		dynapi.library.include('dynapi.api');
		dynapi.library.include('dynapi.library');
		dynapi.library.include('dynapi.util.FileReader');
		dynapi.library.include('DynLayerInline');
	</SCRIPT>
	<SCRIPT language="JavaScript" src="../plantilla/scripts/capaEspera.js"></SCRIPT>
	<SCRIPT language="Javascript">
		dynapi.document.insertAllChildren();
	</SCRIPT>
<!-- ==================================== Fin Para la capa de espera -->
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="780" border="0" cellspacing="0" cellpadding="0">
<div class="Contenedor" id="Main-externo">
  <tr> 
    <td colspan="3">
	 <div class="Contenedor" id="Main-header">
            <span class="Contenedor-con-Imagen" id="Main-Logo"></span>
			<div class="Contenedor" id="Contenedor-Degradado">
			    <div class="Contenedor-con-Imagen" id="Logo-Continuacion">
			    	<span class="Contenedor" id="Nombre-Aplicacion">Informe Diario de Producci&oacute;n </span>
				</div>
				<div class="Contenedor-con-Imagen" id="Logo-Final">
				</div>
			</div>
     </div>
	</td>
</tr>
<tr>
<td colspan="3">
<div class="Contenedor-con-sombra" id="Main-BackCuerpoRight">
            <div class="Contenedor-con-sombra" id="Main-BackCuerpoLeft"> 
                <div class="Contenedor" id="Main-Cuerpo">
                    <div class="Contenedor-con-Bordes" id="Main-Identificador_usuario"></div>
                    <div class="Contenedor" id="Main-breadcrumbs">
                       <div id="Main-Traza">
				         <div id="Main-Traza-aux">
				          </div>
				       </div>
	                   <div class="EsquinasBread" id="EsquinaBreadDerecha">
			           </div>
					</div>   
	                  <div class="Contenedor-Editable-Fondo" id="Vista">
					     <div class="Contenedor-Editable" id="Menu">
						 <form name="forma">
						    <a href="JavaScript:idp(window.document.forma);" class="Contenedor-Texto-Menu"><span class="Text-menu" > IDP</span></a>
						    <a href="JavaScript:idp_dist(window.document.forma);" class="Contenedor-Texto-Menu"><span class="Text-menu" > IDP por Distrito</span></a>
							<a href="JavaScript:idp_segr(window.document.forma);" class="Contenedor-Texto-Menu"><span class="Text-menu" > IDP por Segregación </span></a>
							<a href="JavaScript:catc_term(window.document.forma);" class="Contenedor-Texto-Menu"><span class="Text-menu" > CATC y Terminales</span></a>
							<a href="JavaScript:graficas(window.document.forma);" class="Contenedor-Texto-Menu"><span class="Text-menu" > Gráficas</span></a>
		                	<span class="PuntoHo_Cortico"></span>
							<a class="Contenedor-Texto-Menu"><span class="Text-menu" > Panorámicas </span></a>
							<span class="PuntoHo_Cortico"></span>
							<a class="Contenedor-Texto-Menu"><span class="Text-menu" > División Faja </span></a>
							<a href="JavaScript:pano_merey(window.document.forma);" class="Contenedor-Texto-sub-Menu" ><span class="Text-menu">  Merey </span></a>
							<a class="Contenedor-Texto-Menu"><span class="Text-menu" > División Oriente</span></a>
							<a  href="../paginas/usuario.php" class="Contenedor-Texto-sub-Menu" ><span class="Text-menu"> Anaco Wax </span></a>
							<a href="JavaScript:pano_sb(window.document.forma);" class="Contenedor-Texto-sub-Menu" ><span class="Text-menu"> Santa Bárbara </span></a>
						    <a href="JavaScript:pano_mesa(window.document.forma);" class="Contenedor-Texto-sub-Menu" ><span class="Text-menu"> Mesa </span></a>
						    </form>	
							<span class="PuntoHo_Cortico"></span>
							<a href="JavaScript:salir(window.document.forma);" class="Contenedor-Texto-Menu"><span class="Text-menu" > Cerrar Sesión</span></a>
						 </div>     
                     </div>			  
			          <!--  <DIV ID='CapaFlash'> 
                          <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                           codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
                            WIDTH="500" HEIGHT="400" id="inicio_idp" ALIGN="">
                            <PARAM NAME=movie VALUE="flash/inicio_idp.swf">
                            <PARAM NAME=quality VALUE=high>
                           <PARAM NAME=bgcolor VALUE=#FFFFFF>
                           <EMBED src="flash/inicio_idp.swf" quality=high bgcolor=#FFFFFF  WIDTH="500" HEIGHT="400" NAME=                           "inicio_idp" ALIGN=""
                           TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED> 
                           </OBJECT>
                        </DIV>-->	

						 <DIV> 
                          	<table width="416" border="0" align="center" cellpadding="0" cellspacing="0">
				              <tr> 
				                <td><img src="../plantilla/imag/fotos_varias_1.jpg" width="216" height="200"></td>
				                <td><img src="../plantilla/imag/fotos_varias_2.jpg" width="200" height="200"></td>
				              </tr>
				              <tr> 
				                <td><img src="../plantilla/imag/fotos_varias_3.jpg" width="216" height="131"></td>
				                <td><img src="../plantilla/imag/fotos_varias_4.jpg" width="200" height="131"></td>
				              </tr>
				            </table>
                        </DIV>	
                         
			    </div>			
	          </div>
	        </div>
		<div class="Contenedor-con-Bordes style3 style1" id="Main-Contenedor-footer"> 
            &copy;PDVSA 2003 - &Uacute;ltima actualizaci&oacute;n Abril de 2008 </div>
</td>		
</tr>
  
 </div>
</table>
 
</body>
</html>
