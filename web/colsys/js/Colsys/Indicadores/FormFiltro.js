
/**
 * @autor Felipe Nariño 
 * @return Indicadores Tracking
 * @date:  2016-04-21
 */
indice = 0;
colors = ['blue', 'yellow', 'red', 'green', 'gray'];
res = [];
winindicadores = null;

function daysInMonth(month,year) {
    return new Date(year, month, 0).getDate();
}

function sortByAttribue(arr, attribute) {
  return arr.sort(function(a,b) { 
    return a[attribute] < b[attribute];
  });
}

function getHighest(array, attribute) {
    var max = 0;
    $.each(array, function(index, value) {
        $.each(value, function(index1, value1) {            
            if(index1 == attribute){
                if (value1 > (max || 0)){
                    max = value1;
                }
            }
        });
        
    });
    return max;
}

Ext.define('Colsys.Indicadores.FormFiltro', {
    extend: 'Ext.form.Panel',
    alias: 'widget.wFormFiltro',
    waitMsg : 'Please wait...',    
    autoScroll: true,                                                                        
    listeners: {
        afterrender: function (ct, position) {
            idform = this.id;
            var Fecha = new Date();
            var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() + 1) + "/" + Fecha.getFullYear());
            var sep = sFecha.indexOf('/') !== -1 ? '/' : '-';
            var aFecha = sFecha.split(sep);
            var fecha = aFecha[2] + '/' + aFecha[1] + '/' + aFecha[0];            
            
            fecha = new Date(fecha);            
            var anno = fecha.getFullYear();
            var mes = fecha.getMonth() + 1;
                        
            var haceunmes = "";
            if(mes == 1){ // Enero se pasa al a?o anterior
                anoIni = anno -1;
                mesIni = "12";
                diaIni = "01"                
            }else{
                anoIni = anno;
                mesIni = mes-1;
                mesIni = (mesIni < 10) ? ("0" + mesIni) : mesIni;
            }
            
            diaIni = "01"
            diaEnd = daysInMonth(mesIni, anoIni);
            haceunmes = anoIni + "-" + mesIni + "-" + diaIni;
            actual = anoIni + "-" + mesIni + "-" + diaEnd;            
            
            Ext.getCmp('fch_inicio' + idform + idform).setValue(haceunmes);
            Ext.getCmp('fch_fin' + idform + idform).setValue(actual);
            
            //Ext.getCmp('fch_inicio' + idform + idform).setValue('2016-01-01');
            //Ext.getCmp('fch_fin' + idform + idform).setValue('2016-02-28');
            Ext.getCmp('graficarbtn' + idform + idform).click();
        },
        render: function (ct, position) {
            me = this;
            idform = this.id;
            idmaster = this.idmaster;
            transporte = this.transporte;
            cli = this.cliente;
            
            //La búsqueda sólo podrá realizarse hasta el día anterior. 
            today = new Date();            
            dateEnd = new Date(today - 86400000);            
            
            this.add({
                items: [{
                    xtype: 'hiddenfield',
                    value: transporte,
                    name: 'transporte'
                }, 
                {
                    xtype: 'fieldset',
                    height: 230,
                    layout: 'column',
                    items: [{
                        xtype: 'fieldset',
                        title: 'Filtros de B&uacute;squeda',
                        layout: 'column',
                        columnWidth: 1,
                        height: 150,
                        defaults: {
                            columnWidth: .9,
                            labelAlign: 'left',
                            margin: '4px 4px 4px 4px',
                            padding: '2px 2px 2px 2px'
                        },
                        style: {
                            borderRadius: '9px',
                            marginLeft: '5%',
                            marginRight: '5%'
                        },
                        items: [{
                            xtype: 'Colsys.Widgets.WgTraficos',
                            prefijo: this.prefijo,
                            fieldLabel: 'Pais Origen ',
                            name: 'origen',
                            id: 'origen' + idform,
                            columnWidth: 0.3,
                            listeners: {
                                select: function (combo, record, eOpts) {
                                    Ext.getCmp('ciudadorigenopc' + idform).trafico = record.data.id;
                                }
                            }
                        },
                        {
                            xtype: 'fieldset',
                            checkboxToggle: true,
                            title: 'Elegir Ciudad Origen (Opcional)',
                            id: 'ciudadorigen' + idform,
                            height: 57,
                            checkboxName: 'checkOrigen',
                            columnWidth: 0.35,
                            collapsed: true,
                            items: [
                                Ext.create('Colsys.Widgets.WgCiudadesTrafico', {
                                    fieldLabel: 'Ciudad origen',
                                    prefijo: this.prefijo,
                                    name: 'ciudadorigenopc',
                                    id: 'ciudadorigenopc' + idform,
                                    labelWidth: 100,
                                    store: Ext.create('Ext.data.Store', {
                                        fields: ['id', 'name'],
                                        proxy: {
                                            type: 'ajax',
                                            url: this.prefijo + '/widgets5/datosCiudadesTrafico',
                                            reader: {
                                                type: 'json',
                                                root: 'root'
                                            }
                                        },
                                        autoLoad: false
                                    })
                                })
                            ],
                            listeners: {
                                collapse: function (p) {
                                    p.items.each(function (i) {
                                        i.disable();
                                    },
                                            this);
                                },
                                expand: function (p) {
                                    p.items.each(function (i) {
                                        i.enable();
                                    },
                                            this);
                                }
                            }
                        },
                        {
                            xtype: 'fieldset',
                            checkboxToggle: true,
                            title: 'Elegir Ciudad Destino (Opcional)',
                            id: 'topenOri2' + idform,
                            checkboxName: 'checkOrigen',
                            columnWidth: 0.34,
                            height: 57,
                            defaultType: 'textfield',
                            collapsed: true,
                            items: [{
                                xtype: 'Colsys.Widgets.WgCiudadesTrafico',
                                fieldLabel: 'Ciudad destino',
                                prefijo: this.prefijo,
                                name: 'destinopc',
                                id: 'destinopc' + idform,
                                labelWidth: 100
                            }],
                            listeners: {
                                collapse: function (p) {
                                    p.items.each(function (i) {
                                        i.disable();
                                    },
                                            this);
                                },
                                expand: function (p) {
                                    p.items.each(function (i) {
                                        i.enable();
                                    },
                                            this);
                                }
                            }
                        },
                        {
                            xtype: 'displayfield',
                            value: '',
                            columnWidth: 0.3
                        },
                        {
                            xtype: 'fieldset',
                            height: 50,
                            columnWidth: 0.69,
                            style: {
                                borderRadius: '5px'
                            },
                            layout: 'column',
                            items: [{
                                xtype: 'tbspacer',
                                columnWidth: 1,
                                height: 4
                            },{
                                xtype: 'datefield',
                                fieldLabel: 'Fecha Inicio',
                                id: 'fch_inicio' + idform + idform,
                                allowBlank: false,
                                style: {
                                    marginLeft: '3%',
                                    marginTop: '1%'
                                },
                                name: 'fecha_inicio',
                                format: "Y-m-d",
                                altFormat: "Y-m-d",
                                minValue: '2016-01-01',                                    
                                submitFormat: 'Y-m-d',
                                columnWidth: 0.45
                            },
                            {
                                xtype: 'datefield',
                                fieldLabel: 'Fecha Fin',
                                name: 'fecha_fin',
                                allowBlank: false,                                
                                style: {
                                    marginLeft: '5%',
                                    marginTop: '1%'
                                },
                                id: 'fch_fin' + idform + idform,
                                format: "Y-m-d",
                                altFormat: "Y-m-d",
                                maxValue: dateEnd,
                                submitFormat: 'Y-m-d',
                                columnWidth: 0.45
                            }]
                        },
                        {
                            xtype: 'tbspacer',
                            columnWidth: 1,
                            height: 10
                        }]
                    },
                    {
                        xtype: 'displayfield',
                        value: '',
                        columnWidth: 0.8
                    },
                    {
                        xtype: 'button',
                        text: 'Graficar',
                        columnWidth: .15,
                        id: 'graficarbtn' + idform + idform,                                
                        handler: function () {
                            if (Ext.getCmp(idform).getForm().isValid()) {
                                var myMsg = Ext.create('Ext.window.MessageBox', {
                                    closeAction: 'destroy',
                                    id: 'message'
                                }).show({
                                    title: 'Mensaje',
                                    message: 'Generando el informe... Por favor espere un momento!'
                                });
                                tabpanel = Ext.getCmp('tab-panel-graficas' + idform + idform);
                                indice++;
                                if (!tabpanel.getChildByElement('tabgraficas' + indice + idform)){
                                    date1 = new Date(Ext.getCmp('fch_inicio' + idform + idform).getValue());
                                    var anno = date1.getFullYear();
                                    var mes = date1.getMonth() + 1;
                                    var dia = date1.getDate();
                                    mes = (mes < 10) ? ("0" + mes) : mes;
                                    dia = (dia < 10) ? ("0" + dia) : dia;
                                    var desde = anno + "-" + mes + "-" + dia;
                                    date2 = new Date(Ext.getCmp('fch_fin' + idform + idform).getValue());
                                    var anno = date2.getFullYear();
                                    var mes = date2.getMonth() + 1;
                                    var dia = date2.getDate();
                                    mes = (mes < 10) ? ("0" + mes) : mes;
                                    dia = (dia < 10) ? ("0" + dia) : dia;
                                    var hasta = anno + "-" + mes + "-" + dia;
                                    subtitulo = desde + " a " + hasta;
                                    tabpanel.add({                                        
                                        title: subtitulo,
                                        id: 'tabgraficas' + indice + idform,
                                        itemId: 'tabgraficas' + indice + idform,
                                        class: 'tabgraficas' + indice + idform,
                                        autoDestroy: false,
                                        closable: true,                                        
                                        autoScroll: true,                                        
                                        defaults: {
                                            bodyPadding: 10,
                                            scrollable: true
                                        },
                                        listeners: {
                                            close: function (tab, eOpts) {
                                                this.items.each(function (childItem) {
                                                    this.remove(childItem);
                                                }, this);
                                            }
                                        },
                                        items: [
                                            Ext.create('Ext.panel.Panel', {
                                                bodyPadding: 10,
                                                id: 'formpanel-' + indice + idform,                                                                                                
                                                autoScroll: true,
                                                height: 5000,
                                                listeners: {
                                                    beforerender: function (ct, position) {
                                                        pref = Ext.getCmp(idform).prefijo;
                                                        filtro = JSON.stringify(Ext.getCmp(idform).getForm().getValues());                                                        
                                                        tab = this;
//                                                        b = $('.tabgraficas' + indice + idform);
//                                                        a = $("<div></div>").text("AAAAAAAAA");
//                                                        a.appendTo(b);
                                                    },
                                                    afterrender: function (ct, position) {
                                                        Ext.Ajax.request({
                                                            url: pref + '/widgets5/paisesGraficasIndicadores',
                                                            params: {
                                                                filtro: filtro,
                                                                cliente: cli
                                                            },
                                                            success: function (response, options) {
                                                                var resp = Ext.decode(response.responseText);
                                                                if (resp.success){//                                                                
                                                                    Ext.Ajax.request({
                                                                        url: pref + '/widgets5/datosGraficasIndicadores',
                                                                        params: {
                                                                            filtro: filtro,
                                                                            cliente: cli
                                                                        },
                                                                        success: function (response, options) {
                                                                            res[indice] = Ext.decode(response.responseText);                                                                            
                                                                            datos = res[indice].datosgrid;
                                                                            datoscoor = res[indice].griddatoscumplimiento;

                                                                            datosLcl = res[indice].gridvolumen;
                                                                            tab.add(                                                                                
                                                                                /***PANEL IDG OPORTUNIDAD EN EL ZARPE**/
                                                                                Ext.create('Colsys.Indicadores.PanelGrafica',{
                                                                                    id: 'grafica3' + indice + idform + "-panel",
                                                                                    idgrafica: 'grafica3',
                                                                                    indice: indice,
                                                                                    idform: idform,
                                                                                    ngrafica: transporte == "Mar\u00EDtimo"?"Oportunidad en el Zarpe":"Oportunidad en la Salida",
                                                                                    subtitulo: subtitulo,
                                                                                    transporte: transporte,
                                                                                    listeners: {                                                                                        
                                                                                        render: function (ct, position) {
                                                                                            var me = this;
                                                                                            this.add({
                                                                                                xtype: 'Colsys.Indicadores.grZarpe',
                                                                                                id: me.idgrafica + indice + idform,
                                                                                                name: me.idgrafica,
                                                                                                class: 'grafica',
                                                                                                filtro: "zarpe",
                                                                                                pref: pref,
                                                                                                res: res
                                                                                            });                                                                                            
                                                                                        }
                                                                                    }
                                                                                }),
                                                                                /***PANEL IDG OPORTUNIDAD EN LA LLEGADA**/
                                                                                Ext.create('Colsys.Indicadores.PanelGrafica',{
                                                                                    id: 'grafica4' + indice + idform + "-panel",
                                                                                    idgrafica: 'grafica4',
                                                                                    indice: indice,
                                                                                    idform: idform,
                                                                                    ngrafica: 'Oportunidad en la Llegada',
                                                                                    subtitulo: subtitulo,
                                                                                    transporte: transporte,
                                                                                    listeners: {                                                                                        
                                                                                        render: function (ct, position) {
                                                                                            var me = this;
                                                                                            this.add({
                                                                                                xtype: 'Colsys.Indicadores.grLlegada',
                                                                                                id: me.idgrafica + indice + idform,
                                                                                                name: me.idgrafica,
                                                                                                class: 'grafica',
                                                                                                filtro: "llegada",
                                                                                                pref: pref,
                                                                                                res: res
                                                                                            });                                                                                            
                                                                                        }
                                                                                    }
                                                                                }),
                                                                                /***PANEL IDG OPORTUNIDAD EN LA FACTURACIÓN**/
                                                                                Ext.create('Colsys.Indicadores.PanelGrafica',{
                                                                                    id: 'grafica5' + indice + idform + "-panel",
                                                                                    idgrafica: 'grafica5',
                                                                                    indice: indice,
                                                                                    idform: idform,
                                                                                    ngrafica: 'Oportunidad en la Facturaci&oacute;n',
                                                                                    subtitulo: subtitulo,
                                                                                    transporte: transporte,
                                                                                    listeners: {                                                                                        
                                                                                        render: function (ct, position) {
                                                                                            var me = this;
                                                                                            this.add({
                                                                                                xtype: 'Colsys.Indicadores.grFacturacion',
                                                                                                id: me.idgrafica + indice + idform,
                                                                                                name: me.idgrafica,
                                                                                                class: 'grafica',
                                                                                                filtro: "facturacion",
                                                                                                pref: pref,                                                                                                
                                                                                                res: res
                                                                                            });                                                                                            
                                                                                        }
                                                                                    }
                                                                                }),
                                                                                /***PANEL IDG OPORTUNIDAD EN LA DESCONSOLIDACIÓN**/
                                                                                Ext.create('Colsys.Indicadores.PanelGrafica',{
                                                                                    id: 'grafica6' + indice + idform + "-panel",
                                                                                    idgrafica: 'grafica6',
                                                                                    indice: indice,
                                                                                    idform: idform,
                                                                                    ngrafica: 'Oportunidad en la Desconsolidaci\u00F3n',
                                                                                    subtitulo: subtitulo,
                                                                                    transporte: transporte,
                                                                                    listeners: {                                                                                        
                                                                                        render: function (ct, position) {
                                                                                            var me = this;
                                                                                            this.add({
                                                                                                xtype: 'Colsys.Indicadores.grVaciado',
                                                                                                id: me.idgrafica + indice + idform,
                                                                                                name: me.idgrafica,
                                                                                                class: 'grafica',
                                                                                                filtro: "vaciado",
                                                                                                pref: pref,                                                                                                
                                                                                                res: res
                                                                                            });                                                                                            
                                                                                        }
                                                                                    }
                                                                                }),
                                                                                /***PANEL IDG COORDINACIÓN DE EMBARQUE**/
                                                                                Ext.create('Colsys.Indicadores.PanelGrafica',{
                                                                                    id: 'grafica8' + indice + idform + "-panel",
                                                                                    idgrafica: 'grafica8',
                                                                                    indice: indice,
                                                                                    idform: idform,
                                                                                    ngrafica: 'Coordinación de Embarque',
                                                                                    subtitulo: subtitulo,
                                                                                    transporte: transporte,
                                                                                    listeners: {                                                                                        
                                                                                        render: function (ct, position) {
                                                                                            var me = this;
                                                                                            this.add({
                                                                                                xtype: 'Colsys.Indicadores.grEmbarque',
                                                                                                id: me.idgrafica + indice + idform,
                                                                                                name: me.idgrafica,
                                                                                                class: 'grafica',
                                                                                                filtro: 'embarque',
                                                                                                pref: pref,                                                                                                
                                                                                                res: res
                                                                                            });                                                                                            
                                                                                        }
                                                                                    }
                                                                                }),
                                                                                /***PANEL IDG TIEMPO DE TRANSITO**/                                                                                    
                                                                                Ext.create('Colsys.Indicadores.PanelGrafica',{
                                                                                    id: 'grafica2' + indice + idform + "-panel",
                                                                                    idgrafica: 'grafica2',
                                                                                    indice: indice,
                                                                                    idform: idform,
                                                                                    ngrafica:"Tiempo de transito",
                                                                                    subtitulo: subtitulo,
                                                                                    transporte: transporte,
                                                                                    listeners: {                                                                                        
                                                                                        render: function (ct, position) {
                                                                                            var me = this;
                                                                                            this.add({
                                                                                                xtype: 'Colsys.Indicadores.grTiempoTransito',
                                                                                                id: me.idgrafica + indice + idform,                                                                                                
                                                                                                filtro: "transito",                                                                                                
                                                                                                fields: res[indice].y,                                                                                                                                                                                                                                                                                                
                                                                                                res: res                                                                                                
                                                                                            });                                                                                            
                                                                                        }
                                                                                    }
                                                                                }),
                                                                                /***PANEL DATOS VOLUMEN LCL***/
                                                                                Ext.create('Colsys.Indicadores.PanelGrafica',{
                                                                                    id: 'grafica1' + indice + idform + "-panel",
                                                                                    idgrafica: 'grafica1',
                                                                                    indice: indice,
                                                                                    idform: idform,
                                                                                    ngrafica:"Volumen x Tr&aacute;fico LCL",
                                                                                    subtitulo: subtitulo,
                                                                                    transporte: transporte,
                                                                                    listeners: {                                                                                        
                                                                                        render: function (ct, position) {
                                                                                            var me = this;
                                                                                            this.add({
                                                                                                xtype: 'Colsys.Indicadores.grDatosVolumen',
                                                                                                id: me.idgrafica + indice + idform,                                                                                                
                                                                                                filtro: "volumen",                                                                                                
                                                                                                fields: res[indice].y,                                                                                                
                                                                                                tipo: 'LCL',
                                                                                                res: res                                                                                                
                                                                                            });                                                                                            
                                                                                        }
                                                                                    }
                                                                                }),                                                                                
                                                                                /***PANEL DATOS VOLUMEN FCL***/
                                                                                Ext.create('Colsys.Indicadores.PanelGrafica',{
                                                                                    id: 'grafica1FCL' + indice + idform + "-panel",
                                                                                    idgrafica: 'grafica1FCL',
                                                                                    indice: indice,
                                                                                    idform: idform,
                                                                                    ngrafica:"Volumen x Tr&aacute;fico FCL",
                                                                                    subtitulo: subtitulo,
                                                                                    transporte: transporte,
                                                                                    listeners: {                                                                                        
                                                                                        render: function (ct, position) {
                                                                                            var me = this;
                                                                                            this.add({
                                                                                                xtype: 'Colsys.Indicadores.grDatosVolumen',
                                                                                                id: me.idgrafica + indice + idform,                                                                                                
                                                                                                filtro: "volumen",                                                                                                
                                                                                                fields: res[indice].y,
                                                                                                tipo: 'FCL',
                                                                                                res: res                                                                                                
                                                                                            });                                                                                            
                                                                                        }
                                                                                    }
                                                                                }),
                                                                                /***PANEL DATOS FACTURACION X TRAFICO***/
                                                                                Ext.create('Colsys.Indicadores.PanelGrafica',{
                                                                                    id: 'grafica10' + indice + idform + "-panel",
                                                                                    idgrafica: 'grafica10',
                                                                                    indice: indice,
                                                                                    idform: idform,
                                                                                    ngrafica:"Facturaci&oacute;n x Tr&aacute;fico",
                                                                                    subtitulo: subtitulo,
                                                                                    transporte: transporte,
                                                                                    listeners: {                                                                                        
                                                                                        render: function (ct, position) {
                                                                                            var me = this;
                                                                                            this.add({
                                                                                                xtype: 'Colsys.Indicadores.grDatosFacturacion',                                                                                                
                                                                                                id: me.idgrafica + indice + idform,                                                                                                
                                                                                                filtro: "transito",                                                                                                
                                                                                                fields: res[indice].y,
                                                                                                tipo: 'xTrafico',
                                                                                                res: res
                                                                                            });                                                                                            
                                                                                        }
                                                                                    }
                                                                                }),    
                                                                                /***PANEL DATOS FACTURACION X MES***/
                                                                                Ext.create('Colsys.Indicadores.PanelGrafica',{
                                                                                    id: 'grafica11' + indice + idform + "-panel",
                                                                                    idgrafica: 'grafica11',
                                                                                    indice: indice,
                                                                                    idform: idform,
                                                                                    ngrafica:"Facturaci&oacute;n x Mes",
                                                                                    subtitulo: subtitulo,
                                                                                    transporte: transporte,
                                                                                    listeners: {                                                                                        
                                                                                        render: function (ct, position) {
                                                                                            var me = this;
                                                                                            this.add({
                                                                                                xtype: 'Colsys.Indicadores.grDatosFacturacion',                                                                                                
                                                                                                id: me.idgrafica + indice + idform,
                                                                                                //name: me.idgrafica,
                                                                                                class: 'grafica',
                                                                                                filtro: "transito",                                                                                                
                                                                                                fields: res[indice].y,                                                                                                                                                                                                                                                                                                                                                                                                
                                                                                                tipo: 'xMes',
                                                                                                res: res
                                                                                            });                                                                                            
                                                                                        }
                                                                                    }
                                                                                }),    
                                                                                /***PANEL DATOS PESO x TRAFICO***/
                                                                                Ext.create('Colsys.Indicadores.PanelGrafica',{
                                                                                    id: 'grafica7' + indice + idform + "-panel",
                                                                                    idgrafica: 'grafica7',
                                                                                    indice: indice,
                                                                                    idform: idform,
                                                                                    ngrafica:"Peso x Tr&aacute;fico",
                                                                                    subtitulo: subtitulo,
                                                                                    transporte: transporte,
                                                                                    listeners: {                                                                                        
                                                                                        render: function (ct, position) {
                                                                                            var me = this;
                                                                                            this.add({
                                                                                                xtype: 'Colsys.Indicadores.grDatosPeso',
                                                                                                id: me.idgrafica + indice + idform,
                                                                                                name: me.idgrafica,                                                                                                
                                                                                                filtro: "peso",                                                                                                
                                                                                                fields: res[indice].y,
                                                                                                tipo: 'xTrafico',
                                                                                                res: res                                                                                                
                                                                                            });                                                                                            
                                                                                        }
                                                                                    }
                                                                                }),
                                                                                /***PANEL DATOS PESO x MES***/
                                                                                Ext.create('Colsys.Indicadores.PanelGrafica',{
                                                                                    id: 'grafica7_1' + indice + idform + "-panel",
                                                                                    idgrafica: 'grafica7_1',
                                                                                    indice: indice,
                                                                                    idform: idform,
                                                                                    ngrafica:"Peso x Mes",
                                                                                    subtitulo: subtitulo,
                                                                                    transporte: transporte,
                                                                                    listeners: {                                                                                        
                                                                                        render: function (ct, position) {
                                                                                            var me = this;
                                                                                            this.add({
                                                                                                xtype: 'Colsys.Indicadores.grDatosPeso',
                                                                                                id: me.idgrafica + indice + idform,
                                                                                                name: me.idgrafica,                                                                                                
                                                                                                filtro: "peso",                                                                                                
                                                                                                fields: res[indice].y,
                                                                                                tipo: 'xMes',
                                                                                                res: res                                                                                                
                                                                                            });                                                                                            
                                                                                        }
                                                                                    }
                                                                                })                                                                                 
                                                                            );

                                                                            /*Oculta la gráfica de Volumen LCL y Desconsolidación cuándo no hay negocios LCL*/
                                                                            if(jQuery.isEmptyObject(res[indice].gridvolumen)){
                                                                                $('#grafica1' + indice + idform + "-panel").hide();
                                                                                $('#grafica6' + indice + idform + "-panel").hide();
                                                                            }

                                                                            /*Oculta la gráfica cuándo no hay negocios FCL*/
                                                                            if(jQuery.isEmptyObject(res[indice].gridvolumenFCL)){
                                                                                $('#grafica1FCL' + indice + idform + "-panel").hide();
                                                                            }

                                                                            /*Oculta la gráfica cuándo no mide Coordinación de Embarque*/
                                                                            if(res[indice].clienteEmbarque==null){
                                                                                $('#grafica8' + indice + idform + "-panel").hide();
                                                                            }
                                                                            myMsg.close();    
                                                                        }
                                                                    });                                                                                
                                                                }else if(resp.errorInfo!=""){
                                                                    Ext.MessageBox.alert("Mensaje",'El Nit del cliente existe en nuestra base de datos');                                                                            
                                                                }
                                                            }                                                                
                                                        });
                                                    }
                                                }
                                        })]
                                    }).show();                                            
                                }
//                                b = $('.tabgraficas' + indice + idform);
//                                a = $("<div></div>").text("AAAAAAAAA");
//                                a.appendTo(b);
                                tabpanel.setActiveTab('tabgraficas' + indice + idform);                                        
                            } else {
                                Ext.MessageBox.alert("Error", "Debe Ingresar Rango de Fechas");
                            }
                        }
                    }]
                },{
                    xtype: 'tabpanel',
                    id: 'tab-panel-graficas' + idform + idform,                    
                }]
            });
            Ext.getCmp(idform).add();
            var me = this;
            this.superclass.onRender.call(this, ct, position);
        }
    }
});
function agregarFooter(panel, titulo, subtitulo, transporte) {
    tb = new Ext.toolbar.Toolbar({
        dock: 'bottom',
        border: false
    });
    tb.add(
            Ext.create('Ext.Panel', {
                id: 'footer-'+panel.id,
                border: false,
                width: '100%',
                style: {
                    border: 'none',
                    height: '20px',
                    width: '100%'
                },
            html: '<div style="width:100%;height:2px;border:solid;border-color :#38610B;border-bottom-color:#868A08;"></div><div style="width:100%;height:60px;padding:10;margin:10px;"><div><p style="width:100%;height:60px;text-align:center;font-weight:bold;font-size:22px;"><b>' + titulo + '</b><br><b style="font-size:10px;">' + subtitulo + '</b><br><b style="font-size:10px;">' + transporte + '</b></p></div></div>',
                listeners: {
                    render: function (ct, position) {
                        this.setBorder(0);
                    }
                }
            })
            );
    panel.addDocked(tb);
}

