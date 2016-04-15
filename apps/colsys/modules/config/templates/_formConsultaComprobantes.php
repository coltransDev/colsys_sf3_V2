<?
include_component("widgets5", "wgTipoComprobante");
?>
<script>
 
Ext.define('FormConsultaComprobantes', {
    extend: 'Ext.form.Panel',
    title: 'Importar Numeros Radicacion Muisca',
    bodyPadding: 5,
    //standardSubmit: true,
    width: 1000,
    url: '<?= url_for("inoMaritimo/NumerosRadicacion") ?>',

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
        xtype:'filefield',        
        fieldLabel: 'Archivo',
        name: 'archivo',
        id: 'archivo'
    }   
    //new Ext.colsys.wgTipoComprobante({fieldLabel: 'Tipo Comprobante',
    //    name: 'tipo_comprobante'})
    ],

    // Reset and Submit buttons
    buttons: [{
        text: 'Enviar',
        //formBind: true, //only enabled once the form is valid
        //disabled: true,
        handler: function() {
            /*var form = this.up('form').getForm();
            if (form.isValid()) {
                form.submit({
                    success: function(form, action) {
                       Ext.Msg.alert('Success', action.result.html);
                    },
                    failure: function(form, action) {
                        Ext.Msg.alert('Failed', action.result.msg);
                    }
                });
            }*/
        
            this.up('form').getForm().submit();
            
            /*var fecha_inicial=Ext.getCmp("fecha_inicial").getRawValue();
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
            });*/
        
        }
    }]//,
    //renderTo: Ext.getBody()
});
 
</script>