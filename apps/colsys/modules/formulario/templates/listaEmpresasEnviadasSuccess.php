<?php if ($sf_user->hasFlash('notice')): ?>
    <div class="flash_notice">
        <?php echo $sf_user->getFlash('notice') ?>
    </div>
<?php endif; ?>
<div class="resultado-estadistica">
    <br>
    <br>
    <? if (sizeof($empresas) > 0) { ?> 
        <h1>Listado de Empresas a las cuáles se envió el Formulario:  "<?php echo $formulario->ca_titulo ?>" para la sucursal "<?=$sucursal?>" </h1>
    <? } else { ?> 
        <? /*if ($sucursal != '0') { ?>
            <h3 class="resultado_vacio">No hay contactos de la sucursal <? echo $sucursal; ?> que hallan respondido la encuesta</h3>
        <? } else { ?> 
            <h3 class="resultado_vacio">No hay contactos que hallan respondido la encuesta</h3> 
        <? } */?> 
    <? } ?>          

<? $z = 0 ?>
<? if (sizeof($empresas) > 0) { ?>

        <table border="1" class="listado">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Empresa</th>
                    <th>Sucursal</th>
                </tr>
            </thead>
            <tbody>
                <? foreach ($empresas as $empresa): ?>
                    <?
                    $z++;
                    //$respuesta = $formulario->getPromedio($control['ca_id']);
                    ?>
                    <tr>
                        <td><? echo $z ?></td>
                        <td><? echo $empresa['ca_compania'] ?></td>
                        <td><? echo $empresa['ca_sucursal'] ?></td>
                    </tr>
        <? endforeach; ?>
            </tbody>
        </table>
<? } ?>
</div>