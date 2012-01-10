<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="content" align="center">
    <h2>Listados de Mantenimientos</h2>
    <br />
    <form action="<?= url_for("inventory/informeListadoMantenimientosResult") ?>" method="post">
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
                    <b>Fecha Mantenimiento:</b>
                    <br />
                    <select name="mes">
                        <option value="">Todos</option>
                        <?
                        for( $i=1; $i<13;$i++){
                        ?>
                        <option value=<?=intval($i)?>> <?=Utils::mesLargo($i)   ?></option>
                        <?
                        }
                        ?>
                    </select>
                 </td>
            </tr>
            <tr>
                <td colspan="2">   
                    <b>Ordenar Por:</b>
                    <br />
                    <select name="criterio">
                        <option value="mes" selected="selected">Mes</option>
                        <option value="categoria">Categor&iacute;a</option>
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
