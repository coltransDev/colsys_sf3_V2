<?php
/* 
 * Muestra os datos de una sucursal
 */
?>

<tr>
    <td>
        <div align="left">
            <b>Dirección:</b>
        </div>
    </td>
    <td>
        <div align="left">
            <?=$sucursal->getCaDireccion()?>
        </div>
    </td>
    <td>
        <div align="left">
            <b>Ciudad:</b>
        </div>
    </td>
    <td>
        <div align="left">
              <?=$sucursal->getCiudad()->getCaCiudad() ?>
        </div>
    </td>
</tr>
<tr>
    <td>
        <div align="left">
            <b>Tel&eacute;fono:</b>
        </div>
    </td>
    <td>
        <div align="left">
            <?=$sucursal->getCaTelefonos()?>
        </div>
    </td>
    <td>
        <div align="left">
            <b>Fax:</b>
        </div>
    </td>
    <td>
        <div align="left">
              <?=$sucursal->getCaFax() ?>
        </div>
    </td>
</tr>
