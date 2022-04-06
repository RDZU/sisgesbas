function ventanaEmergente(URL) {
window.open(URL, "_blank", 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=10000,height=10000,left = 30%,top = 50%');
}


function salir() {

    if ( confirm('¿Desea Cerrar Sesión?') )
        return true;
		
    else
        return false;

}

function confirmar() {

    if ( confirm('¿Desea Eliminar el Registro?') )
        return true;
		
    else
        return false;

}

function rezagar() {

    if ( confirm('¿Desea Rezagar al Usuario?') )
        return true;
		
    else
        return false;

}

function habilitar() {

    if ( confirm('¿Desea Habilitar la Permisología?') )
        return true;
    
    else
        return false;

}

function deshabilitar() {

    if ( confirm('¿Desea Deshabilitar la Permisología?') )
        return true;
    
    else
        return false;

}

