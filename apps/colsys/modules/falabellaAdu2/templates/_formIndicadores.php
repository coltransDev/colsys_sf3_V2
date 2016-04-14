<style type="text/css" media="screen">
        .x-grid-row-summary .x-grid-cell-inner {
            font-weight: bold;
            background-color: #BED600;            
        }
        
        .x-tab.x-tab-active.x-tab-default {
    background-color: #BED600;
    border-color: #000;
}
</style>
<script>

var winIndicador;
var winIndicadorFact;
var datos=datosFact=null;
var arrayColors=['#D63100','#BED600','#4572A7', '#AA4643', '#89A54E', '#80699B', '#3D96AE', '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92', '#0000FF', '#0066FF', '#00CCFF','#562F1E', '#AF7F24', '#263249', '#5F7F90', '#D9CDB6' ];
var animate=true;
 
Ext.define('FormIndicadores', {
    extend: 'Ext.form.Panel',
    title: 'Generacion de Indicadores',
    id:'form-indicadores',
    layout: {
        type: 'table'
    },
    defaultType: 'textfield',
    items: [
        {
            xtype:'Colsys.FalabellaAdu.FormFiltrosInd'
        }
    ],
    buttons: [{
        text: 'Indicador Op.',
        
        handler: function() {
            Ext.Ajax.setTimeout(120000);
            idtab=Ext.getCmp("eta1").getRawValue()+"_"+Ext.getCmp("eta2").getRawValue();
            if(idtab=="_")
                idtab=Ext.getCmp("fecha1").getRawValue()+"_"+Ext.getCmp("fecha2").getRawValue();            
            tabpanel= Ext.getCmp("tab-panel-id-indicadores");
            if(!tabpanel.getChildByElement('tab'+idtab) )
            {
                tabpanel.setLoading(true);
                Ext.Ajax.request({
                    url: '<?=url_for("/falabellaAdu2/datosPie")?>',
                    params: {                            
                        fecha1:Ext.getCmp("fecha1").getRawValue(),
                        fecha2:Ext.getCmp("fecha2").getRawValue(),
                        eta1:Ext.getCmp("eta1").getRawValue(),
                        eta2:Ext.getCmp("eta2").getRawValue()
                    },
                    success: function(response, opts) {
                        var res = Ext.decode(response.responseText);

                        datos=res.datos;
                        
                        if( res.success)
                        {
                            obj=[
                        ///////////////////ENCABEZADOS////////////////////////////////                        
                                Ext.create('Ext.panel.Panel',{
                                    title: 'REPORTE DE OPERACIONES',
                                    titleAlign:'center',
                                    id:"panel-operaciones"+idtab,
                                    html: res.encabezados,
                                    bodyStyle: {                            
                                        align:'center',
                                        padding: '10px'
                                    }
                                }),                    
///////////////////////////INDICADOR DE DOCUMENTOS/////////////////////////////////////////////////////
                                Ext.create('Colsys.FalabellaAdu.PanelIndDet',{
                                    title: 'DOCUMENTOS ORIGINALES',
                                    id:"panel-prueba"+idtab,                        
                                    items: [
                                        grafica({id:'hcd'+idtab,title:'Indicador de documentos',subtitle:'Reporte de documentos',datos:JSON.stringify(res.documentos)}),
                                        {
                                            xtype:'Colsys.FalabellaAdu.GridDatosIndDet',
                                            id:'gd'+idtab,
                                            name:'gd'+idtab,                                
                                            columns: columnasgrid('Docs','')                                
                                        }
                                    ]
                                }),                    
///////////////////////////DESCRIPCIONES MINIMAS/////////////////////////////////////////////////////
                                Ext.create('Colsys.FalabellaAdu.PanelIndDet',{
                                    title: 'DESCRIPCIONES MINIMAS',
                                    id:"panel-descripciones"+idtab,                        
                                    items: [
                                        grafica({id:'hcdm'+idtab,title:'Indicador de descripciones minimas',subtitle:'Reporte de documentos',datos:JSON.stringify(res.descripciones)}),
                                        {
                                            xtype:'Colsys.FalabellaAdu.GridDatosIndDet',
                                            id:'gdm'+idtab,
                                            name:'gdm'+idtab,
                                            columns: columnasgrid('Desc','Lineas')
                                        }
                                    ]
                                }),                    
///////////////////////////NACIONALIZACION/////////////////////////////////////////////////////
                                Ext.create('Colsys.FalabellaAdu.PanelIndDet',{
                                    title: 'OPTIMIZACION DE NACIONALIZACION',
                                    id:"panel-nal"+idtab,                        
                                    items: [
                                        grafica({id:'hcnal'+idtab,title:'Indicador optimizacion de nacionalizacion',subtitle:'Reporte de optimizacion de nacionalizacion',datos:JSON.stringify(res.nacionalizacion)}),
                                        {
                                            xtype:'Colsys.FalabellaAdu.GridDatosIndDet',
                                            id:'gnal'+idtab,
                                            name:'gnal'+idtab,
                                            columns: columnasgrid('Nal','Consolidados')
                                        }
                                    ]
                                }),
///////////////////////////CONTENEDORES/////////////////////////////////////////////////////
                                Ext.create('Colsys.FalabellaAdu.PanelIndDet',{
                                    title: 'CONTENEDORES',
                                    id:"panel-con"+idtab,                        
                                    items: [
                                    {
                                        xtype: 'highchart',
                                        id:'hccon'+idtab,
                                        name:'hccon'+idtab,
                                        store: Ext.data.JsonStore({                        
                                            fields: ['tipo', 'SPRBUN','TCBUEN'],
                                            proxy: {
                                                url: '<?=url_for("/falabellaAdu2/datosGrafica")?>',
                                                extraParams: {
                                                        datos:JSON.stringify(res.contenedores)
                                                    },
                                                type: 'ajax',                            
                                                reader: {                                        
                                                     type: 'json',
                                                     rootProperty: 'root'
                                                }                            
                                            },
                                            autoLoad: true
                                        }),
                                        series : [{
                                            type : 'column',
                                            dataIndex : 'SPRBUN',
                                            name : 'SPRBUN'
                                        }, {
                                            type : 'column',
                                            dataIndex : 'TCBUEN',
                                            name : 'TCBUEN'
                                        }],
                                        height : 500,
                                        width : 700,
                                        xField : 'tipo',
                                        chartConfig : {
                                            colors: arrayColors,
                                            chart : {
                                                renderer: 'SVG',
                                                marginRight : 130,
                                                marginBottom : 120,
                                                zoomType : 'x',
                                                options3d: {
                                                    enabled: true,
                                                    alpha: 15,
                                                    beta: 15,
                                                    depth: 50
                                                },
                                                type: 'column'
                                            },

                                            plotOptions: {
                                                column: {
                                                    depth: 25
                                                }                                    
                                            },
                                            title : {
                                                text : 'Analisis por terminal portuaria',
                                                x : -20 
                                            },
                                            subtitle : {
                                                text : "",
                                                x : -20
                                            },
                                            xAxis : [{
                                                title : {
                                                    text : 'Tipo',
                                                    margin : 20
                                                },
                                                labels : {
                                                    rotation : 270,
                                                    y : 35
                                                }
                                            }],
                                            yAxis : {
                                                title : {
                                                    text : 'Cantidad '
                                                },
                                                plotLines : [{
                                                    value : 0,
                                                    width : 1,
                                                    color : '#808080'
                                                }]
                                            },
                                            tooltip : {
                                                pointFormat: '<span style="color:{series.color}"><b>{series.name}</b></span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                                                shared: true

                                            },
                                            legend : {
                                                layout : 'vertical',
                                                align : 'right',
                                                verticalAlign : 'top',
                                                x : -10,
                                                y : 100,
                                                borderWidth : 0
                                            }
                                        }
                                    },
                                    {
                                        xtype:'Colsys.FalabellaAdu.GridDatosIndDet',
                                        id:'gcon'+idtab,
                                        name:'gcon'+idtab,
                                        columns: [
                                            {text: "Terminal", width: 120, dataIndex: 'terminal', sortable: true,
                                                summaryRenderer: function(value, summaryData, dataIndex) {
                                                    return "Total";
                                                }
                                            },
                                            {text: "Contenedores", width: 120, dataIndex: 'contenedor', summaryType: 'sum',sortable: true},
                                            {text: "%", width: 120 , dataIndex: 'por_contenedor', summaryType: 'sum',sortable: true},
                                            {text: "Teus", width: 120 , dataIndex: 'teus', summaryType: 'sum',sortable: true},
                                            {text: "%", width: 120 , dataIndex: 'por_teus', summaryType: 'sum',sortable: true}
                                        ]
                                    }
                                    ]
                                }),
///////////////////////////INDICADOR DE BLS/////////////////////////////////////////////////////
                                Ext.create('Colsys.FalabellaAdu.PanelIndDet',{
                                    title: 'INSPECCION BL',
                                    id:"panel-bl"+idtab,                        
                                    items: [
                                        grafica({id:'hcbl'+idtab,title:'Inspeccion de bl',subtitle:'Reporte de documentos',datos:JSON.stringify(res.bls)}),
                                        {
                                            xtype:'Colsys.FalabellaAdu.GridDatosIndDet',
                                            id:'gbl'+idtab,
                                            name:'gbl'+idtab,
                                            columns: columnasgrid('BL','Bls')                                
                                        }                            
                                    ]
                                })
                            ];
                
                            tabpanel.add({
                                title: "indicadores "+idtab,
                                id:'tab'+idtab,
                                itemId:'tab'+idtab,
                                closable :true,
                                items: [
                                    Ext.create('Ext.panel.Panel', {
                                        bodyPadding: 10,
                                        autoScroll:true,
                                        id:'tab-form'+idtab,
                                        items: obj
                                    })
                                ]
                            }).show();
                                            
                            store=Ext.getCmp('gd'+idtab).store;
                            store.loadData(res.documentosgrid);

                            store=Ext.getCmp('gdm'+idtab).store;                            
                            store.loadData(res.descripcionesgrid);

                            store=Ext.getCmp('gnal'+idtab).store;
                            store.loadData(res.nacionalizaciongrid);

                            store=Ext.getCmp('gcon'+idtab).store;
                            store.loadData(res.contenedoresgrid);

                            store=Ext.getCmp('gbl'+idtab).store;
                            store.loadData(res.blsgrid);
                        }
                        tabpanel.setLoading(false);
                    },
                    failure: function(response, opts) {
                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                        tabpanel.setLoading(false);
                    }
                });
            }
            tabpanel.setActiveTab('tab'+idtab);
        }
    },
    {
        text: 'Facturacion',        
        handler: function() {
        
            idtab=Ext.getCmp("eta1").getRawValue()+"_"+Ext.getCmp("eta2").getRawValue();
            if(idtab=="_")
                idtab=Ext.getCmp("fecha1").getRawValue()+"_"+Ext.getCmp("fecha2").getRawValue();

            tabpanel= Ext.getCmp("tab-panel-id-indicadores");
            if(!tabpanel.getChildByElement('tabf'+idtab) )
            {

                Ext.Ajax.request({
                    url: '<?=url_for("/falabellaAdu2/datosIndFact")?>',
                    params: {                            
                        fecha1:Ext.getCmp("fecha1").getRawValue(),
                        fecha2:Ext.getCmp("fecha2").getRawValue(),
                        eta1:Ext.getCmp("eta1").getRawValue(),
                        eta2:Ext.getCmp("eta2").getRawValue()
                    },
                    success: function(response, opts) {
                        var res = Ext.decode(response.responseText);

                        datosFact=res.datos; 
                        
                        if( res.success)
                        {
                            obj=[
                                
                                Ext.create('Ext.panel.Panel',{
                                    title: 'REPORTE DE OPERACIONES',
                                    titleAlign:'center',
                                    id:"panel-operacionesf"+idtab,
                                    html: res.encabezados,
                                    bodyStyle: {                            
                                        align:'center',
                                        padding: '10px'
                                    }
                                }),
                                Ext.create('Colsys.FalabellaAdu.PanelIndDet',{
                                    title: 'RECIBO FACTURA PUERTO VS ENTREGA A FACTURACIÓN BOG',
                                    id:"panel-indfact1"+idtab,                                    
                                    items: [
                                        grafica({id:'hci1'+idtab,title:'RECIBO FACTURA PUERTO VS ENTREGA A FACTURACIÓN BOG ',datos:JSON.stringify(res.indicador1)}),
                                        {
                                            xtype:'Colsys.FalabellaAdu.GridDatosIndDet',
                                            id:'gi1'+idtab,
                                            name:'gi1'+idtab,
                                            columns: columnasgrid('Fact1','')
                                        }
                                    ]
                                }),
                                
                                
                                Ext.create('Colsys.FalabellaAdu.PanelIndDet',{
                                    title: 'RECIBO FACTURA PUERTO VS ENTREGA A FACTURACIÓN BOG',
                                    id:"panel-indfact2"+idtab,                                    
                                    items: [
                                        grafica({id:'hci2'+idtab,title:'ENTREGA A FACTURACIÓN VS EMISIÓN FACTURA COLMAS',datos:JSON.stringify(res.indicador2)}),
                                        {
                                            xtype:'Colsys.FalabellaAdu.GridDatosIndDet',
                                            id:'gi2'+idtab,
                                            name:'gi2'+idtab,
                                            columns: columnasgrid('Fact2','')
                                        }                                            
                                    ]
                                }),
                                
                                Ext.create('Colsys.FalabellaAdu.PanelIndDet',{
                                    title: 'RECIBO FACTURA PUERTO VS ENTREGA A FACTURACIÓN BOG',
                                    id:"panel-indfact3"+idtab,                                    
                                    items: [
                                        grafica({id:'hci3'+idtab,title:'INDICADOR DE OPTIMIZACION FACTURACIÓN',datos:JSON.stringify(res.indicador3)}),
                                        {
                                            xtype:'Colsys.FalabellaAdu.GridDatosIndDet',
                                            id:'gi3'+idtab,
                                            name:'gi3'+idtab,
                                            columns: columnasgrid('Fact3','')
                                        }
                                    ]
                                })
                                
                            ]
                        }
                        
                        store=Ext.getCmp('gi1'+idtab).store;
                        store.loadData(res.indicador1grid);
                        
                        store=Ext.getCmp('gi2'+idtab).store;
                        store.loadData(res.indicador2grid);
                        
                        store=Ext.getCmp('gi3'+idtab).store;
                        store.loadData(res.indicador3grid);
                        
                        tabpanel.add({
                            title: "indicadores "+idtab,
                            id:'tabf'+idtab,
                            itemId:'tabf'+idtab,
                            closable :true,
                            items: [
                                Ext.create('Ext.panel.Panel', {
                                    bodyPadding: 10,
                                    autoScroll:true,
                                    id:'tabf-form'+idtab,
                                    items: obj                            
                                })
                            ]
                        }).show();
                        tabpanel.setActiveTab('tabf'+idtab);                        
                    },
                    failure: function(response, opts) {
                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                    }
                });
            }
        }
    },
    {
        text: 'Costos',
        handler: function() {
            
            idtab=Ext.getCmp("eta1").getRawValue()+"_"+Ext.getCmp("eta2").getRawValue();
            if(idtab=="_")
                idtab=Ext.getCmp("fecha1").getRawValue()+"_"+Ext.getCmp("fecha2").getRawValue();
            idtab=idtab;
            tabpanel= Ext.getCmp("tab-panel-id-indicadores");            
            if(!tabpanel.getChildByElement('tab'+idtab) )
            {
                
                Ext.Ajax.request({
                    url: '<?=url_for("/falabellaAdu2/datosFacturacion")?>',
                    params: {                            
                        fecha1:Ext.getCmp("fecha1").getRawValue(),
                        fecha2:Ext.getCmp("fecha2").getRawValue(),
                        eta1:Ext.getCmp("eta1").getRawValue(),
                        eta2:Ext.getCmp("eta2").getRawValue()
                    },
                    success: function(response, opts) {
                        var res = Ext.decode(response.responseText);
                        
                        if( res.success)
                        {   
                            datos=res.datos;
                            columnas=res.columnas;

                            var fields=[];
                            for (x in columnas) {
                                fields.push(columnas[x].dataindex);
                            }
                           
                           var createStore = function (fields,json) {                               
                                return Ext.create('Ext.data.Store', {
                                    fields: fields,
                                    data: json
                                });
                            };
                            var createColumns = function (fields,columnas) {
                                return fields.map(function (field) {
                                    return {
                                        text: columnas[field].name,
                                        width: 150,
                                        dataIndex: columnas[field].dataindex,
                                        renderer: function(value)
                                        {
                                            if(!isNaN(value))
                                                return Ext.util.Format.number(value,"0,000");
                                            else
                                                return value
                                            
                                        },
                                        align:'right',
                                        locked: ((columnas[field].name=="Do")?true:false),
                                        summaryType: function(records,data){
                                                var i = 0,
                                                    length = data.length,
                                                    total = 0,
                                                    record;
                                                for (; i < length; ++i) {
                                                    record = data[i];

                                                    if(!isNaN(record))
                                                        total += record;
                                                    else
                                                        total++;                                                    
                                                }
                                                return total;
                                        },
                                        summaryRenderer: function(value, summaryData, dataIndex) {
                                          
                                            if(columnas[dataIndex].summaryType=="sum")
                                                return "<b>Total : "+Ext.util.Format.number(value,"0,000")+"</b>";
                                            else if(columnas[dataIndex].summaryType=="count")
                                                return "<b>Total : "+value+"</b>";
                                            else
                                                return value;
                                        }
                                    };
                                });
                            };

                            obj=[
                                {
                                    xtype:'Colsys.FalabellaAdu.GridDatosIndDet',
                                    id:'fac'+idtab,
                                    name:'fac'+idtab,
                                    store: createStore(fields,res.datos),
                                    columns: createColumns(fields,columnas)
                                }];
                            
                            tabpanel.add({
                               title: "Facturacion "+idtab,
                               id:'tabF'+idtab,
                               itemId:'tabF'+idtab,
                               closable :true,
                               items: [
                                   Ext.create('Ext.panel.Panel', {
                                       bodyPadding: 10,                                       
                                       id:'tab-form'+idtab,
                                       items: obj
                                   })
                               ]
                           }).show();
                        }
                    },
                    failure: function(response, opts) {
                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                    }
                });                
            }
            tabpanel.setActiveTab('tab'+idtab);
        }
    }
    ]
});


