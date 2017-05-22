Ext.define('Colsys.Indicadores.winIndicadoresOtm', {
    extend: 'Ext.window.Window',
    title: 'Resumen de Datos',
            header: {
                titlePosition: 2,
                titleAlign: 'center'
            },
            closable: true,
            //closeAction: 'hide',
            maximizable: true,
            width: 1000,
            minWidth: 350,
            height: 550,
    //height: 700,
    //autoScroll: true,
    //width: 1400,
    //autoScroll: true,
    closeAction: 'destroy',
    //layout: 'anchor',
    alias: 'widget.Colsys.Indicadores.winIndicadoresOtm',
    /*style: {
        borderRadius: '15px'
    },*/
    items: [{
        //Ext.create('Colsys.Indicadores.GridIndicadores', {
            xtype: 'Colsys.Indicadores.GridIndicadoresOtm',
            id: 'gridindicadoresOtm',
            features: [{           
                ftype: 'summary'
            }],
            //autoHeight: true,
            //maxHeight: 500,
            listeners: {
                afterrender: function (ct, position) {
                    this.setStore(
                        Ext.create('Ext.data.Store', {
                            fields: [
                                {name: 'anio', type: 'string'},
                                {name: 'mes', type: 'string'},
                                {name: 'empresa', type: 'string'},
                                {name: 'reporte', type: 'string'},
                                {name: 'doctransporte', type: 'string'},
                                //{name: 'orden', type: 'string'},
                                {name: 'ciuorigen', type:'string'},
                                {name: 'destino'},
                                {name: 'tansportador'},
                                {name: 'modalidad'},
                                {name: 'piezas', type: 'integer'},
                                {name: 'peso', type: 'integer'},
                                {name: 'volumen', type: 'float'},                                
                                {name: 'contenedorlcl', type: 'integer'},
                                /*{name: 'fch_salida'},*/
                                {name: 'fch_llegadaotm'},
                                {name: 'fch_cargue'},
                                {name: 'fch_finalizacion'},
                                {name: 'fch_presentacion', type:'date' , format:'Y-m-d'},
                                {name: 'fch_cierre'},
                                /*{name: 'fch_factura'},
                                {name: 'metacargue'},*/
                                {name: 'metacargue'},
                                {name: 'metallegadaotm'},
                                {name: 'metapresentacion'},
                                {name: 'metacierre'}
                            ], data: this.up('window').datos
                        }));
                }
            }
        //})
    }
    ]
});
