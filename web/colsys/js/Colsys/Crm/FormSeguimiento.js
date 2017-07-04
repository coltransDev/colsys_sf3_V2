comboBoxRenderer = function (combo) {
    return function (value) {

        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField));
    };
};

Ext.define('Colsys.Crm.FormSeguimiento', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormSeguimiento',
    bodyPadding: 5,
    id: 'FormSeguimiento',
    name: 'FormSeguimiento',
    layout: 'column',
    autoHeight: true,
    autoScroll: false,
    defaults: {
        columnWidth: 1,
        //bodyStyle:'padding:30',
        style: "text-align: left",
        labelAlign: 'right'
    },
    buttons: [{
            text: 'Guardar',
            formBind: true,
            handler: function () {
                var idcliente = this.up('form').idcliente;
                var form = this.up('form').getForm();

                if (form.isValid()) {


                    form.submit({
                        url: '/crm/guardarSeguimiento',
                        waitMsg: 'Guardando',
                        params: {
                            idcliente: idcliente
                        },
                        success: function (response, options) {
                            Ext.getCmp("winFormEdit").destroy();
                            Ext.Msg.alert("Seguimiento", "Datos almacenados correctamente");
                            Ext.getCmp("SeguimientosClientes" + idcliente).getStore().reload();
                        },
                        failure: function (form, action) {
                            Ext.Msg.alert("Seguimiento", "Error en guardar " + action.result.errorInfo + "</ br>");
                        }
                    });
                }
            }
        }],
    listeners: {
        afterrender: function (me, eOpts) {
            this.add({
                xtype: 'fieldset',
                height: 310,
                width: 550,
                title: 'General',
                columnWidth: 1,
                layout: 'column',
//            columns: 2,
                defaults: {
                    columnWidth: 0.5,
                    bodyStyle: 'padding:4px',
                    allowBlank: false
                },
                items: [
                    {
                        fieldLabel: 'Tipo de Seguimiento',
                        xtype: 'Colsys.Widgets.WgTipoSeguimiento',
                        id: 'tipo',
                        name: 'tipo',
                        columnWidth: 0.5,
                        renderer: comboBoxRenderer(this)
                    },
                    {
                        xtype: 'tbspacer',
                        height: 25,
                        columnWidth: 1
                    },
                    {
                        xtype: 'textfield',
                        fieldLabel: 'Asunto',
                        name: 'asunto',
                        id: "asunto",
                        columnWidth: 0.8
                    },
                    {
                        xtype: 'tbspacer',
                        height: 25,
                        columnWidth: 1
                    },
                    {
                        xtype: 'textareafield',
                        fieldLabel: 'Detalle',
                        name: 'detalle',
                        id: "detalle",
                        columnWidth: 1
                    },
                    {
                        xtype: 'tbspacer',
                        height: 25,
                        columnWidth: 1
                    },
                    {
                        xtype: 'textareafield',
                        fieldLabel: 'Compromisos',
                        name: 'compromisos',
                        id: "compromisos",
                        columnWidth: 1
                    },
                    {
                        xtype: 'tbspacer',
                        height: 25,
                        columnWidth: 1
                    },
                    {
                        xtype: 'datefield',
                        fieldLabel: 'Cumplir Antes de',
                        name: 'fecha',
                        id: "fecha",
                        columnWidth: 0.5,
                        format: 'Y-m-d',
                        submitFormat: 'Y-m-d'
                    },
                    {
                        xtype: 'tbspacer',
                        height: 25,
                        columnWidth: 1
                    },
                    {
                        fieldLabel: 'Seguimiento Antecesor',
                        xtype: 'Colsys.Widgets.WgSeguimientoAntecesor',
                        id: 'seguimiento_antecesor',
                        name: 'seguimiento_antecesor',
                        columnWidth: 0.7,
                        idcliente: this.idcliente
                    }
                ]});
        }
    }

});