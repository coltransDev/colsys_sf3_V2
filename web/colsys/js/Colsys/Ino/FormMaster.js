/**
 * @autor Felipe Nariño
 *
 * @param idmaster, idtransporte, idimpoexpo
 @comment Permite diligenciar campos de un master:
 modalidad, origen, destino, proveedor, agente, peso,piezas,
 volumen, fecha praviso, fecha llegada, fecha salida.
 */
Ext.define('ComboSiNo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-si-no',
    store: ['Si', 'No']
});

Ext.define('Colsys.Ino.FormMaster', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormMaster',
    title: 'SISTEMA INO',
    bodyPadding: 5,
    //width: 1000,
    autoScroll: true,
    layout: 'column',
    defaults: {
        columnWidth: 1 / 3,
        labelAlign: 'right'
    },
    defaultType: 'textfield',
    onRender: function (ct, position) {
        var textProveedor = "Proveedor";
        if (this.idtransporte == "A\u00E9reo")
            textProveedor = "Aerolinea";
        this.add(
                {
                    xtype: 'fieldset',
                    title: 'General',
                    id: 'general' + this.idmaster,
                    height: 55,
                    columnWidth: 1,
                    layout: 'column',
                    columns: 2,
                    defaults: {
                        columnWidth: 0.5,
                        bodyStyle: 'padding:4px'
                    },
                    items: [{
                            xtype: 'hidden',
                            id: 'master' + this.idmaster,
                            name: 'idmaster',
                            value: this.idmaster
                        }, {
                            xtype: 'hidden',
                            id: 'impoexpo_' + this.idmaster,
                            name: 'impoexpo',
                            value: this.idimpoexpo
                        }, /*{
                         xtype: 'datefield',
                         fieldLabel: 'Fecha Registro',
                         style: 'display:inline-block;text-align:center;font-weight:bold;',
                         labelWidth: 200,
                         allowBlank: false,
                         name: 'fchreferencia',
                         format: "Y-m-d",
                         altFormat: "Y-m-d",
                         submitFormat: 'Y-m-d'
                         },*/
                        {
                            xtype: 'Colsys.Widgets.WgReporte',
                            fieldLabel: 'Reporte',
                            labelWidth: 100,
                            style: 'display:inline-block;text-align:center;font-weight:bold;padding-left:60px;',
                            name: 'idreporte',
                            id: 'reporte' + this.idmaster,
                            //idtransporte: 'transporte' + this.idmaster,
                            //idimpoexpo: 'impoexpo' + this.idmaster,
                            idtransporte: this.idtransporte,
                            idimpoexpo: this.idimpoexpo,
                            idmaster: this.idmaster,
                            listeners: {
                                select: function (combo, records, eOpts) {
                                    var idmaster = this.idmaster;
                                    form = Ext.getCmp('form-master-' + this.idmaster);
                                    var idreporte = records.data.idreporte;
                                    Ext.Ajax.request({
                                        url: '/widgets5/datosReporteCarga',
                                        params: {
                                            idreporte: idreporte
                                        },
                                        success: function (response, options) {
                                            var res = Ext.util.JSON.decode(response.responseText);

                                            if (Ext.getCmp('ca_consignatario' + idmaster)) {
                                                if (Ext.getCmp("ca_consignatario" + idmaster).getValue() == "" ||
                                                        Ext.getCmp("ca_consignatario" + idmaster).getValue() == null) {
                                                    Ext.getCmp('ca_consignatario' + idmaster).setValue(res.data.ca_consignatario);
                                                }
                                            }
                                            if (Ext.getCmp('contacto' + idmaster)) {
                                                if (Ext.getCmp("contacto" + idmaster).getValue() == "" ||
                                                        Ext.getCmp("contacto" + idmaster).getValue() == null) {
                                                    Ext.getCmp('contacto' + idmaster).setValue(res.data.contacto);
                                                }
                                            }
                                            if (Ext.getCmp('cliente' + idmaster)) {
                                                if (Ext.getCmp("cliente" + idmaster).getValue() == null ||
                                                        Ext.getCmp("cliente" + idmaster).getValue() == "") {

                                                    Ext.getCmp("cliente" + idmaster).store.add(
                                                            {"idcliente": res.data.idcliente, "compania": res.data.cliente}
                                                    );

                                                    Ext.getCmp("cliente" + idmaster).setValue(res.data.idcliente);
                                                }
                                            }
                                            if (Ext.getCmp("piezas" + idmaster).getValue() == "" ||
                                                    Ext.getCmp("piezas" + idmaster).getValue() == null) {
                                                Ext.getCmp("piezas" + idmaster).setValue(res.data.ca_piezas);
                                            }
                                            if (Ext.getCmp("volumen" + idmaster).getValue() == "" ||
                                                    Ext.getCmp("volumen" + idmaster).getValue() == null) {
                                                Ext.getCmp("volumen" + idmaster).setValue(res.data.ca_volumen);
                                            }
                                            if (Ext.getCmp("peso" + idmaster).getValue() == "" ||
                                                    Ext.getCmp("peso" + idmaster).getValue() == null) {
                                                Ext.getCmp("peso" + idmaster).setValue(res.data.ca_peso);
                                            }
                                            if (Ext.getCmp("fch_salida" + idmaster).getValue() == null ||
                                                    Ext.getCmp("fch_salida" + idmaster).getValue() == "") {
                                                Ext.getCmp("fch_salida" + idmaster).setValue(res.data.ca_fchsalida);
                                            }
                                            if (Ext.getCmp("tipovehiculo" + idmaster).getValue() == null ||
                                                    Ext.getCmp("tipovehiculo" + idmaster).getValue() == "") {
                                                Ext.getCmp("tipovehiculo" + idmaster).setValue(res.data.tipovehiculo);
                                            }
                                            if (Ext.getCmp("modalidad" + idmaster).getValue() == null ||
                                                    Ext.getCmp("modalidad" + idmaster).getValue() == "") {
                                                Ext.getCmp("modalidad" + idmaster).setValue(res.data.modalidad);
                                            }
                                            if (Ext.getCmp("ca_fchllegada" + idmaster).getValue() == null ||
                                                    Ext.getCmp("ca_fchllegada" + idmaster).getValue() == "") {
                                                Ext.getCmp("ca_fchllegada" + idmaster).setValue(res.data.ca_fchllegada);
                                            }

                                            if (Ext.getCmp("idorigen" + idmaster).getValue() == null ||
                                                    Ext.getCmp("idorigen" + idmaster).getValue() == "") {


                                                Ext.getCmp("idorigen" + idmaster).setValue(res.data.origen);
                                            }

                                            if (Ext.getCmp("iddestino" + idmaster).getValue() == null ||
                                                    Ext.getCmp("iddestino" + idmaster).getValue() == "") {
                                                Ext.getCmp("iddestino" + idmaster).setValue(res.data.destino);
                                            }
                                            if (Ext.getCmp("agente" + idmaster).getValue() == null ||
                                                    Ext.getCmp("agente" + idmaster).getValue() == "") {
                                                Ext.getCmp("agente" + idmaster).setValue(res.data.idagente);
                                            }


                                            if (Ext.getCmp("proveedor" + idmaster).getValue() == null ||
                                                    Ext.getCmp("proveedor" + idmaster).getValue() == "") {

                                                Ext.getCmp("proveedor" + idmaster).store.add(
                                                        {"idlinea": res.data.idlinea, "linea": res.data.linea}
                                                );

                                                Ext.getCmp("proveedor" + idmaster).setValue(res.data.idlinea);
                                            }
                                        }
                                    });
                                }
                            }

                        }]
                },
                {
                    xtype: 'fieldset',
                    title: 'Informaci&oacute;n del trayecto',
                    autoHeight: true,
                    //height: 200,
                    columnWidth: 1,
                    layout: 'column',
                    columns: 2,
                    defaults: {
                        columnWidth: 0.5,
                        bodyStyle: 'padding:4px'
                    },
                    items: [
                        {
                            xtype: 'hidden',
                            id: 'transporte' + this.idmaster,
                            name: 'transporte',
                            value: this.idtransporte
                        }, {
                            text: 'Tipo:',
                            xtype: 'label',
                            style: 'display:inline-block;text-align:center;',
                            columnWidth: 0.19
                        }, {
                            text: this.idimpoexpo,
                            xtype: 'label',
                            id: 'impoexpo' + this.idmaster,
                            name: 'impoexpo',
                            style: 'display:inline-block;text-align:left;font-weight:bold;',
                            labelWidth: 200,
                            idmaster: this.idmaster,
                            columnWidth: 0.26
                        }, {
                            text: 'Transporte:',
                            xtype: 'label',
                            style: 'display:inline-block;text-align:center;',
                            columnWidth: 0.2
                        }, {
                            text: this.idtransporte,
                            xtype: 'label',
                            id: 'idtransporte' + this.idmaster,
                            name: 'idtransporte',
                            style: 'display:inline-block;text-align:left;font-weight:bold;',
                            labelWidth: 200,
                            idmaster: this.idmaster,
                            columnWidth: 0.2
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        }, {
                            xtype: 'Colsys.Widgets.WgModalidad',
                            fieldLabel: 'Modalidad',
                            name: 'modalidad',
                            id: 'modalidad' + this.idmaster,
                            idtransporte: 'transporte' + this.idtransporte,
                            idimpoexpo: 'impoexpo' + this.idimpoexpo,
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            forceSelection: true,
                            width: 300,
                            idmaster: this.idmaster
                        },
                        //{
                        Ext.create('Colsys.Widgets.WgCiudades2', {
                            //xtype: 'Colsys.Widgets.WgCiudades2',
                            fieldLabel: 'Origen',
                            tipo: 'origen',
                            idimpoexpo: this.idimpoexpo,
                            forceSelection: true,
                            id: 'idorigen' + this.idmaster,
                            name: 'idorigen',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 100,
                            width: 300,
                            idmaster: this.idmaster,
                            store: Ext.create('Ext.data.Store', {
                                fields: ['idciudad', 'ciudad', 'idtrafico', 'trafico', 'ciudad_trafico'],
                                proxy: {
                                    type: 'ajax',
                                    url: '/widgets5/datosCiudades',
                                    reader: {
                                        type: 'json',
                                        rootProperty: 'root'
                                    }
                                },
                                autoLoad: true
                            })
                        }),
                        //},
                        ,
                                {
                                    xtype: 'tbspacer',
                                    height: 10,
                                    columnWidth: 1
                                },
                        //{
                        Ext.create('Colsys.Widgets.WgCiudades2', {
                            //xtype: 'Colsys.Widgets.WgCiudades2',
                            fieldLabel: 'Destino',
                            forceSelection: true,
                            tipo: 'destino',
                            idimpoexpo: this.idimpoexpo,
                            id: 'iddestino' + this.idmaster,
                            name: 'iddestino',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            width: 300,
                            idmaster: this.idmaster,
                            store: Ext.create('Ext.data.Store', {
                                fields: ['idciudad', 'ciudad', 'idtrafico', 'trafico', 'ciudad_trafico'],
                                proxy: {
                                    type: 'ajax',
                                    url: '/widgets5/datosCiudades',
                                    reader: {
                                        type: 'json',
                                        rootProperty: 'root'
                                    }
                                },
                                autoLoad: true
                            })
                        })
                                //}, 
                                ,
                        {
                            xtype: 'Colsys.Widgets.WgLinea',
                            fieldLabel: textProveedor,
                            forceSelection: true,
                            id: 'proveedor' + this.idmaster,
                            name: 'proveedor',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 100,
                            width: 300,
                            idmaster: this.idmaster,
                            idtransporte: 'transporte' + this.idmaster
                        },
                        {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        }, {
                            xtype: 'Colsys.Widgets.WgAgentes',
                            fieldLabel: 'Agente',
                            forceSelection: true,
                            name: 'agente',
                            id: 'agente' + this.idmaster,
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            width: 300,
                            idmaster: this.idmaster,
                            idtransporte: 'transporte' + this.idmaster,
                            columnWidth: 0.5,
                            listarTodos: "listar_todos"
                        }, {
                            xtype: 'checkboxfield',
                            boxLabel: 'Listar Todos',
                            name: 'listar_todos',
                            inputValue: '1',
                            id: 'listar_todos' + this.idmaster,
                            columnWidth: 0.2
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        }
                    ]},
                {
                    xtype: 'fieldset',
                    title: 'Informaci&oacute;n del trayecto',
                    autoHeight: true,
                    //height: 500,
                    columnWidth: 1,
                    layout: 'column',
                    columns: 2,
                    defaults: {
                        columnWidth: 0.5,
                        bodyStyle: 'padding:4px'
                    },
                    items: [
                        {
                            xtype: 'textfield',
                            fieldLabel: 'Master',
                            id: 'ca_master' + this.idmaster,
                            name: 'ca_master',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            maxLengthText: 'Tama\u00F1o m\u00E1ximo 30',
                            readOnly: false,
                            width: 300
                        },
                        {
                            xtype: 'numberfield',
                            fieldLabel: 'Piezas',
                            id: 'piezas' + this.idmaster,
                            name: 'ca_piezas',
                            minValue: 0,
                            maxValue: 999999999,
                            maxLengthText: 'Tama\u00F1o m\u00E1ximo 999999999',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 100,
                            width: 300
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        },
                        {
                            xtype: 'numberfield',
                            fieldLabel: 'Peso',
                            id: 'peso' + this.idmaster,
                            name: 'ca_peso',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            minValue: 0,
                            maxValue: 999999999.99,
                            maxLengthText: 'Tama\u00F1o m\u00E1ximo 999999999.99',
                            width: 300
                        }, {
                            xtype: 'numberfield',
                            fieldLabel: 'Volumen',
                            minValue: 0,
                            maxValue: 999999999,
                            maxLengthText: 'Tama\u00F1o m\u00E1ximo 999999999',
                            id: 'volumen' + this.idmaster,
                            name: 'ca_volumen',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 100,
                            width: 300
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        }, {
                            xtype: 'datefield',
                            fieldLabel: 'Fecha Preaviso',
                            id: 'fch_salida' + this.idmaster,
                            allowBlank: false,
                            name: 'ca_fchsalida',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            format: "Y-m-d",
                            altFormat: "Y-m-d",
                            submitFormat: 'Y-m-d',
                            width: 300
                            
                        }, {
                            xtype: 'datefield',
                            fieldLabel: 'Fecha Llegada',
                            allowBlank: false,
                            name: 'ca_fchllegada',
                            id: 'ca_fchllegada' + this.idmaster,
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 100,
                            format: "Y-m-d",
                            altFormat: "Y-m-d",
                            submitFormat: 'Y-m-d',
                            width: 300
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        }, {
                            xtype: 'Colsys.Widgets.WgParametros',
                            id: 'tipovehiculo' + this.idmaster,
                            fieldLabel: 'Tipo Vehiculo',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            caso_uso: 'CU020',
                            name: 'tipovehiculo',
                            width: 300,
                            labelWidth: 200,
                            hidden: true
                        }
                    ]}
        );
        if (this.idtransporte == "Terrestre") {
            Ext.getCmp('tipovehiculo' + this.idmaster).hidden = false;
        }
        if (this.idimpoexpo == "Exportaci\u00F3n") {
            var formattedDate = new Date();
                        var d = formattedDate.getDate();
                        if (d < 10) {
                            d = "0" + d;
                        }
                        var m = formattedDate.getMonth();
                        m += 1;
                        if (m < 10) {
                            m = "0" + m;
                        }
                        var y = formattedDate.getFullYear();
                        var fch = y + "-" + m + "-" + d;
            if (Ext.getCmp('fch_salida' + this.idmaster)) {
                if (Ext.getCmp("fch_salida" + this.idmaster).getValue() == "" ||
                        Ext.getCmp("fch_salida" + this.idmaster).getValue() == null) {
                    Ext.getCmp('fch_salida' + this.idmaster).setValue(fch);
                    Ext.getCmp('ca_fchllegada' + this.idmaster).setValue(fch);
                    Ext.getCmp('fch_salida' + this.idmaster).setVisible(false);
                    Ext.getCmp('ca_fchllegada' + this.idmaster).setVisible(false);
                     Ext.getCmp('ca_fchllegada' + this.idmaster).allowBlank = true;
                }
            }

            this.add({
                xtype: 'fieldset',
                title: 'Informaci&oacute;n ',
                autoHeight: true,
                columnWidth: 1,
                layout: 'column',
                columns: 2,
                defaults: {
                    columnWidth: 0.5,
                    bodyStyle: 'padding:4px'
                },
                items: [
                    {
                        xtype: 'Colsys.Widgets.WgParametros',
                        fieldLabel: 'R&eacute;gimen',
                        forceSelection: true,
                        id: 'ca_modalidad' + this.idmaster,
                        name: 'ca_modalidad',
                        style: 'display:inline-block;text-align:center;font-weight:bold;',
                        labelWidth: 200,
                        allowBlank: false,
                        width: 300,
                        caso_uso: 'CU011'
                    },
                    Ext.create('Colsys.Widgets.WgProveedores', {
                        fieldLabel: 'Agencia de Aduana',
                        forceSelection: true,
                        name: 'idlinea',
                        tipo: 'ADU',
                        id: 'agenciaad' + this.idmaster,
                        style: 'display:inline-block;text-align:center;font-weight:bold;',
                        labelWidth: 100,
                        width: 300,
                        allowBlank: false,
                        idmaster: this.idmaster,
                        idtransporte: 'transporte' + this.idmaster
                    }),
                    //xtype: 'Colsys.Widgets.WgProveedores',



                    {
                        xtype: 'tbspacer',
                        height: 10,
                        columnWidth: 1
                    }, {
                        xtype: 'textfield',
                        fieldLabel: 'Contacto',
                        id: 'contacto' + this.idmaster,
                        name: 'ca_contacto',
                        style: 'display:inline-block;text-align:center;font-weight:bold;',
                        labelWidth: 200,
                        width: 300
                    }, {
                        xtype: 'Colsys.Widgets.WgIncoterms',
                        fieldLabel: 'INCOTERMS',
                        forceSelection: true,
                        allowBlank: false,
                        name: 'ca_incoterms',
                        style: 'display:inline-block;text-align:center;font-weight:bold;',
                        labelWidth: 100,
                        width: 300
                    }, {
                        xtype: 'tbspacer',
                        height: 10,
                        columnWidth: 1
                    }, {
                        xtype: 'textfield',
                        fieldLabel: 'Nombre Consignatario',
                        name: 'ca_consignatario',
                        id: 'ca_consignatario' + this.idmaster,
                        style: 'display:inline-block;text-align:center;font-weight:bold;',
                        labelWidth: 200,
                        width: 300
                    }, {
                        xtype: 'textfield',
                        fieldLabel: 'Direcci&oacute;n Consignatario ',
                        name: 'ca_direccion',
                        style: 'display:inline-block;text-align:center;font-weight:bold;',
                        labelWidth: 100,
                        width: 300
                    }, {
                        xtype: 'tbspacer',
                        height: 10,
                        columnWidth: 1
                    }, {
                        xtype: 'combo-si-no',
                        fieldLabel: 'Aplica IDG',
                        forceSelection: true,
                        name: 'aplicaidg',
                        id: 'aplicaidg' + this.idmaster,
                        style: 'display:inline-block;text-align:center;font-weight:bold;',
                        labelWidth: 200,
                        value: 'SI',
                        width: 300
                    }, {
                        xtype: 'Colsys.Widgets.WgClientes',
                        fieldLabel: 'Cliente',
                        name: 'cliente',
                        id: 'cliente' + this.idmaster,
                        style: 'display:inline-block;text-align:center;font-weight:bold;',
                        labelWidth: 100,
                        width: 300
                    }, {
                        xtype: 'tbspacer',
                        height: 10,
                        columnWidth: 1
                    }, {
                        xtype: 'tbspacer',
                        height: 10,
                        columnWidth: 1
                    }, {
                        xtype: 'textarea',
                        fieldLabel: 'Descripci&oacute;n de la mercanc&iacute;as',
                        name: 'ca_descripcion',
                        labelWidth: 200,
                        width: 600,
                        columnWidth: 0.75
                    }, {
                        xtype: 'tbspacer',
                        height: 10,
                        columnWidth: 1
                    }
                ]});
        }

        /******/
        if (this.idtransporte == "A\u00E9reo") {
            Ext.getCmp("ca_master" + this.idmaster).regex = /(\d{3})-(.{8,9})/;
            Ext.getCmp("ca_master" + this.idmaster).maxLength = 13;
        }

        if (this.idimpoexpo == "OTM-DTA" && this.idtransporte == 'Terrestre') {
            Ext.getCmp('reporte' + this.idmaster).setVisible(true);
            Ext.getCmp("ca_master" + this.idmaster).readOnly = true;
        } else if (this.idimpoexpo == "Importaci\u00F3n" && this.idtransporte == "A\u00E9reo") {
            Ext.getCmp('general' + this.idmaster).setVisible(false);
            Ext.getCmp('reporte' + this.idmaster).setVisible(false);
            Ext.getCmp('impoexpo' + this.idmaster).text = "Importaci\u00F3n";
        } else if (this.idimpoexpo == "INTERNO" && this.idtransporte == "Terrestre") {
            Ext.getCmp("ca_master" + this.idmaster).readOnly = true;
            Ext.getCmp('reporte' + this.idmaster).setVisible(false);
            var fech = new Date();
            var dd = fech.getDate();
            if (dd < 10) {
                dd = "0" + dd;
            }
            var mm = fech.getMonth() + 1;
            if (mm < 10) {
                mm = "0" + mm;
            }
            var yyyy = fech.getFullYear();
            var hoy = yyyy + "-" + mm + "-" + dd;

            Ext.getCmp('ca_fchllegada' + this.idmaster).setVisible(true);
            Ext.getCmp('ca_fchllegada' + this.idmaster).setValue(hoy);
            Ext.getCmp('impoexpo' + this.idmaster).text = "INTERNO";
            Ext.getCmp('agente' + this.idmaster).setValue("800024075");
        }

        this.add(
                {
                    xtype: 'fieldset',
                    title: 'Observaciones',
                    autoHeight: true,
                    columnWidth: 1,
                    layout: 'column',
                    columns: 1,
                    defaults: {
                        columnWidth: 0.75,
                        bodyStyle: 'padding:4px'
                    },
                    items: [{
                            xtype: 'textarea',
                            name: 'ca_observaciones'
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        }
                    ]
                });
        tb = new Ext.toolbar.Toolbar({dock: 'top'});
        if (this.permisos.Editar == true)
        {
            
            tb.add({
                xtype: 'button',
                text: 'Guardar',
                iconCls: 'add',
                width: 150,
                handler: function () {
                    me = this;
                    var form = this.up('form').getForm();
                    var mas = this.up('form').idmaster;
                    var exito = false;
                    if (form.isValid()) {
                        form.submit({
                            url: "/inoF2/guardarMaster",
                            waitMsg: 'Guardando...',
                            waitTitle: 'Por favor espere...',
                            success: function (form, action) {
                                me.this;
                                if (mas == 0)
                                {
                                    var idmas = action.result.idmaster;
                                    var tabpanel = Ext.getCmp('tabpanel1');
                                    //tabpanel = Ext.getCmp('tabpanel1');
                                    ref = idmas;
                                    /*numRef = action.result.idreferencia;
                                     idimpo = action.result.idimpoexpo;
                                     idtrans = action.result.idtransporte;*/

                                    if (action.result.idimpoexpo == "INTERNO")
                                        tmppermisos = permisosG.terrestre;
                                    else if (action.result.idimpoexpo == "Exportaci\u00F3n")
                                        tmppermisos = permisosG.exportacion;
                                    else if (action.result.idimpoexpo == "Importaci\u00F3n")
                                    {

                                        if (action.result.idtransporte == "Mar\u00EDtimo")
                                            tmppermisos = permisosG.maritimo;
                                        if (action.result.idtransporte == "A\u00E9reo")
                                            tmppermisos = permisosG.aereo;
                                    } else if (action.result.idimpoexpo == "OTM-DTA")
                                        tmppermisos = permisosG.otm;

                                    //console.log(tmppermisos);
                                    //return;
                                    tabpanel.getChildByElement('tab0').close();

                                    if (!tabpanel.getChildByElement('tab' + ref) && ref != "")
                                    {
                                        tabpanel.add(
                                                {
                                                    title: action.result.idreferencia,
                                                    id: 'tab' + ref,
                                                    itemId: 'tab' + ref,
                                                    closable: true,
                                                    autoScroll: true,
                                                    items: [
                                                        new Colsys.Ino.Mainpanel(
                                                                {
                                                                    "idmaster": action.result.idmaster, "idtransporte": action.result.idtransporte,
                                                                    "idimpoexpo": action.result.idimpoexpo, "idreferencia": action.result.idmaster,
                                                                    'permisos': tmppermisos, "tipofacturacion": 2, "idticket": "-1", "modalidad": action.result.modalidad
                                                                }),
                                                        {
                                                            region: 'south',
                                                            xtype: 'Colsys.Ino.FormCierre',
                                                            id: 'formCierre' + ref,
                                                            name: 'formCierre' + ref,
                                                            idmaster: ref,
                                                            'permisos': tmppermisos
                                                        }
                                                        /*{xtype:'Colsys.Ino.Mainpanel',"idmaster": ref, "idimpoexpo": idimpo, "idtransporte": idtrans, 'idreferencia': numRef,'permisos': tmppermisos}*/
                                                    ]
                                                }).show();
                                    }
                                    tabpanel.setActiveTab('tab' + ref);
                                }
                                if (action.result.success)
                                    Ext.MessageBox.alert('Mensaje', "Datos Almacenados Correctamente");
                            },
                            failure: function (form, action) {
                                Ext.MessageBox.alert('Error Message', "Se ha presentado un error" + (action.result ? ": " + action.result.errorInfo : "") + " " + (action.response ? "\n Codigo HTTP " + action.response.status : ""));
                            }
                        });
                    } else {
                        Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
                    }
                }
            });
        }

        if (this.permisos.Anular == true)
        {
            tb.add({
                xtype: 'button',
                text: 'Anular',
                iconCls: 'delete',
                width: 150,
                handler: function () {
                    mas = this.up('form').idmaster;
                    idtranspo = this.up('form').idtransporte;
                    idimpoex = this.up('form').idimpoexpo;
                    ref = mas;
                    perms = this.up('form').permisos;
                    anularReferencia();
                }
            });
        }
        idmastrer=this.idmaster;
        if (this.idimpoexpo == "Importaci\u00F3n" && this.idtransporte == "Mar\u00EDtimo")
        {
            tb.add({
                xtype: 'button',
                text: '@ Coloader',
                //iconCls: 'delete',
                width: 150,
                handler: function () {
                    var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                            sorc: "/antecedentes/emailColoader/idmaster/"+idmastrer,
                            height: 600,
                            width: 1000,
                        });
                        windowpdf.show();
                }
            });
        }
        
        if (this.idimpoexpo == "OTM-DTA" && this.idtransporte == "Terrestre")
        {
            tb.add({
                xtype: 'button',
                text: 'Instrucciones',
                //iconCls: 'delete',
                width: 150,
                handler: function () {
                    var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                            sorc: "/inoF/instruccionesOtm/modo/5/idmaster/"+idmastrer
                        });
                        windowpdf.show();
                }
            });
        }
        
        this.addDocked(tb, 'bottom');

        Ext.getCmp("tipovehiculo" + this.idmaster).getStore().load({
            params: {
                caso_uso: 'CU020'
            }
        });
        Colsys.Ino.FormMaster.superclass.onRender.call(this, ct, position);
    },
    items: [
    ],
    buttons: [],
    listeners: {
        beforerender: function (ct, position) {
            this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 150);
            this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 50);




        },
        render: function (ct, position) {
            var idmasterr = this.idmaster;
            var idtransporte = this.idtransporte;

            if (this.load1 == false || this.load1 == "undefined" || !this.load1)
            {
                if (Ext.getCmp("agenciaad" + idmasterr)) {
                    Ext.getCmp("agenciaad" + idmasterr).getStore().reload({
                        params: {
                            tipo: "ADU"
                        }
                    });
                }

                /*Ext.getCmp("idorigen" + idmasterr).store.load({
                 params: {
                 tipo: Ext.getCmp("idorigen" + idmasterr).tipo,
                 impoexpo: Ext.getCmp("idorigen" + idmasterr).idimpoexpo
                 },
                 callback: function (records, operation, success) {
                 console.log("carga de origen");
                 }
                 });
                 Ext.getCmp("iddestino" + idmasterr).store.reload({
                 params: {
                 tipo: Ext.getCmp("iddestino" + idmasterr).tipo,
                 impoexpo: Ext.getCmp("iddestino" + idmasterr).idimpoexpo
                 },
                 callback: function (records, operation, success) {
                 console.log(Ext.getCmp("idorigen" + idmasterr).store);
                 }
                 });*/

                var store = Ext.getCmp('modalidad' + this.idmaster).getStore();
                store.proxy.extraParams = {
                    idmaster: this.idmaster
                }
                store.reload();
                this.form.load({
                    url: '/inoF2/datosMaster',
                    params: {"idmaster": this.idmaster},
                    success: function (response, options) {
                        ///////////////////////////////////////////////////



                        //////////////////////////////////////////////////
                        res = Ext.JSON.decode(options.response.responseText);

                        Ext.getCmp("modalidad" + idmasterr).readOnly = res.data.modalidadnoeditable;
                        Ext.getCmp("idorigen" + idmasterr).readOnly = res.data.origennoeditable;
                        Ext.getCmp("iddestino" + idmasterr).readOnly = res.data.destinonoeditable;

                        /*if (Ext.getCmp("agente" + idmasterr)) {
                         Ext.getCmp("agente" + idmasterr).store.add(
                         {"idagente": res.data.idagente, "nombre": res.data.nombre}
                         );
                         Ext.getCmp("agente" + idmasterr).setValue(res.data.idagente);
                         $('#agente' + idmasterr + '-inputEl').val(res.data.nombre);
                         }*/
                        Ext.getCmp("agente" + idmasterr).store.reload({
                            params: {
                                transporte: idtransporte,
                            },
                            callback: function (records, operation, success) {
                                Ext.getCmp("agente" + idmasterr).store.add(
                                        {"idagente": res.data.idagente, "nombre": res.data.nombre}
                                );
                                Ext.getCmp("agente" + idmasterr).setValue(res.data.idagente);
                                /*------*/

                                //Ext.getCmp("ca_modalidad" + idmasterr).store.add(
                                //     {"id": res.data.id_modalidad, "name": res.data.ca_modalidad}
                                //);
                                Ext.getCmp("modalidad" + idmasterr).setValue(res.data.modalidad);
                            }
                        });

                        Ext.getCmp("proveedor" + idmasterr).store.reload({
                            params: {
                                transporte: idtransporte
                            },
                            callback: function (records, operation, success) {
                                Ext.getCmp("proveedor" + idmasterr).store.add(
                                        {"idlinea": res.data.proveedor, "linea": res.data.linea}
                                );
                                Ext.getCmp("proveedor" + idmasterr).setValue(res.data.proveedor);
                                //$('#proveedor' + idmasterr + '-inputEl').val(res.data.linea);
                            }
                        });


                        if (Ext.getCmp("ca_modalidad" + idmasterr)) {
                            Ext.getCmp("ca_modalidad" + idmasterr).store.add(
                                    {"id": res.data.id_modalidad, "name": res.data.ca_modalidad}
                            );
                            Ext.getCmp("ca_modalidad" + idmasterr).setValue(res.data.id_modalidad);
                            //$('#ca_modalidad' + idmasterr + '-inputEl').val(res.data.ca_modalidad);
                        }
                        if (Ext.getCmp("agenciaad" + idmasterr)) {
                            Ext.getCmp("agenciaad" + idmasterr).getStore().reload({
                                params: {
                                    tipo: "ADU"
                                },
                                callback: function (records, operation, success) {
                                    if (Ext.getCmp("agenciaad" + idmasterr)) {
                                        Ext.getCmp("agenciaad" + idmasterr).store.add(
                                                {"idlinea": res.data.idlinea, "linea": res.data.agencia}
                                        );
                                        Ext.getCmp("agenciaad" + idmasterr).setValue(res.data.idlinea);
                                        $('#agenciaad' + idmasterr + '-inputEl').val(res.data.agencia);
                                    }
                                }
                            });
                        }





                        if (Ext.getCmp("idorigen" + idmasterr)) {
                            Ext.getCmp("idorigen" + idmasterr).store.add(
                                    {"idciudad": res.data.idorigen, "ciudad": res.data.origen}
                            );
                            Ext.getCmp("idorigen" + idmasterr).setValue(res.data.idorigen);
                            //$('#idorigen' + idmasterr + '-inputEl').val(res.data.origen);
                        }

                        if (Ext.getCmp("iddestino" + idmasterr)) {
                            Ext.getCmp("iddestino" + idmasterr).store.add(
                                    {"idciudad": res.data.iddestino, "ciudad": res.data.destino}
                            );
                            Ext.getCmp("iddestino" + idmasterr).setValue(res.data.iddestino);
                            $('#iddestino' + idmasterr + '-inputEl').val(res.data.destino);
                        }
                        if (res.data.impoexpo == "Exportaci\u00f3n") {
                            //if (Ext.getCmp("cliente" + idmasterr))
                            {
                                Ext.getCmp("cliente" + idmasterr).store.add(
                                        {"idcliente": res.data.ca_idcliente, "compania": res.data.ca_compania}
                                );
                                Ext.getCmp("cliente" + idmasterr).setValue(res.data.ca_idcliente);
                                $('#cliente' + idmasterr + '-inputEl').val(res.data.ca_compania);
                            }
                        }

                        //if (Ext.getCmp("proveedor" + idmasterr)) 

                    }
                });
                this.load1 = true;
            }
        }
    }
});
function anularReferencia(id) {
    Ext.MessageBox.show({
        title: 'Anulacion de Referencia',
        msg: 'Ingrese el motivo de anulacion de la referencia:',
        width: 500,
        buttons: Ext.MessageBox.OKCANCEL,
        /*buttons:{
         ok     : "Enviar",
         cancel : "Cancelar"
         },*/
        multiline: true,
        fn: anulacion,
        animEl: 'anular-ref',
        modal: true
    });
}

