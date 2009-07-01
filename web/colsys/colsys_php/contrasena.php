<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       CONTRASE�A.PHP                                              \\
// Creado:        2004-04-20                                                  \\
// Autor:         Carlos Gilberto L�pez M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-20                                                  \\
//                                                                            \\
// Descripci�n:   Pantalla pare el manejod e Contrase�as de Usuario           \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$programa = 47;

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessi�n abierta
if (!isset($usuario)) {                                                        // Verifica si el usuario ya inicio su sessi�n
    echo "<script>document.location.href = 'entrada.php';</script>";
   }
else if(!isset($accion)) {                                                         // Valida si el usuario ya ha iniciado una sessi�n.
   echo "<HTML>";
   echo "<HEAD>";
   echo "<TITLE>Sistema de Informaci�n - Coltrans S.A.</TITLE>";
   echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
   echo "function validar(){";
   echo "  if (document.Contrasena.password_old.value != document.Contrasena.password.value)";
   echo "      alert('La antigua contrase�a no es v�lida');";
   echo "  else if (document.Contrasena.password_new.value == '')";
   echo "      alert('La contrase�a nueva no es v�lida');";
   echo "  else if (document.Contrasena.password_con.value != document.Contrasena.password_new.value)";
   echo "      alert('Error en la confirmaci�n de la Contrase�a');";
   echo "  else";
   echo "      return (true);";
   echo "  return (false);";
   echo "}";
   echo "</script>";
   echo "</HEAD>";
   echo "<BODY BGCOLOR=WHITE>";
   echo "<BR>";
   echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                       // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
   echo "<CENTER>";
   echo "<FORM METHOD=post NAME='Contrasena' ACTION='contrasena.php' ONSUBMIT='return validar();'>";  // Con el submit llama nuevamente este script pero con la variable nombre ya inicializada
   echo "<TABLE WIDTH=300 CELLSPACING=1>";
   echo "<INPUT TYPE='HIDDEN' NAME='password' VALUE=".$password.">";
   echo "<TH COLSPAN=2>CONTROL DE ENTRADA</TH>";
   echo "<TR>";
   echo "  <TD Class=titulo COLSPAN=2>Cambio de Contrase�a</TH>";
   echo "</TR>";
   echo "<TR>";
   echo "  <TD Class=captura>Introduzca Contrase�a Anterior:</TH>";
   echo "  <TD Class=mostrar><INPUT TYPE=PASSWORD NAME='password_old' SIZE=15></TD>";
   echo " </TR>";
   echo "<TR>";
   echo "  <TD Class=captura>Introduzca Contrase�a Nueva:</TH>";
   echo "  <TD Class=mostrar><INPUT TYPE=PASSWORD NAME='password_new' SIZE=15></TD></TR>";
   echo "</TR>";
   echo "<TR>";
   echo "  <TD Class=captura>Confirme Contrase�a Nueva:</TH>";
   echo "  <TD Class=mostrar><INPUT TYPE=PASSWORD NAME='password_con' SIZE=15></TD></TR>";
   echo "</TR>";
   echo "</TABLE><BR>";
   echo "<TABLE BORDER=0 CELLSPACING=10 CELLPADDING=1>";
   echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Cambiar'></TH>";
   echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operaci�n
   echo "<script>Contrasena.password_old.focus()</script>";                             // Ubica el cursor en cuadro de texto para el nombre de usuario
   echo "</TABLE>";
   echo "</FORM>";
   echo "</CENTER>";
   require_once("footer.php");
echo "</BODY>";
  }
elseif (isset($accion)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
    
    $rs =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexi�n a la base de datos
    switch(trim($accion)) {                                                    // Switch que evalua cual bot�n de comando fue pulsado por el usuario
        case 'Cambiar': {                                                      // El Bot�n Guardar fue pulsado
             if (!$rs->Open("ALTER USER $usuario WITH PASSWORD '$password_new'")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit;
                }
			 if (@pg_ErrorMessage($rs->mDbCon) == "") {
			     echo "<script>alert(\"Su contrase�a ha sido cambiada\");</script>";  // Muestra el mensaje de confirmaci�n
				 $password = $password_new;
			    }
			 else {
			     echo "<script>alert(\"Error al intentar cambiar su contrase�a\");</script>";  // Muestra el mensaje de error
			    }
             break;
             }
        }
   echo "<script>document.location.href = 'entrada.php';</script>";  // Retorna a la pantalla principal de la opci�n
   }
?>