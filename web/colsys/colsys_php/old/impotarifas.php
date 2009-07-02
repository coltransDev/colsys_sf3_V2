<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       impotarifas.php                                            \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2006-03-01                                                  \\
//                                                                            \\
// Descripción:   Módulo para importación de Tarifas al sistema.              \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Sistema Importador de Tarifas';
$formato= 'Pegado Rápido';
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    $tm =& DlRecordset::NewRecordset($conn);
    if (!$tm->Open("select ca_idagente, ca_nombre, ca_nomtrafico from vi_agentes order by ca_nomtrafico")) {  // Selecciona todos lo registros de la tabla Modelos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'impotarifas.php?id=$id';</script>";
        exit; }
    $id = 9999;
    if (!$rs->Open("select * from tb_tblgastos where ca_idtblgastos = ".$id)) {   // Mueve el apuntador al registro que se desea modificar
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
        echo "<script>document.location.href = 'impotarifas.php?id=$id';</script>";
        exit;
       }
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='cargar' ACTION='impotarifas.php'>";// Crea una forma con datos vacios
    echo "<TABLE WIDTH=460 CELLSPACING=1>";
    echo "<TH Class=titulo COLSPAN=3>$titulo<BR>".$rs->Value('ca_descripcion')."</TH>";
    echo "<TR>";
    echo "  <TD Class=invertir COLSPAN=3>Agente:<BR><CENTER><SELECT NAME='idagente'>";              // Llena el cuadro de lista con los valores de la tabla Agentes
    echo"   <OPTION VALUE=0></OPTION>";
    while ( !$tm->Eof()) {
            echo"<OPTION VALUE=".$tm->Value('ca_idagente').">".$tm->Value('ca_nomtrafico')." » ".$tm->Value('ca_nombre')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </SELECT></CENTER></TD>";
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
    echo"<TR>";
    echo"  <TD Class=mostrar COLSPAN=3><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=15 COLS=87></TEXTAREA></TD>";
    echo"</TR>";
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo" <TH><INPUT Class=button TYPE='SUBMIT' NAME='boton' VALUE='Iniciar Importación de Datos'></TH>";  // Ordena que se inicie el proceso de importación
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"impotarifas.php?id=$id\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    }
elseif (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    switch(trim($boton)) {
        case 'Iniciar Importación de Datos': {                                       // Segunda Fase de la Importación - Conexión a la fuente de datos y lectura de la información
             set_time_limit(180);
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='cargar' ACTION='impotarifas.php'>";        // Llama nuevamente la forma para mostrar los resultados de la importación
             echo "<TABLE WIDTH=460 CELLSPACING=1>";
             switch(trim($formato)) {
             case 'Pegado Rápido': {                                                     // Tercer formato de importación manejado por el sistema graficador
                  if (strlen($importacion) == 0) {                                       // Valida existencia de datos
                      echo "<script>alert('Debe transcribir o pegar el bloque de datos que desea importar')</script>";
                      echo "<script>document.location.href = 'impotarifas.php?&id=$id';</script>";
                     }
                  else {
                     $rs =& DlRecordset::NewRecordset($conn);                            // A partir de las columnas definidas en la plantilla del informe, construye la estructura de la tabla receptora
                     $ty =& DlRecordset::NewRecordset($conn);                            // A partir de las columnas definidas en la plantilla del informe, construye la estructura de la tabla receptora
                     if (!$rs->Open("select ca_ciudad, ca_idciudad from vi_puertos")) {
                         echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                         echo "<script>document.location.href = 'impotarifas.php?&id=$id';</script>";
                     }
                     $ciudades = array();
                     $rs->MoveFirst();
                     while (!$rs->Eof() and !$rs->IsEmpty()) {
                        $ciudades = array_merge($ciudades, array(strtoupper($rs->Value('ca_ciudad')) => $rs->Value('ca_idciudad')));
                        $rs->MoveNext();
                     }
                     if (!$rs->Open("select ca_sigla, ca_idlinea from tb_transporlineas where ca_sigla != ''")) {
                         echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                         echo "<script>document.location.href = 'impotarifas.php?&id=$id';</script>";
                     }
                     $lineas = array();
                     $rs->MoveFirst();
                     while (!$rs->Eof() and !$rs->IsEmpty()) {
                        $lineas = array_merge($lineas, array($rs->Value('ca_sigla') => $rs->Value('ca_idlinea')));
                        $rs->MoveNext();
                     }

                     if (!$rs->Open("select count(ca_idtblgastos) as ca_numero from tb_planillas where ca_idtblgastos = ".$id)){
                         echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                         echo "<script>document.location.href = 'impotarifas.php?&id=$id';</script>";
                         exit;
                        }
                     $numero  = $rs->Value('ca_numero') + 1;
                     $archivo = "pl".str_pad($id, 8, "0", STR_PAD_LEFT).str_pad($numero, 3, "0", STR_PAD_LEFT);

                     if (!$rs->Open("select tablename from pg_tables where tablename like '%$archivo%'")) {
                         echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                         echo "<script>document.location.href = 'impotarifas.php?&id=$id';</script>";
                        }
                     if (!$rs->Eof() and !$rs->IsEmpty()) {
                        if (!$rs->Open("drop table $archivo")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'impotarifas.php';</script>";
                            exit;
                            }
                     }
                     if (!$rs->Open("select * from tb_columnas c where ca_idtblgastos = ".$id)){
                         echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                         echo "<script>document.location.href = 'impotarifas.php?&id=$id';</script>";
                         exit;
                        }
                     $tipos = array("Numérico"=>"decimal", "Caracter"=>"Varchar", "Fecha"=>"Date", "Hora"=>"Time", "Texto"=>"Text");  // Arreglo de tipos de dato manejados por el sistema
//                   $restricciones = array("Ninguna" => "","Llave Primaria" => "Primary Key","Auto Incremento" => "Auto_increment","No Nulos" => "Not Null","Único" => "Unique");  // Arreglo de restricciones para campos
                     echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";                // Hereda el código del informe
                     echo "<INPUT TYPE='HIDDEN' NAME='archivo' VALUE='$archivo'>";        // Hereda el nombre de la tabla receptora
                     echo "<INPUT TYPE='HIDDEN' NAME='idagente' VALUE='$idagente'>";      // Hereda el nombre del agente
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
                            $comando.= str_replace (" ","_",$rs->Value('ca_columna'))." ".$tipos[$rs->Value('ca_tipo')];
                            if ($rs->Value('ca_tipo') == 'Numérico') {
                                $valor1 = strpos($rs->Value('ca_mascara'),'.');
                                $valor1 = ($valor1 > 0)?($valor1):($tamano);
                                $valor2 = strlen($rs->Value('ca_mascara')) - $valor1 - 1;
                                $valor2 = ($valor2 > 0)?($valor2):(0);
                                $comando= $comando." ($valor1, $valor2)"; }
                            elseif ($rs->Value('ca_tipo') == 'Caracter')
                                $comando= $comando." (".$tamano.")";
                            $comando.= ",";
                            $rs->MoveNext();                                             // Va construyendo la instrucción select
                           }
                     $comando.= "ca_origen varchar (8),";
                     $comando.= "ca_destino varchar (8),";
                     $comando.= "ca_idlinea smallint,";
                     $comando.= "ca_idtrayecto smallint,";
                     echo "<TH>Rta.</TH>";
                     echo "<TH>Imp.</TH>";
                     $comando = substr($comando, 0, strlen($comando)-1);
                     if (isset($llave))
                         $comando.= substr($llave, 0, strlen($llave)-1).")";
                     $comando.= ")";                                                     // Termina la instrucción Select
                     if (!$rs->Open("$comando")) {                                       // Ejecuta la instrucción SQL que acaba de construir
                         echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                         echo "<script>document.location.href = 'impotarifas.php?&id=$id';</script>";
                        }
                     $segmentos = explode (chr(13), $importacion);                       // Busca los Saltos de Línea para identificar los registros
                     $numero = count($segmentos) - 1;                                    // Cacula los registros a importar
                     $con = 1;
                     $pos = 0;
                     $neg = 0;
                     if (!$ty->Open("select ca_origen, ca_ciuorigen, ca_destino, ca_ciudestino, ca_idlinea, ca_sigla, ca_idagente, ca_idtrayecto from vi_trayectos where ca_idagente = $idagente and ca_impoexpo = 'Importación' and ca_transporte = 'Marítimo' and ca_sigla != ''")) {                                    // Ejecuta la instrucción SQL que acaba de construir
                         echo "<script>alert(\"".addslashes($ty->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                         echo "<script>document.location.href = 'impotarifas.php?&id=$id';</script>";
                        }
                     for ($j=0; $j < $numero; $j++) {                                    // Inicia la lectura del archivo fuente de datos
                          if ($delimitador == "TAB")                                     // Determina el caracter de separación de los datos
                              $data = explode (chr(9), trim($segmentos[$j]));
                          elseif ($delimitador == ";")
                              $data = explode (";", trim($segmentos[$j]));
                          elseif ($delimitador == ",")
                              $data = explode (",", trim($segmentos[$j]));
                          if( count($data) != 0) {
                              echo "<TR>";
                              echo "<TD Class=captura>".$con++."</TD>";
                              $origen = '';
                              $destino= '';
                              $idlinea= 0;
                              $idtrayecto = 0;
                              $ty->MoveFirst();
                              $data[0] = trim($data[0],chr(32));
                              $data[1] = trim($data[1],chr(32));
                              while (!$ty->Eof() and !$ty->IsEmpty()) {
                                if (strtolower($ty->Value('ca_ciuorigen')) == strtolower($data[0]) and strtolower($ty->Value('ca_ciudestino')) == strtolower($data[1]) and $ty->Value('ca_sigla') == $data[2]) {
                                    $origen = $ty->Value('ca_origen');
                                    $destino= $ty->Value('ca_destino');
                                    $idlinea= $ty->Value('ca_idlinea');
                                    $idtrayecto = $ty->Value('ca_idtrayecto');
                                    break;
                                    }
                                $ty->MoveNext();
                              }
                              if (strlen($origen) == 0) {
                                  $origen = $ciudades[$data[0]];
                                  $destino = $ciudades[$data[1]];
                                  $idlinea = $lineas[$data[2]];
                              }
                              $comando = "insert into $archivo values (";  // Inicia la construcción de la instrucción SQL que incorpora los
                              for ($i=0; $i<count($data); $i++) {                                          // registros obtenidos en la fuente de datos y los almacena en tabla receptora
                                   if ($definir[$i] == "Caracter" or $definir[$i] == "Texto") // Valida el tipo de campo que se va a importar
                                       $comando.= "'".$data[$i]."',";
                                   elseif ($definir[$i] == "Numérico") {                 // Valida el tipo de campo que se va a importar
                                       if (!empty($data[$i]))
                                           $comando.= $data[$i].",";
                                       else
                                           $comando.= 'NULL'.","; }
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
                                       $comando.= "'".$fechaiso."',";
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
                                       $comando.= "'".$horaiso."',";
                                       }
                                   echo "<TD Class=mostrar>".$data[$i]."</TD>";
                                  }
                              $comando.= "'".$origen."', '".$destino."', ".(strlen($idlinea)!=0?$idlinea:0).", ".(strlen($idtrayecto)!=0?$idtrayecto:0).")";
                              if (!$rs->Open("$comando")) {                              // Ejecuta la instrucción que acaba de construir
                                  $sume = false;
                                  $neg++;                                                // Reporta las instrucciones que fallaron y el porque
                                  echo "<TD Class=mostrar WIDTH=10><IMG SRC='./graficos/no.gif' alt=\"".$rs->mErrMsg."\" border=0></TD>"; }
                              else {
                                  $sume = true;
                                  $pos++;                                                // Reporta las instrucciones que pasaron exitosamente
                                  echo "<TD Class=mostrar WIDTH=10><IMG SRC='./graficos/si.gif' border=0></TD>"; }
                              if ($idtrayecto == 0 and (strlen($origen)==0 or strlen($destino)==0 or $idlinea==0)) {                              // Ejecuta la instrucción que acaba de construir
                                  $error = (strlen($origen)==0)?"Origen no Existe":((strlen($destino)==0)?"Destino no Existe":"Naviera no Existe");
                                  if ($sume) {
                                    $pos--;$neg++;                                                // Reporta las instrucciones que fallaron y el porque
                                  }
                                  echo "<TD Class=mostrar WIDTH=10><IMG SRC='./graficos/no.gif' alt=\"$error\" border=0></TD>"; }
                              else {
                                  echo "<TD Class=mostrar WIDTH=10><IMG SRC='./graficos/si.gif' border=0></TD>"; }
                              echo"</TR>";
                            }
                         }
                     $con--;
                     echo "</TABLE><BR>";
                     $segmentos = explode ("\n", $observaciones);
                     $obs_procesadas = array();
                     $obs_restantes  = '';
                     while (list ($clave, $val) = each ($segmentos)) {
                        list($indice, $contenido) = sscanf($val."\n","(%s) %s");
                        $indice = "(".$indice;
                        if (strlen($indice)!= 1) {
                            $contenido = htmlentities(substr($val, strlen($indice)+1));
                            $obs_procesadas = array_merge($obs_procesadas, array($indice => $contenido));
                        }else{
                            $obs_restantes.= (strlen(trim($val))>0?trim($val):"")."\n";
                        }
                     }
                     $obs_restantes = str_replace("SURCHARGE\n","",$obs_restantes);
                     $obs_restantes = str_replace("REMARKS\n","",$obs_restantes);
                     $observaciones = addslashes(htmlentities($obs_restantes));
                     echo "<TABLE CELLSPACING=1>";                                       // Presenta un informe del resultado de la importación
                     while (list ($clave, $val) = each ($obs_procesadas)) {
                        echo "<INPUT TYPE='HIDDEN' NAME='obs_procesadas[$clave]' VALUE=\"$val\">";
                        echo "<TR>";
                        echo " <TD Class=mostrar>$clave</TD>";
                        echo " <TD Class=mostrar>$val</TD>";
                        echo "</TR>";
                     }
                     echo "<TR>";
                     echo " <TD Class=mostrar COLSPAN=2>".nl2br($observaciones)."</TD>";
                     echo "</TR>";
                     echo "<INPUT TYPE='HIDDEN' NAME='observaciones' VALUE=\"$observaciones\">";
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
      }
   }
elseif (isset($accion)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
    switch(trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Guardar Importación': {                                                      // El Botón Guardar fue pulsado
             set_time_limit(360);
             echo "Fase 1<br>";
             if (!$rs->Open("delete from tb_fletes where ca_idtrayecto in (select ca_idtrayecto from $archivo where ca_idtrayecto != 0) and ca_idconcepto in (10, 15, 21, 54)" )) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'impotarifas.php';</script>";
                 exit;
                }
             if (!$rs->Open("select * from $archivo where ca_idtrayecto = 0 and ca_origen <> '' and ca_destino <> '' and ca_idlinea <> 0")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'impotarifas.php';</script>";
                 exit;
                }
             $rs->MoveFirst();
             $tm =& DlRecordset::NewRecordset($conn);

             echo "Fase 2<br>";
             while (!$rs->Eof() and !$rs->IsEmpty()) {
                if (!$tm->Open("insert into tb_trayectos (ca_origen, ca_destino, ca_idlinea, ca_transporte, ca_impoexpo, ca_frecuencia, ca_tiempotransito, ca_modalidad, ca_fchcreado, ca_idtarifas, ca_observaciones, ca_idagente) values('".$rs->Value('ca_origen')."', '".$rs->Value('ca_destino')."', '".$rs->Value('ca_idlinea')."', 'Marítimo', 'Importación', '-', '-', 'FCL', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), currval('tb_trayectos_id'), '', $idagente)")) {
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'impotarifas.php';</script>";
                    exit;
                   }
                $rs->MoveNext();
             }
            if (!$tm->Open("update $archivo set ca_idtrayecto = (select tb_trayectos.ca_idtrayecto from tb_trayectos where $archivo.ca_origen = tb_trayectos.ca_origen and $archivo.ca_destino = tb_trayectos.ca_destino and $archivo.ca_idlinea = tb_trayectos.ca_idlinea and tb_trayectos.ca_idagente = $idagente) where ca_idtrayecto = 0")) {
                echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                echo "<script>document.location.href = 'impotarifas.php';</script>";
                exit;
               }                    

             echo "Fase 3<br>";
             if (!$rs->Open("select oid,* from $archivo where ca_idtrayecto <> 0 and ca_origen <> '' and ca_destino <> '' and ca_idlinea <> 0")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'impotarifas.php';</script>";
                 exit;
                }
             $rs->MoveFirst();
             $array_id = array();
             while (!$rs->Eof() and !$rs->IsEmpty()) {
                echo $rs->Value('oid')."<br>";
                $id = $rs->Value('ca_idtrayecto');
                array_push($array_id, $id);

                $obs_tarifa = '';
                $surcharges = trim($rs->Value('surcharges'));
                $i = 0;
                while ($i < strlen($surcharges)) {
                    $j = strpos($surcharges,")",$i) + 1;
                    $segmento = substr($surcharges,$i,$j-$i);
                    $obs_tarifa.= $obs_procesadas[$segmento]."\n";
                    $i = $j;
                }
                $remarks = trim($rs->Value('remarks'));
                $i = 0;
                while ($i < strlen($remarks)) {
                    $j = strpos($remarks,")",$i) + 1;
                    $segmento = substr($remarks,$i,$j-$i);
                    $obs_tarifa.= $obs_procesadas[$segmento]."\n";
                    $obs_tarifa.= (strlen($rs->Value('csf'))!=0?"CSF\n":"");
                    $i = $j;
                }
                $obs_tarifa = trim(addslashes($obs_tarifa));
                if ($rs->Value('st20') != 0) {
                    if (!$tm->Open("insert into tb_fletes (ca_idtrayecto, ca_idconcepto, ca_vlrneto, ca_vlrminimo, ca_fleteminimo, ca_idmoneda, ca_observaciones, ca_fchcreado, ca_fchinicio, ca_fchvencimiento, ca_usucreado) values($id, 10, ".$rs->Value('st20').", ".($rs->Value('st20') + 200).", ".($rs->Value('st20') + 200).", 'USD', '$obs_tarifa', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '".$rs->Value('effective')."', '".$rs->Value('expiry')."', '$usuario')" )) {
                        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'impotarifas.php';</script>";
                        exit;
                       }
                }               
                if ($rs->Value('st40') != 0) {
                    if (!$tm->Open("insert into tb_fletes (ca_idtrayecto, ca_idconcepto, ca_vlrneto, ca_vlrminimo, ca_fleteminimo, ca_idmoneda, ca_observaciones, ca_fchcreado, ca_fchinicio, ca_fchvencimiento, ca_usucreado) values($id, 15, ".$rs->Value('st40').", ".($rs->Value('st40') + 300).", ".($rs->Value('st40') + 300).", 'USD', '$obs_tarifa', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '".$rs->Value('effective')."', '".$rs->Value('expiry')."', '$usuario')" )) {
                        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'impotarifas.php';</script>";
                        exit;
                       }
                }               
                if ($rs->Value('hq') != 0) {
                    if (!$tm->Open("insert into tb_fletes (ca_idtrayecto, ca_idconcepto, ca_vlrneto, ca_vlrminimo, ca_fleteminimo, ca_idmoneda, ca_observaciones, ca_fchcreado, ca_fchinicio, ca_fchvencimiento, ca_usucreado) values($id, 21, ".$rs->Value('hq').", ".($rs->Value('hq') + 300).", ".($rs->Value('hq') + 300).", 'USD', '$obs_tarifa', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '".$rs->Value('effective')."', '".$rs->Value('expiry')."', '$usuario')" )) {
                        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'impotarifas.php';</script>";
                        exit;
                       }
                }               
                if ($rs->Value('nor') != 0) {
                    if (!$tm->Open("insert into tb_fletes (ca_idtrayecto, ca_idconcepto, ca_vlrneto, ca_vlrminimo, ca_fleteminimo, ca_idmoneda, ca_observaciones, ca_fchcreado, ca_fchinicio, ca_fchvencimiento, ca_usucreado) values($id, 54, ".$rs->Value('nor').", ".($rs->Value('nor') + 300).", ".($rs->Value('nor') + 300).", 'USD', '$obs_tarifa', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '".$rs->Value('effective')."', '".$rs->Value('expiry')."', '$usuario')" )) {
                        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'impotarifas.php';</script>";
                        exit;
                       }
                }               
                $rs->MoveNext();
             }

             echo "Fase 4<br>";
             if (!$rs->Open("update tb_trayectos set ca_observaciones = '$observaciones' where ca_idtrayecto in (".implode(",",$array_id).")")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'impotarifas.php';</script>";
                 exit;
                }
             if (!$rs->Open("update tb_trayectos set ca_observaciones = '' where ca_idtrayecto not in (".implode(",",$array_id).") and ca_idagente = $idagente")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'impotarifas.php';</script>";
                 exit;
                }

             echo "Fase 5<br>";
             if (!$rs->Open("drop table $archivo")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'impotarifas.php';</script>";
                 exit;
                }
             echo "<script>alert(\"Finalizó el proceso de Importación de tarifas.\");</script>";  // Muestra el mensaje de error        
             break;
             }
        case 'Rechazar la Importación': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("drop table $archivo")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'impotarifas.php';</script>";
                 exit;
                }
             break;
             }
        }
   echo "<script>document.location.href = 'impotarifas.php';</script>";  // Retorna a la pantalla principal de la opción
   }
?>