<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetTercero");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetComerciales");
include_component("widgets", "widgetSucursales");
include_component("widgets", "widgetMultiDatos");

$nmes = $sf_data->getRaw("nmes");
$meses = $sf_data->getRaw("meses");

$nano = $sf_data->getRaw("nano");
$anos = $sf_data->getRaw("anos");
?>
<script type="text/javascript">
    FiltrosEstadisticasOtm = function(config){
    Ext.apply(this, config);
        FiltrosEstadisticasOtm.superclass.constructor.call(this, {
        //labelAlign: 'top',
        frame:true,
        title: 'Estadísticas OTM',
        bodyStyle:'padding:5px 5px 0',
        width: 1000,
        items: [{
            layout: 'form',
            items: [{
                xtype: 'fieldset',
                title: 'Empresa',
                id:"empresa",
                items: [{
                    xtype: 'radiogroup',
                    itemCls: 'x-check-group-alt',
                    allowBlank: false,
                    style:{
                        textAlign: 'left'
                    },
                    id: 'rg_empresa',
                    items: [
                        {boxLabel: 'COLOTM', name: 'nempresa', inputValue: 1, <?= $nempresa == 1 ? "checked:'true'" : "" ?>},
                        {boxLabel: 'CONSOLCARGO', name: 'nempresa', inputValue: 2, <?= $nempresa == 2 ? "checked:'true'" : "" ?>},
                    ]
                }]
            }]
        },{
            layout: 'form',
            items: [{
                xtype: 'fieldset',
                title: 'Tipo de Informe',
                id:"informe",
                items: [{
                    xtype: 'radiogroup',
                    itemCls: 'x-check-group-alt',
                    allowBlank: false,
                    style:{
                        textAlign: 'left'
                    },                                
                    id: 'tipoinforme',
                    items: [
                        {boxLabel: 'ESTADISTICAS', name: 'tipo', inputValue: 1, <?= $tipo == 1 ? "checked:'true'" : "" ?>},
                        {boxLabel: 'INFORME ASEGURADORA / MIN. TRANSPORTE', name: 'tipo', inputValue: 2, <?= $tipo == 2 ? "checked:'true'" : "" ?>},
                    ],
                    listeners: {
                        change: function(radiogroup, radio) {
                            if (radio.inputValue == 1){
                                Ext.getCmp('fechaInicial').allowBlank = true;
                                Ext.getCmp('fechaFinal').allowBlank = true; 
                                Ext.getCmp('fechaInicial').hide(); 
                                Ext.getCmp('fechaFinal').hide(); 
                                Ext.getCmp('ano').show(); 
                                Ext.getCmp('mes').show(); 
                            } else {
                                Ext.getCmp('ano').allowBlank = true;
                                Ext.getCmp('ano').hide();
                                Ext.getCmp('mes').hide();                                
                                Ext.getCmp('fechaInicial').allowBlank = false;
                                Ext.getCmp('fechaFinal').allowBlank = false;
                                Ext.getCmp('fechaInicial').show();
                                Ext.getCmp('fechaFinal').show();
                            }
                        }
                    }
                }]
            }]
        }, {
            layout: 'form',
            items: [{
                xtype: 'fieldset',
                title: 'Fechas de Corte',
                id:"fch_corte",
                items: [{
                    layout:'column',
                    items:[{
                        columnWidth:.5,
                        layout: 'form',
                        items: [{
                            xtype:'fieldset',
                            labelAlign: 'top',
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            width: 350,
                            style:{
                                textAlign: 'left'
                            },
                            items: [
                                new WidgetMultiDatos({                                    
                                    allowBlank: false,
                                    emptyText: '',                                    
                                    title: 'Ano', fieldLabel: 'Año', id: 'ano', name: 'ano[]', hiddenName: "nano[]",
                                    value:'<?= $nano ? implode(",", $nano) : "" ?>',
                                    listeners:{
                                        render:function(){
                                            if (this.store.data.length == 0){
                                                data =<?= json_encode(array("root" => $anos, "total" => count($anos), "success" => true)) ?>;
                                                this.store.loadData(data);
                                            }
                                        },
                                        focus:function(){
                                            if (this.store.data.length == 0){
                                                data =<?= json_encode(array("root" => $anos, "total" => count($anos), "success" => true)) ?>;
                                                this.store.loadData(data);
                                            }
                                        }
                                    }
                                })
                            ]
                        }]
                    },
                    {
                        columnWidth:.5,
                        layout: 'form',
                        items: [{
                            xtype:'fieldset',
                            labelAlign: 'top',
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            width: 350,
                            style:{
                                textAlign: 'left'
                            },
                            items: [
                                new WidgetMultiDatos({
                                    emptyText: 'Todos los meses',
                                    title: 'Mes', fieldLabel: 'Mes', id: 'mes', name: 'mes[]', hiddenName: "nmes[]",
                                    value:'<?= $nmes ? implode(",", $nmes) : "" ?>',
                                    listeners:{
                                        render:function(){
                                            if (this.store.data.length == 0){
                                                data =<?= json_encode(array("root" => $meses, "total" => count($meses), "success" => true)) ?>;
                                                this.store.loadData(data);
                                            }
                                        },
                                        focus:function(){
                                            if (this.store.data.length == 0){
                                                data =<?= json_encode(array("root" => $meses, "total" => count($meses), "success" => true)) ?>;
                                                this.store.loadData(data);
                                            }
                                        }
                                    }
                                })
                            ]
                        }]
                    }]
                },{
                    layout:'column',
                    items:[
                        {
                            columnWidth:.5,
                            layout: 'form',
                            items: [{
                                    xtype:'datefield',
                                    fieldLabel: 'Fecha Inicial',
                                    id : 'fechaInicial',
                                    name : 'fechaInicial',
                                    format: 'Y-m-d',                                
                                    value: '<?= $fechaInicial ?>',
                                    tooltip: 'lo quw sea'
                                }]
                        },
                        {
                            columnWidth:.5,
                            layout: 'form',
                            items: [{
                                    xtype:'datefield',
                                    fieldLabel: 'Fecha Final',
                                    id : 'fechaFinal',
                                    name : 'fechaFinal',
                                    format: 'Y-m-d',                                
                                    value: '<?= $fechaFinal ?>'
                                }]
                        }]
                    }]
                }]
        },{
            layout: 'form',
            items: [{
                xtype: 'fieldset',
                title: 'Parámetros',
                id:"parametros",
                items: [{
                    layout:'column',
                    items:[{
                        columnWidth:.5,
                        layout: 'form',
                        items: [{
                            xtype:"hidden",
                            id: 'transporte',
                            name: 'transporte',
                            value: '<?= Constantes::TERRESTRE ?>'
                            },{
                                xtype:'hidden',
                                name:"opcion",
                                value:"buscar"
                            },
                            new WidgetCiudad({fieldLabel: 'Ciu. Origen',
                                id: 'origen',
                                idciudad:"origen",
                                hiddenName:"idorigen",
                                tipo:"1",
                                impoexpo:"<?= constantes::EXPO ?>",
                                allowBlank:true,
                                value:"<?= $origen ?>",
                                hiddenValue:"<?= $idorigen ?>",
                                width:219
                            }),
                            new WidgetModalidad({fieldLabel: 'Modalidad',
                                id: 'modalidad',
                                hiddenName: "idmodalidad",
                                linkTransporte: "transporte",
                                impoexpo: "<?= Constantes::OTMDTA ?>",
                                width:219,
                                value:"<?= $idmodalidad ?>"
                            }),
                            new WidgetSucursales({fieldLabel: 'Sucursal',
                                id:"sucursal",
                                hiddenName:"idsucursal",
                                width:219,
                                value:"<?= $sucursal ?>",
                                hiddenValue:"<?= $idsucursal ?>"
                            }),                            
                            new WidgetTercero({
                                fieldLabel:'Cliente',                        
                                tipo: 'Consolcargo',
                                width: 219,
                                name: "tercero",           
                                id: "tercero_id",           
                                hiddenName: "idtercero",
                                value:"<?=$cliente?>",
                                hiddenValue:"<?=$idcliente?>"
                            })                            
                        ]
                    }, {
                        columnWidth:.5,
                        layout: 'form',
                        items: [
                            new WidgetCiudad({fieldLabel: 'Ciu. Destino',
                                    id: 'destino',
                                    idciudad:"destino",
                                    hiddenName:"iddestino",
                                    tipo:"1",
                                    impoexpo:"<?= constantes::EXPO ?>",
                                    allowBlank:true,
                                    value:"<?= $destino ?>",
                                    hiddenValue:"<?= $iddestino ?>",
                                    width:219
                            }),
                            new WidgetLinea({fieldLabel: 'Linea',
                                    linkTransporte: "transporte",                                    
                                    id: 'linea',
                                    hiddenName: 'idlinea',                                    
                                    allowBlank: true,
                                    value:"<?= $linea ?>",
                                    hiddenValue:"<?= $idlinea ?>",
                                    tabIndex:7
                            }),
                            new WidgetComerciales({fieldLabel: 'Vendedor',
                                    id: 'vendedor',
                                    name: 'vendedor',
                                    hiddenName:"login",
                                    value:"<?= $vendedor ?>",
                                    hiddenValue:"<?= $login ?>",
                                    width:219
                            }),
                            new WidgetTercero({
                                fieldLabel:'Importador',                        
                                tipo: 'Importador',
                                width: 219,
                                name: "importador",           
                                id: "importador_id",           
                                hiddenName: "idimportador",
                                value:"<?=$importador?>",
                                hiddenValue:"<?=$idimportador?>"
                            })
                            ]
                        }]
                    }]
                }]
            }],
            listeners:{                
                afterrender:function(){
                    <? if ($tipo == 1) { ?>
                        Ext.getCmp("ano").show();
                        Ext.getCmp("mes").show();
                        Ext.getCmp("fechaInicial").hide();
                        Ext.getCmp("fechaFinal").hide();                    
                    <? } else if ($tipo == 2){ ?>
                        Ext.getCmp("ano").hide();
                        Ext.getCmp("mes").hide();
                        Ext.getCmp("fechaInicial").show();
                        Ext.getCmp("fechaFinal").show();                     
                    <? } else {?>
                        Ext.getCmp("ano").hide();
                        Ext.getCmp("mes").hide();
                        Ext.getCmp("fechaInicial").hide();
                        Ext.getCmp("fechaFinal").hide();                     
                    <? }?>
                }
            }
        });
    };
    Ext.extend(FiltrosEstadisticasOtm, Ext.Panel, {

    });
</script>