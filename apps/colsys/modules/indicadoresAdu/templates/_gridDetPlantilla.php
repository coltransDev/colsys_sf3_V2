<?php
include_component("widgets5", "wgParametros",array("caso_uso"=>"CU258"));
?>
<script>
    var combo = new Ext.colsys.wgParametro({                            
        caso_uso:"CU258",
        displayField: 'name',
        valueField: 'name'
    });
    var comboBoxRenderer = function(combo) {
        return function(value) {   
        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField) );
       
        };
    };
    Ext.define('GridDetPlantilla',{
        extend: 'Ext.grid.Panel',
        width: 550,
        
        title: 'Detalle de plantillas',
        collapsible: false,
        store: Ext.create('Ext.data.Store', {
            id:'storegriddetplantilla',
            fields: [ 
                { name: 'ca_id_det_plantilla',mapping:'s_ca_id_det_plantilla'},
                { name: 'ca_id_cab_plantilla',mapping:'s_ca_id_cab_plantilla'},
                { name: 'ca_nombre',          mapping:'s_ca_nombre'},
                { name: 'ca_nombrejson',      mapping:'s_ca_nombrejson'},
                { name: 'ca_orden',           mapping:'s_ca_orden'},
                { name: 'ca_tipo',            mapping:'s_ca_tipo'},
                { name: 'ca_tamano',          mapping:'s_ca_tamano'},
                { name: 'ca_ubicacion',       mapping:'s_ca_ubicacion'}
            ],            
            autoLoad: false,
            remoteSort: true,
            sorters: [{
                property: 'ca_orden',
                direction: 'DESC'
            }],
            proxy: {
                type: 'ajax',
                url: '/indicadoresAdu/datosGridDetPlantilla',
                reader: {
                    type: 'json',
                    rootProperty: 'root',
                    totalProperty: 'totalC',
                    idProperty:'idCab'
                }
            }
        }),
        columns: [   
            { xtype: "checkcolumn",  dataIndex: 'sel', width: 40}, 
            { text: "Id. plantilla", dataIndex:'ca_id_det_plantilla',hidden:true},
            { text: "Número de cabecera", dataIndex:'ca_id_cab_plantilla',hidden:true},
            { text: "Nombre", dataIndex:'ca_nombre', editor:{
                    xtype: "textfield"}},
            { text: "Nombre json", dataIndex:'ca_nombrejson', editor: {xtype: "textfield"}},//es opcional activa el campo ubicación
            { text: "Posición", dataIndex:'ca_orden',editor:{ xtype: "numberfield"}},
            { text: "Tipo",dataIndex: 'ca_tipo',editor:combo,renderer: comboBoxRenderer(combo)},
            { text: "Tamaño", dataIndex:'ca_tamano',editor:{ xtype: "numberfield"}},
            { text: "ubicación", dataIndex:'ca_ubicacion',hidden:true}
        ],
        plugins: [new Ext.grid.plugin.CellEditing({
                    clicksToEdit: 1
                })],
           
        tbar: [
            {
                text: 'Agregar',
                iconCls: 'add',
                handler : function(){        
                    var store=this.up("grid").getStore();
                    var r = Ext.create(store.getModel());
                    r.data.ca_id_cab_plantilla=idcabtmp;
                    store.insert(0, r);
                }
            },
            {
                text: 'Guardar',
                iconCls: 'add',
                id:'btn-guardarDetPlantilla',
                handler : function(){
                    Ext.getCmp('btn-guardarDetPlantilla').disable();
                    var store = this.store;
                    var store=this.up("grid").getStore();
                    var records = store.getModifiedRecords();
                    var lenght = records.length;
                    changes=[];
                    for( var i=0; i< lenght; i++){
                        r = records[i];
                        if(r.getChanges()){
                            if(r.data.ca_id_cab_plantilla!=null){
                                var idCab=idcabtmp;
                            };
                            if(r.data.ca_nombre==null || r.data.ca_nombrejson!=null){
                                var json=2;
                                records[i].set('ca_ubicacion',json);
                            }else{
                                var json=1;
                                records[i].set('ca_ubicacion',json);
                            }
                            
                            Ext.getCmp('btn-guardarDetPlantilla').enable();
                            records[i].set('ca_id_cab_plantilla',idCab);
                            records[i].data.id=r.id;
                            changes[i]=records[i].data;           
                    }
                    }
                    var str= JSON.stringify(changes);
                    if(str.length>5)
                    {
                        Ext.Ajax.request({
                                url: '<?= url_for("indicadoresAdu/guardarDetPlantilla") ?>',
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
                                        Ext.getCmp('btn-guardarDetPlantilla').enable();
                                        rec.commit();  
                                    }
                                    Ext.getCmp('btn-guardarDetPlantilla').enable();
                                },
                                failure: function(response, opts) {
                                    
                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                    box.hide();
                                    Ext.getCmp('btn-guardarDetPlantilla').enable();
                                }
                            });
                    }
                    else
                        Ext.getCmp('btn-guardarDetPlantilla').enable();
                }
            }, {
                xtype: 'button',               
                text: 'Eliminar',
                iconCls: 'delete',
                allowBlank: false,
                hidden: false,
                handler: function() {
                    var store =  Ext.getCmp('grid-det-plantilla').getStore();   
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
                        url: '<?= url_for("indicadoresAdu/eliminarDetPlantilla") ?>',

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
                            var store =  Ext.getCmp('grid-det-plantilla').getStore();
                           
                            store.reload({
                                params : {
                                    id_cab_plantilla: idcabtmp
                                }});
                            if (changes.length >0)
                                Ext.MessageBox.alert("Mensaje", 'Datos Eliminados Correctamente<br>');                                             
                        }
                    });                         
                }
                
            }
            
        ]/*
         * paginación 
         * ,
        bbar: Ext.create('Ext.PagingToolbar', {
                pageSize:5,
                store: 'storegriddetplantilla',
                
                displayInfo: true,
                displayMsg: 'Registros {0} - {1} of {2}',
                emptyMsg: "No hay registros"
                
                
            })*/
    });
</script>


