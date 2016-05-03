Ext.define('Colsys.Ino.PanelFactura', {
    extend: 'Ext.view.View',
    //extend: 'Ext.panel.Table',
    alias: 'widget.Colsys.Ino.PanelFactura',
    //store: Ext.data.StoreManager.lookup('imagesStore'),    
    itemSelector: 'div.thumb-wrap',
    
    onRender: function(ct, position){
 
        
        this.tpl= new Ext.XTemplate(
            '<tpl for=".">',
                '<div style="width:45%;padding:10px;margin: 30px;float:left" title="{tooltip}" class="{class} thumb thumb-wrap"  >',
                '<div class="statement-type">{comprobante}</div>',
                '<table>',
                '<tr><td class="thumb-title">Cliente</td><td class="thumb-title-small">{cliente}</td></tr>',
                '<tr><td class="thumb-title">House</td><td class="thumb-title-small">{house}</td></tr>',
                '<tr><td class="thumb-title">Valor</td><td class="thumb-title-small">{valor}</td></tr>',
                '<tr>',
                '<tpl if="this.existFile(file)">',
                    '<td><a href="javascript:openFile(\'{file}\')"><img src="/images/toolbar/pdf-small.png" /></a></td>',
                '</tpl>',
                '<td colspan="2"><a href="javascript:viewGridFac(\'{idcomprobante}\',\'{comprobante}\',\''+this.idmaster+'\')"><img src="/images/32x32/spreadsheet.gif" /></a></td></tr>',
                '</table>',
                '<table><tr><td id="detalle{idcomprobante}"></td></tr></table>',
                '</div>',
            '</tpl>',               
                {
                existFile:function(file)
                {
                    return (file!="");
                },                
                formatMoney:function(val)
                {
                   return Ext.util.Format.usMoney(val);                   
                }
            }
        );

        this.setStore(
                Ext.create('Ext.data.Store', {
                 fields: [
                    {name: 'iddetalle'        ,mapping: 'iddetalle'        , type: 'int'},
                    {name: 'idhouse'          ,mapping: 'idhouse'          , type: 'int'},
                    {name: 'idcomprobante'    ,mapping: 'idcomprobante'    , type: 'int'},
                    {name: 'comprobante'      ,mapping: 'comprobante'      , type: 'string'},
                    {name: 'house'            ,mapping: 'house'            , type: 'string'},
                    {name: 'cliente'          ,mapping: 'cliente'          , type: 'string'},
                    {name: 'fchcomprobante'   ,mapping: 'fchcomprobante'   , type: 'date', dateFormat: 'Y-m-d'},
                    {name: 'cliente'          ,mapping: 'cliente'          , type: 'string'},
                    {name: 'doctransporte'    ,mapping: 'doctransporte'    , type: 'string'},
                    {name: 'idmoneda'         ,mapping: 'idmoneda'         , type: 'int'},
                    {name: 'moneda'           ,mapping: 'moneda'           , type: 'string'},
                    {name: 'valor'            ,mapping: 'valor'            , type: 'float'},
                    {name: 'idconcepto'       ,mapping: 'idconcepto'       , type: 'int'},
                    {name: 'concepto'         ,mapping: 'concepto'         , type: 'string'},
                    {name: 'cuentapago'       ,mapping: 'cuentapago'       , type: 'string'},        
                    {name: 'estado'           ,mapping: 'estado'           , type: 'int'},
                    {name: 'idccosto'        ,mapping: 'idccosto'         , type: 'int'}
                 ],      
                 proxy: {
                     type: 'ajax',
                     url: '/inoF2/datosFacturas2',
                     extraParams : {
                        idmaster : this.idmaster
                    },
                     reader: {
                         type: 'json',
                         root: 'root'
                     }
                 },
                 //groupField: 'comprobante'+this.idmaster,
                 sorters: [{
                     property: 'comprobante',
                     direction: 'ASC'
                 }],
                 autoLoad: true
            })
        );

        this.superclass.onRender.call(this, ct, position);  
    },
    
    listeners: {
        beforeitemcontextmenu:function( obj, record, item, index, e, eOpts )
        {            
            var me=this.up();
            e.stopEvent();
            var store = this.getStore();
            itemCm = new Array();
            
            if(record.data.estado<=1)
            {
                itemCm.push(
                {
                    text: 'Editar',
                    handler: function() {
                        //Ext.getCmp("grid-facturacion").ventanaFac(record);
                        me.ventanaFac(record);
                    }
                },
                {
                    text: 'Eliminar Comprobante',
                    iconCls: 'delete',
                    handler: function() {                        
                        Ext.MessageBox.confirm('Confirmacion', 'esta seguro de eliminar la Comprobante', 
                        function(e){
                            if(e == 'yes'){
                               var box = Ext.MessageBox.wait('Procesando', 'Eliminando Comprobante')
                               Ext.Ajax.request({
                                   url: '/inoF/EliminarGridFacturacionPanel"',
                                   params: {                            
                                       idcomprobante: record.get('idcomprobante')
                                   },
                                   success: function(response, opts) {
                                        var obj = Ext.decode(response.responseText);

                                        if(obj.errorInfo!="")
                                            Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                        else
                                            this.up().getStore().reload();
                                        box.hide();

                                   },
                                   failure: function(response, opts) {
                                       Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                       box.hide();
                                   }
                              });
                            }
                        })
                    }
                },
                {
                    text: 'Generar Comprobante',
                    iconCls: 'import',
                    disabled:(record.data.cuentapago!=""?false:true),
                    tooltip: (record.data.cuentapago!=""?'':'Debe asignar la forma de pago del cliente'),
                    handler: function() {
                        if(record.get('valor')<1)
                        {
                            Ext.MessageBox.alert("Colsys",  "El valor de la factura no puede ser menor o igual a 0");
                            return;
                        }
                        Ext.MessageBox.confirm('Confirmacion', 'esta seguro de Generar el Comprobante y contabilizarla?', 
                        function(e){
                            if(e == 'yes'){
                               var box = Ext.MessageBox.wait('Procesando', 'Generacion de Comprobante')
                               Ext.Ajax.request({
                                   url: '/inoF2/generarFactura',
                                   params: {                            
                                       idcomprobante: record.get('idcomprobante')
                                   },                                    
                                   success: function(response, opts) {
                                       var obj = Ext.decode(response.responseText);
                                       //Ext.getCmp("grid-facturacion").getStore().reload();
                                       this.up('grid').getStore().reload();
                                       
                                       box.hide();
                                       
                                       if(obj.info!="")
                                           Ext.MessageBox.alert("Colsys",  obj.info);
                                       if(obj.errorInfo!="")
                                           Ext.MessageBox.alert("Colsys",  "Se presento un problema al crearlo: "+obj.errorInfo);
                                       else
                                           Ext.MessageBox.alert("Colsys", "Se genero el Comprobante No. " + obj.consecutivo);
                                       
                                       this.up().getStore().reload();
                                       
                                   },
                                   failure: function(response, opts) {
                                       Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                       box.hide();
                                   }
                              });
                            };
                        }
                    )
                }
                }
                );
            }
            
            if(record.data.estado==5 || record.data.estado==6 || record.data.estado==8  )
            {                
                itemCm.push(            
                {
                    text: 'Anular Comprobante',
                    iconCls:'delete',
                    handler: function() {
                    
                        Ext.MessageBox.confirm('Confirmacion', 'esta seguro de Anular el Comprobante', 
                        function(e){
                            if(e == 'yes'){
                                var box = Ext.MessageBox.wait('Procesando', 'Anulando Comprobante')
                                Ext.Ajax.request({
                                    url: '/inoF2/AnularComprobante',
                                    params: {                            
                                        idcomprobante: record.get('idcomprobante')//,
                                        //modo:'<?//=$modo->getCaIdmodo()?>'
                                    },
                                    success: function(response, opts) {
                                        var obj = Ext.decode(response.responseText);
                                        
                                        if(obj.errorInfo!="")
                                            Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                        else
                                        {
                                            
                                            store.reload();
                                        }
                                        box.hide();
                                    },
                                    failure: function(response, opts) {
                                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                        box.hide();
                                    }
                                });
                            }
                        })
                    }
                });
            }
            
            if(record.data.estado==6)
            {
                itemCm.push(            
                {
                    text: 'Enviar a Siigo',
                    iconCls:'page_white_magnify',
                    handler: function() {

                        Ext.MessageBox.confirm('Confirmacion', 'esta seguro de generar de nuevo el Comprobante', 
                            function(e){
                                if(e == 'yes'){
                                   var box = Ext.MessageBox.wait('Procesando', 'Enviando Comprobantes')
                                   Ext.Ajax.request({
                                       url: '/inoF/EnviarSiigoConect',
                                       params: {                            
                                           idcomprobante: record.get('idcomprobante')
                                       },
                                       success: function(response, opts) {

                                            var obj = Ext.decode(response.responseText);

                                            alert(obj.toSource());
                                            if(obj.indincor=="+5" || obj.indincor=="5")
                                            {                                                
                                                Ext.MessageBox.alert("Colsys", "Se registro correctamente la informacion");
                                                this.up('grid').getStore().reload();
                                            }                                            
                                            box.hide();
                                       },
                                       failure: function(response, opts) {
                                           Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                           box.hide();
                                       }
                                  });
                                }
                            })

                        //window.open("/inocomprobantes/generarComprobantePDF/id/"+record.get('idcomprobante'))
                    }
                }
                );
            
            }
    
            var menu = new Ext.menu.Menu({
                items: itemCm
            }).showAt(e.getXY());
        }
                

    }
    
    
    
    
})

