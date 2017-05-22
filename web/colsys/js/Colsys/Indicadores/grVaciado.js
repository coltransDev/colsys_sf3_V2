Ext.define('Colsys.Indicadores.grVaciado', {
    extend: 'Colsys.Chart.dobleAxis',
     plugins: {
        ptype: 'chartitemevents',
        moveEvents: true
    },
    axes: [{
            type: 'numeric',
            position: 'right',
            id: 'g6-axesr' + indice + idform,
            minimum: 0,
            maximum: 120,
            //grid: true,
            title: {
                text: '% De Cumplimiento',
                fontSize: 15
            },
            //adjustByMajorUnit: true,
            fields: 'porcentaje'
        }, {
            type: 'numeric3d',
            id: 'g6-axesl' + indice + idform,
            adjustByMajorUnit: true,
            minimum: 0,
            grid: true,
            increment: 1,
            majorTickSteps : 5,    
            position: 'left',
            title: {
                text: 'Negocios',
                fontSize: 15
            },
            fields: 'negocios'
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
    store: {
        model: Ext.create('Ext.data.Model', {
            fields: [
                {name: 'name', type: 'string'},
                {name: 'porcentaje', type: 'float'},
                {name: 'negocios', type: 'integer'}
            ]
        })
    },
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
            indice = this.indice;
            idform = this.idform;
            res = this.res;
            subtitulo = this.subtitulo;
            transporte = this.transporte;

            gr6 = Ext.getCmp('grafica6' + indice + idform);
            tb = new Ext.toolbar.Toolbar({
                style: {
                    border: 'none'
                }
            });
            tb.add(
                    {
                        xtype: "panel",
                        width: '60%',
                        html: '<img style="float:left;margin-left:5%;" src="../../images/coltrans_logo.png"></img>',
                        border: false
                    },
                    '->',
                    {
                        xtype: 'button',
                        border: false,
                        //text: 'Exportar',
                        //tooltip: {text: 'This is a an example QuickTip for a toolbar item', title: 'Tip Title'},
                        iconCls: 'menu_responsive',
                        arrowVisible: false,
                        menu: {
                            items: [
                                {
                                    text: 'Detalles',
                                    border: false,
                                    iconCls: 'zoom_img',
                                    class: 'ven1',
                                    indice: indice,
                                    handler: function () {
                                        indi = this.up('menu').up('button').up('toolbar').up().indice;
                                        res = this.up('menu').up('button').up('toolbar').up().res;
                                        idfor = this.up('menu').up('button').up('toolbar').up().idform;

                                        Ext.create('Colsys.Indicadores.winVaciado', {
                                            id: 'w6' + indi + idfor,
                                            indice: indi,
                                            idform: idfor,
                                            res: res
                                        });
                                        
                                        Ext.create('Ext.fx.Anim', {
                                            target: Ext.getCmp('w6' + indi + idfor),
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
                                        if (res[indice]) {
                                            Ext.getCmp('w6' + indi + idfor).show();
                                        }
                                    }
                                },
                                {
                                    text: 'Descargar Imagen',
                                    iconCls: 'page_save',
                                    handler: function (btn, e, eOpts) {
                                        gr6.downloadCanvas('Oportunidad en el Vaciado', subtitulo, transporte);
                                    }
                                },
                                {
                                    text: 'Vista Previa',
                                    iconCls: 'photo_img',
                                    handler: function (btn, e, eOpts) {
                                        gr6.previewIndicadores('Oportunidad en el Vaciado', subtitulo, transporte);
                                    }
                                },
                                {
                                    text: 'Informe del Periodo',
                                    iconCls: 'csv',
                                    handler: function (btn, e, eOpts) {
                                        indi = this.up('menu').up('button').up('toolbar').up().indice;
                                        res = this.up('menu').up('button').up('toolbar').up().res;
                                        idfor = this.up('menu').up('button').up('toolbar').up().idform;
                                        
                                        filtro = "vaciado";
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
                                }
                            ]
                        }
                    }

            );
            this.addDocked(tb);
            tb = new Ext.toolbar.Toolbar({
                dock: 'bottom',
                border: false

            });

        }
    },
    asignarSeries: function (gr6) {
        gr6.addSeries([{
                type: 'bar3d',
                title: 'Negocios',
                axis: 'left',
                stacked: false,
                xField: ['name'],
                yField: ['negocios'],
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
                        mostrardatosMes("vaciado", item.record.data.name);
                    }
                }
            },
            
            {
                type: 'line',
                axis: 'right',
                title: '% de Cumplimiento',
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

            }]);
    }
}
);
