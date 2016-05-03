
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
   
Ext.define('Colsys.Templates.GridConsultaBasic', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Templates.GridConsultaBasic',
    bufferedRenderer: true,                
    
    store: Ext.data.JsonStore({                        
        fields: [
        ],
        proxy: {
            type: 'ajax',                            
            reader: {
                 type: 'json',
                 rootProperty: 'root'
            }                            
        },
        autoLoad: false
    }),
    listeners:
    {
        afterRender:function(ct, position){
            
            tb = new Ext.toolbar.Toolbar();
            tb.add(
            [{
                xtype: 'exporterbutton',
                text: 'Exportar CSV',
                iconCls: 'csv'
                }
            ]);
            //var pos = str.indexOf("locate"); 
            if(this.id.indexOf("-locked")<0)
                this.addDocked(tb);
        //this.superclass.onRender.call(this, ct, position);
        }
    },    
    autoScroll:true,        
    lockedGridConfig: {
        header: false,
        collapsible: true,
        //width: 300,
        //forceFit: true
    },
    lockedViewConfig: {
        scroll: 'horizontal'
    }
});