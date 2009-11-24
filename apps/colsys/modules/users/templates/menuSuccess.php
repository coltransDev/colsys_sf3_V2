<link rel="stylesheet" type="text/css" media="screen" href="/include/css/menu.css" />
<script type="text/javascript" src="/javascripts/menu/mootools.js"></script>
<script type="text/javascript" src="/javascripts/menu/docs.js"></script>
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
		<?=image_tag("menu/button_unhide.jpg")?>
	</div>
</div>

<div id="contentMenu" >

<div id="menuHideBtn" onclick="ocultar()">
	<?=image_tag("menu/button_hide.jpg")?>
</div>

<div id="userInfo">
	<?=image_tag("menu/user_male_r1_c1.gif")?><?=$user->getUserId()?>
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
	$top_tit = '';	
    foreach( $rutinas as $rutina ){    
		if ($top_tit != $rutina->getCaGrupo() ) {
             	
				if($top_tit!=''){			
				 ?>
					</div>
				</div>
				<?
				 }
				 ?>
				<div class="MGroup MEntry">
				<a>
					<?=Utils::replace( $rutina->getCaGrupo() );?>
				</a>
				<div class="MGroupContent" id="MGroupContent2">
				<?
				$top_tit = $rutina->getCaGrupo();
		}
		?>
			<div class="MFile MEntry"><a href="#" onclick="javascript:parent.frames[2].location.href = '<?=$rutina->getCaPrograma()?>';">
						<?=Utils::replace($rutina->getCaOpcion())?>
						</a></div>
					<?
	}
	

?>
	</div>
</div>

	<div class="MGroup MEntry"><a href="#" onclick="javascript:parent.frames[2].location.href = 'salida.php';">Salida</a>
		<div class="MGroupContent" id="MGroupContent2"></div>
	</div>
	
</div>
