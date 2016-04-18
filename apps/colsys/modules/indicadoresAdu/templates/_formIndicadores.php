
<style type="text/css" media="screen">
        .x-grid-row-summary .x-grid-cell-inner {
            font-weight: bold;
            background-color: #138C56;            
        }
        
        .x-tab.x-tab-active.x-tab-default {
    background-color: #138C56;
    border-color: #000;
}
</style>
<script>
var winIndicador;
var datos=null;
var arrayColors=['#007D45','#736363','#4572A7', '#AA4643', '#89A54E'   , '#80699B', '#3D96AE'    , '#DB843D', '#92A8CD', '#A47D7C'    , '#B5CA92'   , '#0000FF'   , '#0066FF', '#00CCFF','#562F1E', '#AF7F24', '#263249'       , '#5F7F90'   , '#D9CDB6'  ];
var animate=true;
    // create the Data Store
//'#D63100','#BED600'  ,'#4572A7', '#AA4643', '#89A54E'   , '#80699B', '#3D96AE'    , '#DB843D', '#92A8CD', '#A47D7C'    , '#B5CA92'   , '#0000FF'   , '#0066FF', '#00CCFF','#562F1E', '#AF7F24', '#263249'       , '#5F7F90'   , '#D9CDB6'    
//rojo     , verde fal ,azul     ,vinotinto , verde pasto , morado   , azul tuquesa , naranja  , azul claro, rojo-morado , verde claro , azul oscuro , azul     , azul tur , cafe    , ocre     ,  azul reosucuro , azul claro2  , rosado claro          

