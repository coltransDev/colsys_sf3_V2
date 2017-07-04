

Ext.define('Colsys.Crm.TreeCotizaciones', {
    extend: 'Ext.tree.Panel',
    alias: 'widget.Colsys.Crm.TreeCotizaciones',
    useArrows: true,
    rootVisible: false,
    multiSelect: true,
    singleExpand: true,
    columnLines: true,
    clicksToEdit: 1,
    lines: true,
    viewConfig: {
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
                var id_cotizacion = record.get('id_cotizacion');
                if (record.get('cotizacion_link')) {
                    return '<a href="/cotizaciones/verCotizacion/id/' + id_cotizacion + '" target="_blank"> ' + value + ' </a>';
                } else {
                    return record.get('text');
                }
            }
        }, {
            text: 'Ver.',
            dataIndex: 'version',
            sortable: false
        }, {
            text: 'Fecha',
            dataIndex: 'fchcotizacion',
            sortable: false
        }, {
            text: 'Modalidad',
            dataIndex: 'modalidad',
            sortable: false
        }, {
            text: 'Origen',
            dataIndex: 'origen',
            sortable: false
        }, {
            text: 'Destino',
            dataIndex: 'destino',
            sortable: false
        }, {
            text: 'Producto',
            dataIndex: 'producto',
            sortable: false,
            flex: -1
        }, {
            text: 'Etapa',
            dataIndex: 'etapa',
            sortable: false
        }, {
            text: 'Presentada',
            dataIndex: 'fchterminada',
            sortable: false
        }, {
            text: 'Usuario',
            dataIndex: 'usuterminada',
            sortable: false
        }
    ]
});

