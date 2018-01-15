var comboReporte = null;
var win_liberacion = null;
var contextMenu = Ext.create('Ext.menu.Menu');

Ext.define('Colsys.Ino.GridHouse', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridHouse',
    id: "gridhouse",
    height: 400,
    //sortableColumns: false,
    enableColumnMove: false,
    autoScroll: true,
    bodegas: null,
    features: [{
            ftype: 'summary',
            dock: 'bottom'
        }],
    selModel: {
        selType: 'cellmodel'
    },
    frame: true,
    /*plugins: {
     ptype: 'cellediting',
     clicksToEdit: 1
     },*/
    plugins: [{
            ptype: 'cellediting',
            clicksToEdit: 1
        }, {
            ptype: 'rowwidget',
            widget: {
                xtype: 'grid',
                //autoLoad: true,
                bind: {
                    store: '{record.equipos}',
                    //title: 'Orders for {record.id}'
                },
                plugins: {
                    ptype: 'cellediting',
                    clicksToEdit: 1
                },
                columns: [{
                        text: 'Sel',
                        xtype: 'checkcolumn',
                        dataIndex: 'sel',
                        width: 1
                    }, {
                        xtype: 'hidden',
                        text: 'Equipo',
                        dataIndex: 'equipo',
                        width: 75
                    }, {
                        //xtype:'hidden',
                        text: 'IdConcepto',
                        dataIndex: 'idconcepto',
                        width: 1
                    }, {
                        text: 'Concepto',
                        dataIndex: 'concepto',
                        width: 120
                    }, {
                        text: 'Serial',
                        dataIndex: 'serial',
                        width: 75
                    }, {
                        dataIndex: 'numprecinto',
                        width: 120,
                        text: 'Precinto'
                    }, {
                        text: 'Piezas',
                        dataIndex: 'piezas',
                        width: 80,
                        align: 'right', editor: {xtype: "textfield"}
                    }, {
                        text: 'Kilos',
                        dataIndex: 'kilos',
                        width: 80,
                        align: 'right', editor: {xtype: "textfield"}
                    }
                ]
            }
        }],
    onRender: function (ct, position) {
        me = this;
        columnas = new Array();

        if (this.idimpoexpo == "INTERNO" && this.idtransporte == "Terrestre") {
            columnas.push({
                header: "Doc. Transporte",
                hideable: false,
                id: "doctransporte" + this.idmaster,
                dataIndex: 'doctransporte' + this.idmaster,
                width: 125,
                sortable: true,
                editor: Ext.create('Colsys.Widgets.wgReferencia', {
                    id: 'comboReferencia' + this.idmaster,
                    listeners:
                            {
                                select: function (a, record, idx)
                                {
                                    var selected = this.up('grid').getSelectionModel().getSelection()[0];
                                    var row = this.up('grid').store.indexOf(selected);
                                    var store = this.up('grid').getStore();
                                    store.data.items[row].set('vendedor' + this.up('grid').idmaster, record.data.ca_vendedor);
                                    store.data.items[row].set('nombrecliente' + this.up('grid').idmaster, record.data.ca_compania);
                                    store.data.items[row].set('idcliente' + this.up('grid').idmaster, record.data.ca_idcliente);
                                    store.data.items[row].set('numpiezas' + this.up('grid').idmaster, record.data.ca_piezas);
                                    store.data.items[row].set('peso' + this.up('grid').idmaster, record.data.ca_peso);
                                    store.data.items[row].set('volumen' + this.up('grid').idmaster, record.data.ca_volumen);
                                    store.data.items[row].set('numorden' + this.up('grid').idmaster, record.data.ca_pedido);

                                }
                            }
                }),
                renderer: comboBoxRenderer(Ext.getCmp('comboReferencia' + this.idmaster))
            });
        } else {
            columnas.push({
                header: "Reporte",
                dataIndex: 'reporte' + this.idmaster,
                sortable: true,
                hideable: false,
                width: 100,
                renderer: comboBoxRenderer(comboReporte),
                editor:
                        /* {
                         xtype: comboReporte,
                         impoExpo: this.idimpoexpo,
                         transporte: this.idtransporte
                         }*/
                        Ext.create('Colsys.Widgets.WgReporte', {
                            displayField: 'consecutivo',
                            valueField: 'idreporte',
                            idimpoexpo: this.idimpoexpo,
                            idtransporte: this.idtransporte,
                            origen: Ext.getCmp("idorigen" + this.idmaster).getValue(),
                            destino: Ext.getCmp("iddestino" + this.idmaster).getValue(),
                            id: "comboReporte" + this.idmaster,
                            listeners: {
                                select: function (a, record, idx) {
                                    var existente = 0;
                                    var store = this.up('grid').getStore();
                                    var selected = this.up('grid').getSelectionModel().getSelection()[0];
                                    var row = this.up('grid').store.indexOf(selected);
                                    var idmaster = this.up('grid').idmaster;
                                    for (var i = 0; i < store.getCount(); i++) {

                                        if (store.data.items[i].get('idreporte') == record.data.idreporte) {
                                            if (i != row) {
                                                Ext.MessageBox.alert('Mensaje', "Ya existe un registro con el reporte de negocio seleccionado");

                                                existente = 1;
                                            }
                                        }
                                    }

                                    if (existente == 1) {
                                        store.remove(row);


                                    }
                                    if (existente == 0) {
                                        var aprobacion = 0;
                                        if (store.data.items[row].get('idreporte' + this.up('grid').idmaster) != 0) {
                                            Ext.MessageBox.confirm('Confirmaci&oacute;n', 'Est&aacute; seguro que desea sobrescribir el Registro?', function (choice) {
                                                if (choice == 'yes') {
                                                    store.data.items[row].set('doctransporte' + idmaster, record.data.ca_doctransporte);
                                                    store.data.items[row].set('idreporte' + idmaster, record.data.idreporte);                                                    
                                                    store.data.items[row].set('vendedor' + idmaster, record.data.usu_ca_login);
                                                    store.data.items[row].set('nombrecliente' + idmaster, record.data.compania);
                                                    store.data.items[row].set('idcliente' + idmaster, record.data.cl_ca_idcliente);
                                                    store.data.items[row].set('numpiezas' + idmaster, record.data.ca_piezas);
                                                    store.data.items[row].set('peso' + idmaster, record.data.ca_peso);
                                                    store.data.items[row].set('volumen' + idmaster, record.data.ca_volumen);
                                                    store.data.items[row].set('numorden' + idmaster, record.data.h_ca_numorden);
                                                    store.data.items[row].set('bodega' + idmaster, record.data.bodega);
                                                    store.data.items[row].set('nombrebodega' + idmaster, record.data.nombrebodega);
                                                    store.data.items[row].set('numorden' + idmaster, record.data.r_ca_orden_clie);
                                                    store.data.items[row].set('tercero' + idmaster, record.data.ca_tercero);
                                                    store.data.items[row].set('idtercero' + idmaster, record.data.ca_idtercero);
                                                }
                                            });
                                        } else {
                                            store.data.items[row].set('doctransporte' + idmaster, record.data.ca_doctransporte);
                                            store.data.items[row].set('idreporte' + idmaster, record.data.idreporte);                                            
                                            store.data.items[row].set('vendedor' + idmaster, record.data.usu_ca_login);
                                            store.data.items[row].set('nombrecliente' + idmaster, record.data.compania);
                                            store.data.items[row].set('idcliente' + idmaster, record.data.cl_ca_idcliente);
                                            store.data.items[row].set('numpiezas' + idmaster, record.data.ca_piezas);
                                            store.data.items[row].set('peso' + idmaster, record.data.ca_peso);
                                            store.data.items[row].set('volumen' + idmaster, record.data.ca_volumen);
                                            store.data.items[row].set('numorden' + idmaster, record.data.h_ca_numorden);
                                            store.data.items[row].set('bodega' + idmaster, record.data.bodega);
                                            store.data.items[row].set('nombrebodega' + idmaster, record.data.nombrebodega);
                                            store.data.items[row].set('numorden' + idmaster, record.data.r_ca_orden_clie);
                                            store.data.items[row].set('tercero' + idmaster, record.data.ca_tercero);
                                            store.data.items[row].set('idtercero' + idmaster, record.data.ca_idtercero);
                                        }
                                    }
                                }
                            }
                        }),
                renderer: comboBoxRenderer(Ext.getCmp('comboReporte' + this.idmaster))
            }, {
                header: "Doc. Transporte",
                hideable: false,
                id: "doctransporte" + this.idmaster,
                dataIndex: 'doctransporte' + this.idmaster,
                width: 125,
                sortable: true,
                editor: {xtype: "textfield"}
            }/*, proveedor, idproveedor*/);
        }
        if ( this.idimpoexpo.substring(0,5) == 'Impor' && this.idtransporte.substring(0,3) == 'Mar' ) {
            columnas.push({
                xtype: 'datecolumn',
                header: "Fch.Doc.Trans",
                dataIndex: 'fchdoctransporte' + this.idmaster,
                hideable: false,
                sortable: false,
                width: 100,
                editor: {xtype: 'datefield', allowBlank: false, format: 'Y-m-d'},
                renderer: Ext.util.Format.dateRenderer('Y-m-d')
            });
        }
        columnas.push({
            header: "Piezas",
            dataIndex: 'numpiezas' + this.idmaster,
            hideable: false,
            align: 'right',
            sortable: false,
            width: 70,
            editor: {xtype: "numberfield"},
            renderer: Ext.util.Format.numberRenderer('0,0.00'),
            summaryType: 'sum',
            summaryRenderer: function (value, summaryData, dataIndex) {
                return "<span style='font-weight: bold;'> " + value + "</span>";
            }
        }, {
            header: "Peso",
            dataIndex: 'peso' + this.idmaster,
            hideable: false,
            sortable: true,
            align: 'right',
            width: 80,
            editor: {
                xtype: "numberfield",
                decimalPrecision: 2
            },
            renderer: Ext.util.Format.numberRenderer('0,0.00'),
            summaryType: 'sum',
            summaryRenderer: function (value, summaryData, dataIndex) {
                return "<span style='font-weight: bold;'> " + value + "</span>";
            }
        }, {
            header: "Volumen",
            dataIndex: 'volumen' + this.idmaster,
            hideable: false,
            width: 70,
            align: 'right',
            sortable: true,
            editor: {
                xtype: "numberfield",
                decimalPrecision: 2
            },
            renderer: Ext.util.Format.numberRenderer('0,0.00'),
            summaryType: 'sum',
            summaryRenderer: function (value, summaryData, dataIndex) {
                return "<span style='font-weight: bold;'> " + value + "</span>";
            }
        });


        if (this.idimpoexpo == "Importaci\u00F3n" && this.idtransporte == "Mar\u00EDtimo") {
            columnas.push({
                header: "Continuacion",
                dataIndex: 'continuacion' + me.idmaster,
                //width: 150,
                editor: Ext.create('Colsys.Widgets.WgParametros', {
                    //style: 'display:inline-block;text-align:center;font-weight:bold;',
                    caso_uso: 'CU274',
                    id: 'continuacion' + me.idmaster,
                    valueField: 'name',
                }),
                renderer: comboBoxRenderer(Ext.getCmp('continuacion' + this.idmaster))
            }, {
                /*{
                 header: "Continuacion",
                 dataIndex: "continuacion" + this.idmaster,
                 width: 50,
                 editor:
                 Ext.create('Colsys.Widgets.wgTipoContinuacion', {
                 valueField: 'continuacion',
                 displayField: 'continuacion'                    
                 })                
                 },*/
                header: "Operador",
                dataIndex: "bodega" + me.idmaster,
                width: 250,
                editor: Ext.create('Colsys.Widgets.WgBodega', {
                    xtype: 'Colsys.Widgets.WgBodega',
                    id: 'bodega' + me.idmaster,
                    name: 'bodega' + me.idmaster,
                    valueField: 'idbodega',
                    displayField: 'nombre',
                    listeners:
                            {
                                select: function (a, record, idx)
                                {
//                                            console.log(me.bodegas);
                                    var selected = this.up('grid').getSelectionModel().getSelection()[0];
                                    var row = this.up('grid').store.indexOf(selected);
                                    var store = this.up('grid').getStore();
                                    store.data.items[row].set('bodega' + this.up('grid').idmaster, record.data.idbodega);
                                }
                            }
                }),
                renderer: comboBoxRenderer(Ext.getCmp('bodega' + me.idmaster))
            }, {
                header: "Destino",
                dataIndex: "destinofinal" + this.idmaster,
                width: 120,
                editor: Ext.create('Colsys.Widgets.WgCiudades2', {
                    //xtype: 'Colsys.Widgets.WgCiudades2',                            
                    tipo: 'destino',
                    idimpoexpo: 'Importaci\u00F3n',
                    id: 'iddestinocontinuacion' + me.idmaster,
                    name: 'iddestinocontinuacion' + me.idmaster,
                    style: 'display:inline-block;text-align:center;font-weight:bold;',
                    store: Ext.create('Ext.data.Store', {
                        fields: ['idciudad', 'ciudad', 'idtrafico', 'trafico', 'ciudad_trafico'],
                        proxy: {
                            type: 'ajax',
                            url: '/widgets5/datosCiudades',
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        },
                        autoLoad: true
                    })
                }),
                renderer: comboBoxRenderer(Ext.getCmp('iddestinocontinuacion' + me.idmaster))
            }
            );
        } else {
            columnas.push({
                header: "Bodega",
                dataIndex: "bodega" + this.idmaster,
                width: 250,
                editor: Ext.create('Colsys.Widgets.WgBodega', {
                    xtype: 'Colsys.Widgets.WgBodega',
                    id: 'bodega' + me.idmaster,
                    name: 'bodega' + me.idmaster,
                    valueField: 'idbodega',
                    displayField: 'nombre',
                    listeners:
                            {
                                select: function (a, record, idx)
                                {
//                                            console.log(me.bodegas);
                                    var selected = this.up('grid').getSelectionModel().getSelection()[0];
                                    var row = this.up('grid').store.indexOf(selected);
                                    var store = this.up('grid').getStore();
                                    store.data.items[row].set('bodega' + this.up('grid').idmaster, record.data.idbodega);
                                }
                            }
                }),
                renderer: comboBoxRenderer(Ext.getCmp('bodega' + this.idmaster))
            });
        }
        columnas.push({
            header: "Cliente",
            dataIndex: "idcliente" + this.idmaster,
            hideable: false,
            width: 250,
            editor: Ext.create('Colsys.Widgets.WgClientes', {
                id: "nombrecliente" + this.idmaster,
                displayField: 'compania',
                valueField: 'idcliente',
                listeners:
                        {
                            select: function (a, record, idx)
                            {
                                var selected = this.up('grid').getSelectionModel().getSelection()[0];
                                var row = this.up('grid').store.indexOf(selected);
                                var store = this.up('grid').getStore();
                                store.data.items[row].set('idcliente' + this.up('grid').idmaster, record.data.ca_idcliente);
                                store.data.items[row].set('vendedor' + this.up('grid').idmaster, record.data.ca_vendedor);
                            }
                        }

            }),
            renderer: comboBoxRenderer(Ext.getCmp('nombrecliente' + this.idmaster))
        });
        
        if (me.idimpoexpo != "Exportaci\u00F3n")
        {
            columnas.push({
                header: "Proveedor",
                dataIndex: 'tercero' + this.idmaster,
                hideable: false,
                width: 120,
                sortable: true,
                //id:'proveedor'+this.idmaster,
                editor: Ext.create('Colsys.Widgets.wgTercero', {
                    id: 'prov' + this.idmaster,
                    displayField: 'nombre',
                    valueField: 'idtercero',
                    listeners:
                            {
                                select: function (a, record, idx)
                                {
                                    var selected = this.up('grid').getSelectionModel().getSelection()[0];
                                    var row = this.up('grid').store.indexOf(selected);
                                    var store = this.up('grid').getStore();

                                    store.data.items[row].set('idtercero' + this.up('grid').idmaster, record.data.t_ca_idtercero);
                                }
                            }
                }),
                renderer: comboBoxRenderer(Ext.getCmp('prov' + this.idmaster))
            });
        }
        columnas.push( {
            header: "Vendedor",
            dataIndex: 'vendedor' + this.idmaster,
            hideable: false,
            sortable: true,
            width: 160,
            editor: Ext.create('Colsys.Widgets.wgUsuario', {
                id: "vendedor" + this.idmaster
            }),
            renderer: comboBoxRenderer(Ext.getCmp('vendedor' + this.idmaster))
        }, {
            header: "Orden",
            hideable: false,
            dataIndex: "numorden" + this.idmaster,
            editor: {xtype: "textfield"}
        });

        this.reconfigure(
                Ext.create('Ext.data.Store', {
                    id: "storeGridHouse",
                    fields: [
                        {name: 'idmaster' + this.idmaster, type: 'integer', mapping: 'idmaster'},
                        {name: 'idhouse' + this.idmaster, type: 'integer', mapping: 'idhouse'},
                        {name: 'doctransporte' + this.idmaster, type: 'string', mapping: 'doctransporte'},
                        {name: 'fchdoctransporte' + this.idmaster, type: 'date', mapping: 'fchdoctransporte', dateFormat: 'Y-m-d'},
                        {name: 'idcliente' + this.idmaster, type: 'integer', mapping: 'idcliente'},
                        {name: 'nombrecliente' + this.idmaster, type: 'string', mapping: 'cliente'},
                        {name: 'bodega' + this.idmaster, type: 'string', mapping: 'idbodega'},
                        {name: 'nombrebodega' + this.idmaster, type: 'string', mapping: 'nombre'},
                        {name: 'continuacion' + this.idmaster, type: 'string', mapping: 'continuacion'},
                        {name: 'destinofinal' + this.idmaster, type: 'string', mapping: 'destinofinal'},
                        {name: 'tercero' + this.idmaster, type: 'string', mapping: 'tercero'},
                        {name: 'vendedor' + this.idmaster, type: 'string', mapping: 'vendedor'},
                        {name: 'idtercero' + this.idmaster, type: 'integer', mapping: 'idtercero'},
                        {name: 'idreporte' + this.idmaster, type: 'integer', mapping: 'idreporte'},
                        {name: 'reporte' + this.idmaster, type: 'string', mapping: 'reporte'},
                        {name: 'numpiezas' + this.idmaster, type: 'integer', mapping: 'numpiezas'},
                        {name: 'peso' + this.idmaster, type: 'float', mapping: 'peso'},
                        {name: 'volumen' + this.idmaster, type: 'float', mapping: 'volumen'},
                        {name: 'numorden' + this.idmaster, type: 'string', mapping: 'numorden'},
                        {name: 'color' + this.idmaster, type: 'string', mapping: 'color'}//,
                        //{name: 'equipos' + this.idmaster, type: 'string', mapping: 'equipos'}
                    ],
                    proxy: {
                        type: 'ajax',
                        url: '/inoF2/datosGridHouse',
                        baseParams: {
                            impoexpo: 'impoexpo'
                        },
                        reader: {
                            type: 'json',
                            rootProperty: 'root',
                            totalProperty: 'total',
                            modo: 'modo'
                        }
                    },
                    sorters: [{
                            property: 'doctransporte',
                            direction: 'ASC'
                        }],
                    autoLoad: false
                }),
                columnas
                );

        var guardar = {
            text: 'Guardar',
            iconCls: 'add',
            width: 80,
            handler: function () {
                idmaster = this.up('grid').idmaster;
                var store = this.up('grid').getStore();
                //var records = this.up('grid').getStore().getRange();
                //console.log(records);
                /*for(i=0;i<records.length;i++)
                 {
                 console.log(records[i].data);
                 }*/

                var model = Ext.create(store.getModel());
                var columnsName = [];
                var fieldsName = [];
                var rows = [];
                var filtrerfields = function (field, index, array) {

                    columnsName.push(field.mapping);
                    fieldsName.push(field.name);
                };

                var filtrerRows = function (rowModel, index, array) {
                    var row = new Object();
                    var lenght1 = fieldsName.length;
                    for (var i = 0; i < lenght1; i++) {
                        row[columnsName[i]] = rowModel.data[fieldsName[i]];
                    }
                    row["id"] = rowModel.data.id;
                    row["fchdoctransporte"] = Ext.Date.format(new Date(row["fchdoctransporte"]), 'Y-m-d');
                    row["equipos"] = rowModel.data.equipos;
                    rows.push(row);
                };
                model.fields.forEach(filtrerfields);
//                store.getModifiedRecords().forEach(filtrerRows);
                store.getRange().forEach(filtrerRows);

                var rowJson = JSON.stringify(rows);
                if (rowJson.length > 5)
                {
                    Ext.Ajax.request({
                        url: '/inoF2/guardarGridHouse',
                        params: {
                            datos: rowJson
                        },
                        success: function (response, opts)
                        {
                            var res = Ext.decode(response.responseText);
                            if (res.id && res.success)
                            {
                                id = res.id.split(",");
                                idhou = res.idhouse.split(",");
                                for (i = 0; i < id.length; i++)
                                {
                                    var rec = store.getById(id[i]);
                                    //rec.data.idhouse = idhou[i];
                                    rec.set(("idhouse" + idmaster), idhou[i]);
                                    rec.commit();
                                }
                                Ext.Msg.alert('Mensaje', "Se guardo Correctamente los datos del House");
                            }
                            if (res.errorInfo != "" && res.errorInfo != "null")
                            {
                                Ext.MessageBox.alert("Mensaje", 'No fue posible el guardar los datos del House <br>' + res.errorInfo);
                            }
                        },
                        failure: function (response, opts)
                        {
                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                            box.hide();
                        }
                    });
                }
            }
        };
        tb = new Ext.toolbar.Toolbar({dock: 'top'});
        if (this.permisos.Crear == true) {
            tb.add({
                text: 'Agregar',
                iconCls: 'add',
                width: 80,
                handler: function () {
                    var store = this.up("grid").getStore();
                    var r = Ext.create(store.getModel());
                    idmaster = this.up("grid").idmaster;
                    cidmaster = "idmaster" + idmaster;
                    r.set(cidmaster, idmaster);
                    store.insert(0, r);
                }
            },
                    guardar
                    );
        } else if (this.permisos.Editar == true) {
            tb.add(guardar);
        }

        tb.add(
                {
                    text: 'Recargar',
                    iconCls: 'refresh',
                    handler: function (me, eOpts) {
                        me.up('grid').getStore().reload();
                    }
                });
        this.addDocked(tb, 'top');
        this.superclass.onRender.call(this, ct, position);
    },
    listeners: {
        beforerender: function (ct, position) {
            this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 150);
            this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 50);
        },
        activate: function (ct, position) {
            idmaster = this.idmaster;
            var store = this.store;
            if (this.load == false || this.load == "undefined" || !this.load)
            {
                store.proxy.extraParams = {
                    idmaster: this.idmaster,
                    idimpoexpo: this.idimpoexpo
                },
                        this.store.reload({
                            callback: function (records, operation, success) {
                                for (i = 0; i < records.length; i++) {
                                    rec = records[i];
                                    //console.log(Ext.ComponentQuery.query("#bodega" + idmaster));
                                    if (Ext.ComponentManager.get("bodega" + idmaster))
                                    {
                                        Ext.getCmp("bodega" + idmaster).store.add(
                                                {"idbodega": rec.data.bodega, "nombre": rec.data.nombrebodega, 'tipo': '', 'transporte': '',
                                                    'identificacion': '', 'direccion': ''}
                                        );
                                        rec.set(("nombrebodega" + idmaster), rec.data.nombrebodega);
                                        rec.set(("bodega" + idmaster), rec.data.bodega);
                                    }


                                    if (Ext.ComponentManager.get("nombrecliente" + idmaster))
                                    {
                                        Ext.getCmp("nombrecliente" + idmaster).store.add(
                                                {"idcliente": rec.data.idcliente, "compania": rec.data.cliente}
                                        );
                                        rec.set(("nombrecliente" + idmaster), rec.data.cliente);
                                        rec.set(("idcliente" + idmaster), rec.data.idcliente);
                                    }

                                    rec.commit();
                                }
                            }
                        });
                this.load = true;
            }
        }
    },
    viewConfig: {
        getRowClass: function (record, rowIndex, rowParams, store) {
            return "row_" + record.get("color");
        },
        stripeRows: true,
        listeners: {
            beforeitemcontextmenu: function (view, record, item, index, e) {
                contextMenu.removeAll();
                permisos = this.up('grid').permisos;
                if (this.idtransporte != "Terrestre") {
                    repor = Ext.create('Ext.menu.Item', {
                        text: 'Ver Reporte',
                        iconCls: 'import',
                        scope: this,
                        handler: function () {
                            idreporte = record.get("idreporte");

                            var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                                sorc: "/reportesNeg/generarPDF/id/" + idreporte
                            });
                            windowpdf.show();
                        }
                    });
                    contextMenu.add(repor);
                }

                ver_status = Ext.create('Ext.menu.Item', {
                    text: 'Status',
                    iconCls: 'search',
                    scope: this,
                    handler: function () {
                        idreporte = record.get("idreporte");
                        reporte = record.get("reporte");
                        if (idreporte == null) {
                            idreporte = "No asignado";
                        }
                        Ext.create('Ext.window.Window', {
                            title: 'Status de reporte: ' + reporte,
                            id: 'status' + idreporte,
                            width: 820,
                            height: 400,
                            layout: 'fit',
                            autoScroll: true,
                            items: {
                                xtype: Ext.create('Colsys.Widgets.wgStatus', {
                                    reporte: reporte,
                                    idreporte: idreporte,
                                    idhouse: record.get("idhouse")
                                })
                            }
                        }).show();
                    }
                });
                contextMenu.add(ver_status);

                documento = Ext.create('Ext.menu.Item', {
                    text: 'Subir Documento',
                    iconCls: 'upload-icon',
                    scope: this,
                    handler: function () {
                        winformsubirarchivos = new Ext.Window({
                            title: 'Documentos',
                            width: 535,
                            height: 185,
                            closeAction: 'destroy',
                            items: {
                                autoScroll: true,
                                items: [{
                                        xtype: 'Colsys.GestDocumental.FormSubirArchivos',
                                        id: 'formsubir',
                                        name: 'form-subir-arch',
                                        idtransporte: record.get("idtransporte"),
                                        idimpoexpo: record.get("idimpoexpo"),
                                        idreferencia: Ext.getCmp('tab' + this.up('grid').idmaster).title,
                                        ref2: record.get("doctransporte"),
                                        idmaster: this.up('grid').idmaster,
                                        //idsserie: serie
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
                });
                contextMenu.add(documento);

                if (permisos.DarLiberacion) {
                    dar_liberacion = Ext.create('Ext.menu.Item', {
                        text: 'Dar Liberaci\u00F3n',
                        iconCls: 'accept',
                        tooltip: 'Autoriza Liberar Documentos',
                        scope: this,
                        handler: function (grid, rowIndex, colIndex) {
                            if (win_liberacion == null) {
                                win_liberacion = new Ext.Window({
                                    id: 'winDarLiberacion',
                                    title: 'Dar Liberaci\u00F3n',
                                    width: 600,
                                    height: 270,
                                    closeAction: 'destroy',
                                    listeners: {
                                        destroy: function (obj, eOpts)
                                        {
                                            win_liberacion = null;
                                        }
                                    },
                                    items: {
                                        xtype: 'Colsys.Ino.FormDarLiberacion',
                                        id: 'formDarLiberacion',
                                        idhouse: record.get("idhouse"),
                                        doctransporte: record.get("doctransporte")
                                    }
                                });
                            }
                            win_liberacion.show();
                        }
                    });
                    contextMenu.add(dar_liberacion);
                }

                if (permisos.LiberacionPto) {
                    rev_liberacion = Ext.create('Ext.menu.Item', {
                        text: 'Reversar Liberaci\u00F3n',
                        iconCls: 'accept',
                        tooltip: 'Reversa Autorizaci\u00F3n de Liberar Documentos',
                        scope: this,
                        handler: function (grid, rowIndex, colIndex) {
                            var store = this.store;
                            var row = store.indexOf(record);
                            data = record.data.idhouse;
                            if (data == null || data == "") {
                                store.removeAt(row);
                            } else {
                                Ext.MessageBox.confirm('Confirmacion', 'Est\u00E1 seguro de Reversa Autorizaci\u00F3n de Liberar Documentos',
                                        function (e) {
                                            if (e == 'yes') {
                                                var box = Ext.MessageBox.wait('Procesando', 'Eliminando');
                                                Ext.Ajax.request({
                                                    waitMsg: 'Eliminando...',
                                                    url: '/inoF2/reversarLiberacion',
                                                    params: {
                                                        idhouse: record.data.idhouse
                                                    },
                                                    success: function (response, opts) {
                                                        var obj = Ext.decode(response.responseText);
                                                        if (obj.errorInfo != "" && obj.errorInfo != "undefined") {
                                                            alert("Se presento un error: " + obj.errorInfo);
                                                        } else {
                                                            store.reload();
                                                        }
                                                        box.hide();
                                                    },
                                                    failure: function (response, opts) {
                                                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                        box.hide();
                                                    }
                                                });
                                            }
                                        }
                                );
                            }
                        }
                    });
                    contextMenu.add(rev_liberacion);
                }

                if (permisos.LiberacionPto) {
                    liberar_docs = Ext.create('Ext.menu.Item', {
                        text: 'Liberar Documentos',
                        iconCls: 'folder_table',
                        tooltip: 'Liberaci\u00F3n Documentos en Puerto',
                        scope: this,
                        handler: function (grid, rowIndex, colIndex) {
                            if (win_liberacion == null) {
                                win_liberacion = new Ext.Window({
                                    id: 'winLiberarDocumentos',
                                    title: 'LiberarDocumentos',
                                    width: 600,
                                    height: 245,
                                    closeAction: 'destroy',
                                    listeners: {
                                        destroy: function (obj, eOpts)
                                        {
                                            win_liberacion = null;
                                        }
                                    },
                                    items: {
                                        xtype: 'Colsys.Ino.FormLiberarDocumentos',
                                        id: 'formDarLiberacion',
                                        idhouse: record.get("idhouse"),
                                        doctransporte: record.get("doctransporte")
                                    }
                                });
                            }
                            win_liberacion.show();
                        }
                    });
                    contextMenu.add(liberar_docs);
                }

                if (permisos.Anular) {
                    eliminar = Ext.create('Ext.menu.Item', {
                        text: 'Eliminar',
                        iconCls: 'delete',
                        scope: this,
                        handler: function (idg) {
                            var store = this.store;
                            var row = store.indexOf(record);
                            data = record.data.idhouse;
                            if (data == null || data == "") {
                                store.removeAt(row);
                            } else {
                                Ext.MessageBox.confirm('Confirmacion', 'Est\u00E1 seguro de Eliminar el registro',
                                        function (e) {
                                            if (e == 'yes') {
                                                var box = Ext.MessageBox.wait('Procesando', 'Eliminando');
                                                Ext.Ajax.request({
                                                    waitMsg: 'Eliminando...',
                                                    url: '/inoF2/eliminarGridHouse',
                                                    params: {
                                                        idhouse: record.data.idhouse
                                                    },
                                                    success: function (response, opts) {
                                                        var obj = Ext.decode(response.responseText);
                                                        if (obj.errorInfo != "" && obj.errorInfo != "undefined") {
                                                            alert("Se presento un error: " + obj.errorInfo);
                                                        } else {
                                                            store.reload();
                                                        }
                                                        box.hide();
                                                    },
                                                    failure: function (response, opts) {
                                                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                        box.hide();
                                                    }
                                                });
                                            }
                                        }
                                );
                            }
                        }
                    });
                    contextMenu.add(eliminar);
                }
            },
            itemcontextmenu: function (view, rec, node, index, e) {
                e.stopEvent();
                contextMenu.showAt(e.getXY());
                return false;
            }
        }
    }
});