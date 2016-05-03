/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Ext.define('Colsys.FalabellaAdu.GridDatosIndFact', {
    extend: 'Colsys.Templates.GridConsultaBasic',
    alias: 'widget.Colsys.FalabellaAdu.GridDatosFact',
    columns: [
        {text: "SUC",                               dataIndex: 'c_ca_destino',         sortable: true,   width:100},
        {text: "DO_IMP",                            dataIndex: 'c_ca_referencia',      sortable: true,   width:130},
        //{text: "DO_SUF",                            dataIndex: 'c_ca_consolidado',        sortable: true,   width:80},
        //{text: "DO_ESTADO",                         dataIndex: 'c_ca_contenedor',         sortable: true,   width:110},
        {text: "DESPACHO_CARGA",                    dataIndex: 'c_ca_fchdespcarga',     sortable: true,   /*width:60,*/
            //renderer: Ext.util.Format.dateRenderer('Y-m-d'),
            format: "d/m/Y",
            altFormat: "Y-m-d",
            submitFormat: 'Y-m-d'},
        {text: "FECHA ENTREGA<br>CARPETA FACTURACION", dataIndex: 'c_ca_fchentrcarpfacturacion',         sortable: true,   /*width:190,*/
            //renderer: Ext.util.Format.dateRenderer('Y-m-d'),
            format: "d/m/Y",
            altFormat: "Y-m-d",
            submitFormat: 'Y-m-d'
        },
        {text: "FECHA ENTREGA<br>A FACTURACION",       dataIndex: 'c_ca_fchentrfacturacion',           sortable: true,    /*width:70,*/
            //renderer: Ext.util.Format.dateRenderer('Y-m-d'),
            format: "d/m/Y",
            altFormat: "Y-m-d",
            submitFormat: 'Y-m-d'
        },
        {text: "FACTURA",                           dataIndex: 't_ca_factura',                 sortable: true/*,    width:130*/},
        {text: "FACTURADO",                         dataIndex: 'c_ca_fchfacturacion',        sortable: true,
            //renderer: Ext.util.Format.dateRenderer('Y-m-d'),
            format: "d/m/Y",
            altFormat: "Y-m-d",
            submitFormat: 'Y-m-d'
        },
        {text: "FACT PUERTO VS<br> ENTREGA A FACTURACIÓN BOG",  dataIndex: 'dias1', sortable: true,width:100 ,tdCls: 'row_orange',baseCls:'row_green'},
        {text: "CUMPLE",                            dataIndex: 'ind1',          sortable: true},
        {text: "ENTREGA A FACTURACIÓN<br> VS FACTURA",  dataIndex: 'dias2',      sortable: true,    width:150, tdCls: 'row_orange',baseCls:'row_green'},
        {text: "CUMPLE",                            dataIndex: 'ind2',      sortable: true},
        {text: "FACT PUERTO  VS<br> FACTURA COLMAS",    dataIndex: 'dias3',          sortable: true,   width:120, tdCls: 'row_orange',baseCls:'row_green'},
        {text: "CUMPLE",                            dataIndex: 'ind3',              sortable: true}
    ]
})