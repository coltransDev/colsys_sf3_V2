<?
//include_component("widgets5", "wgTipoComprobante");
?>
<script>
 
Ext.define('FormCabControl', {
    extend: 'Ext.form.Panel',
    title: 'Importar Cuadro Control',
    bodyPadding: 5,
    id:'form-control-1',
    //standardSubmit: true,
    width: 1000,

    //layout:'column',
    layout: {
        type: 'vbox',       // Arrange child items vertically
        align: 'stretch',    // Each takes up full width
        padding: 5
    },
    

    // The fields
    defaultType: 'textfield',
    items: [
        {
            xtype:'panel',
            title: 'cargar Archivo Control',
            bodyPadding: 5,
            layout:'form',
            defaults: {
                labelAlign:'right'
                
            },
            items: [
            {        
                xtype:'filefield',        
                fieldLabel: 'Archivo',
                name: 'archivo',
                id: 'archivo'
            },
            {
                xtype: 'button',
                text : 'Cargar',
                alignTarget: 'right',
                listeners:{
                    click:function( obj, e, eOpts )
                    {
                        this.up('form').getForm().submit(
                        {
                            url: '<?= url_for("indicadoresAdu/GuardarArchivoControl") ?>',
                            scope: this,
                            waitMsg: 'Uploading...',
                            success: function (formPanel, action) {
                                var data = Ext.decode(action.response.responseText);
                                Ext.getCmp("fileName").setValue(data.fileName);
                                Ext.getCmp("hoja").getStore().loadData(data.hojas);                                
                            },
                            failure: function (formPanel, action) {
                                var data = Ext.decode(action.response.responseText);
                                alert("Failure: " + data.msg);
                            }
                        });
                    }
                }
                
            }
            ]
        },
        {
            xtype:'panel',
            title: 'Datos',
            bodyPadding: 5,
            layout:'table',
            defaults: {
                //anchor: '100%'
                //columnWidth: 1/6,
                labelAlign:'right',
                labelWidth:50
                
            },
            items: [
                {
                    //xtype:"hiddenfield",
                    fieldLabel: 'Archivo',
                    xtype:"textfield",
                    id:"fileName",
                    name:"fileName"
                },
                {
                    xtype:"datefield",
                    fieldLabel: 'Fecha',                    
                    id:"fecha",
                    name:"fecha",
                    format: "Y-m-d",
                    altFormat: "Y-m-d",
                    submitFormat: 'Y-m-d',
                    width:180
                },
                {
                    fieldLabel: 'Hoja',
                    xtype:"combo",
                    id:"hoja",
                    name:"hoja",
                    width:300,
                    store:new Ext.data.JsonStore({
                        data: [],
                        autoLoad: false,
                        root: 'data',
                        fields: [                  
                              { name: 'name'}
                        ]                        
                    }),
                    valueField: 'name',
                    displayField: 'name',
                    
                },
                {
                    fieldLabel: 'Muelle',
                    xtype:"combo",
                    id:"muelle",
                    name:"muelle",
                    //width:400,
                    store:new Ext.data.JsonStore({
                        data: [{'name':'SPRBUN'},{'name':'TCBUEN'}],
                        autoLoad: false,
                        root: 'data',
                        fields: [                  
                              { name: 'name'}
                        ]
                    }),
                    valueField: 'name',
                    displayField: 'name'
                }            
            ]
        }
    ],

    // Reset and Submit buttons
    buttons: [{
        text: 'Importar',
        
        handler: function() {
            
        this.up('form').getForm().submit(
        {
            url: '<?= url_for("indicadoresAdu/ProcesarArchivoControl") ?>',
            scope: this,
            waitMsg: 'Uploading...',
            success: function (formPanel, action) {
                var data = Ext.decode(action.response.responseText);
                Ext.getCmp("grid-consulta-cabcontrol").getStore().reload();
                
            },
            failure: function (formPanel, action) {
                var data = Ext.decode(action.response.responseText);
                alert("Failure: " + data.msg);
            }
        });
        }
    }]

});
 
</script>