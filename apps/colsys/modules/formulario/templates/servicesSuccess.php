<h1>
    <?php echo "bloque ".$bloque->ca_id; ?>
</h1>

<?php
include_partial('formulario/selServicios', array('formulario' => $formulario, 'bloque' => $bloque));
?>
