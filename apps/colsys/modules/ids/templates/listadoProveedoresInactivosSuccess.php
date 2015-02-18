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
    <h2>LISTADO DE PROVEEDORES APROBADOS E INACTIVOS</h2><br/>
    <table border="1" class="tableList" width="70%">
    <thead>
        <tr>
            <th >Nombre</th>
            <th >Ciudad</th>
            <th >Fch. Aprobado</th>
            <th >Usu. Aprobado</th>
            <th >Estado Impo</th>
            <th >Estado Expo</th>
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
            <td><div align="left"><?=$proveedor->getCaFchaprobado()?></div></td>
            <td><div align="left"><?=$proveedor->getCaUsuaprobado()?></div></td>
            <td><div align="left"><?=$proveedor->getCaActivoImpo()?"Activo":"<span class='rojo'>Inactivo</span>"?></div></td>
            <td><div align="left"><?=$proveedor->getCaActivoExpo()?"Activo":"<span class='rojo'>Inactivo</span>"?></div></td>
        </tr>
        <?
        }
        ?>
    </table>
</div>