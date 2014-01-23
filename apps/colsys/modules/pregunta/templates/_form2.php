<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('pregunta/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?ca_id=' . $form->getObject()->getCaId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table class="pregunta-form">
        <tfoot>
            <tr>
                <td colspan="2">
                        <?php if (!$form->getObject()->isNew()): ?>
                        &nbsp;<img src="/images/formularios/delete.gif"></a><?php echo link_to('Borrar', 'pregunta/delete?ca_id=' . $form->getObject()->getCaId(), array('method' => 'delete', 'confirm' => 'Esta seguro?')) ?>
                    <?php endif; ?>
                    <input type="submit" value="Guardar" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <th><h4>Datos Generales</h4>
        </th>
        <td>
        </td>
        </tr>

        <?php echo $form['ca_texto']->renderError(); ?>
        <?php echo $form['ca_idbloque']->renderRow(); ?>
        <?php echo $form['ca_texto']->renderRow(); ?>
        <?php echo $form['ca_ayuda']->renderRow(); ?>
        <?php echo $form['ca_error']->renderRow(); ?>
        <?php echo $form['ca_tipo']->renderRow(); ?>
        <?php echo $form['ca_obligatoria']->renderRow(); ?>
        <?php echo $form['ca_orden']->renderRow(); ?>
        <?php echo $form['ca_activo']->renderRow(); ?>

        <tr>
            <th><h4>Preguntas Tipo Escala</h4>
        </th>
        <td>
        </td>
        </tr>
        <?php echo $form['ca_intervalo_inicial']->renderRow(); ?>
        <?php echo $form['ca_intervalo_final']->renderRow(); ?>
        <?php echo $form['ca_etiqueta_intervalo_inicial']->renderRow(); ?>
        <?php echo $form['ca_etiqueta_intervalo_final']->renderRow(); ?>
        <tr>
            <th><h4>Preguntas Tipo Cuadr&iacute;cula</h4>
        </th>
        <td>
        </td>
        </tr>
        <?php echo $form['ca_etiquetas_columnas']->renderRow(); ?>
        <?php echo $form['ca_etiquetas_filas']->renderRow(); ?>
        <?//php echo $form['_csrf_token']->render(); ?>
        <? //php echo $form ?>
        </tbody>
    </table>
</form>
