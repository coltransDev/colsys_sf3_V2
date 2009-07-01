<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       SALIDA.PHP                                                   \\
// Creado:        2004-04-21                                                  \\
// Autor:         Carlos Gilberto L�pez M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-21                                                  \\
//                                                                            \\
// Descripci�n:   Pantalla de Salida normal del Sistema de Informaci�n        \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
require_once("checklogin.php");                                                                 // Captura las variables de la sessi�n abierta
session_destroy();  
setcookie("coltranscookie", "", -1);                                                           // Termina la sessi�n y destruye el entorno de variables
echo"<script>document.location.href = 'entrada.php';</script>";
echo"<script>parent.frames[1].location.href = 'indice.php';</script>";
?>
