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
    
        /*
         * Crea el expander
         */
        this.expander = new Ext.grid.RowExpander({
            lazyRender : false,
            width: 15,
            tpl : new Ext.Template(
            '<p><div class=\'btnComentarios\' id=\'obs_{_id}\'>&nbsp; {text}</div></p>'

        ),
            getRowClass : function(record, rowIndex, p, ds){
                p.cols = p.cols-1;

                var content = this.bodyContent[record.id];

                //if(!content && !this.lazyRender){		//hace que los comentarios no se borren cuando se guarda
                content = this.getBodyContent(record, rowIndex);
                //}

                if(content){
                    p.body = content;
                }

                var color;
                if( record.data.action=="Cerrado" ){
                    color = "blue";
                }else{
                    if( record.data.tipo=="Defecto" ){
                        color = "pink";
                    }else{
                        switch( record.data.priority ){
                            case "Media":
                                color = "yellow";
                                break;
                            case "Alta":
                                color = "pink";
                                break;
                            default:
                                color = "";
                                break;
                        }
                    }
                }
                color = "row_"+color;
                return this.state[record.id] ? 'x-grid3-row-expanded '+color : 'x-grid3-row-collapsed '+color;
            }
        });


        this.filters = new Ext.ux.grid.GridFilters({
            // encode and local configuration options defined previously for easier reuse
            encode: false, // json encode the filter query
            local: true,   // defaults to false (remote filtering)
            filters: [{
                    type: 'numeric',
                    dataIndex: 'idticket'
                }, {
                    type: 'string',
                    dataIndex: 'project'

                }, {
                    type: 'string',
                    dataIndex: 'title'

                },
                {
                    type: 'string',
                    dataIndex: 'tipo'

                },
                {
                    type: 'string',
                    dataIndex: 'login'

                },
                {
                    type: 'string',
                    dataIndex: 'asignadoaNombre'

                }
                , {
                    type: 'list',
                    dataIndex: 'priority',
                    options: ['Alta', 'Media', 'Baja']

                }, {
                    type: 'list',
                    dataIndex: 'action',
                    options: ['Abierto', 'Cerrado']

                },
                {
                    type: 'date',
                    dataIndex: 'opened'
                },
                {
                    type: 'date',
                    dataIndex: 'respuesta'
                },
                {
                    type: 'date',
                    dataIndex: 'ultseg'
                }
            ]
        });


   

    

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
                header: "Activo",
                dataIndex: 'noinventario',
                //hideable: false,
                width: 63,
                sortable: true,
                renderer: this.formatItem
        
            },
            {
                header: "Marca",
                dataIndex: 'marca',
                //hideable: false,
                sortable: true,
                width: 280
            },
            {
                header: "Modelo",
                dataIndex: 'modelo',
                hideable: false,
                sortable: true,
                width: 80

            },
            {
                header: "Ubicación",
                dataIndex: 'ubicacion',
                //hideable: false,
                sortable: true,
                width: 280

            },
            {
                header: "Procesador",
                dataIndex: 'procesador',
                hideable: false,
                sortable: true,
                width: 80
        
            },
     
            {
                header: "Memoria",
                dataIndex: 'memoria',
                hideable: false,
                sortable: true,
                width: 80
            },
            {
                header: "Disco",
                dataIndex: 'disco',
                hideable: false,
                sortable: true,
                width: 80
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
                sortable: true
            },
            {
                header: "Mantenimiento",
                dataIndex: 'mantenimiento',
                hideable: false,
                width: 100,
                sortable: true
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
            {name: 'mantenimiento', type: 'string'},
            {name: 'folder', type: 'string'},
            {name: 'deleted', type: 'boolean'}


        ]);
    
        this.store = new Ext.data.GroupingStore({
            autoLoad : true,
            url: '<?= url_for("inventory/datosPanelActivos") ?>',
            baseParams : {
                idcategory: this.idcategory
            
            },
            reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total'
            },
            this.record
        ),
            sortInfo:{field: 'noinventario', direction: "ASC"}
            //groupOnSort: true,
            //groupField: 'noinventario'
        

        });

        if(this.editable)
        {
            this.tbar = [
         
                {
                    text: 'Nuevo',
                    tooltip: '',
                    iconCls: 'add',  // reference to our css
                    scope: this,
                    handler: this.crearActivo
                },

                {
                    text: 'Recargar',
                    tooltip: 'Actualiza losdatos del panel',
                    iconCls: 'refresh',  // reference to our css
                    scope: this,
                    handler: this.recargar
                }
         
            ];
        }
    
        PanelActivos.superclass.constructor.call(this, {
            loadMask: {msg:'Cargando...'},
            //boxMinHeight: 300,
            ddGroup : 'TreeDD',
            enableDragDrop   : true,
            autoScroll:true,
            plugins: [
                this.filters
            ],
            view: new Ext.grid.GroupingView({

                forceFit:true,
                enableRowBody:true,
                hideGroupedColumn: true
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
                                    if( this.ctxRecord.data.idactivo  ){
                                        var record = this.ctxRecord;
                                        var win = new EditarActivoWindow({
                                            idactivo: record.data.idactivo,
                                            idcategory: record.data.idcategory,
                                            folder: record.data.folder,
                                            gridopener: grid.id
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
                                    if( this.ctxRecord.data.idactivo  ){
                                        var record = this.ctxRecord;
                                        var win = new EditarActivoWindow({
                                            idactivo: record.data.idactivo,
                                            idcategory: record.data.idcategory,
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
            if(!this.editable){
                return;
            }
            record =  this.store.getAt( rowIndex );
        
            if( typeof(record)!="undefined" ){
                var win = new EditarActivoWindow({
                    idactivo: record.data.idactivo,
                    idcategory: record.data.idcategory,
                    folder: record.data.folder,
                    gridopener: grid.id
                });
                win.show();
            
            }
        },
        eliminar: function(ctxRecord){
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