<?


?>

<div class="content" >
    <div id="panel"></div> 
</div>



<div id="header" class="x-hide-display">
    <table cellspacing="1" width="100%" class="tableList">        
        <tr>

            <td width="122" >
                <div align="center">
                      <b>Reporte No.:</b><br />
                       <?=$reporte->getCaConsecutivo()?>
                </div>
            </td>
            <td width="90"  ><div align="center"><span ><b>Fecha</b></span><br />
                            <?=Utils::fechaMes($reporte->getCaFchreporte())?>
            </div></td>
            <td width="107" ><div align="center"><b>Versi&oacute;n No.</b>:<br />
                            <?=$reporte->getCaVersion()."/".$reporte->numVersiones()?>
            </div></td>
            <td width="85" >
                  <div align="left">
                      <b>Cotizaci&oacute;n</b>
                      <br />
                        <?=$reporte->getCaIdcotizacion()?>
                   </div>
            </td>
            <td width="173" >&nbsp;</td>
            <?
        /*$cotProducto = $reporte->getCotProducto();
        if( $cotProducto ){

            $id_cotizacion = $cotProducto->getCaIdcotizacion();
        }else{

            $id_cotizacion = null;
        }*/
        ?>
            
        </tr>


   </table>

</div>


<div id="footer" class="x-hide-display">
    <?
    $usuario = $reporte->getUsuario();
    $sucursal = $usuario->getSucursal();
    ?>
    <table cellspacing="0" width="100%" class="tableList alignLeft">
        <tbody>
            <tr class="row0">
                <td width="25%" ><b>Ciudad :</b><br />
                        <?=$sucursal?$sucursal->getCaNombre():""?>
                        </td>
                <td width="25%">
                    <div align="left">
                        <b>Elaborado por:</b><br />
                        <?=$reporte->getCaUsucreado()?> <?=UTils::fechaMes($reporte->getCaFchcreado())?>
                    </div>
                </td>
                <td width="25%">
                    <div align="left">
                        <b>Actualizado por:</b><br />
                        <?=$reporte->getCaUsuactualizado()?$reporte->getCaUsuactualizado():"&nbsp;"?> <?=UTils::fechaMes( $reporte->getCaFchactualizado() )?>
                    </div>
                </td>
                <td width="25%">
                    <div align="left">
                        <b>Rep. Comercial:</b><br />
                        <?=$usuario->getCaNombre()?>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

</div>



<?
include_component("reportesNeg","infoReporte", array("reporte"=>$reporte));

include_component("reportesNeg","mainPanel", array("reporte"=>$reporte));
if( !$reporte->esSoloAduana() ){
    include_component("reportesNeg","panelConceptosFletes", array("reporte"=>$reporte));
    $panelConceptosFletes = true;
    if( $reporte->getCaImpoexpo()!=Constantes::EXPO ){
        include_component("reportesNeg","panelRecargos", array("reporte"=>$reporte));
        $panelRecargos = true;
    }else{
        $panelRecargos = false;
    }
}else{
    $panelConceptosFletes = false;
    $panelRecargos = false;
}

if( $reporte->getCaColmas()=="Sí" || $reporte->getCaTransporte() == Constantes::ADUANA ){
    include_component("reportesNeg","panelRecargosAduana", array("reporte"=>$reporte));
    $panelAduana = true;
}else{
    $panelAduana = false;
}

?>
<script language="javascript">


   

    //tabpanel.render('panel-info');
    //tabpanel.setWidth(Ext.getBody().getWidth()-250);


    tbarObj = [{
            text:'Guardar',
            iconCls: 'disk',
            scope:this,
            handler: guardarCambios
        },
        '-'
        /*,
        {
            text:'Importar Cotizacion',
            iconCls: 'import',
            scope:this,
            handler: guardarCambios
        },
        {
            text:'Importar del tarifario',
            iconCls: 'import',
            scope:this,
            handler: guardarCambios
        }*/

      ]
    var guardarCambios = function(){
        <?
        if( $panelConceptosFletes ){
        ?>
            panelFletes.guardarCambios();
        <?
        }
        if( $panelRecargos ){
        ?>
            panelRecargosLocales.guardarCambios();
        <?
        }
        if( $panelAduana ){
        ?>
            panelRecargosAduana.guardarCambios();
        <?
        }
    ?>
    }

    <?
    if( $panelConceptosFletes ){
    ?>
        var panelFletes = new PanelConceptosFletes({
            title: 'Conceptos de fletes',
            tbar: tbarObj
        });
    <?
    }
    if( $panelRecargos ){
    ?>
        var panelRecargosLocales = new PanelRecargos({
            title: 'Recargos locales',
            tbar: tbarObj
        });
    <?
    }
    if( $panelAduana ){
        ?>
        var panelRecargosAduana = new PanelRecargosAduana({
            title: 'Recargos Aduana',
            tbar: tbarObj
        });
        <?
    }
    ?>

      

      var bodyStyle = 'padding: 5px 5px 5px 5px;';

      var mainPanel = new MainPanel({                                                        
                            items: [
                                    {contentEl:'trayecto', title: 'Trayecto', bodyStyle: bodyStyle},
                                    {contentEl:'cliente', title: 'Cliente', bodyStyle: bodyStyle},
                                    {contentEl:'preferencias', title: 'Preferencias', bodyStyle: bodyStyle},
                                    <?
                                    if($reporte->getCaColmas()=="Sí"){
                                    ?>
                                    {contentEl:'aduana', title: 'Aduana', bodyStyle: bodyStyle},
                                    <?
                                    }
                                    if($reporte->getCaSeguro()=="Sí"){
                                    ?>
                                    {contentEl:'seguros', title: 'Seguros', bodyStyle: bodyStyle},
                                    <?
                                    }
                                    ?>
                                    {contentEl:'guias', title: 'Corte de guias', bodyStyle: bodyStyle},
                                    <?
                                    if($reporte->getCaImpoexpo()==Constantes::EXPO){
                                    ?>
                                    {contentEl:'exportaciones', title: 'Exportaciones', bodyStyle: bodyStyle},
                                    <?
                                    }                                    
                                    ?>
                                    <?
                                    $flag = false;
                                    if( $panelConceptosFletes ){
                                    ?>
                                    panelFletes
                                    <?
                                        $flag = true;
                                    }
                                    if( $panelRecargos ){
                                        if( $flag ){
                                            echo ",";
                                        }
                                        $flag = true;
                                    ?>
                                        panelRecargosLocales
                                    <?
                                    }
                                    if( $panelAduana ){
                                        if( $flag ){
                                            echo ",";
                                        }
                                        $flag = true;                                    
                                    ?>
                                        panelRecargosAduana
                                    <?
                                    }
                                    ?>
                                   ]
                            

                      });
      //mainPanel.render("panel");
      //mainPanel.setWidth(Ext.getBody().getWidth()-250);

      
      var panel = new Ext.FormPanel({
        title: "Reportes de Negocio",
        items: [
            {contentEl:'header'},      
            mainPanel,
            {contentEl:'footer'}
        ]
      });

      panel.render("panel");



</script>