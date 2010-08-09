<?
/*
    //Obtiene una variable sin aplicarle filtrro de seguridad.
    $novedades = $sf_data->getRaw("novedades");
    foreach( $novedades as $novedad ){
?>			
    <li><span>
            <?=image_tag("16x16/post.gif")?><b><?=$novedad->getCaFchpublicacion("Y-m-d")?> <?=$novedad->getCaAsunto()?></b>
            <?=link_to(image_tag("16x16/edit.gif"),"homepage/editarNovedad?idnovedad=".$novedad->getCaIdnovedad())?>
            <br />
            <hr />
            <div class="story">
                <?=nl2br($novedad->getCaDetalle())?>
            </div>
        </span>
    </li>
<?
    }
?>


<div class="commentlist">
<?

$responses = $sf_data->getRaw("novedades");
$i=0;
$novedades = $sf_data->getRaw("novedades");
    foreach( $novedades as $novedad ){
    ?>
        <div class="entry-<?=$i++%2==0?"even":"odd"?>">
        <div class="entry-date"><?=Utils::fechaMes($novedad->getCaFchpublicacion())?></div>
        <b><?=$novedad->getCaAsunto()?> <?=link_to(image_tag("16x16/edit.gif"),"homepage/editarNovedad?idnovedad=".$novedad->getCaIdnovedad())?></b>


        <br /><br />
        <?=nl2br($novedad->getCaDetalle())?>
    </div>
    <?
}*/
?>
<!--</div>-->


<div id="entry-list">
<?
$responses = $sf_data->getRaw("novedades");
$i=0;
$novedades = $sf_data->getRaw("novedades");
    foreach( $novedades as $novedad ){
    ?>
        <div class="entry" id="post-3851">
           <h2><a class="entry-title" ><?=$novedad->getCaAsunto()?>
                    <?=link_to(image_tag("16x16/edit.gif"),"homepage/editarNovedad?idnovedad=".$novedad->getCaIdnovedad())?>
               </a>
           </h2>
           <p class="meta"><?=$novedad->getCaFchpublicacion("Y-m-d")?> <!--<a href="http://www.sencha.com/blog/2010/07/28/announcing-ext-js-3-3-beta-pivotgrids-calendars-and-more/#comments" title="Comment on Announcing Ext JS 3.3 Beta ? PivotGrids, Calendars and More">40 Comments »</a></p>-->
           <div style="overflow: hidden;">
                    <img src=".<?=$novedad->getCaIcon()?>." class="post-icon">
                <div class="excerpt">
                    <?=nl2br($novedad->getCaDetalle())?>
                </div>
                <p class="readmore"><a href="http://www.sencha.com/blog/2010/07/28/announcing-ext-js-3-3-beta-pivotgrids-calendars-and-more/">Ver más »</a></p>
           </div>
       </div>
        
<?
    }
?>
</div>