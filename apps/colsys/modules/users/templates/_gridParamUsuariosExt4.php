<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
include_component("widgets4", "wgImpoexpo");
include_component("widgets4", "wgTransporte");
include_component("widgets4", "wgModalidad");

?>
<script type="text/javascript">
var constrainedWin2=null;
Ext.Loader.setConfig({
    enabled: true
});
//Ext.Loader.setPath('Ext.ux', '../ux');

Ext.require([
    'Ext.selection.CellModel',
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.util.*',
    'Ext.state.*',
    'Ext.form.*',
    'Ext.ux.CheckColumn'
]);

    Ext.QuickTips.init();



function formatDate(value){
        return value ? Ext.Date.dateFormat(value, 'M d, Y') : '';
    }
    
    Ext.define('recfac', {
     extend: 'Ext.data.Model',
     fields: [
        {name: 'idusuparametros', type: 'int', mapping: 'ca_idusuparametros'},
        {name: 'idusuario', type: 'int', mapping: 'ca_idusuario'},
        {name: 'usuario', type: 'string', mapping: 'ca_usuario'},
        {name: 'impoexpo', type: 'string', mapping: 'ca_impoexpo'},
        {name: 'transporte', type: 'string', mapping: 'ca_transporte'},
        {name: 'modalidad', type: 'string', mapping: 'ca_modalidad'},
        {name: 'trafico', type: 'string', mapping: 'trafico'},
        {name: 'ciudad', type: 'string', mapping: 'ciudad'},
        {name: 'idcliente', type: 'integer', mapping: 'ca_idcliente'},
        {name: 'cliente', type: 'string', mapping: 'cliente'}
     ]
 });
    
   var store = Ext.create('Ext.data.Store', {
     model: 'recfac',
     proxy: {
         type: 'ajax',
         url: '<?=url_for('users/datosParamUsuarios')?>',
         reader: {
             type: 'json',
             root: 'root'
         }
     },
     groupField: 'usuario',
     sorters: [{
         property: 'usuario',
         direction: 'ASC'
     }],
     autoLoad: true
 });

var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
    clicksToEdit: 1
});    

