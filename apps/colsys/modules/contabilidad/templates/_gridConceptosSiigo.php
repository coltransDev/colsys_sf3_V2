<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//include_component("widgets5", "wgEmpresas");
?>
<script>
    // create the grid
    //var grid = Ext.create('Ext.grid.Panel', {
    Ext.define('GridConceptosSiigo',{
        extend: 'Ext.grid.Panel',
        bufferedRenderer: true,
        selModel: {
            pruneRemoved: false
        },
        store: Ext.create('Ext.data.Store', {            
            fields: [
                { name: 'ca_idconceptosiigo', mapping: 's_ca_idconceptosiigo' },
                { name: 'ca_cod', mapping: 's_ca_cod' },
                { name: 'ca_descripcion', mapping: 's_ca_descripcion' },
                { name: 'ca_cuenta', mapping: 's_ca_cuenta' },
                { name: 'ca_cc', mapping: 's_ca_cc' },
                { name: 'ca_scc', mapping: 's_ca_scc' },
                { name: 'ca_valor', mapping: 's_ca_valor' },
                { name: 'ca_pt', mapping: 's_ca_pt' },
                { name: 'ca_iva', mapping: 's_ca_iva' },
                { name: 'ca_porciva', mapping: 's_ca_porciva' },
                { name: 'ca_retfte', mapping: 's_ca_retfte' },
                { name: 'ca_cuentarf', mapping: 's_ca_cuentarf' },
                { name: 'ca_baserf', mapping: 's_ca_baserf' },
                { name: 'ca_porcrf', mapping: 's_ca_porcrf' },
                { name: 'ca_mone', mapping: 's_ca_mone' },
                { name: 'ca_convenio', mapping: 's_ca_convenio' },
                { name: 'ca_autoret', mapping: 's_ca_autoret' },
                { name: 'ca_basear', mapping: 's_ca_basear' },
                { name: 'ca_tipo', mapping: 's_ca_tipo' },
                { name: 'ca_idempresa', mapping: 's_ca_idempresa' },
                { name: 'empresa', mapping: 'e_ca_nombre' }
            ],
            autoLoad: true,
            remoteSort: false,
            proxy: {
                type: 'ajax',
                url: '/contabilidad/datosConceptosSiigo',
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                }
            }
        }),
        columns: [
            {text: "Consecutivo",   dataIndex: 'ca_idconceptosiigo',    sortable: true                              },
            {text: "Codigo",        dataIndex: 'ca_cod',                sortable: true, editor: {xtype: "textfield"}},
            {text: "Descripcion",   dataIndex: 'ca_descripcion',        sortable: true, editor: {xtype: "textfield"}},
            {text: "Cuenta",        dataIndex: 'ca_cuenta',             sortable: true, editor: {xtype: "textfield"}},
            {text: "CC",            dataIndex: 'ca_cc',                 sortable: true, editor: {xtype: "textfield"}},
            {text: "Scc",           dataIndex: 'ca_scc',                sortable: true, editor: {xtype: "textfield"}},
            {text: "Valor",         dataIndex: 'ca_valor',              sortable: true, editor: {xtype: "textfield"}},
            {text: "PT",            dataIndex: 'ca_pt',                 sortable: true, editor: {xtype: "textfield"}},
            {text: "Iva",           dataIndex: 'ca_iva',                sortable: true, editor: {xtype: "textfield"}},
            {text: "%",             dataIndex: 'ca_porciva',            sortable: true, editor: {xtype: "textfield"}},
            {text: "RetFte",        dataIndex: 'ca_retfte',             sortable: true, editor: {xtype: "textfield"}},
            {text: "Cuenta",        dataIndex: 'ca_cuentarf',           sortable: true, editor: {xtype: "textfield"}},
            {text: "Base",          dataIndex: 'ca_baserf',             sortable: true, editor: {xtype: "textfield"}},
            {text: "%",             dataIndex: 'ca_porcrf',             sortable: true, editor: {xtype: "textfield"}},
            {text: "moneda",        dataIndex: 'ca_mone',               sortable: true, editor: {xtype: "textfield"}},
            {text: "Convenio",      dataIndex: 'ca_convenio',           sortable: true, editor: {xtype: "textfield"}},
            {text: "Autoret",       dataIndex: 'ca_autoret',            sortable: true, editor: {xtype: "textfield"}},
            {text: "Base",          dataIndex: 'ca_basear',             sortable: true, editor: {xtype: "textfield"}},
            //{text: "Tipo",          dataIndex: 'ca_tipo',               sortable: true, editor: {xtype: "textfield"}},
            {text: "Empresa",     dataIndex: 'empresa',          sortable: true, editor: new wgEmpresas()    }
        ],
        plugins: [new Ext.grid.plugin.CellEditing({
                    clicksToEdit: 1
                })],
        listeners:{
            edit : function(editor, e, eOpts)
            {
                //alert(e.field);
                var store = this.store;
                if(e.field=="empresa")
                {
                    store.data.items[e.rowIdx].set('ca_idempresa', e.value);                    
                    store.data.items[e.rowIdx].set('empresa', editor.editors.items[0].field.rawValue);
                }
            }
        },
        tbar: [
            {
                text: 'Refrescar',
                iconCls: 'refresh',
                handler: function() {                    
                    this.up("grid").getStore().reload();
                    
                }
            },
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
/*            {
                text: 'Agregar',
                iconCls: 'add',
                handler : function(){        
                    //var store = Ext.getCmp("grid-facturacion").getStore();            
                    //Ext.getCmp("grid-facturacion").ventanaFac(null);
                }
            },*/
            {
                text: 'Guardar',
                iconCls: 'add',
                id:'btn-guardarConcepto',
                handler : function(){
                    Ext.getCmp('btn-guardarConcepto').disable();
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
                                url: '<?= url_for("contabilidad/guardarGridConceptos") ?>',
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
                                    if(res.errorInfo=="" || res.errorInfo=="null")
                                    {
                                        
                                    }
                                    else
                                        Ext.MessageBox.alert("Mensaje",'No fue posible el guardar la fila <br>'+res.errorInfo);
                                    Ext.getCmp('btn-guardarConcepto').enable();
                                },
                                failure: function(response, opts) {
                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                    box.hide();
                                    Ext.getCmp('btn-guardarConcepto').enable();
                                }
                            });
                    }
                    else
                        Ext.getCmp('btn-guardarConcepto').enable();
                }
            }

        ],
        //forceFit: true,
        //height:500//,
        //split: true,
        //region: 'north'
    });
    
</script>

