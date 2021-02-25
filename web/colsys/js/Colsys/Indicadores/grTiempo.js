Ext.define('Colsys.Indicadores.grEmbarque', {
    extend: 'Colsys.Chart.dobleAxis',
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
            resp = this.resp;
            this.setAxes([{
                    type: 'numeric',
                    //id: 'g2-axesr',
                    position: 'right',
                    minimum: 0,
                    maximum: 120,
                    title: {
                        text: '% De Cumplimiento',
                        fontSize: 15
                    },
                    adjustByMajorUnit: true,
                    fields: 'porcentaje'
                }, {
                    id: 'g2-axesl' + indice + idform,
                    type: 'numeric3d',
                    position: 'left',
                    title: {
                        text: 'Negocios',
                        fontSize: 15
                    },
                    fields: [resp.paises]
                }, {
                    type: 'category3d',
                    position: 'bottom',
                    title: {
                        text: 'Mes',
                        fontSize: 15
                    },
                    fields: 'name'
                }]);
            gr2 = Ext.getCmp('grafica2' + indice + idform);
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

                                        Ext.create('Ext.fx.Anim', {
                                            target: Ext.getCmp('w2' + indice + idform),
                                            duration: 1000,
                                            from: {
                                                width: 0,
                                                opacity: 0,
                                                height: 0,
                                                left: 0
                                            },
                                            to: {
                                                width: 250,
                                                height: 400
                                            }
                                        });
                                        if (res[indice]) {
                                            Ext.getCmp('w2' + indice + idform).show();
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
                                        indi = this.up('menu').up('button').up('toolbar').up().indice;
                                        res = this.up('menu').up('button').up('toolbar').up().res;
                                        idfor = this.up('menu').up('button').up('toolbar').up().idform;
                                        
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
                                }
                            ]
                        }
                    }

            );
            this.addDocked(tb);
        }
    }
}
);


