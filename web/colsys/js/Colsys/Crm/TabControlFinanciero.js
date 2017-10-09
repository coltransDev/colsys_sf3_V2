var win_file = null;

Ext.define('Colsys.Crm.TabControlFinanciero', {
    extend: 'Ext.tab.Panel',
    alias: 'widget.Colsys.Crm.TabControlFinanciero',
    // tabPosition: 'bottom',

    listeners: {
        render: function (ct, position) {
            var me = this;

            this.getTabBar().setVisible(false);
            this.add({
                title: 'General',
                id: 'GeneralControlFinanciero' + me.idcliente,
                itemId: 'GeneralControlFinanciero' + me.idcliente,
                items: [{
                        xtype: 'Colsys.Crm.FormTabGeneralControlFinanciero',
                        idcliente: me.idcliente,
                        id: 'formTabGeneralControlFinanciero' + me.idcliente,
                        height: 400
                    }]
            }, {
                title: 'Info. Financiera',
                id: 'FinancieraControlFinanciero' + me.idcliente,
                itemId: 'FinancieraControlFinanciero' + me.idcliente,
                items: [{
                        xtype: 'Colsys.Crm.GridTabInfoFinanciera',
                        idcliente: me.idcliente,
                        id: 'gridTabInfoFinanciera' + me.idcliente,
                        height: 400,
                        permisos: me.permisos
                    }]
            }, {
                title: 'Documentos',
                id: 'DocumentosControlFinanciero' + me.idcliente,
                itemId: 'DocumentosControlFinanciero' + me.idcliente,
                items: [{
                        xtype: 'Colsys.Crm.GridTabDocumentos',
                        plugins: [
                            Ext.create('Ext.grid.plugin.CellEditing', {
                                clicksToEdit: 1
                            })
                        ],
                        idcliente: me.idcliente,
                        id: 'gridTabDocumentos' + me.idcliente,
                        height: 400
                    }]
            }
            );

            tb = new Ext.toolbar.Toolbar();
            tb.add({
                id: 'bntGeneral' + me.idcliente,
                text: 'General',
                iconCls: 'report_edit',
                handler: function () {
                    me.setActiveTab('GeneralControlFinanciero' + me.idcliente);
                }
            });
            tb.add({
                id: 'bntFinanciera' + me.idcliente,
                text: 'Financiera',
                iconCls: 'money',
                handler: function () {
                    me.setActiveTab('FinancieraControlFinanciero' + me.idcliente);
                }
            });
            tb.add({
                id: 'bntDocumentos' + me.idcliente,
                text: 'Documentos',
                iconCls: 'folder',
                handler: function () {
                    me.setActiveTab('DocumentosControlFinanciero' + me.idcliente);
                }
            });
            tb.add({
//                xtype: 'tbfill'
                xtype: 'displayfield',
                value: '',
                width: 225
            });
            tb.add({
                id: 'bntGuardar' + me.idcliente,
                text: 'Guardar',
                iconCls: 'disk',
                handler: function () {
                    me.setActiveTab('DocumentosControlFinanciero' + me.idcliente);
                    me.setActiveTab('FinancieraControlFinanciero' + me.idcliente);
                    me.setActiveTab('GeneralControlFinanciero' + me.idcliente);

                    var form = Ext.getCmp('formTabGeneralControlFinanciero' + me.idcliente).getForm();

                    var parte1 = form.getFieldValues();

                    var f1 = Ext.getCmp("fchcircular_general" + me.idcliente);
                    var f2 = Ext.getCmp('fechaconstitucion_tributaria' + me.idcliente);

                    var string = "{" + '"idcliente":"' + me.idcliente + '",';
                    for (var x in parte1) {
                        if (x == 'fchcircular') {
                            string += '"' + x + '":"' + f1.rawValue + '",';
                        } else if (x == 'fechaconstitucion') {
                            string += '"' + x + '":"' + f2.rawValue + '",';
                        } else {
                            if (parte1[x]) {
                                string += '"' + x + '":"' + parte1[x] + '",';
                            } else {
                                string += '"' + x + '":"",';
                            }
                        }
                    }
                    string = string.substr(0, string.length - 1);
                    string += "}";

                    if (form.isValid()) {
                        var store = Ext.getCmp('gridTabDocumentos' + me.idcliente).getStore();
                        x = 0;
                        changes = [];
                        for (var i = 0; i < store.getCount(); i++) {
                            var record = store.getAt(i);
                            if (record.get('seleccionado')) {

                                record.data.id = record.id;
                                changes[x] = record.data;
                                x++;
                            }
                        }
                        var strGrid = JSON.stringify(changes);

                        var store = Ext.getCmp('gridTabInfoFinanciera' + me.idcliente).getStore();
                        x = 0;
                        changes = [];
                        for (var i = 0; i < store.getCount(); i++) {
                            var record = store.getAt(i);
                            if (Ext.Object.getSize(record.getChanges()) != 0) {
                                record.data.id = record.id;
                                changes[x] = record.data;
                                x++;
                            }
                        }
                        var strGridFinanciera = JSON.stringify(changes);

                        Ext.Ajax.request({
                            waitMsg: 'Guardando cambios...',
                            url: '/crm/actualizarControlFinanciero',
                            params: {
                                datos: string,
                                datosGrid: strGrid,
                                datosGridFinanciera: strGridFinanciera
                            },
                            failure: function (response, options) {
                                var res = Ext.util.JSON.decode(response.responseText);
                                if (res.errorInfo)
                                    Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.errorInfo);
                                else
                                    Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                            },
                            success: function (response, options) {
                                var res = Ext.decode(response.responseText);
                                var store = Ext.getCmp('gridTabDocumentos' + me.idcliente).getStore();
                                store.reload();
                                Ext.getCmp('gridTabInfoFinanciera' + me.idcliente).getStore().reload();
                                ids = res.ids;
                                if (res.ids) {
                                    for (i = 0; i < ids.length; i++) {
                                        var rec = store.getById(ids[i]);
                                        rec.commit();
                                    }
                                    Ext.MessageBox.alert("Mensaje", 'Informaci&oacute;n almacenada correctamente<br>');
                                    //recarga();
                                }
                            }
                        });
                    }
                },
                listeners: {
                    beforerender: function () {
                        this.setVisible(me.permisos[23]);
                    }
                }
            });
            this.addDocked(tb);
        },
        afterRender: function (panel, eOpts) {
            var me = this;

            form = Ext.getCmp('formTabGeneralControlFinanciero' + me.idcliente).getForm();

            form.load({
                url: '/crm/cargarControlFinanciero',
                params: {
                    idcliente: me.idcliente
                },
                success: function (response, options) {
                    res = Ext.JSON.decode(options.response.responseText);

                    //cargar datos formulario FormTabTributariaControlFinanciero
                    me.setActiveTab('DocumentosControlFinanciero' + me.idcliente);
                    me.setActiveTab('FinancieraControlFinanciero' + me.idcliente);
                    me.setActiveTab('GeneralControlFinanciero' + me.idcliente);
                    Ext.getCmp('tipopersona_tributaria' + me.idcliente).setValue(res.data.tipopersona);
                    // Ext.getCmp('sectoreconomico_tributaria' + me.idcliente).setValue(res.data.sectoreconomico);
                    Ext.getCmp('fechaconstitucion_tributaria' + me.idcliente).setValue(res.data.fechaconstitucion);
                    Ext.getCmp('regimen_tributaria' + me.idcliente).setValue(res.data.regimen);
                    Ext.getCmp('uap_tributaria' + me.idcliente).setValue(res.data.uap);
                    Ext.getCmp('altex_tributaria' + me.idcliente).setValue(res.data.altex);

                    if (res.data.tipopersona == "2") {
                        // Ext.getCmp('fieldset_personajuridica_tributaria' + me.idcliente).setVisible(true);
                    }
                }
            });


            //Cargar Store GridTabInfoFinanciera
            Ext.getCmp('gridTabInfoFinanciera' + me.idcliente).setStore(Ext.create('Ext.data.Store', {
                id: 'storeInfoFinanciera' + me.idcliente,
                autoLoad: true,
                fields: [
                    {name: 'ca_activostotales', type: 'string'},
                    {name: 'ca_activoscorrientes', type: 'string'},
                    {name: 'ca_pasivostotales', type: 'string'},
                    {name: 'ca_pasivoscorrientes', type: 'string'},
                    {name: 'ca_inventarios', type: 'string'},
                    {name: 'ca_patrimonios', type: 'string'},
                    {name: 'ca_utilidades', type: 'string'},
                    {name: 'ca_ventas', type: 'string'},
                    {name: 'ca_anno', type: 'string'},
                    {name: 'ca_actsmmlv', type: 'string'},
                    {name: 'ca_indliquidez', type: 'string'},
                    {name: 'ca_indendeudamiento', type: 'string'},
                    {name: 'ca_pbaacida', type: 'string'},
                    {name: 'ca_ino', type: 'string'}
                ],
                proxy: {
                    type: 'ajax',
                    url: '/clientes/datosInfoFinanciera',
                    reader: {
                        type: 'json',
                        root: 'root'
                    },
                    extraParams: {
                        idcliente: me.idcliente
                    },
                    filterParam: 'query'
                }
            })
                    );

            //Cargar Store GridTabDocumentos
            Ext.getCmp('gridTabDocumentos' + me.idcliente).setStore(Ext.create('Ext.data.Store', {
                id: 'storeControlFinanciero' + me.idcliente,
                autoLoad: true,
                fields: [
                    {name: 'idtipo', type: 'string'},
                    {name: 'iddocumento', type: 'string'},
                    {name: 'empresa', type: 'string'},
                    {name: 'documento', type: 'string'},
                    {name: 'observaciones', type: 'string'},
                    {name: 'fch_documento'},
                    {name: 'seleccionado', type: 'boolean'}
                ],
                proxy: {
                    type: 'ajax',
                    url: '/crm/datosControlFinanciero',
                    reader: {
                        type: 'json',
                        root: 'root'
                    },
                    extraParams: {
                        idcliente: me.idcliente
                    },
                    filterParam: 'query'
                }
            })
                    );
        }
    }
});
