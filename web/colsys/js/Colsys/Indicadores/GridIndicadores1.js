Ext.define('Colsys.Indicadores.GridIndicadores1', {
    alias: 'widget.wGridIndicadores1',
    extend: 'Colsys.Templates.GridConsultaBasic',
    columns: 
        [{
                
                text: "A\u00F1o",
                dataIndex: 'anio',
                //id: 'anio',
                //flex:0.5,
                width: 60,
                //sortable: false,
                //hideable: false,
                summaryRenderer: function (value, summaryData, dataIndex) {
                    return "<b>Totales</b>";
                }
            },
            {
                text: "Mes",
                dataIndex: 'mes',
                width: 60
                //flex: 0.5,
                //id: 'mes'
                //sortable: true
                //hideable: false
            },
            {
                text: "Compa\u00F1\u00EDa",
                dataIndex: 'empresa',
                width: 150,                
                hidden: true
            },
            {
                text: "RN",
                //dataIndex: 'reporte',
                dataIndex: 'consecutivo',
                //id: 'reporte',
                //flex: 1,
                width: 110,
                //sortable: false,
                //hideable: false,
                renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                    return '<a href="/tracking/reportes/detalleReporte/rep/' + value + '" target="_blank">' + value + '</a>';
                }
            },
            {
                text: "Orden No",
                dataIndex: 'orden',
                //id: 'orden',
                //flex: 1,
                width: 120,
                summaryRenderer: function (value, summaryData, dataIndex) {
                    return "<b> # Embarques</b>";
                }
                //sortable: true
                //hideable: false
            },
            {
                text: "Doc.<br/>Transporte",
                dataIndex: 'doctransporte',
                //id: 'doctransporte',
                //flex: 1,
                width: 140,
                summaryType: 'count',
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return "<span style='font-weight: bold;'> "+value+"</span>";
                }
                //sortable: true
                //hideable: false
            },
            {
                text: "Tra. Origen",
                dataIndex: 'traorigen',
                //id: 'traorigen',
                //flex: 1,
                width: 120
                //sortable: true
                //hideable: false
            },
            {
                text: "Destino",
                dataIndex: 'destino',
                //id: 'destino',
                //flex: 1
                width: 100
                //sortable: true
                //hideable: false
            },                       
            {
                text: "Mod.",
                dataIndex: 'modalidad',
                //id: 'modalidad',
                //flex: 1,
                width: 60
                //sortable: false,
                //hideable: false
            },
            {
                text: "Piezas",
                dataIndex: 'piezas',
                //id: 'piezas',
                width: 70,
                //flex: 01,
                summaryType: 'sum',
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return "<span style='font-weight: bold;'> "+value+"</span>";
                }
                //sortable: false,
                //hideable: false
            },
            {
                text: "Peso",
                dataIndex: 'peso',
                //id: 'peso',
                width: 70,
                //flex: 1,
                //sortable: false,
                summaryType: 'sum',                
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return "<span style='font-weight: bold;'> "+value+"</span>";
                }
                //hideable: false
            },
            {
                text: "Vol.",
                dataIndex: 'volumen',
                //id: 'volumen',
                //flex: 1,
                width: 70,
               summaryType: 'sum',                
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return "<span style='font-weight: bold;'> "+value+"</span>";
                }
                //sortable: false,
                //hideable: false
            },
            {
                text: "Teus",
                dataIndex: 'teus',
                //id: 'teus',
                width: 70,
                summaryType: 'sum',                
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return "<span style='font-weight: bold;'> "+value+"</span>";
                }
            },
            {
                text: "Transportador",
                dataIndex: 'line',
                //id: 'line',
                //flex: 1,
                hidden: true,
                width: 100
                //sortable: true
                //hideable: false
            }, 
            {
                text: "Proveedor",
                dataIndex: 'proveedor',
                //id: 'proveedor',
                width: 150,
                hidden: true
                //flex: 1,
                //sortable: false,
                //hideable: false
            },
            {
                text: "Fch. Carga<br/> con Reserva",
                dataIndex: 'fch_zarpe',
                id: 'fch_zarpe',
                //flex: 1,
                width: 120,
                baseCls:'row_yellow',
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Fch. Carga<br/> Disponible",
                dataIndex: 'fch_disponible',
                id: 'fch_disponible',
                //flex: 1,
                width: 120,
                baseCls:'row_yellow',
                summaryType: 'sum',
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Fch. Salida",
                dataIndex: 'fch_salida',
                id: 'fch_salida',
                //flexflex: 1,
                width: 95,
                baseCls:'row_yellow',
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Fch. Informada<br/> en ETA",
                dataIndex: 'fch_eta',
                id: 'fch_eta',
                //flex: 1,
                width: 120,
                baseCls:'row_yellow',
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Fch. Llegada",
                dataIndex: 'fch_llegada',
                id: 'fch_llegada',
                //flex: 1,
                width: 110,
                baseCls:'row_yellow',
                sortable: false,
                hideable: false,
                hidden: true
            },                        
            {
                text: "Fch.<br/> Facturacion",
                dataIndex: 'fch_factura',
                id: 'fch_factura',
                //flex: 1,
                width: 120,
                baseCls:'row_yellow',
                summaryType: 'sum',
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Fch. Vaciado",
                dataIndex: 'fch_vaciado',
                id: 'fch_vaciado',
                //flex: 1,
                width: 120,
                baseCls:'row_yellow',
                summaryType: 'sum',
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Meta",
                dataIndex: 'metacoord',
                id: 'metacoord',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Meta",
                dataIndex: 'metazarpe',
                id: 'metazarpe',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Meta",
                dataIndex: 'metallegada',
                id: 'metallegada',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Meta",
                dataIndex: 'metavaciado',
                id: 'metavaciado',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Meta",
                dataIndex: 'metafacturacion',
                id: 'metafacturacion',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Meta",
                dataIndex: 'metatransito',
                id: 'metatransito',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "IDG",
                dataIndex: 'idgzarpe',
                id: 'idgzarpe',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true,
                //tdCls: 'row_gray',
                baseCls:'row_green'
            },
            {
                text: "IDG",
                dataIndex: 'idgllegada',
                id: 'idgllegada',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true,
                baseCls:'row_green'
            },
            {
                text: "IDG",
                dataIndex: 'idgfacturacion',
                id: 'idgfacturacion',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true,
                baseCls:'row_green'
            },
            {
                text: "IDG",
                dataIndex: 'idgvaciado',
                id: 'idgvaciado',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true,
                baseCls:'row_green'
            },
            {
                text: "IDG",
                dataIndex: 'idgtiempotransito',
                id: 'idgtiempotransito',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true,
                baseCls:'row_green'
            },
            {
                text: "IDG",
                dataIndex: 'idgcoorembarque',
                id: 'idgcoorembarque',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true,
                baseCls:'row_green'
            },
            {
                text: "Observaciones",
                dataIndex: 'obscord',
                id: 'obscord',
                //flex: 1,
                width: 150,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Observaciones",
                dataIndex: 'obszarpe',
                id: 'obszarpe',
                //flex: 1,
                width: 150,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Observaciones",
                dataIndex: 'obsllegada',
                id: 'obsllegada',
                //flex: 1,
                width: 150,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Observaciones",
                dataIndex: 'obsfactura',
                id: 'obsfactura',
                //flex: 1,
                width: 150,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Observaciones",
                dataIndex: 'obstt',
                id: 'obstt',
                width: 150,
                //flex: 1,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Observaciones",
                dataIndex: 'obsdesconsolidacion',
                id: 'obsdesconsolidacion',
                width: 150,
                //flex: 1,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 25,
                //flex: 0.2,
                items: [{
                        getClass: function (value, meta, record, rowIx, ColIx, store) {
                            grigindicadores = this.up().up().filtro;
                            switch (grigindicadores) {

                                case "volumen":
                                    break;
                                case "transito":
                                    if (record.get('metatransito') < record.get('idgtiempotransito')) {
                                        record.set('noc',1);
                                        return "page_white_edit";
                                    }
                                    break;
                                case "embarque":
                                    if (record.get('metacoord') < record.get('idgcoorembarque')) {
                                        record.set('noc',1);
                                        return "page_white_edit";
                                    }
                                    break;
                                case "zarpe":
                                    if (record.get('metazarpe') < record.get('idgzarpe')) {
                                        record.set('noc',1);
                                        return "page_white_edit";
                                    }
                                    break;
                                case "llegada":
                                    if (record.get('metallegada') < record.get('idgllegada')) {
                                        record.set('noc',1);
                                        return "page_white_edit";
                                    }
                                    break;
                                case "facturacion":
                                    if (record.get('metafacturacion') < record.get('idgfacturacion')) {
                                        record.set('noc',1);
                                        return "page_white_edit";
                                    }
                                    break;
                                case "vaciado":
                                    if (record.get('metavaciado') < record.get('idgvaciado')) {
                                        record.set('noc',1);
                                        return "page_white_edit";
                                    }
                                    break;
                                case "peso":
                                    break;
                            }
                        },
                        iconCls: 'page_white_edit',
                        handler: function (grid, rowIndex, colIndex) {
                            var rec = grid.getStore().getAt(rowIndex);
                            if (rec.get('noc') == 1) {
                                win_observaciones = null;
                                titulo = "";
                                tipoidg = "";
                                campo = "";
                                grigindicadores = this.up().up().filtro;
                                switch (grigindicadores) {

                                    case "transito":
                                        tipoidg = 2;
                                        titulo = "Observaciones T. Transito";
                                        campo = 'obstt';
                                        break;
                                    case "embarque":
                                        tipoidg = 1;
                                        titulo = "Observaciones Coord. Embarque";
                                        campo = 'obscord';
                                        break;
                                    case "zarpe":
                                        tipoidg = 3;
                                        titulo = "Observaciones Op. Zarpe";
                                        campo = 'obszarpe';
                                        break;
                                    case "llegada":
                                        tipoidg = 4;
                                        titulo = "Observaciones Op. en la Llegada";
                                        campo = 'obsllegada';
                                        break;
                                    case "facturacion":
                                        tipoidg = 5;
                                        titulo = "Observaciones Op. en Facturacion";
                                        campo = 'obsfactura';
                                        break;
                                    case "vaciado":
                                        tipoidg = 6;
                                        titulo = "Observaciones Op. Desconsolidacion";
                                        campo = 'obsdesconsolidacion';
                                        break;
                                }

                                if (win_observaciones == null) {
                                    win_observaciones = new Ext.Window({
                                        title: titulo,
                                        width: 297,
                                        height: 332,
                                        resizable: false,
                                        id: 'win_observaciones',
                                        items: Ext.create('Ext.form.Panel', {
                                            bodyPadding: 5,
                                            width: 285,
                                            height: 295,
                                            defaultType: 'textareafield',
                                            items: [{
                                                    fieldLabel: '',
                                                    name: 'observ',
                                                    id: 'observ',
                                                    width: '98%',
                                                    height: '95%',
                                                    allowBlank: false,
                                                    value: rec.get(campo)
                                                }],
                                            buttons: [{
                                                    text: 'Guardar',
                                                    formBind: true, //only enabled once the form is valid
                                                    disabled: true,
                                                    handler: function () {
                                                        var form = this.up('form').getForm();
                                                        if (form.isValid()) {
                                                            form.submit({
                                                                url: '/tracking/widgets5/guardarObservacionesIdg',
                                                                params: {
                                                                    idreporte: rec.get('reporte'),
                                                                    tipoidg: tipoidg
                                                                },
                                                                success: function (form, action) {
                                                                    Ext.Msg.alert('Observacion almacenada correctamente');
                                                                    rec.set(campo, Ext.getCmp("observ").value);
                                                                    rec.commit();
                                                                    win_observaciones.close();
                                                                },
                                                                failure: function (form, action) {
                                                                    Ext.Msg.alert('Error', action.result.msg);
                                                                }
                                                            });
                                                        }
                                                    }
                                                }]

                                        }),
                                        listeners: {
                                            close: function (win, eOpts) {
                                                win_observaciones = null;
                                            }
                                        }
                                    })
                                }
                                win_observaciones.show();
                            }

                        }
                    }]
            }
        ],
          
    ocultar: function (filtro) {
        
        //Ext.getCmp('teus').setVisible(false);
        Ext.getCmp('fch_eta').setVisible(false);
        Ext.getCmp('fch_zarpe').setVisible(false);
        Ext.getCmp('fch_salida').setVisible(false);
        Ext.getCmp('fch_llegada').setVisible(false);
        Ext.getCmp('fch_disponible').setVisible(false);
        Ext.getCmp('fch_vaciado').setVisible(false);
        Ext.getCmp('fch_factura').setVisible(false);
        Ext.getCmp('metacoord').setVisible(false);
        Ext.getCmp('metazarpe').setVisible(false);
        Ext.getCmp('metallegada').setVisible(false);
        Ext.getCmp('metavaciado').setVisible(false);
        Ext.getCmp('metafacturacion').setVisible(false);
        Ext.getCmp('metatransito').setVisible(false);
        //Ext.getCmp('proveedor').setVisible(false);
        Ext.getCmp('idgzarpe').setVisible(false);
        Ext.getCmp('idgllegada').setVisible(false);
        Ext.getCmp('idgfacturacion').setVisible(false);
        Ext.getCmp('idgvaciado').setVisible(false);
        Ext.getCmp('idgtiempotransito').setVisible(false);
        Ext.getCmp('idgcoorembarque').setVisible(false);

        Ext.getCmp('obscord').setVisible(false);
        Ext.getCmp('obstt').setVisible(false);
        Ext.getCmp('obszarpe').setVisible(false);
        Ext.getCmp('obsllegada').setVisible(false);
        Ext.getCmp('obsfactura').setVisible(false);
        Ext.getCmp('obsdesconsolidacion').setVisible(false);

        switch (filtro) {
            case "volumen":
                //Ext.getCmp('teus').setVisible(true);
                Ext.getCmp('fch_salida').setVisible(true);
                Ext.getCmp('fch_llegada').setVisible(true);                
                this.view.refresh();
                break;
            case "transito":
                Ext.getCmp('fch_salida').setVisible(true);
                Ext.getCmp('fch_llegada').setVisible(true);                
                Ext.getCmp('metatransito').setVisible(true);
                Ext.getCmp('idgtiempotransito').setVisible(true);
                Ext.getCmp('obstt').setVisible(true);
                this.view.refresh();
                break;
            case "embarque":
                Ext.getCmp('fch_disponible').setVisible(true);
                Ext.getCmp('fch_salida').setVisible(true);
                Ext.getCmp('metacoord').setVisible(true);
                //Ext.getCmp('proveedor').setVisible(true);
                Ext.getCmp('idgcoorembarque').setVisible(true);
                Ext.getCmp('obscord').setVisible(true);
                break;
            case "zarpe":
                Ext.getCmp('fch_zarpe').setVisible(true);
                Ext.getCmp('fch_salida').setVisible(true);
                Ext.getCmp('metazarpe').setVisible(true);
                Ext.getCmp('idgzarpe').setVisible(true);
                Ext.getCmp('obszarpe').setVisible(true);
                break;
            case "llegada":
                Ext.getCmp('fch_llegada').setVisible(true);
                Ext.getCmp('fch_eta').setVisible(true);
                Ext.getCmp('metallegada').setVisible(true);
                Ext.getCmp('idgllegada').setVisible(true);
                Ext.getCmp('obsllegada').setVisible(true);
                break;
            case "facturacion":
                Ext.getCmp('fch_llegada').setVisible(true);
                Ext.getCmp('fch_factura').setVisible(true);
                Ext.getCmp('metafacturacion').setVisible(true);
                Ext.getCmp('idgfacturacion').setVisible(true);
                Ext.getCmp('obsfactura').setVisible(true);
                break;
            case "vaciado":
                Ext.getCmp('fch_llegada').setVisible(true);
                Ext.getCmp('fch_vaciado').setVisible(true);
                Ext.getCmp('metavaciado').setVisible(true);
                Ext.getCmp('idgvaciado').setVisible(true);
                Ext.getCmp('obsdesconsolidacion').setVisible(true);
                break;
            case "peso":
                Ext.getCmp('fch_salida').setVisible(true);
                Ext.getCmp('fch_llegada').setVisible(true);                
                break;
        }
        this.view.refresh();

    },    
    listeners:{
        beforerender:function( me, eOpts )
        {
            
            me.setHeight(this.up().getHeight()-40);
            me.setWidth(this.up().getWidth()-12);
        }
    },
    viewConfig: {
        stripeRows: true,
        getRowClass: function (record, rowIndex, rowParams, store) {
            //     return "row_purple";
            switch (this.up().filtro) {
                case "volumen":
                    break;
                case "transito":                                        
                    var idg = record.get('metatransito') - record.get('idgtiempotransito');
                    
                    if (idg < 0 || record.get('metatransito') == "SIN META") {                        
                        return "row_pink";
                    }
                    break;
                case "embarque":
                    var idg = record.get('metacoord') - record.get('idgcoorembarque');
                    if (idg < 0 || record.get('metacoord') == "SIN META") {     
                        return "row_pink";
                    }
                    break;
                case "zarpe":
                    if (record.get('metazarpe') < record.get('idgzarpe') || record.get('metazarpe') == "SIN META") {
                        return "row_pink";
                    }
                    break;
                case "llegada":
                    if (record.get('metallegada') < record.get('idgllegada') || record.get('metallegada') == "SIN META") {
                        return "row_pink";
                    }
                    break;
                case "facturacion":
                    if (record.get('metafacturacion') < record.get('idgfacturacion') || record.get('metafacturacion') == "SIN META") {
                        return "row_pink";
                    }
                    break;
                case "vaciado":
                    if (record.get('metavaciado') < record.get('idgvaciado') || record.get('metavaciado') == "SIN META") {
                        return "row_pink";
                    }
                    break;
                case "peso":
                    break;
            }


        }
    }
}
);