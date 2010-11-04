<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="content" align="center">
<div class="box1">
    <table border="1" class="tableList" width="680">
        <thead>
            <tr>
                <th>Nombre de Usuario</th>
                <th>Sucursal</th>
                <th>Departamento</th>
                <th>Empresa</th>
                <th>Tel&eacute;fono</th>
                <th>Extensi&oacute;n</th>
            </tr>
            <?
        foreach ($usuarios as $usuario) {
            ?>
            <tr>
                <td><b><a href="<?=url_for('adminUsers/viewUser?login='.$usuario->getCaLogin()) ?>"><?=$usuario->getCaNombre()?></a></b></td>
                <td><?=($usuario->getSucursal()->getCaNombre())?></td>
                <td><?=($usuario->getCaDepartamento())?></td>
                <td><?=($usuario->getSucursal()->getEmpresa()->getCaNombre())?></td>
                <td><?=($usuario->getSucursal()->getCaTelefono())?></td>
                <td><?=($usuario->getCaExtension())?></td>
            </tr>
        <?
        }
        ?>
        </thead>
    </table>
    <br />
    <?
    include_component("adminUsers", "directorio");
    ?>

</div>
</div>