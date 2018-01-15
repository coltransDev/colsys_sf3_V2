
/**
 * @autor Felipe Nariño 
 * @return Formulario para Cerrar y Liquidar en INOF2
 * @date:  2016-04-21
 */



Ext.define('Colsys.Ino.PanelAuditoria', {
    //extend: 'Ext.Viewport',
    extend: 'Ext.panel.Panel',
    alias: 'widget.wPanelAuditoria',
    // url: '/inoF2/datosCierre',
    //bodyPadding: 5,
    layout: 'border',
    title: 'Ext Layout Browser',
    height: 500,
    //items: [],
    listeners: {
        beforerender: function (ct, position) {
            this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 150);
            this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 50);
        },
        render: function (me, eOpts) {
            
            var detailsPanel = {
                //id: 'details-panel',
                title: 'Archivos asociados',
                region: 'center',
                xtype: 'Colsys.Ino.GridDocumentosAuditoria',
                idmaster: this.idmaster,
                bodyStyle: 'padding-bottom:15px;background:#eee;',
                height: 150,
                idticket : this.idticket,
                autoScroll: true,
                
            };
            var detailsPanel2 = {
                id: 'details-panel2',
                title: '<div style="text-align:center;">Vista Previa</div>',
                region: 'north',
                xtype: 'Colsys.Ino.FormVistaTicket',
                height: 350,
                idticket : this.idticket,
                bodyStyle: 'padding-bottom:15px;background:#eee;',
                autoScroll: true
            };

            this.add({
                layout: 'border',
                id: 'layout-browserm',
                region: 'west',
                split: true,
                idticket : this.idticket,
                margins: '2 0 5 5',
                width: 350,
                items: [detailsPanel, detailsPanel2]
            }, {
                title: '<div style="text-align:center;">Respuestas del Ticket</div>',
                region: 'center', // center region is required, no width/height specified
                xtype: 'Colsys.Ino.GridRespuestas',
                idmaster: this.idmaster,
                idticket : this.idticket,
                layout: 'fit',
                margins: '5 5 0 0'
            }



            );
        }
    }
})
