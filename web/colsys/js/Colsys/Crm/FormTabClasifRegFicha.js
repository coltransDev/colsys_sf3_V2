Ext.define('Colsys.Crm.FormTabClasifRegFicha', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormTabClasifRegFicha',
    listeners: {
        beforerender: function (ct, position) {
            var me = this;
            this.add({
                xtype: 'fieldset',
                id: 'fieldsetClasifReg_ficha' + me.idcliente,
                width: 980,
                collapsible: false,
                layout: 'hbox',
                items: [{
                        xtype: 'fieldset',
                        id: 'fieldsetClasifRegIzq_ficha' + me.idcliente,
                        title: 'Clasificacion Arancelaria',
                        width: 475,
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
                                id: 'fieldcontainerClasifRegIzq_ficha' + me.idcliente,
                                combineErrors: true,
                                height: 360,
                                msgTarget: 'under',
                                layout: 'column',
                                defaults: {
                                    flex: 1,
                                    hideLabel: false
                                },
                                items: [{
                                        xtype: 'htmleditor',
                                        name: 'clasificacionCR',
                                        id: 'clasificacionCR' + me.idcliente,
                                        width: '100%',
                                        height: 350,
                                        listeners: {
                                            initialize: function(field, e) {
                                                field.getToolbar().hide();
                                            }
                                        }
                                    }]
                            }]
                    }, {
                        xtype: 'fieldset',
                        id: 'fieldsetClasifRegDer_ficha' + me.idcliente,
                        title: 'Registros de importacion',
                        width: 480,
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
                                id: 'fieldcontainerClasifRegDer_ficha' + me.idcliente,
                                combineErrors: true,
                                height: 360,
                                msgTarget: 'under',
                                layout: 'column',
                                defaults: {
                                    flex: 1,
                                    hideLabel: false
                                },
                                items: [{
                                        xtype: 'htmleditor',
                                        name: 'registrosCR',
                                        id: 'registrosCR' + me.idcliente,
                                        width: '100%',
                                        height: 350,
                                        listeners: {
                                            initialize: function(field, e) {
                                                field.getToolbar().hide();
                                            }
                                        }
                                    }]
                            }]
                    }]
            }
            );
        }
    }
});