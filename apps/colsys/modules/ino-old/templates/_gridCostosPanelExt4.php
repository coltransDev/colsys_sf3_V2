<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$enable=($readOnly=="1")?false:true;
?>


<script type="text/javascript">
var constrainedWin2=null;
Ext.Loader.setConfig({
    enabled: true
});
//Ext.Loader.setPath('Ext.ux', '../ux');

/*Ext.require([
    'Ext.selection.CellModel',
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.util.*',
    'Ext.state.*',
    'Ext.form.*',
    'Ext.ux.CheckColumn'
]);

    Ext.QuickTips.init();
*/


/*function formatDate(value){
        return value ? Ext.Date.dateFormat(value, 'M d, Y') : '';
    }
 */   
    Ext.define('reccosto', {
     extend: 'Ext.data.Model',
     fields: [
        {name: 'idmaster', type: 'integer', mapping: 'c_ca_idmaster'},
        {name: 'idinocosto', type: 'integer', mapping: 'c_ca_idinocosto'},
        {name: 'idcosto', type: 'integer', mapping: 'c_ca_idcosto'},
        {name: 'concepto', type: 'string', mapping: 'cs_ca_concepto'},
        {name: 'idproveedor', type: 'integer', mapping: 'c_ca_idproveedor'},
        {name: 'proveedor', type: 'string', mapping: 'i_ca_nombre'},
        {name: 'factura', type: 'string', mapping: 'c_ca_factura'},
        {name: 'idmoneda', type: 'string', mapping: 'c_ca_idmoneda'},            
        {name: 'neto', type: 'float', mapping: 'c_ca_neto'},
        {name: 'venta', type: 'float', mapping: 'c_ca_venta'},
        {name: 'tcambio', type: 'float', mapping: 'c_ca_tcambio' },
        {name: 'tcambio_usd', type: 'float', mapping: 'c_ca_tcambio_usd'},   
        {name: 'valor_pesos', type: 'float' },
        {name: 'utilidad', type: 'float' },            
        {name: 'color', type: 'string'}
     ]
 });
    
   var store = Ext.create('Ext.data.Store', {
     model: 'reccosto',
     proxy: {
         type: 'ajax',
         url: '<?=url_for('ino/datosGridCostosPanel?idmaster='.$idmaster)?>',         
         reader: {
             type: 'json',
             root: 'root',
             totalProperty: 'total'
         }
     },        
     sorters: [{
         property: 'proveedor',
         direction: 'ASC'
     }],
     autoLoad: true
 });

/*var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
    clicksToEdit: 1
});    */

