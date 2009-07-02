<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       TARIFARIO.PHP                                               \\
// Creado:        2004-04-21                                                  \\
// Autor:         Carlos Gilberto L�pez M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-21                                                  \\
//                                                                            \\
// Descripci�n:   M�dulo para la Consulta de Tarifas.                         \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
$programa = 99999;

$titulo = 'M�dulo de Consultas a Tarifas por Tr�fico';
$imporexpor = array("Importaci�n","Exportaci�n");                              // Arreglo con los tipos de Trayecto
$transportes = array("A�reo","Mar�timo","Terrestre");                          // Arreglo con los tipos de Transportes
$modalidades = array("&nbsp&nbsp&nbsp=-&nbspTODAS&nbsp-=&nbsp&nbsp&nbsp"=>"%","CONSOLIDADO"=>"CONSOLIDADO","DIRECTO"=>"DIRECTO","LCL"=>"LCL","FCL"=>"FCL","COLOADING"=>"COLOADING","PROYECTOS"=>"PROYECTOS");         // Arreglo con los tipos de Modalidades de Carga
$umedidas = array("Metros","Pulgadas","Cent�metros","Pies");                   // Arreglo con las unidades de medida
$upesos = array("Tonelas","Kilogramos","Libras");                              // Arreglo con las unidades de pesos
$tincoterms = array("EXW - EX Works","FCA - Free Carrier","FAS - Free Alongside Ship","FOB - Free On Board","CIF - Cost, Insuarance & Freight", "CIP - Carriage and Insurence Paid", "CPT - Carriage Paid To", "CFR - Cost and Freight", "DDP - Delivered Duty Paid", "DDU - Delivered Duty Unpaid", "DAF - Delivered at Frontier"); // Arreglo con los t�rminos Iconterms

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
include_once 'include/functions.php';                                          // Funciones de Usuarios para PHP
require_once("checklogin.php");                                                                 // Captura las variables de la sessi�n abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificaci�n del m�dulo para la ayuda en l�nea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al m�dulo

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<BODY>";
require_once("menu.php");
    $tm =& DlRecordset::NewRecordset($conn);
    if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'tarifario.php';</script>";
        exit; }
    $tm->MoveFirst();
    while (!$tm->Eof()) {
           echo "<INPUT TYPE='HIDDEN' NAME='idtraficos' VALUE=".$tm->Value('ca_idtrafico').">";
           echo "<INPUT TYPE='HIDDEN' NAME='nomtraficos' VALUE='".$tm->Value('ca_nombre')."'>";
           $tm->MoveNext();
          }
    if (!$tm->Open("select ca_idciudad, ca_ciudad, ca_idtrafico from vi_puertos order by ca_ciudad")) { // Selecciona todos lo registros de la tabla Ciudades
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'tarifario.php';</script>";
        exit; }
    $tm->MoveFirst();
    while (!$tm->Eof()) {
           echo "<INPUT TYPE='HIDDEN' NAME='idciudades' VALUE=".$tm->Value('ca_idciudad').">";
           echo "<INPUT TYPE='HIDDEN' NAME='nomciudades' VALUE='".$tm->Value('ca_ciudad')."'>";
           echo "<INPUT TYPE='HIDDEN' NAME='ciutraficos' VALUE='".$tm->Value('ca_idtrafico')."'>";
           $tm->MoveNext();
          }
    if (!$tm->Open("select ca_impoexpo, ca_transporte, ca_idlinea, ca_nombre, ca_sigla from vi_trayectos group by ca_impoexpo, ca_transporte, ca_idlinea, ca_nombre, ca_sigla order by ca_nombre")) { // Selecciona todos lo registros de la tabla Ciudades
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'tarifario.php';</script>";
        exit; }
    $tm->MoveFirst();
    while (!$tm->Eof()) {
           echo "<INPUT TYPE='HIDDEN' NAME='tr_impoexpo' VALUE=".$tm->Value('ca_impoexpo').">";
           echo "<INPUT TYPE='HIDDEN' NAME='tr_transporte' VALUE='".$tm->Value('ca_transporte')."'>";
           echo "<INPUT TYPE='HIDDEN' NAME='tr_idlinea' VALUE='".$tm->Value('ca_idlinea')."'>";
           echo "<INPUT TYPE='HIDDEN' NAME='tr_nombre' VALUE='".(strlen($tm->Value('ca_sigla'))>0?$tm->Value('ca_sigla'):$tm->Value('ca_nombre'))."'>";
           $tm->MoveNext();
          }
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
	echo "function uno(src,color_entrada) {";
	echo "    src.style.background=color_entrada;src.style.cursor='hand'";
	echo "}";
	echo "function dos(src,color_default) {";
	echo "    src.style.background=color_default;src.style.cursor='default';";
	echo "}";
    echo "function validar(){";
    echo "  if (!chkDate(document.adicionar.fchcotizacion))";
    echo "      document.adicionar.fchcotizacion.focus();";
    echo "  else if (document.adicionar.idciuorigen.value == '')";
    echo "      alert('Seleccione la Ciudad o Todas las Ciudades del Origen');";
    echo "  else if (document.adicionar.idciudestino.value == '')";
    echo "      alert('Seleccione la Ciudad o Todas las Ciudades del de Destino');";
    echo "  else";
    echo "      return (true);";
    echo "  return (false);";
    echo "}";
    echo "function llenar_traficos(){";
    echo "  document.adicionar.idtraorigen.length=0;";
    echo "  document.adicionar.idtraorigen.options[document.adicionar.idtraorigen.length] = new Option();";
    echo "  document.adicionar.idtraorigen.length=0;";
    echo "  document.adicionar.idtradestino.length=0;";
    echo "  document.adicionar.idtradestino.options[document.adicionar.idtradestino.length] = new Option();";
    echo "  document.adicionar.idtradestino.length=0;";
    echo "  if (document.adicionar.impoexpo.value == 'Importaci�n'){";
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
    echo "  llenar_transportistas();";
    echo "}";
    echo "function llenar_origenes(){";
    echo "  document.adicionar.idciuorigen.length=0;";
    echo "  document.adicionar.idciuorigen.options[document.adicionar.idciuorigen.length] = new Option();";
    echo "  document.adicionar.idciuorigen.length=0;";
    echo "  document.adicionar.idciuorigen[document.adicionar.idciuorigen.length] = new Option('Todas las Ciudades','%',false,true);";
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
    echo "}";
    echo "function llenar_destinos(){";
    echo "  document.adicionar.idciudestino.length=0;";
    echo "  document.adicionar.idciudestino.options[document.adicionar.idciudestino.length] = new Option();";
    echo "  document.adicionar.idciudestino.length=0;";
    echo "  document.adicionar.idciudestino[document.adicionar.idciudestino.length] = new Option('Todas las Ciudades','%',false,true);";
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
    echo "function llenar_transportistas(){";
    echo "  document.adicionar.transportista.length=0;";
    echo "  document.adicionar.transportista.options[document.adicionar.transportista.length] = new Option();";
    echo "  document.adicionar.transportista.length=0;";
    echo "  document.adicionar.transportista[document.adicionar.transportista.length] = new Option('Todos los Transportistas','%',false,true);";
    echo "  if (isNaN(tr_nombre.length)){";
    echo "      if (document.adicionar.impoexpo.value == tr_impoexpo.value && document.adicionar.transporte.value == tr_transporte.value){";
    echo "          document.adicionar.transportista[document.adicionar.transportista.length] = new Option(tr_nombre.value,tr_idlinea.value,false,false);";
    echo "          }";
    echo "     }";
    echo "  else {";
    echo "     for (cont=0; cont<tr_nombre.length; cont++) {";
    echo "          if (document.adicionar.impoexpo.value == tr_impoexpo[cont].value && document.adicionar.transporte.value == tr_transporte[cont].value){";
    echo "              document.adicionar.transportista[document.adicionar.transportista.length] = new Option(tr_nombre[cont].value,tr_idlinea[cont].value,false,false);";
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
    echo "<H4>$titulo</H4>";
    echo "<FORM METHOD=post NAME='adicionar' ACTION='tarifario.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
    echo "<INPUT TYPE='HIDDEN' NAME='idcliente' VALUE=0>";            // Por ser m�dulo para simulacion de tarifas por ahora
    echo "<TABLE WIDTH=580 CELLSPACING=1>";
    echo "<TH Class=titulo COLSPAN=6>Datos b�sicos del Tr�fico</TH>";
    echo "<TR>";
    echo "  <TD Class=mostrar COLSPAN=2><B>Fecha :</B><BR><CENTER><INPUT TYPE='TEXT' NAME='fchcotizacion' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";
    echo "  <TD Class=mostrar><B>Impor/Exportaci�n :</B><BR><CENTER><SELECT NAME='impoexpo' ONCHANGE='llenar_traficos();'>";
    for ($i=0; $i < count($imporexpor); $i++) {
         echo " <OPTION VALUE=".$imporexpor[$i].">".$imporexpor[$i];
        }
    echo "  </SELECT></CENTER></TD>";
    echo "  <TD Class=mostrar><B>Transporte :</B><BR><CENTER><SELECT NAME='transporte' ONCHANGE='llenar_transportistas();'>";
    for ($i=0; $i < count($transportes); $i++) {
         echo " <OPTION VALUE=".$transportes[$i].">".$transportes[$i];
        }
    echo "  </SELECT></CENTER></TD>";
    echo "  <TD Class=mostrar COLSPAN=2><B>Modalidad :</B><BR><CENTER><SELECT NAME='modalidad'>";
    while (list ($clave, $val) = each ($modalidades)) {
        echo " <OPTION VALUE='".$val."'".(($val=='ca_referencia')?" SELECTED":"").">".$clave;
        }
    echo "  </SELECT></CENTER></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=3>Ciudad de Origen</TH>";
    echo "  <TH Class=titulo COLSPAN=3>Ciudad de Destino</TH>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=160 COLSPAN=2><SELECT NAME='idtraorigen' ONCHANGE='llenar_origenes();'>";  // Llena el cuadro de lista con los valores de la tabla Traficos
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=160><SELECT NAME='idciuorigen' SIZE=6>";          // Llena el cuadro de lista con los valores de la tabla Origenes
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=160 COLSPAN=2><SELECT NAME='idtradestino' ONCHANGE='llenar_destinos();'>"; // Llena el cuadro de lista con los valores de la tabla Traficos
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=160><SELECT NAME='idciudestino' SIZE=6>";         // Llena el cuadro de lista con los valores de la tabla Destinos
    echo "  </SELECT></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=mostrar><B>Transportistas :</B></TD>";
    echo "  <TD Class=mostrar COLSPAN=5><SELECT NAME='transportista'>";
    echo "  </SELECT></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=6></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar ROWSPAN=6><B>Otras Tablas :</B></TD>";
    echo "  <TD Class=listar COLSPAN=5><A HREF=\"#\" ONCLICK='javascript:window.open(\"./links/TARIFAS LCL VENTA DE OTM BOGOTA.pdf\")'><B>Tarifas LCL Venta de OTM Bogot�&nbsp �Haga Click aqu� para consultar�.</A></B></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=5><A HREF=\"#\" ONCLICK='javascript:window.open(\"./links/TARIFAS FCL VENTA DE OTM BOGOTA.xls\")'><B>Tarifas FCL Venta de OTM Bogot�&nbsp �Haga Click aqu� para consultar�.</A></B></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=5><A HREF=\"#\" ONCLICK='javascript:window.open(\"./links/CONDICIONES LOCALES NAVIERAS.xls\")'><B>Cuadro Condiciones Locales de Navieras &nbsp �Haga Click aqu� para consultar�.</A></B></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=5><A HREF=\"#\" ONCLICK='javascript:window.open(\"./links/TARIFARIO ASW.xls\")'><B>Tarifario ASW &nbsp; �Haga Click aqu� para consultar�.</A></B></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=5><A HREF=\"#\" ONCLICK='javascript:window.open(\"./links/TARIFAS EXPORTACION.xls\")'><B>Tarifario de Exportaci�n &nbsp; �Haga Click aqu� para consultar�.</A></B></TD>";
    echo "</TR>";
	 echo "<TR>";
    echo "  <TD Class=listar COLSPAN=5><A HREF=\"#\" ONCLICK='javascript:window.open(\"./links/TARIFARIO DE IMPORTACION PRINCIPALES TR�FICOS FCL-LCL.xls\")'><B>TARIFARIO DE IMPORTACION PRINCIPALES TR�FICOS FCL/LCL&nbsp; �Haga Click aqu� para consultar�.</A></B></TD>";
    echo "</TR>";
