<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$initialYear = 2007;
$actualYear = date("Y");
$numYears = $actualYear-$initialYear+1;
?>
<div class="content" align="center">
    <table border="1" class="tableList" width="70%">
    <thead>
        <tr>
            <th rowspan="1">Nombre</th>
			<th rowspan="1">Ciudad</th>
        </tr>
        <?
        foreach( $proveedores as $proveedor ){
			
			$ids = $proveedor->getIds();
			$tipo = $proveedor->getIdsTipo();
			$sucursales = $ids->getIdsSucursal();
                ?>
		<tr>
		<td width="300"><div align="left"><?=link_to($proveedor->getIds()->getCaNombre(), "ids/verIds?modo=prov&id=".$ids->getCaId())?></div></td>
		<!--<td  colspan="2"><div align="left"><b><?=$proveedor->getIds()->getCaNombre()?></b></div></td>-->
        <td width="100">
                <div align="left">
                <?
                foreach( $sucursales as $sucursal ){
                    echo $sucursal->getCiudad()->getCaCiudad()." ";
                }
                ?>
                </div>
        </td> 
		</tr>
        <?
        }
        ?>
	</table>
</div>