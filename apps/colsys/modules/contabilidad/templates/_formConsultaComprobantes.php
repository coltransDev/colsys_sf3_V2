<?
include_component("widgets5", "wgTipoComprobante");
?>
<script>
Ext.define('FormConsultaComprobantes', {
    extend: 'Ext.form.Panel',
    title: 'Filtros de búsqueda',
    bodyPadding: 5,    
    url: '<?= url_for("contabilidad/busquedaComprobantes") ?>',    
    listeners: {
        render: function (me, eOpts) {            
            this.add({
                xtype:'fieldset',        
                autoHeight:true,
                layout:'column',
                columns: 3,
                defaults:{
                    columnWidth:0.3333,
                    layout:'form',
                    border:false,
                    bodyStyle:'padding:4px'
                },        
                items:[
                    {            
                        border:false,                                
                        items:[{        
                            xtype:'datefield',
                            fieldLabel: 'Fecha Inicial',
                            name: 'fecha_inicial',
                            id: 'fecha_inicial'+this.idpanel,
                            tabIndex: 1,
                            width: 30,
                            format: "Y-m-d",
                            altFormat: "Y-m-d",
                            submitFormat: 'Y-m-d'
                        },
                        {
                            xtype:'textfield',
                            fieldLabel: 'No Comprobante',
                            name: 'no_comprobante',
                            id: 'no_comprobante'+this.idpanel,
                            tabIndex: 3,
                            listeners: {
                                specialkey: function(field, e){
                                    if (e.getKey() == e.ENTER)                                                     
                                        this.up("form").SpecialKey(field, e);                                                    
                                }
                            }
                        }]
                    },
                    {            
                        border:false,                                
                        items:[{
                            xtype:'datefield',        
                            fieldLabel: 'Fecha Final',
                            tabIndex: 2,
                            name: 'fecha_final',
                            id: 'fecha_final'+this.idpanel,
                            format: "Y-m-d",
                            altFormat: "Y-m-d",        
                            submitFormat: 'Y-m-d'
                        },
                        {
                            xtype:'textfield',
                            fieldLabel: 'No Comprobante 2',
                            name: 'no_comprobante2',
                            id: 'no_comprobante2'+this.idpanel,
                            tabIndex: 4,
                            listeners: {
                                specialkey: function(field, e){
                                    if (e.getKey() == e.ENTER)                                                     
                                        this.up("form").SpecialKey(field, e);                                                    
                                }
                            }
                        }]
                    },
                    {            
                        border:false,                                
                        items:[{
                            xtype:'textfield',
                            fieldLabel: 'No Referencia',
                            name: 'ca_referencia',
                            id: 'ca_referencia'+this.idpanel,
                            tabIndex: 5,
                            listeners: {
                                specialkey: function(field, e){
                                    if (e.getKey() == e.ENTER)                                                     
                                        this.up("form").SpecialKey(field, e);                                                    
                                }
                            }
                        },
                        {
                            xtype: 'Colsys.Widgets.WgTiposcomprobantes',
                            id:'idtipocomprobante'+this.idpanel,
                            tabIndex: 6,
                            name:'idtipocomprobante',
                            fieldLabel: 'Tipo',
                            displayField: 'titulo',
                            origen:'consulta'
                        },
                        Ext.create('Ext.form.ComboBox', {
                            fieldLabel: 'Estado',
                            id:'ca_estado'+this.idpanel,
                            tabIndex: 7,
                            name:'ca_estado',
                            store: Ext.create('Ext.data.Store', {
                                fields: ['id', 'name'],
                                data : [
                                    {"id":"", "name":""},
                                    //{"id":"2", "name":"Sin enviar"},
                                    {"id":"5", "name":"Activo"},
                                    {"id":"8", "name":"Anulado"}
                                ]
                            }),
                            queryMode: 'local',
                            displayField: 'name',
                            valueField: 'id'
                        })]
                    }
                ]
            })
            
            var obj = {
                xtype: 'toolbar',
                dock: 'bottom',
                ui: 'footer',
                defaults: {
                    minWidth: 200
                },
                items: [
                    { xtype: 'component', flex: 1 },
                    {
                        xtype: 'button',
                        height: 30,
                        id: 'button-limpiar'+this.idpanel,
                        text: 'Limpiar',
                        docked: 'bottom',
                        handler: function() {
                            this.up('form').getForm().reset();
                        }
                    },{
                        xtype: 'button',
                        height: 30,
                        id: 'button-buscar'+this.idpanel,
                        tabIndex: 8,
                        text: 'Buscar',
                        docked: 'bottom',
                        //formBind: true, //only enabled once the form is valid
                        //disabled: true,
                        handler: function() {        
                            this.up('form').SpecialKey();
                        }
                    }
                ]
            }
        this.addDocked(obj);            
        }
    },    
    SpecialKey : function(idpanel)
    {
            var idpanel = Ext.getCmp("form-consulta-comprobantes").idpanel;
            
            var fecha_inicial = Ext.getCmp("fecha_inicial"+idpanel).getRawValue();
            var fecha_final = Ext.getCmp("fecha_final"+idpanel).getRawValue();
            var no_comprobante = Ext.getCmp("no_comprobante"+idpanel).getValue();
            var idtipocomprobante =Ext.getCmp("idtipocomprobante"+idpanel).getValue();
            var ca_referencia = Ext.getCmp("ca_referencia"+idpanel).getValue();
            var no_comprobante2 = Ext.getCmp("no_comprobante2"+idpanel).getValue();
            var ca_estado = Ext.getCmp("ca_estado"+idpanel).getValue();
            
            var storeTree = Ext.getCmp("grid-consulta-comprobantes").getStore();
            storeTree.load({
                params : {
                    'fecha_inicial' : fecha_inicial,
                    'fecha_final' : fecha_final,
                    'ca_referencia' : ca_referencia,
                    'no_comprobante' : no_comprobante,
                    'no_comprobante2' : no_comprobante2,
                    'idtipocomprobante' : idtipocomprobante,
                    'ca_estado': ca_estado
                }
            });
    }
}); 
</script>