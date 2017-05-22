nuevoVaciado = null;
nuevoFacturacion = null;
nuevoTiempoTransito = null;
nuevoCoordEmbarque = null;
Ext.define('Colsys.Indicadores.gridParametrizacion', {
    features: [{
            id: 'categoria',
            ftype: 'groupingsummary',
            hideGroupedHeader: true,
            startCollapsed: true,
            totalSummary: 'fixed', // Can be: 'fixed', true, false. Default: false
            totalSummaryTopLine: true, // Default: true
            totalSummaryColumnLines: true  // Default: false
        }],
    alias: 'widget.wGridParametrizacion',
    extend: 'Ext.grid.Panel',
    height: 450,
    listeners: {
        afterrender: function (ct, position) {
            this.getStore().reload();
        },
        beforerender: function (ct, position) {
            prefijo = this.prefijo;
            tb = new Ext.toolbar.Toolbar({
                 enableToggle: true
            });
            tb.add({
                xtype: 'button',
                text: 'Nuevo Parametro Vaciado',
                height: 30,
                iconCls: 'ship',
                handler: function () {
                    if (nuevoVaciado == null) {
                        nuevoVaciado = new Ext.Window({
                            title: 'Nuevo Parametro Desconsolidacion',
                            width: 300,
                            height: 232,
                            resizable: false,
                            id: 'winnuevoVaciado',
                            items: {
                                xtype: 'Colsys.Indicadores.FormVaciado',
                                prefijo: prefijo
                            },
                            listeners: {
                                close: function (win, eOpts) {
                                    nuevoVaciado = null;
                                }
                            }
                        })
                    }
                    nuevoVaciado.show();
                }
            },
                    {
                        xtype: 'button',
                        text: 'Nuevo Parametro Facturacion',
                        height: 30,
                        iconCls: 'page_white_edit',
                        handler: function () {
                            if (nuevoFacturacion == null) {
                                nuevoFacturacion = new Ext.Window({
                                    title: 'Nuevo Parametro Facturacion',
                                    width: 300,
                                    height: 262,
                                    resizable: false,
                                    id: 'winnuevoFacturacion',
                                    items: {
                                        xtype: 'Colsys.Indicadores.FormFacturacion',
                                        prefijo: prefijo
                                    },
                                    listeners: {
                                        close: function (win, eOpts) {
                                            nuevoFacturacion = null;
                                        }
                                    }
                                })
                            }
                            nuevoFacturacion.show();
                        }
                    },
                    {
                        xtype: 'button',
                        text: 'Nuevo Parametro T. Transito',
                        height: 30,
                        iconCls: 'clock',
                        handler: function () {
                            if (nuevoTiempoTransito == null) {
                                nuevoTiempoTransito = new Ext.Window({
                                    title: 'Nuevo Parametro Tiempo de Transito',
                                    width: 300,
                                    height: 332,
                                    resizable: false,
                                    id: 'winnuevoTiempoTransito',
                                    items: {
                                        xtype: 'Colsys.Indicadores.FormTiempoTransito',
                                        prefijo: prefijo
                                    },
                                    listeners: {
                                        close: function (win, eOpts) {
                                            nuevoTiempoTransito = null;
                                        }
                                    }
                                })
                            }
                            nuevoTiempoTransito.show();
                        }
                    },
                    {
                        xtype: 'button',
                        text: 'Nuevo Parametro C. Embarque',
                        height: 30,
                        iconCls: 'hammer',
                        handler: function () {
                            if (nuevoCoordEmbarque == null) {
                                nuevoCoordEmbarque = new Ext.Window({
                                    title: 'Nuevo Parametro C. Embarque',
                                    width: 300,
                                    height: 332,
                                    resizable: false,
                                    id: 'winnuevoCoordEmbarque',
                                    items: {
                                        xtype: 'Colsys.Indicadores.FormCoordEmbarque',
                                        prefijo: prefijo
                                    },
                                    listeners: {
                                        close: function (win, eOpts) {
                                            nuevoCoordEmbarque = null;
                                        }
                                    }
                                })
                            }
                            nuevoCoordEmbarque.show();
                        }
                    },
                    {
                        xtype: 'textfield',
                        fieldLabel: 'Filtrar',
                        labelWidth: 60,
                        width: 250,
                        listeners: {
                            change: function (me, newValue, oldValue, eOpts) {
                                store = this.up('toolbar').up('grid').getStore();
                                store.clearFilter();

                                if (newValue != "") {

                                    store.filterBy(function (record, id) {
                                        ftransporte = record.get("transporte").toString().toUpperCase();
                                        forigen = record.get("origen").toString().toUpperCase();
                                        fdestino = record.get("destino").toString().toUpperCase();
                                        ftransportista = record.get("transportista").toString().toUpperCase();
                                        fcliente = record.get("cliente").toString().toUpperCase();
                                        fperiodo_inicial = record.get("periodo_inicial").toString().toUpperCase();
                                        fperiodo_final = record.get("periodo_final").toString().toUpperCase();
                                        fmuelle = record.get("muelle").toString().toUpperCase();
                                        fvaciado = record.get("vaciado").toString().toUpperCase();
                                        ffacturacion = record.get("facturacion").toString().toUpperCase();
                                        ftiempotransito = record.get("tiempotransito").toString().toUpperCase();
                                        fcoordinacion = record.get("coordinacion").toString().toUpperCase();
                                        ftraficodestino = record.get("traficodestino").toString().toUpperCase();


                                        if (ftransporte.includes(newValue.toUpperCase())
                                                || forigen.includes(newValue.toUpperCase())
                                                || fdestino.includes(newValue.toUpperCase())
                                                || ftransportista.includes(newValue.toUpperCase())
                                                || fcliente.includes(newValue.toUpperCase())
                                                || fperiodo_inicial.includes(newValue.toUpperCase())
                                                || fperiodo_final.includes(newValue.toUpperCase())
                                                || fmuelle.includes(newValue.toUpperCase())
                                                || fvaciado.includes(newValue.toUpperCase())
                                                || ffacturacion.includes(newValue.toUpperCase())
                                                || ftiempotransito.includes(newValue.toUpperCase())
                                                || fcoordinacion.includes(newValue.toUpperCase())
                                                || ftraficodestino.includes(newValue.toUpperCase())
                                                ) {
                                            return true;
                                        } else {
                                            return false;
                                        }

                                    });
                                }


                            }
                        }
                    },
                    {
                        xtype: "textfield",
                        fieldLabel: 'Buscar',
                        listeners:{
                            change:function( obj, newValue, oldValue, eOpts ){
                                var store=this.up("grid").getStore();
                                store.clearFilter();
                                if(newValue!=""){
                                    store.filterBy(function(record, id){
                                        var str=record.get("transporte");
                                        var str1=record.get("origen");
                                        var str2=record.get("traficodestino");
                                        //var str3=record.get("ca_apellidos");

                                        var txt=new RegExp(newValue,"ig");
                                        if(str.search(txt) == -1 && str1.toString().search(txt) == -1 && str2.search(txt) == -1 && str3.search(txt) == -1)
                                            return false;
                                        else
                                            return true;
                                    });
                                }
                            }
                        }
                    }

            );
            this.addDocked(tb);
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'consecutivo', mapping: 'consecutivo'},
                            {name: 'categoria', mapping: 'categoria'},
                            {name: 'transporte', mapping: 'transporte'},
                            {name: 'origen', mapping: 'origen'},
                            {name: 'destino', mapping: 'destino'},
                            {name: 'transportista', mapping: 'transportista'},
                            {name: 'cliente', mapping: 'cliente'},
                            {name: 'periodo_inicial', mapping: 'periodo_inicial'},
                            {name: 'periodo_final', mapping: 'periodo_final'},
                            {name: 'muelle', mapping: 'muelle'},
                            {name: 'vaciado', mapping: 'vaciado'},
                            {name: 'facturacion', mapping: 'facturacion'},
                            {name: 'tiempotransito', mapping: 'tiempotransito'},
                            {name: 'coordinacion', mapping: 'coordinacion'},
                            {name: 'traficodestino', mapping: 'traficodestino'},
                            {name: 'ciudadorigen', mapping: 'ciudadorigen'},
                            {name: 'dias', mapping: 'dias'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: prefijo + '/widgets5/datosParametrizacionIdgClientes',
                            reader: {
                                type: 'json',
                                root: 'root'
                            }
                        },
                        groupField: 'categoria',
                        
                        sorters: [{
                                property: 'categoria',
                                direction: 'ASC'
                            }]
                    }),
                    [
                        {
                            text: 'consecutivo',
                            dataIndex: 'consecutivo',
                            hidden: true
                        }, {
                            text: 'Transporte',
                            dataIndex: 'transporte',
                            width: 84
                        }, {
                            text: 'Origen',
                            dataIndex: 'origen',
                        }, {
                            text: 'C. Origen',
                            dataIndex: 'ciudadorigen',
                        }, {
                            text: 'T. Destino',
                            dataIndex: 'traficodestino',
                        }, {
                            text: 'Destino',
                            dataIndex: 'destino',
                        }, {
                            text: 'Transportista',
                            dataIndex: 'transportista',
                            width: 120
                        }, {
                            text: 'Cliente',
                            dataIndex: 'cliente',
                        }, {
                            text: 'P. Inicial',
                            dataIndex: 'periodo_inicial',
                            width: 90
                        }, {
                            text: 'P. Final',
                            dataIndex: 'periodo_final',
                            width: 90
                        }, {
                            text: 'Muelle',
                            dataIndex: 'muelle',
                        },/* {
                            text: 'Vaciado',
                            dataIndex: 'vaciado',
                            width: 70
                        }, {
                            text: 'Facturacion',
                            dataIndex: 'facturacion',
                            width: 90
                        }, {
                            text: 'Tiempo Transito',
                            dataIndex: 'tiempotransito'
                        }, {
                            text: 'C. Embarque',
                            dataIndex: 'coordinacion'
                        }, */{
                            text: 'Dias',
                            dataIndex: 'dias',
                            width: 60
                        },{
                            menuDisabled: true,
                            sortable: false,
                            xtype: 'actioncolumn',
                            width: 25,
                            items: [{
                                    iconCls: 'delete',
                                    tooltip: 'Eliminar',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        Ext.MessageBox.confirm('Confirmación de Eliminación', 'Está seguro que desea anular el registro?', function (choice) {
                                            if (choice == 'yes') {
                                                Ext.Ajax.request({
                                                    waitMsg: 'Eliminando...',
                                                    url: prefijo + '/widgets5/eliminarParametroIdgClientes',
                                                    params: {
                                                        consecutivo: rec.data.consecutivo
                                                    },
                                                    failure: function (response, options) {
                                                        Ext.MessageBox.alert("Mensaje", 'Se presento un error Eliminando el registro.<br>' + response.errorInfo);
                                                        success = false;
                                                    },
                                                    success: function (response, options) {
                                                        var res = Ext.JSON.decode(response.responseText);
                                                        if (res.success) {
                                                            grid.getStore().reload();
                                                            //store = storeInfoFinanciera;
                                                            //store.reload();
                                                            Ext.MessageBox.alert("Mensaje", 'Registro eliminado correctamente.<br>');
                                                        } else {
                                                            Ext.MessageBox.alert("Mensaje", 'Se presento un error eliminando los registros.<br>' + res.responseInfo);
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    }
                                }]
                        }
                    ]
                    );

        }
    }
});
