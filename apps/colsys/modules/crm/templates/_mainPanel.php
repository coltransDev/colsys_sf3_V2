<script>

    Ext.define('Colsys.Crm.Mainpanel', {
        extend: 'Ext.panel.Panel',
        alias: 'widget.wCRMMainpanel',
//    bodyPadding: 10,
        autoHeight: true,
        onRender: function (ct, position) {

            tabs = new Array();

            tabs.push({
                xtype: 'Colsys.Crm.FormMaster',
                id: "form-master-" + this.idcliente,
                name: "form-master-" + this.idcliente,
                idcliente: this.idcliente,
                permisos: this.permisos
            });
            
            tabs.push({
                xtype: 'Colsys.Crm.PanelContactos',
                title: "Contactos",
                id: "Contactos-" + this.idcliente,
                name: "Contactos-" + this.idcliente,
                idcliente: this.idcliente,
                permisos: this.permisos
            });
            
            tabs.push({
                xtype: 'Colsys.Crm.GridLibretaCliente',
                title: "Libreta de Direcciones",
                id: "LibretaCliente" + this.idcliente,
                name: "LibretaCliente" + this.idcliente,
                idcliente: this.idcliente,
                permisos: this.permisos,
                plugins: [
                    new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
                ]
            });
            
            tabs.push({
                xtype: 'Colsys.Crm.GridSeguimientosClientes',
                title: "Seguimientos",
                id: "SeguimientosClientes" + this.idcliente,
                name: "SeguimientosClientes" + this.idcliente,
                idcliente: this.idcliente,
                permisos: this.permisos
            });
            
            tabs.push({
                xtype: 'Colsys.Crm.GridHistoricoClientes',
                title: "Control de Cambios",
                id: "HistoricoCliente" + this.idcliente,
                name: "HistoricoCliente" + this.idcliente,
                idcliente: this.idcliente,
                permisos: this.permisos
            });
            

            this.add(
                    {
                        xtype: 'tabpanel',
                        id: 'tab-panel-id-indicadores' + this.idcliente,
                        activeTab: 0,
                        items: tabs
                   	    
                    	
                    });
            this.superclass.onRender.call(this, ct, position);
        }
    });
</script>