//#736363 , #007D45    ,
//gris    , verde arau
    
 
Ext.define('FormIndicadores', {
    extend: 'Ext.form.Panel',
    title: 'Generación de Indicadores',
    id:'form-indicadores',
    layout: {
        type: 'table'
    },
    // The fields
    defaultType: 'textfield',
    items: [        
        {
            xtype:'Colsys.FalabellaAdu.FormFiltrosInd'
        }
    ],
    // Reset and Submit buttons
    buttons: [{
        text: 'Indicadores',
        handler: function() {
            idtab=Ext.getCmp("eta1").getRawValue()+"_"+Ext.getCmp("eta2").getRawValue();
            if(idtab=="_")
                idtab=Ext.getCmp("fecha1").getRawValue()+"_"+Ext.getCmp("fecha2").getRawValue();
            
            tabpanel= Ext.getCmp("tab-panel-id-indicadores");
            //alert(Ext.getCmp('region-west').collapsed);
            //Ext.getCmp('region-west').setCollapsed(true);
            if(!tabpanel.getChildByElement('tab'+idtab) )
            {
                Ext.Ajax.request({
                    url: '<?=url_for("/indicadoresAdu/datosPie")?>',
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
                            tipos= new Array()
                            for(i=0;i<1;i++)
                            {
                                for(var aux in res.contenedores[i])  
                                {
                                    if(aux!="tipo")
                                        tipos.push({
                                            type : 'column',
                                            dataIndex : aux,
                                            name : aux
                                        });
                                }
                            }
                            
                            tiposinsp= new Array()
                            for(i=0;i<1;i++)
                            {
                                for(var aux in res.declaracionesinsp[i])
                                {
                                    if(aux!="tipo")
                                        tiposinsp.push({
                                            type : 'column',
                                            dataIndex : aux,
                                            name : aux
                                        });
                                }
                            }
                            
                            
                            
                            tiposind1= new Array()
                            for(i=0;i<1;i++)
                            {
                                for(var aux in res.indicador1[i])
                                {
                                    if(aux!="tipo")
                                        tiposind1.push({
                                            type : 'column',
                                            dataIndex : aux,
                                            name : aux
                                        });
                                }
                            }
                            
                            tiposind3= new Array()
                            for(i=0;i<1;i++)
                            {
                                for(var aux in res.indicador3[i])
                                {
                                    if(aux!="tipo")
                                        tiposind3.push({
                                            type : 'column',
                                            dataIndex : aux,
                                            name : aux
                                        });
                                }
                            }
                            
                            tiposind4= new Array()
                            for(i=0;i<1;i++)
                            {
                                for(var aux in res.indicador4[i])
                                {
                                    if(aux!="tipo")
                                        tiposind4.push({
                                            type : 'column',
                                            dataIndex : aux,
                                            name : aux
                                        });
                                }
                            }
                            
                            coldeclaraciones= new Array()
                            for(i=1;i<2;i++)
                            {
                                for(var aux in res.declaracionesgrid[i])
                                {
                                        coldeclaraciones.push({                                            
                                            dataIndex : aux,
                                            text : aux ,                                            
                                            summaryType: ((aux!="TERMINAL")?'sum':'')                                            
                                        });
                                }
                            }
                            
                            coldeclaracionesinsp= new Array()
                            for(i=1;i<2;i++)
                            {
                                for(var aux in res.declaracionesinspgrid[i])
                                {
                                    coldeclaracionesinsp.push({
                                        dataIndex : aux,
                                        text : aux ,                                            
                                        summaryType: ((aux!="TERMINAL" && aux!="TIPO")?'sum':'')                                            
                                    });
                                }
                            }
                            
                            colind1= new Array();
                            for(i=1;i<2;i++)
                            {
                                for(var aux in res.indicador1grid[i])
                                {
                                    colind1.push({
                                        dataIndex : aux,
                                        text : aux ,                                            
                                        summaryType: ((aux!="TERMINAL" && aux!="TIPO")?'sum':'')                                            
                                    });
                                }
                            }
                            
                            colind3= new Array();
                            for(i=1;i<2;i++)
                            {
                                for(var aux in res.indicador3grid[i])
                                {
                                    colind3.push({
                                        dataIndex : aux,
                                        text : aux ,                                            
                                        summaryType: ((aux!="TERMINAL" && aux!="TIPO")?'sum':'')                                            
                                    });
                                }
                            }
                            
                            colind5= new Array();
                            for(i=0;i<res.indicador5grid.length;i++)
                            {
                                for(var aux in res.indicador5grid[i])
                                {
                                    colind5.push({
                                        dataIndex : aux,
                                        text : aux ,                                            
                                        summaryType: ((aux!="TERMINAL" && aux!="TIPO")?'sum':'')                                            
                                    });
                                }
                            }
                            //console.log(colind5);
                            
                            
                            /*colindicador4= new Array()
                            for(i=1;i<2;i++)
                            {
                                for(var aux in res.indicador4grid[i])
                                {
                                    colindicador4.push({
                                        dataIndex : aux,
                                        text : aux ,                                            
                                        summaryType: ((aux!="TERMINAL" && aux!="TIPO")?'sum':'')                                            
                                    });
                                }
                            }*/
                            //alert(colindicador4.toSource());
                            
                            
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
                    
                                Ext.create('Colsys.FalabellaAdu.PanelIndDet',{
                                    title: 'IDG NAL ',
                                    id:"panel-ind1"+idtab,                        
                                    items: [
                                    {
                                        xtype: 'highchart',
                                        id:'hcind1'+idtab,
                                        name:'hcind1'+idtab,
                                        store: Ext.data.JsonStore({                        
                                            fields: ['tipo'],
                                            proxy: {
                                                url: '<?=url_for("/indicadoresAdu/datosGrafica")?>',
                                                extraParams: {
                                                        datos:JSON.stringify(res.indicador1)
                                                    },
                                                type: 'ajax',                            
                                                reader: {                                        
                                                     type: 'json',
                                                     rootProperty: 'root'
                                                }                            
                                            },
                                            autoLoad: true
                                        }),
                                        series : tiposind1,
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
                                                text : 'Indicador de gestión Arauco - Colmas',
                                                x : -20 
                                            },
                                            subtitle : {
                                                text : "Sin ICA 3 dias - Con ICA 4 dias",
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
                                        id:'gind1'+idtab,
                                        name:'gind1'+idtab,
                                        columns: colind1
                                    }                            
                                    ]
                                }),
                                Ext.create('Colsys.FalabellaAdu.PanelIndDet',{                    
                                    title: 'DIAS ',
                                    id:"panel-ind4"+idtab,                        
                                    items: [
                                    {
                                        xtype: 'highchart',
                                        id:'hcind4'+idtab,
                                        name:'hcind4'+idtab,
                                        store: Ext.data.JsonStore({                        
                                            fields: ['tipo'],
                                            proxy: {
                                                url: '<?=url_for("/indicadoresAdu/datosGrafica")?>',
                                                extraParams: {
                                                        datos:JSON.stringify(res.indicador4)
                                                    },
                                                type: 'ajax',                            
                                                reader: {                                        
                                                     type: 'json',
                                                     rootProperty: 'root'
                                                }                            
                                            },
                                            autoLoad: true
                                        }),
                                        series : tiposind4,
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
                                                    depth: 25//,
                                                    //stacking: 'percent'
                                                }                                    
                                            },
                                            title : {
                                                text : 'Resumen Dias',
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
                                                    text : 'Dias '
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
                                        id:'gind4'+idtab,
                                        name:'gind4'+idtab,
                                        columns: [
                                            {text: "DIA", width: 120, dataIndex: 'DIA',sortable: true,
                                                summaryRenderer: function(value, summaryData, dataIndex) {
                                                    return "Total";
                                                }},
                                            {text: "SIN ICA", width: 120, dataIndex: 'SIN ICA', summaryType: 'sum',sortable: true},
                                            {text: "CON ICA", width: 120 , dataIndex: 'CON ICA', summaryType: 'sum',sortable: true}
                                        ]
                                    }
                                    ]
                                })
                                ,
                    
                                Ext.create('Colsys.FalabellaAdu.PanelIndDet',{
                                    title: 'IDG PLANILLAS ',
                                    id:"panel-ind3f"+idtab,                        
                                    items: [
                                    {
                                        xtype: 'highchart',
                                        id:'hcind3'+idtab,
                                        name:'hcind3'+idtab,
                                        store: Ext.data.JsonStore({                        
                                            fields: ['tipo'],
                                            proxy: {
                                                url: '<?=url_for("/indicadoresAdu/datosGrafica")?>',
                                                extraParams: {
                                                        datos:JSON.stringify(res.indicador1)
                                                    },
                                                type: 'ajax',                            
                                                reader: {                                        
                                                     type: 'json',
                                                     rootProperty: 'root'
                                                }                            
                                            },
                                            autoLoad: true
                                        }),
                                        series : tiposind3,
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
                                                text : 'Indicador de Gestion Entrega de Planillas al transporte',
                                                x : -20 
                                            },
                                            subtitle : {
                                                text : "1 dia a partir de la fecha de levante hasta la entrega de planillas al transporte",
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
                                                    text : 'Cantidad DO/BL '
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
                                        id:'gind3'+idtab,
                                        name:'gind3'+idtab,
                                        columns: colind3
                                    }                            
                                    ]
                                }),

            ///////////////////////////INDICADOR DE DOCUMENTOS/////////////////////////////////////////////////////
                                Ext.create('Colsys.FalabellaAdu.PanelIndDet',{
                                    //title: 'DOCUMENTOS ORIGINALES',
                                    id:"panel-declant"+idtab,
                                    items: [
                                        grafica({id:'hcd'+idtab,title:'Declaraciones Anticipadas vs Iniciales',datos:JSON.stringify(res.declaraciones),nameSerie:'Referencias'}),
                                        {
                                            xtype:'Colsys.FalabellaAdu.GridDatosIndDet',
                                            id:'gd'+idtab,
                                            name:'gd'+idtab,
                                            columns: coldeclaraciones
                                        }                         
                                    ]
                                }),


            ///////////////////////////declaraciones inspeccion/////////////////////////////////////////////////////
                                Ext.create('Colsys.FalabellaAdu.PanelIndDet',{                    
                                    title: 'DECLARACIONES ',
                                    id:"panel-insp"+idtab,                        
                                    items: [
                                    {
                                        xtype: 'highchart',
                                        id:'hcinsp'+idtab,
                                        name:'hcinsp'+idtab,
                                        store: Ext.data.JsonStore({                        
                                            fields: ['tipo'],
                                            proxy: {
                                                url: '<?=url_for("/indicadoresAdu/datosGrafica")?>',
                                                extraParams: {
                                                        datos:JSON.stringify(res.declaracionesinsp)
                                                    },
                                                type: 'ajax',                            
                                                reader: {                                        
                                                     type: 'json',
                                                     rootProperty: 'root'
                                                }                            
                                            },
                                            autoLoad: true
                                        }),
                                        series : tiposinsp,
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
                                                    depth: 25//,
                                                    //stacking: 'percent'
                                                }                                    
                                            },
                                            title : {
                                                text : 'Analisis declaracion por inspeccion',
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
                                        id:'ginsp'+idtab,
                                        name:'ginsp'+idtab,
                                        columns: coldeclaracionesinsp
                                    }                        
                                    ]
                                }),

            ///////////////////////////CONTENEDORES/////////////////////////////////////////////////////
                                Ext.create('Colsys.FalabellaAdu.PanelIndDet',{                    
                                    title: 'REPORTE CONTENEDORES VS  TERMINAL PORTUARIO',
                                    id:"panel-con"+idtab,                        
                                    items: [
                                    {
                                        xtype: 'highchart',
                                        id:'hccon'+idtab,
                                        name:'hccon'+idtab,
                                        store: Ext.data.JsonStore({                        
                                            fields: ['tipo'],
                                            proxy: {
                                                url: '<?=url_for("/indicadoresAdu/datosGrafica")?>',
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
                                        series : tipos,
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
                                                    depth: 25//,
                                                    //stacking: 'percent'
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
                                                    text : 'Cantidad Contenedores'
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
                                            {text: "Do's", width: 120 , dataIndex: 'referencias', summaryType: 'sum',sortable: true},
                                            {text: "%", width: 120 , dataIndex: 'por_referencias', summaryType: 'sum',sortable: true}
                                        ]
                                    }
                                    ]
                                }),
                                
                                Ext.create('Colsys.FalabellaAdu.PanelIndDet',{
                                    //title: 'DOCUMENTOS ORIGINALES',
                                    id:"panel-ind5"+idtab,
                                    items: [
                                        graficaLineas({id:'hind5'+idtab,title:'Tendencia contenedores',datos:JSON.stringify(res.indicador5),nameSerie:'NoContenedores',titleY:'No Contenedores'})
                                        ,
                                        {
                                            xtype:'Colsys.FalabellaAdu.GridDatosIndDet',
                                            id:'gind5'+idtab,
                                            name:'gind5'+idtab,
                                            columns: colind5
                                        }
                                    ]
                                }),
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
                                            
                
                            store=Ext.getCmp('gind1'+idtab).store;
                            store.loadData(res.indicador1grid);

                            store=Ext.getCmp('gind3'+idtab).store;
                            store.loadData(res.indicador3grid);
                            
                            store=Ext.getCmp('gind4'+idtab).store;
                            store.loadData(res.indicador4grid);
                            
                            store=Ext.getCmp('gind5'+idtab).store;
                            store.loadData(res.indicador5grid);


                            store=Ext.getCmp('gcon'+idtab).store;
                            store.loadData(res.contenedoresgrid);

                            store=Ext.getCmp('ginsp'+idtab).store;
                            store.loadData(res.declaracionesinspgrid);

                            store=Ext.getCmp('gd'+idtab).store;
                            store.loadData(res.declaracionesgrid);
                        }
                    },
                    failure: function(response, opts) {
                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                    }
                });
            }
            tabpanel.setActiveTab('tab'+idtab);
        }
    }]
});


