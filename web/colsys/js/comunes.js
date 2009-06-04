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

/*
* Funcion utilizada para editar un campo en una grilla
*/
function editarGrilla( fieldname){
		
	var field1 = document.getElementById(fieldname+"_div");		
	var field2 = document.getElementById(fieldname+"_div_hd");		
					
	field1.style.display = 'none';
	field2.style.display = 'inline';		
	//document.getElementById(fieldname).focus();
}

/*
* Funcion utilizada para actualizar un campo en una grilla
*/
function actualizarGrilla( fielname ){
	var field = document.getElementById(fielname);
	var div1 = document.getElementById( fielname+"_div");
	var div2 = document.getElementById( fielname+"_div_hd");
	if( field.value=="%25"){
		div1.innerHTML = "%";
	}else{	
		div1.innerHTML = field.value;
	}
	
	div2.style.display = 'none';
	div1.style.display = 'inline';	
}

/*
* Funcion utilizada para mostrar u ocultar elemento del documento
*/
function cambiarDisplay( id, display ){
	var element = document.getElementById( id );
	element.style.display = display;
}

function str_repeat(str, repeat) {
  var output = "";
  for (var i = 0; i < repeat; i++) {
    output += str;
  }
  return output;
}


function dump(theObj){
  if(theObj.constructor == Array ||
     theObj.constructor == Object){
    document.write("<ul>")
    for(var p in theObj){
      if(theObj[p].constructor == Array||
         theObj[p].constructor == Object){
        document.write("<ul>")
        showArray(theObj[p]);
        document.write("</ul>")
      } else {
        document.write("<li>"+p+": "+theObj[p]+"</li>");
      }
    }
    document.write("</ul>")
  }
}

/**
 * Format a number 
 * @param {Number/String} value The numeric value to format
 * @return {String} The formatted currency string
 */
function formatNumber(v){
	v = (Math.round((v-0)*100))/100;
	v = (v == Math.floor(v)) ? v + ".00" : ((v*10 == Math.floor(v*10)) ? v + "0" : v);
	v = String(v);
	var ps = v.split('.');
	var whole = ps[0];
	var sub = ps[1] ? '.'+ ps[1] : '.00';
	var r = /(\d+)(\d{3})/;
	while (r.test(whole)) {
		whole = whole.replace(r, '$1' + ',' + '$2');
	}
	v = whole + sub;
	if(v.charAt(0) == '-'){
		return '-' + v.substr(1);
	}
	return "" +  v;
}


function autoGrow( field ){
	var rows = field.value.split("\n").length;
	if(rows==0){
		rows=1;
	}
	field.rows=rows;		
}


var expandCollapse = function( obj , id, classname ){
	target = document.getElementById(id);
	
	//alert( target.style.display );
	if( target.style.display=="none" ){
		target.style.display="inline";		
		obj.className=classname+"_expanded";
	}else{
		target.style.display="none";		
		obj.className=classname+"_collapsed";
	}	
}