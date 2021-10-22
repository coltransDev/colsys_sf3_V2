<?php

/* ================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
  // Archivo:       ENCCLIENTE.PHP                                              \\
  // Creado:        2004-04-26                                                  \\
  // Autor:         Carlos Gilberto López M.                                    \\
  // Ver:           1.00                                                        \\
  // Updated:       2004-04-21                                                  \\
  //                                                                            \\
  // Descripción:   Módulo de mantenimiento a la tabla de Encuestas por Cliente \\
  //                                                                            \\
  // Copyright:     Coltrans S.A. - 2004                                        \\
  /*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
 */
$titulo = 'Formato de Visita al Cliente';
$siono = array("Sí", "No", "--");
$tipos = array("Local", "Oficina", "Bodega", "Apartamento", "Casa", "Planta de Producción");
$vigilancias = array("No Tiene", "Privada");
$acondiciones = array("Normal", "Ruinosas", "Lujoso");
$infraestructuras = array("Estantería", "Montacarga", "Báscula");
$actividades = array("Importador", "Exportador", "Importador y Exportador", "Representante");
$estados = array("Activo", "Potencial", "Vetado");

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta


$rs = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)) {
   $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

   if (!$rs->Open("select * from vi_enccliente where ca_idcliente = $id")) {    // Selecciona todos lo registros de la tabla Clientes
      echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
      echo "<script>document.location.href = 'entrada.php';</script>";
      exit;
   }
   echo "<HTML>";
   echo "<HEAD>";
   echo "<TITLE>Tabla de Encuestas por Cliente</TITLE>";
   echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
   echo "function elegir(opcion, id, co){";
   echo "    document.location.href = 'enccliente.php?boton='+opcion+'\&id='+id+'\&co='+co;";
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
   echo "<FORM METHOD=post NAME='cabecera' ACTION='enccliente.php'>";         // Hace una llamado nuevamente a este script pero con
   echo "<TABLE WIDTH=580 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
   echo "<TR>";
   echo "  <TH Class=titulo COLSPAN=6>Maestra de Encuentas por Cliente</TH>";
   echo "</TR>";
   echo "<TH WIDTH=540 COLSPAN=6>Datos de la Encuesta</TH>";
//    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", " . $id . ", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
   $id_temp = 0;
   while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
      if ($rs->Value('ca_idcliente') != $id_temp) {
         $complemento = (($rs->Value('ca_oficina') != '') ? " Oficina : " . $rs->Value('ca_oficina') : "") . (($rs->Value('ca_torre') != '') ? " Torre : " . $rs->Value('ca_torre') : "") . (($rs->Value('ca_interior') != '') ? " Interior : " . $rs->Value('ca_interior') : "") . (($rs->Value('ca_complemento') != '') ? " - " . $rs->Value('ca_complemento') : "");
         echo "<TR>";
         echo "<TD WIDTH=430 Class=mostrar COLSPAN=5 style='font-size: 11px; text-align:left;'><B>" . $rs->Value('ca_compania') . "</B> &nbsp&nbsp&nbsp<B>Nit.: </B>" . number_format($rs->Value('ca_idalterno')) . "-" . $rs->Value('ca_digito') . "<BR><B>Dirección: </B>" . str_replace("|", " ", $rs->Value('ca_direccion_cl')) . $complemento . "&nbsp&nbsp<B>Localidad: </B>" . $rs->Value('ca_localidad') . "<BR><B>Teléfonos: </B>" . $rs->Value('ca_telefonos_cl') . "&nbsp&nbsp&nbsp&nbsp<B>Fax: </B>" . $rs->Value('ca_fax_cl') . "</TD>";
         echo "<TD Class=mostrar></TD>";
         echo "</TR>";
         $id_temp = $rs->Value('ca_idcliente');
      }
      while ($id_temp == $rs->Value('ca_idcliente') and !$rs->Eof()) {
         if ($rs->Value('ca_idencuesta') != '') {
            echo "<TR>";
            echo "  <TD Class=mostrar ROWSPAN=16>&nbsp&nbsp</TD>";
            echo "  <TD Class=mostrar COLSPAN=2>Contacto : <B>" . $rs->Value('ca_ncompleto_cn') . "</B></TD>";
            echo "  <TD Class=mostrar COLSPAN=2>Fecha de la Visita : <B>" . $rs->Value('ca_fchvisita') . "</B></TD>";
            echo "  <TD Class=listar ROWSPAN=16 onclick='elegir(\"Imprimir\", \"" . $rs->Value('ca_idencuesta') . "\", \"" . $rs->Value('ca_idcliente') . "\");'><IMG src='./graficos/pdf.gif' alt='Genera archivo PFD del Reporte de Visita' border=0></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=mostrar>Tipo de Instalaciones :</TD>";
            echo "  <TD Class=mostrar><B>" . $rs->Value('ca_instalaciones') . "</B></TD>";
            echo "  <TD Class=mostrar>¿Compartidas con otra Empresa? :</TD>";
            echo "  <TD Class=mostrar><B>" . $rs->Value('ca_compartidas') . "</B></TD>";
            echo "</TR>";

            echo "<TR>";
            echo "  <TD Class=mostrar>Condiciones físicas de las instalaciones :</TD>";
            echo "  <TD Class=mostrar><B>" . $rs->Value('ca_condiciones') . "</B></TD>";
            echo "  <TD Class=mostrar>¿Es al mismo tiempo lugar de Vivienda? :</TD>";
            echo "  <TD Class=mostrar><B>" . $rs->Value('ca_vivienda') . "</B></TD>";
            echo "</TR>";

            echo "<TR>";
            echo "  <TD Class=invertir COLSPAN=4 style='font-weight:bold; text-align:center;'>Vigilancia</TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=mostrar>Vigilancia :</TD>";
            echo "  <TD Class=mostrar><B>" . $rs->Value('ca_vigilancia') . "</B></TD>";
            echo "  <TD Class=mostrar COLSPAN=2></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=mostrar>Otros Sistemas de Seguridad :</TD>";
            echo "  <TD Class=mostrar><B>" . $rs->Value('ca_masseguridad') . "</B></TD>";
            echo "  <TD Class=mostrar COLSPAN=2>Detalle: " . $rs->Value('ca_detseguridad') . "</B></TD>";
            echo "</TR>";

            echo "<TR>";
            echo "  <TD Class=invertir COLSPAN=4 style='font-weight:bold; text-align:center;'>Personal</TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=mostrar>¿Acorde al tamaño de la Empresa? :</TD>";
            echo "  <TD Class=mostrar><B>" . $rs->Value('ca_peracorde') . "</B></TD>";
            echo "  <TD Class=mostrar>¿Está el personal Carnetizado? :</TD>";
            echo "  <TD Class=mostrar><B>" . $rs->Value('ca_percarne') . "</B></TD>";
            echo "</TR>";

            echo "<TR>";
            echo "  <TD Class=invertir COLSPAN=4 style='font-weight:bold; text-align:center;'>Mercancia</TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=mostrar>¿Observó movimiento de Mercancia? :</TD>";
            echo "  <TD Class=mostrar><B>" . $rs->Value('ca_mermovimiento') . "</B></TD>";
            echo "  <TD Class=mostrar>¿Tiene Control de Acceso a la bodega? :</TD>";
            echo "  <TD Class=mostrar><B>" . $rs->Value('ca_mercontrol') . "</B></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=listar>¿Cargue dentro de las instalaciones? :</TD>";
            echo "  <TD Class=mostrar><B>" . $rs->Value('ca_mercargue') . "</B></TD>";
            echo "  <TD Class=mostrar COLSPAN=2></TD>";
            echo "</TR>";

            echo "<TR>";
            echo "  <TD Class=invertir COLSPAN=4 style='font-weight:bold; text-align:center;'>Concepto para el Cliente</TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=mostrar>¿Recomienda Trabajar con esta firma? :</TD>";
            echo "  <TD Class=mostrar><B>" . $rs->Value('ca_recomendable') . "</B></TD>";
            echo "  <TD Class=mostrar>¿Refleja operar bajo la Legalidad? :</TD>";
            echo "  <TD Class=mostrar><B>" . $rs->Value('ca_legalidad') . "</B></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=mostrar>¿Ofrece algún peligro para Coltrans o Colmas? :</TD>";
            echo "  <TD Class=mostrar><B>" . $rs->Value('ca_peligro') . "</B></TD>";
            echo "  <TD Class=mostrar COLSPAN=2>Explique: <B>" . $rs->Value('ca_explicacion') . "</B></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=invertir COLSPAN=4 style='font-weight:bold; text-align:center;'>Actividad</TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=mostrar COLSPAN=2>Actividad Comercial : <B>" . $rs->Value('ca_actividad') . "</B></TD>";
            echo "  <TD Class=mostrar COLSPAN=2>Estado : <B>" . $rs->Value('ca_estado') . "</B></TD>";
            echo "</TR>";
//	         echo "<TR>";
//			 echo "  <TD Class=invertir COLSPAN=4 style='font-weight:bold; text-align:center;'>Manejo de Carga Aérea desde:</TD>";
//	         echo "</TR>";
//	         echo "<TR>";
//	         echo "  <TD Class=listar COLSPAN=4><B>".str_replace ("|",", ",$rs->Value('ca_traaereos'))."</B></TD>";
//	         echo "</TR>";
//	         echo "<TR>";
//			 echo "  <TD Class=invertir COLSPAN=4 style='font-weight:bold; text-align:center;'>Manejo de Carga Marítima desde:</TD>";
//	         echo "</TR>";
//	         echo "<TR>";
//	         echo "  <TD Class=listar COLSPAN=4><B>".str_replace ("|",", ",$rs->Value('ca_tramaritimos'))."</B></TD>";
//	         echo "</TR>";
            echo "<TR HEIGHT=5>";
            echo "  <TD Class=titulo COLSPAN=6></TD>";
            echo "</TR>";
         }
         $rs->MoveNext();
      }
   }
   echo "</TABLE><BR>";
   echo "<TABLE CELLSPACING=10>";
   echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"clientes.php?modalidad=N.i.t.&\criterio=$id\"'></TH>";  // Cancela la operación
   echo "</TABLE>";
   echo "</FORM>";
   echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
   require_once("footer.php");
   echo "</BODY>";
   echo "</HTML>";
} elseif (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
   switch (trim($boton)) {
      case 'Adicionar': {                                                    // Opcion para Adicionar Registros a la tabla
            $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
            $tm = & DlRecordset::NewRecordset($conn);
            if (!$tm->Open("select * from vi_concliente where ca_idcliente = $id")) { // Selecciona todos lo registros de la tabla Clientes
               echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";   // Muestra el mensaje de error
               echo "<script>document.location.href = 'enccliente.php';</script>";
               exit;
            }
            echo "<HEAD>";
            echo "<TITLE>Tabla de Encuestas por Cliente</TITLE>";
            echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
            echo "function validar(){";
            echo "  if (document.adicionar.idcontacto.value == '')";
            echo "      alert('Debe Crear la Tabla de Contactos para el Clientes');";
            echo "  else if (!chkDate(document.adicionar.fchvisita))";
            echo "      document.adicionar.fchvisita.focus();";
            echo "  else {";
            echo "  	for (cont=0; cont<document.adicionar.elements.length; cont++){";
            echo "     	element = document.adicionar.elements[cont];";
            echo "     	if (element.type == 'select-one'){";
            echo "         	if (element.value == ''){";
            echo "     			alert ('Debe elegir alguna de las posibles respuestas para el Campo: '+element.name);";
            echo "     			return (false);";
            echo "     		}";
            echo "     	}";
            echo "  	}";
            echo "     return (true);";
            echo "  }";
            echo "  return (false);";
            echo "}";
            echo "</script>";
            echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
            echo "</HEAD>";
            echo "<BODY>";
            require_once("menu.php");
            echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
            echo "<CENTER>";
            echo "<H3>$titulo</H3>";
            echo "<FORM METHOD=post NAME='adicionar' ACTION='enccliente.php' ONSUBMIT='return validar();'>"; // Crea una forma con datos vacios
            echo "<TABLE CELLSPACING=1>";
            echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='" . $id . "'>";           // Hereda el Id del registro que se esta eliminando
            echo "<TH Class=titulo COLSPAN=5>Datos de la Encuesta</TH>";
            echo "<TR>";
            echo "  <TD Class=mostrar COLSPAN=5 style='font-size: 11px; font-weight:bold;'>" . number_format($tm->Value('ca_idalterno')) . "-" . $tm->Value('ca_digito') . "&nbsp" . $tm->Value('ca_compania') . "</TD>";
            echo "</TR>";

            echo "<TR>";
            echo "  <TD Class=mostrar ROWSPAN=20>&nbsp</TD>";
            echo "  <TD Class=mostrar COLSPAN=2>Contacto : <SELECT NAME='idcontacto'>";
            while (!$tm->Eof()) {
               echo"<OPTION VALUE=" . $tm->Value('ca_idcontacto') . ">" . $tm->Value('ca_ncompleto_cn') . "</OPTION>";
               $tm->MoveNext();
            }
            echo "  </SELECT></TD>";
            echo "  <TD Class=mostrar COLSPAN=2>Fecha de la Visita : <INPUT TYPE='TEXT' NAME='fchvisita' SIZE=12 VALUE='" . date("Y-m-d") . "' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=mostrar>Tipo de Instalaciones :</TD>";
            echo "  <TD Class=mostrar><SELECT NAME='instalaciones'>";
            echo "      <OPTION VALUE=''></OPTION>";
            for ($i = 0; $i < count($tipos); $i++) {
               echo " <OPTION VALUE='" . $tipos[$i] . "'>" . $tipos[$i];
            }
            echo "  </SELECT></TD>";
            echo "  <TD Class=mostrar>¿Compartidas con otra Empresa? :</TD>";
            echo "  <TD Class=mostrar><SELECT NAME='compartidas'>";
            echo "      <OPTION VALUE=''></OPTION>";
            for ($i = 0; $i < count($siono); $i++) {
               echo " <OPTION VALUE='" . $siono[$i] . "'>" . $siono[$i];
            }
            echo "  </SELECT></TD>";
            echo "</TR>";

            echo "<TR>";
            echo "  <TD Class=mostrar>Condiciones físicas de las instalaciones :</TD>";
            echo "  <TD Class=mostrar><SELECT NAME='condiciones'>";
            echo "      <OPTION VALUE=''></OPTION>";
            for ($i = 0; $i < count($acondiciones); $i++) {
               echo " <OPTION VALUE='" . $acondiciones[$i] . "'>" . $acondiciones[$i];
            }
            echo "  </SELECT></TD>";
            echo "  <TD Class=mostrar>¿Es al mismo tiempo lugar de Vivienda? :</TD>";
            echo "  <TD Class=mostrar><SELECT NAME='vivienda'>";
            echo "      <OPTION VALUE=''></OPTION>";
            for ($i = 0; $i < count($siono); $i++) {
               echo " <OPTION VALUE='" . $siono[$i] . "'>" . $siono[$i];
            }
            echo "  </SELECT></TD>";
            echo "</TR>";

            echo "<TR>";
            echo "  <TD Class=invertir COLSPAN=5 style='font-weight:bold; text-align:center;'>Vigilancia</TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=mostrar>Vigilancia :</TD>";
            echo "  <TD Class=mostrar><SELECT NAME='vigilancia'>";
            echo "      <OPTION VALUE=''></OPTION>";
            for ($i = 0; $i < count($vigilancias); $i++) {
               echo " <OPTION VALUE='" . $vigilancias[$i] . "'>" . $vigilancias[$i];
            }
            echo "  </SELECT></TD>";
            echo "  <TD Class=mostrar COLSPAN=2></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=mostrar>Otros Sistemas de Seguridad :</TD>";
            echo "  <TD Class=mostrar><SELECT NAME='masseguridad'>";
            echo "      <OPTION VALUE=''></OPTION>";
            for ($i = 0; $i < count($siono); $i++) {
               echo " <OPTION VALUE='" . $siono[$i] . "'>" . $siono[$i];
            }
            echo "  </SELECT></TD>";
            echo "  <TD Class=mostrar COLSPAN=2>Detalle: <INPUT TYPE='TEXT' NAME='detseguridad' SIZE=39 MAXLENGTH=255></TD>";
            echo "</TR>";

            echo "<TR>";
            echo "  <TD Class=invertir COLSPAN=5 style='font-weight:bold; text-align:center;'>Personal</TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=mostrar>¿Acorde la tamaño de la Empresa? :</TD>";
            echo "  <TD Class=mostrar><SELECT NAME='peracorde'>";
            echo "      <OPTION VALUE=''></OPTION>";
            for ($i = 0; $i < count($siono); $i++) {
               echo " <OPTION VALUE='" . $siono[$i] . "'>" . $siono[$i];
            }
            echo "  </SELECT></TD>";
            echo "  <TD Class=mostrar>¿Está el personal Carnetizado? :</TD>";
            echo "  <TD Class=mostrar><SELECT NAME='percarne'>";
            echo "      <OPTION VALUE=''></OPTION>";
            for ($i = 0; $i < count($siono); $i++) {
               echo " <OPTION VALUE='" . $siono[$i] . "'>" . $siono[$i];
            }
            echo "  </SELECT></TD>";
            echo "</TR>";

            echo "<TR>";
            echo "  <TD Class=invertir COLSPAN=5 style='font-weight:bold; text-align:center;'>Mercancia</TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=mostrar>¿Observó movimiento de Mercancia? :</TD>";
            echo "  <TD Class=mostrar><SELECT NAME='mermovimiento'>";
            echo "      <OPTION VALUE=''></OPTION>";
            for ($i = 0; $i < count($siono); $i++) {
               echo " <OPTION VALUE='" . $siono[$i] . "'>" . $siono[$i];
            }
            echo "  </SELECT></TD>";
            echo "  <TD Class=mostrar>¿Tiene Control de Acceso a la bodega? :</TD>";
            echo "  <TD Class=mostrar><SELECT NAME='mercontrol'>";
            echo "      <OPTION VALUE=''></OPTION>";
            for ($i = 0; $i < count($siono); $i++) {
               echo " <OPTION VALUE='" . $siono[$i] . "'>" . $siono[$i];
            }
            echo "  </SELECT></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=listar>¿Cargue dentro de las instalaciones? :</TD>";
            echo "  <TD Class=mostrar><SELECT NAME='mercargue'>";
            echo "      <OPTION VALUE=''></OPTION>";
            for ($i = 0; $i < count($siono); $i++) {
               echo " <OPTION VALUE='" . $siono[$i] . "'>" . $siono[$i];
            }
            echo "  </SELECT></TD>";
            echo "  <TD Class=mostrar COLSPAN=2></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "</TR>";

            echo "<TR>";
            echo "  <TD Class=invertir COLSPAN=5 style='font-weight:bold; text-align:center;'>Concepto para el Cliente</TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=mostrar>¿Recomienda Trabajar con esta firma? :</TD>";
            echo "  <TD Class=mostrar><SELECT NAME='recomendable'>";
            echo "      <OPTION VALUE=''></OPTION>";
            for ($i = 0; $i < count($siono); $i++) {
               echo " <OPTION VALUE='" . $siono[$i] . "'>" . $siono[$i];
            }
            echo "  </SELECT></TD>";
            echo "  <TD Class=mostrar>¿Refleja operar bajo la Legalidad? :</TD>";
            echo "  <TD Class=mostrar><SELECT NAME='legalidad'>";
            echo "      <OPTION VALUE=''></OPTION>";
            for ($i = 0; $i < count($siono); $i++) {
               echo " <OPTION VALUE='" . $siono[$i] . "'>" . $siono[$i];
            }
            echo "  </SELECT></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=mostrar>¿Ofrece algún peligro para Coltrans o Colmas? :</TD>";
            echo "  <TD Class=mostrar><SELECT NAME='peligro'>";
            echo "      <OPTION VALUE=''></OPTION>";
            for ($i = 0; $i < count($siono); $i++) {
               echo " <OPTION VALUE='" . $siono[$i] . "'>" . $siono[$i];
            }
            echo "  </SELECT></TD>";
            echo "  <TD Class=mostrar COLSPAN=2>Explique: <INPUT TYPE='TEXT' NAME='explicacion' SIZE=38 MAXLENGTH=255></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=invertir COLSPAN=5 style='font-weight:bold; text-align:center;'>Actividad</TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=mostrar COLSPAN=2>Actividad Comercial : <SELECT NAME='actividad'>";
            echo "      <OPTION VALUE=''></OPTION>";
            for ($i = 0; $i < count($actividades); $i++) {
               echo " <OPTION VALUE='" . $actividades[$i] . "'>" . $actividades[$i];
            }
            echo "  </SELECT></TD>";
            echo "  <TD Class=mostrar COLSPAN=2>Estado : <SELECT NAME='estado'>";
            echo "      <OPTION VALUE=''></OPTION>";
            for ($i = 0; $i < count($estados); $i++) {
               echo " <OPTION VALUE='" . $estados[$i] . "'>" . $estados[$i];
            }
            echo "  </SELECT></TD>";
            echo "</TR>";
//             if (!$tm->Open("select * from vi_traficos")) { // Selecciona todos lo registros de la tabla Traficos
//                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";   // Muestra el mensaje de error
//                 echo "<script>document.location.href = 'enccliente.php';</script>";
//                 exit; }
//	         echo "<TR>";
//			 echo "  <TD Class=invertir COLSPAN=5 style='font-weight:bold; text-align:center;'>Manejo de Carga Aérea desde:</TD>";
//	         echo "</TR>";
//	         echo " <TD Class=mostrar COLSPAN=5 style='text-align:center;'><TABLE>";
//             while (!$tm->Eof()){
//			 	echo "  <TR>";
//			 	for ($i=0; $i<=6; $i++){
//					if (!$tm->Eof()) {
//						echo "<TD Class=imprimir style='letter-spacing:-1px;'><INPUT TYPE=CHECKBOX NAME='traaereos[]' VALUE='".$tm->Value('ca_nombre')."'>".$tm->Value('ca_nombre')."</TD>";
//						$tm->MoveNext();
//					}else {
//						echo "<TD Class=imprimir>&nbsp</TD>";
//					}
//				}
//			 	echo "  </TR>";
//			 }
//	         echo " </TABLE></TD>";
//	         echo "</TR>";
//	         echo "<TR>";
//			 echo "  <TD Class=invertir COLSPAN=5 style='font-weight:bold; text-align:center;'>Manejo de Carga Marítima desde:</TD>";
//	         echo "</TR>";
//	         echo " <TD Class=mostrar COLSPAN=5 style='text-align:center;'><TABLE>";
//			 $tm->MoveFirst();
//			 while (!$tm->Eof()){
//			 	echo "  <TR>";
//			 	for ($i=0; $i<=6; $i++){
//					if (!$tm->Eof()) {
//						echo "<TD Class=imprimir style='letter-spacing:-1px;'><INPUT TYPE=CHECKBOX NAME='tramaritimos[]' VALUE='".$tm->Value('ca_nombre')."'>".$tm->Value('ca_nombre')."</TD>";
//						$tm->MoveNext();
//					}else {
//						echo "<TD Class=imprimir>&nbsp</TD>";
//					}
//				}
//			 	echo "  </TR>";
//			 }
//	         echo " </TABLE></TD>";
//	         echo "</TR>";
            echo "<TR HEIGHT=5>";
            echo "  <TD Class=invertir COLSPAN=5></TD>";
            echo "</TR>";

            echo "</TABLE><BR>";
            echo "<TABLE CELLSPACING=10>";
            echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";     // Ordena eliminar el registro de forma permanente
            echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"enccliente.php?id=$id\"'></TH>";  // Cancela la operación
            echo "</TABLE>";
            echo "</FORM>";
            echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";   // Link que proporciona la Ayuda en línea
            require_once("footer.php");
            echo "</BODY>";
            break;
         }
      case 'Imprimir': {                                                    // Opcion para Consultar un solo registro
            $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
            echo "<HEAD>";
            echo "<TITLE>$titulo</TITLE>";
            echo "</HEAD>";
            echo "<BODY>";
            require_once("menu.php");
            echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
            echo "<CENTER>";
            echo "<TABLE CELLSPACING=1 WIDTH='830' HEIGHT='650'>";
            echo "<TR>";
            echo "  <TD Class=invertir><iframe ID=consulta_tar src ='ventanas.php?opcion=Reporte&id=$id' width='100%' height='100%'></iframe></TD>";
            echo "</TR>";
            echo "</TABLE>";
            echo "<TABLE CELLSPACING=10>";
            echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"clientes.php?modalidad=N.i.t.&\criterio=$co\"'></TH>";  // Cancela la operación
            echo "</TABLE>";
            echo "</CENTER>";
            break;
         }
   }
} elseif (isset($accion)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
   switch (trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
      case 'Guardar': {                                                      // El Botón Guardar fue pulsado
            $merinfraestructura = isset($merinfraestructura) ? implode("|", $merinfraestructura) : "";
            //$traaereos = isset($traaereos)?implode("|",$traaereos):"";
            //$tramaritimos = isset($tramaritimos)?implode("|",$tramaritimos):"";		
            //ca_traaereos, ca_tramaritimos, 
            //'$traaereos', '$tramaritimos', 
            if (!$rs->Open("insert into tb_enccliente (ca_idcliente, ca_fchvisita, ca_idcontacto, ca_instalaciones, ca_compartidas, ca_condiciones, ca_vivienda, ca_vigilancia, ca_alarma, ca_masseguridad, ca_detseguridad, ca_peracorde, ca_percarne, ca_perpresentado, ca_peruniformado,
			                 ca_mermovimiento, ca_merorganizado, ca_merexistencias, ca_mercontrol, ca_merinfraestructura, ca_mersupervision, ca_mercargue, ca_merseguridad, ca_recomendable, ca_legalidad, ca_peligro, ca_explicacion, ca_actividad, ca_estado, ca_fchcreado, ca_usucreado)
							 values($id, '$fchvisita', $idcontacto, '$instalaciones', '$compartidas', '$condiciones', '$vivienda', '$vigilancia', '', '$masseguridad', '$detseguridad', '$peracorde', '$percarne', '', '', '$mermovimiento', '', '',
							 '$mercontrol', '','', '$mercargue', '', '$recomendable','$legalidad', '$peligro','$explicacion', '$actividad', '$estado', to_timestamp('" . date("d M Y H:i:s") . "', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
               echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
               echo "<script>document.location.href = 'enccliente.php?id=$id';</script>";
               exit;
            }
            break;
         }
   }
   echo "<script>document.location.href = 'enccliente.php?id=$id';</script>";  // Retorna a la pantalla principal de la opción
}
?>