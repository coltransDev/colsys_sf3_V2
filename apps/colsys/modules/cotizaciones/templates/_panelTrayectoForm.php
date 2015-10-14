<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
include_component("widgets", "widgetImpoexpo");
include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetIncoterms");
include_component("widgets", "widgetCiudad");

?>
<script type="text/javascript">
    PanelTrayectoForm = function( config ) {        
        Ext.apply(this,config);
        this.items;        
        if(this.tipo=="Trayecto")
        {
            this.items=[{
                            id: 'cotizacionId',
                            xtype:'hidden',
                            name: 'cotizacionId',
                            value: '<?=$cotizacion->getCaIdcotizacion()?>',
                            allowBlank:false
                        },{
                            id: 'idproducto',
                            xtype:'hidden',
                            name: 'idproducto',
                            value: '',
                            allowBlank:false
                        },{
                            xtype:'textfield',
                            fieldLabel: 'Producto',
                            id: 'producto',
                            name: 'producto',
                            value: '',
                            allowBlank:false,
                            width: 300
                        }
                        , new WidgetImpoexpo({fieldLabel: "Impo/Expo",id:"impoexpo", allowBlank:false})
                        , new WidgetIncoterms({name:"incoterms"})
                        , new WidgetTransporte({fieldLabel: "Transporte",id:"transporte", allowBlank:false})

                        , new WidgetModalidad({fieldLabel: "Modalidad",id:"modalidad", allowBlank:false, linkTransporte: "transporte", linkImpoexpo: "impoexpo"})
                        , new WidgetLinea({fieldLabel: 'Linea',
                                           linkTransporte: "transporte",
                                           linkImpoexpo: "impoexpo",
                                           activoImpo: true,
                                           activoExpo: true,
                                           id:"linea",
                                           hiddenName:"idlinea",
                                           //allowBlank:false,
                                           width:300
                                          })                       
                        ,{
                            xtype:'checkbox',
                            fieldLabel: 'Postular nombre de Linea',
                            id: 'postular_linea',
                            name: 'postular_linea',
                            value: false,
                            width: 300
                        },
                        new WidgetCiudad({fieldLabel: 'Ciudad Origen',
                                          id: 'origen',
                                          idciudad:"origen",
                                          hiddenName:"ciu_origen",
                                          tipo:"1",
                                          impoexpo:"impoexpo",
                                          allowBlank:false
                                        })
                        ,   
                        new WidgetCiudad({fieldLabel: 'Ciudad Destino',
                                                  id: 'destino',
                                                  idciudad:"destino",
                                                  hiddenName:"ciu_destino",
                                                  tipo:"2",
                                                  impoexpo:"impoexpo",
                                                  allowBlank:false
                                                })
                        ,
                        new WidgetCiudad({fieldLabel: 'Ciudad Escala',
                                                  id: 'escala',
                                                  idciudad:"escala",
                                                  hiddenName:"ciu_escala",
                                                  impoexpo:"impoexpo"

                                                })
                        ,{
                            xtype: 'textarea',
                            width: 310,
                            height: 40,
                            fieldLabel: 'Observaciones',
                            name: 'observaciones',
                            value: '',
                            allowBlank:true
                        }
                        ,{
                            xtype: 'textfield',
                            width: 100,
                            fieldLabel: 'Frecuencia',
                            name: 'frecuencia',
                            value: '',
                            allowBlank:true,
                            maxLength:40,
                            maxLengthText:'Por favor verifique que el campo frecuencia tenga maximo 40 caracteres'
                        }
                        ,{
                            xtype: 'textfield',
                            width: 100,
                            fieldLabel: 'T/Transito',
                            name: 'ttransito',
                            value: '',
                            allowBlank:true,
                            maxLength:25,
                            maxLengthText:'Por favor verifique que el campo T/Transito tenga maximo 25 caracteres'
                        }
                        ,
                        new Ext.form.ComboBox({
                            fieldLabel: 'Imprimir',
                            typeAhead: true,
                            forceSelection: true,
                            triggerAction: 'all',
                            emptyText:'',
                            selectOnFocus: true,
                            name: 'imprimir',
                            id: 'imprimir',
                            value: 'Por Item',
                            lazyRender:true,
                            listClass: 'x-combo-list-small',
                            store: [['Por Item', 'Por Item'],['Puerto', 'Puerto'],['Concepto', 'Concepto'],['Trayecto', 'Trayecto']]
                        }),
                        {
                            xtype: 'datefield',
                            width: 100,
                            fieldLabel: 'Vigencia',
                            name: 'vigencia',
                            format: 'Y-m-d',
                            value: '',
                            allowBlank:false
                        }
                    ];
        }
        else if(this.tipo=="OTM/DTA")
        {
            this.items=[{
                            id: 'cotizacionId',
                            xtype:'hidden',
                            name: 'cotizacionId',
                            value: '<?=$cotizacion->getCaIdcotizacion()?>',
                            allowBlank:false
                        },{
                            id: 'idproducto',
                            xtype:'hidden',
                            name: 'idproducto',
                            value: '',
                            allowBlank:false
                        },
                        new Ext.form.ComboBox({
                            fieldLabel: 'Tipo',
                            typeAhead: true,
                            forceSelection: true,
                            triggerAction: 'all',
                            emptyText:'',
                            selectOnFocus: true,
                            name: 'producto',
                            id: 'producto',
                            lazyRender:true,
                            listClass: 'x-combo-list-small',
                            store: [['OTM', 'OTM'],['DTA', 'DTA']]
                        })
                        ,
                        new Ext.form.ComboBox({
                            fieldLabel: 'Modalidad',
                            typeAhead: true,
                            forceSelection: true,
                            triggerAction: 'all',
                            emptyText:'',
                            selectOnFocus: true,
                            name: 'modalidad',
                            id: 'modalidad',
                            lazyRender:true,
                            listClass: 'x-combo-list-small',
                            store: [['FCL', 'FCL'],['LCL', 'LCL']]
                        })
                        ,{
                            xtype:'hidden',
                            id: 'impoexpo',
                            name: 'impoexpo',
                            value: '<?=Constantes::IMPO?>'
                        },
                        {
                            xtype:'hidden',
                            id: 'transporte',
                            name: 'transporte',
                            value: 'OTM-DTA'
                        },
                        {
                            xtype:'hidden',
                            id: 'incoterms',
                            name: 'incoterms',
                            value: ' '
                        },
                        {
                            xtype:'hidden',
                            id: 'imprimir',
                            name: 'imprimir',
                            value: ' '
                        }                        
                        ,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_origen", "label"=>"Ciudad Origen", "idpais"=>"CO-057", "allowBlank"=>"false"))?>
                        ,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_destino", "label"=>"Ciudad Destino", "idpais"=>"CO-057", "allowBlank"=>"false"))?>

                        ,{
                            xtype: 'textarea',
                            width: 310,
                            height: 40,
                            fieldLabel: 'Observaciones',
                            name: 'observaciones',
                            value: '',
                            allowBlank:true
                        }
                        ,{
                            xtype: 'textfield',
                            width: 100,
                            fieldLabel: 'Frecuencia',
                            name: 'frecuencia',
                            value: '',
                            allowBlank:true
                        }
                        ,{
                            xtype: 'textfield',
                            width: 100,
                            fieldLabel: 'T/Transito',
                            name: 'ttransito',
                            value: '',
                            allowBlank:true
                        }
                        ,
                        {
                            xtype: 'datefield',
                            width: 100,
                            fieldLabel: 'Vigencia',
                            name: 'vigencia',
                            format: 'Y-m-d',
                            value: '',
                            allowBlank:false
                        }
                    ];
        }

        PanelTrayectoForm.superclass.constructor.call(this, {                
                layout: 'form',
                frame: true,
                
                autoHeight: true,
                bodyStyle: 'padding: 5px 5px 0 5px;',
                labelWidth: 100,
                items: this.items
        });

        
    }

    Ext.extend(PanelTrayectoForm, Ext.FormPanel, {} );

</script>