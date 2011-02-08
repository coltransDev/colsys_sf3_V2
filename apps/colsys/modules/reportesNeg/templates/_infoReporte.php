<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<div id="trayecto" class="x-hide-display">
    <?
    include_component("reportesNeg", "consultaTrayecto", array("reporte"=>$reporte));
    ?>
    <?
    if( count($grupoReportes)>0 ){
    ?>
    
    <table class="tableList" width="100%">
        <tr>
            <th><b>Unificaci&oacute;n de reportes</b></th>
        </tr>
        
        <?
        foreach( $grupoReportes as $rep){
            ?>
            <tr>
                <td>
                <?=link_to($rep->getCaConsecutivo()." ".$rep->getCaVersion(), "reportesNeg/consultaReporte?id=".$rep->getCaIdreporte())."<br />";?>
                </td>
            </tr>
            <?
        }
        ?>        
   </table>    
    <?
    }
    if( $reporte->getCaIdgrupo() ){
        $reporteUnificado = $reporte->getGrupoReporte();

    ?>
    <table class="tableList" width="100%">
        <tr>
            <th><b>Este reporte se ha unificado con:</b></th>
        </tr>
       
        <tr>
            <td>
            <?=link_to($reporteUnificado->getCaConsecutivo()." ".$reporteUnificado->getCaVersion(), "reportesNeg/consultaReporte?id=".$reporteUnificado->getCaIdreporte())."<br />";?>
            </td>
        </tr>
       
   </table>
    <?
    }
    ?>
</div>
<div id="cliente" class="x-hide-display">
    <table class="tableList alignLeft" width="100%">
        <tr>
            <th colspan="6"><b>Informaci&oacute;n del Cliente</b></th>
        </tr>
        <tr class="row0">
            <td  colspan="6"><b>Cliente</b></td>
        </tr>
        <tr>
            <td colspan="6" >
                <?
                $contacto = $reporte->getContacto();
                if( $contacto ){
                    $cliente = $contacto->getCliente();
                ?>

                <table cellspacing="1" width="100%" border="0">
                    <tbody>
                        <tr>
                            <td width="33%" ><b>Nombre:</b> <?=Utils::replace($cliente->getCaCompania())?></td>
                            <td width="33%" ><b>Contacto:</b> <?=Utils::replace($contacto->getNombre())?></td>
                            <td width="33%" ><b>Orden:</b><?=$reporte->getCaOrdenClie()?></td>
                        </tr>
                        <tr>
                            <td><b>Direcci&oacute;n:</b> <?=Utils::replace($cliente->getCaDireccion())?></td>
                            <td><b>Tel&eacute;fono:</b> <?=$contacto->getCaTelefonos()?></td>
                            <td><b>Fax:</b><?=$contacto->getCaFax()?></td>
                        </tr>
                        <tr>
                            <td><b>Correo   Electr&oacute;nico: </b> <?=$contacto->getCaEmail()?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>

                        <tr >
                            <td><b>Lib. Autom&aacute;tica:</b>
                                <?=$reporte->getCaLiberacion()?>
                            </td>
                        <?
                        if( $reporte->getCaImpoexpo()!=Constantes::EXPO && $reporte->getCaTransporte()==Constantes::MARITIMO && $reporte->getCaComodato()!="" ){
                        ?>
                            <td><b>Firma Contrato de Comodato:</b>
                                <?=$reporte->getCaComodato()?>
                            </td>
                        <?
                        }
                        ?>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <td><b>Tiempo de Cr&eacute;dito:</b>
                                <?=$reporte->getCaTiempocredito()?>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                <?
                }
                ?>			</td>
        </tr>
        <?
        if( $reporte->getCaIdproveedor() ){

            $values = explode("|", $reporte->getCaIdproveedor() );

            foreach( $values as $value ){
            ?>
            <tr class="row0">
                <td  colspan="6"><b>Proveedor</b></td>
            </tr>
            <tr>
                <td colspan="6" >
                    <?
                    include_component("reportesNeg", "previewTercero", array("idtercero"=>$value, "reporte"=>$reporte));
                    ?>
                </td>
            </tr>
            <?
            }
        }
        ?>

    </table>
</div>

<div id="facturacion" class="x-hide-display">
    
    <table class="tableList alignLeft" width="100%">
        <tr>
            <th colspan="6"><b>Facturaci&oacute;n</b></th>
        </tr>
        <tr>
            <td  colspan="6">
                <b>Cliente:</b><br />
                <?=Utils::replace($reporte->getClienteFac()->getCaCompania())?>
                </td>
        </tr>
        <?
        if($reporte->getCaImpoexpo()==Constantes::EXPO)
        {
        ?>
        <tr>
            <td  colspan="6">
                <b>Agente:</b><br />
                <?=Utils::replace($reporte->getClienteAg()->getCaCompania())?>
                </td>
        </tr>
        <tr>
            <td  colspan="6">
                <b>Otro:</b><br />
                <?=Utils::replace($reporte->getClienteOtro()->getCaCompania())?>
                </td>
        </tr>        
        <?
        }
        ?>
        
     </table>
</div>



<div id="preferencias" class="x-hide-display">
    
    <table class="tableList alignLeft" width="100%">
        <tr>
            <th colspan="6"><b>Preferencias del cliente</b></th>
        </tr>
        <tr>

            <td  colspan="6">
                <b>Preferencias del Cliente:</b><br />

                    <?=Utils::replace($reporte->getCaPreferenciasClie())?>

                </td>
        </tr>
        <tr>
            <td  colspan="6">
                <b>Instrucciones Especiales para el Agente:</b>

                <br />
                <?=Utils::replace($reporte->getCaInstrucciones())?></td>
        </tr>
        <tr>
            <td colspan="6" >
                <b>Copiar comunicaciones a:</b><br />

                    <?=str_replace(",", ", ", $reporte->getCaConfirmarClie()) ?>

            </td>
        </tr>
     </table>
</div>

<div id="guias" class="x-hide-display">
    <?
    include_component("reportesNeg", "consultaCorteGuias", array("reporte"=>$reporte));
    ?>
    
</div>

<?
if($reporte->getCaColmas()=="Sí"){
?>
 <div id="aduana" class="x-hide-display">
    
    <?
    include_component("reportesNeg", "consultaAduana", array("reporte"=>$reporte));
    ?>
</div>
<?
}
if($reporte->getCaSeguro()=="Sí"){
?>
 <div id="seguros" class="x-hide-display">
    
    <?
    include_component("reportesNeg", "consultaSeguros", array("reporte"=>$reporte));
    ?>

</div>
<?
}
if($reporte->getCaImpoexpo()==Constantes::EXPO){
?>
 <div id="exportaciones" class="x-hide-display">
    
    <?
    include_component("reportesNeg", "consultaExportaciones", array("reporte"=>$reporte));
    ?>
</div>
<?
}






                             