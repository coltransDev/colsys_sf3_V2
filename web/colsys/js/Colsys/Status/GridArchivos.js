var winformsubirarchivos = null;
var constrainedWin2 = null;
Ext.define('Colsys.Status.GridArchivos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Status.GridArchivos',
    autoHeight: true,
    autoScroll: true,
    //height:440,
    //frame: true,    
    requires: [
        'Ext.selection.CellModel'
    ],
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    selModel: {
        type: 'cellmodel'
    },
    //bodyCls: 'grid-small',
    bbar: {
        platformConfig: {
            '!Ext.supports.Touch': {
                hidden: true
            }
        },
        items: [{
                xtype: 'component',
                flex: 1,
                html: '<b>Not recommended on touch devices</b>',
                style: 'text-align: right;'
            }]
    },    
    listeners: {
        afterrender: function (ct, position) {
            var tbar = [{
                    xtype: 'toolbar',
                    dock: 'top',
                    id: 'bar-archivo-' + this.idhouse,
                    items: [{
                            text: 'Nuevo',
                            iconCls: 'add',
                            handler: function () {
                                this.up('grid').nuevoArchivo();
                            }
                        },
                        {
                            text: 'Recargar',
                            iconCls: 'refresh',
                            handler: function () {
                                this.up("grid").getStore().reload();
                            }
                        }]
                }];
            this.addDocked(tbar);
        },
        beforerender: function (me, eOpts) {

            Ext.define('modelGridArchivos', {
                extend: 'Ext.data.Model',
                id: 'model-grid-archivos',
                fields: [
                    {name: 'idarchivo' + this.idhouse, type: 'integer', mapping: 'idarchivo'},
                    {name: 'iddocumental' + this.idhouse, type: 'integer', mapping: 'iddocumental'},
                    {name: 'ref1' + this.idhouse, type: 'integer', mapping: 'ref1'},
                    {name: 'ref2' + this.idhouse, type: 'integer', mapping: 'ref2'},
                    {name: 'documento' + this.idhouse, type: 'string', mapping: 'documento'},
                    {name: 'nombre' + this.idhouse, type: 'string', mapping: 'nombre'},
                    {name: 'mime' + this.idhouse, type: 'string', mapping: 'mime'},
                    {name: 'path' + this.idhouse, type: 'string', mapping: 'path'},
                    {name: 'fchcreado' + this.idhouse, type: 'date', mapping: 'fchcreado', dateFormat: 'Y-m-d H:i:s'},
                    {name: 'usucreado' + this.idhouse, type: 'string', mapping: 'usucreado'},
                    {name: 'sel' + this.idhouse, type: 'bool'}
                ]
            });
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        model: modelGridArchivos,
                        id: 'store-grid-archivos' + this.idhouse,
                        proxy: {
                            type: 'ajax',
                            url: '/status/datosArchivos',
                            extraParams: {
                                idmaster: this.idmaster,
                                idhouse: this.idhouse
                            },
                            reader: {
                                type: 'json',
                                rootProperty: 'root',
                                totalProperty: 'total'
                            }
                        },
                        sorters: [{
                                property: 'nombre',
                                direction: 'ASC'
                            }],
                        autoLoad: false
                    }),
                    [
                        /*{xtype: 'rownumberer'},*/
                        {
                            xtype: 'checkcolumn',
                            header: 'Sel',
                            dataIndex: 'sel' + this.idhouse,
                            //headerCheckbox: true,
                            //flex: 1,
                            width: 50,
                            stopSelection: false
                        },
                        {
                            dataIndex: 'nombre' + this.idhouse,
                            header: 'Documento',
                            flex: 1,
                            margin: '0 15 0 0',
                            renderer: function (value, metaData, record) {
                                
                                tpl = 
                                    "<div class='text-wrapper'>"+
                                        "<div class='news-data'>"+                            
                                            "<tpl if='mime == \"image/png\" || mime == \"image/jpeg\"' || mime == \"image/gif\"' || mime == \"image/jpg\"'>"+
                                                "<div class='news-picture'><a href='/gestDocumental/verArchivo?id_archivo={idarchivo}' target='_blank'><img src='/gestDocumental/verArchivo?id_archivo={idarchivo}' width='50' height='50'/></a></div>"+
                                            "<tpl else>"+
                                                "<div class='news-picture'><a href='/gestDocumental/verArchivo?id_archivo={idarchivo}' target='_blank'><i class='fa fa-file-pdf-o fa-3x' aria-hidden='true'></i></a></div>"+
                                            "</tpl>"+
                                            "<table><tr><td>"+
                                                "<div class='news-content'>"+
                                                    "<div class='news-title'><a href='/gestDocumental/verArchivo?id_archivo={idarchivo}' target='_blank'>{nombre}</a></div>" +
                                                    "<div class='news-small'>{documento}</div>" + 
                                                    /*"<div class='news-small'>Iddocumental: {iddocumental}</div>" + */
                                                    "<div class='news-small'><span class='news-author'>{fchcreado}</span></div>" +                                        
                                                    "<div class='news-small'>"+
                                                        "<a href='javascript:editarArchivo("+record.internalId+","+this.idmaster+",\""+this.id+"\")'><i class='fa fa-pencil fa-lg' aria-hidden='true' title='Editar Archivo'></i></a>  "+
                                                        "<a href='javascript:eliminarArchivo("+record.internalId+",\""+this.id+"\")'><i class='fa fa-trash-o fa-lg' aria-hidden='true' title='Eliminar Archivo'></i></a>"+
                                                    "</div>"+
                                                '</div>'+                                                    
                                            '</td>'+
                                            "</tr></table>"+
                                        "</div>"+
                                    "</div>";

                                if (!tpl.isTemplate) {
                                    titleTpl = tpl = new Ext.XTemplate(tpl);
                                }
                                var data = Ext.Object.chain(record.data);
                                return tpl.apply(data);
                            }
                        }
                        /*{xtype: 'rownumberer'},
                        {
                            xtype: 'checkcolumn',
                            header: 'Sel',
                            dataIndex: 'sel' + this.idhouse,
                            //headerCheckbox: true,
                            //flex: 1,
                            width: 50,
                            stopSelection: false
                        },
                        {
                            header: 'Documento',
                            dataIndex: 'nombre' + this.idhouse,
                            flex: 1,
                            renderer: function (value, metaData, record, rowIndex, colIndex, store) {
                                var idarchivo = record.data.idarchivo;
                                var url = "https://localhost";
                                var actionUrl = url + "/gestDocumental/verArchivo/id_archivo/" + idarchivo;
                                return '<a href="' + actionUrl + '" target="_blank">' + value + '</a>';
                            }
                        },
                        {
                            header: 'Tipo',
                            dataIndex: 'documento' + this.idhouse,
                            flex: 1
                        },
                        {
                            header: 'Fch. Creado',
                            dataIndex: 'fchcreado' + this.idhouse,
                            flex: 1
                        },
                        {
                            header: 'Usu. Creado',
                            dataIndex: 'usucreado' + this.idhouse,
                            flex: 1
                        },
                        {
                            xtype: 'actioncolumn',
                            id: 'delete' + this.idhouse,
                            //width: 35,
                            sortable: false,
                            flex: 1,
                            menuDisabled: true,
                            items: [{
                                    iconCls: 'delete',
                                    tooltip: 'Borrar Registro',
                                    handler: function (view, recIndex, cellIndex, item, e, record) {
                                        record.drop();
                                    }
                                }]
                        },*/
//                        {
//                            xtype: 'actioncolumn',
//                            id: 'edit' + this.idhouse,
//                            //width: 35,
//                            sortable: false,
//                            flex: 1,
//                            menuDisabled: true,
//                            items: [{
//                                    iconCls: 'folder',
//                                    tooltip: 'Editar Registro',
//                                    handler: function (view, recIndex, cellIndex, item, e, record) {                                           
//                                        
//                                        var idmast = this.up('panel').idmaster;
//                                        var idpadre = this.up().up().id;
//                                        //console.log(constrainedWin2);
//                                        if (record.lastChild == null) {
//
//                                            if (constrainedWin2 == null)
//                                            {
//                                                constrainedWin2 = Ext.create('Ext.Window', {
//                                                    title: 'Editar Archivo',
//                                                    width: 500,
//                                                    height: 300,
//                                                    closeAction: 'hide',
//                                                    x: 120,
//                                                    y: 120,
//                                                    id: "winFormEdit",
//                                                    name: "winFormEdit",
//                                                    constrainHeader: true,
//                                                    frame: true,
//                                                    layout: 'form',
//                                                    items: [{
//                                                            xtype: 'Colsys.GestDocumental.FormArchivos',
//                                                            idimpoexpo: 'Importaci\u00F3n',
//                                                            idtransporte: 'Mar\u00EDtimo',
//                                                            idmaster: idmast,
//                                                            idpadre: idpadre,
//                                                            id: 'form-panel-file1',
//                                                            name: 'form-panel-file1',
//                                                            linkWin: "winFormEdit"
//                                                        }]
//                                                })
//                                            }
//                                            constrainedWin2.show();
//                                            Ext.getCmp("form-panel-file1").cargar(record.data);
//                                        }
//                                    }
//                                }]
//                        }
                        
                    ]);
                    //console.log(this.getStore().getData());
