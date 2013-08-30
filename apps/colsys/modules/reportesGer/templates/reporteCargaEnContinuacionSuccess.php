<?
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetLinea");
//include_component("widgets", "widgetIncoterms");
include_component("widgets", "widgetMultiIncoterms");
include_component("widgets", "widgetCliente");
include_component("widgets", "widgetSucursales");
$cliente = $sf_data->getRaw("cliente");
$linea = $sf_data->getRaw("linea");
$sucursal = $sf_data->getRaw("sucursal");
$incoterms = $sf_data->getRaw("incoterms");
//print_r($incoterms);
//echo implode(",", $incoterms);
$resul = $sf_data->getRaw("resul");
?>

<div align="center" >
    <br />
    <h3> Reporte de carga en continuaci&oacute;n </h3>
    <br />
</div>
<div align="center" id="container"></div>
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
                    title:'Estadisticas',
                    layout:'form',
                    defaultType: 'textfield',
                    id: 'estadisticas',
                    labelWidth: 75,

                    items: [
                        {
                            xtype:'fieldset',
                            title: 'filtros',
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
                                    value:"buscar"
                                },
                                {
                                    xtype:"hidden",
                                    id: 'impoexpo',
                                    name: 'impoexpo',
                                    value:'<?= Constantes::IMPO ?>'
                                },
                                {
                                    xtype:"hidden",
                                    id: 'transporte',
                                    name: 'transporte',
                                    value:'<?= Constantes::MARITIMO ?>'
                                },
                                {
                                    columnWidth:0.5,
                                    border:false,
                                    items:
                                        [
                                        /*{
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha Emb Ini',
                                            name : 'fechaEmbInicial',
                                            format: 'Y-m-d',
                                            value: '<?= $fechaembinicial ?>'
                                        },*/
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha Arribo Ini',
                                            name : 'fechaArrInicial',
                                            format: 'Y-m-d',
                                            value: '<?= $fechaarrinicial ?>'
                                        }/*,
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha Ini',
                                            name : 'fechaInicial',
                                            format: 'Y-m-d',
                                            value: '<?= $fechainicial ?>'
                                        }*/
                                        ,
                                        new WidgetModalidad({fieldLabel: 'Modalidad',
                                            id: 'modalidad',
                                            hiddenName: "idmodalidad",
                                            linkTransporte: "transporte",
                                            linkImpoexpo: "impoexpo",
                                            value:"<?= $idmodalidad ?>"
                                        })
                                        ,
                                        new WidgetCiudad({fieldLabel: 'origen',
                                            id: 'origen',
                                            idciudad:"origen",
                                            hiddenName:"idorigen",
                                            value:"<?= $origen ?>",                                            
                                            hiddenValue:"<?= $idorigen ?>"
                                        }),
                                        new WidgetCliente({fieldLabel: 'Cliente',
                                            id:"Cliente",
                                            hiddenName:"idcliente",
                                            width:300,
                                            value:"<?= $cliente ?>",
                                            hiddenValue:"<?= $idcliente ?>"
                                                      
                                        }),
                                        new WidgetMultiIncoterms({title: 'Terminos',
                                            fieldLabel:"Incoterms",
                                            id: 'incoterms',
                                            name: 'incoterms[]',
                                            width:230,
                                            value:'<?= implode(",", $incoterms) ?>'
                                        })
                                    ]
                                },
                                {
                                    columnWidth:0.5,
                                    border:false,
                                    items:
                                        [
                                        /*{
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha Emb fin',
                                            name : 'fechaEmbFinal',
                                            format: 'Y-m-d',
                                            value: '<?= $fechaembfinal ?>'
                                        },*/
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha Arribo fin',
                                            name : 'fechaArrFinal',
                                            format: 'Y-m-d',
                                            value: '<?= $fechaarrfinal ?>'
                                        },
                                        /*{
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha final',
                                            name : 'fechaFinal',
                                            format: 'Y-m-d',
                                            value: '<?= $fechafinal ?>'
                                        },*/
                                        new WidgetLinea({fieldLabel: 'Naviera',
                                            linkTransporte: "transporte",
                                            name:"linea",
                                            id:"linea",
                                            hiddenName: "idlinea",
                                            value:"<?= $idlinea ?>",
                                            width:300
                                        }),
                                        new WidgetCiudad({fieldLabel: 'destino',
                                            id: 'destino',
                                            idciudad:"destino",
                                            hiddenName:"iddestino",
                                            value:"<?= $destino ?>",
                                            hiddenValue:"<?= $iddestino ?>"
                                        }),
                                        new WidgetSucursales({fieldLabel: 'Sucursal',
                                            id:"sucursal",
                                            name:"sucursal",
                                            hiddenName:"idsucursal",
                                            width:120,
                                            value:"<?= $sucursal ?>",
                                            hiddenValue:"<?= $sucursal ?>"
                                        })
                                    ]
                                }
                            ]
                        }
                    ]
                }]
        },
        buttons: [
            {
                text: 'Continuar',
                handler: function(){
                    var tp = Ext.getCmp("tab-panel");                    
                    var owner=Ext.getCmp("formPanel");
                    if( tp.getActiveTab().getId()=="estadisticas"){
                        owner.getForm().getEl().dom.action='<?= url_for("reportesGer/reporteCargaEnContinuacion") ?>';
                    }
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
                agente_sel='<?= $agente ?>';
                idagente_sel='<?= $idagente ?>';
                if(agente_sel!="")
                {
                    Ext.getCmp("agente").setValue(idagente_sel);
                    $("#agente").val(agente_sel);
                }
                suc_agente_sel='<?= $sucursalagente ?>';
                idsucagente_sel='<?= $idsucursalagente ?>';
                if(suc_agente_sel!="")
                {
                    Ext.getCmp("sucursalagente").setValue(idsucagente_sel);
                    $("#sucursalagente").val(suc_agente_sel);
                }
            }
        }
    });
    tabs.render("container");
