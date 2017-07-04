Ext.define('Colsys.Crm.FormTabClasifRegFicha', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormTabClasifRegFicha',
    listeners: {
        beforerender: function (ct, position) {
            var me = this;
            this.add({
                xtype: 'fieldset',
                id: 'fieldsetClasifReg_ficha' + me.idcliente,
                hideLabel: true,
                width: 980,
                collapsible: false,
                layout: 'hbox',
                items: [{
                        xtype: 'fieldset',
                        id: 'fieldsetClasifRegIzq_ficha' + me.idcliente,
                        hideLabel: true,
                        width: 490,
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
                                id: 'fieldcontainerClasifRegIzq_ficha' + me.idcliente,
                                hideLabel: false,
                                label: 'Clasificacion Arancelaria',
                                combineErrors: true,
                                height: 360,
                                msgTarget: 'under',
                                layout: 'column',
                                defaults: {
                                    flex: 1,
                                    hideLabel: false
                                },
                                items: [{
                                        xtype: 'textareafield',
                                        name: 'clasificacionCR',
                                        id: 'clasificacionCR' + me.idcliente,
                                        fieldLabel: 'Clasificacion Arancelaria',
                                        width: 400,
                                        height: 350,
                                        labelWidth: 150
                                    }]
                            }]
                    }, {
                        id: 'fieldsetClasifRegDer_ficha' + me.idcliente,
                        hideLabel: true,
                        width: 490,
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
                                id: 'fieldcontainerClasifRegDer_ficha' + me.idcliente,
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
                                        xtype: 'textareafield',
                                        name: 'registrosCR',
                                        id: 'registrosCR' + me.idcliente,
                                        width: 400,
                                        fieldLabel: 'Registros de importacion',
                                        height: 350,
                                        labelWidth: 150
                                    }]
                            }]
                    }]
            }
            );
        }
    }
});