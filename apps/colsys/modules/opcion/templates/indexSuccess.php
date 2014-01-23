<h1>Listado de Opciones</h1>
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
                    <th>Texto</th>
                    <th>Id Pregunta</th>
                    <th>Tipo Pregunta</th>
                    <th>Texto Pregunta</th>
                    <th>Orden</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pager->getResults() as $opcion): ?>
                    <tr>
                        <td><?php echo $opcion->getCaId() ?></td>
                        <td><?php echo $opcion->getCaTexto() ?></td>
                        <td><?php echo $opcion->getCaIdpregunta() ?></td>
                        <td><?php echo $opcion->getPregunta()->getPreguntaTipo($opcion->getPregunta()->ca_tipo) ?></td>
                        <td><?php echo html_entity_decode($opcion->getPregunta()->ca_texto) ?></td>
                        <td><?php echo $opcion->getCaOrden() ?></td>
                        <td>
                            <a class="" href="<?php echo url_for('opcion/show?ca_id=' . $opcion->getCaId()) ?>"><img title="Ver Detalle" alt="Ver Detalle" src="/images/formularios/detalle.png"></a>
                            <? if ($nivel<=1){ ?>
                            <a class="" href="<?php echo url_for('opcion/edit?ca_id=' . $opcion->getCaId()) ?>"><img title="Editar" alt="Editar" src="/images/formularios/edit.gif"></a>
                            <? } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if ($pager->haveToPaginate()): ?>
            <div class="pagination">
                <a href="<? //php echo url_for('home', index)     ?>?pagina=1">
                    <img src="/images/formularios/first.png" alt="Primera P·gina" title="Primera P·gina" />
                </a>

                <a href="<? //php echo url_for('pregunta', index)     ?>?pagina=<?php echo $pager->getPreviousPage() ?>">
                    <img src="/images/formularios/before.png" alt="P·gina Anterior" title="P·gina Anterior" />
                </a>

                <?php foreach ($pager->getLinks() as $page): ?>
                    <?php if ($page == $pager->getPage()): ?>
                        <span class="number-page-active"> <?php echo $page ?></span>
                    <?php else: ?>
                        <a class="number-page" href="?pagina=<?php echo $page ?>"><?php echo $page ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>

                <a href="?pagina=<?php echo $pager->getNextPage() ?>">
                    <img src="/images/formularios/next.png" alt="P·gina Siguiente" title="P·gina Siguiente" />
                </a>

                <a href="?pagina=<?php echo $pager->getLastPage() ?>">
                    <img src="/images/formularios/last.png" alt="√öltima P√°gina" title="√öltima P·gina" />
                </a>
            </div>
        <?php endif; ?>
    <?php } ?>
    <!--
        <hr>
    <a class="accion" href="<?php echo url_for('opcion/new') ?>"><img src="/images/formularios/add.gif"> Nueva Opci√≥n</a>
    -->
</div>
<div class="filtro">
    <?php include_partial('filter', array('filtroOpcion' => $filtroOpcion)) ?>
</div>