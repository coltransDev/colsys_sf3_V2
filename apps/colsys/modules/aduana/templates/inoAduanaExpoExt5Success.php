<?
    $permisos=$sf_data->getRaw("permisos");
?>
<link rel="stylesheet" type="text/css"  href="/js/ext6/build/packages/charts/classic/classic/resources/charts-all.css"/>
<table  align="center">
    <tr><td><div id="idPrincipal"></div></td></tr>    
</table>
<script>
    
    Ext.Loader.setConfig({
        enabled: true,
        paths: {            
            'Colsys':'/js/Colsys'            
        }
    });

    Ext.onReady(function(){
        
        var permisos = Ext.decode('<?=json_encode($permisos)?>');
        
        Ext.define('ComboIdg', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-idg',
            store: ['SI', 'NO', 'COLLECT','FACTURA AL AGENTE']
        });

        Ext.create('Ext.panel.Panel', {
            width: 800,
            //height: 640,
            bodyPadding: 10,
            id:'panelEvento',            
            name:'panelEvento',
            scrollable: true,            
            renderTo: 'idPrincipal',            
            layout: {
                type: 'vbox',
                pack: 'start',
                align: 'stretch'
            }, 
            items: [
                Ext.create('Ext.form.Panel', {
                    title: 'Referencias Exportaciones Aduana',
                    bodyPadding: 5,
                    url: '/aduana/guardarReferenciaAduana',
                    layout: 'anchor',
                    defaults: {
                        anchor: '100%'
                    },                    
                    items: [
                        Ext.create('Colsys.Widgets.WgReferencias', {
                            fieldLabel: 'Referencia',
                            id: 'comboReferencia',
                            name: 'comboReferencia',
                            allowBlank: false,
                            idimpoexpo: 'expo',                    
                            forceSelection: true,
                            listeners: {
                                afterrender: function (ct, position) {
                                    var store = this.getStore();
                                    store.proxy.url = '/widgets5/datosComboReferenciasAduana/impoexpo/expo/';
                                },
                                select: function ( combo, record, eOpts ){
                                    
                                    var fchCerrado = record.data.m_ca_fchcerrado;                                    
                                    var disabled = fchCerrado != null?true:false;
                                    
                                    if (record.data.idagencia) {
                                        Ext.getCmp("agenciaad").store.add(
                                            {"idagencia": record.data.idagencia, "nombre": record.data.agencia}
                                        );
                                        Ext.getCmp("agenciaad").setValue(record.data.idagencia);
                                    }else{
                                        Ext.getCmp("agenciaad").setValue(null);
                                    }

                                    if (record.data.id_modalidad) {
                                        Ext.getCmp("ca_modalidad").store.add(
                                            {"id": record.data.id_modalidad, "name": record.data.ca_modalidad}
                                        );
                                        Ext.getCmp("ca_modalidad").setValue(record.data.id_modalidad);                                        
                                    }else{
                                        Ext.getCmp("ca_modalidad").setValue(null);                                        
                                    }

                                    if (record.data.aplicaidg) {                                            
                                        Ext.getCmp("aplicaidg").setValue(record.data.aplicaidg);
                                    }else{
                                        Ext.getCmp("aplicaidg").setValue(null);
                                    }                                        

                                    if(record.data.m_ca_transporte){
                                        Ext.getCmp("fmTransporte").setValue(record.data.m_ca_transporte);                                        
                                    }else{
                                        Ext.getCmp("fmTransporte").setValue(null);
                                    }                                                

                                    Ext.getCmp("comboReporte").origen = record.data.m_ca_destino;
                                    Ext.getCmp("comboReporte").destino = record.data.m_ca_origen;
                                    if(record.data.idreporte){
                                        Ext.getCmp("comboReporte").store.add(
                                            {"idreporte": record.data.idreporte, "consecutivo": record.data.consecutivo}
                                        );
                                        Ext.getCmp("comboReporte").setValue(record.data.idreporte);                                        
                                        this.up('panel').up("panel").cargarReferencia(combo.getValue(), fchCerrado);                                        
                                    }else{
                                        Ext.getCmp("comboReporte").setValue(null);                                                
                                    }
                                    
                                    /*Deshabilita la referencia para cualquier modificación*/
                                    var items = this.up("panel").getForm().getFields().items;                                    
                                    
                                    Ext.each(items, function (f) {
                                        if(f.id != "comboReferencia"){
                                            if(disabled){                                                
                                                f.setDisabled(disabled);                                                
                                            }else{
                                                if((f.id == "ca_modalidad" && f.getValue() !== null) || !permisos.Crear){
                                                    f.setDisabled(true);                                                    
                                                }else{
                                                    f.setDisabled(false);
                                                }
                                            }
                                        }
                                    });
                                    
                                    
                                    if(disabled){                                        
                                        Ext.getCmp('btn-save').hide();
                                        Ext.Msg.alert('Mensaje', 'Referencia Cerrada!');
                                    }else{
                                        Ext.getCmp('btn-save').show();
                                    }   
                                }
                            }
                        }),
                        Ext.create('Colsys.Widgets.WgAgentesAduana', {
                            fieldLabel: 'Agencia de Aduana',                        
                            forceSelection: true,
                            id: 'agenciaad',
                            name: 'agenciaad',                            
                            idtransporte: 'transporte',
                            allowBlank: false
                        }),                    
                        Ext.create('ComboIdg',{
                            fieldLabel: 'Aplica IDG',
                            forceSelection: true,
                            name: 'aplicaidg',
                            id: 'aplicaidg',                            
                            value: 'SI',
                            allowBlank: false
                        }),
                        {
                            xtype: 'Colsys.Widgets.WgParametros',
                            fieldLabel: 'R&eacute;gimen',
                            forceSelection: true,
                            id: 'ca_modalidad',
                            name: 'ca_modalidad',                            
                            allowBlank: false,                            
                            caso_uso: 'CU011'
                        },
                        {            
                            xtype:'Colsys.Widgets.WgTransporte',
                            fieldLabel: 'Transporte',
                            id:'fmTransporte',
                            name:'fmTransporte',
                            allowBlank:false,
                            listeners:{
                                select: function (combo, record, idx){
                                    Ext.getCmp("comboReporte").setDisabled(false);
                                    Ext.getCmp("comboReporte").idtransporte = combo.getValue();
                                    Ext.getCmp("comboReporte").idimpoexpo = "Exportación";
                                }
                            }
                        },
                        Ext.create('Colsys.Widgets.WgReporte', {
                            displayField: 'consecutivo',
                            fieldLabel: 'R. Negocio',
                            valueField: 'idreporte',
                            allowBlank:false,
                            forceSelection: true,                            
                            id: "comboReporte",
                            name: "comboReporte",
                            disabled: true
                        })
                    ],
                    buttons: [{
                        text: 'Guardar',
                        formBind: true, //only enabled once the form is valid
                        disabled: true,
                        id: 'btn-save',
                        handler: function() {
                            var form = this.up('form').getForm();
                            var panel = this.up('panel').up("panel");
                            var data = form.getValues();
                            if (form.isValid()) {
                                form.submit({
                                    success: function(form, action) {
                                        panel.cargarReferencia(data.comboReferencia);
                                        Ext.Msg.alert('Success', action.result.msg);
                                    },
                                    failure: function(form, action) {
                                        Ext.Msg.alert('Failed', action.result.msg);
                                    }
                                });
                            }
                        }
                    }]
                })
                
            ],
            cargarReferencia: function(idreferencia, fchCerrado){        
                var me=this;
                
                if(fchCerrado != null){
                    permisos.Crear = false;                    
                }
                
                this.idtransporte = 'Marítimo';
                this.idimpoexpo = 'Exportación';
                this.idmaster = "";

                    
                var tab = Ext.getCmp('tabpanel-refaduana');

                if(tab){
                    me.remove(tab);
                }
                
                me.add(
                    Ext.create('Ext.tab.Panel', {
                        id: 'tabpanel-refaduana',                            
                        items:[
                            Ext.create('Ext.tab.Panel', {
                                title: idreferencia,
                                id: 'tabpanel-sec-',
                                items: [
                                    Ext.create('Ext.form.Panel', {
                                        title: 'General',
                                        id: 'ref-aduana-',
                                        layout: {
                                        align: 'center',
                                        //type: 'vbox',                                    
                                        },
                                        height: 1000,
                                        //flex: 1,
                                        html: '<iframe id="reportframe" width="100%" height="100%" src="/Coltrans/Aduanas/ConsultaReferenciaAction.do?referencia='+idreferencia+'&consulta="></iframe>'
                                    }),
                                    {
                                        xtype: 'Colsys.Ino.GridEvento',
                                        title: "Eventos",
                                        id: "Eventos-",
                                        name: "Eventos-",
                                        idmaster: this.idmaster,
                                        idreferencia: idreferencia,
                                        permisos: permisos,
                                        plugins: [
                                            new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
                                        ],
                                        iconCls: 'event-add'
                                    },
                                    {
                                        xtype: 'Colsys.GestDocumental.treeGridFiles',
                                        title: "Documentos",
                                        id: "Documentos-0",
                                        name: "Documentos-0",
                                        idmaster: '0',
                                        idreferencia: idreferencia,
                                        idtransporte: this.idtransporte,
                                        idimpoexpo: this.idimpoexpo,
                                        permisos: this.permisos,
                                        iconCls: 'folder',
                                        height: 640,
                                        treeStore: 'documentosIno',
                                        listeners: {
                                            afterrender: function (ct, position) {
                                                Ext.getCmp("Documentos-0" ).setStore(Ext.create('Ext.data.TreeStore', {
                                                    fields: [
                                                        {name: 'idarchivo', type: 'string'},
                                                        {name: 'nombre', type: 'string'},
                                                        {name: 'documento', type: 'string'},
                                                        {name: 'iddocumental', type: 'string'},
                                                        {name: 'path', type: 'string'},
                                                        {name: 'ref1', type: 'string'},
                                                        {name: 'ref2', type: 'string'},
                                                        {name: 'ref3', type: 'string'},
                                                        {name: 'usucreado', type: 'string'},
                                                        {name: 'fchcreado', type: 'string'}
                                                    ],
                                                    proxy: {
                                                        type: 'ajax',
                                                        url: '/gestDocumental/dataFilesTree',
                                                        autoLoad: false,
                                                        extraParams: {
                                                            ref1: idreferencia,
                                                            ref2: "Colmas",
                                                            idsserie: 15,
                                                            exacto:"true"
                                                        }
                                                    },
                                                    autoLoad: true
//                                                    proxy: {
//                                                        type: 'ajax',
//                                                        url: '/gestDocumental/dataFilesTree',
//                                                        autoLoad: false
//                                                    },
//                                                    autoLoad: true
                                                }));
//                                                console.log(this.dockedItems.items[1].items.items[0]);
//                                                
//                                                var btnAdicionar = this.dockedItems.items[1].items.items[0];
//                                                
//                                                btnAdicionar.add({
//                                                    
//                                                })
                                            }

                                        }
                                    }
                                ]
                            })
                        ]
                    })
                );
                console.log('disabled2');
                console.log(Ext.getCmp('btn-save').disabled);
            }
        });
    });
</script>
