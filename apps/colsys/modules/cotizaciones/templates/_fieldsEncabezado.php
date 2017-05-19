<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
include_component("widgets", "widgetContactoCliente");
include_component("widgets", "widgetComerciales");
?>


<script type="text/javascript">
    var despedida = ''

    var entrada = ''

    var anexos = ''
    
    TabGeneralPanel = function( config ){
        Ext.apply(this, config);
       
        this.wgContactoCliente = new WidgetContactoCliente({fieldLabel:'Cliente',
            width:400,
            id:"cliente",
            hiddenName:"idcliente",
            allowBlank:false,
            displayField:"compania",
            autoSelect:false
        });

        this.wgContactoCliente.addListener("select", this.onSelectContactoCliente, this);

        TabGeneralPanel.superclass.constructor.call(this, {
            activeTab:0,
            title:'Encabezado',
            
            autoHeight:true,
            layout:'form',
            labelAlign: 'top',
            buttonAlign: 'left',
            bodyStyle:'padding:10px',
            id:'encabezados-form',
            
            items:[
                {
                    layout:'table',
                    layoutConfig: {
                        // The total column count must be specified here
                        columns: 4
                    },
                    
                    border: false,
                    defaults: {
                        // applied to each contained panel
                        bodyStyle:'padding-right:20px',
                        border: false
                    },
                    autoHeight:true,
                    items:[
                        {
                            layout: 'form',
                            labelAlign: 'top',
                            items: [{
                                    xtype:'textfield',
                                    fieldLabel: 'Consecutivo',
                                    name: 'consecutivo',
                                    value: 'C',
                                    allowBlank:false,
                                    readOnly: true,
                                    width: 120
                                },
                                {
                                    xtype:'hidden',
                                    name: 'idcotizacion'
                                },
                                {
                                    xtype:'hidden',
                                    id: 'listaclinton'
                                },
                                {
                                    xtype:'hidden',
                                    id: 'status'
                                }
                            ]
                        },
                        {
                            layout: 'form',
                            labelAlign: 'top',
                            items: [{
                                    xtype:'datefield',
                                    fieldLabel: 'Fecha de Solicitud',
                                    name: 'fchSolicitud',                                    
                                    format: "Y-m-d",
                                    allowBlank:false,
                                    width: 120,
                                    maxValue:'<?=date("Y-m-d") ?>'
                                }]
                        },{
                            layout: 'form',
                            labelAlign: 'top',
                            items: [{
                                    xtype:'timefield',
                                    fieldLabel: 'Hora de Solicitud',
                                    name: 'horaSolicitud',
                                    id: 'horaSolicitud',                                    
                                    format: "H:i:s",
                                    allowBlank:false,
                                    width: 120
                                }]
                        },{
                            layout: 'form',
                            labelAlign: 'top',
                            items: [{
                                    xtype:          'combo',
                                    mode:           'local',
                                    triggerAction:  'all',
                                    forceSelection: true,
                                    editable:       true,
                                    fieldLabel:     'Medio de Solicitud',
                                    name:           'medioSolicitud',
                                    displayField:   'value',
                                    valueField:     'value',                    
                                    allowBlank:     false,
                                    store:          new Ext.data.JsonStore({
                                        fields : ['value'],
                                        data   : [
                                            <?
                                            foreach( $medios as $medio ){
                                            ?>
                                                {value: '<?=  $medio->getCaValor()?>'},
                                            <?
                                            }
                                            ?>                            
                                        ]
                                    })
                                }]
                        }
                    ]
                },
                this.wgContactoCliente,
                {
                    xtype:"hidden",
                    id:"idconcliente",
                    name:"idconcliente"
                },
                {
                    xtype:"textfield",
                    fieldLabel:"Contacto",
                    name:"contacto",
                    id:"contacto",
                    readOnly:true,
                    width:400
                },
                new WidgetComerciales({fieldLabel: 'Rep. Comercial',
                    id: 'vendedor',
                    name: 'vendedor',
                    hiddenName: "idvendedor",
                    disabled: <?=$nivel>0?"false":"true"?>
                }),
                {
                    xtype:          'combo',
                    mode:           'local',
                    value:          '<?=($sucursal=="PER")?Constantes::TPLOGISTICS:Constantes::COLTRANS?>',
                    triggerAction:  'all',
                    forceSelection: true,
                    editable:       true,
                    fieldLabel:     'Empresa',
                    name:           'empresa',
                    displayField:   'name',
                    valueField:     'name',
                    disabled:       this.idcotizacion, 
                    allowBlank:     true,                    
                    listeners:{
                        select : function ( combo, record, index)
                        {
                            Ext.getCmp("entrada").setValue(Ext.getCmp("entrada"+record.data.name).getValue());
                            Ext.getCmp("anexos").setValue(Ext.getCmp("anexos"+record.data.name).getValue());
                            if (Ext.getCmp("despedida"+record.data.name)){
                                Ext.getCmp("despedida").setValue(Ext.getCmp("despedida"+record.data.name).getValue());
                            }else{
                                Ext.getCmp("despedida").setValue(Ext.getCmp("despedidaDefault").getValue());
                            }
                        }
                    },
                    store:          new Ext.data.JsonStore({
                        fields : ['name'],
                        data   : [
                            <? if($sucursal=="PER"){?>
                               {name : '<?=Constantes::TPLOGISTICS?>'}
                            <?}
                            else{?>
                               {name : '<?=Constantes::COLTRANS?>'},
                               {name : '<?=Constantes::COLMAS?>'},
                               {name : '<?=Constantes::COLDEPOSITOS?>'}
                            <?
                            }?>                            
                            
                        ]
                    })
                }
            ]
            
        });
    };


    Ext.extend(TabGeneralPanel, Ext.Panel, {

        onSelectEmpresa: function( combo, record, index){
            alert(record.toSource())
        },
        onSelectContactoCliente: function( combo, record, index){
            //alert(record.toSource())
            store=combo.store;
            j=0;            

            Ext.getCmp("idconcliente").setValue(record.get("idcontacto"));
            Ext.getCmp("contacto").setValue(record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido"));

            //Ext.getCmp("vendedor").onTrigger1Click();
            Ext.getCmp("vendedor").setValue(record.data.vendedor);
            $("#vendedor").val(record.data.nombre_ven);
            combo.alertaCliente(record);
        }
    });

    TabEntradaPanel = function( config ){
        Ext.apply(this, config);       
        TabEntradaPanel.superclass.constructor.call(this, {
            activeTab:0,
            title:'Entrada',
            buttonAlign:'center',
            autoHeight:true,
            items:[
                {
                    xtype:'fieldset',                    
                    autoHeight:true,                    
                    items:[
                        {
                            xtype:'textfield',
                            width: 500,
                            fieldLabel: 'Asunto',
                            name: 'asunto',
                            value: '<? //=$cotizacion->getCaAsunto()   ?>',
                            allowBlank:false
                        }, {
                            xtype:'textfield',
                            width: 500,
                            fieldLabel: 'Saludo',
                            name: 'saludo',
                            id: 'saludo',
                            value: '',
                            allowBlank:false
                        }, {
                            xtype: 'textarea',
                            width: 500,
                            fieldLabel: 'Entrada',
                            name: 'entrada',
                            id: 'entrada',
                            value: '',
                            allowBlank:false
                        }, {
                            xtype: 'hidden',                            
                            name: 'entradaColmas',
                            id: 'entradaColmas'                            
                        }, {
                            xtype: 'hidden',                            
                            name: 'entradaColtrans',
                            id: 'entradaColtrans'                            
                        }, {
                            xtype: 'hidden',
                            name: 'entradaColdepósitos',
                            id: 'entradaColdepósitos'
                        }
                    ]
                }
            ]
        });
    };


    Ext.extend(TabEntradaPanel, Ext.Panel, {

    });

    TabSalidaPanel = function( config ){
        Ext.apply(this, config);
        TabSalidaPanel.superclass.constructor.call(this, {
            activeTab:0,
            title:'Salida',
            buttonAlign:'center',
            autoHeight:true,
            items:[
                {
                    xtype:'fieldset',                    
                    autoHeight:true,
                    items:[
                        {
                            xtype: 'textarea',
                            width: 500,
                            fieldLabel: 'Despedida',
                            name: 'despedida',
                            id: 'despedida',
                            value: '',
                            allowBlank:false
                        }, {
                            xtype: 'hidden',                          
                            name: 'despedidaDefault',
                            id: 'despedidaDefault'
                        }, {
                            xtype: 'hidden',                          
                            name: 'despedidaColdepósitos',
                            id: 'despedidaColdepósitos'
                        }, {
                            xtype: 'textarea',
                            width: 500,
                            fieldLabel: 'Anexos',
                            name: 'anexos',
                            id: 'anexos',
                            value: '',
                            allowBlank:false
                        }, {
                            xtype: 'hidden',                            
                            name: 'anexosColmas',
                            id: 'anexosColmas'                            
                        }, {
                            xtype: 'hidden',                            
                            name: 'anexosColtrans',
                            id: 'anexosColtrans'                            
                        }, {
                            xtype: 'hidden',                          
                            name: 'anexosColdepósitos',
                            id: 'anexosColdepósitos'
                        }
                    ]
                }
            ]
        });
    };


    Ext.extend(TabSalidaPanel, Ext.Panel, {

    });
    


    TabIdgPanel = function( config ){
        Ext.apply(this, config);
        TabIdgPanel.superclass.constructor.call(this, {
            activeTab:0,            
            buttonAlign:'center',
            autoHeight:true,
            title:'IDG',
            items:[
                {
                    xtype:'fieldset',                    
                    autoHeight:true,
                    items:[{
                            xtype:'datefield',
                            fieldLabel: 'Fecha de Presentación',
                            name: 'fchPresentacion',
                            id: 'fchPresentacion',
                            value: '',
                            format: "Y-m-d",
                            allowBlank:true,
                            width: 120
                        }, {
                            xtype:'timefield',
                            fieldLabel: 'Hora de Presentación',
                            name: 'horaPresentacion',
                            id: 'horaPresentacion',
                            value: '',
                            format: "H:i:s",
                            allowBlank:true,
                            width: 100
                        }, {
                            xtype:'textfield',
                            width: 400,
                            fieldLabel: 'Observaciones',
                            name: 'observaciones_idg',
                            id: 'observaciones_idg',
                            value: '',
                            allowBlank:true
                        }
                    ]
                }
            ]
        });
    };


    Ext.extend(TabIdgPanel, Ext.Panel, {

    });

    


    TabFormatoPanel = function( config ){
        Ext.apply(this, config);
        TabFormatoPanel.superclass.constructor.call(this, {
            activeTab:0,
            buttonAlign:'center',
            autoHeight:true,
            title:'Formato',
            items:[
                {
                    xtype:'fieldset',
                    autoHeight:true,
                    items:[
                        new Ext.form.ComboBox({
                            fieldLabel: 'Fuente',
                            typeAhead: true,
                            forceSelection: true,
                            triggerAction: 'all',
                            selectOnFocus: true,
                            name: 'fuente',
                            id: 'fuente_id',
                            lazyRender:true,
                            allowBlank: false,
                            value: '<? //=$cotizacion->getCaFuente()?$cotizacion->getCaFuente():"Tahoma"   ?>',
                            listClass: 'x-combo-list-small',
                            store : [
                                ['Arial', 'Arial'],
                                ['Calibri', 'Calibri'],
                                ['Tahoma', 'Tahoma']
                            ]
                        })
                    ]
                }
            ]
        });
    };

    Ext.extend(TabFormatoPanel, Ext.Panel, {

    });
</script>