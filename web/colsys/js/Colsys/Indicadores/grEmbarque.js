Ext.define('Colsys.Indicadores.grEmbarque', {
    extend: 'Colsys.Chart.dobleAxis',
     plugins: {
        ptype: 'chartitemevents',
        moveEvents: true
    },
      interactions: 'crosszoom',
    axes: [{
            type: 'numeric',
            position: 'right',
            //grid: true,
            id: 'g8-axesr' + indice + idform,
            minimum: 0,
            maximum: 120,
            title: {
                text: '% De Cumplimiento',
                fontSize: 15
            },
            //adjustByMajorUnit: true,
            fields: 'porcentaje'
                    //renderer: 'onAxisLabelRender'

        }, {
            type: 'numeric',
            id: 'g8-axesl' + indice + idform,
            adjustByMajorUnit: false,
            minimum: 0,
            grid: true,
            increment: 1,
            //majorTickSteps : 5,    
            position: 'left',
            title: {
                text: 'Negocios',
                fontSize: 15
            },
            /*style: {
             //stroke: '#ccc',
             'stroke-width': 5
             },*/
            fields: 'negocios'
        }, {
            type: 'category',
            position: 'bottom',
            //labelInSpan: true,
            grid: true,
            title: {
                text: 'Proveedor',
                fontSize: 15
            },
            fields: 'name',
            renderer: function(value,record,layoutContext){
                //return Ext.String.ellipsis(record, 8);
                
                return record.substring(0, 5);
                //return record;
            },
             labelInSpan : true,

            label: {
             
              miterLimit: 0,
                scalingCenterX : 0,
                shadowColor: '#ccc',
                shadowOffsetY: 1,
                //fillStyle: "#ccc",
                //calloutLine: false,
                miterLimit:0,
                fontSize: 8,
                padding: 0,
                margin: 0,
                style:{
                    width: '2px'
                },
               rotate: {
                    degrees: -90
                }
            }
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

            gr8 = Ext.getCmp('grafica8' + indice + idform);
            
            var axes = gr8.getAxes();            
            
            var SampleValuesAxis =  axes[1];
            var mino = SampleValuesAxis.getMinimum();
            var maxo = SampleValuesAxis.getMaximum();
            
            
            
                    
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
                                        
                                        indi = this.up('menu').up('button').up('toolbar').up().indice;
                                        res = this.up('menu').up('button').up('toolbar').up().res;
                                        idfor = this.up('menu').up('button').up('toolbar').up().idform;
                                        
                                        
                                        Ext.create('Colsys.Indicadores.winEmbarque', {
                                            id: 'w8' + indi + idfor,
                                            indice: indi,
                                            idform: idfor,
                                            res: res
                                        });

                                        Ext.create('Ext.fx.Anim', {
                                            target: Ext.getCmp('w8' + indi + idfor),
                                            duration: 1000,
                                            from: {
                                                width: 0,
                                                opacity: 0,
                                                height: 0,
                                                left: 0
                                            },
                                            to: {
                                                width: 430,
                                            }
                                        });
                                        if (res[indi]) {
                                            Ext.getCmp('w8' + indi + idfor).show();
                                        }


                                    }
                                },
                                {
                                    text: 'Descargar Imagen',
                                    iconCls: 'page_save',
                                    handler: function (btn, e, eOpts) {
                                        gr8.downloadCanvas('Coordinacion de Embarque', subtitulo, transporte);
                                    }
                                },
                                {
                                    text: 'Vista Previa',
                                    iconCls: 'photo_img',
                                    handler: function (btn, e, eOpts) {
                                        gr8.previewIndicadores('Coordinacion de Embarque', subtitulo, transporte);
                                    }
                                },
                                {
                                    text: 'Informe del Periodo',
                                    iconCls: 'csv',
                                    handler: function (btn, e, eOpts) {
                                        indi = this.up('menu').up('button').up('toolbar').up().indice;
                                        res = this.up('menu').up('button').up('toolbar').up().res;
                                        idfor = this.up('menu').up('button').up('toolbar').up().idform;
                                        
                                        filtro = "embarque";
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
    asignarSeries: function (gr8) {
        gr8.addSeries([{
                type: 'bar',
                title: 'Negocios',
                axis: 'left',
                stacked: false,
                xField: ['name'],
                yField: ['negocios'],
               
               /* style: {
                    minGapWidth: 60,
                    maxBarWidth:50
                },*/
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
                        mostrardatosMes("embarque",item.record.data.name);
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
