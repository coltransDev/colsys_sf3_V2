
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Ext.define('Colsys.FalabellaAdu.GridDatosIndAereo', {
    extend: 'Colsys.Templates.GridConsultaBasic',
    alias: 'widget.Colsys.FalabellaAdu.GridDatosIndAereo',
    columns: [
        {text: "ETA",              dataIndex: 'c_ca_fcheta',            sortable: true, width:85,
            renderer: Ext.util.Format.dateRenderer('Y-m-d'),                
            format: "d/m/Y",
            altFormat: "Y-m-d",
            submitFormat: 'Y-m-d'            
        },
        {text: "D.O.",                  dataIndex: 'c_ca_referencia',         sortable: true,                                 width:115},
        {text: "Preins",                dataIndex: 'c_ca_preinspeccion',      sortable: true, xtype : 'checkcolumn',          width:30  },
        {text: "PAIS ORIGEN",       dataIndex: 'c_ca_paisorigen',         sortable: true,    width:110},
        {text: "Fecha cons",              dataIndex: 'ca_fchconsolidado',            sortable: true, width:85,
            renderer: Ext.util.Format.dateRenderer('Y-m-d'),                
            format: "d/m/Y",
            altFormat: "Y-m-d",
            submitFormat: 'Y-m-d'            
        },        
        {text: "CONS.",                 dataIndex: 'c_ca_consolidado',        sortable: true,    width:80},
        
        {text: "guia/bl.",                 dataIndex: 'ca_doctransporte',        sortable: true,    width:80},
        {text: "Carpeta",               dataIndex: 'c_ca_carpeta',            sortable: true,   width:190},
        {text: "Proveedor",          dataIndex: 'c_ca_proveedor',          sortable: true,    width:120},
        {text: "TIPO DE<br> CARGA",         dataIndex: 'c_ca_tipocarga',      sortable: true,   width:120},
        {text: "VALOR",                 dataIndex: 'c_ca_valor',              sortable: true},
        
        
        {text: "FORWARDER",                 dataIndex: 'ca_lognet',        sortable: true,    width:80},
        {text: "Proveedor",                 dataIndex: 'ca_tipocarga',        sortable: true,    width:80},
        {text: "Proveedor",                 dataIndex: 'ca_valor',        sortable: true,    width:80},
        {text: "Proveedor",                 dataIndex: 'ca_fchdoctransporte',        sortable: true,    width:80},
        {text: "Proveedor",                 dataIndex: 'ca_factura',        sortable: true,    width:80},
        {text: "Proveedor",                 dataIndex: 'ca_fchfactura',        sortable: true,    width:80},
        {
            text:"BL",
            columns:[
                {text: "Original",                dataIndex: 'ca_fchbl',              sortable: true, width:85 ,
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                    format: "d/m/Y",
                    altFormat: "Y-m-d",
                    submitFormat: 'Y-m-d'
                }
            ]
        },
        {
            text:"Factura comercial",
            columns:[
                {text: "Numero",               dataIndex: 'c_ca_factura',            sortable: true, editor: {xtype: "textfield"}, width:160},
                {text: "Original",           dataIndex: 'c_ca_fchfactura',         sortable: true, width:85,
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                    format: "d/m/Y",
                    altFormat: "Y-m-d",
                    submitFormat: 'Y-m-d'
                }
            ]
        },
        {
            text:"Lista de<br> Empaque",
            columns:[
                {text: "Original",       dataIndex: 'c_ca_fchlistempaque',     sortable: true, width:85,
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                    format: "d/m/Y",
                    altFormat: "Y-m-d",
                    submitFormat: 'Y-m-d'
                }
            ]
        },
        {
            text:"Certificacion de Fletes",
            columns:[
                {text: "Numero",           dataIndex: 'c_ca_certfletes',         sortable: true, editor: {xtype: "textfield"}},
                {text: "Fecha",       dataIndex: 'c_ca_fchcertfletes',      sortable: true, width:85,
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                    format: "d/m/Y",
                    altFormat: "Y-m-d",
                    submitFormat: 'Y-m-d'
                }
            ]
        },
        {text: "Fecha<br>pago",              dataIndex: 'c_ca_fchpago',            sortable: true, width:85,
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),                
                    format: "d/m/Y",
                    altFormat: "Y-m-d",
                    submitFormat: 'Y-m-d',
                    tdCls: 'row_orange',
                    baseCls:'row_green'
        },
        {text: "A Tiempo", dataIndex: 'c_ca_atiempo', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'},
        {text: "Demora Docs", dataIndex: 'demoradocs', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'},
        {text: "Nacionalizacion", dataIndex: 'nacionalizacion', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'},
        {text: "Descripciones", dataIndex: 'descripciones', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'},
        
        {text: "Optimizacion", dataIndex: 'optimizacion', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'},        
        {text: "Documentos", dataIndex: 'indicador1', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'},
        {text: "Desc. Minimas", dataIndex: 'indicador2', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'},
        {text: "Nal", dataIndex: 'indicador3', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'},
        {text: "Eta <br>Ingr. Dep", dataIndex: 'etadeposito', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'},
        {text: "Eta <br>Consolidado", dataIndex: 'etaconsolida', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'}
    ],
    listeners:{
        beforerender:function( me, eOpts )
        {
            
            me.setHeight(this.up().getHeight()-40);
            me.setWidth(this.up().getWidth()-12);
        }
    }
    
})