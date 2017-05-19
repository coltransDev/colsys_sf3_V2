<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//include_component("widgets5", "wgEmpresas");
$puedeBorrar = $sf_data->getRaw("puedeBorrar");
?>
<script>
    var combo = new wgEmpresas({
        displayField: 'name',
        valueField: 'id'
    });
    var comboBoxRenderer = function(combo) {
        return function(value) {   
        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField) );
       
        };
    }
            
    Ext.define('GridCuentas',{
        extend: 'Ext.grid.Panel',
        bufferedRenderer: false,
        store: Ext.create('Ext.data.Store', {
            fields: [
                { name: 'codigocuenta', mapping: 's_codigocuenta' },
                { name: 'nombrecuenta', mapping: 's_nombrecuenta' },
                { name: 'ca_idempresa', mapping: 's_ca_idempresa' },
                { name: 'empresa', mapping: 'e_ca_nombre' },
                { name: 'id_cuenta',mapping: 's_ca_idcuenta' },
                { name: 'borrado', mapping: 'borrado' }
            ],
            autoLoad: false,
            remoteSort: true,
            proxy: {
                type: 'ajax',
                url: '/contabilidad/datosCuentas',
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                }
            }
        }),
        
        columns: [   
            {xtype: "checkcolumn",  dataIndex: 'borrado', width: 40            }, 
            {text: "idcuenta", dataIndex: 'id_cuenta', width:150, hidden: true, sortable: true, editor: {xtype: "textfield"}},
            {text: "Codigo", dataIndex: 'codigocuenta', width:150, sortable: true, editor: {xtype: "textfield"}},
            {text: "Nombre",  dataIndex: 'nombrecuenta',width:700, sortable: true,editor: {xtype: "textfield"}},       
            {text: "Empresa",  dataIndex: 'ca_idempresa', width:150, hidden: true, sortable: true, editor: combo,renderer: comboBoxRenderer(combo)}
        ],
        plugins: [new Ext.grid.plugin.CellEditing({
                    clicksToEdit: 1
                })],
        listeners:{
            edit : function(editor, e, eOpts)
            {
                //alert(e.field);
                var store = this.store;//Ext.getCmp("grid-facturacion").getStore();
                /*if(e.field=="empresa")
                {
                    //alert(e.rowIdx);
                    //alert(editor.editors.items[0].field.rawValue + " "+e.value);
                    //alert(e.value );
                    //console.log(e);
                    store.data.items[e.rowIdx].set('ca_idempresa', e.value);
                    console.log(editor.editors.items);
                    store.data.items[e.rowIdx].set('empresa', editor.editors.items[0].field.rawValue);
                    //store.data.items[e.rowIdx].set('empresa', e.originalValue);
                }*/
            }
        },
        tbar: [
            {
                text: 'Agregar',
                iconCls: 'add',
                handler : function(){        
                    var store=this.up("grid").getStore();
                    var r = Ext.create(store.getModel());
                    store.insert(0, r);
                }
            },
            {
                text: 'Guardar',
                iconCls: 'add',
                id:'btn-guardar',
                handler : function(){
                    Ext.getCmp('btn-guardar').disable();
                    var store = this.store;//Ext.getCmp("grid-facturacion").getStore();
                    var store=this.up("grid").getStore();
                    //alert(store);
                    var records = store.getModifiedRecords();
                    var lenght = records.length;
                    changes=[];
                    for( var i=0; i< lenght; i++){
                        r = records[i];

                         if(r.getChanges())
                         {
                            records[i].data.id=r.id;
                            changes[i]=records[i].data;
                         }
                    }

                    var str= JSON.stringify(changes);
                    if(str.length>5)
                    {
                        Ext.Ajax.request({
                                url: '<?= url_for("contabilidad/guardarGridCuentas") ?>',
                                params: {                            
                                    datos:str                            
                                },
                                success: function(response, opts) {                                    
                                    var res = Ext.decode(response.responseText);
                                    //var store =  Ext.getCmp('grid-cuentas').getStore();
                                    //store.reload();
                                    
                                    if( res.id && res.success)
                                    {
                                        id=res.id.split(",");                                        
                                        for(i=0;i<id.length;i++)
                                        {
                                            var rec = store.getById(id[i]);                                            
                                            rec.commit();                                    
                                        }
                                        Ext.MessageBox.alert("Mensaje",'Se guardo Correctamente la información');
                                    }
                                    if(res.errorInfo!="" && res.errorInfo!="null")
                                    {
                                        Ext.MessageBox.alert("Mensaje",'No fue posible el guardar la fila <br>'+res.errorInfo);
                                    }
                                    Ext.getCmp('btn-guardar').enable();
                                },
                                failure: function(response, opts) {
                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                    box.hide();
                                    Ext.getCmp('btn-guardar').enable();
                                }
                            });
                    }
                    else
                        Ext.getCmp('btn-guardar').enable();
                }
            },{
                xtype: 'exporterbutton',
                text: 'XLS',
                iconCls: 'csv',
                format:'excel'
            }, {
                xtype: 'button',               
                text: 'Eliminar',
                iconCls: 'delete',
                width: 25,
                allowBlank: false,
                hidden: <?=$puedeBorrar?>,
                handler: function() {
                    var store =  Ext.getCmp('grid-cuentas').getStore();   
                    x = 0;
                    changes = [];
                    for (var i = 0; i < store.getCount(); i++) {
                        var record = store.getAt(i);                        
                        if (record.get("borrado")) {                            
                                record.data.id = record.id
                                changes[x] = record.data;
                                x++;                                
                        } 
                    }                    
                    var strGrid = JSON.stringify(changes);                    
                    Ext.Ajax.request({
                        waitMsg: 'Guardando cambios...',
                        url: '<?= url_for("contabilidad/eliminarGridCuentas") ?>',

                        params: {                                    
                            datos: strGrid 
                        },
                        failure: function(response, options) {
                            var res = Ext.util.JSON.decode(response.responseText);
                            if (res.errorInfo)
                                Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.errorInfo);
                            else
                                Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                        },
                        success: function(response, options) {
                            var store =  Ext.getCmp('grid-cuentas').getStore();
                            store.reload();
                            if (changes.length >0)
                                Ext.MessageBox.alert("Mensaje", 'Datos Eliminados Correctamente<br>');                                             
                        }
                    });                         
                }
                
            }, {
                xtype: 'wempresas',
                hideLabel: false,
                fieldLabel: 'Empresa',
                labelWidth: 80,
                name: 'filtro_empresas',
                id: 'filtro_empresas',
                width: 220,
                allowBlank: false
            }, {
                xtype: 'button',
                hideLabel: false,
                text: 'Buscar',
                iconCls: 'search',
                width: 25,
                allowBlank: false,                
                handler: function() {
                    //console.log(this.up(""));
                    var idempresa = Ext.getCmp("filtro_empresas").getValue();
                    var store =  Ext.getCmp('grid-cuentas').getStore();
                    store.load({
                        params : {
                            idempresa: idempresa
                        }
                    })
                }
                
            },{
                xtype: "textfield",
                fieldLabel: 'Filtrar',
                labelWidth: 40,
                listeners:{
                    change:function( obj, newValue, oldValue, eOpts )
                    {
                        
                        //var storeTree=Ext.getCmp("grid-consulta-comprobantes").getStore();
                        var store =  Ext.getCmp('grid-cuentas').getStore();
                        store.clearFilter();
                        if(newValue!=""){
                                                 
                            store.filterBy(function(record, id){
                            var str=record.get("codigocuenta");
                            var str1=record.get("nombrecuenta");
                            //var str2=record.get("empresa");
                            
                            if(str.toString().toUpperCase().contains(newValue.toUpperCase()) || str1.toString().toUpperCase().contains(newValue.toUpperCase()) ){
                                return true;
                            }
                            else{
                                return false;
                            }
                           
                            });
                        }
                        
                    }
                    
                }
            },

        ],
        height:500
    });
</script>
