<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>
	
	<div id="header" align="center">
		<div id="logo_colmas"><?=image_tag("logo_colmas.jpg")?></div>
		<div id="logo_coltrans"><?=image_tag("logo_coltrans.jpg")?></div>
	</div>	
	<?=include_component("menu", "menubar")?>		
	<div id="content" align="center">
		<?php echo $sf_content ?>
	</div>
	
	<div id="footer" >
		Coltrans S.A. - Colmas SIA LTDA. Todos los derechos reservados
	</div>
</body>
</html>
