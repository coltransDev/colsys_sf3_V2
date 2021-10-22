<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       FINDCONTACTO.PHP                                             \\
// Creado:        2004-04-21                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-21                                                  \\
//                                                                            \\
// Descripción:   Módulo para la Definición de Contactos                       \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
$titulo = 'Consulta a Contactos por Cliente';
$columnas = array("Nombre del Cliente"=>"ca_compania", "Nombre del Contacto"=>"ca_ncompleto_cn", "Nit del Cliente"=>"ca_idcliente");
$bdatos = array("Maestra de Clientes");
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
if (!isset($usuario)) {                                                        // Verifica si el usuario ya inicio su sessión
    echo "<script>location.href = 'entrada.php';</script>";
   }


$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($criterio) and !isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
    echo "function validar(){";
    echo "  if (document.contactos.criterio.value == '')";
    echo "      alert('Consulta muy extensa. Especifique un criterio de búsqueda.');";
    echo "  else";
    echo "      return (true);";
    echo "  return (false);";
    echo "}";
    echo "</script>";
    ?>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <?php
    echo "</HEAD>";
    echo "<BODY style='margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px; text-align: right; font-size: 11px; font-weight:bold;'>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
	echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='contactos' ACTION='findcontacto.php' ONSUBMIT='return validar();'>";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<INPUT TYPE='HIDDEN' NAME='suf' VALUE=$suf>";
    echo "<INPUT TYPE='HIDDEN' NAME='boton' VALUE='Buscar'>";
    echo "<TH COLSPAN=4 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    echo "<TR>";
    echo "  <TH ROWSPAN=2>&nbsp</TH>";
    echo "  <TD Class=listar ROWSPAN=2><B>Buscar por:</B><BR><SELECT NAME='modalidad' SIZE=4>";
    $sel = 'SELECTED';
    while (list ($clave, $val) = each ($columnas)) {
        echo " <OPTION VALUE='".$val."' $sel>".$clave;
        $sel = '';
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar><B>Que contenga la cadena:</B><BR><INPUT TYPE='text' NAME='criterio' size='60'></TD>";
    echo "  <TH ROWSPAN=2><INPUT Class=submit TYPE='SUBMIT' NAME='boton' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar><B>Buscar en:</B><BR><SELECT NAME='buscaren'>";
    for ($i=0; $i < count($bdatos); $i++) {
         echo " <OPTION VALUE='".$bdatos[$i]."'";
         if ($i==0) {
             echo " SELECTED"; 
            }
         echo ">".$bdatos[$i];
        }
    echo "  </SELECT>";
    echo "  </TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=4></TD>";
    echo "</TR>";
    echo "</TABLE>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.find_contacto.style.visibility = \"hidden\"; window.parent.document.body.scroll=\"yes\";'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    //   echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    //require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    switch(trim($boton)) {
        case 'Buscar':{
             if (isset($criterio) and !isset($condicion)) {
                 $condicion= "where lower($modalidad) like lower('%".$criterio."%')"; }
             if (!$rs->Open("select ca_idcliente, ca_compania, ca_idcontacto, ca_ncompleto_cn, ca_cargo, ca_direccion_cl, ca_oficina, ca_torre, ca_interior, ca_complemento, ca_telefonos, ca_fax, ca_email, ca_preferencias, ca_confirmar, ca_cupo, ca_diascredito, ca_vendedor from vi_concliente $condicion")) {               // Selecciona todos lo registros de la tabla de Contactos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>location.href = 'entrada.php';</script>";
                 exit; }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function elegir(opcion, id){";
             echo "    location.href = 'findcontacto.php?boton='+opcion+'\&id='+id+'\&suf=$suf';";
             echo "}";
             echo "function seleccion(i) {";
             echo "    source = document.getElementById('idcontacto_'+i);";
             echo "    elemento = window.parent.document.getElementById('id$suf');";
             echo "    elemento.value = source.value;";
             echo "    source = document.getElementById('compania_'+i);";
             echo "    elemento = window.parent.document.getElementById('nombre$suf');";
             echo "    elemento.value = source.value;";
             echo "    source = document.getElementById('ncompleto_'+i);";
             echo "    elemento = window.parent.document.getElementById('contacto$suf');";
             echo "    elemento.value = source.value;";
             echo "    source = document.getElementById('direccion_'+i);";
             echo "    elemento = window.parent.document.getElementById('direccion$suf');";
             echo "    elemento.value = source.value;";
             echo "    source = document.getElementById('telefonos_'+i);";
             echo "    elemento = window.parent.document.getElementById('telefonos$suf');";
             echo "    elemento.value = source.value;";
             echo "    source = document.getElementById('fax_'+i);";
             echo "    elemento = window.parent.document.getElementById('fax$suf');";
             echo "    elemento.value = source.value;";
             echo "    source = document.getElementById('email_'+i);";
             echo "    elemento = window.parent.document.getElementById('email$suf');";
             echo "    elemento.value = source.value;";
             echo "    if (window.parent.document.title != 'Sistema de Cotizaciones'){";
             echo "        source = document.getElementById('confirmar_'+i);";
             echo "        window.parent.llenar_conf(source.value);";
             echo "        if (window.parent.document.adicionar.accion.value == 'Crear Reporte AG'){";
			 echo "            elemento = document.getElementById('vendedor_'+i);";
			 echo "            window.parent.elegir_item('login',elemento.value);";
             echo "        }";
             echo "        if (window.parent.document.adicionar.accion.value != 'Crear Reporte AG'){";
             echo "             source = document.getElementById('preferencias_'+i);";
             echo "             elemento = window.parent.document.getElementById('preferencias_clie');";
             echo "             elemento.value = source.value;";
             echo "             window.parent.document.getElementById('orden_clie').focus();";
             echo "             if (document.getElementById('cupo_'+i).value != 0 || document.getElementById('diascredito_'+i).value != 0){";
             echo "                elemento = window.parent.document.getElementById('si');";
             echo "                elemento.checked = true;";
             echo "                elemento = window.parent.document.getElementById('tiempocredito');";
             echo "                elemento.value = document.getElementById('diascredito_'+i).value + ' Días';";
             echo "             }else{";
             echo "                elemento = window.parent.document.getElementById('no');";
             echo "                elemento.checked = true;";
             echo "                elemento = window.parent.document.getElementById('tiempocredito');";
             echo "                elemento.value = '-';";
             echo "             }";
             echo "        }";
             echo "    }else if (window.parent.document.title != 'Sistema de Cotizaciones' && !window.parent.document.getElementById('login').disabled){";
			 echo "        elemento = document.getElementById('vendedor_'+i);";
			 echo "        window.parent.elegir_item('login',elemento.value);";
             echo "    }";
             echo "    window.parent.frames.find_contacto.style.visibility = \"hidden\";";
             echo "    window.parent.document.body.scroll=\"yes\";";
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
//require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
			 echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='cabecera' ACTION='findcontacto.php'>";       // Hace una llamado nuevamente a este script pero con
             echo "<TABLE CELLSPACING=1 WIDTH=100%>";                                // un boton de comando definido para hacer mantemientos
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=4>$titulo</TH>";
             echo "</TR>";
             echo "<TH>Nombre del Contacto</TH>";
             echo "<TH>Dirección</TH>";
             echo "<TH>Teléfono</TH>";
             echo "<TH>Fax</TH>";
             $cli_mem = '';
             while (!$rs->Eof() and !$rs->IsEmpty()) {                                  // Lee la totalidad de los registros obtenidos en la instrucción Select
                if ($rs->Value('ca_compania') != $cli_mem) {
                    echo "<TR>";
                    echo "  <TD Class=invertir COLSPAN=5>".$rs->Value('ca_compania')."</TD>";
                    echo "</TR>";
                    $cli_mem = $rs->Value('ca_compania');
                }
                if ($rs->Value('ca_idcontacto') != 0) {
                    $i = $rs->GetCurrentRow();
                    $direccion = str_replace ("|"," ",$rs->Value('ca_direccion_cl')).(($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"" . ($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"" . ($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"" . ($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"");
                    echo "<INPUT ID=idcontacto_$i TYPE='HIDDEN' NAME='idcontacto_$i' VALUE=".$rs->Value('ca_idcontacto').">";
                    echo "<INPUT ID=compania_$i TYPE='HIDDEN' NAME='compania_$i' VALUE='".$rs->Value('ca_compania')."'>";
                    echo "<INPUT ID=ncompleto_$i TYPE='HIDDEN' NAME='ncompleto_$i' VALUE='".$rs->Value('ca_ncompleto_cn')."'>";
                    echo "<INPUT ID=direccion_$i TYPE='HIDDEN' NAME='direccion_$i' VALUE='$direccion'>";
                    echo "<INPUT ID=telefonos_$i TYPE='HIDDEN' NAME='telefonos_$i' VALUE='".$rs->Value('ca_telefonos')."'>";
                    echo "<INPUT ID=fax_$i TYPE='HIDDEN' NAME='fax_$i' VALUE='".$rs->Value('ca_fax')."'>";
                    echo "<INPUT ID=email_$i TYPE='HIDDEN' NAME='email_$i' VALUE='".$rs->Value('ca_email')."'>";
                    echo "<INPUT ID=preferencias_$i TYPE='HIDDEN' NAME='preferencias_$i' VALUE='".htmlspecialchars($rs->Value('ca_preferencias'))."'>";
                    echo "<INPUT ID=confirmar_$i TYPE='HIDDEN' NAME='confirmar_$i' VALUE='".$rs->Value('ca_confirmar')."'>";
                    echo "<INPUT ID=cupo_$i TYPE='HIDDEN' NAME='cupo_$i' VALUE='".$rs->Value('ca_cupo')."'>";
                    echo "<INPUT ID=diascredito_$i TYPE='HIDDEN' NAME='diascredito_$i' VALUE='".$rs->Value('ca_diascredito')."'>";
                    echo "<INPUT ID=vendedor_$i TYPE='HIDDEN' NAME='vendedor_$i' VALUE='".$rs->Value('ca_vendedor')."'>";
                    echo "<TR style='background:F0F0F0' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" ONCLICK='javascript:seleccion($i)'>";
                    echo "  <TD style='vertical-align:top;'><B>".$rs->Value('ca_ncompleto_cn')."</B><br/>".$rs->Value('ca_cargo')."</TD>";
                    echo "  <TD style='vertical-align:top;'>".$direccion."</TD>";
                    echo "  <TD style='vertical-align:top;'>".$rs->Value('ca_telefonos')."</TD>";
                    echo "  <TD style='vertical-align:top;'>".$rs->Value('ca_fax')."</TD>";
                    echo "</TR>";
                }else{
                    echo "<TR>";
                    echo "  <TD Class=listar style='text-align:center;' COLSPAN=4>No hay contactos creados en el Cliente</TD>";
                    echo "</TR>";
                }
                $rs->MoveNext();
               }
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:history.go(-1)'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             //require_once("footer.php");
echo "</BODY>";
             echo "</HTML>";
             break;
             }
        }
}
?>