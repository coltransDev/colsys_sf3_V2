<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<tr class="row0">
    <td width="12%"><b>Etapa</b></td>
    <td width="14%"><b>Usuario</b></td>
    <td width="16%"><b>Fecha</b></td>
    <td width="39%"><b>Seguimiento</b></td>
    <td width="19%">
        <?
        $url = "cotseguimientos/formSeguimiento?idcotizacion=".$cotizacion->getCaIdcotizacion();
        if( isset($producto) ){
            $url .= "&idproducto=".$producto->getCaIdproducto();
        }
        echo link_to(image_tag("22x22/todo.gif")." Nuevo seguimiento", $url);

        ?></td>
</tr>
<?
if( $tarea && $tarea->getCaIdtarea() && !$tarea->getCaFchterminada() ){
?>
<tr class="row0">
    <td colspan="5"><?=image_tag("22x22/alert.gif")?> Se le recordara hacer un seguimiento el d&iacute;a <?=Utils::fechaMes(Utils::parseDate($tarea->getCaFchvencimiento(),"Y-m-d"))?> </td>
</tr>
<?
}

if( count($seguimientos)==0 ){
?>
<tr>
    <td colspan="5">No se han creado seguimientos para este trayecto</td>
</tr>
<?
}

foreach( $seguimientos as $seguimiento ){
?>
<tr>
    <td><?=$seguimiento->getEtapa();?></td>
    <td><?=$seguimiento->getUsuario()->getCaNombre()?></td>
    <td><?=Utils::fechaMes($seguimiento->getCaFchseguimiento())?></td>
    <td colspan="2">
    <?=$seguimiento->getCaSeguimiento()?></td>
</tr>
<?
}
