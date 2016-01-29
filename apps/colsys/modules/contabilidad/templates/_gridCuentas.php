<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//include_component("widgets5", "wgEmpresas");
?>
<script>

    Ext.define('GridCuentas',{
        extend: 'Ext.grid.Panel',
        bufferedRenderer: false,
        store: Ext.create('Ext.data.Store', {
            fields: [
                { name: 'codigocuenta', mapping: 's_codigocuenta' },
                { name: 'nombrecuenta', mapping: 's_nombrecuenta' },
                { name: 'ca_idempresa', mapping: 's_ca_idempresa' },
                { name: 'empresa', mapping: 'e_ca_nombre' }
            ],
            autoLoad: true,
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
            {text: "Codigo", dataIndex: 'codigocuenta', width:150, sortable: true, editor: {xtype: "textfield"}},
            {text: "Nombre",  dataIndex: 'nombrecuenta',width:350, sortable: true,editor: {xtype: "textfield"}},       
            {text: "Empresa",  dataIndex: 'empresa', width:150, sortable: true, editor: new wgEmpresas()}
        ],
        plugins: [new Ext.grid.plugin.CellEditing({
                    clicksToEdit: 1
                })],
        listeners:{
            edit : function(editor, e, eOpts)
            {
                //alert(e.field);
                var store = this.store//Ext.getCmp("grid-facturacion").getStore();
                if(e.field=="empresa")
                {
                    //alert(editor.editors.items[0].field.rawValue);
                    //alert(e.value);
                    store.data.items[e.rowIdx].set('ca_idempresa', e.value);
                    //alert(editor.editors.items[0].field.rawValue);
                    store.data.items[e.rowIdx].set('empresa', editor.editors.items[0].field.rawValue);
                }
            }
        },
        tbar: [
            {
                text: 'Agregar',
                iconCls: 'add',
                handler : function(){        
                    //var store = Ext.getCmp("grid-facturacion").getStore();            
                    //Ext.getCmp("grid-facturacion").ventanaFac(null);
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
                                url: '<?= url_for("contabilidad/guardarGridCuentas") ?>',
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
            }

        ],
        height:500
    });
</script>
