<?php
/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>
<script type="text/javascript">
    var ofertar = function(){
        if( confirm("Esta seguro que desea continuar?") ){
            Ext.Ajax.request(
            {

                url: '<?= url_for("subastas/realizarOferta?idarticulo=" . $articulo->getCaIdarticulo()) ?>',



                callback :function(options, success, response){
                    document.getElementById("resultados").innerHTML = response.responseText;
                }
            });
        }
    
    
    
    }
</script>



<script type="text/javascript">
    //http://sixrevisions.com/tutorials/javascript_tutorial/create-a-slick-and-accessible-slideshow-using-jquery/    
    $(document).ready(function(){
        var currentPosition = 0;
        var slideWidth = 560;
        var slides = $('.slide');
        var numberOfSlides = slides.length;

        // Remove scrollbar in JS
        $('#slidesContainer').css('overflow', 'hidden');

        // Wrap all .slides with #slideInner div
        slides
        .wrapAll('<div id="slideInner"></div>')
        // Float left to display horizontally, readjust .slides width
        .css({
            'float' : 'left',
            'width' : slideWidth
        });

        // Set #slideInner width equal to total width of all slides
        $('#slideInner').css('width', slideWidth * numberOfSlides);

        // Insert controls in the DOM
        $('#slideshow')
        .prepend('<span class="control" id="leftControl">Clicking moves left</span>')
        .append('<span class="control" id="rightControl">Clicking moves right</span>');

        // Hide left arrow control on first load
        manageControls(currentPosition);

        // Create event listeners for .controls clicks
        $('.control')
        .bind('click', function(){
            // Determine new position
            currentPosition = ($(this).attr('id')=='rightControl') ? currentPosition+1 : currentPosition-1;
    
            // Hide / show controls
            manageControls(currentPosition);
            // Move slideInner using margin-left
            $('#slideInner').animate({
                'marginLeft' : slideWidth*(-currentPosition)
            });
        });

        // manageControls: Hides and Shows controls depending on currentPosition
        function manageControls(position){
            // Hide left arrow if position is first slide
            if(position==0){ $('#leftControl').hide() } else{ $('#leftControl').show() }
            // Hide right arrow if position is last slide
            if(position==numberOfSlides-1){ $('#rightControl').hide() } else{ $('#rightControl').show() }
        }	
    });
</script>


<a class="maintitle"><?= $articulo->getCaTitulo() ?></a>
<br />
<?
if( $user->getUserId()==$articulo->getCaUsucreado() ){
    echo link_to(image_tag("16x16/edit.gif")." Editar", "subastas/formArticulo?idarticulo=" . $articulo->getCaIdarticulo());
    echo link_to(image_tag("16x16/camera.png")." Agregar Fotos", "subastas/formImagenes?idarticulo=" . $articulo->getCaIdarticulo());
}
?>





<?
if( count($archivos) ){
?>
<!-- Slideshow HTML -->
<div id="slideshow">
    <div id="slidesContainer">
<?
$i = 0;
foreach ($archivos as $archivo) {
    $ext = strtolower(substr($archivo, -3, 3));
    if ($ext != "jpg" && $ext != "png" && $ext != "gif") {
        continue;
    }
    ?>  
            <div class="slide">
                Foto <?= ++$i ?><br />
                <img src="<?= "/intranet/gestDocumental/verArchivo/folder/" . base64_encode($folder) . "/idarchivo/" . base64_encode(basename($archivo)); ?>" />
            </div>
    <?
}
?>
    </div>
</div>
<?
}else{
    
    ?>
    <br />
    <div class="yellowbox">
    No se han agregado fotos
    <?
    if( $user->getUserId()==$articulo->getCaUsucreado() ){
        echo link_to("haga click aca para agregar", "subastas/formImagenes?idarticulo=" . $articulo->getCaIdarticulo());
    }
    ?>
    </div>
    <?
    
}
?>
<br />
<?
if ($articulo->getCaUsucomprador()) {
    ?>
    <br />
    <div class="yellowbox">
        <b>Lo sentimos este articulo ya fue vendido</b>
    </div>  
    <br />
    <?
}
?>  


<div class="box1">
    <div class="title">Descripción:</div>  
    <div class="body">
<?= $articulo->getCaDescripcion() ?>    
    </div>
</div>
<br />
<div class="box1">    
    <div class="title">Forma de Pago:</div>

    <div class="body">
<?= $articulo->getCaFormapago() ?>    
    </div>
</div>    


<br />

<?
if (!$articulo->getCaUsucomprador()) {
?>
<div class="yellowbox" id="resultados">    
    <?
    if( $articulo->getCaFchinicio()<=date("Y-m-d H:i:s") && $articulo->getCaFchvencimiento()<=date("Y-m-d H:i:s")){    
        echo "Se reciben ofertas hasta <b>".Utils::fechaMes( Utils::parseDate($articulo->getCaFchvencimiento(), "Y-m-d") )." ".Utils::parseDate($articulo->getCaFchvencimiento(), "h:i A")."</b> <br />";
        if ($articulo->getCaDirecta()) {
        ?>
            <input type="button" value="Comprar" onclick="ofertar()" />
            <?
        } else {
            ?>
            <input type="button" value="Realizar una oferta" onclick="ofertar()" /> 

            <?
            include_component("subastas", "listaOfertas", array("articulo" => $articulo));
            ?>
            <?
        }
    }else{
        echo "El articulo no esta disponible para ofertar en este momento. <br />Solo se puede ofertar desde ";        
        echo "<b>".Utils::fechaMes( Utils::parseDate($articulo->getCaFchinicio(), "Y-m-d") )." ".Utils::parseDate($articulo->getCaFchinicio(), "h:i A")."</b>";
        echo " hasta <b>".Utils::fechaMes( Utils::parseDate($articulo->getCaFchvencimiento(), "Y-m-d") )." ".Utils::parseDate($articulo->getCaFchvencimiento(), "h:i A")."</b>";
    }
    ?>
    </div>    
<?
}else{


    if( $user->getUserId()==$articulo->getCaUsucreado() && !$articulo->getCaDirecta() ){
    ?>    
    <div class="yellowbox" >
        <?
        include_component("subastas", "listaOfertas", array("articulo" => $articulo));    
        ?>
    </div> 

    <?
    }
}
?>

<br />



