<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<form action="<?php echo url_for('conceptos/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?ca_idconcepto='.$form->getObject()->getCaIdconcepto() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  
  <table class="tableForm">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields() ?>
          <input type="submit" value="Guardar" class="button" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['ca_concepto']->renderLabel() ?></th>
        <td>
          <?php echo $form['ca_concepto']->renderError() ?>
          <?php echo $form['ca_concepto'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ca_unidad']->renderLabel() ?></th>
        <td>
          <?php echo $form['ca_unidad']->renderError() ?>
          <?php echo $form['ca_unidad'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ca_transporte']->renderLabel() ?></th>
        <td>
          <?php echo $form['ca_transporte']->renderError() ?>
          <?php echo $form['ca_transporte'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ca_modalidad']->renderLabel() ?></th>
        <td>
          <?php echo $form['ca_modalidad']->renderError() ?>
          <?php echo $form['ca_modalidad'] ?>
        </td>
      </tr>
     
      <tr>
        <th><?php echo $form['ca_liminferior']->renderLabel() ?></th>
        <td>
          <?php echo $form['ca_liminferior']->renderError() ?>
          <?php echo $form['ca_liminferior'] ?>
        </td>
      </tr>
     
    </tbody>
  </table>
  
</form>
