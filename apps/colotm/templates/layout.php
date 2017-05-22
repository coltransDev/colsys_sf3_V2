<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>


<link rel="shortcut icon" href="/favicon.ico" />


<?php include_stylesheets() ?>
<?php include_javascripts() ?>
</head>
<body>
	<div class="top">
		<div class="logo1"> 			 
            <?=image_tag("branding/logo_left.png")?>
        </div><br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
				
			
	</div>
	
	<div class="header">
		<?
		include_component("menu", "menubar")
		?>
	</div>
	<div class="headerspace">
		&nbsp;
	</div>
	
<?
echo $sf_content ?>

<div class="footer">	
	<div class="copyright">
		<?// =sfConfig::get("app_branding_name")?> Todos los derechos reservados
	</div>
</div>	
</body>
</html>	