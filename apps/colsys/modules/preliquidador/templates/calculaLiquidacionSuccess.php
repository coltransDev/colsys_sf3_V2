<?
include_component("widgets", "widgetImpoexpo");
include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetConcepto");

$idConcepto = $sf_data->getRaw("idConcepto");
?>

<div align="center" >
    <br />
    <h3> Preliquidador de Cotizaciones </h3>
    <br />
</div>
<div align="left" id="container"></div>
<script language="javascript">
    var tabs = new Ext.FormPanel({
        labelWidth: 75,
        border:true,
        fame:true,
        deferredRender:false,
        width: 900,
        standardSubmit: true,
        buttonAlign : 'center',
        id: 'formPanel',
        items: {
            xtype: 'tabpanel',
            activeTab: 0,
            defaults:{autoHeight:true, bodyStyle:'padding:10px'},
            id: 'tab-panel',
            items:[{
                    title:'Preliquidador',
                    layout:'form',
                    defaultType: 'textfield',
                    id: 'preliquidador',
                    labelWidth: 75,

                    items: [
                        {
                            xtype:'fieldset',
                            title: 'Parámetros',
                            autoHeight : true,
                            layout : 'column',
                            columns : 2,
                            defaults:{
                                columnWidth:0.5,
                                layout:'form',
                                border:false,
                                bodyStyle:'padding:4px;'
                            },
                            items :
                                [
                                {
                                    xtype:'hidden',
                                    name:"opcion",
                                    value:"liquidar"
                                },
                                {
                                    columnWidth:0.35,
                                    border:false,
                                    items:
                                        [
                                        new WidgetImpoexpo({fieldLabel: 'Impo/Expo',
                                            id: 'impoexpo',
                                            hiddenName: "impoexpo",
                                            value:"<?= $impoexpo ?>",
                                            width:110
                                        }),
                                        new WidgetTransporte({fieldLabel: 'Transporte',
                                            id: 'transporte',
                                            hiddenName: "transporte",
                                            linkTransporte: "transporte",
                                            linkImpoexpo: "impoexpo",
                                            value:"<?= $transporte ?>",
                                            width:80
                                        }),
                                        new WidgetModalidad({fieldLabel: 'Modalidad',
                                            id: 'modalidad',
                                            hiddenName: "modalidad",
                                            linkTransporte: "transporte",
                                            linkImpoexpo: "impoexpo",
                                            value:"<?= $modalidad ?>",
                                            width:150
                                        }),
                                        new WidgetConcepto({fieldLabel: 'Concepto',
                                            id: 'idConcepto',
                                            idconcepto:"concepto",
                                            hiddenName: "idconcepto",
                                            linkTransporte: "transporte",
                                            linkModalidad: "modalidad",
                                            value:"<?= $idConcepto ?>",
                                            hiddenValue:"<?= $idconcepto ?>",
                                            width:200
                                        })
                                    ]
                                },
                                {
                                    columnWidth:0.45,
                                    border:false,
                                    items:
                                        [
                                        new WidgetCiudad({fieldLabel: 'Origen',
                                            id: 'idOrigen',
                                            idciudad:"origen",
                                            hiddenName:"idorigen",
                                            tipo:"3",
                                            // traficoParent:"pais_origen",
                                            linkImpoexpo: "impoexpo",
                                            value:"<?= $idOrigen ?>",
                                            hiddenValue:"<?= $idorigen ?>"
                                        }),
                                        new WidgetCiudad({fieldLabel: 'Destino',
                                            id: 'idDestino',
                                            idciudad:"destino",
                                            hiddenName:"iddestino",
                                            tipo:"3",
                                            //traficoParent:"pais_destino",
                                            linkImpoexpo: "impoexpo",
                                            value:"<?= $idDestino ?>",
                                            hiddenValue:"<?= $iddestino ?>"
                                        }),
                                        new WidgetLinea({fieldLabel: 'Transportista',
                                            linkTransporte: "transporte",
                                            name:"linea",
                                            id:"linea",
                                            hiddenName: "idlinea",
                                            value:"<?= $linea ?>",
                                            width:270
                                        }),
                                        {
                                            xtype:'numberfield',
                                            fieldLabel: 'Cantidad',
                                            name : 'cantidad',
                                            value: '<?= $cantidad ?>',
                                            width:30
                                        }
                                    ]
                                },
                                {
                                    columnWidth:0.20,
                                    border:false,
                                    items:
                                        [
                                        {
                                            xtype:'numberfield',
                                            fieldLabel: 'No.Piezas',
                                            name : 'piezas',
                                            value: '<?= $piezas ?>',
                                            width:30
                                        },
                                        {
                                            xtype:'numberfield',
                                            fieldLabel: 'No.Pallets',
                                            name : 'pallets',
                                            value: '<?= $pallets ?>',
                                            width:30
                                        },
                                        {
                                            xtype:'numberfield',
                                            fieldLabel: 'No.Docs.Transporte',
                                            name : 'cantidadDocs',
                                            value: '<?= $cantidadDocs ?>',
                                            width:30
                                        },
                                        {
                                            xtype:'numberfield',
                                            fieldLabel: 'No.Warehouse',
                                            name : 'cantidadDocs',
                                            value: '<?= $cantidadWH ?>',
                                            width:30
                                        },
                                        {
                                            xtype:'numberfield',
                                            fieldLabel: 'Vlr.Asegurado',
                                            name : 'vlrAsegurado',
                                            value: '<?= $vlrAsegurado ?>',
                                            width:70
                                        }
                                    ]
                                }
                            ]
                        }
                    ]
                }]
        },
        buttons: [
            {
                text: 'Liquidar',
                handler: function(){
                    var tp = Ext.getCmp("tab-panel");
                    var owner=Ext.getCmp("formPanel");
                    if( tp.getActiveTab().getId()=="preliquidador"){
                        owner.getForm().getEl().dom.action='<?= url_for("preliquidador/calculaLiquidacion") ?>';
                    }
                    //alert(Ext.getCmp("incoterms").getValue());
                    owner.getForm().submit();
                }
            }],
        listeners:{afterrender:function(){

                linea_sel='<?= $linea ?>';
                idlinea_sel='<?= $idlinea ?>';
                if(linea_sel!="")
                {
                    Ext.getCmp("linea").setValue(idlinea_sel);
                    $("#linea").val(linea_sel);

                }
            }

        }
    });
    tabs.render("container");