function graficaLineas(obj)
{
    return Ext.create('Colsys.Chart.Line',{
        id: obj.id,
        name:obj.id,
        datos:obj.datos,
        title:obj.title,
        subtitle:obj.subtitle,
        titleY:obj.titleY,
        url: '<?=url_for("/falabellaAdu2/datosGrafica")?>',
        series: [
            {
                type: 'line',
                name: (obj.nameSerie)?obj.nameSerie:'Carpetas',
                //categorieField: 'indicador',
                //dataField: 'total'
                yField: 'total',
                xField: 'indicador'
            }
        ]
    });
}

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
                name: (obj.nameSerie)?obj.nameSerie:'Carpetas',
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
                url: '<?=url_for("/indicadoresAdu/datosGrafica")?>',
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
                    depth: 25//,
                    //stacking: 'percent'
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
        //winIndicador = Ext.create('widget.window', {
        winIndicador = Ext.create('Ext.window.Window', {
            title: 'Resumen de Datos',
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
            tools: [{type: 'pin'}/*                
            {
                xtype: 'exporterbutton',
                text: 'Exportar CSV',
                iconCls: 'csv'
            }*/
            
        
            ],
            layout: {
            //    type: 'border',
                padding: 5
            },
            autoScroll: true,
            
        items: [
            Ext.create('Ext.grid.Panel', {
                id:'gresumen',
                name:'gresumen',
                bufferedRenderer: true,                
                store: Ext.data.JsonStore({                        
                    fields: [
                    ],
                    proxy: {
                        type: 'ajax',                            
                        reader: {
                             type: 'json',
                             rootProperty: 'root'
                        }                            
                    },
                    autoLoad: false
                }),
                tbar : [
                {
                    xtype: 'exporterbutton',
                    text: 'Exportar CSV',
                    iconCls: 'csv'
                }
                ],
                columns: [
                    {text: "D.O.",                  dataIndex: 'c_ca_referencia',         sortable: true,                                 width:115},
                    {text: "Preins",                dataIndex: 'c_ca_preinspeccion',      sortable: true, xtype : 'checkcolumn',          width:30},
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
                split: true
            })

        ]

    });
    }
}


