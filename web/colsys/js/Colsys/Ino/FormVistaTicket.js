
Ext.define('ModelRutina', {
    extend: 'Ext.data.Model',
    fields: [
        {name: 'ca_titulo', type: 'string'},
        {name: 'ca_reportado', type: 'string'},
        {name: 'ca_contacto', type: 'string'},
        {name: 'ca_asignado', type: 'string'},
        {name: 'ca_area', type: 'string'},
        {name: 'ca_grupo', type: 'string'},
        {name: 'ca_prioridad', type: 'string'},
        {name: 'ca_tipo', type: 'string'},
        {name: 'ca_estado', type: 'string'}
    ]
});

var storeRutina = Ext.create('Ext.data.Store', {
    autoLoad: false,
    model: 'ModelRutina',
    proxy: {
        type: 'ajax',
        url: '/inoF2/datosVistapreviaTicket',
        reader: {
            type: 'json',
            rootProperty: 'root'
        },
        filterParam: 'query',
    }
});

Ext.define('Colsys.Ino.FormVistaTicket', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormVistaTicket',
    bodyPadding: 5,
    title: 'Administraci&oacute;n de M&eacute;todos',
    //store: storeRutina,
    width: 1150,
    height: 340,
    listeners: {
        render: function (me, eOpts) {
            this.add(
                    [{
                            xtype: 'tbspacer',
                            width: 100
                        }, {
                            xtype: 'fieldset',
                            width: 330,
                            height: 295,
                            collapsible: false,
                            items: [{
                                    xtype: 'fieldcontainer',
                                    hideLabel: true,
                                    combineErrors: true,
                                    height: 45,
                                    msgTarget: 'under',
                                    layout: 'column',
                                    defaults: {
                                        flex: 2,
                                        hideLabel: false
                                    },
                                    items: [{
                                            xtype: 'tbspacer',
                                            height: 1,
                                            width: 320
                                        }, {
                                            xtype: 'displayfield',
                                            name: 'ca_titulo',
                                            fieldStyle: 'font-weight:bold;font-size:11px;height:10px;',
                                            id: 'ca_titulo',
                                            width: 310,
                                            height: 1
                                        }, {
                                            xtype: 'displayfield',
                                            name: 'ca_reportado',
                                            fieldStyle: 'font-weight:lighter;font-size:10px;;height:15  px;',
                                            id: 'ca_reportado',
                                            width: 310
                                        }, {
                                            xtype: 'displayfield',
                                            fieldLabel: '<span style="font-weight:bold;width: 20px ;font-size:10px;padding-right:40px">Contacto</span>',
                                            labelWidth: 65,
                                            fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;',
                                            name: 'ca_contacto',
                                            id: 'ca_contacto',
                                            width: 320,
                                        }, {
                                            xtype: 'tbspacer',
                                            height: 1,
                                            width: 320,
                                        }, {
                                            xtype: 'displayfield',
                                            name: 'ca_asignado',
                                            fieldLabel: '<span style="font-weight:bold;width: 20px ;font-size:10px;">Asignado a</span>',
                                            labelWidth: 65,
                                            fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;',
                                            id: 'ca_asignado',
                                            width: 150,
                                        }, {
                                            xtype: 'displayfield',
                                            fieldLabel: '<span style="font-weight:bold;width: 20px ;font-size:10px;">Area</span>',
                                            name: 'ca_area',
                                            labelWidth: 55,
                                            fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;',
                                            id: 'ca_area',
                                            width: 150,
                                        }, {
                                            xtype: 'tbspacer',
                                            height: 1,
                                            width: 320,
                                        }, , {
                                            xtype: 'displayfield',
                                            fieldLabel: '<span style="font-weight:bold;width: 20px ;font-size:10px;">Proyecto</span>',
                                            name: 'ca_proyecto',
                                            id: 'ca_proyecto',
                                            labelWidth: 65,
                                            fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;',
                                            width: 150,
                                        }, {
                                            xtype: 'displayfield',
                                            fieldLabel: '<span style="font-weight:bold;width: 20px ;font-size:10px;">Prioridad</span>',
                                            name: 'ca_prioridad',
                                            labelWidth: 55,
                                            fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;',
                                            id: 'ca_prioridad',
                                            width: 150,
                                        }, {
                                            xtype: 'tbspacer',
                                            height: 1,
                                            width: 330,
                                        }, {
                                            xtype: 'displayfield',
                                            fieldLabel: '<span style="font-weight:bold;width: 20px ;font-size:10px;">Tipo</span>',
                                            name: 'ca_tipo',
                                            labelWidth: 65,
                                            fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;',
                                            id: 'ca_tipo',
                                            width: 150,
                                        }, {
                                            xtype: 'displayfield',
                                            fieldLabel: '<span style="font-weight:bold;width: 20px ;font-size:10px;">Estado</span>',
                                            name: 'ca_estado',
                                            labelWidth: 55,
                                            fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;',
                                            id: 'ca_estado',
                                            width: 150
                                        }, {
                                            xtype: 'tbspacer',
                                            height: 1,
                                            width: 330
                                        }, {
                                            xtype: 'fieldset',
                                            width: 300,
                                            height: 150,
                                            collapsible: false,
                                            items: [{
                                                    xtype: 'fieldcontainer',
                                                    hideLabel: true,
                                                    combineErrors: true,
                                                    height: 45,
                                                    msgTarget: 'under',
                                                    layout: 'column',
                                                    defaults: {
                                                        flex: 2,
                                                        hideLabel: false
                                                    },
                                                    items: [{
                                                            xtype: 'displayfield',
                                                            hideLabel: true,
                                                            name: 'ca_descripcion',
                                                            fieldStyle: 'font-weight:lighter;font-size:10px;',
                                                            id: 'ca_descripcion',
                                                            width: 298
                                                        }]
                                                }]
                                        }]
                                }]
                        }]);

            var f = this.getForm();
            f.load({
                url: '/inoF2/datosVistapreviaTicket',
                params: {
                    idticket : this.idticket
                },
                success: function () {
                }
            });
        },
        afterrender: function (me, eOpts) {

            // Ext.getCmp("ca_titulo").text = f.data.ca_titulo;
        }
    }
});




