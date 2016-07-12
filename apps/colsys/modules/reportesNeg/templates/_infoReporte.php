<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<div id="trayecto" class="x-hide-display"> 
    <? 
    include_component("reportesNeg", "consultaTrayecto", array("reporte"=>$reporte, "comparar"=>$comparar));
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
            <td <?=($comparar)? (($reporte->compDato("CaIdgrupo")!=0)?"class='rojo'":"") :""?>>
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
                $contacto = $reporte->getContacto('2');
                if( $contacto ){
                    $cliente = $reporte->getCliente();
                ?>

                <table cellspacing="1" width="100%" border="0">
                    <tbody>
                        <tr>
                            <td width="33%" <?=($comparar)? (($reporte->compDato("CaIdconcliente")!=0)?"class='rojo'":"") :""?> ><b>Nombre:</b> <?=Utils::replace($cliente->getCaCompania())?>
                                &nbsp;&nbsp;
                            <?
                                if($cliente->getProperty("cuentaglobal")=="true")
                                {
                            ?>	
                                <img src="/images/CG30.png" title="Cliente de Cuentas Globales" width="20" height="20" />
                             <?
                                }
                             ?>
                            </td>
                            <td width="33%" <?=($comparar)? (($reporte->compDato("CaIdconcliente")!=0)?"class='rojo'":"") :""?> ><b>Contacto:</b> <?=Utils::replace($contacto->getCaNombres())?></td>
                            <td width="33%" <?=($comparar)? (($reporte->compDato("CaOrdenClie")!=0)?"class='rojo'":"") :""?> ><b>Orden:</b><?=$reporte->getOrdenesStr()?></td>
                        </tr>
                        <tr>
                            <td><b>Direcci&oacute;n:</b> <?=Utils::replace($cliente->getDireccion())?></td>
                            <td><b>Tel&eacute;fono:</b> <?=$contacto->getCaTelefonos()?></td>
                            <td><b>Fax:</b><?=$contacto->getCaFax()?></td>
                        </tr>
                        <tr>
                            <td><b>Correo   Electr&oacute;nico: </b> <?=$contacto->getCaEmail()?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>

                        <tr >
                            <td <?=($comparar)? (($reporte->compDato("CaLiberacion")!=0)?"class='rojo'":"") :""?>><b>Lib. Autom&aacute;tica:</b>
                                <?=$reporte->getCaLiberacion()?>
                            </td>
                        <?
                        if( $reporte->getCaImpoexpo()!=Constantes::EXPO && $reporte->getCaTransporte()==Constantes::MARITIMO && $reporte->getCaComodato()!="" ){
                        ?>
                            <td <?=($comparar)? (($reporte->compDato("CaComodato")!=0)?"class='rojo'":"") :""?>><b>Firma Contrato de Comodato:</b>
                                <?=$reporte->getCaComodato()?>
                            </td>
                        <?
                        }
                        ?>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <td <?=($comparar)? (($reporte->compDato("CaTiempocredito")!=0)?"class='rojo'":"") :""?>><b>Tiempo de Cr&eacute;dito:</b>
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
        /*if( $reporte->getCaIdproveedor() ){

            $values = explode("|", $reporte->getCaIdproveedor() );

            foreach( $values as $k=>$value ){
            ?>
            <tr <?=($comparar)? (($reporte->compDato("CaIdproveedor")!=0)?"class='rojo'":"") :""?> class="row0">
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
        }*/
        $proveedores = $reporte->getProveedores();
        $strProveedores = $reporte->getProveedoresStr();
        if( count($proveedores)>0 ){
            foreach( $proveedores as $proveedor ){
                
                if($comparar){
                    echo "comparacion".$reporte->compDato("ProveedoresStr");
                }
                ?>
                <tr class="row0">
                    <td <?=($comparar)? (($reporte->compDato("ProveedoresStr")!=0)?"class='rojo'":"") :""?> colspan="6"><b>Proveedor</b></td>
                </tr>
                <tr>
                    <td colspan="6" >
                        <?
                        include_component("reportesNeg", "previewTercero", array("idtercero"=>$proveedor->getCaIdtercero(), "reporte"=>$reporte));
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
            <td  colspan="6" <?=($comparar)? (($reporte->compDato("CaIdclientefac")!=0)?"class='rojo'":"") :""?>>
                <b>Cliente:</b><br />
                <?=Utils::replace($reporte->getClienteFac()->getCaCompania())?>
                </td>
        </tr>
        <?
        if($reporte->getCaImpoexpo()==Constantes::EXPO)
        {
        ?>
        <tr>
            <td  colspan="6" <?=($comparar)? (($reporte->compDato("CaIdclienteag")!=0)?"class='rojo'":"") :""?>>
                <b>Agente:</b><br />
                <?=Utils::replace($reporte->getClienteAg()->getCaCompania())?>
                </td>
        </tr>
        <tr>
            <td  colspan="6" <?=($comparar)? (($reporte->compDato("CaIdclienteotro")!=0)?"class='rojo'":"") :""?>>
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

            <td  colspan="6" <?=($comparar)? (($reporte->compDato("CaPreferenciasClie")!=0)?"class='rojo'":"") :""?>>
                <b>Preferencias del Cliente:</b><br />

                    <?=Utils::replace($reporte->getCaPreferenciasClie())?>

                </td>
        </tr>
        <tr>
            <td  colspan="6" <?=($comparar)? (($reporte->compDato("CaInstrucciones")!=0)?"class='rojo'":"") :""?>>
                <b>Instrucciones Especiales para el Agente:</b>

                <br />
                <?=Utils::replace($reporte->getCaInstrucciones())?></td>
        </tr>
        <tr>
            <td colspan="6" <?=($comparar)? (($reporte->compDato("CaConfirmarClie")!=0)?"class='rojo'":"") :""?> >
                <b>Copiar comunicaciones a:</b><br />

                    <?=str_replace(",", ", ", $reporte->getCaConfirmarClie()) ?>

            </td>
        </tr>
     </table>
</div>

<div id="guias" class="x-hide-display">
    <?
    include_component("reportesNeg", "consultaCorteGuias", array("reporte"=>$reporte, "comparar"=>$comparar));
    ?>
    
</div>

<?
if($reporte->getCaColmas()=="Sí"){
?>
 <div id="aduana" class="x-hide-display">
    
    <?
    include_component("reportesNeg", "consultaAduana", array("reporte"=>$reporte, "comparar"=>$comparar));
    ?>
</div>
<?
}
if($reporte->getCaSeguro()=="Sí"){
?>
 <div id="seguros" class="x-hide-display">
    
    <?
    include_component("reportesNeg", "consultaSeguros", array("reporte"=>$reporte, "comparar"=>$comparar));
    ?>

</div>
<?
}
if($reporte->getCaImpoexpo()==Constantes::EXPO){
?>
 <div id="exportaciones" class="x-hide-display">
    
    <?
    include_component("reportesNeg", "consultaExportaciones", array("reporte"=>$reporte, "comparar"=>$comparar));
    ?>
</div>
<?
}