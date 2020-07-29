Ext.define('Colsys.Status.FormPrincipal', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Status.FormPrincipal',
    listeners: {
        render: function (me, eOpts) {

            this.add(
                    {xtype: 'hidden', id: 'idmaster' + this.modulo + this.idmaster, name: 'idmaster', value: this.idmaster},
                    {xtype: 'hidden', id: 'modulo' + this.modulo + this.idmaster, name: 'modulo', value: this.modulo}
            );

            this.add({
                xtype: 'fieldset',
                id: 'fieldset-conf-' + this.modulo + this.idmaster,
                hidden: true,
                autoHeight: true,
                border: true,
                layout: {
                    type: 'table',
                    columns: 4,
                    tdAttrs: {style: 'padding: 5px;'},
                    tableAttrs: {
                        style: {
                            width: '90%'
                        }
                    }
                },
                items: [{
                        xtype: 'datefield',
                        fieldLabel: 'Fch. Confirmaci\u00F3n',
                        id: 'conf_fchconfirmacion-' + this.modulo + this.idmaster,
                        name: 'fchconfirmacion',
                        format: "Y-m-d",
                        altFormat: "Y-m-d",
                        maxValue: new Date(),
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        submitFormat: 'Y-m-d'
                    }, {
                        xtype: 'timefield',
                        id: 'conf_hora-' + this.modulo + this.idmaster,
                        name: 'horaconfirmacion',
                        fieldLabel: 'Hora confirmaci\u00F3n',
                        minValue: '00:00:01',
                        maxValue: '23:59:59',
                        increment: 30,
                        anchor: '100%',
                        format: 'H:i:s'
                    }, {
                        xtype: 'textfield',
                        fieldLabel: 'Registro Aduanero',
                        id: 'conf_registroadu-' + this.modulo + this.idmaster,
                        name: 'registroadu'
                    }, {
                        xtype: 'datefield',
                        fieldLabel: 'Fch. Registro',
                        id: 'conf_fchregistroadu-' + this.modulo + this.idmaster,
                        name: 'fchregistroadu',
                        format: "Y-m-d",
                        altFormat: "Y-m-d",
                        maxValue: new Date(),
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        submitFormat: 'Y-m-d'
                    }, {
                        xtype: 'textfield',
                        fieldLabel: 'Bandera',
                        id: 'conf_bandera-' + this.modulo + this.idmaster,
                        name: 'bandera'
                    }, {
                        xtype: 'textfield',
                        fieldLabel: 'Motonave Llegada',
                        id: 'conf_mnllegada-' + this.modulo + this.idmaster,
                        name: 'mnllegada'
                    }, {
                        xtype: 'Colsys.Widgets.WgParametros',
                        fieldLabel: 'Muelles',
                        id: 'conf_idmuelle-' + this.modulo + this.idmaster,
                        name: 'idmuelle',
                        caso_uso: 'CU268',
                        labelWidth: 100
                    }]
                    },
                    {
                        xtype: 'fieldset',
                        autoHeight: true,
                        border: true,                        
                        layout: {
                            type: 'table',
                            columns: 2,
                            tdAttrs: {style: 'padding: 5px;'},
                            tableAttrs: {
                                style: {
                                    width: '90%'
                                }
                            }
                        },
                        scrollable: true,                        
                        items: [
                            Ext.create('Ext.form.ComboBox', {
                                fieldLabel: 'Tipo Factura',
                                id: 'combofactura_status-' + this.modulo + this.idmaster,
                                name: 'combofactura',
                                store: Ext.create('Ext.data.Store', {
                                    fields: ['name'],
                                    data : [
                                        {"id": "ffletes", "name":"Factura de Fletes"},
                                        {"id": "cfletes", "name":"Certificaci\u00F3n de Fletes"},
                                        {"id": "rlocales", "name":"Recargos Locales"}
                                    ]
                                }),
                                value: 'ffletes',
                                queryMode: 'local',
                                displayField: 'name',
                                valueField: 'id',
                                //hidden: true,
                                listeners: {
                                    select: function (combo, records, eOpts) {
                                        var form = combo.up("form");
                                        var id = combo.getValue();
                                        
                                        Ext.getCmp('status_mensaje-' + form.modulo + form.idmaster).setValue(form.tflete[id]); 
                                    }
                                }
                            }),                            
                            {
                                xtype: 'textareafield',
                                fieldLabel: 'Mensaje de Confirmaci\u00F3n',
                                grow: true,
                                style: {
                                    width: '80%'
                                },
                                name: 'mensaje',
                                tabIndex: 8,
                                id: 'status_mensaje-' + this.modulo + this.idmaster,
                                rowspan: 2
                            },
                            {
                                xtype: 'filefield',
                                id: 'status_file-' + this.modulo + this.idmaster,
                                name: 'file',
                                tabIndex: 9,
                                fieldLabel: 'Adjunto',                            
                                msgTarget: 'side',
                                allowBlank: true,                            
                                buttonText: 'Adjuntar'
                            },
                            {
                                xtype: 'datefield',
                                fieldLabel: 'Modificar Fch. de Arribo',
                                id: 'status_fcharribo-' + this.modulo + this.idmaster,
                                name: 'fcharribo',
                                tabIndex: 10,                            
                                format: "Y-m-d",
                                altFormat: "Y-m-d",
                                //maxValue: new Date(),
                                disabled: true,
                                renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                submitFormat: 'Y-m-d'

                            }]
                    },
                    {
                        xtype: 'fieldset',
                        autoHeight: true,
                        border: true,
                        hidden: true,
                        id: "fieldset-vaciado-" + this.modulo + this.idmaster,
                        layout: {
                            type: 'table',
                            columns: 3,
                            tdAttrs: {style: 'padding: 5px;'},
                            tableAttrs: {
                                style: {
                                    width: '90%'
                                }
                            }
                        },
                        scrollable: true,                        
                        items: [{
                            xtype: 'datefield',
                            fieldLabel: 'Fch. Vaciado',
                            id: 'vaciado_fchvaciado-' + this.modulo + this.idmaster,
                            name: 'fchvaciado',
                            format: "Y-m-d",
                            altFormat: "Y-m-d",
                            maxValue: new Date(),
                            renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                            submitFormat: 'Y-m-d'
                        },
                        {
                            xtype: 'timefield',
                            id: 'vaciado_horavaciado-' + this.modulo + this.idmaster,
                            name: 'horavaciado',
                            fieldLabel: 'Hora Vaciado',
                            minValue: '00:00:01',
                            maxValue: '23:59:59',
                            increment: 30,
                            format: 'H:i:s'
                        },
                        {
                            xtype: 'datefield',
                            fieldLabel: 'Fch. Muisca',
                            id: 'vaciado_fchsyga-' + this.modulo + this.idmaster,
                            name: 'fchsyga',
                            format: "Y-m-d",
                            altFormat: "Y-m-d",
                            maxValue: new Date(),
                            renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                            submitFormat: 'Y-m-d'
                        }]
                    });
            
            Ext.getCmp('status_mensaje-' + this.modulo + this.idmaster).setValue(this.texto);

            var obj = {
                xtype: 'toolbar',
                dock: 'top',
                style: 'padding-right:500px;',
                items: [{
                    text: 'Enviar Mensaje',
                    id: 'enviar-mensaje-' + this.idmaster + this.modulo,
                    iconCls: 'disk',
                    handler: function () {
                        //console.log(this.up("panel"));
                        this.up("panel").prepararMensaje();
                    }
                }]
            };

            this.addDocked(obj);
            Ext.getCmp("conf_idmuelle-" + me.modulo + me.idmaster).getStore().load({                    
                params: {
                    caso_uso: Ext.getCmp("conf_idmuelle-" + me.modulo + me.idmaster).caso_uso
                }
            });
        }
    },
    validarCampos: function (modulo) {
        
        var idmaster = this.idmaster;
        var campos = this.getForm().getFields().items;
        var me = this;        
        
        Ext.getCmp('status_fcharribo-' + modulo + idmaster).setDisabled(false);            
        Ext.getCmp('combofactura_status-' + modulo + idmaster).hide();
        
        var arrayModulos = ["pto-llegada","llegada","ffletes","pto-desconsolidacion"];
        
        if(arrayModulos.indexOf(modulo)>-1){
            
            Ext.each(campos, function (name) {
                var nombrecampo = name.id.split("-")[0];                

                switch (modulo) {
                    case "pto-llegada":
                    case "llegada":
                        Ext.getCmp('fieldset-conf-' + modulo + idmaster).show();
                        if (nombrecampo.split("_")[0] === "conf") {
                            Ext.getCmp(nombrecampo + "-" + modulo + idmaster).allowBlank = false;
                        }
                        Ext.getCmp('status_fcharribo-' + modulo + idmaster).setDisabled(true);
                        break;
                    case "ffletes":                    
                        if (nombrecampo.split("_")[0] === "combofactura"){                                                    
                            Ext.getCmp(nombrecampo + "-" + modulo + idmaster).show();                            
                        }
                        break;
                    case "pto-desconsolidacion":                    
                        Ext.getCmp('fieldset-vaciado-' + modulo + idmaster).show();
                        if (nombrecampo.split("_")[0] === "vaciado") {
                            Ext.getCmp(nombrecampo + "-" + modulo + idmaster).allowBlank = false;
                        }
                        break;
                }

            });
        }
    },
    cargar: function () {
        var me = this;
        me.form.load({
            url: '/status/datosFormPrincipal',
            waitMsg:'Cargando datos de formulario principal...',
            params: {
                idmaster: me.idmaster
            },
            success: function (response, options) {
                
                var res = Ext.JSON.decode(options.response.responseText);
                
                Ext.getCmp("conf_idmuelle-" + me.modulo + me.idmaster).store.filterBy(function (record, id) {                    
                    if (record.data.valor2 === res.data.destino)
                        return true;
                    else
                        return false;
                });                                        
                    
            },
            failure: function () {
                Ext.Msg.alert('Alerta', 'Los datos no han cargado correctamente');
            }
        });
    },
    prepararMensaje: function (t) {
        var form = this.getForm();
        var idmaster = this.idmaster;
        var modulo = this.modulo;
        var me = this;
        
        var error = 0;
        var modosIdg = ["llegada","status","desconsolidacion","planilla","ffletes"];        

        
        if (form.isValid()) {
            var idhouses = Ext.getCmp('tab-panel-modulos' + idmaster).idhouses;
            var modo = modulo.split("-")[0];
            
            if (modo !== "pto") {
                var concliente = [];
                var filecliente = [];
                var planillacliente = [];
                var panel = [];
                var formInvalid = [];
                var files = [];
                var forms = [];
                var contactos = [];

                var houses = "";
                var fechas = "";
                var horas = "";
                var justificaciones = "";
                var exclusiones = "";
                var tipofactura = Ext.getCmp('combofactura_status-' + modulo + idmaster).getValue();

                $.each(idhouses.split(","), function (key, idhouse) {                    
                    var panelHouse = Ext.getCmp("panel-house-" + idhouse);
                    
                    if (panelHouse.collapsed === false) {                        

                        var gridContactos = Ext.getCmp("grid-concliente-" + idhouse);
                        var gridArchivos = Ext.getCmp("grid-archivos-" + idhouse);
                        var formHouse = Ext.getCmp("panel-hijo-" + idhouse).getForm();

                        var idcliente = Ext.getCmp('panel-house-' + idhouse).idcliente;
                        var clienteCuadro = Ext.getCmp('panel-house-' + idhouse).comunicaciones;
                        var storeContactos = gridContactos.getStore().getRange();
                        var storeArchivos = gridArchivos.getStore().getRange();
                        
                        if(houses!="")
                            houses+=",";
                        houses+= idhouse;                        
                        
                         /*Fechas para Idg Confirmación de Llegada*/
                        fchstatus = new Date();
                        hourstatus = new Date();
                        // Validación formulario Hijo                        
                        if (formHouse.isValid()) {
                            var valuesForm = formHouse.getFieldValues(true);
                            row = new Object();
                            if (Object.keys(valuesForm).length > 0) {                                
                                row.idhouse = idhouse;
                                row.mensaje = valuesForm.mensaje_cliente;
                                row.fchstatus = valuesForm.fchstatus;
                                row.horastatus = valuesForm.horastatus;
                                row.juststatus = valuesForm.juststatus;
                                row.excstatus = valuesForm.excstatus;
                                
                                if(modulo === "otm"){
                                    row.etapaOtm = valuesForm.etapa_otm;
                                    row.idbodega = valuesForm.bodega;
                                    switch(valuesForm.etapa_otm){
                                        case "IMCOL":
                                            row.fchllegadaOtm = valuesForm.fchllegada_otm;
                                            break;
                                        case "OTDES":
                                            row.fchcargueOtm = valuesForm.fchcargue_otm;
                                            row.fchsalidaOtm = valuesForm.fchsalida_otm;                                   
                                            break;
                                        case "99999":
                                            row.fchplanillaOtm = valuesForm.fchplanilla_otm;
                                            row.fchcierreOtm = valuesForm.fchcierre_otm;
                                            break;
                                    }
                                }
                                
                                fchstatus = valuesForm.fchstatus;
                                hourstatus = valuesForm.horastatus; 
                                
                                forms.push(row);                                
                            }
                        } else {
                            var invalidFields = [];
                            Ext.suspendLayouts();
                            formHouse.getFields().filterBy(function(field) {
                                if (field.validate()) return;
                                invalidFields.push(field);
                            });
                            Ext.resumeLayouts(true);                            
                            formInvalid.push(idhouse);
                        }
//                        console.log(forms);
//                        console.log(formHouse.isValid());
//                        exit();

                        /*Fechas para Idg Comunicaciones Marítimas al cliente*/
                        if(fechas != "")
                            fechas+= ",";
                        fechas+= '"'+Ext.Date.format(fchstatus, 'Y-m-d')+'"';

                        if(horas != "")
                            horas+= ",";
                        horas+= '"'+Ext.Date.format(hourstatus, 'H:i:s')+'"';                                

                        if(justificaciones != "")
                            justificaciones+= ",";
                        justificaciones+= valuesForm?(valuesForm.juststatus?'"'+valuesForm.juststatus+'"':null):null;
                        
                        if(exclusiones != "")
                            exclusiones+= ",";
                        exclusiones+= valuesForm?(valuesForm.excstatus?'"'+valuesForm.excstatus+'"':null):null;
                        
                        // Validación de selección de contactos fijos
                        cf = [];                        
                        Ext.Array.each(storeContactos, function (name, index) {
                            row = new Object();
                            eval("var seleccion = name.data.sel" + idhouse + ";");
                            if (seleccion === true) {
                                eval("var contacto = name.data.email" + idhouse + ";");
                                row.idhouse = idhouse;
                                row.email = contacto;
                                contactos.push(row);
                            }
                            if (name.data.tipo === "Contactos Fijos") {
                                cf.push(seleccion);
                            }
                        });

                        if (Ext.Array.indexOf(cf, true, 0) < 0 && clienteCuadro == null) {
                            concliente.push(idcliente);
                        }
                        
                        // Validación de selección de factura                        
                        fc = [];
                        if (storeArchivos.length > 0) {
                            Ext.Array.each(storeArchivos, function (name, index) {
                                row = new Object();
                                eval("var seleccion = name.data.sel" + idhouse + ";");   
                                console.log(name.data);
                                if (modulo === "ffletes" || modulo === "fcontenedores" || modulo === "fotm") {
                                    if (((name.data.iddocumental === 7 && name.data.idcomprobante !== null) || name.data.iddocumental === 25 )  && seleccion === true ) { // Factura de fletes o Certificación de fletes
                                        fc.push(true);
                                    }
                                }

                                if (seleccion === true) {
                                    row.idhouse = idhouse;
                                    row.idarchivo = name.data.idarchivo;
                                    row.idcomprobante = name.data.idcomprobante;
                                    row.documento = name.data.documento;
                                    files.push(row);
                                }
                            });                            
                        }
                        //console.log(fc);
                        if (modulo === "ffletes" || modulo === "fcontenedores" || modulo === "fotm") {
                            if (Ext.Array.indexOf(fc, true, 0) < 0) {
                                console.log("idcliente"+idcliente);
                                filecliente.push(idcliente);
                            }
                        }

                        // Validación de Planilla
                        if (modulo === "planilla") {
                            if (panelHouse.planilla === null) {
                                planillacliente.push(idcliente);
                            }
                        }                        
                        
                        panel.push(idhouse);
                        //console.log(fc);
                        console.log(filecliente);
                    }
                });
                //console.log(files);
//                        console.log(formInvalid.length);
                //        exit();
                //exit();
                var mensaje = "";
                if (panel.length < 1) {                    
                    mensaje+="- Debe seleccionar al menos un cliente para notificar.<br/>";
                    error++;
                }

                if (formInvalid.length > 0) {                    
                    mensaje+="- Debe diligenciar todos los campos obligatorios. Por favor verifique los campos resaltados en Rojo.<br/>";
                    error++;
                }

                if (concliente.length > 0) {                    
                    mensaje+="- Debe seleccionar al menos un contacto fijo para el(los) Cliente(s) con identificaci\u00F3n # " + concliente.join()+"<br/>";
                    error++;
                }

                if (filecliente.length > 0) {                    
                    mensaje+="- Debe adjuntar la(s) factura(s) para el(los) Cliente(s) con identificaci\u00F3n # " + filecliente.join()+". Verifique que la factura fue guardada a través del INO, opción guardar TRD.<br/>";
                    error++;
                }

                if (planillacliente.length > 0) {                    
                    mensaje+="- El(los) Cliente(s) con identificaci\u00F3n # " + planillacliente.join() + " no tiene(n) planilla reportada.<br/>";
                    error++;
                }

                var parametros = {
                    "strFiles": JSON.stringify(files),
                    "strForms": JSON.stringify(forms),
                    "strContactos": JSON.stringify(contactos),
                    "strHouse": JSON.stringify(panel),
                    "idhouses": JSON.stringify(idhouses)
                };
                
                var requiereIdg = modosIdg.indexOf(modo);
                
                if(requiereIdg > -1){
                    
                    Ext.Ajax.request({                        
                        waitMsg: 'Enviando...',
                        url: '/status/idgConfirmacion',
                        params: {
                            idhouses: "["+houses+"]",
                            fechas: "["+fechas+"]",
                            horas: "["+horas+"]",
                            justificaciones: "["+justificaciones+"]",
                            exclusiones: "["+exclusiones+"]",
                            datosArchivos: parametros.strFiles,
                            modo: modo,
                            tipofactura: tipofactura,
                            fechallegada: Ext.Date.format(me.getForm().findField('fchconfirmacion').getValue(), 'Y-m-d'),                            
                            horallegada: Ext.Date.format(me.getForm().findField('horaconfirmacion').getValue(), 'H:i:s')
                        },
                        failure: function (response, options) {
                            alert(response.responseText);
                            Ext.Msg.hide();
                            alert("Surgio un problema al tratar de calcular el tiempo de oportunidad.")
                        },
                        success: function (response, options) {
                            var res = Ext.util.JSON.decode(response.responseText);
                            //var error = 0;
                            //console.log(res);
                            if(res.data != null){
                                $.each(res.data, function (key, objIdg) {                                
                                    if (objIdg["cumplio"] == "No") {
                                        mensaje+=objIdg["mensaje"];
                                        if(!objIdg["exclusiones"]){
                                            //mensaje+='- De acuerdo al IDG del Doc. Transporte #'+objIdg["doctransporte"]+' est\u00E1 fuera del tiempo de oportunidad, favor diligenciar la casilla de justificaci\u00F3n que se ha habilitado. <br/>';

                                            Ext.getCmp('juststatus' + objIdg["idhouse"]).enable();
                                            Ext.getCmp('juststatus' + objIdg["idhouse"]).focus();
                                        }else{
                                            //mensaje+='- De acuerdo al IDG del Doc. Transporte #'+objIdg["doctransporte"]+' est\u00E1 fuera del tiempo de oportunidad, en caso de ser necesario, puede aplicar una exclusión. <br/>';
                                            //mensaje+=objIdg["mensaje"]+"<br/>";
                                            Ext.getCmp('juststatus' + objIdg["idhouse"]).enable();
                                            Ext.getCmp('excstatus' + objIdg["idhouse"]).enable();
                                            Ext.getCmp('excstatus' + objIdg["idhouse"]).focus();
                                        }
                                        error++;                                                                                                                       
                                    }                              
                                });
                            }
                            
                            if (error === 0)
                                me.enviarMensaje(parametros);
                            else
                                Ext.Msg.alert('Error', "Status con Errores! Por favor revisar: <br/>"+mensaje);
                            
                        }
                    });
                }else{
                    if (error === 0)
                        me.enviarMensaje(parametros);
                    else
                        Ext.Msg.alert('Error', "Status con Errores! Por favor revisar: <br/>"+mensaje);                    
                }                
            } else {
                switch (modulo) {
                    case "pto-planilla":
                        var gridPlanilla = Ext.getCmp('grid-planilla-' + idmaster);
                        var storePlanilla = gridPlanilla.getStore();
                        
                        var r = Ext.create(storePlanilla.getModel());
                        var fields = new Array();

                        for (i = 0; i < r.fields.length; i++) {
                            fields.push(r.fields[i].name.replace(idmaster, ""));
                        }

                        changes = [];
                        var records = storePlanilla.getModifiedRecords();
                        if (records.length > 0) {
                            for (var i = 0; i < records.length; i++) {
                                r = records[i];

                                row = new Object();
                                for (j = 0; j < fields.length; j++) {
                                    eval("row." + fields[j] + "=records[i].data." + fields[j] + idmaster + ";");
                                }

                                eval("var idhouse = records[i].data.idhouse" + idmaster + ";");
                                eval("var planilla = records[i].data.planilla" + idmaster + ";");

                                if (r.isValid()) {
                                    row.id = r.id;
                                    changes[i] = row;
                                }
                            }
                            var strPlanilla = JSON.stringify(changes);
                        } else {
                            Ext.Msg.alert('Alerta', 'Debe diligenciar el(los) n\u00FAmero (s) de planilla para al menos un (1) cliente');
                            error++;
                        }
                        break;
                }
                if (error === 0) {                    
                    var parametros = {"strPlanilla": strPlanilla};
                    this.enviarMensaje(parametros);
                }else{
                    Ext.Msg.alert('Error', "Status con Errores! Por favor revisar: <br/>"+mensaje);
            }            
            }
        } else {
            Ext.Msg.alert('Incompleto', "Por favor verifique que la informaci\u00F3n del mensaje est\u00E1 completa");
        }
    },
    enviarMensaje(options){
                
        var strPlanilla = options.strPlanilla?options.strPlanilla:null;
        var strFiles = options.strFiles?options.strFiles:null;
        var strForms = options.strForms?options.strForms:null;
        var strContactos = options.strContactos?options.strContactos:null;
        var strHouse = options.strHouse?options.strHouse:null;
        var idhouses = options.idhouses?options.idhouses:null;
        
        if(idhouses){
            idhouses = idhouses.substring(0, idhouses.length-1);
            idhouses = idhouses.substring(1);
            $.each(idhouses.split(","), function (key, idhouse) { 
                if(Ext.getCmp("mensaje_cliente"+idhouse))
                    Ext.getCmp("mensaje_cliente"+idhouse).setValue(null);
            });
        }
        //console.log(strFiles);
        //exit();
        var form = this.getForm();
        
        form.submit({
            url: '/status/crearStatus',
            params: {
                datosPlanilla: strPlanilla,
                datosArchivos: strFiles,
                datosForm: strForms,
                datosContactos: strContactos,
                idhouses: strHouse
            },
            waitMsg: 'Guardando',
            success: function (response, options) {

                var res = Ext.JSON.decode(options.response.responseText);

                Ext.MessageBox.alert("Mensaje", res.mensaje);

                if (res.modulo === "pto-planilla") {
                    Ext.getCmp('grid-planilla-' + idmaster).store.reload();
                }
            },
            failure: function (form, action) {
                Ext.MessageBox.alert("Error", action.result.errorInfo);
            }
        });
    }
});