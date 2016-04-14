<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//include_component("widgets5", "wgEmpresas");
?>

<script>
    // create the grid
    //var grid = Ext.create('Ext.grid.Panel', {
    var winIndicador1=null;
    var consoli=0;
    //var class="row_gray";
    var classtyle="";

    Ext.define('GridDetControl',{
        extend: 'Ext.grid.Panel',
        bufferedRenderer: true,
        selModel: {
            pruneRemoved: false
        },
        store: Ext.create('Ext.data.Store', {
            fields: [
                { name: 'ca_id_ind_cab_control',    mapping: 'c_ca_id_fal_ind_control' },
                { name: 'ca_muelle',                mapping: 'f_ca_muelle' },
                { name: 'ca_referencia',            mapping: 'c_ca_referencia' },
                { name: 'ca_preinspeccion',         mapping: 'c_ca_preinspeccion' },
                { name: 'ca_inspeccion',            mapping: 'c_ca_inspeccion' },
                { name: 'ca_consolidado',           mapping: 'c_ca_consolidado' },
                { name: 'ca_contenedor',            mapping: 'c_ca_contenedor' },
                { name: 'ca_tipocontenedor',        mapping: 'c_ca_tipocontenedor' },
                { name: 'ca_carpeta',               mapping: 'c_ca_carpeta' },
                { name: 'ca_lognet',                mapping: 'c_ca_lognet' },
                { name: 'ca_bl',                    mapping: 'c_ca_bl' },
                { name: 'ca_blimpresion',           mapping: 'c_ca_blimpresion' },
                { name: 'ca_fabricante',            mapping: 'c_ca_fabricante' },
                { name: 'ca_proveedor',             mapping: 'c_ca_proveedor' },
                { name: 'ca_observaciones',         mapping: 'c_ca_observaciones' },
                { name: 'ca_transportador',         mapping: 'c_ca_transportador' },
                { name: 'ca_tipocarga',             mapping: 'c_ca_tipocarga' },
                { name: 'ca_valor',                 mapping: 'c_ca_valor' },
                { name: 'ca_fchcourrier',           mapping: 'c_ca_fchcourrier' ,  type: 'date', dateFormat:'Y-m-d' },
                { name: 'ca_fchbl',                 mapping: 'c_ca_fchbl' ,  type: 'date', dateFormat:'Y-m-d'},
                { name: 'ca_factura',               mapping: 'c_ca_factura' },
                { name: 'ca_fchfactura',            mapping: 'c_ca_fchfactura' ,  type: 'date', dateFormat:'Y-m-d'},
                { name: 'ca_fchlistempaque',        mapping: 'c_ca_fchlistempaque' ,  type: 'date', dateFormat:'Y-m-d'},
                { name: 'ca_certfletes',            mapping: 'c_ca_certfletes' },
                { name: 'ca_fchcertfletes',         mapping: 'c_ca_fchcertfletes' ,  type: 'date', dateFormat:'Y-m-d'},
                { name: 'ca_fchpago',               mapping: 'c_ca_fchpago' ,  type: 'date', dateFormat:'Y-m-d'},
                { name: 'ca_fchconsinv',            mapping: 'c_ca_fchconsinv',  type: 'date', dateFormat:'Y-m-d'},
                { name: 'ca_fchrecepcion',          mapping: 'c_ca_fchrecepcion' ,  type: 'date', dateFormat:'Y-m-d'},
                { name: 'ca_fchdescripciones',      mapping: 'c_ca_fchdescripciones' ,  type: 'date', dateFormat:'Y-m-d'},
                { name: 'ca_fchlevante',            mapping: 'c_ca_fchlevante' ,  type: 'date', dateFormat:'Y-m-d'},
                { name: 'ca_fchentregatrans',       mapping: 'c_ca_fchentregatrans' ,  type: 'date', dateFormat:'Y-m-d'},
                { name: 'ca_embarque',              mapping: 'c_ca_embarque' },
                { name: 'demoradocs'},
                { name: 'diasnaleta'},
                { name: 'diasnalhab'},
                { name: 'atiempo'}
            ],
            autoLoad: false,
            remoteSort: false,
            proxy: {
                type: 'ajax',
                url: '/indicadoresAdu/datosDetControl',
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                }
            }
        }),        
        viewConfig: {
            getRowClass: function(record, rowIndex, rowParams, store){
                
                if(consoli!=record.data.ca_consolidado)                
                    classtyle=(classtyle=="row_gray")?"":"row_gray";                
                consoli=record.data.ca_consolidado;                
                return classtyle;
            }
        },
        columns: [
            {text: "D.O.",                  dataIndex: 'ca_referencia',         sortable: true,                                 width:115},
            {text: "Muelle",                dataIndex: 'ca_muelle',             sortable: true,                                 width:100},
            {text: "Preins",                dataIndex: 'ca_preinspeccion',      sortable: true, xtype : 'checkcolumn',          width:30},
            {text: "Inspeccion<br>Dian",    dataIndex: 'ca_inspeccion',         sortable: true, xtype : 'checkcolumn',          width:100},
            {text: "CONS.",                 dataIndex: 'ca_consolidado',        sortable: true, editor: {xtype: "textfield"},   width:80},
            {text: "Container",             dataIndex: 'ca_contenedor',         sortable: true, editor: {xtype: "textfield"},   width:110},
            {text: "Cntr Size",             dataIndex: 'ca_tipocontenedor',     sortable: true, editor: {xtype: "textfield"},   width:60},
            {text: "Carpeta",               dataIndex: 'ca_carpeta',            sortable: true, editor: {xtype: "textfield"},   width:190},
            {text: "LOGNET",                dataIndex: 'ca_lognet',             sortable: true, editor: {xtype: "textfield"},   width:70},
            {text: "Bill of Lading",        dataIndex: 'ca_bl',                 sortable: true, editor: {xtype: "textfield"},   width:130},
            {text: "BL Issue",              dataIndex: 'ca_blimpresion',        sortable: true, editor: {xtype: "textfield"}},
            {text: "Manufacturer",          dataIndex: 'ca_fabricante',         sortable: true, editor: {xtype: "textfield"},   width:100},
            {text: "Partner Name",          dataIndex: 'ca_proveedor',          sortable: true, editor: {xtype: "textfield"},   width:120},
            {text: "Observaciones",         dataIndex: 'ca_observaciones',      sortable: true, editor: {xtype: "textfield"},   width:150},
            {text: "Transportador",         dataIndex: 'ca_transportador',      sortable: true, editor: {xtype: "textfield"},   width:100},
            {text: "Tipo de<br>Carga",      dataIndex: 'ca_tipocarga',          sortable: true, editor: {xtype: "textfield"},   width:120},
            {text: "Valor",                 dataIndex: 'ca_valor',              sortable: true, editor: {xtype: "textfield"}},
            {text: "Courrier",              dataIndex: 'ca_fchcourrier',        sortable: true, editor: {xtype: "textfield"},   width:85},
            {
                text:"BL",
                columns:[
                    {text: "Original",      dataIndex: 'ca_fchbl',    sortable: true, width:85 ,
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        format: "d/m/Y",
                        altFormat: "Y-m-d",
                        submitFormat: 'Y-m-d',
                        editor: {xtype: "datefield",format: "d/m/Y",altFormat: "Y-m-d", submitFormat: 'Y-m-d'}
                    }
                ]
            },
            {
                text:"Factura comercial",
                columns:[
                    {text: "Numero",               dataIndex: 'ca_factura',            sortable: true, editor: {xtype: "textfield"}, width:160},
                    {text: "Original",           dataIndex: 'ca_fchfactura',         sortable: true, width:85,
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        format: "d/m/Y",
                        altFormat: "Y-m-d",
                        submitFormat: 'Y-m-d',
                        editor: {xtype: "datefield",format: "d/m/Y",altFormat: "Y-m-d", submitFormat: 'Y-m-d'}
                    }
                ]
            },
            {
                text:"Lista de<br> Empaque",
                columns:[
                    {text: "Original",       dataIndex: 'ca_fchlistempaque',     sortable: true, width:85,
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        format: "d/m/Y",
                        altFormat: "Y-m-d",
                        submitFormat: 'Y-m-d',
                        editor: {xtype: "datefield",format: "d/m/Y",altFormat: "Y-m-d", submitFormat: 'Y-m-d'}
                    }
                ]
            },
            {
                text:"Certificacion de Fletes",
                columns:[
                    {text: "Numero",           dataIndex: 'ca_certfletes',         sortable: true, editor: {xtype: "textfield"}},
                    {text: "Fecha",       dataIndex: 'ca_fchcertfletes',      sortable: true, width:85,
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        format: "d/m/Y",
                        altFormat: "Y-m-d",
                        submitFormat: 'Y-m-d',
                        editor: {xtype: "datefield",format: "d/m/Y",altFormat: "Y-m-d", submitFormat: 'Y-m-d'}
                    }
                ]
            },
            {
                text:"Indicadores de Optimizacion",
                columns:[
                    {text: "Fecha<br>pago",              dataIndex: 'ca_fchpago',            sortable: true, width:85,
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),                
                        format: "d/m/Y",
                        altFormat: "Y-m-d",
                        submitFormat: 'Y-m-d',
                        tdCls: 'row_orange',
                        baseCls:'row_green',                
                        editor: {xtype: "datefield",format: "d/m/Y",altFormat: "Y-m-d", submitFormat: 'Y-m-d'}                
                    },

                    {text: "Demora<br>Documentos", dataIndex: 'demoradocs', sortable: true, editor: {xtype: "textfield"},   width:100,tdCls: 'row_gray',baseCls:'row_green',
                        renderer: function(value, metaData, record, row, col, store, gridView){
                            if (value >= 1 ) {
                                    metaData.style = 'color:red;font-weight:bold;background:yellow;';
                            }
                            return value ;
                        }
                    },
                    {text: "Dias Nal ETA", dataIndex: 'diasnaleta', sortable: true, editor: {xtype: "textfield"},   width:100,tdCls: 'row_gray',baseCls:'row_green'},
                    {text: "Dias Nal Hab", dataIndex: 'diasnalhab', sortable: true, editor: {xtype: "textfield"},   width:100,tdCls: 'row_gray',baseCls:'row_green'},
                    {text: "Consulta<br>Inventario",           dataIndex: 'ca_fchconsinv',         sortable: true, width:85,
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        format: "d/m/Y",
                        altFormat: "Y-m-d",
                        submitFormat: 'Y-m-d',
                        tdCls: 'row_orange',
                        baseCls:'row_green',
                        editor: {xtype: "datefield",format: "d/m/Y",altFormat: "Y-m-d", submitFormat: 'Y-m-d'}
                    },
                    {text: "Recepcion<br>Documentos",           dataIndex: 'ca_fchrecepcion',         sortable: true, width:85,
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        format: "d/m/Y",
                        altFormat: "Y-m-d",
                        submitFormat: 'Y-m-d',
                        baseCls:'row_green',
                        editor: {xtype: "datefield",format: "d/m/Y",altFormat: "Y-m-d", submitFormat: 'Y-m-d'}
                    },
                    {text: "Descripciones",     dataIndex: 'ca_fchdescripciones',   sortable: true, width:85,
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        format: "d/m/Y",
                        altFormat: "Y-m-d",
                        submitFormat: 'Y-m-d',
                        tdCls: 'row_orange',
                        baseCls:'row_green',
                        editor: {xtype: "datefield",format: "d/m/Y",altFormat: "Y-m-d", submitFormat: 'Y-m-d'}
                    },

                    {text: "A Tiempo", dataIndex: 'atiempo', sortable: true, editor: {xtype: "textfield"},   width:100,tdCls: 'row_gray',baseCls:'row_green'},

                    {text: "Levante",           dataIndex: 'ca_fchlevante',         sortable: true, width:85,
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        format: "d/m/Y",
                        altFormat: "Y-m-d",
                        submitFormat: 'Y-m-d',
                        tdCls: 'row_orange',
                        baseCls:'row_green',
                        editor: {xtype: "datefield",format: "d/m/Y",altFormat: "Y-m-d", submitFormat: 'Y-m-d'}
                    },
                    {text: "Entrega<br>Transp.",     dataIndex: 'ca_fchentregatrans',    sortable: true, width:85,
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        format: "d/m/Y",
                        altFormat: "Y-m-d",
                        submitFormat: 'Y-m-d',
                        tdCls: 'row_orange',
                        baseCls:'row_green',
                        editor: {xtype: "datefield",format: "d/m/Y",altFormat: "Y-m-d", submitFormat: 'Y-m-d'}
                    }
                    
                ]
            },
            {text: "Embarque",              dataIndex: 'ca_embarque',           sortable: true, editor: {xtype: "textfield"}}
        ],
        
        onRender: function(ct, position){
            this.store.load({
                params : {
                    idcabcontrol : this.idcabcontrol,
                    parametros : this.parametros
                }
            });

            GridDetControl.superclass.onRender.call(this, ct, position);
        },
        
        plugins: [new Ext.grid.plugin.CellEditing({
                    clicksToEdit: 1
                })],
        listeners:{
            edit : function(editor, e, eOpts)
            {
                //alert(e.field);
                var store = this.store;
                if(e.field=="empresa")
                {
                    store.data.items[e.rowIdx].set('ca_idempresa', e.value);                    
                    store.data.items[e.rowIdx].set('empresa', editor.editors.items[0].field.rawValue);
                }
            }
        },
        tbar : [
            {
                xtype: 'exporterbutton',
                text: 'Exportar CSV',
                iconCls: 'csv'
            }/*,
            {
                //xtype: 'exporterbutton',
                text: 'Graficar',
                iconCls: 'graph',
                handler : function(){
                    var storeGrafica=this.up("grid").getStore();
                    var records=storeGrafica.getRange();
                    var variable="c_ca_tipocontenedor";
                    //var variable="c_ca_inspeccion";                   
                    
                    var res = [];
                    var indicador=[];
                    var valores=[];                    
                    for(i=0;i<records.length;i++)
                    {
                        eval("d=records[i].data."+variable+";")
                        if(d==false)
                            d="No";
                        else
                            d="Si";
                         index=indicador.lastIndexOf(d);
                         if(!indicador[index])
                         {
                             indicador.push(d);
                             valores.push(1);
                         }
                         else
                         {
                             valores[index]++;
                         }                        
                    }
                    //alert(indicador.toSource()+valores.toSource());
                    for(i=0;i<indicador.length;i++)
                    {
                        res.push({"indicador":indicador[i],"total":valores[i]})
                    }
                    var config={"contconsulta":this.contconsulta,"titleWindow":"Grafica"}
                    graficar(config,res);
                }
            }*/
            /*, {
                    xtype: 'exporterbutton',
                    text: 'Save As XLS',
                    format: 'excel',
                    title: 'Sample'
                }*/
            
        ],
        
    autoScroll:true
    });
    
    function graficar(config,res)
    {
        if (!winIndicador1) {
            winIndicador1 = Ext.create('Ext.window.Window', {
                title: (!config.titleWindow)?'Resumen de Datos':config.titleWindow,
                header: {
                    titlePosition: 2,
                    titleAlign: 'center'
                },
                closable: true,
                closeAction: 'hide',
                maximizable: true,
                //animateTarget: button,
                width: 800,
                minWidth: 350,
                height: 550,
                tools: [{type: 'pin'}],
                layout: {
                //    type: 'border',
                    padding: 5
                },
                autoScroll: true,
                items: [

                    Ext.create('Ext.panel.Panel',{
                        title: 'Grafica',
                        id:"grafica"+config.contconsulta,
                        autoScroll: true,
                        fixed:true,
                        overflowY :'scroll',
                        //width: 500,
                        //height: 800,
                        layout: 'column',
                        defaults: {
                            //anchor: '100%'
                            columnWidth: 1/2                            
                        },
                        //renderTo: Ext.getBody(),
                        items: [
                            grafica({id:'hcd'+config.contconsulta,title:((!config.titleGraph)?'Indicador de documentos':config.titleGraph),subtitle:((!config.subtitleGraph)?'Indicador de documentos':config.subtitleGraph),datos:JSON.stringify(res)}),

                        ]
                    })
                ]
            });
        }
        winIndicador1.show();
    }
    
    /*Ext.define('GridTabDetControl',{        
        extend: 'Ext.tab.Panel',
        //id:'tab-panel-id-det-control',
        activeTab: 0,
        items: [
            //Ext.create('GridDetControl',{'id':'grid-det-control'+this.iditem,'name':'grid-det-control'+this.iditem, 'idcabcontrol':this.iditem})
            new GridDetControl({'id':'grid-det-control'+this.iditem,'name':'grid-det-control'+this.iditem, 'idcabcontrol':this.iditem})
        ]
    });*/
    
</script>