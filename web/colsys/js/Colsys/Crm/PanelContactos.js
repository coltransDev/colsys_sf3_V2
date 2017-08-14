// Form de Consulta Principal de Sucursal

Ext.define('Colsys.Crm.PanelContactos', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Crm.PanelContactos',
    defaults: {
        bodyStyle: 'padding:4px',
        labelWidth: 100
    },
    listeners: {
        render: function (me, eOpts) {

            var treeSucursales = {
                id: 'tree-sucursales' + this.idcliente,
                xtype: 'Colsys.Crm.TreeSucursales',
                store: Ext.create('Ext.data.TreeStore', {
                    fields: [
                        {name: 'text', type: 'string'},
                        {name: 'descripcion', type: 'string'}
                    ],
                    proxy: {
                        type: 'ajax',
                        url: '/crm/datosSucursales',
                        autoLoad: true,
                        extraParams: {
                            idcliente: this.idcliente
                        }
                    }
                }),
                idcliente: this.idcliente,
                permisos: this.permisos,
                autoHeight: true,
                autoScroll: true
            };

            this.add({
                id: 'layout-browserm' + this.idcliente,
                items: [treeSucursales]
            });
        }

    }
});


