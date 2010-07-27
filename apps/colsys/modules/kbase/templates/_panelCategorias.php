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
        // tree-specific configs:
        rootVisible: false,
        lines: false,
        singleExpand: true,
        useArrows: true,
        //iconCls:'settings',
        animate:true,
        loader: new Ext.tree.TreeLoader({
            dataUrl:'<?=url_for("kbase/datosPanelCategorias")?>',
            baseParams: {
                namespace: this.namespace
            }
        }),

        root: new Ext.tree.AsyncTreeNode()
        ,
        listeners:  {
             click : this.onClick,
             contextmenu: this.onContextMenu             
        }
    });
}

Ext.extend(PanelCategorias, Ext.tree.TreePanel, {
    onClick: function(n){
        //var sn = this.selModel.selNode || {}; // selNode is null on initial selection
        if( n.leaf ){  // ignore clicks on folders           
            //var nodeoptions = n.id.split("_");
            
            var action = n.attributes.action;
            var idcategoria = n.attributes.idcategoria;
         

            //Coloca un identificador unico para evitar que el componente se cree dos veces
            var idcomponent = action;
            var title = n.attributes.text;
            /*
            * Todo debe quedar de esta manera
            **/
            if( Ext.getCmp('tab-panel').findById(idcomponent) ){
                Ext.getCmp('tab-panel').setActiveTab(idcomponent);
            }else{
                //alert( action );
                switch( action ){                   
                    default:

                        /*
                        * Se muestran el panel de tickets de acuerdop al criterio
                        */
                        var newComponent = new PanelReading({
                             id:idcomponent,
                             closable: true,
                             idcategory: 17,
                             title: title
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
                            handler: function(){
                                  this.crear( );
                            }
                        },
                        {
                            text: 'Editar',
                            iconCls: 'page_white_edit',
                            scope:this,
                            handler: function(){
                                  this.editar( );
                            }
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
                        }
                        ]
                });
            }
            e.stopEvent();
            this.menu.showAt(e.getXY());
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
        fp.getForm().findField("parent").setValue(n.attributes.parentNode);
        fp.getForm().findField("name").setValue(n.attributes.name);
        fp.getForm().findField("main").disable();
        
    },
    eliminar: function( ){
        var n = this.ctxNode;
        if( n ){
            Ext.Ajax.request(
            {
                waitMsg: 'Eliminando...',
                url: '<?=url_for("kbase/eliminarCategoria")?>',
                //method: 'POST',
                //Solamente se envian los cambios
                params :	{
                    idcategory: n.attributes.idcategoria
                },

                //Ejecuta esta accion en caso de fallo
                //(404 error etc, ***NOT*** success=false)
                failure:function(response,options){
                    alert( "Ha ocurrido un error: ".response.responseText );
                },



                //Ejecuta esta accion cuando el resultado es exitoso
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                        n.remove();
                    }
                }
            });
        }
    }
    
});

</script>