//                    this.titleTpl = 
//                        "<div class='text-wrapper'>"+
//                            "<div class='news-data'>"+                            
//                                "<tpl if='mime == \"image/png\" || mime == \"image/jpeg\"' || mime == \"image/gif\"' || mime == \"image/jpg\"'>"+
//                                    "<div class='news-picture'><img src='/gestDocumental/verArchivo?id_archivo={idarchivo}' width='50' height='50'/></div>"+
//                                "<tpl else>"+
//                                    "<div class='news-picture'><i class='fa fa-file-pdf-o fa-2x' aria-hidden='true'></i></div>"+
//                                "</tpl>"+
//                                "<table><tr><td>"+
//                                    "<div class='news-content'>"+
//                                        "<div class='news-title'>{nombre}</div>" +
//                                        "<div class='news-small'>{documento}</div>" + 
//                                        /*"<div class='news-small'>Iddocumental: {iddocumental}</div>" + */{idarchivo},
//                                        "<div class='news-small'><span class='news-author'>{fchcreado}</span></div>" +                                        
//                                        "<div class='news-small'><a href='javascript:editarArchivo({idarchivo},"+this.idmaster+")'><i class='fa fa-pencil fa-lg' aria-hidden='true' title='Editar Archivo'></i></a>  <a href='javascript:eliminarArchivo({idarchivo})'><i class='fa fa-trash-o fa-lg' aria-hidden='true' title='Eliminar Archivo'></i></a></div>"+
//                                    '</div>'+                                                    
//                                '</td>'+
//                                "</tr></table>"+
//                            "</div>"+
//                        "</div>";
        }
    },
    nuevoArchivo: function () {
        var me = this;
        var panelPrincipal = this.up("panel").up("panel").up("panel");

        //console.log(this.up("panel").up("panel").up("panel"));
        winformsubirarchivos = new Ext.Window({
            title: 'Documentos',
            id: 'win-doc-' + this.idhouse,
            width: 535,
            height: 185,
            closeAction: 'destroy',
            items: {
                autoScroll: true,
                items: [{
                        xtype: 'Colsys.GestDocumental.FormSubirArchivos',
                        id: 'formsubir',
                        name: 'form-subir-arch',
                        idtransporte: 'Mar\u00EDtimo',
                        idimpoexpo: 'Importaci\u00F3n',
                        idmaster: me.idmaster,
                        idreferencia: panelPrincipal.idreferencia,
                        ref2: me.doctransporte
                    }]
            },
            listeners: {
                close: function (win, eOpts) {
                    Ext.getCmp("grid-archivos-" + me.idhouse).getStore().reload();
                    winformsubirarchivos = null;
                }
            }
        });
        winformsubirarchivos.show();
    }    
});

