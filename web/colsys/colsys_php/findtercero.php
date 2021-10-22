<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       FINDTERCERO.PHP                                             \\
// Creado:        2004-04-21                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-21                                                  \\
//                                                                            \\
// Descripción:   Módulo para la Definición de Terceros                       \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
$programa = 18;

$titulo = 'Maestra de Terceros Coltrans S.A.';
$campos = array("Nombre del Tercero", "Nombre del Contacto");                  // Arreglo con los criterios de busqueda
$bdatos = array("Maestra de Terceros");
$tipos  = array("_pro" => "Proveedor", "_rep" => "Representante", "_con" => "Consignatario", "_not" => "Notify", "_mas" => "Master");
$titulo = 'Consulta a Maestra de '.(isset($suf)?($tipos[$suf].'(s)'):'Terceros');

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
if (!isset($usuario)) {                                                        // Verifica si el usuario ya inicio su sessión
    echo "<script>location.href = 'entrada.php';</script>";
   }


$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($criterio) and !isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id){";
    echo "    location.href = 'findtercero.php?boton='+opcion+'\&id='+id+'\&suf=$suf';";
    echo "}";
    echo "</script>";
    ?>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <?php
    echo "</HEAD>";
    echo "<BODY style='margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px; text-align: right; font-size: 11px; font-weight:bold;'>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='terceros' ACTION='findtercero.php'>";
    echo "<INPUT TYPE='HIDDEN' NAME='suf' VALUE=$suf>";
    echo "<INPUT TYPE='HIDDEN' NAME='boton' VALUE='Buscar'>";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=3 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
    echo "<TR>";
    echo "  <TH ROWSPAN=2>&nbsp</TH>";
    echo "  <TD Class=listar ROWSPAN=2><B>Buscar por:</B><BR><SELECT NAME='modalidad' SIZE=4>";
    for ($i=0; $i < count($campos); $i++) {
         echo " <OPTION VALUE='".$campos[$i]."'";
         if ($i==0) {
             echo " SELECTED"; 
            }
         echo ">".$campos[$i];
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar><B>Que contenga la cadena:</B><BR><INPUT TYPE='text' NAME='criterio' size='60'></TD>";
    echo "  <TH ROWSPAN=2><INPUT Class=submit TYPE='SUBMIT' NAME='boton' VALUE='  Buscar  ' ONCLIK='terceros.submit();'></TH>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar><B>Buscar en:</B><BR><SELECT NAME='buscaren'>";
    for ($i=0; $i < count($bdatos); $i++) {
         echo " <OPTION VALUE='".$bdatos[$i]."'";
         if ($i==0) {
             echo " SELECTED"; 
            }
         echo ">".$bdatos[$i];
        }
    echo "  </SELECT>";
    echo "  </TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=4></TD>";
    echo "</TR>";
    echo "</TABLE>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.find_contacto.style.visibility = \"hidden\"; window.parent.document.body.scroll=\"yes\";'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    //   echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    // require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
    }
elseif (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    switch(trim($boton)) {
        case 'Buscar':{
             if (isset($criterio) and !isset($condicion)) {
                 $columnas = array("Nombre del Tercero"=>"ca_nombre", "Nombre del Contacto"=>"ca_contacto");
                 $condicion= "where lower($columnas[$modalidad]) like lower('%".$criterio."%')"; }
             if (!$rs->Open("select * from vi_terceros $condicion and ca_tipo = '".$tipos[substr($suf,0,4)]."'")) {               // Selecciona todos lo registros de la tabla de Terceros
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>location.href = 'entrada.php';</script>";
                 exit; }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function elegir(opcion, id){";
             echo "    location.href = 'findtercero.php?boton='+opcion+'\&id='+id+'\&suf=$suf';";
             echo "}";
             echo "function seleccion(idtercero, nombre, contacto, direccion, telefonos, fax, email) {";
             echo "    elemento = window.parent.document.getElementById('id$suf');";
             echo "    elemento.value = idtercero;";
             echo "    elemento = window.parent.document.getElementById('nombre$suf');";
             echo "    elemento.value = nombre;";
             echo "    elemento = window.parent.document.getElementById('contacto$suf');";
             echo "    elemento.value = contacto;";
             echo "    elemento = window.parent.document.getElementById('direccion$suf');";
             echo "    elemento.value = direccion;";
             echo "    elemento = window.parent.document.getElementById('telefonos$suf');";
             echo "    elemento.value = telefonos;";
             echo "    elemento = window.parent.document.getElementById('fax$suf');";
             echo "    elemento.value = fax;";
             echo "    elemento = window.parent.document.getElementById('email$suf');";
             echo "    elemento.value = email;";
             echo "    window.parent.frames.find_contacto.style.visibility = \"hidden\";";
             echo "    window.parent.document.body.scroll=\"yes\";";
             echo "    if (('$suf').substr(0,4) == '_pro'){";
             echo "        window.parent.document.getElementById('orden$suf').focus();";
             echo "    }";
             echo "    if (('$suf').substr(0,4) == '_not'){";
             echo "        elemento = window.parent.document.getElementById('default_not');";
             echo "        elemento.checked = true;";
             echo "    }";
             echo "}";
             echo "function uno(src,color_entrada) {";
             echo "    src.style.background=color_entrada;src.style.cursor='hand'";
             echo "}";
             echo "function dos(src,color_default) {";
             echo "    src.style.background=color_default;src.style.cursor='default';";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY>";
//require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='cabecera' ACTION='findtercero.php'>";       // Hace una llamado nuevamente a este script pero con
             echo "<INPUT TYPE='HIDDEN' NAME='suf' VALUE=$suf>";
             echo "<TABLE CELLSPACING=1 WIDTH=100%>";                                // un boton de comando definido para hacer mantemientos
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=7>$titulo</TH>";
             echo "</TR>";
             echo "<TH>Nombre del Tercero</TH>";
             echo "<TH>Contacto</TH>";
             echo "<TH>Dirección</TH>";
             echo "<TH>Teléfono</TH>";
             echo "<TH>Fax</TH>";
             echo "<TH>Ciudad</TH>";
             echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
             while (!$rs->Eof() and !$rs->IsEmpty()) {                                  // Lee la totalidad de los registros obtenidos en la instrucción Select
                $visible = ($rs->Value('ca_vendedor')== $usuario or $rs->Value('ca_vendedor')=='' or $nivel >= 1)?'visible':'hidden';
                echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\">";
                echo "  <DIV>";
                echo "  <TD ONCLICK='javascript:seleccion(".$rs->Value('ca_idtercero').",\"".AddSlashes($rs->Value('ca_nombre'))."\",\"".AddSlashes($rs->Value('ca_contacto'))."\",\"".AddSlashes($rs->Value('ca_direccion'))."\",\"".$rs->Value('ca_telefonos')."\",\"".$rs->Value('ca_fax')."\",\"".$rs->Value('ca_email')."\")'>".$rs->Value('ca_nombre')."</TD>";
                echo "  <TD>".$rs->Value('ca_contacto')."</TD>";
                echo "  <TD>".$rs->Value('ca_direccion')."</TD>";
                echo "  <TD>".$rs->Value('ca_telefonos')."</TD>";
                echo "  <TD>".$rs->Value('ca_fax')."</TD>";
                if ($rs->Value('ca_idciudad') != '999-9999')
                   echo "  <TD>".$rs->Value('ca_nomtrafico')." - ".$rs->Value('ca_ciudad')."</TD>";
                else
                   echo "  <TD></TD>";
                echo "  </DIV>";
                echo "  <TD Class=listar WIDTH=44 style='text-align:center;'>";                                            // Botones para hacer Mantenimiento a la Tabla
                echo "    <IMG style='visibility: $visible;' src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\", ".$rs->Value('ca_idtercero').");'>";
                echo "    <IMG style='visibility: $visible;' src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\", ".$rs->Value('ca_idtercero').");'>";
                echo "  </TD>";
                echo "</TR>";
                $rs->MoveNext();
               }
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
			 echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.find_contacto.style.visibility = \"hidden\"; window.parent.document.body.scroll=\"yes\";'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             //require_once("footer.php");
echo "</BODY>";
             echo "</HTML>";
             break;
             }
        case 'Adicionar': {                                                    // Opcion para Adicionar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             $tm =& DlRecordset::NewRecordset($conn);
             echo "<HEAD>";
             echo "<TITLE>Tabla de Terceros ".COLTRANS."</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (document.adicionar.nombre.value == '')";
             echo "      alert('El campo Nombre no es válido');";
             echo "  else if (document.adicionar.contacto.value == '')";
             echo "      alert('El campo Contacto no es válido');";
             echo "  else if (document.adicionar.direccion.value == '')";
             echo "      alert('El campo Dirección no es válido');";
             echo "  else if (document.adicionar.telefonos.value == '')";
             echo "      alert('El campo Teléfonos no es válido');";
             echo "  else if (document.adicionar.fax.value == '')";
             echo "      alert('El campo Fax no es válido');";
             echo "  else";
             echo "      if (!isNaN(document.adicionar.identificacion.value))";
			 echo "          if (document.adicionar.identificacion.value == '')";
             echo "              alert('Por tratarse de un consignatario debe ingresar el número del Nit. o Id');";
			 echo "          else if (document.adicionar.digito.value == '')";
             echo "              alert('Debe Ingresar en Dígito de Verificacion');";
             echo "          else";
             echo "              return (true);";
             echo "  return (false);";
             echo "}";
             echo "function valores(elemento) {";
             echo "	if (isNaN(parseFloat(elemento.value)) || elemento.value.indexOf(',')!=-1 || elemento.value.indexOf('.')!=-1){";
             echo "		alert('No es un valor número correcto para el campo. Favor intente nuevamente sin utilizar letras, comas o rayas.');";
             echo "		elemento.focus();";
             echo "	}else{";
             echo "		elemento.value = parseFloat(elemento.value);";
             echo "	}";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY>";
//require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='findtercero.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='suf' VALUE=$suf>";
             echo "<TABLE CELLSPACING=1 WIDTH=450>";
             echo "<TH Class=titulo COLSPAN=2>Datos para el nuevo Tercero</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='nombre' SIZE=40 MAXLENGTH=80 style='text-transform: uppercase'></TD>";
             echo "</TR>";
			 if ($suf == '_con'){
				 echo "<TR>";
				 echo "  <TD Class=captura>Nit:</TD>";
				 echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='identificacion' SIZE=11 MAXLENGTH=10 ONBLUR='valores(this);'>-<INPUT TYPE='TEXT' NAME='digito' SIZE=2 MAXLENGTH=1 ONBLUR='valores(this);'></TD>";
				 echo "</TR>";
			 }
             echo "<TR>";
             echo "  <TD Class=captura>Contacto:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='contacto' SIZE=40 MAXLENGTH=60></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Dirección:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='direccion' SIZE=60 MAXLENGTH=100></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Teléfonos:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='telefonos' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fax:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fax' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             if (substr($suf,0,4) != '_pro'){
                if (!$tm->Open("select min(c.ca_idciudad) as ca_idciudad, c.ca_ciudad, t.ca_nombre from tb_ciudades c, tb_traficos t where c.ca_idtrafico = t.ca_idtrafico and t.ca_idtrafico != '99-999' group by t.ca_nombre, c.ca_ciudad order by t.ca_nombre, c.ca_ciudad")) {       // Selecciona todos lo registros de la tabla Ciudades
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'agentes.php';</script>";
                    exit; }
                $tm->MoveFirst();
                echo "<TR>";
                echo "  <TD Class=captura>Ciudad:</TD>";
                echo "  <TD Class=mostrar><SELECT NAME='idciudad'>";             // Llena el cuadro de lista con los valores de la tabla Ciudades
                while ( !$tm->Eof()) {
                        echo " <OPTION VALUE=".$tm->Value('ca_idciudad').">".$tm->Value('ca_nombre')." - ".$tm->Value('ca_ciudad')."</OPTION>";
                        $tm->MoveNext();
                      }
                echo "</TR>";
                }
             else{
                echo "<INPUT TYPE='HIDDEN' NAME='idciudad' VALUE='999-9999'>";
             }
             echo "<TR>";
             echo "  <TD Class=captura>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='email' SIZE=40 MAXLENGTH=250 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='location.href = \"findtercero.php?suf=$suf\"'></TH>";  // Cancela la operación
             echo "<script>adicionar.nombre.focus()</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
            // require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Modificar': {                                                    // Opcion para Modificar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select min(c.ca_idciudad) as ca_idciudad, c.ca_ciudad, t.ca_nombre from tb_ciudades c, tb_traficos t where c.ca_idtrafico = t.ca_idtrafico and t.ca_idtrafico != '99-999' group by t.ca_nombre, c.ca_ciudad order by t.ca_nombre, c.ca_ciudad")) {       // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php';</script>";
                 exit; }
             if (!$rs->Open("select * from vi_terceros where ca_idtercero = ".$id)) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>location.href = 'findtercero.php';</script>";
                 exit;
                }
             $tm->MoveFirst();
             echo "<HEAD>";
             echo "<TITLE>Tabla de Terceros ".COLTRANS."</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (document.modificar.nombre.value == '')";
             echo "      alert('El campo Nombre no es válido');";
             echo "  else if (document.modificar.contacto.value == '')";
             echo "      alert('El campo Contacto no es válido');";
             echo "  else if (document.modificar.direccion.value == '')";
             echo "      alert('El campo Dirección no es válido');";
             echo "  else if (document.modificar.telefonos.value == '')";
             echo "      alert('El campo Teléfonos no es válido');";
             echo "  else if (document.modificar.fax.value == '')";
             echo "      alert('El campo Fax no es válido');";
             echo "  else";
             echo "      if (!isNaN(document.modificar.identificacion.value))";
			 echo "          if (document.modificar.identificacion.value == '')";
             echo "              alert('Por tratarse de un consignatario debe ingresar el número del R.U.T. o Id');";
			 echo "          else if (document.modificar.digito.value == '')";
             echo "              alert('Debe Ingresar en Dígito de Verificacion');";
             echo "          else";
             echo "              return (true);";
             echo "  return (false);";
             echo "}";
             echo "function valores(elemento) {";
             echo "	if (isNaN(parseFloat(elemento.value)) || elemento.value.indexOf(',')!=-1 || elemento.value.indexOf('.')!=-1){";
             echo "		alert('No es un valor número correcto para el campo. Favor intente nuevamente sin utilizar letras, comas o rayas.');";
             echo "		elemento.focus();";
             echo "	}else{";
             echo "		elemento.value = parseFloat(elemento.value);";
             echo "	}";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY>";
//require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='modificar' ACTION='findtercero.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='suf' VALUE=$suf>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=$id>";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='vendedor' VALUE='".$rs->Value('ca_vendedor')."'>";
             echo "<TABLE CELLSPACING=1 WIDTH=450>";
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos para el Tercero</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='nombre' VALUE='".$rs->Value('ca_nombre')."' SIZE=40 MAXLENGTH=80 style='text-transform: uppercase'></TD>";
             echo "</TR>";
			 if ($suf == '_con'){
				 echo "<TR>";
				 echo "  <TD Class=captura>Nit:</TD>";
				 list($identificacion, $digito) = sscanf($rs->Value('ca_identificacion'), "%d-%d");
				 echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='identificacion' VALUE='$identificacion' SIZE=11 MAXLENGTH=10 ONBLUR='valores(this);'>-<INPUT TYPE='TEXT' NAME='digito' VALUE='$digito' SIZE=2 MAXLENGTH=1 ONBLUR='valores(this);'></TD>";
				 echo "</TR>";
			 }
             echo "<TR>";
             echo "  <TD Class=captura>Contacto:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='contacto' VALUE='".$rs->Value('ca_contacto')."' SIZE=40 MAXLENGTH=60></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Dirección:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='direccion' VALUE='".$rs->Value('ca_direccion')."' SIZE=60 MAXLENGTH=100></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Teléfonos:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='telefonos' VALUE='".$rs->Value('ca_telefonos')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fax:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fax' VALUE='".$rs->Value('ca_fax')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             if (substr($suf,0,4) != '_pro'){
                echo "<TR>";
                echo "  <TD Class=captura>Ciudad:</TD>";
                echo "  <TD Class=mostrar><SELECT NAME='idciudad'>";             // Llena el cuadro de lista con los valores de la tabla Ciudades
                while ( !$tm->Eof()) {
                        echo " <OPTION VALUE=".$tm->Value('ca_idciudad');
                        if ($tm->Value('ca_idciudad')==$rs->Value('ca_idciudad')) {
                            echo" SELECTED"; }
                        echo ">".$tm->Value('ca_nombre')." - ".$tm->Value('ca_ciudad')."</OPTION>";
                        $tm->MoveNext();
                      }
                echo "</TR>";
                }
             else{
                echo "<INPUT TYPE='HIDDEN' NAME='idciudad' VALUE='999-9999'>";
             }
             echo "<TR>";
             echo "  <TD Class=captura>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='email' VALUE='".$rs->Value('ca_email')."' SIZE=40 MAXLENGTH=250 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='location.href = \"findtercero.php?boton=Buscar\&modalidad=Nombre del Tercero\&criterio=".$rs->Value('ca_nombre')."\&suf=$suf\"'></TH>";  // Cancela la operación
             echo "<script>modificar.nombre.focus();</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             //require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Eliminar': {                                                    // Opcion para Eliminar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_terceros where ca_idtercero = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>location.href = 'findtercero.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>Tabla de Terceros ".COLTRANS."</TITLE>";
             echo "</HEAD>";
             echo "<BODY>";
//require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='eliminar' ACTION='findtercero.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='suf' VALUE=$suf>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=$id>";              // Hereda el Id del registro que se esta eliminando
             echo "<TABLE WIDTH=400 CELLSPACING=1 WIDTH=450>";
             echo "<TH Class=titulo COLSPAN=2>Datos del Tercero a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_nombre')."</TD>";
             echo "</TR>";
			 if ($suf == '_con'){
				 echo "<TR>";
				 echo "  <TD Class=captura>R.U.T.:</TD>";
				 echo "  <TD Class=mostrar>".$rs->Value('ca_identificacion')."-".$rs->Value('ca_digito')."</TD>";
				 echo "</TR>";
			 }
             echo "<TR>";
             echo "  <TD Class=captura>Contacto:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_contacto')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Dirección:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_direccion')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Teléfonos:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_telefonos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fax:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_fax')."</TD>";
             echo "</TR>";
             if (substr($suf,0,4) != '_pro'){
                echo "<TR>";
                echo "  <TD Class=captura>Ciudad:</TD>";
                echo "  <TD Class=mostrar>".$rs->Value('ca_nomtrafico')." - ".$rs->Value('ca_ciudad')."</TD>";
                echo "</TR>"; }
             echo "<TR>";
             echo "  <TD Class=captura>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_email')."</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='location.href = \"findtercero.php?boton=Buscar\&modalidad=Nombre del Tercero\&criterio=".$rs->Value('ca_nombre')."\&suf=$suf\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             //require_once("footer.php");
echo "</BODY>";
             break;
             }
        }
}
elseif (isset($accion)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
    echo "<INPUT TYPE='HIDDEN' NAME='suf' VALUE=$suf>";
    switch(trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Guardar': {                                                      // El Botón Guardar fue pulsado
             $vendedor = ($nivel >= 1)?"":$usuario;
             if (!$rs->Open("insert into tb_terceros (ca_nombre, ca_contacto, ca_direccion, ca_telefonos, ca_fax, ca_idciudad, ca_email, ca_vendedor, ca_tipo, ca_identificacion) values(upper('$nombre'), '$contacto', '$direccion', '$telefonos', '$fax', '$idciudad', lower('$email'), '$vendedor', '".$tipos[substr($suf,0,4)]."', '$identificacion-$digito')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>location.href = 'findtercero.php';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             $vendedor = ($nivel >= 1)?$vendedor:$usuario;
             if (!$rs->Open("update tb_terceros set ca_nombre = upper('$nombre'), ca_contacto = upper('$contacto'), ca_direccion = '$direccion', ca_telefonos = '$telefonos', ca_fax = '$fax', ca_idciudad = '$idciudad', ca_vendedor = '$vendedor', ca_email = lower('$email'), ca_identificacion = '$identificacion-$digito' where ca_idtercero = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>location.href = 'findtercero.php';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_terceros where ca_idtercero = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>location.href = 'findtercero.php';</script>";
                 exit;
                }
             break;
             }
        }
   if (isset($nombre))
       echo "<script>location.href = 'findtercero.php?boton=Buscar\&modalidad=Nombre del Tercero\&criterio=$nombre\&suf=$suf';</script>";  // Retorna a la pantalla principal de la opción
   else
       echo "<script>location.href = 'findtercero.php?suf=$suf';</script>";  // Retorna a la pantalla principal de la opción
}
?>