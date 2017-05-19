
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

winSobreventa=null;
//var constrainedWin2=null;
   
Ext.define('Colsys.Ino.GridBasic', {
  extend: 'Ext.grid.Panel',
  alias: 'widget.Colsys.Ino.Gridbasic',    
    features: [{           
            ftype: 'summary'
        }],
    
    onRender: function(ct, position)
    {
        this.reconfigure(
            Ext.create('Ext.data.Store', {
                fields: [
                   {name: 'idmaster'+this.idmaster, type: 'integer', mapping: 'c_ca_idmaster'},
                   {name: 'idinocosto'+this.idmaster, type: 'integer', mapping: 'c_ca_idinocosto'},
                   {name: 'idcosto'+this.idmaster, type: 'integer', mapping: 'c_ca_idcosto'},
                   {name: 'concepto'+this.idmaster, type: 'string', mapping: 'cs_ca_concepto'},
                   {name: 'idproveedor'+this.idmaster, type: 'integer', mapping: 'c_ca_idproveedor'},
                   {name: 'proveedor'+this.idmaster, type: 'string', mapping: 'i_ca_nombre'},
                   {name: 'factura'+this.idmaster, type: 'string', mapping: 'c_ca_factura'},
                   {name: 'fchfactura'+this.idmaster, type: 'string', mapping: 'c_ca_fchfactura'},
                   {name: 'idmoneda'+this.idmaster, type: 'string', mapping: 'c_ca_idmoneda'},            
                   {name: 'neto'+this.idmaster, type: 'float', mapping: 'c_ca_neto'},
                   {name: 'neto_usd'+this.idmaster, type: 'float', mapping: 'ca_neto_usd'},
                   {name: 'venta'+this.idmaster, type: 'float', mapping: 'c_ca_venta'},
                   {name: 'tcambio'+this.idmaster, type: 'float', mapping: 'c_ca_tcambio' },
                   {name: 'tcambio_usd'+this.idmaster, type: 'float', mapping: 'c_ca_tcambio_usd'},   
                   {name: 'valor_pesos'+this.idmaster, type: 'float' },
                   {name: 'utilidad'+this.idmaster, type: 'float' },            
                   {name: 'color', type: 'string'}
                ],
                proxy: {
                    type: 'ajax',
                    url: '/inoF2/datosGridCostos',
                    reader: {
                        type: 'json',
                        rootProperty: 'root',
                        totalProperty: 'total'
                    }
                },        
                sorters: [{
                    property: 'proveedor',
                    direction: 'ASC'
                }],
                autoLoad: true
            }),
            [
                {
                    header: "Costo",
                    dataIndex: 'concepto'+this.idmaster,
                    //hideable: false,
                    sortable: true,
                    width: 120,
                    //renderer: this.formatItem,
                    summaryRenderer: function(value, summaryData, dataIndex) {
                        return "<span style='font-weight: bold;'>Total</span>"; 
                    },
                    editor: { xtype:'Colsys.Widgets.wgConceptos',
                        //id:'combo-conceptos'+this.idmaster,
                        //name:'combo-conceptos'+this.idmaster,
                        costo:'true',
                        idtransporte:this.idtransporte,
                        idimpoexpo:this.idimpoexpo
                    }
                }, 
                {
                    header: "Factura",
                    dataIndex: 'factura'+this.idmaster,
                    hideable: false,
                    sortable: true,
                    width: 80
                },
                {
                    header: "Fecha<br>Factura",
                    dataIndex: 'fchfactura'+this.idmaster,
                    hideable: false,
                    sortable: true,
                    width: 80
                },
                {
                    header: "Moneda",
                    dataIndex: 'idmoneda'+this.idmaster,
                    hideable: false,
                    sortable: true,
                    width: 70,
                    align: 'left'
                },        
                {
                    header: "Neta",
                    dataIndex: 'neto'+this.idmaster,
                    hideable: false,
                    sortable: true,
                    width: 80,
                    align: 'right',
                    renderer: Ext.util.Format.numberRenderer('0,0.00'),        
                    summaryType: 'sum',
                    summaryRenderer: function(value, summaryData, dataIndex) {
                            return "<span style='font-weight: bold;'> "+Ext.util.Format.usMoney(value)+"</span>";
                        }

                },        
                {
                    header: "Cambio<br>USD",
                    dataIndex: 'tcambio_usd'+this.idmaster,
                    hideable: false,
                    sortable: true,
                    width: 80,
                    align: 'right',
                    renderer: Ext.util.Format.numberRenderer('0,0.00'),
                    summaryType: 'sum',
                    summaryRenderer: function(value, summaryData, dataIndex) {
                        return "<span style='font-weight: bold;'> "+Ext.util.Format.usMoney(value)+"</span>";
                    }
                },
                {
                    header: "Neta<br>USD",
                    dataIndex: 'neto_usd'+this.idmaster,
                    hideable: false,
                    sortable: true,
                    width: 80,
                    align: 'right',
                    renderer: Ext.util.Format.numberRenderer('0,0.00'),        
                    summaryType: 'sum',
                    summaryRenderer: function(value, summaryData, dataIndex) {
                            return "<span style='font-weight: bold;'> "+Ext.util.Format.usMoney(value)+"</span>";
                        }
                },
                {
                    header: "Cambio<br>"+this.monedalocal,
                    dataIndex: 'tcambio'+this.idmaster,
                    hideable: false,
                    sortable: true,
                    width: 80,
                    align: 'right',
                    renderer: Ext.util.Format.numberRenderer('0,0.00'),
                    summaryType: 'sum',
                    summaryRenderer: function(value, summaryData, dataIndex) {
                            return "<span style='font-weight: bold;'> "+Ext.util.Format.usMoney(value)+"</span>";
                        }       
                },
                {
                    header: "Valor "+this.monedalocal,
                    dataIndex: 'valor_pesos'+this.idmaster,
                    hideable: false,
                    sortable: false,
                    width: 80,
                    align: 'right',
                    renderer: this.valorPesos,
                    summaryType: 'sum',
                    summaryRenderer: function(value, summaryData, dataIndex) {
                        return "<span style='font-weight: bold;'> "+Ext.util.Format.usMoney(value)+"</span>";
                    }
                },
                {
                    header: "Venta "+this.monedalocal,
                    dataIndex: 'venta'+this.idmaster,
                    hideable: false,
                    sortable: false,
                    width: 100,
                    align: 'right',
                    renderer: Ext.util.Format.numberRenderer('0,0.00'),
                    summaryType: 'sum',
                    summaryRenderer: function(value, summaryData, dataIndex) {
                        return "<span style='font-weight: bold;'> "+Ext.util.Format.usMoney(value)+"</span>";
                    }

                },
                /*{
                  header: "INO x Sobreventa",
                  dataIndex: 'utilidad',
                  hideable: false,
                  sortable: true,
                  width: 100,
                  align: 'right',
                  renderer: this.utilidad,
                  summaryType: 'sum',
                  summaryRenderer: function(value, summaryData, dataIndex) {
                        return "<b> "+Ext.util.Format.usMoney(value)+"</b>";
                    }
                },
                {
                    header: "Moneda",
                    dataIndex: 'idmoneda',
                    hideable: false,
                    sortable: true,
                    width: 80,
                    align: 'left'
                },*/
                {
                    header: "Proveedor",
                    dataIndex: 'proveedor'+this.idmaster,
                    //hideable: false,
                    sortable: true,
                    width: 300,
                    tpl: '<span class="x-form-item-label-default">{proveedor}</span>'

                },
                {
                    xtype:'actioncolumn',
                    width:50,
                    items: [{
                        iconCls: 'import',
                        tooltip: 'INO x Sobreventa',
                        handler: function(grid, rowIndex, colIndex) {
                            /*var rec = grid.getStore().getAt(rowIndex);
                            alert("Edit " + rec.get('firstname'));
                            */
                           var rec = grid.getStore().getAt(rowIndex);                                                       
                            if(winSobreventa==null)
                            {
                                winSobreventa=Ext.create('Ext.window.Window', {
                                    title: 'Ino x Sobreventa',
                                    height: 200,
                                    width: 600,
                                    layout: 'fit',
                                    //closeAction :'hide',
                                    items: [
                                        {
                                            xtype:"Colsys.Ino.GridSobreventa",
                                            idmaster:this.up('grid').idmaster,
                                            idinocosto:rec.data.c_ca_idinocosto
                                        }
                                    ],
                                    listeners:{
                                        destroy:function( obj, eOpts )
                                        {
                                            winSobreventa=null;
                                        }
                                    }
                                });
                                winSobreventa.show();
                            }
                            else
                            {
                                Ext.Msg.alert("Ino", "Existe una ventana abierta de Sobreventa<br>Por favor cierrela primero");
                            }
                        }
                    }]
                }
            ]
        );
       this.superclass.onRender.call(this, ct, position);   
    },
    selModel: {
        selType: 'cellmodel'
    },
    //renderTo: 'editor-grid',
    width: 600,
    //height: 300,
    autoHeight: true,
    //title: 'Edit Plants?',
    frame: true,

    tbar: [{
        text: 'Agregar',
        iconCls: 'add',
        handler : function(){
            //document.location = "/inoF/formCosto/modo/6/idmaster/"+this.idmaster;       
        
        }
    },
    {
        text: 'Guardar',
        iconCls: 'add',
        handler : function(){
            var store = this.up('grid').getStore();
            var records = store.getModifiedRecords();
            var lenght = records.length;

            changes=[];
            for( var i=0; i< lenght; i++){
                r = records[i];

                 if( r.data.iditem!="" && r.getChanges())
                 {                
                    records[i].data.id=r.id                    
                    changes[i]=records[i].data;               
                 }
            }
            
            
            var str= JSON.stringify(changes);
            if(str.length>5)
            {
                Ext.Ajax.request({
                    url: 'inoF/guardarGridHouse',
                    params: {                            
                        datos:str                            
                    },

                    callback :function(options, success, response){
                        var res = Ext.util.JSON.decode( response.responseText );
                        store=this.up('grid').getStore();
                        store.reload()
                        /*store.each(function(r){
                            if(r.id==res.id){
                                store.remove(r);
                                Ext.Msg.alert("Success", "Se guardaron correctamente los datos");
                            }
                        });*/

                    }
                });
             }
            //alert(changes.toSource());
        }
    }
    ],
    plugins: [
    new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    listeners: {
        
        activate: function(ct, position){
           if(this.load==false || this.load=="undefined" || !this.load)
           {

                this.store.proxy.extraParams = {
                    idmaster: this.idmaster
                }
                this.store.reload();
                this.load=true;
            }
           //this.superclass.onRender.call(this, ct, position);
        },
        edit : function(editor, e, eOpts)
        {
            //alert(e.value);
            var store = this.getStore();
            
            if(e.field=="concepto"+this.idmaster)
            {
                //alert(editor.editors.items[0].field.rawValue);
                //alert(e.value);                
                store.data.items[e.rowIdx].set('idcosto'+this.idmaster, e.value);
                store.data.items[e.rowIdx].set('concepto'+this.idmaster, editor.editors.items[0].field.rawValue);                
            }
            /*else if(e.field=="valor")
            {
                var store = Ext.getCmp("grid-facturacion").getStore();
                        var r = Ext.create('recfac', {
                            comprobante: e.record.get('comprobante'),
                            idcomprobante: e.record.get('idcomprobante'),
                            idhouse: e.record.get('idhouse'),
                            idccosto: e.record.get('idccosto')
                            });
                        store.insert(0, r);
            }*/
        },

      beforeitemcontextmenu: function(view, record, item, index, e)
      {
        e.stopEvent();
        var record = this.store.getAt(index);
        

        var menu = new Ext.menu.Menu({
            items: [
              {
                    text: 'Editar',                    
                    handler: function() {
                    document.location = '/inoF/formCosto/modo=6/idinocosto/'+record.get('idinocosto');
                    }
                },
                {
                    text: 'Eliminar',
                    iconCls: 'delete',
                    handler: function() {                        
                       Ext.MessageBox.confirm('Confirmacion', 'esta seguro de Eliminar el registro', 
                        function(e){
                            if(e == 'yes'){
                                var box = Ext.MessageBox.wait('Procesando', 'Eliminando')
                                Ext.Ajax.request({
                                    url: '/inoF/eliminarGridCostosPanel',
                                    params :{
                                        idinocosto: record.get('idinocosto')//,
                                        //modo: '<?//=$modo->getCaIdmodo()?>'
                                    },
                                    success: function(response, opts) {
                                        var obj = Ext.decode(response.responseText);                                        
                                        if(obj.errorInfo!="")
                                         {
                                            Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                         }
                                        else
                                        {
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
                    }
                }

            ]
        }).showAt(e.xy);
      }

    }

});