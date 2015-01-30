<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$header = $sf_data->getRaw("header");
$container = $sf_data->getRaw("container");
$invoices = $sf_data->getRaw("invoices");

include_component("widgets", "widgetReporte");
?>
<script type="text/javascript">

    var ds = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?= url_for('widgets/listaIdsJSON') ?>'
        }),
        reader: new Ext.data.JsonReader({
            root: 'root',
            totalProperty: 'totalCount'
        }, [
            {name: 'id', mapping: 'ca_id'},
            {name: 'nombre', mapping: 'ca_nombre'}
        ])
    });



    var resultTpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><b>{nombre}</b></div></tpl>'
            );
    var storeTiposTpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><b>{tipo}</b></div></tpl>'
            );

    MainPanel = function () {

        this.editorReporte = new WidgetReporte();

        this.editorFactura = new Ext.form.ComboBox({
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            selectOnFocus: true,
            mode: 'local',
            lazyRender: true,
            store:
                    [
<?
$i = 0;
foreach ($invoices as $invoice) {
    if ($i++ != 0) {
        echo ",";
    }
    echo "[\"" . $invoice["d_ca_numdocumento"] . "\",\"" . $invoice["d_ca_numdocumento"] . "\"]";
}
?>
                    ]
        });

        this.editorContainerMode = new Ext.form.ComboBox({
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            selectOnFocus: true,
            mode: 'local',
            lazyRender: true,
            store:
                    [
<?
$i = 0;
foreach ($container as $mode) {
    if ($i++ != 0) {
        echo ",";
    }
    echo "[\"" . $mode->getCaValor2() . "\",\"" . $mode->getCaValor() . "\"]";
}
?>
                    ]
        });


        this.columns = [
            {
                header: "Reporte",
                dataIndex: 'reporte',
                sortable: false,
                width: 150,
                editor: this.editorReporte
            },
            {
                header: "Número del Viaje",
                dataIndex: 'num_viaje',
                sortable: false,
                width: 100,
                editor: new Ext.form.TextField({
                    allowBlank: false
                })
            },
            {
                header: "Container Mode",
                dataIndex: 'container_mode',
                sortable: false,
                width: 150,
                editor: this.editorContainerMode
            },
            {
                header: "Número del Embarque",
                dataIndex: 'cod_carrier',
                sortable: false,
                width: 120,
                editor: new Ext.form.TextField({
                    allowBlank: false
                })
            },
            {
                header: "Fac.Agenciamiento Carga",
                dataIndex: 'numero_invoice',
                sortable: false,
                width: 150,
                editor: this.editorFactura
            },
            {
                header: "Valor FOB del Embarque",
                dataIndex: 'monto_invoice_miles',
                sortable: false,
                width: 150,
                align: 'right',
                renderer: 'usMoney',
                editor: new Ext.form.NumberField({
                    allowBlank: false,
                    allowNegative: false,
                    style: 'text-align:left',
                    decimalPrecision: 2
                })
            },
            {
                header: "Concepto",
                dataIndex: 'concepto',
                sortable: false,
                width: 120,
                editor: new Ext.form.TextField({
                    allowBlank: false
                })
            },
            {
                header: "Tipo Documento",
                dataIndex: 'documento_tipo',
                sortable: false,
                width: 120,
                editor: new Ext.form.TextField({
                    allowBlank: false
                })
            }
        ];

        this.record = Ext.data.Record.create([
            {name: 'iddoc', type: 'string', mapping: 'd_ca_iddoc'},
            {name: 'reporte', type: 'string', mapping: 'd_ca_reporte'},
            {name: 'num_viaje', type: 'string', mapping: 'd_ca_num_viaje'},
            {name: 'container_mode', type: 'string', mapping: 'd_ca_container_mode'},
            {name: 'cod_carrier', type: 'string', mapping: 'd_ca_cod_carrier'},
            {name: 'numero_invoice', type: 'string', mapping: 'd_ca_numero_invoice'},
            {name: 'concepto', type: 'string', mapping: 'd_ca_concepto'},
            {name: 'documento_tipo', type: 'string', mapping: 'd_ca_documento_tipo'},
            {name: 'monto_invoice_miles', type: 'string', mapping: 'd_ca_monto_invoice_miles'}
        ]);

        this.store = new Ext.data.Store({
            autoLoad: true,
            proxy: new Ext.data.MemoryProxy(<?= json_encode(array("root" => $header)) ?>),
            reader: new Ext.data.JsonReader(
                    {
                        root: 'root'
                    },
            this.record
                    )
        });


        MainPanel.superclass.constructor.call(this, {
            id: 'main-tabs',
            loadMask: {msg: 'Cargando...'},
            clicksToEdit: 1,
            // stripeRows: true,
            // labelAlign: 'top',
            // bodyStyle:'padding:1px',

            view: new Ext.grid.GridView({
                // forceFit:true,
                // enableRowBody:true,
                // showPreview:true,
                getRowClass: this.applyRowClass
            }),
            tbar: [{
                    text: 'Guardar',
                    iconCls: 'disk',
                    scope: this,
                    handler: this.guardarCambios
                }],
            listeners: {
                validateedit: this.onValidateEdit
            }

        });



    };

    Ext.extend(MainPanel, Ext.grid.EditorGridPanel, {
        height: 95,
        guardarCambios: function () {
            var store = this.store;
            var records = store.getModifiedRecords();

            var lenght = records.length;

            for (var i = 0; i < lenght; i++) {
                r = records[i];

                var changes = r.getChanges();

                //Carga un arreglo con los cambios
                changes['id'] = r.id;
                changes['iddoc'] = r.data.iddoc;

                //envia los datos al servidor
                Ext.Ajax.request(
                        {
                            waitMsg: 'Guardando cambios...',
                            url: '<?= url_for("falabella/observeHeader") ?>',
                            //method: 'POST',
                            //Solamente se envian los cambios
                            params: changes,
                            callback: function (options, success, response) {

                                var res = Ext.util.JSON.decode(response.responseText);
                                if (res.id && res.success) {
                                    var rec = store.getById(res.id);

                                    rec.set("sel", false); //Quita la seleccion de todas las columnas
                                    rec.commit();
                                }
                            }
                        }
                );
            }

            var grid = Ext.getCmp("panel-detalle");
            grid.guardarCambios();

        },
        /*
         * Handler que se encarga de colocar el dato consecutivo en el Record
         * cuando se llama el reporte de negocio.
         */
        onValidateEdit: function (e) {
            if (e.field == "reporte") {
                var rec = e.record;
                var ed = this.colModel.getCellEditor(e.column, e.row);

                var store = ed.field.store;
                store.each(function (r) {
                    if (r.data.idreporte == e.value) {
                        e.value = r.data.consecutivo;
                        rec.set("idreporte", r.data.idreporte);
                        return true;
                    }
                }
                );
            }
        }

    });

</script>