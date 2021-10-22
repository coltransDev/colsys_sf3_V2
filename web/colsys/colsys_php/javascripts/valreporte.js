function llenar_traficos(){
  document.adicionar.idtraorigen.length=0;
  document.adicionar.idtraorigen.options[document.adicionar.idtraorigen.length] = new Option();
  document.adicionar.idtraorigen.length=0;
  document.adicionar.idtradestino.length=0;
  document.adicionar.idtradestino.options[document.adicionar.idtradestino.length] = new Option();
  document.adicionar.idtradestino.length=0;
  if (document.adicionar.impoexpo.value == 'Importación'){
      for (cont=0; cont<idtraficos.length; cont++) {
           if (idtraficos[cont].value != 'CO-057')
               document.adicionar.idtraorigen[document.adicionar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);
           else
               document.adicionar.idtradestino[document.adicionar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);
      }
  }else if (document.adicionar.impoexpo.value == 'OTM/DTA'){
      for (cont=0; cont<idtraficos.length; cont++) {
           if (idtraficos[cont].value == 'CO-057'){
               document.adicionar.idtraorigen[document.adicionar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);
               document.adicionar.idtradestino[document.adicionar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);
           }
      }
  }else if (document.adicionar.impoexpo.value == 'Triangulación'){
      for (cont=0; cont<idtraficos.length; cont++) {
           if (idtraficos[cont].value != 'CO-057'){
               document.adicionar.idtraorigen[document.adicionar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);
               document.adicionar.idtradestino[document.adicionar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);
           }
      }
  }
  llenar_origenes();
  llenar_destinos();
  llenar_modalidades();
  llenar_continuaciones();
}

function elegir_traficos(origen, destino){
  document.adicionar.idtraorigen.length=0;
  document.adicionar.idtraorigen.options[document.adicionar.idtraorigen.length] = new Option();
  document.adicionar.idtraorigen.length=0;
  document.adicionar.idtradestino.length=0;
  document.adicionar.idtradestino.options[document.adicionar.idtradestino.length] = new Option();
  document.adicionar.idtradestino.length=0;
  for (cont=0; cont<idtraficos.length; cont++) {
	if (document.adicionar.impoexpo.value == 'Importación'){
	    seleccion = (idtraficos[cont].value == origen || idtraficos[cont].value == destino) ? true : false;
		if (idtraficos[cont].value != 'CO-057'){
			document.adicionar.idtraorigen[document.adicionar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,seleccion);
		}else{
			document.adicionar.idtradestino[document.adicionar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,seleccion);
		}
	}else if (document.adicionar.impoexpo.value == 'OTM/DTA'){
	    sel_one = (idtraficos[cont].value == origen) ? true : false;
	    sel_two = (idtraficos[cont].value == destino) ? true : false;
		if (idtraficos[cont].value == 'CO-057'){
			document.adicionar.idtraorigen[document.adicionar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,sel_one);
			document.adicionar.idtradestino[document.adicionar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,sel_two);
		}
	}else if (document.adicionar.impoexpo.value == 'Triangulación'){
	    sel_one = (idtraficos[cont].value == origen) ? true : false;
	    sel_two = (idtraficos[cont].value == destino) ? true : false;
		if (idtraficos[cont].value != 'CO-057'){
			document.adicionar.idtraorigen[document.adicionar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,sel_one);
			document.adicionar.idtradestino[document.adicionar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,sel_two);
		}
	}
  }
}

function llenar_origenes(){
  document.adicionar.idciuorigen.length=0;
  document.adicionar.idciuorigen.options[document.adicionar.idciuorigen.length] = new Option();
  document.adicionar.idciuorigen.length=0;
  if (isNaN(idciudades.length)){
      if (document.adicionar.idtraorigen.value == ciutraficos.value){
          document.adicionar.idciuorigen[document.adicionar.idciuorigen.length] = new Option(nomciudades.value,idciudades.value,false,false);
          }
     }
  else {
     for (cont=0; cont<idciudades.length; cont++) {
          if (document.adicionar.idtraorigen.value == ciutraficos[cont].value){
              document.adicionar.idciuorigen[document.adicionar.idciuorigen.length] = new Option(nomciudades[cont].value,idciudades[cont].value,false,false);
           }
       }
     }
  llenar_agentes();
}

