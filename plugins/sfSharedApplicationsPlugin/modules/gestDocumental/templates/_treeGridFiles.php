<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<script>
    /*Ext.Loader.setConfig({
    enabled: true
});Ext.Loader.setPath('Ext.ux', '/js/Ext4/examples/ux');

Ext.require([
    'Ext.data.*',
    'Ext.grid.*',
    'Ext.tree.*',
    'Ext.ux.CheckColumn'
]);
     */
    var constrainedWin2=null;   

    /*var store = Ext.create('Ext.data.TreeStore', {
        fields: [
            {name: 'idarchivo',     type: 'string'},
            {name: 'nombre',     type: 'string'},
            {name: 'documento',     type: 'string'},
            {name: 'iddocumental',     type: 'string'},
            {name: 'path', type: 'string'},
            {name: 'ref1', type: 'string'},
            {name: 'ref2', type: 'string'},
            {name: 'ref3', type: 'string'},
            {name: 'usucreado', type: 'string'},
            {name: 'fchcreado', type: 'string'}
        ],
        proxy: {
            type: 'ajax',
            url: '<?= url_for('gestDocumental/dataFilesTree') ?>',
            autoLoad: false
        },
        //folderSort: true,
        autoLoad: false
    });*/

    
    //4life transfer.factor white nano factor inmune spray
    
    Ext.define('Ext.colsys.treeGridFiles', {
        extend: 'Ext.tree.Panel',
        alias: 'widget.wTreeGridFile',    
        title: 'Archivos',
        //width: 1000,
        //height: 300,
        //renderTo: "sub-panel",
        collapsible: true,
        useArrows: true,
        rootVisible: false,
        store: Ext.create('Ext.data.TreeStore', {
        fields: [
            {name: 'idarchivo',     type: 'string'},
            {name: 'nombre',     type: 'string'},
            {name: 'documento',     type: 'string'},
            {name: 'iddocumental',     type: 'string'},
            {name: 'path', type: 'string'},
            {name: 'ref1', type: 'string'},
            {name: 'ref2', type: 'string'},
            {name: 'ref3', type: 'string'},
            {name: 'usucreado', type: 'string'},
            {name: 'fchcreado', type: 'string'}
        ],
        proxy: {
            type: 'ajax',
            url: '<?= url_for('gestDocumental/dataFilesTree') ?>',
            autoLoad: false
        },
        //folderSort: true,
        autoLoad: false
    }),
        multiSelect: true,
        singleExpand: true,
        columnLines :true,
        clicksToEdit: 1,
        lines :true,
        viewConfig: {
            //allowCopy: true,
            //copy: true,
            plugins: {
                ptype: 'treeviewdragdrop',
                containerScroll: true
                
            },
            listeners: {       
                        drop: function (node, data, overModel, dropPosition) {   
                                
                                
                                Ext.Ajax.request({
                                    url: '/gestDocumental/editarArchivo',
                                    method: 'POST',
                                    params: {
                                        "idarchivo" : data.records[0].data.idarchivo,
                                        "ref" : overModel.raw.idarchivo,
                                        "depth2" : overModel.data.depth,
                                        "depth1":data.records[0].data.depth
                                        
                                    },
                                    scope:this,
                                    success: function(a,b){
                                        Ext.MessageBox.hide();
                                    },
                                    failure: function(){console.log('failure');}
                                });
                              
                        }
                    }
            ,getRowClass: function(record, rowIndex, rowParams, store){
                //alert(record.data.toSource());
                if(record.get("idarchivo")==record.get("nombre"))
                    return 'row_green';
            }
        },        
        /*onRender: function(ct, position){
            Ext.colsys.treeGridFiles.superclass.onRender.call(this, ct, position);
            this.expandAll();
        }
        ,*/
        //the 'columns' property is now 'headers'
        columns: [{
                xtype: 'treecolumn', //this is so we know which column will show the tree
                text: 'nombre',
                flex: 1,
                sortable: true,
                dataIndex: 'nombre',
                width:350,
                 renderer: function(value, metaData, record, row, col, store, gridView){                
                        if(record.get("idarchivo")==record.get("nombre"))
                        {                            
                            return value;
                        }
                        else
                        {
                            return "<a href='/gestDocumental/verArchivo?id_archivo="+record.get("idarchivo")+"' target='_blank'>"+value+"</a>";
                        }
                      }
            },{
                text: 'Tipo',
                flex: 1,
                dataIndex: 'documento',
                sortable: true
            }/*,{
                text: 'Ref 1',
                flex: 1,
                dataIndex: 'ref1',
                sortable: true
            },
            {
                text: 'Ref 2',
                flex: 1,
                dataIndex: 'ref2',
                sortable: true
            },{
                text: 'Ref 3',
                flex: 1,
                dataIndex: 'ref3',
                sortable: true
            }*/,{
                text: 'Usu Creado',
                flex: 1,
                dataIndex: 'usucreado',
                sortable: true
            },{
                text: 'Fecha Creado',
                flex: 1,
                dataIndex: 'fchcreado',
                sortable: true
            }, {
                text: '',
                width: 20,
                menuDisabled: true,
                xtype: 'actioncolumn',
                tooltip: 'Ver Carpeta',
                align: 'center',
                icon: '/images/16x16/edit.gif',
                renderer: function(value, metaData, record, row, col, store, gridView){                
                        if(record.get("idarchivo")==record.get("nombre"))
                        {                            
                            return "_";
                        }
                        else
                        {
                            return value;
                        }
                      },
                handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
                    //Ext.Msg.alert(record.data.toSource());
                                    
                    if(constrainedWin2==null)
                    {
                        constrainedWin2 = Ext.create('Ext.Window', {
                            title: 'Editar Archivo',
                            width: 500,
                            height: 300,
                            closeAction: 'hide',
                            x: 120,
                            y: 120,
                            id:"winFormEdit",
                            name:"winFormEdit",
                            constrainHeader: true,
                            frame: true,
                            layout: 'form',
                            items: [{
                                xtype:'wFormArchivo',                                
                                id:'form-panel-file1',
                                name:'form-panel-file1',
                                linkWin:"winFormEdit"
                            }]
                        })
                    }
                    constrainedWin2.show();
                    //Ext.getCmp("_field-file").hide();
                    Ext.getCmp("form-panel-file1").cargar(record.data);
                }
            },
            {
                text: '',
                width: 20,
                menuDisabled: true,
                xtype: 'actioncolumn',
                tooltip: 'Ver Carpeta',
                align: 'center',
                icon: '/images/16x16/delete_task.png',
                renderer: function(value, metaData, record, row, col, store, gridView){                
                        if(record.get("idarchivo")==record.get("nombre"))
                        {
                            return "_";
                        }
                        else
                        {
                            return value;
                        }
                      },
                handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
                
                    //alert(record.data.toSource());
                    Ext.MessageBox.show({
                        title: 'Eliminacion de '+record.data.nombre,
                        msg: 'Por favor ingrese el motivo de la eliminacion:',
                        width:300,
                        buttons: Ext.MessageBox.OKCANCEL,
                        multiline: true,
                        fn: function (btn, text){
                        
                            if( btn == "ok"){
                                if( text.trim()==""){
                                    alert("Debe colocar un motivo");
                                }else{
                                    if(btn=="ok")
                                    {
                                        Ext.MessageBox.wait('Eliminando Archivo', '');
                                        Ext.Ajax.request({
                                            url: '/gestDocumental/eliminarArchivo',
                                            method: 'POST',                
                                            waitTitle: 'Connecting',
                                            waitMsg: 'Eliminando Archivo...',                                     
                                            params: {
                                                "idarchivo" : record.data.idarchivo,
                                                "observaciones": text
                                            },
                                            scope:this,
                                            success: function(a,b){
                                                //Ext.getCmp("tree-grid-file").getStore().reload();
                                                //Ext.getCmp("tree-grid-file").expandAll();
                                                //this.up('grid').getStore().reload();
                                                //this.up('grid').expandAll();
                                                grid.getStore().reload();
                                                //grid.expandAll();
                                                Ext.MessageBox.hide();
                                            },
                                            failure: function(){console.log('failure');}
                                        });
                                    }
                                }
                            }
                        }
                    })
                }
            }
        ]
    });    
</script>