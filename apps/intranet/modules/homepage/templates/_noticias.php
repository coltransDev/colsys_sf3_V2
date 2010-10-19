
<table>
    <?if($nivel==1){?>
    <th title="Nuevo"><?=link_to(image_tag("new.png"),"homepage/editarNoticia")?></th>
    <?}?>
</table>
<?
$responses = $sf_data->getRaw("noticias");
$i=0;
$noticias = $sf_data->getRaw("noticias");
    foreach( $noticias as $noticia ){
    ?>
<div id="entry-list">
   
        <div class="entry" id="post-3851">
                     <h2><a class="entry-title" ><?=$noticia->getCaAsunto()?>
                   
               </a>
           </h2>
           <p class="meta"><?=$noticia->getCaFchpublicacion("Y-m-d")?> <!--<a href="http://www.sencha.com/blog/2010/07/28/announcing-ext-js-3-3-beta-pivotgrids-calendars-and-more/#comments" title="Comment on Announcing Ext JS 3.3 Beta ? PivotGrids, Calendars and More">40 Comments »</a></p>-->
           <div style="overflow: hidden;">
                <img src="<?=$noticia->getCaIcon()?>" class="post-icon">
                <div class="excerpt">
                    <?=nl2br($noticia->getCaDetalle())?>
                </div>
                <p class="readmore"><a href="<?=url_for('homepage/editarNoticia?idnoticia='.$noticia->getCaIdnoticia())?>">Editar</a></p>
           </div>
       </div>

    <?
    }
    ?>
</div>