function grafica(obj)
{    
    return Ext.create('Colsys.Chart.Pie',{
        id: obj.id,
        name:obj.id,
        datos:obj.datos,
        title:obj.title,
        subtitle:obj.subtitle,
        url: '<?=url_for("/falabellaAdu2/datosGrafica")?>',
        series: [
            {
                type: 'pie',
                name: 'Carpetas',
                categorieField: 'indicador',
                dataField: 'total'
            }
        ]
    });
}

function graficaBarras(obj)
{    
    return new Chart.ux.Highcharts({                            
        id: obj.id,
        name:obj.id,
        store: Ext.data.JsonStore({                        
            fields: obj.fields,
            proxy: {
                url: '<?=url_for("/falabellaAdu2/datosGrafica")?>',
                extraParams: {
                        datos:obj.datos
                    },
                type: 'ajax',                            
                reader: {                                        
                     type: 'json',
                     rootProperty: 'root'
                }                            
            },
            autoLoad: true
        }),
        series : obj.series,
        height : (obj.height?obj.height:500),
        width : (obj.width?obj.width:700),
        xField : (obj.xField?obj.xField:'tipo'),
        chartConfig : {
            colors: arrayColors,
            chart : {
                renderer: 'SVG',
                marginRight : 130,
                marginBottom : 120,
                zoomType : 'x',
                options3d: {
                    enabled: true,
                    alpha: 15,
                    beta: 15,
                    depth: 50
                },
                type: 'column'
            },
            plotOptions: {
                column: {
                    depth: 25
                }       
            },
            title : {
                text : (obj.title?obj.title:''),
                x : -20 
            },
            subtitle : {
                text : (obj.subtitle?obj.subtitle:''),
                x : -20
            },
            xAxis : [{
                title : {
                    text : 'Tipo',
                    margin : 20
                },
                labels : {
                    rotation : 270,
                    y : 35
                }
            }],
            yAxis : {
                title : {
                    text : 'Cantidad '
                },
                plotLines : [{
                    value : 0,
                    width : 1,
                    color : '#808080'
                }]
            },
            tooltip : {
                pointFormat: '<span style="color:{series.color}"><b>{series.name}</b></span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                shared: true

            },
            legend : {
                layout : 'vertical',
                align : 'right',
                verticalAlign : 'top',
                x : -10,
                y : 100,
                borderWidth : 0
            }
        }
    });
}

