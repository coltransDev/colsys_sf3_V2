<?php if ($sf_user->hasFlash('notice')): ?>
    <div class="flash_notice">
    <?php echo $sf_user->getFlash('notice') ?>
</div>
<?php endif; ?>
    <div class="resultado-estadistica">
        <h1>Listado de Contactos que respondieron el formulario "<?php echo $formulario->ca_titulo ?>"</h1>
    <?php if (sizeof($contactos) == 0) {
    ?>
        <p class="resultado_vacio"> 0 campos encontrados</p>
    <?php } else {
 ?>
        <table border="1" class="listado">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Empresa</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Sucursal</th>
                    <th>Representante de ventas</th>
                    <th>Fecha en que se diligencio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 0 ?>
<?php foreach ($contactos as $control): ?>
                <?php $i++;          ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $control['ca_id'] ?></td>
                    <td><?php echo $control['ca_compania'] ?></td>
                    <td><?php echo $control['ca_nombres'] . ' ' . $control['ca_papellido'] . ' ' . $control['ca_sapellido'] ?></td>
                    <td><?php echo $control['ca_email'] ?></td>
                    <td><?php echo $control['ca_nombre'] ?></td>
                    <td><?php echo $control['ca_vendedor'] ?></td>
                    <td><?php echo $control['ca_fchcreado'] ?></td>
       
                    <td>
                        <a class="" target="_blank" href="<?php echo url_for('formulario/resultado?ca_id=' . $control['ca_id']) ?>"><img title="Ver respuesta" title="Ver respuesta" src="/images/formularios/respuesta.png"></a>
                    </td>
                </tr>
<?php endforeach; ?>

            </tbody>
        </table>
<?php } ?>
</div>
