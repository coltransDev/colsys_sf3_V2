
/**
 * @autor Felipe Nariño 
 * @return Indicadores Tracking
 * @date:  2016-04-21
 */
indice = 0;
colors = ['blue', 'yellow', 'red', 'green', 'gray'];
res = [];

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
                                    //value: '2015-01-01',
                                    submitFormat: 'Y-m-d',
                                    columnWidth: 0.45
                                },
                                {
                                    xtype: 'datefield',
                                    fieldLabel: 'Fecha Fin',
                                    name: 'fecha_fin',
                                    allowBlank: false,
                                    // value: '2015-12-31',
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
                                            //title: "Grafica " + indice,
                                            title: subtitulo,
                                            id: 'tabgraficas' + indice + idform,
                                            itemId: 'tabgraficas' + indice + idform,
                                            class: 'tabgraficas' + indice + idform,
                                            autoDestroy: false,
                                            closable: true,
                                            listeners: {
                                                close: function (tab, eOpts) {

                                                    this.items.each(function (childItem) {
                                                        this.remove(childItem);
                                                    }, this);
                                                }
                                            },
                                            items: [
                                                Ext.create('Ext.form.Panel', {
                                                    bodyPadding: 10,
                                                    id: 'panel' + indice + idform,
                                                    listeners: {
                                                        beforerender: function (ct, position) {
                                                            pref = Ext.getCmp(idform).prefijo;
                                                            filtro = Ext.getCmp(idform).getForm().getValues();
                                                            filtro = JSON.stringify(filtro);
                                                            tab = this;
                                                            this.add(
                                                                ///////////////////////////////////
                                                                Ext.create('Ext.panel.Panel', {
                                                                    id: 'grafica3' + indice + idform + "-panel",
                                                                    style: {
                                                                        border: 'solid',
                                                                        borderColor: '#157FCC',
                                                                        borderRadius: '10px',
                                                                        padding: '20px',
                                                                        borderWidth: '2px',
                                                                        boxShadow: '5px 5px 5px #888888',
                                                                        margin: '2%',
                                                                        marginBottom: '6%'
                                                                    },
                                                                    listeners: {
                                                                        afterrender: function (ct, position) {
                                                                            $('#grafica3' + indice + idform + "-panel div").css({border: 'none'});
                                                                        },
                                                                        render: function (ct, position) {
                                                                            this.add({
                                                                                xtype: 'Colsys.Indicadores.grZarpe',
                                                                                id: 'grafica3' + indice + idform,
                                                                                name: 'grafica3' + indice,
                                                                                class: 'grafica',
                                                                                filtro: filtro,
                                                                                pref: pref,
                                                                                indice: indice,
                                                                                idform: idform,
                                                                                res: res,
                                                                                subtitulo: subtitulo,
                                                                                transporte: transporte
                                                                            });
                                                                            if (transporte == "Mar\u00EDtimo") {
                                                                                agregarFooter(this, 'Oportunidad en el Zarpe', subtitulo, transporte);
                                                                            }
                                                                            if (transporte == "A\u00E9reo") {
                                                                                agregarFooter(this, 'Oportunidad en la Salida', subtitulo, transporte);
                                                                            }
                                                                        }
                                                                    }
                                                                }),
                                                                ////////////////////////////////////////////////////////////////////
                                                                Ext.create('Ext.panel.Panel', {
                                                                    id: 'grafica4' + indice + idform + "-panel",
                                                                    style: {
                                                                        border: 'solid',
                                                                        borderColor: '#157FCC',
                                                                        borderRadius: '10px',
                                                                        padding: '20px',
                                                                        borderWidth: '2px',
                                                                        boxShadow: '5px 5px 5px #888888',
                                                                        margin: '2%',
                                                                        marginBottom: '6%'
                                                                    },
                                                                    listeners: {
                                                                        afterrender: function (ct, position) {
                                                                            $('#grafica4' + indice + idform + "-panel div").css({border: 'none'});
                                                                        },
                                                                        render: function (ct, position) {
                                                                            this.add({
                                                                                xtype: 'Colsys.Indicadores.grLlegada',
                                                                                id: 'grafica4' + indice + idform,
                                                                                name: 'grafica4' + indice,
                                                                                class: 'grafica',
                                                                                filtro: filtro,
                                                                                pref: pref,
                                                                                indice: indice,
                                                                                idform: idform,
                                                                                res: res,
                                                                                subtitulo: subtitulo,
                                                                                transporte: transporte

                                                                            });
                                                                            agregarFooter(this, 'Oportunidad en la Llegada', subtitulo, transporte);
                                                                        }
                                                                    }
                                                                }),
                                                                ///////////////////////////////////////////////////////////////////////////////////
                                                                Ext.create('Ext.panel.Panel', {
                                                                    id: 'grafica5' + indice + idform + "-panel",
                                                                    style: {
                                                                        border: 'solid',
                                                                        borderColor: '#157FCC',
                                                                        borderRadius: '10px',
                                                                        padding: '20px',
                                                                        borderWidth: '2px',
                                                                        boxShadow: '5px 5px 5px #888888',
                                                                        margin: '2%',
                                                                        marginBottom: '6%'
                                                                    },
                                                                    listeners: {
                                                                        afterrender: function (ct, position) {
                                                                            $('#grafica5' + indice + idform + "-panel div").css({border: 'none'});
                                                                        },
                                                                        render: function (ct, position) {
                                                                            this.add({
                                                                                xtype: 'Colsys.Indicadores.grFacturacion',
                                                                                id: 'grafica5' + indice + idform,
                                                                                name: 'grafica5' + indice,
                                                                                class: 'grafica',
                                                                                filtro: filtro,
                                                                                pref: pref,
                                                                                indice: indice,
                                                                                idform: idform,
                                                                                res: res,
                                                                                subtitulo: subtitulo,
                                                                                transporte: transporte
                                                                            }
                                                                            );
                                                                            agregarFooter(this, 'Oportunidad en la Facturaci&oacute;n', subtitulo, transporte);
                                                                        }
                                                                    }
                                                                }),
                                                                ////////////////////////////////////////////////////////////////////////
                                                                Ext.create('Ext.panel.Panel', {
                                                                    id: 'grafica6' + indice + idform + "-panel",
                                                                    style: {
                                                                        border: 'solid',
                                                                        borderColor: '#157FCC',
                                                                        borderRadius: '10px',
                                                                        padding: '20px',
                                                                        borderWidth: '2px',
                                                                        boxShadow: '5px 5px 5px #888888',
                                                                        margin: '2%',
                                                                        marginBottom: '6%'
                                                                    },
                                                                    listeners: {
                                                                        afterrender: function (ct, position) {
                                                                            $('#grafica6' + indice + idform + "-panel div").css({border: 'none'});
                                                                        },
                                                                        render: function (ct, position) {
                                                                            this.add({
                                                                                xtype: 'Colsys.Indicadores.grVaciado',
                                                                                id: 'grafica6' + indice + idform,
                                                                                name: 'grafica6' + indice,
                                                                                class: 'grafica',
                                                                                filtro: filtro,
                                                                                pref: pref,
                                                                                indice: indice,
                                                                                idform: idform,
                                                                                res: res,
                                                                                subtitulo: subtitulo,
                                                                                transporte: transporte
                                                                            });
                                                                            tb = new Ext.toolbar.Toolbar({
                                                                                dock: 'bottom',
                                                                                border: false
                                                                            });
                                                                            agregarFooter(this, 'Oportunidad en la Desconsolidaci\u00F3n', subtitulo, transporte);
                                                                        }
                                                                    }
                                                                }),
                                                                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                                            
                                                                Ext.create('Ext.panel.Panel', {
                                                                    id: 'grafica8' + indice + idform + "-panel",
                                                                    style: {
                                                                        border: 'solid',
                                                                        borderColor: '#157FCC',
                                                                        borderRadius: '10px',
                                                                        padding: '20px',
                                                                        borderWidth: '2px',
                                                                        boxShadow: '5px 5px 5px #888888',
                                                                        margin: '2%',
                                                                        marginBottom: '6%'
                                                                    },
                                                                    listeners: {
                                                                        afterrender: function (ct, position) {
                                                                            $('#grafica8' + indice + idform + "-panel div").css({border: 'none'});
                                                                        },
                                                                        render: function (ct, position) {
                                                                            this.add({
                                                                                xtype: 'Colsys.Indicadores.grEmbarque',
                                                                                id: 'grafica8' + indice + idform,
                                                                                name: 'grafica8' + indice,
                                                                                class: 'grafica',
                                                                                filtro: filtro,
                                                                                pref: pref,
                                                                                indice: indice,
                                                                                idform: idform,
                                                                                res: res,
                                                                                subtitulo: subtitulo,
                                                                                transporte: transporte
                                                                            }
                                                                            );
                                                                            tb = new Ext.toolbar.Toolbar({
                                                                                dock: 'bottom',
                                                                                border: false
                                                                            });
                                                                            agregarFooter(this, 'Coordinacion de Embarque', subtitulo, transporte);
                                                                        }
                                                                    }
                                                                })
                                                                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                                            );
                                                            b = $('.tabgraficas' + indice + idform);
                                                            a = $("<div></div>").text("AAAAAAAAA");
                                                            a.appendTo(b);
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
                                                                    if (resp.success){
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
                                                                                Ext.create('Ext.panel.Panel', {
                                                                                    id: 'grafica2' + indice + idform + "-panel",
                                                                                    style: {
                                                                                        border: 'solid',
                                                                                        borderColor: '#157FCC',
                                                                                        borderRadius: '10px',
                                                                                        padding: '20px',
                                                                                        borderWidth: '2px',
                                                                                        boxShadow: '5px 5px 5px #888888',
                                                                                        margin: '2%',
                                                                                        marginBottom: '6%'
                                                                                    },
                                                                                    listeners: {
                                                                                        afterrender: function (ct, position) {
                                                                                            $('#grafica2' + indice + idform + "-panel div").css({border: 'none'});
                                                                                        },
                                                                                        render: function (ct, position) {
                                                                                            this.add(
                                                                                                // Tiempo de tránsito
                                                                                                Ext.create('Colsys.Chart.dobleAxis', { 
                                                                                                    plugins: {
                                                                                                        ptype: 'chartitemevents',
                                                                                                        moveEvents: true
                                                                                                    },
                                                                                                    id: 'grafica2' + indice + idform,
                                                                                                    name: 'grafica2',
                                                                                                    axes: [{
                                                                                                        type: 'numeric',
                                                                                                        position: 'right',
                                                                                                        //minimum: 0,
                                                                                                        //grid: true,
                                                                                                        minimum: 0,
                                                                                                        maximum: 120,
                                                                                                        title: {
                                                                                                            text: '% De Cumplimiento',
                                                                                                            fontSize: 15
                                                                                                        },
                                                                                                        //adjustByMajorUnit: true,
                                                                                                        fields: 'porcentaje'
                                                                                                    }, {
                                                                                                        id: 'g2-axesl' + indice + idform,
                                                                                                        type: 'numeric3d',
                                                                                                        position: 'left',
                                                                                                        adjustByMajorUnit: false,
                                                                                                        minimum: 0,
                                                                                                        grid: true,
                                                                                                        increment: 1,
                                                                                                        title: {
                                                                                                            text: 'Negocios',
                                                                                                            fontSize: 15
                                                                                                        },
                                                                                                        //fields: [resp.paises]
                                                                                                        fields: res[indice].y
                                                                                                    }, {
                                                                                                        type: 'category3d',
                                                                                                        position: 'bottom',
                                                                                                        grid: true,
                                                                                                        title: {
                                                                                                            text: 'Mes',
                                                                                                            fontSize: 15
                                                                                                        },
                                                                                                        fields: 'name'
                                                                                                    }],
                                                                                                    tooltip: {
                                                                                                        trackMouse: true,
                                                                                                        width: 140,
                                                                                                        height: 28,
                                                                                                        renderer: function (toolTip, record, ctx) {
                                                                                                            if (record.get(ctx.field)) {
                                                                                                                toolTip.setHtml(ctx.field + ": " + parseFloat(record.get(ctx.field)).toFixed(0));
                                                                                                            } else {
                                                                                                                toolTip.setHtml(ctx.field + ": 0");
                                                                                                            }
                                                                                                        }
                                                                                                    },
                                                                                                    listeners: {
                                                                                                        afterrender: function (ct, position) {
                                                                                                            gr2 = Ext.getCmp('grafica2' + indice + idform);
                                                                                                            tb = new Ext.toolbar.Toolbar({
                                                                                                                style: {
                                                                                                                    border: 'none'
                                                                                                                }
                                                                                                            });
                                                                                                            tb.add({
                                                                                                                xtype: "panel",
                                                                                                                width: '80%',
                                                                                                                html: '<img style="float:left;margin-left:5%;" src="../../images/coltrans_logo.png"></img>',
                                                                                                                border: false
                                                                                                            },
                                                                                                            '->',
                                                                                                            {
                                                                                                                xtype: 'button',
                                                                                                                border: false,
                                                                                                                iconCls: 'menu_responsive',
                                                                                                                arrowVisible: false,
                                                                                                                menu: {
                                                                                                                    items: [{
                                                                                                                        text: 'Detalles',
                                                                                                                        border: false,
                                                                                                                        iconCls: 'zoom_img',
                                                                                                                        class: 'ven1',
                                                                                                                        indice: indice,
                                                                                                                        handler: function () {
                                                                                                                            Ext.create('Colsys.Indicadores.winTransito', {
                                                                                                                                id: 'w2' + this.indice + idform,
                                                                                                                                indice: this.indice,
                                                                                                                                idform: idform,
                                                                                                                                res: res
                                                                                                                            });

                                                                                                                            Ext.create('Ext.fx.Anim', {
                                                                                                                                target: Ext.getCmp('w2' + this.indice + idform),
                                                                                                                                duration: 1000,
                                                                                                                                from: {
                                                                                                                                    width: 0,
                                                                                                                                    opacity: 0,
                                                                                                                                    height: 0,
                                                                                                                                    left: 0
                                                                                                                                },
                                                                                                                                to: {
                                                                                                                                    width: 300,
                                                                                                                                }
                                                                                                                            });
                                                                                                                            if (res[this.indice]) {
                                                                                                                                Ext.getCmp('w2' + this.indice + idform).show();
                                                                                                                            }
                                                                                                                        }
                                                                                                                    },
                                                                                                                    {
                                                                                                                        text: 'Descargar Imagen',
                                                                                                                        iconCls: 'page_save',
                                                                                                                        handler: function (btn, e, eOpts) {
                                                                                                                            gr2.downloadCanvas('Tiempo de Transito', subtitulo, transporte);
                                                                                                                        }
                                                                                                                    },
                                                                                                                    {
                                                                                                                        text: 'Vista Previa',
                                                                                                                        iconCls: 'photo_img',
                                                                                                                        handler: function (btn, e, eOpts) {
                                                                                                                            gr2.previewIndicadores('Tiempo de Transito', subtitulo, transporte);
                                                                                                                        }
                                                                                                                    },
                                                                                                                    {
                                                                                                                        text: 'Informe del Periodo',
                                                                                                                        iconCls: 'csv',
                                                                                                                        handler: function (btn, e, eOpts) {
                                                                                                                            indi = indice;                                                                                                                        
                                                                                                                            idfor = idform;

                                                                                                                            filtro = "transito";
                                                                                                                            var data = res[indi].datosgrid;
                                                                                                                            winindicadores = Ext.create('Colsys.Indicadores.winIndicadores', {
                                                                                                                                id: 'winIndicadores' + idfor+indi,
                                                                                                                                datos: data,
                                                                                                                                listeners: {
                                                                                                                                    destroy: function () {
                                                                                                                                        winindicadores = null;
                                                                                                                                    }
                                                                                                                                }
                                                                                                                            }).show();                                        
                                                                                                                            Ext.getCmp('gridindicadores1').ocultar(filtro);
                                                                                                                            winindicadores.show();
                                                                                                                        }
                                                                                                                    }]
                                                                                                                }
                                                                                                            });
                                                                                                            this.addDocked(tb);
                                                                                                        }
                                                                                                    }
                                                                                                })
                                                                                            );
                                                                                            agregarFooter(this, 'Tiempo de Transito', subtitulo, transporte);
                                                                                        }
                                                                                    }
                                                                                }),
                                                                                //Volumen LCL
                                                                                Ext.create('Ext.panel.Panel', {
                                                                                    id: 'grafica1' + indice + idform + "-panel",
                                                                                    style: {
                                                                                        border: 'solid',
                                                                                        borderColor: '#157FCC',
                                                                                        borderRadius: '10px',
                                                                                        padding: '20px',
                                                                                        borderWidth: '2px',
                                                                                        boxShadow: '5px 5px 5px #888888',
                                                                                        margin: '2%',
                                                                                        marginBottom: '6%'
                                                                                    },
                                                                                    listeners: {
                                                                                        afterrender: function (ct, position) {
                                                                                            $('#grafica1' + indice + idform + "-panel div").css({border: 'none'});
                                                                                        },
                                                                                        render: function (ct, position) {
                                                                                            this.add({
                                                                                                xtype: 'Colsys.Indicadores.grVolumen',
                                                                                                id: 'grafica1' + indice + idform,
                                                                                                name: 'grafica1',
                                                                                                class: 'grafica',
                                                                                                filtro: filtro,
                                                                                                pref: pref,
                                                                                                tipo: 'LCL',
                                                                                                indice: indice,
                                                                                                idform: idform,
                                                                                                res: res,
                                                                                                subtitulo: subtitulo,
                                                                                                transporte: transporte
                                                                                            });
                                                                                            agregarFooter(this, 'Volumen x Tr&aacute;fico LCL', subtitulo, transporte);
                                                                                        }
                                                                                    }
                                                                                }),
                                                                                //Volumen FCL
                                                                                Ext.create('Ext.panel.Panel', {
                                                                                    id: 'grafica1FCL' + indice + idform + "-panel",
                                                                                    style: {
                                                                                        border: 'solid',
                                                                                        borderColor: '#157FCC',
                                                                                        borderRadius: '10px',
                                                                                        padding: '20px',
                                                                                        borderWidth: '2px',
                                                                                        boxShadow: '5px 5px 5px #888888',
                                                                                        margin: '2%',
                                                                                        marginBottom: '6%'
                                                                                    },
                                                                                    listeners: {
                                                                                        afterrender: function (ct, position) {
                                                                                            $('#grafica1FCL' + indice + idform + "-panel div").css({border: 'none'});
                                                                                        },
                                                                                        render: function (ct, position) {
                                                                                            this.add({
                                                                                                xtype: 'Colsys.Indicadores.grVolumen',
                                                                                                id: 'grafica1FCL' + indice + idform,
                                                                                                name: 'grafica1FCL',
                                                                                                class: 'grafica',
                                                                                                filtro: filtro,
                                                                                                pref: pref,
                                                                                                tipo: 'FCL',
                                                                                                indice: indice,
                                                                                                idform: idform,
                                                                                                res: res,
                                                                                                subtitulo: subtitulo,
                                                                                                transporte: transporte
                                                                                            });
                                                                                            agregarFooter(this, 'Volumen x Tr&aacute;fico FCL', subtitulo, transporte);
                                                                                        }
                                                                                    }
                                                                                }),
                                                                                //Peso
                                                                                Ext.create('Ext.panel.Panel', {
                                                                                    id: 'grafica7' + indice + idform + "-panel",
                                                                                    style: {
                                                                                        border: 'solid',
                                                                                        borderColor: '#157FCC',
                                                                                        borderRadius: '10px',
                                                                                        padding: '20px',
                                                                                        borderWidth: '2px',
                                                                                        boxShadow: '5px 5px 5px #888888',
                                                                                        margin: '2%',
                                                                                        marginBottom: '6%'
                                                                                    },
                                                                                    listeners: {
                                                                                        afterrender: function (ct, position) {
                                                                                            $('#grafica7' + indice + idform + "-panel div").css({border: 'none'});
                                                                                        },
                                                                                        render: function (ct, position) {
                                                                                            this.add({
                                                                                                xtype: 'Colsys.Indicadores.grPeso',
                                                                                                id: 'grafica7' + indice + idform,
                                                                                                name: 'grafica7' + indice,
                                                                                                class: 'grafica',
                                                                                                filtro: filtro,
                                                                                                pref: pref,
                                                                                                indice: indice,
                                                                                                idform: idform,
                                                                                                res: res,
                                                                                                subtitulo: subtitulo,
                                                                                                transporte: transporte
                                                                                            });
                                                                                            agregarFooter(this, 'Peso x Mes', subtitulo, transporte);
                                                                                        }
                                                                                    }
                                                                                })
                                                                            );
                                                                    
                                                                            //Oculta la gráfica de Volumen LCL y Desconsolidación cuándo no hay negocios LCL                                                                            
                                                                            if(jQuery.isEmptyObject(res[indice].gridvolumen)){
                                                                                $('#grafica1' + indice + idform + "-panel").hide();
                                                                                $('#grafica6' + indice + idform + "-panel").hide();
                                                                            }
                                                                            
                                                                            //Oculta la gráfica cuándo no hay negocios FCL
                                                                            if(jQuery.isEmptyObject(res[indice].gridvolumenFCL)){
                                                                                $('#grafica1FCL' + indice + idform + "-panel").hide();
                                                                            }
                                                                            
                                                                            //Oculta la gráfica cuándo no mide Coordinación de Embarque
                                                                            if(res[indice].clienteEmbarque==null){
                                                                                $('#grafica8' + indice + idform + "-panel").hide();
                                                                            }
                                                                            
                                                                            ///////////////////////////////////////////////////////////GRAFICA 1 ////////////////////////////////////////////////////////////////////////////
                                                                            asignarinfo(gr1, res[indice].root);
                                                                            gr1.asignarAxes(gr1, indice, idform, res[indice].y, "LCL");
                                                                            gr1.asignarSeries(gr1, res[indice].y, "LCL");

                                                                            asignarinfo(gr1FCL, res[indice].datosFCL);
                                                                            gr1FCL.asignarAxes(gr1FCL, indice, idform, res[indice].y, "FCL");
                                                                            gr1FCL.asignarSeries(gr1FCL, res[indice].y, "FCL", idform, indice);

                                                                            ///////////////////////////////////////////////////////////GRAFICA 2 ////////////////////////////////////////////////////////////////////////////
                                                                            asignarinfo(gr3, res[indice].zarpe);
                                                                            gr3.asignarSeries(gr3);
                                                                            ajustarEjeY(gr3, res[indice].zarpe);
                                                                            ///////////////////////////////////////////////////////////////GRAFICA 4///////////////////////////////////////////////////////////////////////////                                            
                                                                            asignarinfo(gr4, res[indice].llegada);                                                                                        
                                                                            gr4.asignarSeries(gr4);
                                                                            ajustarEjeY(gr4, res[indice].llegada);
                                                                            ///////////////////////////////////////////////////////////////////GRAFICA 5 //////////////////////////////////////////////////////////////////////////
                                                                            asignarinfo(gr5, res[indice].facturacion);
                                                                            gr5.asignarSeries(gr5);
                                                                            ajustarEjeY(gr5, res[indice].facturacion);
                                                                            ///////////////////////////////////////////////////////////////GRAFICA 6 /////////////////////////////////////////////////////////////////////////////
                                                                            asignarinfo(gr8, res[indice].coordembarque);                                                                                        
                                                                            gr8.asignarSeries(gr8);                                                                                        
                                                                            ajustarEjeY(gr8, res[indice].coordembarque);
                                                                            ///////////////////////////////////////////////////////////////
                                                                            asignarinfo(gr6, res[indice].vaciado);
                                                                            gr6.asignarSeries(gr6);
                                                                            ajustarEjeY(gr6, res[indice].vaciado);
                                                                            ///////////////////////////////////////////////////////////////////GRAFICA 7 //////////////////////////////////////////////////////////////////////////
                                                                            //gr7.getStore().setData(res[indice].datospie);
                                                                            asignarinfo(gr7, res[indice].datospie);
                                                                            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                                           
                                                                            gr2.addSeries([{
                                                                                type: 'bar3d',
                                                                                style: {
                                                                                    maxBarWidth: 200,
                                                                                    minBarWidth: 8
                                                                                },
                                                                                axis: 'left',
                                                                                stacked: false,
                                                                                xField: 'name',
                                                                                yField: res[indice].y,
                                                                                tooltip: {
                                                                                    trackMouse: true,
                                                                                    width: 140,
                                                                                    height: 28,
                                                                                    renderer: function (toolTip, record, ctx) {
                                                                                        toolTip.setHtml(ctx.field + ': ' + record.get(ctx.field) + " Negocios");
                                                                                    }
                                                                                },
                                                                                listeners: {
                                                                                    itemdblclick: function (series, item, event, eOpts) {
                                                                                        mostrardatostraficomes("transito", item.record.data.name, item.field);
                                                                                    }
                                                                                }
                                                                            },
                                                                            {
                                                                                type: 'line',
                                                                                axis: 'right',
                                                                                xField: 'name',
                                                                                yField: ['porcentaje'],
                                                                                stacked: false,
                                                                                marker: true,
                                                                                label: {
                                                                                    field: ['porcentaje'],
                                                                                    display: 'over',
                                                                                    font: '10px Helvetica',
                                                                                    renderer: function (text, label, labelCfg, data, index) {
                                                                                        var record = data.store.getAt(index);
                                                                                        return record.get('porcentaje') + '%';
                                                                                    }
                                                                                },
                                                                                tooltip: {
                                                                                    trackMouse: true,
                                                                                    width: 140,
                                                                                    height: 28,
                                                                                    renderer: function (toolTip, record, ctx) {
                                                                                        toolTip.setHtml("<b>" + ctx.field + "</b>" + ': ' + record.get(ctx.field) + "%");
                                                                                    }
                                                                                }

                                                                            }]
                                                                        );
                                                                            str = Ext.create('Ext.data.Store', {
                                                                                id: 'strgr2' + indice + idform,
                                                                                model: Ext.create('Ext.data.Model', {
                                                                                    fields: [res[indice].modelgrafica2],
                                                                                    id: 'mdlgrf2' + indice + idform
                                                                                }),
                                                                                data: res[indice].grafica2
                                                                            });
                                                                            gr2.setStore(str);
                                                                            //ajustarEjeY(gr2, res[indice].grafica2);
                                                                            myMsg.close();    
                                                                        }
                                                                    });
                                                                    }
                                                                    else if(resp.errorInfo!=""){
                                                                            Ext.MessageBox.alert("Mensaje",'El Nit del cliente existe en nuestra base de datos');                                                                            
                                                                    }
                                                                }                                                                
                                                            });
                                                        }
                                                    }
                                                })]
                                        }).show();                                            
                                    }
                                    tabpanel.setActiveTab('tabgraficas' + indice + idform);                                        
                                } else {
                                    Ext.MessageBox.alert("Error", "Debe Ingresar Rango de Fechas");
                                }
                            }
                        }]
                    },{
                        xtype: 'tabpanel',
                        id: 'tab-panel-graficas' + idform + idform
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
    }).show();
    //Ext.getCmp('gridindicadores1').columns[0].setVisible(false);
    Ext.getCmp('gridindicadores1').filtro = filtro;
    Ext.getCmp('gridindicadores1').ocultar(filtro);
    winindicadores.show();
}

function mostrardatosVolumen(param1, param2, param3, filtro) {
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
    
    console.log(data);
    
    winindicadores = Ext.create('Colsys.Indicadores.winIndicadores', {
        id: 'winIndicadores' + idform,
        datos: data,
        listeners: {
            destroy: function () {
                winindicadores = null;
            }
        }
    }).show();
    
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
    console.log(datos);
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
    }).show();
    Ext.getCmp('gridindicadores1').filtro = filtro;
    Ext.getCmp('gridindicadores1').ocultar(filtro);
    winindicadores.show();
}

function mostrardatostraficomes(filtro, param1, pais) {
    data = [];

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
    }).show();
    Ext.getCmp('gridindicadores1').filtro = filtro;    
    Ext.getCmp('gridindicadores1').ocultar(filtro);
    winindicadores.show();
}