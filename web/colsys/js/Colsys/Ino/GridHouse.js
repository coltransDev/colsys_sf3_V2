var comboReporte = null;
var win_liberacion = null;
var contextMenu = Ext.create('Ext.menu.Menu');

Ext.define('Colsys.Ino.GridHouse', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridHouse',
    id: "gridhouse",
    height: 400,
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
    plugins: [{
            ptype: 'cellediting',
            clicksToEdit: 1
        }, {
            ptype: 'rowwidget',
            id: 'plugin-container',
            selectRowOnExpand: true,
            expandOnDblClick: false,
            expandOnEnter: false,
            rowBodyTpl: new Ext.XTemplate()
        }],
    onRender: function (ct, position) {
        me = this;
        columnas = new Array();

        if (this.idimpoexpo == "INTERNO" && this.idtransporte == "Terrestre") {
            columnas.push({
                header: "Doc. Transporte",
                hideable: false,
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
                                    store.data.items[row].set('cliente' + this.up('grid').idmaster, record.data.ca_compania);
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
                                                    store.data.items[row].set('idcliente' + idmaster, record.data.cl_ca_idcliente);
                                                    store.data.items[row].set('cliente' + idmaster, record.data.compania);
                                                    store.data.items[row].set('numpiezas' + idmaster, record.data.ca_piezas);
                                                    store.data.items[row].set('peso' + idmaster, record.data.ca_peso);
                                                    store.data.items[row].set('volumen' + idmaster, record.data.ca_volumen);
                                                    store.data.items[row].set('numorden' + idmaster, record.data.h_ca_numorden);
                                                    store.data.items[row].set('idbodega' + idmaster, record.data.idbodega);
                                                    store.data.items[row].set('bodega' + idmaster, record.data.bodega);
                                                    store.data.items[row].set('numorden' + idmaster, record.data.r_ca_orden_clie);
                                                    store.data.items[row].set('tercero' + idmaster, record.data.ca_tercero);
                                                    store.data.items[row].set('idtercero' + idmaster, record.data.ca_idtercero);
                                                    store.data.items[row].set('continuacion' + idmaster, record.data.continuacion);
                                                }
                                            });
                                        } else {
                                            store.data.items[row].set('doctransporte' + idmaster, record.data.ca_doctransporte);
                                            store.data.items[row].set('idreporte' + idmaster, record.data.idreporte);
                                            store.data.items[row].set('vendedor' + idmaster, record.data.usu_ca_login);
                                            store.data.items[row].set('idcliente' + idmaster, record.data.cl_ca_idcliente);
                                            store.data.items[row].set('cliente' + idmaster, record.data.compania);
                                            store.data.items[row].set('numpiezas' + idmaster, record.data.ca_piezas);
                                            store.data.items[row].set('peso' + idmaster, record.data.ca_peso);
                                            store.data.items[row].set('volumen' + idmaster, record.data.ca_volumen);
                                            store.data.items[row].set('numorden' + idmaster, record.data.h_ca_numorden);
                                            store.data.items[row].set('idbodega' + idmaster, record.data.idbodega);
                                            store.data.items[row].set('bodega' + idmaster, record.data.bodega);
                                            store.data.items[row].set('numorden' + idmaster, record.data.r_ca_orden_clie);
                                            store.data.items[row].set('tercero' + idmaster, record.data.ca_tercero);
                                            store.data.items[row].set('idtercero' + idmaster, record.data.ca_idtercero);
                                            store.data.items[row].set('continuacion' + idmaster, record.data.continuacion);
                                        }
                                    }
                                }
                            }
                        }),
                renderer: comboBoxRenderer(Ext.getCmp('comboReporte' + this.idmaster))
            }, {
                header: "Doc. Transporte",
                hideable: false,
                dataIndex: 'doctransporte' + this.idmaster,
                width: 125,
                sortable: true,
                editor: {xtype: "textfield"}
            }/*, proveedor, idproveedor*/);
        }
        if (this.idimpoexpo.substring(0, 5) == 'Impor' && this.idtransporte.substring(0, 3) == 'Mar') {
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

            me.getPlugin('plugin-container').setConfig({
                widget: {
                    xtype: 'grid',
                    features: [{
                            ftype: 'summary'
                                    //,dock: 'bottom'
                        }],
                    bind: {
                        store: '{record.equipos}'
                    },
                    plugins: {
                        //gridsummaryrow: true,
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
                            width: 120,
                            summaryRenderer: function (value, summaryData, dataIndex) {
                                return "<span style='font-weight: bold;'> TOTALES </span>";
                            }
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
                            align: 'right', editor: {xtype: "numberfield"},
                            summaryType: 'sum',
                            summaryRenderer: function (value, summaryData, dataIndex) {
                                return "<span style='font-weight: bold;'> " + value + "</span>";
                            }
                        }, {
                            text: 'Kilos',
                            dataIndex: 'kilos',
                            width: 80,
                            align: 'right', editor: {xtype: "numberfield"},
                            summaryType: 'sum',
                            summaryRenderer: function (value, summaryData, dataIndex) {
                                return "<span style='font-weight: bold;'> " + value + "</span>";
                            }
                        }
                    ]
                }
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
            renderer: Ext.util.Format.numberRenderer('0,0'),
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
        }, {
            text: 'Utilidad',
            dataIndex: 'utilidad' + this.idmaster,
            width: 80,
            align: 'right', editor: {xtype: "numberfield"},
            renderer: Ext.util.Format.numberRenderer('0,0'),
            summaryType: 'sum',
            summaryRenderer: function (value, summaryData, dataIndex) {
                return "<span style='font-weight: bold;'> " + value + "</span>";
            }
        });


        if (this.idimpoexpo == "Importaci\u00F3n" && this.idtransporte == "Mar\u00EDtimo") {
            columnas.push({
                header: "Continuacion",
                dataIndex: 'continuacion' + this.idmaster,
                //width: 150,
                editor: Ext.create('Colsys.Widgets.WgParametros', {
                    //style: 'display:inline-block;text-align:center;font-weight:bold;',
                    caso_uso: 'CU274',
                    id: 'continuacion' + this.idmaster,
                    valueField: 'name'
                }),
                renderer: comboBoxRenderer(Ext.getCmp('continuacion' + this.idmaster))
            }, {
                header: "Operador",
                dataIndex: "operador" + this.idmaster,
                width: 250
            }, {
                header: "Destino",
                dataIndex: "destinofinal" + this.idmaster,
                width: 120,
                editor: Ext.create('Colsys.Widgets.WgCiudades2', {
                    //xtype: 'Colsys.Widgets.WgCiudades2',                            
                    tipo: 'destino',
                    idimpoexpo: 'Importaci\u00F3n',
                    id: 'iddestinocontinuacion' + this.idmaster,
                    name: 'iddestinocontinuacion' + this.idmaster,
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
                renderer: comboBoxRenderer(Ext.getCmp('iddestinocontinuacion' + this.idmaster))
            }
            );
        } else {
            columnas.push({
                header: "Bodega",
                dataIndex: "bodega" + this.idmaster,
                width: 250,
                editor: Ext.create('Colsys.Widgets.WgBodega', {
                    xtype: 'Colsys.Widgets.WgBodega',
                    id: 'idbodega' + this.idmaster,
                    name: 'idbodega' + this.idmaster,
                    valueField: 'idbodega',
                    displayField: 'nombre',
                    listeners:
                            {
                                select: function (a, record, idx)
                                {
                                    var selected = this.up('grid').getSelectionModel().getSelection()[0];
                                    var row = this.up('grid').store.indexOf(selected);
                                    var store = this.up('grid').getStore();
                                    store.data.items[row].set('idbodega' + this.up('grid').idmaster, record.data.idbodega);
                                }
                            }
                }),
                renderer: comboBoxRenderer(Ext.getCmp('idbodega' + this.idmaster))
            });
        }
        columnas.push({
            header: "Cliente",
            dataIndex: "cliente" + this.idmaster,
            hideable: false,
            width: 250,
            editor: Ext.create('Colsys.Widgets.WgClientes', {
                id: "cliente" + this.idmaster,
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
            renderer: comboBoxRenderer(Ext.getCmp('cliente' + this.idmaster))
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
        columnas.push({
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
                        {name: 'cliente' + this.idmaster, type: 'string', mapping: 'cliente'},
                        {name: 'idbodega' + this.idmaster, type: 'string', mapping: 'idbodega'},
                        {name: 'bodega' + this.idmaster, type: 'string', mapping: 'bodega'},
                        {name: 'continuacion' + this.idmaster, type: 'string', mapping: 'continuacion'},
                        {name: 'destinofinal' + this.idmaster, type: 'string', mapping: 'destinofinal'},
                        {name: 'operador' + this.idmaster, type: 'string', mapping: 'operador'},
                        {name: 'tercero' + this.idmaster, type: 'string', mapping: 'tercero'},
                        {name: 'vendedor' + this.idmaster, type: 'string', mapping: 'vendedor'},
                        {name: 'idtercero' + this.idmaster, type: 'integer', mapping: 'idtercero'},
                        {name: 'idreporte' + this.idmaster, type: 'integer', mapping: 'idreporte'},
                        {name: 'reporte' + this.idmaster, type: 'string', mapping: 'reporte'},
                        {name: 'numpiezas' + this.idmaster, type: 'integer', mapping: 'numpiezas'},
                        {name: 'peso' + this.idmaster, type: 'float', mapping: 'peso'},
                        {name: 'volumen' + this.idmaster, type: 'float', mapping: 'volumen'},
                        {name: 'utilidad' + this.idmaster, type: 'float', mapping: 'utilidad'},
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

                boton = this;
                grid = this.up('grid');

                grid.setLoading(true);
                boton.disabled = true;

                idmaster = grid.idmaster;

                var store = grid.getStore();
                var model = Ext.create(store.getModel());
                var columnsName = [];
                var fieldsName = [];
                var rows = [];
                var filtrerfields = function (field, index, array) {
                    columnsName.push(field.mapping);
                    fieldsName.push(field.name);
                };
                
                var save=true;
                
                var filtrerRows = function (rowModel, index, array) {
                    var row = new Object();
                    var lenght1 = fieldsName.length;
                    for (var i = 0; i < lenght1; i++) {
                        row[columnsName[i]] = rowModel.data[fieldsName[i]];
                    }
                    row["id"] = rowModel.data.id;
                    row["fchdoctransporte"] = Ext.Date.format(new Date(row["fchdoctransporte"]), 'Y-m-d');
                    row["equipos"] = rowModel.data.equipos;
                    if (me.idimpoexpo == "Importaci\u00F3n" && me.idtransporte == "Mar\u00EDtimo")
                    {
                        if(rowModel.data.equipos)
                        {
                            var piezas=0,peso=0;
                            console.log(row["doctransporte"]);
                            console.log(rowModel.data.equipos);
                            
                            for (var i = 0; i < rowModel.data.equipos.length; i++) {
                                piezas+=rowModel.data.equipos[i].piezas;
                                peso+=rowModel.data.equipos[i].kilos;
                                console.log(rowModel.data.equipos[i].kilos);
                            }//numpiezas,peso

                            if( Math.round(row["numpiezas"])!= Math.round(piezas))
                            {
                                Ext.Msg.alert('Mensaje', "Numero de piezas no coincide en el doctransporte :"+ row["doctransporte"]+ " "+ Math.round(row["numpiezas"])+"::"+ Math.round(piezas));
                                save=false;
                            }
                            if( Math.round(row["peso"])!= Math.round(peso))
                            {
                                Ext.Msg.alert('Mensaje', "El peso no coincide en el doctransporte :"+ row["doctransporte"]+ " "+ Math.round(row["peso"])+"::"+ Math.round(peso));
                                save=false;
                            }
                        }
                    }
                    rows.push(row);
                };
                model.fields.forEach(filtrerfields);
//                store.getModifiedRecords().forEach(filtrerRows);
                store.getRange().forEach(filtrerRows);

                if(save==false)
                {
                    grid.setLoading(false);
                    boton.disabled = false;
                    return;
                }

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
                                store.reload();
                                id = res.id.split(",");
                                idhou = res.idhouse.split(",");
                                for (i = 0; i < id.length; i++)
                                {
                                    var rec = store.getById(id[i]);
                                    //rec.data.idhouse = idhou[i];
                                    rec.set(("idhouse" + idmaster), idhou[i]);
                                    //rec.commit();
                                }
                                store.commitChanges();
                                Ext.Msg.alert('Mensaje', "Se guardo Correctamente los datos del House");
                            }
                            if (res.errorInfo != "" && res.errorInfo != "null")
                            {
                                Ext.MessageBox.alert("Mensaje", 'No fue posible el guardar los datos del House <br>' + res.errorInfo);
                            }
                            grid.setLoading(false);
                            boton.disabled = false;
                        },
                        failure: function (response, opts)
                        {
                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                            box.hide();
                            grid.setLoading(false);
                            boton.disabled = false;
                        }

                    });
                } else
                {
                    grid.setLoading(false);
                    boton.disabled = false;
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
                        if (me.up('grid').idimpoexpo == "Importaci\u00F3n" && me.up('grid').idtransporte == "Mar\u00EDtimo") {
                            me.up('grid').buildTips();
                        }
                    }
                });
        this.addDocked(tb, 'top');
        this.superclass.onRender.call(this, ct, position);
    },
    buildTips: function () {
        me = this;
        Ext.Ajax.request({
            url: '/inoF2/datosLiberacion',
            params: {
                idmaster: me.idmaster
            },
            success: function (response, opts) {
                var res = Ext.decode(response.responseText);

                if (res.root && res.success) {
                    var lib = res.root;
                    var gridView = me;
                    //create the ToolTip
                    gridView.tip = Ext.create('Ext.tip.ToolTip', {
                        // The overall target element.
                        target: gridView.el,
                        // Each grid row causes its own seperate show and hide.
                        delegate: gridView.view.cellSelector,
                        // Moving within the row should not hide the tip.
                        trackMouse: true,
                        // Render immediately so that tip.body can be referenced prior to the first show.
                        renderTo: Ext.getBody(),
                        listeners: {
                            // Change content dynamically depending on which element triggered the show.
                            beforeshow: function updateTipBody(tip) {
                                gridColums = gridView.view.getGridColumns();
                                column = gridColums[tip.triggerElement.cellIndex];
                                //only display the tool tip for name column
                                if (column.dataIndex === 'doctransporte' + me.idmaster) {
                                    record = gridView.view.getRecord(tip.triggerElement.parentNode);
                                    var html = "<table bgcolor='" + lib[record.get('idhouse')]["color"] + "'>";
                                    html += "<tr>";
                                    html += "    <td style=\"font-weight: bold;\">Estado:</td>";
                                    html += "    <td>" + lib[record.get('idhouse')]["estado_liberacion"] + "</td>";
                                    html += "</tr>";
                                    html += "<tr>";
                                    html += "    <td style=\"font-weight: bold;\">Nota Liberaci\u00F3n:</td>";
                                    html += "    <td>" + lib[record.get('idhouse')]["nota_liberacion"] + "</td>";
                                    html += "</tr>";
                                    html += "<tr>";
                                    html += "    <td style=\"font-weight: bold;\">Liberaci\u00F3n: " + lib[record.get('idhouse')]["usuliberacion"] + "</td>";
                                    html += "    <td style=\"font-weight: bold;\">Fecha: " + lib[record.get('idhouse')]["fchliberacion"] + "</td>";
                                    html += "</tr>";
                                    html += "<tr>";
                                    html += "    <td colspan= '2'><div style=\"font-weight: bold;\">Observaciones:</div>" + lib[record.get('idhouse')]["observaciones"] + "</td>";
                                    html += "</tr>";
                                    if (lib[record.get('idhouse')]["fchlibero"]) {
                                        html += "<tr>";
                                        html += "    <td style=\"font-weight: bold;\">Liber\u00F3: " + lib[record.get('idhouse')]["usulibero"] + "</td>";
                                        html += "    <td style=\"font-weight: bold;\">Fecha: " + lib[record.get('idhouse')]["fchlibero"] + "</td>";
                                        html += "</tr>";
                                        html += "<tr>";
                                        html += "    <td colspan= '2'><div style=\"font-weight: bold;\">Agente:</div>" + lib[record.get('idhouse')]["agente"] + "</td>";
                                        html += "</tr>";
                                        html += "<tr>";
                                        html += "    <td style=\"font-weight: bold;\">Detalles Liberaci\u00F3n:</td>";
                                        html += "    <td>" + lib[record.get('idhouse')]["detalles"] + "</td>";
                                        html += "</tr>";
                                    }                                
                                    html += "<tr bgcolor='#fae9de'><th colspan='2'>Informaci&oacuten del House</th></tr>";
                                    html += "<tr>";
                                    html += "    <td><div style=\"font-weight: bold;\">Usu Creado:</div></td><td>" + lib[record.get('idhouse')]["usucreado"] + "</td>";
                                    html += "</tr>";
                                    html += "<tr>";
                                    html += "    <td><div style=\"font-weight: bold;\">Fch Creado:</div></td><td>" + lib[record.get('idhouse')]["fchcreado"] + "</td>";
                                    html += "</tr>";
                                    if (lib[record.get('idhouse')]["usuactualizado"]) {
                                        html += "<tr>";
                                        html += "    <td><div style=\"font-weight: bold;\">Usu Actualizado:</div></td><td>" + lib[record.get('idhouse')]["usuactualizado"] + "</td>";
                                        html += "</tr>";
                                        html += "<tr>";
                                        html += "    <td><div style=\"font-weight: bold;\">Fch Actualizado:</div></td><td>" + lib[record.get('idhouse')]["fchactualizado"] + "</td>";
                                        html += "</tr>";
                                    }
                                    html += "</table>";                                
                                    tip.update(html);
                                } else {
                                    return false;
                                }
                            }
                        }
                    });
                }
            },
            failure: function (response, opts) {
                Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                //box.hide();
            }
        });
    }, 
    listeners: {
        afterrender: function (ct, position) {
            if (this.idimpoexpo == "Importaci\u00F3n" && this.idtransporte == "Mar\u00EDtimo") {
                me = this;
                me.buildTips();
            }
        },
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
                                    if (Ext.ComponentManager.get("idbodega" + idmaster))
                                    {
                                        Ext.getCmp("idbodega" + idmaster).store.add(
                                                {"idbodega": records[i].get("idbodega"), "bodega": records[i].get("bodega"), 'tipo': '', 'transporte': '',
                                                    'identificacion': '', 'direccion': ''}
                                        );
                                        records[i].set(("idbodega" + idmaster), records[i].get("idbodega"));

                                        //records[i].set(("idbodega" + idmaster), records[i].get("bodega"));
//                                console.log(records[i].data);
                                        /*if(records[i].dirty);
                                         records[i].commit();*/
                                    }


                                    /*
                                     if (Ext.ComponentManager.get("cliente" + idmaster))
                                     {
                                     Ext.getCmp("cliente" + idmaster).store.add(
                                     {"idcliente": rec.data.idcliente, "compania": rec.data.cliente}
                                     );
                                     rec.set(("cliente" + idmaster), rec.data.cliente);
                                     rec.set(("idcliente" + idmaster), rec.data.idcliente);
                                     }
                                     
                                     console.log(rec)*/

                                }
                                store.commitChanges();
                            }
                        });

                this.load = true;
            }
        }
    },
    viewConfig: {
        getRowClass: function (record, rowIndex, rowParams, store) {

            var transporte = this.up().idtransporte;
            // Oculta el rowexpander para transporte !== Marítimo
            if (transporte !== 'Mar\u00EDtimo') {
                return 'row_' + record.get("color") + '_hide-row-expander';
            } else {
                return "row_" + record.get("color");
            }

        },
        stripeRows: true,
        listeners: {
            beforeitemcontextmenu: function (view, record, item, index, e) {
                contextMenu.removeAll();
                //console.log(me.idtransporte);
                
                permisos = this.up('grid').permisos;
                
                //if (me.idtransporte !== "Terrestre" && me.idimpoexpo !== "INTERNO") 
                
                {
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
                    repor = Ext.create('Ext.menu.Item', {
                        text: 'Ver Reporte Ult. ver',
                        iconCls: 'import',
                        scope: this,
                        handler: function () {
                            reporte = record.get("reporte");

                            var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                                sorc: "/reportesNeg/generarPDF/consecutivo/" + reporte
                            });
                            windowpdf.show();
                        }
                    });
                    contextMenu.add(repor);

                    coti = Ext.create('Ext.menu.Item', {
                        text: 'Ver Cotizacion',
                        iconCls: 'import',
                        scope: this,
                        handler: function () {
                            idreporte = record.get("idreporte");

                            var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                                sorc: "/cotizaciones/verCotizacion/idreporte/" + idreporte
                            });
                            windowpdf.show();
                        }
                    });
                    contextMenu.add(coti);

                    evento = Ext.create('Ext.menu.Item', {
                        text: 'Evento Riesgo',
                        iconCls: 'register',
                        scope: this,
                        handler: function () {
                            window.open("/riesgos/nuevoEventoExt5/idtipo/0/documento/"+idmaster+"/idhouse/" + record.get("idhouse"));
                        }
                    });
                    contextMenu.add(evento);

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
                            width: 600,
                            height: 220,
                            closeAction: 'destroy',
                            items: {
                                autoScroll: true,
                                items: [{
                                        xtype: 'Colsys.GestDocumental.FormSubirArchivos',
                                        id: 'formsubir',
                                        name: 'form-subir-arch',
                                        idtransporte: me.idtransporte,
                                        idimpoexpo: me.idimpoexpo,
                                        idreferencia: me.idreferencia,
                                        idmaster: me.idmaster,
                                        ref2: record.get("doctransporte"),
                                        idmaster: this.up('grid').idmaster
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
                                        idmaster: this.up('grid').idmaster,
                                        doctransporte: record.get("doctransporte")
                                    }
                                });
                            }
                            win_liberacion.show();
                        }
                    });
                    contextMenu.add(dar_liberacion);
                }

                if (permisos.RevLiberacion) {
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
                                                        if (!obj.reversable) {
                                                            Ext.MessageBox.alert("Colsys", "No es posible reversar la liberaci\u00F3n.");
                                                        } else if (obj.errorInfo != "" && obj.errorInfo != "undefined") {
                                                            Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
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
                                        id: 'formLiberarDocumentos',
                                        idhouse: record.get("idhouse"),
                                        idmaster: this.up('grid').idmaster,
                                        doctransporte: record.get("doctransporte")
                                    }
                                });
                            }
                            win_liberacion.show();
                        }
                    });
                    contextMenu.add(liberar_docs);
                }

                if (permisos.Anular)
                {
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