function llenar_destinos(){
  document.adicionar.idciudestino.length=0;
  document.adicionar.idciudestino.options[document.adicionar.idciudestino.length] = new Option();
  document.adicionar.idciudestino.length=0;
  if (isNaN(idciudades.length)){
      if (document.adicionar.idtradestino.value == ciutraficos.value){
          document.adicionar.idciudestino[document.adicionar.idciudestino.length] = new Option(nomciudades.value,idciudades.value,false,false);
          }
     }
  else {
     for (cont=0; cont<idciudades.length; cont++) {
          if (document.adicionar.idtradestino.value == ciutraficos[cont].value){
              document.adicionar.idciudestino[document.adicionar.idciudestino.length] = new Option(nomciudades[cont].value,idciudades[cont].value,false,false);
           }
       }
     }
}

function llenar_finales(){
  if (adicionar.accion.value != 'Crear Reporte AG'){
	  document.adicionar.continuacion_dest.length=0;
	  document.adicionar.continuacion_dest.options[document.adicionar.continuacion_dest.length] = new Option();
	  document.adicionar.continuacion_dest.length=0;
	  if (isNaN(idciudades.length)){
		  if (document.adicionar.idtradestino.value == ciutraficos.value){
			  document.adicionar.continuacion_dest[document.adicionar.continuacion_dest.length] = new Option(nomciudades.value,idciudades.value,false,false);
			  }
		 }
	  else {
		 for (cont=0; cont<idciudades.length; cont++) {
			  if (document.adicionar.idtradestino.value == ciutraficos[cont].value){
				  document.adicionar.continuacion_dest[document.adicionar.continuacion_dest.length] = new Option(nomciudades[cont].value,idciudades[cont].value,false,false);
			   }
		   }
		 }
	  document.adicionar.continuacion_dest.selectedIndex=document.adicionar.idciudestino.selectedIndex
  }
}

function select_final(){
  if (adicionar.accion.value != 'Crear Reporte AG'){
	continuacion_dest.selectedIndex=idciudestino.selectedIndex
  }
}

function elegir_puertos(origen, destino){
  document.adicionar.idciuorigen.length=0;
  document.adicionar.idciuorigen.options[document.adicionar.idciuorigen.length] = new Option();
  document.adicionar.idciuorigen.length=0;
  document.adicionar.idciudestino.length=0;
  document.adicionar.idciudestino.options[document.adicionar.idciudestino.length] = new Option();
  document.adicionar.idciudestino.length=0;
  for (cont=0; cont<idciudades.length; cont++) {
       if (document.adicionar.idtraorigen.value == ciutraficos[cont].value){
           seleccion = (idciudades[cont].value == origen) ? true : false;
           document.adicionar.idciuorigen[document.adicionar.idciuorigen.length] = new Option(nomciudades[cont].value,idciudades[cont].value,false,seleccion);
        }
    }
  for (cont=0; cont<idciudades.length; cont++) {
       if (document.adicionar.idtradestino.value == ciutraficos[cont].value){
           seleccion = (idciudades[cont].value == destino) ? true : false;
           document.adicionar.idciudestino[document.adicionar.idciudestino.length] = new Option(nomciudades[cont].value,idciudades[cont].value,false,seleccion);
        }
    }
}

function llenar_agentes(){
  document.adicionar.idagente.length=0;
  document.adicionar.idagente.options[document.adicionar.idagente.length] = new Option();
  document.adicionar.idagente.length=0;
  if (isNaN(idagentes.length)){
      if (document.adicionar.idtraorigen.value == idtraficoags.value || document.adicionar.todos_ag.checked){
          document.adicionar.idagente[document.adicionar.idagente.length] = new Option(agentes.value,idagentes.value,false,false);
          }
     }
  else {
     for (cont=0; cont<idagentes.length; cont++) {
          if (document.adicionar.idtraorigen.value == idtraficoags[cont].value || document.adicionar.todos_ag.checked){
              document.adicionar.idagente[document.adicionar.idagente.length] = new Option(agentes[cont].value,idagentes[cont].value,false,false);
           }
       }
     }
}

