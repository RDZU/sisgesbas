function Buscador(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function Buscarto() {
	var BASE_PATH='/covi';
	var Texto = document.getElementById('id_usuario').value;
	var Resultados = document.getElementById('resultados');
	ajax = Buscador();
	ajax.open("GET",BASE_PATH+"/index.php/cusuario/valida_usuario?q="+Texto);
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			Resultados.innerHTML = ajax.responseText;
		}
	}
	ajax.send(null)

}

function Buscar() {
	var Texto = document.getElementById('id_usuario').value;
	var Resultados = document.getElementById('resultados');
	ajax = Buscador();
	alert(texto);
	ajax.open("GET","ajax_config.php?q="+Texto);
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			Resultados.innerHTML = ajax.responseText;
		}
	}
	ajax.send(null)

}

function Buscar1() {
	var Texto = document.getElementById('id_usuario2').value;
	var Resultados = document.getElementById('resultados');
	ajax = Buscador();
	ajax.open("GET","/sav/index.php/cajax_config/?r="+Texto);
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			Resultados.innerHTML = ajax.responseText;
		}
	}
	ajax.send(null)

}

function Buscar2() {
	var Texto = document.getElementById('usuario').value;
	var Resultados = document.getElementById('resultados');
	ajax = Buscador();
	ajax.open("GET","ajax_config.php?w="+Texto);
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			Resultados.innerHTML = ajax.responseText;
		}
	}
	ajax.send(null)

}

