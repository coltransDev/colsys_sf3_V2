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

$datos = $sf_data->getRaw("datos");

?>
<script type="text/javascript">
Ext.Loader.setConfig({enabled: true});
Ext.Loader.setPath('Ext.ux', '/js/ext4/examples/ux');
Ext.require([
    'Ext.form.Panel',
    'Ext.ux.form.MultiSelect'
]);


Ext.onReady(function(){
    
     Ext.QuickTips.init();
     
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
                    id:'criterio',
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
                    //msForm.getForm().submit();
                    //Ext.Msg.alert('Submitted Values',msForm.getForm().getValues(false).toSource());
                    //Ext.getStore("grid-result").load({params :msForm.getForm().getValues(false).toSource()});
                    
                    <?
                    foreach($criterios as $c)                        
                    {
                    ?>
                        var index = Ext.getCmp("grid-result").headerCt.items.findIndex('dataIndex','<?=$c["id"]?>');
                        Ext.getCmp("grid-result").columnManager.headerCt.items.get(index).setVisible(false);
                    <?
                    }                    
                    ?>
                    
                    
                    Ext.getCmp("grid-result").getStore().load(
                        {
                            params : msForm.getForm().getValues(false)                             
                            ,callback:function(a,b,c)
                            {                               
                                Ext.getCmp("grid-result").getStore().group(Ext.getCmp("criterio").getValue());
                                Ext.Object.each(Ext.getCmp("criterio").getValue(), function(key, value) {                                    
                                    var index = Ext.getCmp("grid-result").headerCt.items.findIndex('dataIndex',value);
                                    Ext.getCmp("grid-result").columnManager.headerCt.items.get(index).setVisible(true);
                                    //changes.data[key]=value.data;
                                });

                            }
                        }
                    );
                    //form.getValues(true));

                }
            }
        }]
    });

    Ext.Loader.setPath('Ext.ux', '/js/ext4/src/ux');
