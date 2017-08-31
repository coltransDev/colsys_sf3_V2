<script>

    Ext.define('Colsys.Ino.Mainpanel', {
        extend: 'Ext.panel.Panel',
        alias: 'widget.wCIMainpanel',
        //bodyPadding: 10,
//    "idmaster":12176,
        autoHeight: true,
        onRender: function (ct, position) {            
            tabs = new Array();
            //alert(this.permisos.toSource());
            /*tabs.push({
                    xtype: 'Colsys.Pruebas.WgRowWidget',
                    title: "General ",
                    id: "form-prueba" + this.idmaster,
                    name: "form-prueba-" + this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    permisos: this.permisos
                });*/
            
            if (this.permisos.General == true) {
                tabs.push({
                    xtype: 'Colsys.Ino.FormMaster',
                    title: "General ",
                    id: "form-master-" + this.idmaster,
                    name: "form-master-" + this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    permisos: this.permisos
                });
            }
            //console.log(this.modalidad);
            //if (this.modalidad == "FCL") {

            if (this.idtransporte != "A\u00E9reo") {    
                tabs.push({
                    xtype: 'Colsys.Ino.GridContenedores',
                    title: "Equipos ",
                    id: "contenderores-" + this.idmaster,
                    name: "contenderores-" + this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    permisos: this.permisos
                });
            }
            if (!isNaN(this.idmaster) && this.idmaster > 0)
            {
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
                                permisos: this.permisos
                            });
                }
                /*if(this.permisos.Facturacion == true){
                 tabs.push({
                 xtype:'Colsys.Ino.GridFacturacion',
                 title: "Facturacion",
                 id:"grid-facturacion-"+this.idmaster,
                 name:"grid-facturacion-"+this.idmaster,
                 idmaster: this.idmaster,
                 idtransporte: this.idtransporte,
                 idimpoexpo: this.idimpoexpo,
                 permisos: this.permisos
                 });
                 }*/
                /*if(this.permisos.Facturacion == true){
                 tabs.push({
                 xtype:'Colsys.Ino.PanelFacturacion',
                 title: "Facturacion",
                 id:"panel-facturacion-"+this.idmaster,
                 name:"panel-facturacion-"+this.idmaster,
                 idmaster: this.idmaster,
                 idtransporte: this.idtransporte,
                 idimpoexpo: this.idimpoexpo,
                 permisos: this.permisos
                 });
                 }*/
                /* if (this.tipofacturacion == "facturacion1" ) {
                 if (this.permisos.Facturacion == true) {
                 tabs.push({
                 xtype: 'Colsys.Ino.GridFacturacion',
                 title: "Facturacion" ,
                 id: "grid-facturacion-" + this.idmaster,
                 name: "grid-facturacion-" + this.idmaster,
                 idmaster: this.idmaster,
                 idtransporte: this.idtransporte,
                 idimpoexpo: this.idimpoexpo,
                 permisos: this.permisos
                 });
                 }
                 }*/
                // if (this.tipofacturacion == "facturacion2" || this.tipofacturacion == null) 
                {
                    if (this.permisos.Facturacion == true) {
                        tabs.push({
                            xtype: 'Colsys.Ino.PanelFacturacion',
                            title: "Facturacion",
                            id: "panel-facturacion-" + this.idmaster,
                            name: "panel-facturacion-" + this.idmaster,
                            idmaster: this.idmaster,
                            idtransporte: this.idtransporte,
                            idimpoexpo: this.idimpoexpo,
                            permisos: this.permisos,
                            autoScroll: true,
                            autoHeight: true
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
                        plugins: [
                            new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
                        ],
                    });
                }

                if (this.idimpoexpo == "<?= Constantes::EXPO ?>") {
                    tabs.push({
                        xtype: 'Colsys.Ino.GridEvento',
                        title: "Eventos",
                        id: "Eventos-" + this.idmaster,
                        name: "Eventos-" + this.idmaster,
                        idmaster: this.idmaster,
                        idtransporte: this.idtransporte,
                        idimpoexpo: this.idimpoexpo,
                        idreferencia: this.idreferencia,
                        //caso_uso: '11',
                        permisos: this.permisos,
                        plugins: [
                            new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
                        ],
                    });
                }

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
                    xtype: 'Colsys.Ino.PanelBalance',
                    title: "Balance",
                    id: "balance-" + this.idmaster,
                    name: "balance-" + this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    idreferencia: this.idreferencia,
                    permisos: this.permisos
                });

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
                    permisos: this.permisos
                });

                tabs.push({
                    xtype: 'Colsys.Ino.PanelRadicacion',
                    title: "Radicacion",
                    id: "radicacion-" + this.idmaster,
                    name: "radicacion-" + this.idmaster,
                    idticket: this.idticket,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    idreferencia: this.idreferencia,
                    permisos: this.permisos
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