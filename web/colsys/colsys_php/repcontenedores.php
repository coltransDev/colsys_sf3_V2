<?php

/* ================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
  // Archivo:       REPCONTENEDORES.PHP                                         \\
  // Creado:        2004-05-11                                                  \\
  // Autor:         Carlos Gilberto López M.                                    \\
  // Ver:           1.00                                                        \\
  // Updated:       2004-05-11                                                  \\
  //                                                                            \\
  // Descripción:   Reporte de Libro de Referencias                             \\
  //                                                                            \\
  //                                                                            \\
  // Copyright:     Coltrans S.A. - 2004                                        \\
  /*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
 */
$titulo = 'Informe de Contenedores';
$meses  = array( "%" => "Todos los Meses", "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
include_once 'include/functions.php';                                          // Incorpora la libreria de funciones varias
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta


$rs = $tm = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
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
   echo "<TH COLSPAN=8 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";

   echo "<TR>";
   echo "  <TD Class=captura ROWSPAN=3></TD>";
   echo "  <TD Class=listar>Año:<BR><SELECT NAME='ano'>";
   for ( $i=5; $i>=0; $i-- ){
      echo " <OPTION VALUE=".(date('Y')-$i)." SELECTED>".(date('Y')-$i)."</OPTION>";
   }
   echo "  </SELECT></TD>";
   echo "  <TD Class=listar>Mes:<BR><SELECT NAME='mes'>";
   while (list ($clave, $val) = each ($meses)) {
      echo " <OPTION VALUE=$clave";
      if (date('m')==$clave) {
         echo" SELECTED"; }
      echo ">$val</OPTION>";
   }
   echo "  </SELECT></TD>";
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
   if (!$tm->Open("select distinct ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
       echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
       echo "<script>document.location.href = 'repcomisiones.php';</script>";
       exit; }
   echo "  <TD Class=mostrar>Sucursal:<BR><SELECT NAME='sucursal'>";
   echo "  <OPTION VALUE=%>Sucursales (Todas)</OPTION>";
   $tm->MoveFirst();
   while (!$tm->Eof()) {
       echo "<OPTION VALUE='".$tm->Value('ca_sucursal')."'>".$tm->Value('ca_sucursal')."</OPTION>";
       $tm->MoveNext();
   }
   echo "  </SELECT></TD>";
   if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
      echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
      echo "<script>document.location.href = 'reptraficos.php';</script>";
      exit;
   }
   $tm->MoveFirst();
   echo " <TD Class=mostrar>Tráfico :<BR><SELECT NAME='traorigen'>";
   echo " <OPTION VALUE=%>Todos los Tráficos</OPTION>";
   while (!$tm->Eof()) {
      echo " <OPTION VALUE=" . $tm->Value('ca_nombre') . ">" . $tm->Value('ca_nombre') . "</OPTION>";
      $tm->MoveNext();
   }
   echo "  </TD>";
   echo "  <TH style='vertical-align:center;' rowspan='3'><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
   echo "</TR>";
   echo "<TR>";
   if (!$tm->Open("select ca_idlinea, ca_nombre from vi_transporlineas where ca_transporte = 'Marítimo' and ca_activo_impo=true order by ca_nombre")) {       // Selecciona todos los prefijos de la InoMaestra
      echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
      echo "<script>document.location.href = 'repreferencia.php';</script>";
      exit;
   }
   $tm->MoveFirst();
   echo "  <TD Class=listar colspan='3'><B>Línea Naviera:</B><BR><SELECT NAME='linea'>";
   echo "    <OPTION VALUE=%>Todas las Líneas</OPTION>";
   while (!$tm->Eof()) {
       echo "    <OPTION VALUE='" . $tm->Value('ca_idlinea') . "'>" . $tm->Value('ca_nombre') . "</OPTION>";
       $tm->MoveNext();
   }
   echo "  </SELECT></TD>";
   echo "  <TD Class=listar colspan='2'><B>Nombre del Cliente:</B><BR><INPUT TYPE='text' NAME='compania' VALUE='' size='40' maxlength='60'></TD>";
   echo "</TR>";
   echo "<TR>";
   echo "  <TD Class=listar colspan='4'><B>Sitio de Devolución:</B><BR><SELECT NAME='idpatio'>";  // Llena el cuadro de lista con los valores de la tabla Conceptos
   echo "  <OPTION VALUE=''></OPTION>";
   if (!$tm->Open("select pt.*, cd.ca_ciudad from pric.tb_patios pt inner join tb_ciudades cd on pt.ca_idciudad = cd.ca_idciudad order by cd.ca_ciudad")) {       // Selecciona todos lo registros de la tabla Eventos Clientes
       echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";          // Muestra el mensaje de error
       echo "<script>document.location.href = 'entrada.php?id=1503';</script>";
       exit;
   }
   $tm->MoveFirst();
   $ciu_mem = null;
   while (!$tm->Eof()) {
       if ($ciu_mem != $tm->Value('ca_ciudad')) {
           if ($ciu_mem != null) {
               echo "</OPTGROUP>";
           }
           echo "<OPTGROUP LABEL='" . $tm->Value('ca_ciudad') . "'>";
           $ciu_mem = $tm->Value('ca_ciudad');
       }
       echo "<OPTION VALUE=" . $tm->Value('ca_idpatio') . ">" . $tm->Value('ca_nombre') . " - " . substr($tm->Value('ca_direccion'), 0, 25) . "</OPTION>";
       $tm->MoveNext();
   }
   echo "  </OPTGROUP>";
   echo "  </SELECT></TD>";
   echo "  <TD Class=listar><B>No.Contenedor:</B><BR><INPUT TYPE='text' NAME='idequipo' VALUE='' size='15' maxlength='12'></TD>";
   echo "</TR>";

   echo "<TR HEIGHT=5>";
   echo "  <TD Class=captura COLSPAN=7></TD>";
   echo "</TR>";

   echo "</TABLE><BR>";
   echo "<TABLE CELLSPACING=10>";
   echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"reporteador.php\"'></TH>";  // Cancela la operación
   echo "</TABLE>";
   echo "</FORM>";
   echo "</CENTER>";
   echo "<script>menuform.fchconfirmacion.focus()</script>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
   require_once("footer.php");
   echo "</BODY>";
   echo "</HTML>";
} elseif (isset($buscar) and !isset($accion)) {
   $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

   $ano_mem = substr($ano, -2);
   $mes_mem = $mes."-".$ano_mem;
   $condicion = "where";
   $condicion.= ($ano_mem != "%")?" ca_ano = '$ano_mem'":"";
   $condicion.= ($mes_mem != "%")?" and ca_mes = '$mes_mem'":"";
   $condicion.= ($traorigen != "%")?" and ca_traorigen = '$traorigen'":"";
   $condicion.= ($compania != "")?" and ca_compania like '%".strtoupper($compania)."%'":"";
   $condicion.= ($modal != "%")?" and ca_modal = '$modal'":"";
   $condicion.= ($linea != "%")?" and ca_idlinea = '$linea'":"";
   if (strlen($idequipo) != 0){
      $condicion.= " and ca_referencia in (select ca_referencia from tb_inoequipos_sea where ca_idequipo like '%$idequipo%')";
   }else{
      $condicion.= " and ca_referencia in (select ca_referencia from tb_inoequipos_sea where ca_idequipo != '*-*')";
   }
   if (strlen($idpatio) != 0){
       $condicion.= " and ca_referencia in (select ca_referencia from tb_inocontratos_sea where ca_idpatio = '$idpatio')";
   }
   if ($sucursal != "%"){
       $condicion.= " and ca_referencia in (select ca_referencia from tb_inoclientes_sea ic LEFT OUTER JOIN control.tb_usuarios us ON (ic.ca_login = us.ca_login) LEFT OUTER JOIN control.tb_sucursales sc ON (us.ca_idsucursal = sc.ca_idsucursal) where sc.ca_nombre like '%$sucursal%')";
   }
   $sql="select * from vi_inoctrlcontenedores_sea $condicion order by ca_fchconfirmacion, ca_fchdevolucion, ca_referencia";
   //echo $sql."<br>";
   if (!$rs->Open($sql)) {
       echo "Error 138: $sql";
      //echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
      //echo "<script>document.location.href = 'entrada.php';</script>";
      exit;
   }
   $ref_mem = array();
   while (!$rs->Eof() and !$rs->IsEmpty()) {
      $ref_mem[] = "'".$rs->Value('ca_referencia')."'";
      $rs->MoveNext();
   }
   if (count($ref_mem)==0){
       $ref_mem[] = "null";
   }
   
   $rs->MoveFirst();
   $eq = & DlRecordset::NewRecordset($conn);
   $sql="select ca_referencia, ca_concepto, ca_idequipo, ca_inspeccion_nta, ca_inspeccion_fch from vi_inoequipos_sea where ca_referencia in (". implode( ",", $ref_mem) .") order by ca_referencia, ca_concepto";
   if (!$eq->Open($sql)) { 
       echo "Error 153: $sql";
      //echo "<script>alert(\"" . addslashes($eq->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
      //echo "<script>document.location.href = 'entrada.php';</script>";
      exit;
   }
   echo "<HTML>";
   echo "<HEAD>";
   echo "<TITLE>$titulo</TITLE>";
   echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
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
   while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
      if ($oid_mem != $rs->Value('ca_oid')) {
         $ref_mem = $rs->Value('ca_referencia');
         $oid_mem = $rs->Value('ca_oid');
         $cas_cer = TRUE;
         
         $id_array = array();
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
            if ($eq->Value('ca_inspeccion_fch') == ''){     //$eq->Value('ca_inspeccion_nta') == '' or 
               $cas_cer = FALSE;
            }
            $tabla_equipos.= "<TR>";
            $tabla_equipos.= "  <TD Class=listar style='font-size: 9px;'>" . $eq->Value('ca_concepto') . "</TD>";
            $tabla_equipos.= "  <TD Class=listar style='font-size: 9px;'>" . $eq->Value('ca_idequipo') . "</TD>";
            $tabla_equipos.= "</TR>";
            $id_array[] = $eq->Value('ca_concepto');
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
         echo "  <TD Class=listar style='font-size: 9px;'><b>Tráfico:</b><br>" . $rs->Value('ca_traorigen') . "</TD>";
         echo "  <TD Class=listar style='font-size: 9px;'><b>Origen:</b><br>" . $rs->Value('ca_ciuorigen') . "</TD>";
         echo "  <TD Class=listar style='font-size: 9px;'><b>Destino:</b><br>" . $rs->Value('ca_ciudestino') . "</TD>";
         echo "  <TD Class=listar style='font-size: 9px;'><b>MBL:</b><br>" . $rs->Value('ca_mbls') . "|" . $rs->Value('ca_fchmbls') . "</TD>";
         echo "  <TD Class=listar style='font-size: 9px;'><b>E.T.A.:</b><br>" . $rs->Value('ca_fchconfirmacion') . "</TD>";
         echo "  <TD Class=listar style='font-size: 9px;;$back_col'><b>Devolución:</b><br>" . $rs->Value('ca_fchdevolucion') . "</TD>";
         echo "</TR>";
         echo "</TABLE></TD>";
         echo "</TR>";
         echo "<TR>";
         echo "  <TD Class=listar style='font-size: 9px;'><b>Línea:</b><br>" . $rs->Value('ca_nombre') . "<br><b>Motonave:</b><br>" . $rs->Value('ca_mnllegada') . "</TD>";
         echo "  <TD Class=invertir style='font-size: 9px;' WIDTH=300><TABLE WIDTH=100% CELLSPACING=1>";
         echo "  <TH>Cliente</TH>";
         echo "  <TH>HBL</TH>";
      }
      echo "<TR>";
      $back_col = (strlen($rs->Value('ca_fchvencimiento')) != 0) ? " background: #CCCC99" : " background: #F0F0F0";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_compania') . " " . ((strlen($rs->Value('ca_fchvencimiento')) != 0) ? " <B>©</B>" : "") . "</TD>";
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
   echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repcontenedores.php\"'></TH>";  // Cancela la operación
   echo "</TABLE>";
   echo "</FORM>";
   echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
   require_once("footer.php");
   echo "</BODY>";
   echo "</HTML>";
}
?>
