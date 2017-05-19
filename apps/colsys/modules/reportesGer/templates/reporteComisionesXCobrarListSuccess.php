<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$incoterms = $sf_data->getRaw("incoterms");
?>
<script type="text/javascript">
    var win=null;

    Ext.onReady(function() {
        var checkColumn = new Ext.grid.CheckColumn({header: ' ', dataIndex: 'sel', width: 30});

        var summary = new Ext.ux.grid.GroupSummary();
        
        this.columns = [
            {
                header: "Referencia",
                dataIndex: 'ca_referencia',
                sortable: true,
                width: 95,
                renderer: function(value) {
                    myURL = '';
                    if (value !== '') {
                        myURL = '<a href="/colsys_php/inosea.php?boton=Consultar&id=' + value + '" target="_blank">' + value + '</a>';
                    }
                    return myURL;
                }
            }, {
                header: "Cliente",
                dataIndex: 'ca_compania',
                sortable: true,
                width: 180
            }, {
                header: "Doc.Transporte",
                dataIndex: 'ca_hbls',
                sortable: true,
                width: 100
            }, {
                header: "Término de Neg.",
                dataIndex: 'ca_incoterms',
                sortable: true,
                width: 90
            }, {
                header: "Factura",
                dataIndex: 'ca_factura',
                sortable: true,
                width: 70
            }, {
                header: "Fecha Fac.",
                dataIndex: 'ca_fchfactura',
                sortable: true,
                width: 70
            }, {
                header: "Valor",
                dataIndex: 'ca_valor',
                sortable: true,
                align: 'right',
                renderer: Ext.util.Format.usMoney,
                width: 85
            }, {
                header: "Rec.Caja",
                dataIndex: 'ca_reccaja',
                sortable: true,
                width: 70
            }, {
                header: "Fch.Pago",
                dataIndex: 'ca_fchpago',
                sortable: true,
                width: 70
            }, {
                header: "Estado Caso",
                dataIndex: 'ca_estado',
                sortable: true,
                width: 60
            }, {
                header: "Fch.Cerrado",
                dataIndex: 'ca_fchcerrado',
                sortable: true,
                width: 70
            }, {
                header: "Est.Circular",
                dataIndex: 'ca_stdcircular',
                sortable: true,
                width: 60
            }, {
                header: "Vendedor",
                dataIndex: 'ca_login',
                sortable: true,
                width: 80
            }, {
                header: "Sucursal",
                dataIndex: 'ca_sucursal',
                sortable: true,
                width: 60
            }, {
                header: "Comisión Causada",
                dataIndex: 'ca_vlrcomisiones_caus',
                sortable: true,
                align: 'right',
                summaryType: 'sum',
                renderer: Ext.util.Format.usMoney,
                width: 85
            }, {
                header: "Sobreventa Causada",
                dataIndex: 'ca_sbrcomisiones_caus',
                sortable: true,
                align: 'right',
                summaryType: 'sum',
                renderer: Ext.util.Format.usMoney,
                width: 85
            }, {
                header: "Dif.Comisión",
                dataIndex: 'ca_corrientes_dif',
                sortable: true,
                align: 'right',
                summaryType: 'sum',
                renderer: Ext.util.Format.usMoney,
                width: 85
            }, {
                header: "Dif.Sobreventa",
                dataIndex: 'ca_sobreventa_dif',
                sortable: true,
                align: 'right',
                summaryType: 'sum',
                renderer: Ext.util.Format.usMoney,
                width: 85
            },
            checkColumn
        ];

        this.record = Ext.data.Record.create([
            {name: 'ca_oid', type: 'boolean'},
            {name: 'sel', type: 'bool', value: 0},
            {name: 'ca_idinocliente', type: 'string'},
            {name: 'ca_referencia', type: 'string'},
            {name: 'ca_compania', type: 'string'},
            {name: 'ca_hbls', type: 'string'},
            {name: 'ca_incoterms', type: 'string'},
            {name: 'ca_factura', type: 'string'},
            {name: 'ca_fchfactura', type: 'string'},
            {name: 'ca_valor', type: 'float'},
            {name: 'ca_reccaja', type: 'string'},
            {name: 'ca_fchpago', type: 'string'},
            {name: 'ca_estado', type: 'string'},
            {name: 'ca_fchcerrado', type: 'string'},
            {name: 'ca_stdcircular', type: 'string'},
            {name: 'ca_login', type: 'string'},
            {name: 'ca_sucursal', type: 'string'},
            {name: 'ca_vlrcomisiones_caus', type: 'float'},
            {name: 'ca_sbrcomisiones_caus', type: 'float'},
            {name: 'ca_corrientes_dif', type: 'float'},
            {name: 'ca_sobreventa_dif', type: 'float'}
        ]);

        // define a custom summary function
        /*
         Ext.ux.grid.GroupSummary.Calculations['totalCaValor'] = function(v, record, field) {
         return v + (ca_valor);
         };*/
        
        this.store = new Ext.data.GroupingStore({
            autoLoad: true,
            url: '<?= url_for("reportesGer/datosComisionesXCobrar") ?>',
            baseParams: {
                anio: '<?= $anio ?>',
                mes: '<?= $mes ?>',
                sucursal: '<?= $sucursal ?>',
                usuario: '<?= $usuario ?>',
                circular: '<?= $circular ?>',
                resultado: '<?= $resultado ?>',
                casos: '<?= $casos ?>',
                incoterms: '<?= json_encode($incoterms) ?>'
            },
            reader: new Ext.data.JsonReader(
                    {
                        root: 'root',
                        totalProperty: 'total'
                    },
            this.record),
            sortInfo: {field: 'ca_referencia', direction: 'ASC'},
            groupField: 'ca_login'
        });
        
        // Loading Mask
        new Ext.LoadMask(Ext.getBody(),{msg:'Cargando informe...', store: this.store});

        this.gridComisiones = new Ext.grid.EditorGridPanel({
            id: 'gridComisiones',
            title: 'Comisiones Pendientes por Cobrar',
            autoHeight: "auto",
            width: 1800,
            bodyStyle: "pading: 5px",
            store: store,
            colModel: new Ext.grid.ColumnModel({
                defaults: {
                    width: 120,
                    sortable: true
                },
                columns: columns
            }),
            tbar: [{
                id: 'regresarbtn',
                text: 'Volver al menú inicial',
                iconCls: 'new-tab',
                handler: function(){
                    window.location = '/reportesGer/reporteComisionesXCobrar';
                }
            },{
                id: 'recargarbtn',
                text: 'Recargar el Informe',
                iconCls: 'refresh',
                handler: function(){
                    var grid = Ext.getCmp("gridComisiones");
                    var store = grid.getStore();
                    store.reload();
                }            
            },{
                id: 'liquidarbtn',
                text: 'Generar Comprobante Ajuste',
                iconCls: 'page_white_edit',
                handler: function(){
                    var box = Ext.MessageBox.wait('Procesando', 'Buscando Registros');
                    var records = this.store.getModifiedRecords();
                    var lenght = records.length;
                    var count = 0;
                    for (var i = 0; i < lenght; i++) {
                        if (records[i].data.sel)
                            count++;
                    }
                    console.log(count);
                    if(count > 0) {
                        if(win== null) {
                            win = new Ext.Window({
                                id: 'winComprobante',
                                width: 870,
                                height: 400,
                                //closeable: true,
                                closeAction: 'hide',
                                //plain: true,
                                items: new Ext.grid.EditorGridPanel({
                                    id: 'gridComprobante',
                                    clicksToEdit: 1,
                                    width: 850,
                                    height: 400,
                                    columns: [
                                        new Ext.grid.RowNumberer(),
                                        {
                                            header: "Referencia",
                                            dataIndex: 'ca_referencia',
                                            sortable: true,
                                            width: 110,
                                        }, {
                                            header: "Cliente",
                                            dataIndex: 'ca_compania',
                                            sortable: true,
                                            width: 180
                                        }, {
                                            header: "Doc.Transporte",
                                            dataIndex: 'ca_hbls',
                                            sortable: true,
                                            width: 100
                                        }, {
                                            header: "Término de Neg.",
                                            dataIndex: 'ca_incoterms',
                                            sortable: true,
                                            width: 90
                                        }, {
                                            header: "Vendedor",
                                            dataIndex: 'ca_login',
                                            sortable: true,
                                            width: 80
                                        }, {
                                            header: "Sucursal",
                                            dataIndex: 'ca_sucursal',
                                            sortable: true,
                                            width: 60
                                        }, {
                                            header: "Comisión Referencia",
                                            dataIndex: 'ca_corrientes_dif',
                                            sortable: true,
                                            selectOnFocus: true,
                                            renderer: Ext.util.Format.usMoney,
                                            align: 'right',
                                            editor: new Ext.form.NumberField(),
                                            width: 85
                                        }, {
                                            header: "Comisión Sobreventa",
                                            dataIndex: 'ca_sobreventa_dif',
                                            sortable: true,
                                            selectOnFocus: true,
                                            renderer: Ext.util.Format.usMoney,
                                            align: 'right',
                                            editor: new Ext.form.NumberField(),
                                            width: 85
                                        }
                                    ],
                                    store: new Ext.data.ArrayStore({
                                        fields: this.record
                                    }),
                                    listeners: {
                                        'render': function(component) {
                                            var me = this;
                                            var grid = Ext.getCmp("gridComisiones");
                                            grid.getStore().each(function (record, idx) {
                                                if (record.get('sel')){
                                                    me.store.insert(me.store.getCount(), record);
                                                }
                                            });
                                        }
                                    }
                                }),
                                buttons: [{
                                    text: 'Aplicar Comprobante',
                                    handler: function () {
                                        Ext.Msg.show({
                                            title:'Aplicación Comprobante de Ajuste',
                                            msg: '¿Está seguro que desea aplicar el comprobante de ajuste con los registros seleccionados?',
                                            buttons: Ext.Msg.YESNO,
                                            fn: function(btn, text) {
                                                if (btn == "yes") {
                                                    var grid = Ext.getCmp("gridComprobante");
                                                    var store = grid.getStore();
                                                    var records = store.getModifiedRecords();
                                                    var lenght = records.length;

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
                                                            url: '<?= url_for("reportesGer/guardarComprobanteAjuste") ?>',
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
                                                                Ext.getCmp("gridComisiones").getStore().reload();
                                                                Ext.getCmp("winComprobante").close();
                                                                win = null;
                                                            }
                                                        });
                                                    }
                                                }
                                            },
                                            animEl: 'elId'
                                        });
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
                        box.hide();
                        win.show();
                    }else{
                        Ext.Msg.alert('Error', 'Debe seleccionar por lo menos un registro, para elaborar el comprobante de ajuste!');
                    }
                },
                scope: this
            }],
            plugins: [
                checkColumn,
                summary
            ],
            view: new Ext.grid.GroupingView({
                forceFit: true,
                showGroupName: false,
                enableNoGroups: false,
                enableGroupingMenu: false,
                hideGroupedColumn: true
            })
        });
        gridComisiones.render("main-panel");
    });

</script>


<div class="content">    
    <div id="main-panel"></div>
</div>