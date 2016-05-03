/**
    * @autor Felipe Nariño
    * Descripción: Widget encargado de encapsular pdf en
    * window de Ext.
    *
    * @param sfRequest $request A request object
         * src: url del action encargfafo de generar el pdf
         * a mostrar,
    */
Ext.define('Colsys.Widgets.WgVerPdf', {
    extend: 'Ext.window.Window',
    height: 600,
    width: 800,
    title: 'Vista Preliminar del Documento',
    alias: 'widget.Colsys.Widgets.WgVerPdf',
    layout: 'fit',
    items: {
        xtype: 'component',
        itemId: 'panel-document-preview',
        autoEl: {
            tag: 'iframe',
            width: '100%',
            height: '100%',
            frameborder: '0',
            scrolling: 'auto'
            
        }
    },
   
     
     initComponent: function() {
        var me = this;         
        me.callParent(arguments);
        me.on('beforerender', this.beforeTemplateLoad, this);
    },
 
    beforeTemplateLoad: function() {
        this.items.first().autoEl.src = this.sorc;
    }
 });


