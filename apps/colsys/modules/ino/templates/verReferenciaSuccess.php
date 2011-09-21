<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


include_component("ino", "mainPanel", array("referencia"=>$referencia));


include_component("widgets", "widgetMoneda");
include_component("widgets", "widgetIds");

?>


<div class="content">  

    <div id="main-panel"></div>
</div>


<div id="general" class="x-hide-display">

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
            </td>
            <td><b>Agente</b></td>
            <td>
                <? //=$trayecto->getCaModalidad()?>
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
                <td width="50%">&nbsp;</td>
            </tr>
            </tbody>
        </table>

</div>


<div id="balance" class="x-hide-display">
<?
include_component("ino", "balanceReferencia", array("referencia"=>$referencia));
?>
</div>







<script type="text/javascript">
    var mainPanel = new MainPanel({
        modo: '<?=$modo->getCaIdmodo()?>',
        impoexpo: '<?=$modo->getCaImpoexpo()?>',
        transporte: '<?=$modo->getCaTransporte()?>'
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