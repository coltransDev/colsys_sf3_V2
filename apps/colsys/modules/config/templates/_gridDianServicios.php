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
    Ext.define('GridDianServicios',{
        extend: 'Ext.grid.Panel',
        bufferedRenderer: true,
        selModel: {
            pruneRemoved: false
        },
        store: Ext.create('Ext.data.Store', {            
            fields: [
                { name: 'ca_idservicio', mapping: 's_ca_idservicio' },
                { name: 'ca_identificacion', mapping: 's_ca_identificacion' },
                { name: 'ca_razonsocial', mapping: 's_ca_razonsocial' },
                { name: 'ca_ciudad', mapping: 's_ca_ciudad' },
                { name: 'ca_codigo', mapping: 's_ca_codigo' },
                { name: 'ca_tipo', mapping: 's_ca_tipo' }
            ],
            autoLoad: false,
            remoteSort: false,
            proxy: {
                type: 'ajax',
                url: '/config/datosDianServicios',
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                }
            }
        }),
        columns: [            
            {text: "Identificacion",    dataIndex: 'ca_identificacion', sortable: true, width:130, editor: {xtype: "textfield"}},
            {text: "Razon Social",      dataIndex: 'ca_razonsocial',    sortable: true, width:350, editor: {xtype: "textfield"}},
            {text: "Ciudad",            dataIndex: 'ca_ciudad',         sortable: true, width:130, editor: {xtype: "textfield"}},
            {text: "Codigo",            dataIndex: 'ca_codigo',         sortable: true, width:100, editor: {xtype: "textfield"}},
            {text: "Tipo",              dataIndex: 'ca_tipo',           sortable: true, width:150,editor: {xtype: "textfield"}}
            
            
        ],
        plugins: [new Ext.grid.plugin.CellEditing({
                    clicksToEdit: 1
                })],
        listeners:{
            render: function(ct, position){                
                if(this.load==false || this.load=="undefined" || !this.load)
                {
                     this.store.reload();
                     this.load=true;
                 }
                this.superclass.onRender.call(this, ct, position);
             },
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
                        
                        //var storeTree=Ext.getCmp("grid-consulta-comprobantes").getStore();
                        var store=this.up("grid").getStore();
                        store.clearFilter();
                        if(newValue!="")
                        {
                            //alert(newValue);
                            store.filterBy(function(record, id){
                                var str=record.get("ca_razonsocial");
                                var str1=record.get("ca_identificacion");

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

