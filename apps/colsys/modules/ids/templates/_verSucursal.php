<?php
/* 
 * Muestra os datos de una sucursal
 */
?>
<tr>
    <th colspan="3">
        <div align="left">
            <div style="font-size:16px">
                <b><?=$sucursal->getCiudad()->getCaCiudad() ?></b>
            </div>
            <?=$sucursal->getCaPrincipal()?"Oficina Principal":""?>
        </div>
    </th>
    <th valign="top">
        <div align="right">
            <?=$sucursal->getCaPrincipal()?link_to(image_tag("16x16/add_group.gif")." Nueva sucursal", "ids/formSucursalIds?id=".$sucursal->getCaid()."&modo=".$modo):"&nbsp;"?>
        </div>
    </th>
</tr>
<tr>
    <td>
        <div align="left">
            <b>Direcci�n:</b>
        </div>
    </td>
    <td>
        <div align="left">
            <?=$sucursal->getCaDireccion()?>
        </div>
    </td>
    <td>
        <div align="left">
            &nbsp;
        </div>
    </td>
    <td>
        <div align="left">
             &nbsp;
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
