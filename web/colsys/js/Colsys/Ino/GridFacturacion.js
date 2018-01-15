/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var constrainedWin2,winNotCre=null,winDeducciones =null;
Ext.define('Colsys.Ino.GridFacturacion', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridFacturacion',
    
    features: [{
            id: 'comprobante',
            ftype: 'groupingsummary',
            hideGroupedHeader: true,
            totalSummary: 'fixed',          // Can be: 'fixed', true, false. Default: false
            totalSummaryTopLine: true,      // Default: true
            totalSummaryColumnLines: true  // Default: false
        }],

/*           features: [{
            id: 'comprobante',
            ftype: 'grouping',
            hideGroupedHeader: true,
            totalSummary: 'fixed',          // Can be: 'fixed', true, false. Default: false
            totalSummaryTopLine: true,      // Default: true
            totalSummaryColumnLines: true  // Default: false
        }],
*/
    //height:300,
    
    selModel: {
        selType: 'cellmodel'
    },
//    width: 600,
    frame: true,
    
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    listeners: {
        activate: function(ct, position){
            //alert(this.load);
           if(this.load==false || this.load=="undefined" || !this.load)
           {

                this.store.proxy.extraParams = {
                    idmaster: this.idmaster
                }
                this.store.reload();
                this.load=true;
            }
        },           
        beforeedit: function( plugin, e )
        {            
            var rec = e.record;
            //console.log(rec);
            
            if(rec.data.estado>0)
                return false;
            if(e.field=="concepto"+this.idmaster)
            {
                //alert(rec.data.toSource());
                eval("idcom=rec.data.idcomprobante"+this.idmaster);
                Ext.getCmp("combo-conceptos"+this.idmaster).setModo('6',idcom);
                
            }
        },
        edit : function(editor, e, eOpts)
        {
            //alert(e.value);
            //var store = Ext.getCmp("grid-facturacion").getStore();
            //var store = this.up('grid').getStore();
            var store = this.getStore();
            
            if(e.field=="concepto"+this.idmaster)
            {
                //alert(editor.editors.items[0].field.rawValue);
                //alert(e.value);
                store.data.items[e.rowIdx].set('idconcepto'+this.idmaster, e.value);
                store.data.items[e.rowIdx].set('concepto'+this.idmaster, editor.editors.items[0].field.rawValue);                
            }
            record= e.record;
                var records = store.getRange() ;
                recordLast=records[records.length-1];
                if( recordLast.get("valor")>0 && recordLast.get("idconcepto")>0) 
                {
                        var r = Ext.create(store.getModel());
                            r.set('comprobante',record.get('comprobante'));
                            r.set('idcomprobante',record.get('idcomprobante'));
                            r.set('idhouse',record.get('idhouse'));
                            r.set('idccosto',record.get('idccosto'));
                            store.insert(0, r);
                }
        },        
        beforerender:function(me, opts)
        {            
            this.setHeight(Ext.getCmp('tab'+this.idmaster).getHeight()-130);
            this.setWidth(this.up('tabpanel').up('tabpanel').getWidth()-80);
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
                             rootProperty: 'root'
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
                        },
                        summaryRenderer: function(value, summaryData, dataIndex) {
                            return "<b>Total : "+Ext.util.Format.usMoney(value)+"</b>";
                        },
                        summaryType: 'sum'/*function(records){
                            var i = 0,
                                length = records.length,
                                total = 0,
                                record;
                            for (; i < length; ++i) {
                                record = records[i];
                                

                                if(!isNaN(record.get('valor'+this.idmaster)))
                                {
                                    alert("121");
                                    total += record.get('valor'+this.idmaster);
                                }
                            }
                            
                            return total;
                        }*/
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
                    },{
                            menuDisabled: true,
                            sortable: false,
                            xtype: 'actioncolumn',
                            width: 20,
                            items: [{
                                    iconCls: 'import',
                                    tooltip: 'Deducciones',
                                    handler: function (grid, rowIndex, colIndex) {
                                        me = this;
                                        var store = me.up('grid').getStore();
                                        var rec = grid.getStore().getAt(rowIndex);
                                        
                                        viewGridDed(rec.data.idcomprobante,this.up('grid').idimpoexpo,this.up('grid').idtransporte,this.up('grid').idmaster);
                                        
                                    }
                                }]
                        }                        
            ]);
        
          //console.log(this.estado);
            if(this.permisos.Crear == true ){

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
                      else{
                          b.enable();    
                      }
                }
            }
            ]);

            this.addDocked(tb);
        }
        
        
        },
        beforeitemcontextmenu: function(view, record, item, index, e)                                       
        {
            e.stopEvent();
            //var store = Ext.getCmp("grid-facturacion"+this.idmaster).getStore();
            //var store = this.up('grid').getStore();
            idmaster=this.idmaster;
            var store=this.store;
            
            //console.log(e.getXY());
            //alert("item: "+item + "<br>index:"+index);
            
            itemCm = new Array();
            if(record.data.estado<=1)
            {
                itemCm.push(
                {
                    text: 'Editar',
                    handler: function() {
                        //Ext.getCmp("grid-facturacion").ventanaFac(record);
                        this.up('grid').ventanaFac(record);
                        
                    }
                },
                {
                    text: 'Agregar Concepto',
                    iconCls: 'add',
                    handler: function() {
                        
                            var r = Ext.create(store.getModel());
                            r.set('comprobante'+idmaster,record.get('comprobante'+idmaster));
                            r.set('idcomprobante'+idmaster,record.get('idcomprobante'+idmaster));
                            r.set('idhouse'+idmaster,record.get('idhouse'+idmaster));
                            r.set('idccosto'+idmaster,record.get('idccosto'+idmaster));
                            store.insert(0, r);
                            //alert(index)
                            //this.up("grid").reconfigure();
                            
                         /*var r = Ext.create('recfac', {
                            comprobante12176: record.get('comprobante'+idmaster),
                            idcomprobante12176: record.get('idcomprobante'+idmaster),
                            idhouse12176: record.get('idhouse'+idmaster),
                            idccosto12176: record.get('idccosto'+idmaster)
                            });
                        store.insert(0, r);*/
                    }
                },
                {
                    text: 'Eliminar Concepto',
                    iconCls: 'delete',
                    handler: function() {
                        Ext.MessageBox.confirm('Confirmacion', 'esta seguro de eliminar el concepto', 
                        function(e){
                            if(e == 'yes'){
                               var box = Ext.MessageBox.wait('Procesando', 'Eliminando Concepto')
                               Ext.Ajax.request({
                                   url: '/inoF2/EliminarGridFacturacionPanel',
                                   params: {                            
                                       iddetalle: record.get('iddetalle')
                                   },
                                   success: function(response, opts) {
                                        var obj = Ext.decode(response.responseText);

                                        if(obj.errorInfo!="")
                                            Ext.MessageBox.alert("Colsys", "Se genero el Comprobante No. " + obj.errorInfo);
                                        else
                                            ///Ext.getCmp("grid-facturacion").getStore().reload();
                                            this.up('grid').getStore().reload();
                                        
                                        box.hide();

                                   },
                                   failure: function(response, opts) {
                                       Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                       box.hide();
                                   }
                              });
                            }
                        }
                    )}
                });
            }
        
            itemCm.push(
            {
                text: 'Ver Comprobante',
                iconCls:'page_white_magnify',
                handler: function() {
                    //alert(record.data.toSource());
                    //window.open("/inocomprobantes/generarComprobantePDF/id/"+record.get('idcomprobante'))
                    var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                        sorc: "/inocomprobantes/genComprobantePDF/id/"+record.get('idcomprobante')+"/sap/1"
                    });
                    windowpdf.show();
                }
            }
            );
            
            if(record.data.estado<=1   )
            {
                itemCm.push({
                    text: 'Generar Comprobante',
                    iconCls: 'import',
                    disabled:(record.data.cuentapago!=""?false:true),
                    tooltip: (record.data.cuentapago!=""?'':'Debe asignar la forma de pago del cliente'),
                    handler: function() {                        
                        Ext.MessageBox.confirm('Confirmacion', 'esta seguro de Generar el Comprobante y contabilizarla?', 
                        function(e){
                            if(e == 'yes'){
                               var box = Ext.MessageBox.wait('Procesando', 'Generacion de Comprobante')
                               Ext.Ajax.request({
                                   url: '/inoF2/generarFactura" ',
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
                                   url: '/inoF2/EliminarGridFacturacionPanel',
                                   params: {                            
                                       idcomprobante: record.get('idcomprobante')
                                   },
                                   success: function(response, opts) {
                                        var obj = Ext.decode(response.responseText);

                                        if(obj.errorInfo!="")
                                            Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                        else
                                            this.up('grid').getStore().reload();
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
                }
                )
            }
            
            if(record.data.estado==5  )
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
                                    url: 'inoF2/AnularComprobante',
                                    params: {                            
                                        idcomprobante: record.get('idcomprobante')//,
                                        //modo:'<?//=$modo->getCaIdmodo()?>'
                                    },
                                    success: function(response, opts) {
                                        var obj = Ext.decode(response.responseText);
                                        if(obj.errorInfo!="")
                                            Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                        else
                                            this.up('grid').getStore().reload();
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
                                       url: '/inoF2/EnviarSiigoConect',
                                       params: {                            
                                           idcomprobante: record.get('idcomprobante')
                                       },
                                       success: function(response, opts) {

                                            var obj = Ext.decode(response.responseText);

                                            //alert(obj.toSource());
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
            //console.log(itemCm);
            var menu = new Ext.menu.Menu({
                items: itemCm
            }).showAt(e.getXY());
        }
    },
    ventanaFac : function(record,tipo)
    {
        //console.log(record);
        //alert(tipo);
        //console.log(this.idmaster)
        
        if(constrainedWin2==null)
        {
            constrainedWin2 = Ext.create('Ext.Window', {
                title: 'Factura',
                width: 800,
                autoHeight: true,
                closeAction: 'hide',
                //x: 120,
                //y: 120,
                id:"winFormEdit",
                name:"winFormEdit",
                //constrainHeader: true,
                //frame: true,
                layout: 'form',
                items: [{
                    xtype:'Colsys.Ino.FormFactura',
                    id:'form-panel'+this.idmaster,
                    name:'form-panel'+this.idmaster,
                    idmaster: this.idmaster,
                    idcomprobante:(record!=null)?record.data.idcomprobante:"0",
                    ino:(record!=null)?true:false
                }]
            })
        }
        if(record!=null)
        {
            Ext.getCmp("form-panel"+this.idmaster).cargar(record.data.idcomprobante);            
        }
        else
            Ext.getCmp("form-panel"+this.idmaster).getForm().reset();
        //if(tipo=="C")
//            Ext.getCmp("form-panel").config(tipo);
          constrainedWin2.show();
    }
});
function viewGridDed(idcomprobante,impoexpo,transporte, idmaster) {
    if (winDeducciones == null) {
        winDeducciones = new Ext.Window({
            title: 'Deducciones',
            width: 650, 
            id: 'deduccioones' + idmaster,
            height: 400,
            items: {
                xtype: 'Colsys.Ino.GridDeducciones',
                idtransporte: transporte,
                idimpoexpo: impoexpo,
                idcomprobante: idcomprobante,
                idmaster: idmaster
            },
            listeners: {
                close: function (win, eOpts) {
                    winDeducciones = null;
                }
            }
        })
    }
    winDeducciones.show();
}
