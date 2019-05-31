<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

//echo $editable;
?>

<script type="text/javascript">


    PanelActivos = function( config ){

        Ext.apply(this, config);
        

        this.columns = [
            {
                header: "Identificador",
                dataIndex: 'identificador',
                //hideable: false,
                width: 110,
                sortable: true,
                renderer: this.formatItem

            },  
            {
                header: "Detalle",
                dataIndex: 'detalle',
                hideable: false,
                sortable: true,
                width: 80,
                hidden: this.parameter!="Otro"                
            },
            {
                header: "Tipo",
                dataIndex: 'tipo',
                //hideable: false,
                sortable: true,
                width: 100
            },
            {
                header: "Marca",
                dataIndex: 'marca',
                //hideable: false,
                sortable: true,
                width: 180
            },
            {
                header: "Modelo",
                dataIndex: 'modelo',
                hideable: false,
                sortable: true,
                width: 180

            },
            {
                header: "Ubicación",
                dataIndex: 'ubicacion',
                //hideable: false,
                sortable: true,
                width: 280,
                hidden: this.parameter!="Hardware"

            },
            {
                header: "Procesador",
                dataIndex: 'procesador',
                hideable: false,
                sortable: true,
                width: 80,
                hidden: this.parameter!="Hardware"
        
            },
     
            {
                header: "Memoria",
                dataIndex: 'memoria',
                hideable: false,
                sortable: true,
                width: 80,
                hidden: this.parameter!="Hardware"
            },
            {
                header: "Disco",
                dataIndex: 'disco',
                hideable: false,
                sortable: true,
                width: 80,
                hidden: this.parameter!="Hardware"
            },
      
            {
                header: "Serial",
                dataIndex: 'serial',
                hideable: false,
                width: 100,
                sortable: true
            },
            {
                header: "Asignado a",
                dataIndex: 'asignadoaNombre',
                hideable: false,
                width: 100,
                sortable: true,
                hidden: this.parameter!="Hardware"
            },
            {
                header: "Prg. Mantenimiento",
                dataIndex: 'prgmantenimiento',
                hideable: false,
                width: 100,
                sortable: true,
                hidden: this.parameter!="Hardware",
                renderer: Ext.util.Format.dateRenderer('Y-m-d') 
            },
            {
                header: "Cantidad",
                dataIndex: 'cantidad',
                hideable: false,
                width: 100,
                sortable: true,
                hidden: this.parameter!="Software"
            }

      
        ];


        this.record = Ext.data.Record.create([
            {name: 'sel', type: 'bool'},
            {name: 'identificador', type: 'string'},
            {name: 'noinventario', type: 'string'},
            {name: 'idactivo', type: 'integer'},
            {name: 'idcategory', type: 'integer'},
            {name: 'fchcompra', type: 'date'},
            {name: 'marca', type: 'string'},
            {name: 'modelo', type: 'string'},
            {name: 'ubicacion', type: 'string'},
            {name: 'procesador', type: 'string'},
            {name: 'memoria', type: 'string'},
            {name: 'disco', type: 'string'},
            {name: 'optica', type: 'string'},
            {name: 'serial', type: 'string'},
            {name: 'contrato', type: 'string'},
            {name: 'observaciones', type: 'string'},
            {name: 'fchcompra', type: 'date' , dateFormat:'Y-m-d'},
            {name: 'version', type: 'string'},
            {name: 'ipaddress', type: 'string'},
            {name: 'reposicion', type: 'string'},
            {name: 'so', type: 'string'},
            {name: 'factura', type: 'string'},
            {name: 'empresa', type: 'string'},
            {name: 'proveedor', type: 'string'},
            {name: 'asignadoa', type: 'string'},
            {name: 'asignadoaNombre', type: 'string'},
            {name: 'idsucursal', type: 'string'},
            {name: 'prgmantenimiento', type: 'date', dateFormat:'Y-m-d'},
            {name: 'tipo', type: 'string'},
            {name: 'folder', type: 'string'},
            {name: 'deleted', type: 'boolean'},
            {name: 'cantidad', type: 'integer'},
            {name: 'detalle', type: 'string'}
        ]);
    
        this.store = new Ext.data.GroupingStore({
            autoLoad : true,
            url: '<?= url_for("inventory/datosPanelActivos") ?>',
            baseParams : {
                idcategory: this.idcategory,
                idsucursal: this.idsucursal
            
            },
            reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total'
            },
            this.record
        ),
            sortInfo:{field: 'identificador', direction: "ASC"}
            //groupOnSort: true,
            //groupField: 'noinventario'
        

        });

        
        this.tbar = [{
                text: 'Recargar',
                tooltip: 'Actualiza losdatos del panel',
                iconCls: 'refresh',  // reference to our css
                scope: this,
                handler: this.recargar
            }];
        
        if( !this.readOnly ){
            this.tbar.push({
                text: 'Nuevo',
                tooltip: '',
                iconCls: 'add',  // reference to our css
                scope: this,
                handler: this.crearActivo
            });
        }
        
        
        this.tbar.push({
            text: 'Dados de baja',
            scope: this,
            iconCls: 'refresh',  // reference to our css            
            handler: function(btn , e){
                var store = this.store;
                
                
                if( btn.getText()=='Dados de baja'){
                    btn.setText( "Activos" );
                    store.setBaseParam("mostrarBajas", true );
                }else{
                    btn.setText( "Dados de baja" );
                    store.setBaseParam("mostrarBajas", false );
                }
                store.reload();

            }
        });
    
        PanelActivos.superclass.constructor.call(this, {
            loadMask: {msg:'Cargando...'},
            //boxMinHeight: 300,
            ddGroup : 'TreeDD',
            enableDragDrop   : true,
            autoScroll:true,            
            view: new Ext.grid.GroupingView({

                forceFit:true,
                enableRowBody:true,
                hideGroupedColumn: true,
                emptyText: "No hay resultados"
                //showPreview:true,
                //hideGroupedColumn: true,
            
            }),
            listeners:{
                rowcontextmenu: this.onRowcontextMenu,
                rowdblclick : this.onRowDblclick
    
            },
            tbar: this.tbar
        });

    };

    Ext.extend(PanelActivos, Ext.grid.GridPanel, {

        crearActivo: function(){
            
            if( !this.editable ){
                return;
            }
            
            this.win = new EditarActivoWindow( {
                idcategory:this.idcategory,
                idsucursal:this.idsucursal,
                gridopener: this.id,
                parameter: this.parameter,
                autonumeric:this.autonumeric                
            } );
            
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
    

        agruparPor: function( a ){
            this.store.groupBy( a );
        },

    
        formatItem: function(value, p, record) {
            return String.format(
            '<b>{0}</b>',
            value
        );
        }
        ,

        onRowcontextMenu: function(grid, index, e){
            if( !this.readOnly ){
                rec = this.store.getAt(index);
                var parameter = this.parameter;
                var autonumeric = this.autonumeric;
                if(!this.menu){ // create context menu on first right click

                    this.menu = new Ext.menu.Menu({
                        id:'grid_productos-ctx',
                        enableScrolling : false,
                        items: [
                            {
                                text: 'Editar',
                                iconCls: 'page_white_edit',
                                scope:this,
                                handler: function(){
                                    if( !this.editable ){
                                        return;
                                    }
                                    if( this.ctxRecord.data.idactivo  ){
                                        var record = this.ctxRecord;
                                        var win = new EditarActivoWindow({
                                            idactivo: record.data.idactivo,
                                            idcategory: record.data.idcategory,
                                            idsucursal:record.data.idsucursal,
                                            folder: record.data.folder,
                                            gridopener: grid.id,
                                            parameter: parameter,
                                            autonumeric:autonumeric
                                        });
                                        win.show();
                                    }

                                }
                            },
                            {
                                text: 'Copiar en nuevo registro',
                                iconCls: 'page_copy',
                                scope:this,
                                handler: function(){                                    
                                    if( !this.editable ){
                                        return;
                                    }
                                    if( this.ctxRecord.data.idactivo  ){
                                        var record = this.ctxRecord;
                                        var win = new EditarActivoWindow({
                                            idactivo: record.data.idactivo,
                                            idcategory: record.data.idcategory,
                                            idsucursal:record.data.idsucursal,
                                            folder: record.data.folder,
                                            gridopener: grid.id,
                                            copy: true
                                        });
                                        win.show();
                                    }

                                }
                            },
                            {
                                text: 'Eliminar',
                                iconCls: 'delete',
                                scope:this,
                                handler: function(){
                                    if( !this.editable ){
                                        return;
                                    }
                                    if( this.ctxRecord.data.idactivo  ){
                                        this.eliminar(this.ctxRecord);
                                    }

                                }
                            }
                        ]
                    });
                    this.menu.on('hide', this.onContextHide , this);
                }
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
        },

        onRowDblclick: function( grid , rowIndex, e ){
            if( this.readOnly ){
                return;
            }
            
            record =  this.store.getAt( rowIndex );
        
            if( typeof(record)!="undefined" ){
                var win = new EditarActivoWindow({
                    idactivo: record.data.idactivo,
                    idcategory: record.data.idcategory,
                    folder: record.data.folder,
                    gridopener: grid.id,
                    parameter: this.parameter,
                    idsucursal: this.idsucursal,
                    autonumeric: this.autonumeric
                });
                win.show();
            
            }
        },
        eliminar: function(ctxRecord){
            if( this.readOnly ){
                return;
            }
            if( confirm("Esta seguro que desea eliminar este registro?") ){
                var store = this.store;
                
                Ext.Ajax.request(
                {
                    waitMsg: 'Eliminando...',
                    url: '<?= url_for("inventory/eliminarActivo") ?>',
                    method: 'POST',
                    //Solamente se envian los cambios
                    params :	{
                        idactivo: ctxRecord.data.idactivo,
                        id: ctxRecord.id
                    },

                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){                           
                            var rec = store.getById( res.id );
                            store.remove( rec );
                            rec.set("deleted", true);
                        }else{
                            Ext.MessageBox.alert('Error', "Ha ocurrido el siguiente error"+res.errorInfo);
                        }
                    },
                    failure:function(response,options){
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                    }
                }
            );
            }
        }


    });

</script>