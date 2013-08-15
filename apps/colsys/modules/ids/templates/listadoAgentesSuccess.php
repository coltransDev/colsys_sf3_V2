<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<div class="content" align="center">
    <table border="1" class="tableList" width="90%">
    <thead>
        <tr><th colspan="<?=$estado=='tplogistics'?5:3?>" style="text-align: center;"><?=$estado=='actoficial'?'LISTADO DE AGENTES ACTIVOS OFICIALES':($estado=='actnoficial'?'LISTADO DE AGENTES ACTIVOS NO OFICIALES':($estado=='inactivo'?'LISTADO DE AGENTES INACTIVOS':'LISTADO DE AGENTES TPLOGISTICS'))?></th></tr>
        <tr>
            <th style="text-align: center;">Nombre</th>
            <th style="text-align: center;">Pa&iacute;s</th>
<?          
            if($estado=="tplogistics"){
?>
            <th style="text-align: center;">Estado</th>
            <th style="text-align: center;">Tipo</th>
<?          
            }
?>
            <th style="text-align: center;">Información de Seguridad</th>
        </tr>
    </thead>
    <tbody>
<?
        foreach($agentes as $agente){
            
            $sucursales = $agente->getIdsSucursal();
            
            foreach($sucursales as $sucursal){
                if($sucursal->getCaPrincipal() == true){
                    $sucPpal = $sucursal->getCiudad()->getTrafico()->getCaNombre();
                }
            }
?>
        <tr>
            <td width="30%"><?=link_to($agente->getCaNombre(), "ids/verIds?modo=agentes&id=".$agente->getCaId(), array('popup' => true))?></td>
            <td width="20%"><?=$sucPpal?></td>
<?
            if($estado=="tplogistics"){
?>
            <td width="10%"><?=$agente->getIdsAgente()->getCaActivo()?"Activo":"<span class='rojo'>Inactivo</span>"?></td>
            <td width="10%"><?=$agente->getIdsAgente()->getCaTipo()?></td>
<?
            }
?>
            <td width="50%"><?=$agente->getIdsAgente()->getCaInfosec()?></td>
        </tr>
<?
        }
?>
    </tbody>
</table>
    <div align="center">
     Generado <?=Utils::fechaMes(date("Y-m-d H:i:s"))?>
    </div>
</div>