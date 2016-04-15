<?php
/* 
 * @autor Nataly
 * Gestión de Cargos por Empresa
 */
?>
<script>
storecargos=Ext.create('Ext.data.Store', {
            id:'storegridcargos',
            fields: [
                { name: 'ca_cargo', mapping: 's_ca_cargo' },
                { name: 'ca_activo', mapping: 's_ca_activo'},
                { name: 'ca_manager',mapping: 's_ca_manager' },
                { name: 'ca_idempresa', mapping: 's_ca_idempresa' }
            ],
            autoLoad: false,
            params: {pages:4,start: 0, limit: 4, foo: 'bar'},
            pageSize: 70,
            remoteSort: true,
            //height:500,
            proxy: {
                type: 'ajax',
                url : '/config/datosCargos',
                
                reader: {
                    type: 'json',
                    rootProperty: 'root',
                    totalProperty: 'total',
                    idProperty:'idempresa'
                }
            }
        }),
    Ext.define('GridCargos',{
        extend: 'Ext.grid.Panel',
        bufferedRenderer: false,
        store: storecargos,
        autoScroll:true,
        autoHeight:true,
        height:600,
        //width:530,
        columns: [
            {text: "Cargo"       , dataIndex: 'ca_cargo', width:350, sortable: true, editor: {xtype: "textfield"}},
            {xtype:"checkcolumn", text: "Activo"      , dataIndex: 'ca_activo', width:80, sortable: true, editor: {xtype: "checkboxfield"}},
            {xtype:"checkcolumn",text: "Manager"     ,  dataIndex: 'ca_manager',width:80, sortable: true,editor: {xtype: "checkboxfield"}}       
        ],
        plugins: [
            new Ext.grid.plugin.CellEditing({
                clicksToEdit: 1
        })],
        listeners:{
            edit : function(editor, e, eOpts)
            {
                var store = this.store;
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
                    var store = this.store;
                    var store=this.up("grid").getStore();
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
                                url: '<?= url_for("config/guardarGridCargos") ?>',
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
            },
            {
                xtype: 'exporterbutton',
                text: 'XLS',
                iconCls: 'csv',
                format:'excel'
            },
            {
                xtype: 'Colsys.Widgets.wgEmpresas',
                hideLabel: false,
                fieldLabel: 'Empresa',
                labelWidth: 60,
                name: 'filtro_empresas',
                id: 'filtro_empresas',
                width: 220,
                allowBlank: false
            },
            {
                xtype: 'button',
                hideLabel: false,
                text: 'Buscar',
                iconCls: 'search',
                width: 25,
                allowBlank: false,                
                handler: function() {
                    var idempresa = Ext.getCmp("filtro_empresas").getValue();
                    if(idempresa==null){
                        Ext.MessageBox.alert("Mensaje", 'Debe seleccionar una empresa <br>');                                             
                    }else
                    {
                        var store =  Ext.getCmp('grid-cargos').getStore();
                        //store.setBaseParam('ca_idempresa',idempresa)
                        store.getProxy().extraParams.idempresa = idempresa,
                        store.load();
                    }
                } 
            }
        ],
        bbar: Ext.create('Ext.PagingToolbar', {
                store: storecargos,
                displayInfo: true,
                displayMsg: 'Registros {0} - {1} of {2}',
                emptyMsg: "No hay registros"
        })
    });
</script>

