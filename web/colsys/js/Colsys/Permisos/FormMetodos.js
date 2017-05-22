
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//$grupos = $sf_data->getRaw("grupos");



aumento = 0;

Ext.define('ModelRutinaCompleto', {
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

var storeRutinaCompleto = Ext.create('Ext.data.Store', {
    autoLoad: false,
    model: 'ModelRutinaCompleto',
    proxy: {
        type: 'ajax',
        url: '/users/datosRutinaCompleto',
        reader: {
            type: 'json',
            root: 'root'
        },
        extraParams: {
        },
        filterParam: 'query',
    }
});


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

var storeRutinaF = Ext.create('Ext.data.Store', {
    autoLoad: false,
    model: 'ModelRutina',
    proxy: {
        type: 'ajax',
        url: '/users/datosRutinaId',
        reader: {
            type: 'json',
            root: 'root'
        },
        filterParam: 'query'
    }
});


Ext.define('ComboRutinas', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-rutinas',
    queryMode: 'local',
    valueField: 'ca_rutina',
    displayField: 'ca_opcion',
    store: storeRutina
});

Ext.define('Colsys.Permisos.FormMetodos', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Permisos.FormMetodos',
    bodyPadding: 5,
    title: 'Administraci&oacute;n de M&eacute;todos',
    store: storeRutina,
    width: 1150,
    height: 340,
    listeners: {
        afterrender: function (me, eOpts) {
            this.add({
                xtype:'tbspacer',
                width: 100
            },{
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
                                hidden: true,
                                name: 'ca_rutina',
                                id: 'ca_rutina' + this.idrutina,
                                width: 220


                            }, {
                                xtype: 'textfield',
                                fieldLabel: 'Opci&oacute;n',
                                name: 'ca_opcion',
                                id: 'ca_opcion'+ this.idrutina,
                                width: 330,
                            }, {
                                xtype: 'combo-grupo',
                                fieldLabel: 'Grupo',
                                style: 'padding-left: 5px;',
                                name: 'ca_grupo',
                                id: 'ca_grupo'+ this.idrutina,
                                width: 300,
                            }, {
                                xtype: 'tbspacer',
                                height: 10,
                                width: 700,
                            }, {
                                xtype: 'textareafield',
                                fieldLabel: 'Programa',
                                name: 'ca_programa',
                                id: 'ca_programa'+ this.idrutina,
                                width: 330,
                            }, {
                                xtype: 'textareafield',
                                fieldLabel: '&iacute;cono',
                                name: 'ca_icon',
                                style: 'padding-left: 5px;',
                                id: 'ca_icon'+ this.idrutina,
                                width: 300,
                            }, {
                                xtype: 'tbspacer',
                                height: 10,
                                width: 700,
                            }, {
                                xtype: 'textareafield',
                                fieldLabel: 'URL',
                                name: 'ca_url',
                                id: 'ca_url'+ this.idrutina,
                                width: 330,
                            }, {
                                xtype: 'textareafield',
                                fieldLabel: 'Descripci&oacute;n',
                                name: 'ca_descripcion',
                                style: 'padding-left: 5px;',
                                id: 'ca_descripcion'+ this.idrutina,
                                width: 300,
                            }, {
                                xtype: 'tbspacer',
                                height: 10,
                                width: 700,
                            }, {
                                xtype: 'combo-aplicacion',
                                fieldLabel: 'Aplicaci&oacute;n',
                                name: 'ca_aplicacion',
                                id: 'ca_aplicacion'+ this.idrutina,
                                width: 330,
                            }, {
                                xtype: 'combo-visible',
                                fieldLabel: 'Visible',
                                name: 'ca_visible',
                                style: 'padding-left: 5px;',
                                id: 'ca_visible'+ this.idrutina,
                                width: 300
                            }]
                    }]
            });





            var f = this.getForm();
            f.load({
                url: '/users/datosRutinaId',
                params: {
                    idrutina: this.idrutina
                }
            });
        }
    },
    dockedItems: [{
            hidden: true,
            xtype: 'toolbar',
            dock: 'top',
            height: 44,
            items: [{
                    xtype: 'combo-rutinas',
                    hidden: true,
                    width: 400,
                    enableKeyEvents: true,
                    listeners: {
                        keyup: function (combo, e, eOpts) {
                            if (combo.value.toString().length > 3 && combo.value != null) {
                                storeRutina.load({
                                    params: {
                                        nombre: combo.value
                                    }
                                });
                            }
                        },
                        select: function (combo, records, eOpts) {
                            var datos = storeRutina.findRecord('ca_rutina', combo.value);
                            var me = this;
                            var form = me.up('form').getForm();
                            form.loadRecord(datos);
                            var rutina = datos.get('ca_rutina');
                            storeMetodos.load({
                                params: {
                                    rutina: rutina
                                }
                            });
                        }
                    }

                }, /* {
                 xtype: 'tbspacer',
                 width: 150,
                 }, */{
                    text: '',
                    iconCls: 'add',
                    hidden: true,
                    handler: function () {
                        var me = this;
                        var form = me.up('form').getForm();
                        var store = storeRutina;
                        var r = Ext.create(store.model);

                        r.set('ca_rutina', '');
                        r.set('ca_nivel', '');
                        r.set('ca_valor', '');
                        r.set('ca_idrutina_niveles', '');
                        r.set('ca_descripcion', '');
                        r.set('seleccionado', false);

                        form.loadRecord(r);
                        storeMetodos.reset();
                    }
                }, {
                    text: 'Guardar',
                    iconCls: 'disk',
                    handler: function () {
                    }
                }]
        }],
    guardar: function () {
        var me = this;
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
                url: '/users/guardarFormMetodos',
                params: {
                    datos: str
                },
                failure: function (response, options) {
                    var res = Ext.util.JSON.decode(response.responseText);
                    if (res.errorInfo)
                        Ext.MessageBox.alert("Mensaje", 'Debe diligenciar completamente el formulario');
                },
                success: function (response, options) {
                    var res = Ext.decode(response.responseText);
                    ids = res.ids;
                    if (res.success) {
                        Ext.MessageBox.alert("Mensaje", 'Datos Almacenados Correctamente<br>');

                    } else {
                        Ext.MessageBox.alert("Mensaje", '...Datos Incompletos<br>');
                    }
                }
            });
        } else {
            Ext.MessageBox.alert("Mensaje", 'Datos Incompletos<br>');
        }
        return falla;
    }
});




