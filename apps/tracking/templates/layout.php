<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?
$sfModule = sfContext::getInstance()->getModuleName();
        $sfAction = sfContext::getInstance()->getActionName();
        $user = sfContext::getInstance()->getUser();
?>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>


<link rel="shortcut icon" href="/favicon.ico" />

<?
if (strpos("$sfAction", "Ext5") !== false ||  strpos("$sfAction", "Ext6") !== false) 
{
    $stylejs="/js/ext6/build/classic/theme-crisp/resources/theme-crisp-all-debug.css";    
?>

 <link type="text/css" rel="stylesheet" href="/tracking/css/tracking.css">
 <link type="text/css" rel="stylesheet" href="<?=$stylejs?>">
     
                <!--<script type="text/javascript" src="/js/ext5/ext-all.js"></script>-->
                <!--<script type="text/javascript" src="/js/ext6/build/ext-all-debug.js"></script>-->
                <script type="text/javascript" src="/js/ext6/ext-all.js"></script>
                <script type="text/javascript" src="/js/jquery/jquery-1.9.1.min.js"></script>
<?
}
    else
    {
?>

<?php include_stylesheets() ?>
<?php include_javascripts() ?>
<?
}
?>
</head>
<body>
	<div class="top">
		<div class="logo1"> 			 
            <?=image_tag("branding/".sfConfig::get("app_branding_template")."/logo_left.gif")?>
		</div>
		<div class="logo2">
            <?=image_tag("branding/".sfConfig::get("app_branding_template")."/logo_right.gif")?>
		</div>			
			
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
		<?=sfConfig::get("app_branding_name")?>. Todos los derechos reservados
        
	</div>
</div>	
</body>
</html>	