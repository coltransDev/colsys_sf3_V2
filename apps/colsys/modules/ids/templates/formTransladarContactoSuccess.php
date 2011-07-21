<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>

<div class="content" align="center">
	<h3>Maestra de Proveedores - Contactos</h3>
	<br />
    <form action="<?=url_for("ids/formTransladarContacto?modo=".$modo."&idcontacto=".$contacto->getCaIdcontacto())?>" method="post" >
        <table class="tableList alignLeft" width="400px">
            <tr>
                <th>
                    Cambio de sucursal
                </th>
            </tr>
            <tr>
                <td>
                    <b>Contacto:</b>
                    <br />
                    <?=$contacto->getNombre()?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Sucursal:</b>
                    <br />
                    <select name="idsucursal">
                        <?
                        foreach( $sucursales as $s ){
                        ?>
                        <option value="<?=$s->getCaIdsucursal()?>" <?=$s->getCaIdsucursal()==$sucursal->getCaIdsucursal()?"selected='selected'":""?> ><?=$s->getCiudad()->getCaCiudad()." (".$s->getCaDireccion().")"?></option>
                        <?
                        }
                        ?>                    
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <div align="center" ><input class="button" type="submit" value="Guardar" /></div>
                </td>
            </tr>
        </table>
    </form>
    
    
    
    
    
    
</div>