function editarArchivo(internalId, idmast, idpadre) {
    
    var gridArchivos = Ext.getCmp(idpadre);
    record = gridArchivos.getStore().getByInternalId(internalId);

        if (constrainedWin2 === null){
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
                        idimpoexpo: 'Importaci\u00F3n',
                        idtransporte: 'Mar\u00EDtimo',
                        idmaster: idmast,
                        idpadre: idpadre,
                        id: 'form-panel-file1',
                        name: 'form-panel-file1',
                        linkWin: "winFormEdit"
                    }]
            });
        }
        constrainedWin2.show();
        Ext.getCmp("form-panel-file1").cargar(record.data);
}

function eliminarArchivo(internalId, idpadre) {
    
    var gridArchivos = Ext.getCmp(idpadre);
    record = gridArchivos.getStore().getByInternalId(internalId);    
    
    Ext.MessageBox.show({
        title: 'Eliminacion de ' + record.data.nombre,
        msg: 'Por favor ingrese el motivo de la eliminacion:',
        width: 300,
        buttons: Ext.MessageBox.OKCANCEL,
        multiline: true,
        fn: function (btn, text) {

            if (btn === "ok") {
                if (text.trim() === "") {
                    alert("Debe colocar un motivo");
                } else {
                    if (btn === "ok")
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
                                gridArchivos.getStore().reload();
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
    });
}