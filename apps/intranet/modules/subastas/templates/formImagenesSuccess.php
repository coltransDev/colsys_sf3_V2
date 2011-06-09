<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */



include_component("gestDocumental", "widgetUploadImages" );

?>

<h2><?=$articulo->getCaTitulo()?></h2>

<div id="panel-archivos">
    
</div>

 
<?
$url = "subastas/verArticulo?idarticulo=".$articulo->getCaIdarticulo();


?>
<br />


<form>
		<div style="width: 180px; height: 18px; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;">
			<span id="but"></span>
		</div>
	</form>
<div id="div"></div>
<input type="button" class="button" value="Volver" onClick="document.location.href='<?=url_for($url)?>'" />   

<div id="thumbnails"></div>


<script type="text/javascript">
    
      
    
    var newComponent = new WidgetUploadImages({                            
                            post_params: {
                              "folder": "<?=base64_encode("Subastas/".$articulo->getCaIdarticulo())?>",
                              "tam_max": "400",
                              "thumbnails":"thumbnails"
                            },                            
                            button_placeholder_id : "but",
                            upload_target : 'div'                            
                        });          
    //newComponent.render("panel-archivos");  
    
    
    
</script>