function asignarinfo(grafica, datastore) {
    grafica.getStore().setData(datastore);
}

function ajustarEjeY(grafica, datastore){
    
    //Ajusta el eje Y Primario
    max = getHighest(datastore, "negocios");                                                                                        
    var axes = grafica.getAxes();
    var SampleValuesAxis =  axes[1];    
    SampleValuesAxis.setMaximum(max+1);
    if((max+1)<10){
        SampleValuesAxis.setMajorTickSteps(max+1);
    }else if(max%5==0){        
        SampleValuesAxis.setMajorTickSteps(5);
    }else{
        while (max%5!=0) {
            max++;
        }
        SampleValuesAxis.setMaximum(max);
        SampleValuesAxis.setMajorTickSteps(5);
    }            
}

function mostrardatos(filtro, param1, param2) {
    data = [];
    
    if (filtro != "embarque") {
        for (var i = 0; i < datos.length; i++) {

            if (filtro == "volumen") {
                if (datos[i]["mes"] == param1) {
                    data.push(datos[i]);
                }
            }
            if (filtro == "transito") {
                if (datos[i]["mes"] == param1 && datos[i]["cumplett"] == param2) {
                    data.push(datos[i]);
                }
            }

            if (filtro == "zarpe") {
                if (datos[i]["mes"] == param1 && datos[i]["cumplezarpe"] == param2) {
                    data.push(datos[i]);
                }
            }
            if (filtro == "llegada") {
                if (datos[i]["mes"] == param1 && datos[i]['cumplellegada'] == param2) {
                    data.push(datos[i]);
                }
            }
            if (filtro == "facturacion") {
                if (datos[i]["mes"] == param1 && datos[i]["cumplefacturacion"] == param2) {
                    data.push(datos[i]);
                }
            }
            if (filtro == "vaciado") {
                if (datos[i]['mes'] == param1 && datos[i]["cumplevaciado"] == param2 && datos[i]["modalidad"] == "LCL") {
                    data.push(datos[i]);
                }
            }
            if (filtro == "peso") {

                if (datos[i]['mes'] == param1) {
                    data.push(datos[i]);
                }
            }
            if(filtro == "factxorigen"){
                if (datos[i]['mes'] == param1 && datos[i]['traorigen'] == param2) {
                    data.push(datos[i]);
                }
            }
        }



    } else {
        for (var i = 0; i < datoscoor.length; i++) {
            if (datoscoor[i]["proveedor"] == param1 && datoscoor[i]["cumplecoor"] == param2) {
                data.push(datoscoor[i]);
            }
        }
    }

    winindicadores = Ext.create('Colsys.Indicadores.winIndicadores', {
        id: 'winIndicadores' + idform,
        datos: data,
        listeners: {
            destroy: function () {
                winindicadores = null;
            }
        }
    });
    //Ext.getCmp('gridindicadores1').columns[0].setVisible(false);
    Ext.getCmp('gridindicadores1').filtro = filtro;
    Ext.getCmp('gridindicadores1').ocultar(filtro);
    winindicadores.show();
}

