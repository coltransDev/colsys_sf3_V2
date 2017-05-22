var winIndicador = null;
var datos;
Ext.define('Colsys.IndicadoresAdu.FormIndicadores', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.IndicadoresAdu.FormIndicadores',
    title: 'Generaci&oacute;n de Indicadores',
    id: 'form-indicadores',
    layout: {
        type: 'table'
    },
    defaultType: 'textfield',
    items: [
        {
            xtype: 'Colsys.FalabellaAdu.FormFiltrosInd'
        }
    ],
    buttons: [{
            text: 'Indicadores Maritimo',
            handler: function () {
                consultar('Mar\u00edtimo');
            }
        }, {
            text: 'Indicadores Aereo',
            handler: function () {
                consultar('A\u00e9reo');
            }
        }]
});

function consultar(transporte) {

    idtab = Ext.getCmp("eta1").getRawValue() + "_" + Ext.getCmp("eta2").getRawValue();
    if (idtab == "_")
        idtab = Ext.getCmp("fecha1").getRawValue() + "_" + Ext.getCmp("fecha2").getRawValue();
    
    idtab +=  "_" + transporte;

    tabpanel = Ext.getCmp("tab-panel-id-indicadores");
    if (!tabpanel.getChildByElement('tab' + idtab))
    {
        Ext.Ajax.request({
            url: '/tracking/indicadoresAdu/datosIndAdu',
            //url: '/tracking/indicadoresAdu/datosPie',
            params: {
                transporte: transporte,
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
                    columnas = [
                        {
                            dataIndex: "nref",
                            text: "No. Referencias" //,
                                    //summaryType: 'sum'
                        },
                        {
                            dataIndex: "CUMPLE",
                            text: "Conformes" //,
                                    //summaryType: 'sum'
                        },
                        {
                            dataIndex: "DEMORA",
                            text: "Demoras" //,
                                    //summaryType: 'sum'
                        }
                    ];

                    var paneles = new Array();
                    titulos = [] ;
                    titulos[0] = "";
                    titulos[1] = "OPORTUNIDAD ENTREGA DCTS COMPLETOS";
                    titulos[2] = "OPORTUNIDAD DE NACIONALIZACION";
                    titulos[3] = "OPORTUNIDAD ENTREGA DE MERCANCIA";
                    titulos[4] = "OPORTUNIDAD DE ENTREGA A FACTURACION";
                    titulos[5] = "OPORTUNIDAD EN LA FACTURACION";
                    //titulos[6] = "OPORTUNIDAD EN LA FACTURACION";
                    
                    
                    for (i = 1; i <= 5; i++)
                    {
                        eval("tmpdatos=JSON.stringify(res.ind" + i + ");");
                        var h = i;
                        paneles.push(
                                Ext.create('Colsys.FalabellaAdu.PanelIndDet', {
                                    id: "panel-ind" + i + idtab,
                                    items: [
                                        graficaPie({id: 'gind' + i + idtab, name: 'gind' + i + idtab, title: titulos[i], datos: tmpdatos}),
                                        {
                                            xtype: 'Colsys.FalabellaAdu.GridDatosIndDet',
                                            id: 'gdind' + i + idtab,
                                            iditem: i,
                                            name: 'gdind' + i + idtab,
                                            columns: columnas,
                                            listeners: {
                                                celldblclick: function (obj, td, cellIndex, record, tr, rowIndex, e, eOpts)
                                                {
                                                    //console.log(obj.getGridColumns()[cellIndex].dataIndex);                                                           
                                                    callFunction(this.iditem, obj.getGridColumns()[cellIndex].dataIndex);
                                                }
                                            }
                                        }
                                    ]
                                })
                                )
                    }

                    for (i = 1; i <= 5; i++)
                    {
                        store = Ext.getCmp('gdind' + i + idtab).store;
                        eval("store.loadData(res.indgrid" + i + ");");
                    }

                    tabpanel.add({
                        title: "indicadores " + idtab.replace(/_/g, " "),
                        id: 'tab' + idtab,
                        itemId: 'tab' + idtab,
                        closable: true,
                        items: [
                            Ext.create('Ext.panel.Panel', {
                                //title:'grafica',
                                bodyPadding: 10,
                                autoScroll: true,
                                id: 'tab-form' + idtab,
                                items: paneles
                            })
                        ]
                    }).show();
                }
            },
            failure: function (response, opts) {
                Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
            }
        });
    }
    console.log(idtab);
    tabpanel.setActiveTab('tab' + idtab);

}


