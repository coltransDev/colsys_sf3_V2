/**
 * @autor Felipe Nariño
 *
 * @param idmaster, idtransporte, idimpoexpo
 @comment Permite diligenciar campos de un master:
 modalidad, origen, destino, proveedor, agente, peso,piezas,
 volumen, fecha praviso, fecha llegada, fecha salida.
 */
Ext.define('Colsys.Ino.FormMaster', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormMaster',
    title: 'SISTEMA INO',
    bodyPadding: 5,
    width: 1000,
    layout: 'column',
    defaults: {
        columnWidth: 1 / 3,
        labelAlign: 'right'
    },
    defaultType: 'textfield',
    onRender: function (ct, position) {
        //console.log(this.permisos);
        this.add(
                {
                    xtype: 'fieldset',
                    title: 'General',
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
                        }, {
                            xtype: 'datefield',
                            fieldLabel: 'Fecha Registro',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            allowBlank: false,
                            name: 'fchreferencia',
                            format: "Y-m-d",
                            altFormat: "Y-m-d",
                            submitFormat: 'Y-m-d'
                        },
                        {
                            xtype: 'Colsys.Widgets.WgReporte',
                            fieldLabel: 'Reporte',
                            labelWidth: 100,
                            style: 'display:inline-block;text-align:left;font-weight:bold;',
                            name: 'idreporte',
                            id: 'reporte' + this.idmaster,
                            idtransporte: 'transporte' + this.idmaster,
                            idimpoexpo: 'impoexpo' + this.idmaster,
                            idmaster: this.idmaster,
                            listeners: {
                                select: function (combo, records, eOpts) {
                                    var idmaster = this.idmaster;
                                    form = Ext.getCmp('form-master-' + this.idmaster);
                                    var idreporte = records[0].data.idreporte;
                                    Ext.Ajax.request({
                                        url: '/widgets5/datosReporteCarga',
                                        params: {
                                            idreporte: idreporte
                                        },
                                        success: function (response, options) {
                                            var res = Ext.util.JSON.decode(response.responseText);

                                            if (Ext.getCmp("piezas" + idmaster).getValue() == "") {
                                                Ext.getCmp("piezas" + idmaster).setValue(res.data.ca_piezas);
                                            }
                                            if (Ext.getCmp("volumen" + idmaster).getValue() == "") {
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

                        }]},
                {
                    xtype: 'fieldset',
                    title: 'Informaci&oacute;n del trayecto',
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
                        }, {
                            fieldLabel: 'Origen',
                            xtype: 'Colsys.Widgets.WgCiudades2',
                            forceSelection: true,
                            id: 'idorigen' + this.idmaster,
                            name: 'idorigen',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 100,
                            width: 300,
                            idmaster: this.idmaster

                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        }, {
                            xtype: 'Colsys.Widgets.WgCiudades2',
                            fieldLabel: 'Destino',
                            forceSelection: true,
                            id: 'iddestino' + this.idmaster,
                            name: 'iddestino',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            width: 300,
                            idmaster: this.idmaster
                        }, {
                            xtype: 'Colsys.Widgets.WgLinea',
                            fieldLabel: 'Proveedor',
                            forceSelection: true,
                            id: 'proveedor' + this.idmaster,
                            name: 'proveedor',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 100,
                            width: 300,
                            idmaster: this.idmaster,
                            idtransporte: 'transporte' + this.idmaster

                        }, {
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
                            maxLength: 30,
                            maxLengthText: 'Tama\u00F1o m\u00E1ximo 30',
                            readOnly: false,
                            width: 300
                        }, {
                            xtype: 'numberfield',
                            fieldLabel: 'Peso',
                            id: 'peso' + this.idmaster,
                            name: 'ca_peso',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 100,
                            minValue: 0,
                            maxValue: 999999999.99,
                            maxLengthText: 'Tama\u00F1o m\u00E1ximo 999999999.99',
                            width: 300
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        }, {
                            xtype: 'numberfield',
                            fieldLabel: 'Piezas',
                            id: 'piezas' + this.idmaster,
                            name: 'ca_piezas',
                            minValue: 0,
                            maxValue: 999999999,
                            maxLengthText: 'Tama\u00F1o m\u00E1ximo 999999999',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            width: 300
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        }, {
                            xtype: 'datefield',
                            fieldLabel: 'Fecha Salida',
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
                            fieldLabel: 'Fecha Llegada',
                            allowBlank: false,
                            name: 'ca_fchllegada',
                            id: 'ca_fchllegada' + this.idmaster,
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            format: "Y-m-d",
                            altFormat: "Y-m-d",
                            submitFormat: 'Y-m-d',
                            width: 300
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 0.5
                        }
                    ]}
        );

        if (this.idimpoexpo == "Exportaci\u00F3n") {

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
                        fieldLabel: 'Modalidad',
                        forceSelection: true,
                        id: 'ca_modalidad' + this.idmaster,
                        name: 'ca_modalidad',
                        style: 'display:inline-block;text-align:center;font-weight:bold;',
                        labelWidth: 200,
                        allowBlank: false,
                        width: 300,
                        caso_uso: 'CU011'
                    }, {
                        xtype: 'Colsys.Widgets.WgProveedores',
                        fieldLabel: 'Agencia de Aduana',
                        forceSelection: true,
                        name: 'idlinea',
                        tipo: 'ADU',
                        id: 'agencia' + this.idmaster,
                        style: 'display:inline-block;text-align:center;font-weight:bold;',
                        labelWidth: 100,
                        width: 300,
                        allowBlank: false,
                        idmaster: this.idmaster,
                        idtransporte: 'transporte' + this.idmaster
                    }, {
                        xtype: 'tbspacer',
                        height: 10,
                        columnWidth: 1
                    }, {
                        xtype: 'textfield',
                        fieldLabel: 'Contacto',
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


        if (this.idimpoexpo == "OTM-DTA" && this.idtransporte == 'Terrestre') {
            Ext.getCmp('reporte' + this.idmaster).setVisible(true);
            Ext.getCmp("ca_master" + this.idmaster).readOnly = true;
        } else if (this.idimpoexpo == "Importaci\u00F3n" && this.idtransporte == "A\u00E9reo") {
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
                    ]}
        );
        if (this.permisos.Editar == true) {


            tb = new Ext.toolbar.Toolbar({dock: 'top'});
            tb.add({
                    text: 'Guardar',
                iconCls: 'add',
                width: 80,
                    
                    handler: function () {
                        var form = this.up('form').getForm();
                        var mas = this.up('form').idmaster;
                        var exito = false;
                        if (form.isValid()) {
                            form.submit({
                                url: "/inoF2/guardarMaster",
                                waitMsg: 'Guardando...',
                                waitTitle: 'Por favor espere...',
                                success: function (form, action) {

                                    var idmas = action.result.idmaster;
                                    var tabpanel = Ext.getCmp('tabpanel1');
                                    tabpanel = Ext.getCmp('tabpanel1');
                                    ref = idmas;
                                    numRef = action.result.idreferencia;
                                    idimpo = action.result.idimpoexpo;
                                    idtrans = action.result.idtransporte;
                                    if (!tabpanel.getChildByElement('tab' + ref) && ref != "")
                                    {
                                        tabpanel.add(
                                                {
                                                    title: numRef,
                                                    id: 'tab' + ref,
                                                    itemId: 'tab' + ref,
                                                    closable: true,
                                                    autoScroll: true,
                                                    items: [new Colsys.Ino.Mainpanel({"idmaster": ref, "idimpoexpo": idimpo, "idtransporte": idtrans, 'idreferencia': numRef})]
                                                }).show();
                                    }
                                    tabpanel.setActiveTab('tab' + ref);
                                    tabpanel.getChildByElement('tab0').close();
                                    Ext.MessageBox.alert('Error Message', "Exito.");
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
                 this.addDocked(tb, 'bottom');

           // tb = new Ext.toolbar.Toolbar();
            /*this.add(
                    {
                   buttons:{
                    
                   // xtype:'button',
                    text: 'Guardar',
                    width: 150,
                    
                    handler: function () {
                        var form = this.up('form').getForm();
                        var mas = this.up('form').idmaster;
                        var exito = false;
                        if (form.isValid()) {
                            form.submit({
                                url: "/inoF2/guardarMaster",
                                waitMsg: 'Guardando...',
                                waitTitle: 'Por favor espere...',
                                success: function (form, action) {

                                    var idmas = action.result.idmaster;
                                    var tabpanel = Ext.getCmp('tabpanel1');
                                    tabpanel = Ext.getCmp('tabpanel1');
                                    ref = idmas;
                                    numRef = action.result.idreferencia;
                                    idimpo = action.result.idimpoexpo;
                                    idtrans = action.result.idtransporte;
                                    if (!tabpanel.getChildByElement('tab' + ref) && ref != "")
                                    {
                                        tabpanel.add(
                                                {
                                                    title: numRef,
                                                    id: 'tab' + ref,
                                                    itemId: 'tab' + ref,
                                                    closable: true,
                                                    autoScroll: true,
                                                    items: [new Colsys.Ino.Mainpanel({"idmaster": ref, "idimpoexpo": idimpo, "idtransporte": idtrans, 'idreferencia': numRef})]
                                                }).show();
                                    }
                                    tabpanel.setActiveTab('tab' + ref);
                                    tabpanel.getChildByElement('tab0').close();
                                    Ext.MessageBox.alert('Error Message', "Exito.");
                                },
                                failure: function (form, action) {
                                    Ext.MessageBox.alert('Error Message', "Se ha presentado un error" + (action.result ? ": " + action.result.errorInfo : "") + " " + (action.response ? "\n Codigo HTTP " + action.response.status : ""));
                                }
                            });
                        } else {
                            Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
                        }
                    }
                }}
                    
                    



            );*/
            //this.add(tb);

        }

        Colsys.Ino.FormMaster.superclass.onRender.call(this, ct, position);

    },
    items: [
    ],
    buttons: [],
    listeners: {
        render: function (ct, position) {
            var idmasterr = this.idmaster;

            if (this.load1 == false || this.load1 == "undefined" || !this.load1)
            {
                var store = Ext.getCmp('modalidad' + this.idmaster).getStore();
                store.proxy.extraParams = {
                    idmaster: this.idmaster
                }
                store.reload();
                this.form.load({
                    url: '/inoF2/datosMaster',
                    params: {"idmaster": this.idmaster},
                    success: function (response, options) {
                        res = Ext.JSON.decode(options.response.responseText);

                        if (Ext.getCmp("proveedor" + idmasterr)) {
                            Ext.getCmp("proveedor" + idmasterr).store.add(
                                    {"idlinea": res.data.proveedor, "linea": res.data.linea}
                            );
                            Ext.getCmp("proveedor" + idmasterr).setValue(res.data.proveedor);
                            $('#proveedor' + idmasterr + '-inputEl').val(res.data.linea);
                        }

                        if (Ext.getCmp("agente" + idmasterr)) {
                            Ext.getCmp("agente" + idmasterr).store.add(
                                    {"idagente": res.data.idagente, "nombre": res.data.nombre}
                            );
                            Ext.getCmp("agente" + idmasterr).setValue(res.data.idagente);
                            $('#agente' + idmasterr + '-inputEl').val(res.data.nombre);
                        }
                        if (Ext.getCmp("ca_modalidad" + idmasterr)) {
                            Ext.getCmp("ca_modalidad" + idmasterr).store.add(
                                    {"id": res.data.id_modalidad, "name": res.data.ca_modalidad}
                            );
                            Ext.getCmp("ca_modalidad" + idmasterr).setValue(res.data.id_modalidad);
                            $('#ca_modalidad' + idmasterr + '-inputEl').val(res.data.ca_modalidad);
                        }

                        if (Ext.getCmp("agencia" + idmasterr)) {
                            Ext.getCmp("agencia" + idmasterr).store.add(
                                    {"idlinea": res.data.idlinea, "linea": res.data.agencia}
                            );
                            Ext.getCmp("agencia" + idmasterr).setValue(res.data.idlinea);
                            $('#agencia' + idmasterr + '-inputEl').val(res.data.agencia);
                        }

                        if (Ext.getCmp("cliente" + idmasterr)) {
                            Ext.getCmp("cliente" + idmasterr).store.add(
                                    {"idcliente": res.data.ca_idcliente, "compania": res.data.ca_compania}
                            );
                            Ext.getCmp("cliente" + idmasterr).setValue(res.data.ca_idcliente);
                            $('#cliente' + idmasterr + '-inputEl').val(res.data.ca_compania);
                        }

                        if (Ext.getCmp("idorigen" + idmasterr)) {
                            Ext.getCmp("idorigen" + idmasterr).store.add(
                                    {"idciudad": res.data.idorigen, "ciudad": res.data.origen}
                            );
                            Ext.getCmp("idorigen" + idmasterr).setValue(res.data.idorigen);
                            $('#idorigen' + idmasterr + '-inputEl').val(res.data.origen);
                        }
                        if (Ext.getCmp("iddestino" + idmasterr)) {
                            Ext.getCmp("iddestino" + idmasterr).store.add(
                                    {"idciudad": res.data.iddestino, "ciudad": res.data.destino}
                            );
                            Ext.getCmp("iddestino" + idmasterr).setValue(res.data.iddestino);
                            $('#iddestino' + idmasterr + '-inputEl').val(res.data.destino);
                        }
                    }
                });
                this.load1 = true;
            }


        }

    }

});
/**
 * @autor Felipe Nariño
 *
 * @param idmaster, idtransporte, idimpoexpo
 @comment Permite diligenciar campos de un master:
 modalidad, origen, destino, proveedor, agente, peso,piezas,
 volumen, fecha praviso, fecha llegada, fecha salida.
 */
Ext.define('Colsys.Ino.FormMaster', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormMaster',
    title: 'SISTEMA INO',
    bodyPadding: 5,
    width: 1000,
    layout: 'column',
    defaults: {
        columnWidth: 1 / 3,
        labelAlign: 'right'
    },
    defaultType: 'textfield',
    onRender: function (ct, position) {
        //console.log(this.permisos);
        this.add(
                {
                    xtype: 'fieldset',
                    title: 'General',
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
                        }, {
                            xtype: 'datefield',
                            fieldLabel: 'Fecha Registro',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            allowBlank: false,
                            name: 'fchreferencia',
                            format: "Y-m-d",
                            altFormat: "Y-m-d",
                            submitFormat: 'Y-m-d'
                        },
                        {
                            xtype: 'Colsys.Widgets.WgReporte',
                            fieldLabel: 'Reporte',
                            labelWidth: 100,
                            style: 'display:inline-block;text-align:left;font-weight:bold;',
                            name: 'idreporte',
                            id: 'reporte' + this.idmaster,
                            idtransporte: 'transporte' + this.idmaster,
                            idimpoexpo: 'impoexpo' + this.idmaster,
                            idmaster: this.idmaster,
                            listeners: {
                                select: function (combo, records, eOpts) {
                                    var idmaster = this.idmaster;
                                    form = Ext.getCmp('form-master-' + this.idmaster);
                                    var idreporte = records[0].data.idreporte;
                                    Ext.Ajax.request({
                                        url: '/widgets5/datosReporteCarga',
                                        params: {
                                            idreporte: idreporte
                                        },
                                        success: function (response, options) {
                                            var res = Ext.util.JSON.decode(response.responseText);

                                            if (Ext.getCmp("piezas" + idmaster).getValue() == "") {
                                                Ext.getCmp("piezas" + idmaster).setValue(res.data.ca_piezas);
                                            }
                                            if (Ext.getCmp("volumen" + idmaster).getValue() == "") {
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

                        }]},
                {
                    xtype: 'fieldset',
                    title: 'Informaci&oacute;n del trayecto',
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
                        }, {
                            fieldLabel: 'Origen',
                            xtype: 'Colsys.Widgets.WgCiudades2',
                            forceSelection: true,
                            id: 'idorigen' + this.idmaster,
                            name: 'idorigen',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 100,
                            width: 300,
                            idmaster: this.idmaster

                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        }, {
                            xtype: 'Colsys.Widgets.WgCiudades2',
                            fieldLabel: 'Destino',
                            forceSelection: true,
                            id: 'iddestino' + this.idmaster,
                            name: 'iddestino',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            width: 300,
                            idmaster: this.idmaster
                        }, {
                            xtype: 'Colsys.Widgets.WgLinea',
                            fieldLabel: 'Proveedor',
                            forceSelection: true,
                            id: 'proveedor' + this.idmaster,
                            name: 'proveedor',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 100,
                            width: 300,
                            idmaster: this.idmaster,
                            idtransporte: 'transporte' + this.idmaster

                        }, {
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
                            maxLength: 30,
                            maxLengthText: 'Tama\u00F1o m\u00E1ximo 30',
                            readOnly: false,
                            width: 300
                        }, {
                            xtype: 'numberfield',
                            fieldLabel: 'Peso',
                            id: 'peso' + this.idmaster,
                            name: 'ca_peso',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 100,
                            minValue: 0,
                            maxValue: 999999999.99,
                            maxLengthText: 'Tama\u00F1o m\u00E1ximo 999999999.99',
                            width: 300
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        }, {
                            xtype: 'numberfield',
                            fieldLabel: 'Piezas',
                            id: 'piezas' + this.idmaster,
                            name: 'ca_piezas',
                            minValue: 0,
                            maxValue: 999999999,
                            maxLengthText: 'Tama\u00F1o m\u00E1ximo 999999999',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            width: 300
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        }, {
                            xtype: 'datefield',
                            fieldLabel: 'Fecha Salida',
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
                            fieldLabel: 'Fecha Llegada',
                            allowBlank: false,
                            name: 'ca_fchllegada',
                            id: 'ca_fchllegada' + this.idmaster,
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            format: "Y-m-d",
                            altFormat: "Y-m-d",
                            submitFormat: 'Y-m-d',
                            width: 300
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 0.5
                        }
                    ]}
        );

        if (this.idimpoexpo == "Exportaci\u00F3n") {

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
                        fieldLabel: 'Modalidad',
                        forceSelection: true,
                        id: 'ca_modalidad' + this.idmaster,
                        name: 'ca_modalidad',
                        style: 'display:inline-block;text-align:center;font-weight:bold;',
                        labelWidth: 200,
                        allowBlank: false,
                        width: 300,
                        caso_uso: 'CU011'
                    }, {
                        xtype: 'Colsys.Widgets.WgProveedores',
                        fieldLabel: 'Agencia de Aduana',
                        forceSelection: true,
                        name: 'idlinea',
                        tipo: 'ADU',
                        id: 'agencia' + this.idmaster,
                        style: 'display:inline-block;text-align:center;font-weight:bold;',
                        labelWidth: 100,
                        width: 300,
                        allowBlank: false,
                        idmaster: this.idmaster,
                        idtransporte: 'transporte' + this.idmaster
                    }, {
                        xtype: 'tbspacer',
                        height: 10,
                        columnWidth: 1
                    }, {
                        xtype: 'textfield',
                        fieldLabel: 'Contacto',
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


        if (this.idimpoexpo == "OTM-DTA" && this.idtransporte == 'Terrestre') {
            Ext.getCmp('reporte' + this.idmaster).setVisible(true);
            Ext.getCmp("ca_master" + this.idmaster).readOnly = true;
        } else if (this.idimpoexpo == "Importaci\u00F3n" && this.idtransporte == "A\u00E9reo") {
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
                    ]}
        );
        if (this.permisos.Editar == true) {


            tb = new Ext.toolbar.Toolbar({dock: 'top'});
            tb.add({
                    xtype:'button',
                    text: 'Guardar',
                    width: 150,
                    
                    handler: function () {
                        var form = this.up('form').getForm();
                        var mas = this.up('form').idmaster;
                        var exito = false;
                        if (form.isValid()) {
                            form.submit({
                                url: "/inoF2/guardarMaster",
                                waitMsg: 'Guardando...',
                                waitTitle: 'Por favor espere...',
                                success: function (form, action) {

                                    var idmas = action.result.idmaster;
                                    var tabpanel = Ext.getCmp('tabpanel1');
                                    tabpanel = Ext.getCmp('tabpanel1');
                                    ref = idmas;
                                    numRef = action.result.idreferencia;
                                    idimpo = action.result.idimpoexpo;
                                    idtrans = action.result.idtransporte;
                                    if (!tabpanel.getChildByElement('tab' + ref) && ref != "")
                                    {
                                        tabpanel.add(
                                                {
                                                    title: numRef,
                                                    id: 'tab' + ref,
                                                    itemId: 'tab' + ref,
                                                    closable: true,
                                                    autoScroll: true,
                                                    items: [new Colsys.Ino.Mainpanel({"idmaster": ref, "idimpoexpo": idimpo, "idtransporte": idtrans, 'idreferencia': numRef})]
                                                }).show();
                                    }
                                    tabpanel.setActiveTab('tab' + ref);
                                    tabpanel.getChildByElement('tab0').close();
                                    Ext.MessageBox.alert('Error Message', "Exito.");
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
                 this.addDocked(tb, 'bottom');

           // tb = new Ext.toolbar.Toolbar();
            this.add(
                    {
                   buttons:{
                    
                   // xtype:'button',
                    text: 'Guardar',
                    width: 150,
                    
                    handler: function () {
                        var form = this.up('form').getForm();
                        var mas = this.up('form').idmaster;
                        var exito = false;
                        if (form.isValid()) {
                            form.submit({
                                url: "/inoF2/guardarMaster",
                                waitMsg: 'Guardando...',
                                waitTitle: 'Por favor espere...',
                                success: function (form, action) {

                                    var idmas = action.result.idmaster;
                                    var tabpanel = Ext.getCmp('tabpanel1');
                                    tabpanel = Ext.getCmp('tabpanel1');
                                    ref = idmas;
                                    numRef = action.result.idreferencia;
                                    idimpo = action.result.idimpoexpo;
                                    idtrans = action.result.idtransporte;
                                    if (!tabpanel.getChildByElement('tab' + ref) && ref != "")
                                    {
                                        tabpanel.add(
                                                {
                                                    title: numRef,
                                                    id: 'tab' + ref,
                                                    itemId: 'tab' + ref,
                                                    closable: true,
                                                    autoScroll: true,
                                                    items: [new Colsys.Ino.Mainpanel({"idmaster": ref, "idimpoexpo": idimpo, "idtransporte": idtrans, 'idreferencia': numRef})]
                                                }).show();
                                    }
                                    tabpanel.setActiveTab('tab' + ref);
                                    tabpanel.getChildByElement('tab0').close();
                                    Ext.MessageBox.alert('Error Message', "Exito.");
                                },
                                failure: function (form, action) {
                                    Ext.MessageBox.alert('Error Message', "Se ha presentado un error" + (action.result ? ": " + action.result.errorInfo : "") + " " + (action.response ? "\n Codigo HTTP " + action.response.status : ""));
                                }
                            });
                        } else {
                            Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
                        }
                    }
                }}
                    
                    



            );
            //this.add(tb);

        }

        Colsys.Ino.FormMaster.superclass.onRender.call(this, ct, position);

    },
    items: [
    ],
    buttons: [],
    listeners: {
        render: function (ct, position) {
            var idmasterr = this.idmaster;

            if (this.load1 == false || this.load1 == "undefined" || !this.load1)
            {
                var store = Ext.getCmp('modalidad' + this.idmaster).getStore();
                store.proxy.extraParams = {
                    idmaster: this.idmaster
                }
                store.reload();
                this.form.load({
                    url: '/inoF2/datosMaster',
                    params: {"idmaster": this.idmaster},
                    success: function (response, options) {
                        res = Ext.JSON.decode(options.response.responseText);

                        if (Ext.getCmp("proveedor" + idmasterr)) {
                            Ext.getCmp("proveedor" + idmasterr).store.add(
                                    {"idlinea": res.data.proveedor, "linea": res.data.linea}
                            );
                            Ext.getCmp("proveedor" + idmasterr).setValue(res.data.proveedor);
                            $('#proveedor' + idmasterr + '-inputEl').val(res.data.linea);
                        }

                        if (Ext.getCmp("agente" + idmasterr)) {
                            Ext.getCmp("agente" + idmasterr).store.add(
                                    {"idagente": res.data.idagente, "nombre": res.data.nombre}
                            );
                            Ext.getCmp("agente" + idmasterr).setValue(res.data.idagente);
                            $('#agente' + idmasterr + '-inputEl').val(res.data.nombre);
                        }
                        if (Ext.getCmp("ca_modalidad" + idmasterr)) {
                            Ext.getCmp("ca_modalidad" + idmasterr).store.add(
                                    {"id": res.data.id_modalidad, "name": res.data.ca_modalidad}
                            );
                            Ext.getCmp("ca_modalidad" + idmasterr).setValue(res.data.id_modalidad);
                            $('#ca_modalidad' + idmasterr + '-inputEl').val(res.data.ca_modalidad);
                        }

                        if (Ext.getCmp("agencia" + idmasterr)) {
                            Ext.getCmp("agencia" + idmasterr).store.add(
                                    {"idlinea": res.data.idlinea, "linea": res.data.agencia}
                            );
                            Ext.getCmp("agencia" + idmasterr).setValue(res.data.idlinea);
                            $('#agencia' + idmasterr + '-inputEl').val(res.data.agencia);
                        }

                        if (Ext.getCmp("cliente" + idmasterr)) {
                            Ext.getCmp("cliente" + idmasterr).store.add(
                                    {"idcliente": res.data.ca_idcliente, "compania": res.data.ca_compania}
                            );
                            Ext.getCmp("cliente" + idmasterr).setValue(res.data.ca_idcliente);
                            $('#cliente' + idmasterr + '-inputEl').val(res.data.ca_compania);
                        }

                        if (Ext.getCmp("idorigen" + idmasterr)) {
                            Ext.getCmp("idorigen" + idmasterr).store.add(
                                    {"idciudad": res.data.idorigen, "ciudad": res.data.origen}
                            );
                            Ext.getCmp("idorigen" + idmasterr).setValue(res.data.idorigen);
                            $('#idorigen' + idmasterr + '-inputEl').val(res.data.origen);
                        }
                        if (Ext.getCmp("iddestino" + idmasterr)) {
                            Ext.getCmp("iddestino" + idmasterr).store.add(
                                    {"idciudad": res.data.iddestino, "ciudad": res.data.destino}
                            );
                            Ext.getCmp("iddestino" + idmasterr).setValue(res.data.iddestino);
                            $('#iddestino' + idmasterr + '-inputEl').val(res.data.destino);
                        }
                    }
                });
                this.load1 = true;
            }


        }

    }

});
