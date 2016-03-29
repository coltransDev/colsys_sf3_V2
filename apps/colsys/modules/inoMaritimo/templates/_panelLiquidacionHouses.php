<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$costos = $sf_data->getRaw("costos");
$noeditable = $sf_data->getRaw("noeditable");
?>

<script type="text/javascript">
    var win=null;
    
    // utilize custom extension for Group Summary
    var summary = new Ext.ux.grid.GroupSummary();
    
    PanelLiquidaHouses = function (config) {

        Ext.apply(this, config);

        this.costos = <?= json_encode(array("root" => $costos)) ?>;

        this.checkColumn = new Ext.grid.CheckColumn({header: ' ', dataIndex: 'sel', width: 30});

        this.editorIdCostos = new Ext.form.ComboBox({
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            selectOnFocus: true,
            mode: 'local',
            lazyRender: true,
            valueField: 'idcosto',
            displayField: 'costo',
            forceSelection: true,
            selectOnFocus: true,
            store: new Ext.data.Store({
                autoLoad: true,
                proxy: new Ext.data.MemoryProxy(this.costos),
                reader: new Ext.data.JsonReader(
                        {
                            root: 'root',
                            totalProperty: 'total',
                            successProperty: 'success'
                        },
                Ext.data.Record.create([
                    {name: 'idcosto'},
                    {name: 'costo'}
                ])
                        )
            }),
            onSelect: function(record, index){ // override default onSelect to do redirect
                if(this.fireEvent('beforeselect', this, record, index) !== false){
                    this.setValue(record.data[this.displayField || this.valueField]);
                    this.collapse();
                    this.fireEvent('select', this, record, index);
                }
                this.gridEditor.record.data['idcosto'] = record.get('idcosto');
            }
        });

        this.columns = [
            new Ext.grid.RowNumberer(),
            {
                header: "Referencia",
                dataIndex: 'referencia',
                hideable: false,
                sortable: true,
                width: 50
            }, {
                header: "N.i.t.",
                dataIndex: 'idcliente',
                hideable: false,
                sortable: true,
                width: 50
            },
            {
                header: "Cliente",
                dataIndex: 'cliente',
                hideable: false,
                sortable: true,
                width: 150
            },
            {
                header: "HBL",
                dataIndex: 'hbl',
                hideable: false,
                sortable: true,
                width: 50
            }, {
                header: "Facturación",
                dataIndex: 'factura_vlr',
                hideable: false,
                sortable: true,
                width: 40,
                renderer: Ext.util.Format.usMoney,
                align: 'right',
                editor: new Ext.form.NumberField(),
                summaryType: 'sum',
                summaryRenderer: Ext.util.Format.usMoney
            }, {
                header: "Costos Prepaid",
                dataIndex: 'prepaid_vlr',
                hideable: false,
                sortable: true,
                width: 40,
                renderer: Ext.util.Format.usMoney,
                align: 'right',
                editor: new Ext.form.NumberField(),
                summaryType: 'sum',
                summaryRenderer: Ext.util.Format.usMoney
            }, {
                header: "Utilidad",
                dataIndex: 'valor',
                hideable: false,
                sortable: true,
                width: 40,
                renderer: Ext.util.Format.usMoney,
                align: 'right',
                editor: new Ext.form.NumberField(),
                summaryType: 'sum',
                summaryRenderer: Ext.util.Format.usMoney
            }
        ];
        this.record = Ext.data.Record.create([
            {name: 'referencia', type: 'string', mapping: 'ca_referencia'},
            {name: 'idinocliente', type: 'integer', mapping: 'ca_idinocliente'},
            {name: 'idcliente', type: 'integer', mapping: 'ca_idcliente'},
            {name: 'cliente', type: 'string', mapping: 'ca_cliente'},
            {name: 'hbl', type: 'string', mapping: 'ca_hbl'},
            {name: 'prepaid_vlr', type: 'float', mapping: 'ca_prepaid_vlr'},
            {name: 'factura_vlr', type: 'float', mapping: 'ca_factura_vlr'},
            {name: 'valor', type: 'float', mapping: 'ca_valor'},
            {name: 'usucerrado', type: 'string', mapping: 'ca_usucerrado'}
        ]);
        this.recordPrm = new Ext.data.Record.create([
            {name: 'idparametro', type: 'integer', mapping: 'ca_idparametro'},
            {name: 'referencia', type: 'string', mapping: 'ca_referencia'},
            {name: 'idcosto', type: 'integer', mapping: 'ca_idcosto'},
            {name: 'costo', type: 'string', mapping: 'ca_costo'},
            {name: 'tipo', type: 'string', mapping: 'ca_tipo'},
            {name: 'aplicacion', type: 'string', mapping: 'ca_aplicacion'},
            {name: 'valor', type: 'string', mapping: 'ca_valor'},
            {name: 'sel', type: 'boolean'}
        ]);
        this.recordLiq = new Ext.data.Record.create([
            {name: 'idinocliente', type: 'integer', mapping: 'ca_idinocliente'},
            {name: 'caso', type: 'string', mapping: 'ca_caso'},
            {name: 'costo', type: 'string', mapping: 'ca_costo'},
            {name: 'aplicacion', type: 'string', mapping: 'ca_aplicacion'},
            {name: 'multiplicando', type: 'float', mapping: 'ca_multiplicando'},
            {name: 'multiplicador', type: 'float', mapping: 'ca_multiplicador'},
            {name: 'valor', type: 'float', mapping: 'ca_valor'}
        ]);

        this.store = new Ext.data.GroupingStore({
            autoLoad: true,
            url: '<?= url_for("inoMaritimo/datosPanelLiquidacionHouse") ?>',
            baseParams: {
                numRef: '<?= $numRef ?>'
            },
            reader: new Ext.data.JsonReader(
                    {
                        root: 'root',
                        totalProperty: 'total'
                    },
            this.record),
            sortInfo: {field: 'hbl', direction: "ASC"},
            //groupField: 'referencia',
        });
        this.tbar = [
            {
                id: 'importarbtn',
                text: 'Importar Bls',
                iconCls: 'import',
                handler: this.importar,
                scope: this,
                disabled: <?=$noeditable?>
            }, {
                id: 'parametrosbtn',
                text: 'Parámetros',
                iconCls: 'page_white_edit',
                handler: this.parametros,
                scope: this,
                disabled: <?=$noeditable?>
            }, {
                id: 'liquidarbtn',
                text: 'Liquidar',
                iconCls: 'page_white_params',
                handler: this.liquidar,
                scope: this
            }
        ];
        PanelLiquidaHouses.superclass.constructor.call(this, {
            clicksToEdit: 1,
            stripeRows: true,
            loadMask: {msg: 'Cargando...'},
            id: 'listado-referencias',
            plugins: summary,
            view: new Ext.grid.GroupingView({
                    forceFit: true,
                    showGroupName: false,
                    enableNoGroups: false,
                    enableGroupingMenu: false,
                    hideGroupedColumn: true
                }),
            buttons: [{
                text: 'Guardar',
                handler: function () {
                    var grid = Ext.getCmp("listado-referencias");
                    var store = grid.getStore();
                    var records = store.getModifiedRecords();
                    var lenght = records.length;

                    changes = [];
                    for (var i = 0; i < lenght; i++) {
                        r = records[i];
                        if (r.factura_vlr != "" && r.valor != "")
                        {
                            records[i].data.id = r.id;
                            changes[i] = records[i].data;
                        }
                    }
                    var str = JSON.stringify(changes);
                    if (str.length > 5) {
                        Ext.Ajax.request({
                            waitMsg: 'Guardando cambios...',
                            url: '<?= url_for("inoMaritimo/guardarDatosLiquidacionHouse") ?>',
                            params: {
                                datos: str
                            },
                            failure: function (response, options) {
                                var res = Ext.util.JSON.decode(response.responseText);
                                if (res.err)
                                    Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.err);
                                else
                                    Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                            },
                            success: function (response, options)
                            {
                                var res = Ext.util.JSON.decode(response.responseText);

                                if (res.id && res.success)
                                {
                                    id = res.id.split(",");
                                    for (i = 0; i < id.length; i++)
                                    {
                                        var rec = store.getById(id[i]);
                                        rec.commit();
                                    }
                                }
                                if (res.errorInfo)
                                {
                                    Ext.MessageBox.alert("Mensaje", 'No fue posible el guardar la fila <br>' + res.errorInfo);
                                }
                                else
                                {
                                    Ext.MessageBox.alert("Mensaje", 'Se guardo correctamente la informacion');
                                }
                            }
                        });
                    }
                }
            }, {
                text: 'Cancelar',
                handler: function () {
                    var grid = Ext.getCmp("listado-referencias");
                    var store = grid.getStore();
                    store.reload();
                }
            }]
        });
        
        var store = this.store;        
        this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
            var record = store.getAt(rowIndex);                        
            if(record.data.usucerrado){                
                return false;
            }
            return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);       
        }   
    };
    Ext.extend(PanelLiquidaHouses, Ext.grid.EditorGridPanel, {
        importar: function () {
            Ext.Msg.show({
                title:'Realizar Importación?',
                msg: 'Está seguro que desea importar la información de los Hbls?, esto sobreescribirá los registros anteriores.',
                buttons: Ext.Msg.YESNO,
                fn: function(btn, text) {
                    if (btn == "yes") {
                        Ext.Ajax.request({
                            waitMsg: 'Importando registros...',
                            url: '<?= url_for("inoMaritimo/importarDatosHouse") ?>',
                            params: {
                                numRef: '<?= $numRef ?>'
                            },
                            failure: function (response, options) {
                                var res = Ext.util.JSON.decode(response.responseText);
                                if (res.err)
                                    Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.err);
                                else
                                    Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                            },
                            success: function (response, options)
                            {
                                var grid = Ext.getCmp("listado-referencias");
                                var store = grid.getStore();
                                store.reload();
                            }
                        })                        
                    }
                },
                animEl: 'elId'
            });
        },
        parametros: function () {
            if(win== null)
            {
                win = new Ext.Window({
                    id: 'winParameters',
                    width: 870,
                    height: 400,
                    //closeable: true,
                    closeAction: 'hide',
                    //plain: true,
                    items: new Ext.grid.EditorGridPanel({
                        plugins: [this.checkColumn],
                        id: 'gridParameters',
                        clicksToEdit: 1,
                        width: 850,
                        height: 400,
                        columns: [
                            new Ext.grid.RowNumberer(),
                            {
                                header: "Referencia",
                                dataIndex: 'referencia',
                                hideable: false,
                                sortable: true,
                                width: 110
                            }, {
                                header: "Costo",
                                dataIndex: 'costo',
                                hideable: false,
                                sortable: true,
                                width: 290,
                                editor: this.editorIdCostos
                            }, {
                                header: "Tipo",
                                dataIndex: 'tipo',
                                hideable: false,
                                sortable: true,
                                width: 70,
                                editor: new Ext.form.ComboBox({
                                    typeAhead: true,
                                    forceSelection: true,
                                    triggerAction: 'all',
                                    selectOnFocus: true,
                                    listClass: 'x-combo-list-small',
                                    mode: 'local',
                                    store: [['CST', 'Costo'],['ING', 'Ingreso']]

                                })
                            }, {
                                header: "Aplicación",
                                dataIndex: 'aplicacion',
                                hideable: false,
                                sortable: true,
                                width: 110,
                                editor: new Ext.form.ComboBox({
                                    typeAhead: true,
                                    forceSelection: true,
                                    triggerAction: 'all',
                                    selectOnFocus: true,
                                    listClass: 'x-combo-list-small',
                                    mode: 'local',
                                    store: ['Valor Fijo', 'Valor Unitario M3', 'X Doc. Transporte', 'X Metro Cúbico']

                                })
                            }, {
                                header: "Valor",
                                dataIndex: 'valor',
                                hideable: false,
                                sortable: true,
                                width: 120,
                                selectOnFocus: true,
                                renderer: Ext.util.Format.usMoney,
                                align: 'right',
                                editor: new Ext.form.NumberField()
                            },
                            this.checkColumn
                        ],
                        store: new Ext.data.Store({
                            autoLoad: false,
                            url: '<?= url_for("inoMaritimo/datosGridParametrosLiquida") ?>',
                            baseParams: {
                                numRef: '<?= $numRef ?>'
                            },
                            reader: new Ext.data.JsonReader(
                                    {
                                        root: 'root',
                                        totalProperty: 'total'
                                    }, this.recordPrm),
                            sortInfo: {field: 'tipo', direction: "ASC"}
                        }),
                        tbar: [
                            {
                                id: 'addParametro',
                                text: 'Adicionar',
                                iconCls: 'add',
                                handler: function () {
                                    store = Ext.getCmp("gridParameters").getStore();
                                    var recordType = this.recordPrm;
                                    var record = new recordType({
                                        idparametro: '',
                                        referencia: '<?= $numRef ?>',
                                        idcosto: '',
                                        costo: '',
                                        tipo: '',
                                        aplicacion: '',
                                        valor: 0
                                    });
                                    store.insert(store.getCount(), record);
                                },
                                scope: this
                            }, {
                                id: 'delParametro',
                                text: 'Eliminar',
                                iconCls: 'delete',
                                handler: function() {
                                    Ext.MessageBox.confirm('Confirmacion', '¿Esta seguro de Eliminar los registros seleccionados?', 
                                    function(e){
                                        if(e == 'yes'){
                                            var box = Ext.MessageBox.wait('Procesando', 'Eliminando');
                                            var store = Ext.getCmp("gridParameters").getStore();
                                            var records = store.getModifiedRecords();
                                            var lenght = records.length;
                                            deletes = [];
                                            for (var i = 0; i < lenght; i++) {
                                                if (records[i].data.sel)
                                                {
                                                    deletes[i] = records[i].data;
                                                }
                                            }
                                            var str = JSON.stringify(deletes);

                                            Ext.Ajax.request({
                                                url: '<?=url_for("inoMaritimo/eliminarDatosParametros")?>',
                                                params :{
                                                    datos: str
                                                },
                                                success: function(response, opts) {
                                                    var obj = Ext.decode(response.responseText);                                        
                                                    if(obj.errorInfo!="")
                                                     {
                                                        Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                                     }
                                                    else
                                                    {
                                                        store = Ext.getCmp("gridParameters").getStore();
                                                        store.reload();
                                                    }
                                                    box.hide();
                                                },
                                                failure: function(response, opts) {
                                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                    box.hide();
                                                }
                                            });
                                        }
                                    })
                                },
                                scope: this
                            }
                        ],
                        validate: function () {
                            var grid = this, isValid = true;
                            grid.getStore().each(function (record, idx) {
                                if (record.get('costo') == '' || record.get('tipo') == '' || record.get('aplicacion') == '' || record.get('valor') == 0) {
                                    isValid = false;
                                }
                            })
                            return isValid;
                        },
                        listeners: {
                            afterrender: function () {
                                this.store.load();
                            }
                        }
                    }),
                    buttons: [{
                        text: 'Guardar',
                        handler: function () {
                            var grid = Ext.getCmp("gridParameters");
                            var store = grid.getStore();
                            var records = store.getModifiedRecords();
                            var lenght = records.length;
                            var idValid = grid.validate();
                            if (!idValid) {
                                Ext.MessageBox.alert("Error", "El cuadro tiene errores de validación");
                                return false;
                            }

                            changes = [];
                            for (var i = 0; i < lenght; i++) {
                                r = records[i];
                                if (r.costo != "")
                                {
                                    records[i].data.id = r.id;
                                    changes[i] = records[i].data;
                                }
                            }
                            var str = JSON.stringify(changes);
                            if (str.length > 5) {
                                Ext.Ajax.request({
                                    waitMsg: 'Guardando cambios...',
                                    url: '<?= url_for("inoMaritimo/guardarDatosParametros") ?>',
                                    params: {
                                        datos: str
                                    },
                                    failure: function (response, options) {
                                        var res = Ext.util.JSON.decode(response.responseText);
                                        if (res.err)
                                            Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.err);
                                        else
                                            Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                                    },
                                    success: function (response, options)
                                    {
                                        var res = Ext.util.JSON.decode(response.responseText);

                                        if (res.id && res.success)
                                        {
                                            id = res.id.split(",");
                                            for (i = 0; i < id.length; i++)
                                            {
                                                var rec = store.getById(id[i]);
                                                rec.commit();
                                            }
                                        }
                                        if (res.errorInfo)
                                        {
                                            Ext.MessageBox.alert("Mensaje", 'No fue posible el guardar la fila <br>' + res.errorInfo);
                                        }
                                        else
                                        {
                                            Ext.MessageBox.alert("Mensaje", 'Se guardo correctamente la informacion');
                                        }
                                    }
                                });
                            }
                        }
                    }, {
                        text: 'Cancelar',
                        handler: function () {
                            this.findParentByType( 'window' ).close();
                            win = null;
                        }
                    }]
                });
            }
            win.show();
        },
        liquidar: function () {
            if(win== null)
            {
                win = new Ext.Window({
                    id: 'winLiquidacion',
                    width: 870,
                    height: 400,
                    //closeable: true,
                    closeAction: 'hide',
                    //plain: true,
                    items: new Ext.grid.EditorGridPanel({
                        id: 'gridLiquidacion',
                        plugins: summary,
                        view: new Ext.grid.GroupingView({
                            forceFit: true,
                            showGroupName: false,
                            enableNoGroups: false,
                            enableGroupingMenu: false,
                            hideGroupedColumn: true
                        }),
                        width: 850,
                        height: 400,
                        columns: [
                            new Ext.grid.RowNumberer(),
                            {
                                header: "Hbl",
                                dataIndex: 'caso',
                                hideable: false,
                                sortable: true,
                                width: 200
                            }, {
                                header: "Costo",
                                dataIndex: 'costo',
                                hideable: false,
                                sortable: true,
                                width: 200,
                                summaryType: 'count',
                                hideable: false,
                                summaryRenderer: function(v, params, data){
                                    return ((v === 0 || v > 1) ? '<b>(' + v +' Conceptos)</b>' : '<b>(1 Concepto)</b>');
                                },
                            }, {
                                header: "Aplicación",
                                dataIndex: 'aplicacion',
                                hideable: false,
                                sortable: true,
                                width: 110
                            }, {
                                header: "Base",
                                dataIndex: 'multiplicando',
                                hideable: false,
                                sortable: true,
                                width: 60,
                                align: 'right',
                            }, {
                                header: "Tarifa",
                                dataIndex: 'multiplicador',
                                hideable: false,
                                sortable: true,
                                width: 120,
                                renderer: Ext.util.Format.usMoney,
                                align: 'right',
                            }, {
                                header: "Valor",
                                dataIndex: 'valor',
                                hideable: false,
                                sortable: true,
                                width: 120,
                                renderer: Ext.util.Format.usMoney,
                                align: 'right',
                                summaryType: 'sum',
                                // summaryRenderer: Ext.util.Format.usMoney
                                summaryRenderer: function(v, params, data){
                                    var v = '<b>Sub total: ' + Ext.util.Format.usMoney(v) + '</b>';
                                    return v;
                                }
                            }
                        ],
                        store: new Ext.data.GroupingStore({
                            autoLoad: true,
                            url: '<?= url_for("inoMaritimo/datosGridLiquidarReferencia") ?>',
                            baseParams: {
                                numRef: '<?= $numRef ?>'
                            },
                            reader: new Ext.data.JsonReader(
                                    {
                                        root: 'root',
                                        totalProperty: 'total'
                                    }, this.recordLiq),
                            sortInfo: {field: 'caso', direction: "ASC"},
                            groupField: 'caso'
                        }),
                        tbar: [
                            {
                                id: 'aplLiquidacion',
                                text: 'Aplicar Liquidación',
                                iconCls: 'disk',
                                handler: function() {
                                    Ext.MessageBox.confirm('Confirmacion', '¿Esta seguro que desea Aplicar la Liquidación?', 
                                    function(e){
                                        if(e == 'yes'){
                                            var box = Ext.MessageBox.wait('Procesando', 'Aplicando liquidación');
                                            var store = Ext.getCmp("gridLiquidacion").getStore();
                                            var records = store.getRange();
                                            var lenght = records.length;
                                            liquida = [];
                                            for (var i = 0; i < lenght; i++) {
                                                liquida[i] = records[i].data;
                                            }
                                            var str = JSON.stringify(liquida);

                                            Ext.Ajax.request({
                                                url: '<?=url_for("inoMaritimo/aplicarLiquidacionHouse")?>',
                                                params :{
                                                    datos: str
                                                },
                                                success: function(response, opts) {
                                                    var obj = Ext.decode(response.responseText);                                        
                                                    if(obj.errorInfo!="") {
                                                        Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                                    } else {
                                                        var grid = Ext.getCmp("listado-referencias");
                                                        var store = grid.getStore();
                                                        store.reload();
                                                    }
                                                    box.hide();
                                                },
                                                failure: function(response, opts) {
                                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                    box.hide();
                                                }
                                            });
                                        }
                                    })
                                },
                                scope: this
                            }
                        ]                        
                    }),
                    buttons: [{
                        text: 'Salir',
                        handler: function () {
                            this.findParentByType( 'window' ).close();
                            win = null;
                        }
                    }]
                });
            }
            win.show();
        }
    });
</script>
