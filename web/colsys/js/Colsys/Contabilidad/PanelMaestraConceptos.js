Ext.define('Colsys.Contabilidad.PanelMaestraConceptos', {    
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Contabilidad.PanelMaestraConceptos',    
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
            this.add(
                Ext.create('Colsys.Contabilidad.GridMaestraConceptos', {
                    id: 'grid-maestra-conceptos',
                    title: 'Maestra de Conceptos',
                    idgrid: 'gridmaestra'+this.idgrid
                }),
                Ext.create('Colsys.Contabilidad.GridDetalleConceptos', {
                    id: 'grid-detalle-conceptos',
                    title: 'Detalle de Conceptos',
                    idgrid: 'griddetalle'+this.idgrid
                })
            )
        }
    }
    /*items: [
        
    /*, {
        xtype: 'splitter'   // A splitter between the two child items
    }, {                    // Details Panel specified as a config object (no xtype defaults to 'panel').
        title: 'Details',
        bodyPadding: 5,
        items: [{
            fieldLabel: 'Data item',
            xtype: 'textfield'
        }], // An array of form fields
        //flex: 2             // Use 2/3 of Container's height (hint to Box layout)
    }*//*]*/
});/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


