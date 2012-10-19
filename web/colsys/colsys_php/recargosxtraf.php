<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-*\
// Archivo:       RECARGOSXTRAF.PHP                                              \\
// Creado:        2004-06-25                                                     \\
// Autor:         Carlos Gilberto López M.                                       \\
// Ver:           1.00                                                           \\
// Updated:       2004-06-25                                                     \\
//                                                                               \\
// Descripción:   Módulo de mantenimiento a la tabla de Recargos de cada Tráfico \\
//                                                                               \\
// Copyright:     Coltrans S.A. - 2004                                           \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-*\
*/
$titulo = 'Tabla de Recargos Generales en el Mundo';
$imporexpor = array("Importación","Exportación");                              // Arreglo con los tipos de Trayecto
$aplicaciones = array("Permanente","Temporal");
$modalidades= array("CONSOLIDADO","DIRECTO","LCL","FCL","COLOADING","PROYECTOS"); // Arreglo con los tipos de Modalidades de Carga
$basesporcentaje = array("Sobre Flete","Sobre Vlr Factura");
$basesunitario = array("Unidades Peso/Volumen", "Número de Piezas","Cantidad de BLs/AWBs");
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
include_once 'include/functions.php';                                          // Funciones de Usuarios para PHP
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo
    if (!$rs->Open("select * from vi_recargosxtraf")) {                        // Selecciona todos lo registros de la tabla Modelos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, oid){";
    echo "    document.location.href = 'recargosxtraf.php?boton='+opcion+'\&oid='+oid;";
    echo "}";
    echo "</script>";
    ?>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <?php
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='cabecera' ACTION='recargosxtraf.php'>";           // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>SISTEMA TARIFARIO<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH></TH>";
    echo "<TH COLSPAN=5>Información del Recargo</TH>";
    echo "<TH WIDTH=44><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
    $tra_mem = "";
    $nom_tra = "";
    $nom_ciu = "";
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       if ($rs->Value('ca_transporte') != $tra_mem) {
           echo "<TR>";
           echo "  <TD Class=imprimir COLSPAN=7 style='font-size: 15px; font-weight:bold;'>".$rs->Value('ca_transporte')."</TD>";
           $tra_mem = $rs->Value('ca_transporte');
           $nom_tra = "";
           $nom_ciu = "";
           echo "</TR>";
           }
       if ($rs->Value('ca_idtrafico') != $nom_tra) {
           echo "<TR>";
           echo "  <TD Class=imprimir COLSPAN=7>&nbsp</TD>";
           echo "</TR>";
           echo "<TR HEIGHT=5>";
           echo "  <TH COLSPAN=7></TH>";
           echo "</TR>";
           echo "<TR>";
           echo "  <TD Class=listar COLSPAN=2 style='text-align:center;'><IMG src='".$rs->Value('ca_bandera')."' width=\"103\" height=\"69\"></TD>";
           echo "  <TD Class=listar COLSPAN=4 style='font-size: 13px; font-weight:bold; vertical-align:top;'>".$rs->Value('ca_trafico')."&nbsp&nbsp(".$rs->Value('ca_idtrafico').")</TD>";
           echo "  <TD Class=listar></TD>";
           $nom_tra = $rs->Value('ca_idtrafico');
           $nom_ciu = "";
           echo "</TR>";
           echo "<TR HEIGHT=5>";
           echo "  <TH COLSPAN=7></TH>";
           echo "</TR>";
          }
       if ($rs->Value('ca_idciudad') != $nom_ciu) {
           echo "<TR>";
           echo "  <TD Class=invertir COLSPAN=6 style='font-size: 13px; font-weight:bold;'>".$rs->Value('ca_ciudad')."&nbsp&nbsp(".$rs->Value('ca_idciudad').")</TD>";
           echo "  <TD Class=invertir></TD>";
           $nom_ciu = $rs->Value('ca_idciudad');
           echo "</TR>";
           }
       echo "<TR>";
       echo "  <TD Class=listar COLSPAN=4 style='font-size: 11px; font-weight:bold;'>&nbsp&nbsp".$rs->Value('ca_recargo')."</TD>";
       echo "  <TD Class=listar COLSPAN=2 style='font-size: 11px; font-weight:bold;'>".$rs->Value('ca_modalidad')."</TD>";
       echo "  <TD Class=listar WIDTH=44>";                                            // Botones para hacer Mantenimiento a la Tabla
       echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\", \"".$rs->Value('ca_oid')."\");'>";
       echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\", \"".$rs->Value('ca_oid')."\");'>";
       echo "  </TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=listar WIDTH=30></TD>";
       if ($rs->Value('ca_vlrfijo')!= 0)
           echo "  <TD Class=listar>Valor Fijo:<BR><B>".formatNumber($rs->Value('ca_vlrfijo'),3)."</B></TD>";
       else
           echo "  <TD Class=listar>Valor Fijo:<BR>&nbsp;</TD>";
       if ($rs->Value('ca_porcentaje')!= 0) {
           echo "  <TD Class=listar>Porcentaje:<BR><B>".formatNumber($rs->Value('ca_porcentaje'),2)."%</B></TD>";
           echo "  <TD Class=listar>Base de Porcentaje:<BR><B>".$rs->Value('ca_baseporcentaje')."</B></TD>"; }
       else {
           echo "  <TD Class=listar>Porcentaje:<BR>&nbsp;</TD>";
           echo "  <TD Class=listar>Base de Porcentaje:<BR>&nbsp;</TD>";
          }
       if ($rs->Value('ca_vlrunitario')!= 0) {
           echo "  <TD Class=listar>Valor Unitario:<BR><B>".formatNumber($rs->Value('ca_vlrunitario'),3)."</B></TD>";
           echo "  <TD Class=listar>Base de VlrUnitario:<BR><B>".$rs->Value('ca_baseunitario')."</B></TD>"; }
       else {
           echo "  <TD Class=listar>Valor Unitario:<BR>&nbsp;</TD>";
           echo "  <TD Class=listar>Base de VlrUnitario:<BR>&nbsp;</TD>";
          }
       echo "  <TD Class=listar ROWSPAN=5></TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=listar ROWSPAN=4 WIDTH=30></TD>";
       echo "  <TD Class=listar ROWSPAN=4><B>Términos:</B><BR>".str_replace ("|","<BR>",$rs->Value('ca_incoterms'))."</TD>";
       echo "  <TD Class=listar COLSPAN=2 ROWSPAN=4><B>Observaciones:</B><BR>".$rs->Value('ca_observaciones')."<BR>&nbsp;</TD>";
       echo "  <TD Class=listar COLSPAN=2>Recargo Mínimo:<BR><B>".formatNumber($rs->Value('ca_recargominimo'),2)."</B></TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=listar COLSPAN=2>Impor/Expor:<BR><B>".$rs->Value('ca_impoexpo')."</B></TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=listar COLSPAN=2>Tipo:<BR><B>".$rs->Value('ca_tipo')."</B></TD>";
       echo "</TR>";
       echo "<TR>";
       if ($rs->Value('ca_aplicacion') == 'Temporal') {
           echo "  <TD Class=listar COLSPAN=2 style='font-size: 10px; font-weight:bold;'>Aplicación: ".$rs->Value('ca_aplicacion')."<BR>&nbsp&nbsp".$rs->Value('ca_fchinicio')."<BR>&nbsp&nbsp".$rs->Value('ca_fchvencimiento')."</TD>";
          }
       else {
           echo "  <TD Class=listar COLSPAN=2 style='font-size: 10px; font-weight:bold;'>Aplicación: ".$rs->Value('ca_aplicacion')."</TD>";
          }
       echo "</TR>";
       $rs->MoveNext();
      }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operación
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
             if (!$rs->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) { // Selecciona todos lo registros de la tabla Agentes
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select c.ca_idciudad, c.ca_ciudad, c.ca_idtrafico from vi_puertos c order by c.ca_ciudad")) {       // Selecciona todos lo registros de la tabla Origenes
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
                 $tm->MoveFirst();
             while ( !$tm->Eof()) {
                     echo "<INPUT TYPE='HIDDEN' NAME='ar_idciudad' VALUE=".$tm->Value('ca_idciudad').">";
                     echo "<INPUT TYPE='HIDDEN' NAME='ar_ciudad' VALUE='".$tm->Value('ca_ciudad')."'>";
                     echo "<INPUT TYPE='HIDDEN' NAME='ar_idtrafico' VALUE=".$tm->Value('ca_idtrafico').">";
                     $tm->MoveNext();
                   }
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
             echo "function llenar_ciudades(){";
             echo "  document.adicionar.idciudad.length=0;";
             echo "  document.adicionar.idciudad.options[document.adicionar.idciudad.length] = new Option();";
             echo "  document.adicionar.idciudad.length=0;";
             echo "  document.adicionar.idciudad[document.adicionar.idciudad.length] = new Option('Todas las Ciudades','999-9999',false,false);";
             echo "  if (isNaN(ar_ciudad.length)){";
             echo "      if (document.adicionar.idtrafico.value == ar_idtrafico.value){";
             echo "          document.adicionar.idciudad[document.adicionar.idciudad.length] = new Option(ar_idciudad.value,ar_ciudad.value,false,false);";
             echo "          }";
             echo "     }";
             echo "  else {";
             echo "     for (cont=0; cont<ar_ciudad.length; cont++) {";
             echo "          if (document.adicionar.idtrafico.value == ar_idtrafico[cont].value){";
             echo "              document.adicionar.idciudad[document.adicionar.idciudad.length] = new Option(ar_ciudad[cont].value,ar_idciudad[cont].value,false,false);";
             echo "           }";
             echo "       }";
             echo "     }";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='recargosxtraf.php' ONSUBMIT='return validar();'>";             // Hace una llamado nuevamente a este script pero con
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TH COLSPAN=6>$titulo<BR>Datos para el Nuevo Recargo</TH>";
             echo "<TR>";
             echo "  <TD Class=mostrar style='vertical-align:top;' WIDTH=150>Tráfico<BR><CENTER><SELECT NAME='idtrafico' ONCHANGE='llenar_ciudades();'>";             // Llena el cuadro de lista con los valores de la tabla Traficos
             echo " <OPTION VALUE='99-999'>Todos los Tráficos</OPTION>";
             while ( !$rs->Eof()) {
                     echo " <OPTION VALUE='".$rs->Value('ca_idtrafico')."'>".$rs->Value('ca_nombre')."</OPTION>";
                     $rs->MoveNext();
                   }
             echo "  </SELECT></CENTER></TD>";
             echo "  <TD COLSPAN=2 Class=mostrar style='vertical-align:top;' WIDTH=150>Ciudad<BR><CENTER><SELECT NAME='idciudad'>";             // Llena el cuadro de lista con los valores de la tabla Traficos
             echo "  </SELECT></TD>";
             if (!$tm->Open("select ca_idrecargo, ca_recargo, ca_transporte from tb_tiporecargo order by ca_transporte, ca_recargo")) {   // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'recargosxtraf.php';</script>";
                 exit; }
             $tm->MoveFirst();
             echo "  <TD Class=mostrar COLSPAN=3>Recargo<BR><SELECT NAME='idrecargo'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
             while (!$tm->Eof()) {
                    echo"<OPTION VALUE=".$tm->Value('ca_idrecargo').">".$tm->Value('ca_transporte')." » ".$tm->Value('ca_recargo')."</OPTION>";
                    $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
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
             echo "  <TD Class=mostrar>Recargo Mínimo:<BR><INPUT TYPE='TEXT' NAME='recargominimo' SIZE=17 MAXLENGTH=15></TD>";
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
             echo "  <TD Class=mostrar>Modalidad:<BR><SELECT NAME='modalidad'>";            // Llena el cuadro de lista con modalidades de la tabla Conceptos
             if (!$tm->Open("select distinct on (ca_modalidad) ca_modalidad FROM tb_conceptos where ca_modalidad != 'All'")) { // Selecciona todos lo registros de la tabla Conceptos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'fletes.php';</script>";
                 exit; }
             $tm->MoveFirst();
             while ( !$tm->Eof()) {
                     echo"<OPTION VALUE=".$tm->Value('ca_modalidad').">".$tm->Value('ca_modalidad')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar style='vertical-align:top;'>Impo/Expo<BR><SELECT NAME='impoexpo'>";
             for ($i=0; $i < count($imporexpor); $i++) {
                  echo " <OPTION VALUE=".$imporexpor[$i].">".$imporexpor[$i];
                  }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar>Aplicación:<BR><SELECT NAME='aplicacion' ONCHANGE='habilitar(this);'>";
             for ($i=0; $i < count($aplicaciones); $i++) {
                  echo " <OPTION VALUE='".$aplicaciones[$i]."'>".$aplicaciones[$i];
                  }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=4 ROWSPAN=4>Observaciones:<BR><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=10 COLS=82></TEXTAREA></TD>";
             echo "  <TD Class=listar>Inicio<BR><INPUT TYPE='TEXT' DISABLED NAME='fchinicio' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "  <TD Class=listar>Vencimiento<BR><INPUT TYPE='TEXT' DISABLED NAME='fchvencimiento' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "</TR>";
             echo "</TABLE>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"recargosxtraf.php\"'></TH>";  // Cancela la operación
             echo "<script>llenar_ciudades();</script>";
             echo "<script>adicionar.idtrafico.focus()</script>";
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
             if (!$rs->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) { // Selecciona todos lo registros de la tabla Agentes
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select c.ca_idciudad, c.ca_ciudad, c.ca_idtrafico from vi_puertos c order by c.ca_ciudad")) {       // Selecciona todos lo registros de la tabla Origenes
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
                 $tm->MoveFirst();
             while ( !$tm->Eof()) {
                     echo "<INPUT TYPE='HIDDEN' NAME='ar_idciudad' VALUE=".$tm->Value('ca_idciudad').">";
                     echo "<INPUT TYPE='HIDDEN' NAME='ar_ciudad' VALUE='".$tm->Value('ca_ciudad')."'>";
                     echo "<INPUT TYPE='HIDDEN' NAME='ar_idtrafico' VALUE=".$tm->Value('ca_idtrafico').">";
                     $tm->MoveNext();
                   }
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
             echo "function llenar_ciudades(){";
             echo "  document.modicar.idciudad.length=0;";
             echo "  document.modicar.idciudad.options[document.modicar.idciudad.length] = new Option();";
             echo "  document.modicar.idciudad.length=0;";
             echo "  document.modicar.idciudad[document.modicar.idciudad.length] = new Option('Todas las Ciudades','999-9999',false,false);";
             echo "  if (isNaN(ar_ciudad.length)){";
             echo "      if (document.modicar.idtrafico.value == ar_idtrafico.value){";
             echo "          document.modicar.idciudad[document.modicar.idciudad.length] = new Option(ar_idciudad.value,ar_ciudad.value,false,false);";
             echo "          }";
             echo "     }";
             echo "  else {";
             echo "     for (cont=0; cont<ar_ciudad.length; cont++) {";
             echo "          if (document.modicar.idtrafico.value == ar_idtrafico[cont].value){";
             echo "              document.modicar.idciudad[document.modicar.idciudad.length] = new Option(ar_ciudad[cont].value,ar_idciudad[cont].value,false,false);";
             echo "           }";
             echo "       }";
             echo "     }";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<FORM METHOD=post NAME='modificar' ACTION='recargosxtraf.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<INPUT TYPE='HIDDEN' NAME='oid' VALUE=".$oid.">";            // Hereda el Id del registro que se esta modificando
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=6>SISTEMA TARIFARIO<BR>$titulo</TH>";
             echo "</TR>";
             $rs->MoveFirst();
             if (!$rs->Open("select * from vi_recargosxtraf where ca_oid = $oid")) {    // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             echo "  <TD Class=listar COLSPAN=2 style='vertical-align:top;'>Tráfico<BR>&nbsp&nbsp<B>".$rs->Value('ca_trafico')."</B><BR>Ciudad<BR>&nbsp&nbsp<B>".$rs->Value('ca_ciudad')."</B></TD>";    // Llena el cuadro de lista con los valores de la tabla Traficos
             if (!$tm->Open("select ca_idrecargo, ca_recargo, ca_transporte from tb_tiporecargo order by ca_transporte, ca_recargo")) {   // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'recargosxtraf.php';</script>";
                 exit; }
             $tm->MoveFirst();
             echo "  <TD Class=listar COLSPAN=3>Recargo<BR><SELECT NAME='idrecargo'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
             while (!$tm->Eof()) {
                    echo"<OPTION VALUE=".$tm->Value('ca_idrecargo');
                     if ($tm->Value('ca_idrecargo')==$rs->Value('ca_idrecargo')) {
                         echo" SELECTED"; }
                    echo">".$tm->Value('ca_transporte')."» ".$tm->Value('ca_recargo')."</OPTION>";
                    $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar style='vertical-align:top;'>Impo/Expo<BR><SELECT NAME='impoexpo'>";
             for ($i=0; $i < count($imporexpor); $i++) {
                  echo " <OPTION VALUE=".$imporexpor[$i];
                  if ($rs->Value('ca_impoexpo')==$imporexpor[$i]) {
                      echo " SELECTED"; }
                  echo ">".$imporexpor[$i];
                  }
             echo "  </SELECT></TD>";
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
             echo "  <TD Class=mostrar COLSPAN=4 ROWSPAN=5>Observaciones:<BR><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=14 COLS=82>".$rs->Value('ca_observaciones')."</TEXTAREA></TD>";
             echo "  <TD Class=mostrar COLSPAN=2>Recargo Mínimo:<BR><INPUT TYPE='TEXT' NAME='recargominimo' VALUE='".$rs->Value('ca_recargominimo')."' SIZE=17 MAXLENGTH=15></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=listar COLSPAN=2>Moneda:<BR><SELECT NAME='idmoneda'>";            // Llena el cuadro de lista con los valores de la tabla Monedas
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
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>Modalidad:<BR><SELECT NAME='modalidad'>";            // Llena el cuadro de lista con modalidades de la tabla Conceptos
             if (!$tm->Open("select distinct on (ca_modalidad) ca_modalidad FROM tb_conceptos where ca_modalidad != 'All'")) { // Selecciona todos lo registros de la tabla Conceptos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'fletes.php';</script>";
                 exit; }
             $tm->MoveFirst();
             while ( !$tm->Eof()) {
                     echo"<OPTION VALUE=".$tm->Value('ca_modalidad');
                     if ($tm->Value('ca_modalidad')==$rs->Value('ca_modalidad')) {
                         echo" SELECTED"; }
                     echo">".$tm->Value('ca_modalidad')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>Aplicación:<BR><SELECT NAME='aplicacion' ONCHANGE='habilitar(this);'>";
             for ($i=0; $i < count($aplicaciones); $i++) {
                  echo " <OPTION VALUE='".$aplicaciones[$i]."'";
                  if ($rs->Value('ca_aplicacion')==$aplicaciones[$i]) {
                      echo " SELECTED"; }
                  echo ">".$aplicaciones[$i];
                  }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Inicio<BR><INPUT TYPE='TEXT' ".($rs->Value('ca_aplicacion')=='Permanente'?'DISABLED':'')." NAME='fchinicio' SIZE=12 VALUE='".$rs->Value('ca_fchinicio')."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "  <TD Class=mostrar>Vencimiento<BR><INPUT TYPE='TEXT' ".($rs->Value('ca_aplicacion')=='Permanente'?'DISABLED':'')." NAME='fchvencimiento' SIZE=12 VALUE='".$rs->Value('ca_fchvencimiento')."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "</TR>";
             echo "</TR>";
             echo "</TABLE>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"recargosxtraf.php\"'></TH>";  // Cancela la operación
             echo "<script>modificar.idrecargo.focus()</script>";
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
             if (!$rs->Open("select * from vi_recargosxtraf where ca_oid = $oid")) {    // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $rs->MoveFirst();
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<FORM METHOD=post NAME='eliminar' ACTION='recargosxtraf.php'>";      // Llena la forma con los datos actuales del registro
             echo "<INPUT TYPE='HIDDEN' NAME='oid' VALUE=".$oid.">";            // Hereda el Id del registro que se esta modificando
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TH COLSPAN=6>Datos del Recargo a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=listar COLSPAN=2 style='vertical-align:top;'>Tráfico<BR>&nbsp&nbsp<B>".$rs->Value('ca_trafico')."</B><BR>Ciudad<BR>&nbsp&nbsp<B>".$rs->Value('ca_ciudad')."</B></TD>";    // Llena el cuadro de lista con los valores de la tabla Traficos
             echo "  <TD Class=listar>Recargo<BR><B>".$rs->Value('ca_recargo')."</B></TD>";
             echo "  <TD Class=listar>Aplicación<BR><B>".$rs->Value('ca_aplicacion')."</B></TD>";
             echo "  <TD Class=listar>Fecha Inicio<BR><B>".($rs->Value('ca_aplicacion')=='Temporal'?$rs->Value('ca_fchinicio'):'&nbsp;')."</B></TD>";
             echo "  <TD Class=listar>Vecimiento<BR><B>".($rs->Value('ca_aplicacion')=='Temporal'?$rs->Value('ca_fchvencimiento'):'&nbsp;')."</B></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=listar>Valor Fijo:<BR><B>".$rs->Value('ca_vlrfijo')."</B></TD>";
             echo "  <TD Class=listar>Porcentaje:<BR><B>".$rs->Value('ca_porcentaje')."%</B></TD>";
             echo "  <TD Class=listar>Base de Porcentaje:<BR><B>".$rs->Value('ca_baseporcentaje')."</B></TD>";
             echo "  <TD Class=listar>Valor Unitario:<BR><B>".$rs->Value('ca_vlrunitario')."</B></TD>";
             echo "  <TD Class=listar COLSPAN=2>Base de VlrUnitario:<BR><B>".$rs->Value('ca_baseunitario')."</B></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=listar COLSPAN=4 ROWSPAN=4>Observaciones:<BR>".nl2br($rs->Value('ca_observaciones'))."</TD>";
             echo "  <TD Class=listar COLSPAN=2>Recargo Mínimo:<BR><B>".$rs->Value('ca_recargominimo')."</B></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=listar COLSPAN=2>Moneda:<BR><B>".$rs->Value('ca_nombre')."</B></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=listar COLSPAN=2>Impo/Expo:<BR><B>".$rs->Value('ca_impoexpo')."</B></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=listar COLSPAN=2>Impo/Expo:<BR><B>".$rs->Value('ca_modalidad')."</B></TD>";
             echo "</TR>";
             echo "</TABLE>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"recargosxtraf.php\"'></TH>";  // Cancela la operación
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
               if (!$rs->Open("insert into tb_recargosxtraf (ca_idtrafico, ca_idciudad, ca_idrecargo, ca_modalidad, ca_impoexpo, ca_aplicacion, ca_fchinicio, ca_fchvencimiento, ca_vlrfijo, ca_porcentaje, ca_baseporcentaje, ca_vlrunitario, ca_baseunitario, ca_recargominimo, ca_idmoneda, ca_observaciones) values('$idtrafico', '$idciudad', $idrecargo, '$modalidad', '$impoexpo', '$aplicacion', '$fchinicio', '$fchvencimiento', $vlrfijo, $porcentaje, '$baseporcentaje', $vlrunitario, '$baseunitario', $recargominimo, '$idmoneda', '$observaciones')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'recargosxtraf.php';</script>";
                 exit;
                  }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             if (!$rs->Open("update tb_recargosxtraf set ca_idrecargo = $idrecargo, ca_modalidad = '$modalidad', ca_impoexpo = '$impoexpo', ca_aplicacion = '$aplicacion', ca_fchinicio = '$fchinicio', ca_fchvencimiento = '$fchvencimiento', ca_vlrfijo = $vlrfijo, ca_porcentaje = $porcentaje, ca_baseporcentaje = '$baseporcentaje', ca_vlrunitario = $vlrunitario, ca_baseunitario = '$baseunitario', ca_recargominimo = $recargominimo, ca_idmoneda = '$idmoneda', ca_observaciones = '$observaciones' where oid = $oid")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'recargosxtraf.php';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_recargosxtraf where oid = $oid")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'recargosxtraf.php';</script>";
                 exit;
                }
             break;
             }
        }
   echo "<script>document.location.href = 'recargosxtraf.php';</script>";  // Retorna a la pantalla principal de la opción
   }
?>