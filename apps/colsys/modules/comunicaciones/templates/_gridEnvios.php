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
    Ext.define('GridEnvios',{
        extend: 'Ext.grid.Panel',
        bufferedRenderer: true,
        selModel: {
            pruneRemoved: false
        },
        store: Ext.create('Ext.data.Store', {            
            fields: [
                { name: 'ca_idenvio', mapping: 'e_ca_idenvio' },
                { name: 'ca_idcomunicado', mapping: 'e_ca_idcomunicado' },
                { name: 'ca_id', mapping: 'e_ca_id' },
                { name: 'ca_idcontacto', mapping: 'e_ca_idcontacto' },
                { name: 'ca_idemail', mapping: 'e_ca_idemail' },
                { name: 'ca_conf', mapping: 'e_ca_conf' },
                { name: 'ca_fchconf', mapping: 'e_ca_fchconf' },
                { name: 'ca_test', mapping: 'e_ca_test' },
                { name: 'ca_observaciones', mapping: 'e_ca_observaciones' },                
                { name: 'ca_nombre', mapping: 'i_ca_nombre' },
                { name: 'ca_nombres', mapping: 'cc_ca_nombres' },
                { name: 'ca_fchenvio', mapping: 'em_ca_fchenvio' },
                { name: 'ca_comercial', mapping: 'u_ca_nombre' },
            ],
            autoLoad: false,
            remoteSort: false,
            proxy: {
                type: 'ajax',
                url: '/comunicaciones/datosEnvios',                
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                }
            }
        }),
        columns: [            
            //{text: "Identificacion",    dataIndex: 'ca_identificacion', sortable: true, width:130, editor: {xtype: "textfield"}},
            {text: "Comercial",     dataIndex: 'ca_comercial',         sortable: true, width:150},
            {text: "Razon Social",  dataIndex: 'ca_nombre',         sortable: true, width:350},
            {text: "Contacto",      dataIndex: 'ca_nombres',        sortable: true, width:200},
            {text: "Fch. Envío",    dataIndex: 'ca_fchenvio',       sortable: true, width:150},
            {text: "Confirmación",  dataIndex: 'ca_conf',           sortable: true, width:100,  renderer: function(value){
                        return value?'<img src="/images/16x16/button_ok.gif"/>':"";
                    }},
            {text: "Observaciones", dataIndex: 'ca_observaciones',  sortable: true, width:150},
            {text: "Ver Email", dataIndex: 'ca_idemail',  sortable: true, width:150, renderer: function(value){
                        var url = '<?= url_for("email/verEmail?id=") ?>' + value;
                        return '<a href="' + url + '" target="_blank"><img src="/images/16x16/email.gif" alt="Ver reporte"/></a>';
                    }},
            
            //{text: "Tipo",              dataIndex: 'ca_tipo',           sortable: true, width:150,editor: {xtype: "textfield"}}
            
            
        ],
        plugins: [new Ext.grid.plugin.CellEditing({
                    clicksToEdit: 1
                })],
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
                                var str=record.get("ca_comercial");
                                var str1=record.get("ca_nombre");
                                var str2=record.get("ca_nombres");

                                var txt=new RegExp(newValue,"ig");
                                if(str.search(txt) == -1 && str1.search(txt) == -1 && str2.search(txt) == -1)
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
            },
            {
                xtype: 'exporterbutton',
                text: 'Exportar CSV',
                iconCls: 'csv'
            }
        ]//,
         /*beforeTemplateLoad: function(store) {
            store.proxy.extraParams = {
                prueba: this.idcom
            }
        },*/
        //forceFit: true,
        //height:500//,
        //split: true,
        //region: 'north'
    });
    
</script>

