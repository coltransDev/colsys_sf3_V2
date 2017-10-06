Ext.define('Colsys.Ino.FormGenerarXml', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormGenerarXml',
    id: 'FormGenerarXml',
    name: 'FormGenerarXml',
    autoHeight: true,
    autoScroll: false,
    border: false,
    //width: 600,
    fieldDefaults: {
        labelAlign: 'right',
        labelWidth: 200,
        msgTarget: 'qtip'
    },
    items: [{
            xtype: 'fieldset',
            title: 'M\u00F3dulo Muisca',
            defaultType: 'textfield',
            margin: '0 0 5 0',
            layout: 'anchor',
            defaults: {
                anchor: '100%'
            },
            items: [{
                    height: 30,
                    xtype: 'label',
                    style: 'display:inline-block;text-align:center',
                    text: 'N\u00FAmero tomado de la P\u00E1gina de la Dian.'
                }, {
                    xtype: 'numberfield',
                    fieldLabel: 'Ingrese el N\u00FAmero de Env\u00EDo',
                    name: 'NumEnvio',
                    anchor: '100%',
                    allowBlank: false,
                    hideTrigger: true,
                    decimalPrecision: 0,
                    keyNavEnabled: false,
                    mouseWheelEnabled: false
                }
            ]
        }
    ],
    buttons: [{
            text: 'Generar Archivo',
            formBind: true,
            handler: function () {
                var me = this;
                var form = this.up('form').getForm();
                var data = form.getFieldValues();

                if (form.isValid()) {
                    new Ext.create('Ext.form.Panel', {
                        items: {
                            xtype: 'component',
                            autoEl: {
                                src: '/inoF2/generacionArchivoXml/idmaster/' + this.up('form').idmaster + '/NumEnvio/' + data.NumEnvio,
                                tag: 'iframe'
                            }
                        },
                        renderTo: Ext.getBody()
                    });
                }
            },
            listeners: {
                click: function (button, e, eOpts) {
                    Ext.MessageBox.show({
                        msg: 'Generando Archivo XML, por favor espere...',
                        progressText: 'Procesando...',
                        width: 300,
                        wait: true,
                        waitConfig: {interval: 200},
                        animateTarget: 'waitButton'
                    });
                    setTimeout(function () {
                        Ext.MessageBox.hide();
                    }, 8000);
                }
            }
        }]

});
