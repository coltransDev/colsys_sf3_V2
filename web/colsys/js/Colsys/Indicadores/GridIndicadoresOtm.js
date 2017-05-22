Ext.define('Colsys.Indicadores.GridIndicadoresOtm', {
    alias: 'widget.wGridIndicadoresOtm',
    extend: 'Colsys.Templates.GridConsultaBasic',
    columns: 
        [{
                
                text: "A\u00F1o",
                dataIndex: 'anio',                
                width: 60,                
                summaryRenderer: function (value, summaryData, dataIndex) {
                    return "<b>Totales</b>";
                }
            },
            {
                text: "Mes",
                dataIndex: 'mes',
                width: 60
            },
            {
                text: "Compa\u00F1\u00EDa",
                dataIndex: 'empresa',
                width: 150,                
                hidden: true
            },
            {
                text: "RN",                
                dataIndex: 'consecutivo',                
                width: 110,                
                renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                    return '<a href="/tracking/reportes/detalleReporte/rep/' + value + '" target="_blank">' + value + '</a>';
                }
            },            
            {
                text: "Doc.<br/>Transporte",
                dataIndex: 'doctransporte',                
                width: 140,
                summaryType: 'count',
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return "<span style='font-weight: bold;'> "+value+"</span>";
                }
            },
            {
                text: "Origen",
                dataIndex: 'ciuorigen',                
                width: 120
            },
            {
                text: "Destino",
                dataIndex: 'destino',                
                width: 100                
            },                       
            {
                text: "Mod.",
                dataIndex: 'modalidad',                
                width: 60                
            },
            {
                text: "Piezas",
                dataIndex: 'piezas',                
                width: 70,                
                summaryType: 'sum',
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return "<span style='font-weight: bold;'> "+value+"</span>";
                }
            },
            {
                text: "Peso",
                dataIndex: 'peso',                
                width: 70,                
                summaryType: 'sum',                
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return "<span style='font-weight: bold;'> "+value+"</span>";
                }
            },
            {
                text: "Vol.",
                dataIndex: 'volumen',                
                width: 70,
               summaryType: 'sum',                
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return "<span style='font-weight: bold;'> "+value+"</span>";
                }
            },
            {
                text: "Contenedor Lcl",
                dataIndex: 'contenedorlcl',                
                width: 70,
                summaryType: 'sum',                
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return "<span style='font-weight: bold;'> "+value+"</span>";
                }
            },
            {
                text: "Transportador",
                dataIndex: 'transportador',                
                hidden: true,
                width: 100
            },
            {
                text: "Fch. Finalización",
                dataIndex: 'fch_finalizacion',
                id: 'fch_finalizacion',                
                width: 120,
                baseCls:'row_yellow',                
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Fch. Cargue",
                dataIndex: 'fch_cargue',
                id: 'fch_cargue',                
                width: 120,
                baseCls:'row_yellow',
                sortable: false,
                hideable: false,
                hidden: true
            },            
            {
                text: "Fch. Presentación",
                dataIndex: 'fch_presentacion',
                id: 'fch_presentacion',
                //flex: 1,
                width: 120,
                format: "Y-m-d",
                altFormat: "Y-m-d",
                baseCls:'row_yellow',                
                sortable: false,
                hideable: false,
                hidden: true,                
                renderer: function (a, b, c, d){
                    if (a) {
                        var formattedDate = new Date(a);
                        var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                        var d = formattedDate.getDate();
                        if (d < 10) {
                            d = "0" + d;
                        }
                        var m = formattedDate.getMonth();
                        m += 1;  
                        if (m < 10) {
                            m = "0" + m;
                        }
                        var y = formattedDate.getFullYear();
                        return y + "-" + m + "-" + d;
                    }
                }
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
                text: "Fch. Llegada",
                dataIndex: 'fch_llegadaotm',
                id: 'fch_llegadaotm',
                //flex: 1,
                width: 110,
                baseCls:'row_yellow',
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Fch. Cierre",
                dataIndex: 'fch_cierre',
                id: 'fch_cierre',
                //flex: 1,
                width: 110,
                baseCls:'row_yellow',
                sortable: false,
                hideable: false,
                hidden: true
            },            
            {
                text: "Meta",
                dataIndex: 'metacargue',
                id: 'metacargue',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true
            },            
            {
                text: "Meta",
                dataIndex: 'metallegadaotm',
                id: 'metallegadaotm',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Meta",
                dataIndex: 'metapresentacion',
                id: 'metapresentacion',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Meta",
                dataIndex: 'metacierre',
                id: 'metacierre',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true
            },           
            {
                text: "IDG",
                dataIndex: 'idgcargue',
                id: 'idgcargue',
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
                dataIndex: 'idgllegadaotm',
                id: 'idgllegadaotm',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true,
                baseCls:'row_green'
            },
            {
                text: "IDG",
                dataIndex: 'idgpresentacion',
                id: 'idgpresentacion',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true,
                baseCls:'row_green'
            },
            {
                text: "IDG",
                dataIndex: 'idgcierre',
                id: 'idgcierre',
                //flex: 1,
                width: 50,
                sortable: false,
                hideable: false,
                hidden: true,
                baseCls:'row_green'
            },            
            {
                text: "Observaciones",
                dataIndex: 'obscargue',
                id: 'obscargue',                
                width: 150,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Observaciones",
                dataIndex: 'obsllegadaotm',
                id: 'obsllegadaotm',                
                width: 150,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Observaciones",
                dataIndex: 'obspresentacion',
                id: 'obspresentacion',
                width: 150,
                sortable: false,
                hideable: false,
                hidden: true
            },
            {
                text: "Observaciones",
                dataIndex: 'obscierre',
                id: 'obscierre',
                width: 150,
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
                            //console.log(record);
                            switch (grigindicadores) {                                
                                case "cargue":
                                    if (record.get('metacargue') < record.get('idgcargue')) {
                                        record.set('noc',1);
                                        return "page_white_edit";
                                    }
                                    break;
                                case "llegadaotm":
                                    var idg = record.get('metallegadaotm') - record.get('idgllegadaotm');
                                    console.log(idg+"-dfasdfas");
                                    if (idg < 0 || record.get('metallegadaotm') == "SIN META") {                                        
                                        record.set('noc',1);
                                        return "page_white_edit";
                                    }
                                    console.log(record);
                                    break;
                                case "presentacion":
                                    if (record.get('metapresentacion') < record.get('idgpresentacion')) {
                                        record.set('noc',1);
                                        return "page_white_edit";
                                    }
                                    break;
                                case "cierre":
                                    if (record.get('metacierre') < record.get('idgcierre')) {
                                        record.set('noc',1);
                                        return "page_white_edit";
                                    }
                                    break;
                            }
                            //console.log(record);
                        },
                        iconCls: 'page_white_edit',
                        handler: function (grid, rowIndex, colIndex) {
                            var rec = grid.getStore().getAt(rowIndex);
                            console.log(rec);
                            //if (rec.get('noc') == 1) {
                                win_observaciones = null;
                                titulo = "";
                                tipoidg = "";
                                campo = "";
                                grigindicadores = this.up().up().filtro;
                                switch (grigindicadores) {

                                    case "cargue":
                                        tipoidg = 7;
                                        titulo = "Observaciones Cargue";
                                        campo = 'obscargue';
                                        break;
                                    case "llegadaotm":
                                        tipoidg = 8;
                                        titulo = "Observaciones Llegada Otm";
                                        campo = 'obsllegadaotm';
                                        break;
                                    case "presentacion":
                                        tipoidg = 9;
                                        titulo = "Observaciones Presentación";
                                        campo = 'obspresentacion';
                                        break;
                                    case "cierre":
                                        tipoidg = 10;
                                        titulo = "Observaciones Cierre";
                                        campo = 'obscierre';
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
                            //}

                        }
                    }]
            }
        ],
          
    ocultar: function (filtro) {
        
        Ext.getCmp('fch_cargue').setVisible(false);
        Ext.getCmp('fch_finalizacion').setVisible(false);
        //Ext.getCmp('teus').setVisible(false);
        /*Ext.getCmp('fch_eta').setVisible(false);
        Ext.getCmp('fch_zarpe').setVisible(false);
        Ext.getCmp('fch_salida').setVisible(false);*/
        Ext.getCmp('fch_llegadaotm').setVisible(false);
        Ext.getCmp('fch_presentacion').setVisible(false);
        Ext.getCmp('fch_cierre').setVisible(false);
        /*Ext.getCmp('fch_disponible').setVisible(false);
        Ext.getCmp('fch_vaciado').setVisible(false);
        Ext.getCmp('fch_factura').setVisible(false);
        Ext.getCmp('metacoord').setVisible(false);*/
        Ext.getCmp('metacargue').setVisible(false);
        Ext.getCmp('metallegadaotm').setVisible(false);
        Ext.getCmp('metapresentacion').setVisible(false);
        /*Ext.getCmp('metavaciado').setVisible(false);
        Ext.getCmp('metafacturacion').setVisible(false);
        Ext.getCmp('metatransito').setVisible(false);
        //Ext.getCmp('proveedor').setVisible(false);*/
        Ext.getCmp('idgcargue').setVisible(false);
        Ext.getCmp('idgllegadaotm').setVisible(false);
        Ext.getCmp('idgpresentacion').setVisible(false);
        /*Ext.getCmp('idgfacturacion').setVisible(false);
        Ext.getCmp('idgvaciado').setVisible(false);
        Ext.getCmp('idgtiempotransito').setVisible(false);
        Ext.getCmp('idgcoorembarque').setVisible(false);*/

        Ext.getCmp('obscargue').setVisible(false);
        Ext.getCmp('obsllegadaotm').setVisible(false);
        Ext.getCmp('obspresentacion').setVisible(false);
        Ext.getCmp('obscierre').setVisible(false);

        switch (filtro) {
            case "cargue":
                //Ext.getCmp('teus').setVisible(true);
                Ext.getCmp('fch_cargue').setVisible(true);
                Ext.getCmp('fch_finalizacion').setVisible(true);
                Ext.getCmp('metacargue').setVisible(true);
                Ext.getCmp('idgcargue').setVisible(true);
                Ext.getCmp('obscargue').setVisible(true);
                this.view.refresh();
                break;
            case "llegadaotm":
                //Ext.getCmp('teus').setVisible(true);
                Ext.getCmp('fch_llegadaotm').setVisible(true);
                Ext.getCmp('fch_finalizacion').setVisible(true);
                Ext.getCmp('metallegadaotm').setVisible(true);
                Ext.getCmp('idgllegadaotm').setVisible(true);
                Ext.getCmp('obsllegadaotm').setVisible(true);                
                break;
            case "presentacion":
                //Ext.getCmp('teus').setVisible(true);
                Ext.getCmp('fch_finalizacion').setVisible(true);
                Ext.getCmp('fch_presentacion').setVisible(true);
                Ext.getCmp('metapresentacion').setVisible(true);
                Ext.getCmp('idgpresentacion').setVisible(true);
                Ext.getCmp('obspresentacion').setVisible(true);
                this.view.refresh();
                break;
            case "cierre":
                //Ext.getCmp('teus').setVisible(true);
                Ext.getCmp('fch_llegadaotm').setVisible(true);
                Ext.getCmp('fch_cierre').setVisible(true);
                Ext.getCmp('metacierre').setVisible(true);
                Ext.getCmp('idgcierre').setVisible(true);
                Ext.getCmp('obscierre').setVisible(true);
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
            switch (this.up().filtro) {
                case "volumen":
                    break;
                case "cargue":                    
                    var idg = record.get('metacargue') - record.get('idgcargue');
                    
                    if (idg < 0 || record.get('metacargue') == "SIN META") {                        
                        return "row_pink";
                    }
                    break;
                    
                case "llegadaotm":                                        
                    var idg = record.get('metallegadaotm') - record.get('idgllegadaotm');
                    
                    if (idg < 0 || record.get('metallegadaotm') == "SIN META") {                        
                        return "row_pink";
                    }
                    break;
                case "presentacion":                                        
                    var idg = record.get('metapresentacion') - record.get('idgpresentacion');
                    
                    if (idg < 0 || record.get('metapresentacion') == "SIN META") {                        
                        return "row_pink";
                    }
                    break;
                case "cierre":                                        
                    var idg = record.get('metacierre') - record.get('idgcierre');
                    
                    if (idg < 0 || record.get('metacierre') == "SIN META") {                        
                        return "row_pink";
                    }
                    break;
               /* case "transito":                                        
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
                    break;*/
            }


        }
    }
}
);