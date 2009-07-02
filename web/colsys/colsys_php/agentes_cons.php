<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       AGENTES_CONS.PHP                                                 \\
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
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 //


if( $nivel>0 ){
	header("Location: agentes.php");
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='agentes_cons.php'>";            // Hace una llamado nuevamente a este script pero con
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

	if (!$rs->Open("select * from vi_agentesxcont where ca_idtrafico_ag like '$idtrafico' and ca_idciudad_ag like '$idciudad' and ca_nombre_ag like upper('%$agente%')")) {                              // Selecciona todos lo registros de la tabla Agentes
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>Tabla de Agentes Coltrans S.A.</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, ci){";
	echo "    document.location.href = 'agentes_cons.php?boton='+opcion+'\&id='+id+'\&ci='+ci;";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='cabecera' ACTION='agentes_cons.php'>";            // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=530 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=6>SISTEMA TARIFARIO<BR>Maestra de Agentes Coltrans S.A. en el mundo</TH>";
    echo "</TR>";
    echo "<TH>ID</TH>";
    echo "<TH COLSPAN=4>Agente</TH>";
    echo "<TH></TH>";  // Botón para la creación de un Registro Nuevo
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
	       echo "  <TD WIDTH=44 Class=mostrar></TD>";											   // Botones para hacer Mantenimiento a la Tabla
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
           echo "  <TD Class=captura style='text-align:center;'></TD>";  // Botón para la creación de un Registro Nuevo
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
		   echo "  style='font-weight:bold; vertical-align:top; font-size: 11px;' COLSPAN=4>".$rs->Value('ca_nombre_co')." ".($rs->Value('ca_activo_con')!="t"?"(INACTIVO)":"")."</TD>";
	       echo "<TD ";
		   if( $rs->Value('ca_sugerido')=="t" ){
		   	  echo "bgcolor='#FFFFCC'";
		   }else{
		   	  echo "Class=invertir";
		   }
		   echo ">".$rs->Value('ca_idcontacto')."</TD>";
	       echo "<TD WIDTH=44 ";
		   if( $rs->Value('ca_sugerido')=="t" ){
		   	  echo "bgcolor='#FFFFCC'";
		   }else{
		   	  echo "Class=invertir";
		   }
		   echo " style='text-align:center;'></TD>";											   // Botones para hacer Mantenimiento a la Tabla
		   echo "</TD>";
	       echo "</TR>";
	       echo "<TR>";
	       echo "<TD Class=mostrar ROWSPAN=6></TD>";
	       echo "<TD Class=mostrar>Dirección :</TD>";
	       echo "<TD Class=mostrar COLSPAN=3>".$rs->Value('ca_direccion_co')."</TD>";
	       echo "<TD Class=mostrar ROWSPAN=6></TD>";
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
	       echo "<TD Class=mostrar colspan='3'>".($rs->Value('ca_sugerido')=="t"?"S&iacute;":"No")."</TD>";
	     
	       echo "</TR>";
		   
       }
       $rs->MoveNext();
      }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Imprimir Consulta' ONCLICK='elegir(\"Imprimir\", \"$idtrafico\", \"$idciudad\");'></TH>";  // Cancela la operación
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar Consulta' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operación
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Nueva Consulta' ONCLICK='javascript:document.location.href = \"agentes_cons.php\"'></TH>";  // Cancela la operación
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
             echo "  <TD Class=invertir><iframe ID=consulta_tar src ='ventanas.php?opcion=Imprimir&id=$id&ci=$ci' width='100%' height='100%'></iframe></TD>";
             echo "</TR>";
             echo "</TABLE>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"agentes_cons.php?buscar=Consultar Agentes&idtrafico=$id&idciudad=$ci\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</CENTER>";
             break;
             }
      }
   }
?>