function mostrardatosVolumen(param1, param2, param3, filtro, datos) {
    data = [];
    for (var i = 0; i < datos.length; i++) {
        if(datos[i]["modalidad"]== param3){
            if (datos[i]["mes"] == param1 && datos[i]["traorigen"] == param2) {
                data.push(datos[i]);
            }/*else if(datos[i]["mes"] == param1){
                data.push(datos[i]);
            }*/
            }
    }
    
    winindicadores = Ext.create('Colsys.Indicadores.winIndicadores', {
        id: 'winIndicadores' + idform,
        datos: data,
        listeners: {
            destroy: function () {
                winindicadores = null;
            }
        }
    });
    
    Ext.getCmp('gridindicadores1').filtro = filtro;
    Ext.getCmp('gridindicadores1').ocultar(filtro);
    winindicadores.show();
    
    /*winindicadoresVolumen = Ext.create('Ext.window.Window', {
        autoScroll: true,
        width: '98%',
        autoHeight: true,
        closeAction: 'destroy',
        id: 'winIndicadoresVolumen' + idform,
        listeners: {
            beforerender: function(ct, position){
                this.add({
                xtype: 'Colsys.Indicadores.GridIndicadores',
                    id: 'gridindicadores11',
                autoHeight: true,
                maxHeight: 500,
                listeners: {
                    beforerender: function (ct, position) {
                        this.setStore(
                                Ext.create('Ext.data.Store', {
                                    fields: [
                                        {name: 'anio', type: 'string'},
                                        {name: 'mes', type: 'string'},
                                        {name: 'reporte', type: 'string'},
                                        {name: 'doctransporte', type: 'string'},
                                        {name: 'orden', type: 'string'},
                                        {name: 'traorigen', type: 'string'},
                                        {name: 'destino'},
                                        {name: 'proveedor'},
                                        {name: 'modalidad'},
                                        {name: 'piezas'},
                                        {name: 'peso'},
                                        {name: 'volumen'},
                                        {name: 'fch_salida'},
                                        {name: 'fch_llegada'},
                                        {name: 'fch_zarpe'},
                                        {name: 'fch_disponible'},
                                        {name: 'fch_vaciado'},
                                        {name: 'fch_factura'},
                                        {name: 'metacoord'},
                                        {name: 'metazarpe'},
                                        {name: 'metallegada'},
                                        {name: 'metavaciado'},
                                        {name: 'metafacturacion'},
                                            {name: 'idgzarpe'},
                                            {name: 'idgllegada'},
                                            {name: 'idgfacturacion'},
                                            {name: 'idgvaciado'},
                                            {name: 'idgtiempotransito'},
                                            {name: 'idgcoorembarque'},
                                            {name: 'obscord'},
                                            {name: 'obszarpe'},
                                            {name: 'obsllegada'},
                                            {name: 'obsfactura'},
                                            {name: 'obstt'},
                                            {name: 'obsdesconsolidacion'}
                                    ], data: data
                                }));
                    }
                }
            });
            },
            show: function () {
               //Ext.getCmp("gridindicadores11").getStore().setData(data);
               Ext.getCmp('gridindicadores11').ocultar(filtro);
            },
            destroy: function () {
                winindicadoresVolumen = null;
            } 
        },
        style: {
            borderRadius: '15px'
        }
    });

    //Ext.getCmp('gridindicadores11').ocultar(filtro);
    winindicadoresVolumen.show();*/
}

