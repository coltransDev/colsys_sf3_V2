/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Ext.define('Colsys.Indicadores.ToolbarGrafica', {
    alias: 'widget.wToolbarGrafica',
    extend: 'Ext.toolbar.Toolbar',
    style: {
        border: 'none'
    },
    listeners:{
        afterrender: function(ct, position){
            var me = this;
            
            this.add(
                    {
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
                            indice: me.indice,
                            handler: function () {
                                switch (me.filtro) {
                                    case "zarpe":
                                        Ext.create('Colsys.Indicadores.winZarpe', {
                                            id: 'wingrafica-' + me.indice + me.idform,
                                            closeAction: 'destroy',
                                            indice: me.indice,
                                            idform: me.idform,
                                            res: me.res
                                        });
                                        break;
                                    case "llegada":
                                        Ext.create('Colsys.Indicadores.winLlegada', {
                                            id: 'wingrafica-' + me.indice + me.idform,
                                            closeAction: 'destroy',
                                            indice: me.indice,
                                            idform: me.idform,
                                            res: me.res
                                        });
                                        break;
                                    case "facturacion":
                                        Ext.create('Colsys.Indicadores.winFacturacion', {
                                            id: 'wingrafica-' + me.indice + me.idform,
                                            closeAction: 'destroy',
                                            indice: me.indice,
                                            idform: me.idform,
                                            res: me.res
                                        });
                                        break;
                                    case "vaciado":
                                        Ext.create('Colsys.Indicadores.winVaciado', {
                                            id: 'wingrafica-' + me.indice + me.idform,
                                            closeAction: 'destroy',
                                            indice: me.indice,
                                            idform: me.idform,
                                            res: me.res
                                        });
                                        break;
                                    case "embarque":
                                        Ext.create('Colsys.Indicadores.winEmbarque', {
                                            id: 'wingrafica-' + me.indice + me.idform,
                                            closeAction: 'destroy',
                                            indice: me.indice,
                                            idform: me.idform,
                                            res: me.res
                                        });
                                        break;
                                    case "volumen":
                                        if(me.tipo == "LCL"){
                                            Ext.create('Colsys.Indicadores.winVolumenTrafico', {
                                                id: 'wingrafica-' + me.indice + me.idform,
                                                closeAction: 'destroy',
                                                indice: me.indice,
                                                idform: me.idform,
                                                res: me.res
                                            });
                                        }else{
                                            Ext.create('Colsys.Indicadores.winVolumenFCL', {
                                                id: 'wingrafica-' + me.indice + me.idform,
                                                closeAction: 'destroy',
                                                indice: me.indice,
                                                idform: me.idform,
                                                res: me.res
                                            });
                                        }
                                        break;
                                    case "transito":
                                        Ext.create('Colsys.Indicadores.winTransito', {
                                            id: 'wingrafica-' + me.indice + me.idform,
                                            closeAction: 'destroy',
                                            indice: me.indice,
                                            idform: me.idform,
                                            res: me.res
                                        });
                                        break;
                                    case "peso":
                                        Ext.create('Colsys.Indicadores.winPeso', {
                                            id: 'wingrafica-' + me.indice + me.idform,
                                            closeAction: 'destroy',
                                            indice: me.indice,
                                            idform: me.idform,
                                            res: me.res
                                        });
                                        break;
                                }
                                Ext.create('Ext.fx.Anim', {
                                    target: Ext.getCmp('wingrafica-' + me.indice + me.idform),
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
                                if (me.res[indice]) {
                                    Ext.getCmp('wingrafica-' + me.indice + me.idform).show();
                                }
                            }
                        },
                        {
                            text: 'Descargar Imagen',
                            iconCls: 'page_save',
                            handler: function (btn, e, eOpts) {
                                me.up().downloadCanvas(me.ngrafica, me.subtitulo, me.transporte);
                            }
                        },
                        {
                            text: 'Vista Previa',
                            iconCls: 'photo_img',
                            handler: function (btn, e, eOpts) {
                                me.up().previewIndicadores(me.ngrafica, me.subtitulo, me.transporte);
                            }
                        },
                        {
                            text: 'Informe del Periodo',
                            iconCls: 'csv',
                            handler: function (btn, e, eOpts) {
                                indi = me.indice;                                                                                                                        
                                idfor = me.idform;
                                filtro = me.filtro;
                                tipo = me.tipo;
                                
                                
                                var data = me.res[indi].datosgrid;
                                
                                if(tipo){
                                    for (var i = 0; i < datos.length; i++) {
                                        if(datos[i]["modalidad"]== tipo){
                                            data.push(datos[i]);
                                        }
                                    }
                                }
                                
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
                            }
                        }]
                    }
                }
            )
        }
    }
});