Ext.define('Ext.colsys.gridParamUsuarios', {
  extend: 'Ext.grid.Panel',
  alias: 'widget.gParamUsuarios',
  anchor:'100%',
    store: store,
    id:'grid-paramusuarios',
    features: [{
            id: 'usuario',
            ftype: 'grouping',
            hideGroupedHeader: true            
        }],
    columns: [
        {
            id: 'usuario',
            header: 'Usuario',
            dataIndex: 'usuario',
            flex: 1
        },
        {
            id: 'impoexpo',
            header: 'ImpoExpo',
            dataIndex: 'impoexpo',        
            editor: new Ext.colsys.wgImpoexpo(),
            value:''
        },
        {
            id: 'transporte',
            header: 'Transporte',
            dataIndex: 'transporte',
            editor: new Ext.colsys.wgTransporte()
        },        
        {
            id: 'modalidad',            
            header: 'Modalidad',
            dataIndex: 'modalidad',        
            editor: new Ext.colsys.wgModalidad(
            {
                name: 'modalidadEditor',
                id:'modalidadEditor'
            }
            ),
            value:''
        },
        {
            id: 'Trafico',
            header: 'Trafico',
            dataIndex: 'trafico',        
            editor: {
                xtype: 'textfield'
            },
            value:''
        },
        {
            id: 'ciudad',
            header: 'Ciudad',
            dataIndex: 'ciudad',        
            editor: {
                xtype: 'textfield'
            },
            value:''
        },
        {
            id: 'cliente',
            header: 'Cliente',
            dataIndex: 'cliente',
            editor: {
                xtype: 'textfield'
            },
            value:''
        }
        
    ],
    selModel: {
        selType: 'cellmodel'
    },
    //renderTo: 'editor-grid',
    //width: 600,
    //height: 300,
    //title: 'Edit Plants?',
    frame: true,
    tbar: [{
        text: 'Agregar',
        iconCls: 'add',
        handler : function(){        
            //var store = Ext.getCmp("gird-paramusuarios").getStore();            
            Ext.getCmp("grid-paramusuarios").ventanaFac(null);
        }
    },
    {
        text: 'Guardar',
        iconCls: 'add',
        handler : function(){
            var store = Ext.getCmp("grid-paramusuarios").getStore();
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
                        url: '<?= url_for("ino/guardarGridFacturacion") ?>',
                        params: {                            
                            datos:str                            
                        },
                        success: function(response, opts) {
                            var res = Ext.decode(response.responseText);
                            var store = Ext.getCmp("gird-paramusuarios").getStore();
                            
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
                            }
                            if(res.errorInfo!="")
                            {
                                Ext.MessageBox.alert("Mensaje",'No fue posible el guardar la fila <br>'+res.errorInfo);
                            }
                                
                           
                           
                        },
                        failure: function(response, opts) {
                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                            box.hide();
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
        beforeedit: function( editor, e )
        {            
            if(e.field=="modalidad")
            {
                if(e.record.data.impoexpo=="" || e.record.data.transporte=="")
                {
                    //Ext.MessageBox.alert("Colsys", "Debe ingresar primero " );
                    return;
                }                
                var store = Ext.getCmp("modalidadEditor").getStore();                
                store.load({
                  params : {
                      transporte : '<?=  Constantes::MARITIMO?>',
                      impoexpo : '<?=  Constantes::IMPO?>'
                  }
              });
                
            }
        },
        /*edit : function(editor, e, eOpts)
        {
            //alert(e.value);
            var store = Ext.getCmp("gird-paramusuarios").getStore();
            store.data.items[e.rowIdx].set('idconcepto', e.value);
            store.data.items[e.rowIdx].set('concepto', editor.editors.items[0].field.rawValue);
        },*/
        beforeitemcontextmenu: function(view, record, item, index, e)
        {
            e.stopEvent();
            var store = Ext.getCmp("gird-paramusuarios").getStore();
            itemCm = new Array();
            if(record.data.estado!=1)
            {
                itemCm.push(
                {
                    text: 'Editar',
                    handler: function() {
                        Ext.getCmp("gird-paramusuarios").ventanaFac(record);
                    }
                },
                {
                    text: 'Agregar Concepto',
                    iconCls: 'add',
                    handler: function() {
                        var r = Ext.create('recfac', {
                            comprobante: record.get('comprobante'),
                            idcomprobante: record.get('idcomprobante'),
                            idhouse: record.get('idhouse')
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
                                   url: '<?= url_for("ino/EliminarGridFacturacionPanel") ?>',
                                   params: {                            
                                       iddetalle: record.get('iddetalle')
                                   },
                                   success: function(response, opts) {
                                        var obj = Ext.decode(response.responseText);

                                        if(obj.errorInfo!="")
                                            Ext.MessageBox.alert("Colsys", "Se genero la factura No. " + obj.errorInfo);
                                        else
                                            Ext.getCmp("gird-paramusuarios").getStore().reload();
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
                text: 'Ver factura',
                iconCls:'page_white_magnify',
                handler: function() {
                    //alert(record.data.toSource());
                    window.open("/inocomprobantes/generarComprobantePDF/id/"+record.get('idcomprobante'))
                }
            });

            if(record.data.estado!=1)
            {
                itemCm.push({
                    text: 'Generar Factura',
                    iconCls: 'import',
                    handler: function() {                        
                        Ext.MessageBox.confirm('Confirmacion', 'esta seguro de Generar la Factura y contabilizarla?', 
                        function(e){
                            if(e == 'yes'){
                               var box = Ext.MessageBox.wait('Procesando', 'Generacion de Factura')


                               Ext.Ajax.request({
                                   url: '<?= url_for("ino/generarFactura") ?>',
                                   params: {                            
                                       idcomprobante: record.get('idcomprobante')
                                   },                                    
                                   success: function(response, opts) {
                                       var obj = Ext.decode(response.responseText);
                                       Ext.getCmp("gird-paramusuarios").getStore().reload();
                                       box.hide();
                                       Ext.MessageBox.alert("Colsys", "Se genero la factura No. " + obj.consecutivo);
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
                    text: 'Eliminar Factura',
                    iconCls: 'delete',
                    handler: function() {                        
                        Ext.MessageBox.confirm('Confirmacion', 'esta seguro de eliminar la Factura', 
                        function(e){
                            if(e == 'yes'){
                               var box = Ext.MessageBox.wait('Procesando', 'Eliminando factura')
                               Ext.Ajax.request({
                                   url: '<?= url_for("ino/EliminarGridFacturacionPanel") ?>',
                                   params: {                            
                                       idcomprobante: record.get('idcomprobante')
                                   },
                                   success: function(response, opts) {
                                        var obj = Ext.decode(response.responseText);

                                        if(obj.errorInfo!="")
                                            Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                        else
                                            Ext.getCmp("gird-paramusuarios").getStore().reload();
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
        
            var menu = new Ext.menu.Menu({
                items: itemCm
            }).showAt(e.xy);
        }      
    }    
});

</script>


