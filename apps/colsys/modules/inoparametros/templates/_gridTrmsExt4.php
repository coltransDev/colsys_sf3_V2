<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>


<script type="text/javascript">
var constrainedWin2=null;
Ext.Loader.setConfig({
    enabled: true
});
//Ext.Loader.setPath('Ext.ux', '../ux');

Ext.define('reccosto', {
    extend: 'Ext.data.Model',
    fields: [
        {name: 'fecha', type: 'string',mapping: 'ca_fecha'},
        {name: 'pesos', type: 'numeric',mapping: 'ca_pesos'},
        {name: 'euro', type: 'numeric',mapping: 'ca_euro'}
     ]
 });
    
   var store = Ext.create('Ext.data.Store', {
     model: 'reccosto',
     proxy: {
         type: 'ajax',
         url: '<?=url_for('inoparametros/datosTrms')?>',         
         reader: {
             type: 'json',
             root: 'root',
             totalProperty: 'total'
         }
     },
     sorters: [{
         property: 'fecha',
         direction: 'DESC'
     }],
     autoLoad: true
 });


Ext.define('Ext.colsys.gridTrms', {
  extend: 'Ext.grid.Panel',
  alias: 'widget.gTrms',
    store: store,
    id:'grid-trms',
    /*features: [{           
            ftype: 'summary'
        }],*/
    columns: [
    {
        header: 'Fecha',
        dataIndex: 'fecha',
        width: 130,
        //renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        //renderer: Ext.util.Format.dateRenderer('Y-m-d'),                
        editor: {
            //xtype: 'datefield',
            xtype: 'textfield'//,
            //format: 'y-m-d'//,
            //minValue: '01/01/06',
            //disabledDays: [0, 6],
            //disabledDaysText: 'Plants are not available on the weekends'
        }
    },
    {
        header: 'Trm',
        dataIndex: 'pesos',
        width: 120,
        align: 'right',
        //renderer: 'usMoney',
        editor: {
            xtype: 'numberfield',
            allowBlank: false,
            minValue: 0,
            maxValue: 5000
        }
    },
    {
        header: 'Euro',
        dataIndex: 'euro',
        width: 120,
        align: 'right',
        //renderer: 'usMoney',
        editor: {
            xtype: 'numberfield',
            allowBlank: false,
            minValue: 0,
            decimalPrecision : 4,
            maxValue: 5000
        }
    }
    ],
    selModel: {
        selType: 'cellmodel'
    },
    width: 400,
    height: 400,
    frame: true,
    <?
    if($permiso>=0)
    {
    ?>
    tbar: [
        {
            text: 'Agregar',
            iconCls: 'add',
            handler : function(){        
                var store = Ext.getCmp("grid-trms").getStore();
                var r = Ext.create('reccosto', {
                                fecha: '',
                                pesos: '',
                                euro: ''
                                });
                            store.insert(0, r);
            }
        },
        {
            text: 'Guardar',
            iconCls: 'add',
            handler : function(){
                var store = Ext.getCmp("grid-trms").getStore();
                var records = store.getModifiedRecords();
                var lenght = records.length;

                changes=[];
                for( var i=0; i< lenght; i++){
                    r = records[i];

                     if( r.data.fecha!="" && r.getChanges())
                     {                
                        records[i].data.id=r.id                    
                        changes[i]=records[i].data;               
                     }
                }


                var str= JSON.stringify(changes);
                if(str.length>5)
                {
                    Ext.Ajax.request({
                            url: '<?= url_for("inoparametros/guardarGridTrms") ?>',
                            params: {                            
                                datos:str                            
                            },
                            success: function(response, opts) {
                                Ext.getCmp("grid-trms").getStore().reload();
                            }
                        });
                  }
                //alert(changes.toSource());
            }
        }
    ],
    plugins: [
    new Ext.grid.plugin.CellEditing({clicksToEdit: 1,id:'celledit'})
    ]
    <?
    }
    ?>
  

});

</script>