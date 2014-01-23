<h1>Listado de Preguntas</h1>
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
                    <th>formulario</th>
                    <th>bloque</th>
                    <th>texto</th>
                    <th>activa</th>
                    <th>obligatoria</th>
                    <th>tipo</th>
                    <th>orden</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pager->getResults() as $pregunta): ?>
                    <tr>
                        <td><?php echo $pregunta->getCaId() ?></td>
                        <td><?php echo $pregunta->getBloque()->getFormulario()->getCaTitulo() ?></td>
                        <td><?php echo $pregunta->getBloque()->getCaTitulo() ?></td>
                        <td><?php echo html_entity_decode($pregunta->getCaTexto()) ?></td>
                        <td><?php echo html_entity_decode($pregunta->getActivo($pregunta->getCaActivo())) ?></td>
                        <td><?php echo html_entity_decode($pregunta->getTextoBooleano($pregunta->getCaObligatoria())) ?></td>
                        <td><?php echo $pregunta->getPreguntaTipo($pregunta->getCaTipo()) ?></td>
                        <td><?php echo $pregunta->getCaOrden() ?></td>
                        <td>
                            <a class="" href="<?php echo url_for('pregunta/show?ca_id=' . $pregunta->getCaId()) ?>"><img title="Ver Detalle" alt="Ver Detalle" src="/images/formularios/detalle.png"></a>
                            <? if ($nivel<=1){ ?>
                            <a class="" href="<?php echo url_for('pregunta/edit?ca_id=' . $pregunta->getCaId()) ?>"><img title="Editar" alt="Editar" src="/images/formularios/edit.gif"></a>
                            <? } ?>
                            <a class="" target="_blank" href="<?php echo url_for('pregunta/vistaPrevia?ca_id=' . $pregunta->getCaId()) ?>"><img title="Previsualizar" title="Previsualizar" src="/images/formularios/verx16.png"></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <? //php include_partial('pregunta/lista', array('preguntas' => $pager->getResults())) ?>

        <?php if ($pager->haveToPaginate()): ?>
            <div class="pagination">
                <a href="<? //php echo url_for('home', index)  ?>?pagina=1">
                    <img src="/images/formularios/first.png" alt="Primera P&aacute;gina" title="Primera P&aacute;gina" />
                </a>

                <a href="<? //php echo url_for('pregunta', index)  ?>?pagina=<?php echo $pager->getPreviousPage() ?>">
                    <img src="/images/formularios/before.png" alt="Página Anterior" title="Página Anterior" />
                </a>

                <?php foreach ($pager->getLinks() as $page): ?>
                    <?php if ($page == $pager->getPage()): ?>
                        <span class="number-page-active"> <?php echo $page ?></span>
                    <?php else: ?>
                        <a class="number-page" href="?pagina=<?php echo $page ?>"><?php echo $page ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>

                <a href="?pagina=<?php echo $pager->getNextPage() ?>">
                    <img src="/images/formularios/next.png" alt="Página Siguiente" title="Página Siguiente" />
                </a>

                <a href="?pagina=<?php echo $pager->getLastPage() ?>">
                    <img src="/images/formularios/last.png" alt="Última Página" title="Última Página" />
                </a>
            </div>
        <?php endif; ?>
    <?php } ?>
    <!--
    <hr>
    <a class="accion" href="<?//php echo url_for('pregunta/new') ?>"><img src="/images/formularios/add.gif"> Nueva Pregunta</a>
    -->
</div>
<div class="filtro">
    <?php include_partial('filter', array('filtroPregunta' => $filtroPregunta)) ?>
</div>