</script>

<?
if ($opcion) {
?>
<table class="tableList" width="900px" border="1" id="mainTable" align="center">
    <?
    foreach ($responseArray as $trayecto){
    ?>
    <tr>
        <th colspan="10">&nbsp;</th>
    </tr>
    <tr>
        <td><b>Impo/Expo:</b></td>
        <td><?=utf8_decode($trayecto["impoexpo"]) ?></td>
        <td><b>Transporte:</b></td>
        <td><?=utf8_decode($trayecto["transporte"]) ?></td>
        <td><b>Modalidad:</b></td>
        <td><?=$trayecto["modalidad"] ?></td>
        <td><b>Frecuencia:</b></td>
        <td><?=utf8_decode($trayecto["frecuencia"]) ?></td>
        <td><b>T/Transito:</b></td>
        <td><?=utf8_decode($trayecto["ttransito"]) ?></td>
    </tr>
    <tr>
        <td colspan="5">
            <b>
            <?=($trayecto["transporte"]=="Aéreo")?"Aerol&iacute;nea":($trayecto["transporte"]=="Marítimo")?"Naviera":"Transportador" ?>: <br />
            </b>
            <?=utf8_decode($trayecto["linea"]) ?>
        </td>
        <td colspan="5">
            <b>Agente :</b>
            <?=utf8_decode($trayecto["agente"]) ?>
        </td>
    </tr>
    <tr>
        <td colspan="10">
            <b>Observaciones: <br /></b>
            <?=utf8_decode($trayecto["observaciones"]) ?>
        </td>
    </tr>
    <tr>
        <td colspan="5" valign="top">
            <b>Fletes: <br /></b>
            <table class="tableList" width="445px" border="1" id="mainTable" align="center">
            <tr valign="top">
                <td>Concepto:</td>
                <td>Sugerido:</td>
                <td>Valor:</td>
                <td>Vigencia:</td>
            </tr>
            <?
            $array_totales = array();
            $fletes = $trayecto["fletes"];
            $transporte = utf8_decode($trayecto["transporte"]);
            foreach($fletes as $flete){
                $flete_sugerido = round($flete["vlrsugerido"]*$cantidad,2);
                $array_totales[$flete["idmoneda"]]+= $flete_sugerido;
                ?>
                <tr valign="top">
                    <td><?=$flete["concepto"] ?></td>
                    <td><?=Utils::formatNumber($flete["vlrsugerido"])." ".$flete["idmoneda"]." ".$flete["aplicacion"] ?></td>
                    <td><?=Utils::formatNumber($flete_sugerido)." ".$flete["idmoneda"] ?></td>
                    <td><?="Desde: ".$flete["fchinicio"]."<br />Hasta: ".$flete["fchvencimiento"] ?></td>
                </tr>
                <?
            }
            ?>
            </table>
        </td>
        <td colspan="5" rowspan="2" valign="top">
            <b>Recargos en Origen: <br /></b>
            <table class="tableList" width="445px" border="1" id="mainTable" align="center">
            <tr valign="top">
                <td>Recargo:</td>
                <td>Base:</td>
                <td>Valor:</td>
                <td>Vigencia:</td>
            </tr>
            <?
            $recargos = $trayecto["recargos"];
            foreach($recargos as $recargo){
                ?>
                <tr valign="top">
                    <td><?=$recargo["recargo"] ?></td>
                    <td><?=Utils::formatNumber($recargo["vlrrecargo"])." ".$recargo["idmoneda"]." ".$recargo["aplicacion"].(($recargo["vlrminimo"])?"/ Min. ".Utils::formatNumber($recargo["vlrminimo"])." ".$recargo["idmoneda"]." ".$recargo["aplicacionmin"]:""); ?></td>
                    <?
                        $recargo_liq = 0;
                        $cantidadDocs = $cantidadDocs?$cantidadDocs:1;
                        $cantidadWH = $cantidadWH?$cantidadWH:1;
                        $cantidad = $cantidad?$cantidad:1;
                        $piezas = $piezas?$piezas:1;
                        $pallets = $pallets?$pallets:1;
                        
                        if (!$recargo["aplicacion"] or $recargo["aplicacion"] == "Valor Fijo" or $recargo["aplicacion"] == "x Embarque"){
                            $recargo_liq = $recargo["vlrrecargo"];
                        }else if ($recargo["aplicacion"] == "x HAWB" or $recargo["aplicacion"] == "x HBL"){
                            $recargo_liq = round($recargo["vlrrecargo"]*$cantidadDocs,2);
                        }else if ($recargo["aplicacion"] == "x Warehouse"){
                            $recargo_liq = round($recargo["vlrrecargo"]*$cantidadWH,2);
                        }else if ($recargo["aplicacion"] == "% Sobre Flete"){
                            $recargo_liq = round($flete_sugerido*$recargo["vlrrecargo"]/100,2);
                        }else if ( ($transporte == "Aéreo" and $recargo["aplicacion"] == "x Kg ó 6 Dm³") or ($transporte == "Marítimo" and $recargo["aplicacion"] == "x T/M³") or ($transporte == "Marítimo" and $recargo["aplicacion"] == "x Contenedor") ) {
                            $recargo_liq = round($recargo["vlrrecargo"]*$cantidad,2);
                        }else if ($transporte == "Marítimo" and $recargo["aplicacion"] == "x TEU") {
                            $recargo_liq = round($flete_sugerido*$flete["liminferior"]*$cantidad/20,2);
                        }else if ($recargo["aplicacion"] == "x Pieza"){
                            $recargo_liq = round($recargo["vlrrecargo"]*$piezas,2);
                        }else if ($recargo["aplicacion"] == "x Pallet"){
                            $recargo_liq = round($recargo["vlrrecargo"]*$pallets,2);
                        }
                        $aplicacionmin = "";
                        if ((!$recargo["aplicacionmin"] or $recargo["aplicacionmin"] == "x HAWB" or $recargo["aplicacionmin"] == "x HBL") and $recargo_liq < $recargo["vlrminimo"]){
                            $recargo_liq = $recargo["vlrminimo"];
                        }
                        $array_totales[$recargo["idmoneda"]]+= $recargo_liq;
                    ?>
                    <td><?=Utils::formatNumber($recargo_liq,2)." ".$recargo["idmoneda"] ?></td>
                   
                    <td><?="Desde: ".$recargo["fchinicio"]."<br />Hasta: ".$recargo["fchvencimiento"] ?></td>
                    <?
                        if ($recargo["observaciones"]){
                            ?>
                            </tr>
                            <tr>
                                <td colspan="4"><b>Observacion : </b><?=$recargo["observaciones"] ?></td>
                            <?
                        }
                    ?>
                </tr>
                <?
            }
            ?>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="5" valign="top">
            <b>Recargos Locales: <br /></b>
            <table class="tableList" width="445px" border="1" id="mainTable" align="center">
            <tr valign="top">
                <td>Recargo:</td>
                <td>Base:</td>
                <td>Valor:</td>
                <td>Vigencia:</td>
            </tr>
            <?
            $recargos = $trayecto["locales"];
            foreach($recargos as $recargo){
                ?>
                <tr valign="top">
                    <td><?=$recargo["recargo"] ?></td>
                    <td><?=Utils::formatNumber($recargo["vlrrecargo"])." ".$recargo["idmoneda"]." ".$recargo["aplicacion"].(($recargo["vlrminimo"])?"/ Min. ".Utils::formatNumber($recargo["vlrminimo"])." ".$recargo["idmoneda"]." ".$recargo["aplicacionmin"]:""); ?></td>
                    <?
                        $recargo_liq = 0;
                        $cantidadDocs = $cantidadDocs?$cantidadDocs:1;
                        $cantidadWH = $cantidadWH?$cantidadWH:1;
                        $cantidad = $cantidad?$cantidad:1;
                        $piezas = $piezas?$piezas:1;
                        $pallets = $pallets?$pallets:1;

                        if ($recargo["aplicacion"] == "Valor Fijo" or $recargo["aplicacion"] == "x Embarque"){
                            $recargo_liq = $recargo["vlrrecargo"];
                        }else if ($recargo["aplicacion"] == "x HAWB" or $recargo["aplicacion"] == "x HBL"){
                            $recargo_liq = round($recargo["vlrrecargo"]*$cantidadDocs,2);
                        }else if ($recargo["aplicacion"] == "x Warehouse"){
                            $recargo_liq = round($recargo["vlrrecargo"]*$cantidadWH,2);
                        }else if ($recargo["aplicacion"] == "% Sobre Flete"){
                            $recargo_liq = round($flete_sugerido*$recargo["vlrrecargo"]/100,2);
                        }else if ( ($transporte == "Aéreo" and $recargo["aplicacion"] == "x Kg ó 6 Dm³") or ($transporte == "Marítimo" and $recargo["aplicacion"] == "x T/M³") or ($transporte == "Marítimo" and $recargo["aplicacion"] == "x Contenedor") ) {
                            $recargo_liq = round($recargo["vlrrecargo"]*$cantidad,2);
                        }else if ($transporte == "Marítimo" and $recargo["aplicacion"] == "x TEU") {
                            $recargo_liq = round($flete_sugerido*$flete["liminferior"]*$cantidad/20,2);
                        }else if ($recargo["aplicacion"] == "x Pieza"){
                            $recargo_liq = round($recargo["vlrrecargo"]*$piezas,2);
                        }else if ($recargo["aplicacion"] == "x Pallet"){
                            $recargo_liq = round($recargo["vlrrecargo"]*$pallets,2);
                        }
                        $aplicacionmin = "";
                        if ((!$recargo["aplicacionmin"] or $recargo["aplicacionmin"] == "x HAWB" or $recargo["aplicacionmin"] == "x HBL") and $recargo_liq < $recargo["vlrminimo"]){
                            $recargo_liq = $recargo["vlrminimo"];
                        }
                        $array_totales[$recargo["idmoneda"]]+= $recargo_liq;
                    ?>
                    <td><?=Utils::formatNumber($recargo_liq,2)." ".$recargo["idmoneda"] ?></td>

                    <td><?="Desde: ".$recargo["fchinicio"]."<br />Hasta: ".$recargo["fchvencimiento"] ?></td>
                    <?
                        if ($recargo["observaciones"]){
                            ?>
                            </tr>
                            <tr>
                                <td colspan="4"><b>Observacion : </b><?=$recargo["observaciones"] ?></td>
                            <?
                        }
                    ?>
                </tr>
                <?
            }
            ?>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="5" valign="top">
            <b>Seguro: <br /></b>
            <table class="tableList" width="445px" border="1" id="mainTable" align="center">
            <tr valign="top">
                <td>Vlr. Prima:</td>
                <td>Vlr. Seguro:</td>
                <td>Obtencion Poliza:</td>
                <td>Observaciones:</td>
            </tr>
            <?
            $seguros = $trayecto["seguros"];
            foreach($seguros as $seguro){
                $vlrAsegurado = $vlrAsegurado?$vlrAsegurado:0;
                $vlrseguro = round($vlrAsegurado*$seguro["vlrprima"]/100,2);
                if ($vlrseguro == 0){
                    continue;
                }
                ?>
                <tr valign="top">
                    <td><?=Utils::formatNumber($seguro["vlrprima"],2) ?> %</td>
                    <td><?=Utils::formatNumber($vlrseguro,2)." ".$seguro["idmoneda"] ?></td>
                    <td><?=Utils::formatNumber($seguro["vlrobtencionpoliza"],2)." ".$seguro["idmonedaobtencion"] ?></td>
                    <td><?=$seguro["observaciones"] ?></td>
                </tr>
                <?
                $array_totales[$seguro["idmoneda"]]+= $vlrseguro;
                $array_totales[$seguro["idmonedaobtencion"]]+= $seguro["vlrobtencionpoliza"];
            }
            ?>
            </table>
        </td>

        <td colspan="5" valign="top" align="right">
            
            <table class="tableList" width="200px" border="1" id="mainTable" align="right">
            <tr valign="top">
                <th colspan="2"><b>Totales por Moneda:</b></th>
            </tr>
            <?
            foreach($array_totales as $key => $total){
                if ($total == 0){
                    continue;
                }
                ?>
                <tr valign="top">
                    <td align="right"><?=$key ?></td>
                    <td align="right"><?=Utils::formatNumber($total,2) ?></td>
                </tr>
                <?
            }
            ?>
            </table>
        </td>
    </tr>
    <?
    }
    ?>

</table>
<?
}
// print_r($responseArray);
?>
