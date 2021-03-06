<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

include_component("reportesNeg", "gridPanelInstruccionesWindow",array("modo"=>$modo));

?>
<script type="text/javascript">
    FormPreferenciasPanel = function( config ){
        Ext.apply(this, config);

        FormPreferenciasPanel.superclass.constructor.call(this, {
            activeTab:0,
            title:'Preferencias',
            buttonAlign:'center',
            autoHeight:true,
            
            items:[
                {

                    xtype:'fieldset',
                    title:'Preferencias',
                    autoHeight:true,
					labelWidth:120,
                    items:[
                        {
                            xtype:"textarea",
                            fieldLabel:"Preferencias del cliente",
                            name:"preferencias",
                            id:"preferencias",
                            width:500,
                            grow:true
                        },
                        {
                            xtype:"textarea",
                            fieldLabel:"Instrucciones especiales (Agente)",
                            name:"instrucciones",
                            id:"instrucciones",
                            width:500,
                            grow:true
                        },
                        {
                            xtype:"button",
                            text:"Agregar",
                            id:"bagregar",
                            handler:function()
                            {
                                win = new gridWindow();
                                win.show();
                            }
                        }
                    ]
                },
                {
                    xtype:'fieldset',
                    title:'',
                    autoHeight:true,
                    items:[
                         new WidgetTercero({fieldLabel:"Representante",
                                            tipo:'Representante',
                                            width:600,
                                            id:"idrepresentante",
                                            hiddenName:"idrepres"
                                           })
                         ,
                        {
                            xtype    :'checkbox',
                            fieldLabel:'Notificar',
                            id       :'ca_informar_repr',
                            name     :'ca_informar_repr'
                        }
                        ]
                },
                {
                    xtype:'fieldset',
                    title:'Informaciones a:',
                    autoHeight:true,
                    layout:'column',
                    columns:2,
                    items:[
                        {
                            border:false,
                            title:'Libreta de contactos',
                            autoHeight:true,
                            columns:2,
                            columnWidth:0.5,
                            items:[
                                <?
                                for( $i=0; $i<20; $i++ )
                                {
                                    if( $i!=0){
                                        echo ",";
                                    }
                                ?>
                                {
                                   border:false,
                                    title:'',
                                    autoHeight:true,
                                    layout:'column',
                                    columns:2,
                                    defaults:{
                                        
                                        layout:'form',
                                        border:false,                                       
                                        hideLabels:true,
                                        border:true
                                    },
                                    items:[
                                        {
                                            defaultType:'textfield',
                                            items:[
                                                {
                                                    xtype:"textfield",
                                                    fieldLabel:"",
                                                    name:"contacto_<?=$i?>",
                                                    id:"contacto_<?=$i?>",
                                                    readOnly:false,
                                                    width:250,
                                                    height:20
                                                }

                                            ]
                                        },
                                        {
                                            defaults:{width:20},
                                            items:[
                                                {
                                                    xtype:"checkbox",
                                                    fieldLabel:"",
                                                    name:"chkcontacto_<?=$i?>",
                                                    id:"chkcontacto_<?=$i?>",
                                                    width:20,
                                                    height:20
                                                }

                                            ]
                                        }
                                    ]
                                }
                                <?
                                }
                                ?>
                            ]
                        }
                        ,
                        {
                            border:false,
                            title:'Contactos fijos',
                            autoHeight:true,
                            columnWidth:0.5,
                            items:[
                                <?
                                for( $i=0; $i<20; $i++ )
                                {
                                    if( $i!=0){
                                        echo ",";
                                    }
                                ?>
                                {
                                   border:false,
                                    title:'',
                                    autoHeight:true,
                                    layout:'column',
                                    columns:2,
                                    defaults:{                                        
                                        layout:'form',
                                        border:false,
                                       
                                        hideLabels:true,
                                        border:true
                                    },
                                    items:[
                                        {
                                            defaultType:'textfield',
                                            items:[
                                                {
                                                    xtype:"textfield",
                                                    fieldLabel:"",
                                                    name:"contacto_fijos<?=$i?>",
                                                    id:"contacto_fijos<?=$i?>",
                                                    readOnly:true,
                                                    width:250,
                                                    height:20
                                                }

                                            ]
                                        },
                                        {
                                            defaults:{width:20},
                                            items:[
                                                {
                                                    xtype:"checkbox",
                                                    fieldLabel:"",
                                                    name:"chkcontacto_fijos<?=$i?>",
                                                    id:"chkcontacto_fijos<?=$i?>",
                                                    width:20,
                                                    height:20
                                                }

                                            ]
                                        }
                                    ]
                                }
                                <?
                                }
                                ?>
                            ]
                        }
                    ]
                    }       
            ]
        });
    };

    Ext.extend(FormPreferenciasPanel, Ext.Panel, {

    });
</script>