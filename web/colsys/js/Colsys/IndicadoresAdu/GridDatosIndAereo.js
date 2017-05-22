
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Ext.define('Colsys.IndicadoresAdu.GridDatosIndAereo', {
    extend: 'Colsys.Templates.GridConsultaBasic',
    alias: 'widget.Colsys.IndicadoresAdu.GridDatosIndAereo',
    columns: [
        {text: "D.O.",                  dataIndex: 'ca_referencia',         sortable: true,                                 width:115},
        {text: "Cliente",                 dataIndex: 'ca_cliente',        sortable: true,    width:80},
        {text: "Eta",   dataIndex: 'ca_fcheta', sortable: true, width:85,renderer: function (a, b, c, d) {
                                if (a) {
                                    var formattedDate = new Date(a);
                                    var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                                    var d = formattedDate.getDate();
                                    if (d < 10) {
                                        d = "0" + d
                                    }
                                    var m = formattedDate.getMonth();
                                    m += 1; // JavaScript months are 0-11
                                    if (m < 10) {
                                        m = "0" + m;
                                    }
                                    var y = formattedDate.getFullYear();
                                    return y + "-" + m + "-" + d;
                                }
                            }, format: "Y-m-d", altFormat: "Y-m-d",submitFormat: 'Y-m-d'},
        {text: "Documentos<br>completos",   dataIndex: 'ca_fchmayordoc', sortable: true, width:85, renderer: function (a, b, c, d) {
                                if (a) {
                                    var formattedDate = new Date(a);
                                    var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                                    var d = formattedDate.getDate();
                                    if (d < 10) {
                                        d = "0" + d
                                    }
                                    var m = formattedDate.getMonth();
                                    m += 1; // JavaScript months are 0-11
                                    if (m < 10) {
                                        m = "0" + m;
                                    }
                                    var y = formattedDate.getFullYear();
                                    return y + "-" + m + "-" + d;
                                }
                            }, format: "Y-m-d", altFormat: "Y-m-d",submitFormat: 'Y-m-d'},
        {text: "Fecha syga",   dataIndex: 'ca_fchsiga', sortable: true, width:85, 
            renderer: function (a, b, c, d) {
                                if (a) {
                                    var formattedDate = new Date(a);
                                    var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                                    var d = formattedDate.getDate();
                                    if (d < 10) {
                                        d = "0" + d
                                    }
                                    var m = formattedDate.getMonth();
                                    m += 1; // JavaScript months are 0-11
                                    if (m < 10) {
                                        m = "0" + m;
                                    }
                                    var y = formattedDate.getFullYear();
                                    return y + "-" + m + "-" + d;
                                }
                            },
            format: "Y-m-d", altFormat: "Y-m-d",submitFormat: 'Y-m-d'},
        {text: "Levante",   dataIndex: 'ca_fchlevante', sortable: true, width:85, renderer: function (a, b, c, d) {
                                if (a) {
                                    var formattedDate = new Date(a);
                                    var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                                    var d = formattedDate.getDate();
                                    if (d < 10) {
                                        d = "0" + d
                                    }
                                    var m = formattedDate.getMonth();
                                    m += 1; // JavaScript months are 0-11
                                    if (m < 10) {
                                        m = "0" + m;
                                    }
                                    var y = formattedDate.getFullYear();
                                    return y + "-" + m + "-" + d;
                                }
                            }, format: "Y-m-d", altFormat: "Y-m-d",submitFormat: 'Y-m-d'},
        {text: "Despacho",   dataIndex: 'ca_fchdespcarga', sortable: true, width:85, renderer: function (a, b, c, d) {
                                if (a) {
                                    var formattedDate = new Date(a);
                                    var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                                    var d = formattedDate.getDate();
                                    if (d < 10) {
                                        d = "0" + d
                                    }
                                    var m = formattedDate.getMonth();
                                    m += 1; // JavaScript months are 0-11
                                    if (m < 10) {
                                        m = "0" + m;
                                    }
                                    var y = formattedDate.getFullYear();
                                    return y + "-" + m + "-" + d;
                                }
                            }, format: "Y-m-d", altFormat: "Y-m-d",submitFormat: 'Y-m-d'},
        {text: "Entrega Carpeta<br>a facturacion",   dataIndex: 'ca_fchentrcarpfacturacion', sortable: true, width:85,renderer: function (a, b, c, d) {
                                if (a) {
                                    var formattedDate = new Date(a);
                                    var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                                    var d = formattedDate.getDate();
                                    if (d < 10) {
                                        d = "0" + d
                                    }
                                    var m = formattedDate.getMonth();
                                    m += 1; // JavaScript months are 0-11
                                    if (m < 10) {
                                        m = "0" + m;
                                    }
                                    var y = formattedDate.getFullYear();
                                    return y + "-" + m + "-" + d;
                                }
                            }, format: "Y-m-d", altFormat: "Y-m-d",submitFormat: 'Y-m-d'},
        {text: "Entrega a<br>facturacion",   dataIndex: 'ca_fchentrfacturacion', sortable: true, width:85,renderer: function (a, b, c, d) {
                                if (a) {
                                    var formattedDate = new Date(a);
                                    var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                                    var d = formattedDate.getDate();
                                    if (d < 10) {
                                        d = "0" + d
                                    }
                                    var m = formattedDate.getMonth();
                                    m += 1; // JavaScript months are 0-11
                                    if (m < 10) {
                                        m = "0" + m;
                                    }
                                    var y = formattedDate.getFullYear();
                                    return y + "-" + m + "-" + d;
                                }
                            }, format: "Y-m-d", altFormat: "Y-m-d",submitFormat: 'Y-m-d'},
       //{text: "Factura",                 dataIndex: 'ca_factura',        sortable: true,    width:80},
        
        {text: "Fecha<br>Facturacion",   dataIndex: 'ca_fchfacturacion', sortable: true, width:85,renderer: function (a, b, c, d) {
                                if (a) {
                                    var formattedDate = new Date(a);
                                    var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                                    var d = formattedDate.getDate();
                                    if (d < 10) {
                                        d = "0" + d
                                    }
                                    var m = formattedDate.getMonth();
                                    m += 1; // JavaScript months are 0-11
                                    if (m < 10) {
                                        m = "0" + m;
                                    }
                                    var y = formattedDate.getFullYear();
                                    return y + "-" + m + "-" + d;
                                }
                            }, format: "Y-m-d", altFormat: "Y-m-d",submitFormat: 'Y-m-d'},
        {text: "Fecha Entrega<br>Mensajeria",   dataIndex: 'ca_fchmensajeria', sortable: true, width:85, renderer: function (a, b, c, d) {
                                if (a) {
                                    var formattedDate = new Date(a);
                                    var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                                    var d = formattedDate.getDate();
                                    if (d < 10) {
                                        d = "0" + d
                                    }
                                    var m = formattedDate.getMonth();
                                    m += 1; // JavaScript months are 0-11
                                    if (m < 10) {
                                        m = "0" + m;
                                    }
                                    var y = formattedDate.getFullYear();
                                    return y + "-" + m + "-" + d;
                                }
                            }, format: "Y-m-d", altFormat: "Y-m-d",submitFormat: 'Y-m-d'},
        
        {
            text:"Indicadores de optimizacion",
            columns:[

                {text: "IDG 1", dataIndex: 'dia1', sortable: true,    width:100,tdCls: 'row_gray',baseCls:'row_green',
                    renderer: function(value, metaData, record, row, col, store, gridView){
                        if (value >= 1 ) {
                                metaData.style = 'color:red;font-weight:bold;background:yellow;';
                        }
                        return value ;
                    }
                },
                {text: "OPORTUNIDAD<br> ENTREGA DCTS<br> COMPLETOS", dataIndex: 'ind1', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'},
                
                {text: "IDG 2", dataIndex: 'dia2', sortable: true,    width:100,tdCls: 'row_gray',baseCls:'row_green',
                    renderer: function(value, metaData, record, row, col, store, gridView){
                        if (value >= 4 ) {
                                metaData.style = 'color:red;font-weight:bold;background:yellow;';
                        }
                        return value ;
                    }
                },
                {text: "OPORTUNIDAD DE<br> NACIONALIZACIÓN", dataIndex: 'ind2', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'},
                
                {text: "IDG 3", dataIndex: 'dia3', sortable: true,    width:100,tdCls: 'row_gray',baseCls:'row_green',
                    renderer: function(value, metaData, record, row, col, store, gridView){
                        if (value > 1 ) {
                                metaData.style = 'color:red;font-weight:bold;background:yellow;';
                        }
                        return value ;
                    }
                },
                {text: "OPORTUNIDAD<br>ENTREGA DE<br>MERCANCIA", dataIndex: 'ind3', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'},
                
                {text: "IDG 4", dataIndex: 'dia4', sortable: true,    width:100,tdCls: 'row_gray',baseCls:'row_green',
                    renderer: function(value, metaData, record, row, col, store, gridView){
                        if (value > 1 ) {
                                metaData.style = 'color:red;font-weight:bold;background:yellow;';
                        }
                        return value ;
                    }
                },
                {text: "OPORTUNIDAD<br>DE ENTREGA A<br>FACTURACIÓN", dataIndex: 'ind4', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'},
                
                {text: "IDG 5", dataIndex: 'dia5', sortable: true,    width:100,tdCls: 'row_gray',baseCls:'row_green',
                    renderer: function(value, metaData, record, row, col, store, gridView){
                        if (value > 2 ) {
                                metaData.style = 'color:red;font-weight:bold;background:yellow;';
                        }
                        return value ;
                    }
                },
                {text: "OPORTUNIDAD EN<br>LA FACTURACIÓN", dataIndex: 'ind5', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'},
                
                {text: "IDG 6", dataIndex: 'dia6', sortable: true,    width:100,tdCls: 'row_gray',baseCls:'row_green',
                    renderer: function(value, metaData, record, row, col, store, gridView){
                        if (value > 3 ) {
                                metaData.style = 'color:red;font-weight:bold;background:yellow;';
                        }
                        return value ;
                    }
                }/*,
                {text: "OPORTUNIDAD EN<br>LA FACTURACIÓN", dataIndex: 'ind6', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'}*/
            ]
        }
    ],
    listeners:{
        beforerender:function( me, eOpts )
        {
            
            me.setHeight(this.up().getHeight()-40);
            me.setWidth(this.up().getWidth()-12);
        }
    }
    
})