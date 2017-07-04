Ext.define('Colsys.Crm.FormTabDocumentacionFicha', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormTabDocumentacionFicha',
    listeners: {
        
        afterrender: function (ct, position) {
            var me = this;
            this.add(
                    {
                        xtype: 'tbspacer',
                        width: 150
                    },
                    {
                        labelAlign: 'left',
                        xtype: 'fieldset',
                        id: 'fieldsetGeneralDoc_ficha' + me.idcliente,
                        hideLabel: true,
                        width: 800,
                        collapsible: false,
                        defaults: {
                            labelWidth: 89,
                            anchor: '90%',
                            layout: {
                                type: 'column',
                                defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                            }},
                        items: [{
                                xtype: 'fieldset',
                                id: 'fieldsetRegistroLic_ficha' + me.idcliente,
                                title: 'Registro o Licencia de Importaci&oacute;n',
                                width: 610,
                                collapsible: false,
                                defaults: {
                                    labelWidth: 89,
                                    anchor: '90%',
                                    layout: {
                                        type: 'column',
                                        defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                    }},
                                items: [{
                                        xtype: 'fieldcontainer',
                                        id: 'fieldcontainerRegistroLic_ficha' + me.idcliente,
                                        hideLabel: true,
                                        combineErrors: true,
                                        height: 45,
                                        msgTarget: 'under',
                                        layout: 'column',
                                        defaults: {
                                            flex: 1,
                                            hideLabel: false
                                        },
                                        items: [{
                                                xtype: 'checkboxgroup',
                                                name: 'registro_importacion',
                                                id: 'registro_importacion' + me.idcliente,
                                                vertical: false,
                                                width: 500,
                                                items: [
                                                    {boxLabel: 'Colmas', name: 'registro_importacionColmas', inputValue: '1', width: 60},
                                                    {boxLabel: 'Otro', name: 'registro_importacionOtro', inputValue: '2', width: 40}
                                                ]

                                            }]
                                    }]
                            }, {
                                xtype: 'fieldset',
                                id: 'fieldsetTextDoc_ficha' + me.idcliente,
                                title: '',
                                width: 610,
                                collapsible: false,
                                defaults: {
                                    labelWidth: 89,
                                    anchor: '100%',
                                    layout: {
                                        type: 'column',
                                        defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                    }},
                                items: [{
                                        xtype: 'fieldcontainer',
                                        id: 'fieldcontainerTextDoc_ficha' + me.idcliente,
                                        hideLabel: true,
                                        combineErrors: true,
                                        height: 300,
                                        msgTarget: 'under',
                                        layout: 'column',
                                        columnWidth: 1,
                                        defaults: {
                                            columnWidth: 1,
                                            bodyStyle: 'padding:4px'
                                        },
                                        items: [{
                                                xtype: 'textfield',
                                                hideLabel: false,
                                                labelAlign: 'left',
                                                fieldLabel: 'Instrucciones para manejo de saldos, en registros globales',
                                                labelWidth: 200,
                                                name: 'instrucciones',
                                                id: 'instrucciones' + me.idcliente,
                                                width: 650
                                            }, {
                                                xtype: 'textfield',
                                                hideLabel: false,
                                                fieldLabel: 'Env&iacute;o Factura comercial',
                                                labelWidth: 200,
                                                name: 'envio_faccomercial',
                                                id: 'envio_faccomercial' + me.idcliente,
                                                width: 650
                                            }, {
                                                xtype: 'tbspacer',
                                                height: 25,
                                                columnWidth: 1
                                            }, {
                                                xtype: 'textfield',
                                                hideLabel: false,
                                                fieldLabel: 'Env&iacute;o Lista de Empaque',
                                                labelWidth: 200,
                                                name: 'envio_listaempaque',
                                                id: 'envio_listaempaque' + me.idcliente,
                                                width: 650
                                            }, {
                                                xtype: 'tbspacer',
                                                height: 30
                                            }, {
                                                xtype: 'textfield',
                                                hideLabel: false,
                                                fieldLabel: 'Env&iacute;o Certificados de origen',
                                                labelWidth: 200,
                                                name: 'envio_certorigen',
                                                id: 'envio_certorigen' + me.idcliente,
                                                width: 650
                                            }, {
                                                xtype: 'tbspacer',
                                                height: 30
                                            }, {
                                                xtype: 'textfield',
                                                hideLabel: false,
                                                fieldLabel: 'Env&iacute;o certificados sanitarios',
                                                labelWidth: 200,
                                                name: 'envio_certsanitarios',
                                                id: 'envio_certsanitarios' + me.idcliente,
                                                width: 650
                                            }, {
                                                xtype: 'tbspacer',
                                                height: 30
                                            }, {
                                                xtype: 'textfield',
                                                hideLabel: false,
                                                fieldLabel: 'Env&iacute;o certificados Fitosanitarios y Zoosanitarios',
                                                labelWidth: 200,
                                                name: 'envio_certfitozoo',
                                                id: 'envio_certfitozoo' + me.idcliente,
                                                width: 650
                                            }, {
                                                xtype: 'tbspacer',
                                                height: 30
                                            }, {
                                                xtype: 'textareafield',
                                                hideLabel: false,
                                                fieldLabel: 'Otras Instrucciones',
                                                labelAlign: 'left',
                                                labelWidth: 200,
                                                name: 'instrucciones_detalle',
                                                id: 'instrucciones_detalle' + me.idcliente,
                                                width: 650
                                            }]
                                    }]
                            }]
                    }
            );
        }
    }
});