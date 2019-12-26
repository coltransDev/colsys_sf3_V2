<?
//include_component("widgets5", "wgTipoComprobante");
include_component("widgets5", "wgCliente");
?>
<script>
 
Ext.define('FormWsFactColdepositos', {
    extend: 'Ext.form.Panel',
    title: 'Filtros de búsqueda',
    bodyPadding: 5,    
    width: 1000,
    url: '<?= url_for("contabilidad/busquedaComprobantes") ?>',

    layout:'column',
    defaults: {        
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
        maxValue: new Date(),
        submitFormat: 'Y-m-d'
    },
    {
        xtype:'datefield',        
        fieldLabel: 'Fehca Final',
        name: 'fecha_final',
        id: 'fecha_final',
        format: "Y-m-d",
        altFormat: "Y-m-d",
        maxValue: new Date(),
        submitFormat: 'Y-m-d'
    },
    {
        xtype: 'wCliente',
        id:'idcliente',
        name:'idcliente',
        fieldLabel: 'Cliente',
        allowBlank:false,
        readonly:true
    },
    {
        fieldLabel: 'Doc.Transporte',
        name: 'doctransporte',
        id: 'doctransporte'
    }
    ],

    // Reset and Submit buttons
    buttons: [{
        text: 'Limpiar',
        handler: function() {
            this.up('form').getForm().reset();
        }
    }, {
        text: 'Buscar',        
        handler: function() {
            var fecha_inicial=Ext.getCmp("fecha_inicial").getRawValue();
            var fecha_final=Ext.getCmp("fecha_final").getRawValue();
            var doctransporte=Ext.getCmp("doctransporte").getValue();
            var idcliente=Ext.getCmp("idcliente").getValue();
            
            
            var storeTree=Ext.getCmp("grid-ws-fact-coldepositos").getStore();
            storeTree.load({
                params : {
                    'fecha_inicial' : fecha_inicial,
                    'fecha_final' : fecha_final,
                    'doctransporte' : doctransporte,
                    'idcliente':idcliente
                    
                }
            });
        
        }
    }]
});
 
</script>