<h1>Listado de Bloques de Preguntas</h1>
<?php if ($sf_user->hasFlash('notice')): ?>
    <div class="flash_notice">
        <?php echo $sf_user->getFlash('notice') ?>
    </div>
<?php endif; ?>
<div class="resultado">
    <?php if (sizeof($pager->getResults()) == 0) { ?>
        <p class="resultado_vacio"> 0 campos encontrados</p>
    <?php } else { ?>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Formulario</th>
                    <th>Titulo</th>
                    <th>Tipo</th>
                    <th>Introducci&oacute;n</th>
                    <th>No de preguntas</th>
                    <th>Orden</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pager->getResults() as $bloque): ?>
                    <tr>
                        <td><?php echo $bloque->getCaId() ?></td>
                        <td><?php echo $bloque->getFormulario()->getCaTitulo() ?></td>
                        <td><?php echo $bloque->getCaTitulo() ?></td>
                        <td><?php echo $bloque->getTipoBloque($bloque->getCaTipo()) ?></td>
                        <td><?php echo html_entity_decode($bloque->getCaIntroduccion()) ?></td>
                        <td><?php echo sizeof($bloque->getTbPreguntas()) ?></td>
                        <td><?php echo$bloque->getCaOrden() ?></td>
                        <td><?php echo$bloque->getTextoBooleano($bloque->getCaActivo()) ?></td>
                        <td>
                            <a class="" href="<?php echo url_for('bloque/show?ca_id=' . $bloque->getCaId()) ?>"><img title="Ver Detalle" alt="Ver Detalle" src="/images/formularios/detalle.png"></a>
                            <? if($nivel<=1){?>
                            <a class="" href="<?php echo url_for('bloque/edit?ca_id=' . $bloque->getCaId()) ?>"><img title="Editar" alt="Editar" src="/images/formularios/edit.gif"></a>
                            <?}?>
                            <a class="" target="_blank" href="<?php echo url_for('bloque/vistaPrevia?ca_id=' . $bloque->getCaId()) ?>"><img title="Previsualizar" title="Previsualizar" src="/images/formularios/verx16.png"></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if ($pager->haveToPaginate()): ?>
            <div class="pagination">
                <a href="<? //php echo url_for('home', index)     ?>?pagina=1">
                    <img src="/images/formularios/first.png" alt="Primera P&aacute;gina" title="Primera P&aacute;gina" />
                </a>

                <a href="<? //php echo url_for('pregunta', index)     ?>?pagina=<?php echo $pager->getPreviousPage() ?>">
                    <img src="/images/formularios/before.png" alt="P&aacute;gina Anterior" title="P&aacute;gina Anterior" />
                </a>

                <?php foreach ($pager->getLinks() as $page): ?>
                    <?php if ($page == $pager->getPage()): ?>
                        <span class="number-page-active"> <?php echo $page ?></span>
                    <?php else: ?>
                        <a class="number-page" href="?pagina=<?php echo $page ?>"><?php echo $page ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>

                <a href="?pagina=<?php echo $pager->getNextPage() ?>">
                    <img src="/images/formularios/next.png" alt="P&aacute;gina Siguiente" title="P&aacute;gina Siguiente" />
                </a>

                <a href="?pagina=<?php echo $pager->getLastPage() ?>">
                    <img src="/images/formularios/last.png" alt="Última P&aacute;gina" title="Última P&aacute;gina" />
                </a>
            </div>
        <?php endif; ?>
    <?php } ?>
    <!--
        <hr>
        <a class="accion" href="<? //php echo url_for('bloque/new') ?>"><img src="/images/formularios/add.gif"> Nuevo Bloque</a>
    -->
</div>
<div class="filtro">
    <?php include_partial('filter', array('filtroBloque' => $filtroBloque)) ?>
</div>