function viewGridFac(idcomprobante,comprobante,idmaster)
{
    
    
    myWindow = Ext.create('Ext.window.Window', {
    title: 'Conceptos de '+comprobante,
    width: 500,
    height: 300, 
    layout: {
        type: 'hbox',
        align: 'stretch'
    },
    items: [
        {
        xtype:'Colsys.Ino.GridConceptosFact',
        idcomprobante:idcomprobante,
        idmaster:idmaster
        }
    ]
});
myWindow.show();

}




/*Ext.define('Colsys.Ino.PanelFactura', {
    extend: 'Ext.tree.Panel',
    //extend: 'Ext.panel.Table',
    alias: 'widget.Colsys.Ino.PanelFactura',

    title: 'Core Team Projects',
    width: 500,
    height: 300,
    collapsible: true,
    useArrows: true,
    rootVisible: false,
    multiSelect: true,
    
    onRender: function(ct, position){      
        this.reconfigure(
                
            Ext.create('Ext.data.Store', {
                 fields: [
                    {name: 'iddetalle'+this.idmaster        ,mapping: 'iddetalle'        , type: 'int'},
                    {name: 'idhouse'+this.idmaster          ,mapping: 'idhouse'          , type: 'int'},
                    {name: 'idcomprobante'+this.idmaster    ,mapping: 'idcomprobante'    , type: 'int'},
                    {name: 'comprobante'+this.idmaster      ,mapping: 'comprobante'      , type: 'string'},            
                    {name: 'fchcomprobante'+this.idmaster   ,mapping: 'fchcomprobante'   , type: 'date', dateFormat: 'Y-m-d'},
                    {name: 'cliente'+this.idmaster          ,mapping: 'cliente'          , type: 'string'},
                    {name: 'doctransporte'+this.idmaster    ,mapping: 'doctransporte'    , type: 'string'},
                    {name: 'idmoneda'+this.idmaster         ,mapping: 'idmoneda'         , type: 'int'},
                    {name: 'moneda'+this.idmaster           ,mapping: 'moneda'           , type: 'string'},
                    {name: 'valor'+this.idmaster            ,mapping: 'valor'            , type: 'float'},
                    {name: 'idconcepto'+this.idmaster       ,mapping: 'idconcepto'       , type: 'int'},
                    {name: 'concepto'+this.idmaster         ,mapping: 'concepto'         , type: 'string'},
                    {name: 'cuentapago'+this.idmaster       ,mapping: 'cuentapago'       , type: 'string'},        
                    {name: 'estado'+this.idmaster           ,mapping: 'estado'           , type: 'int'},
                    {name: 'idccosto'+this.idmaster         ,mapping: 'idccosto'         , type: 'int'}
                 ],      
                 proxy: {
                     type: 'ajax',
                     url: '/inoF2/datosFacturas',
                     reader: {
                         type: 'json',
                         root: 'root'
                     }
                 },
                 groupField: 'comprobante'+this.idmaster,
                 sorters: [{
                     property: 'comprobante'+this.idmaster,
                     direction: 'ASC'
                 }],
                 autoLoad: false
            }),
            [
                {
                    id: 'comprobante',
                    //header: 'No factura',
                    dataIndex: 'comprobante',
                    flex: 1,
                    hidden:true

                },
                {
                    header: 'Concepto',
                    dataIndex: 'concepto'+this.idmaster,
                    width: 400,
                    editor: { xtype:'Colsys.Widgets.wgConceptosSiigo',
                        id:'combo-conceptos'+this.idmaster,
                        name:'combo-conceptos'+this.idmaster,
                        idtransporte:this.idtransporte,
                        idimpoexpo:this.idimpoexpo
                    }
                },
                {
                    header: 'Valor',
                    dataIndex: 'valor'+this.idmaster,
                    width: 150,
                    align: 'right',
                    renderer:Ext.util.Format.usMoney,

                    editor: {
                        xtype: 'numberfield',
                        allowBlank: false,
                        minValue: 0
                        //,maxValue: 100000
                    }
                },

                {
                    id: 'observaciones',
                    header: 'Observaciones',
                    dataIndex: 'observaciones'+this.idmaster,
                    //flex: 1,
                    width:400,
                    editor: {
                        xtype: 'htmleditor'
                    },
                    value:''
                }
            ]);
        
        this.features= [{
            id: 'comprobante'+this.idmaster,
            ftype: 'grouping',
            hideGroupedHeader: true,
            totalSummary: 'fixed',          // Can be: 'fixed', true, false. Default: false
            totalSummaryTopLine: true,      // Default: true
            totalSummaryColumnLines: true  // Default: false
        }]
      
      

    tb = new Ext.toolbar.Toolbar();
    tb.add(
            [{
        text: 'Agregar',
        iconCls: 'add',
        handler : function(){        
            this.up('grid').ventanaFac(null)
        }
    },
    {
        text: 'Guardar',
        iconCls: 'add',
        id:'btn-guardar'+this.idmaster,
        handler : function(){
            b=this;
            b.disable();
            //Ext.getCmp('btn-guardar'+this.idmaster).disable();
            var store =this.up('grid').getStore();
            idmaster=this.up('grid').idmaster;
            var r = Ext.create(store.getModel());
            //console.log(r.fields);
            var str= JSON.stringify(r.fields,"");
            fields= new Array();
            for(i=0;i<r.fields.length;i++)
            {
                fields.push(r.fields[i].mapping);
            }
            
            var records = this.up('grid').getStore().getModifiedRecords();
            var lenght = records.length;            
            changes=[];
            changes1=[];
            for( var i=0; i< lenght; i++){                
                r = records[i];

                 
                records[i].data.id=r.id
                changes1[i]=records[i].data;               
                
                row=new Object();
                for(j=0;j<fields.length;j++)
                {
                    //console.log(fields[j]);
                    eval("row."+fields[j]+"=records[i].data."+fields[j]+idmaster+";")
                    //console.log(row);
                }
                row.id=r.id
                changes[i]=row;
            }

            var str= JSON.stringify(changes);
            if(str.length>5)
            {
                var box = Ext.MessageBox.wait('Procesando', 'Guardando Informacion')
                Ext.Ajax.request({
                        url: '/inoF2/guardarGridFacturacion',
                        params: {                            
                            datos:str                            
                        },
                        success: function(response, opts) {
                            var res = Ext.decode(response.responseText);
                            
                            if( res.id && res.success)
                            {
                                id=res.id.split(",");
                                idreg=res.idreg.split(",");
                                for(i=0;i<id.length;i++)
                                {
                                    var rec = store.getById( id[i] );
                                    rec.set("iddetalle"+this.idmaster,idreg[i]);
                                    rec.commit();                                    
                                }
                                Ext.MessageBox.alert("Mensaje",'Se guardo Correctamente la información');
                            }
                            if(res.errorInfo!="")
                            {
                                Ext.MessageBox.alert("Mensaje",'No fue posible el guardar la fila <br>'+res.errorInfo);
                            }
                            box.hide();
                            b.enable();
                            
                        },
                        failure: function(response, opts) {
                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                            box.hide();
                            
                            b.enable();
                        }
                    });
              }
              else
                  b.enable();              
        }
    }
    ]
    );

        this.addDocked(tb);
        this.superclass.onRender.call(this, ct, position);
    }
        
        
        
    });
    
*/


