Ext.define('ComboSiNo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-si-no',
    store: ['SI', 'NO']
});

Ext.define('Colsys.Crm.FormTabManejoMercanciasFicha', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormTabManejoMercanciasFicha',
    listeners: {
        beforerender: function (ct, position) {
            var me = this;
            this.add(
                    {
                        xtype: 'fieldset',
                        id: 'fieldsetImportaciones_ficha' + me.idcliente,
                        hideLabel: false,
                        title: 'Importaciones',
                        width: 980,
                        collapsible: false,
                        layout: 'hbox',
                        items: [{
                                xtype: 'fieldset',
                                id: 'fieldsetIzqManejoMercancias_ficha' + me.idcliente,
                                hideLabel: true,
                                width: 430,
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
                                        id: 'fieldcontainerIzqManejoMercancias_ficha' + me.idcliente,
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
                                                xtype: 'checkboxgroup',
                                                name: 'operacion_zonafranca',
                                                id: 'operacion_zonafranca' + me.idcliente,
                                                labelAlign: 'left',
                                                fieldLabel: 'Operaciones zona franca',
                                                labelWidth: 110,
                                                vertical: false,
                                                items: [
                                                    {boxLabel: '', name: 'operacion_zonafrancaMM', inputValue: '1', width: 60}
                                                ]
                                            }, {
                                                xtype: 'textfield',
                                                fieldLabel: 'Dep&oacute;sito Zona Franca',
                                                name: 'deposito_zonafrancaMM',
                                                id: 'deposito_zonafrancaMM' + me.idcliente,
                                                labelWidth: 110,
                                                width: 170
                                            }, {
                                                xtype: 'checkboxgroup',
                                                name: 'dta',
                                                id: 'dta' + me.idcliente,
                                                fieldLabel: 'DTA',
                                                labelWidth: 110,
                                                vertical: false,
                                                items: [
                                                    {boxLabel: '', name: 'dtaMM', inputValue: '1', width: 60}
                                                ]
                                            }, {
                                                xtype: 'checkboxgroup',
                                                name: 'otm',
                                                id: 'otm' + me.idcliente,
                                                fieldLabel: 'OTM',
                                                labelWidth: 110,
                                                vertical: false,
                                                items: [
                                                    {boxLabel: '', name: 'otmMM', inputValue: '1', width: 60}
                                                ]
                                            }, {
                                                xtype: 'checkboxgroup',
                                                name: 'descargue_directo',
                                                id: 'descargue_directo' + me.idcliente,
                                                fieldLabel: 'Descargue Directo',
                                                labelWidth: 110,
                                                vertical: false,
                                                items: [
                                                    {boxLabel: '', name: 'descargue_directoMM', inputValue: '1', width: 60}
                                                ]

                                            }, {
                                                xtype: 'checkboxgroup',
                                                name: 'anticipada',
                                                id: 'anticipada' + me.idcliente,
                                                fieldLabel: 'Anticipada',
                                                labelWidth: 110,
                                                vertical: false,
                                                items: [
                                                    {boxLabel: '', name: 'anticipadaMM', inputValue: '1', width: 60}
                                                ]

                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'preinspeccionesMM',
                                                id: 'preinspeccionesMM' + me.idcliente,
                                                fieldLabel: 'Preinspecciones/Inventario previo de mercancias',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'serialesMM',
                                                id: 'serialesMM' + me.idcliente,
                                                fieldLabel: 'Toma de Seriales',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'desembalajeMM',
                                                id: 'desembalajeMM' + me.idcliente,
                                                fieldLabel: 'Desembalaje/ Separaci&oacute;n de bultos',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'sanidadMM',
                                                id: 'sanidadMM' + me.idcliente,
                                                fieldLabel: 'Inspecci&oacute;n SANIDAD e ICA',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'textfield',
                                                name: 'productosMM',
                                                id: 'productosMM' + me.idcliente,
                                                fieldLabel: 'Productos',
                                                width: 400,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'tbspacer',
                                                height: 10
                                            }, {
                                                xtype: 'textareafield',
                                                name: 'averiasMM',
                                                id: 'averiasMM' + me.idcliente,
                                                fieldLabel: 'Procedimiento / inconsistencias, aver&iacute;as o faltantes',
                                                width: 400,
                                                labelWidth: 150
                                            }]
                                    }]
                            }, {
                                xtype: 'fieldset',
                                id: 'fieldsetDerManejoMercancias_ficha' + me.idcliente,
                                hideLabel: true,
                                width: 620,
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
                                        id: 'fieldcontainerDerManejoMercancias_ficha' + me.idcliente,
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
                                                name: 'ajustadoresMM',
                                                id: 'ajustadoresMM' + me.idcliente,
                                                fieldLabel: 'Presencia de ajustadores de seguros',
                                                width: 250,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'tbspacer',
                                                width: 10
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'funcionarioMM',
                                                id: 'funcionarioMM' + me.idcliente,
                                                fieldLabel: 'Presencia funcionario COLMAS',
                                                width: 250,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'representante_clienteMM',
                                                id: 'representante_clienteMM' + me.idcliente,
                                                fieldLabel: 'Presencia representante del cliente',
                                                width: 250,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'tbspacer',
                                                width: 10
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'segurosMM',
                                                id: 'segurosMM' + me.idcliente,
                                                width: 250,
                                                fieldLabel: 'Presencia funcionario de C&iacute;a de Seguros',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'fotograficosMM',
                                                id: 'fotograficosMM' + me.idcliente,
                                                width: 250,
                                                fieldLabel: 'Registros fotogr&aacute;ficos y f&iacute;lmicos',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'tbspacer',
                                                width: 10
                                            }, {
                                                xtype: 'textfield',
                                                name: 'controladosMM',
                                                id: 'controladosMM' + me.idcliente,
                                                width: 500,
                                                fieldLabel: 'Productos Controlados',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'checkboxgroup',
                                                name: 'coord_despacho',
                                                id: 'coord_despacho' + me.idcliente,
                                                fieldLabel: 'Coordinar despacho trasnporte y entrega',
                                                labelWidth: 250,
                                                vertical: false,
                                                items: [
                                                    {boxLabel: '', name: 'coord_despachoMM', inputValue: '1', width: 60}
                                                ]
                                            }, {
                                                xtype: 'checkboxgroup',
                                                name: 'escolta',
                                                id: 'escolta' + me.idcliente,
                                                fieldLabel: 'Escolta',
                                                labelWidth: 100,
                                                vertical: false,
                                                items: [
                                                    {boxLabel: '', name: 'escoltaMM', inputValue: '1', width: 60}
                                                ]
                                            }, {
                                                xtype: 'textfield',
                                                name: 'poliza_transporteMM',
                                                id: 'poliza_transporteMM' + me.idcliente,
                                                width: 500,
                                                fieldLabel: 'Condiciones contractuales de P&oacute;liza de transporte',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'textfield',
                                                name: 'horario_reciboMM',
                                                id: 'horario_reciboMM' + me.idcliente,
                                                width: 500,
                                                fieldLabel: 'Horario de recibo de mercanc&iacute;a en planta o bodega',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'textareafield',
                                                name: 'instrucciones_especialesMM',
                                                id: 'instrucciones_especialesMM' + me.idcliente,
                                                width: 500,
                                                fieldLabel: 'Instrucciones especiales',
                                                labelWidth: 150
                                            }]
                                    }]
                            }]
                    }
            );
        }
    }
});