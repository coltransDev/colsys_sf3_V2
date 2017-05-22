<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("widgets4", "wgCuentasSiigo");
//include_component("widgets4", "wgConceptosSiigo");
//include_component("widgets4", "wgParametros",array("caso_uso"=>"CU233"));
?>

<script>
    
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



function formatDate(value){
        return value ? Ext.Date.dateFormat(value, 'M d, Y') : '';
    }
*/    
    Ext.define('registro', {
     extend: 'Ext.data.Model',
     fields: [
        {name: 'idcuenta', type: 'int'},
        {name: 'cuenta', type: 'string'},
        {name: 'valor', type: 'double'},
        {name: 'referencia', type: 'string'}
     ]
 });
    
var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
    clicksToEdit: 1
});    

Ext.define('Ext.colsys.gridMovimientos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.gMovimientos',
    store: Ext.create('Ext.data.Store', {
    model: 'registro',
    id:'grid-movimientos',
    name:'grid-movimientos',
    proxy: {
         type: 'ajax',
         url: '<?=url_for('ino/datosComprobantes')?>',
         reader: {
             type: 'json',
             root: 'root'
         }
     },     
     sorters: [{
         property: 'cuenta',
         direction: 'ASC'
     }],
     autoLoad: false
    }),    
    features: [{
            //id: 'comprobante',
            ftype: 'summary',
            hideGroupedHeader: true,   
            totalSummary: 'fixed',          // Can be: 'fixed', true, false. Default: false
            totalSummaryTopLine: true,      // Default: true
            totalSummaryColumnLines: true  // Default: false
        }],
    columns: [
    {
        header: 'Cuenta',
        dataIndex: 'cuenta',
        width: 400,
        editor: new Ext.colsys.wgCuentasSiigo({
            id:'combo-conceptos',
            name:'combo-conceptos'            
        })
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
        id: 'referencia',
        header: 'Referencia',
        dataIndex: 'referencia',
        //flex: 1,
        width:400,
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
    width: 600,
    height: 300,
    //title: 'Edit Plants?',
    frame: true,
    tbar: [{
        text: 'Agregar',
        iconCls: 'add',
        handler : function(){
            var store1 = Ext.getCmp("grid-movimientos").getStore();
            
            var r = Ext.create('registro', {
                    cuenta: '',
                    valor: 0,
                    referencia: ''
                });
                 store1.insert(0, r);
        }
    }
    
    ],
    plugins: [ new Ext.grid.plugin.CellEditing({clicksToEdit: 1}) ],
    listeners: {        
        edit : function(editor, e, eOpts)
        {
            var store = Ext.getCmp("grid-movimientos").getStore();
            if(e.field=="cuenta")
            {
                store.data.items[e.rowIdx].set('codigocuenta', e.value);
                store.data.items[e.rowIdx].set('nombrecuenta', editor.editors.items[0].field.rawValue);
            }
            else if(e.field=="tercero")
            {
                //alert()
                //alert(editor.editors.items[2].field.rawValue);
                store.data.items[e.rowIdx].set('idtercero', e.value);
                store.data.items[e.rowIdx].set('tercero', editor.editors.items[1].field.rawValue);
            }
        }
    }
});  
</script>