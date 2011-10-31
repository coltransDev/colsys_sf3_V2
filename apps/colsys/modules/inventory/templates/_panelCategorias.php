<?
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
    /**
     * PanelCategorias object definition
     **/
    PanelCategorias = function( config ){
        Ext.apply(this, config);

        PanelCategorias.superclass.constructor.call(this, {
            split: true,
            height: 300,
            minSize: 150,
            autoScroll: true,
            enableDrop:true,
            ddGroup : 'TreeDD',
            // tree-specific configs:
            rootVisible: false,
            lines: false,
            singleExpand: true,
            useArrows: true,
            //iconCls:'settings',
            animate:true,
            loader: new Ext.tree.TreeLoader({
                dataUrl:'<?= url_for("inventory/datosPanelCategorias") ?>?idsucursal='+this.idsucursal
            
            }),

            root: new Ext.tree.AsyncTreeNode()
            ,
            listeners:  {
                click : this.onClick,
                contextmenu: this.onContextMenu ,
                beforenodedrop : this.onBeforeNodeDrop
             
            }
        });
    }

    Ext.extend(PanelCategorias, Ext.tree.TreePanel, {
        onClick: function(n){
            //var sn = this.selModel.selNode || {}; // selNode is null on initial selection
            if( n.leaf ){  // ignore clicks on folders           
                //var nodeoptions = n.id.split("_");            
                var parameter = n.attributes.parameter;
                var idcategory = n.attributes.idcategoria;
                var autonumeric = n.attributes.autonumeric;
                var prefix = n.attributes.prefix;
            
                //Coloca un identificador unico para evitar que el componente se cree dos veces
                var idcomponent = 'categoria-'+idcategory+"-"+this.idsucursal;
                var title =  this.idsucursal+" "+n.attributes.name;
                /*
                 * Todo debe quedar de esta manera
                 **/
                if( Ext.getCmp('tab-panel').findById(idcomponent) ){
                    Ext.getCmp('tab-panel').setActiveTab(idcomponent);
                }else{
                    //alert( action );                
                    switch( parameter ){                   
                        default:

                            /*
                             * Se muestran el panel de tickets de acuerdop al criterio
                             */
                            var newComponent = new PanelReading({id:idcomponent,
                                title: title,
                                idcategory: idcategory,
                                idsucursal: this.idsucursal,
                                closable: true,
                                editable: true,
                                parameter: parameter,
                                autonumeric: autonumeric,
                                readOnly: this.readOnly,
                                prefix:prefix
                            });


                            break;
                    }


                    Ext.getCmp('tab-panel').add(newComponent);
                    Ext.getCmp('tab-panel').setActiveTab(newComponent);
                }
                return 0;
            
            }else{
                n.expand();
            }
        },

        onContextMenu: function( node,  e ) {
            if( this.readOnly ){
                return false;
            }
            var id = node.id;

            this.ctxNode = node;
            if( !this.readOnly ){

                if(!this.menu){ // create context menu on first right click
                    this.menu = new Ext.menu.Menu({
                        enableScrolling : false,
                        items: [{
                                text: 'Agregar',
                                iconCls: 'add',
                                scope:this,
                                handler: this.crear
                            },
                            {
                                text: 'Editar',
                                iconCls: 'page_white_edit',
                                scope:this,
                                handler: this.editar
                            },
                            {
                                text: 'Eliminar',
                                iconCls: 'delete',
                                scope:this,
                                handler: function(){
                                    if( confirm("Esta seguro?")){
                                        this.eliminar( );
                                    }
                                }
                            },
                            {
                                text: 'Modelos',
                                iconCls: 'page_white_edit',
                                scope:this,
                                handler: this.editarModelos
                            }
                        ]
                    });
                }
                e.stopEvent();
                this.menu.showAt(e.getXY());
            }

        },
        onBeforeNodeDrop: function( e ){
            if( this.readOnly ){
                return false;
            }
            var ddSource = e.source;
            var selectedRecords = ddSource.dragData.selections;
            var node = e.target;
        
            var idcategoria = node.attributes.idcategoria;
            //alert( selectedRecord.data.idissue+" "+node.attributes.idcategoria );

            var grid = ddSource.grid;
            if(node.leaf){
            
                for( var i=0; i<selectedRecords.length; i++){                
                    selectedRecord = selectedRecords[i];
                    var idactivo = selectedRecord.data.idactivo;
                    Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando...',
                        url: '<?= url_for("inventory/cambiarCategoria") ?>',
                        //method: 'POST',
                        //Solamente se envian los cambios
                        params :	{
                            idactivo: idactivo,
                            idcategory: idcategoria,
                            id: selectedRecord.id
                        },

                        //Ejecuta esta accion en caso de fallo
                        //(404 error etc, ***NOT*** success=false)
                        failure:function(response,options){
                            Ext.MessageBox.alert("Error", "Ha ocurrido un error" );
                        },
                        //Ejecuta esta accion cuando el resultado es exitoso
                        success:function(response,options){
                            var res = Ext.util.JSON.decode( response.responseText );
                            if( res.success ){
                                var rec = grid.store.getById( res.id );
                                grid.store.remove(rec);
                            }else{
                                Ext.MessageBox.alert("Error", "Ha ocurrido un error: "+res.errorInfo );
                            }
                        }
                    });
                }
            }else{
                Ext.MessageBox.alert("Error", "No es posible mover el elemento aca");
            }

        },
        crear: function( ){
            var n = this.ctxNode;        
            if( !n.attributes.leaf ){
                this.win = new PanelCategoriaWindow({node: n, action:"add"});
                this.win.show();
                var fp = Ext.getCmp("categoria-form");
                fp.getForm().findField("parent").setValue(n.attributes.idcategoria);
                fp.getForm().findField("main").enable();            
                fp.getForm().findField("idsucursal").setValue(this.idsucursal);
                fp.getForm().findField("autonumeric").setValue(n.attributes.autonumeric);
                fp.getForm().findField("prefix").setValue(n.attributes.prefix)
            }else{
                Ext.MessageBox.alert("Error","No es posible agregar un nodo en este punto");
            }

        },
        editar: function( ){
        
            var n = this.ctxNode;
            this.win = new PanelCategoriaWindow({node: n, action:"edit"});
            this.win.show();
            var fp = Ext.getCmp("categoria-form");
            fp.getForm().findField("idcategory").setValue(n.attributes.idcategoria);
            fp.getForm().findField("idsucursal").setValue(n.attributes.idsucursal);
            fp.getForm().findField("parent").setValue(n.attributes.parentNode);
            fp.getForm().findField("parameter").setValue(n.attributes.parameter);
            fp.getForm().findField("name").setValue(n.attributes.name);
            fp.getForm().findField("autonumeric").setValue(n.attributes.autonumeric);
            fp.getForm().findField("prefix").setValue(n.attributes.prefix)
            fp.getForm().findField("main").disable();
            fp.getForm().findField("parameter").disable();

        },
        eliminar: function( ){
        
            var n = this.ctxNode;
            if( n ){
                Ext.Ajax.request(
                {
                    waitMsg: 'Eliminando...',
                    url: '<?= url_for("inventory/eliminarCategoria") ?>',
                    //method: 'POST',
                    //Solamente se envian los cambios
                    params :	{
                        idcategory: n.attributes.idcategoria
                    },

                    //Ejecuta esta accion en caso de fallo
                    //(404 error etc, ***NOT*** success=false)
                    failure:function(response,options){
                        Ext.MessageBox.alert("Error", "Ha ocurrido un error" );
                    },
                    //Ejecuta esta accion cuando el resultado es exitoso
                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){
                            n.remove();
                        }else{
                            Ext.MessageBox.alert("Error", "Ha ocurrido un error: "+res.errorInfo );
                        }
                    }
                });
            }
        },    
        editarModelos: function(){   
            var n = this.ctxNode;
            if( n ){
                if( n.attributes.parameter!="Software" ){
                    alert("Esta opción solo esta disponible para inventarios de software");
                    return 0;
                }
                if( n.attributes.main ){ 
                    alert("Por favor seleccione una categoria");
                    return 0;
                }
                var idcategory = n.attributes.idcategoria;
                var idcomponent = 'modelos-'+idcategory;
                var title =  "Modelos "+n.attributes.name;
                /*
                 * Todo debe quedar de esta manera
                 **/
                if( Ext.getCmp('tab-panel').findById(idcomponent) ){
                    Ext.getCmp('tab-panel').setActiveTab(idcomponent);
                }else{
                    var newComponent = new PanelProductos({id:idcomponent,
                        title: title,
                        idcategory: idcategory,                        
                        closable: true,
                        editable: true                        
                    });
                    Ext.getCmp('tab-panel').add(newComponent);
                    Ext.getCmp('tab-panel').setActiveTab(newComponent);
                }
            }
        }
    
    });

</script>