function mostrardatosMes(filtro, param1) {
    data = [];
    
    if(filtro == "vaciado"){
        for (var i = 0; i < datos.length; i++) {
            if(datos[i]["modalidad"]=="LCL"){
                if (datos[i]["mes"] == param1) {
                    data.push(datos[i]);
                }
            }
        }
    }else if (filtro != "embarque") {
        for (var i = 0; i < datos.length; i++) {

            if (datos[i]["mes"] == param1) {
                data.push(datos[i]);
            }

        }
    } else {
        for (var i = 0; i < datoscoor.length; i++) {
            if (datoscoor[i]["proveedor"] == param1) {
                data.push(datoscoor[i]);
            }
        }
    }

    winindicadores = Ext.create('Colsys.Indicadores.winIndicadores', {
        id: 'winIndicadores' + idform,
        datos: data,
        listeners: {
            destroy: function () {
                winindicadores = null;
            }
        }
    });
    Ext.getCmp('gridindicadores1').filtro = filtro;
    Ext.getCmp('gridindicadores1').ocultar(filtro);
    winindicadores.show();
}

function mostrardatostraficomes(filtro, param1, pais, idform, datos) {
    data = [];    

    if(winindicadores == null){
        for (var i = 0; i < datos.length; i++) {
            if (datos[i]["mes"] == param1 && datos[i]["traorigen"] == pais) {
                data.push(datos[i]);
            }
        }

        winindicadores = Ext.create('Colsys.Indicadores.winIndicadores', {
            id: 'winIndicadores' + idform,        
            datos: data,
            listeners: {
                destroy: function () {
                    winindicadores = null;
                }
            }
        });
        Ext.getCmp('gridindicadores1').filtro = filtro;    
        Ext.getCmp('gridindicadores1').ocultar(filtro);
        winindicadores.show();
    }
    
}
