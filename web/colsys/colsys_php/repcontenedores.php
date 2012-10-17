<?php

/* ================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
  // Archivo:       REPCONTENEDORES.PHP                                         \\
  // Creado:        2004-05-11                                                  \\
  // Autor:         Carlos Gilberto L�pez M.                                    \\
  // Ver:           1.00                                                        \\
  // Updated:       2004-05-11                                                  \\
  //                                                                            \\
  // Descripci�n:   Reporte de Libro de Referencias                             \\
  //                                                                            \\
  //                                                                            \\
  // Copyright:     Coltrans S.A. - 2004                                        \\
  /*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
 */
$programa = 45;

$titulo = 'Informe de Contenedores';

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
include_once 'include/functions.php';                                          // Incorpora la libreria de funciones varias
require_once("checklogin.php");                                                                 // Captura las variables de la sessi�n abierta


$rs = $tm = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
if (!isset($buscar) and !isset($accion)) {
   echo "<HTML>";
   echo "<HEAD>";
   echo "<TITLE>$titulo</TITLE>";
   echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
   echo "</HEAD>";
   echo "<BODY>";
   require_once("menu.php");
   echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
   echo "<CENTER>";
   echo "<H3>$titulo</H3>";
   echo "<FORM METHOD=post NAME='menuform' ACTION='repcontenedores.php'>";
   echo "<TABLE WIDTH=550 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
   echo "<TH COLSPAN=8 style='font-size: 12px; font-weight:bold;'><B>Ingrese los par�metros para el Reporte</TH>";

   echo "<TR>";
   echo "  <TD Class=captura ROWSPAN=2></TD>";
   echo "  <TD Class=listar><B>E.T.A.:</B><BR><INPUT TYPE='TEXT' NAME='fchconfirmacion' SIZE=12 VALUE='" . date(date("Y") . "-" . date("m") . "-" . date("d")) . "' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
   echo "  <TD Class=listar><B>Devoluci�n:</B><BR><INPUT TYPE='TEXT' NAME='fchdevolucion' SIZE=12 VALUE='" . date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 10, date("Y"))) . "' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
   echo "  <TD Class=listar><B>Nombre del Cliente:</B><BR><INPUT TYPE='text' NAME='compania' VALUE='' size='30' maxlength='60'></TD>";
   echo "  <TD Class=listar><B>No.Contenedor:</B><BR><INPUT TYPE='text' NAME='idequipo' VALUE='' size='12' maxlength='12'></TD>";
   echo "  <TD Class=listar><B>L�nea Naviera:</B><BR><INPUT TYPE='text' NAME='ca_nombre' VALUE='' size='20' maxlength='40'></TD>";
   if (!$tm->Open("SELECT distinct substr(ca_referencia,1,3) as ca_modal FROM tb_inomaestra_sea order by 1")) {       // Selecciona todos los prefijos de la InoMaestra
      echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
      echo "<script>document.location.href = 'repreferencia.php';</script>";
      exit;
   }
   $tm->MoveFirst();
   echo "  <TD Class=listar>Prefijo:<BR><SELECT NAME='modal'>";
   echo "  <OPTION VALUE=%>Todos</OPTION>";
   while (!$tm->Eof()) {
      echo " <OPTION VALUE=" . $tm->Value('ca_modal') . ">" . $tm->Value('ca_modal') . "</OPTION>";
      $tm->MoveNext();
   }
   echo "  </TD>";
   echo "  <TH style='vertical-align:bottom;'><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
   echo "</TR>";

   echo "<TR HEIGHT=5>";
   echo "  <TD Class=captura COLSPAN=7></TD>";
   echo "</TR>";

   echo "</TABLE><BR>";
   echo "<TABLE CELLSPACING=10>";
   echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"reporteador.php\"'></TH>";  // Cancela la operaci�n
   echo "</TABLE>";
   echo "</FORM>";
   echo "</CENTER>";
   echo "<script>menuform.fchconfirmacion.focus()</script>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
   require_once("footer.php");
   echo "</BODY>";
   echo "</HTML>";
} elseif (isset($buscar) and !isset($accion)) {
   $modulo = "00100000";                                                      // Identificaci�n del m�dulo para la ayuda en l�nea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al m�dulo

   $condicion = "where ca_fchconfirmacion = '$fchconfirmacion' and ca_fchdevolucion >= '$fchdevolucion' and ca_compania like '%$compania%' and (ca_nombre like '%$linea%' or ca_sigla like '%$linea%')";
   $condicion.= (strlen($idequipo) != 0) ? " and ca_referencia in (select ca_referencia from tb_inoequipos_sea where ca_idequipo like '%$idequipo%')" : "";
   $condicion.= ($modal != "%")?" and ca_modal = '$modal'":"";
   if (!$rs->Open("select * from vi_inoctrlcontenedores_sea $condicion order by ca_fchconfirmacion, ca_fchdevolucion, ca_referencia")) {                       // Selecciona todos lo registros de la tabla Ino-Mar�timo
      echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
      echo "<script>document.location.href = 'entrada.php';</script>";
      exit;
   }
   $ref_mem = "";
   while (!$rs->Eof() and !$rs->IsEmpty()) {
      $ref_mem.= "'" . $rs->Value('ca_referencia') . "',";
      $rs->MoveNext();
   }
   $rs->MoveFirst();
   $ref_mem = (strlen($ref_mem) != 0) ? substr($ref_mem, 0, strlen($ref_mem) - 1) : "''";
   $eq = & DlRecordset::NewRecordset($conn);
   if (!$eq->Open("select ca_referencia, ca_concepto, ca_idequipo, ca_inspeccion_nta, ca_inspeccion_fch from vi_inoequipos_sea where ca_referencia in (" . $ref_mem . ") order by ca_referencia, ca_concepto")) {                       // Selecciona todos lo registros de la tabla Ino-Mar�timo
      echo "<script>alert(\"" . addslashes($eq->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
      echo "<script>document.location.href = 'entrada.php';</script>";
      exit;
   }
   echo "<HTML>";
   echo "<HEAD>";
   echo "<TITLE>$titulo</TITLE>";
   echo "<script language='JavaScript' type='text/JavaScript'>";              // C�digo en JavaScript para validar las opciones de mantenimiento
   echo "function uno(src,color_entrada) {";
   echo "    src.style.background=color_entrada;src.style.cursor='hand'";
   echo "}";
   echo "function dos(src,color_default) {";
   echo "    src.style.background=color_default;src.style.cursor='default';";
   echo "}";
   echo "</script>";
   echo "</HEAD>";
   echo "<BODY>";
   require_once("menu.php");
   echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
   echo "<CENTER>";
   echo "<FORM METHOD=post NAME='informe' ACTION='repcontenedores.php'>";       // Hace una llamado nuevamente a este script pero con
   echo "<TABLE WIDTH=700 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
   echo "<TR>";
   echo "  <TH Class=titulo COLSPAN=3>" . COLTRANS . "<BR>$titulo</TH>";
   echo "</TR>";
   echo "<TH COLSPAN=3>Referencia</TH>";
   $oid_mem = 0;
   while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
      if ($oid_mem != $rs->Value('ca_oid')) {
         $ref_mem = $rs->Value('ca_referencia');
         $oid_mem = $rs->Value('ca_oid');
         $cas_cer = TRUE;
         
         $tabla_equipos = "";
         $tabla_equipos.= "<TABLE WIDTH=100% CELLSPACING=1>";
         $tabla_equipos.= "<TH>Equipo</TH>";
         $tabla_equipos.= "<TH>Id</TH>";
         $eq->MoveFirst();
         while (!$eq->Eof() and !$eq->IsEmpty()) {
            if ($eq->Value('ca_referencia') != $ref_mem) {
               $eq->MoveNext();
               continue;
            }
            if ($eq->Value('ca_inspeccion_nta') == '' or $eq->Value('ca_inspeccion_fch') == ''){
               $cas_cer = FALSE;
            }
            $tabla_equipos.= "<TR>";
            $tabla_equipos.= "  <TD Class=listar style='font-size: 9px;'>" . $eq->Value('ca_concepto') . "</TD>";
            $tabla_equipos.= "  <TD Class=listar style='font-size: 9px;'>" . $eq->Value('ca_idequipo') . "</TD>";
            $tabla_equipos.= "</TR>";
            $eq->MoveNext();
         }
         $tabla_equipos.= "</TABLE>";
         
         $intervalo = dateDiff($rs->Value('ca_fchconfirmacion'), date("Y-m-d"));
         // FF0000 -> Rojo
         // 009900 -> Verde
         // FFFF00 -> Amarillo
         // 9999CC -> Lila
         if($cas_cer){
            $back_col = " background: #9999CC";
         }else if($intervalo >= round($rs->Value('ca_numdias')*0.6666666666,0)){
            $back_col = " background: #FF0000";
         }else if($intervalo >= round($rs->Value('ca_numdias')*0.3333333333,0)){
            $back_col = " background: #FFFF00";
         }else{
            $back_col = " background: #009900";
         }
         echo "<TR>";
         echo "<TD Class=invertir style='font-size: 9px;' COLSPAN=3><TABLE WIDTH=100% CELLSPACING=1>";
         echo "<TR>";
         echo "  <TD Class=listar style='font-weight:bold; font-size: 9px;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:window.open(\"inosea.php?boton=Consultar\&id=" . $rs->Value('ca_referencia') . "\");'>" . $rs->Value('ca_referencia') . "</TD>";
         echo "  <TD Class=listar style='font-size: 9px;'><b>Tr�fico:</b><br>" . $rs->Value('ca_traorigen') . "</TD>";
         echo "  <TD Class=listar style='font-size: 9px;'><b>Origen:</b><br>" . $rs->Value('ca_ciuorigen') . "</TD>";
         echo "  <TD Class=listar style='font-size: 9px;'><b>Destino:</b><br>" . $rs->Value('ca_ciudestino') . "</TD>";
         echo "  <TD Class=listar style='font-size: 9px;'><b>MBL:</b><br>" . $rs->Value('ca_mbls') . "|" . $rs->Value('ca_fchmbls') . "</TD>";
         echo "  <TD Class=listar style='font-size: 9px;'><b>E.T.A.:</b><br>" . $rs->Value('ca_fchconfirmacion') . "</TD>";
         echo "  <TD Class=listar style='font-size: 9px;;$back_col'><b>Devoluci�n:</b><br>" . $rs->Value('ca_fchdevolucion') . "</TD>";
         echo "</TR>";
         echo "</TABLE></TD>";
         echo "</TR>";
         echo "<TR>";
         echo "  <TD Class=listar style='font-size: 9px;'><b>L�nea:</b><br>" . $rs->Value('ca_nombre') . "<br><b>Motonave:</b><br>" . $rs->Value('ca_mnllegada') . "</TD>";
         echo "  <TD Class=invertir style='font-size: 9px;' WIDTH=300><TABLE WIDTH=100% CELLSPACING=1>";
         echo "  <TH>Cliente</TH>";
         echo "  <TH>HBL</TH>";
      }
      echo "<TR>";
      $back_col = (strlen($rs->Value('ca_fchvencimiento')) != 0) ? " background: #CCCC99" : " background: #F0F0F0";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_compania') . " " . ((strlen($rs->Value('ca_fchvencimiento')) != 0) ? " <B>�</B>" : "") . "</TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_hbls') . "</TD>";
      echo "</TR>";
      $rs->MoveNext();
      if ($oid_mem != $rs->Value('ca_oid') or $rs->Eof()) {
         echo "</TABLE></TD>";
         echo "<TD Class=invertir style='font-size: 9px;' WIDTH=225>$tabla_equipos</TD>";
         echo "</TR>";
         echo "<TR HEIGHT=5>";
         echo "  <TD Class=titulo COLSPAN=3></TD>";
         echo "</TR>";
      }
   }
   echo "</TABLE><BR>";
   echo "<TABLE CELLSPACING=10>";
   echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repcontenedores.php\"'></TH>";  // Cancela la operaci�n
   echo "</TABLE>";
   echo "</FORM>";
   echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
   require_once("footer.php");
   echo "</BODY>";
   echo "</HTML>";
}
?>