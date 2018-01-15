/*
 * @autor Nataly Puentes
 * Gestor de Houses
 * @params: 
 *       idimpoexpo  : texto con informacion de impoexpo 
 *       idtransporte: texto con modo de transporte
 * @date:  2016-03-31
 */
var constrainedWin2H = null;
var comboCliente = null;
var comboVendedor = null;
var comboReporte = null;
var comboReferencia = null;
var comboBoxRenderer = null;
var fileButton = null;
var tipo = "Proveedor";

Ext.define('Colsys.Ino.GridHouse', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridHouse',
    id: "gridhouse",
    height: 400,
    sortableColumns: false,
    enableColumnMove: false,
    autoScroll: true,
    bodegas:null,
    viewConfig: {
        getRowClass: function (record, rowIndex, rowParams, store) {
            return "row_" + record.get("color");
        }
    },
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
    plugins: [
        {
        ptype: 'cellediting',
        clicksToEdit: 1
    }
        /*,{
        ptype: 'rowwidget',

        // The widget definition describes a widget to be rendered into the expansion row.
        // It has access to the application's ViewModel hierarchy. Its immediate ViewModel
        // contains a record and recordIndex property. These, or any property of the record
        // (including association stores) may be bound to the widget.
        //
        // See the Order model definition with the association declared to Company.
        // Every Company record will be decorated with an "orders" method which,
        // when called yields a store containing associated orders.
        widget: Ext.create('Ext.grid.Panel', {
            //xtype: 'grid',
            autoLoad: true,
            bind: {
                store: '{record.orders}',
                title: 'Orders for {record.name}'
            },
            columns: [{
                text: 'Order Id',
                dataIndex: 'id',
                width: 75
            }, {
                text: 'Procuct code',
                dataIndex: 'productCode',
                width: 265
            }, {
                text: 'Quantity',
                dataIndex: 'quantity',
                xtype: 'numbercolumn',
                width: 100,
                align: 'right'
            }, {
                xtype: 'datecolumn',
                format: 'Y-m-d',
                width: 120,
                text: 'Date',
                dataIndex: 'date'
            }, {
                text: 'Shipped',
                xtype: 'checkcolumn',
                dataIndex: 'shipped',
                width: 75
            }]
        })
    }*/],
    onRender: function (ct, position)
    {
        comboBoxRenderer = function (combo) {
            return function (value) {
                var idx = combo.store.find(combo.valueField, value);
                var rec = combo.store.getAt(idx);
                return (rec === null ? value : rec.get(combo.displayField));
            };
        };        
        //console.log(this.bodegas);
        //me = this;
        /*this.bodegas=Ext.create('Colsys.Widgets.WgBodega', {
                            xtype:'Colsys.Widgets.WgBodega',
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
                        });
                        console.log(this.bodegas);*/
        me = this;
        
        this.reconfigure(
                Ext.create('Ext.data.Store', {
                    id: "storeGridHouse",
                    fields:
                            [
                                {name: 'idmaster' + this.idmaster, type: 'integer', mapping: 'idmaster'},
                                {name: 'idhouse' + this.idmaster, type: 'integer', mapping: 'idhouse'},
                                {name: 'doctransporte' + this.idmaster, type: 'string', mapping: 'doctransporte'},
                                {name: 'fchdoctransporte' + this.idmaster, type: 'date', mapping: 'fchdoctransporte', dateFormat: 'Y-m-d'},
                                {name: 'idcliente' + this.idmaster, type: 'integer', mapping: 'idcliente'},
                                {name: 'nombrecliente' + this.idmaster, type: 'string', mapping: 'cliente'},
                                {name: 'bodega' + this.idmaster, type: 'string', mapping: 'idbodega'},
                                {name: 'nombrebodega' + this.idmaster, type: 'string', mapping: 'nombre'},
                                {name: 'tercero' + this.idmaster, type: 'string', mapping: 'tercero'},
                                {name: 'vendedor' + this.idmaster, type: 'string', mapping: 'vendedor'},
                                {name: 'idtercero' + this.idmaster, type: 'integer', mapping: 'idtercero'},
                                {name: 'idreporte' + this.idmaster, type: 'integer', mapping: 'idreporte'},
                                {name: 'reporte' + this.idmaster, type: 'string', mapping: 'reporte'},
                                {name: 'numpiezas' + this.idmaster, type: 'integer', mapping: 'numpiezas'},
                                {name: 'peso' + this.idmaster, type: 'float', mapping: 'peso'},
                                {name: 'volumen' + this.idmaster, type: 'float', mapping: 'volumen'},
                                {name: 'numorden' + this.idmaster, type: 'string', mapping: 'numorden'},
                                {name: 'color' + this.idmaster, type: 'string', mapping: 'color'}
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
                columns =
                [
                    {
                        header: "idhouse",
                        hidden: true,
                        hideable: false,
                        dataIndex: "idhouse" + this.idmaster
                    },
                    {
                        header: "master" + this.idmaster,
                        hidden: true,
                        hideable: false,
                        dataIndex: "idmaster" + this.idmaster
                    },
                    {
                        header: "Idcliente",
                        hidden: true,
                        hideable: false,
                        dataIndex: 'idcliente' + this.idmaster,
                        sortable: true,
                        width: 100
                    },
                    {
                        header: "idreporte",
                        hidden: true,
                        dataIndex: 'idreporte' + this.idmaster,
                        sortable: true,
                        hideable: false,
                        width: 100
                    },
                    {
                        header: "Piezas",
                        dataIndex: 'numpiezas' + this.idmaster,
                        hideable: false,
                        align: 'right',
                        sortable: false,
                        width: 80,
                        editor: {xtype: "numberfield"},
                        renderer: Ext.util.Format.numberRenderer('0,0.00'),
                        summaryType: 'sum',
                        summaryRenderer: function (value, summaryData, dataIndex) {
                                return "<span style='font-weight: bold;'> " + value + "</span>";
                            }
                    },
                    {
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
                    },
                    {
                        header: "Volumen",
                        dataIndex: 'volumen' + this.idmaster,
                        hideable: false,
                        width: 80,
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
                    },
                    /* {
                     header: "nombrebodega",
                     hidden: true,
                     hideable: false,
                     dataIndex: 'nombrebodega' + this.idmaster,
                     sortable: true,
                     width: 100,
                     
                     },*/
                    {
                        header: "bodega",
                        hidden: true,
                        hideable: false,
                        dataIndex: 'bodega' + this.idmaster,
                        sortable: true,
                        width: 100,
                    },
                    {
                        header: "Bodega",
                        dataIndex: "nombrebodega" + this.idmaster,
                        hideable: false,
                        width: 250,
                        editor:Ext.create('Colsys.Widgets.WgBodega', {
                            xtype:'Colsys.Widgets.WgBodega',
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
                    
                    },
                    {
                        header: "Cliente",
                        dataIndex: "nombrecliente" + this.idmaster,
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
                    },
                    {
                        header: "IdProveedor",
                        dataIndex: 'idtercero' + this.idmaster,
                        hidden: true,
                        hideable: false,
                        width: 50

                    },
                    {
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
                    },
                    {
                        header: "Vendedor",
                        dataIndex: 'vendedor' + this.idmaster,
                        hideable: false,
                        sortable: true,
                        width: 160,
                        editor: Ext.create('Colsys.Widgets.wgUsuario', {
                            id: "vendedor" + this.idmaster
                        }),
                        renderer: comboBoxRenderer(Ext.getCmp('vendedor' + this.idmaster))

                    },
                    {
                        header: "Orden",
                        hideable: false,
                        dataIndex: "numorden" + this.idmaster,
                        editor: {xtype: "textfield"}
                    }

                ]
                );
        var orden = [];
        var house =
                {
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
                };
        var reporte =
                {
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
                                origen: Ext.getCmp("idorigen" + this.idmaster).value,
                                destino: Ext.getCmp("iddestino" + this.idmaster).value,
                                id: "comboReporte" + this.idmaster,
                                listeners:
                                        {
                                            select: function (a, record, idx)
                                            {
                                                var existente = 0;
                                                var store = this.up('grid').getStore();
                                                var selected = this.up('grid').getSelectionModel().getSelection()[0];
                                                var row = this.up('grid').store.indexOf(selected);
                                                var idmaster = this.up('grid').idmaster;
                                                for (var i = 0 ; i < store.getCount() ; i++){
                                                    
                                                    if(store.data.items[i].get('idreporte') == record.data.idreporte){
                                                       if (i != row){
                                                            Ext.MessageBox.alert('Mensaje', "Ya existe un registro con el reporte de negocio seleccionado");
                                                        
                                                            existente = 1;
                                                        }
                                                    }
                                                }
                                                
                                                if (existente == 1){
                                                    store.remove(row);
                                                    
                                                     
                                                }
                                                if (existente == 0){
                                                    var aprobacion = 0;
                                                    if (store.data.items[row].get('idreporte' + this.up('grid').idmaster) != 0) {
                                                        Ext.MessageBox.confirm('Confirmaci&oacute;n', 'Est&aacute; seguro que desea sobrescribir el Registro?', function (choice) {
                                                            if (choice == 'yes'){
                                                                store.data.items[row].set('doctransporte' + idmaster, record.data.ca_doctransporte);
                                                                store.data.items[row].set('idreporte' + idmaster, record.data.idreporte);
                                                                store.data.items[row].set('tercero' + idmaster, record.data.ca_tercero);
                                                                store.data.items[row].set('idtercero' + idmaster, record.data.ca_idtercero);
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
                                                            }
                                                        });
                                                    }else{
                                                        store.data.items[row].set('doctransporte'+ idmaster, record.data.ca_doctransporte);
                                                        store.data.items[row].set('idreporte' + idmaster, record.data.idreporte);
                                                        store.data.items[row].set('tercero' + idmaster, record.data.ca_tercero);
                                                        store.data.items[row].set('idtercero' +idmaster, record.data.ca_idtercero);
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
                                                    }
                                                }
                                            }
                                        }
                            }),
                    renderer: comboBoxRenderer(Ext.getCmp('comboReporte' + this.idmaster))
                };
        /*var proveedor =
         {
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
         };*/
        /*var idproveedor =
         {
         header: "IdProveedor",
         dataIndex: 'idtercero' + this.idmaster,
         hidden: true,
         width: 50
         
         }*/
        var guardar = {
            text: 'Guardar',
            iconCls: 'add',
            width: 80,
            handler: function () {

                idmaster = this.up('grid').idmaster;
                var store = this.up('grid').getStore();
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
                    rows.push(row);
                };
                model.fields.forEach(filtrerfields);
                store.getModifiedRecords().forEach(filtrerRows);
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
        //console.log("bodegas:")
        //console.log(this.bodegas);
        if (this.permisos.Crear == true) {
            tb.add(
                    {
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
        if (this.idimpoexpo == "INTERNO" && this.idtransporte == "Terrestre") {
            orden.push(house);
        } else
        {
            orden.push(reporte, {
                header: "Doc. Transporte",
                hideable: false,
                id: "doctransporte" + this.idmaster,
                dataIndex: 'doctransporte' + this.idmaster,
                width: 125,
                sortable: true,
                editor: {xtype: "textfield"}
            }/*, proveedor, idproveedor*/);
        }
        ;
        this.reconfigure(orden.concat(columns));
        this.superclass.onRender.call(this, ct, position);
    },
    listeners:
            {
                beforerender: function (ct, position) {
                    this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 150);
                    this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 50);
                },
                activate: function (ct, position)
                {
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
                                    if( Ext.ComponentManager.get("bodega" + idmaster))
                                    {
                                        Ext.getCmp("bodega" + idmaster).store.add(
                                                {"idbodega": rec.data.bodega, "nombre": rec.data.nombrebodega, 'tipo': '', 'transporte': '',
                                                    'identificacion': '', 'direccion': ''}
                                        );
                                        rec.set(("nombrebodega" + idmaster), rec.data.nombrebodega);
                                        rec.set(("bodega" + idmaster), rec.data.bodega);
                                    }


                                    if( Ext.ComponentManager.get("nombrecliente" + idmaster))
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
                },
                beforeitemcontextmenu: function (view, record, item, index, e)
                {
                    e.stopEvent();
                    eliminar = null;
                    if (this.permisos.Anular) {
                        eliminar = {
                            text: 'Eliminar',
                            iconCls: 'delete',
                            scope: this,
                            handler: function (idg) {
                                var store = this.store;
                                var row = store.indexOf(record);
                                data = record.data.idhouse;
                                if (data == null || data == "") {
                                    store.removeAt(row);
                                } else
                                {
                                    Ext.MessageBox.confirm('Confirmacion', 'esta seguro de Eliminar el registro',
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
                                                            if (obj.errorInfo != "" && obj.errorInfo != "undefined")
                                                            {
                                                                alert("Se presento un error: " + obj.errorInfo);
                                                            } else
                                                            {
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
                                            });
                                }
                            }
                        };
                    }
                    var repor = "";
                    if (this.idtransporte != "Terrestre") {
                        repor = {
                            text: 'Ver Reporte',
                            iconCls: 'import',
                            scope: this,
                            handler: function () {
                                reporte = record.data.idreporte;

                                var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                                    sorc: "/reportesNeg/generarPDF/id/" + reporte
                                });
                                windowpdf.show();
                            }
                        }
                    }
                    var items = new Array();
                    var menu = new Ext.menu.Menu({
                        items: [repor,
                            {
                                text: 'Status',
                                iconCls: 'search',
                                scope: this,
                                handler: function () {
                                    reporte = record.data.reporte;
                                    if (reporte == null) {
                                        reporte = "No asignado";
                                    }
                                    Ext.create('Ext.window.Window', {
                                        title: 'Status de reporte: ' + reporte,
                                        id: 'status' + record.data.idreporte,
                                        width: 820,
                                        height: 400,
                                        layout: 'fit',
                                        autoScroll: true,
                                        items:
                                                {
                                                    xtype: Ext.create('Colsys.Widgets.wgStatus', {
                                                        reporte: reporte,
                                                        idreporte: record.data.idreporte,
                                                        idhouse: record.data.idhouse
                                                    })
                                                }
                                    }).show();
                                }
                            },
                            eliminar
                        ]
                    }).showAt(e.getXY());
                }
            }
});
