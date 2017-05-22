
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include_component("falabellaAdu2", "gridDetControl");
?>
<script>
    
    
//    var consinternografica=0;
    

    
    
    Ext.define('GridFacturacion',{
        extend: 'Ext.grid.Panel',        
        //id:'gbl'+idtab,
        //name:'gbl'+idtab,
        bufferedRenderer: false,
        store: Ext.data.JsonStore({                        
        fields: ['indicador', 'total'],                        
            proxy: {
                type: 'ajax',                            
                reader: {
                     type: 'json',
                     rootProperty: 'root'
                }
            },
            autoLoad: false
        }),
        columns:[
            {text: "Terminal", width: 120, dataIndex: 'terminal', sortable: true,
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return "Total";
                }
            },
            {text: "Total carpetas", width: 120, dataIndex: 'total_carpeta', summaryType: 'sum',sortable: true}
            /*{text: "Total Demora", width: 120 , dataIndex: 'total_demora', summaryType: 'sum',sortable: true},
            {text: "% Demora", width: 125, dataIndex: 'por_demora', sortable: true,
                summaryType: function(records){
                    var i = 0,
                        length = records.length,
                        totalcarpeta = 0,
                        totaldemora = 0,
                        record;
                    for (; i < length; ++i) {
                        record = records[i];
                        totalcarpeta += record.get('total_carpeta');
                        totaldemora += record.get('total_demora');
                    }
                    return Ext.util.Format.number((totaldemora*100)/totalcarpeta,'0.0');
                }   
            },
            {
                xtype: 'actioncolumn',
                width: 30,
                sortable: false,
                menuDisabled: true,
                items: [{
                    icon: '/images/fam/application_view_columns.png',                                            
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = grid.getStore().getAt(rowIndex);
                       //alert(rec.data.toSource());               
                       callFunction(rec.data,tipo)
                        //eval( functionCallBack+"(rec.data)" );

                    }
                }]
            }*/
        ]
        ,
        height:600,
        //autoScroll: true,
        //split: true,
        features: [{
            id: 'terminal',
            ftype: 'summary',
            groupHeaderTpl: '{name}',
            totalSummary: 'fixed',
            totalSummaryTopLine: true,
            totalSummaryColumnLines: true,
            enableGroupingMenu: false
        }]
    })
</script>