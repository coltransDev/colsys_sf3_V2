<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>

<script type="text/javascript">


    PanelAsignacionesSoftware = function( config ){

        Ext.apply(this, config);
        
        this.columns = [
            {
                header: "Equipo",
                dataIndex: 'identificador',
                //hideable: false,
                width: 110,
                sortable: false,
                renderer: this.formatItem,
                editor: new WidgetEquipo({
                
                })
            },
            {
                header: "Asignado a",
                dataIndex: 'asignadoa',
                //hideable: false,
                width: 110,
                sortable: false
            
            },
            {
                header: "Ubicación",
                dataIndex: 'ubicacion',
                //hideable: false,
                width: 110,
                sortable: false
            }
        ];


        this.record = Ext.data.Record.create([          
            {name: 'idasignacion_software', type: 'integer', mapping: 'a_ca_idasignacion_software'},
            {name: 'idactivo', type: 'integer', mapping: 'a_ca_idactivo'},
            {name: 'idequipo', type: 'integer', mapping: 'a_ca_idequipo'},
            {name: 'identificador', type: 'string', mapping: 'e_ca_identificador'},
            {name: 'asignadoa', type: 'string', mapping: 'u_ca_nombre'},
            {name: 'ubicacion', type: 'string', mapping: 's_ca_nombre'},
            {name: 'orden', type: 'string'},
            {name: 'deleted', type: 'bool'}
           

        ]);
    
        this.store = new Ext.data.GroupingStore({
            autoLoad : false,
            url: '<?= url_for("inventory/datosPanelAsignacionesSoftware") ?>',     
            baseParams: {
                idactivo: this.idactivo,
                readOnly: this.readOnly
            },
            reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total'
            },
            this.record
        ),
            sortInfo:{field: 'orden', direction: "ASC"}    
        });


        this.tbar = [
            {
                text: 'Recargar',
                tooltip: 'Actualiza losdatos del panel',
                iconCls: 'refresh',  // reference to our css
                scope: this,
                handler: this.recargar
            }            
        ];
        
        if( !this.readOnly ){
            this.tbar.push({
                text: 'Guardar Cambios',
                tooltip: 'Guarda los cambios hechos en la base de datos.',
                iconCls: 'disk', 
                scope: this,
                handler: this.guardar
            });
        }

    
        PanelAsignacionesSoftware.superclass.constructor.call(this, {
            loadMask: {msg:'Cargando...'},       
            boxMinHeight: 300,
       
            autoScroll:true,       
            view: new Ext.grid.GroupingView({

                forceFit:true            
            
            
            }),
       
            listeners:{
                rowcontextmenu:this.onRowContextMenu,
                validateedit: this.onValidateEdit
            },
       
            tbar: this.tbar
        });

    };

    Ext.extend(PanelAsignacionesSoftware, Ext.grid.EditorGridPanel, {

        crearActivo: function(){        
            this.win = new EditarActivoWindow( {idcategory:this.idcategory,
                gridopener: this.id} );
            this.win.show();
        },
        recargar: function(){

            if(this.store.getModifiedRecords().length>0){
                if(!confirm("Se perderan los cambios no guardados, desea continuar?")){
                    return 0;
                }
            }
            this.store.reload();
        },
    


        formatItem: function(value, p, record) {
            return String.format(
            '<b>{0}</b>',
            value
        );
        },
    
        onValidateEdit: function(e){
            var storeGrid = this.store;       
            if( e.field == "identificador"){
                var rec = e.record;
                var ed = this.colModel.getCellEditor(e.column, e.row);
                var store = ed.field.store;
                var recordGrilla = this.record;
            
                store.each( function( r ){
                    if( r.data.idactivo==e.value ){                        
                        if( !rec.data.idequipo  ){
                            var newRec = new recordGrilla({
                                idasignacion_software: null,
                                orden: 'Z',
                                idactivo: null,                               
                                identificador: '+',
                                idequipo: null,
                                asignadoa: '',
                                ubicacion: ''                               
                            });
                            storeGrid.addSorted(newRec);
                        }
                        rec.set("idequipo", r.data.idactivo);
                        e.value = r.data.identificador;
                        rec.set("asignadoa", r.data.asignadoa);
                        rec.set("ubicacion", r.data.ubicacion);
                        return true;
                    }
                }
            )
            }
        },
    
        guardar: function(){
            var store = this.store;
            var records = store.getModifiedRecords();
            var lenght = records.length;
        
            for( var i=0; i< lenght; i++){
                r = records[i];

                if(r.data.deleted){
                    continue;
                }
            
                if(!r.data.idequipo){
                    continue;
                }


                var changes = r.getChanges();
            
                changes['id']=r.id;
                changes['idequipo']=r.data.idequipo;
                changes['idactivo']=this.idactivo;
                changes['idasignacion_software']=r.data.idasignacion_software;

                //envia los datos al servidor
                Ext.Ajax.request({                
                    waitMsg: 'Guardando cambios...',
                    url: '<?= url_for("inventory/guardarPanelAsignacionesSoftware") ?>', 						//method: 'POST',
                    //Solamente se envian los cambios
                    params :	changes,               

                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){

                            if( res.id ){
                                var rec = store.getById( res.id );       
                                rec.set("idasignacion_software",res.idasignacion_software);
                                rec.commit();
                            }

                        }else{
                            Ext.MessageBox.alert('Error', "Ha ocurrido el siguiente error"+res.errorInfo);
                        }
                    },
                    failure:function(response,options){
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(response.result?": "+response.result.errorInfo:"")+" "+(response?"\n Codigo HTTP "+response.status:""));
                    }

                });
            
            }
        },
        onRowContextMenu: function(grid, index, e){
            if( !this.readOnly ){
                var items = [{
                        text: 'Eliminar item',
                        iconCls: 'delete',
                        scope:this,
                        handler: function(){                        
                            if( this.ctxRecord && this.ctxRecord.data.idasignacion_software ){
                                var id = this.ctxRecord.id;
                                var idasignacion_software = this.ctxRecord.data.idasignacion_software;
                                var idequipo = this.ctxRecord.data.idequipo;

                                if( idequipo && confirm("Esta seguro?") ){
                                    if( idasignacion_software ){
                                        Ext.Ajax.request(
                                        {
                                            waitMsg: 'Guardando cambios...',
                                            url: '<?= url_for("inventory/eliminarPanelAsignacionSoftware") ?>',
                                            //method: 'POST',
                                            //Solamente se envian los cambios
                                            params :	{
                                                idasignacion_software: idasignacion_software,                                        
                                                id: id
                                            },
                                            success:function(response,options){
                                                var res = Ext.util.JSON.decode( response.responseText );
                                                if( res.id && res.success){
                                                    var rec = storeRecargos.getById( res.id );
                                                    storeRecargos.remove(rec);
                                                    rec.set("deleted", true);
                                                }else{
                                                    Ext.MessageBox.alert('Error', "Ha ocurrido el siguiente error"+res.errorInfo);
                                                }
                                            },
                                            failure:function(response,options){
                                                Ext.MessageBox.alert('Error Message', "Se ha presentado un error "+(response?"\n Codigo HTTP "+response.status:""));
                                            }
                                        });
                                    }else{
                                        var rec = storeRecargos.getById( id );
                                        storeRecargos.remove(rec);
                                    }
                                }
                            }
                        }
                    }
                ];



                rec = this.store.getAt(index);           
                var storeRecargos = this.store;
                if( !this.menu ){
                    this.menu = new Ext.menu.Menu({
                        items: items
                    });
                }
                this.menu.on('hide', this.onContextHide, this);

                e.stopEvent();
                if(this.ctxRow){
                    Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                    this.ctxRow = null;
                }
                this.ctxRecord = rec;
                this.ctxRow = this.view.getRow(index);
                Ext.fly(this.ctxRow).addClass('x-node-ctx');
                this.menu.showAt(e.getXY());
            }

        },
        
        onContextHide: function(){
            if(this.ctxRow){
                Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                this.ctxRow = null;
            }
        }
    

    });

</script>