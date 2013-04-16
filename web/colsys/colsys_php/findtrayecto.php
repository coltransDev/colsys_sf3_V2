<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       TRAYECTOS.PHP                                               \\
// Creado:        2004-05-04                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-04                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la tabla de Trayectos y el        \\
//                transportista que lo atiende.                               \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$imporexpor = array("Importación","Exportación");                              // Arreglo con los tipos de Trayecto
$modalidades= array("CONSOLIDADO","DIRECTO","LCL","FCL","COLOADING","PROYECTOS"); // Arreglo con los tipos de Modalidades de Carga
$transportes = array("Aéreo","Marítimo","Terrestre");                          // Arreglo con los tipos de Transportes

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($criterio) and !isset($boton) and !isset($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
    if (!$rs->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) { // Selecciona todos lo registros de la tabla Agentes
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    $tm =& DlRecordset::NewRecordset($conn);
    if (!$tm->Open("select c.ca_idciudad, c.ca_ciudad, c.ca_nombre from vi_puertos c order by c.ca_ciudad")) {       // Selecciona todos lo registros de la tabla Origenes
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    $tm->MoveFirst();
    while ( !$tm->Eof()) {
            echo "<INPUT TYPE='HIDDEN' NAME='ar_idciudad' VALUE=".$tm->Value('ca_idciudad').">";
            echo "<INPUT TYPE='HIDDEN' NAME='ar_ciudad' VALUE='".$tm->Value('ca_ciudad')."'>";
            echo "<INPUT TYPE='HIDDEN' NAME='ar_nombre' VALUE='".$tm->Value('ca_nombre')."'>";
            $tm->MoveNext();
          }
    echo "<HTML>";
    echo "<HEAD>";
    ?>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <?php
    echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
    echo "function validar(){";
    echo "  if (document.cabecera.idciudad.value == '')";
    echo "      alert('Seleccione la Ciudad o \'Todas las Ciudades\' para la busqueda');";
    echo "  else";
    echo "      return (true);";
    echo "  return (false);";
    echo "}";
    echo "function llenar_ciudades(){";
    echo "  document.cabecera.idciudad.length=0;";
    echo "  document.cabecera.idciudad.options[document.cabecera.idciudad.length] = new Option();";
    echo "  document.cabecera.idciudad.length=0;";
    echo "  document.cabecera.idciudad[document.cabecera.idciudad.length] = new Option('Todas las Ciudades','%',false,true);";
    echo "  document.cabecera.idciudad.selectedIndex=0;";
    echo "  if (isNaN(ar_ciudad.length)){";
    echo "      if (document.cabecera.nombre.value == ar_nombre.value){";
    echo "          document.cabecera.idciudad[document.cabecera.idciudad.length] = new Option(ar_idciudad.value,ar_ciudad.value,false,false);";
    echo "          }";
    echo "     }";
    echo "  else {";
    echo "     for (cont=0; cont<ar_ciudad.length; cont++) {";
    echo "          if (document.cabecera.nombre.value == ar_nombre[cont].value){";
    echo "              document.cabecera.idciudad[document.cabecera.idciudad.length] = new Option(ar_ciudad[cont].value,ar_idciudad[cont].value,false,false);";
    echo "           }";
    echo "       }";
    echo "     }";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='cabecera' ACTION='findtrayecto.php' ONSUBMIT='return validar();'>";
    echo "<INPUT TYPE='HIDDEN' NAME='boton' VALUE='Buscar'>";
    echo "<TABLE WIDTH=500 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=5 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</B></TH>";
    echo "<TR HEIGHT=50>";
    echo "  <TD Class=mostrar style='vertical-align:top;'><B>Impor/Exportación</B><BR><CENTER><SELECT NAME='impoexpo' SIZE=4>";
    $sel = " SELECTED";
    for ($i=0; $i < count($imporexpor); $i++) {
         echo " <OPTION VALUE=".$imporexpor[$i].$sel.">".$imporexpor[$i];
         $sel = "";
         }
    echo "  </SELECT></CENTER></CENTER></TD>";
    echo "  <TD Class=mostrar style='vertical-align:top;'><B>Transporte</B><BR><CENTER><SELECT NAME='transporte' SIZE=4>";
    $sel = " SELECTED";
    for ($i=0; $i < count($transportes); $i++) {
         echo " <OPTION VALUE=".$transportes[$i].$sel.">".$transportes[$i];
         $sel = "";
         }
    echo "  </SELECT></CENTER></TD>";
    echo "  <TD Class=mostrar style='vertical-align:top;' WIDTH=150><B>Tráfico</B><BR><CENTER><SELECT NAME='nombre' ONCHANGE='llenar_ciudades();' SIZE=4>";             // Llena el cuadro de lista con los valores de la tabla Traficos
    echo " <OPTION VALUE=% SELECTED>Todos los Tráficos</OPTION>";
    while ( !$rs->Eof()) {
            echo " <OPTION VALUE='".$rs->Value('ca_nombre')."'>".$rs->Value('ca_nombre')."</OPTION>";
            $rs->MoveNext();
          }
    echo "  </SELECT></CENTER></TD>";
    echo "  <TD Class=mostrar style='vertical-align:top;' WIDTH=150><B>Ciudad</B><BR><CENTER><SELECT NAME='idciudad' SIZE=4>";             // Llena el cuadro de lista con los valores de la tabla Traficos
    echo "  </SELECT></TD>";
    echo "  <TH><INPUT Class=submit TYPE='SUBMIT' NAME='boton' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=5></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar' ONCLICK='javascript:window.parent.frames.findtrayecto.style.visibility = \"hidden\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "<script>llenar_ciudades();</script>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (isset($boton) and !isset($criterio)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo
    if ($impoexpo == "Importación")
        $criterio = "ca_impoexpo = '$impoexpo' and ca_traorigen like '$nombre' and ca_origen like '$idciudad' and ca_transporte like '$transporte'"; 
    else
        $criterio = "ca_impoexpo = '$impoexpo' and ca_tradestino like '$nombre' and ca_destino like '$idciudad' and ca_transporte like '$transporte'";
    if (!$rs->Open("select * from vi_trayectos where $criterio")) {    // Selecciona todos lo registros de la tabla Modelos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function uno(src,color_entrada) {";
    echo "    src.style.background=color_entrada;src.style.cursor='hand'";
    echo "}";
    echo "function dos(src,color_default) {";
    echo "    src.style.background=color_default;src.style.cursor='default';";
    echo "}";
    echo "function seleccion(idtrayecto, trayecto) {";
    echo "    elemento = window.parent.document.getElementById('idtarifas');";
    echo "    elemento.value = idtrayecto;";
    echo "    elemento = window.parent.document.getElementById('tarifas');";
    echo "    elemento.value = trayecto;";
    echo "    window.parent.frames.findtrayecto.style.visibility = \"hidden\";";
    echo "    window.parent.document.body.scroll=\"yes\";";
    echo "    location.href = \"findtrayecto.php\";";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='cabecera' ACTION='findtrayecto.php'>";            // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=500 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TH COLSPAN=3>Relación de Trayectos</TH>";
    echo "<TR>";
    echo "  <TH>Origen</TH>";
    echo "  <TH>Destino</TH>";
    echo "  <TH>Línea</TH>";
    echo "</TR>";
    $nom_impoexpo = "";
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        echo "<TR style='background:F0F0F0' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" ONCLICK='javascript:seleccion(".$rs->Value('ca_idtrayecto').",\"".$rs->Value('ca_ciuorigen')."/".$rs->Value('ca_ciudestino')." - ".$rs->Value('ca_nombre')."\")'>";
        echo "  <TD Class=mostrar>".$rs->Value('ca_ciuorigen')."</TD>";
        echo "  <TD Class=mostrar>".$rs->Value('ca_ciudestino')."</TD>";
        echo "  <TD Class=mostrar>".$rs->Value('ca_nombre')."</TD>";
        echo "</TR>";
        $rs->MoveNext();
    }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=4></TD>";
    echo "</TR>";
    echo "</TABLE>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.findtrayecto.style.visibility = \"hidden\";'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    //   echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
}
?>