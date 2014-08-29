<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

use_helper("ExtCalendar");
?>

<div class="content" align="center">
    <h2>Listados de Licencias</h2>
    <br />
    <form action="<?= url_for("inventory/informeLicenciasResult") ?>" method="post">
        <input type="hidden" id="idcategory" name="idcategory" />
        <table class="tableList alignLeft" width="60%" >
            <tr>
                <th colspan="2">
                    Ingrese los criterios de busqueda
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Sucursal:</b>
                    <br />
                    <select name="idsucursal">
                        <option value="">Todas</option>
                        <?
                        foreach ($sucursales as $s) {
                            ?>
                            <option value="<?= $s->getCaIdsucursal() ?>"><?= $s->getCaNombre() ?></option>
                            <?
                        }
                        ?>
                    </select>
                </td>
            </tr>            
           
            <tr>
                <td colspan="2">
                    <div align="center">
                        <input type="submit" value="Consultar" />
                    </div>
                </td>
            </tr>
        </table>
    </form>

</div>