/*
Ext.define('Task', {
    extend: 'Ext.data.TreeModel',
    fields: [
        {name: 'task',     type: 'string'},
        {name: 'user',     type: 'string'},
        {name: 'duration', type: 'string'},
        {name: 'done',     type: 'boolean'}
    ]
});

    

    var store = Ext.create('Ext.data.TreeStore', {
        model: 'Task',
        proxy: {
            type: 'ajax',
            //the store will get the content from the .json file
            url: 'treegrid.json'
        },
        folderSort: true
    });

    //Ext.ux.tree.TreeGrid is no longer a Ux. You can simply use a tree.TreePanel
    Ext.define('Colsys.Ino.PanelFactura', {
    extend: 'Ext.tree.Panel',
    //extend: 'Ext.panel.Table',
    alias: 'widget.Colsys.Ino.PanelFactura',
    //var tree = Ext.create('Ext.tree.Panel', {
        title: 'Core Team Projects',
        width: 500,
        height: 300,
        //renderTo: Ext.getBody(),
        collapsible: true,
        useArrows: true,
        rootVisible: false,
        store: store,
        multiSelect: true,
        columns: [{
            xtype: 'treecolumn', //this is so we know which column will show the tree
            text: 'Task',
            width: 200,
            sortable: true,
            dataIndex: 'task',
            locked: true
        }, {
            //we must use the templateheader component so we can use a custom tpl
            xtype: 'templatecolumn',
            text: 'Duration',
            width: 150,
            sortable: true,
            dataIndex: 'duration',
            align: 'center',
            //add in the custom tpl for the rows
            tpl: Ext.create('Ext.XTemplate', '{duration:this.formatHours}', {
                formatHours: function(v) {
                    if (v < 1) {
                        return Math.round(v * 60) + ' mins';
                    } else if (Math.floor(v) !== v) {
                        var min = v - Math.floor(v);
                        return Math.floor(v) + 'h ' + Math.round(min * 60) + 'm';
                    } else {
                        return v + ' hour' + (v === 1 ? '' : 's');
                    }
                }
            })
        }, {
            text: 'Assigned To',
            width: 150,
            dataIndex: 'user',
            sortable: true
        }, {
            xtype: 'checkcolumn',
            header: 'Done',
            dataIndex: 'done',
            width: 40,
            stopSelection: false
        }, {
            text: 'Edit',
            width: 40,
            menuDisabled: true,
            xtype: 'actioncolumn',
            tooltip: 'Edit task',
            align: 'center',
            icon: '../simple-tasks/resources/images/edit_task.png',
            handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
                Ext.Msg.alert('Editing' + (record.get('done') ? ' completed task' : '') , record.get('task'));
            },
            // Only leaf level tasks may be edited
            isDisabled: function(view, rowIdx, colIdx, item, record) {
                return !record.data.leaf;
            }
        }]
    });


*/