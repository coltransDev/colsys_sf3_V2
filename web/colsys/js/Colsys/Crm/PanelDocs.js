Ext.define('Colsys.Crm.PanelDocs', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Crm.PanelDocs',
    layout: 'border',
    height: 500,
    listeners: {
        render: function (me, eOpts) {
            var me = this;
            this.add(Ext.create('Colsys.GestDocumental.treeGridFiles', {
                title: null,
                region: 'north', // center region is required, no width/height specified
                idcliente: me.idcliente,
                id: 'tree-grid-file-docs' + me.idcliente,
                layout: 'fit',
                collapsible: false,
                idsserie: 9,
                habilitarToolbar: true,
                ref1: me.idcliente,
                treeStore: 'Docs',
                margins: '5 5 5 5'
            }));
        },
//        beforeShow: function (win, e) {
        afterrender: function (me, eOpts) {
            var me = this;
            tree = Ext.getCmp("tree-grid-file-docs" + me.idcliente);

            tree.setStore(Ext.create('Ext.data.TreeStore', {
                fields: [
                    {name: 'idarchivo', type: 'string'},
                    {name: 'nombre', type: 'string'},
                    {name: 'documento', type: 'string'},
                    {name: 'iddocumental', type: 'string'},
                    {name: 'path', type: 'string'},
                    {name: 'ref1', type: 'string'},
                    {name: 'ref2', type: 'string'},
                    {name: 'ref3', type: 'string'},
                    {name: 'usucreado', type: 'string'},
                    {name: 'fchcreado', type: 'string'}
                ],
                proxy: {
                    type: 'ajax',
                    url: '/gestDocumental/dataFilesTree',
                    autoLoad: false
                },
                autoLoad: false
            }));

            store = tree.getStore();
            store.load({
                params: {
                    ref1: me.idcliente,
                    idsserie: 9
                }
            });
        }

    }
});