function llenar_continuaciones(){
  if (adicionar.accion.value != 'Crear Reporte AG'){
	  document.adicionar.continuacion.length=0;
	  document.adicionar.continuacion.options[document.adicionar.continuacion.length] = new Option();
	  document.adicionar.continuacion.length=0;
	  if (document.adicionar.transporte.value=='Aéreo'){
		  document.adicionar.continuacion[document.adicionar.continuacion.length] = new Option('N/A','N/A',false,false);
		  document.adicionar.continuacion[document.adicionar.continuacion.length] = new Option('CABOTAJE','CABOTAJE',false,false);
		 }
	  else if (document.adicionar.transporte.value=='Marítimo' || document.adicionar.transporte.value=='Terrestre'){
		  document.adicionar.continuacion[document.adicionar.continuacion.length] = new Option('N/A','N/A',false,false);
		  document.adicionar.continuacion[document.adicionar.continuacion.length] = new Option('OTM','OTM',false,false);
		  document.adicionar.continuacion[document.adicionar.continuacion.length] = new Option('DTA','DTA',false,false);
		 }
	  llenar_finales();
  }
}

function llenar_modalidades(){
  document.adicionar.modalidad.length=0;
  document.adicionar.modalidad.options[document.adicionar.modalidad.length] = new Option();
  document.adicionar.modalidad.length=0;
  if (document.adicionar.transporte.value=='Aéreo'){
	  document.adicionar.modalidad[document.adicionar.modalidad.length] = new Option('CONSOLIDADO','CONSOLIDADO',false,false);
	 }
  else if (document.adicionar.transporte.value=='Marítimo'){
	  if (adicionar.accion.value == 'Crear Reporte AG'){
		 document.adicionar.modalidad[document.adicionar.modalidad.length] = new Option('','',false,false); 
	  }
	  document.adicionar.modalidad[document.adicionar.modalidad.length] = new Option('LCL','LCL',false,false);
	  document.adicionar.modalidad[document.adicionar.modalidad.length] = new Option('FCL','FCL',false,false);
	  document.adicionar.modalidad[document.adicionar.modalidad.length] = new Option('COLOADING','COLOADING',false,false);
	  document.adicionar.modalidad[document.adicionar.modalidad.length] = new Option('PROYECTOS','PROYECTOS',false,false);
	  document.adicionar.modalidad[document.adicionar.modalidad.length] = new Option('PARTICULARES','PARTICULARES',false,false);
	 }
  else if (document.adicionar.transporte.value=='Terrestre'){
	  document.adicionar.modalidad[document.adicionar.modalidad.length] = new Option('LCL','LCL',false,false);
	  document.adicionar.modalidad[document.adicionar.modalidad.length] = new Option('FCL','FCL',false,false);
	 }
  if (adicionar.accion.value != 'Crear Reporte AG'){
	  llenar_lineas();
	  llenar_tipos();
  }
}

function llenar_lineas(){
  document.adicionar.idlinea.length=0;
  document.adicionar.idlinea.options[document.adicionar.idlinea.length] = new Option();
  document.adicionar.idlinea.length=0;
  if (document.adicionar.modalidad.value!='LCL'){
    for (cont=0; cont<aidlinea.length; cont++) {
        if (document.adicionar.transporte.value == atransporte[cont].value){
            document.adicionar.idlinea[document.adicionar.idlinea.length] = new Option(anombre[cont].value,aidlinea[cont].value,false,false);
            }
        }
     }
  else{
     document.adicionar.idlinea[document.adicionar.idlinea.length] = new Option('NO APLICA            ','0',false,false);
     }
}

