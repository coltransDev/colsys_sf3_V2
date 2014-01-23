<?
include_component("widgets", "widgetImpoexpo");
include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetLinea");
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
                                    value:"liquidar"
                                },
                                {
                                    columnWidth:0.5,
                                    border:false,
                                    items:
                                        [
                                        new WidgetImpoexpo({fieldLabel: 'Impo/Expo',
                                            id: 'impoexpo',
                                            hiddenName: "impoexpo",
                                            value:"",
                                            width:110
                                        }),
                                        new WidgetTransporte({fieldLabel: 'Transporte',
                                            id: 'transporte',
                                            hiddenName: "idtransporte",
                                            linkTransporte: "transporte",
                                            linkImpoexpo: "impoexpo",
                                            value:"",
                                            width:80
                                        }),
                                        new WidgetCiudad({fieldLabel: 'Origen',
                                            id: 'idOrigen',
                                            idciudad:"origen",
                                            hiddenName:"idorigen",
                                            tipo:"3",
                                            // traficoParent:"pais_origen",
                                            linkImpoexpo: "impoexpo",
                                            value:"<?= $origen ?>",
                                            hiddenValue:"<?= $idorigen ?>"
                                        }),
                                        new WidgetCiudad({fieldLabel: 'Destino',
                                            id: 'idDestino',
                                            idciudad:"destino",
                                            hiddenName:"iddestino",
                                            tipo:"3",
                                            //traficoParent:"pais_destino",
                                            linkImpoexpo: "impoexpo",
                                            value:"<?= $destino ?>",
                                            hiddenValue:"<?= $iddestino ?>"
                                        }),
                                        new WidgetModalidad({fieldLabel: 'Modalidad',
                                            id: 'modalidad',
                                            hiddenName: "idmodalidad",
                                            linkTransporte: "transporte",
                                            linkImpoexpo: "impoexpo",
                                            value:"<?= $idmodalidad ?>",
                                            width:150
                                        }),
                                        new WidgetLinea({fieldLabel: 'Transportista',
                                            linkTransporte: "transporte",
                                            name:"linea",
                                            id:"linea",
                                            hiddenName: "idlinea",
                                            value:"<?= $idlinea ?>",
                                            width:300
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
                text: 'Liquidar',
                handler: function(){
                    var tp = Ext.getCmp("tab-panel");                    
                    var owner=Ext.getCmp("formPanel");
                    if( tp.getActiveTab().getId()=="preliquidador"){
                        owner.getForm().getEl().dom.action='<?= url_for("preliquidador/principalOperativa") ?>';
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