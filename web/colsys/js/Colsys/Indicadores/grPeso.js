Ext.define('Colsys.Indicadores.grPeso', {
    extend: 'Colsys.Chart.Pie3D',
    plugins: {
        ptype: 'chartitemevents',
        moveEvents: true
    },
//    insetPadding: '60 5 10 10',
//    style: {
//        paddingTop: '30px',
//        borderStyle: 'solid 1px #ccc',
//        //borderRadius: '10px',
//        margin: '2%',
//        marginBottom: '6%'
//    },
    store: {
        model: Ext.create('Ext.data.Model', {
            fields: [
                {name: 'mes', type: 'string'},
                {name: 'peso', type: 'float'}
            ]
        })
    },
    tooltip: {
        trackMouse: true,
        width: 140,
        height: 28,
        renderer: function (toolTip, record, ctx) {

            if (record.get(ctx.field)) {
                toolTip.setHtml(ctx.field + ": " + parseFloat(record.get(ctx.field)).toFixed(0)+" Kg");
            } else {
                toolTip.setHtml(ctx.field + ": 0 Kg");
            }
        }
    },
    listeners: {
        afterrender: function (ct, position) {
            var me = this;
            
            var indice = me.up().indice;
            var idform = me.up().idform;
            var idgrafica = me.up().idgrafica;            
            
            res = this.res;
            
            console.log("res");
            console.log(res);
            
            asignarinfo(me, res[indice].datospie);
            this.getStore().setData(res[indice].datospie);            
            
            tb =    Ext.create('Colsys.Indicadores.ToolbarGrafica',{
                id: 'toolbar-'+ idgrafica + indice + idform,
                indice: indice,
                idform: idform,
                ngrafica: me.up().ngrafica,
                subtitulo: me.up().subtitulo,
                transporte: me.up().transporte,                        
                filtro: me.filtro,
                res: me.res
            });
            this.addDocked(tb);            

            //gr7 = Ext.getCmp('grafica7' + indice + idform);
//            tb = new Ext.toolbar.Toolbar({
//                style: {
//                    border: 'none'
//                }
//            });
//            tb.add(
//                    {
//                        xtype: "panel",
//                        width: '60%',
//                        html: '<img style="float:left;margin-left:5%;" src="../../images/coltrans_logo.png"></img>',
//                        border: false
//                    },
//                    '->',
//                    {
//                        xtype: 'button',
//                        border: false,
//                        iconCls: 'menu_responsive',
//                        arrowVisible: false,
//                        menu: {
//                            items: [
//                                {
//                                    text: 'Detalles',
//                                    border: false,
//                                    iconCls: 'zoom_img',
//                                    class: 'ven1',
//                                    indice: indice,
//                                    handler: function () {
//                                        
//                                        indi = this.up('menu').up('button').up('toolbar').up().indice;
//                                        res = this.up('menu').up('button').up('toolbar').up().res;
//                                        idfor = this.up('menu').up('button').up('toolbar').up().idform;
//                                        
//                                        
//                                        Ext.create('Colsys.Indicadores.winPeso', {
//                                            id: 'w7' + indi + idform,
//                                            indice: indi,
//                                            idform: idform,
//                                            res: res
//                                        });
//                                        
//                                        Ext.create('Ext.fx.Anim', {
//                                            target: Ext.getCmp('w7' + indi + idform),
//                                            duration: 1000,
//                                            from: {
//                                                width: 0,
//                                                opacity: 0,
//                                                height: 0,
//                                                left: 0
//                                            },
//                                            to: {
//                                                width: 250,
//                                            }
//                                        });
//                                        if (res[indi]) {
//                                            Ext.getCmp('w7' + indi + idform).show();
//                                        }
//
//
//                                    }
//                                },
//                                {
//                                    text: 'Descargar Imagen',
//                                    iconCls: 'page_save',
//                                    handler: function (btn, e, eOpts) {
//                                        gr7.downloadCanvas('Peso x Mes', subtitulo, transporte);
//                                    }
//                                },
//                                {
//                                    text: 'Vista Previa',
//                                    iconCls: 'photo_img',
//                                    handler: function (btn, e, eOpts) {
//                                        gr7.previewIndicadores('Peso x Mes', subtitulo, transporte);
//                                    }
//                                }
//                            ]
//                        }
//                    }
//
//            );
//            this.addDocked(tb);
        }
    }
}
);
