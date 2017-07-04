Ext.define('Colsys.Crm.FormContacto', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormContacto',
    bodyPadding: 5,
    layout: 'column',
    autoHeight: true,
    autoScroll: true,
    defaults: {
        columnWidth: 1,
        //bodyStyle:'padding:30',
        style: "text-align: left",
        labelAlign: 'right'
    },
    items: [{
            xtype: 'fieldset',
            height: 520,
            width: 550,
            title: 'General',
            columnWidth: 1,
            layout: 'column',
//            columns: 2,
            defaults: {
                columnWidth: 0.5,
                bodyStyle: 'padding:4px'
            },
            items: [{
                    xtype: 'displayfield',
                    fieldLabel: '<span style="width: 20px ;font-size:10px;padding-right:40px">Proveedor</span>',
                    labelWidth: 400,
                    fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;',
                    name: 'proveedor',
                    id: 'proveedor'
                },
                {
                    xtype: 'displayfield',
                    fieldLabel: '<span style="width: 20px ;font-size:10px;padding-right:40px">Id</span>',
                    labelWidth: 400,
                    fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;',
                    name: 'id',
                    hidden: true,
                    id: 'id'
                },
                {
                    xtype: 'tbspacer',
                    height: 25,
                    columnWidth: 1
                },
                {
                    xtype: 'textfield',
                    fieldLabel: 'Nombre',
                    name: 'nombre',
                    id: "nombre"
                },
                {
                    xtype: 'textfield',
                    fieldLabel: 'Apellido',
                    name: 'apellido',
                    id: "apellido"
                },
                {
                    xtype: 'tbspacer',
                    height: 25,
                    columnWidth: 1
                },
                {
                    xtype: 'textfield',
                    fieldLabel: 'C&oacute;digo de &Aacute;rea',
                    name: 'codigo',
                    id: "codigo"
                },
                {
                    xtype: 'textfield',
                    fieldLabel: 'Telefono',
                    name: 'telefono',
                    id: "telefono"
                },
                {
                    xtype: 'tbspacer',
                    height: 25,
                    columnWidth: 1
                },
                {
                    xtype: 'textfield',
                    fieldLabel: 'Fax',
                    name: 'fax',
                    id: "fax"
                },
                {
                    xtype: 'textfield',
                    fieldLabel: 'Celular',
                    name: 'fax',
                    id: "fax"
                },
                {
                    xtype: 'textfield',
                    fieldLabel: 'Skype',
                    name: 'skype',
                    id: "skype"
                },
                {
                    xtype: 'tbspacer',
                    height: 25,
                    columnWidth: 1
                },
                {
                    xtype: 'textfield',
                    fieldLabel: 'Correo Electr&oacute;nico',
                    name: 'correo',
                    id: "correo"
                },
                {
                    xtype: 'tbspacer',
                    height: 10,
                    columnWidth: 1
                },
                {
                    xtype: 'fieldset',
                    title: 'Atiende Impo/Expo',
                    columnWidth: 0.49,
                    layout: 'column',
                    items: [{
                            xtype: 'checkboxgroup',
                            id: 'impo_expo',
                            name: 'impo_expo',
                            items: [
                                {
                                    boxLabel: 'Exportaci&oacute;n',
                                    name: 'exportacion',
                                    inputValue: 'exportacion',
                                    width: 110
                                }, {
                                    boxLabel: 'Importaci&oacute;n',
                                    name: 'impotacion',
                                    inputValue: 'impotacion',
                                    width: 110
                                }
                            ]
                        }]
                },
                {
                    xtype: 'fieldset',
                    title: 'Transporte',
                    columnWidth: 0.49,
                    layout: 'column',
                    items: [{
                            xtype: 'checkboxgroup',
                            id: 'transporte',
                            name: 'transporte',
                            columns: 3,
                            items: [
                                {
                                    boxLabel: 'A&eacute;reo',
                                    name: 'aereo',
                                    inputValue: 'aereo',
                                    width: 70

                                }, {
                                    boxLabel: 'Mar&iacute;timo',
                                    name: 'maritimo',
                                    inputValue: 'maritimo',
                                    width: 80
                                }, {
                                    boxLabel: 'Terrestre',
                                    name: 'terrestre',
                                    inputValue: 'terrestre',
                                    width: 80
                                }
                            ]
                        }]
                },
                {
                    xtype: 'tbspacer',
                    height: 10,
                    columnWidth: 1
                },
                {
                    xtype: 'fieldset',
                    title: 'Cargo',
                    columnWidth: 0.49,
                    layout: 'column',
                    items: [{
                            xtype: 'radiogroup',
                            id: 'cargo',
                            name: 'cargo',
                            columns: 1,
                            items: [
                                {
                                    boxLabel: 'Jefe de Oficina',
                                    name: 'car',
                                    inputValue: 'jefe_oficina'
                                }, {
                                    boxLabel: 'Jefe Importaci&oacute;n',
                                    name: 'car',
                                    inputValue: 'jefe_importacion'
                                }, {
                                    boxLabel: 'Jefe Exportaci&oacute;n',
                                    name: 'car',
                                    inputValue: 'jefe_exportacion'
                                }, {
                                    boxLabel: 'Contacto Operativo',
                                    name: 'car',
                                    inputValue: 'contacto_operativo'
                                }, {
                                    boxLabel: 'Ventas',
                                    name: 'car',
                                    inputValue: 'ventas'
                                }, {
                                    boxLabel: 'Otro',
                                    name: 'car',
                                    inputValue: 'otro'
                                }, {
                                    boxLabel: 'Jefe Exportaci&oacute;n',
                                    name: 'car',
                                    inputValue: 'jefe_exportacion'
                                }, {
                                    boxLabel: 'Representante Legal',
                                    name: 'car',
                                    inputValue: 'representante_legal'
                                }
                            ],
                            listeners: {
                                change: function (me, newValue, oldValue, eOpts) {

                                    if (newValue.car == 'otro') {
                                        Ext.getCmp('otro_radio').setVisible(true);
                                    } else {
                                        Ext.getCmp('otro_radio').setVisible(false);
                                    }
                                }
                            }
                        },
                        {
                            xtype: 'textfield',
                            fieldLabel: 'Otro',
                            name: 'otro_radio',
                            hidden: true,
                            id: "otro_radio"
                        }]
                },
                {
                    xtype: 'fieldset',
                    title: 'Visibilidad',
                    columnWidth: 0.49,
                    layout: 'column',
                    items: [{
                            xtype: 'radiogroup',
                            id: 'visibilidad',
                            name: 'visibilidad',
                            columns: 1,
                            items: [
                                {
                                    boxLabel: 'Todos',
                                    name: 'vis',
                                    inputValue: 'todos'
                                }, {
                                    boxLabel: 'Admon. Proveedores',
                                    name: 'vis',
                                    inputValue: 'admon_proveedores'
                                }
                            ]
                        }]
                },
                {
                    xtype: 'fieldset',
                    title: 'Sugerido',
                    columnWidth: 0.49,
                    layout: 'column',
                    items: [{
                            xtype: 'checkboxgroup',
                            id: 'sugerido',
                            name: 'sugerido',
                            columns: 1,
                            items: [
                                {
                                    boxLabel: 'Sugerir en Colsys',
                                    name: 'sugerir',
                                    inputValue: 'sugerir'
                                }
                            ]
                        }]
                },
                {
                    xtype: 'fieldset',
                    title: 'Activo',
                    columnWidth: 0.49,
                    layout: 'column',
                    items: [{
                            xtype: 'checkboxgroup',
                            id: 'activo',
                            name: 'activo',
                            columns: 1,
                            items: [
                                {
                                    boxLabel: 'Activo',
                                    name: 'act',
                                    inputValue: 'activo'
                                }
                            ]
                        }]
                },
                {
                    xtype: 'fieldset',
                    columnWidth: 0.49,
                    layout: 'column',
                    items: [{
                            xtype: 'checkboxgroup',
                            id: 'notificar',
                            name: 'notificar',
                            columns: 1,
                            items: [
                                {
                                    boxLabel: 'Notificar Vencimiento de documentos',
                                    name: 'not',
                                    inputValue: 'notificar'
                                }
                            ]
                        }]
                },
                {
                    xtype: 'tbspacer',
                    height: 10,
                    columnWidth: 1
                },
                {
                    xtype: 'textareafield',
                    fieldLabel: 'Observaciones',
                    name: 'observaciones',
                    id: "observaciones",
                    columnWidth: 0.98
                }
            ]}],
    buttons: [{
            text: 'Guardar',
            formBind: true,
            handler: function () {
                var idsucursal = this.up('form').idsucursal;
                var idcontacto = this.up('form').idcontacto;
                var form = this.up('form').getForm();

                if (form.isValid()) {
                    form.submit({
                        url: '/crm/guardarContacto',
                        waitMsg: 'Guardando',
                        params: {
                            idsucursal: idsucursal,
                            idcontacto: idcontacto
                        },
                        success: function (fp, o) {
                            Ext.getCmp("winFormEdit").destroy();
                            Ext.Msg.alert("Contacto", "Datos almacenados correctamente");
                        }
                    });
                }
            }
        }],
    listeners: {
        afterrender: function (me, eOpts) {

        }
    }

});