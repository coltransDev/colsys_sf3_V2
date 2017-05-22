<?
$fields = $sf_data->getRaw("fields");
/* echo "<pre>";
  print_r($fields);
  echo "</pre>";
  exit; */
//echo json_encode($fields);
//exit;
?>
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
    var datos = null;
    var arrayColors = ['#007D45', '#736363', '#4572A7', '#AA4643', '#89A54E', '#80699B', '#3D96AE', '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92', '#0000FF', '#0066FF', '#00CCFF', '#562F1E', '#AF7F24', '#263249', '#5F7F90', '#D9CDB6'];
    var animate = true;

    Ext.define('FormIndicadores', {
        extend: 'Ext.form.Panel',
        title: 'Generación de Indicadores',
        id: 'form-indicadores',
        layout: {
            type: 'table'
        },
        // The fields
        defaultType: 'textfield',
        items: [
            {
                xtype: 'Colsys.FalabellaAdu.FormFiltrosInd'
            }
        ],
        // Reset and Submit buttons
        buttons: [{
                text: 'Indicadores',
                handler: function () {
                    idtab = Ext.getCmp("eta1").getRawValue() + "_" + Ext.getCmp("eta2").getRawValue();
                    if (idtab == "_")
                        idtab = Ext.getCmp("fecha1").getRawValue() + "_" + Ext.getCmp("fecha2").getRawValue();

                    tabpanel = Ext.getCmp("tab-panel-id-indicadores");
                    if (!tabpanel.getChildByElement('tab' + idtab))
                    {
                        Ext.Ajax.request({
                            url: '<?=$pref?>/indicadoresAdu/datosPie',
                            params: {
                                fecha1: Ext.getCmp("fecha1").getRawValue(),
                                fecha2: Ext.getCmp("fecha2").getRawValue(),
                                eta1: Ext.getCmp("eta1").getRawValue(),
                                eta2: Ext.getCmp("eta2").getRawValue()
                            },
                            success: function (response, opts) {
                                var res = Ext.decode(response.responseText);
                                datos = res.datos;
                                if (res.success)
                                {

//console.log(res.contenedores);
//console.log(res.indicador6);

                                    tipos = new Array();

                                    for (i = 0; i < 1; i++)
                                    {
                                        for (var auxT in res.contenedores[i])
                                        {
                                            //Analisis por terminal portuaria
                                            if (auxT != "tipo")
                                                tipos.push({
                                                    type: 'column',
                                                    dataIndex: auxT,
                                                    name: auxT,
                                                    renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                                        var field = view.getHeaderAtIndex(colIndex).dataIndex;

                                                        if (value != "" && value != "null") {
                                                            if (colIndex != 0) {
                                                                return '<a href="javascript:mostrardatos(4,\'' + record.get("TERMINAL") + '\',\'' + field + '\')" >' + value + '</a>';
                                                                //return aux1;
                                                            } else {
                                                                return value;
                                                            }
                                                        } else
                                                            return '0';
                                                    }
                                                });
                                        }
                                    }

                                    tiposinsp = new Array()
                                    for (i = 0; i < 1; i++)
                                    {
                                        for (var aux in res.declaracionesinsp[i])
                                        {
                                            if (aux != "tipo")
                                                tiposinsp.push({
                                                    type: 'column',
                                                    dataIndex: aux,
                                                    name: aux
                                                });
                                        }
                                    }



                                  /*  tiposind1 = new Array()
                                    for (i = 0; i < 1; i++)
                                    {
                                        for (var aux in res.indicador1[i])
                                        {
                                            if (aux != "tipo")
                                                tiposind1.push({
                                                    type: 'column',
                                                    dataIndex: aux,
                                                    name: aux
                                                });
                                        }
                                    }*/
                                    tiposind1 = new Array()
                                    for (i = 0; i < 1; i++)
                                    {
                                        for (var aux in res.indicador1[i])
                                        {
                                            if (aux != "tipo")
                                                tiposind1.push({
                                                    type: 'column',
                                                    dataIndex: aux,
                                                    name: aux
                                                });
                                        }
                                    }

                                    tiposind3 = new Array();
                                    for (i = 0; i < 1; i++)
                                    {
                                        for (var aux in res.indicador3[i])
                                        {
                                            if (aux != "tipo")
                                                tiposind3.push({
                                                    type: 'column',
                                                    dataIndex: aux,
                                                    name: aux
                                                });
                                        }
                                    }
/*                                    tiposind6 = new Array();
                                    for (i = 0; i < 1; i++)
                                    {
                                        for (var aux in res.indicador6[i])
                                        {
                                            if (aux != "tipo")
                                                tiposind6.push({
                                                    type: 'column',
                                                    dataIndex: aux,
                                                    name: aux
                                                });
                                        }
                                    }
*/
				//tiposind6=[{type:'column',dataIndex:'CON ICA',name:'CON ICA'},{type:'column',dataIndex:'SIN ICA',name:'SIN ICA'}];
//tiposind6=[{type:'column',dataIndex:'dias',name:'dias'}];
tiposind6=[{type:'column',dataIndex:'CON ICA',name:'CON ICA'}];
					

                                    tiposind4 = new Array()
                                    for (i = 0; i < 1; i++)
                                    {
                                        for (var aux in res.indicador4[i])
                                        {
                                            if (aux != "tipo")
                                                tiposind4.push({
                                                    type: 'column',
                                                    dataIndex: aux,
                                                    name: aux
                                                });
                                        }
                                    }
//console.log(tipos);
//console.log(tiposind6);

                                    coldeclaraciones = new Array();
                                    for (i = 1; i < 2; i++)
                                    {
                                        //var aux1 = "";

                                        for (var aux1 in res.declaracionesgrid[i])
                                        {
                                            temporal = aux1;
                                            coldeclaraciones.push({
                                                dataIndex: aux1,
                                                text: aux1,
                                                f: aux1,
                                                summaryType: ((aux1 != "TERMINAL") ? 'sum' : ''),
                                                //declaraciones anticipadas vs iniciales 
                                                renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                                    var field = view.getHeaderAtIndex(colIndex).dataIndex;

                                                    if (value != "" && value != "null") {
                                                        if (colIndex != 0) {
                                                            return '<a href="javascript:mostrardatos(3,\'' + record.get("TERMINAL") + '\',\'' + field + '\')" >' + value + '</a>';
                                                            //return aux1;
                                                        } else {
                                                            return value;
                                                        }
                                                    } else
                                                        return '0';
                                                }
                                            });
                                            if (aux1 == "TERMINAL"){
                                                coldeclaraciones[(coldeclaraciones.length) - 1].summaryRenderer = function (value, summaryData, dataIndex) {
                                                    return "Total";
                                                }
                                            }
                                            aux1 = "";
                                        }
                                        
                                    }

                                    coldeclaracionesinsp = new Array();
                                    for (i = 1; i < 2; i++)
                                    {
                                        for (var aux in res.declaracionesinspgrid[i])
                                        {
                                            //Declaraciones Anticipadas vs Iniciales
                                            coldeclaracionesinsp.push({
                                                dataIndex: aux,
                                                text: aux,
                                                summaryType: ((aux != "TERMINAL" && aux != "TIPO") ? 'sum' : '')
                                            });
                                        }
                                    }


                                    colind1 = new Array();
                                    for (i = 1; i < 2; i++)
                                    {
                                        for (var aux in res.indicador1grid[i])
                                        {
                                            colind1.push({
                                                dataIndex: aux,
                                                text: aux,
                                                summaryType: ((aux != "TERMINAL" && aux != "TIPO") ? 'sum' : 'Total'),
                                    
                                                renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                                    //Indicador de gestión Arauco - Colmas
                                                    if (value != "" && value != "null") {
                                                        if (value != "SIN ICA" && value != "CON ICA") {
                                                            if (rowIndex == 0 && colIndex == 1) {
                                                                return '<atipos href="javascript:mostrardatos(1,\'SIN ICA\',\'1\')" >' + value + '</a>';
                                                            }
                                                            if (rowIndex == 0 && colIndex == 2) {
                                                                return '<a href="javascript:mostrardatos(1,\'SIN ICA\',\'0\')" >' + value + '</a>';
                                                            }
                                                            if (rowIndex == 1 && colIndex == 1) {
                                                                return '<a href="javascript:mostrardatos(1,\'CON ICA\',\'1\')" >' + value + '</a>';
                                                            }
                                                            if (rowIndex == 1 && colIndex == 2) {
                                                                return '<a href="javascript:mostrardatos(1,\'CON ICA\',\'0\')" >' + value + '</a>';
                                                            }
                                                        } else {
                                                            return value;
                                                        }
                                                    } else
                                                        return '0';
                                                }
                                            });
                                            if (aux == "TIPO"){
                                                colind1[(colind1.length) - 1].summaryRenderer = function (value, summaryData, dataIndex) {
                                                    return "Total";
                                                }
                                            }
                                        }
                                    }
                                    colind6 = new Array();
                                    for (i = 0; i < res.indicador6grid.length; i++)
                                    {
                                        for (var aux in res.indicador6grid[i])
                                        {
                                            colind6.push({
                                                dataIndex: aux,
                                                text: aux,
                                                summaryType: null,
                                                renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                                    //promedio de dias
                                                    var field = view.getHeaderAtIndex(colIndex).dataIndex;

                                                    if (value != "" && value != "null") {
                                                        return '<a href="javascript:mostrardatos(7,\'' + "vacio" + '\',\'' + field + '\')" >' + value + '</a>';
                                                    } else
                                                        return '0';
                                                }
                                            });
                                        }
                                    }
                                    
                                    colind3 = new Array();
                                    for (i = 1; i < 2; i++)
                                    {
                                        for (var aux in res.indicador3grid[i])
                                        {
                                            colind3.push({
                                                dataIndex: aux,
                                                text: aux,
                                                summaryType: ((aux != "TERMINAL" && aux != "TIPO") ? 'sum' : ''),
                                                renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                                    if (value != "" && value != "null") {
                                                        //indicador de gestion entrega de plantillas al transporte
                                                        if (value != "SIN ICA" && value != "CON ICA") {

                                                            if (rowIndex == 0 && colIndex == 1) {
                                                                return '<a href="javascript:mostrardatos(2,\'SIN ICA\',\'cumple\')" >' + value + '</a>';
                                                            }
                                                            if (rowIndex == 0 && colIndex == 2) {
                                                                return '<a href="javascript:mostrardatos(2,\'SIN ICA\',\'NoCumple\')" >' + value + '</a>';
                                                            }
                                                            if (rowIndex == 1 && colIndex == 1) {
                                                                return '<a href="javascript:mostrardatos(2,\'CON ICA\',\'cumple\')" >' + value + '</a>';
                                                            }
                                                            if (rowIndex == 1 && colIndex == 2) {
                                                                return '<a href="javascript:mostrardatos(2,\'CON ICA\',\'NoCumple\')" >' + value + '</a>';
                                                            }



                                                        } else {
                                                            return value;
                                                        }
                                                    } else
                                                        return '0';
                                                }
                                            });
                                            if (aux == "TIPO"){
                                                colind3[(colind3.length) - 1].summaryRenderer = function (value, summaryData, dataIndex) {
                                                    return "Total";
                                                }
                                            }
                                        }
                                    }

                                    colind5 = new Array();
                                    for (i = 0; i < res.indicador5grid.length; i++)
                                    {
                                        for (var aux in res.indicador5grid[i])
                                        {
                                            colind5.push({
                                                dataIndex: aux,
                                                text: aux,
                                                summaryType: ((aux != "TERMINAL" && aux != "TIPO") ? 'sum' : ''),
                                                renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                                    //tendencia contenedores
                                                    var field = view.getHeaderAtIndex(colIndex).dataIndex;

                                                    if (value != "" && value != "null") {
                                                        return '<a href="javascript:mostrardatos(5,\'' + "vacio" + '\',\'' + field + '\')" >' + value + '</a>';
                                                    } else
                                                        return '0';
                                                }

                                            });
                                        }
                                    }


                                    /*colindicador4= new Array()
                                     for(i=1;i<2;i++)
                                     {
                                     for(var aux in res.indicador4grid[i])
                                     {
                                     colindicador4.push({
                                     dataIndex : aux,https://lh3.googleusercontent.com/-yYykb3re9c8/AAAAAAAAAAI/AAAAAAAAAAw/VIc8E3xlPMc/s46-c-k-no/photo.jpg
                                     text : aux ,                                            
                                     summaryType: ((aux!="TERMINAL" && aux!="TIPO")?'sum':'')                                            
                                     });
                                     }
                                     }*/
                                    //alert(colindicador4.toSource());
//console.log(JSON.stringify(res.contenedores));

                                    obj = [
                                        ///////////////////ENCABEZADOS////////////////////////////////

                                        Ext.create('Ext.panel.Panel', {
                                            title: 'REPORTE DE OPERACIONES',
                                            titleAlign: 'center',
                                            id: "panel-operaciones" + idtab,
                                            html: res.encabezados,
                                            bodyStyle: {
                                                align: 'center',
                                                padding: '10px'
                                            }
                                        }),
                                        Ext.create('Colsys.FalabellaAdu.PanelIndDet', {
                                            title: 'IDG NAL ',
                                            id: "panel-ind1" + idtab,
                                            items: [
                                                {
                                                    xtype: 'highchart',
                                                    id: 'hcind1' + idtab,
                                                    name: 'hcind1' + idtab,
                                                    store: Ext.data.JsonStore({
                                                        fields: ['tipo'],
                                                        proxy: {
							    url: '<?=$pref?>/indicadoresAdu/datosGrafica',
                                                            extraParams: {
                                                                datos: JSON.stringify(res.indicador1)
                                                            },
                                                            type: 'ajax',
                                                            reader: {
                                                                type: 'json',
                                                                rootProperty: 'root'
                                                            }
                                                        },
                                                        autoLoad: true
                                                    }),
                                                    series: tiposind1,
                                                    height: 500,
                                                    width: 700,
                                                    xField: 'tipo',
                                                    chartConfig: {
                                                        colors: arrayColors,
                                                        chart: {
                                                            renderer: 'SVG',
                                                            marginRight: 130,
                                                            marginBottom: 120,
                                                            zoomType: 'x',
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
                                                        title: {
                                                            text: 'Indicador de gestión Arauco - Colmas',
                                                            x: -20
                                                        },
                                                        subtitle: {
                                                            text: "Sin ICA 3 dias - Con ICA 4 dias",
                                                            x: -20
                                                        },
                                                        xAxis: [{
                                                                title: {
                                                                    text: 'Tipo',
                                                                    margin: 20
                                                                },
                                                                labels: {
                                                                    rotation: 270,
                                                                    y: 35
                                                                }
                                                            }],
                                                        yAxis: {
                                                            title: {
                                                                text: 'Cantidad '
                                                            },
                                                            plotLines: [{
                                                                    value: 0,
                                                                    width: 1,
                                                                    color: '#808080'
                                                                }]
                                                        },
                                                        tooltip: {
                                                            pointFormat: '<span style="color:{series.color}"><b>{series.name}</b></span>: <b>{point.y}</b><br/>',
                                                            shared: true

                                                        },
                                                        legend: {
                                                            layout: 'vertical',
                                                            align: 'right',
                                                            verticalAlign: 'top',
                                                            x: -10,
                                                            y: 100,
                                                            borderWidth: 0
                                                        }
                                                    }
                                                },
                                                {
                                                    xtype: 'Colsys.FalabellaAdu.GridDatosIndDet',
                                                    id: 'gind1' + idtab,
                                                    name: 'gind1' + idtab,
                                                    columns: colind1
                                                }
                                            ]
                                        }),
                                        Ext.create('Colsys.FalabellaAdu.PanelIndDet', {
                                            title: 'IDG PLANILLAS ',
                                            id: "panel-ind3f" + idtab,
                                            items: [
                                                {
                                                    xtype: 'highchart',
                                                    id: 'hcind3' + idtab,
                                                    name: 'hcind3' + idtab,
                                                    store: Ext.data.JsonStore({
                                                        fields: ['tipo'],
                                                        proxy: {
                                                            url: '<?=$pref?>/indicadoresAdu/datosGrafica',
                                                            extraParams: {
                                                                datos: JSON.stringify(res.indicador1)
                                                            },
                                                            type: 'ajax',
                                                            reader: {
                                                                type: 'json',
                                                                rootProperty: 'root'
                                                            }
                                                        },
                                                        autoLoad: true
                                                    }),
                                                    series: tiposind3,
                                                    height: 500,
                                                    width: 700,
                                                    xField: 'tipo',
                                                    chartConfig: {
                                                        colors: arrayColors,
                                                        chart: {
                                                            renderer: 'SVG',
                                                            marginRight: 130,
                                                            marginBottom: 120,
                                                            zoomType: 'x',
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
                                                        title: {
                                                            text: 'Indicador de Gestion Entrega de Planillas al transporte',
                                                            x: -20
                                                        },
                                                        subtitle: {
                                                            text: "1 dia a partir de la fecha de levante hasta la entrega de planillas al transporte",
                                                            x: -20
                                                        },
                                                        xAxis: [{
                                                                title: {
                                                                    text: 'Tipo',
                                                                    margin: 20
                                                                },
                                                                labels: {
                                                                    rotation: 270,
                                                                    y: 35
                                                                }
                                                            }],
                                                        yAxis: {
                                                            title: {
                                                                text: 'Cantidad DO/BL '
                                                            },
                                                            plotLines: [{
                                                                    value: 0,
                                                                    width: 1,
                                                                    color: '#808080'
                                                                }]
                                                        },
                                                        tooltip: {
                                                            pointFormat: '<span style="color:{series.color}"><b>{series.name}</b></span>: <b>{point.y}</b><br/>',
                                                            shared: true

                                                        },
                                                        legend: {
                                                            layout: 'vertical',
                                                            align: 'right',
                                                            verticalAlign: 'top',
                                                            x: -10,
                                                            y: 100,
                                                            borderWidth: 0
                                                        }
                                                    }
                                                },
                                                {
                                                    xtype: 'Colsys.FalabellaAdu.GridDatosIndDet',
                                                    id: 'gind3' + idtab,
                                                    name: 'gind3' + idtab,
                                                    columns: colind3
                                                }
                                            ]
                                        }),
                                        ///////////////////////////INDICADOR DE DOCUMENTOS/////////////////////////////////////////////////////
                                        Ext.create('Colsys.FalabellaAdu.PanelIndDet', {
                                            //title: 'DOCUMENTOS ORIGINALES',
                                            id: "panel-declant" + idtab,
                                            items: [
                                                grafica({id: 'hcd' + idtab, title: 'Declaraciones Anticipadas vs Iniciales', datos: JSON.stringify(res.declaraciones), nameSerie: 'Referencias'}),
                                                {
                                                    xtype: 'Colsys.FalabellaAdu.GridDatosIndDet',
                                                    id: 'gd' + idtab,
                                                    name: 'gd' + idtab,
                                                    columns: coldeclaraciones
                                                }
                                            ]
                                        }),
                                        ///////////////////////////CONTENEDORES/////////////////////////////////////////////////////
                                        Ext.create('Colsys.FalabellaAdu.PanelIndDet', {
                                            title: 'REPORTE CONTENEDORES VS  TERMINAL PORTUARIO',
                                            id: "panel-con" + idtab,
                                            items: [
                                                {
                                                    xtype: 'highchart',
                                                    id: 'hccon' + idtab,
                                                    name: 'hccon' + idtab,
                                                    store: Ext.data.JsonStore({
                                                        fields: ['tipo'],
                                                        proxy: {
                                                            url: '<?=$pref?>/indicadoresAdu/datosGrafica',
                                                            extraParams: {
                                                                datos: JSON.stringify(res.contenedores)
                                                            },
                                                            type: 'ajax',
                                                            reader: {
                                                                type: 'json',
                                                                rootProperty: 'root'
                                                            }
                                                        },
                                                        autoLoad: true
                                                    }),
                                                    series: tipos,
                                                    height: 500,
                                                    width: 700,
                                                    xField: 'tipo',
                                                    chartConfig: {
                                                        colors: arrayColors,
                                                        chart: {
                                                            renderer: 'SVG',
                                                            marginRight: 130,
                                                            marginBottom: 120,
                                                            zoomType: 'x',
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
                                                        title: {
                                                            text: 'Analisis por terminal portuaria',
                                                            x: -20
                                                        },
                                                        subtitle: {
                                                            text: "",
                                                            x: -20
                                                        },
                                                        xAxis: [{
                                                                title: {
                                                                    text: 'Tipo',
                                                                    margin: 20
                                                                },
                                                                labels: {
                                                                    rotation: 270,
                                                                    y: 35
                                                                }
                                                            }],
                                                        yAxis: {
                                                            title: {
                                                                text: 'Cantidad Contenedores'
                                                            },
                                                            plotLines: [{
                                                                    value: 0,
                                                                    width: 1,
                                                                    color: '#808080'
                                                                }]
                                                        },
                                                        tooltip: {
                                                            pointFormat: '<span style="color:{series.color}"><b>{series.name}</b></span>: <b>{point.y}</b><br/>',
                                                            shared: true

                                                        },
                                                        legend: {
                                                            layout: 'vertical',
                                                            align: 'right',
                                                            verticalAlign: 'top',
                                                            x: -10,
                                                            y: 100,
                                                            borderWidth: 0
                                                        }
                                                    }
                                                },
                                                {
                                                    xtype: 'Colsys.FalabellaAdu.GridDatosIndDet',
                                                    id: 'gcon' + idtab,
                                                    name: 'gcon' + idtab,
                                                    columns: [
                                                        {text: "Terminal", width: 120, dataIndex: 'terminal', sortable: true,
                                                            summaryRenderer: function (value, summaryData, dataIndex) {
                                                                return "Total";
                                                            }
                                                        },
                                                        {text: "Contenedores", width: 120, dataIndex: 'contenedor', summaryType: 'sum', sortable: true,
                                                            renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                                                var field = view.getHeaderAtIndex(colIndex).dataIndex;

                                                                if (value != "" && value != "null") {
                                                                    if (colIndex != 0) {
                                                                        return '<a href="javascript:mostrardatos(4,\'' + record.get("terminal") + '\',\'' + field + '\')" >' + value + '</a>';
                                                                        //return aux1;
                                                                    } else {
                                                                        return value;
                                                                    }
                                                                } else
                                                                    return '0';
                                                            }
                                                        },
                                                        {text: "%", width: 120, dataIndex: 'por_contenedor', summaryType: 'sum', sortable: true,
                                                            renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                                                var field = view.getHeaderAtIndex(colIndex).dataIndex;
                                                                 return value;
                                                                
                                                            }
                                                        },
                                                        {text: "Do's", width: 120, dataIndex: 'referencias', summaryType: 'sum', sortable: true,
                                                            renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                                                var field = view.getHeaderAtIndex(colIndex).dataIndex;
                                                                //return value;
                                                                if (value != "" && value != "null") {
                                                                 
                                                                        return '<a href="javascript:mostrardatos(4,\'' + record.get("terminal") + '\',\'' + field + '\')" >' + value + '</a>';
                                                                 
                                                                } else
                                                                    return '0';
                                                            }
                                                        },
                                                        {text: "%", width: 120, dataIndex: 'por_referencias', summaryType: 'sum', sortable: true,
                                                            renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                                                var field = view.getHeaderAtIndex(colIndex).dataIndex;
                                                                return value;

                                                            }
                                                        }
                                                    ]
                                                }
                                            ]
                                        }),
                                        Ext.create('Colsys.FalabellaAdu.PanelIndDet', {
                                            //title: 'DOCUMENTOS ORIGINALES',
                                            id: "panel-ind5" + idtab,
                                            items: [
                                                graficaLineas({id: 'hind5' + idtab, title: 'Tendencia contenedores', datos: JSON.stringify(res.indicador5), nameSerie: 'NoContenedores', titleY: 'No Contenedores'})
                                                        ,
                                                {
                                                    xtype: 'Colsys.FalabellaAdu.GridDatosIndDet',
                                                    id: 'gind5' + idtab,
                                                    name: 'gind5' + idtab,
                                                    columns: colind5
                                                }
                                            ]
                                        }),
                                        Ext.create('Colsys.FalabellaAdu.PanelIndDet', {
                                            title: 'DIAS ',
                                            id: "panel-ind4" + idtab,
                                            items: [
                                                {
                                                    xtype: 'highchart',
                                                    id: 'hcind4' + idtab,
                                                    name: 'hcind4' + idtab,
                                                    store: Ext.data.JsonStore({
                                                        fields: ['tipo'],
                                                        proxy: {
                                                            url: '<?=$pref?>/indicadoresAdu/datosGrafica',
                                                            extraParams: {
                                                                datos: JSON.stringify(res.indicador4)
                                                            },
                                                            type: 'ajax',
                                                            reader: {
                                                                type: 'json',
                                                                rootProperty: 'root'
                                                            }
                                                        },
                                                        autoLoad: true
                                                    }),
                                                    series: tiposind4,
                                                    height: 500,
                                                    width: 700,
                                                    xField: 'tipo',
                                                    chartConfig: {
                                                        colors: arrayColors,
                                                        chart: {
                                                            renderer: 'SVG',
                                                            marginRight: 130,
                                                            marginBottom: 120,
                                                            zoomType: 'x',
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
                                                                stacking: 'normal',
                                                                depth: 25,
                                                                //stacking: 'percent',
                                                                dataLabels: {
                                                                    enabled: true,
                                                                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                                                                    style: {
                                                                        textShadow: '0 0 3px black'
                                                                    }
                                                                }
                                                            }
                                                        },
                                                        title: {
                                                            text: 'Resumen Dias',
                                                            x: -20
                                                        },
                                                        subtitle: {
                                                            text: "",
                                                            x: -20
                                                        },
                                                        xAxis: [{
                                                                title: {
                                                                    text: 'Tipo',
                                                                    margin: 20
                                                                },
                                                                labels: {
                                                                    rotation: 270,
                                                                    y: 35
                                                                }
                                                            }],
                                                        yAxis: {
                                                            title: {
                                                                text: 'Dias '
                                                            },
                                                            plotLines: [{
                                                                    value: 0,
                                                                    width: 1,
                                                                    color: '#808080'
                                                                }],
                                                            stackLabels: {
                                                                enabled: true,
                                                                style: {
                                                                    fontWeight: 'bold',
                                                                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                                                                }
                                                            }
                                                        },
                                                        tooltip: {
                                                            pointFormat: '<span style="color:{series.color}"><b>{series.name}</b></span>: <b>{point.y}</b><br/>',
                                                            shared: true

                                                        },
                                                        legend: {
                                                            layout: 'vertical',
                                                            align: 'right',
                                                            verticalAlign: 'top',
                                                            x: -10,
                                                            y: 100,
                                                            borderWidth: 0
                                                        }
                                                    }
                                                },
                                                {
                                                    xtype: 'Colsys.FalabellaAdu.GridDatosIndDet',
                                                    id: 'gind4' + idtab,
                                                    name: 'gind4' + idtab,
                                                    columns: [
                                                        {text: "DIA", width: 120, dataIndex: 'DIA', sortable: true,
                                                            summaryRenderer: function (value, summaryData, dataIndex) {
                                                                return "Total";
                                                            }},
                                                        {text: "SIN ICA", width: 120, dataIndex: 'SIN ICA', summaryType: 'sum', sortable: true,
                                                            renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                                                var field = view.getHeaderAtIndex(colIndex).dataIndex;

                                                                if (value != "" && value != "null") {
                                                                    return '<a href="javascript:mostrardatos(6,\'' + record.get("DIA") + '\',\'' + field + '\')" >' + value + '</a>';
                                                                } else
                                                                    return '0';
                                                            }
                                                        },
                                                        {text: "CON ICA", width: 120, dataIndex: 'CON ICA', summaryType: 'sum', sortable: true,
                                                            renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                                                var field = view.getHeaderAtIndex(colIndex).dataIndex;

                                                                if (value != "" && value != "null") {
                                                                    return '<a href="javascript:mostrardatos(6,\'' + record.get("DIA") + '\',\'' + field + '\')" >' + value + '</a>';
                                                                } else
                                                                    return '0';
                                                            }
                                                        }
                                                    ]
                                                }
                                            ]
                                        }),
                                        Ext.create('Colsys.FalabellaAdu.PanelIndDet', {
                                            title: 'Promedio de Dias ',
                                            id: "panel-promedioDias" + idtab,
                                            items: [
                                                /*{
                                                    xtype: 'highchart',
                                                    id: 'hcind6' + idtab,
                                                    name: 'hcind6' + idtab,
                                                    store: Ext.data.JsonStore({
                                                        fields: ['tipo'],
                                                        proxy: {
                                                            url: '<?= url_for("/indicadoresAdu/datosGrafica") ?>',
                                                            extraParams: {
                                                                datos: JSON.stringify(res.indicador6)
                                                            },
                                                            type: 'ajax',
                                                            reader: {
                                                                type: 'json',
                                                                rootProperty: 'root'
                                                            }
                                                        },
                                                        autoLoad: true
                                                    }),
                                                    series: tiposind6,
                                                    height: 500,
                                                    width: 700,
                                                    xField: 'tipo',
                                                    chartConfig: {
                                                        colors: arrayColors,
                                                        chart: {
                                                            renderer: 'SVG',
                                                            marginRight: 130,
                                                            marginBottom: 120,
                                                            zoomType: 'x',
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
                                                        title: {
                                                            text: 'Promedio de Dias',
                                                            x: -20
                                                        },
                                                        subtitle: {
                                                            //text : "Sin ICA 3 dias - Con ICA 4 dias",
                                                            text: '',
                                                            x: -20
                                                        },
                                                        xAxis: [{
                                                                title: {
                                                                    text: 'Promedio',
                                                                    margin: 20
                                                                },
                                                                labels: {
                                                                    rotation: 270,
                                                                    y: 35
                                                                }
                                                            }],
                                                        yAxis: {
                                                            title: {
                                                                text: 'DIAS '
                                                            },
                                                            plotLines: [{
                                                                    value: 0,
                                                                    width: 1,
                                                                    color: '#808080'
                                                                }]
                                                        },
                                                        tooltip: {
                                                            pointFormat: '<span style="color:{series.color}"><b>{series.name}</b></span>: <b>{point.y}</b><br/>',
                                                            shared: true

                                                        },
                                                        legend: {
                                                            layout: 'vertical',
                                                            align: 'right',
                                                            verticalAlign: 'top',
                                                            x: -10,
                                                            y: 100,
                                                            borderWidth: 0
                                                        }
                                                    }
                                                }*/

						Ext.create('Colsys.Chart.Bar1',{
							id: 'hcind6' + idtab,
                                                        name: 'hcind6' + idtab,
//							title:"Promedio de dias",
//							subtitle:"2",
							opacity:0.8,
							store: {
							       fields: ['name', 'dias'],
							       data: res.indicador6
							   },
							axes: [{
							       type: 'numeric3d',
							       position: 'left',
							       fields: ['dias'],
							       title: {
								   text: 'Numero de Dias',
								   fontSize: 15
							       },
							       grid: {
								   odd: {
								       fillStyle: 'rgba(255, 255, 255, 0.06)'
								   },
								   even: {
								       fillStyle: 'rgba(0, 0, 0, 0.03)'
								   }
							       },
							       renderer: 'onAxisLabelRender'
							       
							   }, {
							       type: 'category3d',
							       position: 'bottom',
							       title: {
								   text: 'Tipo',
								   fontSize: 15
							       },
							       fields: 'name'
							   }],
							   series: {
							       type: 'bar3d',
							       xField: 'name',
							       yField: ['dias'],
							       label: {
									field: 'dias',
									display: 'insideEnd',
									renderer: 'onSeriesLabelRender'
								    },
								    tooltip: {
									trackMouse: true,
									renderer: 'onTooltipRender'
								    },
								    highlightCfg: {
									saturationFactor: 1.5
								    }
							   },
							onTooltipRender: function (tooltip, record, item) {
								tooltip.setHtml(record.get('name') + ': ' +
								    Ext.util.Format.number(record.get('dias'), '0,000'));
							    },
 					        })

						,
                                                {
//                                                 Ext.create('Ext.grid.Panel', {                                                    
                                                   xtype: 'Colsys.FalabellaAdu.GridDatosIndDet',
                                                    id: 'gindPromedio' + idtab,
                                                    name: 'gindPromedio' + idtab,
                                                    columns: colind6,
                                                    width: 250
                                                }
                                                //})
                                            ]
                                        })
                                    ];

                                    tabpanel.add({
                                        title: "indicadores " + idtab,
                                        id: 'tab' + idtab,
                                        itemId: 'tab' + idtab,
                                        closable: true,
                                        items: [
                                            Ext.create('Ext.panel.Panel', {
                                                bodyPadding: 10,
                                                autoScroll: true,
                                                id: 'tab-form' + idtab,
                                                items: obj
                                            })
                                        ]
                                    }).show();


                                    store = Ext.getCmp('gind1' + idtab).store;
                                    store.loadData(res.indicador1grid);

                                    store = Ext.getCmp('gind3' + idtab).store;
                                    store.loadData(res.indicador3grid);

                                    store = Ext.getCmp('gind4' + idtab).store;
                                    store.loadData(res.indicador4grid);

                                    store = Ext.getCmp('gind5' + idtab).store;
                                    store.loadData(res.indicador5grid);


                                    store = Ext.getCmp('gcon' + idtab).store;
                                    store.loadData(res.contenedoresgrid);

                                    //store=Ext.getCmp('ginsp'+idtab).store;
                                    //store.loadData(res.declaracionesinspgrid);

                                    store = Ext.getCmp('gd' + idtab).store;
                                    store.loadData(res.declaracionesgrid);

                                    store = Ext.getCmp('gindPromedio' + idtab).store;
                                    store.loadData(res.indicador6grid);

                                }
                            }
                            ,
                            failure: function (response, opts) {
                                Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                            }
                        });
                    }
                    tabpanel.setActiveTab('tab' + idtab);
                }
            }]
    });


    function graficaLineas(obj)
    {
        return Ext.create('Colsys.Chart.Line', {
            id: obj.id,
            name: obj.id,
            datos: obj.datos,
            title: obj.title,
            subtitle: obj.subtitle,
            titleY: obj.titleY,
            url: '<?=$pref?>/indicadoresAdu/datosGrafica',
            series: [
                {
                    type: 'line',
                    name: (obj.nameSerie) ? obj.nameSerie : 'Carpetas',
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
        return Ext.create('Colsys.Chart.Pie', {
            id: obj.id,
            name: obj.id,
            datos: obj.datos,
            title: obj.title,
            subtitle: obj.subtitle,
            url: '<?=$pref?>/indicadoresAdu/datosGrafica',
            series: [
                {
                    type: 'pie',
                    name: (obj.nameSerie) ? obj.nameSerie : 'Carpetas',
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
            name: obj.id,
            store: Ext.data.JsonStore({
                fields: obj.fields,
                proxy: {
                    url: '<?=$pref?>/indicadoresAdu/datosGrafica',
                    extraParams: {
                        datos: obj.datos
                    },
                    type: 'ajax',
                    reader: {
                        type: 'json',
                        rootProperty: 'root'
                    }
                },
                autoLoad: true
            }),
            series: obj.series,
            height: (obj.height ? obj.height : 500),
            width: (obj.width ? obj.width : 700),
            xField: (obj.xField ? obj.xField : 'tipo'),
            chartConfig: {
                colors: arrayColors,
                chart: {
                    renderer: 'SVG',
                    marginRight: 130,
                    marginBottom: 120,
                    zoomType: 'x',
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
                title: {
                    text: (obj.title ? obj.title : ''),
                    x: -20
                },
                subtitle: {
                    text: (obj.subtitle ? obj.subtitle : ''),
                    x: -20
                },
                xAxis: [{
                        title: {
                            text: 'Tipo',
                            margin: 20
                        },
                        labels: {
                            rotation: 270,
                            y: 35
                        }
                    }],
                yAxis: {
                    title: {
                        text: 'Cantidad '
                    },
                    plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                },
                tooltip: {
                    pointFormat: '<span style="color:{series.color}"><b>{series.name}</b></span>: <b>{point.y}</b><br/>',
                    shared: true

                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
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
                        id: 'gresumen',
                        name: 'gresumen',
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
                        tbar: [
                            {
                                xtype: 'exporterbutton',
                                text: 'Exportar CSV',
                                iconCls: 'csv'
                            }
                        ],
                        columns: [
                            {text: "D.O.", dataIndex: 'c_ca_referencia', sortable: true, width: 115},
                            {text: "Preins", dataIndex: 'c_ca_preinspeccion', sortable: true, xtype: 'checkcolumn', width: 30},
                            {text: "CONS.", dataIndex: 'c_ca_consolidado', sortable: true, width: 80},
                            {text: "Container", dataIndex: 'c_ca_contenedor', sortable: true, width: 110},
                            {text: "Cntr Size", dataIndex: 'c_ca_tipocontenedor', sortable: true, width: 60},
                            {text: "Carpeta", dataIndex: 'c_ca_carpeta', sortable: true, width: 190},
                            {text: "LOGNET", dataIndex: 'c_ca_lognet', sortable: true, width: 70},
                            {text: "Bill of Lading", dataIndex: 'c_ca_bl', sortable: true, width: 130},
                            {text: "BL ISSUE", dataIndex: 'c_ca_blimpresion', sortable: true, },
                            {text: "Manufacturer", dataIndex: 'c_ca_fabricante', sortable: true, width: 100},
                            {text: "Partner Name", dataIndex: 'c_ca_proveedor', sortable: true, width: 120},
                            {text: "OBSERVACIONES", dataIndex: 'c_ca_observaciones', sortable: true, width: 150},
                            {text: "TRANS", dataIndex: 'c_ca_transportador', sortable: true, width: 100},
                            {text: "TIPO DE<br> CARGA", dataIndex: 'c_ca_tipocarga', sortable: true, width: 120},
                            {text: "VALOR", dataIndex: 'c_ca_valor', sortable: true},
                            {text: "COURRIER", dataIndex: 'c_ca_fchcourrier', sortable: true, width: 85},
                            {
                                text: "BL",
                                columns: [
                                    {text: "Original", dataIndex: 'ca_fchbl', sortable: true, width: 85,
                                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                        format: "d/m/Y",
                                        altFormat: "Y-m-d",
                                        submitFormat: 'Y-m-d'
                                    }
                                ]
                            },
                            {
                                text: "Factura comercial",
                                columns: [
                                    {text: "Numero", dataIndex: 'c_ca_factura', sortable: true, editor: {xtype: "textfield"}, width: 160},
                                    {text: "Original", dataIndex: 'c_ca_fchfactura', sortable: true, width: 85,
                                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                        format: "d/m/Y",
                                        altFormat: "Y-m-d",
                                        submitFormat: 'Y-m-d'
                                    }
                                ]
                            },
                            {
                                text: "Lista de<br> Empaque",
                                columns: [
                                    {text: "Original", dataIndex: 'c_ca_fchlistempaque', sortable: true, width: 85,
                                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                        format: "d/m/Y",
                                        altFormat: "Y-m-d",
                                        submitFormat: 'Y-m-d'
                                    }
                                ]
                            },
                            {
                                text: "Certificacion de Fletes",
                                columns: [
                                    {text: "Numero", dataIndex: 'c_ca_certfletes', sortable: true, editor: {xtype: "textfield"}},
                                    {text: "Fecha", dataIndex: 'c_ca_fchcertfletes', sortable: true, width: 85,
                                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                        format: "d/m/Y",
                                        altFormat: "Y-m-d",
                                        submitFormat: 'Y-m-d'
                                    }
                                ]
                            },
                            {
                                text: "Indicadores de optimizacion",
                                columns: [
                                    {text: "Fecha<br>pago", dataIndex: 'c_ca_fchpago', sortable: true, width: 85,
                                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                        format: "d/m/Y",
                                        altFormat: "Y-m-d",
                                        submitFormat: 'Y-m-d',
                                        tdCls: 'row_orange',
                                        baseCls: 'row_green'
                                    },
                                    {text: "Demora<br>Documentos", dataIndex: 'demoradocs', sortable: true, width: 100, tdCls: 'row_gray', baseCls: 'row_green',
                                        renderer: function (value, metaData, record, row, col, store, gridView) {
                                            if (value >= 1) {
                                                metaData.style = 'color:red;font-weight:bold;background:yellow;';
                                            }
                                            return value;
                                        }
                                    },
                                    {text: "Dias Nal ETA", dataIndex: 'diasnaleta', sortable: true, width: 100, tdCls: 'row_gray', baseCls: 'row_green'},
                                    {text: "Dias Nal Hab", dataIndex: 'diasnalhab', sortable: true, width: 100, tdCls: 'row_gray', baseCls: 'row_green'},
                                    {text: "Fecha<br>consinv", dataIndex: 'c_ca_fchconsinv', sortable: true, width: 85,
                                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                        format: "d/m/Y",
                                        altFormat: "Y-m-d",
                                        submitFormat: 'Y-m-d',
                                        tdCls: 'row_orange',
                                        baseCls: 'row_green'
                                    },
                                    {text: "Fecha<br>Recepcion", dataIndex: 'c_ca_fchrecepcion', sortable: true, width: 85,
                                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                        format: "d/m/Y",
                                        altFormat: "Y-m-d",
                                        submitFormat: 'Y-m-d',
                                        baseCls: 'row_green'
                                    },
                                    {text: "Fecha<br>Descripciones", dataIndex: 'c_ca_fchdescripciones', sortable: true, width: 85,
                                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                        format: "d/m/Y",
                                        altFormat: "Y-m-d",
                                        submitFormat: 'Y-m-d',
                                        tdCls: 'row_orange',
                                        baseCls: 'row_green'
                                    },
                                    {text: "A Tiempo", dataIndex: 'atiempo', sortable: true, width: 100, tdCls: 'row_gray', baseCls: 'row_green'},
                                    {text: "Fecha<br>levante", dataIndex: 'c_ca_fchlevante', sortable: true, width: 85,
                                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                        format: "d/m/Y",
                                        altFormat: "Y-m-d",
                                        submitFormat: 'Y-m-d',
                                        tdCls: 'row_orange',
                                        baseCls: 'row_green'
                                    },
                                    {text: "Fecha<br>Entrega<br>Trans", dataIndex: 'c_ca_fchentregatrans', sortable: true, width: 85,
                                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                        format: "d/m/Y",
                                        altFormat: "Y-m-d",
                                        submitFormat: 'Y-m-d',
                                        tdCls: 'row_orange',
                                        baseCls: 'row_green'
                                    }

                                ]
                            },
                            {text: "Embarque", dataIndex: 'c_ca_embarque', sortable: true}

                        ],
                        split: true
                    })

                ]

            });
        }
    }


    function columnasgrid(tipo, title1)
    {

        return columnsbasic = [
            {text: ((title1 != "" && tipo == "Desc") ? title1 : "Terminal"), width: 120, dataIndex: 'terminal', sortable: true,
                summaryRenderer: function (value, summaryData, dataIndex) {
                    return "Total";
                }
            },
            {text: ((title1 != "" && tipo != "Desc") ? title1 : "Total carpetas"), width: 120, dataIndex: 'total_carpeta', summaryType: 'sum', sortable: true,
                renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                    if (value != "" && value != "null")
                        return '<a href="javascript:callFunction(\'' + record.get('terminal') + '\',\'' + tipo + '1\')" >' + value + '</a>';
                    else
                        return '';
                }
            },
            {text: "Total Demora", width: 120, dataIndex: 'total_demora', sortable: true,
                renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                    if (value != "0")
                        return '<a href="javascript:callFunction(\'' + record.get('terminal') + '\',\'' + tipo + '\')" >' + value + '</a>';
                    else
                        return '0';
                },
                summaryType: function (records) {
                    var i = 0,
                            length = records.length,
                            totalcarpeta = 0,
                            totaldemora = 0,
                            record;
                    for (; i < length; ++i) {
                        record = records[i];
                        totaldemora += parseInt(record.get('total_demora'));
                    }
                    return Ext.util.Format.number(totaldemora, '0');
                }
            },
            {text: "% Demora", width: 125, dataIndex: 'por_demora', sortable: true,
                summaryType: function (records) {
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
                    return Ext.util.Format.number((totaldemora * 100) / totalcarpeta, '0.0');
                }
            }
        ]
    }
    function cargarWin2()
    {
        //alert("cargarwein2");
        if (!winIndicador) {
            winIndicador = Ext.create('Ext.window.Window', {
                title: 'Resumen de Datos',
                header: {
                    titlePosition: 2,
                    titleAlign: 'center'
                },
                closable: true,
                closeAction: 'destroy',
                maximizable: true,
                width: 800,
                minWidth: 350,
                height: 550,
                tools: [{type: 'pin'}
                ],
                layout: {
                    padding: 5
                },
                listeners: {
                    destroy: function () {
                        winIndicador = null;
                    }
                },
                autoScroll: true,
                items: [
                    new GridDetControl(
                            {'columns':<?= json_encode($fields) ?>, 'id': 'grid-det-control',
                                'name': 'grid-det-control', 'idcabcontrol': 0, 'iditem': 0, title: 'Datos'})//   panelGraficas(id)


                ]
            });
        }
    }
    function mostrardatos(tipo, valor1, valor2) {
        cargarWin2();
        Ext.getCmp('grid-det-control').setStore(null);
        store = Ext.getCmp('grid-det-control').store;
        datosTemp = datos;


        var list = new Array();
	//console.log(datosTemp.length);
        for (var i = 0; i < datosTemp.length; i++)
        {

            var json1 = datosTemp[i].c_ca_datos;



            var json2 = [];
            for (x1 in datosTemp[i]) {
                if (x1 != "c_ca_datos") {
                    json2[x1] = datosTemp[i][x1];
                }
            }

            var str = '{';

            
            var parsed1 = JSON.parse(json1);
            var arr = [];
            var tmp = [];
            for (var x in parsed1) {
                tmp[x] = parsed1[x];
                if (parsed1[x] != null) {
                    str += '' + '"' + x + '"' + ':' + '"' + parsed1[x] + '"' + ',';
                } else {
                    str += '' + '"' + x + '"' + ':' + '' + parsed1[x] + '' + ',';
                }
            }

            for (var x in json2) {
                tmp[x] = json2[x];

                if (x.substring(0, 2) != "c_") {
                    if (json2[x] != null) {
                        str += '' + '"' + x + '"' + ':' + '"' + json2[x] + '"' + ',';
                    } else {
                        str += '' + '"' + x + '"' + ':' + '' + json2[x] + '' + ',';
                    }
                } else {
                    if (json2[x] != null) {
                        str += '' + '"' + x.substring(2, x.length) + '"' + ':' + '"' + json2[x] + '"' + ',';
                    } else {
                        str += '' + '"' + x + '"' + ':' + '' + json2[x] + '' + ',';
                    }
                }
            }
            str = str.substring(0, str.length - 1);
            str += "}";
            str = str.toString();
            str2 = jQuery.parseJSON(str);


            if (tipo == 1) {
                if (valor1 == "CON ICA") {
                    if (valor2 == 0) {
                        if (datosTemp[i].c_ca_inspeccion == "SI" && datosTemp[i].indicador1 == 0) {
                            list.push(str2);
                        }
                    } else if (valor2 == 1) {
                        if (datosTemp[i].c_ca_inspeccion == "SI" && datosTemp[i].indicador1 == 1) {
                            list.push(str2);
                        }
                    }
                } else if (valor1 == "SIN ICA") {
                    if (valor2 == 0) {
                        if (datosTemp[i].c_ca_inspeccion == "NO" && datosTemp[i].indicador1 == 0) {
                            list.push(str2);
                        }
                    } else if (valor2 == 1) {
                        if (datosTemp[i].c_ca_inspeccion == "NO" && datosTemp[i].indicador1 == 1) {
                            list.push(str2);
                        }
                    }
                }

            } else if(tipo == 2){
                
                if (valor1 == "CON ICA" && valor2 == "cumple"){
                    
                    if (datosTemp[i].c_ca_inspeccion == "SI" && datosTemp[i].dias3 <= 1) {
                        list.push(str2);
                    }
                }
                else if (valor1 == "CON ICA" && valor2 == "NoCumple"){
                    
                    if (datosTemp[i].c_ca_inspeccion == "SI" && datosTemp[i].dias3 > 1) {
                        list.push(str2);
                    }
                } else if (valor1 == "SIN ICA" && valor2 == "cumple"){
                    if (datosTemp[i].c_ca_inspeccion == "NO" && datosTemp[i].dias3 <= 1) {
                        list.push(str2);
                    }
                }  
                if (valor1 == "SIN ICA" && valor2 == "NoCumple"){
                    if (datosTemp[i].c_ca_inspeccion == "NO" && datosTemp[i].dias3 > 1) {
                        list.push(str2);
                    }
                }
                
                
            }else if (tipo == 3) {
                if (valor2 == datosTemp[i].c_ca_tipodim && valor1 == datosTemp[i].c_ca_terminal) {
                    list.push(str2);
                }
            } else if (tipo == 4) {
                if (valor1 == datosTemp[i].c_ca_terminal) {
                    list.push(str2);
                }
            } else if (tipo == 5) {
                fecha = datosTemp[i].c_ca_fcheta;
                if (fecha.length > 3) {
                    if (valor2 == fecha.substring(0, fecha.length - 3)) {
                        list.push(str2);
                    }
                }
            } else if (tipo == 6) {
                if (valor1 == datosTemp[i].dias1) {
                    if (valor2 == "SIN ICA" && datosTemp[i].c_ca_inspeccion == "NO") {
                        list.push(str2);
                    } else if (valor2 == "CON ICA" && datosTemp[i].c_ca_inspeccion == "SI") {
                        list.push(str2);
                    }
                }
            } else if (tipo == 7) {
                if (valor2 == "SIN ICA" && datosTemp[i].c_ca_inspeccion == "NO") {
                    list.push(str2);
                } else if (valor2 == "CON ICA" && datosTemp[i].c_ca_inspeccion == "SI") {
                    list.push(str2);
                }
            }
        }
console.log(list);
        store.setData(list);
        winIndicador.show();
    }

    function callFunction(data, tipo)
    {
        cargarWin();
        winIndicador.show();
        store = Ext.getCmp('gresumen').store;
        var list = new Array();

        for (i = 0; i < datos.length; i++)
        {
            if (tipo == "Docs")
            {
                if (datos[i].f_ca_muelle == data && datos[i].demoradocs > 0)
                    list.push(datos[i]);
                //store.add(datos[i]);

            } else if (tipo == "Docs1")
            {
                if (datos[i].f_ca_muelle == data)
                    list.push(datos[i]);
                //store.add(datos[i]);

            } else if (tipo == "Desc")
            {
                if (datos[i].linea == data && datos[i].atiempodm == "No")
                    list.push(datos[i]);
            } else if (tipo == "Desc1")
            {
                if (datos[i].linea == data)
                    list.push(datos[i]);
            } else if (tipo == "Nal")
            {

                if (datos[i].f_ca_muelle == data && datos[i].consnal == 1)
                {
                    //alert(datos[i].consnal);
                    list.push(datos[i]);
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
            } else if (tipo == "Nal1")
            {
                //list.push( datos[i] );
                if (datos[i].f_ca_muelle == data && datos[i].consnal == 0)
                    list.push(datos[i]);
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

            } else if (tipo == "BL")
            {
                if (datos[i].f_ca_muelle == data && datos[i].diasbl > 0)
                    list.push(datos[i]);
            } else if (tipo == "BL1")
            {
                if (datos[i].f_ca_muelle == data)
                    list.push(datos[i]);
            }
        }
        store.setData(list);
    }

</script>


<?
/*
 *             ///////////////////////////declaraciones inspeccion/////////////////////////////////////////////////////
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
  pointFormat: '<span style="color:{series.color}"><b>{series.name}</b></span>: <b>{point.y}</b><br/>',
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
 */
?>
