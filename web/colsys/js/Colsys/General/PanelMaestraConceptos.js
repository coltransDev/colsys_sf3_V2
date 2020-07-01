Ext.define('Colsys.General.PanelMaestraConceptos', {    
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.General.PanelMaestraConceptos',
    autoScroll: true,
    autoHeight: true,    
    layout: {
        type: 'vbox',       // Arrange child items vertically
        align: 'stretch',    // Each takes up full width
        padding: 5
    },
    defaults: {
        frame: true,
        collapsible: true,        
        listeners: {
            collapse: function () {
                this.up().doLayout();
            },
            expand: function () {
                this.up().doLayout();
            }
        }
    },
    requires:[
       'Ext.grid.plugin.Exporter',
       'Ext.view.grid.ExporterController'
    ],
    listeners: {        
        render: function (me, eOpts) {            
            //var h = (this.getHeight()/2)-5;
            this.add(
                Ext.create('Colsys.General.GridMaestraConceptos', {
                    id: 'grid-maestra-conceptos',
                    title: 'Maestra de Conceptos',
                    flex:1,
                    //height:h,   
                    idgrid: 'gridmaestra'+this.idgrid
                }),
                Ext.create('Colsys.General.GridDetalleConceptos', {
                    id: 'grid-detalle-conceptos',
                    title: 'Detalle de Conceptos',
                    flex:1,
                    //height:h,
                    idgrid: 'griddetalle'+this.idgrid
                })
            )
        },
        beforerender: function (ct, position) {            
            this.setHeight(this.up("tabpanel").getHeight()-80);            
        }
    }    
});