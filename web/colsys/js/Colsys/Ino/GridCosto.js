winSobreventa = null;
winTercero = null;
comboBoxRenderer = function (combo) {
    return function (value) {

        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField));
    };
};
comboProveedor = Ext.create('Colsys.Widgets.WgProveedores', {
    idmaster: this.idmaster,
    idtransporte: this.idtransporte
});

comboCosto = Ext.create('Colsys.Widgets.wgConceptos', {
    costo: 'true',
    //costo: 'true',
    idtransporte: this.idtransporte,
    idimpoexpo: this.idimpoexpo
});




Ext.define('Colsys.Ino.GridCosto', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridCosto',
    viewConfig: {
        getRowClass: function (record, rowIndex, rowParams, store) {

            if ((record.get('inoventa' + this.up('grid').idmaster)) - (record.get('neto' + this.up('grid').idmaster)) != 0) {
                return "row_purple";
            }
        }
    },
    //width: 400,
    //height: 200,
    title: 'Summary Test',
    style: 'padding: 20px',
    features: [{
            ftype: 'summary'
        }],
    selModel: {
        selType: 'cellmodel'
    },
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    listeners: {
        activate: function (ct, position) {
            if (this.load == false || this.load == "undefined" || !this.load)
            {
                this.store.proxy.extraParams = {
                    idmaster: this.idmaster
                }

                this.load = true;
            }

            store = this.store;
            idmaster = this.idmaster;
            /*comboProveedor.getStore().add(
             //{"id":data.c_ca_idproveedor, "name":data.i_ca_nombre}
             {"idlinea":800200969, "linea":"AAAA"}
             );*/

            var obj = null;
            Ext.Ajax.request({
                url: '/inoF2/datosGridCostos',
                params: {
                    idmaster: idmaster
                },
                success: function (response, opts) {
                    obj = Ext.decode(response.responseText);

                    for (i = 0; i < obj.root.length; i++)
                        eval("var idlinea=obj.root[i].idproveedor" + idmaster + ";var linea=obj.root[i].proveedor" + idmaster + ";");
                    //eval("var linea=obj.root[i].proveedor"+idmaster+";");
                    comboProveedor.getStore().add(
                            {"idlinea": idlinea, "linea": linea}
                    );


                    store.loadData(obj.root);
                    store.commitChanges();

                },
                failure: function (response, opts) {

                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);

                }
            });



            /*this.store.load({
             scope: this,
             callback: function(records, operation, success) {
             
             for(i=0;i<records.length;i++)
             {
             comboProveedor.getStore().add(
             //{"id":data.c_ca_idproveedor, "name":data.i_ca_nombre}
             {"idlinea":records[i].data.c_ca_idproveedor, "linea":records[i].data.i_ca_nombre}
             );
             //store.data.items[i].data.idproveedor10018=records[i].data.i_ca_nombre;
             
             
             }
             
             for(i=0;i<records.length;i++)
             {
             
             store.data.items[i].set('idproveedor'+idmaster,records[i].data.c_ca_idproveedor);
             
             }
             
             
             } 
             });*/
        },
        beforeedit: function (editor, e, eOpts) {
            var store = this.getStore();

            if (e.field == 'tcambio_usd' + this.idmaster) {
                if (store.data.items[e.rowIdx].get('idmoneda' + this.idmaster) == "USD" || store.data.items[e.rowIdx].get('idmoneda' + this.idmaster) == "COP") {
                    return false;
                }
            }
        },
        blur: function (editor, e, eOpts) {
            var store = this.getStore();

            if (e.field == "idmoneda" + this.idmaster) {
                if (store.data.items[e.rowIdx].get('idmoneda' + this.idmaster) == "USD" || store.data.items[e.rowIdx].get('idmoneda' + this.idmaster) == "COP") {
                    store.data.items[e.rowIdx].set('tcambio_usd' + this.idmaster, "1");
                }
            }

            //if (e.field == "neto" + this.idmaster || e.field == "tcambio_usd" + this.idmaster) {
            store.data.items[e.rowIdx].set('neto_usd' + this.idmaster, (
                    store.data.items[e.rowIdx].get('neto' + this.idmaster) /
                    store.data.items[e.rowIdx].get('tcambio_usd' + this.idmaster)
                    ));
            // }




            //if (e.field == "tcambio" + this.idmaster) {
            store.data.items[e.rowIdx].set('valor_pesos' + this.idmaster, (
                    store.data.items[e.rowIdx].get('tcambio' + this.idmaster) *
                    store.data.items[e.rowIdx].get('neto_usd' + this.idmaster)));

            store.data.items[e.rowIdx].set('inoventa' + this.idmaster, (
                    store.data.items[e.rowIdx].get('venta' + this.idmaster) -
                    store.data.items[e.rowIdx].get('valor_pesos' + this.idmaster)));
            //}

            //if (e.field == "concepto" + this.idmaster)
            //{
            /*store.data.items[e.rowIdx].set('idcosto' + this.idmaster, e.value);
             store.data.items[e.rowIdx].set('concepto' + this.idmaster, editor.editors.items[0].field.rawValue);*/
            //  }

            // if (e.field == "valor_pesos" + this.idmaster || e.field == "ventacop" + this.idmaster) {
            store.data.items[e.rowIdx].set('inoventa' + this.idmaster, (
                    store.data.items[e.rowIdx].get('venta' + this.idmaster) -
                    store.data.items[e.rowIdx].get('valor_pesos' + this.idmaster)));


            // }
        },
        edit: function (editor, e, eOpts)
        {
            var store = this.getStore();

            if (e.field == "idmoneda" + this.idmaster) {
                if (store.data.items[e.rowIdx].get('idmoneda' + this.idmaster) == "USD" || store.data.items[e.rowIdx].get('idmoneda' + this.idmaster) == "COP") {
                    store.data.items[e.rowIdx].set('tcambio_usd' + this.idmaster, "1");
                }
            }

            //if (e.field == "neto" + this.idmaster || e.field == "tcambio_usd" + this.idmaster) {
            store.data.items[e.rowIdx].set('neto_usd' + this.idmaster, (
                    store.data.items[e.rowIdx].get('neto' + this.idmaster) /
                    store.data.items[e.rowIdx].get('tcambio_usd' + this.idmaster)
                    ));
            // }






            //if (e.field == "tcambio" + this.idmaster) {
            store.data.items[e.rowIdx].set('valor_pesos' + this.idmaster, (
                    store.data.items[e.rowIdx].get('tcambio' + this.idmaster) *
                    store.data.items[e.rowIdx].get('neto_usd' + this.idmaster)));





            store.data.items[e.rowIdx].set('inoventa' + this.idmaster, (
                    store.data.items[e.rowIdx].get('venta' + this.idmaster) -
                    store.data.items[e.rowIdx].get('valor_pesos' + this.idmaster)));
            //}

            //if (e.field == "concepto" + this.idmaster)
            //{
            /*store.data.items[e.rowIdx].set('idcosto' + this.idmaster, e.value);
             store.data.items[e.rowIdx].set('concepto' + this.idmaster, editor.editors.items[0].field.rawValue);*/
            //  }

            // if (e.field == "valor_pesos" + this.idmaster || e.field == "ventacop" + this.idmaster) {
            store.data.items[e.rowIdx].set('inoventa' + this.idmaster, (
                    store.data.items[e.rowIdx].get('venta' + this.idmaster) -
                    store.data.items[e.rowIdx].get('valor_pesos' + this.idmaster)));


            // }
        },
        beforeitemcontextmenu: function (view, record, item, index, e)
        {
            var idmast = this.idmaster;
            e.stopEvent();
            var record = this.store.getAt(index);


            var menu = new Ext.menu.Menu({
                items: [
                    {
                        text: 'Eliminar',
                        iconCls: 'delete',
                        handler: function () {
                            Ext.MessageBox.confirm('Confirmacion', 'esta seguro de Eliminar el registro',
                                    function (e) {
                                        if (e == 'yes') {
                                            var box = Ext.MessageBox.wait('Procesando', 'Eliminando')
                                            Ext.Ajax.request({
                                                url: '/inoF2/eliminarCosto',
                                                params: {
                                                    idinocosto: record.get('idinocosto' + idmast)
                                                },
                                                success: function (response, opts) {
                                                    var obj = Ext.decode(response.responseText);

                                                    if (obj.errorInfo)
                                                    {
                                                        Ext.MessageBox.alert("Colsys", "Se presento un error: ");
                                                    } else
                                                    {
                                                        Ext.MessageBox.alert("Colsys", "Registro Eliminado Correctamente");
                                                        store.reload();
                                                    }
                                                    box.hide();
                                                },
                                                failure: function (response, opts) {

                                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                    box.hide();
                                                    store.reload();
                                                }
                                            });
                                        }
                                    })
                        }
                    }
                ]
            }).showAt(e.getXY());
        },
        beforerender: function (me, eOpts) {

            this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 150);
            this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 50);
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'idmaster' + this.idmaster, type: 'integer'},
                            {name: 'idinocosto' + this.idmaster, type: 'integer'},
                            {name: 'idcosto' + this.idmaster, type: 'integer'},
                            //{name: 'concepto' + this.idmaster, type: 'string'},
                            {name: 'idproveedor' + this.idmaster, type: 'string'},
                            {name: 'proveedor' + this.idmaster, type: 'string'},
                            {name: 'factura' + this.idmaster, type: 'string'},
                            {name: 'fchfactura' + this.idmaster},
                            {name: 'idmoneda' + this.idmaster, type: 'string'},
                            {name: 'neto' + this.idmaster, type: 'float'},
                            {name: 'neto_usd' + this.idmaster, type: 'float'},
                            {name: 'venta' + this.idmaster, type: 'float'},
                            {name: 'tcambio' + this.idmaster, type: 'float'},
                            {name: 'tcambio_usd' + this.idmaster, type: 'float'},
                            {name: 'valor_pesos' + this.idmaster, type: 'float'},
                            {name: 'utilidad' + this.idmaster, type: 'float'},
                            {name: 'inoventa' + this.idmaster, type: 'float'},
                            {name: 'ventacop' + this.idmaster, type: 'float'},
                            {name: 'color', type: 'string', mapping: 'color'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/inoF2/datosGridCostos',
                            reader: {
                                type: 'json',
                                root: 'root',
                                totalProperty: 'total'
                            }
                        },
                        sorters: [{
                                property: 'proveedor',
                                direction: 'ASC'
                            }],
                        autoLoad: false
                    }),
                    [
                        {
                            header: "idmaster",
                            dataIndex: 'idmaster' + this.idmaster,
                            hidden: true
                        },
                        {
                            header: "Costo",
                            dataIndex: 'idcosto' + this.idmaster,
                            sortable: true,
                            width: 120,
                            tpl: '<span class="x-form-item-label-default">{name}</span>',
                            editor: {
                                xtype: comboCosto,
                                costo: 'true',
                                transporte: this.idtransporte,
                                impoexpo: this.idimpoexpo

                            },
                            renderer: comboBoxRenderer(comboCosto)
                        },
                        {
                            header: "Factura",
                            dataIndex: 'factura' + this.idmaster,
                            hideable: false,
                            sortable: true,
                            width: 80,
                            editor: {
                                xtype: 'textfield',
                                maxLength: 30
                            }
                        },
                        {
                            header: "Fecha<br>Factura",
                            dataIndex: 'fchfactura' + this.idmaster,
                            hideable: false,
                            sortable: true,
                            width: 80,
                            renderer: function (a, b, c, d) {
                                if (a) {
                                    var formattedDate = new Date(a);
                                    var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                                    var d = formattedDate.getDate();
                                    if (d < 10) {
                                        d = "0" + d
                                    }
                                    var m = formattedDate.getMonth();
                                    m += 1;  // JavaScript months are 0-11
                                    if (m < 10) {
                                        m = "0" + m;
                                    }
                                    var y = formattedDate.getFullYear();
                                    return y + "-" + m + "-" + d;
                                }
                            },
                            editor: new Ext.form.DateField({
                                width: 90,
                                format: 'Y-m-d',
                                useStrict: undefined
                            })
                        },
                        {
                            header: "Moneda",
                            dataIndex: 'idmoneda' + this.idmaster,
                            hideable: false,
                            sortable: true,
                            width: 70,
                            align: 'left',
                            editor: {
                                xtype: 'Colsys.Widgets.wgMoneda'
                            }
                        },
                        {
                            header: "Neta",
                            dataIndex: 'neto' + this.idmaster,
                            hideable: false,
                            sortable: true,
                            width: 80,
                            align: 'right',
                            renderer: Ext.util.Format.numberRenderer('0,0.00'),
                            summaryType: 'sum',
                            editor: {
                                xtype: 'numberfield'
                            },
                            summaryRenderer: function (value, summaryData, dataIndex) {
                                return "<span style='font-weight: bold;'> " + Ext.util.Format.usMoney(value) + "</span>";
                            }
                        },
                        {
                            header: "Cambio<br>USD",
                            dataIndex: 'tcambio_usd' + this.idmaster,
                            hideable: false,
                            sortable: true,
                            width: 80,
                            align: 'right',
                            readOnly: true,
                            renderer: Ext.util.Format.numberRenderer('0,0.00'),
                            //summaryType: 'sum',
                            editor: {
                                xtype: 'numberfield'
                            },
                            /*summaryRenderer: function (value, summaryData, dataIndex) {
                             return "<span style='font-weight: bold;'> " + Ext.util.Format.usMoney(value) + "</span>";
                             }*/
                        },
                        {
                            header: "Neta<br>USD",
                            dataIndex: 'neto_usd' + this.idmaster,
                            hideable: false,
                            sortable: true,
                            width: 70,
                            align: 'right',
                            renderer: Ext.util.Format.numberRenderer('0,0.00'),
                            summaryType: 'sum',
                            summaryRenderer: function (value, summaryData, dataIndex) {
                                return "<span style='font-weight: bold;'> " + Ext.util.Format.usMoney(value) + "</span>";
                            },
                            editor: {
                                xtype: 'numberfield',
                                readOnly: true
                            }
                        },
                        {
                            header: "Cambio<br>" + this.monedalocal,
                            dataIndex: 'tcambio' + this.idmaster,
                            hideable: false,
                            sortable: true,
                            width: 80,
                            align: 'right',
                            renderer: Ext.util.Format.numberRenderer('0,0.00'),
                            // summaryType: 'sum',
                            editor: {
                                xtype: 'numberfield'
                            },
                            /*summaryRenderer: function (value, summaryData, dataIndex) {
                             return "<span style='font-weight: bold;'> " + Ext.util.Format.usMoney(value) + "</span>";
                             }*/
                        },
                        {
                            header: "Neto COP",
                            dataIndex: 'valor_pesos' + this.idmaster,
                            hideable: false,
                            sortable: false,
                            width: 80,
                            align: 'right',
                            summaryType: 'sum',
                            renderer: Ext.util.Format.numberRenderer('0,0.00'),
                            summaryRenderer: function (value, summaryData, dataIndex) {
                                return "<span style='font-weight: bold;'> " + Ext.util.Format.usMoney(value) + "</span>";
                            },
                            editor: {
                                xtype: 'numberfield',
                                readOnly: true
                            }
                        },
                        {
                            header: "Venta COP",
                            dataIndex: 'venta' + this.idmaster,
                            hideable: false,
                            sortable: false,
                            width: 100,
                            align: 'right',
                            renderer: Ext.util.Format.numberRenderer('0,0.00'),
                            summaryType: 'sum',
                            summaryRenderer: function (value, summaryData, dataIndex) {
                                return "<span style='font-weight: bold;'> " + Ext.util.Format.usMoney(value) + "</span>";
                            },
                            editor: {
                                xtype: 'numberfield'
                            }
                        },
                        {
                            header: "Ino en Venta",
                            dataIndex: 'inoventa' + this.idmaster,
                            hideable: false,
                            sortable: false,
                            width: 100,
                            align: 'right',
                            renderer: Ext.util.Format.numberRenderer('0,0.00'),
                            summaryType: 'sum',
                            summaryRenderer: function (value, summaryData, dataIndex) {
                                return "<span style='font-weight: bold;'> " + Ext.util.Format.usMoney(value) + "</span>";
                            }
                        },
                        {
                            header: "Proveedor",
                            dataIndex: 'idproveedor' + this.idmaster,
                            sortable: true,
                            width: 320,
                            tpl: '<span class="x-form-item-label-default">{proveedor}</span>',
                            editor: {
                                xtype: comboProveedor,
                                idmaster: this.idmaster,
                                idtransporte: this.idtransporte
                            },
                            renderer: comboBoxRenderer(comboProveedor)
                        },
                        {
                            xtype: 'actioncolumn',
                            width: 50,
                            items: [{
                                    getClass: function (v, meta, rec) {
                                        if ((rec.data.c_ca_venta - rec.data.c_ca_neto) != 0) {
                                            return 'import';
                                        }
                                    },
                                    tooltip: 'INO x Sobreventa',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        if (winTercero == null)
                                        {
                                            winTercero = Ext.create('Ext.window.Window', {
                                                title: 'Edicion de Terceros',
                                                height: 200,
                                                width: 600,
                                                layout: 'fit',
                                                items:
                                                        {
                                                            xtype: "Colsys.Ino.GridSobreventa",
                                                            idmaster: this.up('grid').idmaster,
                                                            idinocosto: rec.data.c_ca_idinocosto
                                                        },
                                                listeners: {
                                                    destroy: function (obj, eOpts)
                                                    {
                                                        winTercero = null;
                                                    }
                                                }
                                            });
                                            winTercero.show();
                                        } else
                                        {
                                            Ext.Msg.alert("Ino", "Existe una ventana abierta de Sobreventa<br>Por favor cierrela primero");
                                        }
                                    }
                                }]
                        }
                    ]
                    );

            if (this.permisos.Crear == true) {

                tb = new Ext.toolbar.Toolbar();
                tb.add({
                    text: 'Agregar',
                    iconCls: 'add',
                    handler: function () {

                        var store = this.up('grid').store;
                        var r = Ext.create(store.model);
                        r.set('idmaster' + this.up('grid').idmaster, this.up('grid').idmaster);
                        store.insert(0, r);
                    }
                }, {
                    text: 'Guardar',
                    iconCls: 'add',
                    handler: function () {
                        var store = this.up('grid').getStore();
                        idmaster = this.up('grid').idmaster;

                        var records = store.getModifiedRecords();
                        var str = "";

                        var r = Ext.create(store.getModel());
                        fields = new Array();
                        for (i = 0; i < r.fields.length; i++)
                        {

                            fields.push(r.fields[i].name.replace(idmaster, ""));
                        }

                        changes = [];
                        changes1 = [];
                        for (var i = 0; i < records.length; i++) {
                            r = records[i];

                            records[i].data.id = r.id
                            changes1[i] = records[i].data;

                            row = new Object();
                            for (j = 0; j < fields.length; j++)
                            {

                                eval("row." + fields[j] + "=records[i].data." + fields[j] + idmaster + ";")

                            }
                            row.id = r.id
                            changes[i] = row;
                        }


                        var str = JSON.stringify(changes);
                        if (str.length > 5)
                        {
                            Ext.Ajax.request({
                                url: '/inoF2/guardarGridCosto',
                                params: {
                                    datos: str
                                },
                                callback: function (options, success, response) {
                                    var res = Ext.util.JSON.decode(response.responseText);


                                    if (success) {
                                        Ext.MessageBox.alert("Mensaje", 'Datos Almacenados Correctamente<br>');
                                        store.reload();
                                    } else {
                                        Ext.MessageBox.alert("Error", 'Error al guardar<br>' + res.errorInfo);
                                    }


                                }
                            });
                        }
                    }
                });

                this.addDocked(tb);
            }


            comboCosto.getStore().load({
                params: {
                    costo: 'true',
                    transporte: this.idtransporte,
                    impoexpo: this.idimpoexpo
                }
            });

        }

    },
    /*tbar: [{
     text: 'Agregar',
     iconCls: 'add',
     handler: function () {
     
     var store = this.up('grid').store;
     var r = Ext.create(store.model);
     r.set('idmaster'+this.up('grid').idmaster,this.up('grid').idmaster);
     store.insert(0, r);
     }
     }, {
     text: 'Guardar',
     iconCls: 'add',
     handler: function () {
     var store = this.up('grid').getStore();
     idmaster = this.up('grid').idmaster;
     
     var records = store.getModifiedRecords();
     var str="";
     
     var r = Ext.create(store.getModel());
     fields= new Array();
     for(i=0;i<r.fields.length;i++)
     {
     
     fields.push(r.fields[i].name.replace(idmaster,""));
     }
     
     changes=[];
     changes1=[];
     for( var i=0; i< records.length; i++){
     r = records[i];
     
     records[i].data.id=r.id
     changes1[i]=records[i].data;               
     
     row=new Object();
     for(j=0;j<fields.length;j++)
     {
     
     eval("row."+fields[j]+"=records[i].data."+fields[j]+idmaster+";")
     
     }
     row.id=r.id
     changes[i]=row;
     }
     
     
     var str= JSON.stringify(changes);
     if (str.length > 5)
     {
     Ext.Ajax.request({
     url: '/inoF2/guardarGridCosto',
     params: {
     datos: str
     },
     callback: function (options, success, response) {
     var res = Ext.util.JSON.decode(response.responseText);
     
     
     if (success){
     Ext.MessageBox.alert("Mensaje", 'Datos Almacenados Correctamente<br>');
     store.reload();
     }
     else{
     Ext.MessageBox.alert("Error", 'Error al guardar<br>'+ res.errorInfo);
     }
     
     
     }
     });
     }
     }
     }]*/
});