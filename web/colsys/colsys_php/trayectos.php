<?
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

$titulo = 'Tabla de Trayectos por Transportista';
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
    echo "<TITLE>$titulo</TITLE>";
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
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='cabecera' ACTION='trayectos.php' ONSUBMIT='return validar();'>";
    echo "<TABLE WIDTH=600 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
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
    echo "  <TH><INPUT Class=submit TYPE='SUBMIT' NAME='criterio' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=5></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "<script>llenar_ciudades();</script>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (!isset($boton) and !isset($accion) and isset($criterio)){
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
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id){";
    echo "    document.location.href = 'trayectos.php?boton='+opcion+'\&id='+id;";
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='trayectos.php'>";            // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=5>SISTEMA TARIFARIO<BR>$titulo</TH>";
    echo "  <TH WIDTH=44><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
    echo "</TR>";
    $nom_impoexpo = "";
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       if($nom_impoexpo != $rs->Value('ca_impoexpo')) {
          echo "<TR HEIGHT=20>";
          echo "<TD COLSPAN=6 Class=imprimir style='font-size: 12px; font-weight: bold; text-align=center'>".strtoupper($rs->Value('ca_impoexpo'))."</TD>";
          echo "</TR>";
          $nom_impoexpo = $rs->Value('ca_impoexpo');
          $nom_transpor = "";
         } 
       if($nom_transpor != $rs->Value('ca_transporte')) {
          echo "<TR HEIGHT=25>";
          echo "<TD COLSPAN=6 Class=imprimir style='font-size: 11px; font-weight: bold;'>".strtoupper($rs->Value('ca_transporte'))."</TD>";
          echo "</TR>";
          echo "<TH WIDTH=5>&nbsp</TH>";
          echo "<TH>Tráfico Origen</TH>";
          echo "<TH>Origen</TH>";
          echo "<TH>Tráfico Destino</TH>";
          echo "<TH>Destino</TH>";
          echo "<TH></TH>";  // Botón para la creación de un Registro Nuevo
          $nom_transpor = $rs->Value('ca_transporte');
         } 
       echo "<TR>";
       echo "  <TD Class=invertir style='font-size: 12px;' COLSPAN=6><B>".$rs->Value('ca_nombre')."</B></TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=invertir style='font-size: 11px;' COLSPAN=2><B>(Id Trayecto: ".$rs->Value('ca_idtrayecto').")</B></TD>";
       echo "  <TD Class=invertir style='font-size: 11px;' COLSPAN=4><B>Agente: ".$rs->Value('ca_nomtransportista')."</B> (Nit: ".number_format($rs->Value('ca_idtransportista')).")</TD>";
       echo "</TR>";
       echo "<TR>";
       echo "<TD Class=listar ROWSPAN=6></TD>";
       echo "<TD Class=listar style='font-size: 11px; font-weight: bold;'>".strtoupper($rs->Value('ca_traorigen'))."</TD>";
       echo "<TD Class=listar style='font-size: 11px;'><font color='#0000FF'>".$rs->Value('ca_origen')." ".$rs->Value('ca_ciuorigen')."</font></TD>";
       echo "<TD Class=listar style='font-size: 11px; font-weight: bold;'>".strtoupper($rs->Value('ca_tradestino'))."</TD>";
       echo "<TD Class=listar style='font-size: 11px;'><font color='#0000FF'>".$rs->Value('ca_destino')." ".$rs->Value('ca_ciudestino')."</font>";
       if ($rs->Value('ca_terminal') != "") {
           echo "<BR> » ";
           echo str_replace ("|","<BR> » ",$rs->Value('ca_terminal'));
          }
       echo "</TD>";
       echo "  <TD Class=listar>";                                                                                           // Botones para hacer Mantenimiento a la Tabla
       echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\",  ".$rs->Value('ca_idtrayecto').");'>";
       echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\",  ".$rs->Value('ca_idtrayecto').");'>";
       echo "  </TD>";
       echo "</TR>";
       echo "<TR>";
       echo "<TD Class=mostrar style='font-weight: bold;'>Import/Export:</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_impoexpo')."</TD>";
       echo "<TD Class=mostrar style='font-weight: bold;'>Modalidad:</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_modalidad')."</TD>";
       echo "<TD Class=mostrar ROWSPAN=5></TD>";
       echo "</TR>";
       echo "<TR>";
       echo "<TD Class=mostrar style='font-weight: bold;'>Transporte:</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_transporte')."</TD>";
       echo "<TD Class=mostrar style='font-weight: bold;'>Tiempo/Transito:</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_tiempotransito')."</TD>";
       echo "</TR>";
       echo "<TR>";
       echo "<TD Class=mostrar style='font-weight: bold;'>Frecuencia:</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_frecuencia')."</TD>";
       echo "<TD Class=mostrar style='font-weight: bold;'>Fch.Creado:</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_fchcreado')."</TD>";
       echo "</TR>";
       echo "<TR>";
       echo "<TD Class=mostrar style='font-weight: bold;'>Toma Tarifas de:</TD>";
       echo "<TD Class=mostrar COLSPAN=3>".(($rs->Value('ca_idtrayecto')!=$rs->Value('ca_idtarifas'))?$rs->Value('ca_tarifas'):"")."</TD>";
       echo "</TR>";
       echo "<TR>";
       echo "<TD Class=mostrar style='font-weight: bold;'>Nombre del Agente:</TD>";
       echo "<TD Class=mostrar COLSPAN=3>".$rs->Value('ca_nomagente')."</TD>";
       echo "</TR>";
       echo "<TR>";
       echo "<TD Class=mostrar></TD>";
       echo "<TD Class=mostrar COLSPAN=4><B>Observaciones:<BR></B>".nl2br($rs->Value('ca_observaciones'))."<BR>&nbsp</TD>";
       echo "<TD Class=mostrar onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href = \"fletes.php?id=".$rs->Value('ca_idtrayecto')."\"' style='color=blue; text-align: center;'>FLETES</TD>";
       echo "</TR>";
       echo "<TR HEIGHT=5>";
       echo "<TD Class=captura COLSPAN=6></TD>";
       echo "</TR>";
       $rs->MoveNext();
       }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Nueva Consulta' ONCLICK='javascript:document.location.href = \"trayectos.php\"'></TH>";  // Cancela la operación
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
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'trayectos.php';</script>";
                 exit; }
             $tm->MoveFirst();
             while ( !$tm->Eof()) {
                     echo "<INPUT TYPE='HIDDEN' NAME='idtraficos' VALUE=".$tm->Value('ca_idtrafico').">";
                     echo "<INPUT TYPE='HIDDEN' NAME='nomtraficos' VALUE='".$tm->Value('ca_nombre')."'>";
                     $tm->MoveNext();
                   }
             if (!$tm->Open("select ca_idciudad, ca_ciudad, ca_idtrafico from vi_puertos order by ca_ciudad")) { // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'trayectos.php';</script>";
                 exit; }
             $tm->MoveFirst();
             while ( !$tm->Eof()) {
                     echo "<INPUT TYPE='HIDDEN' NAME='idciudades' VALUE=".$tm->Value('ca_idciudad').">";
                     echo "<INPUT TYPE='HIDDEN' NAME='nomciudades' VALUE='".$tm->Value('ca_ciudad')."'>";
                     echo "<INPUT TYPE='HIDDEN' NAME='ciutraficos' VALUE='".$tm->Value('ca_idtrafico')."'>";
                     $tm->MoveNext();
                   }
             if (!$tm->Open("select ca_idlinea, ca_nombre, ca_transporte from vi_transporlineas order by ca_nombre")) { // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'trayectos.php';</script>";
                 exit; }
             $tm->MoveFirst();
             while ( !$tm->Eof()) {
                     echo "<INPUT TYPE='HIDDEN' NAME='aidlinea' VALUE=".$tm->Value('ca_idlinea').">";
                     echo "<INPUT TYPE='HIDDEN' NAME='anombre' VALUE='".$tm->Value('ca_nombre')."'>";
                     echo "<INPUT TYPE='HIDDEN' NAME='atransporte' VALUE='".$tm->Value('ca_transporte')."'>";
                     $tm->MoveNext();
                   }
             if (!$tm->Open("select ca_idagente, ca_nombre, ca_idtrafico from vi_agentes order by ca_nombre")) { // Selecciona todos lo registros de la tabla Agentes
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'reportenegocio.php';</script>";
                 exit; }
             $tm->MoveFirst();
             while (!$tm->Eof()) {
                    echo "<INPUT TYPE='HIDDEN' NAME='idagentes' VALUE=".$tm->Value('ca_idagente').">";
                    echo "<INPUT TYPE='HIDDEN' NAME='agentes' VALUE='".$tm->Value('ca_nombre')."'>";
                    echo "<INPUT TYPE='HIDDEN' NAME='idtraficoags' VALUE='".$tm->Value('ca_idtrafico')."'>";
                    $tm->MoveNext();
                   }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function llenar_traficos(){";
             echo "  document.adicionar.idtraorigen.length=0;";
             echo "  document.adicionar.idtraorigen.options[document.adicionar.idtraorigen.length] = new Option();";
             echo "  document.adicionar.idtraorigen.length=0;";
             echo "  document.adicionar.idtradestino.length=0;";
             echo "  document.adicionar.idtradestino.options[document.adicionar.idtradestino.length] = new Option();";
             echo "  document.adicionar.idtradestino.length=0;";
             echo "  if (document.adicionar.impoexpo.value == 'Importación'){";
             echo "      for (cont=0; cont<idtraficos.length; cont++) {";
             echo "           if (idtraficos[cont].value != 'CO-057')";
             echo "               document.adicionar.idtraorigen[document.adicionar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
             echo "           else";
             echo "               document.adicionar.idtradestino[document.adicionar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
             echo "           }";
             echo "       }";
             echo "  else {";
             echo "      for (cont=0; cont<idtraficos.length; cont++) {";
             echo "           if (idtraficos[cont].value == 'CO-057')";
             echo "               document.adicionar.idtraorigen[document.adicionar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
             echo "           else";
             echo "               document.adicionar.idtradestino[document.adicionar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
             echo "           }";
             echo "       }";
             echo "  llenar_origenes();";
             echo "  llenar_destinos();";
             echo "}";
             echo "function llenar_origenes(){";
             echo "  document.adicionar.idciuorigen.length=0;";
             echo "  document.adicionar.idciuorigen.options[document.adicionar.idciuorigen.length] = new Option();";
             echo "  document.adicionar.idciuorigen.length=0;";
             echo "  if (isNaN(idciudades.length)){";
             echo "      if (document.adicionar.idtraorigen.value == ciutraficos.value){";
             echo "          document.adicionar.idciuorigen[document.adicionar.idciuorigen.length] = new Option(nomciudades.value,idciudades.value,false,false);";
             echo "          }";
             echo "     }";
             echo "  else {";
             echo "     for (cont=0; cont<idciudades.length; cont++) {";
             echo "          if (document.adicionar.idtraorigen.value == ciutraficos[cont].value){";
             echo "              document.adicionar.idciuorigen[document.adicionar.idciuorigen.length] = new Option(nomciudades[cont].value,idciudades[cont].value,false,false);";
             echo "           }";
             echo "       }";
             echo "     }";
             echo "  llenar_agentes();";
             echo "}";
             echo "function llenar_destinos(){";
             echo "  document.adicionar.idciudestino.length=0;";
             echo "  document.adicionar.idciudestino.options[document.adicionar.idciudestino.length] = new Option();";
             echo "  document.adicionar.idciudestino.length=0;";
             echo "  if (isNaN(idciudades.length)){";
             echo "      if (document.adicionar.idtradestino.value == ciutraficos.value){";
             echo "          document.adicionar.idciudestino[document.adicionar.idciudestino.length] = new Option(nomciudades.value,idciudades.value,false,false);";
             echo "          }";
             echo "     }";
             echo "  else {";
             echo "     for (cont=0; cont<idciudades.length; cont++) {";
             echo "          if (document.adicionar.idtradestino.value == ciutraficos[cont].value){";
             echo "              document.adicionar.idciudestino[document.adicionar.idciudestino.length] = new Option(nomciudades[cont].value,idciudades[cont].value,false,false);";
             echo "           }";
             echo "       }";
             echo "     }";
             echo "}";
             echo "function llenar_lineas(){";
             echo "  document.adicionar.idlinea.length=0;";
             echo "  document.adicionar.idlinea.options[document.adicionar.idlinea.length] = new Option();";
             echo "  document.adicionar.idlinea.length=0;";
             echo "  for (cont=0; cont<aidlinea.length; cont++) {";
             echo "       if (document.adicionar.transporte.value == atransporte[cont].value){";
             echo "           document.adicionar.idlinea[document.adicionar.idlinea.length] = new Option(anombre[cont].value,aidlinea[cont].value,false,false);";
             echo "           }";
             echo "       }";
             echo "}";
             echo "function llenar_agentes(){";
             echo "  document.adicionar.idagente.length=0;";
             echo "  document.adicionar.idagente.options[document.adicionar.idagente.length] = new Option();";
             echo "  document.adicionar.idagente.length=0;";
             echo "  document.adicionar.idagente[document.adicionar.idagente.length] = new Option('SIN ESPECIFICAR',0,false,false);";
             echo "  if (isNaN(idagentes.length)){";
             echo "      if (document.adicionar.idtraorigen.value == idtraficoags.value){";
             echo "          document.adicionar.idagente[document.adicionar.idagente.length] = new Option(agentes.value,idagentes.value,false,false);";
             echo "          }";
             echo "     }";
             echo "  else {";
             echo "     for (cont=0; cont<idagentes.length; cont++) {";
             echo "          if (document.adicionar.idtraorigen.value == idtraficoags[cont].value){";
             echo "              document.adicionar.idagente[document.adicionar.idagente.length] = new Option(agentes[cont].value,idagentes[cont].value,false,false);";
             echo "           }";
             echo "       }";
             echo "     }";
             echo "}";
             echo "function validar(){";
             echo "  if (document.adicionar.idciuorigen.value == '')";
             echo "      alert('Seleccione la Ciudad de Origen');";
             echo "  else if (document.adicionar.idciudestino.value == '')";
             echo "      alert('Seleccione la Ciudad de Destino');";
             echo "  else if (document.adicionar.frecuencia.value == '')";
             echo "      alert('Establezca la Frecuencia del Trayecto');";
             echo "  else if (document.adicionar.tiempotransito.value == '')";
             echo "      alert('Establezca un Tiempo de Transito para el Trayecto');";
             echo "  else";
             echo "      return (true);";
             echo "  return (false);";
             echo "}";
             echo "function buscar_trayecto(){";
             echo "  findtrayecto.style.visibility = \"visible\";";
             echo "  findtrayecto.style.left = eval((document.body.clientWidth/2)-(600/2));";
             echo "  findtrayecto.style.top = document.body.clientHeight-152;";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<DIV ID='findtrayecto' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";
             echo "<IFRAME SRC='findtrayecto.php' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:150'>";
             echo "</IFRAME>";
             echo "</DIV>";
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='trayectos.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<INPUT ID=idtrayecto TYPE='HIDDEN' NAME='idtarifas' VALUE=0>";
             echo "<TABLE WIDTH=500 CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=5>Datos sobre el nuevo Trayecto</TH>";
             echo "<TR>";
             echo "  <TH Class=titulo>Impor/Exportación</TH>";
             echo "  <TH Class=titulo COLSPAN=2>Ciudad de Origen</TH>";
             echo "  <TH Class=titulo COLSPAN=2>Ciudad de Destino</TH>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'><SELECT NAME='impoexpo' ONCHANGE='llenar_traficos();'>";
             for ($i=0; $i < count($imporexpor); $i++) {
                  echo " <OPTION VALUE=".$imporexpor[$i].">".$imporexpor[$i];
                  }
             echo "  </SELECT></TD>";
             echo "  <TD Class=listar WIDTH=160 ROWSPAN=5><SELECT NAME='idtraorigen' ONCHANGE='llenar_origenes();'>";  // Llena el cuadro de lista con los valores de la tabla Traficos
             echo "  </SELECT></TD>";
             echo "  <TD Class=listar WIDTH=160 ROWSPAN=5><SELECT NAME='idciuorigen' SIZE=7'>";          // Llena el cuadro de lista con los valores de la tabla Origenes
             echo "  </SELECT></TD>";
             echo "  <TD Class=listar WIDTH=160 ROWSPAN=5><SELECT NAME='idtradestino' ONCHANGE='llenar_destinos();'>"; // Llena el cuadro de lista con los valores de la tabla Traficos
             echo "  </SELECT></TD>";
             echo "  <TD Class=listar WIDTH=160 ROWSPAN=5><SELECT NAME='idciudestino' SIZE=7'>";         // Llena el cuadro de lista con los valores de la tabla Destinos
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>&nbsp</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='font-weight: bold;'>Transporte:</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura><SELECT NAME='transporte' ONCHANGE='llenar_lineas();'>";
             for ($i=0; $i < count($transportes); $i++) {
                  echo " <OPTION VALUE=".$transportes[$i].">".$transportes[$i];
                  }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>&nbsp</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Transportista:</TD>";
             echo "  <TD Class=mostrar COLSPAN=4><SELECT NAME='idlinea'>";             // Llena el cuadro de lista con los valores de la tabla Transportistas
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Agente Coltrans:</TD>";
             echo "  <TD Class=mostrar COLSPAN=4><SELECT NAME='idagente'>";                              // Llena el cuadro de lista con los valores de la tabla Agentes
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura></TD>";
             echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
             echo "  <TD Class=captura>Modalidad:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='modalidad'>";
             for ($i=0; $i < count($modalidades); $i++) {
                  echo " <OPTION VALUE=".$modalidades[$i].">".$modalidades[$i];
                  }
             echo "  </SELECT></TD>";
             echo "  <TD Class=titulo COLSPAN=2 ROWSPAN=4><B>Toma Tarifas de:</B><BR><BR><TEXTAREA ID=trayecto NAME='tarifas' WRAP=virtual READONLY ROWS=4 COLS=35></TEXTAREA><BR><BR><INPUT Class=button TYPE='BUTTON' NAME='buscar' VALUE='Buscar Trayecto' ONCLICK='buscar_trayecto();'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Frecuencia:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='frecuencia' SIZE=19 MAXLENGTH=20></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tiempo/Transito:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='tiempotransito' SIZE=19 MAXLENGTH=25></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fch.Creado:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fchcreado' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "</TR>";
             echo "</TABLE></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "<TD Class=captura style='vertical-align:top;'>Observaciones:</TD>";
             echo "<TD Class=mostrar COLSPAN=5><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=5 COLS=80></TEXTAREA></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"trayectos.php\"'></TH>";  // Cancela la operación
             echo "<script>llenar_traficos();</script>";
             echo "<script>llenar_lineas();</script>";
             echo "<script>adicionar.impoexpo.focus();</script>";
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
             if (!$rs->Open("select * from vi_trayectos where ca_idtrayecto = ".$id)) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'trayectos.php';</script>";
                 exit;
                }
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select ca_idlinea, ca_nombre, ca_transporte from tb_transporlineas order by ca_nombre")) { // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'trayectos.php';</script>";
                 exit; }
             $tm->MoveFirst();
             while ( !$tm->Eof()) {
                     echo "<INPUT TYPE='HIDDEN' NAME='aidlinea' VALUE=".$tm->Value('ca_idlinea').">";
                     echo "<INPUT TYPE='HIDDEN' NAME='anombre' VALUE='".$tm->Value('ca_nombre')."'>";
                     echo "<INPUT TYPE='HIDDEN' NAME='atransporte' VALUE='".$tm->Value('ca_transporte')."'>";
                     $tm->MoveNext();
                   }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function llenar_lineas(){";
             echo "  document.modificar.idlinea.length=0;";
             echo "  document.modificar.idlinea.options[document.modificar.idlinea.length] = new Option();";
             echo "  document.modificar.idlinea.length=0;";
             echo "  for (cont=0; cont<aidlinea.length; cont++) {";
             echo "       if (document.modificar.transporte.value == atransporte[cont].value){";
             echo "           document.modificar.idlinea[document.modificar.idlinea.length] = new Option(anombre[cont].value,aidlinea[cont].value,false,false);";
             echo "           }";
             echo "       }";
             echo "}";
             echo "function validar(){";
             echo "  if (document.modificar.frecuencia.value == '')";
             echo "      alert('Establezca la Frecuencia del Trayecto');";
             echo "  else if (document.modificar.tiempotransito.value == '')";
             echo "      alert('Establezca un Tiempo de Transito para el Trayecto');";
             echo "  else";
             echo "      return (true);";
             echo "  return (false);";
             echo "}";
             echo "function buscar_trayecto(){";
             echo "  findtrayecto.style.visibility = \"visible\";";
             echo "  findtrayecto.style.left = eval((document.body.clientWidth/2)-(600/2));";
             echo "  findtrayecto.style.top = document.body.clientHeight-152;";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<DIV ID='findtrayecto' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";
             echo "<IFRAME SRC='findtrayecto.php' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:150'>";
             echo "</IFRAME>";
             echo "</DIV>";
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='modificar' ACTION='trayectos.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<INPUT ID=idtrayecto TYPE='HIDDEN' NAME='idtarifas' VALUE=".$rs->Value('ca_idtarifas').">";
             echo "<TABLE WIDTH=500 CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificado
             echo "<TH Class=titulo COLSPAN=5>Nuevos Datos sobre el Trayecto</TH>";
             echo "<TR>";
             echo "  <TH Class=titulo>Impor/Exportación</TH>";
             echo "  <TH Class=titulo COLSPAN=2>Ciudad de Origen</TH>";
             echo "  <TH Class=titulo COLSPAN=2>Ciudad de Destino</TH>";
             echo "</TR>";
             echo "<TR HEIGHT=30>";
             echo "  <TD Class=captura>".$rs->Value('ca_impoexpo')."</TD>";
             echo "  <TD Class=listar WIDTH=160 style='font-size: 11px; font-weight: bold; text-align=center'>".$rs->Value('ca_traorigen')."</TD>";
             echo "  <TD Class=listar WIDTH=160 style='font-size: 11px; font-weight: bold; text-align=center'>".$rs->Value('ca_ciuorigen')."</TD>";
             echo "  <TD Class=listar WIDTH=160 style='font-size: 11px; font-weight: bold; text-align=center'>".$rs->Value('ca_tradestino')."</TD>";
             echo "  <TD Class=listar WIDTH=160 style='font-size: 11px; font-weight: bold; text-align=center'>".$rs->Value('ca_ciudestino')."</TD>";
             echo "</TR>";
             if (!$tm->Open("select ca_idlinea, ca_nombre from tb_transporlineas where ca_transporte = '".$rs->Value('ca_transporte')."' order by ca_nombre")) { // Selecciona todos lo registros de la tabla Transportistas
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'trayectos.php';</script>";
                 exit; }
             echo "<TR>";
             echo "  <TD Class=captura>Transportista:</TD>";
             echo "  <TD Class=mostrar COLSPAN=4><SELECT NAME='idlinea'>";             // Llena el cuadro de lista con los valores de la tabla Transportistas
             $tm->MoveFirst();
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE=".$tm->Value('ca_idlinea');
                     if ($tm->Value('ca_idlinea')==$rs->Value('ca_idlinea')) {
                         echo" SELECTED"; }
                     echo ">".$tm->Value('ca_nombre')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
             if (!$tm->Open("select ca_idagente, ca_nombre, ca_idtrafico from vi_agentes where ca_idtrafico = '".$rs->Value('ca_idtraorigen')."' order by ca_nombre")) { // Selecciona todos lo registros de la tabla Agentes
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'trayectos.php';</script>";
                 exit; }
             echo "<TR>";
             echo "  <TD Class=captura>Agente Coltrans:</TD>";
             echo "  <TD Class=mostrar COLSPAN=4><SELECT NAME='idagente'>";                              // Llena el cuadro de lista con los valores de la tabla Agentes
             echo "  <OPTION VALUE=0>SIN ESPECIFICAR</OPTION>";
             $tm->MoveFirst();
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE=".$tm->Value('ca_idagente');
                     if ($tm->Value('ca_idagente')==$rs->Value('ca_idagente')) {
                         echo" SELECTED"; }
                     echo ">".$tm->Value('ca_nombre')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura></TD>";
             echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
             echo "  <TD Class=captura>Transporte:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='transporte' ONCHANGE='llenar_lineas();'>";
             for ($i=0; $i < count($transportes); $i++) {
                  echo " <OPTION VALUE=".$transportes[$i];
                  if ($rs->Value('ca_transporte')==$transportes[$i]) {
                      echo " SELECTED"; }
                  echo ">".$transportes[$i];
                  }
             echo "  </SELECT></TD>";
             echo "  <TD Class=titulo COLSPAN=2 ROWSPAN=4><B>Toma Tarifas de:</B><BR><BR><TEXTAREA NAME='tarifas' WRAP=virtual READONLY ROWS=4 COLS=35>".(($rs->Value('ca_idtrayecto')!=$rs->Value('ca_idtarifas'))?$rs->Value('ca_tarifas'):"")."</TEXTAREA><BR><BR><INPUT Class=button TYPE='BUTTON' NAME='buscar' VALUE='Buscar Trayecto' ONCLICK='buscar_trayecto();'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Modalidad:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='modalidad'>";
             for ($i=0; $i < count($modalidades); $i++) {
                  echo " <OPTION VALUE=".$modalidades[$i];
                  if ($rs->Value('ca_modalidad')==$modalidades[$i]) {
                      echo " SELECTED"; }
                  echo ">".$modalidades[$i];
                  }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Frecuencia:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='frecuencia' SIZE=15 VALUE='".$rs->Value('ca_frecuencia')."' MAXLENGTH=20></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tiempo/Transito:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='tiempotransito' VALUE='".$rs->Value('ca_tiempotransito')."' SIZE=15 MAXLENGTH=25></TD>";
             echo "</TR>";
             echo "</TABLE></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "<TD Class=captura style='vertical-align:top;'>Observaciones:</TD>";
             echo "<TD Class=mostrar COLSPAN=5><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=5 COLS=80>".$rs->Value('ca_observaciones')."</TEXTAREA></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"trayectos.php\"'></TH>";  // Cancela la operación
//           echo "<script>modificar.idtransportista.focus();</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Eliminar': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_trayectos where ca_idtrayecto = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'trayectos.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='eliminar' ACTION='trayectos.php'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=5>Datos del Trayecto a Eliminar</TH>";
             echo "<TR>";
             echo "  <TH Class=titulo>Impor/Exportación</TH>";
             echo "  <TH Class=titulo COLSPAN=2>Ciudad de Origen</TH>";
             echo "  <TH Class=titulo COLSPAN=2>Ciudad de Destino</TH>";
             echo "</TR>";
             echo "<TR HEIGHT=30>";
             echo "  <TD Class=captura>".$rs->Value('ca_impoexpo')."</TD>";
             echo "  <TD Class=listar style='font-size: 11px; font-weight: bold; text-align=center'>".$rs->Value('ca_traorigen')."</TD>";
             echo "  <TD Class=listar style='font-size: 11px; font-weight: bold; text-align=center'>".$rs->Value('ca_ciuorigen')."</TD>";
             echo "  <TD Class=listar style='font-size: 11px; font-weight: bold; text-align=center'>".$rs->Value('ca_tradestino')."</TD>";
             echo "  <TD Class=listar style='font-size: 11px; font-weight: bold; text-align=center'>".$rs->Value('ca_ciudestino')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Transportista:</TD>";
             echo "  <TD Class=mostrar COLSPAN=4>".$rs->Value('ca_nombre')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Agente:</TD>";
             echo "  <TD Class=mostrar COLSPAN=4>".$rs->Value('ca_nomagente')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura ROWSPAN=3></TD>";
             echo "  <TD Class=captura>Transporte:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_transporte')."</TD>";
             echo "  <TD Class=captura>Frecuencia:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_frecuencia')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Modalidad:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_modalidad')."</TD>";
             echo "  <TD Class=captura>Tiempo/Transito:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_tiempotransito')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fch.Creado:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_fchcreado')."</TD>";
             echo "  <TD Class=captura>Toma de Tarifas de:</TD>";
             echo "  <TD Class=mostrar>".(($rs->Value('ca_idtrayecto')!=$rs->Value('ca_idtarifas'))?$rs->Value('ca_tarifas'):"")."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "<TD Class=captura style='vertical-align:top;'>Observaciones:</TD>";
             echo "<TD Class=mostrar COLSPAN=5>".nl2br($rs->Value('ca_observaciones'))."</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"trayectos.php\"'></TH>";  // Cancela la operación
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
    switch(trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Guardar': {                                                      // El Botón Guardar fue pulsado
             $idtarifas = ($idtarifas==0)?"currval('tb_trayectos_id')":$idtarifas;
             if (!$rs->Open("insert into tb_trayectos (ca_origen, ca_destino, ca_idlinea, ca_transporte, ca_impoexpo, ca_frecuencia, ca_tiempotransito, ca_modalidad, ca_fchcreado, ca_idtarifas, ca_observaciones, ca_idagente) values('$idciuorigen', '$idciudestino', $idlinea, '$transporte', '$impoexpo', '$frecuencia', '$tiempotransito', '$modalidad', '$fchcreado', $idtarifas, '$observaciones', $idagente)")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'trayectos.php';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             $terminales = isset($terminales)?implode("|",$terminales):"";
             if (!$rs->Open("update tb_trayectos set ca_idlinea = $idlinea, ca_transporte = '$transporte', ca_frecuencia = '$frecuencia', ca_tiempotransito = '$tiempotransito', ca_modalidad = '$modalidad', ca_idtarifas = $idtarifas, ca_observaciones = '$observaciones', ca_idagente = $idagente where ca_idtrayecto = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'trayectos.php';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_trayectos where ca_idtrayecto = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'trayectos.php';</script>";
                 exit;
                }
             break;
             }
        }
   echo "<script>document.location.href = 'trayectos.php';</script>";  // Retorna a la pantalla principal de la opción
   }
?>