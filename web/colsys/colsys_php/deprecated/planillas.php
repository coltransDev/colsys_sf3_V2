<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       PLANILLAS.PHP                                               \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripción:   Módulo para importación de datos en tablas de gastos.       \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Tabla de Planillas de Gastos';
$formato= 'Pegado Rápido';
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    if (!$rs->Open("select * from vi_planillas where ca_idtblgastos = $id")) { // Selecciona todos lo registros de la tabla Planillas
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id){";
	echo "    document.location.href = 'planillas.php?boton='+opcion+'\&id='+id;";
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='planillas.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=550 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=5>SISTEMA TARIFARIO<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>Fecha de Importación</TH>";
    echo "<TH>Inicio de Vigencia</TH>";
    echo "<TH>Final de Vigencia</TH>";
    echo "<TH>Usuario</TH>";
    echo "<TH WIDTH=22><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", ".$id.");'></TH>";  // Botón para la creación de un Registro Nuevo
    echo "<TR>";
    echo "<TD Class=invertir style='font-size: 11px;' COLSPAN=3><B>Planillas:</B> ".$rs->Value('ca_descripcion')."</TD>";
	echo "<TD Class=invertir style='font-size: 11px;' COLSPAN=2><B>Trafico:</B> ".$rs->Value('ca_nombre')."</TD>";
    echo "</TR>";
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       echo "<TR>";
       echo "<TD Class=mostrar onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href = \"planillas.php?boton=Consultar\&archivo=".$rs->Value('ca_archivo')."\"' style='color=blue;' WIDTH=180>".$rs->Value('ca_fchimportacion')."</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_fchinicio')."</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_fchvencimiento')."</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_usuario')."</TD>";
       echo "  <TD Class=mostrar>";											   // Botones para hacer Mantenimiento a la Tabla
	   echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\",  \"".$rs->Value('ca_archivo')."\");'>";
	   echo "  </TD>";
       echo "</TR>";
       $rs->MoveNext();
       }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar' ONCLICK='javascript:document.location.href = \"gastos.php\"'></TH>";  // Cancela la operación
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
             if (!$rs->Open("select * from tb_tblgastos where ca_idtblgastos = ".$id)) {   // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'planillas.php?id=$id';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (!chkDate(document.cargar.fchinicio))";
             echo "      document.cargar.fchinicio.focus();";
             echo "  else if (!chkDate(document.cargar.fchvencimiento))";
             echo "      document.cargar.fchvencimiento.focus();";
			 echo "  else if (document.cargar.fchinicio.value >= document.cargar.fchvencimiento.value)";
			 echo "      alert('¡El rango de fechas para la vigencia no es válido!');";
			 echo "  else";
			 echo "      return (true);";
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
             echo "<FORM METHOD=post NAME='cargar' ACTION='planillas.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<TABLE WIDTH=460 CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=3>Planillas de Gastos para Tráfico</TH>";
             echo "<TR>";
             echo "  <TD Class=captura style='font-weight: bold;'>Planilla de Gastos<BR>".$rs->Value('ca_descripcion')."</TD>";
             echo "  <TD Class=mostrar>Inicio de vigencia<BR><INPUT TYPE='TEXT' NAME='fchinicio' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "  <TD Class=mostrar>Vencimiento<BR><INPUT TYPE='TEXT' NAME='fchvencimiento' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "</TR>";
             echo"<INPUT TYPE='HIDDEN' NAME='usuario' VALUE=$usuario>";
			 echo"<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";                // Hereda el código del informe
             echo"<TR>";
             echo"  <TD Class=captura COLSPAN=3>Coloque en Cuadro de Texto los datos a importar. Puede utilizar la opción 'Pegar (Ctrl+V)'<BR>o hacer el ingreso de los datos por teclado. Debe utilizar un carácter de separación para<BR>delimitar los datos como el Tabulador (TAB), el punto y coma ( ; ) o la coma ( , ).Tenga en<BR>cuenta que cada registro debe finalizar con un «Enter».<BR><BR>Señale el caractér de delimitación a utilizar:</TD>";
             echo"</TR>";
             echo"<TR>";                                                         // Determina el caracter separador de los datos
             echo"  <TD Class=mostrar><INPUT NAME='delimitador' TYPE='radio' VALUE ='TAB' CHECKED>Tabulador</TD>";
             echo"  <TD Class=mostrar><INPUT NAME='delimitador' TYPE='radio' VALUE =';'>Punto y Coma</TD>";
             echo"  <TD Class=mostrar><INPUT NAME='delimitador' TYPE='radio' VALUE =','>Coma</TD>";
             echo"</TR>";
             echo"<TR>";
             echo"  <TD Class=mostrar COLSPAN=3><TEXTAREA NAME='importacion' WRAP=virtual ROWS=15 COLS=87></TEXTAREA></TD>";
             echo"</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo" <TH><INPUT Class=button TYPE='SUBMIT' NAME='boton' VALUE='Iniciar Importación de Datos'></TH>";  // Ordena que se inicie el proceso de importación
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"planillas.php?id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Iniciar Importación de Datos': {                                       // Segunda Fase de la Importación - Conexión a la fuente de datos y lectura de la información
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='cargar' ACTION='planillas.php'>";        // Llama nuevamente la forma para mostrar los resultados de la importación
             echo "<TABLE WIDTH=460 CELLSPACING=1>";
             switch(trim($formato)) {
             case 'Pegado Rápido': {                                                     // Tercer formato de importación manejado por el sistema graficador
                  if (strlen($importacion) == 0) {                                       // Valida existencia de datos
                      echo "<script>alert('Debe transcribir o pegar el bloque de datos que desea importar')</script>";
                      echo "<script>document.location.href = 'planillas.php?&id=$id';</script>";
                     }
                  else {
                     $rs =& DlRecordset::NewRecordset($conn);                            // A partir de las columnas definidas en la plantilla del informe, construye la estructura de la tabla receptora
                     if (!$rs->Open("select count(ca_idtblgastos) as ca_numero from tb_planillas where ca_idtblgastos = ".$id)){
                         echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                         echo "<script>document.location.href = 'planillas.php?&id=$id';</script>";
                         exit;
                        }
					 $numero  = $rs->Value('ca_numero') + 1;
                     $archivo = "pl".str_pad($id, 8, "0", STR_PAD_LEFT).str_pad($numero, 3, "0", STR_PAD_LEFT);

                     if (!$rs->Open("select * from tb_columnas c where ca_idtblgastos = ".$id)){
                         echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                         echo "<script>document.location.href = 'planillas.php?&id=$id';</script>";
                         exit;
                        }
                     $tipos = array("Numérico"=>"decimal", "Caracter"=>"Varchar", "Fecha"=>"Date", "Hora"=>"Time", "Texto"=>"Text");  // Arreglo de tipos de dato manejados por el sistema
//                   $restricciones = array("Ninguna" => "","Llave Primaria" => "Primary Key","Auto Incremento" => "Auto_increment","No Nulos" => "Not Null","Único" => "Unique");  // Arreglo de restricciones para campos
                     echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";                // Hereda el código del informe
                     echo "<INPUT TYPE='HIDDEN' NAME='archivo' VALUE='$archivo'>";        // Hereda el nombre de la tabla receptora
					 echo "<INPUT TYPE='HIDDEN' NAME='fchinicio' VALUE='$fchinicio'>";
					 echo "<INPUT TYPE='HIDDEN' NAME='fchvencimiento' VALUE='$fchvencimiento'>";
                     echo "<TABLE WIDTH=600 CELLSPACING=1>";
					 echo "<TH>Reg.#</TH>";
                     $longitud = 0;
                     $tamanos = array();                                                 // Arreglo para manejar los tamaños de campo
                     $definir = array();                                                 // Arreglo para manejar los tipos de campo
                     $formato = array();                                                 // Arreglo para manejar las mascaras de edición
                     $comando = "create table $archivo (";                               // Inicia la construcción de la instrucción SQL que crea la tabla receptora
                     while (!$rs->Eof()) {                                               // Lee la totalidad de los campos definidos para la plantilla del informe
					        echo "<TH>".$rs->Value('ca_columna')."</TH>";
                            array_push($tamanos, $rs->Value('ca_longitud'));
                            array_push($definir, $rs->Value('ca_tipo'));
                            array_push($formato, $rs->Value('ca_mascara'));
							$tamano = $rs->Value('ca_longitud');
                            $longitud+= $rs->Value('ca_longitud');
                            $comando = $comando.str_replace (" ","_",$rs->Value('ca_columna'))." ".$tipos[$rs->Value('ca_tipo')];
                            if ($rs->Value('ca_tipo') =='Numérico') {
                                $valor1 = strpos($rs->Value('ca_mascara'),'.');
                                $valor1 = ($valor1 > 0)?($valor1):($tamano);
                                $valor2 = strlen($rs->Value('ca_mascara')) - $valor1 - 1;
                                $valor2 = ($valor2 > 0)?($valor2):(0);
                                $comando= $comando." ($valor1, $valor2)"; }
                            elseif ($rs->Value('ca_tipo') == 'Caracter')
                                $comando= $comando." (".$tamano.")";
//                          if ($rs->Value('ca_restriccion') <> ' ') {
//                              if ($rs->Value('ca_restriccion') == 'Llave Primaria') {
//                                  if (!isset($llave))
//                                      $llave = ", primary key (";
//                                  $llave = $llave . $rs->Value('ca_nombreint').",";
//                                  $comando = $comando." not null"; }
//                              else
//                                  $comando = $comando." ".$restricciones[$rs->Value('ca_restriccion')]." ";
//                             }
                            $comando = $comando.",";
                            $rs->MoveNext();                                             // Va construyendo la instrucción select
                           }
					 echo "<TH>Rta.</TH>";
                     $comando = substr($comando, 0, strlen($comando)-1);
                     if (isset($llave))
                         $comando = $comando.substr($llave, 0, strlen($llave)-1).")";
                     $comando = $comando.")";                                            // Termina la instrucción Select
                     if (!$rs->Open("$comando")) {                                    // Ejecuta la instrucción SQL que acaba de construir
                         echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                         echo "<script>document.location.href = 'planillas.php?&id=$id';</script>";
                        }
                     $segmentos = explode (chr(13), $importacion);                       // Busca los Saltos de Línea para identificar los registros
                     $numero = count($segmentos) - 1;                                    // Cacula los registros a importar
                     $con = 1;
                     $pos = 0;
                     $neg = 0;
                     for ($j=0; $j < $numero; $j++) {                                    // Inicia la lectura del archivo fuente de datos
                          if ($delimitador == "TAB")                                     // Determina el caracter de separación de los datos
                              $data = explode (chr(9), $segmentos[$j]);
                          elseif ($delimitador == ";")
                              $data = explode (";", $segmentos[$j]);
                          elseif ($delimitador == ",")
                              $data = explode (",", $segmentos[$j]);
                          if( count($data) != 0) {
                              echo "<TR>";
                              echo "<TD Class=captura>".$con++."</TD>";
                              $comando = "insert into $archivo values (";  // Inicia la construcción de la instrucción SQL que incorpora los
                              for ($i=0; $i<count($data); $i++) {                                          // registros obtenidos en la fuente de datos y los almacena en tabla receptora
                                   if ($definir[$i] == "Caracter" or $definir[$i] == "Texto") // Valida el tipo de campo que se va a importar
                                       $comando = $comando."'".$data[$i]."',";
                                   elseif ($definir[$i] == "Numérico") {                 // Valida el tipo de campo que se va a importar
                                       if (!empty($data[$i]))
                                           $comando = $comando.$data[$i].",";
                                       else
                                           $comando = $comando.'NULL'.","; }
                                   elseif ($definir[$i] == "Fecha"){                     // Valida el tipo de campo que se va a importar
                                       $fechaiso = strtr($data[$i], '-/.', '   ');
                                       $dia = $mes = $anno = 0;
                                       if (strtr($formato[$i], '-/.', '   ') == "dd mm yy" or strtr($formato[$i], '-/.', '   ') == "dd mm yyyy")
                                           list($dia, $mes, $anno) = sscanf($fechaiso,"%d %d %d");
                                       elseif (strtr($formato[$i], '-/.', '   ') == "yy mm dd" or strtr($formato[$i], '-/.', '   ') == "yyyy mm dd")
                                           list($anno, $mes, $dia) = sscanf($fechaiso,"%d %d %d");
                                       elseif (strtr($formato[$i], '-/.', '   ') == "mm dd yy" or strtr($formato[$i], '-/.', '   ') == "mm dd yyyy")
                                           list($mes, $dia, $anno) = sscanf($fechaiso,"%d %d %d");
                                       $fechaiso = strftime ("%Y-%m-%d",mktime(0,0,0,$mes,$dia,$anno));
                                       $comando = $comando."'".$fechaiso."',";
                                       }
                                   elseif ($definir[$i] == "Hora"){                      // Valida el tipo de campo que se va a importar
                                       $horaiso = $data[$i];
                                       $hor = $min = $seg = 0;
                                       if (strcasecmp($formato[$i], "hh:mm:ss"))
                                           list($hor, $min, $seg) = sscanf($horaiso,"%2d:%2d:%2d");
                                       elseif (strcasecmp($formato[$i], "hh:mm"))
                                           list($hor, $min) = sscanf($horaiso,"%d:%d");
                                       elseif (strcasecmp($formato[$i], "hh"))
                                           list($hor) = sscanf($horaiso,"%d");
                                       $horaiso = $hor.':'.$min.':'.$seg;
                                       $comando = $comando."'".$horaiso."',";
                                       }
                                   echo "<TD Class=mostrar>".$data[$i]."</TD>";
                                  }
                              $comando = substr($comando, 0, strlen($comando)-1).")";    // Termina la construcción de la instrucción SQL
                              if (!$rs->Open("$comando")) {                              // Ejecuta la instrucción que acaba de construir
                                  $neg++;                                                // Reporta las instrucciones que fallaron y el porque
                                  echo "<TD Class=mostrar WIDTH=10><IMG SRC='./graficos/no.gif' alt=\"".$rs->mErrMsg."\" border=0></TD>"; }
                              else {
                                  $pos++;                                                // Reporta las instrucciones que pasaron exitosamente
                                  echo "<TD Class=mostrar WIDTH=10><IMG SRC='./graficos/si.gif' border=0></TD>"; }
                              echo"</TR>";
                            }
                         }
                     $con--;
                     echo "</TABLE><BR>";
                     echo "<TABLE CELLSPACING=1>";                                       // Presenta un informe del resultado de la importación
                     echo "<TR>";
                     echo " <TD Class=captura>Registros Aceptados.........:</TD>";
                     echo " <TD Class=mostrar WIDTH=40>$pos</TD>";
                     echo "</TR>";
                     echo "<TR>";
                     echo " <TD Class=captura>Registros Rechazados........:</TD>";
                     echo " <TD Class=mostrar WIDTH=40>$neg</TD>";
                     echo "</TR>";
                     echo "<TR>";
                     echo " <TD Class=captura>Total Registros Procesados..:</TD>";
                     echo " <TD Class=mostrar WIDTH=40><B>$con</TD>";
                     echo "</TR>";
                     echo "</TABLE><BR>";
                     echo "<TABLE BORDER=0 CELLSPACING=10 CELLPADDING=1>";
                     echo "<TH><INPUT Class=button TYPE='SUBMIT' NAME='accion' VALUE='Guardar Importación'></TH>";  // Controles para hacer mantenimiento a la tabla importada
                     echo "<TH><INPUT Class=button TYPE='SUBMIT' NAME='accion' VALUE='Rechazar la Importación'></TH>";
                     echo "</TABLE>";
                     echo "</FORM>";
                     echo "</CENTER>";
                     require_once("footer.php");
echo "</BODY>";
                     }
                  break;
                  }
               }
             break;
             }
        case 'Consultar': {                                       // Segunda Fase de la Importación - Conexión a la fuente de datos y lectura de la información
             $modulo = "00100200";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select * from vi_planillas where ca_archivo = '$archivo'")) {// Selecciona todos lo registros de la tabla Traficos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'planillas.php?id=$id';</script>";
                 exit; }             
             if (!$rs->Open("select * from $archivo")) {                       // Extrae todos los registro del archivo
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'planillas.php?id=$id';</script>";
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
             echo "<FORM METHOD=post NAME='cargar' ACTION='planillas.php'>";        // Llama nuevamente la forma para mostrar los resultados de la importación
             echo "<TABLE WIDTH=600 CELLSPACING=1>";
             echo "<TR>";
             echo "<TD Class=invertir style='font-size: 11px;' COLSPAN=3><B>Planillas:<BR></B> ".$tm->Value('ca_descripcion')."</TD>";
             echo "<TD Class=invertir style='font-size: 11px;' COLSPAN=2><B>Trafico:<BR></B> ".$tm->Value('ca_nombre')."</TD>";
             echo "<TD Class=invertir style='font-size: 11px;' COLSPAN=2><B>Importado:<BR></B> ".$tm->Value('ca_fchimportacion')."</TD>";
             echo "<TD Class=invertir style='font-size: 11px;' COLSPAN=2><B>Vigencia:<BR></B> ".$tm->Value('ca_fchinicio')." - ".$tm->Value('ca_fchvencimiento')."</TD>";
             echo "</TR>";
             echo "</TABLE>";
             echo "<TABLE WIDTH=600 CELLSPACING=1>";
			 echo "<TH>Reg.#</TH>";
			 $id = substr($archivo,2,8);
             for ($i=0; $i < $rs->mColumnCount; $i++) {
                  echo "<TH>".pg_fieldname($rs->mResultSet, $i)."</TH>";
                  }
             while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
			    $con = $rs->mCurrentRow + 1;
                echo "<TR>";
				echo "<TD Class=captura>".$con."</TD>";
                for ($i=0; $i < $rs->mColumnCount; $i++) {
                     echo "<TD Class=mostrar>".$rs->Value(addcslashes(pg_fieldname($rs->mResultSet, $i),"'"))."</TD>";
                     }
                echo "</TR>";
                $rs->MoveNext();
                }
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar la Consulta' ONCLICK='javascript:document.location.href = \"planillas.php?id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo"<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Eliminar': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_planillas where ca_archivo = '".$id."'")) {// Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'planillas.php?id=$id';</script>";
                 exit;
                }
			 $id = $rs->Value('ca_idtblgastos');
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='eliminar' ACTION='planillas.php'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE WIDTH=350 CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$rs->Value('ca_idtblgastos').">";            // Hereda el Id del registro que se esta eliminando
			 echo "<INPUT TYPE='HIDDEN' NAME='archivo' VALUE=".$rs->Value('ca_archivo').">";
             echo "<TH Class=titulo COLSPAN=2>Datos de la Tabla de Gastos a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>ID Tabla Gastos:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idtblgastos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Descripción:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_descripcion')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tráfico:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_nombre')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fecha Importación:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_fchimportacion')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Inicio Vigencia:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_fchinicio')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fin de Vigencia:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_fchvencimiento')."</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"planillas.php?id=$id\"'></TH>";  // Cancela la operación
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
        case 'Guardar Importación': {                                                      // El Botón Guardar fue pulsado
             if (!$rs->Open("insert into tb_planillas (ca_idtblgastos, ca_fchimportacion, ca_fchinicio, ca_fchvencimiento, ca_archivo, ca_usuario) values($id, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$fchinicio', '$fchvencimiento', '$archivo', '$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = '\"planillas.php?id=$id\"';</script>";
                 exit;
                }
             break;
             }
        case 'Rechazar la Importación': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("drop table $archivo")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = '\"planillas.php?id=$id\"';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_planillas where ca_archivo = '$archivo'")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = '\"planillas.php?id=$id\"';</script>";
                 exit;
                }
             if (!$rs->Open("drop table $archivo")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = '\"planillas.php?id=$id\"';</script>";
                 exit;
                }
             break;
             }
        }
   echo "<script>document.location.href = 'planillas.php?id=$id';</script>";  // Retorna a la pantalla principal de la opción
   }
?>