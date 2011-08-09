<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>
<div class="content" align="center">
    <h2>Listados de Activos</h2>
    <br />
    <form action="<?=url_for("inventory/informeListadoActivosResult")?>" method="post">
        <table class="tableList alignLeft" width="40%" >
            <tr>
                <th>
                    Ingrese los citerios de busqueda
                </th>
            </tr>
            <tr>
                <td>
                    <b>Sucursal:</b>
                        <br />
                    <select name="idsucursal">
                        <?
                        foreach( $sucursales as $s ){
                        ?>
                        <option value="<?=$s->getCaIdsucursal()?>"><?=$s->getCaNombre()?></option>
                        <?
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <div align="center">
                        <input type="submit" value="Consultar" />
                    </div>
                </td>
            </tr>
        </table>
    </form>
    
</div>