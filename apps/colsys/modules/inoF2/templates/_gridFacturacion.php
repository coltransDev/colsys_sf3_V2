<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

//include_component("inoF", "formFacturaExt4",array("idmaster"=>$idmaster));
include_component("widgets4", "wgConceptosSiigo");
$enable=($readOnly=="1")?false:true;
$enable=true;
?>

<script type="text/javascript">
var constrainedWin2,winNotCre=null;
Ext.Loader.setConfig({
    enabled: true
});
//Ext.Loader.setPath('Ext.ux', '../ux');



    Ext.QuickTips.init();

    function formatDate(value){
        return value ? Ext.Date.dateFormat(value, 'M d, Y') : '';
    }
    
    Ext.define('recfac', {
     extend: 'Ext.data.Model',
     fields: [
        {name: 'iddetalle', type: 'int'},
        {name: 'idhouse', type: 'int'},
        {name: 'idcomprobante', type: 'int'},
        {name: 'comprobante', type: 'string'},            
        {name: 'fchcomprobante', type: 'date', dateFormat: 'Y-m-d'},
        {name: 'cliente', type: 'string'},
        {name: 'doctransporte', type: 'string'},
        {name: 'idmoneda', type: 'int'},
        {name: 'moneda', type: 'string'},
        {name: 'valor', type: 'float'},
        {name: 'idconcepto', type: 'int'},
        {name: 'concepto', type: 'string'},
        {name: 'cuentapago', type: 'string'},        
        {name: 'estado', type: 'int'},
        {name: 'idccosto', type: 'int'}
     ]
 });
    
   var store = Ext.create('Ext.data.Store', {
     model: 'recfac',
     proxy: {
         type: 'ajax',
         url: '<?=url_for('inoF2/datosFacturas')?>',
         reader: {
             type: 'json',
             root: 'root'
         }
     },
     groupField: 'comprobante',     
     sorters: [{
         property: 'comprobante',
         direction: 'ASC'
     }],
     autoLoad: false
 });

var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
    clicksToEdit: 1
});    

