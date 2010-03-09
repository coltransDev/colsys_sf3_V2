<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<table class="tableList alignLeft" width="100%">
    <tr>
        <th colspan="6"><b>Informaci&oacute;n del trayecto</b></th>
    </tr>
    <tr>
        <td ><b>Clase:</b></td>
        <td ><?=Utils::replace($reporte->getCaImpoexpo())?></td>
        <td ><b>Fecha Despacho:</b></td>
        <td ><?=Utils::fechaMes($reporte->getCaFchdespacho())?></td>
        <td ><b>&nbsp;</b></td>
        <td >&nbsp;</td>
    </tr>

    <tr>
        <td ><b>Transporte:</b></td>
        <td ><?=Utils::replace($reporte->getCaTransporte())?></td>
        <td ><b>Origen:</b></td>
        <td ><?=$reporte->getOrigen()?></td>
        <td ><b>Destino</b></td>
        <td ><?=$reporte->getDestino()?></td>
    </tr>
    <tr>

        <td ><b>Modalidad</b></td>
        <td ><?=$reporte->getCaModalidad()?></td>
        <td ><b>Agente:</b></td>
        <td ><?=$reporte->getIdsAgente()?$reporte->getIdsAgente()->getIds()->getCaNombre():"Directo"?></td>
        <td >&nbsp;</td>
        <td >&nbsp;</td>
    </tr>
    <tr>
        <td colspan="6" ><b>Descripci&oacute;n de la Mercanc&iacute;a:</b><br />
            <?=Utils::replace($reporte->getCaMercanciaDesc())?>			</td>
    </tr>
</table>
<?
if( $reporte->getcaContinuacion()!="N/A" ){
    

?>

<table class="tableList alignLeft" width="100%">
     <tr >
         <th colspan="4" ><b>Continuaci&oacute;n de viaje</b></th>
     </tr>
     <tr>
         <td colspan="4">
           <?=$reporte->getCaContinuacion()?>
        </td>
    </tr>
    <tr id="continuacion-row0">
        <td width="33%" valign="top" ><b>Destino Final:</b><br />
                <?=$reporte->getDestinoCont()?>

				</td>
                <td width="67%" valign="top" >
                <?
                if( $reporte->getCaTransporte()==Constantes::MARITIMO){
                ?>
                <b>Notificar a:</b><br />
                <?
                    if( $reporte->getCaContinuacionConf() ){
                        $usuario = Doctrine::getTable("Usuario")->find( $reporte->getCaContinuacionConf() );
                        echo $usuario->getCaNombre();
                    }
                }
                ?>
        </td>
    </tr>
</table>
<?
}
?>