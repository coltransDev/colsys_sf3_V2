<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       ENTRADA.PHP                                                 \\
// Creado:        2004-04-20                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-20                                                  \\
//                                                                            \\
// Descripción:   Pantalla de Entrada al Sistema de Información, módulos de   \\
//                acceso de los usuarios al sistema.                          \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

header("Location: /");
exit;
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
include_once 'include/functions.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos



$user_agent = $_SERVER['HTTP_USER_AGENT'];
$ie6 = false;
if( strpos($user_agent , "MSIE 6")!==false ){
	$ie6 = true;
}

require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
if(!isset($usuario)) {                                                         // Valida si el usuario ya ha iniciado una sessión.
   session_destroy();                                                          // Presenta la Pantalla de Login para iniciar Sessión
   
   echo "<script>parent.frames[1].location.href = 'indice.php';</script>";
   echo "<HTML>";
   echo "<HEAD>";
   echo "<TITLE>Sistema de Información - Coltrans S.A.</TITLE>";
   echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
   echo "function validar(){";
   echo "  if (document.Entrada.password.value == '')";
   echo "      alert('La contraseña ingresada no es válida');";
   echo "  else";
   echo "      return (true);";
   echo "  return (false);";
   echo "}";
   echo "</script>";
   echo "</HEAD>";
   echo "<BODY BGCOLOR=WHITE>";
   
     if( $ie6 ){
	 
	   ?>
	   <br />
	   <center> <div style="background:#FFFFF4; font-size:14px; color:#000000; border: solid 1px #000000; width:500px;" align="center">
			<br />
			<img src="graficos/important.gif" /> Es altamente recomendable actualizar su versión de Internet Explorer
			<br />
			<a href="#" onclick='window.open("https://www.coltrans.com.co/download/IE7-WindowsXP-x86-esn.exe")'> Por favor haga click aca para descargarlo </a>
			<br />
	   </div>
	   </center>
	   <?	
	   }
   
   echo "<BR>";
   echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                       // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
   echo "<CENTER>";
   echo "<FORM METHOD=post NAME='Entrada' ACTION='entrada.php' ONSUBMIT='return validar();'>";  // Con el submit llama nuevamente este script pero con la variable nombre ya inicializada
   echo "<TABLE WIDTH=300 CELLSPACING=1>";
   echo "<TH COLSPAN=2>CONTROL DE ENTRADA</TH>";
   echo "<TR>";
   echo "  <TD Class=titulo COLSPAN=2>Introduzca su Nombre de usuario y contraseña...</TH>";
   echo "</TR>";
   echo "<TR>";
   echo "  <TD Class=captura>Nombre de Usuario:</TH>";
   echo "  <TD Class=mostrar><INPUT TYPE=TEXT NAME='usuario' SIZE=15 AUTOCOMPLETE=OFF></TD>";
   echo " </TR>";
   echo "<TR>";
   echo "  <TD Class=captura>Contraseña:</TH>";
   echo "  <TD Class=mostrar><INPUT TYPE=PASSWORD NAME='password' SIZE=15 AUTOCOMPLETE=OFF></TD></TR>";
   echo "</TR>";
   echo "</TABLE><BR>";
   echo "<TABLE BORDER=0 CELLSPACING=10 CELLPADDING=1>";
   echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='boton' VALUE='Conectar'></TH>";
   echo "<TH><INPUT Class=reset  TYPE='RESET'  NAME='boton' VALUE='Limpiar '></TH>";
   echo "<script>Entrada.usuario.focus()</script>";                             // Ubica el cursor en cuadro de texto para el nombre de usuario
   echo "</TABLE>";
   echo "</FORM>";
   
  
   
   echo "</CENTER>";
   require_once("footer.php");
echo "</BODY>";
  }