</script>
<?
    if ($opcion) {
?>

        <div align="center">
            <br>
            <h3>Estadisticas de cargas  <br>
<?
        /*if ($fechainicial && $fechafinal) {
            echo " fechas de Creacion referencia: " . $fechainicial . " - " . $fechafinal;
        }
        if ($fechaembinicial && $fechaembfinal) {
            echo " fechas de Embarque: " . $fechaembinicial . " - " . $fechaembfinal;
        }*/
        if ($fechaarrinicial && $fechaarrfinal) {
            echo " fechas de Arribo: " . $fechaarrinicial . " - " . $fechaarrfinal;
        }
        if ($idmodalidad) {
            echo " modalidad: " . $idmodalidad . " - ";
        }
        if ($origen) {
            echo " origen: " . $origen . " - ";
        }
        if ($destino) {
            echo " destino: " . $destino . " - ";
        }
        if ($incoterms) {
            echo "<br>Incoterms: " . implode(",", $incoterms) . " - ";
        }
?>
    </h3>
    <br />
    <br />
</div>
<table class="tableList" width="900px" border="1" id="mainTable" align="center">
    <tr>
        <td>No</td>
        <td>Fecha<br>Embarque</td>
        <td>Fecha<br>Arribo</td>
        <td>Fecha<br>Referencia</td>
        <td>Referencia</td>
        <td>Origen</td>
        <td>Destino</td>
        <td>Destino Final</td>
        <td>Cliente</td>
        <td>Doc.Transporte</td>
        <td>No. DTM</td>
        <td>Piezas</td>
        <td>Peso</td>
        <td>Volumen</td>
        <td>Rep.Negocio</td>
        <td>Bodega</td>
        <td>Operador</td>
        <td>Seguro</td>
        <td>Colmas</td>
        <td>Sucursal</td>
    </tr>
<?
        $ref = "";
        $tvolumen = 0;
        $tpiezas = 0;
        $tpeso = 0;
        $teus = 0;

        $nreferencias = 0;
        $nhbls = 0;
        $nitem = 1;
        $totales = array();
        foreach ($resul as $r) {
            $teus+=$r["teus"];
            $totales["modalidad"][$r["ca_modalidad"]]["origen"][$r["ori_ca_nombre"]]+=$r["teus"];
            $totales["modalidad"][$r["ca_modalidad"]]["destino"][$r["des_ca_ciudad"]]+=$r["teus"];
            /*if ($r["ca_referencia"] == $ref) {
                $volumen = "";
                $piezas = "";
                $peso = "";
            } else*/ {

                $tvolumen+=$r["volumen"];
                $volumen = number_format($r["volumen"], 2);
                $tpiezas+=$r["piezas"];
                $piezas = number_format($r["piezas"], 0);
                $tpeso+=$r["peso"];
                $peso = number_format($r["peso"], 2);
                $nreferencias++;
                $arrtmp = explode("-", $r["ca_fchreferencia"]);
                //print_r($arrtmp);
                //echo $arrtmp[4]."-";
            }
            $nhbls+=$r["nhbls"];
            $totales["años"][$arrtmp[0]][$arrtmp[1]]["volumen"]+=$volumen;
            $totales["años"][$arrtmp[0]][$arrtmp[1]]["teus"]+=$r["teus"];
?>
            <tr>
                <td><?= $nitem++ ?></td>
                <td><?= $r["ca_fchembarque"] ?></td>
                <td><?= $r["ca_fcharribo"] ?></td>
                <td><?= $r["ca_fchreferencia"] ?></td>
                <td><a href="/colsys_php/inosea.php?boton=Consultar&id=<?= $r["ca_referencia"] ?>" target="_blank"><?= $r["ca_referencia"] ?></td>
                <td><?= $r["ori_ca_ciudad"] ?></td>
                <td><?= $r["des_ca_ciudad"] ?></td>
                <td><?= $r["desfin_ca_ciudad"] ?></td>                
                <td><?= $r["ca_compania"] ?></td>
                <td><?= $r["ca_hbls"] ?></td>
                <td><?= $r["nodtm"] ?></td>
                <td align="right"><?= $piezas ?></td>
                <td align="right"><?= $peso ?></td>
                <td align="right"><?= $volumen ?></td>
                <td><?= $r["ca_consecutivo"] ?></td>
                <td><?= $r["ca_bodega"] ?></td>
                <td><?= $r["ca_operador"] ?></td>
                <td><?= $r["ca_seguro"] ?></td>
                <td><?= $r["ca_colmas"] ?></td>
                <td><?= $r["ca_sucursal"] ?></td>
            </tr>
<?
            $ref = $r["ca_referencia"];
        }
?>
            <tr><td><br><br><br></td></tr>
<?
        foreach ($resul2 as $r) {
            $tvolumen+=$r["ca_volumen"];
            $volumen = number_format($r["ca_volumen"], 2);
            $tpiezas+=$r["ca_numpiezas"];
            $piezas = number_format($r["ca_numpiezas"], 0);
            $tpeso+=$r["ca_peso"];
            $peso = number_format($r["ca_peso"], 2);
?>
            <tr>
                <td><?= $nitem++ ?></td>
                <td><?= $r["ca_fchembarque"] ?></td>
                <td><?= $r["ca_fcharribo"] ?></td>
                <td><?= $r["ca_fchreferencia"] ?></td>
                <td><a href="/colsys_php/inosea.php?boton=Consultar&id=<?= $r["ca_referencia"] ?>" target="_blank"><?= $r["ca_referencia"] ?></td>
                <td><?= $r["ca_ciuorigen"] ?></td>
                <td><?= $r["ca_ciudestino"] ?></td>
                <td><?= $r["desfin_ca_ciudad"] ?></td>                
                <td><?= $r["ca_compania"] ?></td>
                <td><?= $r["ca_hbls"] ?></td>
                <td align="right"><?= $piezas ?></td>
                <td align="right"><?= $peso ?></td>
                <td align="right"><?= $volumen ?></td>
                <td><?= $r["ca_consecutivo"] ?></td>
                <td><?= $r["ca_bodega"] ?></td>
                <td><?= $r["ca_operador"] ?></td>
                <td><?= $r["ca_seguro"] ?></td>
                <td><?= $r["ca_colmas"] ?></td>
                <td><?= $r["ca_sucursal"] ?></td>
            </tr>
<?
            
        }
?>
        <tr><td colspan="10"><b>Totales</b></td>
            <td align="right"><b><?= number_format($tpiezas, 0) ?></b></td><td align="right"><b><?= number_format($tpeso, 2) ?></b></td><td align="right"><b><?= number_format($tvolumen, 2) ?></b></td>
            <td colspan="6">&nbsp;</td>
        </tr>
    </table>
                                <?
                            }
                                ?>
<script>
    //Ext.getCmp('incoterms').mode="local";
    //Ext.getCmp('incoterms').onStoreLoad();
    //Ext.getCmp('incoterms').setValue('<?= implode(",", $incoterms) ?>');
            //Ext.getCmp('incoterms').setValue('<?= implode(",", $incoterms) ?>');</script>