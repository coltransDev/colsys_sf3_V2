<?php
include_component("widgets5", "wgCliente");
$idCab = $sf_data->getRaw("id_cab_plantilla");
?>
<script>
var idcabtmp=0;
    Ext.define('GridCabPlantilla',{
        
        extend: 'Ext.grid.Panel',
        title: 'Cabecera de plantillas',
        bodyStyle: "padding: 5px;",
        collapsible: true,
        bufferedRenderer: false,
        store: Ext.create('Ext.data.Store', {
            id:'storegridcabplantilla',
            fields: [ 
                { name: 'ca_id_cab_plantilla',mapping:'s_ca_id_cab_plantilla'},
                { name: 'ca_idcliente',       mapping: 's_ca_idcliente' },
                { name: 'ca_estado',          mapping: 's_ca_estado',type: 'bool'}
            ],
            autoLoad: false,
            remoteSort: true,
            params: {start: 0, limit: 4, foo: 'bar'},
            pageSize: 2,
            
            sorters: [{
                property: 'ca_id_cab_plantilla',
                direction: 'DESC'
            }],
            proxy: {
                type: 'ajax',
                url: '/indicadoresAdu/datosGridCabPlantilla',
                reader: {
                    type: 'json',
                    rootProperty: 'root',
                    totalProperty: 'totalC'
                }
            }
        }),
        columns: [   
            { xtype: "checkcolumn",     dataIndex: 'sel', width: 40}, 
            { text:  "id_cab_plantilla",dataIndex: 'ca_id_cab_plantilla'},
            { xtype: "checkcolumn",     text:"Estado",    dataIndex:"c_ca_estado",width: 80,
                editor:{
                    xtype: 'checkbox',
                    cls: 'x-grid-checkheader-editor'
                }
            }
        ],pageSize:1,
        plugins: [new Ext.grid.plugin.CellEditing({
                    clicksToEdit: 1
                })],
        listeners:{
                rowdblclick:function(obj, record, tr, rowIndex, e, eOpts )
                {
                    //alert(record.data.toSource());
                    var ca_id_cab_plantilla;
                    ca_id_cab_plantilla=record.data.ca_id_cab_plantilla;
                    idcabtmp=ca_id_cab_plantilla;
                    var store =  Ext.getCmp('grid-det-plantilla').getStore();
                        store.load({
                            params : {
                                id_cab_plantilla: ca_id_cab_plantilla
                            }
                        });
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
                id:'btn-guardarCabPlantilla',
                handler : function(){
                    
                    Ext.getCmp('btn-guardarCabPlantilla').disable();
                    var store = this.store;
                    var store=this.up("grid").getStore(); 
                    var records = store.getModifiedRecords();
                    var lenght = records.length;
                    changes=[];
                    for( var i=0; i< lenght; i++){
                        r = records[i];
                        if(r.getChanges()){
                            if(r.data.ca_estado != null){
                            var idcliente = Ext.getCmp("filtro_clienteCabPlantilla").getValue();
                           
                                    records[i].set('ca_idcliente',idcliente);
                                    records[i].data.id=r.id;
                                    changes[i]=records[i].data;
                        }
                    }
                    }
                    var str= JSON.stringify(changes);
                    if(str.length>5)
                    {
                        
                        Ext.Ajax.request({
                                url: '<?= url_for("indicadoresAdu/guardarCabPlantilla") ?>',
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
                                        Ext.MessageBox.alert("Mensaje",'No fue posible el guardar la fecha <br>'+res.errorInfo);
                                        Ext.getCmp('btn-guardarCabPlantilla').enable();
                                        rec.commit();  
                                    }
                                    Ext.getCmp('btn-guardarCabPlantilla').enable();
                                },
                                failure: function(response, opts) {
                                    
                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                    box.hide();
                                    Ext.getCmp('btn-guardarCabPlantilla').enable();
                                }
                            });
                    }
                    else
                        Ext.getCmp('btn-guardarCabPlantilla').enable();
                }
            }, {
                xtype: 'button',               
                text: 'Eliminar',
                iconCls: 'delete',
                width: 25,
                allowBlank: false,
                hidden: false,
                handler: function() {
                    var store =  Ext.getCmp('grid-cab-plantilla').getStore();   
                    x = 0;
                    changes = [];
                    for (var i = 0; i < store.getCount(); i++) {
                        var record = store.getAt(i);                        
                        if (record.get("sel")) {                            
                                record.data.id = record.id;
                                changes[x] = record.data;
                                x++;                                
                        } 
                    }                    
                    var strGrid = JSON.stringify(changes);                    
                    Ext.Ajax.request({
                        waitMsg: 'Guardando cambios...',
                        url: '<?= url_for("indicadoresAdu/eliminarCabPlantilla") ?>',

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
                            var store =  Ext.getCmp('grid-cab-plantilla').getStore();
                            store.reload();
                            if (changes.length >0)
                                Ext.MessageBox.alert("Mensaje", 'Datos Eliminados Correctamente<br>');                                             
                        }
                    });                         
                }
                
            },
            , {
                xtype: 'wCliente',
                hideLabel: false,
                fieldLabel: 'Cliente',
                labelWidth: 50,
                name: 'filtro_clienteCabPlantilla',
                id: 'filtro_clienteCabPlantilla',
                width: 200,
                allowBlank: false
            }, {
                xtype: 'button',
                hideLabel: false,
                text: 'Buscar',
                iconCls: 'search',
                width: 25,
                allowBlank: false,                
                handler: function() {
                    var idcliente = Ext.getCmp("filtro_clienteCabPlantilla").getValue();
                    if(idcliente==null){
                        Ext.MessageBox.alert("Mensaje", 'Debe seleccionar un cliente <br>');                                             
                    }else
                    {
                        var store =  Ext.getCmp('grid-cab-plantilla').getStore();
                        store.load({
                            params : {    
                                idcliente: idcliente
                            }
                        });
                    }
                }
                
            }
        ],
        bbar: Ext.create('Ext.PagingToolbar', {
                store: 'storegridcabplantilla',
                displayInfo: true,
                displayMsg: 'Registros {0} - {1} of {2}',
                emptyMsg: "No hay registros"
            })
});
</script>