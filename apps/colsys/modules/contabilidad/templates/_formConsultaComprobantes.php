<?
include_component("widgets5", "wgTipoComprobante");
?>
<script>
 
Ext.define('FormConsultaComprobantes', {
    extend: 'Ext.form.Panel',
    title: 'Filtros de búsqueda',
    bodyPadding: 5,
    //standardSubmit: true,
    width: 1000,
    url: '<?= url_for("contabilidad/busquedaComprobantes") ?>',

    layout:'column',
    defaults: {
        //anchor: '100%'
        columnWidth: 1/3,
        labelAlign:'right'
    },

    // The fields
    defaultType: 'textfield',
    items: [
    {        
        xtype:'datefield',
        
        fieldLabel: 'Fehca Inicial',
        name: 'fecha_inicial',
        id: 'fecha_inicial',        
        format: "Y-m-d",
        altFormat: "Y-m-d",
        submitFormat: 'Y-m-d'
    },
    {
        xtype:'datefield',        
        fieldLabel: 'Fehca Final',
        name: 'fecha_final',
        id: 'fecha_final',
        format: "Y-m-d",
        altFormat: "Y-m-d",        
        submitFormat: 'Y-m-d'
    },
    /*{
        fieldLabel: 'Tipo Comprobante',
        name: 'tipo_comprobante'
    },*/
    {
        fieldLabel: 'No Referencia',
        name: 'ca_referencia',
        id: 'ca_referencia',
        listeners: {
            specialkey: function(field, e){
                if (e.getKey() == e.ENTER)                                                     
                    this.up("form").SpecialKey(field, e);                                                    
            }
        }
    },
    {
        fieldLabel: 'No Comprobante',
        name: 'no_comprobante',
        id: 'no_comprobante',
        listeners: {
            specialkey: function(field, e){
                if (e.getKey() == e.ENTER)                                                     
                    this.up("form").SpecialKey(field, e);                                                    
            }
        }
    },
    {
        fieldLabel: 'No Comprobante 2',
        name: 'no_comprobante2',
        id: 'no_comprobante2',
        listeners: {
            specialkey: function(field, e){
                if (e.getKey() == e.ENTER)                                                     
                    this.up("form").SpecialKey(field, e);                                                    
            }
        }
    },
    {
        xtype: 'wTipoComprobante',
        id:'idtipocomprobante',
        name:'idtipocomprobante',
        fieldLabel: 'Tipo'
    },
    Ext.create('Ext.form.ComboBox', {
        fieldLabel: 'Estado',
        id:'ca_estado',
        name:'ca_estado',
        store: Ext.create('Ext.data.Store', {
            fields: ['id', 'name'],
            data : [
                {"id":"", "name":""},
                {"id":"2", "name":"Sin enviar"},
                {"id":"5", "name":"Procesado"},
                {"id":"6", "name":"Error"}
            ]
        }),
        queryMode: 'local',
        displayField: 'name',
        valueField: 'id'
    })
    ],
    // Reset and Submit buttons
    buttons: [{
        text: 'Limpiar',
        handler: function() {
            this.up('form').getForm().reset();
        }
    }, {
        text: 'Buscar',
        //formBind: true, //only enabled once the form is valid
        //disabled: true,
        handler: function() {        
            this.up('form').SpecialKey();
        
        }
    }],
    SpecialKey : function()
    {
            var fecha_inicial=Ext.getCmp("fecha_inicial").getRawValue();
            var fecha_final=Ext.getCmp("fecha_final").getRawValue();
            var no_comprobante=Ext.getCmp("no_comprobante").getValue();
            var idtipocomprobante=Ext.getCmp("idtipocomprobante").getValue();
            var ca_referencia=Ext.getCmp("ca_referencia").getValue();
            var no_comprobante2=Ext.getCmp("no_comprobante2").getValue();
            var ca_estado=Ext.getCmp("ca_estado").getValue();
            
            var storeTree=Ext.getCmp("grid-consulta-comprobantes").getStore();
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