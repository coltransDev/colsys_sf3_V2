Ext.define('Colsys.Indicadores.winIndicadores', {
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
    alias: 'widget.Colsys.Indicadores.winIndicadores',
    /*style: {
        borderRadius: '15px'
    },*/
    items: [{
        //Ext.create('Colsys.Indicadores.GridIndicadores', {
            xtype: 'Colsys.Indicadores.GridIndicadores1',
            id: 'gridindicadores1',
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
                                {name: 'orden', type: 'string'},
                                {name: 'traorigen', type:'string'},
                                {name: 'destino'},
                                {name: 'proveedor'},
                                {name: 'modalidad'},
                                {name: 'piezas', type: 'integer'},
                                {name: 'peso', type: 'integer'},
                                {name: 'volumen', type: 'float'},                                
                                {name: 'teus', type: 'integer'},
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
                                {name: 'metatransito'}
                            ], data: this.up('window').datos
                        }));
                }
            }
        //})
    }
    ]
});
