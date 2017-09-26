// Form para Edición Datos de la Sucursal

Ext.define('Colsys.Crm.FormSucursal', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormSucursal',
    bodyPadding: 5,
    layout: 'column',
    autoHeight: true,
    //autoScroll: true,
    defaults: {
        columnWidth: 1,
        //bodyStyle:'padding:30',
        style: "text-align: left",
        labelAlign: 'right'
    },
    items: [{
            xtype: 'fieldset',
            height: 130,
            width: 580,
            title: 'General',
            columnWidth: 1,
            layout: 'column',
            columns: 2,
            defaults: {
                columnWidth: 0.5,
                bodyStyle: 'padding:4px'
            },
            items: [{
                    xtype: 'hiddenfield',
                    id: 'idsucursal',
                    name: 'idsucursal'
                }, {
                    xtype: 'textfield',
                    fieldLabel: 'Nombre',
                    name: 'nombre',
                    id: "nombre",
                    width: 200
                }, {
                    xtype: 'Colsys.Widgets.WgCiudades2',
                    fieldLabel: 'Ciudad',
                    name: 'ciudad',
                    id: "ciudad",
                    allowBlank: false,
                    width: 200
                }, {
                    xtype: 'tbspacer',
                    height: 25,
                    columnWidth: 1
                }, {
                    xtype: 'textfield',
                    fieldLabel: 'Direccion',
                    name: 'direccion',
                    id: "direccion",
                    allowBlank: false,
                    width: 200
                }, {
                    xtype: 'textfield',
                    fieldLabel: 'Ciudad Destino',
                    name: 'ciudad_destino',
                    id: "ciudad_destino",
                    width: 200
                }, {
                    xtype: 'tbspacer',
                    height: 25,
                    columnWidth: 1
                }, {
                    xtype: 'textfield',
                    fieldLabel: 'Telefonos',
                    name: 'telefonos',
                    id: "telefonos",
                    allowBlank: false,
                    width: 200
                }, {
                    xtype: 'textfield',
                    fieldLabel: 'Fax',
                    name: 'fax',
                    id: "fax",
                    allowBlank: false,
                    width: 200
                }
            ]}],
    buttons: [{
            text: 'Guardar',
            formBind: true,
            handler: function () {
                var idsucursal = this.up('form').idsucursal;
                var idcliente = this.up('form').idcliente;
                var form = this.up('form').getForm();
                if (form.isValid()) {
                    form.submit({
                        url: '/crm/guardarSucursal',
                        waitMsg: 'Guardando',
                        params: {
                            idsucursal: idsucursal,
                            idcliente: idcliente
                        },
                        success: function (fp, o) {
                            Ext.getCmp("winFormEdit").destroy();
                            Ext.Msg.alert("Sucursal", "Datos almacenados correctamente");
                            Ext.getCmp("tree-sucursales" + idcliente).getStore().reload();
                        }
                    });
                }
            }
        }],
    listeners: {
        afterrender: function (me, eOpts) {
            //alert(this.idsucursal);
            if (this.idsucursal) {
                form = this.getForm();
                form.load({
                    url: '/crm/cargarDatosSucursal',
                    params: {
                        idsucursal: this.idsucursal
                    }
                });
            }
        }
    }
});