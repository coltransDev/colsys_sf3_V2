<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>
	<div class="top">
		<div class="logo1"> 			          					
				<?=image_tag("coltrans_logo.jpg")?>
		</div>
		<div class="logo2"> 			          					
				<?=image_tag("colmas_logo.jpg")?>
		</div>
			
		
		
	
		<!--	<div class="search">
			<div class="searchint">
				<div class="moduletable">
				<jdoc:include type="modules" name="user4" />
			</div>
		  </div>
		</div>-->

	
		
		
		<?
		include_component("menu", "menubar")
		?>
			
		
	</div>
<!--Top Area End-->


	<!--Header Start-->			
	<div class="header">
	<!--<jdoc:include type="modules" name="user5"  />	-->					
	</div>	
	
		
	<div id="content" align="center">
		<?php echo $sf_content ?>
	</div>
	
	
	<div class="footer">	
		<div class="copyright">
			Coltrans S.A. - Colmas LTDA. Todos los derechos reservados
		</div>
	</div>		
</body>
</html>
