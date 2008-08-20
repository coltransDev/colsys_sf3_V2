//Funcion que hace visible la pagina de busqueda de clientes
function cuadro_busqueda( url ){
	var findcliente = document.getElementById('cuadroBusqueda');
	var cuadroBusquedaClienteFrame = document.getElementById('frameBusqueda');	
	cuadroBusquedaClienteFrame.src = url; 	
    findcliente.style.display = 'inline';
    findcliente.style.left = eval((document.body.clientWidth/2)-(600/2));
    //findcliente.style.top = document.body.clientHeight-180;	
}




//
function seleccion( formName ,idcliente, cliente, vendedor, coordinador, papellido, sapellido, nombre, email, preferencias) {
 
	
	switch( formName ){
		case "expoReporteFormcliente":				
			window.parent.document.expoReporteForm.idcliente.value=idcliente;
			window.parent.document.expoReporteForm.cliente.value=cliente; 
			window.parent.document.expoReporteForm.vendedor.value=vendedor;
			window.parent.document.expoReporteForm.preferencias_clie.value=preferencias;
			
			window.parent.document.expoReporteForm.cliente.focus();
			break;
		case "expoReporteFormconsignatario":				
			window.parent.document.expoReporteForm.idconsignatario.value=idcliente;			
			window.parent.document.expoReporteForm.nombreconsignatario.value=cliente;			
			
			window.parent.document.expoReporteForm.nombreconsignatario.focus();
			break;
	}
    window.parent.frames.cuadroBusqueda.style.display = 'none';
}


//Funcion que hace visible la pagina de busqueda de clientes
function cuadro_seleccion( url ){
	var cuadroSeleccion = document.getElementById('cuadroSeleccion');
	var cuadroSeleccionFrame = document.getElementById('cuadroSeleccionFrame');
    cuadroSeleccion.style.display = 'inline';
    cuadroSeleccionFrame.src = url; 
	
	cuadroSeleccion.style.left = eval((document.body.clientWidth/2)-(800/2));
	
    cuadroSeleccion.style.top = document.body.clientHeight-250;
	
	
}


function seleccionCotizacion(formName, idCotizacion, idproducto ){
	switch( formName ){
		case "expoReporteForm":		
		window.parent.document.expoReporteForm.id_producto.value=idproducto;
		window.parent.document.expoReporteForm.id_cotizacion.value=idCotizacion;
			//;
			//window.parent.document.expoReporteForm.cliente.value=cliente; 
			//window.parent.document.expoReporteForm.vendedor.value=vendedor;
			//window.parent.document.expoReporteForm.preferencias_clie.value=preferencias;
			
			window.parent.document.expoReporteForm.cliente.focus();
			break;
	}
	 window.parent.frames.cuadroBusqueda.style.display = 'none';
}




function popup(url, width, height){
	
	var mine = window.open (url, "mywindow","menubar=0,location=0,resizable=1,status=1,scrollbars=1, width="+width+",height="+height);	
	
	if(mine){
		var popUpsBlocked = false;
	}
	else{
		var popUpsBlocked = true;
	}
	
	
	if(popUpsBlocked){
		alert('Usted tiene bloqueador de popups, consulte al administrador del sistema para continuar');
	}
	return popUpsBlocked;	
}
