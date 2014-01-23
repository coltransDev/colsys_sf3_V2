<h1>Editar Opci&oacute;n</h1>
<?php if ($sf_user->hasFlash('notice')): ?>
    <div class="flash_notice">
        <?php echo $sf_user->getFlash('notice') ?>
    </div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
    <div class="flash_error">
        <?php echo $sf_user->getFlash('error') ?>
    </div>
<?php endif; ?>
<?php include_partial('form', array('form' => $form)) ?>
