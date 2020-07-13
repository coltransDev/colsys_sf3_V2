Ext.define('Colsys.Indicadores.Internos.GridArchivos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Indicadores.Internos.GridArchivos',
    autoHeight: true,
    autoScroll: true,
    frame: true,   
    features: [{ftype:'grouping'}],
//    multiSelect: true,
//    stateId: 'stateGrid',    
//    viewConfig: {        
//        getRowClass: function (record, rowIndex, rowParams, store) {
//            return "row_"+record.get('ca_color'); 
//        }
//    },
    listeners:{
        render: function (me, eOpts){
            
            var me = this;            
            
            this.reconfigure(
                store = Ext.create('Ext.data.Store', {
                    id: 'store-archivos-'+me.indice,
                    fields: [
                        {name: 'idarchivo' + me.indice, type: 'integer', mapping: 'idarchivo'},
                        {name: 'ano' + me.indice, type: 'string', mapping: 'ano'},
                        {name: 'proceso' + me.indice, type: 'string', mapping: 'proceso'},
                        {name: 'periodo' + me.indice, type: 'string', mapping: 'periodo'},
                        {name: 'sucursal' + me.indice, type: 'string', mapping: 'sucursal'},
                        {name: 'nombre' + me.indice, type: 'string', mapping: 'nombre'},
                        {name: 'path' + me.indice, type: 'string', mapping: 'path'},
                        {name: 'observaciones' + me.indice, type: 'string', mapping: 'observaciones'},
                        {name: 'fchcreado' + me.indice, type: 'date', mapping: 'fchcreado'},
                        {name: 'usucreado' + me.indice, type: 'string', mapping: 'usucreado'}
                    ],                    
                    proxy: {
                        type: 'ajax',
                        url: '/indicadores/datosArchivos',
                        extraParams:{                            
                            idg: me.idg
                        },
                        reader: {
                            type: 'json',
                            rootProperty: 'root',
                            totalProperty: 'total',
                            summaryRootProperty: 'summaryRoot'
                        }
                    },
                    groupField: ['ano','proceso','sucursal'],
                    sorters: [{
                        property: 'fchcreado' + me.indice,
                        direction: 'ASC'
                    }],
                    autoLoad: true                    
                }),
                [
                    {
                        header: 'A\u00f1o',
                        dataIndex: 'ano' + me.indice,
                        hidden: true
                    },
                    {
                        header: 'Proceso',
                        dataIndex: 'proceso' + me.indice,
                        hidden: true
                    },
                    {
                        header: 'Sucursal',
                        dataIndex: 'sucursal' + me.indice,
                        hidden: true
                    },
                    {   
                        xtype: 'hidden',
                        dataIndex: 'idarchivo' + me.indice,
                        flex:1,
                        align:"rigth"
                    },
                    {
                        header: "Nombre",
                        dataIndex: 'nombre' + me.indice,
                        flex:1,
                        align:"rigth",
                        renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                            return '<a href="' + record.data.path + '" target="_blank">'+value+'</a>';
                        }
                        
                    },
                    {
                        header: "Observaciones",
                        dataIndex: 'observaciones' + me.indice,
                        flex:1,
                        align:"rigth"
                    },
                    {
                        header: "Fch. Creado",
                        dataIndex: 'fchcreado' + me.indice,
                        flex:1,
                        align:"rigth",
                        renderer: Ext.util.Format.dateRenderer('Y-m-d H:i:s')
                    },
                    {
                        header: "Usu. Creado",
                        dataIndex: 'usucreado' + me.indice,
                        flex:1,
                        align:"rigth"
                    }
                ]
            );
    
//            tbar = [{
//                xtype: 'toolbar',
//                dock: 'top',
//                id: 'bar-eve-'+this.indice,                
//                items: [
//                {
//                    text:   'Excel',
//                    iconCls: 'csv',
//                    cfg: {
//                        type: 'excel07',
//                        ext: 'xlsx'
//                    },
//                    handler: function(){
//                        var cfg = Ext.merge({
//                            title: 'Indicador de Gestión',
//                            fileName: 'Indicador de Gestión' + '.' + (this.cfg.ext || this.cfg.type)
//                        }, this.cfg);
//                        
//                        this.up("grid").saveDocumentAs(cfg);
//                    }
//                },{
//                    text: 'Generar PDF',
//                    iconCls: 'pdf',
//                    id: 'button2-'+me.indice,
//                    handler: function () {
//                        
//                        var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
//                            id: 'window-pdf-idg-'+me.indice,
//                            title: 'Generar PDF',
//                            sorc: "/indicadores/generarPdf?idg="+me.idg+"&mes="+me.mes+"&ano="+me.ano+"&tipo=pdf"
//                        });
//                        
//                        windowpdf.insertDocked(0, {
//                            xtype: 'toolbar',
//                            dock: 'top',
//                            items: [{ 
//                                xtype: 'button', 
//                                text: 'Guardar Versión',
//                                iconCls: 'disk',
//                                handler: function(){
//                                    Ext.create('Colsys.Indicadores.Internos.WindowVersion',{
//                                        title: 'Guardar ésta versión como:',
//                                        id: 'winversion-'+me.indice,
//                                        width: 500,
//                                        heigth: 500,
//                                        indice: me.indice,
//                                        ano: me.ano,
//                                        mes: me.mes,
//                                        idg: me.idg
//                                    }).show();
//                                }
//                            }]
//                        });
//                                                    
//                        windowpdf.show();
//                        
//                    }                                           
//                }]
//            }];

//            this.addDocked(tbar);
    
        }
    }    
});