Ext.define('ComboIdg', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-idg',
    store: ['SI', 'NO']
});

Ext.define('Colsys.Aduana.FormExpoAduana', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Aduana.FormExpoAduana',        
    bodyPadding: 5,    
    layout: 'column',
    defaults: {
        columnWidth: 1 / 3,
        labelAlign: 'right'
    },
    onRender: function (ct, position) {
        tmppermisos = this.permisos;
        permisoscrm = this.permisoscrm;
        
        this.add({
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
                xtype: 'hidden',
                id: 'referencia_' + this.idmaster,
                name: 'referencia',
                value: this.idreferencia
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
                origen: this.origen,
                destino: this.destino,                
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
//                                if (Ext.getCmp("tipovehiculo" + idmaster).getValue() == null || Ext.getCmp("tipovehiculo" + idmaster).getValue() == "") {
//                                    Ext.getCmp("tipovehiculo" + idmaster).setValue(res.data.tipovehiculo);
//                                }
                                if (Ext.getCmp("modalidad" + idmaster).getValue() == null || Ext.getCmp("modalidad" + idmaster).getValue() == "") {
                                    Ext.getCmp("modalidad" + idmaster).setValue(res.data.modalidad);
                                }
//
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
            title: 'Informaci\u00f3n de Exportaciones',
            id: 'info-expo' + this.idmaster,
            height: 55,
            columnWidth: 1,
            layout: 'column',
            hidden: this.modo=="Crear"?true:false,//(this.idmaster > 0) ? true : false,
            columns: 2,
            defaults: {
                columnWidth: 0.5,
                bodyStyle: 'padding:4px'
            },            
            items:[
                {
                    xtype: 'label',
                    id: 'ir' + this.idmaster,
                    name: 'ir',                    
                    text: '',
                    margin: '0 0 0 10'
                },
                {
                    xtype: 'label',
                    id: 'nit' + this.idmaster,
                    name: 'nit',                    
                    text: '',
                    margin: '0 0 0 10'
                },
                {
                    xtype: 'label',
                    id: 'rn' + this.idmaster,
                    name: 'rn',                    
                    text: '',
                    margin: '0 0 0 10'
                },                
                {
                    xtype: 'label',
                    id: 'compania' + this.idmaster,
                    name: 'compania',                    
                    text: '',
                    margin: '0 0 0 10'
                }
            ]
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
                    fieldLabel: 'Linea',
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
                    fieldLabel: 'Fch. Salida',
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
                },
                {
                    xtype: 'tbspacer',
                    height: 10,
                    columnWidth: 1
                }
            ]},
            {
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
                ]}
        );

        tb = new Ext.toolbar.Toolbar({dock: 'top'});
        console.log("508");
        console.log(this.permisos);
        if (this.permisos.Editar == true){
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
                            url: "/aduana/guardarMasterAdu",
                            waitMsg: 'Guardando...',
                            waitTitle: 'Por favor espere...',
                            success: function (form, action) {
                                me.this;
                                if (mas == 0)
                                {
                                    var idmas = action.result.idmaster;
                                    var tabpanel = Ext.getCmp('tabpanel1');

                                    ref = idmas;
                                    
                                    tabpanel.getChildByElement('tab0').close();                                    

                                    if (!tabpanel.getChildByElement('tab' + ref) && ref != ""){
                                        tabpanel.add({
                                            title: action.result.idreferencia,
                                            id: 'tab' + ref,
                                            itemId: 'tab' + ref,
                                            closable: true,
                                            autoScroll: true,
                                            items: [
                                                new Colsys.Aduana.Mainpanel({
                                                    "idmaster": action.result.idmaster,
                                                    "idtransporte": action.result.idtransporte,
                                                    "idimpoexpo": action.result.idimpoexpo, 
                                                    "origen": action.result.origen,
                                                    "destino": action.result.destino,
                                                    "idreferencia": action.result.idreferencia,
                                                    'permisos': tmppermisos, 
                                                    'permisoscrm': permisoscrm
                                                })
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
        this.addDocked(tb, 'bottom');
        Colsys.Aduana.FormExpoAduana.superclass.onRender.call(this, ct, position);
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
            toolbar = this.down("toolbar");            

            if (this.load1 == false || this.load1 == "undefined" || !this.load1 & this.idmaster != '0'){
                var store = Ext.getCmp('modalidad' + this.idmaster).getStore();
                store.proxy.extraParams = {
                    idmaster: this.idmaster
                };
                store.reload();
                this.form.load({
                    url: '/aduana/datosMasterAduana',
                    waitMsg: 'Cargando informaci\u00f3n de la referencia. Por favor espere un momento...',
                    params: {"idmaster":  this.idmaster},
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
                        
                        if (Ext.getCmp("ir" + idmasterr)) {                            
                            Ext.getCmp("ir" + idmasterr).setText("Id: "+res.data.idreporte);                            
                        }
                        
                        if (Ext.getCmp("rn" + idmasterr)) {                            
                            Ext.getCmp("rn" + idmasterr).setText("Rn: "+res.data.consecutivo);                            
                        }
                        
                        if (Ext.getCmp("nit" + idmasterr)) {                            
                            Ext.getCmp("nit" + idmasterr).setText("Nit: "+res.data.ca_idcliente);                            
                        }
                        
                        if (Ext.getCmp("compania" + idmasterr)) {                            
                            Ext.getCmp("compania" + idmasterr).setText("Cliente: "+res.data.ca_compania);                            
                        }

                        if (Ext.getCmp("iddestino" + idmasterr)) {
                            Ext.getCmp("iddestino" + idmasterr).store.add(
                                    {"idciudad": res.data.iddestino, "ciudad": res.data.destino}
                            );
                            Ext.getCmp("iddestino" + idmasterr).setValue(res.data.iddestino);
                            $('#iddestino' + idmasterr + '-inputEl').val(res.data.destino);
                        }
                        
                        toolbar.add({
                            xtype: 'button',
                            text: 'Status Expo',
                            id: "idstatus" + idmasterr,
                            iconCls: 'link',
                            width: 150,
                            consecutivo: res.data.consecutivo,
                            handler: function () {
                                window.open("/traficos/listaStatus/modo/expo?reporte=" + this.consecutivo);
                            }
                        });
                    }
                });
                this.load1 = true;
            }
        }
    }
});