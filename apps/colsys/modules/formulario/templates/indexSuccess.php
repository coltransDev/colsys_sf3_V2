<?php if ($sf_user->hasFlash('notice')): ?>
    <div class="flash_notice">
        <?php echo $sf_user->getFlash('notice') ?>
    </div>
<?php endif; ?>
<div class="resultado">
    <h1>Listado de Formularios <? //php echo sizeof($pager->getResults())   ?> <? //zphp echo sizeof($pager->getNbResults())   ?> </h1>
    <?php if (sizeof($pager->getResults()) == 0) { ?>
        <p class="resultado_vacio"> 0 campos encontrados</p>
    <?php } else { ?>
        <table border="1" class="listado">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pager->getResults() as $formulario): ?>
                    <tr>
                        <td><?php echo $formulario->getCaId() ?></td>
                        <td><?php echo html_entity_decode($formulario->getCaTitulo()) ?></td>
                        <td>
                            <? if ($nivel<=2){ ?>
                            <a class="" href="<?php echo url_for('formulario/show?ca_id=' . $formulario->getCaId()) ?>"><img title="Ver Detalle" alt="Ver Detalle" src="/images/formularios/detalle.png"></a>
                            <? }?>
                            <? if ($nivel<=1){ ?>
                            <a class="" href="<?php echo url_for('formulario/edit?ca_id=' . $formulario->getCaId()) ?>"><img title="Editar" alt="Editar" src="/images/formularios/edit.gif"></a>
                            <? }?>
                            <? if ($nivel==0){ ?>
                            <a class="" target="" href="<?php echo url_for('formulario/cloneForm?ca_id=' . base64_encode($formulario->getCaId())) ?>"><img title="Duplicar formulario" alt="Duplicar formulario" src="/images/formularios/clone.png"></a>
                            <? }?>
                            <? if ($nivel<=2){ ?>
                            <a class="" target="_blank" href="<?php echo url_for('formulario/vistaPrevia?ca_id=' . base64_encode($formulario->getCaId())) ?>"><img title="Previsualizar" alt="Previsualizar" src="/images/formularios/verx16.png"></a>
                            <a class="" target="_blank" href="<?php echo url_for('formulario/vistaPreviaEmail?ca_id=' . base64_encode($formulario->getCaId())) ?>"><img title="Previsualizar Plantilla Email" alt="Previsualizar Plantilla Email" src="/images/formularios/mail_template.png"></a> 
                            <? }?>
                            <a class="" target="" href="<?php echo url_for('formulario/estadistica?ca_id=' . base64_encode($formulario->getCaId())) ?>"><img title="Ver Estad�sticas" alt="Ver Estad�sticas" src="/images/formularios/stats.png"></a>       
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
        <?php if ($pager->haveToPaginate()): ?>
            <div class="pagination">
                <a href="<? //php echo url_for('home', index)         ?>?pagina=1">
                    <img src="/images/formularios/first.png" alt="Primera P&aacute;gina" title="Primera P&aacute;gina" />
                </a>

                <a href="<? //php echo url_for('pregunta', index)         ?>?pagina=<?php echo $pager->getPreviousPage() ?>">
                    <img src="/images/formularios/before.png" alt="P�gina Anterior" title="P�gina Anterior" />
                </a>
                <?php foreach ($pager->getLinks() as $page) { ?>
                    <?php if ($page == $pager->getPage()): ?>
                        <span class="number-page-active"> <?php echo $page ?></span>
                    <?php else: ?>
                        <a class="number-page" href="?pagina=<?php echo $page ?>"><?php echo $page ?></a>
                    <?php endif; ?>
                <?php } ?>
                <a href="?pagina=<?php echo $pager->getNextPage() ?>">
                    <img src="/images/formularios/next.png" alt="P�gina Siguiente" title="P�gina Siguiente" />
                </a>
                <a href="?pagina=<?php echo $pager->getLastPage() ?>">
                    <img src="/images/formularios/last.png" alt="�ltima P�gina" title="�ltima P�gina" />
                </a>
            </div>
        <?php endif; ?>
    <?php } ?>
    <!--
        <hr>
        <a class="accion" href="<?php // echo url_for('formulario/new')   ?>"><img src="/images/formularios/add.gif"> Nuevo Formulario</a>
    -->
</div>
<div class="filtro">
    <?php include_partial('filter', array('filtroFormulario' => $filtroFormulario)) ?>
    <!--
        <form action="<? //php echo url_for('formulario/filtrar')         ?>" method="POST">
    <? //php echo $filtroFormulario ?>
            <input type="submit"  />
        </form>-->
</div>


