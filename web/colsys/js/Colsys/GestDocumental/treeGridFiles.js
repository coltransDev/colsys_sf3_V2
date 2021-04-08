
/**
 * @autor Felipe Nari�o 
 * @return Arbol de archivos correspondientes a una referencia
 * @param sfRequest $request A request 
 *               idtransporte : tipo de transporte
 *               idimpoexpo: impoexpo
 *               referencia: numero de referencia
 *               
 330.20.06.0011.20
 * @date:  2016-04-07
 */


var constrainedWin2 = null;
var winformsubirarchivos = null;
Ext.define('Colsys.GestDocumental.treeGridFiles', {
    extend: 'Ext.tree.Panel',
    alias: 'widget.Colsys.GestDocumental.treeGridFiles',
    title: 'Archivos',
    collapsible: true,
    useArrows: true,
    rootVisible: true,
    store: Ext.create('Ext.data.TreeStore', {
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
    }),
    multiSelect: true,
    //singleExpand: true,
    columnLines: true,
    clicksToEdit: 1,
    lines: true,
    viewConfig: {
        plugins: {
            ptype: 'treeviewdragdrop',
            containerScroll: true

        },
        listeners: {
            drop: function (node, data, overModel, dropPosition) {
                Ext.Ajax.request({
                    url: '/gestDocumental/editarArchivo',
                    method: 'POST',
                    params: {
                        "idarchivo": data.records[0].data.idarchivo,
                        "ref": overModel.raw.idarchivo,
                        "depth2": overModel.data.depth,
                        "depth1": data.records[0].data.depth

                    },
                    scope: this,
                    success: function (a, b) {
                        Ext.MessageBox.hide();
                    },
                    failure: function () {
                        console.log('failure');
                    }
                });

            },
            afterRender: function () {

                //console.log(this.up('panel'));
                //console.log(this);
                ref1 = (this.up('panel').idreferencia!=""?this.up('panel').idreferencia:this.idreporte);
                idtrans = this.up('panel').idtransporte;
                impo = this.up('panel').idimpoexpo;
                serie = this.up('panel').idsserie;
                exacto =  this.up('panel').exacto?this.up('panel').exacto:"false";
                idmod= this.up('panel').idmodalidad;

                this.store.load({
                    params: {
                        ref1: ref1,
                        idtransporte: idtrans,
                        idimpoexpo: impo,
                        idsserie: serie,
                        idmodalidad: idmod,
                        exacto: exacto
                    }
                });

            },
            itemdblclick: function (record, item, index, e, eOpts) {

                var record = this.getStore().getAt(e);
                if (record.lastChild == null) {
                    var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                        sorc: "/gestDocumental/verArchivo?id_archivo=" + record.get('idarchivo') + "&condicion=pdf"
                    });
                    windowpdf.show();
                }
            }

        }
        , getRowClass: function (record, rowIndex, rowParams, store) {
            if (record.get("idarchivo") == record.get("nombre"))
                return 'row_green';
        }
    },
    columns: [
        {
            xtype: 'checkcolumn',
            header: '',
            dataIndex: 'active',
            width: 40,
            editor: {
                xtype: 'checkbox',
                cls: 'x-grid-checkheader-editor'
            },
            renderer: function (value, metaData, record, row, col, store, gridView) {
                //console.log(record.data);
                ///renderer: function(value, meta, rec) {
                if (record.get("idarchivo") == record.get("nombre"))
                {
                    //console.log("128");
                    console.log(record.get("idarchivo") +" : "+ record.get("nombre"));
                    return "_";
                } else
                {
                    //console.log("133");
                    console.log(record.get("idarchivo") +" : "+ record.get("nombre"));
                    //return value;
                    return  new Ext.grid.column.Check().renderer(value);
                }
            }
        },
        {
            xtype: 'treecolumn',
            text: 'Nombre',
            flex: 1,
            sortable: true,
            dataIndex: 'nombre',
            width: 350,
            renderer: function (value, metaData, record, row, col, store, gridView) {
                return value;
            }
        }, {
            text: 'Tipo',
            flex: 1,
            dataIndex: 'documento',
            sortable: true
        }, {
            text: 'Usu Creado',
            flex: 1,
            dataIndex: 'usucreado',
            sortable: true
        }, {
            text: 'Fecha Creado',
            flex: 1,
            dataIndex: 'fchcreado',
            sortable: true
        }, {
            text: '',
            width: 20,
            menuDisabled: true,
            xtype: 'actioncolumn',
            tooltip: 'Ver Carpeta',
            align: 'center',
            getClass: function (v, meta, rec) {
                if (rec.lastChild == null) {
                    return 'import';
                }
            },
            renderer: function (value, metaData, record, row, col, store, gridView) {
                if (record.get("idarchivo") == record.get("nombre"))
                {
                    return "_";
                } else
                {
                    return value;
                }
            },
            handler: function (grid, rowIndex, colIndex, actionItem, event, record, row) {
                idtra = this.up('panel').idtransporte;
                impoe = this.up('panel').idimpoexpo;
                var idpadre  = this.up().up().id;
                var idmast = this.up('panel').idmaster;
                if (record.lastChild == null) {

                    if (constrainedWin2 == null)
                    {
                        constrainedWin2 = Ext.create('Ext.Window', {
                            title: 'Editar Archivo',
                            width: 500,
                            height: 300,
                            closeAction: 'hide',
                            x: 120,
                            y: 120,
                            id: "winFormEdit",
                            name: "winFormEdit",
                            constrainHeader: true,
                            frame: true,
                            layout: 'form',
                            items: [{
                                    xtype: 'Colsys.GestDocumental.FormArchivos',
                                    idimpoexpo: impoe,
                                    idtransporte: idtra,
                                    idmaster: idmast,      
                                    idpadre: idpadre,
                                    id: 'form-panel-file1',
                                    name: 'form-panel-file1',
                                    linkWin: "winFormEdit"
                                }]
                        })
                    }
                    constrainedWin2.show();
                    Ext.getCmp("form-panel-file1").cargar(record.data);
                }
            }
        },
        {
            text: '',
            width: 20,
            menuDisabled: true,
            xtype: 'actioncolumn',
            tooltip: 'Ver Carpeta',
            align: 'center',
            getClass: function (v, meta, rec) {
                if (rec.lastChild == null) {
                    return 'delete';
                }
            },
            renderer: function (value, metaData, record, row, col, store, gridView) {
                if (record.get("idarchivo") == record.get("nombre"))
                {
                    return "_";
                } else
                {
                    return value;
                }
            },
            handler: function (grid, rowIndex, colIndex, actionItem, event, record, row) {
                if (record.lastChild == null) {
                    Ext.MessageBox.show({
                        title: 'Eliminacion de ' + record.data.nombre,
                        msg: 'Por favor ingrese el motivo de la eliminacion:',
                        width: 300,
                        buttons: Ext.MessageBox.OKCANCEL,
                        multiline: true,
                        fn: function (btn, text) {

                            if (btn == "ok") {
                                if (text.trim() == "") {
                                    alert("Debe colocar un motivo");
                                } else {
                                    if (btn == "ok")
                                    {
                                        Ext.MessageBox.wait('Eliminando Archivo', '');
                                        Ext.Ajax.request({
                                            url: '/gestDocumental/eliminarArchivo',
                                            method: 'POST',
                                            waitTitle: 'Connecting',
                                            waitMsg: 'Eliminando Archivo...',
                                            params: {
                                                "idarchivo": record.data.idarchivo,
                                                "observaciones": text
                                            },
                                            scope: this,
                                            success: function (a, b) {
                                                grid.getStore().reload();
                                                Ext.MessageBox.hide();
                                            },
                                            failure: function () {
                                                console.log('failure');
                                            }
                                        });
                                    }
                                }
                            }
                        }
                    })
                }
            }
        }
    ],
    dockedItems: [{
            xtype: 'toolbar',
            items: [{
                    text: 'Adicionar',
                    tooltip: 'Adicionar un registro',
                    iconCls: 'add',
                    scope: this,
                    handler: function () {
                        if (this.idmaster) {
                            id = this.idmaster;
                        } else if (this.idcliente) {
                            id = this.idcliente;
                        }else
                        {
                            id="0";
                        }

                        winformsubirarchivos = new Ext.Window({
                            title: 'Documentos',
                            width: 600,
                            height: 220,
                            closeAction: 'destroy',
                            items: {
                                autoScroll: true,
                                items: [
                                    {
                                        xtype: 'Colsys.GestDocumental.FormSubirArchivos',
                                        id: 'formsubir',
                                        name: 'form-subir-arch',
                                        idtransporte: idtrans,
                                        idimpoexpo: impo,
                                        idreferencia: ref1,
                                        idmaster: id,
                                        idsserie: serie,
                                        idmodalidad: idmod
                                    }
                                ]
                            },
                            listeners: {
                                beforeshow: function (eOpts) {
                                },
                                close: function (win, eOpts) {

                                    winformsubirarchivos = null;
                                }
                            }
                        });
                        winformsubirarchivos.show();
                    }
                }, {
                    text: 'Refrescar',
                    iconCls: 'refresh',
                    handler: function () {
                        this.up().up().getStore().reload();
                    }
                },
                {
                    text: 'Notificar',
                    iconCls: 'email',
                    handler: function () {
                        //this.up().up().getStore().reload();
                        arrayeliminar = [];
                        
                        var store = this.up().up().getStore();
                        console.log(store.data);
                        for (var i = 0; i < store.getCount(); i++) {
                            record = store.getAt(i);
                            console.log(record);
                            if (record.get('active') == true) {
                                arrayeliminar.push(record.data.idarchivo);
                            }
                        }
                        
                        //console.log(arrayeliminar);
                        //console.log(arrayeliminar.toString());
                        ref1 = (this.up('panel').idreferencia!=""?this.up('panel').idreferencia:this.idreporte);
                        
                        var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {                                            
                            id: 'window-envio-docs-'+this.up('panel').idreferencia,
                            width: 900,
                            title: 'Notificacion Documentos '+ ref1,
                            sorc: "/status/verEmailDocs/iddocs/"+arrayeliminar.toString()+"/idmaster/"+this.up().up().idmaster
                        });
                        windowpdf.show();
                    }
                }
            ]
        }],
    listeners: {
        beforerender: function (ct, position) {
            if (eval(this.up('tabpanel'))) {
                this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 150);
                this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 50);
            }
        }
    }
})

