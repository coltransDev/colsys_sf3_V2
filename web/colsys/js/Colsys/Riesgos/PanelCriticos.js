Ext.define('Colsys.Riesgos.PanelCriticos', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Riesgos.PanelCriticos',    
    height: 750,    
    layout: {
        type: 'vbox', // Arrange child items vertically
        align: 'stretch',    // Each takes up full width ,
        pack: 'start'
    },
    bodyPadding: 10,    
    defaults: {
        frame: true,
        collapsible: true,        
        bodyPadding: 10,
        listeners: {
            collapse: function () {
                this.up().doLayout();
            },
            expand: function () {
                this.up().doLayout();
            }
        }
    },
    items: [],
    listeners: {        
        render: function (me, eOpts) {
            
            this.add({
                    xtype:'Colsys.Riesgos.GridCriticos',                                                    
                    id:"grid-criticos",
                    criterios: this.criterios,
                    headers: this.headers  
                });
        }        
    }
});