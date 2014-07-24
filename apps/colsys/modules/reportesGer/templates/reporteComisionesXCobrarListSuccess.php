<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$comisiones = $sf_data->getRaw("comisiones");
?>
<script type="text/javascript">

    Ext.onReady(function() {
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
                summaryType: 'sum',
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
            }
        ];

        this.record = Ext.data.Record.create([
            {name: 'ca_oid', type: 'boolean'},
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
            proxy: new Ext.data.MemoryProxy(<?= json_encode(array("root" => $comisiones)) ?>),
            reader: new Ext.data.JsonReader(
                    {
                        root: 'root'
                    },
            this.record
                    ),
            sortInfo: {field: 'ca_referencia', direction: 'ASC'},
            groupField: 'ca_login'
        });

        this.summary = new Ext.ux.grid.GroupSummary();

        var gridComisiones = new Ext.grid.EditorGridPanel({
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
            plugins: [
                this.summary
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