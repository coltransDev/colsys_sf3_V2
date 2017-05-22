winrepgastos = null;
comboBoxRenderer = function (combo) {
    return function (value) {

        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField));
    };
};


Ext.define('Colsys.Ino.GridConceptosFact', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridConceptosFact',
    width: 840,
    autoHeight: true,
    selModel: {
        selType: 'cellmodel'
    },
    features: [{
            id: 'comprobante',
            ftype: 'groupingsummary',
            collapseTip: 'Click para minimizar',
            expandTip: 'Click para expandir',
            //hideGroupedHeader: true,
            totalSummary: 'fixed', // Can be: 'fixed', true, false. Default: false
            totalSummaryTopLine: true, // Default: true
            totalSummaryColumnLines: true // Default: false


        }],
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    frame: true,
    listeners: {
        beforeedit: function( plugin, e )
        {            
            var rec = e.record;
            
            //console.log(this.idsucursal);
            if(rec.data.estado>0)
                return false;
            if(e.field=="concepto")
            {                
                //alert(rec.data.toSource());
                if(this.idsucursal=="")
                {   
                   // eval("idcom=rec.data.idcomprobante");                
                    //Ext.getCmp("combo-conceptos").setModo('6',idcom);
                }
                else
                {
                    //console.log("54");
                    if(this.reloadCombo)
                    {
                        Ext.getCmp("combo-conceptos").getStore().reload({params:{"idcc":this.idcc  }});
                        this.reloadCombo=false;
                    }
                }
                
            }
        },
        afterrender: function (ct, position) {
            //alert(this.idhouse);
            if (this.load == false || this.load == "undefined" || !this.load)
            {
                idcompr = this.idcomprobante;
                this.store.proxy.extraParams = {
                    idcomprobante: idcompr
                }
                this.store.reload({
                    callback: function (options, success, response) {
                        var res = Ext.util.JSON.decode(response.responseText);
                        if (Ext.getCmp('combo-conceptos')) {
                            Ext.getCmp('combo-conceptos').getStore().reload({
                                params: {
                                    transporte: this.idtransporte,
                                    impoexpo: this.idimpoexpo,
                                    idcomprobante: idcompr
                                }
                            });
                        }
                        //console.log(Ext.getCmp('venfac'));

                    }
                });
                this.load = true;
            }
            tb = new Ext.toolbar.Toolbar();
            tb.add(
                    [
                        {
                            text: 'Guardar',
                            iconCls: 'add',
                            id: 'btn-guardar' + this.idcomprobante,
                            handler: function () {
                                error = 0;
                                b = this;
                                b.disable();

                                var store = this.up('grid').getStore();
                                idmaster = this.up('grid').idmaster;


                                var records = this.up('grid').getStore().getModifiedRecords();
                                var lenght = records.length;

                                changes = [];


                                for (var j = 0; j < lenght; j++) {
                                   // alert(records[j].data.concepto);
                                    for (var i = 0; i < store.getCount(); i++) {
                                        var recordstore = store.getAt(i);

                                        if ((recordstore.data.idconcepto == records[j].data.concepto) && records[j].data.concepto != "") {
                                            error++;
                                        }
                                    }
                                    records[j].data.id = recordstore.data.id;
                                    changes[j] = records[j].data;
                                }

                                var str = JSON.stringify(changes);
                                if (error == 0)
                                {
                                    var box = Ext.MessageBox.wait('Procesando', 'Guardando Informacion')
                                    Ext.Ajax.request({
                                        url: '/inoF2/guardarGridFacturacion',
                                        params: {
                                            datos: str
                                        },
                                        success: function (response, opts) {
                                            var res = Ext.decode(response.responseText);

                                            if (res.id && res.success)
                                            {
                                                id = res.id.split(",");
                                                idreg = res.idreg.split(",");
                                                for (i = 0; i < id.length; i++)
                                                {
                                                    var rec = store.getById(id[i]);
                                                    rec.set("iddetalle" + this.idcomprobante, idreg[i]);
                                                    rec.commit();
                                                }
                                                alert('Se guardo Correctamente la informacion');
                                                store.reload();
                                            }
                                            if (res.errorInfo != "")
                                            {
                                                alert('No fue posible el guardar la fila <br>' + res.errorInfo);
                                            }

                                            Ext.getCmp('panel-factura-' + idmaster).getStore().reload();
                                            box.hide();
                                            b.enable();

                                        },
                                        failure: function (response, opts) {
                                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                            box.hide();

                                            b.enable();
                                        }
                                    });
                                } else {
                                    b.enable();
                                    if (error != 0)
                                        Ext.MessageBox.alert("Colsys", "No se deben repetir conceptos, imposible guardar");

                                }
                            }
                        }, {
                            text: 'Importar',
                            iconCls: 'import',
                            id: 'btn-importar' + this.idcomprobante,
                            handler: function () {
                                house = this.up('grid').idhouse;
                                master = this.up('grid').idmaster;
                                idcomprobante = this.up('grid').idcomprobante;
                                if (winrepgastos == null) {
                                    winrepgastos = new Ext.Window({
                                        //title: 'Deducciones',
                                        width: 670,
                                        id: 'repgastos' + house,
                                        height: 400,
                                        items: {
                                            xtype: 'Colsys.Ino.GridRepGastos',
                                            idhouse: house,
                                            idmaster: master,
                                            idcomprobante: idcomprobante
                                        },
                                        listeners: {
                                            close: function (win, eOpts) {
                                                winrepgastos = null;
                                            }
                                        }
                                    })
                                }
                                winrepgastos.show();
                            }
                        }, {
                            text: 'Eliminar',
                            iconCls: 'delete',
                            id: 'btn-eliminar' + this.idcomprobante,
                            handler: function () {
                                arrayeliminar = [];
                                var store = this.up('grid').getStore();
                                for (var i = 0; i < store.getCount(); i++) {
                                    record = store.getAt(i);
                                    if (record.get('active') == true) {
                                        arrayeliminar[i] = record.data;
                                    }
                                }
                                if (arrayeliminar.length > 0) {
                                    var str = JSON.stringify(arrayeliminar);
                                    Ext.Ajax.request({
                                        url: '/inoF2/eliminarGridFacturacion',
                                        params: {
                                            datos: str
                                        },
                                        success: function (response, opts) {
                                            var res = Ext.decode(response.responseText);

                                            if (res.success)
                                            {
                                                Ext.MessageBox.alert("Colsys", "Conceptos Eliminados Correctamente");
                                                store.reload();
                                            } else {
                                                Ext.MessageBox.alert("Colsys", "Error al eliminar");
                                            }

                                            Ext.getCmp('panel-factura-' + idmaster).getStore().reload();

                                        },
                                        failure: function (response, opts) {
                                            Ext.MessageBox.alert("Colsys", "Error al eliminar");
                                        }
                                    });
                                }

                            }
                        }
                    ]
                    );

            this.addDocked(tb);
        },
        edit: function (editor, e, eOpts)
        {

            var store = this.getStore();

            if (e.field == "concepto")
            {
                //alert(editor.editors.items[0].field.rawValue);
                //alert(e.value);
                //  store.data.items[e.rowIdx].set('idconcepto', e.value);
                //store.data.items[e.rowIdx].set('concepto', editor.editors.items[0].field.rawValue);

                record = e.record;
                var records = store.getRange();
                recordLast = records[records.length - 1];
                if (recordLast.get("concepto") != 0)
                {
                    var r = Ext.create(store.getModel());
                    r.set('comprobante', record.get('comprobante'));
                    r.set('idcomprobante', record.get('idcomprobante'));
                    r.set('idhouse', record.get('idhouse'));
                    r.set('idccosto', record.get('idccosto'));
                    store.insert(0, r);
                    this.view.refresh();
                    this.getSelectionModel().setCurrentPosition({row: store.getCount(), column: 1});

                   

                }
            }
        },        
        beforerender: function (ct, position) {
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'iddetalle', mapping: 'iddetalle', type: 'int'},
                            {name: 'idhouse', mapping: 'idhouse', type: 'int'},
                            {name: 'idcomprobante', mapping: 'idcomprobante', type: 'int'},
                            {name: 'comprobante', mapping: 'comprobante', type: 'string'},
                            {name: 'fchcomprobante', mapping: 'fchcomprobante', type: 'date', dateFormat: 'Y-m-d'},
                            {name: 'cliente', mapping: 'cliente', type: 'string'},
                            {name: 'doctransporte', mapping: 'doctransporte', type: 'string'},
                            {name: 'idmoneda', mapping: 'idmoneda', type: 'int'},
                            {name: 'moneda', mapping: 'moneda', type: 'string'},
                            {name: 'valor', mapping: 'valor', type: 'float'},
                            {name: 'idconcepto', mapping: 'idconcepto', type: 'int'},
                            {name: 'concepto', mapping: 'concepto', type: 'string'},
                            {name: 'cuentapago', mapping: 'cuentapago', type: 'string'},
                            {name: 'estado', mapping: 'estado', type: 'int'},
                            {name: 'idccosto', mapping: 'idccosto', type: 'int'},
                            {name: 'active', type: 'bool'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/inoF2/datosConceptosFact',
                            //extraParams:{'idcomprobante':this.idcomprobante},
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        },
                        groupField: 'comprobante',
                        sorters: [{
                                property: 'comprobante',
                                direction: 'ASC'
                            }],
                        autoLoad: false
                    }),
                    [
                        {
                            id: 'comprobante',
                            //header: 'No factura',
                            dataIndex: 'comprobante',
                            flex: 1,
                            hidden: true

                        },
                        {
                            xtype: 'checkcolumn',
                            header: '',
                            dataIndex: 'active',
                            width: 40,
                            editor: {
                                xtype: 'checkbox',
                                cls: 'x-grid-checkheader-editor'
                            }
                        },
                        /*{
                         header: 'Valor',
                         dataIndex: 'aa',
                         width: 120,
                         align: 'right',
                         editor: {
                         xtype: 'textfield',
                         allowBlank: false,
                         minValue: 0,
                         selectOnFocus: true
                        
                         }
                         },*/
                        {
                            header: 'Concepto',
                            dataIndex: 'concepto',
                            width: 250,
                            editor:
                                    Ext.create('Colsys.Widgets.wgConceptosSiigo', {
                                        id: 'combo-conceptos',
                                        /*triggerAction: 'all',
                                        typeAhead: true,
                                        mode: 'remote',
                                        minChars: 2,
                                        forceSelection: true,*/
                                        //hideTrigger: true,
                                        name: 'combo-conceptos',
                                        selectOnFocus: true,
                                        idtransporte: this.idtransporte,
                                        idimpoexpo: this.idimpoexpo,
                                        selectOnFocus: true,
                                                listeners: {
                                                    /* select: function ( combo , record , eOpts ) {
                                                     var grid = this.up('grid').view;
                                                     selModel = grid.getSelectionModel();
                                                     selModel.setPosition({row: 3, column: 2}, false);
                                                     var pos = selModel.getPosition();
                                                     grid.focusCell(pos);
                                                    
                                                     }*/
                                                }

                                    }),
                            renderer: comboBoxRenderer(Ext.getCmp('combo-conceptos')),
                            summaryRenderer: function (value, summaryData, dataIndex) {
                                return "<b>Total</b>";
                            },
                        },
                        {
                            header: 'Valor',
                            dataIndex: 'valor',
                            width: 120,
                            align: 'right',
                            renderer: Ext.util.Format.usMoney,
                            editor: {
                                xtype: 'numberfield',
                                allowBlank: false,
                                minValue: 0,
                                selectOnFocus: true,
                                listeners: {
                                    blur: function (me, event, eOpts) {
                                        //this.up("grid").view.refresh();
                                        //Ext.getCmp("conceptosfac").getView().focusRow(1);
                                        //Ext.getCmp("conceptosfac").getSelectionModel().setCurrentPosition({row: 0, column: 1});
                                        //Ext.getCmp("conceptosfac").startEditing(0, 1);
                                        //Ext.getCmp("conceptosfac").cellEditing.startEditByPosition({row: 0, column: 1});
                                    }
                                }
                                //,maxValue: 100000
                            },
                            renderer: function (value, metaData, record, rowIdx, colIdx, store, view) {
                                return Ext.util.Format.usMoney(record.get('valor'));
                            },
                                    summaryType: function (records, values) {
                                        var i = 0,
                                                length = records.length,
                                                total = 0,
                                                record;
                                        for (; i < length; ++i) {
                                            record = records[i];
                                            total += record.get('valor');
                                        }
                                        return total;
                                    },
                            summaryRenderer: Ext.util.Format.usMoney


                        }
                    ]

                    );
        },
        setIdCc: function (idcc)
        {            
            if(this.idcc==idcc)
                this.reloadCombo=false;
            else
                this.reloadCombo=true;
            this.idcc=idcc;
            //Ext.getCmp("combo-conceptos").getStore().reload({params:{"idcc":this.idcc  }});
        },
        setIdComprobante: function (idcomprobante)
        {
            //alert(idcomprobante);
            this.idcomprobantegrid=idcomprobante;
                //alert(this.idcomprobantegrid);
            //Ext.getCmp("combo-conceptos").getStore().reload({params:{"idcc":this.idcc  }});
        }
    }
});






