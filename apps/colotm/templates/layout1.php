<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>




<link rel="shortcut icon" href="/favicon.ico" />




    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>

    <script type="text/javascript" src="/js/loginWindow.js"></script>
</head>
<body >

	<div align="center">
		<div class="header" align="center" >
			<div class="headerleft" ><?=image_tag("branding/".sfConfig::get("app_branding_template")."/header/head_left.gif")?></div>
			<div class="headerright" ><?=image_tag("branding/".sfConfig::get("app_branding_template")."/header/head_right.gif")?></div>
			<div class="topmenuwraper"  >
                <?
                //include_component("menu", "menubar");
                ?>
			</div>
		</div>
		
		<?
        //include_component("menu", "menubar");
        ?>
		
	</div>
    <?
    //include_component("menu", "menubar");
    ?>
    <div id="mask"></div>


<? 
include_component("menu", "submenubar");
?>
<br />

<?php echo $sf_content ?>

<div class="footer">	
	<div class="copyright">
		<?=sfConfig::get("app_branding_name")?>. Todos los derechos reservados
        <br />        
        colsys@<?=$_SERVER["SERVER_ADDR"]?>
	</div>
</div>	




<script type="text/javascript">

    $('.qtip').tooltip({track: true});
    $('.help').tooltip({track: true, fade: 250, opacity: 1, top: -15, extraClass: "pretty fancy" });
</script>


</body>
</html>
