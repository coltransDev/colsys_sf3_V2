<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>




<link rel="shortcut icon" href="/favicon.ico" />



</head>
<body>
	<div align="center">
		<div class="header" align="center" >	
			
			
			<div class="headerleft" ><?=image_tag("layout/header/head_left.gif")?></div>
			<div class="headerright" ><?=image_tag("layout/header/head_right.gif")?></div>
			<div class="topmenuwraper"  >
					<? 
					include_component("menu", "menubar");
					?>
			</div>
		</div>
		
		
		
	</div>
	
<br />




<br />
<br />

<? 
include_component("menu", "submenubar");
?>
<br />
<br />	
 <?php echo $sf_content ?>



<div class="footer">	
	<div class="copyright">
		Coltrans S.A. - Colmas LTDA. Todos los derechos reservados
	</div>
</div>	




<script type="text/javascript" charset="utf-8">	
	/*$$("a").each( function(input) {
		if(input.title){
			new Tooltip(input, {backgroundColor: "#FC9", borderColor: "#C96", textColor: "#000", textShadowColor: "#FFF"});
		}	
	});
	$$("form input").each( function(input) {
		if(input.title){
			new Tooltip(input, {backgroundColor: "#FC9", borderColor: "#C96", textColor: "#000", textShadowColor: "#FFF"});
		}
	});
	
	$$("form select").each( function(input) {
		if(input.title){
			new Tooltip(input, {backgroundColor: "#FC9", borderColor: "#C96", textColor: "#000", textShadowColor: "#FFF"});
		}
	});
	
	$$("img").each( function(input) {
		if(input.title){
			new Tooltip(input, {backgroundColor: "#FC9", borderColor: "#C96", textColor: "#000", textShadowColor: "#FFF"});
		}
	});*/
</script>





</body>
</html>
