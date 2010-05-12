<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('noticias/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?ca_idnoticia='.$form->getObject()->getCaIdnoticia() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('noticias/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'noticias/delete?ca_idnoticia='.$form->getObject()->getCaIdnoticia(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['ca_autor']->renderLabel() ?></th>
        <td>
          <?php echo $form['ca_autor']->renderError() ?>
          <?php echo $form['ca_autor'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ca_titulo']->renderLabel() ?></th>
        <td>
          <?php echo $form['ca_titulo']->renderError() ?>
          <?php echo $form['ca_titulo'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ca_categoria']->renderLabel() ?></th>
        <td>
          <?php echo $form['ca_categoria']->renderError() ?>
          <?php echo $form['ca_categoria'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ca_fchcreado']->renderLabel() ?></th>
        <td>
          <?php echo $form['ca_fchcreado']->renderError() ?>
          <?php echo $form['ca_fchcreado'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ca_fcharchivar']->renderLabel() ?></th>
        <td>
          <?php echo $form['ca_fcharchivar']->renderError() ?>
          <?php echo $form['ca_fcharchivar'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ca_idsucursal']->renderLabel() ?></th>
        <td>
          <?php echo $form['ca_idsucursal']->renderError() ?>
          <?php echo $form['ca_idsucursal'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ca_noticia']->renderLabel() ?></th>
        <td>
          <?php echo $form['ca_noticia']->renderError() ?>
          <?php echo $form['ca_noticia'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
