<?
$aplicaciones = array("Permanente","Temporal");
$basesporcentaje = array("Sobre Flete","Sobre Vlr Factura");
$basesunitario = array("Unidades Peso/Volumen","Número de Piezas","Cantidad de BLs/AWBs");

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 
$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos

if (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    switch(trim($boton)) {
        case 'ModificarTarifa': {
             $modulo = "00100200";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if ($oid != 0){
                 if (!$rs->Open("select * from vi_tarifario where ca_idtrayecto = $id and ca_oid_f = $oid")) {  // Selecciona todos lo registros de la tabla Fletes
                     echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                     echo "<script>document.location.href = 'entrada.php';</script>";
                     exit; }
                 $cnp =& DlRecordset::NewRecordset($conn);
                 if (!$cnp->Open("select c.ca_idconcepto, c.ca_concepto from tb_conceptos c, tb_fletes f where c.ca_idconcepto = f.ca_idconcepto and f.oid = $oid order by ca_concepto")) { // Selecciona todos lo registros de la tabla Conceptos
                     echo "<script>alert(\"".addslashes($cnp->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                     echo "<script>document.location.href = 'uptarifario.php';</script>";
                     exit; }
                }
             else {
                 if (!$rs->Open("select t.* from vi_tarifario t RIGHT OUTER JOIN (select * from tb_fletes limit 1) y ON (null)")) {  // Selecciona todos lo registros de la tabla Fletes
                     echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                     echo "<script>document.location.href = 'entrada.php';</script>";
                     exit; }
                 $cnp =& DlRecordset::NewRecordset($conn);
                 if (!$cnp->Open("select c.ca_idconcepto, c.ca_concepto from tb_conceptos c, tb_trayectos t where t.ca_idtrayecto = $id and c.ca_transporte = t.ca_transporte and c.ca_modalidad = t.ca_modalidad and c.ca_idconcepto not in (select ca_idconcepto from tb_fletes where ca_idtrayecto = $id) order by ca_concepto")) { // Selecciona todos lo registros de la tabla Conceptos
                     echo "<script>alert(\"".addslashes($cnp->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                     echo "<script>document.location.href = 'uptarifario.php';</script>";
                     exit; }
                }
             $try =& DlRecordset::NewRecordset($conn);
             if (!$try->Open("select * from vi_trayectos where ca_idtrayecto = $ty")) {   // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($try->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'uptarifario.php';</script>";
                 exit; }
             $mon =& DlRecordset::NewRecordset($conn);
             if (!$mon->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) { // Selecciona todos lo registros de la tabla Monedas
                 echo "<script>alert(\"".addslashes($mon->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'uptarifario.php';</script>";
                 exit; }
             $rcg =& DlRecordset::NewRecordset($conn);
             if (!$rcg->Open("select ca_idrecargo, ca_recargo from tb_tiporecargo where ca_transporte = '".$try->Value('ca_transporte')."' and ca_tipo = 'Recargo en Origen' order by ca_recargo")) {   // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($rcg->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'recargos.php';</script>";
                 exit; }
             $tm =& DlRecordset::NewRecordset($conn);
             echo "<HEAD>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (document.modificar.vlrneto_f.value == '')";
             echo "      alert('El campo Tarifa Neta no es válido');";
             echo "  else if (document.modificar.vlrminimo_f.value == '')";
             echo "      alert('El campo Sugerida Venta no es válido');";
             echo "  else if (!chkDate(document.modificar.fchinicio_f))";
             echo "      document.modificar.fchinicio_f.focus();";
             echo "  else if (!chkDate(document.modificar.fchvencimiento_f))";
             echo "      document.modificar.fchvencimiento_f.focus();";
             echo "  else if (document.modificar.fchinicio_f.value >= document.modificar.fchvencimiento_f.value){";
             echo "      document.modificar.fchinicio_f.focus();";
             echo "      alert('Error en la Definición de la Vigencia');}";
             echo "  else{";
             echo "      respuesta = true;";
             echo "      elementos = document.getElementById('num_reg');";
             echo "      for (cont=0; cont<elementos.value; cont++) {";
             echo "           elemento = document.getElementById('fchinicio_' + cont);";
             echo "           if (!chkDate(elemento)){";
             echo "               elemento.focus();";
             echo "               respuesta = false;";
             echo "               break;";
             echo "              }";
             echo "           elemento = document.getElementById('fchvencimiento_' + cont);";
             echo "           if (!chkDate(elemento)){";
             echo "               elemento.focus();";
             echo "               respuesta = false;";
             echo "               break;"; 
             echo "              }";
             echo "           fch_ini = document.getElementById('fchinicio_' + cont);";
             echo "           fch_fin = document.getElementById('fchvencimiento_' + cont);";
             echo "           if (eval(fch_ini.value >= fch_fin.value) && !(fch_ini.disabled && fch_ini.disabled) ){";
             echo "               alert('¡El rango de fechas para la vigencia no es válido!');";
             echo "               fch_ini.focus();";
             echo "               respuesta = false;";
             echo "               break;"; 
             echo "              }";
             echo "          }";
             echo "      return (respuesta);";
             echo "      }";
             echo "  return (false);";
             echo "}";
             echo "function habilitar(campo){";
             echo "  cadena = campo.getAttribute('ID');";
             echo "  indice = cadena.substring(cadena.indexOf('_') + 1, cadena.length);";
             echo "  if (cadena.indexOf(\"vlrfijo\") != -1){";
             echo "      if (campo.value <= 0){";
             echo "          alert('El valor ingresado como Valor Fijo no es válido');";
             echo "          campo.focus();";
             echo "          campo.value = 0;";
             echo "          return (false); }";
             echo "      else {";
             echo "          objeto = document.getElementById('recargominimo_' + indice);";
             echo "          objeto.value = campo.value;";
             echo "          return (true); }";
             echo "      }";
             echo "  else if (cadena.indexOf(\"porcentaje\") != -1){";
             echo "      objeto = document.getElementById('baseporcentaje_' + indice);";
             echo "      if (campo.value > 0 && campo.value <= 100){";
             echo "          objeto.disabled = false;";
             echo "          objeto.focus();";
             echo "          return (true); }";
             echo "      else if (campo.value == 0){";
             echo "          campo.value = 0;";
             echo "          objeto.disabled = true;";
             echo "          return (true); }";
             echo "      else {";
             echo "          objeto.disabled = true;";
             echo "          alert('El valor ingresado como Porcentaje no es válido');";
             echo "          campo.focus();";
             echo "          return (false); }";
             echo "      }";
             echo "  else if (cadena.indexOf(\"vlrunitario\") != -1){";
             echo "      objeto = document.getElementById('baseunitario_' + indice);";
             echo "      if (campo.value > 0){";
             echo "          objeto.disabled = false;";
             echo "          objeto.focus();";
             echo "          return (true); }";
             echo "      else if (campo.value == 0){";
             echo "          campo.value = 0;";
             echo "          objeto.disabled = true;";
             echo "          return (true); }";
             echo "      else {";
             echo "          objeto.disabled = true;";
             echo "          alert('El valor ingresado como Valor Unitario no es válido');";
             echo "          campo.focus();";
             echo "          return (false); }";
             echo "      }";
             echo "  else if (cadena.indexOf(\"aplicacion\") != -1){";
             echo "      objeto_1 = document.getElementById('fchinicio_' + indice);";
             echo "      objeto_2 = document.getElementById('fchvencimiento_' + indice);";
             echo "      if (campo.value == 'Temporal'){";
             echo "          objeto_1.disabled = false;";
             echo "          objeto_2.disabled = false;";
             echo "          objeto_1.focus();";
             echo "          return (true); }";
             echo "      else {";
             echo "          objeto_1.disabled = true;";
             echo "          objeto_2.disabled = true;";
             echo "          return (true); }";
             echo "      }";
             echo "  else if (cadena.indexOf(\"recargominimo\") != -1){";
             echo "      objeto_1 = document.getElementById('vlrfijo_' + indice);";
             echo "      objeto_2 = document.getElementById('porcentaje_' + indice);";
             echo "      objeto_3 = document.getElementById('vlrunitario_' + indice);";
             echo "      if ((objeto_1.value == '' || objeto_1.value <= 0) && (objeto_2.value == '' || objeto_2.value <= 0) && (objeto_3.value == '' || objeto_3.value <= 0)){";
             echo "          alert('Debe especificar un valor fijo, porcentaje o valor unitario para el Recargo');";
             echo "          objeto_1.focus();";
             echo "          return (false); }";
             echo "      else {";
             echo "          return (true); }";
             echo "      }";
             echo "}";
             echo "function sincronizar(fuente){";
             echo "  for (cont=0; cont<modificar.elements.length; cont++) {";
             echo "      if (modificar.elements[cont].type == \"select-one\"){"; // && (modificar.elements[cont].getAttribute('ID')).indexOf(\"idconcepto\") != -1
             echo "          elemento = modificar.elements[cont].name;";
             echo "          if (elemento.indexOf(\"idconcepto\") != -1){";
             echo "              modificar.elements[cont].selectedIndex = fuente.selectedIndex;";
             echo "             }";
             echo "         }";
             echo "      }";
             echo "}";
             echo "function elegir(opcion, id){";
             echo "  if (confirm(\"¿Esta Seguro que desea eliminar el Registro?\")) {";
             echo "      location.href = 'uptarifario.php?accion='+opcion+'\&id='+id;";
             echo "     }";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<FORM METHOD=post NAME='modificar' ACTION='uptarifario.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='ty' VALUE=".$ty.">";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='oid_f' VALUE=".$oid.">";            // Hereda el Id del registro que se esta modificando
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                echo "<TR><TD>";
                echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=4 style='font-size: 12px; font-weight:bold;'>SISTEMA TARIFARIO</TH>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=invertir style='font-size: 14px; font-weight:bold;' COLSPAN=4>".$try->Value('ca_nombre')." [".$try->Value('ca_idtrayecto')."]</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar ROWSPAN=3><B>".strtoupper($try->Value('ca_traorigen'))."</B></TD>";
                echo "  <TD Class=listar style='font-size: 11px; font-weight:bold;'>".$try->Value('ca_origen')."-".$try->Value('ca_ciuorigen')."</TD>";
                echo "  <TD Class=listar ROWSPAN=3><B>".strtoupper($try->Value('ca_tradestino'))."</B></TD>";
                echo "  <TD Class=listar style='font-size: 11px; font-weight:bold;'>".$try->Value('ca_destino')."-".$try->Value('ca_ciudestino')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar><B>Transporte: </B>".$try->Value('ca_transporte')."</TD>";
                echo "  <TD Class=listar><B>Modalidad: </B>".$try->Value('ca_modalidad')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar>Frecuencia: <INPUT TYPE='TEXT' NAME='frecuencia' VALUE='".$try->Value('ca_frecuencia')."' SIZE=19 MAXLENGTH=20></TD>";
                echo "  <TD Class=listar>Tiempo/Transito: <INPUT TYPE='TEXT' NAME='tiempotransito' VALUE='".$try->Value('ca_tiempotransito')."' SIZE=19 MAXLENGTH=25></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar>Observaciones: </TD>";
                echo "  <TD Class=listar COLSPAN=3><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=3 COLS=95>".$try->Value('ca_observaciones')."</TEXTAREA></TD>";
                echo "</TR>";
                echo "</TABLE>";                                    // un boton de comando definido para hacer mantemientos
                echo "</TD></TR>";

                $editar = ($oid!=0)?" ":"style='visibility:hidden;'";
                echo "<TR><TD>";
                echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
                echo "<TH COLSPAN=6 style='font-size: 10px; font-weight:bold;'>Nuevos Datos para la Tarifa</TH>";
                echo "<TR>";
                echo "  <TD Class=invertir COLSPAN=4><B>Seleccione un producto:</B><BR><SELECT NAME='idconcepto_f' ONCHANGE='sincronizar(this);'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
                if ($oid != 0){
                    echo "<OPTION VALUE=".$rs->Value('ca_idconcepto')." SELECTED>".$rs->Value('ca_concepto')."</OPTION>";
                    }
                else {
                    $cnp->MoveFirst();
                    while (!$cnp->Eof()) {
                        echo "<OPTION VALUE=".$cnp->Value('ca_idconcepto').">".$cnp->Value('ca_concepto')."</OPTION>";
                        $cnp->MoveNext();
                        }
                    }
                echo "  </SELECT></TD>";
                list($anno, $mes, $dia) = sscanf($rs->Value('ca_fchinicio_f'),"%d-%d-%d");
                $ini_mem = (checkdate($mes, $dia, $anno))?$rs->Value('ca_fchinicio_f'):date(date("Y")."-".date("m")."-"."01");
                list($anno, $mes, $dia) = sscanf($rs->Value('ca_fchvencimiento_f'),"%d-%d-%d");
                $ven_mem = (checkdate($mes, $dia, $anno))?$rs->Value('ca_fchvencimiento_f'):date( "Y-m-d", mktime(0,0,0,date("m")+1,0,date("Y")));
                echo "  <TD Class=mostrar style='text-align: center;'><B>Inicio Vigencia:</B><BR><INPUT TYPE='TEXT' NAME='fchinicio_f' SIZE=12 VALUE='".$ini_mem."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "  <TD Class=mostrar style='text-align: center;'><B>Final Vigencia:</B><BR><INPUT TYPE='TEXT' NAME='fchvencimiento_f' SIZE=12 VALUE='".$ven_mem."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar WIDTH=50></TD>";
                echo "  <TD Class=mostrar>Tarifa Neta:<BR><INPUT TYPE='TEXT' NAME='vlrneto_f' VALUE=".sprintf ("%01.2f", $rs->Value('ca_vlrneto'))." SIZE=17 MAXLENGTH=15 ONCHANGE='javascript:vlrminimo_f.value=this.value;fleteminimo_f.value=this.value;'></TD>";
                echo "  <TD Class=mostrar>Sugerida Venta:<BR><INPUT TYPE='TEXT' NAME='vlrminimo_f' VALUE=".sprintf ("%01.2f", $rs->Value('ca_vlrminimo'))." SIZE=17 MAXLENGTH=15 ONCHANGE='javascript:fleteminimo_f.value=this.value;'></TD>";
                echo "  <TD Class=mostrar>Flete Mínimo:<BR><INPUT TYPE='TEXT' NAME='fleteminimo_f' VALUE='".sprintf ("%01.2f", $rs->Value('ca_fleteminimo'))."' SIZE=17 MAXLENGTH=15></TD>";
                echo "  <TD Class=mostrar>Moneda:<BR><SELECT NAME='idmoneda_f'>";            // Llena el cuadro de lista con los valores de la tabla Monedas
                $mon->MoveFirst();
                while (!$mon->Eof()) {
                    echo "<OPTION VALUE=".$mon->Value('ca_idmoneda');
                    if ($mon->Value('ca_idmoneda')==$rs->Value('ca_idmoneda_f')) {
                        echo" SELECTED"; }
                    echo ">".$mon->Value('ca_nombre')."</OPTION>";
                    $mon->MoveNext();
                    }
                echo "  </SELECT></TD>";
                echo "  <TD Class=mostrar ROWSPAN=2><DIV $editar>Eliminar Tarifa:</DIV><CENTER><IMG src='./graficos/del.gif' $editar alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar_Tarifa\", \"".$rs->Value('ca_oid_f')."\");'></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar WIDTH=50></TD>";
                echo "  <TD Class=mostrar COLSPAN=4>Observaciones:<BR><INPUT TYPE='TEXT' NAME='observaciones_f' VALUE='".$rs->Value('ca_observaciones_f')."' SIZE=84 MAXLENGTH=250></TD>";
                echo "</TR>";
                echo "</TABLE>";
                echo "</TD></TR>";
                $j = 0;
                echo "<TD><TR>";
                echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
                echo "<TH COLSPAN=6 style='font-size: 10px; font-weight:bold;'>Nuevos Datos para el Recargo</TH>";
                do {
                    echo "<INPUT TYPE='HIDDEN' NAME='oid_r[]' VALUE=".$rs->Value('ca_oid_r').">";
                    echo "<TR>";
                    echo "  <TD Class=invertir COLSPAN=2>Concepto<BR><SELECT ID=idconcepto_$j NAME='reg_".$rs->Value('ca_oid_r')."[idconcepto]'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
                    $cnp->MoveFirst();
                    while (!$cnp->Eof()) {
                           echo "<OPTION VALUE=".$cnp->Value('ca_idconcepto');
                           if ($cnp->Value('ca_idconcepto')==$rs->Value('ca_idconcepto')) {
                               echo" SELECTED"; }
                           echo ">".$cnp->Value('ca_concepto')."</OPTION>";
                           $cnp->MoveNext(); }
                    echo "  <OPTION VALUE=9999 ".(($rs->Value('ca_idaplicacion')=='9999')?" SELECTED":"").">Recargo General Para Tráfico</OPTION>";
                    echo "  </SELECT></TD>";
                    echo "  <TD Class=invertir COLSPAN=2>Recargo<BR><SELECT ID=idrecargo_$j NAME='reg_".$rs->Value('ca_oid_r')."[idrecargo]'>";           // Llena el cuadro de lista con los valores de la tabla Recaergos
                    $rcg->MoveFirst();
                    while (!$rcg->Eof()) {
                           echo "<OPTION VALUE=".$rcg->Value('ca_idrecargo');
                           if ($rcg->Value('ca_idrecargo')==$rs->Value('ca_idrecargo')) {
                               echo" SELECTED"; }
                           echo ">".$rcg->Value('ca_recargo')."</OPTION>";
                           $rcg->MoveNext(); }
                    echo "  </SELECT></TD>";
                    echo "  <TD Class=invertir>Moneda:<BR><SELECT ID=idmoneda_$j NAME='reg_".$rs->Value('ca_oid_r')."[idmoneda]'>";            // Llena el cuadro de lista con los valores de la tabla Monedas
                    $mon->MoveFirst();
                    while (!$mon->Eof()) {
                           echo "<OPTION VALUE=".$mon->Value('ca_idmoneda');
                           if ($mon->Value('ca_idmoneda')==$rs->Value('ca_idmoneda_r')) {
                               echo" SELECTED"; }
                           echo ">".$mon->Value('ca_nombre')."</OPTION>";
                           $mon->MoveNext(); }
                    echo "  </SELECT></TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=invertir>Valor Fijo:<BR><INPUT ID=vlrfijo_$j TYPE='TEXT' NAME='reg_".$rs->Value('ca_oid_r')."[vlrfijo]' VALUE=".sprintf ("%01.2f", $rs->Value('ca_vlrfijo'))." SIZE=17 MAXLENGTH=15 ONCHANGE='habilitar(this);'></TD>";
                    echo "  <TD Class=invertir>Porcentaje:<BR><INPUT ID=porcentaje_$j TYPE='TEXT' NAME='reg_".$rs->Value('ca_oid_r')."[porcentaje]' VALUE=".sprintf ("%01.2f", $rs->Value('ca_porcentaje'))." SIZE=6 MAXLENGTH=5 ONBLUR='habilitar(this);'>%</TD>";
                    echo "  <TD Class=invertir>Base de Porcentaje:<BR><SELECT ID=baseporcentaje_$j ".($rs->Value('ca_porcentaje')==0?'DISABLED':'')." NAME='reg_".$rs->Value('ca_oid_r')."[]'>";
                    for ($i=0; $i < count($basesporcentaje); $i++) {
                         echo " <OPTION VALUE='".$basesporcentaje[$i]."'";
                         if ($rs->Value('ca_baseporcentaje')==$basesporcentaje[$i]) {
                             echo " SELECTED"; }
                         echo ">".$basesporcentaje[$i]; }
                    echo "  <TD Class=invertir>Valor Unitario:<BR><INPUT ID=vlrunitario_$j TYPE='TEXT' NAME='reg_".$rs->Value('ca_oid_r')."[vlrunitario]' VALUE=".sprintf ("%01.2f", $rs->Value('ca_vlrunitario'))." SIZE=17 MAXLENGTH=15 ONBLUR='habilitar(this);'></TD>";
                    echo "  <TD Class=invertir>Base de VlrUnitario:<BR><SELECT ID=baseunitario_$j ".($rs->Value('ca_vlrunitario')==0?'DISABLED':'')." NAME='reg_".$rs->Value('ca_oid_r')."[baseunitario]'>";
                    for ($i=0; $i < count($basesunitario); $i++) {
                         echo " <OPTION VALUE='".$basesunitario[$i]."'";
                         if ($rs->Value('ca_baseunitario')==$basesunitario[$i]) {
                             echo " SELECTED"; }
                         echo ">".$basesunitario[$i]; }
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=invertir>Aplicación:<BR><SELECT ID=aplicacion_$j NAME='reg_".$rs->Value('ca_oid_r')."[aplicacion]' ONCHANGE='habilitar(this);'>";
                    for ($i=0; $i < count($aplicaciones); $i++) {
                         echo " <OPTION VALUE='".$aplicaciones[$i]."'";
                         if ($rs->Value('ca_aplicacion')==$aplicaciones[$i]) {
                             echo " SELECTED"; }
                         echo ">".$aplicaciones[$i]; }
                    echo "  </SELECT></TD>";

                    list($anno, $mes, $dia) = sscanf($rs->Value('ca_fchinicio_r'),"%d-%d-%d");
                    $ini_mem = (checkdate($mes, $dia, $anno))?$rs->Value('ca_fchinicio_r'):date(date("Y")."-".date("m")."-"."01");
                    list($anno, $mes, $dia) = sscanf($rs->Value('ca_fchvencimiento_r'),"%d-%d-%d");
                    $ven_mem = (checkdate($mes, $dia, $anno))?$rs->Value('ca_fchvencimiento_r'):date( "Y-m-d", mktime(0,0,0,date("m")+1,0,date("Y")));
                    echo "  <TD Class=invertir>Inicio<BR><INPUT ID=fchinicio_$j TYPE='TEXT' ".($rs->Value('ca_aplicacion')!='Temporal'?'DISABLED':'')." NAME='reg_".$rs->Value('ca_oid_r')."[fchinicio]' SIZE=12 VALUE='".$ini_mem."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                    echo "  <TD Class=invertir>Vencimiento<BR><INPUT ID=fchvencimiento_$j TYPE='TEXT' ".($rs->Value('ca_aplicacion')!='Temporal'?'DISABLED':'')." NAME='reg_".$rs->Value('ca_oid_r')."[fchvencimiento]' SIZE=12 VALUE='".$ven_mem."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                    echo "  <TD Class=invertir>Recargo Mínimo:<BR><INPUT ID=recargominimo_$j TYPE='TEXT' NAME='reg_".$rs->Value('ca_oid_r')."[recargominimo]' ONBLUR='habilitar(this);' VALUE=".sprintf ("%01.2f", $rs->Value('ca_recargominimo'))." SIZE=17 MAXLENGTH=15></TD>";
                    echo "  <TD Class=invertir><DIV $editar>Eliminar el Recargo :</DIV><CENTER><IMG src='./graficos/del.gif' $editar alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar_Recargo\", \"".$rs->Value('ca_oid_r')."\");'></TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=invertir COLSPAN=5>Observaciones:<BR><TEXTAREA ID=observaciones_$j NAME='reg_".$rs->Value('ca_oid_r')."[observaciones]' WRAP=virtual ROWS=3 COLS=113>".$rs->Value('ca_observaciones_r')."</TEXTAREA></TD>";
                    echo "</TR>";
                    echo "<TR HEIGHT=5>";
                    echo "  <TD Class=titulo COLSPAN=6></TD>";
                    echo "</TR>";
                    $rs->MoveNext();
                    $j++;
                  } while($rs->Value('ca_oid_f') == $oid and !$rs->Eof());

                echo "</TABLE><BR>";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.update_tarifario.style.visibility = \"hidden\"; window.parent.document.body.scroll=\"yes\";'></TH>";  // Cancela la operación
                echo "</TABLE>";
                echo "<BR><BR>";                
                echo "<TABLE WIDTH=600 CELLSPACING=1 style='background: #D2D2D2'>";
                echo "<TH COLSPAN=6 style='font-size: 10px; font-weight:bold;'>Nuevos Recargos</TH>";
                $z = $j;
                do {
                    echo "<INPUT TYPE='HIDDEN' NAME='oid_r[]' VALUE=nuevo_$z>";
                    echo "<TR>";
                    echo "  <TD Class=imprimir COLSPAN=2>Concepto<BR><SELECT NAME='reg_nuevo_".$z."[idconcepto]'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
                    $cnp->MoveFirst();
                    while (!$cnp->Eof()) {
                           echo "<OPTION VALUE=".$cnp->Value('ca_idconcepto');
                           if ($cnp->Value('ca_idconcepto')==$rs->Value('ca_idconcepto')) {
                               echo" SELECTED"; }
                           echo ">".$cnp->Value('ca_concepto')."</OPTION>";
                           $cnp->MoveNext(); }
                    echo "  <OPTION VALUE=9999>Recargo General Para Tráfico</OPTION>";
                    echo "  </SELECT></TD>";
                    $rcg->MoveFirst();
                    echo "  <TD Class=imprimir COLSPAN=2>Recargo<BR><SELECT ID=idrecargo_$z NAME='reg_nuevo_".$z."[idrecargo]'>";           // Llena el cuadro de lista con los valores de la tabla Recargos
                    while (!$rcg->Eof()) {
                           echo "<OPTION VALUE=".$rcg->Value('ca_idrecargo').">".$rcg->Value('ca_recargo')."</OPTION>";
                           $rcg->MoveNext(); }
                    echo "  </SELECT></TD>";
                    echo "  <TD Class=imprimir>Moneda:<BR><SELECT ID=idmoneda_$z NAME='reg_nuevo_".$z."[idmoneda]'>";            // Llena el cuadro de lista con los valores de la tabla Monedas
                    $mon->MoveFirst();
                    while (!$mon->Eof()) {
                           echo "<OPTION VALUE=".$mon->Value('ca_idmoneda').">".$mon->Value('ca_nombre')."</OPTION>";
                           $mon->MoveNext(); }
                    echo "  </SELECT></TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=imprimir>Valor Fijo:<BR><INPUT ID=vlrfijo_$z TYPE='TEXT' NAME='reg_nuevo_".$z."[vlrfijo]' VALUE=0 SIZE=17 MAXLENGTH=15 ONCHANGE='habilitar(this);'></TD>";
                    echo "  <TD Class=imprimir>Porcentaje:<BR><INPUT ID=porcentaje_$z TYPE='TEXT' NAME='reg_nuevo_".$z."[porcentaje]' VALUE=0 SIZE=6 MAXLENGTH=5 ONBLUR='habilitar(this);'>%</TD>";
                    echo "  <TD Class=imprimir>Base de Porcentaje:<BR><SELECT ID=baseporcentaje_$z DISABLED NAME='reg_nuevo_".$z."[baseporcentaje]'>";
                    for ($i=0; $i < count($basesporcentaje); $i++) {
                         echo " <OPTION VALUE='".$basesporcentaje[$i]."'>".$basesporcentaje[$i]; }
                    echo "  </SELECT></TD>";
                    echo "  <TD Class=imprimir>Valor Unitario:<BR><INPUT ID=vlrunitario_$z TYPE='TEXT' NAME='reg_nuevo_".$z."[vlrunitario]' VALUE=0 SIZE=17 MAXLENGTH=15 ONBLUR='habilitar(this);'></TD>";
                    echo "  <TD Class=imprimir>Base de VlrUnitario:<BR><SELECT ID=baseunitario_$z DISABLED NAME='reg_nuevo_".$z."[baseunitario]'>";
                    for ($i=0; $i < count($basesunitario); $i++) {
                         echo " <OPTION VALUE='".$basesunitario[$i]."'".">".$basesunitario[$i]; }
                    echo "  </SELECT></TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=imprimir>Aplicación:<BR><SELECT ID=aplicacion_$z NAME='reg_nuevo_".$z."[aplicacion]' ONCHANGE='habilitar(this);'>";
                    for ($i=0; $i < count($aplicaciones); $i++) {
                         echo " <OPTION VALUE='".$aplicaciones[$i]."'>".$aplicaciones[$i]; }
                    echo "  </SELECT></TD>";
                    echo "  <TD Class=imprimir>Inicio<BR><INPUT ID=fchinicio_$z TYPE='TEXT' DISABLED NAME='reg_nuevo_".$z."[fchinicio]' VALUE='".date(date("Y")."-".date("m")."-"."01")."' SIZE=12 ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                    echo "  <TD Class=imprimir>Vencimiento<BR><INPUT ID=fchvencimiento_$z TYPE='TEXT' DISABLED NAME='reg_nuevo_".$z."[fchvencimiento]' VALUE='".date( "Y-m-d", mktime(0,0,0,date("m")+1,0,date("Y")))."' SIZE=12 ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                    echo "  <TD Class=imprimir>Recargo Mínimo:<BR><INPUT ID=recargominimo_$z TYPE='TEXT' NAME='reg_nuevo_".$z."[recargominimo]' ONBLUR='habilitar(this);' SIZE=17 MAXLENGTH=15></TD>";
                    echo "  <TD Class=imprimir></TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=imprimir COLSPAN=5>Observaciones:<BR><TEXTAREA ID=observaciones_$z NAME='reg_nuevo_".$z."[observaciones]' WRAP=virtual ROWS=3 COLS=113></TEXTAREA></TD>";
                    echo "</TR>";
                    echo "<TR HEIGHT=5>";
                    echo "  <TD Class=titulo COLSPAN=6></TD>";
                    echo "</TR>";
                    $z++;
                  } while($z < ($j + 5));
                echo "<INPUT ID=num_reg TYPE='HIDDEN' NAME='num_reg' VALUE=".$z.">";              // Hereda el Id del registro que se esta modificando

                echo "</TABLE>";
                echo "</TD></TR>";
               }
          echo "</FORM>";
          echo "</CENTER>";
//        echo"<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
          require_once("footer.php");
echo "</BODY>";
          break;
         }
        case 'SugerirTarifa': {
             if (!$rs->Open("select * from vi_trayectos where ca_origen = (select ca_origen from tb_trayectos where ca_idtrayecto = $id) and ca_destino = (select ca_destino from tb_trayectos where ca_idtrayecto = $id)")) {          // Selecciona todos lo registros de la tabla Grupos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $modulo = "00100200";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             echo "<HEAD>";
             echo "<TITLE>Registrar Tarifas Sugeridas</TITLE>";
             echo "</HEAD>";
             echo "<BODY onscroll='dalt=document.body.scrollTop+3 ; update_tarifario.style.top=dalt'>";
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>Registrar Tarifas Sugeridas</H3>";
             echo "<FORM METHOD=post NAME='consultar' ACTION='uptarifario.php'>";// Crea una forma con datos vacios
             echo "<TABLE WIDTH=645 CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=2>Datos Generales del Tráfico</TH>";
             echo "<TR>";
             echo "  <TD Class=listar style='text-align:center;'><B>".strtoupper($rs->Value('ca_traorigen'))."</B><BR>&nbsp</TD>";
             echo "  <TD Class=listar style='text-align:center;'><B>".strtoupper($rs->Value('ca_tradestino'))."</B><BR>&nbsp</TD>";
             echo "</TR>";
             echo "</TABLE>";
             echo "<TABLE WIDTH=600 CELLSPACING=1>";
             $tr =& DlRecordset::NewRecordset($conn);                     // Apuntador que permite manejar la conexiòn a la base de datos
             while (!$rs->Eof() and !$rs->IsEmpty()) {                    // Lee la totalidad de los registros obtenidos en la instrucción Select
                if (!$tr->Open("select * from vi_tarifario where ca_idtrayecto = ".$rs->Value('ca_idtarifas'))) {                              // Selecciona todos lo registros de la tabla Agentes
                    echo "<script>alert(\"".addslashes($tr->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                $tr->MoveFirst();
                $con_tit = '';
                echo "<TR>";
                echo "  <TD Class=invertir style='font-weight:bold; font-size: 11px;' COLSPAN=2>".$rs->Value('ca_ciuorigen')." - ".$rs->Value('ca_ciudestino')." (".$rs->Value('ca_nombre').")</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar style='font-weight:bold; font-size: 8px;' WIDTH=100><B>Frecuencia:</B><CENTER>".$rs->Value('ca_frecuencia')."</CENTER><B>T/Transito:</B><BR><CENTER>".$rs->Value('ca_tiempotransito')."</CENTER><B>Modalidad:</B><BR><CENTER>".$rs->Value('ca_modalidad')."</CENTER><B>Observaciones:</B><BR>".$rs->Value('ca_observaciones')."</TD>";
                echo "  <TD Class=invertir><TABLE WIDTH=545 CELLSPACING=1 style='letter-spacing:-1px;'><TD Class=titulo WIDTH=70>Concepto</TD><TD Class=titulo WIDTH=70>Flete</TD><TD Class=titulo WIDTH=70>Flt.Mínimo</TD><TD Class=titulo WIDTH=70>Recargos</TD><TD Class=titulo WIDTH=70>Valor</TD><TD Class=titulo WIDTH=70>Rec.Mínimo</TD><TD Class=titulo>Sugerir</TD>";
                while (!$tr->Eof() and !$tr->IsEmpty()) {                          // Lee la totalidad de los registros obtenidos en la instrucción Select
                    echo "<TR>";
                    if ($con_tit != $tr->Value('ca_concepto')) {
                        echo "  <TD Class=listar style='text-align:left; font-weight:bold;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='actualizacion(\"update_tarifario\", \"ModificarTarifa\", ".$tr->Value('ca_idtrayecto').", ".$tr->Value('ca_oid_f').");'>".$tr->Value('ca_concepto')."</TD>";
                        echo "  <TD Class=listar style='text-align:right; font-size: 9px;'>".sprintf ("%01.2f", $tr->Value('ca_vlrneto'))." ".$tr->Value('ca_idmoneda_f')."</TD>";
                        echo "  <TD Class=listar style='text-align:right'>".sprintf ("%01.2f", $tr->Value('ca_fleteminimo'))." ".$tr->Value('ca_idmoneda_f')."</TD>";
                        $obs_fle = $tr->Value('ca_observaciones_f');
                        $con_tit = $tr->Value('ca_concepto');
                        $bot_mem = true;
                        }
                    else {
                        echo "  <TD Class=listar COLSPAN=3>$obs_fle</TD>";
                        $obs_fle = '';}
                    echo "  <TD Class=listar style='text-align:left; font-weight:bold;'>".$tr->Value('ca_recargo')."</TD>";
                    if ($tr->Value('ca_vlrfijo') != 0) {
                        echo "  <TD Class=listar style='text-align:right;'>".sprintf ("%01.2f", $tr->Value('ca_vlrfijo'))." ".$tr->Value('ca_idmoneda_r')."</TD>"; }
                    else if ($tr->Value('ca_porcentaje') != 0) {
                        echo "  <TD Class=listar style='text-align:right;'>% ".sprintf ("%01.2f", $tr->Value('ca_porcentaje'))."</TD>"; }
                    else if ($tr->Value('ca_vlrunitario') != 0) {
                        echo "  <TD Class=listar style='text-align:right;'>".sprintf ("%01.2f", $tr->Value('ca_vlrunitario'))." ".$tr->Value('ca_idmoneda_r')."</TD>"; }
                    else {
                        echo "  <TD Class=listar style='text-align:right;'>".sprintf ("%01.2f", $tr->Value('ca_recargominimo'))." ".$tr->Value('ca_idmoneda_r')."</TD>"; }
                    echo "  <TD Class=listar style='text-align:right;'>".sprintf ("%01.2f", $tr->Value('ca_recargominimo'))." ".$tr->Value('ca_idmoneda_r')."</TD>";
                    echo "  <TD Class=listar style='text-align:center;' WIDTH=30>";
                    if ($bot_mem) {
                        echo "<INPUT TYPE='HIDDEN' NAME='tarifas[]' VALUE='".$tr->Value('ca_oid_f')."'>";
                        echo "<INPUT TYPE=CHECKBOX NAME='sugeridas[]' ".(($tr->Value('ca_sugerida')!='')?" CHECKED":"")." VALUE=".$tr->Value('ca_oid_f').">";
                        $bot_mem = false;
                        }
                    echo "  </TD>"; // Cuadro de chequeo para seleccionar el registro
                    echo "</TR>";
                    $tr->MoveNext();
                    }
                echo "  </TABLE></TD>";
                echo "</TR>";
                $rs->MoveNext();
                }
            echo "</TABLE><BR>";
            echo "<TABLE CELLSPACING=10>";
            echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Registrar'></TH>";  // Ordena que se actualice el registro
            echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.update_tarifario.style.visibility = \"hidden\"; window.parent.document.body.scroll=\"yes\";'></TH>";  // Cancela la operación
            echo "</TABLE>";
          break;
         }
        case 'AMantenimiento': {
             if (!$rs->Open("select * from vi_trayectos where ca_idtraorigen in (select ca_idtraorigen from vi_trayectos t where t.ca_idtrayecto = $id) and ca_idtradestino = (select ca_idtradestino from vi_trayectos t where t.ca_idtrayecto = $id) and ca_idtransportista = (select ca_idtransportista from vi_trayectos where ca_idtrayecto = $id)")) {          // Selecciona todos lo registros de la tabla Grupos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $modulo = "00100200";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             echo "<HEAD>";
             echo "<TITLE>Tarifas a Mantenimiento</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function marcar(fuente){";
             echo "  for (cont=0; cont<consultar.elements.length; cont++) {";
             echo "      if (consultar.elements[cont].type == \"checkbox\"){"; // && (modificar.elements[cont].getAttribute('ID')).indexOf(\"idconcepto\") != -1
             echo "          elemento = consultar.elements[cont].name;";
             echo "          if (elemento.indexOf(\"mantenimiento\") != -1){";
             echo "              consultar.elements[cont].checked = fuente.checked;";
             echo "             }";
             echo "         }";
             echo "      }";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>Tarifas a Mantenimiento</H3>";
             echo "<FORM METHOD=post NAME='consultar' ACTION='uptarifario.php'>";// Crea una forma con datos vacios
             echo "<TABLE WIDTH=600 CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=3>Datos Generales del Tráfico</TH>";
             echo "<TR>";
             echo "  <TD Class=listar style='text-align:center; font-weight:bold;'>".strtoupper($rs->Value('ca_traorigen'))."</B><BR>&nbsp</TD>";
             echo "  <TD Class=listar style='text-align:center; font-weight:bold;'>Trayecto a Mantenimiento<BR><INPUT TYPE=CHECKBOX NAME='para_mantenimiento' ONCLICK='marcar(this);'></TD>";
             echo "  <TD Class=listar style='text-align:center; font-weight:bold;'>".strtoupper($rs->Value('ca_tradestino'))."</B><BR>&nbsp</TD>";
             echo "</TR>";
             echo "</TABLE>";
             echo "<TABLE WIDTH=600 CELLSPACING=1>";
             $tr =& DlRecordset::NewRecordset($conn);                     // Apuntador que permite manejar la conexiòn a la base de datos
             set_time_limit(180);
             while (!$rs->Eof() and !$rs->IsEmpty()) {                    // Lee la totalidad de los registros obtenidos en la instrucción Select
                if (!$tr->Open("select * from vi_tarifario where ca_idtrayecto = ".$rs->Value('ca_idtarifas'))) {                              // Selecciona todos lo registros de la tabla Agentes
                    echo "<script>alert(\"".addslashes($tr->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                $tr->MoveFirst();
                $con_tit = '';
                echo "<TR>";
                echo "  <TD Class=invertir style='font-weight:bold; font-size: 11px;' COLSPAN=2>".$rs->Value('ca_ciuorigen')." - ".$rs->Value('ca_ciudestino')." (".$rs->Value('ca_nombre').")</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar style='font-weight:bold; font-size: 8px;' WIDTH=100><B>Frecuencia:</B><CENTER>".$rs->Value('ca_frecuencia')."</CENTER><B>T/Transito:</B><BR><CENTER>".$rs->Value('ca_tiempotransito')."</CENTER><B>Modalidad:</B><BR><CENTER>".$rs->Value('ca_modalidad')."</CENTER><B>Observaciones:</B><BR>".$rs->Value('ca_observaciones')."</TD>";
                echo "  <TD Class=invertir><TABLE WIDTH=500 CELLSPACING=1 style='letter-spacing:-1px;'><TD Class=titulo WIDTH=50>Concepto</TD><TD Class=titulo WIDTH=50>Flete</TD><TD Class=titulo WIDTH=50>Flt.Mínimo</TD><TD Class=titulo WIDTH=50>Recargos</TD><TD Class=titulo WIDTH=50>Valor</TD><TD Class=titulo WIDTH=50>Rec.Mínimo</TD><TD Class=titulo>Mantener</TD>";
                while (!$tr->Eof() and !$tr->IsEmpty()) {                          // Lee la totalidad de los registros obtenidos en la instrucción Select
                    echo "<TR>";
                    if ($con_tit != $tr->Value('ca_concepto')) {
                        echo "  <TD Class=listar style='text-align:left; font-weight:bold;'>".$tr->Value('ca_concepto')."</TD>";
                        echo "  <TD Class=listar style='text-align:right; font-size: 9px;'>".sprintf ("%01.2f", $tr->Value('ca_vlrneto'))." ".$tr->Value('ca_idmoneda_f')."</TD>";
                        echo "  <TD Class=listar style='text-align:right'>".sprintf ("%01.2f", $tr->Value('ca_fleteminimo'))." ".$tr->Value('ca_idmoneda_f')."</TD>";
                        $obs_fle = $tr->Value('ca_observaciones_f');
                        $con_tit = $tr->Value('ca_concepto');
                        $bot_mem = true;
                        }
                    else {
                        echo "  <TD Class=listar COLSPAN=3>$obs_fle</TD>";
                        $obs_fle = '';}
                    echo "  <TD Class=listar style='text-align:left; font-weight:bold;'>".$tr->Value('ca_recargo')."</TD>";
                    if ($tr->Value('ca_vlrfijo') != 0) {
                        echo "  <TD Class=listar style='text-align:right;'>".sprintf ("%01.2f", $tr->Value('ca_vlrfijo'))." ".$tr->Value('ca_idmoneda_r')."</TD>"; }
                    else if ($tr->Value('ca_porcentaje') != 0) {
                        echo "  <TD Class=listar style='text-align:right;'>% ".sprintf ("%01.2f", $tr->Value('ca_porcentaje'))."</TD>"; }
                    else if ($tr->Value('ca_vlrunitario') != 0) {
                        echo "  <TD Class=listar style='text-align:right;'>".sprintf ("%01.2f", $tr->Value('ca_vlrunitario'))." ".$tr->Value('ca_idmoneda_r')."</TD>"; }
                    else {
                        echo "  <TD Class=listar style='text-align:right;'>".sprintf ("%01.2f", $tr->Value('ca_recargominimo'))." ".$tr->Value('ca_idmoneda_r')."</TD>"; }
                    echo "  <TD Class=listar style='text-align:right;'>".sprintf ("%01.2f", $tr->Value('ca_recargominimo'))." ".$tr->Value('ca_idmoneda_r')."</TD>";
                    echo "  <TD Class=listar style='text-align:center;' WIDTH=35>";
                    if ($bot_mem) {
                        echo "<INPUT TYPE='HIDDEN' NAME='tarifas[]' VALUE='".$tr->Value('ca_oid_f')."'>";
                        echo "<INPUT TYPE=CHECKBOX NAME='mantenimientos[]' ".(($tr->Value('ca_mantenimiento')!='')?" CHECKED":"")." VALUE=".$tr->Value('ca_oid_f').">";
                        $bot_mem = false;
                        }
                    echo "  </TD>"; // Cuadro de chequeo para seleccionar el registro
                    echo "</TR>";
                    $tr->MoveNext();
                    }
                echo "  </TABLE></TD>";
                echo "</TR>";
                $rs->MoveNext();
                }
            echo "</TABLE><BR>";
            echo "<TABLE CELLSPACING=10>";
            echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='A_Mantenimiento'></TH>";  // Ordena que se actualice el registro
            echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.update_tarifario.style.visibility = \"hidden\"; window.parent.document.body.scroll=\"yes\";'></TH>";  // Cancela la operación
            echo "</TABLE>";
          break;
         }
        case 'EliminarTrayecto': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "window.parent.frames.update_tarifario.style.visibility = \"hidden\";";
             echo "if (confirm(\"¿Esta seguro que desea Borrar el Trayecto?\")) {";
             echo "    location.href = 'uptarifario.php?accion=Eliminar&id=".$ty."';";
             echo "   }";
             echo "</script>";
          break;
         }
      }
   }
elseif (isset($accion)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
    switch(trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
            $observaciones = addslashes($observaciones);
            if (!$rs->Open("update tb_trayectos set ca_frecuencia = '$frecuencia', ca_tiempotransito = '$tiempotransito', ca_observaciones = '$observaciones' where ca_idtrayecto = $ty")) {
                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                echo "<script>location.href = 'uptarifario.php';</script>";
                exit;
               }
            settype($vlrneto_f,"double");
            settype($vlrminimo_f,"double");
            settype($fleteminimo_f,"double");
            $observaciones_f = addslashes($observaciones_f);
            if ($oid_f != 0) {
                if (!$rs->Open("update tb_fletes set ca_idconcepto = $idconcepto_f, ca_vlrneto = $vlrneto_f, ca_vlrminimo = $vlrminimo_f, ca_fleteminimo = $fleteminimo_f, ca_idmoneda = '$idmoneda_f', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario', ca_fchinicio = '$fchinicio_f', ca_fchvencimiento = '$fchvencimiento_f', ca_observaciones = '$observaciones_f' where oid = $oid_f")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>location.href = 'uptarifario.php';</script>";
                    exit;
                   }
                }
            else {
                if (!$rs->Open("insert into tb_fletes (ca_idtrayecto, ca_idconcepto, ca_vlrneto, ca_vlrminimo, ca_fleteminimo, ca_idmoneda, ca_fchcreado, ca_usucreado, ca_fchinicio, ca_fchvencimiento, ca_observaciones) values ( $id, $idconcepto_f, $vlrneto_f, $vlrminimo_f, $fleteminimo_f, '$idmoneda_f', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario', '$fchinicio_f', '$fchvencimiento_f', '$observaciones_f')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>location.href = 'uptarifario.php';</script>";
                    exit;
                   }
                }
            for ($i=0; $i < count($oid_r); $i++) {
                $registro = 'reg_'.$oid_r[$i];
                //echo "<BR>( ".$oid_f." )( ".$oid_r[$i]." ) [ ".$registro." ]<BR>";
                if ($oid_r[$i] != 0) {
                    if (!$rs->Open("select oid as ca_oid_r, * from tb_recargos where oid = $oid_r[$i]")) {  // Selecciona todos lo registros de la tabla Recargos
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        echo "<script>location.href = 'entrada.php';</script>";
                        exit; }
                    if (!$rs->IsEmpty()) {
                        // Corrige irregularidad por falta de diligencimiento de fechas
                        list($anno, $mes, $dia) = sscanf(${$registro}['fchinicio'],"%d-%d-%d");
                        ${$registro}['fchinicio'] = (checkdate($mes, $dia, $anno)?${$registro}['fchinicio']:$rs->Value('ca_fchinicio'));
                        list($anno, $mes, $dia) = sscanf(${$registro}['fchinicio'],"%d-%d-%d");
                        ${$registro}['fchinicio'] = (checkdate($mes, $dia, $anno)?${$registro}['fchinicio']:date("Y-m-d"));
     
                        list($anno, $mes, $dia) = sscanf(${$registro}['fchvencimiento'],"%d-%d-%d");
                        ${$registro}['fchvencimiento'] = (checkdate($mes, $dia, $anno)?${$registro}['fchvencimiento']:$rs->Value('ca_fchvencimiento'));
                        list($anno, $mes, $dia) = sscanf(${$registro}['fchvencimiento'],"%d-%d-%d");
                        ${$registro}['fchvencimiento'] = (checkdate($mes, $dia, $anno)?${$registro}['fchvencimiento']:date("Y-m-d"));
     
                        // Calcula y sólo actualiza los registros que cambiaron //
                        $cambio = 0;
                        while (list ($clave, $val) = each ($$registro)) {
                        // echo "<BR>".$rs->Value('ca_'.$clave)." - ".$val;
                           $cambio+= ($rs->Value('ca_'.$clave) != $val)?1:0;
                           }
                        //echo "<BR>*".(($cambio!=0)?"Sí Cambió $oid_r[$i] ($cambio)":"No Cambió")."<BR><BR>";
                        if ($cambio!=0) {
                            if (!$rs->Open("update tb_recargos set ca_idconcepto = ".${$registro}['idconcepto'].", ca_idrecargo = ".${$registro}['idrecargo'].", ca_aplicacion = '".${$registro}['aplicacion']."', ca_fchinicio = '".${$registro}['fchinicio']."', ca_fchvencimiento = '".${$registro}['fchvencimiento']."', ca_vlrfijo = ".${$registro}['vlrfijo'].", ca_porcentaje = ".${$registro}['porcentaje'].", ca_baseporcentaje = '".${$registro}['baseporcentaje']."', ca_vlrunitario = ".${$registro}['vlrunitario'].", ca_baseunitario = '".${$registro}['baseunitario']."', ca_recargominimo = ".${$registro}['recargominimo'].", ca_idmoneda = '".${$registro}['idmoneda']."', ca_observaciones = '".${$registro}['observaciones']."', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where oid = $oid_r[$i]")) {
                                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                echo "<script>location.href = 'uptarifario.php?id=$id';</script>";
                                exit;
                               }
                            }
                    }elseif(!$rs->Open("select oid as ca_oid_r, * from tb_recargosxtraf where oid = $oid_r[$i]")){
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        echo "<script>location.href = 'entrada.php';</script>";
                        exit; }
                    if (!$rs->IsEmpty()) {
                        // Corrige irregularidad por falta de diligencimiento de fechas
                        list($anno, $mes, $dia) = sscanf(${$registro}['fchinicio'],"%d-%d-%d");
                        ${$registro}['fchinicio'] = (checkdate($mes, $dia, $anno)?${$registro}['fchinicio']:$rs->Value('ca_fchinicio'));
                        list($anno, $mes, $dia) = sscanf(${$registro}['fchinicio'],"%d-%d-%d");
                        ${$registro}['fchinicio'] = (checkdate($mes, $dia, $anno)?${$registro}['fchinicio']:date("Y-m-d"));
     
                        list($anno, $mes, $dia) = sscanf(${$registro}['fchvencimiento'],"%d-%d-%d");
                        ${$registro}['fchvencimiento'] = (checkdate($mes, $dia, $anno)?${$registro}['fchvencimiento']:$rs->Value('ca_fchvencimiento'));
                        list($anno, $mes, $dia) = sscanf(${$registro}['fchvencimiento'],"%d-%d-%d");
                        ${$registro}['fchvencimiento'] = (checkdate($mes, $dia, $anno)?${$registro}['fchvencimiento']:date("Y-m-d"));
     
                        // Calcula y sólo actualiza los registros que cambiaron //
                        $cambio = 0;
                        while (list ($clave, $val) = each ($$registro)) {
                           //echo "<BR>".$rs->Value('ca_'.$clave)." - ".$val;
                           $cambio+= ($rs->Value('ca_'.$clave) != $val)?1:0;
                           }
                        //echo "<BR>*".(($cambio!=0)?"Sí Cambió $oid_r[$i] ($cambio)":"No Cambió")."<BR><BR>";
                        if ($cambio>1) {
                            if (!$rs->Open("update tb_recargosxtraf set ca_idrecargo = ".${$registro}['idrecargo'].", ca_aplicacion = '".${$registro}['aplicacion']."', ca_fchinicio = '".${$registro}['fchinicio']."', ca_fchvencimiento = '".${$registro}['fchvencimiento']."', ca_vlrfijo = ".${$registro}['vlrfijo'].", ca_porcentaje = ".${$registro}['porcentaje'].", ca_baseporcentaje = '".${$registro}['baseporcentaje']."', ca_vlrunitario = ".${$registro}['vlrunitario'].", ca_baseunitario = '".${$registro}['baseunitario']."', ca_recargominimo = ".${$registro}['recargominimo'].", ca_idmoneda = '".${$registro}['idmoneda']."', ca_observaciones = '".${$registro}['observaciones']."' where oid = $oid_r[$i]")) {
                                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                echo "<script>location.href = 'uptarifario.php?id=$id';</script>";
                                exit;
                               }
                            }
                        }
                    }
                elseif (substr($registro,0,4)=='reg_' and (${$registro}['vlrfijo']!=0 or ${$registro}['porcentaje']!=0 or ${$registro}['vlrunitario']!=0)){
                    list($anno, $mes, $dia) = sscanf(${$registro}['fchinicio'],"%d-%d-%d");
                    ${$registro}['fchinicio'] = (checkdate($mes, $dia, $anno)?${$registro}['fchinicio']:date("Y-m-d"));
                    list($anno, $mes, $dia) = sscanf(${$registro}['fchvencimiento'],"%d-%d-%d");
                    ${$registro}['fchvencimiento'] = (checkdate($mes, $dia, $anno)?${$registro}['fchvencimiento']:date("Y-m-d"));
                    //while (list ($clave, $val) = each ($$registro)) {
                    //   echo "<BR>".$clave." - ".$val;
                    //}
                    if (!$rs->Open("insert into tb_recargos (ca_idtrayecto, ca_idconcepto, ca_idrecargo, ca_aplicacion, ca_fchinicio, ca_fchvencimiento, ca_vlrfijo, ca_porcentaje, ca_baseporcentaje, ca_vlrunitario, ca_baseunitario, ca_recargominimo, ca_idmoneda, ca_observaciones, ca_fchcreado, ca_usucreado) values($id, ".${$registro}['idconcepto'].", ".${$registro}['idrecargo'].", '".${$registro}['aplicacion']."', '".${$registro}['fchinicio']."', '".${$registro}['fchvencimiento']."', ".${$registro}['vlrfijo'].", ".${$registro}['porcentaje'].", '".${$registro}['baseporcentaje']."', ".${$registro}['vlrunitario'].", '".${$registro}['baseunitario']."', ".${$registro}['recargominimo'].", '".${$registro}['idmoneda']."', '".${$registro}['observaciones']."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>location.href = 'uptarifario.php?id=$id';</script>";
                        exit;
                       }
                    }
             }
             break;
            }
        case 'Registrar': {                                                   // El Botón Actualizar fue pulsado
            if (!$rs->Open("update tb_fletes set ca_sugerida = '' where oid in (".implode(",",$tarifas).")")) {
                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                echo "<script>location.href = 'uptarifario.php';</script>";
                exit;
               }
            if (isset($sugeridas)) {
                if (!$rs->Open("update tb_fletes set ca_sugerida = '*' where oid in (".implode(",",$sugeridas).")")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>location.href = 'uptarifario.php';</script>";
                    exit;
                   }
               }
            break;
            }
        case 'A_Mantenimiento': {                                                   // El Botón Actualizar fue pulsado
            if (!$rs->Open("update tb_fletes set ca_mantenimiento = '' where oid in (".implode(",",$tarifas).")")) {
                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                echo "<script>location.href = 'uptarifario.php';</script>";
                exit;
               }
            if (isset($mantenimientos)) {
                if (!$rs->Open("update tb_fletes set ca_mantenimiento = '*' where oid in (".implode(",",$mantenimientos).")")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>location.href = 'uptarifario.php';</script>";
                    exit;
                   }
               }
             break;
            }
        case 'Eliminar': {                                                   // El Botón Actualizar fue pulsado
            if (!$rs->Open("delete from tb_recargos where ca_idtrayecto = $id")) {
                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                echo "<script>location.href = 'uptarifario.php';</script>";
                exit;
               }
            if (!$rs->Open("delete from tb_trayectos where ca_idtrayecto = $id")) {
                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                echo "<script>location.href = 'uptarifario.php';</script>";
                exit;
               }
             break;
            }
        case 'Eliminar_Recargo': {                                                   // El Botón Eliminar fue pulsado
            if (!$rs->Open("delete from tb_recargos where oid = $id")) {
                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                echo "<script>location.href = 'uptarifario.php';</script>";
                exit;
               }
             break;
            }
        case 'Eliminar_Tarifa': {                                                   // El Botón Eliminar fue pulsado
            if (!$rs->Open("delete from tb_recargos where ca_idtrayecto in (select ca_idtrayecto from tb_fletes where oid = $id) and ca_idconcepto in (select ca_idconcepto from tb_fletes where oid = $id)")) {
                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                echo "<script>location.href = 'uptarifario.php';</script>";
                exit;
               }
            if (!$rs->Open("delete from tb_fletes where oid = $id")) {
                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                echo "<script>location.href = 'uptarifario.php';</script>";
                exit;
               }
             break;
            }
        }
    echo "<script>window.parent.frames.update_tarifario.style.visibility = \"hidden\";window.parent.history.go(0);</script>";  // Retorna a la pantalla principal de la opción
   }
?>