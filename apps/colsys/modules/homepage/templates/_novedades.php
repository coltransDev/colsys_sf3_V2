<?
$novedades = $sf_data->getRaw("novedades");

if( count($novedades)>0 || $nivelNoticias>0){
    ?>
    <h5>Noticias</h5>
    <?
    if( $nivelNoticias>0 ){
        echo link_to(image_tag("16x16/edit_add.gif")." Nuevo" , "homepage/editarNovedad", array("nivelNoticias"=>$nivelNoticias))."<br />";
    }
    ?>
    <div class="box">
        <div id="entry-list">
        <?
        $i=0;
        foreach( $novedades as $novedad ){
            ?>
            <div class="entry" id="post-3851">
               <h2><a class="entry-title" ><?=$novedad->getCaAsunto()?>
                    <?
                    if( $nivelNoticias>0 ){
                        echo link_to(image_tag("16x16/edit.gif"),"homepage/editarNovedad?idnovedad=".$novedad->getCaIdnovedad());
                    }
                    ?>
                    </a>
               </h2>
               <p class="meta"><?=$novedad->getUsuCreado()->getCaNombre()." ".Utils::fechaMes($novedad->getCaFchpublicacion("Y-m-d"))?> <!--<a href="" title="">40 Comments »</a></p>-->
               <div style="overflow: hidden;">
                    <img src="<?=$novedad->getCaIcon()?>" class="post-icon">
                    <div class="excerpt"><?=nl2br($novedad->getCaDetalle())?></div>                
               </div>
           </div>
            <?
        }
        ?>
        </div>
    </div>
    <?
}
?>