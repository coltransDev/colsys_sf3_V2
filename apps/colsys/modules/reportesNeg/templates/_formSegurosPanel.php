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
                    title: 'Informaci�n de Seguros',
                    autoHeight:true,
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
                        //defaultType: 'textfield',
                        //collapsed: true,
                        width:'100%',
                        id:"seguros",
                        name:"seguros",
                        items: [
                            {
                                xtype:'fieldset',
                                autoHeight:true,
                                layout:'column',
                                columns: 3,
                                columnWidth: .33,
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
                                        width:50
                                    },
                                    new WidgetMoneda({
                                                    id: 'ca_idmoneda_vlr',                                                    
                                                    width:          90
                                                    })
                                    ]
                                },
                                {
                                    layout: 'column',
                                    border:false,
                                    defaultType: 'textfield',
                                    columns: 3,
                                    columnWidth: .33,
                                    title: "Obtenci�n P�liza ",
                                    items: [
                                    {
                                        xtype: "numberfield",                                        
                                        name: "ca_obtencionpoliza",
                                        id: "ca_obtencionpoliza",
                                        width: 120
                                    },
                                    new WidgetMoneda({
                                                    id: 'ca_idmoneda_pol',
                                                    width:          90
                                                    })
                                    ]
                                },
                                {
                                    layout: 'column',
                                    border:false,
                                    defaultType: 'textfield',
                                    columns:3,
                                    title:"Prima Venta",
                                    items: [
                                    {
                                        xtype: "numberfield",                                       
                                        name: "ca_primaventa",
                                        id: "ca_primaventa",
                                        width: 120
                                    }
                                    ]
                                },
                                {
                                    layout: 'column',
                                    border:false,
                                    defaultType: 'textfield',
                                    columns:2,
                                    title:"Min",
                                    items: [
                                    {
                                        xtype: "numberfield",                                        
                                        name: "ca_minimaventa",
                                        id: "ca_minimaventa",
                                        width: 120
                                    },
                                    new WidgetMoneda({
                                                    id: 'ca_idmoneda_vta',                                                    
                                                    width:          90
                                                    })
                                    ]
                                }
                                ]
                            }
                        ]
                    }]
                }
            ]
        });
    };

    Ext.extend(FormSegurosPanel, Ext.Panel, {
    });


</script>
