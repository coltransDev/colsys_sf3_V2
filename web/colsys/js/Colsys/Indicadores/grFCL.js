/*Ext.define('Colsys.Indicadores.grFCL', {
    extend: 'Colsys.Chart.dobleAxis',
    plugins: {
        ptype: 'chartitemevents',
        moveEvents: true
    },
    listeners: {
        beforerender: function (ct, position) {

            pref = this.pref;
            filtro = this.filtro;
            store = Ext.create('Ext.data.Store', {
                proxy: {
                    url: pref + '/widgets5/datosGraficasIndicadores',
                    type: 'ajax',
                    autoLoad: false,
                    reader: {
                        root: 'root',
                        totalProperty: 'totalCount',
                        type: 'json'
                    },
                    extraParams: {
                        filtro: filtro
                    }
                }
            });
            this.setStore(store);
        },
        afterrender: function (ct, position) {
            //alert("HOLA");
            gr1FCL = Ext.getCmp('grafica1FCL' + indice + idform);
            indice = this.indice;
            //console.log(indice);
            idform = this.idform;
            res = this.res;
            subtitulo = this.subtitulo;
            transporte = this.transporte;

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
                                        /* for(a = 1; a<= indice ; a++){
                                         console.log(Ext.getCmp('w1' + a + idform));
                                         }*/
                                        //console.log(this.up().indice);
                                       /*indi = this.up('menu').up('button').up('toolbar').up().indice;
                                        res = this.up('menu').up('button').up('toolbar').up().res;
                                        idfor = this.up('menu').up('button').up('toolbar').up().idform;
                                        
                                        Ext.create('Colsys.Indicadores.winVolumenFCL', {
                                            id: 'w1FCL' + indi + idfor,
                                            indice: indi,
                                            idform: idfor,
                                            res: res,
                                            closeAction: 'destroy'
                                        });
                                      

                                        Ext.create('Ext.fx.Anim', {
                                            target: Ext.getCmp('w1FCL' + indi + idfor),
                                            duration: 1000,
                                            from: {
                                                width: 0,
                                                opacity: 0,
                                                height: 0,
                                                left: 0
                                            },
                                            to: {
                                                width: 250,
                                               // height:  (Ext.getCmp('gridvolumen' + indi + idfor).getHeight() + 50)
                                            }
                                        });
                                        if (res[indi]) {
                                            //Ext.getCmp('gridvolumen' + this.indice + idform).getStore().setData(res[this.indice].gridvolumen);
                                            Ext.getCmp('w1FCL' + indi + idfor).show();
                                        }


                                    }
                                },
                                {
                                    //xtype: 'button',
                                    text: 'Descargar Imagen',
                                    iconCls: 'page_save',
                                    handler: function (btn, e, eOpts) {
                                        gr1FCL.downloadCanvas('Volumen x Tr\u00E1fico', subtitulo, transporte);
                                    }
                                },
                                {
                                    // xtype: 'button',
                                    text: 'Vista Previa',
                                    iconCls: 'photo_img',
                                    handler: function (btn, e, eOpts) {
                                        gr1FCL.previewIndicadores('Volumen x Tr&aacute;fico', subtitulo, transporte);
                                    }
                                }
                            ]
                        }
                    }

            );
            this.addDocked(tb);
        }
    },
    asignarAxes: function (gr1FCL, indice, idform, dato) {
        gr1FCL.setAxes([{
                type: 'numeric3d',
                position: 'left',
                grid: true,
                id: 'g1-axesl' + indice + idform,
                title: {
                    text: 'Volume',
                    fontSize: 15
                },
                fields: dato
            }, {
                type: 'category3d',
                position: 'bottom',
                title: {
                    text: 'Month',
                    fontSize: 15
                },
                fields: 'name'
            }]);
    },
    asignarSeries: function (gr1FCL, dato) {
        gr1FCL.addSeries({
            type: 'bar3d',
            xField: 'name',
            yField: dato,
            stacked: false,
            axis: 'left',
            width: 140,
            style: {
                maxBarWidth: 200,
                minBarWidth: 8
            },
            label: {
                font: '8px Helvetica',
                field: dato,
                display: 'insideEnd',
                renderer: function (value) {
                    return value;
                }
            },
            tooltip: {
                trackMouse: true,
                width: 140,
                height: 28,
                renderer: function (toolTip, record, ctx, index, store) {

                    if (record.get(ctx.field)) {
                        toolTip.setHtml(ctx.field + ": " + parseFloat(record.get(ctx.field)).toFixed(0));
                    } else {
                        toolTip.setHtml(ctx.field + ": 0");
                    }
                    //ctx.fill = colors[index % colors.length];

                    return ctx;
                }
            },
            listeners: {
                itemdblclick: function (series, item, event, eOpts) {
                    mostrardatosvolumen(item.record.data.name, item.field);
                }
            }

        });
    }
});*/


