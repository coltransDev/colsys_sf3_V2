<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       CONTACTOS.PHP                                               \\
// Creado:        2004-04-26                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-21                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la tabla de Contactos por  Cliente\\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$programa = 10;

$titulo = 'Maestra de Contactos por Cliente';
$meses  = array( "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );
$saludos= array( "Señor" => "Señor", "Señora" => "Señora", "Doctor" => "Doctor", "Doctora" => "Doctora", "Ingeniero" => "Ingeniero", "Ingeniera" => "Ingeniera", "Arquitecto" => "Arquitecto", "Arquitecta" => "Arquitecta" );
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    if (!$rs->Open("select * from vi_concliente where ca_idcliente = $id")) {    // Selecciona todos lo registros de la tabla Clientes
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>Tabla de Contactos por Cliente</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, co){";
    echo "    document.location.href = 'concliente.php?boton='+opcion+'\&id='+id+'\&co='+co;";
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='concliente.php'>";         // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=8>$titulo</TH>";
    echo "</TR>";
    echo "<TH>ID Cliente</TH>";
    echo "<TH COLSPAN=4>Nombre del Contacto</TH>";
    $visible = ($rs->Value('ca_vendedor')== $usuario or $rs->Value('ca_vendedor')=='' or $nivel >= 2)?'visible':'hidden';
    echo "<TH><IMG style='visibility: $visible;' src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", ".$id.", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
    $id_temp = 0;
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       if ($rs->Value('ca_idcliente') != $id_temp) {
           $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"");
           echo "<TR>";
           echo "<TD Class=mostrar style='vertical-align: top;'>".number_format($rs->Value('ca_idalterno')?$rs->Value('ca_idalterno'):$rs->Value('ca_idcliente'))."-".$rs->Value('ca_digito')."</TD>";
           echo "<TD WIDTH=430 Class=mostrar COLSPAN=4 style='font-size: 11px; text-align:left;'><B>".$rs->Value('ca_compania')."<BR>Dirección: </B>".str_replace ("|"," ",$rs->Value('ca_direccion_cl')).$complemento. "&nbsp;&nbsp;<B>Localidad: </B>" . $rs->Value('ca_localidad')."<BR><B>Teléfonos: </B>".$rs->Value('ca_telefonos_cl')."&nbsp;&nbsp;&nbsp;&nbsp;<B>Fax: </B>".$rs->Value('ca_fax_cl')."</TD>";
           echo "<TD Class=mostrar></TD>";
           echo "</TR>";
           $id_temp = $rs->Value('ca_idcliente');
           }
       while($id_temp == $rs->Value('ca_idcliente') and !$rs->Eof()){
          if ($rs->Value('ca_ncompleto_cn') != '') {
              $linkEmail = "<a href='https://www.colsys.com.co/email/verEmail?id=".substr($rs->Value('ca_pcontactos'),strpos($rs->Value('ca_pcontactos'),'masivas')+8,10)."' target='_blank'>Ver Email</a>";
              echo "<TR>";
              echo "<TD Class=mostrar ROWSPAN=5></TD>";
              echo "<TD Class=mostrar style='font-size: 11px; font-weight:bold;'>".$rs->Value('ca_saludo_cn')."</TD>";
              echo "<TD Class=mostrar style='font-size: 11px; font-weight:bold;' COLSPAN=3>".$rs->Value('ca_ncompleto_cn')."</TD>";
              echo "<TD WIDTH=44 Class=mostrar>";                                              // Botones para hacer Mantenimiento a la Tabla
              echo "  <IMG style='visibility: $visible;' src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\", ".$id.", ".$rs->Value('ca_idcontacto').");'>";
              echo "  <IMG style='visibility: $visible;' src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\", ".$id.", ".$rs->Value('ca_idcontacto').");'>";
              echo "</TD>";
              echo "</TR>";
              echo "<TR>";
              echo "<TD Class=mostrar>Cargo :</TD>";
              echo "<TD Class=mostrar>".$rs->Value('ca_cargo')."</TD>";
              echo "<TD Class=mostrar>Área o Departamento :</TD>";
              echo "<TD Class=mostrar>".$rs->Value('ca_departamento')."</TD>";
              echo "<TD Class=listar ROWSPAN=4><!--<IMG SRC='./graficos/nuevo.gif' border=0 ALT='Se modificó la opción para eliminar contatos en el cliente!'>--></TD>";
              echo "</TR>";
              echo "<TR>";
              echo "<TD Class=mostrar>Teléfonos :</TD>";
              echo "<TD Class=mostrar>".$rs->Value('ca_telefonos')."</TD>";
              echo "<TD Class=mostrar>Fax :</TD>";
              echo "<TD Class=mostrar>".$rs->Value('ca_fax')."</TD>";
              echo "</TR>";
              echo "<TR>";
              echo "<TD Class=mostrar style='vertical-align: top;' COLSPAN=2>Email :<BR>".$rs->Value('ca_email')."&nbsp;</TD>";
              echo "<TD Class=mostrar style='vertical-align: top;' COLSPAN=2>Observaciones :<BR><ul><li>".$rs->Value('ca_observaciones')."&nbsp;</li>".(($rs->Value('ca_fijo')=="t")?"<li><b>Contacto Fijo en Comunicaciones</b></li>":"").((strstr($rs->Value('ca_pcontactos'), "masivas")!='')?'<li>No enviar comunicaciones masivas '.$linkEmail.'</li>':"")."</ul></TD>";
              echo "</TR>";
              $fch_mem = explode("-",$rs->Value('ca_cumpleanos'));
              echo "<TR>";
              echo "  <TD Class=mostrar COLSPAN=2>Fecha de Cumpleaños:<BR>".$meses[$fch_mem[0]]." - $fch_mem[1]</TD>";
              echo "  <TD Class=mostrar COLSPAN=2>Creado : ".$rs->Value('ca_usucreado')." ".$rs->Value('ca_fchcreado')."<BR>Actualizado : ".$rs->Value('ca_usuactualizado')." ".$rs->Value('ca_fchactualizado')."</TD>";
              echo "</TR>";
             }
          $rs->MoveNext();
         }
       }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"clientes.php?modalidad=N.i.t.&\criterio=".$rs->Value('ca_idalterno')."\"'></TH>";  // Cancela la operación
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
             if (!$tm->Open("select * from vi_clientes where ca_idcliente = $id")) { // Selecciona todos lo registros de la tabla Clientes
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'concliente.php';</script>";
                 exit; }
             echo "<HEAD>";
             echo "<TITLE>Tabla de Contactos por Cliente</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (document.adicionar.id.value == '')";
             echo "      alert('El campo Identificación no es válido');";
             echo "  else if (document.adicionar.nombre.value == '')";
             echo "      alert('El campo Nombre no es válido');";
             echo "  else if (document.adicionar.email.value == '')";
             echo "      alert('El campo Correo Electrónico no es válido');";
             echo "  else if (document.adicionar.direccion.value == '' && document.adicionar.telefonos.value == '' && document.adicionar.email.value == '')";
             echo "      alert('Debe ingresar por lo menos uno de los datos de contacto: Dirección, Teléfono o Correo Electrónico');";
             echo "  else";
             echo "      return (true);";
             echo "  return (false);";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='concliente.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='".$id."'>";           // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=3>Información del Cliente</TH>";
             echo "<TR>";
             echo "  <TD Class=mostrar style='vertical-align: top;' ROWSPAN=4>".number_format($tm->Value('ca_idcliente'))."-".$tm->Value('ca_digito')."</TD>";
             echo "  <TD Class=mostrar COLSPAN=2 style='font-size: 12px; font-weight:bold; text-align:left;'>".$tm->Value('ca_compania')."</TD>";
             echo "</TR>";
             echo "<TR>";
             $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"");
             echo "  <TD Class=mostrar COLSPAN=2>&nbsp;&nbsp;<B>Dirección : </B>".str_replace ("|"," ",$tm->Value('ca_direccion')).$complemento."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>&nbsp;&nbsp;<B>Teléfonos : </B>".$tm->Value('ca_telefonos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>&nbsp;&nbsp;<B>Fax : </B>".$tm->Value('ca_fax')."</TD>";
             echo "</TR>";
             echo "<TH Class=titulo COLSPAN=3>Datos para el nuevo Contacto</TH>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;' ROWSPAN=12>Datos del Contacto. :</TD>";
             echo "  <TD Class=mostrar>Saludo:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='saludo'>";
             while (list ($clave, $val) = each ($saludos)) {
                echo " <OPTION VALUE=$clave>$val</OPTION>";
             }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Nombres:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='nombres' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Primer Apellido:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='papellido' SIZE=15 MAXLENGTH=15></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Segundo Apellido:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='sapellido' SIZE=15 MAXLENGTH=15></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Cargo:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='cargo' SIZE=20 MAXLENGTH=40></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Área o Departamento:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='departamento' SIZE=25 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Teléfonos:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='telefonos' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Fax:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fax' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Fecha Cumpleaños:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='cumpleanos[]'>";
             echo "    <OPTION VALUE=''>Seleccione el Mes</OPTION>";
             while (list ($clave, $val) = each ($meses)) {
                echo " <OPTION VALUE=$clave>$val</OPTION>";
             }
             echo "  </SELECT>&nbsp;&nbsp;Día :<INPUT TYPE='TEXT' NAME='cumpleanos[]' SIZE=3 MAXLENGTH=2></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='email' SIZE=35 MAXLENGTH=150 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN='2'>Contacto Fijo en Comunicaciones :&nbsp;&nbsp;<INPUT TYPE='CHECKBOX' NAME='fijo'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Tipo :</td><td Class=mostrar><select  id='tipo' name='tipo'><option value='0'></option><option value='1'>Agente de aduana</option></select></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;'>Observaciones:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=5 COLS=58></TEXTAREA></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"concliente.php?id=$id\"'></TH>";  // Cancela la operación
             echo "<script>adicionar.saludo.focus()</script>";
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
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select * from vi_clientes where ca_idcliente = $id")) { // Selecciona todos lo registros de la tabla Clientes
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'concliente.php';</script>";
                 exit; }
             if (!$rs->Open("select * from vi_concliente where ca_idcontacto = $co")) {  // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'concliente.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>Tabla de Contactos por Cliente</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (document.modificar.direccion.value == '' && document.modificar.telefonos.value == '' && document.modificar.email.value == '')";
             echo "      alert('Debe ingresar por lo menos uno de los datos de contacto: Dirección, Teléfono o Correo Electrónico');";
             echo "  else if (document.modificar.email.value == '')";
             echo "      alert('El campo Correo Electrónico no es válido');";
             echo "  else";
             echo "      return (true);";
             echo "  return (false);";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='modificar' ACTION='concliente.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='".$id."'>";           // Hereda el Id del registro que se esta eliminando
             echo "<INPUT TYPE='HIDDEN' NAME='co' VALUE='".$co."'>";           // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=3>Nuevos Datos para el Contacto</TH>";
             echo "<TR>";
             echo "  <TD Class=mostrar style='vertical-align: top;' ROWSPAN=4>".number_format($tm->Value('ca_idcliente'))."-".$tm->Value('ca_digito')."</TD>";
             echo "  <TD Class=mostrar COLSPAN=2 style='font-size: 12px; font-weight:bold; text-align:left;'>".$tm->Value('ca_compania')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>&nbsp;&nbsp;<B>Dirección : </B>".$tm->Value('ca_direccion')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>&nbsp;&nbsp;<B>Teléfonos : </B>".$tm->Value('ca_telefonos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>&nbsp;&nbsp;<B>Fax : </B>".$tm->Value('ca_fax')."</TD>";
             echo "</TR>";
             echo "<TH Class=titulo COLSPAN=3>Datos para el nuevo Contacto</TH>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;' ROWSPAN=12>Datos del Contacto :</TD>";
             echo "  <TD Class=mostrar>Saludo:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='saludo'>";
             while (list ($clave, $val) = each ($saludos)) {
                echo " <OPTION VALUE=$clave";
                if ($clave==$rs->Value('ca_saludo_cn')) {
                    echo" SELECTED"; }
                echo ">$val</OPTION>";
             }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Nombres:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='nombres' VALUE='".$rs->Value('ca_nombres')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Primer Apellido:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='papellido' VALUE='".$rs->Value('ca_papellido')."' SIZE=15 MAXLENGTH=15></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Segundo Apellido:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='sapellido' VALUE='".$rs->Value('ca_sapellido')."' SIZE=15 MAXLENGTH=15></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Cargo:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='cargo' VALUE='".$rs->Value('ca_cargo')."' SIZE=20 MAXLENGTH=40></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Área o Departamento:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='departamento' VALUE='".$rs->Value('ca_departamento')."' SIZE=25 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Teléfonos:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='telefonos' VALUE='".$rs->Value('ca_telefonos')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Fax:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fax' VALUE='".$rs->Value('ca_fax')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Fecha Cumpleaños:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='cumpleanos[]'>";
             echo "    <OPTION VALUE=''>Seleccione el Mes</OPTION>";
             $fch_mem = explode("-",$rs->Value('ca_cumpleanos'));
             while (list ($clave, $val) = each ($meses)) {
                echo " <OPTION VALUE=$clave";
                if ($clave==$fch_mem[0]) {
                    echo" SELECTED"; }
                echo ">$val</OPTION>";
             }
             echo "  </SELECT>&nbsp;&nbsp;Día :<INPUT TYPE='TEXT' NAME='cumpleanos[]' VALUE='".$fch_mem[1]."' SIZE=3 MAXLENGTH=2></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='email' VALUE='".$rs->Value('ca_email')."' SIZE=35 MAXLENGTH=150 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN='2'>Contacto Fijo en Comunicaciones :&nbsp;&nbsp;<INPUT TYPE='CHECKBOX' NAME='fijo' ".(($rs->Value('ca_fijo')=="t")?"CHECKED":"")."></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar >Tipo </td><td Class=mostrar><select  id='tipo' name='tipo'><option value='0'></option><option value='1' ".(($rs->Value('ca_tipo')=="1")?"selected":"")." >Agente de aduana</option></select></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;'>Observaciones:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=5 COLS=58>".$rs->Value('ca_observaciones')."</TEXTAREA></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo"<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
             echo"<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"concliente.php?id=$id\"'></TH>";  // Cancela la operación
             echo"<script>modificar.saludo.focus()</script>";
             echo"</TABLE>";
             echo"</FORM>";
             echo"</CENTER>";
//           echo"<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Eliminar': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select * from vi_clientes where ca_idcliente = $id")) { // Selecciona todos lo registros de la tabla Clientes
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'concliente.php';</script>";
                 exit; }
             if (!$rs->Open("select * from vi_concliente where ca_idcontacto = $co")) {  // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'concliente.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>Tabla de Contactos por Cliente</TITLE>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='eliminar' ACTION='concliente.php'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE WIDTH=400 CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='".$id."'>";           // Hereda el Id del registro que se esta eliminando
             echo "<INPUT TYPE='HIDDEN' NAME='co' VALUE='".$co."'>";           // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=3>Datos del Contacto a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=destacar COLSPAN=3><!--<IMG SRC='./graficos/nuevo.gif' border=0 ALT='Especifique una etapa para el proceso de Importación'><br />--><B>El Contacto NO será eliminado de forma definitiva de la base de datos y en su lugar, el sistema automáticamente remplazará los campos Cargo y Departamente con la palabra 'Extrabajador'. Pulse el botón 'Eliminar' para proceder de ésta forma.</B></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar style='vertical-align: top;' ROWSPAN=4>".number_format($tm->Value('ca_idcliente'))."-".$tm->Value('ca_digito')."</TD>";
             echo "  <TD Class=mostrar COLSPAN=2 style='font-size: 12px; font-weight:bold; text-align:left;'>".$tm->Value('ca_compania')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>&nbsp;&nbsp;<B>Dirección : </B>".$tm->Value('ca_direccion')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>&nbsp;&nbsp;<B>Teléfonos : </B>".$tm->Value('ca_telefonos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>&nbsp;&nbsp;<B>Fax : </B>".$tm->Value('ca_fax')."</TD>";
             echo "</TR>";
             echo "<TH Class=titulo COLSPAN=3>Datos para el nuevo Contacto</TH>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;' ROWSPAN=12>Datos del Contacto :</TD>";
             echo "  <TD Class=mostrar>Saludo:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_saludo')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Nombres:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_nombres')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Primer Apellido:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_papellido')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Segundo Apellido:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_sapellido')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Cargo:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_cargo')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Área o Departamento:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_departamento')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Teléfonos:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_telefonos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Fax:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_fax')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Fecha Cumpleaños:</TD>";
             $fch_mem = explode("-",$rs->Value('ca_cumpleanos'));
             echo "  <TD Class=mostrar>".$meses[$fch_mem[0]]." - $fch_mem[1]</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_email')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;'>Observaciones:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2>".$rs->Value('ca_observaciones')."</TD>";
             echo "</TR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"concliente.php?id=$id\"'></TH>";  // Cancela la operación
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
    $fijo = (isset($fijo) and $fijo=="on")?"true":"false";
    switch(trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Guardar': {                                                      // El Botón Guardar fue pulsado
             $cumpleanos = isset($cumpleanos)?implode("-",$cumpleanos):"";
             if (!$rs->Open("insert into tb_concliente (ca_idcliente, ca_papellido, ca_sapellido, ca_nombres, ca_saludo, ca_cargo, ca_departamento, ca_telefonos, ca_fax, ca_cumpleanos, ca_email, ca_fijo, ca_tipo, ca_observaciones, ca_fchcreado, ca_usucreado) values($id, '$papellido', '$sapellido', '$nombres', '$saludo', '$cargo', '$departamento', '$telefonos', '$fax', '$cumpleanos', lower('$email'), '$fijo', '$tipo','$observaciones', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'concliente.php?id=$id';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             $cumpleanos = isset($cumpleanos)?implode("-",$cumpleanos):"";
             $sql_update="update tb_concliente set ca_papellido = '$papellido', ca_sapellido = '$sapellido', ca_nombres = '$nombres', ca_saludo = '$saludo', ca_cargo = '$cargo', ca_departamento = '$departamento', ca_telefonos = '$telefonos', ca_fax = '$fax', ca_cumpleanos = '$cumpleanos', ca_email = lower('$email'), ca_fijo = '$fijo', ca_tipo = '$tipo', ca_observaciones = '$observaciones', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where ca_idcliente = $id and ca_idcontacto = $co";
             if (!$rs->Open($sql_update)) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'concliente.php?id=$id';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("update tb_concliente set ca_cargo = 'Extrabajador', ca_departamento = 'Extrabajador', ca_email = '', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where ca_idcliente = $id and ca_idcontacto = $co")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'concliente.php?id=$id';</script>";
                 exit;
                }
             if (!$rs->Open("delete from tb_tracking_users where ca_idcontacto = $co")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'concliente.php?id=$id';</script>";
                 exit;
                }

             break;
             }
        }
   echo "<script>document.location.href = 'concliente.php?id=$id';</script>";  // Retorna a la pantalla principal de la opción
   }
?>