function cargarWin()
{
    
    if (!winIndicador) {
        winIndicador = Ext.create('Ext.window.Window', {
            title: 'Resumen de Datos',
            header: {
                titlePosition: 2,
                titleAlign: 'center'
            },
            closable: true,
            closeAction: 'hide',
            maximizable: true,            
            width: 800,
            minWidth: 350,
            height: 550,
            tools: [{type: 'pin'}
            ],
            layout: {
                padding: 5
            },
            autoScroll: true,
            items: [
            {
                xtype:'Colsys.FalabellaAdu.GridDatosIndOperativo',
                id:'gresumen',
                name:'gresumen'
            }
        ]
    });
    }
}

function cargarWinfact()
{
    if (!winIndicadorFact) {        
        winIndicadorFact = Ext.create('Ext.window.Window', {
            title: 'Resumen de Datos',
            header: {
                titlePosition: 2,
                titleAlign: 'center'
            },
            closable: true,
            closeAction: 'hide',
            maximizable: true,            
            width: 800,
            minWidth: 350,
            height: 550,
            tools: [{type: 'pin'}
            ],
            layout: {            
                padding: 5
            },
            autoScroll: true,
            
            items: [
                {
                    xtype:'Colsys.FalabellaAdu.GridDatosIndFact',
                    id:'gresumenfact',
                    name:'gresumenfact'
                }
            ]
        });
    }
}


