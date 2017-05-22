
<script>
//grid para la creación de fechas de cierre contable por cliente
        Ext.define('GridFechaCierre',{
        extend: 'Ext.grid.Panel',
        
        bufferedRenderer: false,
        store: Ext.create('Ext.data.Store', {
            id:'storegridcierre',
            fields: [ 
                { name: 'ca_id_fecha_cierre',mapping:'s_ca_id_fecha_cierre'},
                { name: 'ca_fecha_cierre',   mapping: 's_ca_fecha_cierre',type: 'date'},
                { name: 'ca_idcliente',      mapping: 's_ca_idcliente' },
                { name:'ca_compania',        mapping:'c_ca_compania'}
                
            ],
            autoLoad:   false,
            remoteSort: true,
            params: {start: 0, limit: 4, foo: 'bar'},
            pageSize: 2,
            
            sorters: [{
                property: 'ca_fecha_cierre',
                direction: 'DESC'
            }],
            proxy: {
                type: 'ajax',
                url: '/indicadoresAdu/datosGridFechaCierre',
                reader: {
                    type: 'json',
                    rootProperty: 'root',
                    totalProperty: 'totalC'
                    
                }
            }
        }),
        
        columns: [   
            {xtype: "checkcolumn",        dataIndex: 'sel',                   width: 40            }, 
            {text:  "id_fechaCierre",     dataIndex: 'ca_id_fecha_cierre',    sortable: true,       width: 25,  hidden:true   },
            {text:  "Fecha Cierre",       dataIndex: 'ca_fecha_cierre',       id:'ca_fecha_cierre', width:150, sortable: true, 
                renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        format: "d/m/Y",
                        altFormat: "Y-m-d",
                        submitFormat: 'Y-m-d',allowBlank: false,
                        editor: {xtype: "datefield",format: "d/m/Y",altFormat: "Y-m-d", submitFormat: 'Y-m-d',allowBlank: false, validateBlank:true}
            }
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
                    store.insert(0, r);
                }
            },
            {
                text: 'Guardar',
                iconCls: 'add',
                id:'btn-guardarFechaCierre',
                handler : function(){
                    Ext.getCmp('btn-guardarFechaCierre').disable();
                    var store = this.store;
                    var store=this.up("grid").getStore(); 
                 
                    var records = store.getModifiedRecords();
                     
                    var lenght = records.length;
                    //Ext.MessageBox.alert("Mensaje",'records'+records);  
                  
                  
                    changes=[];
                    for( var i=0; i< lenght; i++){
                        r = records[i];
                        if(r.getChanges()){
                            if(r.data.ca_fecha_cierre != null){
                            var idcliente = Ext.getCmp("filtro_clienteFechaCierre").getValue();
                            if(idcliente==null){
                                Ext.MessageBox.alert("Mensaje",'debe seleccionar un cliente');
                                Ext.getCmp('btn-guardarFechaCierre').enable();
                                
                            }else{
                                    records[i].set('ca_idcliente',idcliente);
                                    records[i].data.id=r.id;
                                    changes[i]=records[i].data;
                            }
                        }
                        
                    }
                    }
                    
                    var str= JSON.stringify(changes);
                    if(str.length>5)
                    {
                        
                        Ext.Ajax.request({
                                url: '<?= url_for("indicadoresAdu/guardarGridFechas") ?>',
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
                                        Ext.getCmp('btn-guardarFechaCierre').enable();
                                        rec.commit();  
                                    }
                                    Ext.getCmp('btn-guardarFechaCierre').enable();
                                },
                                failure: function(response, opts) {
                                    
                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                    box.hide();
                                    Ext.getCmp('btn-guardarFechaCierre').enable();
                                }
                            });
                    }
                    else
                        Ext.getCmp('btn-guardarFechaCierre').enable();
                }
            }, {
                xtype: 'button',               
                text: 'Eliminar',
                iconCls: 'delete',
                width: 25,
                allowBlank: false,
                hidden: false,
                handler: function() {
                    var store =  Ext.getCmp('grid-fecha-cierre').getStore();   
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
                        url: '<?= url_for("indicadoresAdu/eliminarGridFechas") ?>',

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
                            var store =  Ext.getCmp('grid-fecha-cierre').getStore();
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
                labelWidth: 80,
                name: 'filtro_clienteFechaCierre',
                id: 'filtro_clienteFechaCierre',
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
                    var idcliente = Ext.getCmp("filtro_clienteFechaCierre").getValue();
                    if(idcliente==null){
                        Ext.MessageBox.alert("Mensaje", 'Debe seleccionar un cliente <br>');                                             
                    }else
                    {
                        var store =  Ext.getCmp('grid-fecha-cierre').getStore();
                        store.load({
                            params : {
                                idcliente: idcliente
                            }
                        });
                    }
                }
                
            }
        ],
        bbar:Ext.create('Ext.PagingToolbar',{
                
                store: 'storegridcierre',
                //pageSize:2,
                displayInfo: true,
                displayMsg: 'Mostrando datos {0} - {1} of {2}',
                emptyMsg: "No topics to display"
                
            })
       
    });
    
</script>

