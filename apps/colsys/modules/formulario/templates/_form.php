<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('formulario/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?ca_id=' . $form->getObject()->getCaId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
        <div class="mandatory"><span class="obligatorio-parentesis">(</span><span class="pregunta-obligatoria-admin">*</span><span class="obligatorio-parentesis">): </span> <span class="obligatorio">Campos Obligatorios</span></div>
    <table>
        <tfoot>
            <tr>
                <td colspan="2">
                    <!--&nbsp;<a class="accion" href="<?php echo url_for('formulario/index') ?>"><img src="/images/formularios/list.png">Regresar a la lista</a>-->
                    <?//php if (!$form->getObject()->isNew()): ?>
                        &nbsp;<!--<img src="/images/formularios/delete.gif"></a>--><?php// echo link_to('Borrar', 'formulario/delete?ca_id=' . $form->getObject()->getCaId(), array('method' => 'delete', 'confirm' => 'Esta seguro?')) ?>
                    <?//php endif; ?>
                    <input type="submit"  value="Guardar" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <!--<tr>
                <td><span class="obligatorio-parentesis">(</span><span class="pregunta-obligatoria-admin">*</span><span class="obligatorio-parentesis">): </span> <span class="obligatorio">Campos Obligatorios</span></td>
            </tr-->
            <?php echo $form ?>
        </tbody>
    </table>
</form>
