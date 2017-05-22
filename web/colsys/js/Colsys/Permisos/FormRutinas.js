Ext.define('ComboAplicacion', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-aplicacion',
    store: ['colsys', 'intranet']
});

Ext.define('ComboVisible', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-visible',
    store: ['SI', 'NO']
});

Ext.define('ComboGrupo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-grupo',
    queryMode: 'local',
    valueField: 'grupo',
    displayField: 'grupo',
    store: Ext.create('Ext.data.Store', {
        autoLoad: true,
        fields: [
            {name: 'grupo', type: 'string'}
        ],
        proxy: {
            type: 'ajax',
            url: '/users/datosGrupo',
            reader: {
                type: 'json',
                root: 'root'
            },
            filterParam: 'query'
        }
    })
});


Ext.define('ModelRutina', {
    extend: 'Ext.data.Model',
    fields: [
        {name: 'ca_rutina', type: 'string'},
        {name: 'ca_opcion', type: 'string'},
        {name: 'ca_descripcion', type: 'string'},
        {name: 'ca_programa', type: 'string'},
        {name: 'ca_grupo', type: 'string'},
        {name: 'ca_url', type: 'string'},
        {name: 'ca_icon', type: 'string'},
        {name: 'ca_aplicacion', type: 'string'}
    ]
});

var storeRutina = Ext.create('Ext.data.Store', {
    autoLoad: false,
    model: 'ModelRutina',
    proxy: {
        type: 'ajax',
        url: '/users/datosRutina',
        reader: {
            type: 'json',
            root: 'root'
        },
        filterParam: 'query',
    }
});


Ext.define('Colsys.Permisos.FormRutinas', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Permisos.FormRutinas',
    store: storeRutina,
    bodyPadding: 5,
    defaults: {
        columnWidth: 0.5,
        bodyStyle: 'padding:4px',
        labelWidth: 100,
    },
    items: [{
            xtype: 'fieldset',
            width: 690,
            height: 240,
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
                            height: 10,
                            width: 700,
                        }, {
                            xtype: 'textfield',
                            fieldLabel: 'Rutina',
                            name: 'ca_rutina',
                            id: 'ca_rutina',
                            width: 630,
                            hidden: true
                        }, {
                            xtype: 'textfield',
                            fieldLabel: 'Opci&oacute;n',
                            name: 'ca_opcion',
                            id: 'ca_opcion',
                            width: 330
                        }, {
                            xtype: 'combo-grupo',
                            fieldLabel: 'Grupo',
                            style: 'padding-left: 5px;',
                            name: 'ca_grupo',
                            id: 'ca_grupo',
                            width: 300
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            width: 700
                        }, {
                            xtype: 'textareafield',
                            fieldLabel: 'Programa',
                            name: 'ca_programa',
                            id: 'ca_programa',
                            width: 330
                        }, {
                            xtype: 'textareafield',
                            fieldLabel: '&iacute;cono',
                            name: 'ca_icon',
                            style: 'padding-left: 5px;',
                            id: 'ca_icon',
                            width: 300
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            width: 700
                        }, {
                            xtype: 'textareafield',
                            fieldLabel: 'URL',
                            name: 'ca_url',
                            id: 'ca_url',
                            width: 330
                        }, {
                            xtype: 'textareafield',
                            fieldLabel: 'Descripci&oacute;n',
                            name: 'ca_descripcion',
                            style: 'padding-left: 5px;',
                            id: 'ca_descripcion',
                            width: 300
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            width: 700
                        }, {
                            xtype: 'combo-aplicacion',
                            fieldLabel: 'Aplicaci&oacute;n',
                            name: 'ca_aplicacion',
                            id: 'ca_aplicacion',
                            width: 330
                        }, {
                            xtype: 'combo-visible',
                            fieldLabel: 'Visible',
                            name: 'ca_visible',
                            style: 'padding-left: 5px;',
                            id: 'ca_visible',
                            width: 300
                        }]
                }]
        }

    ],
    buttons: [{
            text: 'Guardar',
            formBind: true,
            handler: function () {

                var me = this.up('form');
                var falla = 0;
                var form = me.getForm();
                var data = form.getFieldValues();

                if (data.ca_opcion == "" || data.ca_descripcion == "" || data.ca_programa == ""
                        || data.ca_icon == "" || data.ca_aplicacion == "") {
                    falla = 1;
                }
                var str = JSON.stringify(data);

                if (falla == 0) {

                    Ext.Ajax.request({
                        waitMsg: 'Guardando cambios...',
                        url: '/users/guardarFormRutinas',
                        params: {
                            datos: str
                        },
                        failure: function (response, options) {
                            var res = Ext.util.JSON.decode(response.responseText);
                            if (res.errorInfo)
                                Ext.MessageBox.alert("Mensaje", res.errorInfo);
                        },
                        success: function (response, options) {
                            var res = Ext.decode(response.responseText);
                            ids = res.ids;
                            if (res.success) {
                                Ext.MessageBox.alert("Mensaje", 'Datos Almacenados Correctamente<br>');
                                tabpanel = Ext.getCmp('tabpanel1');

                                ref = res.idrutina;

                                tabpanel.add(
                                            {
                                                width: 900,
                                                title: res.nombre,
                                                id: 'tab' + ref,
                                                itemId: 'tab' + ref,
                                                closable: true,
                                                autoScroll: true,
                                                items: [
                                                    Ext.create("Colsys.Permisos.FormMetodos", {
                                                        id: "form" + res.idrutina,
                                                        idrutina:res.idrutina
                                                    }),
                                                    Ext.create("Colsys.Permisos.GridMetodos", {
                                                        id: "grid" + res.idrutina,
                                                        idrutina: res.idrutina
                                                    })
                                                ],
                                                dockedItems: [{
                                                        xtype: 'toolbar',
                                                        dock: 'top',
                                                        height: 44,
                                                        items: [{
                                                                xtype: 'button',
                                                                text: 'Guardar',
                                                                iconCls: 'disk',
                                                                handler: function () {
                                                                    var g = Ext.getCmp("form" + res.idrutina).guardar();
                                                                    if (g == 0)
                                                                        Ext.getCmp("grid" + res.idrutina).guardar();
                                                                }
                                                            }]
                                                    }]

                                            }).show();

                                me.up('window').close();

                            } else {
                                Ext.MessageBox.alert("Mensaje", res.errorInfo + "<br>");
                            }
                        }
                    });
                } else {
                    Ext.MessageBox.alert("Mensaje", 'Datos Incompletos<br>');
                }



            }
        }]
})