/*    Ext.require([
    'Ext.ux.ExportRecords'
    ]);
*/
    /*var store = Ext.create('Ext.data.Store', {
            model: 'Listado',
            data: [],//<?//= json_encode($sf_data->getRaw("contactos")) ?>,
            sorters: {property: 'due', direction: 'ASC'},
            groupers: ['ca_ano', 'ca_mes']
        });
    */
    Ext.define('Listado', {
        extend: 'Ext.data.Model',
        //idProperty: 'id',
        fields: [
            {name: 'ca_ano', type: 'string'},
            {name: 'ca_mes', type: 'int'},
            {name: 'ca_referencias', type: 'int'},
            {name: 'ca_facturacion', type: 'float'},
            {name: 'ca_utilidad', type: 'float'},
            {name: 'ca_cmb', type: 'int'},
            {name: 'ca_teus', type: 'int'},
            {name: 'ca_hbls', type: 'int'},
            {name: 'ca_sucursal', type: 'string'},
            {name: 'ca_traorigen', type: 'string'},
            {name: 'ca_ciudestino', type: 'string'},
            {name: 'ca_vendedor', type: 'string'},
            {name: 'ca_compania', type: 'string'},
            {name: 'ca_nomlinea', type: 'string'}
        ]
    });

    var store = Ext.create('Ext.data.Store', {
     model: 'Listado',
     proxy: {
         type: 'ajax',
         url: '<?=url_for('inoReportes/datosReporteador')?>',
         reader: {
             type: 'json',
             root: 'root'
         }
     },
     //groupField: 'ca_ano',
     //groupers:['ca_ano','ca_mes'],
     sorters: [{
         property: 'ca_ano',
         direction: 'ASC'
     }],
     autoLoad: false
 });
        
        var grid = Ext.create('Ext.grid.Panel', {
            title: 'Generador de Reportes',
            iconCls: 'icon-grid',
            store: store,
            frame: true,
            width: 900,
            height:700,
            id:'grid-result',
            renderTo: 'grid',
            multiSelect : true,
            listeners: {
                beforeshowtip: function(grid, tip, data) {
                    var cellNode = tip.triggerEvent.getTarget(tip.view.getCellSelector());
                    if (cellNode) {
                        data.colName = tip.view.headerCt.getHeaderAtIndex(cellNode.cellIndex).text;
                    }
                }                
            },
            tbar: [
            {
                text: 'Exportar',
                handler: function() {
                    
                    changes=new Object();

                    data=Ext.getCmp("grid-result").getStore().getRange();
                    changes.group=Ext.getCmp("grid-result").getStore().groupers.keys;
                    changes.sort=Ext.getCmp("grid-result").getStore().sorters.keys;
                    changes.data=[];

                    Ext.Object.each(data, function(key, value) {
                        changes.data[key]=value.data;
                    });

                    var str= JSON.stringify(changes);
                    if(str.length>5)
                    {                        
                        $("#datos").val(str);
                        $("#formXls").submit();
                    }
                }
            }],
/*            plugins :[{
                ptype           :   'exportrecords',
                downloadButton  : 'top'
            }],
*/
            features: [Ext.create('Ext.ux.grid.feature.MultiGroupingSummary', {
                    id: 'group',
                    name: 'group',
                    groupsHeaderTpl: {
                        ca_ano: 'Año: {name}',
                        ca_mes: 'Mes: {name}'
                    },
                    hideGroupedHeader: true,
                    enableGroupingMenu: true,
                    startCollapsed: false,
                    totalSummary: 'fixed',          // Can be: 'fixed', true, false. Default: false
                    totalSummaryTopLine: true,      // Default: true
                    totalSummaryColumnLines: true  // Default: false
                }), {
                    ftype: 'summary',
                    dock: 'bottom'
                }],
            columns: [
                {
                    header: 'Año',                    
                    sortable: true,
                    dataIndex: 'ca_ano',
                    hidden:true
                },
                {
                    header: 'Mes',                    
                    sortable: true,
                    dataIndex: 'ca_mes',
                    hidden:true
                },
                {
                    header: 'Sucursal',                    
                    sortable: true,
                    dataIndex: 'ca_sucursal',
                    hidden:true
                },
                {
                    header: 'Origen',
                    sortable: true,
                    dataIndex: 'ca_traorigen',
                    hidden:true
                },
                {
                    header: 'Destino',
                    sortable: true,
                    dataIndex: 'ca_ciudestino',
                    hidden:true
                },
                {
                    header: 'Vendedor',
                    sortable: true,
                    dataIndex: 'ca_vendedor',
                    hidden:true
                }, 
                {
                    header: 'Empresa',                    
                    sortable: true,
                    dataIndex: 'ca_compania',
                    hidden:true
                }, 
                {
                    header: 'Linea',
                    sortable: true,
                    dataIndex: 'ca_nomlinea',
                    hidden:true
                },
                {
                    header: '# Ref',
                    width: 130,
                    sortable: true,
                    dataIndex: 'ca_referencias',
                    summaryType: 'sum',
                    renderer: Ext.util.Format.numberRenderer('0.00'),
                    summaryRenderer: function(value) {
                        return Ext.util.Format.number(value, '0.00');
                    }
                },
                {
                    header: '# House',
                    width: 130,
                    sortable: true,
                    dataIndex: 'ca_hbls',
                    summaryType: 'sum',
                    renderer: Ext.util.Format.numberRenderer('0.00'),
                    summaryRenderer: function(value) {
                        return Ext.util.Format.number(value, '0.00');
                    }
                },
                {
                    header: 'Facturacion',
                    width: 130,
                    sortable: true,
                    dataIndex: 'ca_facturacion',
                    renderer: 'usMoney',
                    summaryRenderer: function(value, summaryData, dataIndex) {
                        return "<b>"+Ext.util.Format.usMoney(value)+"</b>";
                    },
                    //summaryType: 'sum'
                    summaryType: function(records){
                        var i = 0,
                            length = records.length,
                            total = 0,
                            record;
                        for (; i < length; ++i) {
                            record = records[i];
                            if(!isNaN(record.get('ca_facturacion')))
                                total += record.get('ca_facturacion');                            
                        }
                        //alert (total);
                        return total;
                    }
                },
                {
                    header: 'Utilidad',
                    width: 130,
                    sortable: true,
                    dataIndex: 'ca_utilidad',
                    summaryType: 'sum',
                    renderer: 'usMoney',
                    summaryRenderer: function(value, summaryData, dataIndex) {
                        return "<b>"+Ext.util.Format.usMoney(value)+"</b>";
                    }
                },
                {
                    header: 'Teus',
                    width: 130,
                    sortable: true,
                    dataIndex: 'ca_teus',
                    summaryType: 'sum',
                    renderer: Ext.util.Format.numberRenderer('0.00'),
                    summaryRenderer: function(value) {
                        return Ext.util.Format.number(value, '0.00');
                    }
                },
                {
                    header: 'Volumen',
                    width: 130,
                    sortable: true,
                    dataIndex: 'ca_cmb',
                    summaryType: 'sum',
                    renderer: Ext.util.Format.numberRenderer('0.00'),
                    summaryRenderer: function(value) {
                        return Ext.util.Format.number(value, '0.00');
                    }
                }
            ]
        });
    
});
</script>

<table width="60%" align="center"><tr><td width="100%" style="text-align: center" >
<div id="multiselect"></div>
</td></tr></table>

<table width="80%" align="center">
    <tr><td>
            <div id="grid" style="margin-bottom:15px; margin-top: 15px;" align="center"></div>
        </td></tr>
</table>


<form id="formXls" name="formXls" action="<?= url_for("inoReportes/reporteadorXls") ?>" method="post">
    <input type="hidden" id="datos" name="datos">
</form>
