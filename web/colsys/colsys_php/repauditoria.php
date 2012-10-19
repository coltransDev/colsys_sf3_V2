<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       REPAUDITORIA.PHP                                            \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripción:   Reporte de Rastros de Auditoria                             \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Informe sobre Rastros de Auditoría';
$meses  = array( "%" => "Todos los Meses", "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($traorigen) and !isset($boton) and !isset($accion)){
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    ?>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <?php
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='repauditoria.php'>";
    echo "<TABLE WIDTH=550 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=7 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=2></TD>";
    echo "  <TD Class=listar>Año:<BR><SELECT NAME='ano'>";
    for ( $i=5; $i>=0; $i-- ){
          echo " <OPTION VALUE=".(date('Y')-$i)." SELECTED>".(date('Y')-$i)."</OPTION>";
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar>Mes a Consultar:<BR><SELECT NAME='mes'>";
    while (list ($clave, $val) = each ($meses)) {
        echo " <OPTION VALUE=$clave";
        if (date('m')==$clave) {
            echo" SELECTED"; }
        echo ">$val</OPTION>";
        }
    echo "  </SELECT></TD>";
    $tm =& DlRecordset::NewRecordset($conn);
	if (!$tm->Open("select distinct ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repcomisiones.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar>Sucursal :<BR><SELECT NAME='sucursal'>";
    echo " <OPTION VALUE=%>Sucursales (Todas)</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE='".$tm->Value('ca_sucursal')."'>".$tm->Value('ca_sucursal')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </SELECT></TD>";

    if (!$tm->Open("select DISTINCT ca_identificacion as ca_trafico from tb_parametros p, tb_traficos t where ca_casouso = 'CU010' and p.ca_valor = t.ca_idtrafico order by ca_identificacion")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repreferencia.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar>Sufijo :<BR><SELECT NAME='trafico'>";
    echo " <OPTION VALUE=%>Sufijos (Todos)</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE=".$tm->Value('ca_trafico').">".$tm->Value('ca_trafico')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </TD>";

    if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repauditoria.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar>Tráfico :<BR><SELECT NAME='traorigen'>";
    echo " <OPTION VALUE=%>Todos los Tráficos</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE=".$tm->Value('ca_nombre').">".$tm->Value('ca_nombre')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </TD>";

    echo "  <TH style='vertical-align:bottom;'><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=6></TD>";
    echo "</TR>";

    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"reporteador.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "<script>menuform.ano.focus()</script>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (!isset($boton) and !isset($accion) and isset($traorigen)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

	$condicion = "where ca_mes::text like '$mes' and ca_ano::text = '$ano' and ca_trafico like '%$trafico%' and ca_traorigen like '%$traorigen%'";
    $subcondic = "where ca_mes::text like '$mes' and ca_ano::text = '$ano' and ca_sucursal like '$sucursal'";
    if (!$rs->Open("select * from vi_inoauditor_sea where ca_referencia in (select DISTINCT ca_referencia from vi_inomaestra_sea $condicion) and ca_referencia in (select DISTINCT ca_referencia from vi_inoclientes_sea $subcondic) order by ca_referencia")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, cl){";
    echo "    document.location.href = 'inosea.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
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
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='informe' ACTION='repauditoria.php'>";       // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=650 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=6>Maestra de Registros de Auditoría</TH>";
    echo "</TR>";
    echo "<TH WIDTH=80>Fecha</TH>";
    echo "<TH>Tipo</TH>";
    echo "<TH WIDTH=300 COLSPAN=3>Asunto</TH>";
    echo "<TH>Generó</TH>";
    $num_ref = 0;
    $eve_ant = 0;
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       if ($num_ref != $rs->Value('ca_referencia')) {
           echo "<TR>";
           echo "  <TD Class=invertir style='font-size: 12px; font-weight:bold;' onMouseOver=\"uno(this,'FFFFFF');\" onMouseOut=\"dos(this,'CCCCCC');\" onclick='javascript:window.open(\"inosea.php?boton=Consultar\&id=".$rs->Value('ca_referencia')."\");' COLSPAN=6>".$rs->Value('ca_referencia')." -> ".$rs->Value('ca_estado')."</TD>";
           echo "</TR>";
           $num_ref = $rs->Value('ca_referencia');
          }
       if ($eve_ant != $rs->Value('ca_idevento_ant')) {
           echo "<TR>";
           echo "  <TD Class=mostrar COLSPAN=6 style='letter-spacing:-1px; letter-spacing:-1px;'><B>".$rs->Value('ca_asunto_ant')."</B></TD>";
           echo "</TR>";
           $eve_ant = $rs->Value('ca_idevento_ant');
          }
       echo "<TR>";
       echo "  <TD WIDTH=80 Class=listar style='letter-spacing:-1px; letter-spacing:-1px;'>".$rs->Value('ca_fchevento')."</TD>";
       echo "  <TD Class=listar style='letter-spacing:-1px;'>".$rs->Value('ca_tipo')."</TD>";
       echo "  <TD Class=listar style='letter-spacing:-1px;' COLSPAN=3>".$rs->Value('ca_asunto')."</TD>";
       echo "  <TD Class=listar style='letter-spacing:-1px;'>".$rs->Value('ca_usuario')."</TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD WIDTH=80 Class=listar></TD>";
       echo "  <TD Class=listar style='letter-spacing:-1px;' COLSPAN=2><B>Detalles:</B><BR>".nl2br($rs->Value('ca_detalle'))."</TD>";
       echo "  <TD Class=listar style='letter-spacing:-1px;' COLSPAN=3><B>Compromisos:</B><BR>".nl2br($rs->Value('ca_compromisos'))."<BR>Plazo :".$rs->Value('ca_fchcompromiso')."</TD>";
       echo "</TR>";
       $rs->MoveNext();
      }
    echo "</TABLE><BR>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repauditoria.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
?>