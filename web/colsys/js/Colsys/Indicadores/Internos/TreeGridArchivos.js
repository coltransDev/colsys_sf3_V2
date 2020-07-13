Ext.define('Colsys.Indicadores.Internos.TreeGridArchivos', {
    extend: 'Ext.tree.Panel',    
    controller: 'tree-grid',
    columns: [],
    listeners:{
        beforerender: function (ct, position) {
            var me = this;
            var url = this.url;
            this.reconfigure(                
                store = {
                    fields: [
                        {name: 'text' + me.indice, type: 'string', mapping: 'text'},'idarchivo','periodo','fchcreado','usucreado','observaciones','path'],
                    type: 'tree',
                    proxy: {
                        type: 'ajax',                        
                        url: url,
                        extraParams:{
                            idg: me.idg
                        }
                    },
                    root: {                        
                        id: 'src',
                        expanded: true
                    },
                    folderSort: true,
                    sorters: [{
                        property: 'text',
                        direction: 'ASC'
                    }]
                },
                [{
                    xtype: 'treecolumn',
                    text: 'Indicador',
                    dataIndex: 'text',
                    flex: 2
                },{
                    text: 'Periodo',
                    dataIndex: 'periodo',
                    flex: 1
                },{
                    xtype: 'hidden',                    
                    dataIndex: 'idarchivo'
                },{
                    text: 'Fch. Creado',
                    dataIndex: 'fchcreado',
                    flex: 1
                },{
                    text: 'Usu. Creado',
                    dataIndex: 'usucreado',
                    flex: 1
                },{
                    text: 'Observaciones',
                    dataIndex: 'observaciones',
                    flex: 1
                },{
                    xtype: 'actioncolumn',
                    id: 'eliminar'+ me.indice,
                    text: 'Eliminar',
                    width: 55,
                    menuDisabled: true,
                    tooltip: 'Eliminar archivo',
                    align: 'center',
                    iconCls: 'delete',
                    handler: 'onDeleteRowAction',
                    isActionDisabled: 'isRowEditDisabled'
                }]
            );
            tb = new Ext.toolbar.Toolbar();
            tb.add({
                text: 'Refrescar',
                iconCls: 'refresh',
                handler: function () {
                    me.getStore().reload();
                }
            });
            me.addDocked(tb);
                    
        }
    }
});

/**
 * Controller for the Tree Grid Archivos
 */
Ext.define('Colsys.view.tree.TreeGridController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.tree-grid',
    formatHours: function(v) {
        if (v < 1) {
            return Math.round(v * 60) + ' mins';
        }

        if (Math.floor(v) !== v) {
            var min = v - Math.floor(v);
            return Math.floor(v) + 'h ' + Math.round(min * 60) + 'm';
        }

        return v + ' hour' + (v === 1 ? '' : 's');
    },

    isRowEditDisabled: function(view, rowIdx, colIdx, item, record) {
        // Only leaf level tasks may be edited
        return !record.data.leaf;
    },

    onDeleteRowAction: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
        console.log(grid);
        Ext.MessageBox.confirm('Confirmaci\u00f3n de Eliminaci\u00f3n', 'Est\u00e1 seguro que desea anular el archivo?', function (choice) {
            if (choice == 'yes') {
                Ext.Ajax.request({
                    waitMsg: 'Eliminando...',
                    url: '/indicadores/eliminarArchivo',
                    params: {
                        idarchivo: record.get('idarchivo'),
                    },
                    failure: function (response, options) {
                        Ext.MessageBox.alert("Mensaje", 'Se presento un error Eliminando el registro.<br>' + response.errorInfo);
                        success = false;
                    },
                    success: function (response, options) {
                        var res = Ext.JSON.decode(response.responseText);
                        if (res.success) {
                            Ext.MessageBox.alert("Mensaje", 'Registro eliminado correctamente.<br>');
                            grid.up("treepanel").getStore().reload();
                        } else {
                            Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + res.errorInfo);
                        }
                    }
                })
            }
        })
//        Ext.Msg.alert('Editing' + (record.get('done') ? ' completed task' : '') ,
//            record.get('task'));
    }
});