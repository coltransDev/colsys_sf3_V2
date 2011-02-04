<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       GASTOS.PHP                                                  \\
// Creado:        2004-07-14                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-07-14                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la maestra de tablas de gastos    \\
//                para tráfico.                                               \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
$programa = 37;

$titulo = 'Maestra de Tablas de Gastos para Tráfico';
$tipostarifas = array("Valor Fijo","Porcentaje","Valor Unitario");             // Arreglo con los tipos de Tarifa en Tablas de Gastos
$basestarifas = array("Sobre Flete","Sobre Vlr Factura","Cantidad unidades Peso/Volumen", "Número de Piezas","Cantidad de BLs/AWBs");  // Arreglo con las bases de Tarifa en Tablas de Gastos

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 
$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!$rs->Open("select ca_valor from tb_parametros where ca_casouso = 'CU062'")) { // Selecciona los términos de la tabla Parametros
    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
    echo "<script>document.location.href = 'reportenegocio.php';</script>";
    exit;
}
$tincoterms = array(); // Arreglo con los términos Iconterms
while (!$rs->Eof()) {
    $tincoterms[] = $rs->Value('ca_valor');
    $rs->MoveNext();
}

if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    if (!$rs->Open("select * from vi_tblgastos")) {                            // Selecciona todos lo registros de la tabla Grupos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id){";
    echo "    document.location.href = 'gastos.php?boton='+opcion+'\&id='+id;";
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='gastos.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=550 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=8>SISTEMA TARIFARIO<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>ID</TH>";
    echo "<TH>Tráfico</TH>";
    echo "<TH>Tipo de Tarifa</TH>";
    echo "<TH>Base de Tarifa</TH>";
    echo "<TH>Incoterms</TH>";
    echo "<TH>Diseño</TH>";
    echo "<TH>Archivo</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       echo "<TR>";
       echo "  <TD Class=listar ROWSPAN=2>".$rs->Value('ca_idtblgastos')."</TD>";
       echo "  <TD Class=listar COLSPAN=6>".$rs->Value('ca_descripcion')."</TD>";
       echo "  <TD Class=listar ROWSPAN=3 WIDTH=44>";                                              // Botones para hacer Mantenimiento a la Tabla
       echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\",  ".$rs->Value('ca_idtblgastos').");'>";
       echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\",  ".$rs->Value('ca_idtblgastos').");'>";
       echo "  </TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=mostrar>".$rs->Value('ca_nombre')."</TD>";
       echo "  <TD Class=mostrar>".$rs->Value('ca_tipotarifa')."</TD>";
       echo "  <TD Class=mostrar>".$rs->Value('ca_basetarifa')."</TD>";
       echo "  <TD Class=listar>".str_replace ("|","<BR>",$rs->Value('ca_incoterms'))."</TD>";
       echo "  <TD Class=mostrar onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href = \"columnas.php?id=".$rs->Value('ca_idtblgastos')."\"' style='color=blue; text-align: center;'>Columnas</TD>";
       echo "  <TD Class=mostrar onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href = \"planillas.php?id=".$rs->Value('ca_idtblgastos')."\"' style='color=blue; text-align: center;'>Planillas</TD>";
       echo "</TR>";
       if ($rs->Value('ca_condicion')!='') {
           echo "<TR>";
           echo "<TD Class=mostrar></TD>";
           echo "<TD Class=mostrar COLSPAN=6><B>Condición: </B>".$rs->Value('ca_condicion')."</TD>";
           echo "</TR>";
       }
       $rs->MoveNext();
       }
    echo "</TABLE><BR>";
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
             if (!$tm->Open("select ca_idtrafico, ca_nombre from tb_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'ciudades.php';</script>";
                 exit; }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (document.adicionar.descripcion.value == '')";
             echo "      alert('El campo Descripción no es válido');";
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
             echo "<FORM METHOD=post NAME='adicionar' ACTION='gastos.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<TABLE CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=2>Datos sobre la nueva Tabla de Gastos</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Descripción:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='descripcion' SIZE=30 MAXLENGTH=40></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tráfico:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='idtrafico'>";             // Llena el cuadro de lista con los valores de la tabla Traficos
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE=".$tm->Value('ca_idtrafico').">".$tm->Value('ca_nombre')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tipo de Tarifa:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='tipotarifa'>";
             for ($i=0; $i < count($tipostarifas); $i++) {
                  echo " <OPTION VALUE='".$tipostarifas[$i]."'>".$tipostarifas[$i];
                  }
             echo "</SELECT>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Base de Tarifa:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='basetarifa'>";
             for ($i=0; $i < count($basestarifas); $i++) {
                  echo " <OPTION VALUE='".$basestarifas[$i]."'>".$basestarifas[$i];
                  }
             echo "</SELECT>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Incoterms:</TD>";
             echo "  <TD Class=mostrar>";
             for ($i=0; $i < count($tincoterms); $i++) {
                  echo " <INPUT TYPE=CHECKBOX NAME='incoterms[]' VALUE='".$tincoterms[$i]."'>".$tincoterms[$i]."<BR>";
                  }
             echo "  </TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Condición:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='condicion' SIZE=40 MAXLENGTH=250></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"gastos.php\"'></TH>";  // Cancela la operación
             echo "<script>adicionar.descripcion.focus()</script>";
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
             if (!$tm->Open("select ca_idtrafico, ca_nombre from tb_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'ciudades.php';</script>";
                 exit; }
             if (!$rs->Open("select * from vi_tblgastos where ca_idtblgastos = ".$id)) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'gastos.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (document.modificar.descripcion.value == '')";
             echo "      alert('El campo Descripción no es válido');";
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
             echo "<FORM METHOD=post NAME='modificar' ACTION='gastos.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos sobre la Tabla de Gastos</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Descripción:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='descripcion' VALUE='".$rs->Value('ca_descripcion')."' SIZE=30 MAXLENGTH=40></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tráfico:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='idtrafico'>";             // Llena el cuadro de lista con los valores de la tabla Traficos
             while ( !$tm->Eof()) {
                     echo "<OPTION VALUE=".$tm->Value('ca_idtrafico');
                     if ($tm->Value('ca_idtrafico')==$rs->Value('ca_idtrafico')) {
                         echo " SELECTED"; }
                     echo ">".$tm->Value('ca_nombre')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tipo de Tarifa:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='tipotarifa'>";
             for ($i=0; $i < count($tipostarifas); $i++) {
                  echo " <OPTION VALUE='".$tipostarifas[$i]."'";
                  if ($rs->Value('ca_tipotarifa')==$tipostarifas[$i]) {
                      echo " SELECTED"; }
                  echo ">".$tipostarifas[$i];
                  }
             echo "</SELECT>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Base de Tarifa:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='basetarifa'>";
             for ($i=0; $i < count($basestarifas); $i++) {
                  echo " <OPTION VALUE='".$basestarifas[$i]."'";
                  if ($rs->Value('ca_basetarifa')==$basestarifas[$i]) {
                      echo " SELECTED"; }
                  echo ">".$basestarifas[$i];
                  }
             echo "</SELECT>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Incoterms:</TD>";
             echo "  <TD Class=mostrar>";
             for ($i=0; $i < count($tincoterms); $i++) {
                  $chequear = (in_array($tincoterms[$i],explode("|",$rs->Value('ca_incoterms'))))?"CHECKED":" ";
                  echo " <INPUT TYPE=CHECKBOX NAME='incoterms[]' VALUE='".$tincoterms[$i]."' ".$chequear.">".$tincoterms[$i]."<BR>";
                  }
             echo "  </TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Condición:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='condicion' VALUE='".$rs->Value('ca_condicion')."' SIZE=40 MAXLENGTH=250></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo"<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
             echo"<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"gastos.php\"'></TH>";  // Cancela la operación
             echo"<script>modificar.descripcion.focus()</script>";
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
             if (!$rs->Open("select * from vi_tblgastos where ca_idtblgastos = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'gastos.php';</script>";
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
             echo "<FORM METHOD=post NAME='eliminar' ACTION='gastos.php'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE WIDTH=250 CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=2>Datos de la Tabla de Gastos a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Descripción:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_descripcion')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tráfico:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idtrafico')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tipo de Tarifa:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_tipotarifa')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Base de Tarifa:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_basetarifa')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Incoterms:</TD>";
             echo "  <TD Class=mostrar>".str_replace ("|","<BR>",$rs->Value('ca_incoterms'))."</TD>";
             echo "</SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Condición:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_condicion')."</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"gastos.php\"'></TH>";  // Cancela la operación
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
             $incoterms = implode("|",$incoterms);
             if (!$rs->Open("insert into tb_tblgastos (ca_descripcion, ca_idtrafico, ca_tipotarifa, ca_basetarifa, ca_incoterms, ca_condicion) values('$descripcion', '$idtrafico', '$tipotarifa', '$basetarifa', '$incoterms', '$condicion')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'gastos.php';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             $incoterms = implode("|",$incoterms);
             if (!$rs->Open("update tb_tblgastos set ca_descripcion = '$descripcion', ca_idtrafico = '$idtrafico', ca_tipotarifa = '$tipotarifa', ca_basetarifa = '$basetarifa', ca_incoterms = '$incoterms', ca_condicion = '$condicion' where ca_idtblgastos = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'gastos.php';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_tblgastos where ca_idtblgastos = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'gastos.php';</script>";
                 exit;
                }
             break;
             }
        }
   echo "<script>document.location.href = 'gastos.php';</script>";  // Retorna a la pantalla principal de la opción
   }
?>