var anulacion = function (btn, text) {

    if (btn == "ok") {
        if (text.trim() == "") {
            Ext.MessageBox.alert("Mensaje", 'Debe colocar una observaci&oacute;n<br>');
        } else {
            if (btn == "ok") {
                Ext.MessageBox.wait('Anulando referencia', '');


                Ext.Ajax.request({
                    waitMsg: 'Anulando referencia...',
                    url: '/inoF2/anularReferencia',
                    params: {
                        idmaster: mas,
                        motivo: text
                    },
                    failure: function (response, options) {
                        var res = Ext.util.JSON.decode(response.responseText);
                        if (res.errorInfo)
                            Ext.MessageBox.alert("Mensaje", 'Error en Eliminaci&oacute;n');

                    },
                    success: function (response, options) {
                        var res = Ext.decode(response.responseText);

                        if (res.success) {
                            numRef = res.idreferenca;
                            tabpanel = Ext.getCmp('tabpanel1');
                            tabpanel.getChildByElement('tab' + ref).close();
                            //   if (!tabpanel.getChildByElement('tab' + ref) && ref != "")
                            {
                                tabpanel.add(
                                        {
                                            title: numRef,
                                            id: 'tab' + ref,
                                            itemId: 'tab' + ref,
                                            closable: true,
                                            autoScroll: true,
                                            items: [new Colsys.Ino.Mainpanel({
                                                    "idmaster": ref,
                                                    "idimpoexpo": idimpoex,
                                                    "idtransporte": idtranspo,
                                                    'idreferencia': numRef,
                                                    "permisos": perms
                                                })]
                                        }).show();
                            }
                            tabpanel.setActiveTab('tab' + ref);
                            Ext.MessageBox.alert("Mensaje", 'Datos Anulados Correctamente<br>');

                        } else {
                            Ext.MessageBox.alert("Mensaje", 'Datos Incompletos<br>');
                        }
                    }
                });
            }

        }
    }
};
