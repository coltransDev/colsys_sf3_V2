<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('opcion/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?ca_id='.$form->getObject()->getCaId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          
          <?//php if (!$form->getObject()->isNew()): ?>
            <!--&nbsp;<img src="/images/formularios/delete.gif"></a><?//php echo link_to('Delete', 'opcion/delete?ca_id='.$form->getObject()->getCaId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>-->
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
