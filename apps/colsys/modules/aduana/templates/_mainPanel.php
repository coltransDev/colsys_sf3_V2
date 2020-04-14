<script>
Ext.define('Colsys.Aduana.Mainpanel', {
    extend: 'Ext.panel.Panel',    
    alias: 'widget.wCIMainpanel',
    autoHeight: true,
    items: [
    ],
    buttons: [],
    onRender: function (ct, position) {
        var me = this;

        tabs = new Array(); 
        console.log(this.idmaster);
//        console.log("MainPanel");
//        console.log(this.permisos);
//        console.log(this.permisoscrm);
//        console.log("FinMainPanel");        
        
        if (this.permisos.Consultar == true) {
            tabs.push({
                xtype: 'Colsys.Aduana.FormExpoAduana',
                title: "General",
                id:'form-expo-adu-'+me.idmaster,
                idmaster: me.idmaster,
                idtransporte: me.idtransporte,
                idimpoexpo: this.idimpoexpo,
                permisos: me.permisos,
                permisoscrm: me.permisoscrm,
                idreferencia: me.idreferencia,
                origen: me.origen,
                destino: me.destino,
                //modo: me.modo,
                flex: 2
            });            
        

            if (this.idimpoexpo == "<?= Constantes::EXPO ?>" && this.modo!= "Crear") { 
                tabs.push({
                    xtype: 'component',                        
                    title: "Aduana",
                    id: 'panel-document-preview'+ me.idmaster,
                    itemId: 'panel-document-preview'+ me.idmaster,    
                    autoEl: {
                        tag: 'iframe',
                        width: '100%',
                        height: '100%',
                        frameborder: '0',
                        scrolling: 'auto',
                        src: '/Coltrans/Aduanas/ConsultaReferenciaAction.do?referencia='+me.idreferencia+'&consulta='
                    },
                    listeners: {
                        beforerender: function (ct, position) {
                            this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 150);
                            this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 50);
                        }
                    }
                });

                tabs.push(
                    Ext.create('Ext.Panel', {
                        title: "Eventos",
                        layout: {
                            type: 'hbox',
                            pack: 'start',
                            align: 'stretch'
                        },
                        iconCls: 'event-add',
                        id: "Panel-Eventos-" + me.idmaster,
                        name: "Panel-Eventos-" + me.idmaster,
                        items: [{
                            xtype: 'Colsys.Ino.GridEvento',
                            title: 'Listado de Eventos',
                            id: "Eventos-" + me.idmaster,
                            name: "Eventos-" + me.idmaster,
                            idmaster: me.idmaster,
                            idtransporte: me.idtransporte,
                            idimpoexpo: me.idimpoexpo,
                            idreferencia: me.idreferencia,
                            tipo: 'Aduana',
                            permisos: me.permisos,
                            permisoscrm: me.permisoscrm,
                            plugins: [
                                new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
                            ],
                            collapsible: true,
                            collapseDirection : 'left',
                            flex: 1.5
                        }]
                    })
                );
        
                tabs.push({
                    xtype: 'Colsys.GestDocumental.treeGridFiles',
                    title: "Documentos",
                    id: "Documentos-"+ me.idmaster,
                    name: "Documentos-"+me.idmaster,
                    idmaster: me.idmaster,
                    idreferencia: me.idreferencia,
                    idtransporte: me.idtransporte,
                    idimpoexpo: me.idimpoexpo,
                    permisos: me.permisos,
                    iconCls: 'folder',
                    height: 640,
                    treeStore: 'documentosIno',
                    listeners: {
                        afterrender: function (ct, position) {
                            Ext.getCmp("Documentos-"+me.idmaster ).setStore(
                                Ext.create('Ext.data.TreeStore', {
                                    fields: [
                                        {name: 'idarchivo', type: 'string'},
                                        {name: 'nombre', type: 'string'},
                                        {name: 'documento', type: 'string'},
                                        {name: 'iddocumental', type: 'string'},
                                        {name: 'path', type: 'string'},
                                        {name: 'ref1', type: 'string'},
                                        {name: 'ref2', type: 'string'},
                                        {name: 'ref3', type: 'string'},
                                        {name: 'usucreado', type: 'string'},
                                        {name: 'fchcreado', type: 'string'}
                                    ],
                                    proxy: {
                                        type: 'ajax',
                                        url: '/gestDocumental/dataFilesTree',
                                        autoLoad: false,
                                        extraParams: {
                                            ref1: me.idreferencia,
                                            ref2: "Colmas",
                                            idsserie: 15,
                                            exacto:"true"
                                        }
                                    },
                                    autoLoad: true
                                })
                            );
                        }
                    }
                });
            }
        }

        this.add({
            xtype: 'tabpanel',
            id: 'tab-panel-principal-' + this.idmaster,
            activeTab: 0,
            items: tabs
        });
        this.superclass.onRender.call(this, ct, position);
    }
});
</script>