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