Ext.define('Ext.colsys.gridCosto', {
  extend: 'Ext.grid.Panel',
  alias: 'widget.gCosto',
    store: store,
    id:'grid-costo',
    features: [{           
            ftype: 'summary'
        }],
    columns: [
    {
        header: "Proveedor",
        dataIndex: 'proveedor',
        //hideable: false,
        sortable: true,
        width: 200,
        summaryRenderer: function(value, summaryData, dataIndex) {
            return "<b>Total</b>"; 
        }
      },  
      {
        header: "Costo",
        dataIndex: 'concepto',
        //hideable: false,
        sortable: true,
        width: 150,
        renderer: this.formatItem
      }, 
      {
        header: "Factura",
        dataIndex: 'factura',
        hideable: false,
        sortable: true,
        width: 100        

      },
      {
        header: "Neta",
        dataIndex: 'neto',
        hideable: false,
        sortable: true,
        width: 100,
        align: 'right',
        renderer: Ext.util.Format.numberRenderer('0,0.00'),        
        summaryType: 'sum',
        summaryRenderer: function(value, summaryData, dataIndex) {
                return "<b> "+Ext.util.Format.usMoney(value)+"</b>";
            }
       
      },
      {
        header: "Cambio",
        dataIndex: 'tcambio',
        hideable: false,
        sortable: true,
        width: 100,
        align: 'right',
        renderer: Ext.util.Format.numberRenderer('0,0.00'),
        summaryType: 'sum',
        summaryRenderer: function(value, summaryData, dataIndex) {
                return "<b> "+Ext.util.Format.usMoney(value)+"</b>";
            }       
      },
      {
        header: "Cambio USD",
        dataIndex: 'tcambio_usd',
        hideable: false,
        sortable: true,
        width: 100,
        align: 'right',
        renderer: Ext.util.Format.numberRenderer('0,0.00'),
        summaryType: 'sum',
        summaryRenderer: function(value, summaryData, dataIndex) {
                return "<b> "+Ext.util.Format.usMoney(value)+"</b>";
            }
      },
      {
        header: "Valor <?=$monedaLocal?>",
        dataIndex: 'valor_pesos',
        hideable: false,
        sortable: false,
        width: 100,
        align: 'right',
        renderer: this.valorPesos,
        summaryType: 'sum',
        summaryRenderer: function(value, summaryData, dataIndex) {
                return "<b> "+Ext.util.Format.usMoney(value)+"</b>";
            }
      },      
      {
        header: "Venta",
        dataIndex: 'venta',
        hideable: false,
        sortable: false,
        width: 100,
        align: 'right',
        renderer: Ext.util.Format.numberRenderer('0,0.00'),
        summaryType: 'sum',
        summaryRenderer: function(value, summaryData, dataIndex) {
                return "<b> "+Ext.util.Format.usMoney(value)+"</b>";
            }
       
      },
      {
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
            document.location = "<?=url_for("ino/formCosto")?>?modo=<?=$modo->getCaIdmodo()?>&idmaster=<?=$idmaster?>";       
        
        }
    },
    {
        text: 'Guardar',
        iconCls: 'add',
        handler : function(){
            var store = Ext.getCmp("grid-costo").getStore();
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
                        url: '<?= url_for("ino/guardarGridHouse") ?>',
                        params: {                            
                            datos:str                            
                        },

                        callback :function(options, success, response){
                            var res = Ext.util.JSON.decode( response.responseText );
                            store=Ext.getCmp("grid-costo").getStore();
                            store.each(function(r){
                                if(r.id==res.id){
                                    store.remove(r);
                                    Ext.Msg.alert("Success", "Se guardaron correctamente los datos");
                                }
                            });

                        }
                    });
              }
            //alert(changes.toSource());
        }
    }
    ],
    <?
    }
    ?>
    plugins: [
    new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    listeners: {
        validateedit: function(editor,e){
            
/*
 if(e.field == 'concepto') {
        var rec = e.record;
        var gridCols = this.columns;
        for(i = 0; i < gridCols.length; i++)
            if (gridCols[i].dataIndex == 'concepto') break;
        var combo = gridCols[i].getEditor(e.record);
        var store = combo.getStore();
        //var store = e.store;
        store.each( function( r ){
                    if( r.data.id==e.value ){
                        e.value = r.data.name;
                        rec.set("idconcepto", r.data.id);
                        //rec.set("concepto", r.data.name);
                        //field1=editor.field;
                        //field1.setValue(r.data.nombre);
        //                alert(e.value);
                        return true;
                    }
                }
            );
    }*/
         //records
         //document.write(e.grid.columns.toSource())
         
         //var ed = e.grid.getColumnModel().getCellEditor(e.column, e.row);
        
        /*
         return;
        //document.write(editor.toSource())
        if( e.field == "concepto"){
            var rec = e.record;
            //var ed = this.columns.getCellEditor(e.column, e.row);

            var store = editor.field.store;
            var store = e.store;
            store.each( function( r ){
                    if( r.data.id==e.value ){
                        e.value = r.data.nombre;
                        rec.set("idconcepto", r.data.id);
                        rec.set("concepto", r.data.name);
                        return true;
                    }
                }
            );
        }*/
    },
<?
    if($enable)
    {
?>
      beforeitemcontextmenu: function(view, record, item, index, e)
      {
        e.stopEvent();
        var record = this.store.getAt(index);
        
        <?
        if($enable)
        {
        ?>

        var menu = new Ext.menu.Menu({
            items: [
              {
                    text: 'Editar',                    
                    handler: function() {
                    document.location = "<?=url_for("ino/formCosto")?>?modo=<?=$modo->getCaIdmodo()?>&idinocosto="+record.get('idinocosto');
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
                                    url: '<?=url_for("ino/eliminarGridCostosPanel")?>',
                                    params :{
                                        idinocosto: record.get('idinocosto'),
                                        modo: '<?=$modo->getCaIdmodo()?>'
                                    },
                                    success: function(response, opts) {
                                        var obj = Ext.decode(response.responseText);                                        
                                        if(obj.errorInfo!="")
                                         {
                                            Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                         }
                                        else
                                        {
                                            Ext.getCmp("grid-costo").getStore().reload();
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
        <?
        }
        ?>
      }
<?
    }
?>
    }

});

</script>