function llenar_tipos(){
  document.adicionar.tipo.length=0;
  document.adicionar.tipo.options[document.adicionar.tipo.length] = new Option();
  document.adicionar.tipo.length=0;
  atipos = new Array();
  tip_mem='';
  for (cont=0; cont<aidbodega.length; cont++) {
       if (atipo[cont].value!=tip_mem && atranspor[cont].value.indexOf(document.adicionar.transporte.value)!= -1 && ("|"+atipos.join("|")).indexOf("|"+atipo[cont].value) == -1){
           document.adicionar.tipo[document.adicionar.tipo.length] = new Option(atipo[cont].value,atipo[cont].value,false,false);
           atipos.push(atipo[cont].value);
           tip_mem=atipo[cont].value;
          }
     }
  llenar_consignar();
  llenar_bodegas();
}

function llenar_consignar(){
  document.adicionar.idconsignar.length=0;
  document.adicionar.idconsignar.options[document.adicionar.idconsignar.length] = new Option();
  document.adicionar.idconsignar.length=0;
  for (cont=0; cont<aidconsigna.length; cont++) {
      if (document.adicionar.transporte.value=='Aéreo'){
          if (aclase[cont].value == 'Coordinador Logístico')
              document.adicionar.idconsignar[document.adicionar.idconsignar.length] = new Option(aconsigna[cont].value,aidconsigna[cont].value,false,false);
      }else{
          document.adicionar.idconsignar[document.adicionar.idconsignar.length] = new Option(aconsigna[cont].value,aidconsigna[cont].value,false,false);
      }
  }
}

function llenar_bodegas(){
  document.adicionar.idbodega.length=0;
  document.adicionar.idbodega.options[document.adicionar.idbodega.length] = new Option();
  document.adicionar.idbodega.length=0;
  for (cont=0; cont<aidbodega.length; cont++) {
       if (atipo[cont].value==document.adicionar.tipo.value && atranspor[cont].value.indexOf(document.adicionar.transporte.value)!= -1){
           document.adicionar.idbodega[document.adicionar.idbodega.length] = new Option(abodega[cont].value,aidbodega[cont].value,false,false);
          }
     }
}

function is_prepay(){
	element = document.adicionar.incoterms_pro_1.value.substr(0,3);
	if (element!= '' && (element=='CIF' || element=='CIP' || element=='CPT' || element=='CFR')){
			document.getElementById('modalidad').disabled = false;
		}else{
			document.getElementById('modalidad').disabled = true;
			}
}

function existe(){
  p0 = document.getElementById('fchreporte').value;
  p1 = document.getElementById('idciuorigen').value;
  p2 = document.getElementById('idciudestino').value;
  p3 = document.getElementById('idagente').value;
  p4 = document.getElementById('id_pro_1').value;
  p5 = document.getElementById('idconcliente').value;
  p6 = document.getElementById('transporte').value;
  frame = document.getElementById('find_texts_frame');
  frame.src='ventanas.php?opcion=Existe_reporte&p0='+p0+'&p1='+p1+'&p2='+p2+'&p3='+p3+'&p4='+p4+'&p5='+p5+'&p6='+p6;
}

function validador(){
    return (eval(document.adicionar.validado.value));
}

