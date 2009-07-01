<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       INDICE.PHP                                                  \\
// Creado:        2004-04-20                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-20                                                  \\
//                                                                            \\
// Descripción:   Menú de opciones por usuario                                \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
if(!isset($usuario) or ($usuario == $password)) {                                                         // Valida si el usuario ya ha iniciado una sessión.
   session_destroy();                                                          // Presenta la Pantalla de Login para iniciar Sessión
   echo "<HTML>";
   echo "<HEAD>";
   echo "<TITLE>Menú</TITLE>";
   echo "</HEAD>";
   echo "<BODY>";
require_once("menu.php");
   require_once("footer.php");
echo "</BODY>";
   echo "</HTML>";
  }
else {
  
   $rs =& DlRecordset::NewRecordset($conn);                                    // Selecciona las bases de datos a las que usuario identificado tiene acceso

   if (!$rs->Open("select u.ca_rutinas, u.ca_sucursal, n.ca_nivel from vi_usuarios u, control.tb_niveles n where u.ca_login = '$usuario' and u.ca_login = n.ca_login and n.ca_basededatos = '$database'")) {                   // Selecciona todos lo registros de la tabla Modelos
	   // Muestra el mensaje de error
	   echo addslashes($rs->mErrMsg);
       echo "<script>document.location.href = 'entrada.php';</script>";
       exit;
	   }
       setcookie("coltranscookie", $usuario, time()+60*60*24);
	   ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Coltrans Menu</title>
<link rel="stylesheet" type="text/css" media="screen" href="include/css/menu.css" />
<script type="text/javascript" src="javascripts/menu/mootools.js"></script>
<script type="text/javascript" src="javascripts/menu/docs.js"></script>
</head>
<body>


<script language="javascript">
	function ocultar(){
		
		document.getElementById("contentMenu").style.display="none";
		document.getElementById("contentMenuHide").style.display="block";		
		var fs = top.document.getElementById("workframe");		
        fs.cols = "12,*"
		
	}
	
	function mostrar(){
		
		document.getElementById("contentMenu").style.display="block";
		document.getElementById("contentMenuHide").style.display="none";		
		var fs = top.document.getElementById("workframe");		
        fs.cols = "140,*"
		
	}
</script>
<div id="contentMenuHide" >
	<div id="menuUnhideBtn" onclick="mostrar()">
		<img src="graficos/menu/button_unhide.jpg" alt="" />
	</div>
</div>

<div id="contentMenu" >

<div id="menuHideBtn" onclick="ocultar()">
	<img src="graficos/menu/button_hide.jpg" alt="" />
</div>

<div id="userInfo">
	<img src="graficos/menu/user_male_r1_c1.gif" alt="" /><?=$usuario?>
</div>

<?	
       echo "<DIV ID='validcliente' STYLE='display:none; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";  // left:150; top:25; width:600; height:200
       echo "  <IFRAME ID='send_cookie' SRC='/Coltrans/Menu.jsp' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:150'>";
       echo "  </IFRAME>";
       echo "</DIV>";
	   
	   ?>
<div id="Menu">
	<div class="MGroup MEntry"><a href="#" onclick="javascript:document.location.href = 'entrada.php';">Entrada</a>
		<div class="MGroupContent" id="MGroupContent2"></div>
	</div>
	<?
   
      
      /* echo 'Entrada';*/

       while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
          $opciones = "('".str_replace ("|","','",$rs->Value('ca_rutinas'))."')";
          $tm =& DlRecordset::NewRecordset($conn);                                    // Selecciona las bases de datos a las que usuario identificado tiene acceso
          if (!$tm->Open("select * from control.tb_rutinas where ca_rutina in ".$opciones." order by ca_grupo, ca_opcion")) { // Selecciona todos lo registros de la tabla Modelos
		      echo addslashes($tm->mErrMsg);
	         
			  // Muestra el mensaje de error
	          echo "<script>document.location.href = 'entrada.php';</script>";
	          exit; 
		}
			
	      $top_tit = '';
		  $trans = get_html_translation_table(HTML_ENTITIES);
          while (!$tm->Eof() and !$tm->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
             if ($top_tit != $tm->Value('ca_grupo')) {
             	
				if($top_tit!=''){			
				 ?>
</div>
</div>
<?
				 }
				 
				 ?>
<div class="MGroup MEntry"><a>
	<?=strtr( $tm->Value('ca_grupo'), $trans) ;?>
	</a>
	<div class="MGroupContent" id="MGroupContent2">
		<?
				
             	 $top_tit = $tm->Value('ca_grupo');
             }			
			 ?>
		<div class="MFile MEntry">
		<?
		if( $tm->Value('ca_rutina')=="0500200000" ||  $tm->Value('ca_rutina')=="0500300000" || $tm->Value('ca_rutina')=="0200220000"){			
		?>
		<a href="#" onclick="javascript:parent.location.href = '<?=$tm->Value('ca_programa')?>';">
			<?=strtr( $tm->Value('ca_opcion'), $trans)?>
		</a>	
		<?
		}else{	 
		?>
		<a href="#" onclick="javascript:document.location.href = '<?=$tm->Value('ca_programa')?>';">			
			<?=strtr( $tm->Value('ca_opcion'), $trans)?>
		</a>
		<?
		}
		?>	
		</div>
		<?
           /*  echo "\n['|".$tm->Value('ca_opcion')."','/".$tm->Value('ca_programa').",".$tm->Value('ca_descripcion')."'],";*/
             $tm->MoveNext();
            }
		  $rs->MoveNext();
         }
      ?>
	</div>
</div>
<div class="MGroup MEntry"><a href="#" onclick="javascript:document.location.href = '/colsys_sf/general/eguide';">Directorio</a>
	<div class="MGroupContent" id="MGroupContent2"></div>
</div>
<div class="MGroup MEntry"><a href="#" onclick="javascript:document.location.href = 'salida.php';">Salida</a>
	<div class="MGroupContent" id="MGroupContent2"></div>
</div>
</div>

</div>
</body>
</html>
<?    
}
?>
