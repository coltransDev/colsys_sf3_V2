<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-*\
// Archivo:       RECARGOS.PHP                                                   \\
// Creado:        2004-06-25                                                     \\
// Autor:         Carlos Gilberto López M.                                       \\
// Ver:           1.00                                                           \\
// Updated:       2004-06-25                                                     \\
//                                                                               \\
// Descripción:   Módulo de mantenimiento a la tabla de Recargos de cada Trayecto\\
//                atendido por los transportista.                                \\
//                                                                               \\
// Copyright:     Coltrans S.A. - 2004                                           \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-*\
*/

$titulo = 'Tabla de Recargos por Trayecto de Transportistas';
$aplicaciones = array("Permanente","Temporal");
$basesporcentaje = array("Sobre Flete","Sobre Vlr Factura");
$basesunitario = array("Unidades Peso/Volumen", "Número de Piezas","Cantidad de BLs/AWBs");
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    switch(trim($boton)) {
        case 'Adicionar': {                                                    // Opcion para Adicionar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_trayectos where ca_idtrayecto = $id")) {  // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select ca_idconcepto, ca_concepto from tb_conceptos where ca_modalidad = '".$rs->Value('ca_modalidad')."'")) {   // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'recargos.php';</script>";
                 exit; }
			 $tm->MoveFirst();
             echo "<HTML>";
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.adicionar.vlrfijo.value == '' && document.adicionar.porcentaje.value == '' && document.adicionar.vlrunitario.value == '')";
			 echo "      alert('Debe especificar un valor fijo, porcentaje o valor unitario para el Recargo');";
             echo "  else if (!chkDate(document.adicionar.fchinicio))";
             echo "      document.adicionar.fchinicio.focus();";
             echo "  else if (!chkDate(document.adicionar.fchvencimiento))";
             echo "      document.adicionar.fchvencimiento.focus();";
			 echo "  else";
             echo "      return (habilitar(document.adicionar.porcentaje) && habilitar(document.adicionar.vlrunitario));";
			 echo "  return (false);";
             echo "}";
             echo "function habilitar(campo){";
			 echo "  if (campo.name == 'porcentaje')";
             echo "      if (campo.value > 0 && campo.value <= 100){";
			 echo "          document.adicionar.baseporcentaje.disabled = false;";
             echo "          document.adicionar.baseporcentaje.focus();";
			 echo "          return (true); }";
			 echo "      else if (campo.value == 0){";
			 echo "          document.adicionar.baseporcentaje.disabled = true;";
			 echo "          return (true); }";
			 echo "      else {";
			 echo "          document.adicionar.baseporcentaje.disabled = true;";
			 echo "          alert('El valor ingresado como Porcentaje no es válido');";
             echo "          campo.focus();";
			 echo "          return (false); }";
             echo "  else if (campo.name == 'vlrunitario')";
             echo "      if (campo.value > 0){";
			 echo "          document.adicionar.baseunitario.disabled = false;";
             echo "          document.adicionar.baseunitario.focus();";
			 echo "          return (true); }";
			 echo "      else if (campo.value == 0){";
			 echo "          document.adicionar.baseunitario.disabled = true;";
			 echo "          return (true); }";
			 echo "      else {";
			 echo "          document.adicionar.baseunitario.disabled = true;";
			 echo "          alert('El valor ingresado como Valor Unitario no es válido');";
             echo "          campo.focus();";
			 echo "          return (false); }";
             echo "  else if (campo.name == 'aplicacion')";
             echo "      if (campo.value == 'Temporal'){";
			 echo "          document.adicionar.fchinicio.disabled = false;";
			 echo "          document.adicionar.fchvencimiento.disabled = false;";
             echo "          document.adicionar.fchinicio.focus();";
			 echo "          return (true); }";
			 echo "      else {";
			 echo "          document.adicionar.fchinicio.disabled = true;";
			 echo "          document.adicionar.fchvencimiento.disabled = true;";
			 echo "          return (true); }";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='recargos.php' ONSUBMIT='return validar();'>";             // Hace una llamado nuevamente a este script pero con
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";                      // Hereda el Id del registro que se esta consultando
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=4>SISTEMA TARIFARIO<BR>$titulo</TH>";
             echo "</TR>";
             while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                echo "<TR>";
                echo "  <TD Class=captura style='font-weight: bold;'>Transportista</TD>";
                echo "  <TD Class=mostrar style='font-weight: bold;' COLSPAN=3>".number_format($rs->Value('ca_idtransportista'))." - ".$rs->Value('ca_nomtransportista')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura style='font-weight: bold;'>".strtoupper($rs->Value('ca_traorigen'))."</TD>";
                echo "  <TD Class=mostrar>".$rs->Value('ca_origen')." ".$rs->Value('ca_ciuorigen')."</TD>";
                echo "  <TD Class=captura style='font-weight: bold;'>".strtoupper($rs->Value('ca_tradestino'))."</TD>";
                echo "  <TD Class=mostrar>".$rs->Value('ca_destino')." ".$rs->Value('ca_ciudestino')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "<TD Class=captura style='font-weight: bold;'>Transporte:</TD>";
                echo "<TD Class=mostrar>".$rs->Value('ca_transporte')."</TD>";
                echo "<TD Class=captura style='font-weight: bold;'>Modalidad:</TD>";
                echo "<TD Class=mostrar>".$rs->Value('ca_modalidad')."</TD>";
                echo "</TR>";
                $rs->MoveNext();
                }
             echo "</TABLE><BR>";
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                       // un boton de comando definido para hacer mantemientos
             echo "<TH COLSPAN=6>Datos para el Nuevo Recargo</TH>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>Concepto<BR><SELECT NAME='idconcepto'>";  // Llena el cuadro de lista con los valores de la tabla Conceptos
			 echo "  <OPTION VALUE=9999>Recargo General Para Tráfico</OPTION>";
             while (!$tm->Eof()) {
                    echo"<OPTION VALUE=".$tm->Value('ca_idconcepto').">".$tm->Value('ca_concepto')."</OPTION>";
                    $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             if (!$tm->Open("select ca_idrecargo, ca_recargo from tb_tiporecargo where ca_transporte = '".$rs->Value('ca_transporte')."' order by ca_recargo")) {   // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'recargos.php';</script>";
                 exit; }
			 $tm->MoveFirst();
             echo "  <TD Class=mostrar>Recargo<BR><SELECT NAME='idrecargo'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
             while (!$tm->Eof()) {
                    echo"<OPTION VALUE=".$tm->Value('ca_idrecargo').">".$tm->Value('ca_recargo')."</OPTION>";
                    $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar>Aplicación:<BR><SELECT NAME='aplicacion' ONCHANGE='habilitar(this);'>";
             for ($i=0; $i < count($aplicaciones); $i++) {
                  echo " <OPTION VALUE='".$aplicaciones[$i]."'>".$aplicaciones[$i];
                  }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar>Inicio<BR><INPUT TYPE='TEXT' DISABLED NAME='fchinicio' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "  <TD Class=mostrar>Vencimiento<BR><INPUT TYPE='TEXT' DISABLED NAME='fchvencimiento' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Valor Fijo:<BR><INPUT TYPE='TEXT' NAME='vlrfijo' SIZE=17 MAXLENGTH=15></TD>";
             echo "  <TD Class=mostrar>Porcentaje:<BR><INPUT TYPE='TEXT' NAME='porcentaje' SIZE=6 MAXLENGTH=5 ONBLUR='habilitar(this);'>%</TD>";
             echo "  <TD Class=mostrar>Base de Porcentaje:<BR><SELECT DISABLED NAME='baseporcentaje'>";
             for ($i=0; $i < count($basesporcentaje); $i++) {
                  echo " <OPTION VALUE='".$basesporcentaje[$i]."'>".$basesporcentaje[$i];
                  }
             echo "  <TD Class=mostrar>Valor Unitario:<BR><INPUT TYPE='TEXT' NAME='vlrunitario' SIZE=16 MAXLENGTH=14 ONBLUR='habilitar(this);'></TD>";
             echo "  <TD Class=mostrar COLSPAN=2>Base de VlrUnitario:<BR><SELECT DISABLED NAME='baseunitario'>";
             for ($i=0; $i < count($basesunitario); $i++) {
                  echo " <OPTION VALUE='".$basesunitario[$i]."'>".$basesunitario[$i];
                  }
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=4 ROWSPAN=2>Observaciones:<BR><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=5 COLS=82></TEXTAREA></TD>";
             echo "  <TD Class=mostrar COLSPAN=2>Recargo Mínimo:<BR><INPUT TYPE='TEXT' NAME='recargominimo' SIZE=17 MAXLENGTH=15></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>Moneda:<BR><SELECT NAME='idmoneda'>";            // Llena el cuadro de lista con los valores de la tabla Monedas
             if (!$tm->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) { // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'fletes.php';</script>";
                 exit; }
			 $tm->MoveFirst();
             while ( !$tm->Eof()) {
                     echo"<OPTION VALUE=".$tm->Value('ca_idmoneda').">".$tm->Value('ca_nombre')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
			 echo "</TABLE>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"fletes.php?id=$id\"'></TH>";  // Cancela la operación
             echo "<script>adicionar.idconcepto.focus()</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Modificar': {
             $modulo = "00100200";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_trayectos where ca_idtrayecto = $id")) {  // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select ca_idconcepto, ca_concepto from tb_conceptos where ca_modalidad = '".$rs->Value('ca_modalidad')."'")) {   // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'recargos.php';</script>";
                 exit; }
			 $tm->MoveFirst();
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.modificar.vlrfijo.value == '' && document.modificar.porcentaje.value == '' && document.modificar.vlrunitario.value == '')";
			 echo "      alert('Debe especificar un valor fijo, porcentaje o valor unitario para el Recargo');";
             echo "  else if (!chkDate(document.modificar.fchinicio))";
             echo "      document.modificar.fchinicio.focus();";
             echo "  else if (!chkDate(document.modificar.fchvencimiento))";
             echo "      document.modificar.fchvencimiento.focus();";
			 echo "  else";
			 echo "      return (true);";
			 echo "  return (false);";
             echo "}";
             echo "function habilitar(campo){";
			 echo "  if (campo.name == 'porcentaje')";
             echo "      if (campo.value > 0 && campo.value <= 100){";
			 echo "          document.modificar.baseporcentaje.disabled = false;";
             echo "          document.modificar.baseporcentaje.focus();";
			 echo "          return (true); }";
			 echo "      else if (campo.value == 0){";
			 echo "          document.modificar.baseporcentaje.disabled = true;";
			 echo "          return (true); }";
			 echo "      else {";
			 echo "          document.modificar.baseporcentaje.disabled = true;";
			 echo "          alert('El valor ingresado como Porcentaje no es válido');";
             echo "          campo.focus();";
			 echo "          return (false); }";
             echo "  else if (campo.name == 'vlrunitario')";
             echo "      if (campo.value > 0){";
			 echo "          document.modificar.baseunitario.disabled = false;";
             echo "          document.modificar.baseunitario.focus();";
			 echo "          return (true); }";
			 echo "      else if (campo.value == 0){";
			 echo "          document.modificar.baseunitario.disabled = true;";
			 echo "          return (true); }";
			 echo "      else {";
			 echo "          document.modificar.baseunitario.disabled = true;";
			 echo "          alert('El valor ingresado como Valor Unitario no es válido');";
             echo "          campo.focus();";
			 echo "          return (false); }";
             echo "  else if (campo.name == 'aplicacion')";
             echo "      if (campo.value == 'Temporal'){";
			 echo "          document.modificar.fchinicio.disabled = false;";
			 echo "          document.modificar.fchvencimiento.disabled = false;";
             echo "          document.modificar.fchinicio.focus();";
			 echo "          return (true); }";
			 echo "      else {";
			 echo "          document.modificar.fchinicio.disabled = true;";
			 echo "          document.modificar.fchvencimiento.disabled = true;";
			 echo "          return (true); }";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<FORM METHOD=post NAME='modificar' ACTION='recargos.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='oid' VALUE=".$oid.">";            // Hereda el Id del registro que se esta modificando
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=4>SISTEMA TARIFARIO<BR>$titulo</TH>";
             echo "</TR>";
             while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                echo "<TR>";
                echo "  <TD Class=captura style='font-weight: bold;'>Transportista</TD>";
                echo "  <TD Class=mostrar style='font-weight: bold;' COLSPAN=3>".number_format($rs->Value('ca_idtransportista'))." - ".$rs->Value('ca_nomtransportista')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura style='font-weight: bold;'>".strtoupper($rs->Value('ca_traorigen'))."</TD>";
                echo "  <TD Class=mostrar>".$rs->Value('ca_origen')." ".$rs->Value('ca_ciuorigen')."</TD>";
                echo "  <TD Class=captura style='font-weight: bold;'>".strtoupper($rs->Value('ca_tradestino'))."</TD>";
                echo "  <TD Class=mostrar>".$rs->Value('ca_destino')." ".$rs->Value('ca_ciudestino')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "<TD Class=captura style='font-weight: bold;'>Transporte:</TD>";
                echo "<TD Class=mostrar>".$rs->Value('ca_transporte')."</TD>";
                echo "<TD Class=captura style='font-weight: bold;'>Modalidad:</TD>";
                echo "<TD Class=mostrar>".$rs->Value('ca_modalidad')."</TD>";
                echo "</TR>";
                $rs->MoveNext();
                }
             echo "</TABLE><BR>";
             if (!$rs->Open("select * from vi_recargos where ca_idtrayecto = $id and ca_oid = $oid")) {  // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
			 $rs->MoveFirst();
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TH COLSPAN=6>Nuevos Datos para el Recargo</TH>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>Concepto<BR><SELECT NAME='idconcepto'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
			 echo "  <OPTION VALUE=9999>Recargo General Para Tráfico</OPTION>";
             while (!$tm->Eof()) {
                    echo"<OPTION VALUE=".$tm->Value('ca_idconcepto');
                     if ($tm->Value('ca_idconcepto')==$rs->Value('ca_idconcepto')) {
                         echo" SELECTED"; }
					echo">".$tm->Value('ca_concepto')."</OPTION>";
                    $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             if (!$tm->Open("select ca_idrecargo, ca_recargo from tb_tiporecargo where ca_transporte = '".$rs->Value('ca_transporte')."' order by ca_recargo")) {   // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'recargos.php';</script>";
                 exit; }
			 $tm->MoveFirst();
             echo "  <TD Class=mostrar>Recargo<BR><SELECT NAME='idrecargo'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
             while (!$tm->Eof()) {
                    echo"<OPTION VALUE=".$tm->Value('ca_idrecargo');
                     if ($tm->Value('ca_idrecargo')==$rs->Value('ca_idrecargo')) {
                         echo" SELECTED"; }
					echo">".$tm->Value('ca_recargo')."</OPTION>";
                    $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar>Aplicación:<BR><SELECT NAME='aplicacion' ONCHANGE='habilitar(this);'>";
             for ($i=0; $i < count($aplicaciones); $i++) {
                  echo " <OPTION VALUE='".$aplicaciones[$i]."'";
                  if ($rs->Value('ca_aplicacion')==$aplicaciones[$i]) {
                      echo " SELECTED"; }
				  echo ">".$aplicaciones[$i];
                  }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar>Inicio<BR><INPUT TYPE='TEXT' ".($rs->Value('ca_aplicacion')=='Permanente'?'DISABLED':'')." NAME='fchinicio' SIZE=12 VALUE='".$rs->Value('ca_fchinicio')."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "  <TD Class=mostrar>Vencimiento<BR><INPUT TYPE='TEXT' ".($rs->Value('ca_aplicacion')=='Permanente'?'DISABLED':'')." NAME='fchvencimiento' SIZE=12 VALUE='".$rs->Value('ca_fchvencimiento')."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Valor Fijo:<BR><INPUT TYPE='TEXT' NAME='vlrfijo' VALUE='".$rs->Value('ca_vlrfijo')."' SIZE=17 MAXLENGTH=15></TD>";
             echo "  <TD Class=mostrar>Porcentaje:<BR><INPUT TYPE='TEXT' NAME='porcentaje' VALUE='".$rs->Value('ca_porcentaje')."' SIZE=6 MAXLENGTH=5 ONBLUR='habilitar(this);'>%</TD>";
             echo "  <TD Class=mostrar>Base de Porcentaje:<BR><SELECT ".($rs->Value('ca_porcentaje')==0?'DISABLED':'')." NAME='baseporcentaje'>";
             for ($i=0; $i < count($basesporcentaje); $i++) {
                  echo " <OPTION VALUE='".$basesporcentaje[$i]."'";
                  if ($rs->Value('ca_baseporcentaje')==$basesporcentaje[$i]) {
                      echo " SELECTED"; }
				  echo ">".$basesporcentaje[$i];
                  }
             echo "  <TD Class=mostrar>Valor Unitario:<BR><INPUT TYPE='TEXT' NAME='vlrunitario' VALUE='".$rs->Value('ca_vlrunitario')."' SIZE=17 MAXLENGTH=15 ONBLUR='habilitar(this);'></TD>";
             echo "  <TD Class=mostrar COLSPAN=2>Base de VlrUnitario:<BR><SELECT ".($rs->Value('ca_vlrunitario')==0?'DISABLED':'')." NAME='baseunitario'>";
             for ($i=0; $i < count($basesunitario); $i++) {
                  echo " <OPTION VALUE='".$basesunitario[$i]."'";;
                  if ($rs->Value('ca_baseunitario')==$basesunitario[$i]) {
                      echo " SELECTED"; }
				  echo ">".$basesunitario[$i];
                  }
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=4 ROWSPAN=2>Observaciones:<BR><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=5 COLS=82>".$rs->Value('ca_observaciones')."</TEXTAREA></TD>";
             echo "  <TD Class=mostrar COLSPAN=2>Recargo Mínimo:<BR><INPUT TYPE='TEXT' NAME='recargominimo' VALUE='".$rs->Value('ca_recargominimo')."' SIZE=17 MAXLENGTH=15></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>Moneda:<BR><SELECT NAME='idmoneda'>";            // Llena el cuadro de lista con los valores de la tabla Monedas
             if (!$tm->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) { // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'fletes.php';</script>";
                 exit; }
			 $tm->MoveFirst();
             while ( !$tm->Eof()) {
                     echo"<OPTION VALUE=".$tm->Value('ca_idmoneda');
                     if ($tm->Value('ca_idmoneda')==$rs->Value('ca_idmoneda')) {
                         echo" SELECTED"; }
					 echo">".$tm->Value('ca_nombre')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
			 echo "</TABLE>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"fletes.php?id=$id\"'></TH>";  // Cancela la operación
             echo "<script>modificar.idconcepto.focus()</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo"<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Eliminar': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_trayectos where ca_idtrayecto = $id")) {  // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<FORM METHOD=post NAME='eliminar' ACTION='recargos.php'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='oid' VALUE=".$oid.">";            // Hereda el Id del registro que se esta modificando
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=4>SISTEMA TARIFARIO<BR>$titulo</TH>";
             echo "</TR>";
             while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                echo "<TR>";
                echo "  <TD Class=captura style='font-weight: bold;'>Transportista</TD>";
                echo "  <TD Class=mostrar style='font-weight: bold;' COLSPAN=3>".number_format($rs->Value('ca_idtransportista'))." - ".$rs->Value('ca_nomtransportista')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura style='font-weight: bold;'>".strtoupper($rs->Value('ca_traorigen'))."</TD>";
                echo "  <TD Class=mostrar>".$rs->Value('ca_origen')." ".$rs->Value('ca_ciuorigen')."</TD>";
                echo "  <TD Class=captura style='font-weight: bold;'>".strtoupper($rs->Value('ca_tradestino'))."</TD>";
                echo "  <TD Class=mostrar>".$rs->Value('ca_destino')." ".$rs->Value('ca_ciudestino')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "<TD Class=captura style='font-weight: bold;'>Transporte:</TD>";
                echo "<TD Class=mostrar>".$rs->Value('ca_transporte')."</TD>";
                echo "<TD Class=captura style='font-weight: bold;'>Modalidad:</TD>";
                echo "<TD Class=mostrar>".$rs->Value('ca_modalidad')."</TD>";
                echo "</TR>";
                $rs->MoveNext();
                }
             echo "</TABLE><BR>";
             if (!$rs->Open("select * from vi_recargos where ca_idtrayecto = $id and ca_oid = $oid")) {  // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
			 $rs->MoveFirst();
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TH COLSPAN=6>Datos del Recargo a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>Concepto<BR><B>".$rs->Value('ca_concepto')."</B></TD>";
             echo "  <TD Class=mostrar>Recargo<BR><B>".$rs->Value('ca_recargo')."</B></TD>";
             echo "  <TD Class=mostrar>Aplicación<BR><B>".$rs->Value('ca_aplicacion')."</B></TD>";
             echo "  <TD Class=mostrar>Fecha Inicio<BR><B>".($rs->Value('ca_aplicacion')=='Temporal'?$rs->Value('ca_fchinicio'):'&nbsp;')."</B></TD>";
             echo "  <TD Class=mostrar>Vecimiento<BR><B>".($rs->Value('ca_aplicacion')=='Temporal'?$rs->Value('ca_fchvencimiento'):'&nbsp;')."</B></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Valor Fijo:<BR><B>".$rs->Value('ca_vlrfijo')."</B></TD>";
             echo "  <TD Class=mostrar>Porcentaje:<BR><B>".$rs->Value('ca_porcentaje')."%</B></TD>";
             echo "  <TD Class=mostrar>Base de Porcentaje:<BR><B>".$rs->Value('ca_baseporcentaje')."</B></TD>";
             echo "  <TD Class=mostrar>Valor Unitario:<BR><B>".$rs->Value('ca_vlrunitario')."</B></TD>";
             echo "  <TD Class=mostrar COLSPAN=2>Base de VlrUnitario:<BR><B>".$rs->Value('ca_baseunitario')."</B></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=4 ROWSPAN=2>Observaciones:<BR>".nl2br($rs->Value('ca_observaciones'))."</TD>";
             echo "  <TD Class=mostrar COLSPAN=2>Recargo Mínimo:<BR><B>".$rs->Value('ca_recargominimo')."</B></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>Moneda:<BR><B>".$rs->Value('ca_nombre')."</B></TD>";
             echo "</TR>";
			 echo "</TABLE>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"fletes.php?id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";   // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
      }
   }
elseif (isset($accion)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
    settype($vlrfijo,"double");
    settype($porcentaje,"double");
    settype($vlrunitario,"double");
    settype($recargominimo,"double");
    $fchinicio = (isset($fchinicio)?$fchinicio:date("Y-m-d"));
    $fchvencimiento = (isset($fchvencimiento)?$fchvencimiento:date("Y-m-d"));
    switch(trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Guardar': {                                                      // El Botón Guardar fue pulsado
             if (!$rs->Open("insert into tb_recargos (ca_idtrayecto, ca_idconcepto, ca_idrecargo, ca_aplicacion, ca_fchinicio, ca_fchvencimiento, ca_vlrfijo, ca_porcentaje, ca_baseporcentaje, ca_vlrunitario, ca_baseunitario, ca_recargominimo, ca_idmoneda, ca_observaciones) values($id, $idconcepto, $idrecargo, '$aplicacion', '$fchinicio', '$fchvencimiento', $vlrfijo, $porcentaje, '$baseporcentaje', $vlrunitario, '$baseunitario', $recargominimo, '$idmoneda', '$observaciones')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'fletes.php?id=$id';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             if (!$rs->Open("update tb_recargos set ca_idconcepto = $idconcepto, ca_idrecargo = $idrecargo, ca_aplicacion = '$aplicacion', ca_fchinicio = '$fchinicio', ca_fchvencimiento = '$fchvencimiento', ca_vlrfijo = $vlrfijo, ca_porcentaje = $porcentaje, ca_baseporcentaje = '$baseporcentaje', ca_vlrunitario = $vlrunitario, ca_baseunitario = '$baseunitario', ca_recargominimo = $recargominimo, ca_idmoneda = '$idmoneda', ca_observaciones = '$observaciones' where oid = $oid")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'fletes.php?id=$id';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_recargos where oid = $oid")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'fletes.php?id=$id';</script>";
                 exit;
                }
             break;
             }
        }
   echo "<script>document.location.href = 'fletes.php?id=$id';</script>";  // Retorna a la pantalla principal de la opción
   }
?>