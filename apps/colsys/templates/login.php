<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html >
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />


    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
</head>
<body>
	<div class="topLogos">
		<div class="logo1"> 			          					
				<?=image_tag("branding/".sfConfig::get("app_branding_template")."/logo_left.gif")?>
		</div>
		<div class="logo2"> 			          					
				<?=image_tag("branding/".sfConfig::get("app_branding_template")."/logo_right.gif")	?>
		</div>			
			
	</div>
	
	<div class="headerlogin">
		<?
		//include_component("menu", "menubar")
		?>
		&nbsp;
	</div>
	<div class="headerspace">
		&nbsp;
	</div>
	<div align="center">
		<?
		echo $sf_content ?>
	</div>

<div class="footer">	
	<div class="copyright">
		<?=sfConfig::get("app_branding_name")?>. Todos los derechos reservados
	</div>
</div>	
</body>
</html>	