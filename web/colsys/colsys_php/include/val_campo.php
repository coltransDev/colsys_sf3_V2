<?
             echo"<script language='JavaScript' type='text/JavaScript'>";
             echo"function confirmar(){";
             echo"   return (validar(adicionar.nombreint) && validar(adicionar.enteros) && validar(adicionar.decimales) && validar(adicionar.longitud))?true:confirm('?Datos incorrectos o por definir...! ?desea cotinuar?');";
             echo"  };";
             echo"function validar(campo){";
             echo"  if (campo.name == 'nombreint') {";
             echo"     if (campo.value.length==0){";
             echo"        alert('El campo Nombre Interno no puede ser blanco');";
             echo"        campo.focus();";
             echo"        return false; }";
             echo"     else ";
             echo"        return true; }";
             echo"  else if (campo.name == 'enteros') {";
             echo"     if (document.adicionar.tipo.value == 'Num?rico' && campo.selectedIndex==0){";
             echo"        alert('Seleccione el n?mero de posiciones enteras que va a manejar este campo');";
             echo"        campo.focus();";
             echo"        return false; }";
             echo"     else if (document.adicionar.tipo.value == 'Fecha' && campo.selectedIndex==0){";
             echo"        alert('Seleccione el formato de fecha que va a manejar este campo y el correspondiente separador');";
             echo"        campo.focus();";
             echo"        return false; }";
             echo"     else ";
             echo"        return true; }";
             echo"  else if (campo.name == 'decimales') {";
             echo"     if (document.adicionar.tipo.value == 'Fecha' && document.adicionar.enteros.selectedIndex!=0 && campo.selectedIndex==0){";
             echo"        alert('Seleccione un caracter de separaraci?n para el formato fecha');";
             echo"        campo.focus();";
             echo"        return false; }";
             echo"     else ";
             echo"        return true; }";
             echo"  else if (campo.name == 'longitud') {";
             echo"     if (document.adicionar.tipo.value == 'Caracter' && (campo.value==0 || isNaN(campo.value))){";
             echo"        alert('?El valor de Longitud para datos de tipo Caracter no es v?lido!');";
             echo"        campo.select();";
             echo"        campo.focus();";
             echo"        return false; }";
             echo"     else ";
             echo"        return true; }";
             echo" };";
             echo"function llenar(tipo, enteros, decimales){";
             echo"  var formfecha = new Array(6);";
             echo"  var separador = new Array(3);";
             echo"  if (tipo.value == 'Num?rico') {";
             echo"      enteros.length=0;";
             echo"      enteros.options[enteros.length] = new Option('Cifras Enteras','',false,false);";
             echo"      decimales.length=0;";
             echo"      decimales.options[decimales.length] = new Option('Cifras Decimales','',false,false);";
             echo"      for (i=0; i<20; i++) {";
             echo"        enteros.options[enteros.length] = new Option(i+1,i+1,false,false);";
             echo"        if (i <= 5)";
             echo"            decimales.options[decimales.length] = new Option(i,i,false,false);";
             echo"        }";
             echo"      document.adicionar.longitud.value='';";
             echo"      enteros.focus();}";
             echo"  else if (tipo.value == 'Caracter') {";
             echo"      enteros.length=0;";
             echo"      enteros.options[enteros.length] = new Option('Ingrese la longitud de campo','',false,false);";
             echo"      decimales.length=0;";
             echo"      decimales.options[decimales.length] = new Option('en el siguiente rengl?n','',false,false);";
             echo"      document.adicionar.longitud.value=0;";
             echo"      document.adicionar.longitud.focus();";
             echo"      document.adicionar.longitud.select();}";
             echo"  else if (tipo.value == 'Fecha') {";
             echo"      enteros.length=0;";
             echo"      enteros.options[enteros.length] = new Option('Formato','',false,false);";
             echo"      decimales.length=0;";
             echo"      decimales.options[decimales.length] = new Option('Separador','',false,false);";
             echo"      formfecha[0] = 'dd mm yy';";
             echo"      formfecha[1] = 'yy mm dd';";
             echo"      formfecha[2] = 'mm dd yy';";
             echo"      formfecha[3] = 'dd mm yyyy';";
             echo"      formfecha[4] = 'yyyy mm dd';";
             echo"      formfecha[5] = 'mm dd yyyy';";
             echo"      separador[0] = '-';";
             echo"      separador[1] = '/';";
             echo"      separador[2] = '.';";
             echo"      for (i=0; i<formfecha.length; i++) {";
             echo"        enteros.options[enteros.length] = new Option(formfecha[i],formfecha[i],false,false);";
             echo"        if (i < 3)";
             echo"            decimales.options[decimales.length] = new Option(separador[i],separador[i],false,false);";
             echo"        }";
             echo"      document.adicionar.longitud.value='';";
             echo"      enteros.focus();}";
             echo"  else if (tipo.value == 'Hora') {";
             echo"      enteros.length=0;";
             echo"      enteros.options[enteros.length] = new Option('hh:mm:ss','hh:mm:ss',false,false);";
             echo"      enteros.options[enteros.length] = new Option('hh:mm','hh:mm',false,false);";
             echo"      enteros.options[enteros.length] = new Option('hh','hh',false,false);";
             echo"      decimales.length=0;";
             echo"      decimales.options[decimales.length] = new Option('12 horas','12 horas',false,false);";
             echo"      decimales.options[decimales.length] = new Option('24 horas','24 horas',false,false);";
             echo"      document.adicionar.longitud.value='';";
             echo"      enteros.focus();}";
             echo"  else {";
             echo"      document.adicionar.longitud.value='';";
             echo"      enteros.length=0;";                                  //Truco para remover elementos desmarcados
             echo"      enteros.options[enteros.length] = new Option('','',false,false);";
             echo"      decimales.length=0;";
             echo"      decimales.options[decimales.length] = new Option('','',false,false); }";
             echo"}";
             echo"</script>";
?>
