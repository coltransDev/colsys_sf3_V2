<div id="entry-list">
    <?     
    if ($nivel == 1) {
        echo link_to(image_tag("new.png"), "noticias/formNoticia")."<br />";
    }     
    $noticias = $sf_data->getRaw("noticias");
    foreach ($noticias as $noticia) {
        if($idsucursal == $noticia->getCaIdsucursal() || $noticia->getCaIdsucursal()==null){
        ?>
            <div class="entry" >
                <h2>
                    <a class="entry-title" ><?= $noticia->getCaAsunto() ?></a>
                </h2>
                <p class="meta"><?= $noticia->getCaFchpublicacion("Y-m-d") ?></p>
                <div style="overflow: hidden;">
                    <img src="<?= $noticia->getCaIcon() ?>" class="post-icon">
                    <div class="excerpt">
                        <?= nl2br($noticia->getCaDetalle()) ?>
                    </div>
                    <p class="readmore">
                        <? if ($nivel == 1) { ?>
                            <a href="<?= url_for('noticias/formNoticia?idnoticia=' . $noticia->getCaIdnoticia()) ?>">Editar</a>
                        <? } ?>
                    </p>
                </div>
            </div>
            <?
        }
    }
    ?>
</div>