function columnasgrid(tipo,title1)
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
        {text: "Total Demora", width: 120 , dataIndex: 'total_demora', sortable: true,
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

function callFunction(data,tipo)
{
    cargarWin();
    winIndicador.show();
    store=Ext.getCmp('gresumen').store;
    var list = new Array();
    
    for(i=0;i<datos.length;i++)
    {
        if(tipo=="Docs")
        {
            if(datos[i].f_ca_muelle==data && datos[i].demoradocs>0)
                list.push( datos[i] );
            //store.add(datos[i]);
                
        }
        else if(tipo=="Docs1")
        {
            if(datos[i].f_ca_muelle==data)
                list.push( datos[i] );
            //store.add(datos[i]);
                
        }
        else if(tipo=="Desc")
        {
            if(datos[i].linea==data && datos[i].atiempodm=="No")
                list.push( datos[i] );
        }
        else if(tipo=="Desc1")
        {
            if(datos[i].linea==data )
                list.push( datos[i] );
        }
        else if(tipo=="Nal")
        {
            
            if(datos[i].f_ca_muelle==data && datos[i].consnal==1)
            {
                //alert(datos[i].consnal);
                list.push( datos[i] );
            }
            /*if(datos[i].f_ca_muelle==data && (datos[i].c_ca_preinspeccion ==true || datos[i].c_ca_inspeccion==true )  )
            {
                if(datos[i].diasnalhab>4)
                    list.push( datos[i] );
            }
            else
            {
                if(datos[i].diasnalhab>2)
                    list.push( datos[i] );
            }*/
        }
        else if(tipo=="Nal1")
        {
            //list.push( datos[i] );
            if(datos[i].f_ca_muelle==data && datos[i].consnal==0)
                list.push( datos[i] );
            /*if(datos[i].f_ca_muelle==data)
            {
                if(datos[i].diasnalhab>4)
                    list.push( datos[i] );
            }
            else
            {
                if(datos[i].diasnalhab>2)
                    list.push( datos[i] );
            }*/ 
            
        }
        else if(tipo=="BL")
        {
            if(datos[i].f_ca_muelle==data && datos[i].diasbl>0)
                list.push( datos[i] );
        }
        else if(tipo=="BL1")
        {
            //console.log(datos[i].f_ca_muelle+":::"+data)
            if(datos[i].f_ca_muelle==data )
                list.push( datos[i] );
        }
    }
    store.setData(list);    
}

</script>
