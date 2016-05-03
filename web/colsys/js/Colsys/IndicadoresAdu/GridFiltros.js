

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//include_component("widgets5", "wgEmpresas");
//$fields = $sf_data->getRaw("fields");


var contconsulta=1000;
var states = Ext.create('Ext.data.Store', {
    fields: ['id', 'name','tipo'],
    data : myData1//<?=json_encode($fields)?>
});

var operadores = Ext.create('Ext.data.Store', {
    fields: ['id', 'name'],
    data : [
        {'id':'=','name':'='},
        {'id':'>','name':'>'},
        {'id':'>=','name':'>='},
        {'id':'<','name':'<'},
        {'id':'<=','name':'<='},
        {'id':'>=','name':'>='},
        {'id':'between','name':'Entre'},
        {'id':'like','name':'Contiene'}
    ]
});

var union = Ext.create('Ext.data.Store', {
    fields: ['id', 'name'],
    data : [
        {'id':'AND','name':'Y'},
        {'id':'OR','name':'O'}
    ]
});

//var myData1= '';//<?=json_encode($fields)?>;
//comboCampos


var comboBoxRenderer = function(combo) {
  return function(value) {      
    var idx = combo.store.find(combo.valueField, value);
    var rec = combo.store.getAt(idx);
    return (rec === null ? value : rec.get(combo.displayField) );
  };
}



Ext.define('Simple', {
    extend: 'Ext.data.Model',
    fields: ['id','name', 'union', 'valor','operador']    
});

