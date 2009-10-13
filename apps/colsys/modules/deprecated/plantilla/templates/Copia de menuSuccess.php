<?

?>

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
/*  echo "<DIV ID='validcliente' STYLE='display:none; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";  // left:150; top:25; width:600; height:200
   echo "  <IFRAME ID='send_cookie' SRC='/Coltrans/Menu.jsp' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:150'>";
   echo "  </IFRAME>";
   echo "</DIV>";
   */
   ?>
<div id="Menu">
	<div class="MGroup MEntry"><a href="#" onclick="javascript:parent.frames[2].location.href = 'entrada.php';">Entrada</a>
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
	          echo "<script>parent.frames[2].location.href = 'entrada.php';</script>";
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
		<div class="MFile MEntry"><a href="#" onclick="javascript:parent.frames[2].location.href = '<?=$tm->Value('ca_programa')?>';">
			<?=strtr( $tm->Value('ca_opcion'), $trans)?>
			</a></div>
		<?
           /*  echo "\n['|".$tm->Value('ca_opcion')."','/".$tm->Value('ca_programa').",".$tm->Value('ca_descripcion')."'],";*/
             $tm->MoveNext();
            }
		  $rs->MoveNext();
         }
      ?>
	</div>
</div>
<div class="MGroup MEntry"><a href="#" onclick="javascript:parent.frames[2].location.href = '/colsys_sf/general/eguide';">Directorio</a>
	<div class="MGroupContent" id="MGroupContent2"></div>
</div>
<div class="MGroup MEntry"><a href="#" onclick="javascript:parent.frames[2].location.href = 'salida.php';">Salida</a>
	<div class="MGroupContent" id="MGroupContent2"></div>
</div>
</div>

</div>
</body>
</html>
<?    
}
?>