function validar(element){
  if (element.value == "Borrador")
      document.adicionar.validado.value = 'true';
  else if (isNaN(document.getElementById('nw')) && (element.value == 'Nueva Versión' || element.value == 'Reporte Nuevo')){
	  alert('Ha realizado una importación sobre un reporte existente, por tanto debe pulsar el botón \"Guardar Modificación\"');
      document.adicionar.validado.value = 'false';}
  else if (document.adicionar.idciuorigen.value == '')
      alert('Seleccione la Ciudad de Origen');
  else if (document.adicionar.idciudestino.value == '')
      alert('Seleccione la Ciudad de Destino');
  else if (!chkDate(document.adicionar.fchdespacho))
      document.adicionar.fchdespacho.focus;
  else if (document.adicionar.mercancia_desc.value == '')
      alert('Suministre una breve descripción de la Mercancia');
  else if (document.adicionar.idconcliente.value == '')
      alert('Debe específicar el Cliente');
  else if (document.adicionar.orden_clie.value == '')
      alert('Ingrese el Número de Orden del Cliente');
  else if (document.adicionar.login.value == '')
      alert('Seleccione un Representante Comercial');
  else if (adicionar.accion.value == 'Crear Reporte AG'){
	  document.adicionar.status.value = confirm('¿Desea ir a la página para el envio de status para este reporte?');
	  if (document.getElementById('id_pro_1').value.length != 0 && document.getElementById('orden_pro_1').value.length != 0){
      	document.adicionar.validado.value = 'true';
	  }else{
		alert('Datos del Proveedor de Cliente Incompletos');
		document.adicionar.validado.value = 'false'; }
	  }
  else if (document.adicionar.idcotizacion.value == '')
      alert('Ingrese el Número de Cotización');
  else if (document.adicionar.tiempocredito.value == '')
      alert('Debe Especificar el tiempo de Crédito');
  else if (document.adicionar.continuacion.value != 'N/A' && document.adicionar.idciudestino.selectedIndex == document.adicionar.continuacion_dest.selectedIndex)
      alert('Error en la definición del Destino Final cuando hay continuación de viaje.');
  else{
      ischeck_colmas = false;
	  for (cont=0; cont<adicionar.elements.length; cont++){
		  if (adicionar.elements[cont].name == 'colmas'){
			  if (adicionar.elements[cont].checked){
				  ischeck_colmas = true;
				  }
			  }
          }
      if (!ischeck_colmas){
		  document.adicionar.validado.value = 'false';
		  alert('Debe responder si aplica Colmas Si/No');
		  return;
      }

      ischeck_seguro = false;
	  for (cont=0; cont<adicionar.elements.length; cont++){
		  if (adicionar.elements[cont].name == 'seguro'){
			  if (adicionar.elements[cont].checked){
				  ischeck_seguro = true;
				  }
			  }
          }
      if (!ischeck_seguro){
		  document.adicionar.validado.value = 'false';
		  alert('Debe responder si aplica Seguro Si/No');
		  return;
      }

      if (ischeck_colmas && ischeck_seguro){
		  i = 1;
		  any = false;
		  ord = false;
		  while (isNaN(document.getElementById('id_pro_'+i))) {
			  objeto_1 = document.getElementById('id_pro_'+i);
			  objeto_2 = document.getElementById('orden_pro_'+i);
			  objeto_3 = document.getElementById('incoterms_pro_'+i);
			  if (objeto_1.value.length != 0) {
				  any = true;
				  if (objeto_2.value.length != 0 && objeto_3.value.length != 0)
					  ord = true;
				  else
					  ord = false;
				 }
			 i++;
		   }
		   if (!any || !ord){
			   document.adicionar.validado.value = 'false';
			   alert('Datos del Proveedor de Cliente Incompletos');
		   }else{
			   document.adicionar.validado.value = 'true';
			   document.getElementById('login').disabled = false;
			   document.getElementById('si').disabled = false;
			   document.getElementById('no').disabled = false;
			   document.getElementById('tiempocredito').disabled = false;
		   }
      }
  }
}


function uno(src,color_entrada) {
    src.style.background=color_entrada;src.style.cursor='hand'
}

function dos(src,color_default) {
    src.style.background=color_default;src.style.cursor='default';
}

function terceros(ventana, sufijo, target){
  document.body.scroll='no';
  frame = document.getElementById(ventana + '_frame');
  frame.style.height = document.body.clientHeight-16;
  ventana = document.getElementById(ventana);
  ventana.style.visibility = 'visible';
  ancho = frame.getAttribute('STYLE').width.substring( 0, frame.getAttribute('STYLE').width.indexOf('px') );
  alto  = frame.getAttribute('STYLE').height.substring( 0, frame.getAttribute('STYLE').height.indexOf('px') );
  ventana.style.left = eval((document.body.clientWidth/2)-(ancho/2));
  frame.src=target+'.php?suf='+sufijo;
}

