<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<table cellspacing="0" cellpadding="0">
    <tr>
        <td colspan="2"><b>Nombre:
            </b><br />

        <?=Utils::replace($tercero->getCaNombre())?></td>
        <td>
            <b>Enviar Informaci&oacute;n</b>:<br />
            <?=Utils::replace( $reporte->getCaInformarCons() )?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><b>Contacto:</b><br />
            <?=Utils::replace($tercero->getCaContacto())?>
        </td>
        <td><b>Direcci&oacute;n:</b><br />
            <?=Utils::replace($tercero->getCaDireccion())?>
        </td>
    </tr>
    <tr>
        <td>
            <b>Tel&eacute;fono</b>:<br />
            <?=$tercero->getCaTelefonos()?>
        </td>
        <td>
            <b>Fax</b>:<br />
            <?=$tercero->getCaFax()?>
        </td>
        <td>
            <b>Correo Electr&oacute;nico</b>:<br />
            <?=$tercero->getCaEmail()?>
        </td>
    </tr>
</table>
