var win_file = null;

Ext.define('Colsys.Crm.TabFichaTecnica', {
    extend: 'Ext.tab.Panel',
    alias: 'widget.Colsys.Crm.TabFichaTecnica',
    // tabPosition: 'bottom',
    listeners: {
        afterRender: function (panel, eOpts) {
            var me = this;

            formGen = Ext.getCmp('formTabInfoGeneralFicha' + me.idcliente).getForm();
            formDoc = Ext.getCmp('formTabDocumentacionFicha' + me.idcliente);
            formMMerc = Ext.getCmp('formTabManejoMercanciasFicha' + me.idcliente);
            formCReg = Ext.getCmp('formTabClasifRegFicha' + me.idcliente);
            formSoFA = Ext.getCmp('formTabSolicitudFicha' + me.idcliente);
            formFAC = Ext.getCmp('formTabFacturacionFicha' + me.idcliente);
            formREQ = Ext.getCmp('formTabReqClienteFicha' + me.idcliente);

            Ext.Ajax.request({
                url: '/crm/cargarDatosFichaTecnica',
                params: {
                    idcliente: me.idcliente
                },
                success: function (response, options) {
                    res = Ext.JSON.decode(response.responseText);
                    if (res.documentacion) {
                        formGen.setValues(res.documentacion);
                        formDoc.info = res.documentacion;
                        formMMerc.info = res.documentacion;
                        formCReg.info = res.documentacion;
                        formSoFA.info = res.documentacion;
                        formFAC.info = res.documentacion;
                        formREQ.info = res.documentacion;
                    }
                    if(res.imprimir == true){
                        Ext.getCmp("btnImprimir" + me.idcliente).setVisible(true);
                    }else{
                        Ext.getCmp("btnImprimir" + me.idcliente).setVisible(false);
                    }
                },
                failure: function () {
                    alert("failure");
                }
            });

//            tb = new Ext.toolbar.Toolbar();
//            tb.add({
//                text: 'Imprimir',
//                id: 'btnImprimir' + me.idcliente,
//                tooltip: 'Generar Documento de Transporte',
//                iconCls: 'page_white_acrobat',
//                handler: function () {
//                    //var id = storeItemsDocs.proxy.extraParams.id;
//                    if (win_file == null) {
//                        win_file = new Ext.Window({
//                            title: 'Vista Preliminar del Documento',
//                            height: 600,
//                            width: 900,
//                            items: [{
//                                    xtype: 'component',
//                                    itemId: 'panel-document-preview',
//                                    autoEl: {
//                                        tag: 'iframe',
//                                        width: '100%',
//                                        height: '100%',
//                                        frameborder: '0',
//                                        scrolling: 'auto',
//                                        src: '/clientes/fichaTecnicaPdf/idcliente/' + me.idcliente
//                                    }
//                                }],
//                            listeners: {
//                                close: function (panel, eOpts) {
//                                    win_file = null;
//                                }
//                            }
//                        });
//                    }
//                    win_file.show();
//                }
//            }, {
//                id: 'bntGuardar' + me.idcliente,
//                text: 'Guardar',
//                iconCls: 'disk',
//                handler: function () {
//                    var f1 = Ext.getCmp("fchvencimientoPCE" + me.idcliente);
//                    var f2 = Ext.getCmp("fchvencimientoRCE" + me.idcliente);
//                    var f3 = Ext.getCmp("vigenciaMS" + me.idcliente);
//
//                    me.setActiveTab('Documentacion_ficha' + me.idcliente);
//                    me.setActiveTab('TransporteInternacional_ficha' + me.idcliente);
//                    me.setActiveTab('ManejoMercancias_ficha' + me.idcliente);
//                    me.setActiveTab('ClasificacionRegistros_ficha' + me.idcliente);
//                    me.setActiveTab('SolicitudFondos_ficha' + me.idcliente);
//                    me.setActiveTab('Facturacion_ficha' + me.idcliente);
//                    me.setActiveTab('OtrosContactos_ficha' + me.idcliente);
//                    me.setActiveTab('Requerimientos_ficha' + me.idcliente);
//                    me.setActiveTab('Infogeneral_ficha' + me.idcliente);
//
//                    var form = Ext.getCmp('formTabInfoGeneralFicha' + me.idcliente).getForm();
//                    var formDoc = Ext.getCmp('formTabDocumentacionFicha' + me.idcliente).getForm();
//                    var formMMerc = Ext.getCmp('formTabManejoMercanciasFicha' + me.idcliente).getForm();
//                    var formCReg = Ext.getCmp('formTabClasifRegFicha' + me.idcliente).getForm();
//                    var formSoFA = Ext.getCmp('formTabSolicitudFicha' + me.idcliente).getForm();
//                    var formFAC = Ext.getCmp('formTabFacturacionFicha' + me.idcliente).getForm();
//                    var formREQ = Ext.getCmp('formTabReqClienteFicha' + me.idcliente).getForm();
//
//                    var parte1 = form.getFieldValues();
//                    var parte2 = formDoc.getFieldValues();
//                    var parte3 = formMMerc.getFieldValues();
//                    var parte4 = formCReg.getFieldValues();
//                    var parte5 = formSoFA.getFieldValues();
//                    var parte6 = formFAC.getFieldValues();
//                    var parte7 = formREQ.getFieldValues();
//
//                    var string = "{";
//                    for (var x in parte1) {
//
//                        if (x == 'fchvencimientoPCE') {
//                            string += '"' + x + '":"' + f1.rawValue + '",';
//                        } else if (x == 'fchvencimientoRCE') {
//                            string += '"' + x + '":"' + f2.rawValue + '",';
//                        } else if (x == "vigenciaMS") {
//                            string += '"' + x + '":"' + f3.rawValue + '",';
//                        } else {
//                            if (parte1[x]) {
//                                string += '"' + x + '":"' + parte1[x] + '",';
//                            } else {
//                                string += '"' + x + '":"",';
//                            }
//                        }
//                    }
//                    for (var x in parte2) {
//                        if (parte2[x]) {
//                            string += '"' + x + '":"' + parte2[x] + '",';
//                        } else {
//                            string += '"' + x + '":"",';
//                        }
//                    }
//                    for (var x in parte3) {
//                        if (parte3[x]) {
//                            string += '"' + x + '":"' + parte3[x] + '",';
//                        } else {
//                            string += '"' + x + '":"",';
//                        }
//                    }
//                    for (var x in parte4) {
//                        if (parte4[x]) {
//                            string += '"' + x + '":"' + parte4[x] + '",';
//                        } else {
//                            string += '"' + x + '":"",';
//                        }
//                    }
//                    for (var x in parte5) {
//                        if (parte5[x]) {
//                            string += '"' + x + '":"' + parte5[x] + '",';
//                        } else {
//                            string += '"' + x + '":"",';
//                        }
//                    }
//                    for (var x in parte6) {
//                        if (parte6[x]) {
//                            string += '"' + x + '":"' + parte6[x] + '",';
//                        } else {
//                            string += '"' + x + '":"",';
//                        }
//                    }
//                    for (var x in parte7) {
//                        if (parte7[x]) {
//                            string += '"' + x + '":"' + parte7[x] + '",';
//                        } else {
//                            string += '"' + x + '":"",';
//                        }
//                    }
//
//                    string = string.substr(0, string.length - 1);
//                    string += "}";
//
//                    if (form.isValid()) {
//                        var store = Ext.getCmp('gridTabTransporte' + me.idcliente).getStore();
//                        x = 0;
//                        changes = [];
//                        for (var i = 0; i < store.getCount(); i++) {
//                            var record = store.getAt(i);
//                            changes[x] = record.data;
//                            x++;
//                        }
//                        var strGrid = JSON.stringify(changes);
//
//                        var store = Ext.getCmp('gridTabContactos' + me.idcliente).getStore();
//                        x = 0;
//                        changes = [];
//                        for (var i = 0; i < store.getCount(); i++) {
//                            var record = store.getAt(i);
//                            changes[x] = record.data;
//                            x++;
//                        }
//                        var strGridCO = JSON.stringify(changes);
//
//                        Ext.Ajax.request({
//                            waitMsg: 'Guardando cambios...',
//                            url: '/clientes/actualizarFichaTecnica',
//                            params: {
//                                datos: string,
//                                datosGrid: strGrid,
//                                datosGridCO: strGridCO,
//                                idcliente: me.idcliente
//                            },
//                            failure: function (response, options) {
//                                var res = Ext.util.JSON.decode(response.responseText);
//                                if (res.errorInfo)
//                                    Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.errorInfo);
//                                else
//                                    Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
//                            },
//                            success: function (response, options) {
//                                var res = Ext.decode(response.responseText);
//                                ids = res.ids;
//                                if (res.success) {
//                                    Ext.MessageBox.alert("Mensaje", 'Ficha almacenada correctamente<br>');
//                                    Ext.getCmp("btnImprimir" + me.idcliente).setVisible(true);
//                                }
//                            }
//                        });
//                    }
//                }
//            });
//            this.addDocked(tb);

            //Cargar Store GridTransporte
            Ext.getCmp('gridTabTransporte' + me.idcliente).setStore(Ext.create('Ext.data.Store', {
                autoLoad: true,
                fields: [
                    /////////TRANSPORTE INTERNACIONAL//////////
                    {name: 'filaNumero' + me.idcliente, type: 'string'},
                    {name: 'tipoI' + me.idcliente, type: 'string'},
                    {name: 'nombre_tipotransporteI' + me.idcliente, type: 'string'},
                    {name: 'convenioI' + me.idcliente, type: 'string'},
                    {name: 'contactoI' + me.idcliente, type: 'string'},
                    {name: 'telefonoI' + me.idcliente, type: 'string'},
                    {name: 'pagofletesI' + me.idcliente, type: 'string'},
                    {name: 'dropoffI' + me.idcliente, type: 'string'},
                    {name: 'contenedorvacioI' + me.idcliente, type: 'string'}
                ],
                proxy: {
                    type: 'ajax',
                    url: '/clientes/datosTransporteFichaTecnica',
                    reader: {
                        type: 'json',
                        root: 'root'
                    },
                    extraParams: {
                        idcliente: me.idcliente
                    },
                    filterParam: 'query'
                }
            }));

            //Cargar Store Grid Otros Contactos

            Ext.getCmp('gridTabContactos' + me.idcliente).setStore(Ext.create('Ext.data.Store', {
                autoLoad: true,
                fields: [
                    /////////CONTACTOS//////////
                    {name: 'tipo', type: 'string'},
                    {name: 'contacto', type: 'string'},
                    {name: 'telefono', type: 'string'},
                    {name: 'convenio', type: 'string'}
                ],
                proxy: {
                    type: 'ajax',
                    url: '/clientes/datosContactosFichaTecnica',
                    reader: {
                        type: 'json',
                        root: 'root'
                    },
                    extraParams: {
                        idcliente: me.idcliente
                    },
                    filterParam: 'query'
                }
            }));

        },
        render: function (ct, position) {
            var me = this;

            this.add(
                    {
                        title: 'Informacion General',
                        id: 'Infogeneral_ficha' + me.idcliente,
                        itemId: 'Infogeneral_ficha' + me.idcliente,
                        items: [{
                                xtype: 'Colsys.Crm.FormTabInfoGeneralFicha',
                                idcliente: me.idcliente,
                                id: 'formTabInfoGeneralFicha' + me.idcliente,
                                height: 400
                            }]
                    },
                    {
                        title: 'Documentaci&oacute;n',
                        id: 'Documentacion_ficha' + me.idcliente,
                        itemId: 'Documentacion_ficha' + me.idcliente,
                        items: [{
                                xtype: 'Colsys.Crm.FormTabDocumentacionFicha',
                                idcliente: me.idcliente,
                                id: 'formTabDocumentacionFicha' + me.idcliente,
                                height: 400,
                                listeners: {
                                    afterrender: function (ct, position) {
                                        form = this.getForm();
                                        form.setValues(this.info);
                                    }
                                }
                            }]
                    },
                    {
                        title: 'Transporte Internacional',
                        id: 'TransporteInternacional_ficha' + me.idcliente,
                        itemId: 'TransporteInternacional_ficha' + me.idcliente,
                        items: [{
                                xtype: 'Colsys.Crm.GridTabTransporteInternacional',
                                idcliente: me.idcliente,
                                id: 'gridTabTransporte' + me.idcliente,
                                height: 400
                            }]
                    },
                    {
                        title: 'Manejo de Mercancias',
                        id: 'ManejoMercancias_ficha' + me.idcliente,
                        itemId: 'ManejoMercancias_ficha' + me.idcliente,
                        items: [{
                                xtype: 'Colsys.Crm.FormTabManejoMercanciasFicha',
                                idcliente: me.idcliente,
                                id: 'formTabManejoMercanciasFicha' + me.idcliente,
                                height: 400,
                                listeners: {
                                    afterrender: function (ct, position) {
                                        form = this.getForm();
                                        form.setValues(this.info);
                                    }
                                }
                            }]
                    },
                    {
                        title: 'Clasificaci&oacute;n y Registros',
                        id: 'ClasificacionRegistros_ficha' + me.idcliente,
                        itemId: 'ClasificacionRegistros_ficha' + me.idcliente,
                        items: [{
                                xtype: 'Colsys.Crm.FormTabClasifRegFicha',
                                idcliente: me.idcliente,
                                id: 'formTabClasifRegFicha' + me.idcliente,
                                height: 400,
                                listeners: {
                                    afterrender: function (ct, position) {
                                        form = this.getForm();
                                        form.setValues(this.info);
                                    }
                                }
                            }]
                    },
                    {
                        title: 'Solicitud de Fondos o Anticipos',
                        id: 'SolicitudFondos_ficha' + me.idcliente,
                        itemId: 'SolicitudFondos_ficha' + me.idcliente,
                        items: [{
                                xtype: 'Colsys.Crm.FormTabSolicitudFicha',
                                idcliente: me.idcliente,
                                id: 'formTabSolicitudFicha' + me.idcliente,
                                height: 400,
                                listeners: {
                                    afterrender: function (ct, position) {
                                        form = this.getForm();
                                        form.setValues(this.info);
                                    }
                                }
                            }
                        ]
                    },
                    {
                        title: 'Facturaci&oacute;n',
                        id: 'Facturacion_ficha' + me.idcliente,
                        itemId: 'Facturacion_ficha' + me.idcliente,
                        items: [{
                                xtype: 'Colsys.Crm.FormTabFacturacionFicha',
                                idcliente: me.idcliente,
                                id: 'formTabFacturacionFicha' + me.idcliente,
                                height: 400,
                                listeners: {
                                    afterrender: function (ct, position) {
                                        form = this.getForm();
                                        form.setValues(this.info);
                                    }
                                }
                            }]
                    },
                    {
                        title: 'Otros Contactos',
                        id: 'OtrosContactos_ficha' + me.idcliente,
                        itemId: 'OtrosContactos_ficha' + me.idcliente,
                        items: [{
                                xtype: 'Colsys.Crm.GridTabContactos',
                                idcliente: me.idcliente,
                                plugins: [
                                    Ext.create('Ext.grid.plugin.CellEditing', {
                                        clicksToEdit: 1
                                    })
                                ],
                                id: 'gridTabContactos' + me.idcliente,
                                height: 400
                            }]
                    },
                    {
                        title: 'Requerimientos del Cliente',
                        id: 'Requerimientos_ficha' + me.idcliente,
                        itemId: 'Requerimientos_ficha' + me.idcliente,
                        items: [{
                                xtype: 'Colsys.Crm.FormTabReqClienteFicha',
                                idcliente: me.idcliente,
                                id: 'formTabReqClienteFicha' + me.idcliente,
                                height: 400,
                                listeners: {
                                    afterrender: function (ct, position) {
                                        form = this.getForm();
                                        form.setValues(this.info);
                                    }
                                }
                            }]
                    }
            );

        }
    }
});
