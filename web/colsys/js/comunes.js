
/*
 * Abre un popup.
 **/
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

function d_verificacion(nit) {
             ceros = '000000000000000';
             li_peso= new Array();
             li_peso[0] = 71;
             li_peso[1] = 67;
             li_peso[2] = 59;
             li_peso[3] = 53;
             li_peso[4] = 47;
             li_peso[5] = 43;
             li_peso[6] = 41;
             li_peso[7] = 37;
             li_peso[8] = 29;
             li_peso[9] = 23;
             li_peso[10] = 19;
             li_peso[11] = 17;
             li_peso[12] = 13;
             li_peso[13] = 7;
             li_peso[14] = 3;
             ls_str_nit = (ceros + nit).substring((ceros + nit).length - 15, (ceros + nit).length);
             li_suma = 0;
             for( i = 0; i < 15; i++ ){
                  li_suma += ls_str_nit.substring(i,i+1) * li_peso[i];
                }
             digito_chequeo = li_suma%11;
             if ( digito_chequeo >= 2 )
                  digito_chequeo = 11 - digito_chequeo;
             return digito_chequeo;
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


document.getElementsByClass = function(needle) {
 function acceptNode(node) {
   if (node.hasAttribute("class")) {
     var c = " " + node.className + " ";
      if (c.indexOf(" " + needle + " ") != -1)
        return NodeFilter.FILTER_ACCEPT;
   }
   return NodeFilter.FILTER_SKIP;
 }
 var treeWalker = document.createTreeWalker(document.documentElement,
     NodeFilter.SHOW_ELEMENT, acceptNode, true);
 var outArray = new Array();
 if (treeWalker) {
   var node = treeWalker.nextNode();
   while (node) {
     outArray.push(node);
     node = treeWalker.nextNode();
   }
 }
 return outArray;
}


/*
* Expande y colapsa un elemento de acuerdo a la clase que tenga
*/
var expandCollapseGroup = function( obj , id ){

    for( var i=0; i<10; i++ ){
        var target = document.getElementById(id+"_"+i);
       
        if( target && typeof(target)!="undefined" ){             
            if( target.style.display=="none" ){
                target.style.display="";
                obj.className="group_expanded";
            }else{
                target.style.display="none";
                obj.className="group_collapsed";
            }
        }
    }    
}



function actualizarContenido( id , url, params ){
    var content = document.getElementById( id );

    content.innerHTML = "<div id='indicator'></div>";
    Ext.Ajax.request({
        url: url,
        params: params,
        success: function(xhr) {
            content.innerHTML = xhr.responseText;

        },
        failure: function() {
            Ext.Msg.alert("Error", "Server communication failure");
        }
    });
}



function isMicrosoft(){
    return (navigator.appName.indexOf("Microsoft") > -1) && !(navigator.userAgent.indexOf("Opera") > -1);
}

function isSafari(){
    return (navigator.userAgent.indexOf("Safari") > 0);
}

/*
 * A�ade on evento a un objeto
 **/
function addListener( objElem, eventName, handler ){
    
    if (isMicrosoft())
    {
        if( eventName =="click" ){
            objElem.attachEvent("onclick", handler);
        }

        if( eventName =="dblclick" ){
            objElem.attachEvent("ondblclick", handler);
        }
    }
    else
    {
        objElem.addEventListener(eventName,handler, false);
        
    }
}


/*
 * Enlace dos combos HTML de tal manera que uno dependa del otro, p.e. Pais y Ciudad
 **/
function linkField( idLinkedFld, idDependantFld, includeBlank , defaultVal ){
    
}




/*
 *
 var ciudades = [];
 function llenarCiudades( idtraficoFld, idciudadFld, includeBlank , defaultVal){
    var idtrafico = document.getElementById(idtraficoFld).value;
    var fldCiudades = document.getElementById(idciudadFld);

    fldCiudades.length=0;
    if( typeof(includeBlank)!="undefined" && includeBlank ){
        fldCiudades[fldCiudades.length] = new Option('','',false,false);
    }



    if( ciudades.length == 0 ){

        Ext.Ajax.request(
            {
                waitMsg: '',
                url: '/widgets/datosCiudadesPaises',
                callback :function(options, success, response){
                    //alert( response.responseText );

                    var res = Ext.util.JSON.decode( response.responseText );
                    if(res.success){
                        ciudades = res.root;
                        var ciudadesTrafico = ciudades[idtrafico];
                        cargarTraficos( ciudadesTrafico, fldCiudades, defaultVal );
                    }
                }
             }
            );
     }else{
        var ciudadesTrafico = ciudades[idtrafico];
        cargarTraficos( ciudadesTrafico, fldCiudades, defaultVal );
     }

    if( typeof(llenarAgentes)!='undefined' ){
        llenarAgentes();
    }
}

function cargarTraficos( ciudadesTrafico, fldCiudades, defaultVal ){
    for( i in ciudadesTrafico ){
            if( defaultVal == ciudadesTrafico[i]['idciudad'] ){
                var selected = true;
            }else{
                var selected = false;
            }
            if( typeof(ciudadesTrafico[i]['idciudad'])!="undefined" ){
                fldCiudades[fldCiudades.length] = new Option(ciudadesTrafico[i]['ciudad'],ciudadesTrafico[i]['idciudad'],false,selected);
            }
        }

}


var modalidades = [];
function llenarModalidades( impoexpoFldId, transporteFldId, modalidadFldId, includeBlank , defaultVal ){
    var impoexpo = document.getElementById(impoexpoFldId).value;
    var transporte = document.getElementById(transporteFldId).value;
    var modalidadFld = document.getElementById(modalidadFldId);

    modalidadFld.length=0;
    if( typeof(includeBlank)!="undefined" && includeBlank ){
        modalidadFld[modalidadFld.length] = new Option('','',false,false);
    }


    if( modalidades.length == 0 ){

        Ext.Ajax.request(
            {
                waitMsg: '',
                url: '/widgets/datosModalidades',
                callback :function(options, success, response){
                    //alert( response.responseText );

                    var res = Ext.util.JSON.decode( response.responseText );
                    if(res.success){
                        modalidades = res.root;

                        cargarModalidades( modalidades, impoexpo, transporte, modalidadFld, defaultVal )
                    }
                }
             }
            );
     }else{
           cargarModalidades( modalidades, impoexpo, transporte, modalidadFld, defaultVal )
     }
}

function cargarModalidades( modalidades, impoexpo, transporte, modalidadFld, defaultVal ){
    for( i in modalidades ){
            if( typeof(modalidades[i]['modalidad'])!="undefined" ){

                if( impoexpo == modalidades[i]['impoexpo'] && transporte == modalidades[i]['transporte'] ){
                    if( defaultVal == modalidades[i]['modalidad'] ){
                        var selected = true;
                    }else{
                        var selected = false;
                    }
                    modalidadFld[modalidadFld.length] = new Option(modalidades[i]['modalidad'],modalidades[i]['idmodalidad'],false, selected);
                }
            }
        }
}



var lineas = [];
function llenarLineas( transporteFldId, lineaFldId, includeBlank , defaultVal ){

    var transporte = document.getElementById(transporteFldId).value;
    var lineaFld = document.getElementById(lineaFldId);

    lineaFld.length=0;
    if( typeof(includeBlank)!="undefined" && includeBlank ){
        lineaFld[lineaFld.length] = new Option('','',false,false);
    }


    if( lineas.length == 0 ){

        Ext.Ajax.request(
            {
                waitMsg: '',
                url: '/widgets/datosLineas',
                callback :function(options, success, response){
                    //alert( response.responseText );

                    var res = Ext.util.JSON.decode( response.responseText );
                    if(res.success){
                        lineas = res.root;
                        cargarDatosLineas( lineas, transporte, lineaFld, defaultVal);
                    }
                }
             }
            );
     }else{
        cargarDatosLineas( lineas, transporte,  lineaFld, defaultVal);
     }
}

function cargarDatosLineas( lineas , transporte,  lineaFld, defaultVal){
    for( i in lineas ){
        if( typeof(lineas[i]['transporte'])!="undefined" ){
            if( transporte == lineas[i]['transporte'] ){
                if( defaultVal == lineas[i]['idlinea'] ){
                    var selected = true;
                }else{
                    var selected = false;
                }
                lineaFld[lineaFld.length] = new Option(lineas[i]['linea'],lineas[i]['idlinea'],false, selected);
            }
        }
    }

}
 **/



/**
*
*  Base64 encode / decode
*  http://www.webtoolkit.info/
*
**/

var Base64 = {

	// private property
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

	// public method for encoding
	encode : function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;

		input = Base64._utf8_encode(input);

		while (i < input.length) {

			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);

			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;

			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}

			output = output +
			this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
			this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

		}

		return output;
	},

	// public method for decoding
	decode : function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;

		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

		while (i < input.length) {

			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));

			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;

			output = output + String.fromCharCode(chr1);

			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}

		}

		output = Base64._utf8_decode(output);

		return output;

	},

	// private method for UTF-8 encoding
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";

		for (var n = 0; n < string.length; n++) {

			var c = string.charCodeAt(n);

			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}

		}

		return utftext;
	},

	// private method for UTF-8 decoding
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;

		while ( i < utftext.length ) {

			c = utftext.charCodeAt(i);

			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}

		}

		return string;
	}

}