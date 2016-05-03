/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Ext.define('Colsys.FalabellaAdu.GridDatosIndDet', {
    extend: 'Colsys.Templates.GridConsultaBasic',
    alias: 'widget.Colsys.FalabellaAdu.GridDatosIndDet',
                                
    store: Ext.data.JsonStore({                        
    fields: ['indicador', 'total'],                        
        proxy: {
            type: 'memory',                            
            reader: {
                 type: 'json',
                 rootProperty: 'root'
            }                            
        },
        autoLoad: false
    }),
    columns: [], //columnasgrid('Docs',''),
    features: [{
        id: 'terminal',
        ftype: 'summary',
        groupHeaderTpl: '{name}',
        totalSummary: 'fixed',          // Can be: 'fixed', true, false. Default: false
        totalSummaryTopLine: true,      // Default: true
        totalSummaryColumnLines: true,  // Default: false                                    
        enableGroupingMenu: false
    }]  
})
