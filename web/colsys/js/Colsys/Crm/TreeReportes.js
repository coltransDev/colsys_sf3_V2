

Ext.define('Colsys.Crm.TreeReportes', {
    extend: 'Ext.tree.Panel',
    alias: 'widget.Colsys.Crm.TreeReportes',
    useArrows: true,
    rootVisible: false,
    multiSelect: true,
    singleExpand: true,
    columnLines: true,
    clicksToEdit: 1,
    lines: true,
    viewConfig: {
        trackOver: false,
        plugins: {
            ptype: 'treeviewdragdrop',
            containerScroll: true
        },
        listeners: {
            beforeRender: function (ct, position) {
                idcliente = this.up('panel').idcliente;

                this.store.load({
                    params: {
                        idcliente: idcliente
                    }
                });
            }
        }
    },
    columns: [{
            xtype: 'treecolumn',
            text: 'Consecutivo',
            sortable: true,
            dataIndex: 'text',
            width: 220,
            renderer: function (value, metaData, record, row, col, store, gridView) {
                var id_reporte = record.get('id_reporte');
                if (record.get('reporte_link')) {
                    return '<a href="/reportesNeg/verReporte/id/' + id_reporte + '" target="_blank"> ' + value + ' </a>';
                } else {
                    return record.get('text');
                }
            }
        }, {
            text: 'Modalidad',
            dataIndex: 'modalidad',
            sortable: false,
            width: 130
        }, {
            text: 'Origen',
            dataIndex: 'origen',
            sortable: false,
            width: 130
        }, {
            text: 'Destino',
            dataIndex: 'destino',
            sortable: false
        }, {
            text: 'Nro.Orden',
            dataIndex: 'orden_clie',
            sortable: false,
            flex: -1
        }, {
            text: 'Vendedor',
            dataIndex: 'login',
            sortable: false
        }, {
            text: 'Colmas',
            dataIndex: 'colmas',
            sortable: false
        }, {
            text: 'Seguro',
            dataIndex: 'seguro',
            sortable: false
        }, {
            text: 'Continuacion',
            dataIndex: 'continuacion',
            sortable: false
        }, {
            text: 'Presentada',
            dataIndex: 'fchactualizado',
            sortable: false
        }, {
            text: 'Usuario',
            dataIndex: 'usuactualizado',
            sortable: false
        }
    ]
});

