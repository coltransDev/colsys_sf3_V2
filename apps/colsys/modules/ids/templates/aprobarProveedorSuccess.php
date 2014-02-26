<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<div class="content" align="center">
    <div class="box1" style="width: 830px">
        <?if($respuesta=="Aprobado"){?>
            El proveedor <?=$proveedor->getIds()->getCaNombre()?> ha sido correctamente aprobado.<br />
            <b>Fecha:</b> <?=date('Y-m-d')?> <br />
            <b>Usuario:</b><?=$usuario->getCaNombre()?><br />        
        <?}else{?>
            Usted no está autorizado para aprobar éste proveedor. <br />
            La persona autorizada para aprobar éste proveedor es: <?=$proveedor->getCaJefecuenta()?$proveedor->getCaJefecuenta():"<span class='rojo'>Este proveedor aún no tiene Jefe de Cuenta.</span><br /> Favor reportar a Pricing"?><br />
        <?}?>
            <a href="/ids/verIds/modo/prov/id/<?=$proveedor->getCaIdproveedor()?>">Volver</a>
    </div>
</div>