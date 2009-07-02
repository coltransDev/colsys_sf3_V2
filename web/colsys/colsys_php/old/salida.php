<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       SALIDA.PHP                                                   \\
// Creado:        2004-04-21                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-21                                                  \\
//                                                                            \\
// Descripción:   Pantalla de Salida normal del Sistema de Información        \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
session_destroy();  
setcookie("coltranscookie", "", -1);                                                           // Termina la sessiòn y destruye el entorno de variables
echo"<script>document.location.href = 'entrada.php';</script>";
echo"<script>parent.frames[1].location.href = 'indice.php';</script>";
?>
