/* 
 * @autor: Nataly Puentes
 * @return: grid cargado con historial de status según id reporte e id house
 * @params: 
 *      idreporte: numero de reporte
 *      idhouse: identificacion del house
 * @date:  2016-04-04
 */
Ext.define('modelStatus',{
    extend: 'Ext.data.Model',
    id: 'modelStatus',
    fields: [
            {name: 'fchstatus' , type: 'date'  , dateFormat:'Y-m-d'},
            {name: 'etapa'     , type: 'string' },
            {name: 'status'    , type: 'string' },
            {name: 'idemail'   , type: 'integer'}
    ]
});
Ext.define('Colsys.Widgets.wgStatus', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Widgets.wgStatus', 
    
    store:{
        id:'storeStatus',
        model: 'modelStatus',
        proxy:{
            type: 'ajax',
            url: '/inoF2/historialStatus',
            reader: {
                type            : 'json',
                rootProperty            : 'root'
            }
        },        
        sorters: [{
            property    : 'fcstatus',
            direction   : 'ASC'
        }],
        autoLoad        : true  
    },
    
    tbar:
    [
        {
            xtype: 'exporterbutton',
            text: 'XLS',
            iconCls: 'csv',
            format:'excel' 
        }
    ],
    columns : 
    [
        {
            header      : "Fecha",
            dataIndex   : 'fchstatus',
            hideable    : false,
            sortable    : true,
            width       : 100
        },
        {
            header      : "Etapa",
            //hidden      : true,
            dataIndex   : 'etapa',
            sortable    : true,
            width       : 100
        },
        {
            header      : "Mensaje",
            dataIndex   : 'status',
            hideable    : false,
            sortable    : true,
            width       : 550
        },
        /*{
            header      : "ver",
            hideable    : false,
            sortable    : false,
            resizable   : false,
            dataIndex   : '',
            width       : 50,                                            
            /*renderer: function(value, metaData, record, rowIndex, colIndex, store) { 
                //var a = '<a href="/email/verEmail?id='+record.data.idemail+'" ><img src="/images/fam/table_go.png" width=16 title="Ir"></a>';
                var a = '<a href="/email/verEmail?id='+record.data.idemail+'" target="/email/verEmail?id='+record.data.idemail+'"><img src="/images/fam/table_go.png" width=16 title="Ir"></a>';
                return  a;
                return '';
            }
            
        }*/
        {
        xtype: 'actioncolumn',
        width: 50,
        items: [{
                getClass: function (v, meta, rec) {
                    
                        return 'import';
                    
                },
                tooltip: 'Ver',
                handler: function (grid, rowIndex, colIndex) {
                    var record = grid.getStore().getAt(rowIndex);
                    var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                        sorc:"/email/verEmail?id="+record.data.idemail
                    });
                    windowpdf.show();
                }
            }]
        }
    ],
    onRender: function(ct, position){
       Colsys.Widgets.wgStatus.superclass.onRender.call(this, ct, position);
        idreporte=this.idreporte;
        idhouse=this.idhouse;
        this.store.proxy.extraParams = {
            idreporte:idreporte,
            idhouse:idhouse
        };
    }
});
