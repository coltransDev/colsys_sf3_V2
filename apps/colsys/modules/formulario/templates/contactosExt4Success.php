<div style="margin-bottom:15px; margin-top: 15px;" align="center"><b><?= html_entity_decode($formulario->getCaMedicion())?></b></div>
<div id="grid" style="margin-bottom:15px; margin-top: 15px;" align="center"></div>
<script>
    Ext.define('Listado', {
        extend: 'Ext.data.Model',
        idProperty: 'id',
        fields: [
            {name: 'title', type: 'string'},
            {name: 'idform', type: 'int'},
            {name: 'idencuesta', type: 'int'},
            {name: 'idcliente', type: 'int'},
            {name: 'compania', type: 'string'},
            {name: 'nombre', type: 'string'},
            {name: 'sucursal', type: 'string'},
            {name: 'comercial', type: 'string'},
            {name: 'promedio', type: 'float'},
            {name: 'seguimiento', type: 'boolean'}
        ]
    });

    Ext.onReady(function() {
        Ext.QuickTips.init();

        var store = Ext.create('Ext.data.Store', {
            model: 'Listado',
            data: <?= json_encode($sf_data->getRaw("contactos")) ?>,
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
                        return ((value === 0 || value > 1) ? '<span style="font-weight:bold;">' + value + ' Contactos</span>' : '(1 Contactos)');
                    }
                },
                {
                    header: 'Sucursal',
                    width: 180,
                    sortable: true,
                    dataIndex: 'sucursal'

                },
                {
                    text: 'Comercial',
                    sortable: true,
                    dataIndex: 'comercial',
                },
                {
                    text: 'Contacto',
                    flex: 1,
                    sortable: true,
                    dataIndex: 'nombre',
                    hideable: false
                },
                {
                    header: 'Promedio',
                    width: 130,
                    sortable: true,
                    dataIndex: 'promedio',
                    summaryType: 'average',
                    renderer: Ext.util.Format.numberRenderer('0.00'),
                    summaryRenderer: function(value) {
                        return Ext.util.Format.number(value, '0.00');
                    },
                    renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                        var idform = '<?= $formulario->getCaId() ?>';
                        var cierre = '<?= $formulario->getCaCierre()?>';                        
                        var idencuesta = record.data.idencuesta;
                        var idcliente = record.data.idcliente;
                        var url = '<?= url_for("formulario/resultadoExt4?ca_id=") ?>' + idform + '/idcliente/'+ idcliente + '/idencuesta/'+ idencuesta + '/cierre/'+ cierre;
                        return '<a href="' + url + '" target="_blank">' + value + '</a>';
                    },
                },
                {
                    header: "Seguimientos", 
                    width: 100,                     
                    dataIndex: 'seguimiento', 
                    sortable: false,
                    renderer: function(value){
                        return value?'<img src="/images/16x16/button_ok.gif"/>':"";
                    }
                }
            ]
        });
    });
</script>