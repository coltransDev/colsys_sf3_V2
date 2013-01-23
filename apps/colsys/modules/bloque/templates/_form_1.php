<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?//php echo "id: ".$id ?>
<form action="<?php echo url_for('bloque/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?ca_id='.$form->getObject()->getCaId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <!--&nbsp;<a class="accion" href="<?//php echo url_for('bloque/index') ?>"><img src="/images/formularios/list.png">Regresar a la lista</a>-->
          <?//php if (!$form->getObject()->isNew()): ?>
          <!--  &nbsp;<img src="/images/formularios/delete.gif"></a><?//php echo link_to('Eliminar', 'bloque/delete?ca_id='.$form->getObject()->getCaId(), array('method' => 'eliminar', 'confirm' => 'Esta seguro?')) ?>-->
          <?//php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
