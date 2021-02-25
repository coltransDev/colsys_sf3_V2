Ext.define('Colsys.Riesgos.PanelMaestraProcesos', {    
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Riesgos.PanelMaestraProcesos',
    //autoScroll: true,
    //autoHeight: true,    
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
    listeners: {        
        render: function (me, eOpts) {            
            //var h = (this.getHeight()/2)-5;
            this.add(
                Ext.create('Colsys.Riesgos.GridMaestraProcesos', {
                    id: 'grid-procesos',
                    title: 'Administrador de Procesos',
                    flex:1,                    
                    idgrid: 'grid-'+me.idgrid
                }),
                Ext.create('Colsys.Riesgos.GridPermisosProcesos', {
                    id: 'grid-permisos-procesos',
                    title: 'Permisos Generales',
                    flex:1,                    
                    /*width: 1000, 
                    height: 400,*/
                    idgrid: 'gridpermisos'+me.idgrid
                })
            )
        },
        beforerender: function (ct, position) {            
            this.setHeight(this.up("tabpanel").getHeight()-50);            
        }
    }    
});