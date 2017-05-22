
/**
 * @autor Felipe Nariño 
 * @return Indicadores Tracking
 * @date:  2016-04-21
 */
indice = 0;
colors = ['blue', 'yellow', 'red', 'green', 'gray'];
res = [];
winIndicadoresOtm = null;

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

Ext.define('Colsys.Indicadores.FormFiltroOtm', {
    extend: 'Ext.form.Panel',
    alias: 'widget.wFormFiltroOtm',
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
                                                                    id: 'graficaOtm1' + indice + idform + "-panel",
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
                                                                            $('#graficaOtm1' + indice + idform + "-panel div").css({border: 'none'});
                                                                        },
                                                                        render: function (ct, position) {
                                                                            this.add({
                                                                                xtype: 'Colsys.Indicadores.grCargueOtm',
                                                                                id: 'graficaOtm1' + indice + idform,
                                                                                name: 'graficaOtm1' + indice,
                                                                                class: 'grafica',
                                                                                filtro: filtro,
                                                                                pref: pref,
                                                                                indice: indice,
                                                                                idform: idform,
                                                                                res: res,
                                                                                subtitulo: subtitulo,
                                                                                transporte: transporte
                                                                            });                                                                            
                                                                            agregarFooter(this, 'Oportunidad en el Cargue', subtitulo, "Otm");
                                                                        }
                                                                    }
                                                                }),
                                                                ////////////////////////////////////////////////////////////////////
                                                                Ext.create('Ext.panel.Panel', {
                                                                    id: 'graficaOtm2' + indice + idform + "-panel",
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
                                                                            $('#graficaOtm2' + indice + idform + "-panel div").css({border: 'none'});
                                                                        },
                                                                        render: function (ct, position) {
                                                                            this.add({
                                                                                xtype: 'Colsys.Indicadores.grLlegadaOtm',
                                                                                id: 'graficaOtm2' + indice + idform,
                                                                                name: 'graficaOtm2' + indice,
                                                                                class: 'grafica',
                                                                                filtro: filtro,
                                                                                pref: pref,
                                                                                indice: indice,
                                                                                idform: idform,
                                                                                res: res,
                                                                                subtitulo: subtitulo,
                                                                                transporte: transporte

                                                                            });
                                                                            agregarFooter(this, 'Oportunidad en la Llegada Otm', subtitulo, "Otm");
                                                                        }
                                                                    }
                                                                }),
                                                                ////////////////////////////////////////////////////////////////////
                                                                Ext.create('Ext.panel.Panel', {
                                                                    id: 'graficaOtm3' + indice + idform + "-panel",
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
                                                                            $('#graficaOtm3' + indice + idform + "-panel div").css({border: 'none'});
                                                                        },
                                                                        render: function (ct, position) {
                                                                            this.add({
                                                                                xtype: 'Colsys.Indicadores.grPresentacionOtm',
                                                                                id: 'graficaOtm3' + indice + idform,
                                                                                name: 'graficaOtm3' + indice,
                                                                                class: 'grafica',
                                                                                filtro: filtro,
                                                                                pref: pref,
                                                                                indice: indice,
                                                                                idform: idform,
                                                                                res: res,
                                                                                subtitulo: subtitulo,
                                                                                transporte: transporte

                                                                            });
                                                                            agregarFooter(this, 'Oportunidad en la Presentaci\u00F3n Otm', subtitulo, "Otm");
                                                                        }
                                                                    }
                                                                }),
                                                                ////////////////////////////////////////////////////////////////////
                                                                Ext.create('Ext.panel.Panel', {
                                                                    id: 'graficaOtm4' + indice + idform + "-panel",
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
                                                                            $('#graficaOtm4' + indice + idform + "-panel div").css({border: 'none'});
                                                                        },
                                                                        render: function (ct, position) {
                                                                            this.add({
                                                                                xtype: 'Colsys.Indicadores.grCierreOtm',
                                                                                id: 'graficaOtm4' + indice + idform,
                                                                                name: 'graficaOtm4' + indice,
                                                                                class: 'grafica',
                                                                                filtro: filtro,
                                                                                pref: pref,
                                                                                indice: indice,
                                                                                idform: idform,
                                                                                res: res,
                                                                                subtitulo: subtitulo,
                                                                                transporte: transporte

                                                                            });
                                                                            agregarFooter(this, 'Oportunidad en el Cierre', subtitulo, "Otm");
                                                                        }
                                                                    }
                                                                })
                                                            );
                                                            b = $('.tabgraficas' + indice + idform);
                                                            a = $("<div></div>").text("AAAAAAAAA");
                                                            a.appendTo(b);
                                                        },
                                                        afterrender: function (ct, position) {
                                                            Ext.Ajax.request({
                                                                url: pref + '/indicadoresAdu/paisesGraficasIndicadoresOtm',
                                                                params: {
                                                                    filtro: filtro,
                                                                    cliente: cli
                                                                },                                                                
                                                                success: function (response, options) {                                                                    
                                                                    var resp = Ext.decode(response.responseText);
                                                                    if (resp.success){
                                                                        Ext.Ajax.request({
                                                                            url: pref + '/indicadoresAdu/datosGraficasIndicadoresOtm',
                                                                            params: {
                                                                                filtro: filtro,
                                                                                cliente: cli
                                                                            },
                                                                            success: function (response, options) {
                                                                                res[indice] = Ext.decode(response.responseText);
                                                                                datos = res[indice].datosgrid;                                                                                        
                                                                                datoscoor = res[indice].griddatoscumplimiento;

                                                                                datosLcl = res[indice].gridvolumen;                                                                            
                                                                                asignarinfo(grOtm1, res[indice].cargue);

                                                                                grOtm1.asignarSeries(grOtm1);
                                                                                ajustarEjeY(grOtm1, res[indice].cargue);
                                                                                ///////////////////////////////////////////////////////////////GRAFICA 4///////////////////////////////////////////////////////////////////////////                                            
                                                                                asignarinfo(grOtm2, res[indice].llegadaotm);                                                                                        
                                                                                grOtm2.asignarSeries(grOtm2);
                                                                                ajustarEjeY(grOtm2, res[indice].llegadaotm);
                                                                                ///////////////////////////////////////////////////////////////GRAFICA 5///////////////////////////////////////////////////////////////////////////                                            
                                                                                asignarinfo(grOtm3, res[indice].presentacion);                                                                                        
                                                                                grOtm3.asignarSeries(grOtm3);
                                                                                ajustarEjeY(grOtm3, res[indice].presentacion);                                                                            
                                                                                ///////////////////////////////////////////////////////////////GRAFICA 5///////////////////////////////////////////////////////////////////////////                                            
                                                                                asignarinfo(grOtm4, res[indice].cierre);                                                                                        
                                                                                grOtm4.asignarSeries(grOtm4);
                                                                                ajustarEjeY(grOtm4, res[indice].cierre);
                                                                                ///////////////////////////////////////////////////////////////////GRAFICA 5 //////////////////////////////////////////////////////////////////////////

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
                                                })
                                            ]
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
            html: '<div style="width:100%;height:2px;border:solid;border-color :#38610B;border-bottom-color:#868A08;"></div><div style="width:100%;height:60px;padding:0;margin:10px;"><div><p style="width:100%;height:60px;text-align:center;font-weight:bold;font-size:22px;"><b>' + titulo + '</b><br><b style="font-size:10px;">' + subtitulo + '</b><br><b style="font-size:10px;">' + transporte + '</b></p></div></div>',
            listeners: {
                render: function (ct, position) {
                    this.setBorder(0);
                }
            }
        })
    );
    panel.addDocked(tb);
}

function mostrardatosMesOtm(filtro, param1) {
    data = [];         
    
    for (var i = 0; i < datos.length; i++) {
        if (datos[i]["mes"] == param1) {
            data.push(datos[i]);        
        }
    }
    
    if(winIndicadoresOtm==null){
        winIndicadoresOtm = Ext.create('Colsys.Indicadores.winIndicadoresOtm', {
            id: 'winIndicadoresOtm' + idform,
            datos: data,
            listeners: {
                close: function (win, eOpts) {
                    winIndicadoresOtm = null;                            
                },
                show: function(){
                    winIndicadoresOtm.superclass.show.apply(this, arguments);
                }
            }
        })
    }
    
    Ext.getCmp('gridindicadoresOtm').filtro = filtro;
    Ext.getCmp('gridindicadoresOtm').ocultar(filtro);
    winIndicadoresOtm.show();
}