Ext.define('Colsys.IndicadoresAdu.GridFiltros', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.IndicadoresAdu.GridFiltros',
    //id:'parentGrid',
    requires: [
        'Ext.grid.*',
        'Ext.layout.container.HBox'        
    ],    
    xtype: 'dd-grid-to-grid',    
    layout:'column',
    defaults:{
                columnWidth: 1/2,
                bodyStyle:'padding:0,marging:0',
                style:"text-align: left"
        },
    
    myData: myData1,
    tbar: [
    {
        text: 'Buscar',
        iconCls: 'search',        
        handler: function() {
            
            var grid2=getData('grid2');
            var grid3=getData('grid3');
            var grid4=getData('grid4');
            parametros={
                "filtros": grid2,
                "agrupamiento": grid3,
                "ordenamiento": grid4
            };
            
            
            parametros= JSON.stringify(parametros);
            var tabpanel=Ext.getCmp("tab-panel-id");
            obj=[
            {
                xtype: 'tabpanel',
                id:'tab-panel-id-indicadores'+contconsulta,
                activeTab: 0,            
                items: [
                    new GridDetControl({'id':'grid-det-control'+contconsulta,'name':'grid-det-control'+contconsulta,'idalt':contconsulta, 'parametros':parametros,'iditem':id,title: 'Datos'}),
                    panelGraficas(contconsulta)
                ]
            }
                
            ];


            tabpanel.add(
            {
                title: "Estadistica "+(contconsulta-999),
                id:'tab'+contconsulta,
                itemId:'tab'+contconsulta,
                closable :true,
                autoScroll:true,
                items: [
                {
                    autoScroll:true,
                    items:[
                        Ext.create('Ext.panel.Panel', {
                        title: 'Datos Cuadro Control',
                            bodyPadding: 10,
                            //width: 350,
                            autoScroll:true,
                            id:'tab-form'+contconsulta,
                            items: obj
                        })
                    ]
                }
                ]
            }).show();
            tabpanel.setActiveTab('tab'+(contconsulta++));
                        
        }
    }],
    buttonAlign :'right',
    initComponent: function(){
        var group1 = this.id + 'group1',
            group2 = this.id + 'group2',
            group3 = this.id + 'group3',
            group4 = this.id + 'group4';
    
            this.comboCampos=new Ext.form.ComboBox({
                store: states,
                queryMode: 'local',
                displayField: 'name',
                valueField: 'id'
            });
            columnsCheck =[
                { xtype : 'checkcolumn', text : 'Sel', dataIndex : 'sel',width:30 },
            ];
            columns = [
                {
                    xtype:'hidden',
                    dataIndex: 'id'
                },
                {
                    text: 'Campo', 
                    flex: 1, 
                    sortable: true, 
                    dataIndex: 'name',
                    editor:this.comboCampos,
                    renderer: comboBoxRenderer(this.comboCampos)
                }
            ];
            
            
            this.comboUnion=new Ext.form.ComboBox({
                store: union,
                queryMode: 'local',
                displayField: 'name',
                valueField: 'id'
            });
            
            columnsU = [
                {
                    text: 'Union',
                    dataIndex: 'union',
                    editor:this.comboUnion,
                    renderer: comboBoxRenderer(this.comboUnion)
                }
            ];
            
            this.comboOperador=new Ext.form.ComboBox({
                store: operadores,
                queryMode: 'local',
                displayField: 'name',
                valueField: 'id'
            });
            columns1 = [
            {
                text: 'Op',                
                dataIndex: 'operador',
                editor:this.comboOperador,
                renderer: comboBoxRenderer(this.comboOperador)
            },
            {
                text:'Valor',
                dataIndex: 'valor',
                editor: {xtype: "textfield"}
            }
                
            ];
        
            columnsOption = [            
            {
                xtype: 'actioncolumn',
                width: 30,
                sortable: false,
                menuDisabled: true,
                items: [{
                    icon: '/images/fam/delete.png',
                    handler: function(grid, rowIndex, colIndex) {
                        
                        var rec = grid.getStore().getAt(rowIndex);
                        grid.getStore().removeAt(rowIndex);
                       alert(rec.data.toSource());
                       //callFunction(rec.data,tipo)
                        //eval( functionCallBack+"(rec.data)" );

                    }
                }]
            }];
         
            this.items = [
            {
                columnWidth: 0.3,
                itemId: 'grid1',
                id: 'grid1',
                name: 'grid1',
                //flex: 1,
                xtype: 'grid',
                multiSelect: true,
                //width:200,
                height:600,
                viewConfig: {
                    plugins: {
                        ptype: 'gridviewdragdrop',
                        dragGroup: group1,
                        dropGroup: group2
                    },
                    listeners: {
                        drop: function(node, data, dropRec, dropPosition) {
                            //var dropOn = dropRec ? ' ' + dropPosition + ' ' + dropRec.get('name') : ' on empty view';
                            //alert('Drag from right to left', 'Dropped ' + data.records[0].get('name') + dropOn);
                        }
                    }
                },
                store: new Ext.data.Store({
                    model: Simple,
                    data: this.myData
                }),
                columns: columns.concat(columnsCheck),
                title: 'Columnas',
                tools: [{
                    type: 'refresh',
                    tooltip: 'Reset both grids',
                    scope: this,
                    handler: this.onResetClick
                }],        
                margin: '0 5 0 0',
                plugins: [new Ext.grid.plugin.CellEditing({
                        clicksToEdit: 1
                    })]
            },
            {
                columnWidth: 0.7,
                itemId: 'grid2',
                id: 'grid2',
                name: 'grid2',
                //flex: 1,
                xtype: 'grid',
                //width: 500,
                height:300,
                viewConfig: {
                    plugins: {
                        ptype: 'gridviewdragdrop',
                        //dragGroup: group2,
                        dropGroup: group1
                    },
                    listeners: {
                        drop: function(node, data, dropRec, dropPosition) {
                            Ext.getCmp('grid1').getStore().loadData(myData1);
                            //this.up('#grid1').getStore().loadData(this.myData);
                            //var dropOn = dropRec ? ' ' + dropPosition + ' ' + dropRec.get('name') : ' on empty view';
                            //alert('Drag from left to right', 'Dropped ' + data.records[0].get('name') + dropOn);
                        }
                    }
                },
                store: new Ext.data.Store({
                    model: Simple
                }),
                columns: columnsU.concat(columns,columns1,columnsOption),
                stripeRows: true,
                title: 'Filtros',
                plugins: [new Ext.grid.plugin.CellEditing({
                        clicksToEdit: 1
                    })],
                tbar: [
                {
                    text: 'Nuevo',
                    iconCls: 'add',
                    handler: function() {
                        //alert(record.data.toSource());
                        var store=this.up("grid").getStore();
                        var r = Ext.create(store.getModel());
                        store.insert(1000, r);
                    }
                }]
            },
            {
                columnWidth: 0.35,
                itemId: 'grid3',
                id: 'grid3',
                name: 'grid3',
                disabled:true,
                //flex: 1,
                xtype: 'grid',
                height:300,
                viewConfig: {
                    plugins: {
                        ptype: 'gridviewdragdrop',
                        //dragGroup: group3,
                        dropGroup: group1
                    },
                    listeners: {
                        drop: function(node, data, dropRec, dropPosition) {
                            Ext.getCmp('grid1').getStore().loadData(myData1);
                            //var dropOn = dropRec ? ' ' + dropPosition + ' ' + dropRec.get('name') : ' on empty view';
                            //alert('Drag from left to right', 'Dropped ' + data.records[0].get('name') + dropOn);
                        }
                    }
                },
                store: new Ext.data.Store({
                    model: Simple
                }),
                columns: columns.concat(columnsOption),
                stripeRows: true,
                title: 'Agrupamiento',
                plugins: [new Ext.grid.plugin.CellEditing({
                        clicksToEdit: 1
                    })]
            },
            {
                columnWidth: 0.35,
                itemId: 'grid4',
                id: 'grid4',
                name: 'grid4',
                disabled:true,
                //flex: 1,
                xtype: 'grid',
                height:300,
                viewConfig: {
                    plugins: {
                        ptype: 'gridviewdragdrop',
                        //dragGroup: group4,
                        dropGroup: group1
                    },
                    listeners: {
                        drop: function(node, data, dropRec, dropPosition) {
                            Ext.getCmp('grid1').getStore().loadData(myData1);
                            //var dropOn = dropRec ? ' ' + dropPosition + ' ' + dropRec.get('name') : ' on empty view';
                            //alert('Drag from left to right', 'Dropped ' + data.records[0].get('name') + dropOn);
                        }
                    }
                },
                store: new Ext.data.Store({
                    model: Simple
                }),
                columns: columns.concat(columnsOption),
                stripeRows: true,
                title: 'Ordenar',
                plugins: [new Ext.grid.plugin.CellEditing({
                        clicksToEdit: 1
                    })]
            }
       
    ];

        this.callParent();
    },
    onResetClick: function(){
        //refresh source grid
        this.down('#grid1').getStore().loadData(this.myData);

        //purge destination grid
        this.down('#grid2').getStore().removeAll();
        this.down('#grid3').getStore().removeAll();
        this.down('#grid4').getStore().removeAll();
    }
});


function getData(id)
{
    
    var store = Ext.getCmp(id).getStore();    
    var records = store.getRange();
    var lenght = records.length;

    changes=[];
    for( var i=0; i< lenght; i++){
        r = records[i];
         //if(records[i].data.sel==true)
         {
            records[i].data.id=r.id;
            changes[i]=records[i].data;
         }
    }

    return changes;
}