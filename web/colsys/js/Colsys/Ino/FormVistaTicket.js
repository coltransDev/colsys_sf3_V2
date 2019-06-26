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
    autoWidth: true,
    autoHeigth: true,
    listeners: {
        render: function (me, eOpts) {
            var me = this;
            this.add(
                [{
                    xtype: 'tbspacer',
                    width: 100
                }, {
                xtype: 'fieldset',
                autoHeigth: true,
                collapsible: false,
                items: [{
                    xtype: 'fieldcontainer',
                    hideLabel: true,
                    combineErrors: true,                    
                    msgTarget: 'under',
                    layout: 'column',
                    defaults: {
                        columnWidth: 0.5,
                        labelWidth: 65,
                        hideLabel: false
                    },
                    items: [{
                        xtype: 'displayfield',
                        name: 'ca_titulo',
                        fieldStyle: 'font-weight:bold;font-size:11px;height:10px;',
                        id: 'ca_titulo'+ me.idmaster,
                        columnWidth: 1
                    }, {
                        xtype: 'displayfield',
                        name: 'ca_reportado',
                        fieldStyle: 'font-weight:lighter;font-size:10px;;height:15  px;',
                        id: 'ca_reportado'+ me.idmaster,
                        columnWidth: 1
                    }, {
                        xtype: 'displayfield',
                        fieldLabel: '<span style="font-weight:bold;width: 20px ;font-size:10px;padding-right:40px">Contacto</span>',
                        fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;',
                        name: 'ca_contacto',
                        id: 'ca_contacto'+ me.idmaster
                    }, {
                        xtype: 'displayfield',
                        fieldLabel: '<span style="font-weight:bold;width: 20px ;font-size:10px;padding-right:40px">Fecha</span>',
                        fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;',
                        name: 'ca_fecha',
                        id: 'ca_fecha'+ me.idmaster
                    },{
                        xtype: 'displayfield',
                        name: 'ca_asignado',
                        fieldLabel: '<span style="font-weight:bold;width: 20px ;font-size:10px;">Asignado a</span>',
                        fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;',
                        id: 'ca_asignado'+ me.idmaster
                    }, {
                        xtype: 'displayfield',
                        fieldLabel: '<span style="font-weight:bold;width: 20px ;font-size:10px;">Proceso</span>',
                        name: 'ca_area',
                        fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;',
                        id: 'ca_area'+ me.idmaster
                    }, {
                        xtype: 'displayfield',
                        fieldLabel: '<span style="font-weight:bold;width: 20px ;font-size:10px;">Tema</span>',
                        name: 'ca_proyecto',
                        id: 'ca_proyecto'+ me.idmaster,
                        fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;'
                    }, {
                        xtype: 'displayfield',
                        fieldLabel: '<span style="font-weight:bold;width: 20px ;font-size:10px;">Status</span>',
                        name: 'ca_status',
                        fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;',
                        id: 'ca_status'+ me.idmaster
                    }, {
                        xtype: 'displayfield',
                        fieldLabel: '<span style="font-weight:bold;width: 20px ;font-size:10px;">Hallazgo</span>',
                        name: 'ca_tipo',
                        fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;',
                        id: 'ca_tipo'+ me.idmaster
                    }, {
                        xtype: 'displayfield',
                        fieldLabel: '<span style="font-weight:bold;width: 20px ;font-size:10px;">Estado</span>',
                        name: 'ca_estado',
                        fieldStyle: 'font-weight:lighter;font-size:10px;height:10px;',
                        id: 'ca_estado'+ me.idmaster
                    }, {
                        xtype: 'fieldset',
                        columnWidth: 1,
                        collapsible: false,
                        items: [{
                            xtype: 'fieldcontainer',
                            hideLabel: true,
                            combineErrors: true,
                            msgTarget: 'under',
                            layout: 'column',
                            defaults: {
                                hideLabel: false
                            },
                            items: [{
                                xtype: 'displayfield',
                                hideLabel: true,
                                name: 'ca_descripcion',
                                fieldStyle: 'font-weight:lighter;font-size:10px;',
                                id: 'ca_descripcion'+ me.idmaster
                            }]
                        }]
                    }]
                }]
            }]);
        }
    }
});