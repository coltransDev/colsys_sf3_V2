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
            <td width="90"  ><div align="center" class="help" id="fchreporte"><span ><b>Fecha</b></span><br />
                            <?=Utils::fechaMes($reporte->getCaFchreporte())?>
            </div></td>
            <td width="107" ><div align="center" class="help" id="versiones"><b>Versi&oacute;n No.</b>:<br />
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

include_component("reportesNeg","infoReporte", array("reporte"=>$reporte, "grupoReportes"=>$grupoReportes));

include_component("reportesNeg","mainPanel");
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


if( $reporte->getCaColmas()=="Sí" || substr($reporte->getCaModalidad(),0,6) == "ADUANA" ){
   include_component("reportesNeg","panelRecargosAduana", array("reporte"=>$reporte));
//   include_component("cotizaciones","panelTarifarioAduana",array("cotizacion"=>$cotizacion));
   $panelAduana = true;
}else{
   $panelAduana = false;
}
?>
<script language="javascript">
   Ext.onReady(function(){
/*      window.alert = function(texto,titulo)
     {
        titulo=(titulo!="undefined")?titulo:'Alerta';
        Ext.MessageBox.alert(titulo, texto );
     }
*/
   });

    var anularReporte = function(btn, text){
        if( btn == "ok"){
            if( text.trim()==""){
                alert("Debe colocar un motivo");
            }else{
                Ext.Ajax.request(
                {
                    waitMsg: 'Anulando...',
                    url: '<?=url_for("reportesNeg/anularReporte?id=".$reporte->getCaIdreporte())?>',
                    //method: 'POST',
                    //Solamente se envian los cambios
                    params :	{
                        motivo: text.trim()
                    },
                    //Ejecuta esta accion cuando el resultado es exitoso
                    callback :function(options, success, response){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){
                            document.location="<?=url_for("reportesNeg/verReporte?id=".$reporte->getCaIdreporte())?>";
                        }
                    }
                 }
            );
            }
        }
    };

    var ventanaAnularReporte = function(){
        Ext.MessageBox.show({
           title: 'Anular Reporte',
           msg: 'por favor coloque el motivo por el que anula el reporte:',
           width:300,
           buttons: Ext.MessageBox.OKCANCEL,
           multiline: true,
           fn: anularReporte,
           animEl: 'anular-reporte',
           modal: true
       });


    }

    //tabpanel.render('panel-info');
    //tabpanel.setWidth(Ext.getBody().getWidth()-250);



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


    var importarConceptosFletes = function(){
        panelFletes.importarCotizacion();
    }

    var importarRecargosLocales = function(){
        panelRecargosLocales.importarCotizacion();
    }

    var importarRecargosAduanas = function(){
        panelRecargosAduana.importarCotizacion();
    }


    <?
    if( $panelConceptosFletes ){
    ?>
        var panelFletes = new PanelConceptosFletes({
            title: 'Conceptos de fletes',
            id:'panel-Fletes'
            <?
            if( $editable ){
            ?>
            ,tbar: [
                {
                    text:'Guardar',
                    iconCls: 'disk',
                    scope:this,
                    handler: guardarCambios
                }
                <?
                if( $reporte->getCaIdproducto() ){
                ?>
                ,
                '-',

                 {
                    text:'Importar Cotizacion',
                    iconCls: 'import',
                    scope:this,
                    handler: importarConceptosFletes
                }
                <?
                }
                ?>
            ]
            <?
            }
            ?>
        });
    <?
    }
    if( $panelRecargos ){
    ?>
        var panelRecargosLocales = new PanelRecargos({
            title: 'Recargos locales',
            id:'panel-RecargosLocales'
            <?
            if( $editable ){
            ?>
            ,
            tbar: [
                {
                    text:'Guardar',
                    iconCls: 'disk',
                    scope:this,
                    handler: guardarCambios
                }
                <?
                if( $reporte->getCaIdcotizacion() ){
                ?>
                ,
                '-',
                 {
                    text:'Importar Cotizacion',
                    iconCls: 'import',
                    scope:this,
                    handler: importarRecargosLocales
                }
                <?
                }
                ?>
            ]
            <?
            }
            ?>
        });
    <?
    }
    if( $panelAduana ){
        ?>
        var panelRecargosAduana = new PanelRecargosAduana({
            title: 'Recargos Aduana',
            id:'panel-Recargos-Aduana'
            <?
            if( $editable ){
            ?>
            ,
            tbar: [
                {
                    text:'Guardar',
                    iconCls: 'disk',
                    scope:this,
                    handler: guardarCambios
                }
                <?
                /*if( $reporte->getCaIdcotizacion() ){
                ?>
                ,
                '-',

                 {
                    text:'Importar de la Cotizacion',
                    iconCls: 'import',
                    scope:this,
                    handler: importarRecargosAduanas
                }
                <?
                }*/
                ?>
                ]
            <?
            }
            ?>
        });
        <?
    }
    ?>



      var bodyStyle = 'padding: 5px 5px 5px 5px;';

      var mainPanel = new MainPanel({
                            activeTab: 0,
                            id:"panelMainReporte",
                            items: [
                                    {contentEl:'trayecto', title: 'Trayecto', bodyStyle: bodyStyle},
                                    {contentEl:'cliente', title: 'Cliente', bodyStyle: bodyStyle},
                                    {contentEl:'facturacion', title: 'Facturación', bodyStyle: bodyStyle},
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
                                    if( !$reporte->esSoloAduana() ){
                                    ?>
                                    {contentEl:'guias', title: 'Corte de Documentos', bodyStyle: bodyStyle},
                                    <?
                                    }
                                    if($reporte->getCaImpoexpo()==Constantes::EXPO){
                                    ?>
                                    {contentEl:'exportaciones', title: 'Exportaciones', bodyStyle: bodyStyle},
                                    <?
                                    }

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
//      mainPanel.render("panel");
//      mainPanel.setWidth(Ext.getBody().getWidth()-250);


      var panel = new Ext.FormPanel({
        title: "Reportes de Negocio",
        id:"panel-Form-Reporte",
        items: [
            {contentEl:'header'},
            mainPanel,
            {contentEl:'footer'}
        ]
      });
      panel.render("panel");
</script>

<?
include_component("kbase","tooltipById", array("idcategory"=>18));
if( $opcion=="ayudas" ){
    include_component("kbase","tooltipCreator", array("idcategory"=>18));
}
?>