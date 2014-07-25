<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$years = $sf_data->getRaw("years");
$meses = $sf_data->getRaw("meses");
$sucursales = $sf_data->getRaw("sucursales");
$destinos = $sf_data->getRaw("ciudadDestino");
$criterios = $sf_data->getRaw("criterios");

$destino = $sf_data->getRaw("destino");
$vendedor = $sf_data->getRaw("vendedor");
$sucursal = $sf_data->getRaw("sucursal");
$criterio = $sf_data->getRaw("criterio");

include_component("widgets4", "wgCliente");
include_component("widgets4", "wgLinea");
include_component("widgets4", "wgModalidad");
?>
<script type="text/javascript">
Ext.Loader.setConfig({enabled: true});
Ext.Loader.setPath('Ext.ux', '/js/ext4/examples/ux');
Ext.require([
    'Ext.form.Panel',
    'Ext.ux.form.MultiSelect'
]);

Ext.onReady(function(){
    var ds =new Ext.data.Store( {
     fields: ['year'],
     data : <?=json_encode($years )?>
    });

    var msForm = new Ext.form.Panel( {
        title: 'Generador de Informes INO',
        anchor: '100%',
        standardSubmit:true,
        bodyPadding: 2,
        layout:'column',
        renderTo: 'multiselect',
        defaults:{
                columnWidth: 1/4,
                bodyStyle:'padding:0,marging:0',
                style:"text-align: left"
        },
        items:[
            {
                baseCls:'x-plain',
                columnWidth: 1/5,
                items:[{
                   xtype: 'multiselect',
                   title: 'Año',
                   msgTarget: 'side',
                   name: 'year',
                   id: 'year',
                   allowBlank: false,
                   minSelections: 1,
                   store: new Ext.data.Store( {
                       fields: ['year'],
                       data : <?=json_encode($years )?>
                      }),
                   displayField: 'year',
                   valueField: 'year',
                   value:<?=json_encode($year)?>
               }]
            },
            {
                baseCls:'x-plain',
                items:[{
                    xtype: 'multiselect',
                    title: 'Meses',
                    name: 'mes',
                    id: 'mes',
                    height : 220,
                    allowBlank: false,
                    minSelections: 1,
                    store: new Ext.data.Store( {
                        fields: ['id','valor'],
                        data : <?=json_encode($meses)?>
                       }),
                    displayField: 'valor',
                    valueField: 'id',
                    value:<?=json_encode(explode(",",  utf8_encode($mes)))?>                    
                }]
            },
            {
                baseCls:'x-plain',
                items:[{
                    xtype: 'multiselect',
                    msgTarget: 'side',
                    title: 'Sucursales',
                    name: 'sucursal',
                    id: 'sucursal',
                    minSelections: 0,
                    height : 220,
                    store: new Ext.data.Store( {
                        fields: ['id','valor'],
                        data : <?=json_encode($sucursales )?>
                       }),
                    displayField: 'valor',
                    valueField: 'id',
                    listeners:{
                        change:function (obj, newValue, oldValue, eOpts)
                        {
                            Ext.getCmp("vendedor").getStore().load({
                                    params : {
                                        sucursal : newValue
                                    }
                                });
                        },
                        afterrender: function( obj, eOpts )
                        {
                            if(Ext.getCmp("sucursal").getValue()!="")
                            {
                                Ext.getCmp("vendedor").getStore().load({
                                    params : {
                                        sucursal : Ext.getCmp("sucursal").getValue()
                                    }
                                });
                            }
                        }
                    },
                    value:<?=json_encode(explode(",",  utf8_encode($sucursal)))?>
                }]
            },
            {
                baseCls:'x-plain',
                items:[{
                    xtype: 'multiselect',
                    msgTarget: 'side',
                    title: 'Vendedores',
                    name: 'vendedor',
                    id: 'vendedor',
                    height : 220,
                    minSelections: 0,
                    store: new Ext.data.Store({
                        fields: ['id','valor'],
                        proxy: {
                            type: 'ajax',
                            url: '<?=url_for('pruebas/datosVendedores')?>',
                            reader: {
                                type: 'json',
                                root: 'root'
                            }
                        },
                        autoLoad: false
                    }),
                    displayField: 'valor',
                    valueField: 'id',
                    value:<?=json_encode(explode(",",$vendedor))?>
                }]
            },
            {
                baseCls:'x-plain',
                anchor:'100%',
                columnWidth: 1/2,
                items:[
                    {
                        xtype: 'wCliente',
                        width:350,
                        fieldLabel: "Cliente",
                        name: "idcliente",
                        id: "idcliente"
                    }
                ]
            },
            {
                baseCls:'x-plain',
                columnWidth: 1/2.1,
                items:[
                    {
                        xtype: 'hidden',
                        name: "transporte",
                        id: "transporte",
                        value:"<?=Constantes::TERRESTRE?>"
                    },
                    {
                        xtype: 'hidden',
                        name: "impoexpo",
                        id: "impoexpo",
                        value:"<?=Constantes::INTERNO?>"
                    },
                    {
                        xtype: 'wLinea',
                        fieldLabel: "Linea",
                        name: "idlinea",
                        id: "idlinea",
                        transporte:"<?=Constantes::TERRESTRE?>",
                        width:350
                    }
                ]
            },
            {
                baseCls:'x-plain',
                columnWidth: 1/3,
                items:[
                {
                    xtype: 'wModalidad',
                    fieldLabel: "Modalidad",
                    name: "modalidad",
                    id: "modalidad",
                    transporte:"<?=Constantes::TERRESTRE?>",
                    impoexpo:"<?=Constantes::INTERNO?>",
                    width:220
                }
                ]
            },
            {
                baseCls:'x-plain',
                columnWidth: 1/3.1,
                items:[{
                    xtype: 'multiselect',
                    msgTarget: 'side',
                    title: 'Ciudad Destino',
                    name: 'destino',
                    minSelections: 0,
                    height : 150,
                    store: new Ext.data.Store( {
                        fields: ['id','valor'],
                        data : <?=json_encode($destinos)?>
                       }),
                    displayField: 'valor',
                    valueField: 'id',
                    value:<?=json_encode(explode(",",  utf8_encode($destino)))?>
                }]
            },
            {
                baseCls:'x-plain',
                columnWidth: 1/3.1,
                items:[{
                    xtype: 'multiselect',
                    msgTarget: 'side',
                    title: 'Agrupamiento',
                    name: 'criterio',
                    minSelections: 0,
                    height : 150,
                    store: new Ext.data.Store( {
                        fields: ['id','valor'],
                        data : <?=json_encode($criterios)?>
                       }),
                    displayField: 'valor',
                    valueField: 'id',
                    value:<?=json_encode(explode(",",$criterio))?>
                }]
            }
        ],
        buttons: [
        {
            text: 'Reset',
            handler: function() {
                msForm.getForm().reset();
            }
        }, {
            text: 'Buscar',
            handler: function(){
                if(msForm.getForm().isValid()){
                    msForm.getForm().submit();
                }
            }
        }]
    });
});
</script>

<table width="60%" align="center"><tr><td width="100%" style="text-align: center" >
<div id="multiselect"></div>
</td></tr></table>