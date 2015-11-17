<style type="text/css">
    .x-grid-cell-inner { white-space:normal !important; }
</style>

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
            {name: 'pregunta', type: 'string'},
            {name: 'resultado', type: 'int'},            
            {name: 'servicio', type: 'string'},
            {name: 'seguimiento', type: 'boolean'}
        ]
    });

    Ext.onReady(function() {
        Ext.QuickTips.init();

        var store = Ext.create('Ext.data.Store', {
            model: 'Listado',
            data: <?= json_encode($sf_data->getRaw("contactos")) ?>,
            sorters: {property: 'compania', direction: 'ASC'}
        });
        
        var grid = Ext.create('Ext.grid.Panel', {
            title: 'Empresas a las cuáles se les envió la Encuesta',
            iconCls: 'icon-grid',
            store: store,            
            frame: true,            
            width: 1000,
            renderTo: 'grid',
            listeners: {
                beforeshowtip: function(grid, tip, data) {
                    var cellNode = tip.triggerEvent.getTarget(tip.view.getCellSelector());
                    if (cellNode) {
                        data.colName = tip.view.headerCt.getHeaderAtIndex(cellNode.cellIndex).text;
                    }
                }
            },      
            columns: [
                {
                    text: 'Compania',
                    tdCls: 'listado',
                    sortable: true,
                    dataIndex: 'compania',
                    hideable: false,
                    flex:3                    
                },
                {
                    header: 'Sucursal',                    
                    flex:2,
                    sortable: true,
                    dataIndex: 'sucursal'

                },
                {
                    text: 'Comercial',
                    sortable: true,
                    flex:2,
                    dataIndex: 'comercial',
                },                
                {
                    text: 'Pregunta',
                    flex: 4,
                    sortable: true,
                    dataIndex: 'pregunta',
                },
                {
                    header: 'Resultado',                    
                    sortable: true,
                    dataIndex: 'resultado',
                    flex:1,
                    hideable: false,                    
                    renderer: Ext.util.Format.numberRenderer('0.00'),                    
                    renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                        var idform = '<?= $formulario->getCaId() ?>';
                        var idencuesta = record.data.idencuesta;
                        var idcliente = record.data.idcliente;
                        var url = '<?= url_for("formulario/resultadoExt4?ca_id=") ?>' + idform + '/idcliente/'+ idcliente + '/idencuesta/'+ idencuesta;
                        return '<a href="' + url + '" target="_blank">' + value + '</a>';
                    },
                },
                {
                    text: 'Servicio',
                    flex: 3,                    
                    sortable: true,
                    dataIndex: 'servicio'                    
                },
                {
                    header: "Seguimientos",                     
                    flex: 1,
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
