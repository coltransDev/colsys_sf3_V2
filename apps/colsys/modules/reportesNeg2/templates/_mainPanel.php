<script>

    Ext.define('Colsys.ReportesNeg.Mainpanel', {
        extend: 'Ext.panel.Panel',
        alias: 'widget.wCIMainpanel',
        //bodyPadding: 10,
//    "idmaster":12176,
        autoHeight: true,
        onRender: function (ct, position) {
            tabs = new Array();
            me=this;
            
            tabs.push({
                    xtype: 'Colsys.ReportesNeg.FormGeneral',
                    title: "General ",
                    id: "form-general-" + this.idreporte,
                    name: "form-general-" + this.idreporte,                    
                    idreporte: this.idreporte,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,                    
                    permisos: this.permisos,
                    iconCls: 'application_form',
                    idmodalidad: this.modalidad,
                    idrepPrincipal: this.idrepPrincipal
                });
                
                if(this.idreporte>0)
                {
                    
                    
                    tabs.push({
                        xtype: 'Colsys.ReportesNeg.GridContenedores',
                        title: "Equipos ",
                        id: "tab_contenderores-" + this.idreporte,
                        name: "tab_contenderores-" + this.idreporte,
                        idreporte: this.idreporte,
                        idtransporte: this.idtransporte,
                        idimpoexpo: this.idimpoexpo,
                        idmodalidad: this.modalidad,                        
                        permisos: this.permisos,
                        iconCls: 'camion'
                    });
                    
                    
                    
                    tabs.push({
                        xtype: 'Colsys.ReportesNeg.GridItr',
                        title: "Itr ",
                        id: "tab_itr-" + this.idreporte,
                        name: "tab_itr-" + this.idreporte,
                        idreporte: this.idreporte,
                        idtransporte: this.idtransporte,
                        idimpoexpo: this.idimpoexpo,
                        idmodalidad: this.modalidad,                        
                        permisos: this.permisos,
                        iconCls: 'camion',                        
                        itemId: 'tabitr',
                        hidden: true
                    });

                     tabs.push({
                        xtype: 'Colsys.ReportesNeg.FormSeguro',
                        title: "Seguros",
                        id: "tab_seguros-" + this.idreporte,
                        name: "tab_seguros-" + this.idreporte,
                        idreporte: this.idreporte,
                        idtransporte: this.idtransporte,
                        idimpoexpo: this.idimpoexpo,
                        idmodalidad: this.modalidad,
                        permisos: this.permisos
                       // iconCls: 'camion'
                    });
                    
                    tabs.push(
                    {
                        xtype: 'Colsys.ReportesNeg.GridConceptos',
                        width: 425,
                        title: "Tarifas",
                        //idcomprobante: idcomprobante,
                        idcomprobante: "0",
                        idreporte: this.idreporte,
                        idtransporte: this.idtransporte,
                        idimpoexpo: this.idimpoexpo,
                        idmodalidad: this.modalidad,
                        estado:"",
                        id: 'conceptos'+this.idreporte,
                        name: 'conceptos'+this.idreporte,
                        permisos: this.permisos
                    },
                    {
                        iconCls: 'pdf',
     //                   region : 'center',
                        xtype : "component",                        
                        height :600,
                        autoEl : {
                            tag : "iframe",
                            src : "/reportesNeg/generarPDF/id/" + me.idreporte
                            //src : "/reportesNeg2/generarPDF/id/" + me.idreporte                            
                        },                        
                        listeners: {
                            beforerender: function (ct, position) {
                                this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 150);
                                this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 50);
                            }
                        }

                    },
                    
                    /*Ext.create('Colsys.Widgets.WgVerPdf', {
                        title: "PDF",
                        iconCls: 'pdf',
                        //sorc: '/reportesNeg/verHistorialRef/idmaster/'+idmaster
                        sorc:"/reportesNeg/verReporte/id/" + me.idreporte + "/impoexpo/" + me.idimpoexpo + "/modo/" + me.idtransporte
                    })*/
                    
                    {
                        xtype: 'Colsys.GestDocumental.treeGridFiles',
                        title: "Documentos",
                        id: "Documentos-" + me.idreporte,
                        name: "Documentos-" + me.idreporte,
                        exacto: true,
                        ref1: this.idreporte,
                        idmaster: me.idreporte,
                        idreferencia: me.idreferencia,
                        idtransporte: this.idtransporte,
                        idimpoexpo: this.idimpoexpo,
                        idsserie:19,
                        permisos: this.permisos,
                        iconCls: 'folder',
                        treeStore: 'documentosRep',
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

                                tree = Ext.getCmp("Documentos-" + me.idreporte);
                                ref1 = me.idreferencia;
                                idtrans = this.idtransporte;
                                impo = this.idimpoexpo;


                                store = tree.getStore();
                                store.load({
                                    params: {
                                        ref1: ref1,
                                        idtransporte: idtrans,
                                        idimpoexpo: impo,
                                        idsserie:19
                                    }
                                });
                            }

                        }
                    }
                                
                            
                    
                    );
                }    
            
            this.add(
                    {
                        xtype: 'tabpanel',
                        id: 'tab-panel-id-reportes-neg' + this.idreporte,
                        activeTab: 0,
                        items: tabs
                    });
           
            this.superclass.onRender.call(this, ct, position);
        }
    });
</script>