function columnasgrid(tipo,title1)
{

    if(tipo=="Fact1" || tipo=="Fact2" || tipo=="Fact3")
    {
        return columnsbasic= [
         
            {text: 'Total Referencias', width: 150, dataIndex: 'total_carpeta', summaryType: 'sum',sortable: true,
                renderer: function(value,metaData,record,rowIndex,colIndex,store,view) {                    
                    if(value!="" && value!="null")
                        return '<a href="javascript:callFunction(1,\''+tipo+'\')" >'+value+'</a>';
                    else
                        return '';
                }

            },
            {text: "Total Demora", width: 120 , dataIndex: 'total_demora', sortable: true,
                renderer: function(value,metaData,record,rowIndex,colIndex,store,view) {
                    if(value!="0")
                        return '<a href="javascript:callFunction(2,\''+tipo+'\')" >'+value+'</a>';
                    else
                        return '0';
                },
                summaryType: function(records){
                    var i = 0,
                        length = records.length,
                        totalcarpeta = 0,
                        totaldemora = 0,
                        record;
                    for (; i < length; ++i) {
                        record = records[i];
                        totaldemora += parseInt(record.get('total_demora'));
                    }                
                    return Ext.util.Format.number(totaldemora,'0');
                }
            },
            {text: "% Demora", width: 125, dataIndex: 'por_demora', sortable: true,
                summaryType: function(records){
                    var i = 0,
                        length = records.length,
                        totalcarpeta = 0,
                        totaldemora = 0,
                        record;
                    for (; i < length; ++i) {
                        record = records[i];
                        totalcarpeta += parseInt(record.get('total_carpeta'));
                        totaldemora += parseInt(record.get('total_demora'));
                    }
                    return Ext.util.Format.number((totaldemora*100)/totalcarpeta,'0.0');
                }
            }
        ]
    }
    else
    {
        return columnsbasic= [
            {text: ((title1!="" && tipo=="Desc")?title1:"Terminal"), width: 120, dataIndex: 'terminal', sortable: true,
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return "Total";
                }
            },
            {text: ((title1!="" && tipo!="Desc")?title1:"Total carpetas"), width: 120, dataIndex: 'total_carpeta', summaryType: 'sum',sortable: true,
                renderer: function(value,metaData,record,rowIndex,colIndex,store,view) {
                    //console.log("total:"+value);
                    if(value!="" && value!="null")
                        return '<a href="javascript:callFunction(\''+record.get('terminal')+'\',\''+tipo+'1\')" >'+value+'</a>';
                    else
                        return '';
                }
            },
            {text: ((tipo=="BL")?"Total BLs":"Total Demora"), width: 120 , dataIndex: 'total_demora', sortable: true,
                renderer: function(value,metaData,record,rowIndex,colIndex,store,view) {
                    if(value!="0")
                        return '<a href="javascript:callFunction(\''+record.get('terminal')+'\',\''+tipo+'\')" >'+value+'</a>';
                    else
                        return '0';
                },
                summaryType: function(records){
                    var i = 0,
                        length = records.length,
                        totalcarpeta = 0,
                        totaldemora = 0,
                        record;
                    for (; i < length; ++i) {
                        record = records[i];
                        totaldemora += parseInt(record.get('total_demora'));
                    }                
                    return Ext.util.Format.number(totaldemora,'0');
                }
            },

            {text: ((tipo=="BL")?"% Bls":"% Demora"), width: 125, dataIndex: 'por_demora', sortable: true,
                summaryType: function(records){
                    var i = 0,
                        length = records.length,
                        totalcarpeta = 0,
                        totaldemora = 0,
                        record;
                    for (; i < length; ++i) {
                        record = records[i];

                        totalcarpeta += parseInt(record.get('total_carpeta'));
                        totaldemora += parseInt(record.get('total_demora'));
                    }                
                    return Ext.util.Format.number((totaldemora*100)/totalcarpeta,'0.0');
                }
            }
        ]
    }
}

