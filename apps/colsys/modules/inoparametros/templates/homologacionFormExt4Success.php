<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("widgets", "wgCcostos");
include_component("widgets", "wgConceptos");

?>
<link rel="stylesheet" type="text/css" href="/js/ext4/examples/ux/css/ItemSelector.css" />

<script type="text/javascript">
Ext.Loader.setConfig({enabled: true});
//Ext.Loader.setPath('Ext.ux', '../ux');
Ext.Loader.setPath('Ext.ux', '/js/ext4/examples/ux');
Ext.require([
    'Ext.form.Panel',
    'Ext.ux.form.MultiSelect',
    'Ext.ux.form.ItemSelector'
]);

Ext.onReady(function(){
    
    var isForm = Ext.widget('form', {
        title: 'Administracion de conceptos Colsys-Siigo',
        width: 800,
        bodyPadding: 10,
        renderTo: 'itemselector',
        layout:'column',
        defaults:{
                columnWidth: 1/2.1,
                bodyStyle:'padding:0,marging:0',
                style:"text-align: left"
        },
        items:[
                {
                    bodyStyle:'padding:0,marging:0',                        
                    xtype: 'wCcostos',
                    id:'ccosto',
                    name:'idccosto',
                    width : 300,
                    fieldLabel: 'Centro Costo',
                    listeners:{                
                        'change': function ( obj, newValue, oldValue, eOpts )
                        {
                            var storeTmp=Ext.getCmp("concepto").getStore();
                            storeTmp.load({
                                params : {
                                    "idccosto" : newValue                                    
                                }
                            });
                            var storeTmp=Ext.getCmp("seleccion-conceptos").getStore();
                            storeTmp.load({
                                params : {
                                    "idccosto" : newValue,
                                    "idconcepto" : Ext.getCmp("concepto").getValue()
                                },
                                callback: function(records, operation, success) {
                                    var t=Ext.JSON.decode(operation.response.responseText);                                    
                                    Ext.getCmp("seleccion-conceptos").setValue(t.seleccionados);                                    
                                }
                            });
                            
                            
                        }
                   }
                }
                ,            
                {
                    //fieldStyle : 'font-size:19px', 
                    xtype: 'wConceptos',
                    id:'concepto',
                    name:'idconcepto',
                    width : 300,
                    fieldLabel: 'Concepto',
                    labelAlign : 'right',
                    listeners:{
                        select: function(combo, records, eOpts )
                        {                            
                            idconcepto=records[0].get('idconcepto');
                            Ext.Ajax.request({
                                url: '<?=url_for('inoparametros/datosConceptosHomo')?>',
                                params: {
                                    "idconcepto": idconcepto,
                                    "idccosto": Ext.getCmp("ccosto").getValue()
                                },
                                success: function(response, opts) {
                                   var t = Ext.decode(response.responseText);
                                   Ext.getCmp("seleccion-conceptos").setValue(t.seleccionados);
                                   //alert(obj.toSource());
                                   
                                },
                                failure: function(response, opts) {
                                   console.log('server-side failure with status code ' + response.status);
                                }
                             });
                            
                        }
                    }
                    
                },
                {
                    columnWidth: 1,
                    xtype: 'itemselector',
                    name: 'seleccionados',
                    anchor: '100%',
                    height : 300,
                    defaultAlign : 'left',
                    store:  Ext.create('Ext.data.Store', {
                        fields: ['id','name'],
                        proxy: {
                            type: 'ajax',
                            url: '<?=url_for('inoparametros/datosConceptosSiigo')?>',
                            reader: {
                                type: 'json',
                                root: 'root'
                            }
                        },
                        autoLoad: false
                    }),
                    displayField: 'name',
                    valueField: 'id',
                    //value: ['3', '4', '6','1'],
                    buttons :['add', 'remove'],
                    allowBlank: false,
                    msgTarget: 'side',
                    id:'seleccion-conceptos'
                }
            ],
        
        buttons: [
            {
                text: 'Guardar',
                handler: function(){
                    if(isForm.getForm().isValid()){
                        
                        isForm.getForm().submit({
                            url: '<?=url_for('inoparametros/guardarConceptosHomo')?>',                                
                                success: function(response, action) {
                                   var t = Ext.JSON.decode(action.response.responseText);
                                   if(t.success)
                                   {
                                       Ext.MessageBox.alert("ACTUALIZACION", "Se actualizo correctamente la informacion");
                                   }
                                   else if(t.error)
                                       Ext.MessageBox.alert("ERROR", "Se presento un error al guardar: '"+t.error+"'");
                                },
                                failure: function(response, opts) {
                                   console.log('server-side failure with status code ' + response.status);
                                }
                        })
                        
                    }
                }
            }
        ]
    });

});


</script>

<table width="60%" align="center"><tr><td width="100%" style="text-align: center" >

<div id="itemselector"></div>
</td></tr></table>



