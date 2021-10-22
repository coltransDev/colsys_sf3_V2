<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$years = $sf_data->getRaw("years");
$meses = $sf_data->getRaw("meses");
$sucursales = $sf_data->getRaw("sucursales");
//include_component("widgets", "wgCliente");
include_component("widgets4", "wgCliente");
?>

<script type="text/javascript">
Ext.Loader.setConfig({enabled: true});
Ext.Loader.setPath('Ext.ux', '/js/ext4/examples/ux');
Ext.require([
    'Ext.form.Panel',
    'Ext.ux.form.MultiSelect',
    'Ext.ux.form.ItemSelector'
]);



Ext.onReady(function(){


Ext.define('EmployeeModel', {
     extend: 'Ext.data.Model',
     fields: [
        {name: 'idcliente', mapping: 'ca_idcliente'},
        {name: 'compania', mapping: 'ca_compania'},
        {name: 'cargo', mapping: 'ca_cargo'},			
        {name: 'vendedor', mapping: 'ca_vendedor'},
        {name: 'nombre_ven', mapping: 'ca_nombre'},
        {name: 'listaclinton', mapping: 'ca_listaclinton'},
        {name: 'fchcircular', mapping: 'ca_fchcircular', type:'int'},
        {name: 'status', mapping: 'ca_status'},
        {name: 'confirmar', mapping: 'ca_confirmar'},
        {name: 'preferencias', mapping: 'ca_preferencias'},
        {name: 'coordinador', mapping: 'ca_coordinador'},
        {name: 'diascredito', mapping: 'ca_diascredito'},
        {name: 'cupo', mapping: 'ca_cupo'}
     ]
  });

  // remote store
  var employeeStore= new Ext.data.Store(
  {
     model: 'EmployeeModel',
     //pageSize: 10, 
     proxy: {
        url: '/widgets/listaClientesJSON',        
        type: 'ajax',
        autoLoad: true,
        reader: 
        {
           root: 'clientes',
           totalProperty: 'totalCount',
           id: 'id',
           type: 'json'
        }//,
       // simpleSortMode: true 
     }
  });



  var employeeBox = new Ext.form.ComboBox(
  {
     store: employeeStore,
     displayField: 'compania',
     valueField: 'idcliente',
     typeAhead: false,
     loadingText: 'buscando...',
     triggerAction: 'all',
     hiddenName: 'idcliente',
     name: 'cliente',
     id: 'cliente',
     fieldLabel: 'Cliente',
     selectOnFocus: true,
     allowBlank: false,
     anchor: '98%',
     width: 670,
     enableKeyEvents: true,
     //pageSize: true,
     //minListWidth: 220,
     minChars: 3,     
     labelWidth: 60
     //resizable: true
  });

    /*
     * Ext.ux.form.MultiSelect Example Code
     */
    var ds =new Ext.data.Store( {
     fields: ['year'],
     data : <?=json_encode($years )?>
    });
    
    var msForm = new Ext.form.Panel( {
        title: 'Generador de Informes Módulo Marítimo',
        anchor: '100%',
        
        bodyPadding: 10,
        layout:'column',
        renderTo: 'multiselect',
        defaults:{
                columnWidth: 1/4,
                bodyStyle:'padding:0,marging:0',
                style:"text-align: left"
        },
        items:[            
            {
                    
                    baseCls:'x-plain',
                    columnWidth: 1/5,
                    items:[{
                       xtype: 'multiselect',
                       title: 'Año',
                       msgTarget: 'side',
                       name: 'year',
                       allowBlank: false,
                       minSelections: 1,                       
                       store: new Ext.data.Store( {
                           fields: ['year'],
                           data : <?=json_encode($years )?>
                          }),
                       displayField: 'year',
                       valueField: 'year'
                   }]
                }
            ,
            {
                
                baseCls:'x-plain',                
                items:[{
                    //anchor: '100%',
                    xtype: 'multiselect',                    
                    title: 'Meses',
                    name: 'meses',
                    height : 230,
                    allowBlank: false,
                    minSelections: 1,
                    store: new Ext.data.Store( {
                        fields: ['id','valor'],
                        data : <?=json_encode($meses )?>
                       }),
                    displayField: 'valor',
                    valueField: 'id'
                }]
            },
            {
               
                baseCls:'x-plain',                
                items:[{
                    xtype: 'multiselect',
                    msgTarget: 'side',
                    title: 'Sucursales',
                    name: 'sucursales',
                    allowBlank: false,
                    minSelections: 1,
                    height : 230,
                    store: new Ext.data.Store( {
                        fields: ['id','valor'],
                        data : <?=json_encode($sucursales )?>
                       }),
                    displayField: 'valor',
                    valueField: 'id',
                    listeners:{
                        change:function (obj, newValue, oldValue, eOpts)
                        {
                            Ext.getCmp("vendedores").getStore().load({
                                    params : {
                                        sucursal : newValue
                                    }
                                });

                        }
                    }
                }]
            },
            {
                
                baseCls:'x-plain',     
                columnWidth: 1,
                items:[{
                    xtype: 'multiselect',
                    msgTarget: 'side',
                    title: 'Vendedores',
                    name: 'vendedores',
                    id: 'vendedores',
                    height : 230,
                    allowBlank: false,
                    minSelections: 1,
                    store: new Ext.data.Store({
                        fields: ['id','valor'],
                        proxy: {
                            type: 'ajax',
                            url: '<?=url_for('pruebas/datosVendedores')?>',
                            reader: {
                                type: 'json',
                                root: 'root'
                            }
                        },
                        autoLoad: false
                    }),
                    displayField: 'valor',
                    valueField: 'id'
                }]
            },
            {
                
                baseCls:'x-plain',
                anchor:'100%',
                items:[
                    //employeeBox
                    {
                            xtype: 'wCliente',
                            fieldLabel: "Cliente",
                            name: "idcliente",
                            id: "idcliente",                            
                            allowBlank: false                
                        }
                ]
            }
                /*,
                }
            {
                xtype: 'wCliente',
                id:'cliente',
                name:'cliente',
                fieldLabel: 'Cliente',                
                queryMode: 'local',
                displayField: 'compania',
                valueField: 'idcliente'                
            }*/
        
        ],
        buttons: [
        {
            text: 'Reset',
            handler: function() {
                msForm.getForm().reset();
            }
        }, {
            text: 'Buscar',
            handler: function(){
                if(msForm.getForm().isValid()){
                    Ext.Msg.alert('Submitted Values', 'The following will be sent to the server: <br />'+
                        msForm.getForm().getValues(true));
                }
            }
        }]
    });




    /*var ds =new Ext.data.Store( {
     fields: ['year'],
     data : <?=json_encode($years )?>
    });
    */
    /*new Ext.data.Store({
        autoLoad : true,
        reader: new Ext.data.JsonReader(
            {
                root: 'root'
            },
            fields['year']
        ),
        proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$years, "total"=>count($years), "success"=>true) )?> )
    });*/
    
    /*new Ext.data.ArrayStore({
        data: [[123,'One Hundred Twenty Three'],
            ['1', 'One'], ['2', 'Two'], ['3', 'Three'], ['4', 'Four'], ['5', 'Five'],
            ['6', 'Six'], ['7', 'Seven'], ['8', 'Eight'], ['9', 'Nine']],
        fields: ['value','text'],
        sortInfo: {
            field: 'value',
            direction: 'ASC'
        }
    })*/
    

    var isForm = Ext.widget('form', {
        title: 'ItemSelector Test',
        width: 700,
        bodyPadding: 10,
        renderTo: 'itemselector',

        tbar:[{
            text: 'Options',
            menu: [{
                text: 'Set value (2,3)',
                handler: function(){
                    isForm.getForm().findField('itemselector').setValue(['2', '3']);
                }
            },{
                text: 'Toggle enabled',
                handler: function(){
                    var m = isForm.getForm().findField('itemselector');
                    if (!m.disabled) {
                        m.disable();
                    } else {
                        m.enable();
                    }
                }
            },{
                text: 'Toggle delimiter',
                handler: function() {
                    var m = isForm.getForm().findField('itemselector');
                    if (m.delimiter) {
                        m.delimiter = null;
                        Ext.Msg.alert('Delimiter Changed', 'The delimiter is now set to <b>null</b>. Click Save to ' +
                                      'see that values are now submitted as separate parameters.');
                    } else {
                        m.delimiter = ',';
                        Ext.Msg.alert('Delimiter Changed', 'The delimiter is now set to <b>","</b>. Click Save to ' +
                                      'see that values are now submitted as a single parameter separated by the delimiter.');
                    }
                }
            }]
        }],

        items:[{
            xtype: 'itemselector',
            name: 'itemselector',
            anchor: '100%',
            fieldLabel: 'ItemSelector',
            imagePath: '/js/ext4/resources/css/ext-theme-neptune/images/',

            store: ds,
            displayField: 'year',
            valueField: 'year',
            //value: ['3', '4', '6'],

            allowBlank: false,
            // minSelections: 2,
            // maxSelections: 3,
            msgTarget: 'side'
        }],

        buttons: [{
            text: 'Clear',
            handler: function(){
                var field = isForm.getForm().findField('itemselector');
                if (!field.readOnly && !field.disabled) {
                    field.clearValue();
                }
            }
        }, {
            text: 'Reset',
            handler: function() {
                isForm.getForm().reset();
            }
        }, {
            text: 'Save',
            handler: function(){
                if(isForm.getForm().isValid()){
                    Ext.Msg.alert('Submitted Values', 'The following will be sent to the server: <br />'+
                        isForm.getForm().getValues(true));
                }
            }
        }]
    });

});

</script>

<table width="60%" align="center"><tr><td width="100%" style="text-align: center" >
<div id="multiselect"></div>
<div id="itemselector"></div>
</td></tr></table>