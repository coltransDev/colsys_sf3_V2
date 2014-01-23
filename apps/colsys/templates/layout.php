<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
 <?
    
    $sfModule=sfContext::getInstance()->getModuleName ();
    $sfAction=sfContext::getInstance()->getActionName ();
    ?>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

    
    <?php 
    if(strpos("$sfAction", "Ext4")===false && $sfModule."/".$sfAction!="gestDocumental/index")
    {   
        include_stylesheets();
        include_javascripts();
    }else{
        
?>


<link rel="stylesheet" type="text/css" media="screen" href="/css/coltrans.css" />
<link rel="stylesheet" type="text/css" media="print" href="/css/print.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/jquery/jquery.tooltip.css" />

<link rel="stylesheet" type="text/css" media="screen" href="/css/menu/menu.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/blog.css" />

<!--<link type="text/css" rel="stylesheet" href="/js/ext4/resources/css/ext-all-gray.css">-->
<link type="text/css" rel="stylesheet" href="/js/ext4/resources/css/ext-all-neptune.css">


<!--<link rel="stylesheet" type="text/css" media="screen" href="/css/coltrans.css" />
<link rel="stylesheet" type="text/css" media="print" href="/css/print.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/jquery/jquery.tooltip.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/ext/css/ext-all.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/ext/css/xtheme-gray.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/menu/menu.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/blog.css" />
-->

<script type="text/javascript" src="/js/ext4/ext-all.js"></script>
<script type="text/javascript" src="/js/ext4/ux/multiupload/swfobject.js"></script>

<script type="text/javascript" src="/js/comunes.js"></script>
<script type="text/javascript" src="/js/jquery/jquery.js"></script>
<script type="text/javascript" src="/js/jquery/jquery.tooltip.js"></script>
<script type="text/javascript" src="/js/jquery/jquery.dimensions.js"></script>
<script type="text/javascript" src="/js/menu/menu.js"></script>
<?
    }
?>


    <script type="text/javascript" src="/js/loginWindow.js"></script>
</head>
<body >

	<div align="center">
		<div class="header" align="center" >
			<div class="headerleft" ><?=image_tag("branding/".sfConfig::get("app_branding_template")."/header/head_left.gif")?></div>
			<div class="headerright" ><?=image_tag("branding/".sfConfig::get("app_branding_template")."/header/head_right.gif")?></div>
			<div class="topmenuwraper"  >
                <?
                include_component("menu", "menubar");
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
