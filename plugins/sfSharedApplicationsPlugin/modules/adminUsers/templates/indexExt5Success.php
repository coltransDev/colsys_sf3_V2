<style>
.x-grid-cell-inner {    
    white-space: pre-line !important;
}

.my-home-icon {
    background-image: url(/images/22x22/home.gif) !important;
}

.fa-bus:before {
       content: "\f207" !important; 
}

.file-view .userthumb {
    padding: 3px;
}

.file-view .x-view-selected {
    background: #eff5fb url("images/selected.gif") no-repeat scroll right bottom;
    border: 1px solid #99bbe8;
    padding: 4px;
}
.file-view .thumb-wrap {
    float: left;
    margin: 4px 0 4px 4px;
    padding: 5px;
}
.file-view .x-item-selected {
    background-color: #d3e1f1 !important;
}
</style>
<div id="appContent" class="app-content"></div>
<script src="https://use.fontawesome.com/c696ddcd4e.js"></script>

<script>
    Ext.Loader.setConfig({
        enabled: true,    
        paths: {            
            'Ext.ux': '../js/ext5/examples/ux/',            
            'Ext.ux.exporter':'../js/ext5/examples/ux/exporter/',
            'Colsys':'/js/Colsys'
        }
    });

    Ext.require([        
        'Ext.ux.form.SearchField',
        'Ext.ux.exporter.Exporter'
    ]);

    Ext.onReady(function() {
        Ext.tip.QuickTipManager.init();

        var msg = function(title, msg) {
            Ext.Msg.show({
                title: title,
                msg: msg,
                minWidth: 200,
                modal: true,
                icon: Ext.Msg.INFO,
                buttons: Ext.Msg.OK
            });
        };

        var store = Ext.create('Ext.data.TreeStore', {
            root: {
                expanded: false
            },
            proxy: {
                type: 'ajax',
                url: '<?=url_for("adminUsers/datosIndex")?>'
            }
        });

        new Ext.Panel({
            renderTo: 'appContent',
            height:600,
            layout:'border',
            /*defaults: {
                collapsible: true,
                split: true,
                bodyStyle: 'padding:15px'
            },*/
            items: [{
                region: 'west',
                collapsible: true,
                autoScroll:true,
                //split: true,
                title: 'Intranet',
                width: 180,
                items:[{
                    xtype:'treepanel',
                    id:'tree-id',
                    height: 400,
                    //autoScroll:true,                
                    rootVisible: false,
                    store: store,
                    /*dockedItems: [{
                        xtype: 'toolbar',
                        dock: 'top'
                    }],*/
                    listeners:{
                        itemclick: function(t,record,item,index){
                            var sufijo = "";
                            var tabpanel = Ext.getCmp("tabpanel");                        
                            if(record.data.id==="10"){
                                obj = [{
                                    xtype:'Colsys.Users.GridUsuarios',
                                    id:'grid-usuarios',
                                    name:'grid-usuarios',
                                    frame:true,
                                    app:'<?=$app?>'
                                }];
                                sufijo = "grid-usuarios";
                                //    Ext.Create('Colsys.Users.GridUsuarios',{id:'grid-usuarios',name:'grid-usuarios',frame:true}
                            }else if(record.data.id==="20") {
                                obj = [{
                                    xtype:'Colsys.Users.GridCargos',
                                    id:'grid-cargos',
                                    name:'grid-cargos',
                                    frame:true,
                                    app:'<?=$app?>',
                                    permisos:'<?=$permisos?>'
                                }];
                                sufijo = "grid-cargos";                            
                            }else if(record.data.id==="30") {
                                obj = [{
                                    xtype:'Colsys.Users.GridHijos',
                                    id:'grid-hijos',
                                    name:'grid-hijos',
                                    frame:true,
                                    app:'<?=$app?>',
                                    permisos:'<?=$permisos?>'
                                }];
                                sufijo = "grid-hijos";
                            }/*else if(record.data.id==="60") {
                                obj = [{
                                    xtype:'Colsys.Users.ViewUsers',
                                    id:'panel-users',
                                    name:'panel-users',
                                    frame:true,
                                    store: new Ext.data.JsonStore({
                                        autoload: true,
                                        root: 'root',
                                        fields: ['login','name', 'icon'],
                                        proxy: {
                                            type: 'ajax',
                                            url: '/adminUsers/datosUsuariosZonas',
                                            reader: {
                                                type: 'json',
                                                rootProperty: 'root'
                                            },
                                            extraParams:{
                                                idzona: 1
                            }
                                        }
                                    }),
                                    app:'<?=$app?>',
                                    permisos:'<?=$permisos?>'
                                }];
                                sufijo = "panel-users";
                            }*/
    
                            for(var i=1; i<13; i++){
                               if(record.data.id===i){
                                    obj = [
                                        Ext.create('Ext.form.Panel', {
                                            title: 'Zona'+i,
                                            bodyPadding: 5,
                                            //height: 260,
                                            items: [{
                                                xtype:'Colsys.Users.ViewUsers',
                                                id:'panel-users'+i,
                                                name:'panel-users'+i,
                                                frame:true,
                                                store: new Ext.data.JsonStore({
                                                    autoload: true,
                                                    root: 'root',
                                                    fields: ['login','name', 'icon'],
                                                    proxy: {
                                                        type: 'ajax',
                                                        url: '/adminUsers/datosUsuariosZonas',
                                                        reader: {
                                                            type: 'json',
                                                            rootProperty: 'root'
                                                        },
                                                        extraParams:{
                                                            idzona: i
                                                        }
                                                    }
                                                }),
                                                app:'<?=$app?>',
                                                permisos:'<?=$permisos?>'
                                            }],
                                            dockedItems: [
                                                {
                                                    xtype: 'toolbar',
                                                    dock: 'top',
                                                    items: [
                                                        Ext.create('Colsys.Widgets.wgUsuario', {
                                                            id: "vendedor"+i,                                                    
                                                            width: 300,
                                                            listeners: {
                                                                select: function (combo, records, eOpts) {
                                                                    var panel = Ext.getCmp('panel-users1');
                                                                    console.log(i);
                                                                    Ext.Ajax.request({
                                                                        url: '<?=url_for("/adminUsers/agregarUsuarioZona")?>',
                                                                        method: 'POST',
                                                                        //Solamente se envian los cambios
                                                                        params :	{
                                                                            login:records.data.login,
                                                                            idzona: i
                                                                        },

                                                                        callback :function(options, success, response){
                                                                            panel.store.reload();
                                                                            combo.setValue("");
                                                                        }
                                                                     });                                                                    
                                                                }
                                                            }
                                                        }),
                                                        {
                                                            text: 'Borrar',
                                                            tooltip: 'Elimina el usuario seleccionado',
                                                            iconCls:'delete',  // reference to our css
                                                            idcomponent: this.idcomponent, 
                                                            scope: this,
                                                            handler: function(){
                                                                var fv = Ext.getCmp("panel-users1");
                                                                //records =  fv.getSelectedRecords();
                                                                var records = fv.selModel.getSelection();
                                                                //console.log(records.length);
                                                                
                                                                
                                                                var storeView = fv.getStore();
                                                                for( var j=0;j< records.length; j++){
                                                                    if( confirm( 'Esta seguro que desea borrar el archivo seleccionado?') ){                
                                                                        Ext.Ajax.request({
                                                                            url: '/adminUsers/eliminarUsuarioZona',
                                                                            params: {
                                                                                login: records[j].data.login,
                                                                                idzona: this.i,
                                                                                id: records[j].id
                                                                            },

                                                                            callback :function(options, success, response){
                                                                                var res = Ext.util.JSON.decode( response.responseText );
                                                                                storeView.each(function(r){
                                                                                    if(r.id==res.id){
                                                                                        storeView.remove(r);
                                                                                        Ext.Msg.alert("Success", "Se ha eliminado el usuario");
                                                                                    }
                                                                                });

                                                                            }
                                                                        });
                                                                    }
                                                                }
                                                            }
                                                        }]
                                                }]
                                        })
                                    ];
                                    sufijo = "panel-users"+i;
                                }                                 
                            }
                            
                            var tab = tabpanel.getChildByElement('tab'+record.data.id)

                            if(!tab){ //si no existe lo creamos
                                tab = new Ext.Panel({  
                                    title: record.data.text,
                                    id:'tab-'+record.data.id,
                                    itemId:'tab-'+record.data.id,                                        
                                    closable: true,
                                    items: obj
                                });
                                Ext.getCmp(sufijo).getStore().reload();
                                tabpanel.add(tab).show();                            
                            }

                            tabpanel.setActiveTab('tab'+record.data.id); //
                        }
                    }
                }]
                // could use a TreePanel or AccordionLayout for navigational items
            }, {
                region: 'south',
                title: 'Adicional',
                collapsed: true,
                collapsible: true,
                html: 'Information goes here',
                split: true,
                height: 100,
                minHeight: 100
            }, {
                region: 'east',
                title: 'Información',
                collapsible: true,
                collapsed: true,
                split: true,                
                width: 150
            }, {
                region: 'center',
                xtype: 'tabpanel', // TabPanel itself has no title
                activeTab: 0,      // First tab active by default
                id:"tabpanel"/*,
                items: {
                    title: 'Default Tab',
                    html: 'The first tab\'s content. Others may be added dynamically',
                    id:'tab-form1'
                }*/
            }]
        });
    });
</script>