Ext.define('Colsys.Ino.GridFacturacion', {
  extend: 'Ext.grid.Panel',
  alias: 'widget.wCIGFacturacion',
    store: store,
    //id:'grid-facturacion',
    features: [{
            id: 'comprobante',
            ftype: 'groupingsummary',
            hideGroupedHeader: true,
            totalSummary: 'fixed',          // Can be: 'fixed', true, false. Default: false
            totalSummaryTopLine: true,      // Default: true
            totalSummaryColumnLines: true  // Default: false
        }],
    columns: [
    {
        id: 'comprobante',
        //header: 'No factura',
        dataIndex: 'comprobante',
        flex: 1
        /*,
        editor: {
            allowBlank: false
        }*/
    },
    {
        header: 'Concepto',
        dataIndex: 'concepto',
        width: 400,
        editor: new Ext.colsys.wgConceptosSiigo({
            id:'combo-cosnceptos',
            name:'combo-conceptos'
        }
        /*{
            idccosto:'76'
        }*/
        )
            /*,
        renderer: function(value, metaData, record, row, col, store, gridView){
            //alert(record.data.toSource());
                return record.get("concepto");
            }*/
    },
    {
        header: 'Valor',
        dataIndex: 'valor',
        width: 150,
        align: 'right',
        renderer: 'usMoney',
        editor: {
            xtype: 'numberfield',
            allowBlank: false,
            minValue: 0
            //,maxValue: 100000
        },
        summaryRenderer: function(value, summaryData, dataIndex) {
                return "<b>Total : "+Ext.util.Format.usMoney(value)+"</b>";
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
    },
    
    {
        id: 'observaciones',
        header: 'Observaciones',
        dataIndex: 'observaciones',
        //flex: 1,
        width:400,
        editor: {
            xtype: 'htmleditor'
        },
        value:''
    }    
    ],    
    selModel: {
        selType: 'cellmodel'
    },
    //renderTo: 'editor-grid',
    width: 600,
    height: 300,
    //title: 'Edit Plants?',
    frame: true,
    <?    
    if($enable)
    {
    ?>
    tbar: [{
        text: 'Agregar',
        iconCls: 'add',
        handler : function(){        
            //var store = Ext.getCmp("grid-facturacion").getStore();            
            //Ext.getCmp("grid-facturacion").ventanaFac(null);
            this.up('grid').ventanaFac(null)
        }
    },
    {
        text: 'Guardar',
        iconCls: 'add',
        id:'btn-guardar',
        handler : function(){
            Ext.getCmp('btn-guardar').disable();
            //var store = Ext.getCmp("grid-facturacion").getStore();
            //var store = this.up('grid').getStore();
            
            var records = store.getModifiedRecords();
            var lenght = records.length;

            changes=[];
            for( var i=0; i< lenght; i++){
                r = records[i];

                 if( r.data.idconcepto!="" && r.data.valor!="" && r.getChanges())
                 {                
                    records[i].data.id=r.id                    
                    changes[i]=records[i].data;               
                 }
            }            
            
            var str= JSON.stringify(changes);
            if(str.length>5)
            {
                Ext.Ajax.request({
                        url: '<?= url_for("inoF/guardarGridFacturacion") ?>',
                        params: {                            
                            datos:str                            
                        },
                        success: function(response, opts) {
                            var res = Ext.decode(response.responseText);
                            //var store = Ext.getCmp("grid-facturacion").getStore();
                            var store = this.up('grid').getStore();
                            
                            
                            if( res.id && res.success)
                            {
                                id=res.id.split(",");
                                idreg=res.idreg.split(",");
                                for(i=0;i<id.length;i++)
                                {
                                    var rec = store.getById( id[i] );
                                    rec.set("iddetalle",idreg[i]);
                                    rec.commit();                                    
                                }
                                Ext.MessageBox.alert("Mensaje",'Se guardo Correctamente la información');
                            }
                            if(res.errorInfo!="")
                            {
                                Ext.MessageBox.alert("Mensaje",'No fue posible el guardar la fila <br>'+res.errorInfo);
                            }
                            Ext.getCmp('btn-guardar').enable();
                        },
                        failure: function(response, opts) {
                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                            box.hide();
                            Ext.getCmp('btn-guardar').enable();
                        }
                    });
              }
              else
              Ext.getCmp('btn-guardar').enable();
        }
    }
    
    ],
    <?
    }
    ?>
    
    /*viewConfig: {
        getRowClass: function(record, rowIndex, rowParams, store){
            //alert(record.get("color"));
            if(record.get("estado")>5)
                return "row_pink";
            else if(record.get("estado")==5)
                return "row_green";
                
        }
    },*/
    
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
        beforeedit: function( plugin, e )
        {            
            var rec = e.record;
            if(rec.data.estado>0)
                return false;
            if(e.field=="concepto")
            {
                //alert(rec.data.record.toSource());
                Ext.getCmp("combo-cosnceptos").setModo('<?='6'//=$modo->getCaIdmodo()?>',rec.data.idcomprobante);
                
            }
        },
        edit : function(editor, e, eOpts)
        {
            //alert(e.value);
            //var store = Ext.getCmp("grid-facturacion").getStore();
            var store = this.up('grid').getStore();
            
            if(e.field=="concepto")
            {
                //alert(editor.editors.items[0].field.rawValue);
                //alert(e.value);
                store.data.items[e.rowIdx].set('idconcepto', e.value);
                store.data.items[e.rowIdx].set('concepto', editor.editors.items[0].field.rawValue);                
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
            //var store = Ext.getCmp("grid-facturacion"+this.idmaster).getStore();
            //var store = this.up('grid').getStore();
            //alert(this.idmaster);
            var store=this.store;
            
            //console.log(e.getXY());
            
            
            itemCm = new Array();
            if(record.data.estado<=1 && <?=($enable?"true":"false")?>)
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
                        //alert(record.data.toSource());
                        var r = Ext.create('recfac', {
                            comprobante: record.get('comprobante'),
                            idcomprobante: record.get('idcomprobante'),
                            idhouse: record.get('idhouse'),
                            idccosto: record.get('idccosto')
                            });
                        store.insert(0, r);
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
                                   url: '<?= url_for("inoF/EliminarGridFacturacionPanel") ?>',
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
                    window.open("/inocomprobantes/generarComprobantePDF/id/"+record.get('idcomprobante'))
                }
            }
            );
            
            if(record.data.estado<=1  && <?=($enable?"true":"false")?> )
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
                                   url: '<?= url_for("inoF/generarFactura") ?>',
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
                                   url: '<?= url_for("inoF/EliminarGridFacturacionPanel") ?>',
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
            
            if(record.data.estado==5 && '<?=$permisos["contabilidad"]==true?>' )
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
                                    url: '<?= url_for("inoF/AnularComprobante") ?>',
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

            if(record.data.estado==6  && <?=($enable?"true":"false")?>)
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
                                       url: '<?= url_for("inoF/EnviarSiigoConect") ?>',
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
            console.log(itemCm);
            var menu = new Ext.menu.Menu({
                items: itemCm
            }).showAt(e.getXY());
        }      
    },
    ventanaFac : function(record,tipo)
    {
        //alert(record.data.toSource());
        //alert(tipo);
        
        if(constrainedWin2==null)
        {
            constrainedWin2 = Ext.create('Ext.Window', {
                //title: 'House',
                width: 800,
                autoHeight: true,
                closeAction: 'hide',
                x: 120,
                y: 120,
                id:"winFormEdit",
                name:"winFormEdit",
                constrainHeader: true,
                frame: true,
                layout: 'form',
                items: [{
                    xtype:'wFormFactura',
                    id:'form-panel',
                    name:'form-panel'
                }]
            })
        }
        if(record!=null)
        {
            Ext.getCmp("form-panel").cargar(record.data.idcomprobante);            
        }
        else
            Ext.getCmp("form-panel").getForm().reset();
        //if(tipo=="C")
//            Ext.getCmp("form-panel").config(tipo);
          constrainedWin2.show();
    }

});

</script>


