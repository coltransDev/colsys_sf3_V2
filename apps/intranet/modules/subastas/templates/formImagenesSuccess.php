<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */



include_component("gestDocumental", "panelArchivos", array("readOnly"=>false) );
?>

<h2><?=$articulo->getCaTitulo()?></h2>

<div id="panel-archivos">
    
</div>

 
<?
$url = "subastas/verArticulo?idarticulo=".$articulo->getCaIdarticulo(); 
?>
<br />
<input type="button" class="button" value="Volver" onClick="document.location.href='<?=url_for($url)?>'" />   

<script type="text/javascript">
    var folder = "<?=base64_encode("Subastas/".$articulo->getCaIdarticulo())?>";
    var newComponent = new PanelArchivos({
                                         folder:folder,
                                         title:"Imagenes",
                                         closable: true,
                                         height: 300                                         
                                        });
                                     
    newComponent.render("panel-archivos");                                     
</script>