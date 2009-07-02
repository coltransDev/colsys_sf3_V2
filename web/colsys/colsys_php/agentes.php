<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       AGENTES.PHP                                                 \\
// Creado:        2004-04-21                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-21                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la tabla de Agentes Coltrans en   \\
//                el mundo                                                    \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
$programa = 8;

$tipos = array("Oficial","No Oficial");                                        // Arreglo con los Tipos de Agentes

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta

if( $nivel==0 ){
	header("Location: agentes_cons.php");
	exit();
}


$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($buscar) and !isset($boton) and !isset($accion)) {
    if (!$rs->Open("select ca_idtrafico, ca_nombre from tb_traficos order by ca_nombre")) { // Selecciona todos lo registros de la tabla Agentes
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    $tm =& DlRecordset::NewRecordset($conn);
    if (!$tm->Open("select distinct on (c.ca_ciudad) a.ca_idciudad, c.ca_ciudad, c.ca_idtrafico from tb_agentes a, tb_ciudades c where a.ca_idciudad = c.ca_idciudad order by c.ca_ciudad")) {       // Selecciona todos lo registros de la tabla Origenes
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
        $tm->MoveFirst();
    while ( !$tm->Eof()) {
            echo "<INPUT TYPE='HIDDEN' NAME='ar_idciudad' VALUE=".$tm->Value('ca_idciudad').">";
            echo "<INPUT TYPE='HIDDEN' NAME='ar_ciudad' VALUE='".$tm->Value('ca_ciudad')."'>";
            echo "<INPUT TYPE='HIDDEN' NAME='ar_idtrafico' VALUE='".$tm->Value('ca_idtrafico')."'>";
            $tm->MoveNext();
          }
    echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
    echo "function llenar_ciudades(){";
    echo "  document.cabecera.idciudad.length=0;";
	echo "  document.cabecera.idciudad.options[document.cabecera.idciudad.length] = new Option();";
    echo "  document.cabecera.idciudad.length=0;";
    echo "  document.cabecera.idciudad[document.cabecera.idciudad.length] = new Option('Oficinas Principales','%',false,false);";
    echo "  if (isNaN(ar_ciudad.length)){";
	echo "      if (document.cabecera.idtrafico.value == ar_idtrafico.value){";
    echo "          document.cabecera.idciudad[document.cabecera.idciudad.length] = new Option(ar_idciudad.value,ar_ciudad.value,false,false);";
    echo "          }";
	echo "     }";
  	echo "  else {";
    echo "     for (cont=0; cont<ar_ciudad.length; cont++) {";
    echo "          if (document.cabecera.idtrafico.value == ar_idtrafico[cont].value){";
    echo "              document.cabecera.idciudad[document.cabecera.idciudad.length] = new Option(ar_ciudad[cont].value,ar_idciudad[cont].value,false,false);";
    echo "           }";
    echo "       }";
    echo "     }";
    echo "}";
    echo "</script>";
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>Tabla de Agentes Coltrans S.A.</TITLE>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='cabecera' ACTION='agentes.php'>";            // Hace una llamado nuevamente a este script pero con
	echo "<INPUT TYPE='HIDDEN' NAME='buscar' VALUE='Consultar Agentes'>";
    echo "<TABLE CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=6>SISTEMA TARIFARIO<BR>Maestra de Agentes Coltrans S.A. en el mundo</TH>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=captura WIDTH=60>Tráfico:</TD>";
    echo "  <TD Class=mostrar WIDTH=100><SELECT NAME='idtrafico' ONCHANGE='llenar_ciudades();'>";             // Llena el cuadro de lista con los valores de la tabla Traficos
	echo " <OPTION VALUE=%>Todos los Tráficos</OPTION>";
    while ( !$rs->Eof()) {
            echo " <OPTION VALUE=".$rs->Value('ca_idtrafico').">".$rs->Value('ca_nombre')."</OPTION>";
            $rs->MoveNext();
          }
    echo "  </SELECT></TD>";
    echo "  <TD Class=captura WIDTH=60>Ciudad:</TD>";
    echo "  <TD Class=mostrar WIDTH=100><SELECT NAME='idciudad'>";             // Llena el cuadro de lista con los valores de la tabla Traficos
    echo "  </SELECT></TD>";
    echo "  <TD Class=captura>Agente:</TD>";
    echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='agente' SIZE=30 MAXLENGTH=100 style='text-transform: uppercase'></TD>";
    echo "</TR>";
	echo "<TH COLSPAN=6>&nbsp</TH>";
    echo "</TABLE>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='Consultar Agentes'></TH>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "<script>llenar_ciudades();</script>";
    echo "<TABLE CELLSPACING=10>";
    echo "</TABLE>";
    echo "</FORM>";
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
}
elseif (isset($buscar) and !isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo
	if (isset($id)) {
	    if (!$rs->Open("select * from vi_agentesxcont where ca_idagente = $id")) {                              // Selecciona todos lo registros de la tabla Agentes
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
	}else if (!$rs->Open("select * from vi_agentesxcont where ca_idtrafico_ag like '$idtrafico' and ca_idciudad_ag like '$idciudad' and ca_nombre_ag like upper('%$agente%')")) {                              // Selecciona todos lo registros de la tabla Agentes
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>Tabla de Agentes Coltrans S.A.</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(tabla, opcion, id, cn){";
	echo "    document.location.href = tabla+'.php?boton='+opcion+'\&id='+id+'\&cn='+cn;";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='cabecera' ACTION='agentes.php'>";            // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=530 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=6>SISTEMA TARIFARIO<BR>Maestra de Agentes Coltrans S.A. en el mundo</TH>";
    echo "</TR>";
    echo "<TH>ID</TH>";
    echo "<TH COLSPAN=4>Agente</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"agentes\", \"Adicionar\", 0, 0);'></TH>";  // Botón para la creación de un Registro Nuevo
	$id_temp = 0;
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
	   if ($rs->Value('ca_idagente') != $id_temp) {
	       echo "<TR HEIGHT=5>";
	       echo "<TD Class=imprimir COLSPAN=6></TD>";
	       echo "</TR>";
	       echo "<TR>";
	       echo "  <TD Class=captura style='font-weight:bold; vertical-align:top; font-size: 11px;'>".number_format($rs->Value('ca_idagente'))."</TD>";
	       echo "  <TD Class=captura style='font-weight:bold; vertical-align:top; font-size: 11px;' COLSPAN=5>".$rs->Value('ca_nombre_ag')." ".($rs->Value('ca_activo')!="t"?"(INACTIVO)":"")."</TD>";
	       echo "</TR>";
	       echo "<TR>";
	       echo "  <TD Class=mostrar style='vertical-align:top;'>Dirección :</TD>";
		   echo "  <TD Class=mostrar COLSPAN=4>".$rs->Value('ca_direccion_ag')."</TD>";
	       echo "  <TD WIDTH=44 Class=mostrar style='text-align:center;'>";											   // Botones para hacer Mantenimiento a la Tabla
		   echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"agentes\", \"Modificar\", ".$rs->Value('ca_idagente').", 0);'>";
		   echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"agentes\", \"Eliminar\", ".$rs->Value('ca_idagente').", 0);'>";
		   echo "  </TD>";
	       echo "</TR>";
	       echo "<TR>";
	       echo "  <TD Class=mostrar>Pais :</TD>";
	       echo "  <TD Class=mostrar><font color='#996600'>".$rs->Value('ca_idtrafico_ag')."</font>&nbsp".$rs->Value('ca_nomtrafico_ag')."</TD>";
	       echo "  <TD Class=mostrar>Ciudad :</TD>";
	       echo "  <TD Class=mostrar COLSPAN=2><font color='#996600'>".$rs->Value('ca_idciudad_ag')."</font>&nbsp".$rs->Value('ca_ciudad_ag')."</TD>";
	       echo "  <TD Class=mostrar ROWSPAN=5></TD>";
	       echo "</TR>";
	       echo "<TR>";
	       echo "  <TD Class=mostrar>Teléfonos :</TD>";
	       echo "  <TD Class=mostrar COLSPAN=2>".$rs->Value('ca_telefonos_ag')."</TD>";
	       echo "  <TD Class=mostrar>Fax :</TD>";
	       echo "  <TD Class=mostrar>".$rs->Value('ca_fax_ag')."</TD>";
	       echo "</TR>";
	       echo "<TR>";
	       echo "  <TD Class=mostrar>Web Site :</TD>";
	       echo "  <TD Class=mostrar COLSPAN=4><a href='http://".$rs->Value('ca_website')."'target='_blank'>".$rs->Value('ca_website')."</a></TD>";
	       echo "</TR>";
	       echo "<TR>";
	       echo "  <TD Class=mostrar>Email :</TD>";
	       echo "  <TD Class=mostrar COLSPAN=4>".$rs->Value('ca_email_ag')."</TD>";
	       echo "</TR>";
	       echo "<TR>";
	       echo "  <TD Class=mostrar>Zip Code :</TD>";
	       echo "  <TD Class=mostrar COLSPAN=2>".$rs->Value('ca_zipcode')."</TD>";
	       echo "  <TD Class=mostrar>Tipo :</TD>";
	       echo "  <TD Class=mostrar>".$rs->Value('ca_tipo')."</TD>";
	       echo "</TR>";
	       echo "<TR>";
	       echo "  <TD Class=captura style='font-weight:bold; text-align:center;' COLSPAN=5>Contactos del Agente</TD>";
           echo "  <TD Class=captura style='text-align:center;'><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"contactos\", \"Adicionar\", ".$rs->Value('ca_idagente').", 0);'></TD>";  // Botón para la creación de un Registro Nuevo
	       echo "</TR>";
		   $id_temp = $rs->Value('ca_idagente');
		   $tra_con = '';
		   $ciu_con = '';
    	  }
       if ($rs->Value('ca_idcontacto') != '') {
	       if ($rs->Value('ca_nomtrafico_co') != $tra_con or $rs->Value('ca_ciudad_co') != $ciu_con) {
		       echo "<TR>";
		       echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 11px;' COLSPAN=6>".strtoupper($rs->Value('ca_ciudad_co'))."</TD>";
		       echo "</TR>";
			   $tra_con = $rs->Value('ca_nomtrafico_co');
			   $ciu_con = $rs->Value('ca_ciudad_co');
	       }
	       echo "<TR>";
	       echo "<TD ";
		   if( $rs->Value('ca_sugerido')=="t" ){
		   	  echo "bgcolor='#FFFFCC'";
		   }else{
		   	  echo "Class=invertir";
		   }
		   echo " style='font-weight:bold; vertical-align:top; font-size: 11px;' COLSPAN=4>".$rs->Value('ca_nombre_co')." ".($rs->Value('ca_activo_con')!="t"?"(INACTIVO)":"")."</TD>";
	       echo "<TD ";
		   if( $rs->Value('ca_sugerido')=="t" ){
		   	  echo "bgcolor='#FFFFCC'";
		   }else{
		   	  echo "Class=invertir";
		   }
		   echo ">".$rs->Value('ca_idcontacto')."</TD>";
	       echo "<TD WIDTH=44 Class=invertir style='text-align:center;'>";											   // Botones para hacer Mantenimiento a la Tabla
	 	   echo "  <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"contactos\", \"Modificar\", ".$rs->Value('ca_idagente').", \"".$rs->Value('ca_idcontacto')."\");'>";
		   echo "  <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"contactos\", \"Eliminar\", ".$rs->Value('ca_idagente').", \"".$rs->Value('ca_idcontacto')."\");'>";
		   echo "</TD>";
	       echo "</TR>";
	       echo "<TR>";
	       echo "<TD Class=mostrar ROWSPAN=7></TD>";
	       echo "<TD Class=mostrar>Dirección :</TD>";
	       echo "<TD Class=mostrar COLSPAN=3>".$rs->Value('ca_direccion_co')."</TD>";
	       echo "<TD Class=mostrar ROWSPAN=7></TD>";
	       echo "</TR>";
	       echo "<TR>";
	       echo "<TD Class=mostrar>Teléfonos :</TD>";
	       echo "<TD Class=mostrar>".$rs->Value('ca_telefonos_co')."</TD>";
	       echo "<TD Class=mostrar>Fax :</TD>";
	       echo "<TD Class=mostrar>".$rs->Value('ca_fax_co')."</TD>";
	       echo "</TR>";
	       echo "<TR>";
	       echo "<TD Class=mostrar>País :</TD>";
	       echo "<TD Class=mostrar><font color='#996600'>".$rs->Value('ca_idtrafico_co')."</font>&nbsp".$rs->Value('ca_nomtrafico_co')."</TD>";
	       echo "<TD Class=mostrar>Ciudad :</TD>";
	       echo "<TD Class=mostrar><font color='#996600'>".$rs->Value('ca_idciudad_co')."</font>&nbsp".$rs->Value('ca_ciudad_co')."</TD>";
	       echo "</TR>";
	       echo "<TR>";
	       echo "<TD Class=mostrar>Email :</TD>";
	       echo "<TD Class=mostrar COLSPAN=3>".$rs->Value('ca_email_co')."</TD>";
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
		   
		    echo "<TR>";
	       echo "<TD Class=mostrar colspan='3' >Sugerido en cotizaciones :</TD>";
	       echo "<TD Class=mostrar>".($rs->Value('ca_sugerido')=="t"?"S&iacute;":"No")."</TD>";
	     
	       echo "</TR>";
       }
       $rs->MoveNext();
      }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Imprimir Consulta' ONCLICK='elegir(\"agentes\", \"Imprimir\", \"$idtrafico\", \"$idciudad\");'></TH>";  // Cancela la operación
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar Consulta' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operación
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Nueva Consulta' ONCLICK='javascript:document.location.href = \"agentes.php\"'></TH>";  // Cancela la operación
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
             if (!$tm->Open("select ca_idciudad, ca_ciudad, ca_nombre from vi_ciudades order by ca_nombre, ca_ciudad")) {       // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php';</script>";
                 exit; }
             echo "<HEAD>";
             echo "<TITLE>Tabla de Agentes Coltrans S.A.</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.adicionar.id.value == 0)";
			 echo "      alert('El campo Identificación no es válido');";
			 echo "  else if (document.adicionar.nombre.value == '')";
			 echo "      alert('El campo Nombre no es válido');";
			 echo "  else if (document.adicionar.direccion.value == '')";
			 echo "      alert('El campo Dirección no es válido');";
			 echo "  else if (document.adicionar.telefonos.value == '')";
			 echo "      alert('El campo Teléfonos no es válido');";
			 echo "  else if (document.adicionar.fax.value == '')";
			 echo "      alert('El campo Fax no es válido');";
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
             echo "<H3>Maestra de Agentes Coltrans S.A.</H3>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='agentes.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<TABLE CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=2>Datos para el nuevo Agente</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='nombre' SIZE=40 MAXLENGTH=60 style='text-transform: uppercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Dirección:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='direccion' SIZE=60 MAXLENGTH=100></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Teléfonos:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='telefonos' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fax:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fax' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='idciudad'>";             // Llena el cuadro de lista con los valores de la tabla Ciudades
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE=".$tm->Value('ca_idciudad').">".$tm->Value('ca_ciudad')." «".$tm->Value('ca_nombre')."»</OPTION>";
                     $tm->MoveNext();
                   }
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Página Web:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='website' SIZE=60 MAXLENGTH=60 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='email' SIZE=40 MAXLENGTH=40 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Zip Code:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='zipcode' SIZE=20 MAXLENGTH=20></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tipo :</TD>";
             echo "  <TD Class=listar>";
             for ($i=0; $i < count($tipos); $i++) {
             	echo " <INPUT TYPE=RADIO NAME='tipo' VALUE='".$tipos[$i]."'>".$tipos[$i]."<BR>";
             	}
             echo "  </TD>";
             echo "</TR>";
			  echo "<TR>";
             echo "  <TD Class=captura>Activo: <img src=\"./graficos/nuevo.gif\" border=\"0\"></TD>";
             echo "  <TD Class=mostrar>";
			 echo " <INPUT TYPE=CHECKBOX NAME='activo' VALUE='1' CHECKED>Activo<BR>";
				 
				
			 echo "</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"agentes.php\"'></TH>";  // Cancela la operación
             echo "<script>adicionar.nombre.focus()</script>";
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
             if (!$tm->Open("select ca_idciudad, ca_ciudad, ca_nombre from vi_ciudades order by ca_nombre, ca_ciudad")) {       // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php';</script>";
                 exit; }
             if (!$rs->Open("select * from vi_agentes where ca_idagente = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>Tabla de Agentes Coltrans S.A.</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.modificar.nombre.value == '')";
			 echo "      alert('El campo Nombre no es válido');";
			 echo "  else if (document.modificar.direccion.value == '')";
			 echo "      alert('El campo Dirección no es válido');";
			 echo "  else if (document.modificar.telefonos.value == '')";
			 echo "      alert('El campo Teléfonos no es válido');";
			 echo "  else if (document.modificar.fax.value == '')";
			 echo "      alert('El campo Fax no es válido');";
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
             echo "<H3>Maestra de Agentes Coltrans S.A.</H3>";
             echo "<FORM METHOD=post NAME='modificar' ACTION='agentes.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos para el Agente</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar>".number_format($rs->Value('ca_idagente'))."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='nombre' VALUE='".$rs->Value('ca_nombre')."' SIZE=40 MAXLENGTH=60 style='text-transform: uppercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Dirección:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='direccion' VALUE='".$rs->Value('ca_direccion')."' SIZE=60 MAXLENGTH=100></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Teléfonos:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='telefonos' VALUE='".$rs->Value('ca_telefonos')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fax:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fax' VALUE='".$rs->Value('ca_fax')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='idciudad'>";             // Llena el cuadro de lista con los valores de la tabla Ciudades
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE=".$tm->Value('ca_idciudad');
                     if ($tm->Value('ca_idciudad')==$rs->Value('ca_idciudad')) {
                         echo" SELECTED"; }
					 echo ">".$tm->Value('ca_ciudad')." «".$tm->Value('ca_nombre')."»</OPTION>";
                     $tm->MoveNext();
                   }
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Página Web:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='website' VALUE='".$rs->Value('ca_website')."' SIZE=60 MAXLENGTH=60 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='email' VALUE='".$rs->Value('ca_email')."' SIZE=40 MAXLENGTH=40 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Zip Code:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='zipcode' VALUE='".$rs->Value('ca_zipcode')."' SIZE=20 MAXLENGTH=20></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tipo :</TD>";
             echo "  <TD Class=listar>";
             for ($i=0; $i < count($tipos); $i++) {
             	echo " <INPUT TYPE=RADIO NAME='tipo' VALUE='".$tipos[$i]."' ".($rs->Value('ca_tipo')==$tipos[$i]?" CHECKED":"").">".$tipos[$i]."<BR>";
             	}
             echo "  </TD>";
             echo "</TR>";
			 echo "<TR>";
             echo "  <TD Class=captura>Activo: <img src=\"./graficos/nuevo.gif\" border=\"0\"></TD>";
             echo "  <TD Class=mostrar>";
			  echo " <INPUT TYPE=CHECKBOX NAME='activo' VALUE='1'";
				  if ( $rs->Value('ca_activo')=="t" ) {
				      echo " CHECKED";
				  }
				  echo ">Activo<BR>";
			 echo "</TD>";
             echo "</TR>";
			 
             echo"</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo"<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
             echo"<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"agentes.php?buscar=Consultar Agentes\&id=$id\"'></TH>";  // Cancela la operación
             echo"<script>modificar.nombre.focus()</script>";
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
             if (!$rs->Open("select * from vi_agentes where ca_idagente = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php';</script>";
                 exit;
                }
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>Maestra de Agentes Coltrans S.A.</H3>";
             echo "<FORM METHOD=post NAME='eliminar' ACTION='agentes.php'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=2>Datos del Agente a Eliminar<br>Serán Eliminados todos los Contactos</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar>".number_format($rs->Value('ca_idagente'))."</TD>";
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
             echo "  <TD Class=mostrar>".$rs->Value('ca_ciudad')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Pais :</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_nomtrafico')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Página Web:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_website')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_email')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Zip Code:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_zipcode')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tipo :</TD>";
             echo "  <TD Class=listar>".$rs->Value('ca_tipo')."</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"agentes.php?buscar=Consultar Agentes\&id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";   // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Imprimir': {
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<TABLE CELLSPACING=1 WIDTH='100%' HEIGHT='90%'>";
             echo "<TR>";
             echo "  <TD Class=invertir><iframe ID=consulta_tar src ='ventanas.php?opcion=Imprimir&id=$id&ci=$cn' width='100%' height='100%'></iframe></TD>";
             echo "</TR>";
             echo "</TABLE>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"agentes.php?buscar=Consultar Agentes&idtrafico=$id&idciudad=$cn\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</CENTER>";
             break;
             }
      }
   }
elseif (isset($accion)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
    switch(trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Guardar': {                                                      // El Botón Guardar fue pulsado
			 $direccion = addslashes($direccion);
			 if($activo){
			 	$act = "true";
			 }else{
			 	$act = "false";
			 }	
             if (!$rs->Open("insert into tb_agentes (ca_idagente, ca_nombre, ca_direccion, ca_telefonos, ca_fax, ca_idciudad, ca_zipcode, ca_website, ca_email, ca_tipo, ca_activo, ca_fchcreado, ca_usucreado) values(fn_idagente('tb_agentes_id','$idciudad'), upper('$nombre'), '$direccion', '$telefonos', '$fax', '$idciudad', '$zipcode', lower('$website'), lower('$email'), '$tipo', $act, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
			 $direccion = addslashes($direccion);
			 if($activo){
			 	$act = "true";
			 }else{
			 	$act = "false";
			 }
             if (!$rs->Open("update tb_agentes set ca_nombre = upper('$nombre'), ca_direccion = '$direccion', ca_telefonos = '$telefonos', ca_fax = '$fax', ca_idciudad = '$idciudad', ca_zipcode = '$zipcode', ca_website = lower('$website'), ca_email = lower('$email'), ca_tipo = '$tipo', ca_activo=$act, ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where ca_idagente = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php?buscar=Consultar Agentes\&id=$id';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_agentes where ca_idagente = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php?buscar=Consultar Agentes\&id=$id';</script>";
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