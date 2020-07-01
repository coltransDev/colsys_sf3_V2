/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



Ext.define('Colsys.General.TreeClasificacion', {
    extend: 'Ext.tree.Panel',
    alias: 'widget.Colsys.General.TreeClasificacion',
    autoScroll:true,                
    rootVisible: false,
    border:false,
    store: Ext.create('Ext.data.TreeStore', {
        root: {
            expanded: false
        },
        proxy: {
            type: 'ajax',
            url: '/config/datosClasificacion'
        }
    }),
    getAt: function (index) {
        var current = 0;
        return (function find(nodes) {
            var i, len = nodes.length;
            for (i = 0; i < len; i++) {
                if (current === index) {
                    return nodes[i];
                }
                current++;
                var found = find(nodes[i].childNodes);
                if (found) {
                    return found;
                }
            }
        }(this.getStore().root.childNodes));
    },
    findValue: function (field, value) {
        var current = 0;
        return (function find(nodes) {
            var i, len = nodes.length;
            for (i = 0; i < len; i++) {
                if (nodes[i].get(field) === value) {
                    return nodes[i];
                }
                current++;
                var found = find(nodes[i].childNodes);
                if (found) {
                    return found;
                }
            }
        }(this.getStore().root.childNodes));
    },
    selectByField: function (field, value) {
        var node = this.findValue(field, value);
        this.getSelectionModel().select(node);
        this.expandPath(node.getPath());
    },
    dockedItems: [{
        xtype: 'toolbar',
        dock: 'top'
    }],
    listeners:{
//        itemclick: function(t,record,item,index){
//            alert(!isNaN(record.data.id))
//        },
//        itemmouseenter: function( t, record, item, index, e, eOpts ){
//
//        },
        itemcontextmenu ( t , record , item , index , e , eOpts )
        {
            e.stopEvent();        
            var tree=this;

            itemCm = new Array();

            if(this.permisos.Crear)
            {
                itemCm.push(
                        {
                        text: 'Agregar',
                        handler: function() {
                            var a=Ext.MessageBox.prompt('Nombre', 'Agrege el nombre del subitem',
                            function(btn, text){
                                if(text!="")
                                {
                                    Ext.Ajax.request(
                                    {
                                        url: '/config/agregarItemClasificacion',
                                        params :	{
                                            idclasificacion: record.data.idclasificacion,
                                            nombre: text,
                                            tipo: record.data.tipo
                                        },

                                        failure:function(response,options){
                                            var res = Ext.util.JSON.decode( response.responseText );
                                            Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(res.errorInfo?": "+res.errorInfo:"")+" - "+(response.status?"\n Codigo HTTP "+response.status:""));
                                        },
                                        success:function(response,options){
                                            var res = Ext.util.JSON.decode( response.responseText );
                                            if( res.success ){

                                                var selModel = tree.getSelectionModel();
                                                var node = selModel.getLastSelected();
                                                if (!node) {
                                                    return;
                                                }

                                                node.set('leaf', false);
                                                node.appendChild({
                                                    leaf: true,
                                                    text: text,
                                                    tipo: res.tipo,
                                                    idclasificacion: res.idclasificacion,
                                                });
                                                tree.getView().refresh();
                                                node.expand();
                                                //console.log(tree)
                                            }else{
                                                Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(res.errorInfo?": "+res.errorInfo:"")+" - "+(response.status?"\n Codigo HTTP "+response.status:""));
                                            }
                                        }
                                    });
                                }                                
                                else
                                    Ext.MessageBox.alert("Sin dato", "por favor ingrese un nombre")
                            });


                        //document.location = '/inoF/formCosto/modo=6/idinocosto/'+record.get('id');
                        }
                    }
                );            
            }

            if(this.permisos.Anular)
            {
                itemCm.push(
                {
                    text: 'Eliminar',
                    iconCls: 'delete',
                    handler: function() {                        
                        if(record.data.leaf==false)
                        {
                            alert("No es posible eliminar este item");
                            return;
                        }

                       Ext.MessageBox.confirm('Confirmacion', 'esta seguro de Eliminar el registro', 
                        function(e){
                            if(e == 'yes'){
                                var box = Ext.MessageBox.wait('Procesando', 'Eliminando')
                                Ext.Ajax.request({
                                    url: '/config/anularItemClasificacion',
                                    params :{
                                        idclasificacion: record.data.idclasificacion
                                        //modo: '<?//=$modo->getCaIdmodo()?>'
                                    },
                                    success: function(response, opts) {
                                        var obj = Ext.decode(response.responseText);

                                        var selModel = tree.getSelectionModel();
                                            var node = selModel.getLastSelected();
                                            if (!node) {
                                                return;
                                            }

                                            node.remove();                                            
                                            tree.getView().refresh();
                                            //node.expand();

                                        box.hide();
                                    },
                                    failure: function(response, opts) {
                                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                        box.hide();
                                    }
                                });
                            }
                        })
                    }
                });

            }
            var menu = new Ext.menu.Menu({
                items: itemCm
            }).showAt(e.getXY());
        }
    }
});


