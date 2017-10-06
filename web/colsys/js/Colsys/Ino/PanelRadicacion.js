// Form de Consulta Principal de Sucursal

Ext.define('Colsys.Ino.PanelRadicacion', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.PanelRadicacion',
    defaults: {
        bodyStyle: 'padding:4px',
        labelWidth: 100
    },
    listeners: {
        beforerender: function (ct, position) {
            this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 150);
            this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 50);
        },
        render: function (me, eOpts) {
            
            var panelRadicacion = {
                /*layout: {
                    type: 'vbox'
                },*/
                items: [
                    {
                        idmaster: this.idmaster,
                        permisos: this.permisos,
                        xtype: 'Colsys.Ino.FormMasterRadicacion'
                    }, {
                        idmaster: this.idmaster,
                        permisos: this.permisos,
                        xtype: 'Colsys.Ino.GridHouseRadicacion'
                    }
                ],
                autoHeight: true,
                autoScroll: true
            };

            this.add({
                id: 'layout-browserm' + this.idcliente,
                items: [panelRadicacion]
            });
        }

    }
});