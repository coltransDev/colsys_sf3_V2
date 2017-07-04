Ext.define('ComboSiNo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-si-no',
    store: ['SI', 'NO']
});

Ext.define('Colsys.Crm.FormTabReqClienteFicha', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormTabReqClienteFicha',
    listeners: {
        beforerender: function (ct, position) {
            var me = this;
            this.add(
                    {
                        xtype: 'fieldset',
                        id: 'fieldsetReqClientes_ficha' + me.idcliente,
                        hideLabel: true,
                        title: '',
                        width: 650,
                        height: 380,
                        collapsible: false,
                        defaults: {
                            labelWidth: 89,
                            anchor: '90%',
                            layout: {
                                type: 'column',
                                defaultMargins: {top: 0, right: 25, bottom: 0, left: 25}
                            }},
                        items: [{
                                xtype: 'fieldset',
                                id: 'fieldsetReportesInf_ficha' + me.idcliente,
                                hideLabel: false,
                                title: 'Reportes e Informes',
                                width: 620,
                                height: 260,
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
                                        id: 'fieldcontainerReportesInf_ficha' + me.idcliente,
                                        hideLabel: true,
                                        combineErrors: true,
                                        height: 360,
                                        msgTarget: 'under',
                                        layout: 'column',
                                        defaults: {
                                            flex: 1,
                                            hideLabel: false
                                        },
                                        items: [{
                                                xtype: 'combo-si-no',
                                                name: 'indicadoresRE',
                                                id: 'indicadoresRE' + me.idcliente,
                                                fieldLabel: 'Presentaci&oacute;n de indicadores',
                                                width: 250,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'estadoRE',
                                                id: 'estadoRE' + me.idcliente,
                                                fieldLabel: 'Estado de D.O diario',
                                                width: 240,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'reporteRE',
                                                id: 'reporteRE' + me.idcliente,
                                                fieldLabel: 'Reporte despacho de mercancias',
                                                width: 250,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'textareafield',
                                                name: 'informesRE',
                                                id: 'informesRE' + me.idcliente,
                                                width: 500,
                                                height: 55,
                                                fieldLabel: 'Otros informes',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'combo-declaraciones',
                                                name: 'declaracionesRE',
                                                id: 'declaracionesRE' + me.idcliente,
                                                fieldLabel: 'Env&iacute;o copia de declaraciones',
                                                width: 250,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'fieldcontainer',
                                                fieldLabel: 'Aceptaci&oacute;n previa de DI',
                                                defaultType: 'checkboxfield',
                                                width: 240,
                                                labelWidth: 150,
                                                items: [
                                                    {
                                                        boxLabel: '',
                                                        name: 'registro_importacionAP',
                                                        id: 'registro_importacionAP' + me.idcliente,
                                                        inputValue: '3'
                                                    }]

                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'inhouseRC',
                                                id: 'inhouseRC' + me.idcliente,
                                                fieldLabel: 'IN HOUSE',
                                                width: 300,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'tbspacer',
                                                width: 500,
                                                height: 10
                                            }, {
                                                xtype: 'textfield',
                                                hideLabel: false,
                                                fieldLabel: 'Contacto',
                                                labelWidth: 150,
                                                name: 'contactoRC',
                                                id: 'contactoRC' + me.idcliente,
                                                width: 500
                                            }, {
                                                xtype: 'tbspacer',
                                                width: 500,
                                                height: 10
                                            }, {
                                                xtype: 'textfield',
                                                hideLabel: false,
                                                fieldLabel: 'Tel&eacute;fono',
                                                labelWidth: 150,
                                                name: 'telefonoRC',
                                                id: 'telefonoRC' + me.idcliente,
                                                width: 300
                                            }]
                                    }]
                            }, {
                                xtype: 'fieldset',
                                id: 'fieldsetIDG_ficha' + me.idcliente,
                                hideLabel: false,
                                title: 'IDG',
                                width: 620,
                                height: 90,
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
                                        id: 'fieldcontainerIDG_ficha' + me.idcliente,
                                        hideLabel: true,
                                        combineErrors: true,
                                        height: 360,
                                        msgTarget: 'under',
                                        layout: 'column',
                                        defaults: {
                                            flex: 1,
                                            hideLabel: false
                                        },
                                        items: [{
                                                xtype: 'textfield',
                                                name: 'tnacionalizacionRC',
                                                id: 'tnacionalizacionRC' + me.idcliente,
                                                fieldLabel: 'Tiempos de Nacionalizaci&oacute;n',
                                                width: 300,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'textfield',
                                                name: 'tfacturacionRC',
                                                id: 'tfacturacionRC' + me.idcliente,
                                                fieldLabel: 'Tiempos de Facturaci&oacute;n',
                                                width: 300,
                                                labelWidth: 150
                                            }]
                                    }]
                            }]
                    }
            );
        }
    }
});