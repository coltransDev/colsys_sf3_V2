<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       FLETES.PHP                                                  \\
// Creado:        2004-06-07                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-06-07                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la tabla de Fletes de cada Trayecto\
//                atendido por los transportista.                             \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Tabla de Fletes por Trayecto de Transportistas';

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    if (!$rs->Open("select * from vi_trayectos where ca_idtrayecto = $id")) {  // Selecciona todos lo registros de la tabla Modelos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(programa, opcion, id, oid){";
	echo "  if (programa == 0) ";
	echo "      document.location.href = 'fletes.php?boton='+opcion+'\&id='+id+'\&oid='+oid;";
	echo "  else";
	echo "      document.location.href = 'recargos.php?boton='+opcion+'\&id='+id+'\&oid='+oid;";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='cabecera' ACTION='fletes.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=4>SISTEMA TARIFARIO<BR>$titulo</TH>";
    echo "</TR>";
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       echo "<TR>";
       echo "  <TD Class=invertir style='font-size: 14px;' COLSPAN=7><B>".$rs->Value('ca_nombre')."</B></TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=invertir style='font-size: 11px; font-weight:bold;' COLSPAN=7>&nbsp&nbsp&nbsp".$rs->Value('ca_nomtransportista')." - ".number_format($rs->Value('ca_idtransportista'))."</TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=listar WIDTH=105 ROWSPAN=2><IMG src='".$rs->Value('ca_banorigen')."' width=\"103\" height=\"69\"></TD>";
       echo "  <TD Class=listar><B>".strtoupper($rs->Value('ca_traorigen'))."</B><BR>".$rs->Value('ca_origen')."-".$rs->Value('ca_ciuorigen')."</TD>";
       echo "  <TD Class=listar WIDTH=105 ROWSPAN=2><IMG src='".$rs->Value('ca_bandestino')."' width=\"103\" height=\"69\"></TD>";
       echo "  <TD Class=listar><B>".strtoupper($rs->Value('ca_tradestino'))."</B><BR>".$rs->Value('ca_destino')."-".$rs->Value('ca_ciudestino')."</TD>";
       echo "</TR>";
       echo "<TR>";
       echo "<TD Class=mostrar><B>Transporte: </B>".$rs->Value('ca_transporte')."</TD>";
       echo "<TD Class=mostrar><B>Modalidad: </B>".$rs->Value('ca_modalidad')."</TD>";
       echo "</TR>";
       $rs->MoveNext();
       }
    echo "</TABLE><BR>";
    echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TH COLSPAN=6 style='font-size: 13px; font-weight:bold;'>Tarifas por Concepto</TH>";
    echo "<TH WIDTH=44><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(0, \"Adicionar\", $id, 0);'></TH>";  // Botón para la creación de un Registro Nuevo
    echo "</TABLE>";
    $tm =& DlRecordset::NewRecordset($conn);
    if (!$rs->Open("select * from vi_fletes where ca_idtrayecto = $id")) {  // Selecciona todos lo registros de la tabla Modelos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    $rs->MoveFirst();
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
       echo "<TR>";
       echo "  <TD Class=invertir COLSPAN=6 style='font-size: 14px; font-weight:bold;'>".$rs->Value('ca_concepto')."</TD>";
       echo "  <TD Class=invertir WIDTH=44>";											   // Botones para hacer Mantenimiento a la Tabla
       echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(0, \"Modificar\", $id,  \"".$rs->Value('ca_oid')."\");'>";
       echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(0, \"Eliminar\", $id, \"".$rs->Value('ca_oid')."\");'>";
       echo "  </TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=mostrar WIDTH=30></TD>";
       echo "  <TD Class=mostrar><B>Moneda:</B><BR>".$rs->Value('ca_nombre')."</TD>";
       echo "  <TD Class=mostrar>Tarifa Neta:<BR><B>".number_format($rs->Value('ca_vlrneto'),2)."</B></TD>";
       echo "  <TD Class=mostrar>Tarifa Mínima:<BR><B>".number_format($rs->Value('ca_vlrminimo'),2)."</B></TD>";
       echo "  <TD Class=mostrar>Tarifa Senior:<BR><B>".number_format($rs->Value('ca_vlrsenior'),2)."</B></TD>";
       echo "  <TD Class=mostrar>Tarifa Junior:<BR><B>".number_format($rs->Value('ca_vlrjunior'),2)."</B></TD>";
       echo "  <TD Class=mostrar ROWSPAN=3></TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=mostrar WIDTH=30></TD>";
       echo "  <TD Class=listar COLSPAN=4><B>Observaciones:</B><BR>".nl2br($rs->Value('ca_observaciones'))."&nbsp;</TD>";
       echo "  <TD Class=mostrar>Flete Mínimo:<BR><B>".number_format($rs->Value('ca_fleteminimo'),2)."</B></TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=mostrar WIDTH=30></TD>";
       echo "  <TD Class=invertir><B><BR>&nbsp;Datos de Control</B></TD>";
       echo "  <TD Class=invertir><B>Creación:</B><BR>".$rs->Value('ca_fchcreado')."&nbsp;</TD>";
       echo "  <TD Class=invertir><B>Modificado:</B><BR>".$rs->Value('ca_fchactualizado')."&nbsp;</TD>";
       echo "  <TD Class=invertir><B>Inicio Vigencia:</B><BR>".$rs->Value('ca_fchinicio')."&nbsp;</TD>";
       echo "  <TD Class=invertir><B>Fin Vigencia:</B><BR>".$rs->Value('ca_fchvencimiento')."&nbsp;</TD>";
       echo "</TR>";
	   
       echo "</TABLE>";
       if (!$tm->Open("select * from vi_recargos where ca_idtrayecto = $id and ca_idconcepto = ".$rs->Value('ca_idconcepto'))) {  // Selecciona todos lo registros de la tabla Modelos
           echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
           echo "<script>document.location.href = 'entrada.php';</script>";
           exit; }
       $tm->MoveFirst();
       echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
       while (!$tm->Eof() and !$tm->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
          echo "<TR>";
          echo "  <TD Class=invertir COLSPAN=4 style='font-size: 10px; font-weight:bold;'>".$tm->Value('ca_recargo')."</TD>";
          echo "  <TD Class=invertir COLSPAN=2 style='font-size: 10px; font-weight:bold;'>".$tm->Value('ca_tipo')."</TD>";
          echo "  <TD Class=invertir WIDTH=44>";											   // Botones para hacer Mantenimiento a la Tabla
          echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(1, \"Modificar\", $id,  \"".$tm->Value('ca_oid')."\");'>";
          echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(1, \"Eliminar\", $id, \"".$tm->Value('ca_oid')."\");'>";
          echo "  </TD>";
          echo "</TR>";
          echo "<TR>";
          echo "  <TD Class=mostrar WIDTH=30></TD>";
		  if ($tm->Value('ca_vlrfijo')!= 0)
              echo "  <TD Class=mostrar>Valor Fijo:<BR><B>".number_format($tm->Value('ca_vlrfijo'),2)."</B></TD>";
		  else
              echo "  <TD Class=mostrar>Valor Fijo:<BR>&nbsp;</TD>";
		  if ($tm->Value('ca_porcentaje')!= 0) {
              echo "  <TD Class=mostrar>Porcentaje:<BR><B>".number_format($tm->Value('ca_porcentaje'),2)."%</B></TD>";
              echo "  <TD Class=mostrar>Base de Porcentaje:<BR><B>".$tm->Value('ca_baseporcentaje')."</B></TD>"; }
		  else {
              echo "  <TD Class=mostrar>Porcentaje:<BR>&nbsp;</TD>";
              echo "  <TD Class=mostrar>Base de Porcentaje:<BR>&nbsp;</TD>";
		  }
		  if ($tm->Value('ca_vlrunitario')!= 0) {
              echo "  <TD Class=mostrar>Valor Unitario:<BR><B>".number_format($tm->Value('ca_vlrunitario'),2)."</B></TD>";
              echo "  <TD Class=mostrar>Base de VlrUnitario:<BR><B>".$tm->Value('ca_baseunitario')."</B></TD>"; }
		  else {
              echo "  <TD Class=mostrar>Valor Unitario:<BR>&nbsp;</TD>";
              echo "  <TD Class=mostrar>Base de VlrUnitario:<BR>&nbsp;</TD>";
		  }
          echo "  <TD Class=mostrar ROWSPAN=2></TD>";
          echo "</TR>";
          echo "<TR>";
          echo "  <TD Class=mostrar WIDTH=30></TD>";
		  if ($tm->Value('ca_observaciones')!= '')
              echo "  <TD Class=mostrar COLSPAN=4><B>Observaciones:</B><BR>".$tm->Value('ca_observaciones')."</TD>";
		  else
              echo "  <TD Class=mostrar COLSPAN=4>Observaciones:<BR>&nbsp;</TD>";
          echo "  <TD Class=mostrar>Recargo Mínimo:<BR><B>".number_format($tm->Value('ca_recargominimo'),2)."</B></TD>";
          echo "</TR>";
          $tm->MoveNext();
          }
       echo "</TABLE>";
       $rs->MoveNext();
       }
    if (!$tm->Open("select * from vi_recargos where ca_idtrayecto = $id and ca_idconcepto = 9999")) {
        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    $tm->MoveFirst();
	echo "<BR>";
    echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TH COLSPAN=7 style='font-size: 13px; font-weight:bold;'>Relación de Recargos Generales del Trayecto</TH>";
    echo "<TH WIDTH=44><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(1, \"Adicionar\", $id, 0);'></TH>";  // Botón para la creación de un Registro Nuevo
    while (!$tm->Eof() and !$tm->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
          echo "<TR>";
          echo "  <TD Class=invertir COLSPAN=3 style='font-size: 9px;'>Recargo:<BR><B>".$tm->Value('ca_recargo')."</B></TD>";
          echo "  <TD Class=invertir style='font-size: 9px;'>Tipo de Recargo:<BR><B>".$tm->Value('ca_tipo')."</B></TD>";
          echo "  <TD Class=invertir style='font-size: 9px;'>Aplicación:<BR><B>".$tm->Value('ca_aplicacion')."</B></TD>";
          echo "  <TD Class=invertir style='font-size: 9px;'>Fecha Inicio:<BR><B>".($tm->Value('ca_aplicacion')=='Temporal'?$tm->Value('ca_fchinicio'):'&nbsp;')."</B></TD>";
          echo "  <TD Class=invertir style='font-size: 9px;'>Vencimiento:<BR><B>".($tm->Value('ca_aplicacion')=='Temporal'?$tm->Value('ca_fchvencimiento'):'&nbsp;')."</B></TD>";
          echo "  <TD Class=invertir WIDTH=44>";											   // Botones para hacer Mantenimiento a la Tabla
          echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(1, \"Modificar\", $id,  \"".$tm->Value('ca_oid')."\");'>";
          echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(1, \"Eliminar\", $id, \"".$tm->Value('ca_oid')."\");'>";
          echo "  </TD>";
          echo "</TR>";
          echo "<TR>";
          echo "  <TD Class=listar WIDTH=30></TD>";
          echo "  <TD Class=listar>Valor Fijo:<BR><B>".number_format($tm->Value('ca_vlrfijo'),2)."</B>&nbsp;</TD>";
          echo "  <TD Class=listar>Porcentaje:<BR><B>".number_format($tm->Value('ca_porcentaje'),2)."%</B>&nbsp;</TD>";
          echo "  <TD Class=listar>Base de Porcentaje:<BR><B>".$tm->Value('ca_baseporcentaje')."</B>&nbsp;</TD>";
          echo "  <TD Class=listar>Valor Unitario:<BR><B>".number_format($tm->Value('ca_vlrunitario'),2)."</B>&nbsp;</TD>";
          echo "  <TD Class=listar COLSPAN=2>Base de VlrUnitario:<BR><B>".$tm->Value('ca_baseunitario')."</B>&nbsp;</TD>";
          echo "  <TD Class=listar ROWSPAN=3></TD>";
          echo "</TR>";
          echo "<TR>";
          echo "  <TD Class=listar ROWSPAN=2 WIDTH=30></TD>";
          echo "  <TD Class=listar COLSPAN=4 ROWSPAN=2><B>Observaciones:</B><BR>".nl2br($tm->Value('ca_observaciones'))."&nbsp;</TD>";
          echo "  <TD Class=listar COLSPAN=2>Recargo Mínimo:<BR><B>".$tm->Value('ca_recargominimo')."</B>&nbsp;</TD>";
          echo "<TR>";
          echo "  <TD Class=listar COLSPAN=2>Moneda:<BR><B>".$tm->Value('ca_nombre')."</B></TD>";
          echo "</TR>";
          $tm->MoveNext();
       }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar' ONCLICK='javascript:document.location.href = \"trayectos.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    switch(trim($boton)) {
        case 'Adicionar': {                                                    // Opcion para Adicionar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_trayectos where ca_idtrayecto = $id")) {  // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select ca_idconcepto, ca_concepto from vi_conceptos where ca_modalidad = '".$rs->Value('ca_modalidad')."'")) {   // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'fletes.php';</script>";
                 exit; }
			 $tm->MoveFirst();
             echo "<HTML>";
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (!chkDate(document.adicionar.fchinicio))";
             echo "      document.adicionar.fchinicio.focus();";
             echo "  else if (!chkDate(document.adicionar.fchvencimiento))";
             echo "      document.adicionar.fchvencimiento.focus();";
			 echo "  else if (document.adicionar.vlrneto.value == '')";
			 echo "      alert('El campo Tarifa Neta no es válido');";
			 echo "  else if (document.adicionar.vlrminimo.value == '')";
			 echo "      alert('El campo Tarifa Mínima no es válido');";
			 echo "  else if (document.adicionar.vlrsenior.value == '')";
			 echo "      alert('El campo Tarifa Senior no es válido');";
			 echo "  else if (document.adicionar.vlrjunior.value == '')";
			 echo "      alert('El campo Tarifa Junior no es válido');";
			 echo "  else";
			 echo "      return (true);";
			 echo "  return (false);";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='fletes.php' ONSUBMIT='return validar();'>";             // Hace una llamado nuevamente a este script pero con
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";                      // Hereda el Id del registro que se esta consultando
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=4>SISTEMA TARIFARIO<BR>$titulo</TH>";
             echo "</TR>";
             while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
		        echo "<TR>";
		        echo "  <TD Class=invertir style='font-size: 14px; font-weight:bold;' COLSPAN=7>".$rs->Value('ca_nomtransportista')." - ".number_format($rs->Value('ca_idtransportista'))."</TD>";
		        echo "</TR>";
		        echo "<TR>";
		        echo "  <TD Class=listar WIDTH=105 ROWSPAN=2><IMG src='".$rs->Value('ca_banorigen')."' width=\"103\" height=\"69\"></TD>";
		        echo "  <TD Class=listar><B>".strtoupper($rs->Value('ca_traorigen'))."</B><BR>".$rs->Value('ca_origen')."-".$rs->Value('ca_ciuorigen')."</TD>";
		        echo "  <TD Class=listar WIDTH=105 ROWSPAN=2><IMG src='".$rs->Value('ca_bandestino')."' width=\"103\" height=\"69\"></TD>";
		        echo "  <TD Class=listar><B>".strtoupper($rs->Value('ca_tradestino'))."</B><BR>".$rs->Value('ca_destino')."-".$rs->Value('ca_ciudestino')."</TD>";
		        echo "</TR>";
		        echo "<TR>";
		        echo "<TD Class=mostrar><B>Transporte: </B>".$rs->Value('ca_transporte')."</TD>";
		        echo "<TD Class=mostrar><B>Modalidad: </B>".$rs->Value('ca_modalidad')."</TD>";
		        echo "</TR>";
                $rs->MoveNext();
                }
             echo "</TABLE><BR>";
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TH COLSPAN=6>Datos para la Nueva Tarifa</TH>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=4><B>Seleccione un producto:</B><BR><SELECT NAME='idconcepto'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
             while (!$tm->Eof()) {
                    echo"<OPTION VALUE=".$tm->Value('ca_idconcepto').">".$tm->Value('ca_concepto')."</OPTION>";
                    $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar style='text-align: center;'><B>Inicio Vigencia:</B><BR><INPUT TYPE='TEXT' NAME='fchinicio' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "  <TD Class=mostrar style='text-align: center;'><B>Final Vigencia:</B><BR><INPUT TYPE='TEXT' NAME='fchvencimiento' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar WIDTH=50></TD>";
             echo "  <TD Class=mostrar>Moneda:<BR><SELECT NAME='idmoneda'>";            // Llena el cuadro de lista con los valores de la tabla Monedas
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
             echo "  <TD Class=mostrar>Tarifa Neta:<BR><INPUT TYPE='TEXT' NAME='vlrneto' SIZE=17 MAXLENGTH=15></TD>";
             echo "  <TD Class=mostrar>Tarifa Mínima:<BR><INPUT TYPE='TEXT' NAME='vlrminimo' SIZE=17 MAXLENGTH=15></TD>";
             echo "  <TD Class=mostrar>Tarifa Senior:<BR><INPUT TYPE='TEXT' NAME='vlrsenior' SIZE=17 MAXLENGTH=15></TD>";
             echo "  <TD Class=mostrar>Tarifa Junior:<BR><INPUT TYPE='TEXT' NAME='vlrjunior' SIZE=17 MAXLENGTH=15></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar WIDTH=50></TD>";
             echo "  <TD Class=mostrar COLSPAN=4>Observaciones:<BR><INPUT TYPE='TEXT' NAME='observaciones' SIZE=84 MAXLENGTH=100></TD>";
             echo "  <TD Class=mostrar>Flete Mínimo:<BR><INPUT TYPE='TEXT' NAME='fleteminimo' SIZE=17 MAXLENGTH=15></TD>";
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
             if (!$tm->Open("select ca_idconcepto, ca_concepto from vi_conceptos where ca_modalidad = '".$rs->Value('ca_modalidad')."'")) {   // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'fletes.php';</script>";
                 exit; }
			 $tm->MoveFirst();
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (!chkDate(document.modificar.fchinicio))";
             echo "      document.modificar.fchinicio.focus();";
             echo "  else if (!chkDate(document.modificar.fchvencimiento))";
             echo "      document.modificar.fchvencimiento.focus();";
			 echo "  else if (document.modificar.vlrneto.value == '')";
			 echo "      alert('El campo Tarifa Neta no es válido');";
			 echo "  else if (document.modificar.vlrminimo.value == '')";
			 echo "      alert('El campo Tarifa Mínima no es válido');";
			 echo "  else if (document.modificar.vlrsenior.value == '')";
			 echo "      alert('El campo Tarifa Senior no es válido');";
			 echo "  else if (document.modificar.vlrjunior.value == '')";
			 echo "      alert('El campo Tarifa Junior no es válido');";
			 echo "  else";
			 echo "      return (true);";
			 echo "  return (false);";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<FORM METHOD=post NAME='modificar' ACTION='fletes.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='oid' VALUE=".$oid.">";            // Hereda el Id del registro que se esta modificando
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=4>SISTEMA TARIFARIO<BR>$titulo</TH>";
             echo "</TR>";
             while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
		        echo "<TR>";
		        echo "  <TD Class=invertir style='font-size: 14px; font-weight:bold;' COLSPAN=7>".$rs->Value('ca_nomtransportista')." - ".number_format($rs->Value('ca_idtransportista'))."</TD>";
		        echo "</TR>";
		        echo "<TR>";
		        echo "  <TD Class=listar WIDTH=105 ROWSPAN=2><IMG src='".$rs->Value('ca_banorigen')."' width=\"103\" height=\"69\"></TD>";
		        echo "  <TD Class=listar><B>".strtoupper($rs->Value('ca_traorigen'))."</B><BR>".$rs->Value('ca_origen')."-".$rs->Value('ca_ciuorigen')."</TD>";
		        echo "  <TD Class=listar WIDTH=105 ROWSPAN=2><IMG src='".$rs->Value('ca_bandestino')."' width=\"103\" height=\"69\"></TD>";
		        echo "  <TD Class=listar><B>".strtoupper($rs->Value('ca_tradestino'))."</B><BR>".$rs->Value('ca_destino')."-".$rs->Value('ca_ciudestino')."</TD>";
		        echo "</TR>";
		        echo "<TR>";
		        echo "<TD Class=mostrar><B>Transporte: </B>".$rs->Value('ca_transporte')."</TD>";
		        echo "<TD Class=mostrar><B>Modalidad: </B>".$rs->Value('ca_modalidad')."</TD>";
		        echo "</TR>";
                $rs->MoveNext();
                }
             echo "</TABLE><BR>";
             if (!$rs->Open("select * from vi_fletes where ca_idtrayecto = $id and ca_oid = $oid")) {  // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
			 $rs->MoveFirst();
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TH COLSPAN=6>Nuevos Datos para la Tarifa</TH>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=4><B>Seleccione un producto:</B><BR><SELECT NAME='idconcepto'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
             while (!$tm->Eof()) {
                    echo"<OPTION VALUE=".$tm->Value('ca_idconcepto');
                    if ($tm->Value('ca_idconcepto')==$rs->Value('ca_idconcepto')) {
                         echo" SELECTED"; }
					echo">".$tm->Value('ca_concepto')."</OPTION>";
                    $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar style='text-align: center;'><B>Inicio Vigencia:</B><BR><INPUT TYPE='TEXT' NAME='fchinicio' SIZE=12 VALUE='".$rs->Value('ca_fchinicio')."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "  <TD Class=mostrar style='text-align: center;'><B>Final Vigencia:</B><BR><INPUT TYPE='TEXT' NAME='fchvencimiento' SIZE=12 VALUE='".$rs->Value('ca_fchvencimiento')."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar WIDTH=50></TD>";
             echo "  <TD Class=mostrar>Moneda:<BR><SELECT NAME='idmoneda'>";            // Llena el cuadro de lista con los valores de la tabla Monedas
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
             echo "  <TD Class=mostrar>Tarifa Neta:<BR><INPUT TYPE='TEXT' NAME='vlrneto' VALUE='".$rs->Value('ca_vlrneto')."' SIZE=17 MAXLENGTH=15></TD>";
             echo "  <TD Class=mostrar>Tarifa Mínima:<BR><INPUT TYPE='TEXT' NAME='vlrminimo' VALUE='".$rs->Value('ca_vlrminimo')."' SIZE=17 MAXLENGTH=15></TD>";
             echo "  <TD Class=mostrar>Tarifa Senior:<BR><INPUT TYPE='TEXT' NAME='vlrsenior' VALUE='".$rs->Value('ca_vlrsenior')."' SIZE=17 MAXLENGTH=15></TD>";
             echo "  <TD Class=mostrar>Tarifa Junior:<BR><INPUT TYPE='TEXT' NAME='vlrjunior' VALUE='".$rs->Value('ca_vlrjunior')."' SIZE=17 MAXLENGTH=15></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar WIDTH=50></TD>";
             echo "  <TD Class=mostrar COLSPAN=4>Observaciones:<BR><INPUT TYPE='TEXT' NAME='observaciones' VALUE='".$rs->Value('ca_observaciones')."' SIZE=84 MAXLENGTH=100></TD>";
             echo "  <TD Class=mostrar>Flete Mínimo:<BR><INPUT TYPE='TEXT' NAME='fleteminimo' VALUE='".$rs->Value('ca_fleteminimo')."' SIZE=17 MAXLENGTH=15></TD>";
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
             echo "<FORM METHOD=post NAME='eliminar' ACTION='fletes.php'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='oid' VALUE=".$oid.">";            // Hereda el Id del registro que se esta modificando
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=6>SISTEMA TARIFARIO<BR>$titulo</TH>";
             echo "</TR>";
             while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
		        echo "<TR>";
		        echo "  <TD Class=invertir style='font-size: 14px; font-weight:bold;' COLSPAN=7>".$rs->Value('ca_nomtransportista')." - ".number_format($rs->Value('ca_idtransportista'))."</TD>";
		        echo "</TR>";
		        echo "<TR>";
		        echo "  <TD Class=listar WIDTH=105 ROWSPAN=2><IMG src='".$rs->Value('ca_banorigen')."' width=\"103\" height=\"69\"></TD>";
		        echo "  <TD Class=listar><B>".strtoupper($rs->Value('ca_traorigen'))."</B><BR>".$rs->Value('ca_origen')."-".$rs->Value('ca_ciuorigen')."</TD>";
		        echo "  <TD Class=listar WIDTH=105 ROWSPAN=2><IMG src='".$rs->Value('ca_bandestino')."' width=\"103\" height=\"69\"></TD>";
		        echo "  <TD Class=listar><B>".strtoupper($rs->Value('ca_tradestino'))."</B><BR>".$rs->Value('ca_destino')."-".$rs->Value('ca_ciudestino')."</TD>";
		        echo "</TR>";
		        echo "<TR>";
		        echo "<TD Class=mostrar><B>Transporte: </B>".$rs->Value('ca_transporte')."</TD>";
		        echo "<TD Class=mostrar><B>Modalidad: </B>".$rs->Value('ca_modalidad')."</TD>";
		        echo "</TR>";
                $rs->MoveNext();
                }
             echo "</TABLE><BR>";
             if (!$rs->Open("select * from vi_fletes where ca_idtrayecto = $id and ca_oid = $oid")) {  // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
			 $rs->MoveFirst();
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TH COLSPAN=6>Datos de la Tarifa a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=4 style='font-size: 13px; font-weight:bold;'><B>Concepto:</B><BR>".$rs->Value('ca_concepto')."</TD>";
             echo "  <TD Class=mostrar style='text-align: center;'><B>Inicio Vigencia:</B><BR>".$rs->Value('ca_fchinicio')."&nbsp</TD>";
             echo "  <TD Class=mostrar style='text-align: center;'><B>Final Vigencia:</B><BR>".$rs->Value('ca_fchvencimiento')."&nbsp</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar WIDTH=50></TD>";
             echo "  <TD Class=mostrar><B>Moneda:</B><BR>".$rs->Value('ca_nombre')."</TD>";
             echo "  <TD Class=mostrar>Tarifa Neta:<BR><B>".number_format($rs->Value('ca_vlrneto'))."</B></TD>";
             echo "  <TD Class=mostrar>Tarifa Mínima:<BR><B>".number_format($rs->Value('ca_vlrminimo'))."</B></TD>";
             echo "  <TD Class=mostrar>Tarifa Senior:<BR><B>".number_format($rs->Value('ca_vlrsenior'))."</B></TD>";
             echo "  <TD Class=mostrar>Tarifa Junior:<BR><B>".number_format($rs->Value('ca_vlrjunior'))."</B></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar WIDTH=50></TD>";
             echo "  <TD Class=mostrar COLSPAN=4><B>Observaciones:</B><BR>".$rs->Value('ca_observaciones')."&nbsp</TD>";
             echo "  <TD Class=mostrar>Flete Mínimo:<BR><B>".number_format($rs->Value('ca_fleteminimo'))."</B></TD>";
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
    settype($vlrneto,"double");
    settype($vlrminimo,"double");	
    settype($vlrsenior,"double");
    settype($vlrjunior,"double");
    settype($fleteminimo,"double");	
    switch(trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Guardar': {                                                      // El Botón Guardar fue pulsado
             if (!$rs->Open("insert into tb_fletes (ca_idtrayecto, ca_idconcepto, ca_vlrneto, ca_vlrminimo, ca_vlrsenior, ca_vlrjunior, ca_fleteminimo, ca_idmoneda, ca_fchcreado, ca_fchinicio, ca_fchvencimiento, ca_observaciones) values($id, $idconcepto, $vlrneto, $vlrminimo, $vlrsenior, $vlrjunior, $fleteminimo, '$idmoneda', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$fchinicio', '$fchvencimiento', '$observaciones')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'fletes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             if (!$rs->Open("update tb_fletes set ca_idconcepto = $idconcepto, ca_vlrneto = $vlrneto, ca_vlrminimo = $vlrminimo, ca_vlrsenior = $vlrsenior, ca_vlrjunior = $vlrjunior, ca_fleteminimo = $fleteminimo, ca_idmoneda = '$idmoneda', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_fchinicio = '$fchinicio', ca_fchvencimiento = '$fchvencimiento', ca_observaciones = '$observaciones' where oid = $oid")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'fletes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_fletes where oid = $oid")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'fletes.php';</script>";
                 exit;
                }
             break;
             }
        }
   echo "<script>document.location.href = 'fletes.php?id=$id';</script>";  // Retorna a la pantalla principal de la opción
   }
?>