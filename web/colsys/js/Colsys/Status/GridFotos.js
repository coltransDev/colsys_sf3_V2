var winformsubirarchivos = null;
Ext.define('Colsys.Status.GridFotos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Status.GridFotos',
    autoHeight: true,
    autoScroll: true,
    //height:440,
    frame: true,
    requires: [
        'Ext.selection.CellModel'
    ],
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    selModel: {
        type: 'cellmodel'
    },
    bodyCls: 'grid-small',
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
                    id: 'bar-foto-' + this.idhouse,
                    items: [/*{
                     text: 'Nuevo',
                     iconCls: 'add',
                     handler : function(){                
                     this.up('grid').nuevoArchivo();            
                     }
                     },*/
                        {
                            xtype: 'filefield',
                            buttonOnly: true,
                            id: 'button-file-' + this.idhouse,
                            buttonText: 'Cargar Fotos...',
                            //width: 10,
                            listeners: {
                                render: function (s) {
                                    s.fileInputEl.set({multiple: 'multiple'});
                                    s.setHeight(24);
                                },
                                change: function (s) {
                                    var me = this.up('grid');
                                    var idhouse = me.idhouse;
                                    var panelPrincipal = this.up("panel").up("panel").up("panel").up("panel");
                                    //console.log(panelPrincipal);
                                    Ext.each(s.fileInputEl.dom.files, function (f) {
                                        var data = new FormData(),
                                                rec = me.store.add({col: f.name})[0];
                                        data.append('file', f);
                                        Ext.Ajax.request({
                                            url: '/gestDocumental/subirArchivoTRD',
                                            rawData: data,
                                            params: {
                                                documento: 16,
                                                ref2: me.doctransporte,
                                                ref1: panelPrincipal.idreferencia,
                                                tam_max: 640
                                            },
                                            headers: {'Content-Type': null}, //to use content type of FormData
                                            progress: function (e) {
                                                rec.set('progress', e.loaded / e.total);
                                                rec.set('status', 'uploading...');
                                                rec.commit();
                                            },
                                            success: function () {
                                                //rec.set('status', 'done');
                                                rec.commit();
                                                me.store.reload();

                                            },
                                            failure: function () {
                                                rec.set('progress', 0);
                                                rec.set('status', 'failed');
                                                rec.commit();
                                            }
                                        });
                                    });
                                }
                            }
                        }]
                }];
            this.addDocked(tbar);

            var store = this.getStore();
            store.clearFilter();
            store.filterBy(function (record, id) {
                if (record.data.iddocumental === 16)
                    return true;
                else
                    return false;
            });
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
                    {name: 'usucreado' + this.idhouse, type: 'string', mapping: 'usucreado'}/*
                     {name: 'sel'+this.idhouse+'f',                         type: 'bool'                           }*/
                ]
            });
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        model: modelGridArchivos,
                        id: 'store-grid-fotos' + this.idhouse,
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
                        autoLoad: true
                    }),
                    [
                        {xtype: 'rownumberer'},
                        {
                            dataIndex: 'nombre' + this.idhouse,
                            header: 'Imagen',
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
                                                    "<div class='news-title'>{nombre}</div>" +
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
                        }/*,                        
                        {
                            xtype: 'actioncolumn',
                            id: 'actioncolumn' + this.idhouse + 'f',
                            //width: 35,
                            sortable: false,
                            flex: 1,
                            menuDisabled: true,
                            items: [{
                                    iconCls: 'delete',
                                    tooltip: 'Delete Plant',
                                    handler: function (view, recIndex, cellIndex, item, e, record) {
                                        record.drop();
                                    }
                                }]
                        }*/
                    ]
                    );
            
            this.titleTpl =
                '<div class="thumb-wrap" id="{idarchivo'+this.idhouse+'f}">'+
                '<div class="thumb"><img src="https://localhost/gestDocumental/verImagen/idarchivo/{idarchivo'+this.idhouse+'f}"></div>'+
                '<span class="x-editable">{nombre}</span>'+
                '</div>';


        }
    },
    prepareData: function (data) {
        console.log(data);
            Ext.apply(data, {
                shortName: Ext.util.Format.ellipsis(data.nombre, 15),
                sizeString: Ext.util.Format.fileSize(data.size),
                dateString: Ext.util.Format.date(data.lastmod, "m/d/Y g:i a")
            });
            return data;
        }
    /*,
     nuevoArchivo: function(){
     var me = this;
     var panelPrincipal = this.up("panel").up("panel").up("panel");
     console.log(this.doctransporte);
     //console.log(this.up("panel").up("panel").up("panel"));
     winformsubirarchivos = new Ext.Window({
     title: 'Documentos',
     id: 'win-doc-'+this.idhouse,
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
     Ext.getCmp("grid-archivos-"+me.idhouse).getStore().reload();
     winformsubirarchivos = null;
     }
     }
     })
     winformsubirarchivos.show();
     }*/
});