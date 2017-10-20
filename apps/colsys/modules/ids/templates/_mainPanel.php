<script>

    Ext.define('Colsys.Ids.Mainpanel', {
        extend: 'Ext.panel.Panel',
        alias: 'widget.wIdsMainpanel',
//    bodyPadding: 10,
        autoHeight: true,
        onRender: function (ct, position) {
            var me = this;
            tabs = new Array();

            tabs.push({
                xtype: 'Colsys.Ids.FormMaster',
                id: "form-master-" + me.idproveedor,
                name: "form-master-" + me.idproveedor,
                idproveedor: me.idproveedor,
                permisos: me.permisos
            });
            
            tabs.push({
                xtype: 'Colsys.Ids.PanelContactos',
                title: "Contactos",
                id: "Contactos-" + me.idproveedor,
                name: "Contactos-" + me.idproveedor,
                idproveedor: me.idproveedor,
                permisos: me.permisos
            });
            
            tabs.push({
                xtype: 'Colsys.Ids.GridDocumentos',
                title: "Documentos",
                id: "documentos-" + me.idproveedor,
                name: "documentos-" + me.idproveedor,
                idproveedor: me.idproveedor,
                permisos: me.permisos
            });
            
            tabs.push({
                xtype: 'Colsys.Ids.PanelEvaluaciones',
                title: "Evaluaci&oacute;n",
                id: "evaluacion-" + me.idproveedor,
                name: "evaluacion-" + me.idproveedor,
                idproveedor: me.idproveedor,
                permisos: me.permisos
            });

            this.add(
                    {
                        xtype: 'tabpanel',
                        id: 'tab-panel-id-indicadores' + me.idproveedor,
                        items: tabs,
                        listeners:{
                            afterRender: function (panel, eOpts) {
                                this.setActiveTab('Contactos-' + me.idproveedor);
                                this.setActiveTab('form-master-' + me.idproveedor);
                            }
                        }
                    });
            this.superclass.onRender.call(this, ct, position);
        }
    });
</script>