function llenar_item(target, content) {
  if (isNaN(document.getElementById(target))){
     elemento = document.getElementById(target);
  }else{
     for (var i=0; i < document.adicionar.elements.length; i++) {
         if (elemento.form.elements[i].name == target+"[]"){
            j=0;
            while (document.adicionar.elements[i].name == target+"[]") {
                  document.adicionar.elements[i].value = (isNaN(content[j]))?content[j]:" ";
                  j++;
                  i++; }
            }
         }
     return;
  }
  if (elemento.type == 'text' || elemento.type == 'hidden'){
     elemento.value = content;
  }else if (elemento.type == 'select-one'){
     elegir_item(target, content);
     if (target == 'idtraorigen'){
        llenar_origenes();}
     else if (target == 'idtradestino'){
        llenar_destinos();}
     else if (target == 'transporte'){
        llenar_modalidades();
        llenar_continuaciones();}
     else if (target == 'modalidad'){
        llenar_lineas();}
  }else if (elemento.type == 'radio'){
     for (var i=0; i < elemento.form.elements.length; i++) {
        if (elemento.form.elements[i].name == target){
            while (elemento.form.elements[i].name == target) {
                elemento.form.elements[i].checked = (elemento.form.elements[i].value == content)?true:false;
                i++; }
            break;
            }
        }
  }
}

function llenar_conf(confirmar) {
  i = 0;
  emails = confirmar.split(',');
  while (isNaN(document.getElementById('conf_'+i))) {
    element = document.getElementById('conf_'+i);
    if (typeof emails[i] != "undefined" && emails[i].length > 1){
        element.value = emails[i];
        document.getElementById('email_'+i).value = emails[i];
    }else{
        element.value = ' ';
    }
    i++;
    }
}

function asignar_email(campo){
  cadena = campo.getAttribute('ID');
  indice = cadena.substring(cadena.indexOf('_') + 1, cadena.length);
  objeto = document.getElementById('conf_' + indice);
  if(campo.checked && objeto.value.length > 1) {
     campo.value = objeto.value; }
  else {
     campo.value = '' };
}

function cambiar_email(campo){
  cadena = campo.getAttribute('ID');
  indice = cadena.substring(cadena.indexOf('_') + 1, cadena.length);
  objeto = document.getElementById('email_' + indice);
  objeto.value = campo.value;
}

function valores(elemento) {
  if (isNaN(parseFloat(elemento.value)) || elemento.value.indexOf(',')!=-1){
      alert('No es un valor número correcto para el campo. Favor intente nuevamente sin utilizar letras ni comas, sólo un punto para separar decimales.');
      elemento.focus();
  }else{
      elemento.value = parseFloat(elemento.value);
  }
}

function extender(elemento) {
  cadena = elemento.getAttribute('ID');
  subtable = document.getElementById(cadena.substring(0, cadena.indexOf('_') + 1) + "tbl");
  if (subtable.style.display == "block"){
	  subtable.style.display = "none";
  } else {
	  subtable.style.display = "block";
  }
}

function clean_subform(campo){
  cadena = campo.getAttribute('ID');
  indice = cadena.substring(cadena.indexOf('_') + 1, cadena.length);
  objeto = document.getElementById('id_' + indice);
  objeto.value = '';
  objeto = document.getElementById('nombre_' + indice);
  objeto.value = '';
  objeto = document.getElementById('contacto_' + indice);
  objeto.value = '';
  objeto = document.getElementById('direccion_' + indice);
  objeto.value = '';
  objeto = document.getElementById('telefonos_' + indice);
  objeto.value = '';
  objeto = document.getElementById('fax_' + indice);
  objeto.value = '';
  objeto = document.getElementById('email_' + indice);
  objeto.value = '';
  if (indice.substr(0,4) == 'pro_'){
     objeto = document.getElementById('orden_' + indice);
     objeto.value = '';
     objeto = document.getElementById('incoterms_' + indice);
	 elegir_item(objeto.id, '');
  }if (indice.substr(0,3) == 'con'){
     objeto = document.getElementById('orden_' + indice + 's');
     objeto.value = '';
  }
}
