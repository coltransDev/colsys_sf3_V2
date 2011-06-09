<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
?>



<table border="1" class="tableList" width="100%">
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
            <td align="left"><b><a href="<?=url_for('adminUsers/viewUser?login='.$usuario->getCaLogin()) ?>"><?=$usuario->getCaNombre()?></a></b></td>
            <td align="left"><?=($usuario->getSucursal()->getCaNombre())?></td>
            <td align="left"><?=($usuario->getCaDepartamento())?></td>
            <td align="left"><?=($usuario->getSucursal()->getEmpresa()->getCaNombre())?></td>
            <td align="left"><?=($usuario->getSucursal()->getCaTelefono())?></td>
            <td align="left"><?=($usuario->getCaExtension())?></td>
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
<br />
