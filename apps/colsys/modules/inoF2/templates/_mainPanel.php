<script>

    Ext.define('Colsys.Ino.Mainpanel', {
        extend: 'Ext.panel.Panel',
        alias: 'widget.wCIMainpanel',
        autoHeight: true,
        onRender: function (ct, position) {
            var me = this;
            
            tabs = new Array();            
            
            if (this.permisos.General == true) {
                tabs.push({
                    xtype: 'Colsys.Ino.FormMaster',
                    title: "General ",
                    id: "form-master-" + this.idmaster,
                    name: "form-master-" + this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    permisos: this.permisos,
                    idempresa: this.idempresa,
                    iconCls: 'application_form',
                    idmodalidad: this.modalidad
                });
            }

            if (!isNaN(this.idmaster) && this.idmaster > 0)
            {
                if (this.idtransporte != "A\u00E9reo") {
                    tabs.push({
                        xtype: 'Colsys.Ino.GridContenedores',
                        title: "Equipos ",
                        id: "contenderores-" + this.idmaster,
                        name: "contenderores-" + this.idmaster,
                        idmaster: this.idmaster,
                        idtransporte: this.idtransporte,
                        idmodalidad: this.modalidad,                        
                        idimpoexpo: this.idimpoexpo,
                        permisos: this.permisos,
                        iconCls: 'camion'
                    });
                }
                if (this.permisos.House == true) {
                    tabs.push(
                            {
                                xtype: 'Colsys.Ino.GridHouse',
                                title: "House",
                                id: "grid-house-" + this.idmaster,
                                name: "grid-house-" + this.idmaster,
                                idmaster: this.idmaster,
                                idtransporte: this.idtransporte,
                                idimpoexpo: this.idimpoexpo,
                                idmodalidad: this.modalidad,
                                permisos: this.permisos,
                                iconCls: 'table'
                            });
                }
                

                if (this.idtransporte == "<?= Constantes::MARITIMO ?>" && this.permisos.Muisca == true) {    /* FIX-ME Permisos para Radicaci?n*/
                    tabs.push({
                        xtype: 'Colsys.Ino.PanelRadicacion',
                        title: "Radicacion",
                        id: "radicacion-" + this.idmaster,
                        name: "radicacion-" + this.idmaster,
                        idmaster: this.idmaster,
                        idtransporte: this.idtransporte,
                        idimpoexpo: this.idimpoexpo,
                        idreferencia: this.idreferencia,
                        permisos: this.permisos,
                        iconCls: 'dian'
                    });
                }
                 
                
                if (this.permisos.Facturacion == true) {

                    if (this.tipofacturacion == "Grid") 
                    {
                        tabs.push({
                            xtype: 'Colsys.Ino.GridFacturacion',
                            title: "Ingresos" ,
                            id: "grid-facturacion-" + this.idmaster,
                            name: "grid-facturacion-" + this.idmaster,
                            idmaster: this.idmaster,
                            idtransporte: this.idtransporte,
                            idimpoexpo: this.idimpoexpo,
                            permisos: this.permisos,
                            iconCls: 'money_dollar',
                            autoScroll: true,
                            autoHeight: true
                            });
                        
                    }else{
                        tabs.push({
                            xtype: 'Colsys.Ino.PanelFacturacion',
                            title: "Ingresos",
                            id: "panel-facturacion-" + this.idmaster,
                            name: "panel-facturacion-" + this.idmaster,
                            idmaster: this.idmaster,
                            idtransporte: this.idtransporte,
                            idimpoexpo: this.idimpoexpo,
                            permisos: this.permisos,
                            autoScroll: true,
                            autoHeight: true,
                            iconCls: 'money_dollar',
                            ino: true
                        });                         
                    }
                }
                
                if (this.permisos.Costos == true) {

                    tabs.push({
                        xtype: 'Colsys.Ino.GridCosto',
                        title: "Costos",
                        id: "costo-" + this.idmaster,
                        name: "costo-" + this.idmaster,
                        idmaster: this.idmaster,
                        idtransporte: this.idtransporte,
                        idimpoexpo: this.idimpoexpo,
                        permisos: this.permisos,
                        iconCls: 'icon-grid1'
                    });
                }

                if (this.idimpoexpo == "<?= Constantes::EXPO ?>") {
                    tabs.push(
                        Ext.create('Ext.panel.Panel', {
                            title: "Eventos",                            
                            layout: {
                                type: 'hbox',
                                pack: 'start',
                                align: 'stretch'
                            },
                            iconCls: 'event-add',
                            id: "Panel-Eventos-" + this.idmaster,
                            name: "Panel-Eventos-" + this.idmaster,
                            items: [{                                    
                                xtype: 'Colsys.Ino.GridEvento',                                
                                title: 'Listado de Eventos',
                                id: "Eventos-" + me.idmaster,
                                name: "Eventos-" + me.idmaster,
                                idmaster: me.idmaster,
                                idtransporte: me.idtransporte,
                                idimpoexpo: me.idimpoexpo,
                                idreferencia: me.idreferencia,
                                tipo: 'Carga',
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

                    var tipoDoc = '';
                    if (this.idtransporte == "<?= Constantes::AEREO ?>") {
                        tipoDoc = 'Gu\u00EDas';
                        tipoGrid = 'Colsys.Ino.GridAwbsTransporte';
                    } else if (this.idtransporte == "<?= Constantes::MARITIMO ?>") {
                        tipoDoc = 'Hbls';                        
                        tipoGrid = 'panel'; /*FIX-ME M?dulo de Impresion Hbls de Exportaciones*/
                    } else {
                        tipoDoc = 'Docs';
                        tipoGrid = 'panel';
                    }
                    tabs.push({
                        xtype: tipoGrid,
                        title: tipoDoc,
                        id: "Impresion-" + this.idmaster,
                        name: "Impresion-" + this.idmaster,
                        idmaster: this.idmaster,
                        idtransporte: this.idtransporte,
                        idimpoexpo: this.idimpoexpo,
                        idreferencia: this.idreferencia,
                        permisos: this.permisos,
                        iconCls: 'report-add'
                    });
                }

                tabs.push({
                    xtype: 'Colsys.Ino.PanelBalance',
                    title: "Balance",
                    id: "balance-" + this.idmaster,
                    name: "balance-" + this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    idreferencia: this.idreferencia,
                    permisos: this.permisos,
                    iconCls: 'calculator'
                });

                if (this.permisos.Documentos == true) {

                    tabs.push({
                        xtype: 'Colsys.GestDocumental.treeGridFiles',
                        title: "Documentos",
                        id: "Documentos-" + this.idmaster,
                        name: "Documentos-" + this.idmaster,
                        idmaster: this.idmaster,
                        idreferencia: this.idreferencia,
                        idtransporte: this.idtransporte,
                        idimpoexpo: this.idimpoexpo,
                        permisos: this.permisos,
                        iconCls: 'folder',
                        treeStore: 'documentosIno',
                        listeners: {
                            beforerender: function (ct, position) {
                                Ext.getCmp("Documentos-" + this.idmaster).setStore(Ext.create('Ext.data.TreeStore', {
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
                                        autoLoad: false
                                    },
                                    autoLoad: false
                                }));

                                tree = Ext.getCmp("Documentos-" + this.idmaster);
                                ref1 = this.idreferencia;
                                idtrans = this.idtransporte;
                                impo = this.idimpoexpo;


                                store = tree.getStore();
                                store.load({
                                    params: {
                                        ref1: ref1,
                                        idtransporte: idtrans,
                                        idimpoexpo: impo
                                    }
                                });
                            }

                        }
                    });
                }

                tabs.push({
                    xtype: 'Colsys.Ino.PanelAuditoria',
                    title: "Auditoria",
                    id: "auditoria-" + this.idmaster,
                    name: "auditoria-" + this.idmaster,
                    idticket: this.idticket,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    idreferencia: this.idreferencia,
                    permisos: this.permisos,
                    iconCls: 'page_white_magnify'
                });
            }
            this.add(
                    {
                        xtype: 'tabpanel',
                        id: 'tab-panel-id-indicadores' + this.idmaster,
                        activeTab: 0,
                        items: tabs
                    });
            this.superclass.onRender.call(this, ct, position);
        }
    });
</script>