//    echo "<TR>";
//    echo "  <TD Class=listar COLSPAN=5><A HREF=\"#\" ONCLICK='javascript:window.open(\"./links/Cuadro condiciones Deposito-Dropoff.pdf\")'><B>Cuadro de Condiciones Dep�sito - Dropoff &nbsp �Haga Click aqu� para consultar�. <IMG SRC='./graficos/nuevo.gif' border=0 ALT='Nuevo Item'></A></TD>";
//    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=6></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='boton' VALUE='Consultar'></TH>";           // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar ' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operaci�n
    echo "<script>llenar_traficos();</script>";
    echo "<script>adicionar.impoexpo.focus();</script>";
    echo "</TABLE><BR>";

    if (!$tm->Open("select DISTINCT ca_impoexpo, ca_transporte, ca_nombre, ca_idtraorigen, ca_traorigen, ca_idtradestino, ca_tradestino from vi_trayectos where ca_idtrayecto in (select DISTINCT ca_idtrayecto from tb_fletes where ca_fchcreado >= (date(now())-7) or ca_fchactualizado >= (date(now())-7) order by ca_idtrayecto) order by ca_impoexpo DESC, ca_transporte, ca_nombre, ca_traorigen, ca_tradestino")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'tarifario.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "<TABLE WIDTH=580 CELLSPACING=1>";
    echo "<TR>";
    echo "  <TD Class=titulo COLSPAN=5><B>Actualizaciones a Tarifario en los �ltimos 8 d�as</B> <IMG SRC='./graficos/nuevo.gif' border=0 ALT='Nuevo Item'></TD>";
    echo "</TR>";
	$impoexpo_mem = '';
	$transpor_mem = '';
	while (!$tm->Eof()) {
	   if ($impoexpo_mem != $tm->Value('ca_impoexpo')){
	   		$impoexpo_mem = $tm->Value('ca_impoexpo');
			$transpor_mem = '';
	   		echo "<TR>";
	   		echo "  <TD Class=titulo COLSPAN=5><B>".strtoupper($tm->Value('ca_impoexpo'))."</B></TD>";
			echo "</TR>"; }
	   if ($transpor_mem != $tm->Value('ca_transporte')){
	   		$transpor_mem = $tm->Value('ca_transporte');
	   		echo "<TR>";
	   		echo "  <TD Class=listar COLSPAN=5><B>".strtoupper($tm->Value('ca_transporte'))."</B></TD>";
	   		echo "</TR>"; }
	   echo "<TR onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'$sug_mem');\"  onclick='document.location.href = \"tarifario.php?boton=Consultar&impoexpo=$impoexpo_mem&transporte=$transpor_mem&modalidad=%&idtraorigen=".$tm->Value('ca_idtraorigen')."&idtradestino=".$tm->Value('ca_idtradestino')."&idciuorigen=%&idciudestino=%&transportista=%\"'>";
	   echo "  <TD>&nbsp</TD>";
	   echo "  <TD>".$tm->Value('ca_nombre')."</TD>";
   	   echo "  <TD>".$tm->Value('ca_traorigen')."</TD>";
	   echo "  <TD>".$tm->Value('ca_tradestino')."</TD>";
	   echo "  <TD><IMG SRC='./graficos/vista.gif' border=0 ALT='Consultar Tarifas'></TD>";
	   echo "</TR>";
	   $tm->MoveNext();
	  }
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (isset($boton)) {                                                       // Switch que evalua cual bot�n de comando fue pulsado por el usuario
    switch(trim($boton)) {
        case 'Consultar': {                                                    // Opcion para Adicionar Registros a la tabla
             if (!$rs->Open("select * from vi_trayectos where ca_impoexpo = '$impoexpo' and ca_transporte = '$transporte' and ca_modalidad like '$modalidad' and ca_idtraorigen = '$idtraorigen' and ca_idtradestino = '$idtradestino' and ca_origen like '$idciuorigen' and ca_destino like '$idciudestino' and ca_idlinea like '$transportista'")) {          // Selecciona todos lo registros de la tabla Grupos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $trayectos = array();
             while (!$rs->Eof() and !$rs->IsEmpty()) {
                 if (!in_array($rs->Value('ca_idtarifas'), $trayectos)){
                     array_push($trayectos, $rs->Value('ca_idtarifas'));}
                 $rs->MoveNext();
                }
             asort ($trayectos);
             $trayectos = implode (",", $trayectos);
             $trayectos = (strlen($trayectos)<>0)?$trayectos:0;
             $rs->MoveFirst();
             $modulo = "00100000";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
//           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // C�digo en JavaScript para validar las opciones de mantenimiento
             echo "function uno(src,color_entrada) {";
             echo "    src.style.background=color_entrada;src.style.cursor='hand'";
             echo "}";
             echo "function dos(src,color_default) {";
             echo "    src.style.background=color_default;src.style.cursor='default';";
             echo "}";
             echo "function actualizacion(ventana, to, ty, id, oid){";
             echo "  document.body.scroll='no';";
             echo "  frame = document.getElementById(ventana + '_frame');";
             echo "  frame.style.height = document.body.clientHeight-16;";
             echo "  ventana = document.getElementById(ventana);";
             echo "  ventana.style.visibility = \"visible\";";
             echo "  ancho = frame.getAttribute('STYLE').width.substring( 0, frame.getAttribute('STYLE').width.indexOf(\"px\") );";
             echo "  alto  = frame.getAttribute('STYLE').height.substring( 0, frame.getAttribute('STYLE').height.indexOf(\"px\") );";
             echo "  ventana.style.left = eval((document.body.clientWidth/2)-(ancho/2));";
             echo "  frame.src='uptarifario.php?boton='+to+'\&ty='+ty+'\&id='+id+'\&oid='+oid;";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/hintbox.js'></script>";
             echo "</HEAD>";

             echo "<BODY ID=Cuerpo onscroll='dalt=document.body.scrollTop+3; update_tarifario.style.top=dalt;'>";
             echo "<DIV ID='update_tarifario' STYLE='visibility:hidden; position:absolute; border-width:3; border-color:#666666; border-style:solid;'>";
             echo "<IFRAME ID='update_tarifario_frame' SRC='uptarifario.php' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:645; height:200'>";
             echo "</IFRAME>";
             echo "</DIV>";

             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='consultar' ACTION='tarifario.php'>";// Crea una forma con datos vacios
             echo "<TABLE WIDTH=645 CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=2>Datos Generales del Tr�fico</TH>";
             echo "<TR>";
             echo "  <TD Class=listar style='text-align:center;'><B>".strtoupper($rs->Value('ca_traorigen'))."</B><BR>&nbsp</TD>";
             echo "  <TD Class=listar style='text-align:center;'><B>".strtoupper($rs->Value('ca_tradestino'))."</B><BR>&nbsp</TD>";
             echo "</TR>";
             if ($rs->Value('ca_linkorigen') != '' or $rs->Value('ca_linkdestino') != '') {
                 $links_org = explode("|",$rs->Value('ca_linkorigen'));
                 $links_des = explode("|",$rs->Value('ca_linkdestino'));
                 echo "<TR>";
                 echo "  <TD Class=listar COLSPAN=2><IMG src='./graficos/info.gif'><B>&nbspEl Trayecto maneja Planillas de Gastos :</B>";
                 while ((list ($clave, $val) = each ($links_org)) and $val != '') {
                    echo "  <CENTER><LI><A HREF=\"#\" ONCLICK='javascript:window.open(\"./links/".$val."\")'>&nbsp$val&nbspHaga Click para consultar.</A></LI></CENTER>";
                 }
                 while ((list ($clave, $val) = each ($links_des)) and $val != '') {
                    echo "  <CENTER><LI><A HREF=\"#\" ONCLICK='javascript:window.open(\"./links/".$val."\")'>&nbsp$val&nbspHaga Click para consultar.</A></LI></CENTER>";
                 }
                 echo "</TD>";
                 echo "</TR>";
             }
             echo "</TABLE>";
             echo "<TABLE WIDTH=640 CELLSPACING=1>";

             $rl =& DlRecordset::NewRecordset($conn);                     // Apuntador que permite manejar la conexi�n a la base de datos
             $tr =& DlRecordset::NewRecordset($conn);                     // Apuntador que permite manejar la conexi�n a la base de datos
             if (!$tr->Open("select * from vi_tarifario where ca_idtrayecto in ($trayectos)")) {     // Selecciona todos lo registros de la tabla Agentes
                 echo "<script>alert(\"".addslashes($tr->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             while (!$rs->Eof() and !$rs->IsEmpty()) {                    // Lee la totalidad de los registros obtenidos en la instrucci�n Select
                echo "<TR>";
                echo "  <TD Class=invertir style='font-weight:bold; font-size: 11px;' COLSPAN=4>".$rs->Value('ca_ciuorigen')." - ".$rs->Value('ca_ciudestino')." (".(strlen($rs->Value('ca_sigla'))>0?$rs->Value('ca_sigla'):$rs->Value('ca_nombre')).")".($rs->Value('ca_idagente')!=0?" �".$rs->Value('ca_nomagente')."�":"")."</TD>"; //".."
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar>Frecuencia&nbsp:&nbsp<B>".$rs->Value('ca_frecuencia')."</B></TD>";
                echo "  <TD Class=listar>T/Transito&nbsp:&nbsp<B>".$rs->Value('ca_tiempotransito')."</B></TD>";
                echo "  <TD Class=listar>Modalidad&nbsp:&nbsp<B>".$rs->Value('ca_modalidad')."</B></TD>";
                if ($rs->Value('ca_idtrayecto') != $rs->Value('ca_idtarifas')) {
                    echo "  <TD Class=listar WIDTH=300>Toma Tarifas de:&nbsp:&nbsp<B>".$rs->Value('ca_tarifas')."</B></TD>"; }
                else {
                    echo "  <TD Class=listar WIDTH=300>&nbsp</TD>"; }
                echo "</TR>";
                echo "<TR>";
                if (strlen($rs->Value('ca_observaciones')) >= 500){					
                    $trad = array(chr(13) => "", chr(10) => "", chr(34) => "", chr(39) => "");
                    $obs_mem = trim(strtr(nl2br($rs->Value('ca_observaciones')),$trad));
                    
				    echo "  <TD Class=destacar COLSPAN=6><B>Observaciones:</B><IMG src='./graficos/si.gif' class='hintanchor' onMouseover='showhint(\"$obs_mem\", this, event, \"530px\")' border=0>";
					echo "Para ver m�s Observaciones, localice el apuntador del mouse sobre el �cono verde.<br />";
					if ($rs->Value('ca_idtrayecto') == 543||$rs->Value('ca_idtrayecto') == 542){
						echo "******FAVOR TENER MUY EN CUENTA SIGUIENTE OBSERVACI�N******
ADJUNTO PLANILLA DE TARIFAS CON APLICACION PARA EMBARQUES CON CLIENTES EFECTIVOS Y/O ANTIGUOS (FAVOR HACER CLICK EN ESTE HIPERV�NCULO):<br />";
						?>
						<A HREF="#" ONCLICK="javascript:window.open('./links/TARIFAS FCL ITALIA A CTG - CCL PARA CLIENTES EFECTIVOS O ANTIGUOS.xls')">TARIFAS FCL ITALIA A CTG - CCL PARA CLIENTES EFECTIVOS O ANTIGUOS.xls</A>
						<br />
						<div style="color:#FF0000"><strong>Tarifas exclusivas para clientes nuevos:</strong></div>
						<?
						
					}	
										
					if ($rs->Value('ca_idtraorigen') == "IT-039" && $rs->Value('ca_sigla') == "COLTRANS"  ){
						?>
						<strong>******FAVOR TENER MUY EN CUENTA SIGUIENTE OBSERVACI�N******
ADJUNTO LAS TARIFAS CON APLICACION PARA EMBARQUES CON CLIENTES EFECTIVOS Y/O ANTIGUOS (FAVOR HACER CLICK EN ESTE HIPERV�NCULO):</strong>
						<br />
						<A HREF="#" ONCLICK="javascript:window.open('./links/TARIFAS LCL VADOLIGURE A CTG - CONSOLIDADO PARA CLIENTES EFECTIVOS O ANTIGUOS.xls')">TARIFAS LCL VADOLIGURE A CTG - CONSOLIDADO PARA CLIENTES EFECTIVOS O ANTIGUOS.xls</A>
						<br />
						<div style="color:#FF0000"><strong>Tarifas exclusivas para clientes nuevos:</strong></div>
						<?
					}
									
					
					echo "</TD>";
                }else{
                    echo "  <TD Class=listar COLSPAN=6><B>Observaciones:</B> ".nl2br($rs->Value('ca_observaciones'))."</TD>";
                }
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=invertir COLSPAN=6><TABLE WIDTH=640 CELLSPACING=1 style='letter-spacing:-1px;'>";
                echo "  <TD Class=titulo WIDTH=100>Concepto</TD>";
                echo "  <TD Class=titulo WIDTH=65>Tar.Neta</TD>";
                echo "  <TD Class=titulo WIDTH=65>Sug.Venta</TD>";
                echo "  <TD Class=titulo WIDTH=65>Flt.M�nimo</TD>";
                echo "  <TD Class=titulo WIDTH=60>Recargos</TD>";
                echo "  <TD Class=titulo WIDTH=65>Valor</TD>";
                echo "  <TD Class=titulo WIDTH=65>Rec.M�nimo</TD>";
                echo "  <TD Class=titulo>Observaciones</TD>";
                echo "</TR>";
                $ciu_ori = $rs->Value('ca_ciuorigen');
                $ciu_des = $rs->Value('ca_ciudestino');
                $obs_fle = '';
                $con_tit = '';
                $tr->MoveFirst();
                while (!$tr->Eof() and !$tr->IsEmpty()) {                          // Lee la totalidad de los registros obtenidos en la instrucci�n Select
                    if ($tr->Value('ca_idtrayecto') != $rs->Value('ca_idtarifas')) {
                        $tr->MoveNext();
                        continue;
                       }
                    echo "<dfn title=\"Vigencia para la Tarifa: ".$tr->Value('ca_fchinicio_f')." � ".$tr->Value('ca_fchvencimiento_f')."\">";
                    echo "<TR>";
                    if ($con_tit != $tr->Value('ca_concepto')) {
                        $sug_mem = ($tr->Value('ca_sugerida')=='*')?'FFFFC0':'F0F0F0';
                        $sug_mem = ($tr->Value('ca_mantenimiento')=='*')?'FF6666':$sug_mem;
                        $man_mem = ($tr->Value('ca_mantenimiento')=='*')?'<BR>�En&nbspMantenimiento�':'';
                        $img_mem = ($tr->Value('ca_fchcreado_f') >= date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-2, date("Y"))) or $tr->Value('ca_fchactualizado_f') >= date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-7, date("Y"))))?"<IMG SRC='./graficos/nuevo.gif' border=0 ALT='Tarifa Nueva'>":($tr->Value('ca_fchcreado_f') >= date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-2, date("Y"))) or $tr->Value('ca_fchactualizado_f') >= date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-7, date("Y"))))?"<IMG SRC='./graficos/reciente.gif' border=0>":" ";
                        if ($obs_fle != '') {
                            echo "  <TD Class=listar style='background-color: $sug_mem;' COLSPAN=8>&nbsp&nbsp$obs_fle</TD>";
                            echo "</TR>";
                            echo "<TR>";
                            $obs_fle = '';
                            }
                        echo "  <TD Class=listar style='text-align:left; font-weight:bold; background-color: $sug_mem;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'$sug_mem');\" onclick='actualizacion(\"update_tarifario\", \"ModificarTarifa\", ".$rs->Value('ca_idtrayecto').", ".$rs->Value('ca_idtarifas').", ".$tr->Value('ca_oid_f').");'>".$tr->Value('ca_concepto')." ".$img_mem.$man_mem."</TD>";
                        echo "  <TD Class=listar style='text-align:right; font-size: 9px; background-color: $sug_mem;'>".formatNumber($tr->Value('ca_vlrneto'),3)." ".$tr->Value('ca_idmoneda_f')."</TD>";
                        echo "  <TD Class=listar style='text-align:right; font-size: 9px; background-color: $sug_mem;'>".formatNumber($tr->Value('ca_vlrminimo'),3)." ".$tr->Value('ca_idmoneda_f')."</TD>";
                        echo "  <TD Class=listar style='text-align:right; background-color: $sug_mem;'>".formatNumber($tr->Value('ca_fleteminimo'),3)." ".$tr->Value('ca_idmoneda_f')."</TD>";
                        $obs_fle = nl2br($tr->Value('ca_observaciones_f'));
                        $con_tit = $tr->Value('ca_concepto'); }
                    else {
                        echo "  <TD Class=listar COLSPAN=4 style='background-color: $sug_mem;'>$obs_fle&nbsp</TD>";
                        $obs_fle = '';}
                    echo "  <TD Class=listar style='text-align:left; background-color: $sug_mem; font-weight:bold;'>".$tr->Value('ca_recargo')."</TD>";
                    if ($tr->Value('ca_vlrfijo') != 0) {
                        echo "  <TD Class=listar style='text-align:right; background-color: $sug_mem;'>".formatNumber($tr->Value('ca_vlrfijo'),3)." ".$tr->Value('ca_idmoneda_r')."</TD>"; }
                    else if ($tr->Value('ca_porcentaje') != 0) {
                        echo "  <TD Class=listar style='text-align:right; background-color: $sug_mem;'>% ".formatNumber($tr->Value('ca_porcentaje'),3)."</TD>"; }
                    else if ($tr->Value('ca_vlrunitario') != 0) {
                        echo "  <TD Class=listar style='text-align:right; background-color: $sug_mem;'>".formatNumber($tr->Value('ca_vlrunitario'),3)." ".$tr->Value('ca_idmoneda_r')."</TD>"; }
                    else {
                        echo "  <TD Class=listar style='text-align:right; background-color: $sug_mem;'>".formatNumber($tr->Value('ca_recargominimo'),3)." ".$tr->Value('ca_idmoneda_r')."</TD>"; }
                    echo "  <TD Class=listar style='text-align:right; background-color: $sug_mem;'>".formatNumber($tr->Value('ca_recargominimo'),3)." ".$tr->Value('ca_idmoneda_r')."</TD>";
                    echo "  <TD Class=listar style='background-color: $sug_mem;'>".nl2br($tr->Value('ca_observaciones_r'))."</TD>";
                    echo "</TR>";
                    echo "</dfn>";
                    $tr->MoveNext();
                    }
                if ($obs_fle != '') {
                    echo "<TR>";
                    echo "  <TD Class=listar style='background-color: $sug_mem;' COLSPAN=8>&nbsp&nbsp$obs_fle</TD>";
                    echo "</TR>";
                    echo "<TR>";
                    $obs_fle = ''; }
                echo "  </TABLE>";
                echo "  <TABLE>";
                echo "   <TR>";
                echo "     <TD Class=listar WIDTH=265>&nbsp</TD>";
                echo "     <TD Class=imprimir style='text-align:center; font-size: 10px;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'FFFFFF');\" onclick='actualizacion(\"update_tarifario\", \"AMantenimiento\", ".$rs->Value('ca_idtrayecto').", ".$rs->Value('ca_idtarifas').", 0);'>A_Mantenimiento</TD>";
                echo "     <TD Class=imprimir style='text-align:center; font-size: 10px;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'FFFFFF');\" onclick='actualizacion(\"update_tarifario\", \"SugerirTarifa\", ".$rs->Value('ca_idtrayecto').", ".$rs->Value('ca_idtarifas').", 0);'>Sugerir Tarifas</TD>";
                echo "     <TD Class=imprimir style='text-align:center; font-size: 10px;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'FFFFFF');\" onclick='actualizacion(\"update_tarifario\", \"ModificarTarifa\", ".$rs->Value('ca_idtrayecto').", ".$rs->Value('ca_idtarifas').", 0);'>Crear Tarifas</TD>";
                echo "     <TD Class=imprimir style='text-align:center; font-size: 10px;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'FFFFFF');\" onclick='actualizacion(\"update_tarifario\", \"EliminarTrayecto\", ".$rs->Value('ca_idtrayecto').", ".$rs->Value('ca_idtarifas').", 0);'>Eliminar Trayecto</TD>";
                echo "   </TR>";
                echo "  </TABLE></TD>";
                $impo_expo = $rs->Value('ca_impoexpo');
                $tra_mem = $rs->Value('ca_transporte');
                $mod_mem = $rs->Value('ca_modalidad');
                $rs->MoveNext();
                if ($rs->Value('ca_ciuorigen') != $ciu_ori or $rs->Value('ca_ciudestino') != $ciu_des or $rs->Eof()) {
                    if ( $impo_expo == "Importaci�n") {
                        if (!$rl->Open("select * from vi_recargosxtraf where (ca_idtrafico = '".$ciu_ori."' or ca_idtrafico = '99-999') and (ca_idciudad = '".$ciu_des."' or ca_idciudad = '999-9999') and ca_transporte = '".$tra_mem."' and ca_impoexpo = '".$impo_expo."' and ca_modalidad = '".$mod_mem."'")) {                              // Selecciona todos lo registros de la tabla Recargos por trafico
                            echo "<script>alert(\"".addslashes($rl->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                            echo "<script>document.location.href = 'entrada.php';</script>";
                            exit; }
                         }
                     else {
                        if (!$rl->Open("select * from vi_recargosxtraf where (ca_idtrafico = '".$ciu_des."' or ca_idtrafico = '99-999') and (ca_idciudad = '".$ciu_ori."' or ca_idciudad = '999-9999') and ca_transporte = '".$tra_mem."' and ca_impoexpo = '".$impo_expo."' and ca_modalidad = '".$mod_mem."'")) {                              // Selecciona todos lo registros de la tabla Recargos por trafico
                            echo "<script>alert(\"".addslashes($rl->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                            echo "<script>document.location.href = 'entrada.php';</script>";
                            exit; }
                         }
                    if ($rl->mRowCount != 0) {
                        echo "<TR>";
                        $rl->MoveFirst();
                        echo "  <TD Class=invertir COLSPAN=6><B>Recargos Locales:</B><BR><TABLE CELLSPACING=1 style='letter-spacing:-1px;'><TD Class=titulo>Aplicaci�n</TD><TD Class=titulo WIDTH=150>Recargo</TD><TD Class=titulo WIDTH=60>Valor</TD><TD Class=titulo WIDTH=60>Rec.M�nimo</TD><TD Class=titulo>Observaciones</TD>";
                        while (!$rl->Eof() and !$rl->IsEmpty()) {
                            echo "<TR>";
                            echo "  <TD Class=listar style='text-align:left;'>".$rl->Value('ca_aplicacion')."</TD>";
                            if ($rl->Value('ca_porcentaje') != 0 ) {
                                echo "  <TD Class=listar style='text-align:left; font-weight:bold;'>".$rl->Value('ca_recargo')." (% ".$rl->Value('ca_baseporcentaje').")</TD>";
                                echo "  <TD Class=listar style='text-align:right;'>% ".formatNumber($rl->Value('ca_porcentaje'),3)."</TD>"; }
                            else if ($rl->Value('ca_vlrunitario') != 0 ) {
                                echo "  <TD Class=listar style='text-align:left; font-weight:bold;'>".$rl->Value('ca_recargo')." (".$rl->Value('ca_baseunitario').")</TD>";
                                echo "  <TD Class=listar style='text-align:right;'>".formatNumber($rl->Value('ca_vlrunitario'),3)."</TD>"; }
                            else {
                                echo "  <TD Class=listar style='text-align:left; font-weight:bold;'>".$rl->Value('ca_recargo')."</TD>";
                                echo "  <TD Class=listar style='text-align:right;'>".formatNumber($rl->Value('ca_vlrfijo'),3)." ".$rl->Value('ca_idmoneda')."</TD>"; }
                            echo "  <TD Class=listar style='text-align:right;'>".formatNumber($rl->Value('ca_recargominimo'),3)." ".$rl->Value('ca_idmoneda')."</TD>";
                            echo "  <TD Class=listar>".nl2br($rl->Value('ca_observaciones'))."</TD>";
                            echo "</TR>";
                            $rl->MoveNext();
                           }
                        echo "  </TABLE></TD>";
                        echo "</TR>";
                    }
                    echo "<TR HEIGHT=5>";
                    echo "  <TD Class=titulo COLSPAN=8></TD>";
                    echo "</TR>";
                }
            }
            echo "</TABLE>";
            echo "<TABLE CELLSPACING=10>";
            echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar' ONCLICK='javascript:document.location.href = \"tarifario.php\"'></TH>";  // Cancela la operaci�n
            echo "</TABLE>";
            echo "</FORM>";
            echo "</CENTER>";
//          echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
            require_once("footer.php");
echo "</BODY>";
            echo "</HTML>";
            break;
           }
   }
}
?>