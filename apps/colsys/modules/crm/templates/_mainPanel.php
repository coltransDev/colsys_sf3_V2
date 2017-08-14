<script>

    Ext.define('Colsys.Crm.Mainpanel', {
        extend: 'Ext.panel.Panel',
        alias: 'widget.wCRMMainpanel',
//    bodyPadding: 10,
        autoHeight: true,
        onRender: function (ct, position) {
            me = this;
            Ext.Ajax.request({
                url: '/crm/permisosDuenoCuenta',
                method: 'GET',
                params: {
                    idcliente: this.idcliente // record.data.idcliente
                },
                success: function (response) {
                    var res = Ext.JSON.decode(response.responseText);
                    permisosG = res.permisos ? res.permisos : me.permisos;
                    tabs = new Array();

                    tabs.push({
                        xtype: 'Colsys.Crm.FormMaster',
                        id: "form-master-" + me.idcliente,
                        name: "form-master-" + me.idcliente,
                        idcliente: me.idcliente,
                        permisos: permisosG
                    });

                    tabs.push({
                        xtype: 'Colsys.Crm.PanelContactos',
                        title: "Contactos",
                        id: "Contactos-" + me.idcliente,
                        name: "Contactos-" + me.idcliente,
                        idcliente: me.idcliente,
                        permisos: permisosG
                    });

                    tabs.push({
                        xtype: 'Colsys.Crm.GridLibretaCliente',
                        title: "Libreta de Direcciones",
                        id: "LibretaCliente" + me.idcliente,
                        name: "LibretaCliente" + me.idcliente,
                        idcliente: me.idcliente,
                        permisos: permisosG,
                        plugins: [
                            new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
                        ]
                    });

                    tabs.push({
                        xtype: 'Colsys.Crm.GridSeguimientosClientes',
                        title: "Seguimientos",
                        id: "SeguimientosClientes" + me.idcliente,
                        name: "SeguimientosClientes" + me.idcliente,
                        idcliente: me.idcliente,
                        permisos: permisosG
                    });

                    tabs.push({
                        xtype: 'Colsys.Crm.GridHistoricoClientes',
                        title: "Control de Cambios",
                        id: "HistoricoCliente" + me.idcliente,
                        name: "HistoricoCliente" + me.idcliente,
                        idcliente: me.idcliente,
                        permisos: permisosG
                    });

                    me.add({
                        xtype: 'tabpanel',
                        id: 'tab-panel-id-indicadores' + me.idcliente,
                        activeTab: 0,
                        items: tabs
                    });
                }
            });

            this.superclass.onRender.call(this, ct, position);
        }
    });
</script>
