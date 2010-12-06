<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       CONTACTOS.PHP                                               \\
// Creado:        2004-04-26                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-21                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la tabla de Contactos por Agente  \\
//                que atenderán cad trafico                                   \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
$programa = 8;

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
$impoexpos = array("Importación", "Exportación");                              // Arreglo con los servicios recibidos del contacto
$transportes = array("Aéreo", "Marítimo", "Terrestre");                        // Arreglo con los medios de transporte manejados por el contacto
$cargos = array("Jefe de Oficina", "Jefe Importación", "Jefe Exportación", "Contacto Operativo");	// Arreglo con los tipos de cargo del contacto

require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    if (!$rs->Open("select * from vi_contactos")) {       					   // Selecciona todos lo registros de la tabla Modelos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>Tabla de Contactos por Agente Coltrans S.A.</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id){";
	echo "    document.location.href = 'contactos.php?boton='+opcion+'\&id='+id;";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='cabecera' ACTION='contactos.php'>";            // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=8>SISTEMA TARIFARIO<BR>Maestra de Contactos por Agente Coltrans S.A. en el mundo</TH>";
    echo "</TR>";
    echo "<TH>ID Agente</TH>";
    echo "<TH>ID Contacto</TH>";
    echo "<TH COLSPAN=3>Nombre del Contacto</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
	$id_temp = 0;
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
	   if ($rs->Value('ca_idagente') != $id_temp) {
           echo "<TR>";
           echo "<TD Class=mostrar>".number_format($rs->Value('ca_idagente'))."</TD>";
           echo "<TD Class=mostrar style='font-weight:bold;' COLSPAN=4>".$rs->Value('ca_nomagente')."</TD>";
           echo "<TD Class=mostrar></TD>";
           echo "</TR>";
		   $id_temp = $rs->Value('ca_idagente');
    	   }
	   while($id_temp == $rs->Value('ca_idagente') and !$rs->Eof()){
             echo "<TR>";
             echo "<TD Class=mostrar ROWSPAN=6></TD>";
             echo "<TD Class=mostrar style='font-weight:bold;'>".$rs->Value('ca_idcontacto')."</TD>";
             echo "<TD Class=mostrar style='font-weight:bold;' COLSPAN=3>".$rs->Value('ca_nombre')."</TD>";
             echo "<TD WIDTH=44 Class=mostrar>";											   // Botones para hacer Mantenimiento a la Tabla
       	     echo "  <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\",  \"".$rs->Value('ca_idcontacto')."\");'>";
      	     echo "  <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\", \"".$rs->Value('ca_idcontacto')."\");'>";
      	     echo "</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "<TD Class=mostrar>Dirección :</TD>";
             echo "<TD Class=mostrar COLSPAN=3>".$rs->Value('ca_direccion')."</TD>";
             echo "<TD Class=mostrar ROWSPAN=6></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "<TD Class=mostrar>Teléfonos :</TD>";
             echo "<TD Class=mostrar>".$rs->Value('ca_telefonos')."</TD>";
             echo "<TD Class=mostrar>Fax :</TD>";
             echo "<TD Class=mostrar>".$rs->Value('ca_fax')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "<TD Class=mostrar>País :</TD>";
             echo "<TD Class=mostrar>".$rs->Value('ca_nomtrafico')."</TD>";
             echo "<TD Class=mostrar>Ciudad :</TD>";
             echo "<TD Class=mostrar>".$rs->Value('ca_ciudad')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "<TD Class=mostrar>Email :</TD>";
             echo "<TD Class=mostrar COLSPAN=3>".$rs->Value('ca_email')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "<TD Class=listar>Atiende :</TD>";
             echo "<TD Class=listar>".str_replace ("|","<BR>",$rs->Value('ca_impoexpo'))."</TD>";
             echo "<TD Class=listar>Transporte :</TD>";
             echo "<TD Class=listar>".str_replace ("|","<BR>",$rs->Value('ca_transporte'))."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "<TD Class=mostrar>Cargo :</TD>";
             echo "<TD Class=mostrar>".$rs->Value('ca_cargo')."</TD>";
             echo "<TD Class=mostrar>Detalles :</TD>";
             echo "<TD Class=mostrar>".$rs->Value('ca_detalle')."</TD>";
             echo "</TR>";
             echo "<TR HEIGHT=5>";
             echo "<TD Class=mostrar COLSPAN=6></TD>";
             echo "</TR>";
      	     $rs->MoveNext();
      	    }
       echo "<TR HEIGHT=5>";
       echo "<TD Class=captura COLSPAN=6></TD>";
       echo "</TR>";
       }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operación
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
             if (!$tm->Open("select ca_idagente, ca_nombre from tb_agentes where ca_idagente = ".$id)) { // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php?buscar=\"Consultar Agentes\"\&id=$id';</script>";
                 exit; }
             echo "<HEAD>";
             echo "<TITLE>Tabla de Contactos por Agente Coltrans S.A.</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.adicionar.id.value == '')";
			 echo "      alert('El campo Identificación no es válido');";
			 echo "  else if (document.adicionar.nombre.value == '')";
			 echo "      alert('El campo Nombre no es válido');";
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
             echo "<H3>Maestra de Contactos Coltrans S.A.</H3>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='contactos.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='".$id."'>";           // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=4>Datos para el nuevo Contacto</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Agente:</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><SELECT NAME='idagente'>";              // Llena el cuadro de lista con los valores de la tabla Agentes
             while ( !$tm->Eof()) {
                     echo"<OPTION VALUE=".$tm->Value('ca_idagente').">".$tm->Value('ca_nombre')." «".substr($tm->Value('ca_idagente'),6,3)."» </OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><INPUT TYPE='TEXT' NAME='nombre' SIZE=40 MAXLENGTH=60></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><INPUT TYPE='TEXT' NAME='idcontacto' SIZE=12 MAXLENGTH=9 style='text-transform: uppercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Dirección:</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><INPUT TYPE='TEXT' NAME='direccion' SIZE=60 MAXLENGTH=100></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Teléfonos:</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><INPUT TYPE='TEXT' NAME='telefonos' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fax:</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><INPUT TYPE='TEXT' NAME='fax' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             if (!$tm->Open("select min(c.ca_idciudad) as ca_idciudad, c.ca_ciudad, t.ca_nombre from tb_ciudades c, tb_traficos t where c.ca_idtrafico = t.ca_idtrafico and t.ca_idtrafico != '99-999' group by t.ca_nombre, c.ca_ciudad order by t.ca_nombre, c.ca_ciudad")) {       // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php';</script>";
                 exit; }
			 $tm->MoveFirst();
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><SELECT NAME='idciudad'>";             // Llena el cuadro de lista con los valores de la tabla Ciudades
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE=".$tm->Value('ca_idciudad').">".$tm->Value('ca_nombre')." - ".$tm->Value('ca_ciudad')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><INPUT TYPE='TEXT' NAME='email' SIZE=40 MAXLENGTH=40 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Atiende Impo/Expo:</TD>";
             echo "  <TD Class=listar>";
             for ($i=0; $i < count($impoexpos); $i++) {
                  echo " <INPUT TYPE=CHECKBOX NAME='impoexpo[]' VALUE='".$impoexpos[$i]."'>".$impoexpos[$i]."<BR>";
                  }
             echo "  </TD>";
             echo "  <TD Class=captura style='vertical-align:top;'>Transporte:</TD>";
             echo "  <TD Class=listar>";
             for ($i=0; $i < count($transportes); $i++) {
                  echo " <INPUT TYPE=CHECKBOX NAME='transporte[]' VALUE='".$transportes[$i]."'>".$transportes[$i]."<BR>";
                  }
             echo "  </TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Cargo:</TD>";
             echo "  <TD Class=listar>";
             for ($i=0; $i < count($cargos); $i++) {
                  echo " <INPUT TYPE=RADIO NAME='cargo' VALUE='".$cargos[$i]."'>".$cargos[$i]."<BR>";
                  }
             echo "  </TD>";
             echo "  <TD Class=captura style='vertical-align:top;'>Detalles:</TD>";
             echo "  <TD Class=listar><INPUT TYPE='TEXT' NAME='detalle' SIZE=30 MAXLENGTH=100></TD>";
             echo "</TR>";
			  echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Cotizaciones:<img src=\"./graficos/nuevo.gif\" border=\"0\"> </TD>";
             echo "  <TD Class=listar>";
             		
                  echo " <INPUT TYPE=CHECKBOX NAME='sugerida' VALUE='1'";
				  if ( $rs->Value('ca_sugerido')=="t" ) {
				      echo " CHECKED";
				  }
				  echo ">Sugerir en cotizaciones<BR>";
                 
             echo "  </TD>";
             echo "  <TD Class=captura style='vertical-align:top;'>&nbsp;</TD>";
             echo "  <TD Class=listar>&nbsp;</TD>";
             echo "</TR>";
			  echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Activo: <img src=\"./graficos/nuevo.gif\" border=\"0\"> </TD>";
             echo "  <TD Class=listar>";
             		
                  echo " <INPUT TYPE=CHECKBOX NAME='activo' VALUE='1'";
				  if ( $rs->Value('ca_activo_con')=="t" ) {
				      echo " CHECKED";
				  }
				  echo ">Activo<BR>";
                 
             echo "  </TD>";
             echo "  <TD Class=captura style='vertical-align:top;'>&nbsp;</TD>";
             echo "  <TD Class=listar>&nbsp;</TD>";
             echo "</TR>";	
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='cancel' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"agentes.php?buscar=Consultar Agentes\&id=$id\"'></TH>";  // Cancela la operación
             echo "<script>adicionar.idagente.focus()</script>";
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
             if (!$tm->Open("select min(c.ca_idciudad) as ca_idciudad, c.ca_ciudad, t.ca_nombre from tb_ciudades c, tb_traficos t where c.ca_idtrafico = t.ca_idtrafico group by t.ca_nombre, c.ca_ciudad order by t.ca_nombre, c.ca_ciudad")) {       // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php?buscar=\"Consultar Agentes\"\&id=$id';</script>";
                 exit; }

             if (!$rs->Open("select * from vi_contactos where ca_idcontacto = '$cn'")) {  // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php?buscar=\"Consultar Agentes\"\&id=$id';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>Tabla de Contactos por Agente Coltrans S.A.</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.modificar.direccion.value == '' && document.modificar.telefonos.value == '' && document.modificar.email.value == '')";
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
             echo "<H3>Maestra de Contactos Coltrans S.A.</H3>";
             echo "<FORM METHOD=post NAME='modificar' ACTION='contactos.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='$id'>";      // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='cn' VALUE=".$rs->Value('ca_oid').">";           // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=4>Nuevos Datos para el Contacto</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Agente:</TD>";
             echo "  <TD Class=mostrar COLSPAN=3 style='font-weight:bold; text-align:center; font-size: 12px;'>".$rs->Value('ca_nomagente')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><INPUT TYPE='TEXT' NAME='idcontacto' VALUE='".$rs->Value('ca_idcontacto')."' SIZE=12 MAXLENGTH=9 style='text-transform: uppercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><INPUT TYPE='TEXT' NAME='nombre' VALUE='".$rs->Value('ca_nombre')."' SIZE=40 MAXLENGTH=60></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Dirección:</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><INPUT TYPE='TEXT' NAME='direccion' VALUE='".$rs->Value('ca_direccion')."' SIZE=60 MAXLENGTH=100></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Teléfonos:</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><INPUT TYPE='TEXT' NAME='telefonos' VALUE='".$rs->Value('ca_telefonos')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fax:</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><INPUT TYPE='TEXT' NAME='fax' VALUE='".$rs->Value('ca_fax')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><SELECT NAME='idciudad'>";             // Llena el cuadro de lista con los valores de la tabla Ciudades
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE=".$tm->Value('ca_idciudad');
                     if ($tm->Value('ca_idciudad')==$rs->Value('ca_idciudad')) {
                         echo" SELECTED"; }
					 echo ">".$tm->Value('ca_nombre')." - ".$tm->Value('ca_ciudad')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><INPUT TYPE='TEXT' NAME='email' VALUE='".$rs->Value('ca_email')."' SIZE=40 MAXLENGTH=40 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Atiende Impo/Expo:</TD>";
             echo "  <TD Class=listar>";
             for ($i=0; $i < count($impoexpos); $i++) {
                  $chequear = (in_array($impoexpos[$i],explode("|",$rs->Value('ca_impoexpo'))))?"CHECKED":" ";
                  echo " <INPUT TYPE=CHECKBOX NAME='impoexpo[]' VALUE='".$impoexpos[$i]."' ".$chequear.">".$impoexpos[$i]."<BR>";
                  }
             echo "  </TD>";
             echo "  <TD Class=captura style='vertical-align:top;'>Transporte:</TD>";
             echo "  <TD Class=listar>";
             for ($i=0; $i < count($transportes); $i++) {
                  $chequear = (in_array($transportes[$i],explode("|",$rs->Value('ca_transporte'))))?"CHECKED":" ";
                  echo " <INPUT TYPE=CHECKBOX NAME='transporte[]' VALUE='".$transportes[$i]."' ".$chequear.">".$transportes[$i]."<BR>";
                  }
             echo "  </TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Cargo:</TD>";
             echo "  <TD Class=listar>";
             for ($i=0; $i < count($cargos); $i++) {
                  echo " <INPUT TYPE=RADIO NAME='cargo' VALUE='".$cargos[$i]."'";
				  if ($rs->Value('ca_cargo') == $cargos[$i]) {
				      echo " CHECKED";
				  }
				  echo ">".$cargos[$i]."<BR>";
                  }
             echo "  </TD>";
             echo "  <TD Class=captura style='vertical-align:top;'>Detalles:</TD>";
             echo "  <TD Class=listar><INPUT TYPE='TEXT' NAME='detalle' VALUE='".$rs->Value('ca_detalle')."' SIZE=30 MAXLENGTH=100></TD>";
             echo "</TR>";
			 echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Cotizaciones: <img src=\"./graficos/nuevo.gif\" border=\"0\"> </TD>";
             echo "  <TD Class=listar>";
             		
                  echo " <INPUT TYPE=CHECKBOX NAME='sugerida' VALUE='1'";
				  
				  if ( $rs->Value('ca_sugerido')=="t" ) {
				      echo " CHECKED";
				  }
				  echo ">Sugerir en cotizaciones<BR>";
                 
             echo "  </TD>";
             echo "  <TD Class=captura style='vertical-align:top;'>&nbsp;</TD>";
             echo "  <TD Class=listar>&nbsp;</TD>";
             echo "</TR>";
			  echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Activo: <img src=\"./graficos/nuevo.gif\" border=\"0\"> </TD>";
             echo "  <TD Class=listar>";
             		
                  echo " <INPUT TYPE=CHECKBOX NAME='activo' VALUE='1'";
				  
				  if ( $rs->Value('ca_activo_con')=="t" ) {
				      echo " CHECKED";
				  }
				  echo ">Activo<BR>";
                 
             echo "  </TD>";
             echo "  <TD Class=captura style='vertical-align:top;'>&nbsp;</TD>";
             echo "  <TD Class=listar>&nbsp;</TD>";
             echo "</TR>";			 
             echo"</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo"<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
             echo"<TH><INPUT Class=button TYPE='BUTTON' NAME='cancel' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"agentes.php?buscar=Consultar Agentes\&id=$id\"'></TH>";  // Cancela la operación
             echo"<script>modificar.direccion.focus()</script>";
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
             if (!$rs->Open("select * from vi_contactos where ca_idcontacto = '$cn'")) { // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php?buscar=\"Consultar Agentes\"\&id=$id';</script>";
                 exit;
                }
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>Maestra de Contactos Coltrans S.A.</H3>";
             echo "<FORM METHOD=post NAME='eliminar' ACTION='contactos.php'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE WIDTH=380 CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='$id'>";      // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='cn' VALUE=".$rs->Value('ca_oid').">";           // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Datos del Contacto a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Agente:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_nomagente')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idcontacto')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_nombre')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Dirección:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_direccion')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Teléfonos:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_telefonos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fax:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_fax')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_nomtrafico')." - ".$rs->Value('ca_ciudad')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_email')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Atiende Impo/Expo:</TD>";
             echo "  <TD Class=mostrar>".str_replace ("|","<BR>",$rs->Value('ca_impoexpo'))."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Transporte:</TD>";
             echo "  <TD Class=mostrar>".str_replace ("|","<BR>",$rs->Value('ca_transporte'))."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Cargo:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_cargo')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Detalles:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_detalle')."</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='cancel' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"agentes.php?buscar=Consultar Agentes\&id=$id\"'></TH>";  // Cancela la operación
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
		     $impoexpo = implode("|",$impoexpo);
		     $transporte = implode("|",$transporte);
			 $direccion = addslashes($direccion);
			 if($sugerida){
			 	$sug = "true";
			 }else{
			 	$sug = "false";
			 }	
			 
			 if($activo){
			 	$act = "true";
			 }else{
			 	$act = "false";
			 }			 
             if (!$rs->Open("insert into tb_contactos (ca_idcontacto, ca_idagente, ca_nombre, ca_direccion, ca_telefonos, ca_fax, ca_idciudad, ca_email, ca_impoexpo, ca_transporte, ca_cargo, ca_detalle, ca_sugerido, ca_activo, ca_fchcreado, ca_usucreado) values(upper('$idcontacto'), $idagente, '$nombre', '$direccion', '$telefonos', '$fax', '$idciudad', lower('$email'), '$impoexpo', '$transporte', '$cargo', '$detalle', $sug, $act, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
		     $impoexpo = implode("|",$impoexpo);
		     $transporte = implode("|",$transporte);
			 $direccion = addslashes($direccion);
			  if($sugerida){
			 	$sug = "true";
			 }else{
			 	$sug = "false";
			 }
			 
			 if($activo){
			 	$act = "true";
			 }else{
			 	$act = "false";
			 }
			 
             if (!$rs->Open("update tb_contactos set ca_idcontacto = '$idcontacto', ca_nombre = '$nombre', ca_direccion = '$direccion', ca_telefonos = '$telefonos', ca_fax = '$fax', ca_idciudad = '$idciudad', ca_email = lower('$email'), ca_impoexpo = '$impoexpo', ca_transporte = '$transporte', ca_cargo = '$cargo', ca_detalle = '$detalle', ca_sugerido=$sug, ca_activo=$act, ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where oid = $cn")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_contactos where oid = $cn")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php';</script>";
                 exit;
                }
             break;
             }
        }
	if (isset($id)) {
		echo "<script>document.location.href = 'agentes.php?buscar=Consultar Agentes\&id=$id';</script>";  // Retorna a la pantalla principal de la opción
	}else {
		echo "<script>document.location.href = 'agentes.php';</script>";  // Retorna a la pantalla principal de la opción
	}
}
?>