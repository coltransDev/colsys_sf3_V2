
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Ext.define('Colsys.FalabellaAdu.GridDatosIndOperativo', {
    extend: 'Colsys.Templates.GridConsultaBasic',
    alias: 'widget.Colsys.FalabellaAdu.GridDatosIndOperativo',
    columns: [
        {text: "D.O.",                  dataIndex: 'c_ca_referencia',         sortable: true,                                 width:115},
        {text: "Preins",                dataIndex: 'c_ca_preinspeccion',      sortable: true, xtype : 'checkcolumn',          width:30  },
        {text: "CONS.",                 dataIndex: 'c_ca_consolidado',        sortable: true,    width:80},
        {text: "Container",             dataIndex: 'c_ca_contenedor',         sortable: true,    width:110},
        {text: "Cntr Size",             dataIndex: 'c_ca_tipocontenedor',     sortable: true,    width:60},
        {text: "Carpeta",               dataIndex: 'c_ca_carpeta',            sortable: true,   width:190},
        {text: "LOGNET",                dataIndex: 'c_ca_lognet',             sortable: true,    width:70},
        {text: "Bill of Lading",        dataIndex: 'c_ca_bl',                 sortable: true,    width:130},
        {text: "BL ISSUE",              dataIndex: 'c_ca_blimpresion',        sortable: true, },
        {text: "Manufacturer",          dataIndex: 'c_ca_fabricante',         sortable: true,    width:100},
        {text: "Partner Name",          dataIndex: 'c_ca_proveedor',          sortable: true,    width:120},
        {text: "OBSERVACIONES",         dataIndex: 'c_ca_observaciones',      sortable: true,    width:150},
        {text: "TRANS",                 dataIndex: 'c_ca_transportador',      sortable: true,    width:100},
        {text: "TIPO DE<br> CARGA",         dataIndex: 'c_ca_tipocarga',      sortable: true,   width:120},
        {text: "VALOR",                 dataIndex: 'c_ca_valor',              sortable: true},
        {text: "COURRIER",              dataIndex: 'c_ca_fchcourrier',        sortable: true,   width:85},
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
        {
            text:"Indicadores de optimizacion",
            columns:[
                {text: "Fecha<br>pago",              dataIndex: 'c_ca_fchpago',            sortable: true, width:85,
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),                
                    format: "d/m/Y",
                    altFormat: "Y-m-d",
                    submitFormat: 'Y-m-d',
                    tdCls: 'row_orange',
                    baseCls:'row_green'
                },

                {text: "Demora<br>Documentos", dataIndex: 'demoradocs', sortable: true,    width:100,tdCls: 'row_gray',baseCls:'row_green',
                    renderer: function(value, metaData, record, row, col, store, gridView){
                        if (value >= 1 ) {
                                metaData.style = 'color:red;font-weight:bold;background:yellow;';
                        }
                        return value ;
                    }
                },
                {text: "Dias Nal ETA", dataIndex: 'diasnaleta', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'},
                {text: "Dias Nal Hab", dataIndex: 'diasnalhab', sortable: true,    width:100,tdCls: 'row_gray',baseCls:'row_green'},

                {text: "Fecha<br>consinv",           dataIndex: 'c_ca_fchconsinv',         sortable: true, width:85,
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                    format: "d/m/Y",
                    altFormat: "Y-m-d",
                    submitFormat: 'Y-m-d',
                    tdCls: 'row_orange',
                    baseCls:'row_green'
                },
                {text: "Fecha<br>Recepcion",           dataIndex: 'c_ca_fchrecepcion',         sortable: true, width:85,
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                    format: "d/m/Y",
                    altFormat: "Y-m-d",
                    submitFormat: 'Y-m-d',
                    baseCls:'row_green'                                                                                
                },
                {text: "Fecha<br>Descripciones",     dataIndex: 'c_ca_fchdescripciones',   sortable: true, width:85,
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                    format: "d/m/Y",
                    altFormat: "Y-m-d",
                    submitFormat: 'Y-m-d',
                    tdCls: 'row_orange',
                    baseCls:'row_green'
                },

                {text: "A Tiempo", dataIndex: 'atiempo', sortable: true,  width:100,tdCls: 'row_gray',baseCls:'row_green'},
                {text: "Fecha<br>levante",           dataIndex: 'c_ca_fchlevante',         sortable: true, width:85,
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                    format: "d/m/Y",
                    altFormat: "Y-m-d",
                    submitFormat: 'Y-m-d',
                    tdCls: 'row_orange',
                    baseCls:'row_green'
                },
                {text: "Fecha<br>Entrega<br>Trans",     dataIndex: 'c_ca_fchentregatrans',    sortable: true, width:85,
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                    format: "d/m/Y",
                    altFormat: "Y-m-d",
                    submitFormat: 'Y-m-d',
                    tdCls: 'row_orange',
                    baseCls:'row_green'                                                                                
                }
            ]
        },
        {text: "Embarque",              dataIndex: 'c_ca_embarque',           sortable: true}        
    ],
    listeners:{
        beforerender:function( me, eOpts )
        {
            //console.log(this.up().getHeight())
            me.setHeight(this.up().getHeight()-40);
            me.setWidth(this.up().getWidth()-12);
        }
    }
    
})