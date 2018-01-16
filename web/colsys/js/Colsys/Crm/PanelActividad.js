
Ext.define('Colsys.Crm.PanelActividad', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.PanelActividad',
    bodyPadding: 5,
    layout: 'column',
    autoHeight: true,
    defaults: {
        columnWidth: 1,
        style: "text-align: left",
        labelAlign: 'right'
    },
    listeners: {
        render: function (me, eOpts) {
            this.add(
                    [{
                            xtype: 'fieldset',
                            title: 'Actividad',
                            columnWidth: 0.8,
                            height: 50,
                            style: 'background: #F2F2F2;',
                            defaults: {
                                anchor: '110%',
                                layout: {
                                    type: 'hbox',
                                    defaultMargins: {top: 0, right: 5, bottom: 0, left: 0}
                                }
                            },
                            items: [
                                {
                                    xtype: 'fieldcontainer',
                                    msgTarget: 'under',
                                    defaults: {
                                        hideLabel: true,
                                        readOnly: true
                                    },
                                    items: [
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'actividad_economica',
                                            id: "actividad_economica" + this.idcliente,
                                            width: 740
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            xtype: 'fieldset',
                            title: 'Preferencias',
                            columnWidth: 0.8,
                            height: 300,
                            style: 'background: #F2F2F2;',
                            defaults: {
                                anchor: '110%',
                                layout: {
                                    type: 'hbox',
                                    defaultMargins: {top: 0, right: 5, bottom: 0, left: 0}
                                }
                            },
                            items: [
                                {
                                    xtype: 'fieldcontainer',
                                    msgTarget: 'under',
                                    defaults: {
                                        hideLabel: true,
                                        autoHeight: true,
                                        readOnly: true
                                    },
                                    items: [
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'preferencias',
                                            style: 'height: 100px;',
                                            id: "preferencias" + this.idcliente,
                                            width: 740,
//                                            height: 170
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            xtype: 'fieldset',
                            title: 'Cumplimiento de la documentaci&oacute;n para Circular 0170',
                            columnWidth: 0.8,
                            height: 60,
                            defaults: {
                                anchor: '110%',
                                layout: {
                                    type: 'hbox',
                                    defaultMargins: {top: 0, right: 5, bottom: 0, left: 0}
                                }
                            },
                            items: [
                                {
                                    xtype: 'fieldcontainer',
                                    msgTarget: 'under',
                                    defaults: {
                                        hideLabel: true,
                                        readOnly: true
                                    },
                                    margin: '3 0 0 0',
                                    items: [
                                        {xtype: 'displayfield', value: 'Coltrans: ', width: 90, id: "labelColtrans" + this.idcliente, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'coltrans',
                                            id: "coltrans" + this.idcliente,
                                            width: 93
                                        },
                                        {xtype: 'displayfield', value: 'Colmas: ', width: 90, id: "labelColmas" + this.idcliente, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'colmas',
                                            id: "colmas" + this.idcliente,
                                            width: 93
                                        },
                                        {xtype: 'displayfield', value: 'ColOTM: ', width: 90, id: "labelColOTM" + this.idcliente, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'colotm',
                                            id: "colotm" + this.idcliente,
                                            width: 93
                                        },
                                        {xtype: 'displayfield', value: 'ColDep&oacute;sitos: ', width: 95, id: "labelColdepositos" + this.idcliente, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'coldepositos',
                                            id: "coldepositos" + this.idcliente,
                                            width: 93
                                        }
                                    ]
                                }
                            ]
                        }]
                    );
        },
        afterrender: function (me, eOpts) {
            //alert(this.idsucursal);
            form = this.getForm();
            form.load({
                url: '/crm/datosCliente',
                params: {
                    idcliente: this.idcliente
                },
                success: function () {
                }
            });
        }
    }
});