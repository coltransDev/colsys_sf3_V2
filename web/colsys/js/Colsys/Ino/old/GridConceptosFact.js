/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */









Ext.define('Colsys.Ino.GridConceptosFact', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridConceptosFact',
    
    features: [{
            id: 'comprobante',
            ftype: 'summary',
            hideGroupedHeader: true,
            totalSummary: 'fixed',          // Can be: 'fixed', true, false. Default: false
            totalSummaryTopLine: true,      // Default: true
            totalSummaryColumnLines: true  // Default: false
        }],
    
    store:Ext.create('Ext.data.Store', {
            fields: [
               {name: 'iddetalle'        ,mapping: 'iddetalle'        , type: 'int'},
               {name: 'idhouse'          ,mapping: 'idhouse'          , type: 'int'},
               {name: 'idcomprobante'    ,mapping: 'idcomprobante'    , type: 'int'},
               {name: 'comprobante'      ,mapping: 'comprobante'      , type: 'string'},            
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
               {name: 'idccosto'         ,mapping: 'idccosto'         , type: 'int'}
            ],      
            proxy: {
                type: 'ajax',
                url: '/inoF2/datosConceptosFact',
                //extraParams:{'idcomprobante':this.idcomprobante},
                reader: {
                    type: 'json',
                    root: 'root'
                }
            },
            //groupField: 'comprobante'+this.idcomprobante,
            sorters: [{
                property: 'comprobante',
                direction: 'ASC'
            }],
            autoLoad: false
       }),
       columns:[
                {
                    id: 'comprobante',
                    //header: 'No factura',
                    dataIndex: 'comprobante',
                    flex: 1,
                    hidden:true

                },
                {
                    header: 'Concepto',
                    dataIndex: 'concepto',
                    width: 250,
                    editor: { xtype:'Colsys.Widgets.wgConceptosSiigo',
                        id:'combo-conceptos',
                        name:'combo-conceptos',
                        idtransporte:this.idtransporte,
                        idimpoexpo:this.idimpoexpo
                    },
                    summaryRenderer: function(value, summaryData, dataIndex) {
                            return "<b>Total</b>";
                        }
                },
                {
                    header: 'Valor',
                    dataIndex: 'valor',
                    width: 120,
                    align: 'right',
                    renderer:Ext.util.Format.usMoney,

                    editor: {
                        xtype: 'numberfield',
                        allowBlank: false,
                        minValue: 0
                        //,maxValue: 100000
                    },

                    summaryRenderer: function(value, summaryData, dataIndex) {
                            return Ext.util.Format.usMoney(value);
                        },
                    summaryType: 'sum'/*function(records){
                        var i = 0,
                            length = records.length,
                            total = 0,
                            record;
                        for (; i < length; ++i) {
                            record = records[i];
                            total += record.get('valor');
                        }
                        return total;
                    }*/
                }
            ],
    
    onRender: function(ct, position){      
        /*this.reconfigure(
                
            Ext.create('Ext.data.Store', {
                 fields: [
                    {name: 'iddetalle'+this.idcomprobante        ,mapping: 'iddetalle'        , type: 'int'},
                    {name: 'idhouse'+this.idcomprobante          ,mapping: 'idhouse'          , type: 'int'},
                    {name: 'idcomprobante'+this.idcomprobante    ,mapping: 'idcomprobante'    , type: 'int'},
                    {name: 'comprobante'+this.idcomprobante      ,mapping: 'comprobante'      , type: 'string'},            
                    {name: 'fchcomprobante'+this.idcomprobante   ,mapping: 'fchcomprobante'   , type: 'date', dateFormat: 'Y-m-d'},
                    {name: 'cliente'+this.idcomprobante          ,mapping: 'cliente'          , type: 'string'},
                    {name: 'doctransporte'+this.idcomprobante    ,mapping: 'doctransporte'    , type: 'string'},
                    {name: 'idmoneda'+this.idcomprobante         ,mapping: 'idmoneda'         , type: 'int'},
                    {name: 'moneda'+this.idcomprobante           ,mapping: 'moneda'           , type: 'string'},
                    {name: 'valor'+this.idcomprobante            ,mapping: 'valor'            , type: 'float'},
                    {name: 'idconcepto'+this.idcomprobante       ,mapping: 'idconcepto'       , type: 'int'},
                    {name: 'concepto'+this.idcomprobante         ,mapping: 'concepto'         , type: 'string'},
                    {name: 'cuentapago'+this.idcomprobante       ,mapping: 'cuentapago'       , type: 'string'},        
                    {name: 'estado'+this.idcomprobante           ,mapping: 'estado'           , type: 'int'},
                    {name: 'idccosto'+this.idcomprobante         ,mapping: 'idccosto'         , type: 'int'}
                 ],      
                 proxy: {
                     type: 'ajax',
                     url: '/inoF2/datosConceptosFact',
                     extraParams:{'idcomprobante':this.idcomprobante},
                     reader: {
                         type: 'json',
                         root: 'root'
                     }
                 },
                 //groupField: 'comprobante'+this.idcomprobante,
                 sorters: [{
                     property: 'comprobante'+this.idcomprobante,
                     direction: 'ASC'
                 }],
                 autoLoad: true
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
                    dataIndex: 'concepto'+this.idcomprobante,
                    width: 250,
                    editor: { xtype:'Colsys.Widgets.wgConceptosSiigo',
                        id:'combo-conceptos'+this.idcomprobante,
                        name:'combo-conceptos'+this.idcomprobante,
                        idtransporte:this.idtransporte,
                        idimpoexpo:this.idimpoexpo
                    },
                    summaryRenderer: function(value, summaryData, dataIndex) {
                            return "<b>Total</b>";
                        }
                },
                {
                    header: 'Valor',
                    dataIndex: 'valor'+this.idcomprobante,
                    width: 120,
                    align: 'right',
                    renderer:Ext.util.Format.usMoney,

                    editor: {
                        xtype: 'numberfield',
                        allowBlank: false,
                        minValue: 0
                        //,maxValue: 100000
                    },

                    summaryRenderer: function(value, summaryData, dataIndex) {
                            return Ext.util.Format.usMoney(value);
                        },
                    summaryType: function(records){
                        var i = 0,
                            length = records.length,
                            total = 0,
                            record;
                        for (; i < length; ++i) {
                            record = records[i];
                            total += record.get('valor');
                        }
                        return total;
                    }
                }
            ]);*/
        
        /*this.features= [{
            id: 'comprobante'+this.idcomprobante,
            ftype: 'grouping',
            hideGroupedHeader: true,
            totalSummary: 'fixed',          // Can be: 'fixed', true, false. Default: false
            totalSummaryTopLine: true,      // Default: true
            totalSummaryColumnLines: true  // Default: false
        }]*/
      if(this.load==false || this.load=="undefined" || !this.load)
           {

                this.store.proxy.extraParams = {
                    idcomprobante: this.idcomprobante
                }
                this.store.reload();
                this.load=true;
            }
      

    tb = new Ext.toolbar.Toolbar();
    tb.add(
            [
    {
        text: 'Guardar',
        iconCls: 'add',
        id:'btn-guardar'+this.idcomprobante,
        handler : function(){
            b=this;
            b.disable();
            //Ext.getCmp('btn-guardar'+this.idcomprobante).disable();
            //console.log(this.up('grid'));
            //console.log(this.up('window'));
            //console.log(this.up('window').up());
            var store =this.up('grid').getStore();
            idmaster =this.up('grid').idmaster;
            
            //idcomprobante=this.up('grid').idcomprobante;
            //var r = Ext.create(store.getModel());
            //console.log(r.fields);
            //var str= JSON.stringify(r.fields,"");
            //fields= new Array();
            //for(i=0;i<r.fields.length;i++)
            //{
            //    fields.push(r.fields[i].mapping);
            //}
            
            var records = this.up('grid').getStore().getModifiedRecords();
            var lenght = records.length;            
            changes=[];
            //changes1=[];
            for( var i=0; i< lenght; i++){                
                r = records[i];

                 if( r.data.idconcepto!="" && r.data.valor!="" && r.getChanges())
                 {                
                    records[i].data.id=r.id
                    changes[i]=records[i].data;               
                 }
                //records[i].data.id=r.id
                //changes1[i]=records[i].data;               
                
                /*row=new Object();
                for(j=0;j<fields.length;j++)
                {
                    //console.log(fields[j]);
                    eval("row."+fields[j]+"=records[i].data."+fields[j]+";")
                    //console.log(row);
                }
                row.id=r.id
                changes[i]=row;*/
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
                                    rec.set("iddetalle"+this.idcomprobante,idreg[i]);
                                    rec.commit();                                    
                                }
                                alert('Se guardo Correctamente la informacion');
                                store.reload();                                
                            }
                            if(res.errorInfo!="")
                            {
                                alert('No fue posible el guardar la fila <br>'+res.errorInfo);
                            }
                            
                            Ext.getCmp('panel-factura-'+idmaster).getStore().reload();
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
    },
    
    /*selModel: {
        selType: 'cellmodel'
    },*/
    width: 600,
    //frame: true,
    
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    listeners: {
        /*activate: function(ct, position){
            
           if(this.load==false || this.load=="undefined" || !this.load)
           {

                this.store.proxy.extraParams = {
                    idcomprobante: this.idcomprobante
                }
                this.store.reload();
                this.load=true;
            }
        },*/           
        beforeedit: function( plugin, e )
        {            
            var rec = e.record;
            //console.log(rec);
            
            if(rec.data.estado>0)
                return false;
            if(e.field=="concepto")
            {
                //alert(rec.data.toSource());
                eval("idcom=rec.data.idcomprobante");
                Ext.getCmp("combo-conceptos").setModo('6',idcom);
                
            }
        },
        edit : function(editor, e, eOpts)
        {
            //alert(e.value);
            //var store = Ext.getCmp("grid-facturacion").getStore();
            //var store = this.up('grid').getStore();
            var store = this.getStore();
            
            if(e.field=="concepto")
            {
                //alert(editor.editors.items[0].field.rawValue);
                //alert(e.value);
                store.data.items[e.rowIdx].set('idconcepto', e.value);
                store.data.items[e.rowIdx].set('concepto', editor.editors.items[0].field.rawValue);                
            }
        },
        beforeitemcontextmenu: function(view, record, item, index, e)                                       
        {
            e.stopEvent();
            //var store = Ext.getCmp("grid-facturacion"+this.idcomprobante).getStore();
            //var store = this.up('grid').getStore();
            idcomprobante=this.idcomprobante;
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
                            r.set('comprobante',record.get('comprobante'));
                            r.set('idcomprobante',record.get('idcomprobante'));
                            r.set('idhouse',record.get('idhouse'));
                            r.set('idccosto',record.get('idccosto'));
                            store.insert(0, r);
                            //alert(index)
                            //this.up("grid").reconfigure();
                            
                         /*var r = Ext.create('recfac', {
                            comprobante12176: record.get('comprobante'+idcomprobante),
                            idcomprobante12176: record.get('idcomprobante'+idcomprobante),
                            idhouse12176: record.get('idhouse'+idcomprobante),
                            idccosto12176: record.get('idccosto'+idcomprobante)
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
                                   url: '/inoF/EliminarGridFacturacionPanel',
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
                        sorc: "/inocomprobantes/generarComprobantePDF/id/"+record.get('idcomprobante')
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
                                   url: '/inoF/generarFactura" ',
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
                }
                
                )
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
            //console.log(itemCm);
            var menu = new Ext.menu.Menu({
                items: itemCm
            }).showAt(e.getXY());
        }
    }

});