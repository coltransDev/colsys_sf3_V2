<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$permisos = $sf_data->getRaw("permisos");
//print_r($permisos);

include_component("inoF", "mainPanel", array("referencia"=>$referencia,"modo"=>$idmodo,"permisos"=>$permisos));
include_component("widgets", "widgetMoneda");
include_component("widgets", "widgetIds");

$readOnly = $referencia->getReadOnly();
?>


<div class="content">  

    <div id="main-panel"></div>
</div>


<div id="general" class="x-display">

    <table class="tableList" width="100%">
        
       
        <?

        ?>
        <tr class="row0">
            <td colspan="4"><b>Datos del trayecto</b></td>
        </tr>
        <tr>
                <td><b>Clase</b></td>
                <td><?=$referencia->getCaImpoexpo()?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><b>Transporte</b></td>
                <td><?=$referencia->getCaTransporte()?></td>
                <td><b>Modalidad</b></td>
                <td><?=$referencia->getCaModalidad()?></td>
            </tr>
        <tr>
            <td><b>Origen:</b></td>
            <td><?=$referencia->getOrigen()->getTrafico()->getCaNombre()?> <?=$referencia->getOrigen()->getCaCiudad()?></td>
            <td><b>Destino:</b></td>
            <td><?=$referencia->getDestino()->getTrafico()->getCaNombre()?> <?=$referencia->getDestino()->getCaCiudad()?></td>

        </tr>

         <tr>
             <td><b>Linea</b></td>
            <td>
               <?=$referencia->getIdsProveedor()->getIds()->getCaNombre()?>                
                <a href="/ids/formEventos/modo/prov/id/<?=$referencia->getCaIdlinea()?>">Eventos</a>                
            </td>
            <td><b>Agente</b></td>
            <td>                
                <?
                if($referencia->getCaIdagente()!="" && $referencia->getCaIdagente()>0)
                {
                ?>
                <?=$referencia->getIdsAgente()->getIds()->getCaNombre()?>
                <a href="/ids/formEventosNew/referencia/<?=$referencia->getCaIdmaster()?>">Eventos</a>
                <? 
                }
                ?>
            </td>

        </tr>
        <tr class="row0">
                <td colspan="4"><b>Datos de la guia</b></td>
            </tr>
        <tr>
            <td><b>Master:</b></td>
            <td>
                <?=$referencia->getCaMaster()?>
            </td>
            <td>&nbsp;</td>
            <td>
                &nbsp;
            </td>
        </tr>  
        
        <?
        if( $referencia->getCaObservaciones() ){
        ?>
        <tr class="row0">
                <td colspan="4"><b>Observaciones</b></td>
            </tr>
        <tr>
            
            <td colspan="4">
                <?=$referencia->getCaObservaciones()?>
            </td>            
        </tr>  
        <?
        }
        ?>
    </table>

</div>

<div id="header" class="x-hide-display">
    <table cellspacing="1" width="100%" class="tableList">
        <tr>

            <td width="25%">
                <div align="center">
                      <b>Referencia:</b><br />
                       <?=$referencia->getCaReferencia()?>
                </div>
            </td>
            <td width="25%">
                <div align="center" class="help" id="fchreporte"><span ><b>Fecha</b></span><br />
                <?=Utils::fechaMes($referencia->getCaFchreferencia())?>
            </div></td>
            <td width="50%">&nbsp;</td>

        </tr>


   </table>

</div>


<div id="footer" class="x-hide-display">
    
    <table cellspacing="0" width="100%" class="tableList alignLeft">
        <tbody>
            <tr class="row0">
                
                <td width="25%">
                    <div align="left">
                        <b>Elaborado por:</b><br />
                        <?=$referencia->getCaUsucreado()?> <?=Utils::fechaMes($referencia->getCaFchcreado())?>
                    </div>
                </td>
                <td width="25%">
                    <div align="left">
                        <b>Actualizado por:</b><br />
                        <?=$referencia->getCaUsuactualizado()?$referencia->getCaUsuactualizado()." ".Utils::fechaMes( $referencia->getCaFchactualizado() ):"&nbsp;"?>
                    </div>
                </td>
                <td width="25%">
                    <div align="left">
                        <?
                        if( $referencia->getCaFchanulado() ){
                            ?>                        
                            <span class="rojo"><b>Anulado por:</b></span>
                            <br />
                            <?=$referencia->getCaUsuanulado()?>/<?=Utils::fechaMes($referencia->getCaFchanulado())?>                            
                            <?
                        }else{
                        ?>
                        
                            <b>Liquidado por:</b><br />
                            <?
                            if($referencia->getCaFchliquidado()){
                            ?>
                            <?=$referencia->getCaUsuliquidado()?>/<?=Utils::fechaMes($referencia->getCaFchliquidado())?>
                            <?
                            if(!$referencia->getCaFchcerrado()){
                                ?>
                                <input type="button" class="button" value="Cancelar liquidación" onclick="document.location='<?=url_for("inoF/cancelarLiquidarCaso?modo=".$modo->getCaIdmodo()."&idmaster=".$referencia->getCaIdmaster())?>'" />
                                <?
                                }
                            }else{
                            ?>
                            El caso no se ha liquidado.
                            <?
                                if($permisos["liquidar"])
                                {
                                ?>
                                <input type="button" class="button" value="Firmar liquidación" onclick="document.location='<?=url_for("inoF/liquidarCaso?modo=".$modo->getCaIdmodo()."&idmaster=".$referencia->getCaIdmaster())?>'" />
                                <?    
                                }
                            }
                        }
                        ?>
                    </div>
                </td>
                <td width="25%">
                    <div align="left">
                        <?
                        if( !$referencia->getCaFchanulado() ){
                            ?>
                            <b>Cerrado por:</b><br />
                           <?
                            if($referencia->getCaFchcerrado() && $permisos["reabrir"]){
                            ?>
                            <?=$referencia->getCaUsucerrado()?>/<?=Utils::fechaMes($referencia->getCaFchcerrado())?>

                            <input type="button" class="button" value="Abrir" onclick="document.location='<?=url_for("inoF/abrirCaso?modo=".$modo->getCaIdmodo()."&idmaster=".$referencia->getCaIdmaster())?>'" />
                            <?
                            }else{
                            ?>
                            El caso se encuentra abierto.
                            <?
                                if($referencia->getCaFchliquidado() && $permisos["cerrar"]){
                                ?>
                                <input type="button" class="button" value="Cerrar" onclick="document.location='<?=url_for("inoF/cerrarCaso?modo=".$modo->getCaIdmodo()."&idmaster=".$referencia->getCaIdmaster())?>'" />
                                <?    
                                }
                            }
                        }else{
                            echo "&nbsp;";
                        }
                        ?>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
</div>

<div id="balance" class="x-hide-display">
<?
include_component("inoF", "balanceReferencia", array("referencia"=>$referencia, "modo"=>$modo->getCaIdmodo()));
?>
</div>

<script type="text/javascript">
    var mainPanel = new MainPanel({
        modo: '<?=$modo->getCaIdmodo()?>',
        impoexpo: '<?=$modo->getCaImpoexpo()?>',
        transporte: '<?=$modo->getCaTransporte()?>',
        modalidad: '<?=$referencia->getCaModalidad()?>',
        readOnly: <?=$readOnly?"true":"false"?>
    });



    var panel = new Ext.FormPanel({
        title: "Sistema de referencias",
        items: [
            {contentEl:'header'},
            mainPanel,
            {contentEl:'footer'}
        ]
      });
     panel.render("main-panel");

</script>