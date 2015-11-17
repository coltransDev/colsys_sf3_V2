<div id="grid" style="margin-bottom:15px; margin-top: 15px;" align="center"></div>

<script>
     Ext.define('Listado', {
        extend: 'Ext.data.Model',
        idProperty: 'id',
        fields: [
            {name: 'title', type: 'string'},
            {name: 'idform', type: 'int'},
            {name: 'idemail', type: 'int'},
            {name: 'compania', type: 'string'},
            {name: 'nombre', type: 'string'},
            {name: 'sucursal', type: 'string'},
            {name: 'comercial', type: 'string'},
            {name: 'fchenvio', type: 'date', dateFormat: 'Y-m-d H:i:s'}
        ]
    });

    Ext.onReady(function() {
        Ext.QuickTips.init();

        var store = Ext.create('Ext.data.Store', {
            model: 'Listado',
            data: <?= json_encode($sf_data->getRaw("empresas")) ?>,
            sorters: {property: 'due', direction: 'ASC'},
            groupers: ['sucursal', 'comercial']
        });
        
        var grid = Ext.create('Ext.grid.Panel', {
            title: 'Empresas a las cuáles se les envió la Encuesta',
            iconCls: 'icon-grid',
            store: store,            
            frame: true,            
            width: 750,
            renderTo: 'grid',
            listeners: {
                beforeshowtip: function(grid, tip, data) {
                    var cellNode = tip.triggerEvent.getTarget(tip.view.getCellSelector());
                    if (cellNode) {
                        data.colName = tip.view.headerCt.getHeaderAtIndex(cellNode.cellIndex).text;
                    }
                }
            },
            
            features: [Ext.create('Ext.ux.grid.feature.MultiGroupingSummary', {
                    id: 'group',
                    groupsHeaderTpl: {
                        sucursal: 'Sucursal: {name}',
                        comercial: '{name}'
                    },
                    hideGroupedHeader: true,
                    enableGroupingMenu: true,
                    startCollapsed: true
                }), {
                    ftype: 'summary',
                    dock: 'bottom'
                }],
            columns: [
                {
                    text: 'Compania',
                    width: 300,
                    locked: true,
                    tdCls: 'listado',
                    sortable: true,                    
                    dataIndex: 'compania',
                    hideable: false,
                    summaryType: 'count',
                    summaryRenderer: function(value, summaryData, dataIndex) {
                        return ((value === 0 || value > 1) ? '<span style="font-weight:bold;">' + value + ' Empresas</span>' : '(1 Empresa)');
                    }
                },
                {
                    header: 'Sucursal',
                    width: 300,
                    sortable: true,
                    dataIndex: 'sucursal'

                },
                {
                    text: 'Comercial',
                    sortable: true,
                    width: 300,
                    dataIndex: 'comercial',                    
                },
                {
                    text: 'Fecha de Envío',
                    xtype:'datecolumn',                    
                    flex: 30/100,
                    sortable: true,                    
                    dataIndex: 'fchenvio',
                    hideable: false,
                    renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                        var idemail = record.data.idemail;
                        var url = '<?= url_for("email/verEmail?id=") ?>' + idemail;
                        return '<a href="' + url + '" target="_blank">' + Ext.util.Format.date(value, 'Y-m-d H:i:s') + '</a>';
                    }
                }
            ]
        });
    });
</script>