function callFunction(data,tipo)
{
    if(tipo=="Fact1" || tipo=="Fact2" || tipo=="Fact3")
    {
        cargarWinfact();
        winIndicadorFact.show();
        store=Ext.getCmp('gresumenfact').store;
        datosTemp=datosFact;
    }
    else
    {
        //console.log(data);
        cargarWin();
        winIndicador.show();
        store=Ext.getCmp('gresumen').store;
        datosTemp=datos;
    }
    
    var list = new Array();
    
    for(i=0;i<datosTemp.length;i++)
    {
        if(tipo=="Docs")
        {
            if(datosTemp[i].f_ca_muelle==data && datosTemp[i].demoradocs>0)
                list.push( datosTemp[i] );
        }
        else if(tipo=="Docs1")
        {
            if(datosTemp[i].f_ca_muelle==data)
                list.push( datosTemp[i] );                
        }
        else if(tipo=="Desc")
        {
            if(datosTemp[i].linea==data && datosTemp[i].atiempodm=="No")
                list.push( datosTemp[i] );
        }
        else if(tipo=="Desc1")
        {
            if(datosTemp[i].linea==data )
                list.push( datosTemp[i] );
        }
        else if(tipo=="Nal")
        {
            if(datosTemp[i].f_ca_muelle==data && datosTemp[i].consnal==1)
            {
                list.push( datosTemp[i] );
            }
        }
        else if(tipo=="Nal1")
        {
            if(datosTemp[i].f_ca_muelle==data && datosTemp[i].consnal==0)
                list.push( datosTemp[i] );
        }
        else if(tipo=="BL")
        {
            if(datosTemp[i].f_ca_muelle==data && datosTemp[i].diasbl>0)
                list.push( datosTemp[i] );
        }
        else if(tipo=="BL1")
        {
            if(datosTemp[i].f_ca_muelle==data )
                list.push( datosTemp[i] );
        }
        else if(tipo=="Fact1")
        {
            if(data=="2")
            {
                if(datosTemp[i].ind1=="No" )
                    list.push( datosTemp[i] );
            }
            else if(data=="1")
                list.push( datosTemp[i] );
            
        }
        else if(tipo=="Fact2")
        {
            if(data=="2")
            {
                if(datosTemp[i].ind2=="No" )
                    list.push( datosTemp[i] );
            }
            else if(data=="1")
                list.push( datosTemp[i] );
        }
        else if(tipo=="Fact3")
        {
            if(data=="2")
            {
                if(datosTemp[i].ind3=="No" )
                    list.push( datosTemp[i] );
            }
            else if(data=="1")
                list.push( datosTemp[i] );
        }
    }
    
    store.setData(list);
    console.log(list);
}

function callFunctionFact(data,tipo)
{
    cargarWinfact();
    winIndicador.show();
    store=Ext.getCmp('gresumen').store;
    var list = new Array();    
    for(i=0;i<datos.length;i++)
    {
        if(data=="Fact1" || data=="Fact2" || data=="Fact3")
        {
            list.push( datos[i] );
        }
    }
    store.setData(list);    
}
</script>