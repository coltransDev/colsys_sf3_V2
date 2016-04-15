<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>
    // create the grid
    //var grid = Ext.create('Ext.grid.Panel', {
    Ext.define('GridBodegas',{
        extend: 'Ext.grid.Panel',
        bufferedRenderer: true,
        selModel: {
            pruneRemoved: false
        },
        store: Ext.create('Ext.data.Store', {            
            fields: [
                { name: 's_ca_idbodega'       },
                { name: 's_ca_nombre'         },
                { name: 's_ca_tipo'           },
                { name: 's_ca_transporte'     },
                { name: 's_ca_cod_dian'       },
                { name: 's_ca_direccion'      },
                { name: 's_ca_identificacion' }
            ],
            autoLoad: true,
            remoteSort: false,
            proxy: {
                type: 'ajax',
                url: '/config/datosBodegas',
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                }
            }
        }),
        columns: [            
            
            {text: "Nombre",            dataIndex: 's_ca_nombre',         sortable: true, width:350, editor: {xtype: "textfield"}},
            {text: "Tipo",              dataIndex: 's_ca_tipo',           sortable: true, width:130, editor: {xtype: "textfield"}},
            {text: "Transporte",        dataIndex: 's_ca_transporte',     sortable: true, width:100, editor: {xtype: "textfield"}},
            {text: "Codigo Dian",       dataIndex: 's_ca_cod_dian',       sortable: true, width:150, editor: {xtype: "textfield"}},
            {text: "Direccion",         dataIndex: 's_ca_direccion',      sortable: true, width:350, editor: {xtype: "textfield"}},
            {text: "Identificacion",    dataIndex: 's_ca_identificacion', sortable: true, width:130, editor: {xtype: "textfield"}},
            
            
        ],
        plugins: [new Ext.grid.plugin.CellEditing({
                    clicksToEdit: 1
                })],
        listeners:{
            edit : function(editor, e, eOpts)
            {
                //alert(e.field);
                /*var store = this.store;
                if(e.field=="empresa")
                {
                    store.data.items[e.rowIdx].set('ca_idempresa', e.value);                    
                    store.data.items[e.rowIdx].set('empresa', editor.editors.items[0].field.rawValue);
                }*/
            }
        },
        tbar: [
            {
                text: 'Nuevo',
                iconCls: 'add',
                handler: function() {
                    //alert(record.data.toSource());
                    var store=this.up("grid").getStore();
                    var r = Ext.create(store.getModel());
                    store.insert(0, r);
                }
            },
            {
                text: 'Guardar',
                iconCls: 'add',
                id:'btn-guardarBodega',
                handler : function(){
                    Ext.getCmp('btn-guardarBodega').disable();
                    //var store = this.store;//Ext.getCmp("grid-facturacion").getStore();
                    var store=this.up("grid").getStore();
                    //alert(store);
                    var records = store.getModifiedRecords();
                    var lenght = records.length;
                    //alert(records[0].data.toSource());
                    //return;
                    changes=[];
                    for( var i=0; i< lenght; i++){
                        r = records[i];

                         if(/* r.data.idconcepto!="" && r.data.valor!="" &&*/ r.getChanges())
                         {
                            records[i].data.id=r.id;
                            changes[i]=records[i].data;
                         }
                    }

                    var str= JSON.stringify(changes);
                    if(str.length>5)
                    {
                        Ext.Ajax.request({
                                url: '<?= url_for("config/guardarBodegas") ?>',
                                params: {                            
                                    datos:str                            
                                },
                                success: function(response, opts) {
                                    var res = Ext.decode(response.responseText);

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
                                    if(res.errorInfo!="" && res.errorInfo!="null" &&  res.errorInfo!=null)
                                    {
                                        Ext.MessageBox.alert("Mensaje",'No fue posible el guardar la fila <br>'+res.errorInfo);
                                    }
                                    Ext.getCmp('btn-guardarBodega').enable();
                                },
                                failure: function(response, opts) {
                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                    box.hide();
                                    Ext.getCmp('btn-guardarBodega').enable();
                                }
                            });
                    }
                    else
                        Ext.getCmp('btn-guardarBodega').enable();
                }
            },
            {
                text: 'Recargar',
                iconCls: 'refresh',
                id:'btn-guardarrecarga',
                handler : function(){
                    this.up("grid").getStore().reload();
                }
            },
            '|'
            ,
            {
                xtype: "textfield",
                fieldLabel: 'Buscar',
                listeners:{
                    change:function( obj, newValue, oldValue, eOpts )
                    {
                        var store=this.up("grid").getStore();
                        store.clearFilter();
                        if(newValue!="")
                        {
                     
                            store.filterBy(function(record, id){
                                var str=record.get("s_ca_nombre");
                                var str1=(!record.get("s_ca_identificacion"))?"":record.get("s_ca_identificacion");
                                var txt=new RegExp(newValue,"ig");
                                if(str.search(txt) == -1 && str1.search(txt) == -1 )
                                    return false;
                                else
                                    return true;
                            });
                        }
                        /*else
                        {
                            this.store.filter("","",true,true);
                        }*/
                    }
                    
                }
            }
            


        ],
        //forceFit: true,
        height:500//,
        //split: true,
        //region: 'north'
    });
    
</script>