else {
   session_register("usuario", "password", "nivel", "database", "principal", "servidor", "hora");    // Crea el entoro de variables para la sessión que se esta abriendo
   $modulo = "00000000";                                                       // Identificación del módulo para la ayuda en línea
   if ($hora == NULL) {                                                         // Controla la hora de ingreso del usuario
       $hora      = strftime("%I:%M:%S%p",time());
       $principal = "Coltrans";
       $servidor  = "10.192.1.127";
       $password  = ($password== NULL) ? "\"\"" : $password;
       
      }

  

   if ($usuario == $password) {
       echo "<script>alert('El Periodo de gracia para el cambio de sus contraseña, Ya Expiró!!!\\nPor favor cámbiela en este momento, Gracias!')</script>";
       echo "<script>document.location.href = 'contrasena.php';</script>";
      }

   $rs =& DlRecordset::NewRecordset($conn);                                    // Selecciona las bases de datos a las que usuario identificado tiene acceso
// $au =& DlRecordset::NewRecordset($conn);                                    // Prepara el registro de Auditoria
   if (!$rs->Open("select b.ca_basededatos, b.ca_servidor, n.ca_nivel from control.tb_basededatos b, control.tb_niveles n where b.ca_basededatos = n.ca_basededatos and n.ca_login = '$usuario' order by b.oid")) {
//     $au->execute("insert into $principal.tb_auditoria (ca_rutina, ca_login, ca_respuesta, ca_maquina, ca_fecha, ca_hora) values('$modulo','$usuario','Denegado','".$REMOTE_ADDR."','".date('Y-m-d')."','".date('H:i:s')."')");
       session_destroy();
       echo "<script>alert('Error en la entrada. Nombre de usuario o contraseña incorrectos')</script>";
       echo "<script>document.location.href = 'entrada.php';</script>";
      }
   if ($rs->mRowCount == 0) {
//     $au->execute("insert into $principal.tb_auditoria (ca_rutina, ca_login, ca_respuesta, ca_maquina, ca_fecha, ca_hora) values('$modulo','$usuario','Denegado','".$REMOTE_ADDR."','".date('Y-m-d')."','".date('H:i:s')."')");
       session_destroy();
       echo "<script>alert('El usuario no tiene Acceso a ninguna de las\\nBases de Datos del Sistema Coltrans S.A.')</script>";
       echo "<script>document.location.href = 'entrada.php';</script>";
      }
   else {
       $niveles= array( "0" => "Usuario", "1" => "Operador", "2" => "Coordinador", "3" => "Administrador", "4" => "Supervisor", "5" => "Superusuario" );
       while (!$rs->Eof()) {
          if(isset($connspace)) {                                              // Permite que el usuario cambie su conexión a otras bases de datos
             if($connspace==$rs->Value('ca_basededatos')) {                    // que se encuentran dentro de su menú personal
                $database = $rs->Value('ca_basededatos');
                $servidor = $rs->Value('ca_servidor');
                $nivel    = $rs->Value('ca_nivel');
               }
             }
          elseif(isset($database)) {
             if($database== $rs->Value('ca_basededatos')) {
                $database = $rs->Value('ca_basededatos');
                $servidor = $rs->Value('ca_servidor');
                $nivel    = $rs->Value('ca_nivel');
               }
             }
          else {
//              $au->execute("insert into $principal.tb_auditoria (ca_rutina, ca_login, ca_respuesta, ca_maquina, ca_fecha, ca_hora) values('$modulo','$usuario','Entrada','".$REMOTE_ADDR."','".date('Y-m-d')."','".date('H:i:s')."')");
                $database = $rs->Value('ca_basededatos');
                $servidor = $rs->Value('ca_servidor');
                $nivel    = $rs->Value('ca_nivel');
             }
          $rs->MoveNext();
          }
       echo "<HTML>";                                                           // Pantalla de Bienvenida
       echo "<HEAD>";
       echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";
       echo "<script language='JavaScript' type='text/JavaScript'>";
       echo "function cambia(){";                                               // Script de java que refresca la pantalla de bienvenida
       echo "   document.creacion.submit();";                                   // cuando el usuario cambia la conexión a otra base de datos
       echo "}";
       echo "function capturas(objeto, id, accion){";
       echo "  ventana = document.getElementById('captura');";
       echo "  ventana.style.visibility = \"visible\";";
       echo "  ventana.style.left = eval((document.body.clientWidth/2)-(600/2));";
       echo "  ventana = document.getElementById('frame_captura');";
       echo "  ventana.src='ventanas.php?opcion='+objeto+'\&id='+id+'\&accion='+accion;";
       echo "}";
       echo "</script>";
       echo "<script>parent.document.getElementById('workframe').cols = '140,*';</script>";
       echo "<script>parent.document.getElementById('menu').src = 'indice.php';</script>";
       echo "</HEAD>";
       echo "<BR>";
       echo "<BODY onscroll='dalt=document.body.scrollTop+3; captura.style.top=dalt;'>";
       echo "<DIV ID='captura' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";  // left:150; top:25; width:600; height:200
       echo "<IFRAME ID=frame_captura SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:315'>";
       echo "</IFRAME>";
       echo "</DIV>";
       echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
       echo "<CENTER>";
       echo "<FORM METHOD=post NAME='creacion' ACTION='entrada.php'>";
       echo "<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=2>";
       echo "<TR>";
       echo "  <TH COLSPAN=8 HEIGHT=10></TH>";
       echo "</TR>";                                                            // Renglon en blanco
       echo "<TR>";
       echo "<TD Height=150 Class=mostrar COLSPAN=8><CENTER><IMG SRC='./graficos/logo_colsys.gif' border=0></CENTER></TD>";
       echo "</TR>";
       echo "<TH COLSPAN=8>Datos de la Conexión</TH>";
       echo "<TR>";
       echo "  <TH>Usuario :</TH>";
       echo "  <TD Class=mostrar><INPUT TYPE=TEXT READONLY NAME='usuario' SIZE=".strlen($usuario)*1.15." VALUE=$usuario></TD>";
       echo "  <TH>Base de Datos :</TH>";
       echo "  <TD Class=mostrar><SELECT NAME='connspace' ONCHANGE='cambia()' >";
       $rs->MoveFirst();
       while (!$rs->Eof()) {                                                   // Lee la totalidad de los registros obtenidos en la instrucción Select
              echo "<OPTION VALUE='".$rs->Value('ca_basededatos')."'";
              if ( $rs->Value('ca_basededatos') == $database)
                   echo " SELECTED";
              echo ">".$rs->Value('ca_basededatos')."</OPTION>";
              $rs->MoveNext();
            }
       echo "  </SELECT>";
       echo "  <TH>Nivel :</TH>";
       echo "  <TD Class=mostrar><INPUT TYPE=TEXT READONLY NAME='nivel' VALUE=".$niveles[$nivel]."></TD>";
       echo "  <TH>Servidor :</TH>";
       echo "  <TD Class=mostrar><INPUT TYPE=TEXT READONLY NAME='servidor' VALUE=$servidor></TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TH COLSPAN=8 HEIGHT=10></TH>";
       echo "</TR>";                                                            // Renglon en blanco
       echo "</TABLE>";
	   echo "<BR />";
	   
	  
	   
       $rs =& DlRecordset::NewRecordset($conn);
       if (!$rs->Open("select * from tb_colnovedades where ca_fcharchivar >= now() order by ca_fchpublicacion DESC, ca_fcharchivar DESC")) {          // Selecciona todos lo registros de la tabla Eventos de Clientes
           echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
           exit; }

       $visible = ($nivel >= 5)?'visible':'hidden';
	   echo "<TABLE WIDTH=625 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
       echo "<TR>";
       echo "  <TH Class=titulo COLSPAN=4>Novedades del Sistema COLSYS</TH>";
       echo "</TR>";
       echo "<TH WIDTH=70>Publicado</TH>";
       echo "<TH WIDTH=440>Detalle</TH>";
       echo "<TH WIDTH=70> Adjunto</TH>";	   
       echo "<TH WIDTH=45><IMG style='visibility: $visible;' src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='javascript:capturas(\"Novedad\",null,\"Nuevo\");'></TH>";  // Botón para la creación de un Registro Nuevo
       while (!$rs->IsEmpty() and !$rs->Eof()) {
	   		list($year, $month, $day) = sscanf($rs->Value('ca_fchpublicacion'), "%d-%d-%d");
			$fch_pub = mktime(0,0,0,$month,$day,$year);
	   		list($year, $month, $day) = sscanf($rs->Value('ca_fcharchivar'), "%d-%d-%d");
			$fch_arc = mktime(0,0,0,$month,$day,$year);
	   		$edad = dateDiff(date("Y-M-d",$fch_pub),date("Y-M-d"))/dateDiff(date("Y-M-d",$fch_pub),date("Y-M-d",$fch_arc));
			$icono = ($edad <= 0.3)?'nuevo.gif':(($edad <= 0.6)?'reciente.gif':'admira.gif');
	   		echo "<TR>";
	   		echo "  <TD Class=invertir COLSPAN=2><B>".$rs->Value('ca_asunto')."</B>&nbsp<IMG SRC='./graficos/$icono' border=0 ALT='Edad de la Novedad'></TD>";
	   		echo "  <TD Class=invertir COLSPAN=2><a href='ventanas.php?opcion=see_attachment&id=".$rs->Value('ca_idnovedad')."&novedad=true'>".$rs->Value('ca_header_file')."</a></TD>";
	   		echo "</TR>";
	   		echo "<TR>";
	   		echo "  <TD Class=listar style='letter-spacing:-1px;'>".$rs->Value('ca_fchpublicacion')."</TD>";
	   		echo "  <TD Class=listar style='letter-spacing:-1px;' COLSPAN=2>".$rs->Value('ca_detalle')."</TD>";
			echo "  <TD Class=listar>";											   // Botones para hacer Mantenimiento a la Tabla
			echo "    <IMG style='visibility: $visible;' src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='javascript:capturas(\"Novedad\",".$rs->Value('ca_idnovedad').", \"Modifica\");'>";
			echo "    <IMG style='visibility: $visible;' src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='javascript:(confirm(\"¿Desea Eliminar el registro?\")?capturas(\"Novedad\",".$rs->Value('ca_idnovedad').", \"Elimina\"):null)'>";
			echo "  </TD>";
	   		echo "</TR>";
	   		$rs->MoveNext();
	   }
       echo "<TR HEIGHT=5>";
       echo "  <TD Class=titulo COLSPAN=4></TD>";
       echo "</TR>";
       echo "</TABLE><BR>";
       echo "</FORM>";

       echo "</CENTER>";
       require_once("footer.php");
echo "</BODY>";
       echo "</HTML>";
      }
  }
?>