function callFunction(tipoidg, column)
{
    //if(column=="nref")
    //    return;
    cargarWin();
    winIndicador.show();
    store = Ext.getCmp('gresumen').store;
    var datosTemp = datos;

    var list = new Array();
    //alert(column);
    //alert(datosTemp.length);
    for (i = 0; i < datosTemp.length; i++)
    {
        if (column == "DEMORA" || column == "CUMPLE")
        {
            if (datosTemp[i]["ind" + tipoidg] == column)
                list.push(datosTemp[i]);
        } else
            list.push(datosTemp[i]);
        /*if(column=="DEMORA")
         {
         if(datosTemp[i]["dia"+tipoidg]>datosTemp[i]["lim"+tipoidg])
         list.push( datosTemp[i] );
         }
         if(column=="CUMPLE")
         {
         //alert(datosTemp["dia"+tipoidg] + "--"+datosTemp["lim"+tipoidg])
         if(datosTemp[i]["dia"+tipoidg]<=datosTemp[i]["lim"+tipoidg])
         list.push( datosTemp[i] );  
         }
         else
         list.push( datosTemp[i] );  
         */
    }
    //console.log(list.length)
    store.setData(list);
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
            width: 1000,
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
                    xtype: 'Colsys.IndicadoresAdu.GridDatosIndAereo',
                    id: 'gresumen',
                    name: 'gresumen'
                }
            ]
        });
    }
}

var arrayColors = ['#007D45', '#736363', '#4572A7', '#AA4643', '#89A54E', '#80699B', '#3D96AE', '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92', '#0000FF', '#0066FF', '#00CCFF', '#562F1E', '#AF7F24', '#263249', '#5F7F90', '#D9CDB6'];
function graficaPie(obj)
{
    var datostmp = Ext.decode(obj.datos);

    return Ext.create('Colsys.Chart.Pie1', {
        id: obj.id,
        name: obj.id,
        title: obj.title,
        subtitle: obj.subtitle,
        opacity: 0.8,
        theme: 'Muted',
        //colors:arrayColors,
        axes: [{
                type: 'numeric',
                position: 'left'
            }, {
                type: 'category',
                position: 'bottom'
            }],
        store: {
            fields: ['total'],
            data: datostmp
        },
        series: {
            type: 'pie3d',
            angleField: 'total',
            donut: 30,
            colorSpread: 50,
            style: {opacity: 0.8},
            //colors:['111111','222222','333333'],
            label: {
                field: 'name',
                display: 'rotate'
            },
            distortion: 0.6,
            highlight: {
                margin: 40
            },
            tooltip: {
                trackMouse: true,
                renderer: 'onSeriesTooltipRender'
            }
        },
        onSeriesTooltipRender: function (tooltip, record, item) {
            tooltip.setHtml(record.get('name') + ': ' + record.get('total'));
        }
    })
}
/*
 Ext.create('Colsys.FalabellaAdu.PanelIndDet',{
 //title: 'DOCUMENTOS ORIGINALES',
 id:"panel-declant1"+idtab,
 items: [
 graficaColumn({id:'hcd1'+idtab,name:'hcd1'+idtab,title:'Declaraciones Anticipadas vs Iniciales',datos:JSON.stringify(res.declaraciones),nameSerie:'Referencias'}),
 {
 xtype:'Colsys.FalabellaAdu.GridDatosIndDet',
 id:'gd1'+idtab,
 name:'gd1'+idtab,
 columns: coldeclaraciones
 }
 ]
 })
 
 function  graficaColumn(obj)
 {
 return Ext.create('Colsys.Chart.Bar1',{
 id: obj.id,
 name:obj.id,
 title:obj.title,
 subtitle:obj.subtitle
 })
 }*/