/**
 * @autor Felipe Nariño
 *
 * @param idmaster, idtransporte, idimpoexpo
 @comment Permite diligenciar campos de un master:
 modalidad, origen, destino, proveedor, agente, peso,piezas,
 volumen, fecha praviso, fecha llegada, fecha salida.
 */
Ext.define('ComboIdg', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-idg',
    store: ['SI', 'NO', 'COLLECT','FACTURA AL AGENTE']
});

Ext.define('Colsys.Ino.FormMaster', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormMaster',
    title: 'SISTEMA INO',
    bodyPadding: 5,    
    autoScroll: true,
    layout: 'column',
    defaults: {
        columnWidth: 1 / 3,
        labelAlign: 'right'
    },
    defaultType: 'textfield',
    onRender: function (ct, position) {

        var textProveedor = "Proveedor";
        var textFechapreaviso = "Fecha Preaviso";

        if (this.idtransporte == "A\u00E9reo")
            textProveedor = "Aerolinea";
        else if (this.idtransporte == "Mar\u00EDtimo") {
            textProveedor = "Naviera";
            textFechapreaviso = "Fecha Zarpe";
        }
        this.add(
                {
                    xtype: 'fieldset',
                    title: 'General',
                    id: 'general' + this.idmaster,
                    height: 55,
                    columnWidth: 1,
                    layout: 'column',
                    hidden: (this.idmaster > 0) ? true : false,
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
                    },
                    {
                        xtype: 'Colsys.Widgets.WgReporte',
                        fieldLabel: 'Reporte',
                        labelWidth: 100,
                        style: 'display:inline-block;text-align:center;font-weight:bold;padding-left:60px;',
                        name: 'idreporte',
                        id: 'reporte' + this.idmaster,                            
                        idtransporte: this.idtransporte,
                        idimpoexpo: this.idimpoexpo,
                        idmaster: this.idmaster,
                        hidden: (this.idmaster > 0) ? true : false,
                        tabIndex: 1,
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

                                        if (Ext.getCmp("piezas" + idmaster).getValue() == "" || Ext.getCmp("piezas" + idmaster).getValue() == null) {
                                            Ext.getCmp("piezas" + idmaster).setValue(res.data.ca_piezas);
                                        }
                                        if (Ext.getCmp("volumen" + idmaster).getValue() == "" || Ext.getCmp("volumen" + idmaster).getValue() == null) {
                                            Ext.getCmp("volumen" + idmaster).setValue(res.data.ca_volumen);
                                        }
                                        if (Ext.getCmp("peso" + idmaster).getValue() == "" || Ext.getCmp("peso" + idmaster).getValue() == null) {
                                            Ext.getCmp("peso" + idmaster).setValue(res.data.ca_peso);
                                        }
                                        if (Ext.getCmp("fch_salida" + idmaster).getValue() == null || Ext.getCmp("fch_salida" + idmaster).getValue() == "") {
                                            Ext.getCmp("fch_salida" + idmaster).setValue(res.data.ca_fchsalida);
                                        }
                                        if (Ext.getCmp("tipovehiculo" + idmaster).getValue() == null || Ext.getCmp("tipovehiculo" + idmaster).getValue() == "") {
                                            Ext.getCmp("tipovehiculo" + idmaster).setValue(res.data.tipovehiculo);
                                        }
                                        if (Ext.getCmp("modalidad" + idmaster).getValue() == null || Ext.getCmp("modalidad" + idmaster).getValue() == "") {
                                            Ext.getCmp("modalidad" + idmaster).setValue(res.data.modalidad);
                                        }

                                        if (Ext.getCmp("ca_fchllegada" + idmaster).getValue() == null || Ext.getCmp("ca_fchllegada" + idmaster).getValue() == "") {
                                            Ext.getCmp("ca_fchllegada" + idmaster).setValue(res.data.ca_fchllegada);
                                        }

                                        if (Ext.getCmp("idorigen" + idmaster).getValue() == null || Ext.getCmp("idorigen" + idmaster).getValue() == "") {
                                            Ext.getCmp("idorigen" + idmaster).setValue(res.data.origen);
                                        }

                                        if (Ext.getCmp("iddestino" + idmaster).getValue() == null || Ext.getCmp("iddestino" + idmaster).getValue() == "") {
                                            Ext.getCmp("iddestino" + idmaster).setValue(res.data.destino);
                                        }
                                        if (Ext.getCmp("agente" + idmaster).getValue() == null || Ext.getCmp("agente" + idmaster).getValue() == "") {
                                            Ext.getCmp("agente" + idmaster).setValue(res.data.idagente);
                                        }

                                        if (Ext.getCmp("proveedor" + idmaster).getValue() == null || Ext.getCmp("proveedor" + idmaster).getValue() == "") {
                                            Ext.getCmp("proveedor" + idmaster).store.add(
                                                {"idlinea": res.data.idlinea, "linea": res.data.linea}
                                            );
                                            Ext.getCmp("proveedor" + idmaster).setValue(res.data.idlinea);
                                        }
                                        if (Ext.getCmp("ca_modalidad" + idmaster).getValue() == null || Ext.getCmp("ca_modalidad" + idmaster).getValue() == "") {
                                            Ext.getCmp("ca_modalidad" + idmaster).store.add(
                                                {"id": res.data.id_modalidad, "name": res.data.ca_modalidad}
                                            );
                                            Ext.getCmp("ca_modalidad" + idmaster).setValue(res.data.id_modalidad);
                                        }

                                        if (Ext.getCmp("ca_descripcion" + idmaster).getValue() == "" || Ext.getCmp("ca_descripcion" + idmaster).getValue() == null) {
                                            Ext.getCmp("ca_descripcion" + idmaster).setValue(res.data.ca_descripcion);
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
                    id: 'finformacion' + this.idmaster,
                    name: 'finformacion' + this.idmaster,
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
                        },
                        {
                            xtype: 'hidden',
                            id: 'idempresa' + this.idmaster,
                            name: 'idempresa',
                            value: this.idempresa
                        }
                        , {
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
                            idmaster: this.idmaster,
                            tabIndex: 2
                        },                        
                        Ext.create('Colsys.Widgets.WgCiudades2', {                            
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
                            tabIndex: 3,
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
                        {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        },                        
                        Ext.create('Colsys.Widgets.WgCiudades2', {                            
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
                            tabIndex: 4,
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
                        {
                            xtype: 'Colsys.Widgets.WgLinea',
                            fieldLabel: textProveedor,
                            forceSelection: true,
                            id: 'proveedor' + this.idmaster,
                            name: 'proveedor',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 100,
                            width: 300,
                            tabIndex: 5,
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
                            tabIndex: 6,
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
                            columnWidth: 0.1,
                            tabIndex: 7
                        }, {
                            xtype: 'checkboxfield',
                            boxLabel: 'Factura \u00DAnica',
                            name: 'factura_unica',
                            inputValue: '1',
                            id: 'factura_unica' + this.idmaster,
                            columnWidth: 0.1,
                            tabIndex: 8
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
                    items: [{
                            xtype: 'textfield',
                            fieldLabel: 'Master',
                            id: 'ca_master' + this.idmaster,
                            name: 'ca_master',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            maxLengthText: 'Tama\u00F1o m\u00E1ximo 30',
                            readOnly: false,
                            width: 300,
                            tabIndex: 8
                        }, {
                            xtype: 'datefield',
                            fieldLabel: 'Fch.Documento',                            
                            id: 'fchmaster' + this.idmaster,
                            name: 'ca_fchmaster',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 100,
                            format: "Y-m-d",
                            altFormat: "Y-m-d",
                            submitFormat: 'Y-m-d',
                            width: 300,
                            hidden: true,
                            tabIndex: 12
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
                            width: 300,
                            tabIndex: 9
                        }, {
                            xtype: 'datefield',
                            fieldLabel: textFechapreaviso,
                            id: 'fch_salida' + this.idmaster,
                            allowBlank: false,
                            name: 'ca_fchsalida',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 100,
                            format: "Y-m-d",
                            altFormat: "Y-m-d",
                            submitFormat: 'Y-m-d',
                            width: 300,
                            tabIndex: 13
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        }, {
                            xtype: 'numberfield',
                            fieldLabel: 'Peso',
                            id: 'peso' + this.idmaster,
                            name: 'ca_peso',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            minValue: 0,
                            maxValue: 999999999.99,
                            maxLengthText: 'Tama\u00F1o m\u00E1ximo 999999999.99',
                            width: 300,
                            tabIndex: 10
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
                            width: 300,
                            tabIndex: 14
                        }, {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        }, {
                            xtype: 'numberfield',
                            fieldLabel: 'Volumen',
                            minValue: 0,
                            maxValue: 999999999,
                            maxLengthText: 'Tama\u00F1o m\u00E1ximo 999999999',
                            id: 'volumen' + this.idmaster,
                            name: 'ca_volumen',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 200,
                            width: 300,
                            tabIndex: 11
                        }, {
                            xtype: 'Colsys.Widgets.WgParametros',
                            id: 'tipovehiculo' + this.idmaster,
                            fieldLabel: 'Tipo Vehiculo',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            caso_uso: 'CU020',
                            name: 'tipovehiculo',
                            width: 300,
                            labelWidth: 100,
                            hidden: true,
                            tabIndex: 15
                        },
                        {
                            xtype: 'textfield',
                            fieldLabel: 'Motonave',
                            id: 'ca_motonave' + this.idmaster,
                            name: 'ca_motonave',
                            style: 'display:inline-block;text-align:center;font-weight:bold;',
                            labelWidth: 100,
                            maxLengthText: 'Tama\u00F1o m\u00E1ximo 30',
                            width: 300,
                            hidden: true,
                            tabIndex: 16
                        },
                        {
                            xtype: 'tbspacer',
                            height: 10,
                            columnWidth: 1
                        }
                    ]}
        );
        if (this.idtransporte == "Terrestre") {
            Ext.getCmp('tipovehiculo' + this.idmaster).hidden = false;
        }
        if (this.idtransporte == "Mar\u00EDtimo") {
            Ext.getCmp('fchmaster' + this.idmaster).hidden = false;
            Ext.getCmp('ca_motonave' + this.idmaster).hidden = false;
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
                if (Ext.getCmp("fch_salida" + this.idmaster).getValue() == "" || Ext.getCmp("fch_salida" + this.idmaster).getValue() == null) {
                    Ext.getCmp('fch_salida' + this.idmaster).setValue(fch);
                    Ext.getCmp('ca_fchllegada' + this.idmaster).setValue(fch);                    
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
                    Ext.create('Colsys.Widgets.WgAgentesAduana', {
                        fieldLabel: 'Agencia de Aduana',                        
                        forceSelection: true,
                        id: 'agenciaad' + this.idmaster,
                        name: 'agenciaad',
                        style: 'display:inline-block;text-align:center;font-weight:bold;',
                        labelWidth: 150,
                        width: 600,
                        idmaster: this.idmaster,
                        idtransporte: 'transporte' + this.idmaster,
                        allowBlank: false
                    }),
                    {
                        xtype: 'tbspacer',
                        height: 10,
                        columnWidth: 1
                    }, 
                    Ext.create('ComboIdg',{
                        fieldLabel: 'Aplica IDG',
                        forceSelection: true,
                        name: 'aplicaidg',
                        id: 'aplicaidg' + this.idmaster,
                        style: 'display:inline-block;text-align:center;font-weight:bold;',
                        labelWidth: 200,
                        value: 'SI',
                        width: 300
                    }),{
                        xtype: 'tbspacer',
                        height: 10,
                        columnWidth: 1
                    }, {
                        xtype: 'textarea',
                        fieldLabel: 'Descripci&oacute;n de la mercanc&iacute;as',
                        id: 'ca_descripcion' + this.idmaster,
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

        this.add({
            xtype: 'fieldset',
            title: 'Observaciones',
            autoHeight: true,
            columnWidth: 1,
            layout: 'fit',
            defaults: {
                columnWidth: 1,
                bodyStyle: 'padding:4px'
            },
            items: [{
                    xtype: 'textarea',
                    name: 'ca_observaciones',
                    listeners: {
                        render: function () {
                            this.setHeight(this.up('form').getHeight() - 370);
                        }
                    }
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
                                    
                                    ref = idmas;
                                    
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

                                    tabpanel.getChildByElement('tab0').close();

                                    if (!tabpanel.getChildByElement('tab' + ref) && ref != "")
                                    {
                                        tabpanel.add({
                                            title: action.result.idreferencia,
                                            id: 'tab' + ref,
                                            itemId: 'tab' + ref,
                                            closable: true,
                                            autoScroll: true,
                                            items: [
                                                new Colsys.Ino.Mainpanel({
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
        idmastrer = this.idmaster;
        
        if (this.idimpoexpo == "Importaci\u00F3n" && this.idtransporte == "Mar\u00EDtimo" && this.idmodalidad == "COLOADING")
        {
            tb.add({
                xtype: 'button',
                text: '@ Coloader',
                id: "bcoloader" + idmastrer,
                name: "bcoloader" + idmastrer,                
                width: 150,
                handler: function () {
                    var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                        sorc: "/antecedentes/emailColoader/idmaster/" + idmastrer,
                        height: 600,
                        width: 1000
                    });
                    windowpdf.show();
                }
            });
        }

        if ((this.idimpoexpo == "Importaci\u00F3n" || this.idimpoexpo == "Triangulaci\u00F3n") && this.idtransporte == "Mar\u00EDtimo")
        {
            tb.add({
                xtype: 'button',
                text: 'Confirmaciones',
                id: "confirmaciones" + idmastrer,
                name: "confirmaciones" + idmastrer,
                iconCls: 'link',
                width: 150,
                handler: function () {
                    window.open("/status/indexExt5/idmaster/" + idmaster);
                }
            });
        }

        if (this.idimpoexpo == "OTM-DTA" && this.idtransporte == "Terrestre")
        {
            tb.add({
                xtype: 'button',
                text: 'Instrucciones',                
                width: 150,
                handler: function () {
                    var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                        sorc: "/inoF/instruccionesOtm/modo/5/idmaster/" + idmastrer
                    });
                    windowpdf.show();
                }
            }, {
                xtype: 'button',
                text: 'Confirmaciones',
                id: "confirmaciones-otm-" + idmastrer,
                name: "confirmaciones-otm-" + idmastrer,
                iconCls: 'link',
                width: 150,
                handler: function () {
                    window.open("/confirmacionesOtm/consulta/referencia/" + idmaster);
                }
            });
        }
        
        if (this.idtransporte == "Terrestre")
        {
            Ext.getCmp("tipovehiculo" + this.idmaster).getStore().load({
                params: {
                    caso_uso: 'CU020'
                }
            });
        }

        tb.add({
            text: 'Eventos',
            iconCls: 'user',
            handler: function () {
                openFile("/ids/formEventos?idmaster=" + idmastrer);
            }
        });

        this.addDocked(tb, 'bottom');
        
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
                var store = Ext.getCmp('modalidad' + this.idmaster).getStore();
                store.proxy.extraParams = {
                    idmaster: this.idmaster
                };
                store.reload();
                this.form.load({
                    url: '/inoF2/datosMaster',
                    params: {"idmaster": this.idmaster},
                    success: function (response, options) {
                        
                        res = Ext.JSON.decode(options.response.responseText);
                        
                        Ext.getCmp('finformacion' + idmasterr).setTitle("Informaci&oacute;n del trayecto [" + res.data.referencia + "," + idmasterr + "]");                        
                        Ext.getCmp("modalidad" + idmasterr).readOnly = res.data.modalidadnoeditable;
                        Ext.getCmp("idorigen" + idmasterr).readOnly = res.data.origennoeditable;
                        Ext.getCmp("iddestino" + idmasterr).readOnly = res.data.destinonoeditable;

                        Ext.getCmp("agente" + idmasterr).store.reload({
                            params: {
                                transporte: idtransporte
                            },
                            callback: function (records, operation, success) {
                                Ext.getCmp("agente" + idmasterr).store.add(
                                    {"idagente": res.data.idagente, "nombre": res.data.nombre}
                                );
                                Ext.getCmp("agente" + idmasterr).setValue(res.data.idagente);                                
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
                            }
                        });


                        if (Ext.getCmp("ca_modalidad" + idmasterr)) {
                            Ext.getCmp("ca_modalidad" + idmasterr).store.add(
                                    {"id": res.data.id_modalidad, "name": res.data.ca_modalidad}
                            );
                            Ext.getCmp("ca_modalidad" + idmasterr).setValue(res.data.id_modalidad);                            
                        }
                        if (Ext.getCmp("agenciaad" + idmasterr)) {
                            Ext.getCmp("agenciaad" + idmasterr).getStore().reload({
                                params: {
                                    tipo: "ADU"
                                },
                                callback: function (records, operation, success) {
                                    if (Ext.getCmp("agenciaad" + idmasterr)) {
                                        Ext.getCmp("agenciaad" + idmasterr).store.add(
                                                {"idagencia": res.data.idagencia, "nombre": res.data.agencia}
                                        );
                                        Ext.getCmp("agenciaad" + idmasterr).setValue(res.data.idagencia);
                                    }
                                }
                            });
                        }

                        if (Ext.getCmp("idorigen" + idmasterr)) {
                            Ext.getCmp("idorigen" + idmasterr).store.add(
                                    {"idciudad": res.data.idorigen, "ciudad": res.data.origen}
                            );
                            Ext.getCmp("idorigen" + idmasterr).setValue(res.data.idorigen);                            
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
function anularReferencia(id) {
    Ext.MessageBox.show({
        title: 'Anulacion de Referencia',
        msg: 'Ingrese el motivo de anulacion de la referencia:',
        width: 500,
        buttons: Ext.MessageBox.OKCANCEL,        
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
                            tabpanel.add({
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
                            
                            tabpanel.setActiveTab('tab' + ref);
                            Ext.MessageBox.alert("Mensaje", 'Datos Anulados Correctamente<br>');

                        } else {
                            Ext.MessageBox.alert("Mensaje", res.errorinfo);
                        }
                    }
                });
            }
        }
    }
};