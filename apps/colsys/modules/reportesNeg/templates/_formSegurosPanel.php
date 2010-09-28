<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/
//include_component("widgets", "widgetContactoCliente");
include_component("widgets", "widgetMoneda");
?>
<script type="text/javascript">
    FormSegurosPanel = function( config ){
        Ext.apply(this, config);        
        FormSegurosPanel.superclass.constructor.call(this, {
            activeTab: 0,
            title: 'Seguros',
            buttonAlign: 'center',
            autoHeight: true,            
            items: [
                {
                    xtype:'fieldset',
                    title: 'Información de Seguros',
                    autoHeight:true,
                    id:"panel-seguros",
                    //defaults: {width: 210},
                    items: [
                        {
                            xtype: "hidden",
                            name: "ca_seguro_conf",
                            id: "ca_seguro_conf",
                            value: '<?=$seguro_conf?>'

                        },
                        {
                            xtype: "hidden",
                            name: "ca_seguro",
                            id: "ca_seguro"
                        },
                        
                            {
                                xtype:'fieldset',
                                checkboxToggle:true,
                                title: 'Seguros',
                                autoHeight:true,
                                collapsed: true,
                                layout:'column',                                
                                id:"seguros",
                                name:"seguros",
                                columns: 4,
                                frame:true,

                                items :[
                                {
                                    layout:'column',
                                    border:false,
                                    title: "Valor Asegurado ",
                                    columns: 2,
                                    columnWidth: .3,
                                    fieldLabel: "Valor Asegurado ",
                                    items: [
                                        {
                                            xtype: "numberfield",
                                            name: "ca_vlrasegurado",
                                            id: "ca_vlrasegurado",
                                            width:100,
                                            columnWidth: .3

                                        },
                                        new WidgetMoneda({
                                                        id: 'ca_idmoneda_vlr',
                                                        width:          80,
                                                        columnWidth: .2
                                                        })
                                    ]
                                },
                                {
                                    layout: 'column',
                                    border:false,
                                    defaultType: 'textfield',
                                    columns: 3,
                                    columnWidth: .3,
                                    title: "Obtención Póliza ",
                                    items: [
                                    {
                                        xtype: "numberfield",                                        
                                        name: "ca_obtencionpoliza",
                                        id: "ca_obtencionpoliza",
                                        width: 100,
                                        columnWidth: .3
                                    },
                                    new WidgetMoneda({
                                                    id: 'ca_idmoneda_pol',
                                                    width:          80,
                                                    columnWidth: .2
                                                    })
                                    ]
                                },
                                {
                                    layout: 'column',
                                    border:false,
                                    defaultType: 'textfield',                                    
                                    title:"Prima Venta",
                                    columnWidth: .1,
                                    items: [
                                    {
                                        xtype: "numberfield",                                       
                                        name: "ca_primaventa",
                                        id: "ca_primaventa",
                                        width: 100
                                    }
                                    ]
                                },
                                {
                                    layout: 'column',
                                    border:false,
                                    defaultType: 'textfield',
                                    columns:2,
                                    columnWidth: .3,
                                    title:"Min",
                                    items: [
                                    {
                                        xtype: "numberfield",                                        
                                        name: "ca_minimaventa",
                                        id: "ca_minimaventa",
                                        width: 100,
                                        columnWidth: .3
                                    },
                                    new WidgetMoneda({
                                                    id: 'ca_idmoneda_vta',                                                    
                                                    width:          80,
                                                    columnWidth: .2
                                                    })
                                    ]
                                }
                                ]
                            }
                        
                    ]
                }
            ]
        });
    };

    Ext.extend(FormSegurosPanel, Ext.Panel, {
    });


</script>
