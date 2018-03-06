
Ext.define('Colsys.Crm.GridListarClientes', {
    extend: 'Ext.grid.Panel',
    bufferedRenderer: false,
    alias: 'widget.Colsys.Crm.GridListarClientes',
    autoScroll: true,
    autoHeight: true,
    listeners: {
        afterrender: function (ct, position) {
            var me = this;
            var storeAfter = me.getStore();
            bbar = new Ext.PagingToolbar({
                dock: 'bottom',
                displayInfo: true,
                store: storeAfter,
                displayMsg: 'Registros {0} - {1} of {2}',
                emptyMsg: "No hay registros"
            });
            me.addDocked(bbar);
        },
        render: function (ct, position) {
            var me = this;
            this.reconfigure(
//                    this.superclass.onRender.call(this, ct, position),
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'idcliente', type: 'string', mapping: 'idcliente'},
                            {name: 'idalterno', type: 'string', mapping: 'idalterno'},
                            {name: 'nombre', type: 'string', mapping: 'nombre'},
                            {name: 'direccion', type: 'string', mapping: 'direccion'},
                            {name: 'telefono', type: 'string', mapping: 'telefono'},
                            {name: 'correo', type: 'string', mapping: 'correo'},
                            {name: 'fax', type: 'string', mapping: 'fax'},
                            {name: 'ciudad', type: 'string', mapping: 'ciudad'},
                            {name: 'vendedor', type: 'string', mapping: 'vendedor'},
                            {name: 'sucursal', type: 'string', mapping: 'sucursal'},
                            {name: 'coordinador', type: 'string', mapping: 'coordinador'},
                            {name: 'tipoPersona', type: 'string', mapping: 'tipoPersona'},
                            {name: 'regimen', type: 'string', mapping: 'regimen'},
                            {name: 'circular0170_fch', type: 'string', mapping: 'circular0170_fch'},
                            {name: 'circular0170_std', type: 'string', mapping: 'circular0170_std'},
                            {name: 'cartaGarantia_fch', type: 'string', mapping: 'cartaGarantia_fch'},
                            {name: 'cartaGarantia_vnc', type: 'string', mapping: 'cartaGarantia_vnc'},
                            {name: 'cartaGarantia_std', type: 'string', mapping: 'cartaGarantia_std'},
                            {name: 'ultima_encuesta', type: 'string', mapping: 'ultima_encuesta'},
                            {name: 'fecha_constitucion', type: 'string', mapping: 'fecha_constitucion'},
                            {name: 'fecha_acuerdo_conf', type: 'string', mapping: 'fecha_acuerdo_conf'},
                            {name: 'nivel_riesgo', type: 'string', mapping: 'nivel_riesgo'},
                            {name: 'listaOFAC', type: 'string', mapping: 'listaOFAC'},
                            {name: 'uap', type: 'string', mapping: 'uap'},
                            {name: 'altex', type: 'string', mapping: 'altex'},
                            {name: 'oea', type: 'string', mapping: 'oea'},
                            {name: 'comerciante', type: 'string', mapping: 'comerciante'},
                            {name: 'coltrans_std', type: 'string', mapping: 'coltrans_std'},
                            {name: 'coltrans_fch', type: 'string', mapping: 'coltrans_fch'},
                            {name: 'colmas_std', type: 'string', mapping: 'colmas_std'},
                            {name: 'colmas_fch', type: 'string', mapping: 'colmas_fch'},
                            {name: 'colotm_std', type: 'string', mapping: 'colotm_std'},
                            {name: 'colotm_fch', type: 'string', mapping: 'colotm_fch'},
                            {name: 'coldepositos_std', type: 'string', mapping: 'coldepositos_std'},
                            {name: 'coldepositos_fch', type: 'string', mapping: 'coldepositos_fch'}
                        ],
                        proxy: {
                            type: 'memory',
                            reader: {
                                type: 'json',
                                root: 'root'
                            }
                        }
                    }),
                    [
                        {
                            header: "Idcliente",
                            dataIndex: 'idalterno'
                        }, {
                            header: "Nombre",
                            dataIndex: 'nombre',
                            width: 250
                        }, {
                            header: "Direcci\u00F3n",
                            dataIndex: 'direccion',
                            width: 250
                        }, {
                            header: "Tel\u00E9fono",
                            dataIndex: 'telefono',
                            width: 100
                        }, {
                            header: "Correo",
                            dataIndex: 'correo'
                        }, {
                            header: "Fax",
                            dataIndex: 'fax'
                        }, {
                            header: "Ciudad",
                            dataIndex: 'ciudad'
                        }, {
                            header: "Vendedor",
                            dataIndex: 'vendedor'
                        }, {
                            header: "Sucursal",
                            dataIndex: 'sucursal'
                        }, {
                            header: "Coordinador",
                            dataIndex: 'coordinador'
                        }, {
                            header: "Tipo Persona",
                            dataIndex: 'tipoPersona'
                        }, {
                            header: "Regimen",
                            dataIndex: 'regimen'
                        }, {
                            header: "Circular0170",
                            dataIndex: 'circular0170_fch'
                        }, {
                            header: "Estado",
                            dataIndex: 'circular0170_std'
                        }, {
                            header: "Carta Garantia",
                            dataIndex: 'cartaGarantia_fch'
                        }, {
                            header: "Vence Garantia",
                            dataIndex: 'cartaGarantia_vnc'
                        }, {
                            header: "Estado",
                            dataIndex: 'cartaGarantia_std'
                        }, {
                            header: "Encuesta Visita",
                            dataIndex: 'ultima_encuesta'
                        }, {
                            header: "Fch.Constitución",
                            dataIndex: 'fecha_constitucion'
                        }, {
                            header: "Acu.Confidencialidad",
                            dataIndex: 'fecha_acuerdo_conf'
                        }, {
                            header: "Nivel Riesgo",
                            dataIndex: 'nivel_riesgo'
                        }, {
                            header: "Lista OFAC",
                            dataIndex: 'listaOFAC'
                        }, {
                            header: "UAP",
                            dataIndex: 'uap'
                        }, {
                            header: "altex",
                            dataIndex: 'Altex'
                        }, {
                            header: "OEA",
                            dataIndex: 'oea'
                        }, {
                            header: "Comerciante",
                            dataIndex: 'comerciante'
                        }, {
                            header: "Coltrans",
                            dataIndex: 'coltrans_std'
                        }, {
                            header: "Fch.Coltrans",
                            dataIndex: 'coltrans_fch'
                        }, {
                            header: "Colmas",
                            dataIndex: 'colmas_std'
                        }, {
                            header: "Fch.Colmas",
                            dataIndex: 'colmas_fch'
                        }, {
                            header: "Colotm",
                            dataIndex: 'colotm_std'
                        }, {
                            header: "Fch.Colotm",
                            dataIndex: 'colotm_fch'
                        }, {
                            header: "Coldepositos",
                            dataIndex: 'coldepositos_std'
                        }, {
                            header: "Fch.Coldepositos",
                            dataIndex: 'coldepositos_fch'
                        }
                    ]);

            tb = new Ext.toolbar.Toolbar();
            tb.add({
                xtype: 'exporterbutton',
                text: 'XLS',
                iconCls: 'csv',
                format: 'excel',
                store: this.store
            });
            this.addDocked(tb);
        },
        rowdblclick: function (obj, record, tr, rowIndex, e, eOpts) {
            tabpanel = Ext.getCmp('tabpanel1');
            ref = record.data.idcliente;
            if (!tabpanel.getChildByElement('tab' + ref) && ref != "") {
                tabpanel.add({
                    title: record.data.nombre,
                    id: 'tab' + ref,
                    itemId: 'tab' + ref,
                    closable: true,
                    autoScroll: true,
                    items: [{
                            xtype: 'wCRMMainpanel',
                            id: ref,
                            idcliente: ref,
                            permisos: Ext.getCmp('layout-browser').permisosG
                        }
                    ]
                }).show();
            }
            tabpanel.setActiveTab('tab' + ref);
        }
    }
});
